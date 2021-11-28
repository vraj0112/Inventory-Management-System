<?php
    include('./config.php');

    $fromdate = $_POST['fromdate'];
    $todate = $_POST['todate'];
    // $getDamageDetails = "SELECT category_name, subcategory_name, ProductTypeColor, BrandName,  SizeOrDimension, QtyPerUnit, PackingUnit, GradeText, Code, BatchNo, BasePrice, DateAdded, stockdetails.BillingQty AS BillingQty, stockdetails.OtherQty AS OtherQty, breakageanddamage.BillingQty AS DBillingQty, breakageanddamage.OtherQty AS DOtherQty, breakageanddamage.CreatedDate AS CreatedDate, breakageanddamage.StockId AS StockId, breakageanddamage.SysId AS SysId, productmst.ProductID AS ProductID, systable.BatchNo As BatchNo from breakageanddamage JOIN stockdetails, systable, productmst, subcategories, categories, brandnames, grades WHERE breakageanddamage.StockId = stockdetails.StockId and stockdetails.SysId = systable.SysId and systable.ProductId = productmst.ProductID and productmst.ProductSubCategoryID = subcategories.subcategory_id and subcategories.category_id = categories.category_id and productmst.BrandId = brandnames.BrandId and productmst.GradeId = grades.GradeId and breakageanddamage.CreatedDate >= '{$fromdate}' and breakageanddamage.CreatedDate <= '{$todate}'";
    $getDamageDetails = "SELECT category_name, subcategory_name, ProductTypeColor, BrandName,  SizeOrDimension, QtyPerUnit, PackingUnit, GradeText, Code, BatchNo, BasePrice, DateAdded, stockdetails.BillingQty AS BillingQty, stockdetails.OtherQty AS OtherQty, breakageanddamage.BillingQty AS DBillingQty, breakageanddamage.OtherQty AS DOtherQty, breakageanddamage.CreatedDate AS CreatedDate, breakageanddamage.StockId AS StockId, breakageanddamage.SysId AS SysId, productmst.ProductID AS ProductID, systable.BatchNo As BatchNo from breakageanddamage JOIN stockdetails, systable, productmst, subcategories, categories, brandnames, grades WHERE breakageanddamage.StockId = stockdetails.StockId and stockdetails.SysId = systable.SysId and systable.ProductId = productmst.ProductID and productmst.ProductSubCategoryID = subcategories.subcategory_id and subcategories.category_id = categories.category_id and productmst.BrandId = brandnames.BrandId and productmst.GradeId = grades.GradeId and breakageanddamage.CreatedDate between '{$fromdate}' and '{$todate}'";
    $result_getDamageDetails = mysqli_query($conn, $getDamageDetails);
    $dataToBeSent = array();
    //echo $getDamageDetails;

    if($result_getDamageDetails){
        

        if($result_getDamageDetails->num_rows > 0){

            $flag = array('FLAG' => "OKK");
            $dataToBeSent[] = $flag;

            while($row = $result_getDamageDetails->fetch_assoc()){
                $category = $row['category_name'];
                $subcategory = $row['subcategory_name'];
                $typeorcolor = $row['ProductTypeColor'];
                $brand = $row['BrandName'];
                $dimension = $row['SizeOrDimension'];
                $qtyperunit = $row['QtyPerUnit'];
                $packingunit = $row['PackingUnit'];
                $grade = $row['GradeText'];
                $code = $row['Code'];
                $batchno = $row['BatchNo'];
                $baseprice = $row['BasePrice'];
                $dateadded = $row['DateAdded'];
                $billingqty = $row['BillingQty'];
                $otherqty = $row['OtherQty'];
                $dbillingqty = $row['DBillingQty'];
                $dotherqty = $row['DOtherQty'];
                $damagedadditiondate = $row['CreatedDate'];
                $stockid = $row['StockId'];
                $sysid = $row['SysId'];
                $productid = $row['ProductID'];

                $obj = array(
                    'category' => $category,
                    'subcategory' => $subcategory,
                    'typeorcolor' => $typeorcolor,
                    'brand'       => $brand,
                    'dimension'   => $dimension,
                    'qtyperunit'  => $qtyperunit,
                    'packingunit' => $packingunit,
                    'grade'       => $grade,
                    'code'        => $code,
                    'batchno'     => $batchno,
                    'baseprice'   => $baseprice,
                    'dateadded'   => $dateadded,
                    'billingqty'  => $billingqty,
                    'otherqty'    => $otherqty,
                    'dbillingqty' => $dbillingqty,
                    'dotherqty'   => $dotherqty,
                    'damageadditiondate' => $damagedadditiondate,
                    'stockid'  => $stockid,
                    'sysid'    => $sysid,
                    'productid' => $productid 
                );

                $dataToBeSent[] = $obj;
            }

            echo json_encode($dataToBeSent);
        }
        else{
            $flag = array('FLAG' => "NORECORD");
            $dataToBeSent[] = $flag;
            die(json_encode($dataToBeSent));
        }
    }
    else{
        $flag = array('FLAG' => 'ERROR'); // ERROR => Error In Query
        $dataToBeSent[] = $flag;
        die(json_encode($dataToBeSent));
    }

?>