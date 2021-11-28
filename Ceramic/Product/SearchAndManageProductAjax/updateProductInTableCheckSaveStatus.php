<?php
    include('./config.php');

    $data = file_get_contents("php://input");
    $mydata = json_decode($data, true);

    if(!empty($mydata))
    {
       

        $pid = $mydata['pid'];
        $type = $mydata['type'];
        $subtypeid = $mydata['subtypeid'];
        $producttypeorcolor = $mydata['producttypeorcolor'];
        $producttypeorcolor = ucwords(strtolower($producttypeorcolor));
        $producttypeorcolor = trim(preg_replace('/\s+/',' ', $producttypeorcolor));
        $brandid = $mydata['brandid'];
        $dimension = $mydata['dimension'];
        /*$dimension = ucwords(strtolower($dimension));
        $dimension = trim(preg_replace('/\s+/',' ', $dimension));*/
        $qtyperunit = $mydata['qtyperunit'];
        $packingunit = $mydata['packingunit'];
        $gradeid = $mydata['gradeid'];
        $code = $mydata['code'];
        $code = ucwords(strtolower($code));
        $code = trim(preg_replace('/\s+/',' ', $code));

        $checkForRecords = "SELECT COUNT(1) AS noofrecord FROM ProductMst Where "
                        ."  ProductSubCategoryID = ".$subtypeid." AND "
                        ."  ProductTypeColor='".$producttypeorcolor."' AND "
                        ."  SizeOrDimension='".$dimension."' AND "
                        ."  QtyPerUnit='".$qtyperunit."' AND "
                        ."  PackingUnit='".$packingunit."' AND "
                        ."  Code='".$code."' AND "
                        ."  BrandId =".$brandid."  AND "
                        ."  GradeId =".$gradeid."  AND "
                        ."  ProductMst.RecStatus = true";

        
        $resultcheckForRecords = mysqli_query($conn, $checkForRecords);

        if($resultcheckForRecords){

            $row = $resultcheckForRecords->fetch_assoc();
            $noofrecord = $row['noofrecord'];

            if($noofrecord == 0)
            {
                mysqli_autocommit($conn, false);
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

                $resultupdatequery = mysqli_query($conn, $updatequery);

                if($resultupdatequery)
                {
                    if(!mysqli_commit($conn))
                    {
                        mysqli_rollback($conn);
                        mysqli_autocommit($conn, true);
                        die("-6");  //  -3 => Commit Fail
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
                    die("-5");  //   -5 => Error In Update Query 
                }
            }
            else if($noofrecord == 1)
            {
                die("-3");  // -3 => Record Already Exists
            }
            else
            {
                die('-4');  //  -4 => More Then One Record Found
            }
        }
        else
        {
            die("-2"); // -2 => Error In cheack Query
        }  
    }
    else
    {
        die("-1");  // -1 => Parameters Empty
    }
?>