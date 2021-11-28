<?php
include ("connection.php");
?>
<html>
<head>
	<title>New Customer</title>
	<style type="text/css">
         .grid1{
            display: grid;
            width: '100%';
            grid-template-columns: '50px 1fr';
         }
      </style>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
      <script src="https://code.jquery.com/jquery-1.12.4.js"></script>

      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
      <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>

      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
</head>
<body>
   <?php 
   include('connection.php');

   $sql = "SELECT max(CustomerId) FROM TblCustomerMst";
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
                     <h3 class="card-title" style="color: white" align="center">New Customer</h3>
                  </div>
                  <div class="card-body">
                     <form class="" action="NewCustomer.php" method="post">
                      
                        <div class="form-group col-md-6">
                           <label class="form-label">Customer Id: </label>
                           <input type="Number" name="cid" id="cid" value="<?php echo (isset($new))?$new:'';?>" class="form-control"  disabled=""> 
                        </div>

                        <div class="form-group col-md-6">
                           <label class="form-label">Customer Name<span style="color: red">*</span> : </label>
                           <input type="text" name="cname" class="form-control" id="cname" placeholder="Enter Your Name" required="" pattern="[A-Za-z\s]+" title="Only Contains Character"> 
                        </div>

                        <div class="form-group col-md-6">
                           <label class="form-label">Mobile No.<span style="color: red">*</span> : </label>
                           <input type="text" name="cmno" class="form-control" id="cmno" pattern="[0-9]{10}" maxlength="10" placeholder="99XXXXXXXX" required="" title="Only Contains Numbers"> 
                        </div>

                        <div class="form-group col-md-6">
                           <label class="form-label">GST No.: </label>
                           <input type="text" name="cgst" class="form-control" id="cgst" pattern="\d{2}[A-Z]{5}\d{4}[A-Z]{1}[A-Z\d]{1}[Z]{1}[A-Z\d]{1}" maxlength="15" placeholder="Enter GST Number"> 
                        </div>

                        <div class="form-group col-md-6">
                           <label class="form-label">Email Id: </label>
                           <input type="email" name="cemail" class="form-control" id="cemail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" placeholder="example@gmail.com"> 
                        </div>

                        <div class="form-group col-md-6">
                           <label class="form-label">Address: </label>
                           <textarea class="form-control" rows="5" id="caddress" name="caddress" required=""></textarea> 
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
   
         // $cid=$_POST['cid'];
         $name=ucwords(strtolower($_POST['cname']));
         $temp = trim(preg_replace('/\s+/',' ', $name));
         $cmno=$_POST['cmno'];
         $cgst=strtoupper($_POST['cgst']);
         $cemail=strtolower($_POST['cemail']);
         $caddress=$_POST["caddress"]; 


         $myque = "SELECT CustomerId FROM tblcustomermst WHERE CustomerName LIKE '$temp' AND MobileNo LIKE '$cmno' AND GSTNo LIKE '$cgst' AND Email Like '$cemail'";

         // echo "$myque";

         $myque2 = mysqli_query($conn,$myque);

         $row = mysqli_fetch_row($myque2);
         $myque3=$row[0];
         // echo "$myque3";

         
         // console.log($myque6);



         // var myno = $myque3;


         if ($temp=='' || $cmno=='') {
            echo "<script>alert('please fill required field');<script>";
         }

         // elseif ($myque6 == 0) {
         //    $myque7 = "UPDATE btblcustomermst SET RecStatus=1 WHERE CustomerId=$myque3";
         //    $query=mysqli_query($conn,$myque7);
         //    echo "<meta http-equiv='refresh' content='0'>";
         // }    

         elseif ($myque3 != 0){
            $myque4 = "SELECT RecStatus FROM tblcustomermst WHERE CustomerId=$myque3";
            $myque5 = mysqli_query($conn,$myque4);
            $row = mysqli_fetch_row($myque5);
            $myque6=$row[0];
            if ($myque6==0) {
               $myque7 = "UPDATE tblcustomermst SET RecStatus=1 WHERE CustomerId=$myque3";
               $query=mysqli_query($conn,$myque7);
               echo '<script>swal("Customer Exiest & Activated Succesfully","@ Customer ID =  '.$myque3.'")</script>';

               // echo '<script>alert("Customer Activated @ Customer ID =  '.$myque3.'")</script>';
               // echo "<meta http-equiv='refresh' content='0'>";
               # code...
            }
            else{
                              echo '<script>swal("Customer Aulready Exiest","@ Customer ID =  '.$myque3.'")</script>';
                              
            }
         } 
         // setTimeout(function () { 
         //             swal({
         //                title: "Customer Activated Succesfully",
         //                text: "@ CustomerId = '.$myque3.'",
         //                type: "success",
         //                confirmButtonText: "OK"
         //             },
         //             function(isConfirm){
         //                if (isConfirm) {
         //                   window.location.href = "NewCustomer.php";
         //                }  
         //          }); }, 1);

         else{
            $que = "INSERT INTO tblcustomermst (CustomerName,MobileNo,Email,GSTNo,Address,CreatedDate,ModifiedDate,RecStatus) VALUES('$temp','$cmno','$cemail','$cgst','$caddress',NOW(),NOW(),1)";

            $query=mysqli_query($conn,$que);

            // echo "<meta http-equiv='refresh' content='0'>";

            echo '<script>
setTimeout(function () { 
swal({
  title: "Customer Added Succesfully",
  text: "",
  type: "success",
  confirmButtonText: "OK"
},
function(isConfirm){
  if (isConfirm) {
    window.location.href = "NewCustomer.php";
  }
}); }, 1);
            </script>';

            // echo '<script>swal.fire("Customer Added Succesfully","","success")</script>';

            // echo '<script>window.location.href = "NewCustomer.php"</script>';

            
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