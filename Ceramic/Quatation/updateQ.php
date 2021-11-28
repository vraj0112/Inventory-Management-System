<!DOCTYPE html>
<html>
<head>
    <title>Update</title>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">

</head>
<body>

</body>
</html>
<?php 
include 'connection.php';
if(isset($_POST['submit'])){
    $qdis = $_POST['qdis'];
    $qqty = $_POST['qqty'];
    $qrate = $_POST['qrate'];
    $qgstd = $_POST['qgstd'];
    $qgstamt = $_POST['qgstamt'];
    $qamt = $_POST['qamt'];
    $qx = $_POST['qx'];
    $qx--;
    $q_id = @$_GET['id'];


    $ttgst = $_POST['ttgst'];
    $ttprice = $_POST['ttprice'];
    $ttamount = $_POST['ttamount'];


    $q = "UPDATE tblqutationdetails SET Discription = '$qdis', Qty = $qqty, Rate = $qrate, Gst = $qgstd,  ModifiedDate = NOW() WHERE QutationId=$q_id AND ItemNo=$qx";
    $update = mysqli_query($conn,$q);

    $q2 = "UPDATE tblqutationmst SET TotalPrice = $ttprice, TotalGST =$ttgst, TotalAmount=$ttamount, ModifiedDate = NOW() WHERE QutationId=$q_id";
    $run = mysqli_query($conn,$q2); 



    echo "$q";
    echo " $q2 ";

    if($update AND $run)
    {
        echo '<script>
setTimeout(function () { 
swal({
  title: "Qutation updated Succesfully",
  text: "",
  type: "success",
  confirmButtonText: "OK"
},
function(isConfirm){
  if (isConfirm) {
    window.location.href = "ManageQuatation.php";
  }
}); }, 1);
</script>';
        // echo "<script>window.open('ManageQuatation.php','_self')</script>";
  
    }
    else{
        echo "not updated";
    }

    }

?>