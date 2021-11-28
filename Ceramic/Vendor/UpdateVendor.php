<?php
  $conn2=mysqli_connect('localhost','root','','imsfinal');

  $update_record = @$_GET['id'];
  

  $qu="SELECT * FROM tblvendormst WHERE VendorId='$update_record'";
  $run1=mysqli_query($conn2,$qu);

  while ($row=mysqli_fetch_array($run1))
  {
     $update_id=$row[0];
     $CustomerName=$row[1];
     $MobileNo=$row[2];
     $Email=$row[3];
     $Address=$row[4];
     $gst=$row[5];
     
  }

?>
<!DOCTYPE html>
<html>
<head>
	<title>Update Vendor</title>
	<style type="text/css">
         .grid1{
            display: grid;
            width: '100%';
            grid-template-columns: '50px 1fr';
         }
      </style>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
      <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
</head>
<body>
      <div class="container-fluid col-lg-12">
         <div class="row">
            <div class="col-md-12">
               <div class="card card-primary">
                  <div class="card-header" style="background-color: #2B60DE">
                     <h3 class="card-title" style="color: white" align="center">Update Vendor</h3>
                  </div>
                  <div class="card-body">
                     <form class="" action="UpdateVendor.php?update_form=<?php echo $update_id; ?>" method="post">
                      
                        <div class="form-group col-md-6">
                           <label class="form-label">Vendor Id: </label>
                           <input type="number" name="vid" class="form-control" id="vid" value="<?php echo $update_id;?>" disabled=""> 
                        </div>

                        <div class="form-group col-md-6">
                           <label class="form-label">Vendor Name: </label>
                           <input type="text" name="vname" class="form-control" id="vname" value="<?php echo $CustomerName;?>" placeholder="Enter Your Name" required="" pattern="[A-Za-z\s]+" title="Only Contains Character"> 
                        </div>

                        <div class="form-group col-md-6">
                           <label class="form-label">Mobile No.: </label>
                           <input type="text" name="vmno" class="form-control" id="vmno" value="<?php echo $MobileNo;?>" pattern="[0-9]{10}" maxlength="10" placeholder="99XXXXXXXX" required="" title="Only Contains Numbers"> 
                        </div>

                        <div class="form-group col-md-6">
                           <label class="form-label">GST No.: </label>
                           <input type="text" name="vgst" class="form-control" id="vgst" value="<?php echo $gst;?>" pattern="\d{2}[A-Z]{5}\d{4}[A-Z]{1}[A-Z\d]{1}[Z]{1}[A-Z\d]{1}" placeholder="Enter GST Number"> 
                        </div>
                        

                        <div class="form-group col-md-6">
                           <label class="form-label">Email Id: </label>
                           <input type="email" name="vemail" class="form-control" id="vemail" value="<?php echo $Email;?>" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" placeholder="example@gmail.com" required=""> 
                        </div>

                        <div class="form-group col-md-6">
                           <label class="form-label">Address: </label>
                           <textarea class="form-control" rows="5" id="vaddress" name="vaddress" required=""><?php echo $Address;?></textarea> 
                        </div>
<br>
                        <div class="col-12">
                           <input type="submit" value="Save" name="update" id="update" class="btn btn-primary">
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

  include 'connection.php';


  if(isset($_POST['update'])){

  $id1=$_GET['update_form'];
  // $id1=$_POST['cid'];  
  $name1=ucwords(strtolower($_POST['vname']));
  $temp1 = trim(preg_replace('/\s+/',' ', $name1));
  $mobile1=$_POST['vmno'];
  $email1=strtolower($_POST['vemail']);
  $caddress1=$_POST['vaddress'];
  $cgst1=strtoupper($_POST['vgst']);
    // echo $id1;
    // echo "Hello ";

    $q="UPDATE tblvendormst SET VendorName = '$temp1',  MobileNo = '$mobile1', Email = '$email1' , Address ='$caddress1', GSTNo ='$cgst1', ModifiedDate = NOW() WHERE VendorId = '$id1'";


  $update = mysqli_query($conn,$q);
     
 if($update)
 {

  echo '<script>
setTimeout(function () { 
swal({
  title: "Vendor updated Succesfully",
  text: "",
  type: "success",
  confirmButtonText: "OK"
},
function(isConfirm){
  if (isConfirm) {
    window.location.href = "ManageVendor.php";
  }
}); }, 1);
</script>';
  // echo "<script>Swal.fire('Vendor Updated Succesfully', '', 'success')</script>";
  
 }
  else{
    echo "not updated";
  }



  //header("Refresh:0; url=ManageVendor.php.php");


 //echo "<script>window.open('ManageVendor.php','_self')</script>"; 
 }


?>