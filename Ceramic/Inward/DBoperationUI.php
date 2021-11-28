 <?php
include("config.php");
include("uploadImg.php");
     $cnt = 0;
     $type        = $_POST['type'];
     $com         = $_POST['com'];
     $unit        = $_POST['unit'];
     $color       = $_POST['toc'];
     $grade       = $_POST['grade'];
     $code        = $_POST['cmd'];
     $batch       = $_POST['bn'];
     $bprice      = $_POST['basep'];
     $qty         = $_POST['qu'];
     $cgst        = $_POST['cgst'];
     $sgst        = $_POST['sgst'];
     $tcost       = $_POST['tc'];
     $tp          = $_POST['tp'];
     $iid         = $_POST['iid'];
     $ino         = $_POST['ino'];
     $disc        = $_POST['disc'];
     $pending     = $_POST['pending'];
     $paid        = $_POST['paid'];
     $StockType        = $_POST['type1'];

     $getgradeq = "SELECT * FROM grades WHERE GradeText = '$grade'";
     $gettypeq = "SELECT * FROM subcategories WHERE subcategory_name = '$type'";
     $getbrandq = "SELECT * FROM brandnames WHERE BrandName = '$com'";


     $getg = mysqli_query($conn, $getgradeq) or die("wrong query3");
     while ($getgrade = mysqli_fetch_assoc($getg)) {   
     $gradeid = $getgrade['GradeId'];
     }


     $gett = mysqli_query($conn, $gettypeq) or die("wrong query3");
     while ($gettype = mysqli_fetch_assoc($gett)) {
     $typeid = $gettype['subcategory_id'];
     }

     $getb = mysqli_query($conn, $getbrandq) or die("wrong query3");
     while($getbrand = mysqli_fetch_assoc($getb))
     {
     $brandid = $getbrand['BrandId'];
     }
     
     $check = "SELECT * FROM productmst where ProductSubCategoryID='$typeid' and ProductTypeColor='$color' and BrandId='$brandid' and PackingUnit='$unit' and GradeId='$gradeid' and Code='$code' ";
     
     $res1 = mysqli_query($conn, $check) or die("wrong query3");
     while ($checkp = mysqli_fetch_assoc($res1)) {   
        $cnt++;
        $pid = $checkp['ProductID'];
     }

     if($cnt != 0)
     {
        $checksys = "select COUNT(*) as total, SysId from systable where ProductId='$pid' and BasePrice='$bprice' and BatchNo='$batch'";
        $res2 = mysqli_query($conn, $checksys) or die("wrong query4 2");
        $row1 = mysqli_fetch_assoc($res2);
        $rowcount = $row1['total'];
        $sysid = $row1['SysId'];
        if($rowcount == 0)
        {
            $insertsys = "INSERT INTO systable (ProductId, BasePrice, BatchNo) VALUES ($pid, $bprice, '$batch');"; 
            mysqli_query($conn, $insertsys) or die("wrong query for insert");
            $sqlgetid = "select * from systable order by SysId desc limit 1;";
            $res5 = mysqli_query($conn, $sqlgetid) or die("wrong query for select");
            $row5 = mysqli_fetch_assoc($res5);
            $sysid = $row5['SysId'];
            if($StockType == "bill")
            {
                $insertstock = "INSERT INTO stockmst (SysId, BillingQty) VALUES ($sysid, $qty);";
                $insertstockdetails = "INSERT INTO stockdetails (SysId, BillingQty, VirtualQty, InwardId) VALUES ($sysid, $qty, $qty, $iid);";
            }
            else
            {
                $insertstock = "INSERT INTO stockmst (SysId, OtherQty) VALUES ($sysid, $qty);";
                $insertstockdetails = "INSERT INTO stockdetails (SysId, OtherQty, InwardId) VALUES ($sysid, $qty, $iid);";
            }
            mysqli_query($conn, $insertstock) or die("wrong query for insert in stock1");
            mysqli_query($conn, $insertstockdetails) or die("wrong query for insert in stock2");
            
        }
        else
        {
            if($StockType=="bill")
            { 
                $updatestock = "UPDATE stockmst set BillingQty = BillingQty + $qty WHERE SysId = '$sysid'";
                $insertstockdetails = "INSERT INTO stockdetails (SysId, BillingQty, VirtualQty, InwardId) VALUES ($sysid, $qty, $qty, $iid);";
            }
            else
            {

                $updatestock = "UPDATE stockmst set OtherQty = OtherQty + $qty WHERE SysId = '$sysid'";
                $insertstockdetails = "INSERT INTO stockdetails (SysId, OtherQty, InwardId) VALUES ($sysid, $qty, $iid);";
            }
            mysqli_query($conn, $updatestock) or die("wrong query for update in stock");
            mysqli_query($conn, $insertstockdetails) or die("wrong query for insert in stock");
        }

        $sql         = "INSERT INTO TblInwardDetails (ProductId, InwardId, Qty, Price, CGST, SGST, TotalCost, Discount) VALUES ($sysid, $iid, $qty, $bprice, $cgst, $sgst, $tp, $disc)";
        mysqli_query($conn, $sql) or die("wrong query for inward item");
        $sql2        = "UPDATE tblinwardbillmst set TotalAmount = TotalAmount + $tp, TotalGST = TotalGST + $cgst + $sgst, AmountPaid=AmountPaid+$paid, AmountPending=AmountPending+$pending WHERE InwardId = $iid";
        mysqli_query($conn, $sql2) or die("Wrong for update");
        echo "done";
     }
     else
     {
        echo "NotDone";
     }
?> 