 <?php
include("config.php");
include("uploadImg.php");
if (isset($_GET['log1'])) {


    $count               = $_POST['count'];
    $pcnt                = $_POST['count2'];
    $count1              = $_POST['count'];
    
    $insertsys = "";
    $insertstock = "";
    $updatestock = "";
    //$image = $_FILES['uploadBill']['tname'];
    $InwardDate          = $_POST['dop']." 00:00:00";
    $VendorId            = $_POST['vname'];
    $TotalGST            = $_POST['totalgst'];
    $Transport_extracost = $_POST['totalcost'];
    $TotalAmount         = $_POST['totalbill'];

    
    $AmountPaid          = $_POST['totalpaid'];
    $AmountPending       = $_POST['totalpending'];
    $PaymentMode         = $_POST['cash'];
    //$TotalDiscount = $_POST[''];
    $Notes               = $_POST['n'];
    $StockType           = $_POST['bill'];
    if(isset($_POST['extraCost']))
    {
        $extrac = $_POST['extraCost'];
        $Transport_extracost = $Transport_extracost + $extrac;
        $TotalAmount = $TotalAmount;
        
    }
    else
    {
        $extrac = 0;
    }
    if(isset($_POST['extraCostDes']))
    {
        $edesc = $_POST['extraCostDes'];
    }
    else
    {
        $edesc = " ";
    }
    $sqlinsert           = "INSERT INTO TblInwardBillMst (InwardDate, VendorId, TotalGST, Transport_extracost, TotalAmount, AmountPaid, AmountPending, UploadBill, PaymentMode, TotalDiscount, Notes, StockMstSysId, ModifiedDate,  StockType, ExtraCost, Description) VALUES ('$InwardDate', '$VendorId', '$TotalGST', '$Transport_extracost', '$TotalAmount', '$AmountPaid', '$AmountPending', 0, '$PaymentMode', '0', '$Notes', '0', '0', '$StockType', $extrac, '$edesc')";
    

    
    
    
    $sql         = "INSERT INTO TblInwardDetails (ProductId, InwardId, Qty, Price, CGST, SGST, TotalCost, Discount, StockMstSysId, ModifiedDate) VALUES ";
    $sql1        = "";
    $cnt         = 0;
    $insertCount = 0;
    for ($x = 1; $x <= $count; $x++) {
        if (isset($_POST['type_' . $x])) {

            $insertCount = $insertCount + 1;
            $type        = $_POST['type_' . $x];
            $com         = $_POST['com_' . $x];
            $unit        = $_POST['unit_' . $x];
            $size        = $_POST['size_' . $x];
            $die        = $_POST['die_' . $x];
            $color       = $_POST['color_' . $x];
            $grade       = $_POST['grade_' . $x];
            $code        = $_POST['code_' . $x];
            $gettype = "SELECT * FROM subcategories where subcategory_name = '$type'";
            $getbrand = "SELECT * FROM brandnames where BrandName = '$com'";
            $getgrade = "SELECT * FROM grades where GradeText = '$grade'";
            //echo $gettype;
            $getsubtype = mysqli_query($conn, $gettype) or die("wrong query3");
            $getbradid = mysqli_query($conn, $getbrand) or die("wrong query3");
            $getgradeid = mysqli_query($conn, $getgrade) or die("wrong query3");

            while ($rowoftype = mysqli_fetch_assoc($getsubtype)) {
                $typeid = $rowoftype['subcategory_id'];
                
            }
            while ($rowofbrand = mysqli_fetch_assoc($getbradid)) {
                $brandid = $rowofbrand['BrandId'];
                
            }
            while ($rowofgrade = mysqli_fetch_assoc($getgradeid)) {
                $gradeid = $rowofgrade['GradeId'];
                
            }
            $sql1 .= "SELECT * FROM productmst where ProductSubCategoryID='$typeid' and ProductTypeColor='$color' and BrandId='$brandid' and PackingUnit='$unit' and GradeId='$gradeid' and Code='$code' and QtyPerUnit = '$size' and SizeOrDimension = '$die'";
            
            //echo $sql1;
            $res = mysqli_query($conn, $sql1) or die("wrong query3");
            //$cnt = 1;
            while ($row = mysqli_fetch_assoc($res)) {
                $productid[$x] = $row['ProductID'];
                //echo $productid[$x];
                $cnt             = $cnt + 1;
            }
            //echo "asdf2";
            
        }
        $sql1 = "";
    }
    
    // $sql1 = rtrim($sql1, ", ");
    // $sql1 .= ";";
    //echo $sql1;
    // if($insertCount!=0) {
    //  
    
    // }
    // echo "asdf1";
    //echo $cnt;
    //echo $count;
    //echo $cnt;
    //echo $count;
    if ($cnt == $pcnt) {
        //echo "asdf";
        //echo $sqlinsert;
        mysqli_query($conn, $sqlinsert) or die("wrong query1");
    

    
    $sqlgetid = "select * from TblInwardBillMst order by InwardId desc limit 1;";
    $res1 = mysqli_query($conn, $sqlgetid) or die("wrong query2");
    while ($row = mysqli_fetch_assoc($res1)) {
        $inwardid = $row['InwardId'];
    }
        if($AmountPending == 0)
        {
            $Status = 'Complete';
        }
        else
        {
            $Status = 'Pending';
        }
        $sqlpayment = "INSERT INTO tblinwardpayment (InwardId, PaymentDate, AmountPaid, AmountPending, Status, PaymentMode, RoundOffDade, StockMstSysId, RecStatus) VALUES ($inwardid, '$InwardDate', $AmountPaid, $AmountPending, '$Status' , 'Vendor', 0, 1, 1)";
        $sqlpayment2 = "INSERT INTO tblinwardpayment (InwardId, PaymentDate, AmountPaid, AmountPending, Status, PaymentMode, RoundOffDade, StockMstSysId, RecStatus) VALUES ($inwardid, '$InwardDate', $AmountPaid, $AmountPending, '$Status' , 'Vendor', 0, 0, 1)";

       // echo $sqlpayment;

            
        mysqli_query($conn, $sqlpayment) or die("wrong query for payment");
        mysqli_query($conn, $sqlpayment2) or die("wrong query for payment");

        $insertCount = 1;
        for ($x = 1; $x <= $count; $x++) {
            if (isset($_POST['type_' . $x])) {
                $insertCount = $insertCount + 1;
                $pid         = $productid[$x];
                $sysid = [];
                $qty   = $_POST['qty_' . $x];
                $price = $_POST['bprice_' . $x];
                $cgst  = $_POST['cgst_' . $x];
                $sgst  = $_POST['sgst_' . $x];
                $tcost = $_POST['tp_' . $x];
                $batch = $_POST['batch_'. $x];
                $disc  = $_POST['disc_' . $x];
                $finalbprice = $tcost / $qty;
                //echo $sql;
                $checksys = "select * from systable where ProductId='$pid' and BasePrice='$finalbprice' and BatchNo='$batch'";
                $check1 = "select COUNT(*) as total, SysId from systable where ProductId='$pid' and BasePrice='$finalbprice' and BatchNo='$batch'";
                $res1 = mysqli_query($conn, $checksys) or die("wrong query4 1");
                $res2 = mysqli_query($conn, $check1) or die("wrong query4 2");
                $row1 = mysqli_fetch_assoc($res2);
                $rowcount = $row1['total'];
                if($rowcount == 0)
                {   

                    $insertsys .= "INSERT INTO systable (ProductId, BasePrice, BatchNo) VALUES ($pid, $finalbprice, '$batch');"; 
                    //echo $insertsys;
                    mysqli_query($conn, $insertsys) or die("wrong query for insert");
                    $sqlgetid = "select * from systable order by SysId desc limit 1;";
                    $res5 = mysqli_query($conn, $sqlgetid) or die("wrong query for select");
                    $row5 = mysqli_fetch_assoc($res5);
                    $sysid[$x] = $row5['SysId'];

                    $checkstock = "SELECT count(*) as total1 from stockmst where SysId = '$sysid[$x]'";
                    $res3 = mysqli_query($conn, $checkstock) or die("wrong query for check stock");
                    $row4 = mysqli_fetch_assoc($res3);
                    $rowcount1 = $row4['total1'];
                    if($rowcount1 == 0)
                    {
                        if($StockType=="bill")
                        { 
                            $insertstock .= "INSERT INTO stockmst (SysId, BillingQty) VALUES ($sysid[$x], $qty);";
                            $insertstockdetails = "INSERT INTO stockdetails (SysId, BillingQty, VirtualQty, InwardId) VALUES ($sysid[$x], $qty, $qty, $inwardid);";
                        }
                        else
                        {
                            $insertstock .= "INSERT INTO stockmst (SysId, OtherQty) VALUES ($sysid[$x], $qty);";
                            $insertstockdetails = "INSERT INTO stockdetails (SysId, OtherQty, InwardId) VALUES ($sysid[$x], $qty, $inwardid);";

                        }
                        //echo $insertstock;
                        mysqli_query($conn, $insertstock) or die("wrong query for insert in stock1");
                        mysqli_query($conn, $insertstockdetails) or die("wrong query for insert in stock2");

                    }
                    else
                    {
                        if($StockType=="bill")
                        { 
                            $updatestock .= "UPDATE stockmst set BillingQty = BillingQty + $qty WHERE SysId = '$sysid[$x]'";
                            $insertstockdetails = "INSERT INTO stockdetails (SysId, BillingQty, VirtualQty, InwardId) VALUES ($sysid[$x], $qty, $qty, $inwardid);";
                        }
                        else
                        {

                            $updatestock .= "UPDATE stockmst set OtherQty = OtherQty + $qty WHERE SysId = '$sysid[$x]'";
                            $insertstockdetails = "INSERT INTO stockdetails (SysId, OtherQty, InwardId) VALUES ($sysid[$x], $qty, $inwardid);";
                        }
                        mysqli_query($conn, $updatestock) or die("wrong query for update in stock3");
                        mysqli_query($conn, $insertstockdetails) or die("wrong query for insert in stock4");

                    }
                    
                }
                
                else
                {
                    $sysid[$x] = $row1['SysId'];
                    $checkstock = "SELECT count(*) as total1 from stockmst where SysId = '$sysid[$x]'";
                    $res3 = mysqli_query($conn, $checkstock) or die("wrong query for check stock");
                    $row4 = mysqli_fetch_assoc($res3);
                    $rowcount1 = $row4['total1'];
                    if($rowcount1 == 0)
                    {
                        if($StockType=="bill")
                        { 
                            $insertstock .= "INSERT INTO stockmst (SysId, BillingQty) VALUES ($sysid[$x], $qty);";
                            $insertstockdetails = "INSERT INTO stockdetails (SysId, BillingQty, VirtualQty, InwardId) VALUES ($sysid[$x], $qty, $qty, $inwardid);";
                        }
                        else
                        {
                            $insertstock .= "INSERT INTO stockmst (SysId, OtherQty) VALUES ($sysid[$x], $qty);";
                            $insertstockdetails = "INSERT INTO stockdetails (SysId, OtherQty, InwardId) VALUES ($sysid[$x], $qty, $inwardid);";

                        }
                        mysqli_query($conn, $insertstock) or die("wrong query for insert in stock");
                        mysqli_query($conn, $insertstockdetails) or die("wrong query for insert in stock");

                    }
                    else
                    {
                        if($StockType=="bill")
                        { 
                            $updatestock .= "UPDATE stockmst set BillingQty = BillingQty + $qty WHERE SysId = '$sysid[$x]'";
                            $insertstockdetails = "INSERT INTO stockdetails (SysId, BillingQty, VirtualQty, InwardId) VALUES ($sysid[$x], $qty, $qty, $inwardid);";
                        }
                        else
                        {

                            $updatestock .= "UPDATE stockmst set OtherQty = OtherQty + $qty WHERE SysId = '$sysid[$x]'";
                            $insertstockdetails = "INSERT INTO stockdetails (SysId, OtherQty, InwardId) VALUES ($sysid[$x], $qty, $inwardid);";
                        }
                        mysqli_query($conn, $updatestock) or die("wrong query for update in stock");
                        mysqli_query($conn, $insertstockdetails) or die("wrong query for insert in stock");

                    }
                    
                    //echo $sysid[$x];
                }
                $sql .= "($sysid[$x], $inwardid, '$qty', '$price', '$cgst', '$sgst', '$tcost', '$disc', 0, 0), ";
                $insertsys = "";
                $insertstock = "";
                $updatestock = "";
                
                
            }
        }
        $sql = rtrim($sql, ", ");
        $sql .= ";";
        if ($insertCount != 0) {
            //echo $sql;
            mysqli_query($conn, $sql) or die("wrong query5");
            
        }
        if(isset($_FILES['uploadBill']))
        {
        UploadImage($_FILES['uploadBill'],$_FILES["uploadBill"]["tmp_name"],$inwardid);
        $file = $_FILES['uploadBill'];
        $imgname = $inwardid."_".basename($file["name"]);
        $updateimg = "update tblinwardbillmst set UploadBill='$imgname' where InwardId='$inwardid'";
        }
        //echo $updateimg;
            mysqli_query($conn, $updateimg) or die("wrong query4");
        echo "done";
        //header("Location:NewInward.php?alert=1");

    } else {
        echo "notdone";
        //echo "asdf2";
       // header("Location:NewInward.php?alert=0");
        
    }
 } 


?> 