<!DOCTYPE html>
<html>
<head>
	<title>Sell/Perchase Report</title>
<!-- 	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous"> -->
  <!--   <script src="//code.jquery.com/jquery-1.11.1.min.js"></script> -->
  <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
    <script src="jquery-1.11.1.min.js" type="text/javascript"></script>  
    <script src="jquery.table2excel.min.js" type="text/javascript"></script>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="excel-bootstrap-table-filter-bundle.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" />
  <link rel="stylesheet" href="excel-bootstrap-table-filter-style.css" /> -->
     <script src="jquery.tableTotal.js"></script>
<!--     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->


<!-- <script src="excel-bootstrap-table-filter-bundle.js"></script>
<link rel="stylesheet" href="excel-bootstrap-table-filter-style.css"> -->

    <script src="sweetalert2.all.min.js"></script>
    <link rel='stylesheet' href='sweetalert2.min.css'>
    <script src="sweetalert-dev.js"></script>
    <link rel="stylesheet" href="sweetalert.css">


    <script type="text/javascript" src="script.js"></script>
    <script type="text/javascript" src="jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="jquery.dataTables.min.css">


    <script type="text/javascript">
    	function checkRadio(radio){
	    	if (radio.id === "sell"){
            	document.getElementById("hsnc").innerHTML = "FROM : <input type='date' name='sell1' class='form-group col-md-4' id='sell1'> TO : <input type='date' name='sell2' class='form-group col-md-4' id='sell2'>";
            }
            else if (radio.id === "purchase"){
            	document.getElementById("hsnc").innerHTML = "FROM : <input type='date' name='purchase1' class='form-group col-md-4' id='purchase1'> TO : <input type='date' name='purchase2' class='form-group col-md-4' id='purchase2'>";
            }

            
            
        }

        function exportexcel() {  
            $("#data_table").table2excel({  
                name: "Table2Excel",  
                filename: "Sell Purchase Report",  
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
                            <h3 class="card-title" style="color: white">Report Generation</h3>
                        </center>
                    </div>
                    <div class="card-body">
                    	<form class="row g-1" id="radio-buttons" method="POST" action="perticulerreport.php">
                     		<div class="form-group col-md-12">
                        		<label class="form-label">Type: </label>
                        		<div class="form-check form-check-inline">
                           			<input class="form-check-input" type="radio" name="mc" id="sell" value="sell" onchange="checkRadio(this)">
				                    <label class="form-check-label" for="inlineRadio1" >Sell Report </label>
                        		</div>
                        		<div class="form-check form-check-inline">
    			                    <input class="form-check-input" type="radio" name="mc" id="purchase" value="purchase" onchange="checkRadio(this)">
    			                    <label class="form-check-label" for="inlineRadio2">Purchase Report</label>
    			                </div>
<!--     			                <div class="form-check form-check-inline">
    			                    <input class="form-check-input" type="radio" name="mc" id="perticuler" value="perticuler" onchange="checkRadio(this)">
    			                    <label class="form-check-label" for="inlineRadio2">perticuler Report</label>
    			                </div> -->
 <!--    			                <div class="form-check form-check-inline">
    			                    <input class="form-check-input" type="radio" name="mc" id="type" value="type" onchange="checkRadio(this)">
    			                    <label class="form-check-label" for="inlineRadio3">Prduct Report </label>
    			                </div>
    			                <div class="form-check form-check-inline">
    			                    <input class="form-check-input" type="radio" name="mc" id="subtype" value="subtype" onchange="checkRadio(this)">
    			                    <label class="form-check-label" for="inlineRadio3">Subtype Report </label>
    			                </div>
    			           		<div class="form-check form-check-inline">
    			                    <input class="form-check-input" type="radio" name="mc" id="brand" value="brand" onchange="checkRadio(this)">
    			                    <label class="form-check-label" for="inlineRadio3">Brand Report </label>
    			                </div> -->
                    		</div>  
                        	<div class="form-group col-md-6" id="hsnc">
                        	</div>
                        	<div>
                          		<input type="submit" value="Search" id="save" class="btn btn-success">
                          		<input type="button" value="Close"  name="close" id="close" class="btn btn-success" onclick="location.href = '../admin.php';">
                        	</div>
                  		</form>
                    </div>
                </div>
            </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary" style="">

<!-- <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for item.." title="Type in a name"> -->
                <table class="table" id="data_table" onchange="gettotal()">
                    <thead>
                        <tr>
<!--                             <th style="width: 10px;">No.</th> -->
                           <th style="text-align: left;">DATE</th>
                           <th>No</th>
                           <th style="text-align: left;">PARTY NAME</th>
                           <th>Product Type</th>
<!--                            <th>BILL Amount</th> -->
                           <th style="text-align: left;">Product Subtype</th>
                           <th>Brand Name</th>
                           <th>Grad</th>
                           <th>Code</th>
                           <th>Dimention</th>
                           <th>Qty/Unit</th> 
<!--                            <th style="">GST Amount</th> -->
<!--                            <th>Email Id.</th>
                           <th>Addresss</th> -->
                           <th style="">Total Amount</th>
                        </tr>
                     </thead>
                     <tbody>
                      <?php
                                error_reporting( E_PARSE);
                                $con=mysqli_connect('localhost','root','','imsfinal');
                                $sell1=$_POST['sell1']." 00:00:00";
                                // echo $cid;
                                $sell2=$_POST['sell2']." 00:00:00";
                                $purchase1=$_POST['purchase1']." 00:00:00";
                                $purchase2=$_POST['purchase2']." 00:00:00";
                                $type=$_POST['type'];
                                $subtype=$_POST['subtype'];
                                $name=$_POST['brand'];


                                                     
                                if($_POST['sell1'] and $_POST['sell2']=='' and $_POST['purchase1']=='' and $_POST['purchase2']==''){
                                    $query="SELECT challanmst.ChallanDate as IDate, tblcustomermst.CustomerName as Name, subcategories.subcategory_name, categories.category_name, brandnames.BrandName, challandetails.SellingPrice*(challandetails.OtherQty + challandetails.BillingQty) as iamount,categories.category_name, brandnames.BrandName, grades.GradeText, productmst.Code, productmst.SizeOrDimension, productmst.QtyPerUnit, challanmst.ChallanNo FROM challanmst join tblcustomermst, challandetails, systable, productmst, subcategories, categories, brandnames, grades, stockdetails WHERE challanmst.CustomerId=tblcustomermst.CustomerId AND challandetails.ChallanId=challanmst.ChallanId AND challandetails.StockId=stockdetails.StockId AND stockdetails.SysId=systable.SysId AND  productmst.ProductID=systable.ProductId AND subcategories.subcategory_id =productmst.ProductSubCategoryID AND categories.category_id=subcategories.category_id AND brandnames.BrandId=productmst.BrandId AND grades.GradeId=productmst.GradeId AND challanmst.ChallanDate LIKE '$sell1' AND challandetails.RecStatus='1'";
                                     //    echo $query;
                                    $run=mysqli_query($con,$query);
                                                                  if($run->num_rows==0){
                                      echo "<script>Swal.fire({icon: 'error', title: 'Oops...',text: 'No Data Found For This Value !!!'});</script>";

                                  }

                                }
                                else if ($_POST['sell1'] and $_POST['sell2'] and $_POST['purchase1']=='' and $_POST['purchase2']=='') {
                                	$query="SELECT challanmst.ChallanDate as IDate, tblcustomermst.CustomerName as Name, subcategories.subcategory_name, categories.category_name, brandnames.BrandName, challandetails.SellingPrice*(challandetails.OtherQty + challandetails.BillingQty) as iamount,categories.category_name, brandnames.BrandName, grades.GradeText, productmst.Code, productmst.SizeOrDimension, productmst.QtyPerUnit, challanmst.ChallanNo FROM challanmst join tblcustomermst, challandetails, systable, productmst, subcategories, categories, brandnames, grades, stockdetails WHERE challanmst.CustomerId=tblcustomermst.CustomerId AND challandetails.ChallanId=challanmst.ChallanId AND challandetails.StockId=stockdetails.StockId AND stockdetails.SysId=systable.SysId AND  productmst.ProductID=systable.ProductId AND subcategories.subcategory_id =productmst.ProductSubCategoryID AND categories.category_id=subcategories.category_id AND brandnames.BrandId=productmst.BrandId AND grades.GradeId=productmst.GradeId AND challanmst.ChallanDate BETWEEN '$sell1' AND '$sell2' AND challandetails.RecStatus='1'";
                                       // echo $query;
                                        $run=mysqli_query($con,$query);
                                                                      if($run->num_rows==0){
                                      echo "<script>Swal.fire({icon: 'error', title: 'Oops...',text: 'No Data Found For This Value !!!'});</script>";

                                  }
                                }                    
                                                     
                                else if($_POST['sell1']=='' and $_POST['sell2']=='' and $_POST['purchase1'] and $_POST['purchase2']=='')
                                    {
                                        $query="SELECT tblinwardbillmst.InwardDate as IDate, tblvendormst.VendorName as Name, subcategories.subcategory_name , tblinwarddetails.CGST, tblinwarddetails.SGST, tblinwarddetails.TotalCost, categories.category_name, brandnames.BrandName, grades.GradeText, productmst.Code, productmst.SizeOrDimension, productmst.QtyPerUnit, tblinwardbillmst.InwardId FROM tblinwardbillmst join tblvendormst, tblinwarddetails, systable, productmst, subcategories, categories, brandnames, grades WHERE tblinwardbillmst.VendorId=tblvendormst.VendorId AND tblinwarddetails.InwardId=tblinwardbillmst.InwardId AND tblinwarddetails.ProductId=systable.SysId AND productmst.ProductID=systable.ProductId AND subcategories.subcategory_id =productmst.ProductSubCategoryID AND categories.category_id=subcategories.category_id AND brandnames.BrandId=productmst.BrandId AND grades.GradeId=productmst.GradeId AND tblinwardbillmst.InwardDate LIKE '$purchase1' AND tblinwardbillmst.RecStatus='A'";
                                        // echo $query;
                                        $run=mysqli_query($con,$query);
                                                                      if($run->num_rows==0){
                                      echo "<script>Swal.fire({icon: 'error', title: 'Oops...',text: 'No Data Found For This Value !!!'});</script>";

                                  }
                                        
                                    }

                                else if ($_POST['sell1']=='' and $_POST['sell2']=='' and $_POST['purchase1'] and $_POST['purchase2']) {
                                        $query="SELECT tblinwardbillmst.InwardDate as IDate, tblvendormst.VendorName as Name, subcategories.subcategory_name , tblinwarddetails.CGST, tblinwarddetails.SGST, tblinwarddetails.TotalCost, categories.category_name, brandnames.BrandName, grades.GradeText, productmst.Code, productmst.SizeOrDimension, productmst.QtyPerUnit, tblinwardbillmst.InwardId FROM tblinwardbillmst join tblvendormst, tblinwarddetails, systable, productmst, subcategories, categories, brandnames, grades WHERE tblinwardbillmst.VendorId=tblvendormst.VendorId AND tblinwarddetails.InwardId=tblinwardbillmst.InwardId AND tblinwarddetails.ProductId=systable.SysId AND productmst.ProductID=systable.ProductId AND subcategories.subcategory_id =productmst.ProductSubCategoryID AND categories.category_id=subcategories.category_id AND brandnames.BrandId=productmst.BrandId AND grades.GradeId=productmst.GradeId AND tblinwardbillmst.InwardDate BETWEEN '$purchase1' AND '$purchase2' AND tblinwardbillmst.RecStatus='A'";
                                       // echo $query;
                                        $run=mysqli_query($con,$query);     
                                                                      if($run->num_rows==0){
                                      echo "<script>Swal.fire({icon: 'error', title: 'Oops...',text: 'No Data Found For This Value !!!'});</script>";

                                  }                  
                                    }
                                // else if ($_POST['sell1']=='' and $_POST['sell2']=='' and $_POST['purchase1'] and $_POST['purchase2']=='' and $_POST['type'] and $_POST['subtype']=='' and $_POST['name']==''){
                                // 		 $query="SELECT tblinwardbillmst.InwardDate as IDate, tblvendormst.VendorName as Name, subcategories.subcategory_name , tblinwarddetails.CGST, tblinwarddetails.SGST, tblinwarddetails.TotalCost, categories.category_name  FROM tblinwardbillmst join tblvendormst, tblinwarddetails, systable, productmst, subcategories, categories WHERE tblinwardbillmst.VendorId=tblvendormst.VendorId AND tblinwarddetails.InwardId=tblinwardbillmst.InwardId AND tblinwarddetails.ProductId=systable.SysId AND productmst.ProductID=systable.ProductId AND subcategories.subcategory_id =productmst.ProductSubCategoryID AND categories.category_id=subcategories.category_id AND categories.category_name='$type' AND tblinwardbillmst.InwardDate LIKE '$purchase1' AND tblinwardbillmst.RecStatus='A' ";
                                //          //echo $query;
                                //         $run=mysqli_query($con,$query);                       

                                // }
                                // else if ($_POST['sell1']=='' and $_POST['sell2']=='' and $_POST['purchase1'] and $_POST['purchase2'] and $_POST['type'] and $_POST['subtype']=='' and $_POST['name']==''){
                                //          $query="SELECT tblinwardbillmst.InwardDate as IDate, tblvendormst.VendorName as Name, subcategories.subcategory_name , tblinwarddetails.CGST, tblinwarddetails.SGST, tblinwarddetails.TotalCost, categories.category_name, brandnames.BrandName, grades.GradeText, productmst.Code, productmst.SizeOrDimension, productmst.QtyPerUnit  FROM tblinwardbillmst join tblvendormst, tblinwarddetails, systable, productmst, subcategories, categories, brandnames, grades WHERE tblinwardbillmst.VendorId=tblvendormst.VendorId AND tblinwarddetails.InwardId=tblinwardbillmst.InwardId AND tblinwarddetails.ProductId=systable.SysId AND productmst.ProductID=systable.ProductId AND subcategories.subcategory_id =productmst.ProductSubCategoryID AND categories.category_id=subcategories.category_id AND brandnames.BrandId=productmst.BrandId AND grades.GradeId=productmst.GradeId AND categories.category_name='$type' AND tblinwardbillmst.InwardDate BETWEEN '$purchase1' AND '$purchase2' AND tblinwardbillmst.RecStatus='A'";
                                //          echo $query;
                                //         $run=mysqli_query($con,$query);  


                                // }
                                // else if ($_POST['sell1']=='' and $_POST['sell2']=='' and $_POST['purchase1'] and $_POST['purchase2']=='' and $_POST['type']=='' and $_POST['subtype'] and $_POST['name']==''){
                                //     $query="SELECT tblinwardbillmst.InwardDate as IDate, tblvendormst.VendorName as Name, subcategories.subcategory_name , tblinwarddetails.CGST, tblinwarddetails.SGST, tblinwarddetails.TotalCost, categories.category_name  FROM tblinwardbillmst join tblvendormst, tblinwarddetails, systable, productmst, subcategories, categories WHERE tblinwardbillmst.VendorId=tblvendormst.VendorId AND tblinwarddetails.InwardId=tblinwardbillmst.InwardId AND tblinwarddetails.ProductId=systable.SysId AND productmst.ProductID=systable.ProductId AND subcategories.subcategory_id =productmst.ProductSubCategoryID AND categories.category_id=subcategories.category_id AND subcategories.subcategory_name='$subtype' AND tblinwardbillmst.InwardDate LIKE '$purchase1' AND tblinwardbillmst.RecStatus='A' ";
                                //          //echo $query;
                                //         $run=mysqli_query($con,$query);                       

                                // }
                                // else if ($_POST['sell1']=='' and $_POST['sell2']=='' and $_POST['purchase1'] and $_POST['purchase2'] and $_POST['type']=='' and $_POST['subtype'] and $_POST['name']==''){
                                //     $query="SELECT tblinwardbillmst.InwardDate as IDate, tblvendormst.VendorName as Name, subcategories.subcategory_name , tblinwarddetails.CGST, tblinwarddetails.SGST, tblinwarddetails.TotalCost, categories.category_name  FROM tblinwardbillmst join tblvendormst, tblinwarddetails, systable, productmst, subcategories, categories WHERE tblinwardbillmst.VendorId=tblvendormst.VendorId AND tblinwarddetails.InwardId=tblinwardbillmst.InwardId AND tblinwarddetails.ProductId=systable.SysId AND productmst.ProductID=systable.ProductId AND subcategories.subcategory_id =productmst.ProductSubCategoryID AND categories.category_id=subcategories.category_id AND subcategories.subcategory_name='$subtype' AND tblinwardbillmst.InwardDate BETWEEN '$purchase1' AND '$purchase2' AND tblinwardbillmst.RecStatus='A' ";
                                //          //echo $query;
                                //         $run=mysqli_query($con,$query);                       

                                // }
                                // else if ($_POST['sell1']=='' and $_POST['sell2']=='' and $_POST['purchase1']=='' and $_POST['purchase2']=='' and $_POST['type']=='' and $_POST['subtype']=='' and $_POST['name']){

                                // }
                                // elseif ($_POST['vid']=='' and $_POST['vname']=='' and $_POST['vmno1'] and $_POST['vmno2']) {
                                //         $query="SELECT * FROM tblqutationmst WHERE QDate BETWEEN '$vmno1' AND '$vmno2' AND RecStatus=1";
                                //         $run=mysqli_query($con,$query);
                                                               
                                //     }

                              // if($run->num_rows==0){
                              //         echo "<script>Swal.fire({icon: 'error', title: 'Oops...',text: 'No Data Found For This Value !!!'});</script>";

                              //     }
                              // else{
                                
                              $tt = 0;
                              $tg = 0;
                              $qid = 0;
                                while ($row=mysqli_fetch_array($run))
                                {
                            
                                    $idate=$row[0];
                                    $idate=substr($idate, 0, 10);
                                    $idate=explode("-", $idate);
                                    $idate=$idate[2]."-".$idate[1]."-".$idate[0];
                                    $iname=$row[1];
                                    $iitem=$row[2];

                                    $cgst=$row[3];
                                    $sgst=$row[4];
                                    $iamount=$row[5];
                                    $itype= $row[6];
                                    $ibrand=$row[7];
                                    $igrade=$row[8];
                                    $icode=$row[9];
                                    $idimantion=$row[10];
                                    $iqpu=$row[11];
                                    $igst=intVal($cgst)+intVal($sgst);
                                    $tg=$tg+$igst;
                                    $tt=$tt+$iamount;
                                    $qid++;
                                    $chano=$row[12];
                                    // $vemail=$row[3];
                                    // $vaddress=$row[4];
                                  ?>
                      </tr>
<!--                             <th style="width: 10px;"><?php echo $qid; ?></th> -->
                            <td style="text-align: left;"><?php echo $idate; ?></td>
                            <td><?php echo $chano; ?></td>
                            <td style="text-align: left;"><?php echo $iname; ?></td>
                            <td style="text-align: left;"><?php echo $itype; ?></td>
                            <td><?php echo $iitem; ?></td>
                            <td><?php echo $ibrand; ?></td>
                            <td><?php echo $igrade; ?></td>
                            <td><?php echo $icode; ?></td>
                            <td><?php echo $idimantion; ?></td>
                            <td><?php echo $iqpu; ?></td>
<!--                             <td><?php echo $igst; ?></td> -->
							<td ><?php echo $iamount; ?></td>                
                        </tr>

                                              <?php } ?>
                     </tbody>

                    <tfoot>
                        <tr>
<!--                             <th style="width: 10px;">Sr no.</th> -->
                            <th>Date</th>
                            <th>No</th>
                            <th>Party Name</th>
                            <th>Type</th>
                            <th>Subtype</th>
                            <th>Brand Name</th>
                            <th>Grade</th>
                            <th>Code</th>
                            <th>Dimention</th>
                            <th>Qty/Unit</th>
<!--                             <th>GST Amount</th> -->
                            <th>Total Amount</th>
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
            
            document.getElementById("val").innerHTML = "Total Amount: " +sumVal;
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
                    <div class="col-md-6">
                    <h3 id="val">Total Amount: <?php echo"$tt" ?></h3> 
                    </div>
                    
                    <center>
                        <button class="btn btn-primary" id='savebtn' onclick="exportexcel()"> Print Report </button>
                        <button id='closebtn' class="btn btn-primary" onclick="window.location='../admin.php'">Close</button>
                    </center>
                </div>
            </div>
         </div>
      </div> 
            </section>
</body>
</html>


<!-- 
                    $('#data_table').tableTotal({
                        totalRow: true,
                        totalCol: false,
                        bold:true
                    });

                    $('#data_table').excelTableFilter(); -->