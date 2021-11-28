<!DOCTYPE html>
<html>
<head>
	<title>Profit/Lose Report</title>
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
                filename: "Profit_loss_Report",  
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
                            <h3 class="card-title" style="color: white">Profit / Loss Report</h3>
                        </center>
                    </div>
                    <div class="carr card-body">
                      <form class="row g-3" id="radio-buttons" method="POST" action="profitloss.php">
                        <div class="form-group col-md-6">
                          FROM : <input type='date' name='vmno1' class='form-group col-md-3' id='vmno1'> TO : <input type='date' name='vmno2' class='form-group col-md-3' id='vmno2'>
                        </div>

                        <div>
                          <input type="submit" value="Search" id="save" class="btn btn-success">
                          <input type="button" value="Close"  name="close" id="close" class="btn btn-success" onclick="location.href = '../admin.php';">
                        </div>
                    </div>
                </div>
                <br>
      <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">

<!-- <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for item.." title="Type in a name"> -->
                <table class="table" id="data_table" onchange="gettotal()">
                    <thead>
                        <tr>
<!--                             <th style="width: 10px;">No.</th> -->
                           <th>Date</th>
                           <th>Challan No.</th>
                           <th style="text-align: left;">Product Type</th>
                           <th style="text-align: left;">Product Subtype</th>
                          <!--  <th>Product Type</th> -->
<!--                            <th>BILL Amount</th> -->
                           <th style="text-align: left;">Brand Name</th>
                           <!-- <th>Qty/Unit</th> -->
                          <!--  <th>Dimantion</th> -->
                           <th>Batch No.</th>
                           <th>Qty.</th>
                           <th>Base Price</th>
                           <th>Selling Price</th>
<!--                            <th>Profit/Unit</th> -->
                           <th>Profit/Unit</th>
                           <th>Total Profit</th> 
<!--                            <th style="">GST Amount</th> -->
<!--                            <th>Email Id.</th>
                           <th>Addresss</th> -->
<!--                            <th style="">Total Amount</th> -->
                        </tr>
                     </thead>
                     <tbody>
                      <?php
                      error_reporting(E_ERROR  | E_PARSE);
                      $start=$_POST['vmno1']." 00:00:00";
                      $end=$_POST['vmno2']." 00:00:00";
                      $con=mysqli_connect('localhost','root','','imsfinal');

                      if ($_POST['vmno1']=='' AND $_POST['vmno2']=='') {
                      
                        $query="SELECT productmst.QtyPerUnit, brandnames.BrandName, categories.category_name, subcategories.subcategory_name, productmst.PackingUnit, productmst.SizeOrDimension, systable.BatchNo, challanmst.ChallanDate, challandetails.SellingPrice, systable.BasePrice, challandetails.BillingQty, challandetails.OtherQty, challanmst.ChallanNo FROM stockdetails join systable, productmst, subcategories, categories, brandnames, challandetails, challanmst WHERE challanmst.ChallanId=challandetails.ChallanId AND stockdetails.SysId = systable.SysId and challandetails.StockId=stockdetails.StockId and systable.ProductId = productmst.ProductID and productmst.ProductSubCategoryID = subcategories.subcategory_id and subcategories.category_id = categories.category_id and brandnames.BrandId=productmst.BrandId AND categories.active_status=1 AND subcategories.active_status=1 AND productmst.RecStatus=1 AND systable.RecStatus=1";
                    //  echo "$query";
                        $run=mysqli_query($con,$query);

                        $query1="SELECT challanmst.ChallanDate, challandetails.SellingPrice*(challandetails.BillingQty+challandetails.OtherQty) as selling, systable.BasePrice*(challandetails.BillingQty+challandetails.OtherQty) as base, challandetails.SellingPrice*(challandetails.BillingQty+challandetails.OtherQty) - systable.BasePrice*(challandetails.BillingQty+challandetails.OtherQty) as profit FROM stockdetails join systable, challandetails, challanmst WHERE challanmst.ChallanId=challandetails.ChallanId AND stockdetails.SysId = systable.SysId and challandetails.StockId=stockdetails.StockId and systable.RecStatus=1";
                        //echo "$query1";
                        $run1=mysqli_query($con,$query1); 

                        $query2="SELECT COALESCE(sum(RoundOffDeade),0), COALESCE(sum(DueAmount),0) FROM challanmst WHERE RecStatus=1";
                        $run2=mysqli_query($con,$query2); 

                        $query3="SELECT  COALESCE(sum((breakageanddamage.BillingQty+breakageanddamage.OtherQty)*systable.BasePrice),0) FROM breakageanddamage join systable WHERE breakageanddamage.SysId=systable.SysId and breakageanddamage.RecStatus=1";
                        //echo "$query3";
                        $run3=mysqli_query($con,$query3); 

                        $query4="SELECT COALESCE(sum(Amount),0) FROM tblexpencemst WHERE RecStatus=1";
                        $run4=mysqli_query($con,$query4);                                
                      }
                      elseif($_POST['vmno1'] AND $_POST['vmno2']==''){
                          $query="SELECT productmst.QtyPerUnit, brandnames.BrandName, categories.category_name, subcategories.subcategory_name, productmst.PackingUnit, productmst.SizeOrDimension, systable.BatchNo, challanmst.ChallanDate, challandetails.SellingPrice, systable.BasePrice, challandetails.BillingQty, challandetails.OtherQty, challanmst.ChallanNo FROM stockdetails join systable, productmst, subcategories, categories, brandnames, challandetails, challanmst WHERE challanmst.ChallanId=challandetails.ChallanId AND stockdetails.SysId = systable.SysId and challandetails.StockId=stockdetails.StockId and systable.ProductId = productmst.ProductID and productmst.ProductSubCategoryID = subcategories.subcategory_id and subcategories.category_id = categories.category_id and brandnames.BrandId=productmst.BrandId AND categories.active_status=1 AND subcategories.active_status=1 AND productmst.RecStatus=1 AND systable.RecStatus=1 AND challanmst.ChallanDate LIKE '$start'";
                     // echo "$query";
                          $run=mysqli_query($con,$query); 

                          $query1="SELECT challanmst.ChallanDate, challandetails.SellingPrice*(challandetails.BillingQty+challandetails.OtherQty) as selling, systable.BasePrice*(challandetails.BillingQty+challandetails.OtherQty) as base, challandetails.SellingPrice*(challandetails.BillingQty+challandetails.OtherQty) - systable.BasePrice*(challandetails.BillingQty+challandetails.OtherQty) as profit FROM stockdetails join systable, challandetails, challanmst WHERE challanmst.ChallanId=challandetails.ChallanId AND stockdetails.SysId = systable.SysId and challandetails.StockId=stockdetails.StockId and systable.RecStatus=1 AND challanmst.ChallanDate LIKE '$start'";
                        // echo "$query1";
                          $run1=mysqli_query($con,$query1); 

                          $query2="SELECT COALESCE(sum(RoundOffDeade),0), COALESCE(sum(DueAmount),0) FROM challanmst WHERE ChallanDate Like '$start' and RecStatus=1";
                          //echo "$query2";
                          $run2=mysqli_query($con,$query2);

                          $query3="SELECT COALESCE(SUM(systable.BasePrice * (breakageanddamage.BillingQty + breakageanddamage.OtherQty)),0) as damage FROM breakageanddamage join systable WHERE breakageanddamage.SysId=systable.SysId and breakageanddamage.CreatedDate LIKE '$start' and  breakageanddamage.RecStatus=1";
                         // echo "$query3";
                          $run3=mysqli_query($con,$query3);  

                          $query4="SELECT COALESCE(sum(Amount),0) FROM tblexpencemst WHERE ModifiedDate Like '$start' AND RecStatus=1";
                          $run4=mysqli_query($con,$query4);
                          //echo $query4;      
                      }
                      elseif ($_POST['vmno1'] AND $_POST['vmno2']) { 
                        $query="SELECT productmst.QtyPerUnit, brandnames.BrandName, categories.category_name, subcategories.subcategory_name, productmst.PackingUnit, productmst.SizeOrDimension, systable.BatchNo, challanmst.ChallanDate, challandetails.SellingPrice, systable.BasePrice, challandetails.BillingQty, challandetails.OtherQty, challanmst.ChallanNo FROM stockdetails join systable, productmst, subcategories, categories, brandnames, challandetails, challanmst WHERE challanmst.ChallanId=challandetails.ChallanId AND stockdetails.SysId = systable.SysId and challandetails.StockId=stockdetails.StockId and systable.ProductId = productmst.ProductID and productmst.ProductSubCategoryID = subcategories.subcategory_id and subcategories.category_id = categories.category_id and brandnames.BrandId=productmst.BrandId AND categories.active_status=1 AND subcategories.active_status=1 AND productmst.RecStatus=1 AND systable.RecStatus=1 AND challanmst.ChallanDate BETWEEN '$start' AND '$end'";
                     // echo "$query";
                          $run=mysqli_query($con,$query); 

                          $query1="SELECT challanmst.ChallanDate, challandetails.SellingPrice*(challandetails.BillingQty+challandetails.OtherQty) as selling, systable.BasePrice*(challandetails.BillingQty+challandetails.OtherQty) as base, challandetails.SellingPrice*(challandetails.BillingQty+challandetails.OtherQty) - systable.BasePrice*(challandetails.BillingQty+challandetails.OtherQty) as profit FROM stockdetails join systable, challandetails, challanmst WHERE challanmst.ChallanId=challandetails.ChallanId AND stockdetails.SysId = systable.SysId and challandetails.StockId=stockdetails.StockId and systable.RecStatus=1 AND challanmst.ChallanDate BETWEEN '$start' AND '$end'";
                          //echo "$query1";
                          $run1=mysqli_query($con,$query1); 

                          $query2="SELECT COALESCE(sum(RoundOffDeade),0), COALESCE(sum(DueAmount),0) FROM challanmst WHERE ChallanDate BETWEEN '$start' AND '$end' AND RecStatus=1";
                         // echo "$query2";
                          $run2=mysqli_query($con,$query2);

                          $query3="SELECT  COALESCE(sum((breakageanddamage.BillingQty+breakageanddamage.OtherQty)*systable.BasePrice),0) FROM breakageanddamage join systable WHERE breakageanddamage.SysId=systable.SysId and breakageanddamage.CreatedDate BETWEEN '$start' and '$end' and  breakageanddamage.RecStatus=1";
                         // echo "$query3";
                          $run3=mysqli_query($con,$query3);

                          $query4="SELECT COALESCE(sum(Amount),0) FROM tblexpencemst WHERE ModifiedDate BETWEEN '$start' AND '$end' AND RecStatus=1";
                          $run4=mysqli_query($con,$query4);
                      }     



                      // if($run->num_rows==0){
                      //                 echo "<script>Swal.fire({icon: 'error', title: 'Oops...',text: 'No Data Found For This Value !!!'});</script>";

                      //             }

                      //             else{


                              // $tt = 0;
                              // $tg = 0;
                              // $qid = 0;
                                    $maxprofit=0;

              

                                while ($row=mysqli_fetch_array($run))
                                {
                                	$type=$row[2];
                                	$subtype=$row[3];
                                	$brand=$row[1];
                                	$qtypu=$row[0];
                                	
                                	$pakunit=$row[4];
                                  $diman=$row[5];
                                  $batch=$row[6];
                                  $date=$row[7];
                                  $date=substr($date, 0, 10);
                                  $date=explode("-", $date);
                                  $date=$date[2]."-".$date[1]."-".$date[0];
                                  $selling=$row[8];
                                  $base=$row[9];
                                  $profit=$selling-$base;  
                                  $billing=$row[10];
                                  $other=$row[11];
                                  $totalqty=$billing+$other;
                                  $totalprofit=$profit*$totalqty;
                                  $maxprofit=$maxprofit+$totalprofit;
                                  $cno=$row[12];

                                  ?>
                      </tr>
                            <td><?php echo $date; ?></td>
                            <td><?php echo $cno; ?></td>
                            <td style="text-align: left;"><?php echo $type; ?></td>
                            <td style="text-align: left;"><?php echo $subtype; ?></td>
                            <td style="text-align: left;"><?php echo $brand; ?></td>
                            <td><?php echo $batch; ?></td>

                            <td><?php echo $totalqty; ?></td>
                            <td><?php echo $base; ?></td>
                            <td><?php echo $selling; ?></td>
                            <td><?php echo $profit; ?></td>
                            <td><?php echo $totalprofit; ?></td> 


                        </tr>

                                              <?php } 

          $tprofit=0;
          $netp=0;
          while ($row=mysqli_fetch_array($run1))
            {
              $profit=$row[3];
              $tprofit=$tprofit+$profit;
            }
          while ($row=mysqli_fetch_array($run2)) {
              $round=$row[0];
              $pending=$row[1];
            }
          while ($row=mysqli_fetch_array($run3)) {
              $damage=$row[0];
           }
          while ($row=mysqli_fetch_array($run4)) {
              $expense=$row[0];
           }

           $netp=$tprofit-$round-$pending-$damage-$expense;
              

                                               ?>
                     </tbody>

                    <tfoot>
                        <tr>
<!--                             <th style="width: 10px;">Sr no.</th> -->
                            <th>Date</th>
                            <th>Challan No.</th>
                            <th>Product Type</th>
                            <th>Product Subtype</th>
                            <th>Brand Name</th>
<!--                             <th>Qty/Unit</th> -->
<!--                             <th>Dimantion</th> -->
                            <th>Batch No</th>
                            <th>Qty.</th>
                            <th>Base Price</th>
                            <th>Selling Price</th>
                            <th>Profit/Unit</th>
                            <th>Total Profit</th>

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
                <div class="row mt-3">
                     <input type="hidden" name="val3" id="val3" value="<?php echo "$maxprofit" ?>">
                     <input type="hidden" name="val3" id="val4" value="<?php echo "$round" ?>">
                     <input type="hidden" name="val3" id="val5" value="<?php echo "$pending" ?>">
                     <input type="hidden" name="val3" id="val6" value="<?php echo "$damage" ?>">
                     <input type="hidden" name="val3" id="val10" value="<?php echo "$expense" ?>">
                     <input type="hidden" name="val3" id="val16" value="<?php echo "$netp" ?>">


                     
                    <div class="col-md-2">
                     <center><h5 id="val">Selling Profit: <?php echo "$maxprofit" ?> <!-- <input type="number" style="border: 0px" name="val" id="val" value="<?php echo "$maxprofit" ?>" readonly="" class="form-group"> --></h5></center>  
                    </div>
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
                     </script>

                    <center>
                        <input type="button" class="btn btn-primary" id='savebtn' onclick="exportexcel()" value="Print Report"> 
                        <input type="button" id='closebtn' class="btn btn-primary" onclick="location.href = '../admin.php';" value="Close">
<!--                         <button id='closebtn' class="btn btn-primary" onclick="window.location='../admin.php'">Close</button> -->
                    </center>
                </div>
            </div>
         </div>
      </div> 
            </section>
                

</body>
</html>