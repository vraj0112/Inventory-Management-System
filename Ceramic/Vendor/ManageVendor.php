<!DOCTYPE html>
<html>
   <head>
      <title>Search and Manage Vendor</title>
      <link href="bootstrap.min.css" rel="stylesheet">
      <script src="sweetalert2.all.min.js"></script>
      <link rel='stylesheet' href='sweetalert2.min.css'>
      <script src="sweetalert-dev.js"></script>
      <link rel="stylesheet" href="sweetalert.css">

<style type="text/css">
  #btn{
    margin-right: 10px;
  }
</style>


      <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
      <script>
         function checkRadio(radio){
               if (radio.id === "vendor"){
                     document.getElementById("hsnc").innerHTML = "<input type='text' name='vid' class='form-control' id='vid' placeholder='Enter Vendor Id.'>";
                  }

               else if (radio.id === "vendorName"){
                     document.getElementById("hsnc").innerHTML = "<input type='text' name='vname' class='form-control' id='vname' placeholder='Enter Vendor Name'>";
                  }
               else if (radio.id === "vmobileno"){
                     document.getElementById("hsnc").innerHTML = "<input type='text' name='vmno' class='form-control' id='vmno' pattern='[0-9]{10}'' maxlength='10' placeholder='Enter Vendor Mobile No.'>";
                  }
               // else if (radio.id === "subtype"){
               //       document.getElementById("hsnc").innerHTML = "<select id='pname' onchange='select1()' class='form-select col-md-12' style='width: 98%; margin-left: -5%;'><option value='White Cement'>White Cement</option><option value='Grey Cement'>Grey Cement</option><option value='Vitrified Tiles'>Vitrified Tiles</option><option value='Wall Tiles'>Wall Tiles</option><option value='Floor Tiles'>Floor Tiles</option><option value='Parking Tiles'>Parking Tiles</option><option value='One Piece'>One Piece</option><option value='Wall Huge'>Wall Huge</option></select>";
               //    }
               // else if (radio.id === "codeno"){
               //       document.getElementById("hsnc").innerHTML = "<select id='pname' onchange='select1()' class='form-select col-md-12' style='width: 98%; margin-left: -5%;'><option value='1201L'>1201L</option><option value='1201HL'>1201HL</option><option value='1201D'>1201D</option><option value='1201F'>1201F</option></select>";
               //    }
               }
       </script>
          </head>
   <body>
      <div class="container-fluid col-lg-12">
       <div class="row">
         <div class="col-md-12">
            <div class="card card-primary">
               <div class="card-header" style="background-color: #2B60DE">
                  <h3 class="card-title" style="color: white" align="center">Search and Manage Vendor</h3>
               </div>
               <div class="card-body">
                  <form class="row g-3" id="radio-buttons" method="POST" action="ManageVendor.php">
                     <div class="form-group col-md-12">
                        <label class="form-label">Search By: </label>
                        <div class="form-check form-check-inline">
                           <input class="form-check-input" type="radio" name="mc" id="vendor" value="vendor" onchange="checkRadio(this)">
                           <label class="form-check-label" for="inlineRadio1">Vendor Id. </label>
                        </div>
                        <div class="form-check form-check-inline">
                           <input class="form-check-input" type="radio" name="mc" id="vendorName" value="vendorName" onchange="checkRadio(this)">
                           <label class="form-check-label" for="inlineRadio2">Vendor Name</label>
                        </div>
                        <div class="form-check form-check-inline">
                           <input class="form-check-input" type="radio" name="mc" id="vmobileno" value="mobileno" onchange="checkRadio(this)">
                           <label class="form-check-label" for="inlineRadio3">Mobile No. </label>
                        </div>




                        <!-- 
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="mc" id="subtype" value="subtype" onchange="checkRadio(this)">
                            <label class="form-check-label" for="inlineRadio4">Sub Type</label>
                         </div>
                         <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="hsn" id="codeno" value="codeno" onchange="checkRadio(this)">
                            <label class="form-check-label" for="inlineRadio5">Product Code No.</label>
                         </div> -->
                     </div>  
<!--                         <div class="form-group col-md-1">
                        </div> -->
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
         <br>
         <div class="row">
            <div class="col-md-12">
               <div class="card card-primary">
                  <table class="table" id="data_table">
                     <thead>
                        <tr>
                           <th>Vendor Id.</th>
                           <th>Vendor Name</th>
                           <th>Mobile Number</th>
                           <th>GST No.</th>
                           <th>Email Id.</th>
                           <th>Addresss</th>
                           <th>Button</th>
                        </tr>
                     </thead>
                     <tbody>
                      <?php
                                error_reporting(E_ERROR );
                                $con=mysqli_connect('localhost','root','','imsfinal');
                                $vid=$_POST['vid'];
                                // echo $cid;
                                $vname=$_POST['vname'];
                                $vmno=$_POST['vmno'];
             
                                if ($_POST['vid']=='' and $_POST['vname']=='' and $_POST['vmno']=='') {
                                  $query= "SELECT * FROM tblvendormst WHERE RecStatus=1";
                                  $run = mysqli_query($con,$query);

                                  // $query2 = "SELECT count(*) FROM tblvendormst WHERE RecStatus=1";
                                  // echo "$query2";
                                  // if ($query2==0) {
                                  //         echo "<script>Swal.fire('No Record Found all');</script>";
                                  //                             # code...
                                  //       }


                                  // if () {
                                  //         echo "<script>Swal.fire('Vendor Added Succesfully', '', 'success');</script>";
                                  //                             # code...
                                  //       }
                                }
                                                     
                                else if($_POST['vid'] and $_POST['vname']=='' and $_POST['vmno']==''){
                                        $query= "SELECT * FROM tblvendormst WHERE VendorId LIKE $vid AND RecStatus=1";
                                        $run = mysqli_query($con,$query);
                                    }
                                                     
                                                     
                                    elseif($_POST['vid']=="" and $_POST['vname'] and $_POST['vmno']=='')
                                    {
                                        $query="SELECT * FROM tblvendormst WHERE VendorName LIKE '%$vname%' AND RecStatus=1";
                                        $run=mysqli_query($con,$query);

                                        $query2="SELECT count(*) FROM tblvendormst WHERE VendorName LIKE '%$vname%' AND RecStatus=1";
                                        if ($query2='0') {
                                          echo "<script>Swal.fire('No Record Found');</script>";
      
                                        }

                                    }

                                    elseif ($_POST['vid']=='' and $_POST['vname']=='' and $_POST['vmno']) {
                                        $query="SELECT * FROM tblvendormst WHERE MobileNo LIKE '$vmno' AND RecStatus=1";
                                        $run=mysqli_query($con,$query);
                                        
                                        // $quary2 = "SELECT count(*) FROM tblvendormst WHERE MobileNo LIKE '$vmno' AND RecStatus=1";
                                        // //$run2=mysqli_query($con,$query2);    
                                        // if ($query2==0) {
                                        //   echo "<script>Swal.fire('No Record Found');</script>";
                                        //                       # code...
                                        // }                    
                                    }
                                  if($run->num_rows==0){
                                      echo "<script>Swal.fire({icon: 'error', title: 'Oops...',text: 'No Data Found For This Value !!!'});</script>";

                                  }
                                  else{
                                    while ($row=mysqli_fetch_array($run))
                                {
                                    $vid=$row[0];
                                    $vname=$row[1];
                                    $vmno=$row[2];
                                    $vgst=$row[5];
                                    $vemail=$row[3];
                                    $vaddress=$row[4];
                                  ?>
                      </tr>
                            <td><?php echo $vid; ?></td>
                            <td><?php echo $vname; ?></td>
                            <td><?php echo $vmno; ?></td>
                            <td><?php echo $vgst; ?></td>
                            <td><?php echo $vemail; ?></td>
                            <td><?php echo $vaddress; ?></td>
                            <td><a href="UpdateVendor.php?id=<?php echo $vid; ?>"><input type="Button" value="Update" name="" class="btn btn-primary" id="btn"></a><a href="DeleteVendor.php?id=<?php echo $vid; ?>"><input type="Button" value="Delete" name="" class="btn btn-primary" id="btn"></a></td>                  
                        </tr>


                                
                                
                                              <?php } } ?>
<!--                                               <?php  ?> -->

                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
      </section>
   </body>
   </html>