<?php
  $conn2=mysqli_connect('localhost','root','','imsfinal');

  $update_record = @$_GET['id'];
  

  $qu="SELECT * FROM tblexpencemst WHERE ExpanceId='$update_record'";
  $run1=mysqli_query($conn2,$qu);

  while ($row=mysqli_fetch_array($run1))
  {
     $update_id=$row[0];
     $dis=$row[1];
     $date=$row[2];
     $amount=$row[3];
     
  }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Expense</title>
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
                        <h3 class="card-title" style="color: white" align="center">Update Expense</h3>
                    </div>
                    <div class="card-body">
                        <form class="row g-3" id="radio-buttons" action="UpdateExpense.php?update_form=<?php echo $update_id; ?>" method="post">
                            <div class="form-group col-md-12">
                                <div class="row mt-3">
                                    <div class="col-md-4 form-group">
                                        <Label class="form-label">Date of Expense:</Label>
                                        <input type="date" value="<?php echo $date;?>" name="edate" class="form-control" id="date-input">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-4 form-group">
                                        <Label class="form-label">Amount :</Label>
                                        <input type="number" name="eamount" value="<?php echo $amount;?>" class="form-control" id="amt-input"
                                            placeholder="Enter Amount...">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-4 form-group">
                                        <Label class="form-label">Description :</Label>
                                        <textarea class="form-control" name="edis" value="<?php echo $dis;?>" id="exampleFormControlTextarea1" rows="3"
                                            placeholder="Enter Description of entered Amount for Expense..."><?php echo $dis;?></textarea>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2 mt-4">
                                        <input type="submit" value="Save" name="update" id="update" class="btn btn-primary">
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


  if(isset($_POST['update'])){

  $id1=$_GET['update_form'];
  // $id1=$_POST['cid'];  
  $date_1=$_POST['edate'];
  $amount_1=$_POST['eamount'];
  $dis_1=$_POST['edis'];
  
    $q="UPDATE tblexpencemst SET Discription = '$dis_1',  ExpanceDate = '$date_1', Amount = '$amount_1',  ModifiedDate = NOW() WHERE ExpanceId = '$id1'";

    // echo $q;


  $update = mysqli_query($conn,$q);
     
 if($update)
 {
  echo '<script>
setTimeout(function () { 
swal({
  title: "Expense updated Succesfully",
  text: "",
  type: "success",
  confirmButtonText: "OK"
},
function(isConfirm){
  if (isConfirm) {
    window.location.href = "ManageExpense.php";
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