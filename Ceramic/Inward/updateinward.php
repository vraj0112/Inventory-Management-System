<?php

include('config.php');

?>

<!DOCTYPE html>
<html>
   <head>
      <title>Search and Manage Inward</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
      <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
      <script>
         function checkRadio(radio){
               if (radio.id === "Inward ID"){
                     document.getElementById("hsnc").innerHTML = "<input type='text' name='iid' class='form-control' id='iid' placeholder='Enter Inward Id.'>";
                  }
               else if (radio.id === "Vendor Mobile No."){
                     document.getElementById("hsnc").innerHTML = "<input type='text' name='vmob' class='form-control' id='vmob' placeholder='Enter Vendor Mobile No.'>";
                  }
               else if (radio.id === "Vendor Name"){
                     document.getElementById("hsnc").innerHTML = "<input type='text' name='vname' class='form-control' id='vname' placeholder='Enter Vendor Name'>";
                
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
                  <h3 class="card-title" style="color: white" align="center">Search and Manage Inward</h3>
               </div>
            </div>
         </div>
      </div>
         <br>
         <div class="row">
            <div class="col-md-12">
               <div class="card card-primary">
                  <table class="table" id="data_table">
                     <thead>
                        <tr valign="middle">
                           <th>Inward No.</th>
                           <th>Sys Id.</th>
                           <th>Sub Category</th>
                           <th>Color</th>
                           <th>Dimension</th>
                           <th>Qtyperunit</th>
                           <th>Unit</th>
                           <th>Code</th>
                           <th>Brand</th>
                           <th>Grade</th>
                           <th>Qty</th>
                           <th>Price</th>
                           <th>CGST</th>
                           <th>SGST</th>
                           <th>Total Price</th>
                           <th>Discount</th>
                           <th>Update</th>
                        </tr>
                     </thead>
                     <tbody>
                      <?php
                                error_reporting(E_ERROR | E_WARNING | E_PARSE);
                                $con=mysqli_connect('localhost','root','','imsfinal');
                                $iid=$_GET['id'];
                                $type = $_GET['type'];
                                
                                  $query= "SELECT * FROM tblinwarddetails where InwardId='$iid' and RecStatus='A'";
                                  $run = mysqli_query($con,$query);
                                
                                while ($row=mysqli_fetch_array($run))
                                {
                                    $ino=$row[0];
                                    $sys=$row[1];
                                    $qty=$row[3];
                                    $price=$row[4];
                                    $cgst=$row[5];
                                    $sgst=$row[6];
                                    $total=$row[7];
                                    $Dis=$row[8];
                                    $query1 = "SELECT * FROM productmst inner join systable on productmst.ProductID = systable.ProductId where systable.SysId = $sys";
                                    //echo $query1;
                                    $run1 = mysqli_query($con,$query1);
                                    while($row1 = mysqli_fetch_array($run1))
                                    {
                                      $proid = $row1[0];
                                      $prosub = $row1[1];
                                      $col = $row1[2];
                                      $die = $row1[3];
                                      $qpu = $row1[4];
                                      $unit = $row1[5];
                                      $code = $row1[6];
                                      $brand = $row1[9];
                                      $grade = $row1[10];
                                      $getsub = "SELECT * FROM subcategories WHERE subcategory_id = $prosub";
                                      $runsub = mysqli_query($conn,$getsub);
                                      while($rowsub = mysqli_fetch_array($runsub))
                                      {
                                        $subcategories1 = $rowsub['subcategory_name'];
                                      } 
                                      $getbrand = "SELECT * FROM brandnames WHERE BrandId = $brand";
                                      //echo $getbrand;
                                      $runbrand = mysqli_query($conn,$getbrand);
                                      while($rowsbrand = mysqli_fetch_array($runbrand))
                                      {
                                        $brandname = $rowsbrand[1];

                                      } 
                                      $getgrade = "SELECT * FROM grades WHERE GradeId = $grade";
                                      //echo $getbrand;
                                      $rungrade = mysqli_query($conn,$getgrade);
                                      while($rowsgrade = mysqli_fetch_array($rungrade))
                                      {
                                        $gradename = $rowsgrade[1];

                                      } 

                                    }

                                    // $vemail=$row[3];
                                    // $vaddress=$row[4];
                                  ?>
                      </tr>
                            <td><?php echo $ino; ?></td>
                            <td><?php echo $sys; ?></td>
                            <td><?php echo $subcategories1; ?></td>
                            <td><?php echo $col; ?></td>
                            <td><?php echo $die; ?></td>
                            <td><?php echo $qpu; ?></td>
                            <td><?php echo $unit; ?></td>
                            <td><?php echo $code; ?></td>
                            <td><?php echo $brandname; ?></td>
                            <td><?php echo $gradename; ?></td>
                            <td><?php echo $qty; ?></td>
                            <td><?php echo $price; ?></td>
                            <td><?php echo $cgst; ?></td>
                            <td><?php echo $sgst; ?></td>
                            <td><?php echo $total; ?></td>
                            <td><?php echo $Dis; ?></td>
<!--                             <td><?php echo $vemail; ?></td>
                            <td><?php echo $vaddress; ?></td> -->
                            <td><a href="Deleteinwarditem.php?id=<?php echo $sys; ?>&iid=<?php echo $iid; ?>&ino=<?php echo $ino; ?>&type=<?php echo $type; ?>"><input type="Button" value="Delete" name="" class="btn btn-primary" id="btn"></a></td>                  
                        </tr>
                                              <?php } ?>
                       <?php
                       /*
                             
                              $res=mysqli_query($conn,$q) or die("Can't Execute Query...");
                               $count=1;
                               while($row=mysqli_fetch_assoc($res))
                               {
                              ?>
                           <tr>
                               <td><?php echo $row['InwardDate']; ?></td>
                               <td><?php echo $row['VendorId']; ?></td>
                               <td><?php echo $row['TotalGST']; ?></td>
                               <td><?php echo $row['Transport_extracost']; ?></td>
                               <td><?php echo $row['TotalAmount']; ?></td>
                               <td><?php echo $row['AmountPaid']; ?></td>
                               <td><?php echo $row['AmountPending']; ?></td>
                               <td><?php echo $row['PaymentMode']; ?></td>
                               <td><?php echo $row['TotalDiscount']; ?></td>
                               <td><?php echo $row['Notes']; ?></td>
                               <?php

                                    echo  '<td><a href="Update_Product.php?pid='.$row['InwardId'].'">Edit</a> / <a href="process_del_pro.php?pid='.$row['InwardId'].'">Delete</a>'
                                 */
                                    ?>

                               <?php/*
                               $count++;
                               }
                                */
                               ?>

                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
      <div class="card-body">
                      <div style="float: right;">
                     <a href="Updateinwarditem.php?iid=<?php echo $iid; ?>&ino=<?php echo $ino; ?>&type=<?php echo $type; ?> "><input type="Button" value="Add" name="" class="btn btn-success" id="btn"></a></div>
                     <div class="form-group col-md-12">
                        <div id="rb1">
                        </div>
                     </div>
                     <div class="form-group col-md-2">
                        <div id="rb2">
                        </div>
                     </div>
                     
                     <div class="grid1">
                        <?php
                        $id = $_GET['id'];
                        $getbill = "SELECT * FROM tblinwardbillmst where InwardId='$id'";
                        $run1 = mysqli_query($con,$getbill);
                        $row1=mysqli_fetch_array($run1)

                         ?>
                        <form action="Updatebillinward.php" method="post">
                        <div>

                           <p class="col-md-6">Notes: <input type="text" name="not" value="<?php echo $row1['Notes']?>" class="form-control"
                                 id="not"></span></p>
                           <p class="col-md-6">Total Bill: <input type="number" name="totalbill" value="<?php echo $row1['TotalAmount']?>" class="form-control"
                                 id="totalbill" readonly></span></p>
                           <p class="col-md-6">Total GST: <input type="number" name="totalgst" value="<?php echo $row1['TotalGST']?>" class="form-control"
                                 id="totalgst" readonly></p>
                           <p class="col-md-6">Total Transport Cost: <input type="number" value="<?php echo $row1['Transport_extracost']?>" name="totalcost"
                                 class="form-control" id="totalcost"></p>
                           <p class="col-md-6">Total Paid: <input type="number" name="totalpaid" value="<?php echo $row1['AmountPaid']?>" class="form-control"
                                 id="totalpaid"></p>
                           <p class="col-md-6">Total Pending: <input type="number" name="totalpending" value="<?php echo $row1['AmountPending']?>"
                                 class="form-control" id="totalpending"></p>
                           <input type="text" name="id" value="<?php echo $id?>" hidden>
                        </div>
                        <input type="submit" value="Update" name="update" class="btn btn-primary" id="update">
                        <a href="s&minward.php"><input type="Button" value="Close" name="close" class="btn btn-primary" id="close"></a>
                        <form>
                     </div>

                   </div>
                  

      </section>
   </body>
   </html>