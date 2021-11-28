<?php
    include('../config.php');
    
    $InvoiceId = $_POST['InvoiceId'];

    $query = "SELECT subcategory_name, ProductGST, ProductTypeColor, BrandName, SizeOrDimension, QtyPerUnit, PackingUnit, GradeText, Code, DateAdded, BatchNo, invoicedetails.Quantity AS BillingQty, stockdetails.VirtualQty AS AvailableBillingQty, invoicedetails.SellingPrice AS SellingPrice, stockdetails.StockId AS StockId FROM invoicedetails JOIN stockdetails, systable, productmst, brandnames, grades, subcategories WHERE invoicedetails.StockId = stockdetails.StockId and stockdetails.SysId = systable.SysId and systable.ProductId = productmst.ProductID and productmst.BrandId = brandnames.BrandId and productmst.GradeId = grades.GradeId and productmst.ProductSubCategoryID = subcategories.subcategory_id and invoicedetails.InvoiceId = {$InvoiceId}";
    $result = mysqli_query($conn, $query);

    $dataToBeSent = array();
    if($result){
        $no_of_rows = $result->num_rows;
        if($no_of_rows > 0){
            $flag = array('FLAG' => "OKK");
            $dataToBeSent[] = $flag;

            while($row = $result->fetch_assoc()){
                $subcategory_name = $row['subcategory_name'];
                $GST              =$row['ProductGST'];
                $typeorcolor      = $row['ProductTypeColor'];
                $brandname        = $row['BrandName'];
                $dimension        = $row['SizeOrDimension'];
                $qtyperunit       = $row['QtyPerUnit'];
                $packingunit      = $row['PackingUnit'];
                $gradetext        = $row['GradeText'];
                $code             = $row['Code'];
                $date             = $row['DateAdded'];
                $batchno          = $row['BatchNo'];
                $billingqty       = $row['BillingQty'];
                //$otherqty         = $row['OtherQty'];
                $sellingprice     = $row['SellingPrice'];
                $availablebillingqty = $row['AvailableBillingQty'];
              //  $availableotherqty = $row['AvailableOtherQty'];
                $stockid = $row['StockId'];

                $obj = array(
                    'subcategoryname' => $subcategory_name,
                    'GST'             =>$GST,
                    'typeorcolor'     => $typeorcolor,
                    'brandname'       => $brandname,
                    'dimension'       => $dimension,
                    'qtyperunit'      => $qtyperunit,
                    'packingunit'     => $packingunit,
                    'grade'           => $gradetext,
                    'code'            => $code,
                    'date'            => $date,
                    'batchno'         => $batchno,
                    'billingqty'      => $billingqty,
                   // 'otherqty'        => $otherqty,
                    'sellingprice'    => $sellingprice,
                    'availablebillingqty' => $availablebillingqty,
                   // 'availableotherqty' => $availableotherqty,
                    'stockid' => $stockid
                );

                $dataToBeSent[] = $obj;
            }

            echo json_encode($dataToBeSent);

        }
        else{
            $flag = array('FLAG' => "RECORDNOTFOUND"); // RECORDNOTFOUND => No Items Found n this Challan
            $dataToBeSent[] = $flag;
            die($dataToBeSent);
        }
    }
    else{
        $flag = array('FLAG' => "ERRINQUERY"); // ERRINQUERY => Error In Query
        $dataToBeSent[] = $flag;
        die($dataToBeSent);
    }

?>