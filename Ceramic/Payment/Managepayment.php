<!DOCTYPE html>
<html>
<?php 
    $month = date('m');
    $day = date('d');
    $year = date('Y');
    
    $today = $year.'-'.$month.'-'.$day;
?>
<head>
   <title>Manage Payment</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

   <style type="text/css">
      #btn {
         margin-right: 10px;
      }

      html,
      body {
         max-width: 100%;
         overflow-x: hidden;
      }

      .quantity {
         width: 50px;
      }
   </style>
   <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
   <script>
      function checkRadio(radio) {
         if (radio.id === "customerName") {
            document.getElementById("hsnc").innerHTML = "<input type='text' name='cname' style='margin-bottom: 20px;' class='form-control' id='name' placeholder='Enter Customer Name'>";
         }
         else if (radio.id === "vendorName") {
            document.getElementById("hsnc").innerHTML = "<input type='text' name='vname' style='margin-bottom: 20px;' class='form-control' id='name' placeholder='Enter Vendor Name'>";
         }
         else if (radio.id === "date") {
            document.getElementById("hsnc").innerHTML = "<div class='row col-md-12' style='margin-bottom: 20px;'><div class='col-md-6'><label for=''>From Date:</label><input type='date' class='form-control get-date' id='date1' name='date1'></div><div class='col-md-6'><label for=''>To Date:</label><input type='date' class='form-control get-date' id='date2' value='<?php echo $today; ?>' name='date2'></div></div>";
         }
         else if (radio.id === "challanno") {
            document.getElementById("hsnc").innerHTML = "<input type='number' name='challanno' style='margin-bottom: 20px;' class='form-control col-md-4' id='name' placeholder='Enter Challan Number'>";
         }
         else if (radio.id === "InwardId") {
            document.getElementById("hsnc").innerHTML = "<input type='number' name='InwardId' style='margin-bottom: 20px;' class='form-control col-md-4' id='name' placeholder='Enter Inward ID'>";
         }
      }
   </script>
</head>

<body>
   <div class="container-fluid col-lg-12">
      <div class="row">
         <div class="col-md-12">
            <div class="card card-primary">
               <div class="card-header" style="background-color: #2B60DE">
                  <h3 class="card-title" style="color: white" align="center">Search and Manage Payment</h3>
               </div>
               <form class="row g-3" id="radio-buttons" method="POST" action="Managepayment.php">
                  <div class="card-body">
                     <div class="form-group col-md-8" >
                        <label class="form-label">Search By: </label>
                        <div class="form-check form-check-inline">
                           <input class="form-check-input" type="radio" name="mc" id="date" value="date"
                              onchange="checkRadio(this)">
                           <label class="form-check-label" for="inlineRadio1">Date</label>
                        </div>

                        <div class="form-check form-check-inline">
                           <input class="form-check-input" type="radio" name="mc" id="customerName" value="customerName"
                              onchange="checkRadio(this)">
                           <label class="form-check-label" for="inlineRadio2" name="cuspay">Customer Name </label>
                        </div>
                        <div class="form-check form-check-inline">
                           <input class="form-check-input" type="radio" name="mc" id="vendorName" value="vendorName"
                              onchange="checkRadio(this)">
                           <label class="form-check-label" for="inlineRadio3" name="venpay">Vendor Name</label>
                        </div>
                        <div class="form-check form-check-inline">
                           <input class="form-check-input" type="radio" name="mc" id="challanno" value="challanno"
                              onchange="checkRadio(this)">
                           <label class="form-check-label" for="inlineRadio4" name="challan">Challan Number</label>
                        </div>
                        <div class="form-check form-check-inline">
                           <input class="form-check-input" type="radio" name="mc" id="InwardId" value="InwardId"
                              onchange="checkRadio(this)">
                           <label class="form-check-label" for="inlineRadio5" name="inward">Inward ID</label>
                        </div>

                        <div id="button">

                        </div>
                     </div>
                     
                     <div class="form-group col-md-3" id="hsnc">
                     </div>
                     
                     
                        <input type="Submit" value="Search" name="Search" id="save" class="btn btn-success">
                        <input type="hidden" id="count" name="count">
                        <input type="button" value="Close" name="close" id="close" class="btn btn-success"
                           onclick="location.href = '../admin.php';">
                     
                  </div>
               </form>
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
                     <th>Sr no</th>
                     <th>Date</th>
                     <th>Challan No./Inward No.</th>
                     <th>Customer/Vendor Name</th>
                     <th>Total Payment</th>
                     <th>Amount Paid</th>
                     <th>Notes</th>
                     <th></th>
                     <th></th>
                  </tr>
               </thead>
               <tbody>
                  
                  <?php

                     error_reporting(E_ERROR | E_PARSE);
                     $con=mysqli_connect('localhost','root','','imsfinal');

                     $cname=$_POST['cname'];
                     $vname=$_POST['vname'];
                     $challanno=$_POST['challanno'];
                     $InwardId=$_POST['InwardId'];
                     $date1=$_POST['date1'];
                     $date2=$_POST['date2'];
                     $penPayment=$_POST["AmountPending"];
                     $AmountPaid=$_POST["AmountPaid"];
                     $totalPayment=$_POST["TotalAmount"];
                     $PaymentID=$_POST['PaymentID'];
                     $RoundOffDade=$_POST['RoundOffDade'];
                     $PaymentNotes=$_POST['PaymentNotes'];
                     $counter = 0;
                                
                     if ($_POST['cname']=='' and $_POST['vname']=='' and $_POST['date1']=='' and $_POST['challanno']=='' and $_POST['InwardId']=='') 
                     {
                        $query= "SELECT Discount,TransportCost,ExtraCost,PaymentDate,ChallanNo,CustomerName,TotalAmount,tblinwardpayment.AmountPaid,tblinwardpayment.AmountPending,PaymentID,PaymentNotes FROM ((tblinwardpayment
                                 INNER JOIN challanmst ON tblinwardpayment.ChallanId = challanmst.ChallanId)
                                 INNER JOIN tblcustomermst ON challanmst.CustomerId = tblcustomermst.CustomerId) WHERE tblinwardpayment.RecStatus=1 and tblinwardpayment.StockMstSysId=0 UNION SELECT TotalDiscount,Transport_extracost,Transport_extracost,PaymentDate,tblinwardpayment.InwardId,VendorName,TotalAmount,tblinwardpayment.AmountPaid,tblinwardpayment.AmountPending,PaymentID,PaymentNotes FROM ((tblinwardpayment 
                                 INNER JOIN tblinwardbillmst ON tblinwardpayment.InwardId = tblinwardbillmst.InwardId)
                                 INNER JOIN tblvendormst ON tblinwardbillmst.VendorId = tblvendormst.VendorId) WHERE tblinwardpayment.RecStatus=1 and tblinwardpayment.StockMstSysId=0 ORDER BY PaymentDate DESC";
                        //echo $query;
                        $run = mysqli_query($con,$query);
                     }
                                                     
                     else if($_POST['cname']=='' and $_POST['vname'] and $_POST['date1']=='' and $_POST['date2']=='' and $_POST['challanno']=='' and $_POST['InwardId']=='')
                     {
                        $query= "SELECT TotalDiscount as Discount,temptransport as TransportCost,tempextra as ExtraCost,PaymentDate,tblinwardpayment.InwardId,VendorName,TotalAmount,tblinwardpayment.AmountPaid,tblinwardpayment.AmountPending,PaymentID,PaymentNotes FROM ((tblinwardpayment
                                 INNER JOIN tblinwardbillmst ON tblinwardpayment.InwardId = tblinwardbillmst.InwardId)
                                 INNER JOIN tblvendormst ON tblinwardbillmst.VendorId = tblvendormst.VendorId) WHERE VendorName LIKE '%$vname%' and tblinwardpayment.RecStatus=1 and tblinwardpayment.StockMstSysId=0 ORDER BY PaymentDate DESC";
                        $run = mysqli_query($con,$query);
                     }

                     else if($_POST['vname']=='' and $_POST['cname'] and $_POST['date1']=='' and $_POST['date2']=='' and $_POST['challanno']=='' and $_POST['InwardId']=='')
                     {
                        $query= "SELECT Discount,TransportCost,ExtraCost,PaymentDate,ChallanNo,CustomerName,TotalAmount,tblinwardpayment.AmountPaid,tblinwardpayment.AmountPending,PaymentID,PaymentNotes FROM ((tblinwardpayment
                                 INNER JOIN challanmst ON tblinwardpayment.ChallanId = challanmst.ChallanId)
                                 INNER JOIN tblcustomermst ON challanmst.CustomerId = tblcustomermst.CustomerId) WHERE CustomerName LIKE '%$cname%'  and tblinwardpayment.RecStatus=1 and tblinwardpayment.StockMstSysId=0  ORDER BY PaymentDate DESC";
                        $run = mysqli_query($con,$query);
                     }

                     else if ($_POST['cname']=='' and $_POST['vname']=='' and $_POST['date1'] and $_POST['date2']=='' and $_POST['challanno']=='' and $_POST['InwardId']=='') 
                     {
                        $query= "SELECT Discount,TransportCost,ExtraCost,PaymentDate,ChallanNo,CustomerName,TotalAmount,tblinwardpayment.AmountPaid,tblinwardpayment.AmountPending,PaymentID,PaymentNotes FROM ((tblinwardpayment
                                 INNER JOIN challanmst ON tblinwardpayment.ChallanId = challanmst.ChallanId)
                                 INNER JOIN tblcustomermst ON challanmst.CustomerId = tblcustomermst.CustomerId) WHERE PaymentDate LIKE '$date1'  and tblinwardpayment.RecStatus=1 and tblinwardpayment.StockMstSysId=0 ORDER BY PaymentDate DESC UNION SELECT TotalDiscount as Discount,temptransport as TransportCost,tempextra as ExtraCost, PaymentDate,tblinwardpayment.InwardId,VendorName,TotalAmount,tblinwardpayment.AmountPending,tblinwardpayment.AmountPaid,PaymentID, PaymentNotes FROM ((tblinwardpayment 
                                 INNER JOIN tblinwardbillmst ON tblinwardpayment.InwardId = tblinwardbillmst.InwardId)
                                 INNER JOIN tblvendormst ON tblinwardbillmst.VendorId = tblvendormst.VendorId) WHERE PaymentDate LIKE '$date1'  and tblinwardpayment.RecStatus=1 and tblinwardpayment.StockMstSysId=0 ORDER BY PaymentDate DESC";
                        $run=mysqli_query($con,$query);                       
                     }
                                
                     else if ($_POST['cname']=='' and $_POST['vname']=='' and $_POST['date1'] and $_POST['date2'] and $_POST['challanno']=='' and $_POST['InwardId']=='') 
                     {
                        $query= "SELECT Discount,TransportCost,ExtraCost, PaymentDate,ChallanNo,CustomerName,TotalAmount,tblinwardpayment.AmountPaid,tblinwardpayment.AmountPending,PaymentID,PaymentNotes FROM ((tblinwardpayment
                                 INNER JOIN challanmst ON tblinwardpayment.ChallanId = challanmst.ChallanId)
                                 INNER JOIN tblcustomermst ON challanmst.CustomerId = tblcustomermst.CustomerId) WHERE PaymentDate BETWEEN '$date1' AND '$date2' and tblinwardpayment.RecStatus=1 and tblinwardpayment.StockMstSysId=0 UNION SELECT TotalDiscount as Discount,temptransport as TransportCost,tempextra as ExtraCost,PaymentDate,tblinwardpayment.InwardId,VendorName,TotalAmount,tblinwardpayment.AmountPaid,tblinwardpayment.AmountPending,PaymentID, PaymentNotes FROM ((tblinwardpayment 
                                 INNER JOIN tblinwardbillmst ON tblinwardpayment.InwardId = tblinwardbillmst.InwardId)
                                 INNER JOIN tblvendormst ON tblinwardbillmst.VendorId = tblvendormst.VendorId) WHERE PaymentDate BETWEEN '$date1' AND '$date2' and tblinwardpayment.RecStatus=1 and tblinwardpayment.StockMstSysId=0 ORDER BY PaymentDate DESC";
                                      //  echo $query;
                        $run=mysqli_query($con,$query);                       
                     }
                                //echo $_POST['challanno'];    
                     else if($_POST['challanno'] and $_POST['cname']=='' and $_POST['vname']=='' and $_POST['date1']=='' and  $_POST['InwardId']=='')
                     {
                        $query= "SELECT Discount,TransportCost,ExtraCost,PaymentDate,ChallanNo,CustomerName,TotalAmount,tblinwardpayment.AmountPaid,tblinwardpayment.AmountPending,PaymentID,PaymentNotes FROM ((tblinwardpayment
                                 INNER JOIN challanmst ON tblinwardpayment.ChallanId = challanmst.ChallanId)
                                 INNER JOIN tblcustomermst ON challanmst.CustomerId = tblcustomermst.CustomerId)
                                 WHERE ChallanNo LIKE '$challanno' and tblinwardpayment.StockMstSysId=0 and tblinwardpayment.RecStatus=1  ORDER BY PaymentDate DESC";
                                                //echo $query;
                        $run = mysqli_query($con,$query);
                     }

                     else if ($_POST['cname']=='' and $_POST['vname']=='' and $_POST['date1']=='' and $_POST['ChallanNo']=='' and $_POST['InwardId'])
                     {
                        $query= "SELECT TotalDiscount as Discount,temptransport as TransportCost,tempextra as ExtraCost,PaymentDate,tblinwardpayment.InwardId,VendorName,TotalAmount,tblinwardpayment.AmountPaid,tblinwardpayment.AmountPending,PaymentID,PaymentNotes FROM ((tblinwardpayment
                                 INNER JOIN tblinwardbillmst ON tblinwardpayment.InwardId = tblinwardbillmst.InwardId)
                                 INNER JOIN tblvendormst ON tblinwardbillmst.VendorId = tblvendormst.VendorId)
                                 WHERE tblinwardpayment.InwardId LIKE '$InwardId'  and tblinwardpayment.StockMstSysId=0 and tblinwardpayment.RecStatus=1 ORDER BY PaymentDate DESC";   
                                 //echo $query;                   
                        $run = mysqli_query($con,$query);
                     }
                                        
                     if($run->num_rows==0){
                        // echo "<script>swal.fire({ icon: 'error', title: 'Oops...', text: 'No Data Found For This Value !!!' });</script>";
                     }else{     
                        while ($row=mysqli_fetch_array($run))
                        {
                           $date=$row["PaymentDate"];
                           $date=explode(" ",$date);
                           $date=$date[0];
                           $date=explode("-",$date);
                           $date=$date[2]."-".$date[1]."-".$date[0];
                           $cname=$row["CustomerName"];
                           $vname=$row["VendorName"];
                           $ChallanNo=$row["ChallanNo"];
                           $InwardId=$row["InwardId"];
                           $penPayment=$row["AmountPending"];
                           $AmountPaid=$row["AmountPaid"];
                           $totalPayment=$row["TotalAmount"];
                           $discount=$row["Discount"];
                           $transport=$row["TransportCost"];
                           $extra=$row["ExtraCost"];
                           $subtotal=$totalPayment-$discount+$transport+$extra;
                           $PaymentID=$row['PaymentID'];
                           $RoundOffDade=$row['RoundOffDade'];
                           $PaymentNotes=$row['PaymentNotes'];
                  ?>
                           <tr>
                              <td><?php echo ++$counter; ?></td>
                              <td><?php echo $date; ?></td>
                              <td><?php echo $ChallanNo; ?><?php echo $InwardId; ?></td>
                              <td><?php echo $cname; ?><?php echo $vname; ?></td>
                              <td><?php echo $subtotal; ?></td>
                              <td><?php echo $AmountPaid; ?></td>
                              <td><?php echo $PaymentNotes; ?></td> 
                              <td><input type="hidden" value="<?php echo $PaymentID; ?>" name="PaymentID"></td>
                              <td><input type="hidden" value="<?php echo $RoundOffDade; ?>" name="RoundOffDade"></td>
                              <!-- <td>
                                 <form>
                                    <a href="UpdatePayment.php?id=<?php echo $PaymentID; ?>"><input type="Button" value="Edit"
                                       name="submit" class="btn btn-primary" id="btn"></a>
                                    <a href="DeletePayment.php?id=<?php echo $PaymentID; ?>"><input type="Button" value="Delete"
                                       name="" class="btn btn-primary" id="btn"></a>
                                    <a href="MarkDadePayment.php?id=<?php echo $PaymentID; ?>&pen=<?php echo $penPayment; ?>"><input
                                       type="Button" value="Mark as Dade" name="" class="btn btn-primary" id="btn"></a>
                                 </form>
                              </td> -->
                           </tr>

                  <?php } }?>
               </tbody>
            </table>

         </div>
      </div>
   </div>
</body>

</html>