<?php

    include('./config.php');

    $data = file_get_contents("php://input");
    $mydata = json_decode($data, true);

    $type = $mydata['type'];
    $subcatid = $mydata['subtype'];
    $typeorcolor = $mydata['producttypeorcolor'];
    $brandid = $mydata['brandid'];
    $dimension = $mydata['dimension'];
    $qty = $mydata['qtyperunit'];
    $packingunit = $mydata['packingunit'];
    $gradeid = $mydata['gradeid'];
    $code = $mydata['code'];

    $searchIntoProductMst = "SELECT COUNT(1) AS noofrecord FROM productmst WHERE "
        ."ProductSubCategoryID=".$subcatid." AND "
        //."ProductHSNCode='".$hsncode."' AND "
        ."ProductTypeColor='".$typeorcolor."' AND "
        ."BrandId=".$brandid." AND "
        ."SizeOrDimension='".$dimension."' AND "
        ."QtyPerUnit=".$qty." AND "
        ."PackingUnit='".$packingunit."' AND "
        ."GradeId=".$gradeid." AND "
        ."Code='".$code."'  ";


        // echo $searchIntoProductMst;

    $resultsearchIntoProductMst = mysqli_query($conn, $searchIntoProductMst);
    if($resultsearchIntoProductMst)
    {
        $row = $resultsearchIntoProductMst ->fetch_assoc();
        $noofrecord = $row['noofrecord'];

        if($noofrecord == 0)
        {
            echo "0"; // 1 ==> Success
        }
        else if($noofrecord == 1)
        {
            echo "1"; // 0 ==> Record Found
        }
        else
        {
            echo "-1"; // -1 ==> More Then One Record Found
        }   

    }
    else
    {
        
        echo "-2";  //  -2 ==> Error In Query Executing
    } 
?>