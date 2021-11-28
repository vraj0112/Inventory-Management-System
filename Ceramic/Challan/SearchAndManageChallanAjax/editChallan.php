<!DOCTYPE html>
<html lang="en">
<?php 
    include('./config.php');
    $challanid = $_POST['challanid'];
    //echo $challanid;
    $query = "SELECT ChallanNo, CustomerName, ChallanDate, DueAmount, ExtraCostDesc, ExtraCost, Discount, TransportCost FROM challanmst JOIN tblcustomermst WHERE challanmst.CustomerId = tblcustomermst.CustomerId and ChallanId = {$challanid}";
    $result = mysqli_query($conn, $query);
    if(!$result){
        die('ERROR');
    }
    else{
        $row = $result->fetch_assoc();
        $challanno = $row['ChallanNo'];
        $challandate = $row['ChallanDate'];
        $challandate = substr($challandate, 0, 10);
        $challandate = explode("-", $challandate);
        $challandate = $challandate[2]."-".$challandate[1]."-".$challandate[0];
        $customername = $row['CustomerName'];
        $extracost = $row['ExtraCost'];
        $extracost = number_format($extracost, 2, '.', '');
        $extracostdesc = $row['ExtraCostDesc'];
        $dueamount = $row['DueAmount'];
        $dueamount = number_format($dueamount, 2, '.', '');
        $discount = $row['Discount'];
        $discount = number_format($discount, 2, '.', '');
        $transport = $row['TransportCost'];
        $transport = number_format($transport, 2, '.', '');

    }
?>

<head>
    <title>
        <?php echo $challanno ?>
    </title>
    <style type="text/css">
        .grid1 {
            display: grid;
            width: '100%';
            grid-template-columns: '50px 1fr';
        }

        /* for removing arrow buttons in muber type field. */
        input[type=number] {
            -moz-appearance: textfield;
            text-align: right;
        }



        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .txt-box {
            border-radius: 5px;
        }

        td {
            text-align: center;
        }

        thead th {
            text-align: center;
        }

        tr:nth-child(even) {
            background-color: aqua;
        }

        thead {
            background-color: grey;
        }

        .purchase-qty {
            width: 10px;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="../chosen/chosen.css">
    <script src="../chosen/chosen.jquery.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/table-to-json@1.0.0/lib/jquery.tabletojson.min.js"
        integrity="sha256-H8xrCe0tZFi/C2CgxkmiGksqVaxhW0PFcUKZJZo1yNU=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
    <input type="text" name="" id="challanid" value="<?php echo $challanid; ?>" hidden>

    <div class="container-fluid col-lg-12">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header" style="background-color: #2B60DE">
                        <center>
                            <h3 class="card-title" style="color: white">Challan No :
                                <?php echo $challanno ?>
                            </h3>
                        </center>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2 mt-1">
                                <label for="">Customer :</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" value="<?php echo $customername ?>" disabled>
                            </div>
                            <div class="col-md-6 row">
                                <div class="col-md-2 mt-1">
                                    <label for="">Date :</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" value="<?php echo $challandate ?>" disabled>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row mt-1" style="height: 70px; background-color: grey;">
                        <center>
                            <h4>Purchased Items</h4>
                        </center>
                        <table id="purchasedtable">
                            <thead>
                                <th>Sub<br>Type</th>
                                <th>Type/<br>Color</th>
                                <th>Brand</th>
                                <th>Dimension</th>
                                <th>Qty/<br>Unit</th>
                                <th>Packing<br>Unit</th>
                                <th>Grade</th>
                                <th>Code</th>
                                <th>Date</th>
                                <th>Batch<br>No</th>
                                <th>Billing<br>Qty</th>
                                <th>Other<br>Qty</th>
                                <th>Selling<br>Price</th>
                                <th>Updated<br>Billing<br>Qty</th>
                                <th>Updated<br>Other<br>Qty</th>
                                <th>Updated<br>Selling<br>Price</th>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                        <hr>
                        <link rel="stylesheet" href="">
                        <div class="row">
                            <div class="grid1">
                                <div style="grid-column-start: 1;grid-column-end: 2;">
                                    <div class="row" style="margin-bottom:2%;margin-top: 5%;">
                                        <div class="col-md-4">
                                            <label class="form-label">Total</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="number" class="form-control" id="oldTotalcost" disabled>
                                        </div>
                                    </div>

                                    <div class="row" style="margin-bottom:2%;">
                                        <div class="col-md-4">
                                            <label class="form-label">Discount</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="number" class="form-control discount" id="oldDiscount"
                                                value="<?php echo $discount;?>" disabled>
                                        </div>
                                    </div>

                                    <div class="row" style="margin-bottom:2%;">
                                        <div class="col-md-4">
                                            <label class="form-label">Transpor. Cost</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="number" class="form-control" id="oldTransportcost"
                                                value="<?php echo $transport;?>" disabled>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-bottom:2%;margin-top: 5%;">
                                        <div class="col-md-4">
                                            <label class="form-label">Extra Cost Desc.</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="oldExtraCostDescription"
                                                value="<?php echo $extracostdesc;?>" disabled>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-bottom:2%;">
                                        <div class="col-md-4">
                                            <label class="form-label">Extra Cost Amt.</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="number" class="form-control" id="oldExtraCost"
                                                value="<?php echo $extracost;?>" disabled>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-bottom:2%;">
                                        <div class="col-md-4">
                                            <label class="form-label">Sub Total:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="number" class="form-control" id="oldSubtotal" disabled>
                                        </div>
                                    </div>
                                    <!-- <div class="row" style="margin-bottom:2%;">
                                        <div class="col-md-4">
                                            <label class="form-label">Payed Amt.</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="number" class="form-control" id="oldPayedAmount"
                                                value="<?php //echo $extracost;?>" disabled>
                                        </div>
                                    </div>

                                    <div class="row" style="margin-bottom:2%;">
                                        <div class="col-md-4">
                                            <label class="form-label">Remainig Payment</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="number" class="form-control" id="oldRemainingAmt"
                                                value="<?php //echo $dueamount;?>" disabled>
                                        </div>
                                    </div> -->

                                </div>

                                <div style="grid-column-start: 3;grid-column-end: 4;">
                                    <div class="row" style="margin-bottom:2%;margin-top: 5%;">
                                        <div class="col-md-4">
                                            <label class="form-label">Total</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="number" class="form-control" id="totalcost" value="0.00"
                                                disabled>
                                        </div>
                                    </div>

                                    <div class="row" style="margin-bottom:2%;">
                                        <div class="col-md-4">
                                            <label class="form-label">Discount</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="number" class="form-control discount" id="discount"
                                                value="<?php echo $discount;?>" onkeyup="calsubtotal()">
                                        </div>
                                    </div>

                                    <div class="row" style="margin-bottom:2%;">
                                        <div class="col-md-4">
                                            <label class="form-label">Transport. Cost</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="number" class="form-control" id="transportcost"
                                                value="<?php echo $transport;?>" onkeyup="calsubtotal()">
                                        </div>
                                    </div>

                                    <div class="row" style="margin-bottom:2%;margin-top: 5%;">
                                        <div class="col-md-4">
                                            <label class="form-label">Extra Cost Desc.</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="extraCostDescription"
                                                value="<?php echo $extracostdesc;?>">
                                        </div>
                                    </div>
                                    <div class="row" style="margin-bottom:2%;">
                                        <div class="col-md-4">
                                            <label class="form-label">Extra Cost Amt.</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="number" class="form-control" id="extraCost"
                                                value="<?php echo $extracost;?>" onkeyup="calsubtotal(); validateCost();">
                                        </div>
                                    </div>
                                    <div class="row" style="margin-bottom:2%;">
                                        <div class="col-md-4">
                                            <label class="form-label">Sub Total</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="number" class="form-control" id="subtotal" value="0.00"
                                                disabled>
                                        </div>
                                    </div>
                                    <!-- <div class="row" style="margin-bottom:2%;">
                                        <div class="col-md-4">
                                            <label class="form-label">Payed Amt.</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="number" class="form-control" id="payedAmount"
                                                value="<?php //echo $extracost;?>" onkeyup="calrem()">
                                        </div>
                                    </div>

                                    <div class="row" style="margin-bottom:2%;">
                                        <div class="col-md-4">
                                            <label class="form-label">Remainig Payment</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="number" class="form-control" id="remainingAmt"
                                                disabled>
                                        </div>
                                    </div> -->

                                </div>
                            </div>
                        </div>
<!-- <link rel="stylesheet" href="../searchAndManageChallan.php"> -->
                        <div class="row">
                            <center>
                                <button class="btn btn-success" id='savebtn'>Save Changes</button>
                                <button class="btn btn-success" onclick="window.close()">Close</button>
                            </center>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>

    <script>

        var stockIdsToBePurchased = new Set();
        $(function () {

            ReloadItems();
            calsubtotal();
            calrem();
            function ReloadItems() {

                var challanid = $("#challanid").val();

                $.ajax({
                    type: "POST",
                    url: "./ViewChallanByChallanIdAjax/getPurchasedProductDetails.php",
                    data: { challanid: challanid },
                    dataType: 'json',
                    success: function (Data) {
                        var total = 0;
                        if (Data[0].FLAG == "OKK") {
                            var n = Data.length;

                            for (var i = 1; i < n; i++) {
                                var subcategoryname = Data[i].subcategoryname;
                                var typeorcolor = Data[i].typeorcolor;
                                var brandname = Data[i].brandname;
                                var dimension = Data[i].dimension;
                                var qtyperunit = Data[i].qtyperunit;
                                var packingunit = Data[i].packingunit;
                                var grade = Data[i].grade;
                                var code = Data[i].code;
                                var date = Data[i].date;
                                var batchno = Data[i].batchno;
                                var billingqty = Data[i].billingqty;
                                var otherqty = Data[i].otherqty;
                                var sellingprice = Data[i].sellingprice;
                                var availablebillingqty = Data[i].availablebillingqty;
                                var availableotherqty = Data[i].availableotherqty;
                                var stockid = Data[i].stockid;
                                stockIdsToBePurchased.add(stockid);
                                total = total + (parseInt(billingqty) + parseInt(otherqty)) * parseFloat(sellingprice);
                                console.log(total);
                                $("#purchasedtable tbody:last-child").append(
                                    '<tr>' +
                                    '<td>' + subcategoryname + '</td>' +
                                    '<td>' + typeorcolor + '</td>' +
                                    '<td>' + brandname + '</td>' +
                                    '<td>' + dimension + '</td>' +
                                    '<td>' + qtyperunit + '</td>' +
                                    '<td>' + packingunit + '</td>' +
                                    '<td>' + grade + '</td>' +
                                    '<td>' + code + '</td>' +
                                    '<td>' + date + '</td>' +
                                    '<td>' + batchno + '</td>' +
                                    '<td id="oldbillingqty_'+ stockid +'">' + billingqty + '</td>' +
                                    '<td id="oldotherqty_'+ stockid +'">' + otherqty + '</td>' +
                                    '<td>' + sellingprice + '</td>' +
                                    '<td style="width: 50px;"><input type="number" class="form-control availbill" onkeyup="validateQty(this, ' + availablebillingqty + '); updateTable()" step="1" id="billingqty_' + stockid + '"></td>' +
                                    '<td style="width: 50px;"><input type="number" class="form-control availother" onkeyup="validateQty(this, ' + availableotherqty + '); updateTable()" step="1" id="otherqty_' + stockid + '"></td>' +
                                    '<td style="width: 100px;"><input type="number" class="form-control" onkeyup="validateSellingPrice(this); updateTable()" id="sellingprice_' + stockid + '"></td>' +
                                    '</tr>'
                                );
                            }

                            $("#oldTotalcost").val(total.toFixed(2));
                            var sub = parseFloat($("#oldTotalcost").val()) - parseFloat($("#oldDiscount").val()) + parseFloat($("#oldTransportcost").val()) + parseFloat($("#oldExtraCost").val());
                            $("#oldSubtotal").val(sub.toFixed(2));

                        }
                        else if (Data[0].FLAG == "RECORDNOTFOUND") {
                            console.log("No Items Found n this Challan");
                            swal("No Purchase Product Found For This Challan", '', 'info');
                        }
                        else if (Data[0].FLAG == "ERRINQUERY") {
                            console.log("Error In Query");
                            swal("Something Went Wrong", '', 'error');
                        }
                        else {
                            console.log("Other Response Recived");
                            swal("Something Went Wrong", '', 'error');
                        }
                    },
                    error: function (Data) {

                    }
                });

            }

            $("#savebtn").on('click', function(){
                var totalcost=0;
                var discount=0;
                var transportationcost=0;
                var extracost=0;
                var subtotal=0;
                // var payedamount=0;
                // var remainingamount=0;

                if($("#totalcost").val() == ""){
                    swal("Total Cost Invalid", '', 'warning').then(()=>{
                        return;
                    });
                    return;
                }
                else{
                    totalcost = $("#totalcost").val();
                    totalcost = parseFloat(totalcost);
                    if(totalcost < 0){
                        swal("Total Cost Can't Be Nagetive", '', 'warning').then(()=>{
                            return;
                        });
                        return;
                    }
                }

                if($("#discount").val() == ""){
                    swal("Discount Invalid", '', 'warning').then(()=>{
                        return;
                    });
                    return;
                }
                else{
                    discount = $("#discount").val();
                    discount = parseFloat(discount);
                    if(discount < 0){
                        swal("Discount Can't Be Nagetive", '', 'warning').then(()=>{
                            return;
                        });
                        return;
                    }
                }

                if($("#transportcost").val() == ""){
                    swal("Transportation Cost Invalid", '', 'warning').then(()=>{
                        return;
                    });
                    return;
                }
                else{
                    transportationcost = $("#transportcost").val();
                    transportationcost = parseFloat(transportationcost);
                    if(transportationcost < 0){
                        swal("Transportation Cost Can't Be Nagetive", '', 'warning').then(()=>{
                            return;
                        });
                        return;
                    }
                }

                if($("#extraCostDescription").val() == ""){
                    swal("Extra Cost Description Empty", '', 'warning').then(()=>{
                        return;
                    });
                    return;
                }

                if($("#extraCost").val() == ""){
                    swal("Extra Cost Empty", '', 'warning').then(()=>{
                        return;
                    });
                    return;
                }
                else{
                    extracost = $("#extraCost").val();
                    extracost = parseFloat(extracost);
                    if(extracost < 0){
                        swal("Extra Cost Can't Be Nagetive", '', 'warning').then(()=>{
                            return;
                        });
                        return;
                    }
                }

                if($("#subtotal").val() == ""){
                    swal("Subtotal Empty", '', 'warning').then(()=>{
                        return;
                    });
                    return;
                }
                else{
                    subtotal = $("#subtotal").val();
                    subtotal = parseFloat(subtotal);
                    if(subtotal < 0){
                        swal("Sub Total Can't Be Nagetive", '', 'warning').then(()=>{
                            return;
                        });
                        return;
                    }
                }

                // if($("#payedAmount").val() == ""){
                //     swal("Payed Amount Empty", '', 'warning').then(()=>{
                //         return;
                //     });
                //     return;
                // }
                // else{
                //     payedamount = $("#payedAmount").val();
                //     payedamount = parseFloat(payedamount);
                //     if(payedamount < 0){
                //         swal("Payed Amount Can't Be Nagetive", '', 'warning').then(()=>{
                //             return;
                //         });
                //         return;
                //     }
                // }

                // if($("#remainingAmt").val() == ""){
                //     swal("Remaing Amount Empty", '', 'warning').then(()=>{
                //         return;
                //     });
                //     return;
                // }
                // else{
                //     remainingamount = $("#remainingAmt").val();
                //     remainingamount = parseFloat(remainingamount);
                //     /*if(remainingamount < 0){
                //         swal("Remaining Amount Can't Be Nagetive", '', 'warning').then(()=>{
                //             return;
                //         });
                //         return;
                //     }*/
                // }
            
                var itr = stockIdsToBePurchased[Symbol.iterator]();
                var n = stockIdsToBePurchased.size;
                var challanpack = new Array();
                var challanid = $("#challanid").val();
                
                var extracostdesc = $("#extraCostDescription").val();
                var challanmetadata = {challanid: challanid, discount: discount, transportationcost: transportationcost, extracostdesc: extracostdesc, extracost: extracost};
                console.log(challanmetadata);
                challanpack.push(challanmetadata);
    
                for (let i = 0; i < n; i++) {
                    var tempstockid = itr.next().value;
                    if($("#billingqty_"+tempstockid).val() == ""){
                        swal("Billing Qty Empty In Purchased Product", '','warning').then(()=>{
                            return;
                        });
                        return;
                    }
                    if($("#otherqty_"+tempstockid).val() == ""){
                        swal("Other Qty Empty In Purchased Product", '','warning').then(()=>{
                            return;
                        });
                        return;
                    }
                    if($("#sellingprice_"+tempstockid).val() == ""){
                        swal("Selling Price Empty In Purchased Product", '','warning').then(()=>{
                            return;
                        });
                        return;
                    }
                    var billingqty = $("#billingqty_"+tempstockid).val();
                    var otherqty   = $("#otherqty_"+tempstockid).val()
                    var oldbillingqty = $("#oldbillingqty_"+tempstockid).html();
                    var oldotherqty   = $("#oldotherqty_"+tempstockid).html();
                    var sellingprice = $("#sellingprice_"+tempstockid).val();
                    var obj = {
                        stockid: tempstockid, 
                        oldbillingqty: oldbillingqty, 
                        oldotherqty: oldotherqty, 
                        billingqty: billingqty, 
                        otherqty: otherqty,
                        sellingprice: sellingprice
                    };

                    challanpack.push(obj);

                }

                $.ajax({
                    type: "POST",
                    url: './EditChallanAjax/editChallanSaveChanges.php',
                    data: {challandata: JSON.stringify(challanpack)},
                    success: function(Data){
                        if(Data == "1"){
                            swal('Succesfully Updated Challan', '', 'success').then(()=>{
                                window.close();
                            });
                            
                        }
                        else if(Data == "-1"){
                            console.log("error in challandetails or stockdetails Query");
                            swal("Something Went Wrong!!!", '', 'error');
                        }
                        else if(Data == "-2"){
                            console.log("Error In Challan Mst Update Query");
                            swal("Something Went Wrong!!!", '', 'error');
                        }
                        else if(Data == "-3"){  
                            console.log("Error In Update Payment Update Query");
                            swal("Something Went Wrong!!!", '', 'error');
                        }
                        else if(Data == "-4"){
                            console.log("Commit Fail");
                            swal("Something Went Wrong!!!", '', 'error');
                        }
                        else{
                            console.log("Other Responce recived");
                            swal("Something Went Wrong!!!", '', 'error');
                        }
                    },
                    error: function(Data){
                        console.log("Error In ./EditChallanAjax/editChallanSaveChanges.php   Ajax Call");
                        swal("Something Went Wrong", '', 'error').then(()=>{
                            return;
                        });
                    }
                });
            });

        });

        function validateQty(ref, avail) {
            enterdvalue = ref.value;
            if (enterdvalue < 0) {
                swal('Quentity Cant Be Zero Or Nagetive', '', 'warning').then(() => {
                    ref.value = "";
                    ref.focus();
                    return;
                });
                return;
            }

            if (enterdvalue > avail) {
                swal('Quentity Entered Is Not Available In Stock', 'Available Stock : ' + avail, 'warning').then(() => {
                    ref.value = "";
                    ref.focus();
                    return;
                });
                return;
            }
        }

        function validateSellingPrice(ref) {
            enterdvalue = ref.value;
            if (enterdvalue < 0) {
                swal('Invalid Selling Price', '', 'warning').then(() => {
                    ref.value = "";
                    ref.focus();
                    return;
                });
                return;
            }
        }

        /*function calprice() {
            var itr = stockIdsToBePurchased[Symbol.iterator]();
            var n = stockIdsToBePurchased.size;
            var totalprice = 0;
            for (let i = 0; i < n; i++) {

                var tempstockid = itr.next().value;
                var billingQty = $("#billingqty_" + tempstockid).val();
                var otherQty = $("#otherqty_" + tempstockid).val();
                var sellingPrice = $("#sellingprice_" + tempstockid).val();
                totalprice = (totalprice + (billingQty * sellingPrice) + (otherQty * sellingPrice));
            }
            document.getElementById("totalcost").value = totalprice;

        }*/

        function calsubtotal() {
            var total = document.getElementById("totalcost").value;
            if(total == ""){total = 0;}
            var discount = document.getElementById("discount").value;
            if (discount == "") {discount = 0;}
            total = parseFloat(total);
            discount = parseFloat(discount);
            if(discount<0){
                swal("Discount Can't Be Nagetive").then(() => {
                    document.getElementById("discount").value = 0;
                    return;
                });
            }
            var transport = document.getElementById("transportcost").value;
            if (transport == "") {transport = 0;}
            transport = parseFloat(transport);
            if (transport < 0) {
                swal("Transport Cost Can't Be Nagetive").then(() => {
                    document.getElementById("transport").value = 0;
                    return;
                });
            }

            extraCost = $('#extraCost').val();
            if (extraCost == "") {extraCost = 0;}
            var subtotal = total - discount + Number.parseFloat(transport) + Number.parseFloat(extraCost);
            document.getElementById("subtotal").value = subtotal.toFixed(2);
            calrem();
        }

        function splitDate(date) {
            var DateArray = date.split("-");
            return (DateArray[2] + "-" + DateArray[1] + "-" + DateArray[0]);
        }

        function validateCost() {
            if (parseFloat($("#extraCost").val()) <= 0) {
                swal("Extra Cost Can't Be Nagetive Or Zero", '', 'info').then(() => {
                    $("#extraCost").val("0");
                    updateTable();
                    return;
                });
            }
        }

        function updateTable() {
            var itr = stockIdsToBePurchased[Symbol.iterator]();
            var n = stockIdsToBePurchased.size;
            var totalprice = 0;
            for (let i = 0; i < n; i++) {

                var tempstockid = itr.next().value;
                var billingQty = $("#billingqty_" + tempstockid).val();
                if (billingQty == "") {
                    billingQty = 0;
                }
                var otherQty = $("#otherqty_" + tempstockid).val();
                if (otherQty == "") {
                    otherQty = 0;
                }
                var sellingPrice = $("#sellingprice_" + tempstockid).val();
                if (sellingPrice == "") {
                    sellingPrice = 0;
                }
                totalprice = (totalprice + (parseInt(billingQty) + parseInt(otherQty)) * sellingPrice);
            }
            document.getElementById("totalcost").value = totalprice.toFixed(2);
            calsubtotal();
        }

        function calrem(){
            var subtotal = $("#subtotal").val();
            if(subtotal == ""){subtotal=0;}
            // var payedamount = $("#payedAmount").val();
            // if(payedamount == ""){payedamount = 0;}
            // remainingamt = parseFloat(subtotal) - parseFloat(payedamount);
            // $("#remainingAmt").val(remainingamt.toFixed(2));

        }
    </script>
</body>