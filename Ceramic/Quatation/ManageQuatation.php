<!DOCTYPE html>
<html>
   <head>
      <title>Search and Manage Quatation</title>
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
               if (radio.id === "vendor"){
                     document.getElementById("hsnc").innerHTML = "<input type='text' name='vid' class='form-control' id='vid' placeholder='Enter Quatation Id.'>";
                  }

               else if (radio.id === "vendorName"){
                     document.getElementById("hsnc").innerHTML = "<input type='text' name='vname' class='form-control' id='vname' placeholder='Enter Customer Name'>";
                  }
               else if (radio.id === "vmobileno"){
                     document.getElementById("hsnc").innerHTML = "FROM : <input type='date' name='vmno1' class='form-group col-md-4' id='vmno1'> TO : <input type='date' name='vmno2' class='form-group col-md-4' id='vmno2'>";
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
                  <h3 class="card-title" style="color: white" align="center">Search and Manage Quatation</h3>
               </div>
               <div class="card-body">
                  <form class="row g-3" id="radio-buttons" method="POST" action="ManageQuatation.php">
                     <div class="form-group col-md-12">
                        <label class="form-label">Search By: </label>
                        <div class="form-check form-check-inline">
                           <input class="form-check-input" type="radio" name="mc" id="vendor" value="vendor" onchange="checkRadio(this)">
                           <label class="form-check-label" for="inlineRadio1">Quatation Id. </label>
                        </div>
                        <div class="form-check form-check-inline">
                           <input class="form-check-input" type="radio" name="mc" id="vendorName" value="vendorName" onchange="checkRadio(this)">
                           <label class="form-check-label" for="inlineRadio2">Customer Name</label>
                        </div>
                        <div class="form-check form-check-inline">
                           <input class="form-check-input" type="radio" name="mc" id="vmobileno" value="mobileno" onchange="checkRadio(this)">
                           <label class="form-check-label" for="inlineRadio3"> Date </label>
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
                           <th>Quatation ID.</th>
                           <th>Customer Name</th>
                           <th>Quatation Date</th>
                           <th>Total Amount</th>
<!--                            <th>Email Id.</th>
                           <th>Addresss</th> -->
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                      <?php
                                error_reporting(E_ERROR  | E_PARSE);
                                $con=mysqli_connect('localhost','root','','imsfinal');
                                $vid=$_POST['vid'];
                                // echo $cid;
                                $vname=$_POST['vname'];
                                $vmno1=$_POST['vmno1'];
                                $vmno2=$_POST['vmno2'];
             
                                if ($_POST['vid']=='' and $_POST['vname']=='' and $_POST['vmno1']=='' and $_POST['vmno2']==''){
                                  $query= "SELECT * FROM tblqutationmst WHERE RecStatus=1";
                                  $run = mysqli_query($con,$query);
                                }
                                                     
                                else if($_POST['vid'] and $_POST['vname']=='' and $_POST['vmno1']=='' and $_POST['vmno2']==''){
                                        $query= "SELECT * FROM tblqutationmst WHERE QutationId LIKE $vid AND RecStatus=1";
                                        $run = mysqli_query($con,$query);
                                        
                                    }
                                                     
                                                     
                                elseif($_POST['vid']=="" and $_POST['vname'] and $_POST['vmno1']=='' and $_POST['vmno2']=='')
                                    {
                                        $query="SELECT * FROM tblqutationmst WHERE Name LIKE '%$vname%' ANd RecStatus=1";
                                        $run=mysqli_query($con,$query);
                                        

                                    }

                                elseif ($_POST['vid']=='' and $_POST['vname']=='' and $_POST['vmno1'] and $_POST['vmno2']=='') {
                                        $query="SELECT * FROM tblqutationmst WHERE QDate LIKE '$vmno1' AND RecStatus=1";
                                        $run=mysqli_query($con,$query);
                                        
                                                               
                                    }
                                elseif ($_POST['vid']=='' and $_POST['vname']=='' and $_POST['vmno1'] and $_POST['vmno2']) {
                                        $query="SELECT * FROM tblqutationmst WHERE QDate BETWEEN '$vmno1' AND '$vmno2' AND RecStatus=1";
                                        $run=mysqli_query($con,$query);
                                                               
                                    }

                              if($run->num_rows==0){
                                      echo "<script>Swal.fire({icon: 'error', title: 'Oops...',text: 'No Data Found For This Value !!!'});</script>";

                                  }
                              else{
                                
                              
                                while ($row=mysqli_fetch_array($run))
                                {
                                    $qid=$row[0];
                                    $qname=$row[1];
                                    $qdate=$row[2];
                                    $qamount=$row[5];
                                    // $vemail=$row[3];
                                    // $vaddress=$row[4];
                                  ?>
                      </tr>
                            <td><?php echo $qid; ?></td>
                            <td><?php echo $qname; ?></td>
                            <td><?php echo $qdate; ?></td>
                            <td><?php echo $qamount ?></td>
<!--                             <td><?php echo $vemail; ?></td>
                            <td><?php echo $vaddress; ?></td> -->
                            <td><a href="UpdateQuatation.php?id=<?php echo $qid; ?>"><input type="Button" value="Update" name="" class="btn btn-primary" id="btn"></a><a href="DeleteQuatation.php?id=<?php echo $qid; ?>"><input type="Button" value="Delete" name="" class="btn btn-primary" id="btn"></a><a href="makepdf2.php?id=<?php echo $qid; ?>"><button class='btn btn-success'> PDF </button></a></td>                  
                        </tr>
                                              <?php } }?>
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