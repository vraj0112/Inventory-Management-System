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

        if($billingqty==0 && $otherqty==0)
        {
            //update qty is zero then Modifieddate should not get modified
            $UpdateInReturndetails = "UPDATE returndetails SET BillingReturnQty=BillingReturnQty+{$billingqty},OtherReturnQty=OtherReturnQty+{$otherqty} WHERE ChallanId = {$challanid} and StockId={$stockid} and Createddate IN (SELECT max(Createddate) FROM returndetails where StockId={$stockid} and ChallanId={$challanid})";
            $result_UpdateReturndetails = mysqli_query($conn, $UpdateInReturndetails);

            if(!$result_UpdateReturndetails){
                mysqli_rollback($conn);
                mysqli_autocommit($conn, true);
            die("-5"); // -1 => error in returndetails Query
            }
        }
        else
        {
            //update qty is not zero then Modifieddate should get modified
            $UpdateInReturndetails = "UPDATE returndetails SET BillingReturnQty=BillingReturnQty+{$billingqty},OtherReturnQty=OtherReturnQty+{$otherqty},Modifieddate=now() WHERE ChallanId = {$challanid} and StockId={$stockid} and Createddate IN (SELECT max(Createddate) FROM returndetails where StockId={$stockid} and ChallanId={$challanid})";
            $result_UpdateReturndetails = mysqli_query($conn, $UpdateInReturndetails);

            if(!$result_UpdateReturndetails){
                mysqli_rollback($conn);
                mysqli_autocommit($conn, true);
                die("-5"); // -1 => error in returndetails Query
            }
        }

        // $UpdateInReturndetails = "UPDATE returndetails SET BillingReturnQty=BillingReturnQty+{$billingqty},OtherReturnQty=OtherReturnQty+{$otherqty} WHERE ChallanId = {$challanid} and StockId={$stockid} and Createddate IN (SELECT max(Createddate) FROM returndetails where StockId={$stockid} and ChallanId={$challanid}";
        // //UPDATE returndetails SET BillingReturnQty=BillingReturnQty+1,OtherReturnQty=OtherReturnQty+0 WHERE ChallanId=12 and StockId=4 and  Createddate IN (SELECT max(Createddate) FROM returndetails where StockId=4 and ChallanId=12);
        // //UPDATE returndetails SET Modifieddate=curdate()+'00:00:00' WHERE ChallanId = 12
        // $result_UpdateReturndetails = mysqli_query($conn, $UpdateInReturndetails);

        // if(!$result_UpdateReturndetails){
        //     mysqli_rollback($conn);
        //     mysqli_autocommit($conn, true);
        //     die("-5"); // -1 => error in stockdetails Query
        // }

        // //For deleting the row having zero billing qty and other qty
        // $deletenullquantity = "DELETE FROM returndetails WHERE BillingReturnQty = '0' and OtherReturnQty = '0' ";
        // $result_deletenullqty = mysqli_query($conn, $deletenullquantity);

        // //update qty is zero then Modifieddate should not get modified
        // $UpdateReturndetailsZeroQty = "UPDATE returndetails SET Modifieddate=now() WHERE ChallanId = {$challanid} and StockId={$stockid} and Createddate=max(Createddate)";
        // $result_UpdateReturndetailsZeroQty = mysqli_query($conn, $UpdateReturndetailsZeroQty);
    //}

    //Here challanid can be same but stockid will be different
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

    $updateInChallan = "UPDATE challanmst,tblinwardpayment SET DueAmount = (TotalAmount+ExtraCost+TransportCost)-(Discount+AmountPaid) WHERE challanmst.ChallanId=tblinwardpayment.ChallanId AND tblinwardpayment.StockMstSysId='1' and tblinwardpayment.ChallanId={$challanid}";
    $result_updateInChallan = mysqli_query($conn, $updateInChallan);
        
        if(!$result_updateInChallan){
            mysqli_rollback($conn);
            mysqli_autocommit($conn, true);
            die("-11"); // -10v => Error In Challan Mst Update Query
        }
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