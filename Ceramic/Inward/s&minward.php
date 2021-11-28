<?php

include('config.php');

?>

<!DOCTYPE html>
<html>
   <head>
      <title>Search and Manage Inward</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
      <script src="https://code.jquery.com/jquery-1.12.4.js"></script>

      
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
      <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
      <script>
         function checkRadio(radio){
               if (radio.id === "Inward ID"){
                     document.getElementById("hsnc").innerHTML = "<input type='text' name='iid' class='form-control' id='iid' placeholder='Enter Inward Id.'>";
                  }
               else if(radio.id === "Date")
               {
                  document.getElementById("hsnc").innerHTML = "<input type='date' name='datet' class='form-control' id='datet' placeholder='Enter date'> to <input type='date' name='datef' class='form-control' id='datef' placeholder='Enter date'>";
               }
               
               else if (radio.id === "Vendor"){
                     document.getElementById("hsnc").innerHTML = "<select id='vname' name='vname' class='form-select col-md-4'><option selected>Select Vendor</option></select>";
                
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
                  <h3 class="card-title" style="color: white" align="center">Search and Manage Inward</h3>
               </div>
               <div class="card-body">
                  <form class="row g-3" id="radio-buttons" action="s&minward.php" method="POST">
                     <div class="form-group col-md-12">
                        <label class="form-label">Search By: </label>
                        <div class="form-check form-check-inline">
                           <input class="form-check-input" type="radio" name="hsn1" id="Inward ID" value="Inward ID" onchange="checkRadio(this)">
                           <label class="form-check-label" for="inlineRadio1">Inward ID</label>
                        </div>
                        <div class="form-check form-check-inline">
                           <input class="form-check-input" type="radio" name="hsn1" id="Date" value="Date" onchange="checkRadio(this)">
                           <label class="form-check-label" for="inlineRadio2">Date</label>
                        </div>
                        <div class="form-check form-check-inline">
                           <input class="form-check-input" type="radio" name="hsn1" id="Vendor" value="Vendor Name" onchange="checkRadio(this)">
                           <label class="form-check-label" for="inlineRadio3">Vendor name</label>
                        </div>
                     </div>  
                        <div class="form-group col-md-1">
                        </div>
                        <div class="form-group col-md-6" id="hsnc">
                        </div>
                        <div>
                          <input type="submit" value="Search" name="search" id="save" class="btn btn-success">

                          <a href="../admin.php"><input type="button" value="Close" name="Close" id="Close" class="btn btn-success"></a>
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
                        <tr valign="middle">
                           <th>Inward Id</th>
                           <th>Date of Purchase</th>
                           <th>Vendor Name</th>
                           <th>Total GST</th>
                           <th>Extra Cost</th>
                           <th>Total Amount</th>
                           <th>Amount Paid</th>
                           <th>Amount Pending</th>
                           <th>Payment Mode</th>
                           <th>Total Discount</th>
                           <th>Notes</th>
                           <th>Stock Type</th>
                           <th>Update</th>
                        </tr>
                     </thead>
                     <tbody>
                      <?php
                                error_reporting(E_ERROR | E_PARSE);
                                $con=mysqli_connect('localhost','root','','imsfinal');
                                $iid=$_POST['iid'];
                                // echo $cid;
                                $vname=$_POST['vname'];
                                $datet=$_POST['datet']." 00:00:00";
                                $datef=$_POST['datef']." 00:00:00";
                                
                                if ($_POST['iid']=='' and $_POST['vname']=='' and $_POST['datet']=='')
                                {
                                  $query= "SELECT * FROM tblinwardbillmst inner join tblvendormst on tblvendormst.VendorId = tblinwardbillmst.VendorId where tblinwardbillmst.RecStatus='A' ORDER BY `tblinwardbillmst`.`InwardDate` DESC";
                                  //echo $query;
                                  $run = mysqli_query($con,$query);
                                }
                                         
                                else if($_POST['iid'] and $_POST['vname']=='' and $_POST['datet']==''){

                                        $query= "SELECT * FROM tblinwardbillmst inner join tblvendormst on tblvendormst.VendorId = tblinwardbillmst.VendorId where InwardId = $iid and tblinwardbillmst.RecStatus='A' ORDER BY `tblinwardbillmst`.`InwardDate` DESC";
                                        //echo $query;
                                        $run = mysqli_query($con,$query);
                                        
                                    }
                                                     
                                                     
                                elseif($_POST['iid']=="" and $_POST['vname'] and $_POST['datet']=='')
                                    {
                                        $query="SELECT * FROM tblinwardbillmst inner join tblvendormst on tblvendormst.VendorId = tblinwardbillmst.VendorId WHERE tblinwardbillmst.VendorId=$vname and tblinwardbillmst.RecStatus='A' ORDER BY `tblinwardbillmst`.`InwardDate` DESC";
                                        //echo $query;
                                        $run=mysqli_query($con,$query);
                                        
                                    }
                                elseif($_POST['iid']=="" and $_POST['vname']=="" and $_POST['datet'] and $_POST['datef']=="")
                                    {
                                      //echo $datet;
                                        $query="SELECT * FROM tblinwardbillmst inner join tblvendormst on tblvendormst.VendorId = tblinwardbillmst.VendorId WHERE InwardDate LIKE '$datet' and tblinwardbillmst.RecStatus='A' ORDER BY `tblinwardbillmst`.`InwardDate` DESC";
                                       // echo $query;
                                        $run=mysqli_query($con,$query);
                                        
                                    }
                                elseif ($_POST['iid']=='' and $_POST['vname']=='' and $_POST['datet'] and $_POST['datef']) {
                                        $query="SELECT * FROM tblinwardbillmst inner join tblvendormst on tblvendormst.VendorId = tblinwardbillmst.VendorId WHERE InwardDate BETWEEN '$datet' AND '$datef' AND tblinwardbillmst.RecStatus='A' ORDER BY `tblinwardbillmst`.`InwardDate` DESC";
                                        
                                        $run=mysqli_query($con,$query);
                                        
                                                               
                                    }
                            if($run->num_rows==0){
                                      echo "<script>Swal.fire({icon: 'error', title: 'Oops...',text: 'No Data Found For This Value !!!'});</script>";

                                  }

                                  else{

                                
                                while ($row=mysqli_fetch_array($run))
                                {
                                    $qid=$row[0];
                                    $qdate=$row[1];
                                    $qdate=substr($qdate, 0, 10);
                                    $qdate=explode("-", $qdate);
                                    $qdate=$qdate[2]."-".$qdate[1]."-".$qdate[0];
                                    $qvid=$row[22];
                                    $qgst=$row[3];
                                    $qtcost=$row[4];
                                    $qamount=$row[5];
                                    $qpaid=$row[6];
                                    $qpending=$row[7];
                                    $qmode=$row[9];
                                    $qdisc=$row[10];
                                    $qnotes=$row[11];
                                    $qtype=$row[16];
                                    // $vemail=$row[3];
                                    // $vaddress=$row[4];
                                  ?>
                      </tr>
                            <td><?php echo $qid; ?></td>
                            <td><?php echo $qdate; ?></td>
                            <td><?php echo $qvid; ?></td>
                            <td><?php echo $qgst ?></td>
                            <td><?php echo $qtcost; ?></td>
                            <td><?php echo $qamount; ?></td>
                            <td><?php echo $qpaid; ?></td>
                            <td><?php echo $qpending; ?></td>
                            <td><?php echo $qmode; ?></td>
                            <td><?php echo $qdisc; ?></td>
                            <td><?php echo $qnotes; ?></td>
                            <td><?php echo $qtype ?></td>

<!--                             <td><?php echo $vemail; ?></td>
                            <td><?php echo $vaddress; ?></td> -->
                            <td><a href="Updateinward.php?id=<?php echo $qid; ?>&type=<?php echo $qtype; ?>"><input type="Button" value="Update" name="" class="btn btn-primary" id="btn"></a> <a href="Deleteinward.php?id=<?php echo $qid; ?>"><input type="Button" value="Delete" name="" class="btn btn-primary" id="btn"></a></td>                  
                        </tr>
                                              <?php } } ?>
                       <?php
                       /*
                             
                              $res=mysqli_query($conn,$q) or die("Can't Execute Query...");
                               $count=1;
                               while($row=mysqli_fetch_assoc($res))
                               {
                              ?>
                           <tr>
                               <td><?php echo $row['InwardDate']; ?></td>
                               <td><?php echo $row['VendorId']; ?></td>
                               <td><?php echo $row['TotalGST']; ?></td>
                               <td><?php echo $row['Transport_extracost']; ?></td>
                               <td><?php echo $row['TotalAmount']; ?></td>
                               <td><?php echo $row['AmountPaid']; ?></td>
                               <td><?php echo $row['AmountPending']; ?></td>
                               <td><?php echo $row['PaymentMode']; ?></td>
                               <td><?php echo $row['TotalDiscount']; ?></td>
                               <td><?php echo $row['Notes']; ?></td>
                               <?php

                                    echo  '<td><a href="Update_Product.php?pid='.$row['InwardId'].'">Edit</a> / <a href="process_del_pro.php?pid='.$row['InwardId'].'">Delete</a>'
                                 */
                                    ?>

                               <?php/*
                               $count++;
                               }
                                */
                               ?>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
      </section>
   </body>
   <script>
      $('#Vendor').on('click', function () {
         console.log("asdf");
         $("#vname").empty();
         $("#vname").append(new Option('Select', '-1'));

            myobj = { scn: 0 };

            $.ajax({
               type: "POST",
               url: "./getvendor.php",
               data: JSON.stringify(myobj),
               dataType: "json",
               success: function (Data) {
                  //console.log(Data);
                  if (Data[0].FLAG == 'OK') {
                     let x = Data;
                     let scn;
                     let n = x.length;
                     for (let i = 1; i < n; i++) {
                        scn = Data[i].scn;
                        $("#vname").append(new Option(scn, Data[i].sci))
                     }
                  }
                  else {
                     alert('Something Went Wrong');
                     location.reload(true);
                  }
               }
            });
         
         

      });
   </script>
   </html>