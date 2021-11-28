<!DOCTYPE html>
<html>
<head>
	<title>Payment Report</title>
    <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
    <script src="jquery-1.11.1.min.js"></script>
    <script src="jquery.table2excel.min.js" type="text/javascript"></script>

<!-- <script src="jquery.tableTotal.js"></script> -->

    <script src="sweetalert2.all.min.js"></script>
    <link rel='stylesheet' href='sweetalert2.min.css'>
    <script src="sweetalert-dev.js"></script>
    <link rel="stylesheet" href="sweetalert.css">


    <script type="text/javascript" src="script.js"></script>
    <script type="text/javascript" src="jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="jquery.dataTables.min.css">
    
    <script type="text/javascript">
    	function exportexcel() {  
            $("#data_table").table2excel({  
                name: "Table2Excel",  
                filename: "Payment Report",  
                fileext: ".xls"  
            });
            swal({
                title: "Report Generated Succesfully",
                text: "",
                type: "success",
                confirmButtonText: "OK"
            });
                    
        }   
    </script>
</head>
<body>
	<div class="container-fluid col-lg-12">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
					         <div class="card-header" style="background-color: #2B60DE">
                        <center>
                            <h3 class="card-title" style="color: white">Payment Report</h3>
                        </center>
                    </div>
                    <div class="carr card-body">
                      <form id="searchByForm" autocomplete="off" method="POST" target="paymentreport.php">
                            <div class="row">
                                <div class="row col-md-12">
                                    <div class="col-md-1">
                                        <label class="form-label" style="margin-right: 10px;">Search By: </label>
                                    </div>
                                    <div class="col-md-3">
                                      <select class="form-select" id="select" name="select">
                                        <option id="challan" value="challan">Challan Payment</option>
                                        <option id="inward" value="inward">Inward Payment</option>
                                        <option id="invoice" value="invoice">Invoice</option>
                                      </select>
                                    </div>
                                    <div class="col-md-1">
                                      <label class="form-label" style="float: right;">FROM : </label>
                                    </div>
                                    <div class="col-md-2">
                                        <input type='date' name='vmno1' class='form-select col-md-4' id='vmno1'> 
                                    </div>
                                    <div class="col-md-1">
                                      <label class="form-label" style="float: right;">TO : </label>
                                    </div>
                                    <div class="col-md-2">
                                      <input type='date' name='vmno2' class='form-select col-md-4' id='vmno2'>
                                    </div>
                                </div>
                              </div>
                              <div class="row mt-3">
                                <div>
                                    <input type="submit" value="Search" id="save" class="btn btn-success">
                                    <input type="button" value="Close"  name="close" id="close" class="btn btn-success" onclick="location.href = '../admin.php';">
                                </div>
                              </div>
                          </form>
                    </div>
                <br>
      <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <table class="table" id="data_table" onchange="gettotal()">
                    <thead>
                        <tr>
                           <th>Date</th>
                           <th>No.</th>
                           <th>Total Amount</th>
                           <th>Paid Amount</th>
                           <th>Pending Amount</th>
                        </tr>
                     </thead>
                     <tbody>
                      <?php
                      error_reporting( E_PARSE);
                      $start=$_POST['vmno1']." 00:00:00";
                      $end=$_POST['vmno2']." 00:00:00";
                      $select=$_POST['select'];
                      $con=mysqli_connect('localhost','root','','imsfinal');

                      if ($_POST['vmno1'] AND $_POST['vmno2']=='' AND $_POST['select']=='challan') {
                      
                        $query="SELECT ChallanDate, ChallanNo, (TotalAmount-Discount+TransportCost+ExtraCost) as total, (TotalAmount-Discount+TransportCost+ExtraCost-DueAmount) as pending, DueAmount FROM challanmst WHERE ChallanDate LIKE '$start' AND RecStatus=1";
                        $run=mysqli_query($con,$query);

                      }
                      elseif ($_POST['vmno1'] AND $_POST['vmno2'] AND $_POST['select']=='challan') { 
                        $query="SELECT ChallanDate, ChallanNo, (TotalAmount-Discount+TransportCost+ExtraCost) as total, (TotalAmount-Discount+TransportCost+ExtraCost-DueAmount) as pending, DueAmount FROM challanmst WHERE ChallanDate BETWEEN '$start' AND '$end' AND RecStatus=1";
                        $run=mysqli_query($con,$query); 
                      }





                      // baki che aa valu Inward table pachi thase

                      elseif ($_POST['vmno1'] AND $_POST['vmno2']=='' AND $_POST['select']=='inward') {
                      
                        $query="SELECT InwardDate, InwardId, TotalAmount as total, AmountPending as pending, AmountPaid FROM tblinwardbillmst WHERE InwardDate LIKE '$start' AND RecStatus='A'";
                        $run=mysqli_query($con,$query);

                      }
                      elseif ($_POST['vmno1'] AND $_POST['vmno2'] AND $_POST['select']=='inward') { 
                        $query="SELECT InwardDate, InwardId, TotalAmount as total, AmountPending as pending, AmountPaid FROM tblinwardbillmst WHERE InwardDate BETWEEN '$start' AND '$end' AND RecStatus='A'";

                        $run=mysqli_query($con,$query); 
                      }





                      elseif ($_POST['vmno1'] AND $_POST['vmno2']=='' AND $_POST['select']=='invoice') {
                      
                        $query="SELECT InvoiceDate, InvoiceNo, (TotalAmount-Discount+(TransportationCost+TransportationCost*0.18)) as total,'NA','NA' FROM invoicemst WHERE InvoiceDate LIKE '$start' AND RecStatus=1";
                        echo $query;
                        $run=mysqli_query($con,$query);


                      }
                      elseif ($_POST['vmno1'] AND $_POST['vmno2'] AND $_POST['select']=='invoice') { 
                        $query="SELECT InvoiceDate, InvoiceNo, (TotalAmount-Discount+(TransportationCost+TransportationCost*0.18)) as total,'NA','NA' FROM invoicemst WHERE InvoiceDate BETWEEN '$start' AND '$end' AND RecStatus=1";
                        echo $query;
                        $run=mysqli_query($con,$query); 
                      }     
              

                                while ($row=mysqli_fetch_array($run))
                                {
                                	$date=$row[0];
                                  $date=substr($date, 0, 10);
                                  $date=explode("-", $date);
                                  $date=$date[2]."-".$date[1]."-".$date[0];
                                  $no=$row[1];
                                	$total=$row[2];
                                	$paid=$row[3];
                                	$pending=$row[4];
                                	

                                  ?>
                      </tr>
                            <td><?php echo $date; ?></td>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $total; ?></td>
                            <td><?php echo $paid; ?></td>
                            <td><?php echo $pending; ?></td>
                        </tr>

                                              <?php } ?>
                     </tbody>

                    <tfoot>
                        <tr>
                           <th>Date</th>
                           <th>No.</th>
                           <th>Total Amount</th>
                           <th>Paid Amount</th>
                           <th>Pending Amount</th>
                        </tr>
                    </tfoot>
                  </table>

                  <script type="text/javascript">
                    function gettotal(){
                         var table = document.getElementById("data_table"), sumVal = 0;
            
                         for(var i = 1; i < table.rows.length-1; i++)
                            {
                                sumVal = sumVal + parseInt(table.rows[i].cells[10].innerHTML);
                            }

                        if(sumVal < 0){
                          document.getElementById("val").style.color="red";
                        }
                        else {
                          document.getElementById("val").style.color="green";
                        }
            
                        document.getElementById("val").innerHTML = "Selling Profit : " + sumVal;



                        var a=document.getElementById("val3").value;                       
                        var b=document.getElementById("val4").value;                       
                        var c=document.getElementById("val5").value;                       
                        var d=document.getElementById("val6").value;                       
                        var e=document.getElementById("val10").value;   
                        var z=sumVal-b-c-d-e;
                        console.log(z);


                        document.getElementById("val15").innerHTML = "Net Profit : " + z;


                        if (z < 0) {
                          document.getElementById("val15").innerHTML = "Net Profit : " + z;
                        }
                        else {
                          document.getElementById("val15").innerHTML = "Net Loss : " + z;
                        }

                        console.log(z);                    

                        // console.log(sumVal);

                        
                    }



//                     function myFunction() {
//   var input, filter, table, tr, td, i, txtValue;
//   input = document.getElementById("myInput");
//   filter = input.value.toUpperCase();
//   table = document.getElementById("data_table");
//   tr = table.getElementsByTagName("tr");
//   for (i = 0; i < tr.length; i++) {
//     td = tr[i].getElementsByTagName("td")[2];
//     if (td) {
//       txtValue = td.textContent || td.innerText;
//       if (txtValue.toUpperCase().indexOf(filter) > -1) {
//         tr[i].style.display = "";
//       } else {
//         tr[i].style.display = "none";
//       }
//     }       
//   }
// }
                  </script>

               </div>
             </div>
           </div>
         </div> 
                <div class="row mt-3">
<!--                      <input type="hidden" name="val3" id="val3" value="<?php echo "$maxprofit" ?>">
                     <input type="hidden" name="val3" id="val4" value="<?php echo "$round" ?>">
                     <input type="hidden" name="val3" id="val5" value="<?php echo "$pending" ?>">
                     <input type="hidden" name="val3" id="val6" value="<?php echo "$damage" ?>">
                     <input type="hidden" name="val3" id="val10" value="<?php echo "$expense" ?>">
                     <input type="hidden" name="val3" id="val16" value="<?php echo "$netp" ?>"> -->


                     
<!--                     <div class="col-md-2">
                     <center><h5 id="val">Selling Profit: <?php echo "$maxprofit" ?> --> <!-- <input type="number" style="border: 0px" name="val" id="val" value="<?php echo "$maxprofit" ?>" readonly="" class="form-group"> --></h5></center>  
<!--                     </div>
                    <div class="col-md-2">
                     <center><h5 id="val7">Dade Loss: <?php echo"$round" ?></h5></center>   
                    </div>
                    <div class="col-md-2">
                    <center><h5 id="val8">Pending Loss: <?php echo"$pending" ?></h5></center> 
                    </div>
                    <div class="col-md-2">
                    <center><h5 id="val9">Damage Loss: <?php echo "$damage" ?></h5></center> 
                    </div>
                    <div class="col-md-2">
                    <center><h5 id="val11">Expense: <?php echo "$expense" ?></h5></center> 
                    </div>
                    <div class="col-md-2">
                    <center><h5 id="val15">Net Profit: <?php echo "$netp" ?></h5></center> 
                    </div>

                    <script type="text/javascript">
                       var x = document.getElementById("val3").value;
                       // console.log(x);
                       if(x>=0){
                        document.getElementById("val").style.color="green";
                       }
                       else{
                        document.getElementById("val").style.color="red";
                       }

                       var y = document.getElementById("val4").value;
                       if(y==0){
                        document.getElementById("val7").style.color="green";
                       }
                       else{
                        document.getElementById("val7").style.color="red";
                       }
                       var z = document.getElementById("val5").value;
                       if(z==0){
                        document.getElementById("val8").style.color="green";
                       }
                       else{
                        document.getElementById("val8").style.color="red";
                       }
                       var w = document.getElementById("val6").value;
                     //  console.log(w);
                       if(w==0){
                        document.getElementById("val9").style.color="green";
                       }
                       else{
                        document.getElementById("val9").style.color="red";
                       }
                       var p = document.getElementById("val10").value;
                       if(p==0){
                        document.getElementById("val11").style.color="green";
                       }
                       else{
                        document.getElementById("val11").style.color="red";
                       }
                       var q = document.getElementById("val16").value;
                       if(q==0){
                        document.getElementById("val15").style.color="green";
                       }
                       else{
                        document.getElementById("val15").style.color="red";
                       }
                     </script> -->

                    <center>
                        <input type="button" class="btn btn-primary" id='savebtn' onclick="exportexcel()" value="Print Report"> 
                        <input type="button" id='closebtn' class="btn btn-primary" onclick="location.href = '../admin.php';" value="Close">
<!--                         <button id='closebtn' class="btn btn-primary" onclick="window.location='../admin.php'">Close</button> -->
                    </center>
                </div>
            <!-- </div> -->
         <!-- </div> -->
      </div> 
            </section>
                

</body>
</html>