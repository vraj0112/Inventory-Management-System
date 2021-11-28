<?php

    include('./config.php');
    $data = file_get_contents("php://input");
    $challandata = $_POST['challandata'];
    //echo $challandata;
    $challandata = json_decode($challandata, true);
    $challanid = $challandata[0]['challanid'];

    $n = count($challandata);
    mysqli_autocommit($conn, false);
    $total = 0;
    for($i = 1; $i<$n; $i++){

        $stockid           = $challandata[$i]['stockid'];
        $billingqty        = $challandata[$i]['billingqty'];
        $otherqty          = $challandata[$i]['otherqty'];
        $sellingprice      = $challandata[$i]['sellingprice'];

        $total = (intval($billingqty) + intval($otherqty))* floatval($sellingprice);
        
        $updateStockDetails = "UPDATE stockdetails SET BillingQty = BillingQty + ({$billingqty}), OtherQty = OtherQty + ({$otherqty}), ModifiedDate=now() WHERE StockId = {$stockid}";
        $result_updateStockDetails = mysqli_query($conn, $updateStockDetails);

        if(!$result_updateStockDetails){
            mysqli_rollback($conn);
            mysqli_autocommit($conn, true);
            die("-1"); // -1 => error in stockdetails Query
        }

        $InsertInReturndetails = "INSERT INTO returndetails (ChallanId ,StockId, BillingReturnQty , OtherReturnQty , ReturnAmount , Createddate , RecStatus) VALUES($challanid ,$stockid, $billingqty , $otherqty, $total ,now(), 1)";
        $result_InsertReturndetails = mysqli_query($conn, $InsertInReturndetails);

        if(!$result_InsertReturndetails){
            mysqli_rollback($conn);
            mysqli_autocommit($conn, true);
            die("-5"); // -1 => error in stockdetails Query
        }
        //}

        $updateInChallandetails = "UPDATE challandetails SET BillingQty=BillingQty-{$billingqty},OtherQty=OtherQty-{$otherqty} WHERE ChallanId = {$challanid} and StockId={$stockid}";
        $result_updateInChallandetails = mysqli_query($conn, $updateInChallandetails);
    
        if(!$result_updateInChallandetails){
            mysqli_rollback($conn);
            mysqli_autocommit($conn, true);
            die("-2"); // -2v => Error In Challan Mst Update Query
        }

        $updateInChallanMst = "UPDATE challanmst SET TotalAmount = TotalAmount-{$total} where ChallanId = {$challanid}";
        $result_updateInChallanMst = mysqli_query($conn, $updateInChallanMst);
    
            if(!$result_updateInChallanMst){
                mysqli_rollback($conn);
                mysqli_autocommit($conn, true);
                die("-10"); // -10v => Error In Challan Mst Update Query
            }

        // $select = "SELECT AmountPaid from tblinwardpayment where tblinwardpayment.StockMstSysId='1' and tblinwardpayment.ChallanId={$challanid} ";
        // $result_select = mysqli_query($conn, $select);

        //$updateInChallan = "UPDATE challanmst inner join tblinwardpayment on challanmst.ChallanId=tblinwardpayment.ChallanId set DueAmount = TotalAmount - AmountPaid  where tblinwardpayment.ChallanId={$challanid} and tblinwardpayment.StockMstSysId='1' ";
        $updateInChallan = "UPDATE challanmst,tblinwardpayment SET DueAmount = (TotalAmount+ExtraCost+TransportCost)-(Discount+AmountPaid) WHERE challanmst.ChallanId=tblinwardpayment.ChallanId AND tblinwardpayment.StockMstSysId='1' and tblinwardpayment.ChallanId={$challanid}";
        $result_updateInChallan = mysqli_query($conn, $updateInChallan);
        
            if(!$result_updateInChallan){
                mysqli_rollback($conn);
                mysqli_autocommit($conn, true);
                die("-11"); // -10v => Error In Challan Mst Update Query
            }




            $updateInPayment = "UPDATE challanmst,tblinwardpayment SET AmountPending = DueAmount WHERE challanmst.ChallanId=tblinwardpayment.ChallanId AND tblinwardpayment.StockMstSysId='1' and tblinwardpayment.ChallanId={$challanid}";
        $result_updateInPayment = mysqli_query($conn, $updateInPayment);
        
            if(!$result_updateInPayment){
                mysqli_rollback($conn);
                mysqli_autocommit($conn, true);
                die("-11"); // -10v => Error In Challan Mst Update Query
            }



          


    

        // $updateInPayment = "UPDATE tblinwardpayment SET AmountPending = AmountPending-{$total}, ModifiedDate=now() WHERE ChallanId = {$challanid}";
        // $result_updateInPayment = mysqli_query($conn, $updateInPayment);

        // if(!$result_updateInPayment){
        //     mysqli_rollback($conn);
        //     mysqli_autocommit($conn, true);
        //     die("-3"); // -3 => Error In Update Payment Update Query
        // }

        // if(mysqli_commit($conn)){
        //     mysqli_autocommit($conn, true);
        //     echo "1";
        // }
        // else{
        //     mysqli_rollback($conn);
        //     mysqli_autocommit($conn, true);
        //     die("-4"); // -4=> Commit Fail
        // }

        //For deleting the row having zero billing qty and other qty
        $deletenullquantity = "DELETE FROM returndetails WHERE BillingReturnQty = '0' and OtherReturnQty = '0' ";
        $result_deletenullqty = mysqli_query($conn, $deletenullquantity);
    }

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