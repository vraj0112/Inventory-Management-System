<?php

    include('./config.php');
    $data = file_get_contents("php://input");
    $invoicedata = $_POST['invoicedata'];
    $invoicedata = json_decode($invoicedata, true);
    
    $invoiceid = $invoicedata[0]['invoiceid'];
    $discount = $invoicedata[0]['discount'];
    $totalamout = $invoicedata[0]['total'];
    $transportationcost = $invoicedata[0]['transportationcost'];
    // $extracostdesc = $invoicedata[0]['extracostdesc'];
    // $extracost = $invoicedata[0]['extracost'];
    // $payedamount = $invoicedata[0]['payedamount'];

    $n = count($invoicedata);
    mysqli_autocommit($conn, false);
    $total = 0;
    //$total gst=0;
    for($i = 1; $i<$n; $i++){

        $stockid           = $invoicedata[$i]['stockid'];
        $oldbillingqty     = $invoicedata[$i]['oldbillingqty'];
    //    $oldotherqty       = $invoicedata[$i]['oldotherqty'];
        $billingqty        = $invoicedata[$i]['billingqty'];
      //  $otherqty          = $invoicedata[$i]['otherqty'];
        $sellingprice      = $invoicedata[$i]['sellingprice'];
        $updatebillingqty  = $billingqty - $oldbillingqty;
      //  $updateotherqty    = $otherqty - $oldotherqty;

      // $total = (intval($billingqty))* floatval($sellingprice);

       $editInvoiceDetails = "UPDATE invoicedetails SET Quantity = Quantity + ({$updatebillingqty}), SellingPrice = {$sellingprice} WHERE InvoiceId = {$invoiceid} and StockId= {$stockid}";
        $result_editInInvoiceDetails = mysqli_query($conn,$editInvoiceDetails);
        $updateStockDetails = "UPDATE stockdetails SET VirtualQty = VirtualQty - ({$updatebillingqty}) WHERE StockId = {$stockid}";
        $result_updateStockDetails = mysqli_query($conn, $updateStockDetails);

        if(!$result_editInInvoiceDetails && !$result_updateStockDetails){
            mysqli_rollback($conn);
            mysqli_autocommit($conn, true);
            die("-1"); // -1 => error in challandetails or stockdetails Query
        }
    }
    // $subtotal = $total - floatval($discount) + floatval($transportationcost) + floatval($extracost);
    // $dueamount = $subtotal - floatval($payedamount);

    $editIninvoiceMst = "UPDATE invoicemst SET Discount = '{$discount}', TransportationCost = '{$transportationcost}', ModifiedDate = now(), TotalAmount = {$totalamout} WHERE InvoiceId = {$invoiceid}";
    $result_editInChallanMst = mysqli_query($conn, $editIninvoiceMst);
    //echo $editIninvoiceMst;
    if(!$result_editInChallanMst){
        mysqli_rollback($conn);
        mysqli_autocommit($conn, true);
        die("-2"); // -2v => Error In Challan Mst Update Query
    }

    // if($dueamount == 0){
    //     $pendingstatus = "Complete";
    // }
    // else{
    //     $pendingstatus = "Pending";
    // }
    // $updateInPayment = "UPDATE tblinwardpayment SET AmountPaid = {$payedamount}, AmountPending = {$dueamount}, Status = '{$pendingstatus}', ModifiedDate=now() WHERE ChallanId = {$invoiceid}";
    // $result_updateInPayment = mysqli_query($conn, $updateInPayment);

    // if(!$result_updateInPayment){
    //     mysqli_rollback($conn);
    //     mysqli_autocommit($conn, true);
    //     die("-3"); // -3 => Error In Update Payment Update Query
    // }

    if(mysqli_commit($conn)){
        mysqli_autocommit($conn, true);
        echo "1";
    }
    else{
        mysqli_rollback($conn);
        mysqli_autocommit($conn, true);
        die("-4"); // -4=> Commit Fail
    }
?>