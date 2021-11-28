<?php
    include('./config.php');

    $query="SELECT * from stockdetails join systable where stockdetails.SysId=systable.SysId and systable.ProductId=". $_POST['productid']." and (BillingQty>0 or OtherQty>0) and RecStatus=true";
    //echo $query;
    $getStocks = mysqli_query($conn,$query);

    $dataToBeSent = array();

    if($getStocks){
        if(mysqli_num_rows($getStocks) > 0){
            $obj = array('FLAG' => 'RECORDFOUND');
            $dataToBeSent[] = $obj;

            while($row = $getStocks->fetch_assoc()){
                $billing_qty = $row['VirtualQty'];
                $other_qty = $row['OtherQty'];
                $base_price = $row['BasePrice'];
                $date_added = $row['DateAdded'];
                $stock_id = $row['StockId'];

                $obj = array('billingqty' => $billing_qty, 'otherqty' => $other_qty, 'baseprice' => $base_price, 'dateAdded' => $date_added, 'stockid' => $stock_id);
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