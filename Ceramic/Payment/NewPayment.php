<!DOCTYPE html>
<html>
<?php 
    $month = date('m');
    $day = date('d');
    $year = date('Y');
    
    $today = $year.'-'.$month.'-'.$day;
?>
   <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
   <meta content="utf-8" http-equiv="encoding">
   <?php
      include("dbconfig.php");
      ?>
   <head>
      <title>Payment</title>
      <style type="text/css">
         .grid1{
            display: grid;
            width: '100%';
            grid-template-columns: '50px 1fr';
         }
      </style>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
      <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>

      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    
      <script>
         
         function SomeDeleteRowFunction(o) {
         
         var p=o.parentNode.parentNode;
         p.parentNode.removeChild(p);
         }
           
         function cancelField(){
            document.getElementById("ExtraCost").innerHTML = "";
            document.getElementById("addOtherCharge").disabled=false;
        }      

        function checkRadio(radio)
        {
            if (radio.id === "customerName")
            {
               document.getElementById("hsnc").innerHTML = "<div class='row col-md-6' style='margin-bottom: 20px;'><input type='text' name='cname' class='form-control col-md-4' id='name' placeholder='Enter Customer Name'><div class='col-md-6'><label for=''>From Date:</label><input type='date' class='form-control get-date' id='date1' name='date1'></div><div class='col-md-6'><label for=''>To Date:</label><input type='date' class='form-control get-date' id='date2' value='<?php echo $today; ?>' name='date2'></div></div>";
               //"<input type='text' name='cname' class='form-control col-md-4' id='name' placeholder='Enter Customer Name'><input type='date' class='form-control get-date' id='date1' name='date1'>";
            }
            else if (radio.id === "vendorName")
            {
               document.getElementById("hsnc").innerHTML = "<div class='row col-md-6' style='margin-bottom: 20px;'><input type='text' name='vname' class='form-control col-md-4' id='name' placeholder='Enter Vendor Name'><div class='col-md-6'><label for=''>From Date:</label><input type='date' class='form-control get-date' id='date3' name='date3'></div><div class='col-md-6'><label for=''>To Date:</label><input type='date' class='form-control get-date' id='date4' value='<?php echo $today; ?>' name='date4'></div></div>";
            }
            else if (radio.id === "ChallanNo")
            {
               document.getElementById("hsnc").innerHTML = "<div class='row col-md-6' style='margin-bottom: 20px;'><input type='number' name='ChallanNo' class='form-control col-md-4' id='name' placeholder='Enter Challan Number'></div>";
            }
            else if (radio.id === "InwardId")
            {
               document.getElementById("hsnc").innerHTML = "<div class='row col-md-6' style='margin-bottom: 20px;'><input type='number' name='InwardId' class='form-control col-md-4' id='name' placeholder='Enter Inward ID'></div>";
            }
        }

         function alert1()
         {
            <?php
            if(isset($_GET['alert'])){ ?>
               swal({
                    text: "Operation Performed Successful",
                    icon: "success",
                    button: "OK",
                  });
            <?php } ?>
         }

      </script>

   </head>
   <body onload="alert1();">
      <div class="container-fluid col-lg-12">
         <div class="row">
            <div class="col-md-12">
               <div class="card card-primary">
                  <div class="card-header" style="background-color: #2B60DE">
                     <h3 class="card-title" style="color: white" align="center">Payment</h3>
                  </div>
                  <div class="card-body">
                     <form class="row g-3" action="NewPayment.php" method="POST">
                       <!-- <div class="form-group col-md-2"> 
                           <label class="form-label">Date of Payment: </label>       
                           <input type="date" name="date" id="date" class="form-control">
                        </div>-->

                    
                        <div class="form-group col-md-12">
                           <label class="form-label">New Payment :</label>
                           <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="mc" id="customerName" value="customerName" onchange="checkRadio(this)">
                              <label class="form-check-label" for="inlineRadio1" name="cuspay">Customer Payment </label>
                           </div>
                           <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="mc" id="vendorName" value="vendorName" onchange="checkRadio(this)">
                              <label class="form-check-label" for="inlineRadio2" name="venpay">Vendor Payment</label>
                           </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="mc" id="ChallanNo" value="ChallanNo" onchange="checkRadio(this)">
                              <label class="form-check-label" for="inlineRadio3" name="challan">Challan Number</label>
                           </div>
                           <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="mc" id="InwardId" value="InwardId" onchange="checkRadio(this)">
                              <label class="form-check-label" for="inlineRadio4" name="inward">Inward ID</label>
                           </div>
                           
                           <div id="button"></div>
                        </div>
                      <div class="" id="hsnc" style="margin-top: 18px; ">
                        </div>
                        <div class="col-md-4">
                          <input type="Submit" value="Search" name="Save" id="Save" class="btn btn-success">
                          <input type="button" value="Close"  name="close" id="close" class="btn btn-success" onclick="location.href = '../admin.php';">
                          <input type="hidden" id="count" name="count">
                        </div>
                          
                  </div>
               </div>
            </div>
         </div>
         <br>
         <div class="row">
            <div class="col-md-12">
               <div class="card card-primary" style="overflow-x:auto;">
                  <table class="table" id="data_table">
                     <thead>
                        <tr>
                           <th>Date of Payment</th>
                           <th>Challan No./Inward No.</th>
                           <th>Name of Customer/Vendor</th>
                           <th>Total Payment</th>
                           <th>Total Pending Payment</th>
                           <th>Payment Recieved/Paid</th>
                           <th>RoundOff/Dade</th>
                           <th width="20%">PaymentNotes</th>
                           <th></th>
                          <!--  <th>PaymentId</th>
                           <th>Cno</th>
                           <th>Ino</th> -->
                        </tr>
                     </thead>
                     <tbody>
                       <?php
                            // Using database connection file here
                           //mysqli_close($db); // Close connection
                                 error_reporting(E_PARSE|E_ERROR);

                                $con=mysqli_connect('localhost','root','','imsfinal');
                                
                                

                                $InwardId=$_POST["InwardId"];
                                $ChallanId=$_POST["ChallanId"];
                                $cname=$_POST['cname'];
                                $vname=$_POST['vname'];
                                $PaymentID=$_POST['PaymentID'];
                                $ChallanNo=$_POST['ChallanNo'];
                               // $InwardId=$_POST['InwardId'];
                                $date1=$_POST['date1'];
                                $date2=$_POST['date2'];
                                $date3=$_POST['date3'];
                                $date4=$_POST['date4'];
                                $PaymentDate=$_POST['PaymentDate'];
                                $totalPayment=$_POST['totalPayment'];
                                $penPayment=$_POST['penPayment'];
                                $Status=$_POST['status'];
                                $AmountPaid=$_POST['AmountPaid'];
                                $dade=$_POST['dade'];
                                 $PaymentNotes=$_POST['PaymentNotes'];
                                
                                   /* if ($_POST['cname']==''and $_POST['vname']=='' and $_POST['cno']=='' and $_POST['ino']=='') 
                                    {
                                       $query= "SELECT * FROM ((tblinwardpayment
                                       INNER JOIN challanmst ON tblinwardpayment.ChallanId = challanmst.ChallanId)
                                       INNER JOIN tblcustomermst ON challanmst.CustomerId = tblcustomermst.CustomerId) where tblinwardpayment.RecStatus=1 
                                       ";
                                       $run = mysqli_query($con,$query);
                                    }*/
/* if ($_POST['cname']==''and $_POST['vname']=='' and $_POST['ChallanNo']=='' and $_POST['InwardId']=='') 
                                    {
                                     $query="SELECT ChallanNo,CustomerName,TotalAmount,tblinwardpayment.AmountPending,PaymentID,tblinwardpayment.ChallanId,tblinwardpayment.InwardId FROM ((tblinwardpayment
INNER JOIN challanmst ON tblinwardpayment.ChallanId = challanmst.ChallanId)
INNER JOIN tblcustomermst ON challanmst.CustomerId = tblcustomermst.CustomerId) where tblinwardpayment.StockMstSysId!=0 and tblinwardpayment.RecStatus=1 UNION SELECT InwardId,VendorName,TotalAmount,tblinwardpayment.AmountPending,PaymentID,tblinwardpayment.ChallanId,tblinwardpayment.InwardId FROM ((tblinwardpayment 
INNER JOIN tblinwardbillmst ON tblinwardpayment.InwardId = tblinwardbillmst.InwardId)
INNER JOIN tblvendormst ON tblinwardbillmst.VendorId = tblvendormst.VendorId) where tblinwardpayment.StockMstSysId!=0 and tblinwardpayment.RecStatus=1";

                                       
                                       $run = mysqli_query($con,$query);
                                    }*/
                                                     
                                      if($_POST['cname'] and $_POST['ChallanNo']=='' and $_POST['InwardId']=='' and $_POST['date1']=='' )
                                    {
                                        /*$query= "SELECT * FROM ((tblinwardpayment
                                                INNER JOIN challanmst ON tblinwardpayment.ChallanId = challanmst.ChallanId)
                                                INNER JOINtblcustomermst ON challanmst.CustomerId = tblcustomermst.CustomerId)
                                                WHERE CustomerName LIKE '%$cname%' and tblinwardpayment.StockMstSysId!=0 and tblinwardpayment.RecStatus=1 ";
                                                $run = mysqli_query($con,$query);*/
                                               // echo $query;
                                                $query= "SELECT ChallanDate,Discount,TransportCost,ExtraCost,ChallanNo,CustomerName,TotalAmount,AmountPaid,PaymentID,tblinwardpayment.ChallanId,tblinwardpayment.InwardId,tblinwardpayment.Status FROM ((tblinwardpayment
INNER JOIN challanmst ON tblinwardpayment.ChallanId = challanmst.ChallanId)
INNER JOIN tblcustomermst ON challanmst.CustomerId = tblcustomermst.CustomerId) WHERE CustomerName LIKE '%$cname%' and tblinwardpayment.AmountPending!=0 and tblinwardpayment.StockMstSysId!=0  and tblinwardpayment.RecStatus=1  ";
// echo $query;
//echo $query;
                                        $run = mysqli_query($con,$query);
                                    }

                                     else if ($_POST['vname'] and $_POST['ChallanNo']=='' and $_POST['InwardId']=='' and $_POST['date3']=='')
                                    {
                                        /*$query= "SELECT * FROM ((tblinwardpayment
                                                INNER JOIN tblinwardbillmst ON tblinwardpayment.InwardId = tblinwardbillmst.InwardId)
                                                INNER JOIN tblvendormst ON tblinwardbillmst.VendorId = tblvendormst.VendorId)
                                                WHERE VendorName LIKE '%$vname%' and tblinwardpayment.StockMstSysId!=0 and tblinwardpayment.RecStatus=1 ";                                        
                                                $run = mysqli_query($con,$query);*/
                                                 $query1= "SELECT InwardDate,TotalDiscount as Discount,temptransport as TransportCost, tempextra as ExtraCost,tblinwardpayment.InwardId,VendorName,TotalAmount,tblinwardpayment.AmountPaid,PaymentID,tblinwardpayment.ChallanId,tblinwardpayment.InwardId,tblinwardpayment.Status FROM ((tblinwardpayment
INNER JOIN tblinwardbillmst ON tblinwardpayment.InwardId = tblinwardbillmst.InwardId)
INNER JOIN tblvendormst ON tblinwardbillmst.VendorId = tblvendormst.VendorId) WHERE VendorName LIKE '%$vname%' and tblinwardpayment.AmountPending!=0 and tblinwardpayment.StockMstSysId!=0 and tblinwardpayment.RecStatus=1";
//echo $query1;
                                        $run = mysqli_query($con,$query1);
                                    }

                                    if($_POST['cname'] and $_POST['ChallanNo']=='' and $_POST['InwardId']=='' and $_POST['date1'] and $_POST['date2'])
                                    {
                                        /*$query= "SELECT * FROM ((tblinwardpayment
                                                INNER JOIN challanmst ON tblinwardpayment.ChallanId = challanmst.ChallanId)
                                                INNER JOINtblcustomermst ON challanmst.CustomerId = tblcustomermst.CustomerId)
                                                WHERE CustomerName LIKE '%$cname%' and tblinwardpayment.StockMstSysId!=0 and tblinwardpayment.RecStatus=1 ";
                                                $run = mysqli_query($con,$query);*/
                                               // echo $query;
                                                $query= "SELECT ChallanDate,Discount,TransportCost,ExtraCost,ChallanNo,CustomerName,TotalAmount,AmountPaid,PaymentID,tblinwardpayment.ChallanId,tblinwardpayment.InwardId,tblinwardpayment.Status FROM ((tblinwardpayment
INNER JOIN challanmst ON tblinwardpayment.ChallanId = challanmst.ChallanId)
INNER JOIN tblcustomermst ON challanmst.CustomerId = tblcustomermst.CustomerId) WHERE CustomerName LIKE '%$cname%'  and ChallanDate BETWEEN '$date1' AND '$date2' and tblinwardpayment.AmountPending!=0 and tblinwardpayment.StockMstSysId!=0  and tblinwardpayment.RecStatus=1  ";
//echo $query;
//echo $query;
                                        $run = mysqli_query($con,$query);
                                    }

                                     else if ($_POST['vname'] and $_POST['ChallanNo']=='' and $_POST['InwardId']=='' and $_POST['date3'] and $_POST['date4'])
                                    {
                                        /*$query= "SELECT * FROM ((tblinwardpayment
                                                INNER JOIN tblinwardbillmst ON tblinwardpayment.InwardId = tblinwardbillmst.InwardId)
                                                INNER JOIN tblvendormst ON tblinwardbillmst.VendorId = tblvendormst.VendorId)
                                                WHERE VendorName LIKE '%$vname%' and tblinwardpayment.StockMstSysId!=0 and tblinwardpayment.RecStatus=1 ";                                        
                                                $run = mysqli_query($con,$query);*/
                                                 $query1= "SELECT InwardDate,TotalDiscount as Discount,temptransport as TransportCost, tempextra as ExtraCost,tblinwardpayment.InwardId,VendorName,TotalAmount,tblinwardpayment.AmountPaid,PaymentID,tblinwardpayment.ChallanId,tblinwardpayment.InwardId,tblinwardpayment.Status FROM ((tblinwardpayment
INNER JOIN tblinwardbillmst ON tblinwardpayment.InwardId = tblinwardbillmst.InwardId)
INNER JOIN tblvendormst ON tblinwardbillmst.VendorId = tblvendormst.VendorId) WHERE VendorName LIKE '%$vname%' and InwardDate BETWEEN '$date3' AND '$date4' and tblinwardpayment.AmountPending!=0 and tblinwardpayment.StockMstSysId!=0 and tblinwardpayment.RecStatus=1";
//echo $query1;
                                        $run = mysqli_query($con,$query1);
                                    }

                                    else if($_POST['cname']=='' and $_POST['ChallanNo'] and $_POST['InwardId']=='' and $_POST['date1']=='' and $_POST['date2']=='' and $_POST['date3']=='' and $_POST['date4']=='')
                                    {
                                        $query= "SELECT ChallanDate,Discount,TransportCost,ExtraCost,ChallanNo,CustomerName,TotalAmount,AmountPaid,PaymentID,tblinwardpayment.ChallanId,tblinwardpayment.InwardId,tblinwardpayment.Status FROM ((tblinwardpayment
                                                INNER JOIN challanmst ON tblinwardpayment.ChallanId = challanmst.ChallanId)
                                                INNER JOIN tblcustomermst ON challanmst.CustomerId = tblcustomermst.CustomerId)
                                                WHERE ChallanNo LIKE '$ChallanNo' and tblinwardpayment.AmountPending!=0 and tblinwardpayment.StockMstSysId!=0 and tblinwardpayment.RecStatus=1 ";
                                                $run = mysqli_query($con,$query);
                                    }

                                     else if ($_POST['vname']=='' and $_POST['ChallanNo']=='' and $_POST['InwardId'] and $_POST['date1']=='' and $_POST['date2']=='' and $_POST['date3']=='' and $_POST['date4']=='')
                                    {
                                        $query= "SELECT InwardDate,TotalDiscount as Discount,temptransport as TransportCost,tempextra as ExtraCost,tblinwardpayment.InwardId,VendorName,TotalAmount,tblinwardpayment.AmountPaid,PaymentID,tblinwardpayment.ChallanId,tblinwardpayment.InwardId,tblinwardpayment.Status FROM tblinwardpayment
                                                INNER JOIN tblinwardbillmst ON tblinwardpayment.InwardId = tblinwardbillmst.InwardId
                                                LEFT JOIN tblvendormst ON tblinwardbillmst.VendorId = tblvendormst.VendorId
                                                WHERE tblinwardpayment.InwardId LIKE '$InwardId' and tblinwardpayment.AmountPending!=0 and tblinwardpayment.StockMstSysId!=0 and tblinwardpayment.RecStatus=1 ";                 
                                               // echo $query;                       
                                                $run = mysqli_query($con,$query);
                                    }

                                     if($run->num_rows==0){
                                      echo "<script>Swal.fire({icon: 'error', title: 'Oops...',text: 'No Data Found For This Value !!!'});</script>";

                                  }
                                  else{
                                    
                                
                                while ($row=mysqli_fetch_array($run))
                                 {
                                 $InwardId=$row["InwardId"];
                                 $PaymentID=$row["PaymentID"];
                                 $ChallanId=$row["ChallanId"];
                                 $PaymentDate=$row["PaymentDate"];
                                 $cname=$row["CustomerName"];
                                 $vname=$row["VendorName"];
                                 $ChallanNo=$row["ChallanNo"];
                                 $Inward=$row["InwardId"];
                                 $totalPayment=$row["TotalAmount"];
                                 $discount=$row["Discount"];
                                 $transport=$row["TransportCost"];
                                 $extraCost=$row["ExtraCost"];
                                 $subtotal=$totalPayment-$discount+$transport+$extraCost;
                                 //$subtotal1=$totalPayment;
                                 $paidPayment=$row["AmountPaid"];
                                 $penPayment = $subtotal- $paidPayment;
                                 $Status=$row["Status"];
                                 //$AmountPaid=$row["AmountPaid"];

                        ?>
                        <form action="NewPayment.php" method="POST">
                  <tr>   
                            <td><input type="date" name="PaymentDate" id="PaymentDate" class="form-control" required></td>
                            <td><?php echo ($ChallanNo==""?$InwardId:$ChallanNo);?></td>
                            <td><?php echo ($cname==""?$vname:$cname);?></td>
                            <td><?php echo $subtotal; ?></td>
                            <td><?php echo $penPayment; ?></td>


                            <td><input type="number" style="width:70%;" name="AmountPaid" class="form-control" required></td> 
                            <td><input type="number" style="width:70%;" name="dade" class="form-control" required></td>
                            <td><input type="text" name="PaymentNotes" class="form-control"></td>
                            <td><input type="hidden" value="<?php echo $PaymentID; ?>" name="PaymentID"></td>
                           <!-- <td><input type="number" value="<?php echo $ChallanNo; ?>" name="ChallanNo"></td>
                            <td><input type="number" value="<?php echo $InwardId; ?>" name="InwardId"></td>-->
                            <td><input type="hidden" value="<?php echo $penPayment; ?>" name="AmountPending"></td> 
                            <td><input type="hidden" value="<?php echo $Inward; ?>" name="Inward"></td>
                            <td><input type="hidden" value="<?php echo $ChallanId; ?>" name="ChallanId"></td>
                            <!-- <td><input type="Button" type="Submit" value="Submit" name="Sub1" id="Sub1" class="btn btn-success"></td>     -->
                           
                              <td><input type="submit" value="Submit" name="Sub1" id="Sub1" class="btn btn-success"></td> 
              
               </tr>
                  </form>   
               </form>
            <?php 
                              } }
            ?>
                     </tbody>
                     </table>
                    <hr>
                   
               <br>
                <div class="grid1">
                  <?php 
                     error_reporting(E_PARSE|E_ERROR);

                                $con=mysqli_connect('localhost','root','','imsfinal');
                                $result=mysqli_query($con,"SELECT SUM(AmountPending) as value_sum FROM tblinwardpayment where StockMstSysId!=0");
                                $row=mysqli_fetch_assoc($result);
                                $sum=$row['value_sum'];
                                ?>
                  <div style="grid-column-start: 4;
                              grid-column-end: 5;">
                     <p>Total Pending Payment: <span id="tbill" name="penPayment"><?php echo $sum;?></span></p>
                     <p>Payment Status: <span id="ttcost" name="status"><?php echo $Status; ?></span></p>
                  </div>
                
                  </div>
                  <div class="col-12">

 
                        <?php
   include 'connection.php';
   //echo "hello";
   if(isset($_POST['Sub1']))
   {
      //echo "<script>console.log('executed')</script>";
      
      $InwardId=$row["InwardId"];
      $PaymentID=$_POST["PaymentID"];
      $ChallanId=$_POST["ChallanId"];
      $cname=$row["CustomerName"];
      $vname=$row["VendorName"];
      $penPayment=$_POST["AmountPending"];
      $Status=$row["Status"];
      $ChallanNo=$row["ChallanNo"];
      $Inward=$_POST['Inward'];
      //$InwardId=$row["InwardId"];
      $PaymentDate=$_POST["PaymentDate"];
      $AmountPaid=$_POST["AmountPaid"];
      $dade=$_POST["dade"];
      $PaymentNotes=$_POST["PaymentNotes"];
      $temp=$penPayment-$AmountPaid;
      //$paid = $_POST['paid'];
      //$totalpen=$penPayment-$paid;
      //echo $paid;
      //echo "hello";
       if ($_POST['PaymentDate']=='' || $_POST['AmountPaid']=='' || $_POST['dade']=='') {
            echo "<script>alert('please fill all field');<script>";
         }   

      //$sql = "UPDATE tblinwardpayment SET AmountPending = AmountPending-'$AmountPaid' where PaymentDate='$date'";
       
      $sql1="INSERT INTO tblinwardpayment (InwardId,PaymentDate, AmountPaid, AmountPending, PaymentMode, RoundOffDade, PaymentNotes, RecStatus, ChallanId) VALUES('$Inward','$PaymentDate','$AmountPaid','$temp','$PaymentMode','$dade','$PaymentNotes',1,'$ChallanId')";
      echo $sql1;
      $sql = "UPDATE tblinwardpayment SET AmountPaid= AmountPaid + '$AmountPaid',AmountPending = AmountPending-'$AmountPaid' -'$dade',RoundOffDade = '$dade',PaymentDate='$PaymentDate', PaymentNotes='$PaymentNotes' where PaymentID='$PaymentID' and RecStatus='1' ";
     if($_POST['ChallanNo'] || $_POST['cname'] || $_POST['AmountPaid'] || $_POST['dade']){
          $sql2= "UPDATE challanmst SET DueAmount = DueAmount-'$AmountPaid' -'$dade', RoundOffDeade = '$dade' where ChallanId='$ChallanId' and RecStatus='1'";
          //echo $sql2;
         mysqli_query($con, $sql2);
     }
     if($_POST['vname'] || $_POST['Inward'] || $_POST['AmountPaid'] || $_POST['dade'])
    {
          $sql3= "UPDATE tblinwardbillmst SET AmountPaid= AmountPaid + '$AmountPaid',AmountPending = AmountPending-'$AmountPaid' -'$dade' where InwardId='$Inward' and RecStatus='A'";
// echo $sql3;
          mysqli_query($con,$sql3);
          //echo $sql3;
    }
   //  $sql2= "UPDATE challanmst SET AmountPaid='$AmountPaid',AmountPending = AmountPending-'$AmountPaid' -'$dade' where ChallanNo='$ChallanNo' and RecStatus='1'";
    //     echo $sql2;
         
     if (mysqli_query($con, $sql)&&mysqli_query($con,$sql1)) 
      {
        //echo $sql;
       // echo $sql1;
      	echo '<script>
setTimeout(function () { 
swal({
  title: "Payment Added Succesfully",
  text: "",
  type: "success",
  confirmButtonText: "OK"
},
function(isConfirm){
  if (isConfirm) {
    window.location.href = "NewPayment.php";
  }
}); }, 1);
            </script>';
       //echo "<script>window.open('NewPayment.php','_self')</script>";
     } 

      else 
      {
       echo "Error: " . $sql . " " . $sql1 . " " . mysqli_error($con);
      }
      
   }
?>   
                     </div>
                     <br>
               </div>
            </div>
         </div>
      </div>
      </section>
   </body>
</html>


