<!DOCTYPE html>
<html>
<head>
	<title>Stocks Details</title>
  	<link href="bootstrap.min.css" rel="stylesheet">
    <script src="jquery-1.11.1.min.js"></script>

    <script src="jquery.table2excel.min.js" type="text/javascript"></script>

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
                filename: "Stocks Report",  
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
                            <h3 class="card-title" style="color: white">Stocks Details</h3>
                        </center>
                    </div>
                    <div class="carr card-body">
                      <form class="row g-3" id="radio-buttons" method="POST" action="otherstock.php">
                        <div class="form-group col-md-12">
                          FROM : <input type='date' name='vmno1' class='form-group col-md-2' id='vmno1'> TO : <input type='date' name='vmno2' class='form-group col-md-2' id='vmno2'>
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
                <table class="table" id="data_table" onfocus="gettotal()">
                    <thead>
                        <tr>
<!--                             <th style="width: 10px;">No.</th> -->
                           <th style="text-align: left;">Product Type</th>
                           <th style="text-align: left;">Product Subtype</th>
                          <!--  <th>Product Type</th> -->
<!--                            <th>BILL Amount</th> -->
                           <th style="text-align: left;">Brand Name</th>
                           <th>Qty/Unit</th>
                           <th>Dimantion</th>
                           <th>Batch No.</th>
                           <th>Model NO.</th>
                           <th>Grade</th>
                           <th>Date</th>
                           <th>Billling Qty</th>
                           <th>Other Qty</th>
                           <!-- <th>Total Qty</th> --> 
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
                      
                        $query="SELECT stockdetails.BillingQty, stockdetails.OtherQty, productmst.QtyPerUnit, brandnames.BrandName, categories.category_name, subcategories.subcategory_name, productmst.PackingUnit, productmst.SizeOrDimension, systable.BatchNo, stockdetails.DateAdded, productmst.Code, grades.GradeText FROM stockdetails join systable, productmst, subcategories, categories, brandnames, grades WHERE stockdetails.SysId = systable.SysId and systable.ProductId = productmst.ProductID and productmst.ProductSubCategoryID = subcategories.subcategory_id and subcategories.category_id = categories.category_id and brandnames.BrandId=productmst.BrandId AND grades.GradeId=productmst.GradeId AND categories.active_status=1 AND subcategories.active_status=1 AND productmst.RecStatus=1 AND systable.RecStatus=1 AND (stockdetails.BillingQty>0 OR stockdetails.OtherQty>0)";
                     // echo "$query";
                        $run=mysqli_query($con,$query);          
                      }
                      elseif($_POST['vmno1'] AND $_POST['vmno2']==''){
                          $query="SELECT stockdetails.BillingQty, stockdetails.OtherQty, productmst.QtyPerUnit, brandnames.BrandName, categories.category_name, subcategories.subcategory_name, productmst.PackingUnit, productmst.SizeOrDimension, systable.BatchNo, stockdetails.DateAdded, productmst.Code, grades.GradeText FROM stockdetails join systable, productmst, subcategories, categories, brandnames, grades WHERE stockdetails.SysId = systable.SysId and systable.ProductId = productmst.ProductID and productmst.ProductSubCategoryID = subcategories.subcategory_id and subcategories.category_id = categories.category_id and brandnames.BrandId=productmst.BrandId AND grades.GradeId=productmst.GradeId AND categories.active_status=1 AND subcategories.active_status=1 AND productmst.RecStatus=1 AND stockdetails.DateAdded LIKE '$start' AND systable.RecStatus=1 AND (stockdetails.BillingQty>0 OR stockdetails.OtherQty>0)";
                    //  echo "$query";
                          $run=mysqli_query($con,$query);        
                      }
                      elseif ($_POST['vmno1'] AND $_POST['vmno2']) { 
                        $query="SELECT stockdetails.BillingQty, stockdetails.OtherQty, productmst.QtyPerUnit, brandnames.BrandName, categories.category_name, subcategories.subcategory_name, productmst.PackingUnit, productmst.SizeOrDimension, systable.BatchNo, stockdetails.DateAdded, productmst.Code, grades.GradeText FROM stockdetails join systable, productmst, subcategories, categories, brandnames, grades WHERE stockdetails.SysId = systable.SysId and systable.ProductId = productmst.ProductID and productmst.ProductSubCategoryID = subcategories.subcategory_id and subcategories.category_id = categories.category_id and brandnames.BrandId=productmst.BrandId AND grades.GradeId=productmst.GradeId AND categories.active_status=1 AND subcategories.active_status=1 AND productmst.RecStatus=1 AND stockdetails.DateAdded BETWEEN '$start' and '$end' AND systable.RecStatus=1 AND (stockdetails.BillingQty>0 OR stockdetails.OtherQty>0)";
                    //  echo "$query";
                          $run=mysqli_query($con,$query); 
                      }     



                      if($run->num_rows==0){
                                      echo "<script>Swal.fire({icon: 'error', title: 'Oops...',text: 'No Data Found For This Value !!!'});</script>";

                                  }

                                  else{


                              // $tt = 0;
                              // $tg = 0;
                              // $qid = 0;
                                while ($row=mysqli_fetch_array($run))
                                {
                                	$type=$row[4];
                                	$subtype=$row[5];
                                	$brand=$row[3];
                                	$billing=$row[0];
                                	$other=$row[1];
                                	$qtypu=$row[2];
                                	$totalqty=$billing+$other;
                                	$pakunit=$row[6];
                                  $diman=$row[7];
                                  $batch=$row[8];
                                  $date=$row[9];
                                  $date=substr($date, 0, 10);
                                  $date=explode("-", $date);
                                  $date=$date[2]."-".$date[1]."-".$date[0];
                                  $model=$row[10];
                                  $garde=$row[11];
                            
                                    // $idate=$row[0];
                                    // $iname=$row[1];
                                    // $iitem=$row[2];
                                    // $cgst=$row[3];
                                    // $sgst=$row[4];
                                    // $iamount=$row[5];
                                    // $itype= $row[6];
                                    // $ibrand=$row[7];
                                    // $igrade=$row[8];
                                    // $icode=$row[9];
                                    // $idimantion=$row[10];
                                    // $iqpu=$row[11];
                                    // $igst=$cgst+$sgst;
                                    // $tg=$tg+$igst;
                                    // $tt=$tt+$iamount;
                                    // $qid++;
                                    // $vemail=$row[3];
                                    // $vaddress=$row[4];
                                  ?>
                      </tr>
<!--                             <th style="width: 10px;"><?php echo $qid; ?></th> -->
                            <td style="text-align: left;"><?php echo $type; ?></td>
                            <td style="text-align: left;"><?php echo $subtype; ?></td>
                            <td style="text-align: left;"><?php echo $brand; ?></td>
                            <td><?php echo $qtypu; ?></td>
                            <td><?php echo $diman; ?></td>
                            <td><?php echo $batch; ?></td>
                            <td><?php echo $model; ?></td>
                            <td><?php echo $garde; ?></td>
                            <td><?php echo $date; ?></td>
                            <td><?php echo $billing; ?></td>
                            <td><?php echo $other; ?></td>
                           <!--  <td><?php echo $totalqty; ?></td> -->                <!-- <?php echo $pakunit; ?> -->
                        </tr>

                                              <?php } }?>
                     </tbody>

                    <tfoot>
                        <tr>
<!--                             <th style="width: 10px;">Sr no.</th> -->
                            <th>Product Type</th>
                            <th>Product Subtype</th>
                            <th>Brand Name</th>
                            <th>Qty/Unit</th>
                            <th>Dimantion</th>
                            <th>Batch No</th>
                            <th>Model NO.</th>
                            <th>Grade</th>
                            <th>Date</th>
                            <th>Billling Qty</th>
                            <th>Other Qty</th>
                           <!--  <th>Total Qty</th> -->

                        </tr>
                    </tfoot>
                  </table>

                  <script type="text/javascript">
                    function gettotal(){
                         var table = document.getElementById("data_table"), sumVal = 0;
            
                         for(var i = 1; i < table.rows.length-1; i++)
                            {
                                sumVal = sumVal + parseInt(table.rows[i].cells[9].innerHTML);
                            }
            
            document.getElementById("val").value = sumVal;
            console.log(sumVal);

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
                    <!-- <div class="col-md-6">
                     Total Amount:  <input type="number" name="val" id="val" value="" onfocus="gettotal()" readonly="" class="form-group">   
                    </div> -->
                    
                    <center>
                        <input type="button" class="btn btn-primary" id='savebtn' onclick="exportexcel()" value="Print Report"> 
<!--                         <button id='closebtn' class="btn btn-primary" onclick="window.location='../admin.php'">Close</button> -->
                    </center>
                </div>
            </div>
         </div>
      </div> 
            </section>
                

</body>
</html>