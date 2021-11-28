<?php
include ("connection.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>New Vendor</title>
	<style type="text/css">
         .grid1{
            display: grid;
            width: '100%';
            grid-template-columns: '50px 1fr';
         }
      </style>
      <link href="bootstrap.min.css" rel="stylesheet">
      <script src="jquery-1.12.4.js"></script>

      <script src="sweetalert2.all.min.js"></script>
      <link rel='stylesheet' href='sweetalert2.min.css'>
      <link rel="stylesheet" href="sweetalert2_1.min.css">
      <script src="sweetalert2_1.all.min.js"></script>

      <script src="sweetalert-dev.js"></script>
      <link rel="stylesheet" href="sweetalert.css">
</head>
<body>
   <?php 
   include('connection.php');

   $sql = "SELECT max(VendorId) FROM TblVendorMst";
   $result = $conn->query($sql);
   while ($row = $result->fetch_assoc()) {
    $new = end($row)+1;
   }
    ?>
      <div class="container-fluid col-lg-12">
         <div class="row">
            <div class="col-md-12">
               <div class="card card-primary">
                  <div class="card-header" style="background-color: #2B60DE">

                     <h3 class="card-title" style="color: white" align="center">New Vendor</h3>
                  </div>
                  <div class="card-body">
                     <form class="" action="NewVendor.php" method="post">
                      
                        <div class="form-group col-md-6">
                           <label class="form-label">Vendor Id: </label>
                           <input type="number" name="vid" class="form-control" id="vid" value="<?php echo (isset($new))?$new:'';?>" disabled=""> 
                        </div>

                        <div class="form-group col-md-6">
                           <label class="form-label">Vendor Name<span style="color: red">*</span> : </label>
                           <input type="text" name="vname" class="form-control" id="vname" placeholder="Enter Your Name" required="" pattern="[A-Za-z\s]+" title="Only Contains Character"> 
                        </div>

                        <div class="form-group col-md-6">
                           <label class="form-label">Mobile No.<span style="color: red">*</span> : </label>
                           <input type="text" name="vmno" class="form-control" id="vmno" pattern="[0-9]{10}" maxlength="10" placeholder="99XXXXXXXX" required="" title="Only Contains Numbers"> 
                        </div>

                        <div class="form-group col-md-6">
                           <label class="form-label">GST No.: </label>
                           <input type="text" name="vgst" class="form-control" id="vgst" pattern="\d{2}[A-Z]{5}\d{4}[A-Z]{1}[A-Z\d]{1}[Z]{1}[A-Z\d]{1}" maxlength="15" placeholder="Enter GST Number"> 
                        </div>
                        

                        <div class="form-group col-md-6">
                           <label class="form-label">Email Id: </label>
                           <input type="email" name="vemail" class="form-control" id="vemail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" placeholder="example@gmail.com"> 
                        </div>

                        <div class="form-group col-md-6">
                           <label class="form-label">Address: </label>
                           <textarea class="form-control" rows="5" id="vaddress" name="vaddress"></textarea> 
                        </div>
<br>
                        <div class="col-12">
                           <input type="submit" value="Save" name="submit" id="submit" class="btn btn-primary">
                           <input type="button" value="Close"  name="close" id="close" class="btn btn-primary" onclick="location.href = '../admin.php';">
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
</body>
</html>
<?php

if(isset($_POST['submit'])){

  error_reporting(E_ERROR | E_PARSE);
   
         $name=ucwords(strtolower($_POST['vname']));
         $temp = trim(preg_replace('/\s+/',' ', $name));
         $vmno=$_POST['vmno'];
         $vgst=strtoupper($_POST['vgst']);
         $vemail=strtolower($_POST['vemail']);
         $vaddress=$_POST["vaddress"]; 

         $myque = "SELECT VendorId FROM tblvendormst WHERE VendorName = '$name' AND MobileNo = '$vmno' AND GSTNo = '$vgst' AND Email = '$vemail'";

         $myque2 = mysqli_query($conn,$myque);
         $row = mysqli_fetch_row($myque2);
         $myque3=$row[0];

         if ($name=='' || $vmno=='') {
            echo "<script>Swal.fire('please fill all required field');<script>";
         }

         elseif ($myque3 != 0){
            $myque4 = "SELECT RecStatus FROM tblvendormst WHERE VendorId=$myque3";
            $myque5 = mysqli_query($conn,$myque4);
            $row = mysqli_fetch_row($myque5);
            $myque6=$row[0];
            if ($myque6==0) {
              $myque7 = "UPDATE tblvendormst SET RecStatus=1 WHERE VendorId=$myque3";
              $query=mysqli_query($conn,$myque7);
              echo '<script>swal("Vendor Exiest & Activated Succesfully","@ Vendor ID =  '.$myque3.'")</script>';
            }
            else{
              echo '<script>swal("Vendor Aulready Exiest","@ Vendor ID =  '.$myque3.'")</script>';
            }
         }


              

         else{
            $que = "INSERT INTO tblvendormst (VendorName,MobileNo,Email,GSTNo,Address,CreatedDate,ModifiedDate,RecStatus) VALUES('$name','$vmno','$vemail','$vgst','$vaddress',NOW(),NOW(),1)";


            $query=mysqli_query($conn,$que);

            echo '<script>
setTimeout(function () { 
swal({
  title: "Vendor Added Succesfully",
  text: "",
  type: "success",
  confirmButtonText: "OK"
},
function(isConfirm){
  if (isConfirm) {
    window.location.href = "NewVendor.php";
  }
}); }, 1);
</script>';

                       

         }
          // echo "<meta http-equiv='refresh' content='0'>";
      }
      
 
?> 