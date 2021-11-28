<?php
    include('./config.php');

    $data = file_get_contents("php://input");
    $mydata = json_decode($data, true);

    if(!empty($mydata))
    {
        mysqli_autocommit($conn, false);

        $pid = $mydata['pid'];
        $type = $mydata['type'];
        $subtypeid = $mydata['subtypeid'];
        $producttypeorcolor = $mydata['producttypeorcolor'];
        $producttypeorcolor = ucwords(strtolower($producttypeorcolor));
        $producttypeorcolor = trim(preg_replace('/\s+/',' ', $producttypeorcolor));
        $brandid = $mydata['brandid'];
        $dimension = $mydata['dimension'];
        /*$dimension = ucwords(strtolower($dimension));
        $dimension = trim(preg_replace('/\s+/',' ', $dimension));/** */
        $qtyperunit = $mydata['qtyperunit'];
        $packingunit = $mydata['packingunit'];
        $gradeid = $mydata['gradeid'];
        $code = $mydata['code'];
        $code = ucwords(strtolower($code));
        $code = trim(preg_replace('/\s+/',' ', $code));


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
                mysqli_rollback($conn);
                mysqli_autocommit($conn, true);
                die("-3");  //  -3 => Commit Fail
            }
            else
            {
                mysqli_autocommit($conn, true);
                echo "1"; //  1 => Success
            }
        }
        else
        {
            mysqli_rollback($conn);
            mysqli_autocommit($conn, true);
            die("-2"); // -2 => Error In Update Query
        }
    }
    else
    {
        die("-1");  // -1 => Parameters Empty
    }
?>