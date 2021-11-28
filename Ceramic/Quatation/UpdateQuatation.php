<?php
    include('connection.php');
    $q_id = @$_GET['id'];
    $qcname;
    $qdate;
    $qprice;
    $qgst;
    $qamount;
    $srno;
    // $company_name;
    // $gst_no;
    // $discount;
    // $totalamount = 0;
    // $amounttobepaid = 0;

    $query = "SELECT * FROM tblqutationmst WHERE QutationId='$q_id'";
    $result = mysqli_query($conn, $query);

    while ($row=mysqli_fetch_array($result))
    {
        $qcname=$row[1];
        $qdate=$row[2];
        $qprice=$row[3];
        $qgst=$row[4];
        $qamount=$row[5];
        $seno=$row[0]; 

     
    }
                          
        // if($row = $result->mysqli_fetch_array())
        // {
        //     $qcname = $row['Name'];
        //     $qdate = $row['QDate'];
        //     $qprice = $row['TotalPrice'];
        //     $qgst = $row['TotalGST'];
        //     $qamount = $row['TotalAmount'];

        //     $query2 = "SELECT customer_name,customer_contact_no_1,customer_email, customer_address, company_name, gst_no FROM customer WHERE customer_id=".$customer_id;
        //     $result2 = mysqli_query($conn, $query2);
        //     if($row2 = $result2->fetch_assoc())
        //     {
        //         $customer_name = $row2['customer_name'];
        //         $customer_contact_no = $row2['customer_contact_no_1'];
        //         $customer_email = $row2['customer_email'];
        //         $customer_address = $row2['customer_address'];
        //         $company_name = $row2['company_name'];
        //         $gst_no = $row2['gst_no'];
        //     }
        // }
        
        //$arr = array("FLAG" => "OK",'challan_id' => $challan_id, 'customer_name' => $customer_name, 'customer_contact_no' => $customer_contact_no, 'challan_date' => $challan_date);

        //echo json_encode($arr);
    
?>
<!-- 
<!DOCTYPE html> -->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Challan Id :
        <?php echo $_POST['q_id'] ?>
    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
   <!--  <link rel="stylesheet" href="chosen/chosen.css">
    <link rel="stylesheet" href="./s&m.css">
 -->
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- <script src="http://code.jquery.com/jquery-1.12.0.min.js"></script> -->
 <!--    <script src="chosen/chosen.jquery.js" type="text/javascript"></script>
 -->
    <style>
        .datafields {
            background-color: lightgrey;
        }

        .fieldlabel {
            color: blue;
        }

        /* .datafields-p{
            align-items: center;
        } */
    </style>

    <script type="text/javascript">
        function SomeDeleteRowFunction(o,x) {
            var b = document.getElementById("data_table").rows[x].cells[1].innerHTML;
            var c = document.getElementById("data_table").rows[x].cells[2].innerHTML;
            var e = document.getElementById("data_table").rows[x].cells[4].innerHTML;
            var f = document.getElementById("data_table").rows[x].cells[5].innerHTML;

            var s = document.getElementById('setTotalAmount').value - b.trim()*c.trim();
            var r = document.getElementById('setDiscount').value - e.trim();
            var t = document.getElementById('setAmountToBePaid').value - f.trim();

            document.getElementById('setTotalAmount').value=s;
            document.getElementById('setDiscount').value=r;
            document.getElementById('setAmountToBePaid').value=t;

          var p=o.parentNode.parentNode;
           p.parentNode.removeChild(p);
           $("#submit").prop("disabled", false);
        }

        function editdata(o,x){

            $("#add_data").prop("disabled", false);
            $("#submit").prop("disabled", false);

            // console.log(x);

              // alert("Row index is: " + x.rowIndex);

            // var p = o.parentNode.srno
            //var x = document.getElementById(x).value;
            // var table = document.getElementById("data_table");
            // var row = table.rows[x];
            var a = document.getElementById("data_table").rows[x].cells[0].innerHTML;
            var b = document.getElementById("data_table").rows[x].cells[1].innerHTML;
            var c = document.getElementById("data_table").rows[x].cells[2].innerHTML;
            var d = document.getElementById("data_table").rows[x].cells[3].innerHTML;
            var e = document.getElementById("data_table").rows[x].cells[4].innerHTML;
            var f = document.getElementById("data_table").rows[x].cells[5].innerHTML;
            // var g = document.getElementById("data_table").rows[x].cells[6].children.value;
            var g = $("#hidden_"+x).val();
            console.log(g);


            document.getElementById("qdis").value = a.trim();
            document.getElementById("qqty").value = b.trim();
            document.getElementById("qrate").value = c.trim();
            document.getElementById("qgstd").value = d.trim();
            // document.getElementById("qgstamt").value = e.trim();
            // document.getElementById("qamt").value = f.trim();
            document.getElementById("qx").value = g;


            var i = document.getElementById("data_table").rows[x].cells[1].innerHTML;
            var j = document.getElementById("data_table").rows[x].cells[2].innerHTML;
            var k = document.getElementById("data_table").rows[x].cells[4].innerHTML;
            var l = document.getElementById("data_table").rows[x].cells[5].innerHTML;

            var s = document.getElementById('setTotalAmount').value - i.trim()*j.trim();
            var r = document.getElementById('setDiscount').value - k.trim();
            var t = document.getElementById('setAmountToBePaid').value - l.trim();

            document.getElementById('setTotalAmount').value=s;
            document.getElementById('setDiscount').value=r;
            document.getElementById('setAmountToBePaid').value=t;

            SomeDeleteRowFunction(o,x);
           //            var p=o.parentNode.parentNode;
           // p.parentNode.removeChild(p);

            var qdis = $('#qdis').val();
            var qqty = $('#qqty').val();
            var qrate = $('#qrate').val();
            var qgstd = $('#qgstd').val();
            var amt=qqty*qrate;
            var amount =(qqty * qrate) + (qqty * qrate * qgstd / 100);
            console.log(amount);
            var gstamount = qqty * qrate * qgstd / 100;

            document.getElementById('qgstamt').value = parseFloat(gstamount);
            document.getElementById('qamt').value = parseFloat(amount + gstamount);

            var p = parseFloat(document.getElementById('setTotalAmount').value);
            var q = parseFloat(document.getElementById('setDiscount').value);
            var r = parseFloat(document.getElementById('setAmountToBePaid').value);

            totalBill=p+amt;
            // document.getElementById("tbill").value='totalBill';
            gst=q+gstamount;
            // document.getElementById("tgst").value='gst';
            trcost=r+amount;
            // document.getElementById("ttcost").value='trcost';


            document.getElementById('setTotalAmount').value = totalBill;
            document.getElementById('setDiscount').value = gst;
            document.getElementById('setAmountToBePaid').value = trcost;

        }
        


    </script>
</head>

<body>
                        <form action="UpdateQ.php?id=<?php echo $q_id; ?>" method="post">
    <div class="container-fluid col-lg-12">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header" style="background-color: #2B60DE">
                        <center>
                            <h3 class="card-title" style="color: white">Quatation Id :
                                <?php echo $q_id ?>
                            </h3>
                        </center>
                    </div>

                        <div class="card-body">
                        <div class="row mt-3">
                            <div class="col-md-1">
                                <label class='fieldlabel mt-1' for="companyname">Name : </label>
                            </div>
                            <div class="col-md-5">
                                <input id='setCompanyName' class="form-control mt-1 datafields" type="text"
                                    value="<?php echo $qcname; ?>" disabled>
                            </div>
                            <div class="col-md-1">
                                <label class='fieldlabel mt-1' for="customername">Date : </label>
                            </div>
                            <div class="col-md-5">
                                <input id='setCustomerName' class="form-control mt-1 datafields" type="date"
                                    value="<?php echo $qdate; ?>" disabled>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-1">
                                <label class='fieldlabel mt-1' for="customername">Description : </label>
                            </div>
                            <div class="col-md-5">
                                <input id='qdis' name="qdis" class="form-control mt-1 datafields" type="text">
                            </div>
                            <div class="col-md-1">
                                <label class='fieldlabel mt-1' for="customername">Quantity : </label>
                            </div>
                            <div class="col-md-1">
                                <input id='qqty' name="qqty" class="form-control mt-1 datafields" type="text">
                            </div>
                            <div class="col-md-1">
                                <label class='fieldlabel mt-1' for="customername">Rate : </label>
                            </div>
                            <div class="col-md-1">
                                <input id='qrate' name="qrate" class="form-control mt-1 datafields" type="text">
                            </div>
                            <div class="col-md-1">
                                <label class='fieldlabel mt-1' for="customername">Taxable GST : </label>
                            </div>
                            <div class="col-md-1">
                                <select class="form-control mt-1 datafields" id="qgstd" name="qgstd">
                                    <option value="0">NA</option>
                                    <option value="5">5</option>
                                    <option value="12">12</option>
                                    <option value="18">18</option>
                                    <option value="28">28</option>
                           </select>
<!--                                 <input id='qgstd' class="form-control mt-1 datafields" type="text"> -->
                            </div>
                        </div>
                            <div class="col-md-8">
                                <input id="qgstamt" name="qgstamt" class="form-control mt-1 datafields" type="hidden">
                            </div>
                            <div class="col-md-8">
                                <input id="qamt" name="qamt" class="form-control mt-1 datafields" type="hidden">
                            </div>
                            <div class="col-md-8">
                                <input id="qx" name="qx" class="form-control mt-1 datafields" type="hidden">
                            </div>
                        

                        <div class="col-12">
                            <input type="Button" name="add" value="Add" id="add_data" class="btn btn-primary" disabled>
                            
                            <!-- <button type="button" id="updateButton" name="add" class="btn btn-primary" onclick="productUpdate();"> Add </button> --><!-- 
                            <input type="Button" value="Reset" id="reset" class="btn btn-primary" onclick="reseta()">
                            <input type="hidden" id="count" name="count"> -->
                        </div>
                        

                    </div>
                </div>
            </div>
        </div>
        <br>
        <!-- <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header" style="background-color: #2B60DE">
                        <center>
                            <h4 class="card-title" style="color: white">Items</h6>
                        </center>
                    </div>
                    <div class="card-body">

                    </div>
                </div>
            </div>
        </div> -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary" style="overflow-x:auto; overflow-y: auto; height: 310px;">
                        <table class="table" id="data_table">
                            <thead>
                                <tr>
                                    <th width="550px">Discription</th>
                                    <th>Qty</th>
                                    <th>Rate</th>
                                    <th>GST</th>
<!--                                     <th>Total</th> -->
                                    <th>GST Amount</th>
                                    <th>Amount</th>
                                    <th width="40px">Action</th>
                                </tr>
                            </thead>

                            <tbody id="tbody">
                                <?php
                                
                                $findItem = "SELECT Discription, Qty, Rate, Gst, ItemNo FROM tblqutationdetails WHERE QutationId='$q_id'";
                                $resultfindItem = mysqli_query($conn, $findItem);

                                while ($row=mysqli_fetch_array($resultfindItem))
                                {
                                    $qdis=$row[0];
                                    $qqty=$row[1];
                                    $qrate=$row[2];
                                    $qgstd=$row[3];
                                    $qgstamt=$qrate*$qqty*$qgstd/100;
                                    $qamt=($qqty*$qrate)+$qgstamt;
                                    $srno=$row[4];
                                    $srno++;
     
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $qdis ?>
                                    </td>
                                    <td>
                                        <?php echo $qqty ?>
                                    </td>
                                    <td>
                                        <?php echo $qrate ?>
                                    </td>
                                    <td>
                                        <?php echo $qgstd ?>
                                    </td>
                                    <td>
                                        <?php echo $qgstamt ?>
                                    </td>
                                    <td>
                                        <?php echo $qamt ?>
                                    </td>
<!--                                     <td>
                                        <?php echo $srno ?>
                                    </td> -->
                                    <td>
                                        <input type="hidden" name="srno" value="<?php echo (isset($srno))?$srno:'';?>" id="hidden_<?php echo (isset($srno))?$srno:'';?>">
                                        <input type="button" name="edit" class="btn btn-success" value="Edit" onclick="editdata(this, <?php echo (isset($srno))?$srno:'';?>)">
                                        <input type="button" name="delete" class="btn btn-success" value="Delete" onclick="SomeDeleteRowFunction(this, <?php echo (isset($srno))?$srno:'';?>)">
                                    </td>
<!--                                     <td>
                                        <?php $totalamount += $product_qty * $product_rate; echo $product_qty * $product_rate ?>
                                    </td> -->
                                    <!-- <td><?php /*echo $product_name*/ ?></td> -->

                                </tr>
                                <?php

                                            }
       
                                 
                            ?>
                            </tbody>
                        </table>
                        
                    </div>
                    <div class="row mt-3">
                            <div class="col-md-1">
                                <label class='fieldlabel mt-1' for="totalamount">Total Price</label>
                            </div>
                            <div class="col-md-3">
                                <input id="setTotalAmount" name="ttprice" class="form-control mt-1 datafields-p" type="text"
                                    value="<?php echo $qprice; ?>">
                            </div>
                            <div class="col-md-1">
                                <label class='fieldlabel mt-1' for="totalamount">Total GST</label>
                            </div>
                            <div class="col-md-3">
                                <input id="setDiscount" name="ttgst" class="form-control mt-1 datafields-p" type="text"
                                    value="<?php echo $qgst; ?>">
                            </div>
                            <div class="col-md-1">
                                <label class='fieldlabel mt-1' for="amounttobepaid">Total Amount</label>
                            </div>
                            <div class="col-md-3">
                                <input id="setAmountToBePaid" name="ttamount" class="form-control mt-1 datafields-p" type="text" value="<?php echo $qamount; ?>">
                            </div>
                        </div>

                        <div class="row" style="margin-top: 20px;">
                            <center>
                                <form action="makepdf.php" target="_blank" method='POST'>
                                    <input type='hidden' name='hidden-challan-date'  id='hidden-challan-date'  value="<?php echo $challan_date; ?>">
                                    <input type='hidden' name='hidden-discount'  id='hidden-discount'  value="<?php echo $discount; ?>">
                                    <input type='hidden' name='hidden-customer-name' id='hidden-customer-name' value="<?php echo $customer_name; ?>">
                                    <input type='hidden' name='hidden-challan-id'    id='hidden-challan-id'    value="<?php echo $challan_id; ?>">
                                    <input type='hidden' name='hidden-customer-id'   id='hidden-customer-id'   value="<?php echo $customer_id; ?>">
                                    
                                    <input type="submit" id="submit" name="submit" value="submit" class="btn btn-primary" disabled>
                                    <input type="button" class="btn btn-primary" name="Close" value="Close" onclick="window.location='./ManageQuatation.php'">
                                </form>
                            </center>
                        </div>
                </div>
            </div>
        </div>
    </div>
                        </form>
                        
</body>

<script type="text/javascript">
    $(document).ready(function(){
        $('#add_data').click(function(){

            var qdis = $('#qdis').val();
            var qqty = $('#qqty').val();
            var qrate = $('#qrate').val();
            var qgstd = $('#qgstd').val();
            console.log(qgstd);
            var y = $('#qx').val();
            console.log(y);
            
            var amount =(qqty * qrate) + (qqty * qrate * qgstd / 100);
            console.log(amount);
            var gstamount = qqty * qrate * qgstd / 100;
            var amt=qqty*qrate + gstamount;
            var totalamount = qqty*qrate;
            document.getElementById('qgstamt').value = parseFloat(gstamount);
            document.getElementById('qamt').value = parseFloat(amount);

            var p = parseFloat(document.getElementById('setTotalAmount').value);
            var q = parseFloat(document.getElementById('setDiscount').value);
            var r = parseFloat(document.getElementById('setAmountToBePaid').value);

            totalBill=p+totalamount;
            // document.getElementById("tbill").value='totalBill';
            gst=q+gstamount;
            // document.getElementById("tgst").value='gst';
            trcost=r+amount;
            // document.getElementById("ttcost").value='trcost';


            document.getElementById('setTotalAmount').value = totalBill;
            document.getElementById('setDiscount').value = gst;
            document.getElementById('setAmountToBePaid').value = trcost;
            
            $('#data_table tbody:last-child').append(
                '<tr>'+
                    '<td>'+qdis+'</td>'+
                    '<td>'+qqty+'</td>'+
                    '<td>'+qrate+'</td>'+
                    '<td>'+qgstd+'</td>'+
                    '<td>'+gstamount+'</td>'+
                    '<td>'+amt+'</td>'+
                    // '<td> <input readonly id="qdis" type="text" value="'+qdis+'"></td>'+
                    // '<td> <input readonly id="qqty" type="text" value="'+qqty+'"></td>'+
                    // '<td> <input readonly id="qrate" type="text" value="'+qrate+'"></td>'+
                    // '<td> <input readonly id="qgstd" type="text" value="'+qgstd+'"></td>'+
                    // '<td> <input readonly id="qgstamt" type="text" value="'+gstamount+'"></td>'+
                    // '<td> <input readonly id="qamt" type="text" value="'+amt+'"></td>'+
                    // '<td> <input readonly id="qx" type="hidden" value="'+x+'"></td>'+
                    '<td> <input type="hidden" value="srno"><input type="button" name="edit" class="btn btn-success" value="Edit" onclick="edit(this, '+y+')"> <input type="button" name="delete" class="btn btn-success" value="Delete" onclick="SomeDeleteRowFunction(this, '+y+')"></td>'+
                '</tr>'
                    );
                    $("#add_data").prop("disabled", true);

                });

            });



</script>

</html>