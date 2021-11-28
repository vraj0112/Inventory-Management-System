<?php
    include('./config.php');

    $data = file_get_contents("php://input");
    $mydata = json_decode($data, true);

    if(!empty($mydata))
    {
        mysqli_begin_transaction($conn, MYSQLI_TRANS_START_READ_WRITE);

        $pid = $mydata['pid'];
        $type = $mydata['type'];
        $subtypeid = $mydata['subtypeid'];
        $producttypeorcolor = $mydata['producttypeorcolor'];
        $brandid = $mydata['brandid'];
        $dimension = $mydata['dimension'];
        $qtyperunit = $mydata['qtyperunit'];
        $packingunit = $mydata['packingunit'];
        $gradeid = $mydata['gradeid'];
        $code = $mydata['code'];


        $updatequery = "UPDATE ProductMst SET "
                        ."  ProductSubCategoryID = ".$subtypeid.", "
                        ."  ProductTypeColor='".$producttypeorcolor."', "
                        ."  SizeOrDimension='".$dimension."', "
                        ."  QtyPerUnit='".$qtyperunit."', "
                        ."  PackingUnit='".$packingunit."', "
                        ."  Code='".$code."', "
                        ."  ModifiedDate=CURRENT_DATE,  "
                        ."  BrandId =".$brandid." , "
                        ."  GradeId =".$gradeid."  "
                        ."  WHERE ProductID = ".$pid." ";

        //echo $updatequery;
        $resultupdatequery = mysqli_query($conn, $updatequery);

        if($resultupdatequery)
        {
            if(!mysqli_commit($conn))
            {
                die("-3");  //  -3 => Commit Fail
            }
            else
            {
                echo "1"; //  1 => Success
            }
        }
        else
        {
            die("-2"); // -2 => Error In Update Query
        }
    }
    else
    {
        die("-1");  // -1 => Parameters Empty
    }
?>