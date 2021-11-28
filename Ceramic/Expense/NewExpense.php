<?php
include ("connection.php");
    $month = date('m');
    $day = date('d');
    $year = date('Y');

    $today = $year . '-' . $month . '-' . $day;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Expense</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>

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
                        <h3 class="card-title" style="color: white" align="center">New Expense</h3>
                    </div>
                    <div class="card-body">
                        <form class="row g-3" id="radio-buttons" method="POST" action="NewExpense.php">
                            <div class="form-group col-md-12">
                                <div class="row mt-3">
                                    <div class="col-md-4 form-group">
                                        <Label class="form-label">Date of Expense:</Label>
                                        <input type="date" name="edate" value="<?php echo $today; ?>" class="form-control" id="date-input">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-4 form-group">
                                        <Label class="form-label">Amount :</Label>
                                        <input type="number" name="eamount" class="form-control" id="amt-input"
                                            placeholder="Enter Amount...">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-4 form-group">
                                        <Label class="form-label">Description :</Label>
                                        <textarea class="form-control" name="edis" id="exampleFormControlTextarea1" rows="3"
                                            placeholder="Enter Description of entered Amount for Expense..."></textarea>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2 mt-4">
                                        <input style="margin-right: 5px;" type="Submit" value="Save" id="Save" name="submit" 
                                            class="btn btn-success">
                                        <input style="margin-right: 5px;" type="button" value="Close"  name="close" id="close" class="btn btn-success" onclick="location.href = '../admin.php';">
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


if(isset($_POST['submit'])){
   
         // $cid=$_POST['cid'];
         $date=$_POST['edate'];
         $amount=$_POST['eamount'];
         $dis=$_POST['edis'];
         // $cemail=$_POST['cemail'];
         // $caddress=$_POST["caddress"]; 


         // $myque = "SELECT CustomerId FROM tblcustomermst WHERE CustomerName LIKE '$name' AND MobileNo LIKE '$cmno' AND GSTNo LIKE '$cgst' AND Email LIKE '$cemail' AND Address LIKE '$caddress'";

         // $myque2 = mysqli_query($conn,$myque);

         // $row = mysqli_fetch_row($myque2);
         // $myque3=$row[0];


         if ($date=='' || $amount=='' || $dis=='') {
            echo "<script>alert('please fill all field');<script>";
         }    

         // elseif ($myque3 != 0){
         //    echo '<script>alert("Customer Aulready Exiest")</script>';
         // } 

         else{
            $que = "INSERT INTO tblexpencemst (Discription, ExpanceDate, Amount, CreatedDate, ModifiedDate, RecStatus) VALUES('$dis','$date','$amount',NOW(),NOW(),1)";

            $query=mysqli_query($conn,$que);

            //echo "<meta http-equiv='refresh' content='0'>";
            echo '<script>
setTimeout(function () { 
swal({
  title: "Expense Added Succesfully",
  text: "",
  type: "success",
  confirmButtonText: "OK"
},
function(isConfirm){
  if (isConfirm) {
    window.location.href = "NewExpense.php";
  }
}); }, 1);
            </script>';

            
            // if($query)
            // {  

            //    $reg="SELECT u_id FROM u_reg WHERE u_name LIKE '$name'and u_email LIKE '$email'and u_contact LIKE '$contact'and u_degree LIKE '$degree'and u_college LIKE '$collage' and u_dur LIKE '$dur' and u_tech LIKE '$tech' and u_guide LIKE '$guide' and u_jdate LIKE '$date' and u_NOC LIKE '$noc'  ";

            //    $query1=mysqli_query($conn,$reg);

            //    while($run=mysqli_fetch_array($query1))
            //    {
            //       $u_id=$run[0];


            //       echo "<script>window.alert('Registration no is: $u_id')</script>";
            //    }

            // }
            // else{
            //    echo "Registration Failed";
            // }
         }
      
  
   }
?> 