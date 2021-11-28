<?php
    include('./config.php');
    $productid = $_POST['productid'];
    $todate = $_POST['todate'];
    $fromdate = $_POST['fromdate'];
    $query="SELECT breakageanddamage.SysId, breakageanddamage.BillingQty AS DBillingQty, breakageanddamage.OtherQty AS DOtherQty, stockdetails.StockId, stockdetails.BillingQty AS BillingQty, stockdetails.OtherQty AS OtherQty, stockdetails.DateAdded AS DateAdded, systable.BasePrice AS BasePrice, breakageanddamage.CreatedDate AS CreatedDate, systable.BatchNo AS BatchNo  from breakageanddamage JOIN stockdetails, systable where breakageanddamage.StockId = stockdetails.StockId and stockdetails.SysId = systable.SysId and systable.ProductId = {$productid} and breakageanddamage.CreatedDate >= '{$fromdate}' and breakageanddamage.CreatedDate <= '{$todate}'";
    //echo $query;
    $getStocks = mysqli_query($conn,$query);

    $dataToBeSent = array();

    if($getStocks){
        if(mysqli_num_rows($getStocks) > 0){
            $obj = array('FLAG' => 'RECORDFOUND');
            $dataToBeSent[] = $obj;

            while($row = $getStocks->fetch_assoc()){
                $billing_qty = $row['BillingQty'];
                $other_qty = $row['OtherQty'];
                $base_price = $row['BasePrice'];
                $dateadded = $row['DateAdded'];
                $stock_id = $row['StockId'];
                $sysid = $row['SysId'];
                $dbillingqty = $row['DBillingQty'];
                $dothergqty = $row['DOtherQty'];
                $dcreateddate = $row['CreatedDate'];
                $batchno = $row['BatchNo'];

                $obj = array('billingqty' => $billing_qty, 'otherqty' => $other_qty, 'baseprice' => $base_price, 'dateadded' => $dateadded, 'stockid' => $stock_id, 'sysid' => $sysid, 'dbillingqty' => $dbillingqty, 'dotherqty' => $dothergqty, 'dcreateddate' => $dcreateddate, 'batchno' => $batchno);
                $dataToBeSent[] =$obj;
            }
            echo json_encode($dataToBeSent);
        }else{
            $obj = array('FLAG' => 'NORECORDFOUND' );
            $dataToBeSent[] = $obj;
            echo json_encode($dataToBeSent);
        }
    }else{
        $obj = array('FLAG' => 'ERRORINQUERY' );
        $dataToBeSent[] = $obj;
        echo json_encode($dataToBeSent);
    }

?>