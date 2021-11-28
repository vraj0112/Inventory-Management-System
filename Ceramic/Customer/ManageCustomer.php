<?php 
 ?>
<!DOCTYPE html>
<html>
   <head>
      <title>Search and Manage Customer</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
      
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
      <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">

<style type="text/css">
  #btn{
    margin-right: 10px;
  }
</style>

      <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
      <script>
         function checkRadio(radio){
               if (radio.id === "customer"){
                     document.getElementById("hsnc").innerHTML = "<input type='text' name='cid' class='form-control' id='cid' placeholder='Enter Customer Id.'>";

                  }
               else if (radio.id === "customerName"){
                     document.getElementById("hsnc").innerHTML = "<input type='text' name='cname' class='form-control' id='cname' placeholder='Enter Customer Name'>";
                  }
               else if (radio.id === "mobileno"){
                     document.getElementById("hsnc").innerHTML = "<input type='text' name='cmno' class='form-control' id='cmno' pattern='[0-9]{10}'' maxlength='10' placeholder='Enter Customer Mobile No.'>";
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
                
                  <h3 class="card-title" style="color: white" align="center">Search and Manage Customer</h3>
                  

               </div>
               <div class="card-body">
                  <form class="row g-3" id="radio-buttons" method="POST" action="ManageCustomer.php">
                     <div class="form-group col-md-12">
                        <label class="form-label">Search By: </label>
                        <div class="form-check form-check-inline">
                           <input class="form-check-input" type="radio" name="mc" id="customer" value="customer" onchange="checkRadio(this)">
                           <label class="form-check-label" for="inlineRadio1">Customer Id. </label>
                        </div>
                        <div class="form-check form-check-inline">
                           <input class="form-check-input" type="radio" name="mc" id="customerName" value="customerName" onchange="checkRadio(this)">
                           <label class="form-check-label" for="inlineRadio2">Customer Name</label>
                        </div>
                        <div class="form-check form-check-inline">
                           <input class="form-check-input" type="radio" name="mc" id="mobileno" value="mobileno" onchange="checkRadio(this)">
                           <label class="form-check-label" for="inlineRadio3">Mobile No. </label>
                        </div><!-- 
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
<!--                         <input type="text" name="cid" id="cid"> -->
                        <div class="form-group col-md-6" id="hsnc">
                        </div>
                        <div>
                          <input type="submit" name="submit" value="Search" id="submit" class="btn btn-success">
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
                           <th>Customer Id.</th>
                           <th>Customer Name</th>
                           <th>Mobile Number</th>
                           <th>GST No.</th>
                           <th>Email Id.</th>
                           <th>Addresss</th>
                           <th>Button</th>                           
                        </tr>
                     </thead>
                     <tbody>
                      <tr>
                        <?php
                                error_reporting(E_ERROR| E_PARSE);
                                $con=mysqli_connect('localhost','root','','imsfinal');
                                $cid=$_POST['cid'];
                                // echo $cid;
                                $cname=$_POST['cname'];
                                $cmno=$_POST['cmno'];
             
                                if ($_POST['cid']=='' and $_POST['cname']=='' and $_POST['cmno']=='') {
                                  $query= "SELECT * FROM tblcustomermst WHERE RecStatus=1";
                                  $run = mysqli_query($con,$query);
                                }
                                                     
                                else if($_POST['cid'] and $_POST['cname']=='' and $_POST['cmno']==''){
                                        $query= "SELECT * FROM tblcustomermst WHERE CustomerId LIKE $cid AND RecStatus=1";
                                        $run = mysqli_query($con,$query);
                                    }
                                                     
                                                     
                                    elseif($_POST['cid']=="" and $_POST['cname'] and $_POST['cmno']=='')
                                    {
                                        $query="SELECT * FROM tblcustomermst WHERE CustomerName LIKE '%$cname%' AND RecStatus=1";
                                        $run=mysqli_query($con,$query);
                                    }

                                    elseif ($_POST['cid']=='' and $_POST['cname']=='' and $_POST['cmno']) {
                                        $query="SELECT * FROM tblcustomermst WHERE MobileNo LIKE '$cmno' AND RecStatus=1";
                                        $run=mysqli_query($con,$query);                       
                                    }
                                if($run->num_rows==0){
                                      echo "<script>Swal.fire({icon: 'error', title: 'Oops...',text: 'No Data Found For This Value !!!'});</script>";

                                  }
                                  else{
                                while ($row=mysqli_fetch_array($run))
                                {
                                    $cid=$row[0];
                                    $cname=$row[1];
                                    $cmno=$row[2];
                                    $cgst=$row[5];
                                    $cemail=$row[3];
                                    $caddress=$row[4];
                                  ?>
                      </tr>
                            <td><?php echo $cid; ?></td>
                            <td><?php echo $cname; ?></td>
                            <td><?php echo $cmno; ?></td>
                            <td><?php echo $cgst; ?></td>
                            <td><?php echo $cemail; ?></td>
                            <td><?php echo $caddress; ?></td>
                            <td><a href="UpdateCustomer.php?id=<?php echo $cid; ?>"><input type="Button" value="Update" name="" class="btn btn-primary" id="btn"></a><a href="DeleteCustomer.php?id=<?php echo $cid; ?>"><input type="Button" value="Delete" name="" class="btn btn-primary" id="btn"></a></td>                  
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