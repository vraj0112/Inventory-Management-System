<?php

    include('./config.php');
    $stockid = $_POST['stockid'];
    $sysid = $_POST['sysid'];
    $updatebillingqty = $_POST['updatebillingqty'];
    $updateotherqty = $_POST['updateotherqty'];

    mysqli_autocommit($conn, false);

    $result_updateStockDetails = mysqli_query($conn, "UPDATE stockdetails SET BillingQty=BillingQty - ({$updatebillingqty}),OtherQty=OtherQty - ({$updateotherqty}) where StockId={$stockid}");
    //$result1=mysqli_query($conn, "UPDATE stockdetails SET DateAdded=curdate() where StockId='$id'");
   // if($result)
     // {
         //echo "<script>console.log('done2')</script>";
        // $link= "<script>window.open('Breakage&Damage.php')</script>";
     // }

    $result_insertIntoBreakageAndDamage = mysqli_query($conn, "UPDATE breakageanddamage SET BillingQty = BillingQty + ({$updatebillingqty}), OtherQty = OtherQty + ({$updateotherqty}), ModifiedDate = CURDATE() WHERE SysId = {$sysid}");
    //echo $result_insertIntoBreakageAndDamage;
    if(!$result_updateStockDetails || !$result_insertIntoBreakageAndDamage){
        mysqli_rollback($conn);
        mysqli_autocommit($conn, true);
        die("-1"); // -1 => Error  In Query
    }
    else{
        mysqli_autocommit($conn, true);
        echo '1';
    }



    //  CREATE TABLE breakageanddamage 
    //  (
    //      SysId int PRIMARY KEY AUTO_INCREMENT,
    //      StockId int,
    //      BillingQty int,
    //      OtherQty int,
    //      CreatedDate date DEFAULT CURRENT_DATE,
    //      ModifiedDate date,
    //      RecStatus boolean DEFAULT true,
    //      FOREIGN KEY (StockId) REFERENCES stockdetails(StockId)
    //  )
?>