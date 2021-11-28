<?php
  $con=mysqli_connect('localhost','root','','imsfinal');

  $update_record = @$_GET['id'];
  
$qu="SELECT PaymentDate,ChallanNo,CustomerName,TotalAmount,tblinwardpayment.AmountPending,PaymentID,tblinwardpayment.ChallanId,tblinwardpayment.InwardId,tblinwardpayment.RoundOffDade,challanmst.TotalAmount,tblinwardpayment.AmountPaid FROM ((tblinwardpayment
INNER JOIN challanmst ON tblinwardpayment.ChallanId = challanmst.ChallanId)
INNER JOIN tblcustomermst ON challanmst.CustomerId = tblcustomermst.CustomerId) where PaymentID='$update_record' and tblinwardpayment.RecStatus=1 UNION SELECT PaymentDate,tblinwardpayment.InwardId,VendorName,TotalAmount,tblinwardpayment.AmountPending,PaymentID,tblinwardpayment.ChallanId,tblinwardpayment.InwardId,tblinwardpayment.RoundOffDade,tblinwardbillmst.TotalAmount,tblinwardpayment.AmountPaid FROM ((tblinwardpayment 
INNER JOIN tblinwardbillmst ON tblinwardpayment.InwardId = tblinwardbillmst.InwardId)
INNER JOIN tblvendormst ON tblinwardbillmst.VendorId = tblvendormst.VendorId) where tblinwardpayment.RecStatus=1 and PaymentID='$update_record'";
  //$qu="SELECT * FROM tblinwardpayment WHERE PaymentID='$update_record'";
  $run1=mysqli_query($con,$qu);

  while ($row=mysqli_fetch_array($run1))
  {
     $update_id=$row['PaymentID'];
     $date=$row['PaymentDate'];
     $cname=$row['CustomerName'];
     $vname=$row['VendorName'];
     $ChallanNo=$row['ChallanNo'];
     $InwardId=$row['InwardId'];
     $penPayment=$row['AmountPending'];
     $AmountPaid=$row['AmountPaid'];
     $totalPayment=$row['TotalAmount'];
     $RoundOffDade=$row['RoundOffDade'];
     
  }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

          <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <style>
        /* for removing arrow buttons in muber type field. */
        input[type=number] {
            -moz-appearance: textfield;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .txt-box {
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <div class="container-fluid col-lg-12">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header" style="background-color: #2B60DE">
                        <h3 class="card-title" style="color: white" align="center">Update Payment</h3>
                    </div>
                    <div class="card-body">
                        <form class="row g-3" id="radio-buttons" action="UpdatePayment.php?update_form=<?php echo $update_id; ?>" method="post">
                            <div class="form-group col-md-12">
                                <div class="row mt-3">
                                    <div class="col-md-4 form-group">
                                        <Label class="form-label">Date of Payment:</Label>
                                        <input type="date" value="<?php echo $date;?>" name="date" class="form-control" id="date-input">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-4 form-group">
                                        <Label class="form-label">Customer Name/Vendor Name :</Label>
                                        <?php echo ($cname==""?$vname:$cname);?>
                                    </div>
                                </div>
                                 <div class="row mt-3">
                                    <div class="col-md-4 form-group">
                                        <Label class="form-label">Challan No./Inward Id :</Label>
                                        <?php echo ($ChallanNo==""?$InwardId:$ChallanNo);?>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-4 form-group">
                                        <Label class="form-label">Total Amount :</Label>
                                        <?php echo $totalPayment;?>
                                        <input type="hidden" value="<?php echo $totalPayment;?>" name="total">    
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-4 form-group">
                                        <Label class="form-label">Pending Payment :</Label>
                                        <?php echo $penPayment;?>    
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-4 form-group">
                                        <Label class="form-label">Total Amount Paid :</Label>
                                        <input type="number" name="pamount" value="<?php echo $AmountPaid;?>" class="form-control" id="amt-input"
                                            placeholder="Enter Total Amount Paid...">
                                    </div>
                                </div>
                                 <div class="row mt-3">
                                    <div class="col-md-4 form-group">
                                        <Label class="form-label">Round Off :</Label>
                                        <input type="number" name="ramount" value="<?php echo $RoundOffDade;?>" class="form-control" id="amt-input"
                                            placeholder="Enter Round Off...">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2 mt-4">
                                        <input type="submit" value="Save" name="update" id="update" class="btn btn-primary"><input type="button" value="Close"  name="close" id="close" class="btn btn-success" onclick="location.href = 'ManagePayment.php';">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<?php

  include 'connection.php';
  error_reporting(E_ERROR | E_WARNING);


  if(isset($_POST['update'])){

  $id1=$_GET['update_form'];
  // $id1=$_POST['cid'];  
  $date=$_POST['date'];
  $pamount=$_POST['pamount'];
  $ramount=$_POST['ramount'];
  $totalPayment=$_POST['total'];
  
    $q="UPDATE tblinwardpayment SET AmountPaid ='$pamount',  PaymentDate = '$date',RoundOffDade = '$ramount', AmountPending ='$totalPayment'-'$pamount' - '$ramount',  ModifiedDate = NOW() WHERE PaymentID = '$id1'";

     echo $q;


  $update = mysqli_query($con,$q);
     
 if($update)
 {
  echo '<script>
setTimeout(function () { 
swal({
  title: "Payment updated Succesfully",
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
  else{
    echo "not updated";
  }

 
 }

?>