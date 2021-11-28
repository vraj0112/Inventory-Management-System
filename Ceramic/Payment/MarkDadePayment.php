<!DOCTYPE html>
<html>
<head>
	<title>Mark as Dade</title>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">

</head>
<body>

</body>
</html>
<?php

include 'connection.php';
$con=mysqli_connect('localhost','root','','imsdata');

 $id1 = @$_GET['id'];
 $penPay = @$_GET['pen'];

$mark = "UPDATE tblinwardpayment SET RoundOffDade=$penPay,AmountPending = 0, ModifiedDate = NOW() WHERE PaymentID LIKE '$id1' ";

$mark=mysqli_query($con, $mark);

if($mark)
{   
	echo '<script>
setTimeout(function () { 
swal({
  title: "Payment Marked as Dade Succesfully",
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