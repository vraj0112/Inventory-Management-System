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

$id = $_GET['id'];

$delete = "UPDATE tblinwardbillmst SET RecStatus = 0, ModifiedDate = NOW() WHERE InwardId=$id ";
$deletep = "UPDATE tblinwardpayment SET RecStatus = 0, ModifiedDate = NOW() WHERE InwardId=$id ";
//echo $delete;
$del1=mysqli_query($conn, $delete) or die("wrong query for payment");
$delpay = mysqli_query($conn, $deletep) or die("asdf");
$delstock = "DELETE from stockdetails WHERE InwardId='$id'";
$del2=mysqli_query($conn, $delstock);
$delinwarditem = "UPDATE tblinwarddetails set RecStatus = 0 WHERE InwardId = $id";
$del3 = mysqli_query($conn,$delinwarditem);
if($del1)
{   
	echo '<script>
setTimeout(function () { 
swal({
  title: "Inward Deleted Succesfully",
  text: "",
  type: "success",
  confirmButtonText: "OK"
},
function(isConfirm){
  if (isConfirm) {
    window.location.href = "s&minward.php";
  }
}); }, 1);
</script>';
    // echo "<script>window.open('s&minward.php','_self')</script>";
  
}
?>