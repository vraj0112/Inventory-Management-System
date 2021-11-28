<!DOCTYPE html>
<html>
<head>
	<title>Delete</title>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">

</head>
<body>

</body>
</html>
<?php

include 'connection.php';
$con=mysqli_connect('localhost','root','','imsfinal');

$id = @$_GET['id'];

$delete = "UPDATE tblinwardpayment SET RecStatus = 0, ModifiedDate = NOW() WHERE PaymentID LIKE $id ";

$del=mysqli_query($con, $delete);

if($del)
{   
	echo '<script>
setTimeout(function () { 
swal({
  title: "Payment Deleted Succesfully",
  text: "",
  type: "success",
  confirmButtonText: "OK"
},
function(isConfirm){
  if (isConfirm) {
    window.location.href = "ManagePayment.php";
  }
}); }, 1);
</script>';
    // echo "<script>window.open('ManageExpence.php','_self')</script>";
  
}

?>