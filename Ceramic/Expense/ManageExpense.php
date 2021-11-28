<!DOCTYPE html>
<html>
   <head>
      <title>Search and Manage Expense</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
      <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
      <link rel="stylesheet" href="chosen/chosen.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="chosen/chosen.jquery.js" type="text/javascript"></script>

      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
      <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
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
      <script>
         function checkRadio(radio){
               // if (radio.id === "expenid"){
               //       document.getElementById("date-input").style.display="none";
               //       document.getElementById("desc").style.display="none";
               //      // document.getElementById("exid").style.display="block";
               //       document.getElementById("examt").style.display="none";
               // }
              if (radio.id === "expendis"){
                document.getElementById("hsnc").innerHTML = "<input type='text' class='form-control col-md-12' name='edis' id='desc' placeholder='Enter Description to Search...''>"
                    //  document.getElementById("date-input").style.display="none";
                    //  document.getElementById("desc").style.display="block";
                    // // document.getElementById("exid").style.display="none";
                    //  document.getElementById("examt").style.display="none";
               }
               else if (radio.id === "expenamount"){
                document.getElementById("hsnc").innerHTML = "<input type='number' class='form-control col-md-12' name='eamt' id='examt' placeholder='Enter Amount to Search...''>"
                    //  document.getElementById("date-input").style.display="none";
                    //  document.getElementById("desc").style.display="none";
                    // // document.getElementById("exid").style.display="none";
                    //  document.getElementById("examt").style.display="block";
               }
               else if (radio.id === "expendate"){
                document.getElementById("hsnc").innerHTML = "FROM : <input type='date' name='edate1' class='form-group col-md-4' id='edate1'> TO : <input type='date' name='edate2' class='form-group col-md-4' id='edate2'>";
                    // document.getElementById("date-input1").style.display="block";
                    // document.getElementById("date-input2").style.display="block";
                    // document.getElementById("date-input3").style.display="block";
                    // document.getElementById("date-input4").style.display="block";
                    // document.getElementById("desc").style.display="none";
                    // document.getElementById("exid").style.display="none";
                    // document.getElementById("examt").style.display="none";
               }
         }
      </script>
   </head>
   <body>
      <div class="container-fluid col-lg-12">
       <div class="row">
         <div class="col-md-12">
            <div class="card card-primary">
               <div class="card-header" style="background-color: #2B60DE">
                  <h3 class="card-title" style="color: white" align="center">Search and Manage Expense</h3>
               </div>
               <div class="card-body">
                  <form class="row g-3" id="radio-buttons" action="ManageExpense.php" method="post">
                     <div class="form-group col-md-12">
                        <label class="form-label">Search By: </label>
<!-- 
                        <div class="form-check form-check-inline">
                           <input class="form-check-input" type="radio" name="date" id="expenid" value="eid" onchange="checkRadio(this)">
                           <label class="form-check-label" for="inlineRadio2">ExpenceID</label>
                        </div> -->
                        <div class="form-check form-check-inline">
                           <input class="form-check-input" type="radio" name="date" id="expendate" value="edate" onchange="checkRadio(this)">
                           <label class="form-check-label" for="inlineRadio1">Date</label>
                        </div>
                        <div class="form-check form-check-inline">
                           <input class="form-check-input" type="radio" name="date" id="expendis" value="edis" onchange="checkRadio(this)">
                           <label class="form-check-label" for="inlineRadio2">Description</label>
                        </div>
                        <div class="form-check form-check-inline">
                           <input class="form-check-input" type="radio" name="date" id="expenamount" value="eamount" onchange="checkRadio(this)">
                           <label class="form-check-label" for="inlineRadio2">Amount</label>
                        </div>
                        <div class="form-group col-md-6" id="hsnc">
                        </div>
<!--                         <div id="fields">
                           <div class="form-group col-md-4">
                            <label id="date-input1" style="display: none;">From</label><input type="date" class="form-control col-md-12" name="edate" id="date-input2" style="display: none;"><label id="date-input3" style="display: none">To</label><input type="date" class="form-control col-md-12" name="edate" id="date-input4" style="display: none;">
                             <input type="text" class="form-control col-md-12" name="edis" id="desc" style="display: none;" placeholder="Enter Description to Search...">
                             <input type="number" class="form-control col-md-12" name="eid" id="exid" style="display: none;" placeholder="Enter Expence ID to Search...">
                              <input type="number" class="form-control col-md-12" name="eamt" id="examt" style="display: none;" placeholder="Enter Expence Amount to Search...">
                           </div> -->
                        </div>
                        <div>
                          <input type="submit" value="Search" name="submit" id="search" class="btn btn-success" style="margin-top: 10px;">
                          <input type="button" value="Close"  name="close" id="close" class="btn btn-success" onclick="location.href = '../admin.php';" style="margin-top: 10px;">
                        </div>
                     </form>
                    </div>
               </div>
            </div>
         </div>
         <br>
         <div class="row">
            <div class="col-md-12">
               <div class="card card-primary">
                  <table class="table" id="data_table">
                     <thead>
                        <tr>
                           <th>Expence Id.</th>
                           <th>Date</th>
                           <th>Discription</th>
                           <th>Amount</th>
                           <th>Action</th>                           
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <?php
                                error_reporting(E_ERROR | E_PARSE);
                                $con=mysqli_connect('localhost','root','','imsfinal');
//                                $eid=$_POST['eid'];
                                // echo $cid;
                                $edis=$_POST['edis'];
                                 $eamt=$_POST['eamt'];
                                 $edate1=$_POST['edate1'];
                                 $edate2=$_POST['edate2'];
             
                                if ($_POST['edis']=='' and $_POST['eamt']=='' and $_POST['edate1']=='' and $_POST['']=='') {
                                 $query= "SELECT * FROM tblexpencemst WHERE RecStatus=1";
                                 $run = mysqli_query($con,$query);
                                }
                                                     
                                                     
                                elseif($_POST['edis'] and $_POST['eamt']=='' and $_POST['edate1']=='' and $_POST['edate2']=='')
                                    {
                                        $query="SELECT * FROM tblexpencemst WHERE Discription LIKE '%$edis%' AND RecStatus=1";
                                        $run=mysqli_query($con,$query);
                                    }

                                elseif ($_POST['edis']=='' and $_POST['eamt'] and $_POST['edate1']=='' and $_POST['edate2']=='') {
                                        $query="SELECT * FROM tblexpencemst WHERE Amount LIKE $eamt AND RecStatus=1";
                                        $run=mysqli_query($con,$query);                       
                                    }
                                elseif ($_POST['edis']=='' and $_POST['eamt']=='' and $_POST['edate1'] and $_POST['edate2']=='') {
                                        $query="SELECT * FROM tblexpencemst WHERE ExpanceDate LIKE '$edate1' AND RecStatus=1";
                                        $run=mysqli_query($con,$query);                       
                                    }
                                elseif ($_POST['edis']=='' and $_POST['eamt']=='' and $_POST['edate1'] and $_POST['edate2']) {
                                        $query="SELECT * FROM tblexpencemst WHERE ExpanceDate BETWEEN '$edate1' AND '$edate2' AND RecStatus=1";
                                        //echo $query;
                                        $run=mysqli_query($con,$query);                       
                                    }
                                if($run->num_rows==0){
                                      echo "<script>Swal.fire({icon: 'error', title: 'Oops...',text: 'No Data Found For This Value !!!'});</script>";

                                  }
                                  else{
                                    
                                  

                                while ($row=mysqli_fetch_array($run))
                                {
                                    $eid=$row[0];
                                    $edis=$row[2];
                                    $edate=$row[1];
                                    $eamt=$row[3];
                                  ?>
                        </tr>
                               <td><?php echo $eid; ?></td>
                            <td><?php echo $edis; ?></td>
                            <td><?php echo $edate; ?></td>
                            <td><?php echo $eamt; ?></td>
                            <td><a href="UpdateExpense.php?id=<?php echo $eid; ?>"><input type="Button" value="Update" name="" class="btn btn-primary" id="btn"></a> <a href="DeleteExpense.php?id=<?php echo $eid; ?>"><input type="Button" value="Delete" name="" class="btn btn-primary" id="btn"></a></td>                  
                        </tr>
                                              <?php } }?>
<!--                                               <?php  ?> -->

                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
</section>


   </body>
   </html>