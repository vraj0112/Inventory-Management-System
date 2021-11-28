<!DOCTYPE html>
<html lang="en">
<?php include('./config.php');?>

<head>
    <title>Challan</title>
    <style type="text/css">

        html, body {
            max-width: 100%;
            overflow-x: hidden;
        }
        .grid1 {
            display: grid;
            width: '100%';
            grid-template-columns: '50px 1fr';
        }

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
    <link rel="stylesheet" href="chosen/chosen.css">
    <script src="chosen/chosen.jquery.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/table-to-json@1.0.0/lib/jquery.tabletojson.min.js"
        integrity="sha256-H8xrCe0tZFi/C2CgxkmiGksqVaxhW0PFcUKZJZo1yNU=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>

        function checkRadio(radio) {
            if (radio.id === "complete") {
                document.getElementById("rpy").value = "0";
                document.getElementById("Amt").value = "";
                document.getElementById("rpy").readOnly = true;
                document.getElementById("RemAmt").style.display = "none";
            } else if (radio.id === "pending") {
                document.getElementById("RemAmt").style.display = "block";
            }
        }

        function calrem() {

            var tot = parseFloat(document.getElementById('subtotal').value);
            var pen = document.getElementById('Amt').value;
            if (parseFloat($("#discount").val()) > parseFloat($("#totalcost").val())) {
                $("#discount").val("0");
                return;
            }
            if (pen == "") {
                document.getElementById('rpy').value = 0;
                return;
            }
            if (pen > tot) {
                swal("Amount Can't Be Greater Then Sub Total", '', 'info').then(() => {
                    document.getElementById('Amt').value = "";
                    $("#Amt").focus();
                    document.getElementById('rpy').value = 0;
                    return;
                });
            }
            else if (pen <= 0) {
                swal("Amount Can't Be Nagative Or Zero", '', 'info').then(() => {
                    document.getElementById('Amt').value = "";
                    $("#Amt").focus();
                    document.getElementById('rpy').value = 0;
                    return;
                });
            }
            else {

                var remain = tot - parseFloat(pen);
                document.getElementById('rpy').value = remain;
            }
        }

        function cancelField() {
            document.getElementById("addOtherCharge").disabled = false;
            document.getElementById("extraCost").innerHTML = "";
            addAnotherChargesFlag = false;
            calsubtotal();
            document.getElementById("ExtraCost").innerHTML = "";
        }

        function SomeDeleteRowFunction(o) {
            var p = o.parentNode.parentNode;
            p.parentNode.removeChild(p);
        }

    </script>
</head>

<?php 
    $month = date('m');
    $day = date('d');
    $year = date('Y');
    $today = $year . '-' . $month . '-' . $day;
?>

<body>
    <div class="container-fluid col-lg-12">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header" style="background-color: #2B60DE">
                        <center>
                            <h3 class="card-title" style="color: white">Challan</h3>
                        </center>
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-2">
                                <label class="mt-1" style="margin-left: 2px">Date:</label>
                            </div>
                            <div class="col-md-2">
                                <input type="date" id="getChallanDate" name="getChallanDate" class="form-control"
                                    value="<?php echo $today; ?>">
                            </div>

                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-2">
                                        <label class="form-label mt-1" style="margin-left: 20%;">Customer :</label>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="ec" class="mt-1" style="margin-left: 5%;"><input
                                                class="form-check-input mt-1 radio" type="radio" name="customer" id="ec"
                                                value="ec"> Existing Customer</label>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="nc" class="mt-1" style="margin-left: 5%;"><input
                                                class="form-check-input mt-1 radio" type="radio" name="customer" id="nc"
                                                value="nc"> New Customer</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 mt-1">
                                <label for="">Customer : </label>
                            </div>
                            <div class="col-md-4">
                                <select class="form-select" name="" id="getCustomerName">
                                    <option value="-1">Select</option>

                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row mt-3">
                    <div class="form-group col-md-1">
                        <label class="form-label">Product Type: </label>
                    </div>
                    <div class="col-md-2">
                        <select id="category_name" class="form-select col-md-12 resetsearchparam class-category">
                            <option value='-1' selected>Select</option>
                            <?php
                                $query = "SELECT category_id ,category_name FROM categories where active_status=true";
                                $result = mysqli_query($conn, $query);
                                if($result)
                                {
                                    while($row = $result -> fetch_assoc())
                                    {
                                        $category_id = $row['category_id'];
                                        $category_name = $row['category_name'];
                                        echo
                                            "<option value='".$category_id."'>".$category_name."</option>";
                                    }
                                }
                                else
                                {
                                    echo "<script>swal('Something Went Wrong', '', 'error');</script>";
                                    location.reload(true);
                                }
                            ?>
                        </select>
                    </div>

                    <div class="form-group col-md-1" style="width:12%;">
                        <label class="form-label">Product Sub Type: </label>
                    </div>
                    <div class="col-md-2">
                        <select id="subcategories" class="form-select resetsearchparam class-subcategory">
                            <option value='-1'>Select</option>
                        </select>
                    </div>

                    <div class="col-md-1">
                        <label class="form-label">Brand Name: </label>
                    </div>
                    <div class="col-md-2">
                        <select id="getbrandname" class="form-select resetsearchparam class-brand">
                            <option value='-1'>Select</option>
                        </select>
                    </div>

                    <div class="col-md-1">
                        <label class="form-label">HSN Code: </label>
                    </div>
                    <div class="col-md-1" style="width: 10%;">
                        <input type="number" name="HSN" class="form-control" id='hsn'
                            onKeyPress="if(this.value.length==8) return false;" disabled>
                    </div>
                </div>

                <div class="row mt-3">

                    <div class="col-md-1">
                        <label class="form-label">Grade : </label>
                    </div>
                    <div class="col-md-2">
                        <select id="getgrade" class="form-select col-md-12 resetsearchparam class-grade">
                            <option value='-1' selected>Select</option>

                        </select>
                    </div>

                    <div class="col-md-1" style="width: 12%;">
                        <label class="form-label">Product Type/Color : </label>
                    </div>
                    <div class="col-md-2">
                        <select name='getProductTypeColor' class="form-control form-select resetsearchparam"
                            id="getProductTypeColor">
                            <option value="-1">Select</option>

                        </select>
                    </div>

                    <div class="col-md-1">
                        <label class="form-label">Dimension : </label>
                    </div>
                    <div class="col-md-2">
                        <select id="getdimension" class="form-select col-md-12 resetsearchparam">
                            <option value='-1' selected>Select</option>

                        </select>
                    </div>

                    <div class="col-md-1">
                        <label class="form-label">GST : </label>
                    </div>
                    <div class="col-md-1" style="width: 10%;">
                        <input type="number" name="gst" class="form-control" id='gst' disabled>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-1">
                        <label class="form-label">Qty Per Unit : </label>
                    </div>
                    <div class="col-md-2">
                        <select class='form-select resetsearchparam' name="" id="getqtyperunit">
                            <option value="-1">Select</option>
                        </select>
                    </div>

                    <div class="col-md-1" style="width: 12%;">
                        <label class="form-label">Packing Unit : </label>
                    </div>
                    <div class="col-md-2">
                        <select class='form-select resetsearchparam' name="" id="getpackingunit">
                            <option value="-1">Select</option>
                            <option value="KG">KG</option>
                            <option value="PIECE">PIECE</option>
                            <option value="BOX">BOX</option>
                        </select>
                    </div>
                    <div class="col-md-2" style="width:18%;">
                        <label class="form-label">Code No./Model No./Design No.: </label>
                    </div>

                    <div class="col-md-2">
                        <select id="getcode" class="form-select col-md-12 resetsearchparam">
                            <option value='-1' selected>Select</option>

                        </select>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-1">
                        <input type="Button" value="Search" id="searchbtn" class="btn btn-success" style="margin-bottom: 10px;">
                    </div>
                    <div class="col-md-1">
                        <input type="text" id="pid" hidden>
                    </div>

                </div>
            </div>
            <hr>
            <table id="searchedTable">
                <thead>
                    <th>Type</th>
                    <th>Sub<br>Type</th>
                    <!--<th>HSN<br>Code</th> -->
                    <th>Type/<br>Color</th>
                    <th>Brand</th>
                    <th>Dimension</th>
                    <th>Qty/Unit</th>
                    <th>Packing<br>Unit</th>
                    <th>Grade</th>
                    <th>Code</th>
                    <th>GST</th>
                    <th>Date</th>
                    <th>Batch<br>No</th>
                    <th>Billing<br>Qty</th>
                    <th>Other<br>Qty</th>
                    <th>Base<br>Price</th>
                    <th>Action</th>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
        <!-- <div class="card card-primary" style="overflow-x:auto; overflow-y: auto; height: 310px;">
            <table id="searchedTable">
                <thead style="height: 80px;">
                    <th>Type</th>
                    <th>Sub<br>Type</th>
                    <th>Type/<br>Color</th>
                    <th>Brand</th>
                    <th>Dimension</th>
                    <th>Qty/Unit</th>
                    <th>Packing<br>Unit</th>
                    <th>Grade</th>
                    <th>Code</th>
                    <th>GST</th>
                    <th>Date</th>
                    <th>Batch<br>No</th>
                    <th>Billing<br>Qty</th>
                    <th>Other<br>Qty</th>
                    <th>Base<br>Price</th>
                    <th>Action</th> 
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div> -->
    </div>

    <br>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card card-header">
                    <center>
                        <h2 class="card-titile">Purchased Items</h2>
                    </center>
                </div>

                <div class="card card-body">

                </div>
                <table id="purchasedTable">
                    <thead>
                        <th>Type</th>
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
                        <th>Base<br>Price</th>
                        <th>Purchase<br>Billing Qty</th>
                        <th>Purchase<br>Other Qty</th>
                        <th>Selling<br>Price</th>
                        <th>Action</th>
                    </thead>
                    <tbody>

                    </tbody>
                </table>

                <div class="grid1">
                    <div style="grid-column-start: 1;grid-column-end: 4;">
                        <div class="col-12">
                            <input type="Button" value="Add Other Charge" id="addOtherCharge" class="btn btn-success"
                                style="margin-left: 30px;margin-bottom: 10px; margin-top: 3%;">
                        </div>
                        <div id="ExtraCost">
                        </div>

                        <div class="card-body">
                            <div class="form-group col-md-12">
                                <label class="form-label">Payment detail :</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="payment" id="complete"
                                        value="complete" onchange="checkRadio(this)">
                                    <label class="form-check-label" for="inlineRadio3">Complete</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="payment" id="pending"
                                        value="pending" onchange="checkRadio(this)">
                                    <label class="form-check-label" for="inlineRadio4">Partial</label>
                                </div>
                                <div id="RemAmt" style="display: none;">
                                    <div class="col-md-4">
                                        <input type="number" style="margin-top: 10px;margin-bottom: 10px;" name="Amt"
                                            class="form-control" id="Amt" placeholder="Enter Paid Amount"
                                            onkeyup="calrem()">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <div id="rb1">

                                </div>
                            </div>
                            <div class="form-group col-md-2">
                                <div id="rb2">

                                </div>
                            </div>

                            <div class="form-group col-md-4">
                                <label class="form-label">Remaining Payment: </label>
                                <input type="number" name="rpy" class="form-control" id="rpy" onkeyup="calrem()"
                                    disabled>
                            </div>
                        </div>
                    </div>
                    <div style="grid-column-start: 5;grid-column-end: 6;">

                        <div class="row" style="margin-bottom:2%;margin-top: 5%;">
                            <div class="col-md-4">
                                <label class="form-label">Total :</label>
                            </div>
                            <div class="col-md-6">
                                <input type="number" name="totalcost" class="form-control calsubtotal" id="totalcost"
                                    onkeyup="calsubtotal()" value='0' disabled>
                            </div>
                        </div>

                        <div class="row" style="margin-bottom:2%;">
                            <div class="col-md-4">
                                <label class="form-label">Discount :</label>
                            </div>
                            <div class="col-md-6">
                                <input type="number" name="discount" class="form-control calsubtotal" id="discount"
                                    onkeyup="calsubtotal()" value='0'>
                            </div>
                        </div>

                        <div class="row" style="margin-bottom:2%;">
                            <div class="col-md-4">
                                <label class="form-label">Transportation Cost :</label>
                            </div>
                            <div class="col-md-6">
                                <input type="number" name="transportcost" class="form-control calsubtotal"
                                    id="transportcost" onkeyup="calsubtotal()" value=0>
                            </div>
                        </div>

                        <div class="row" style="margin-bottom:2%;">
                            <div class="col-md-4">
                                <label class="form-label">Sub Total:</label>
                            </div>
                            <div class="col-md-6">
                                <input type="number" name="subtotal" class="form-control calsubtotal" id="subtotal"
                                    onkeyup="callsubtotal()" value='0' disabled>
                            </div>
                        </div>
                    </div>
                </div>

                <form action="../Challan/AddNewChallanAjax/pdf.php" method="POST" target="_blank" id='makepdf'>
                    <input type="hidden" name="challanid" id="challanid">
                </form>
                <div class="row mt-5">
                    <center><button class="btn btn-success" id='confirmchallan'> Confirm Challan </button> <button
                            class="btn btn-success" id='closechallan' onclick="window.location='../admin.php'">
                            Close </button></center>
                </div>
            </div>
        </div>
    </div>
</body>

<script type="text/javascript">
    var stockIdsToBePurchased;
    var addAnotherChargesFlag = false;
    $(function () {

        ReloadSubcategoriesSelectMenu();
        ReloadGradeSelectMenu();
        ReloadBrandSelectMenu();
        ReloadDimesionSelectMenu();
        ReloadQtyPerUnitSelectMenu();
        ReloadProductTypeColorMenu();
        ReloadCodeSelectMenu();
        stockIdsToBePurchased = new Set();
        var cid;
        $("#getCustomerName").prop('disabled', true).chosen();
        $("#getCustomerName").prop('disabled', true).trigger("chosen:updated");

        $('#addOtherCharge').click(function () {
            $('#ExtraCost').append(
                '<form class="row g-3">' +
                '<div class="form-group col-md-2" style="margin-left: 30px; margin-top: 30px;" id="AddChargesRs">' +
                '<input type="number" name="extraCost" class="form-control col-md-2" id="extraCost" placeholder="Extra Cost" onkeyup="calsubtotal(); validateCost();">' +
                '</div>' +
                '<div class="form-group col-md-4" style="margin-top: 30px;" id="AddChargesDes">' +
                '<input type="text" name="extraCostDes" class="form-control" id="extraCostDes" placeholder="Description of Extra Cost">' +
                '</div>' +
                '<div class="form-group col-md-1" style="margin-top: 35px;" id="CancelField" >' +
                '<button type="button" class="btn-close" id="closeButton" onclick="cancelField()"></button>' +
                '</div>' +
                '<div></div>' +
                '</form>'
            );
            $('#addOtherCharge').attr("disabled", true);
            addAnotherChargesFlag = true;
        });

        $('input[type=radio][name=customer]').change(function () {
            if (this.id == 'ec') {

                $.ajax({
                    type: 'POST',
                    url: "./AddNewChallanAjax/getCustomerName.php",
                    dataType: "json",
                    success: function (Data) {
                        console.log(Data);
                        if (Data[0].FLAG == "SUCCESS") {
                            let n = Data.length;
                            for (let i = 1; i < n; i++) {
                                $("#getCustomerName").append(new Option(Data[i].customerName + " " + Data[i].customerNo, Data[i].customerId));
                            }
                            $('#getCustomerName').prop('disabled', false).chosen();
                            $('#getCustomerName').prop('disabled', false).trigger("chosen:updated");
                        }
                        else if (Data[0].FLAG == "NORECORDFOUND") {
                            console.log("NO RECORD FOUND");
                            swal('Something Went Wrong', '', 'error');
                        }
                        else if (Data[0].FLAG == "ERRORINQUERYEXECUTION") {
                            console.log("ERROR IN QUERY EXECUTION");
                            swal('Something Went Wrong', '', 'error');
                        }
                        else {
                            console.log("ERROR");
                            swal('Something Went Wrong', '', 'error');
                        }
                    },
                    error: function (Data) {

                    }
                });
            }
            else if (this.id == 'nc') {
                $("#getCustomerName").prop('disabled', true).chosen();
                $("#getCustomerName").prop('disabled', true).trigger("chosen:updated");
                window.location.href = '../Customer/NewCustomer.php';
            }
        });

        function validateChallanMetaData() {
            var challanDate = $("#getChallanDate").val();
            var customerId = $("#getCustomerName").val();
            if (challanDate != '' && customerId != "-1") {
                return true;
            }
            else {
                return false;
            }
        }

        $("#category_name").on('change', function () {

            ResetSelectMenu($("#subcategories"));
            ResetSelectMenu($("#getbrandname"));
            ResetSelectMenu($("#getgrade"));
            $("#hsn").val(" ");
            $("#gst").val(" ");
            $("#searchedTable tbody").empty();
            let cid = $('#category_name').val();
            console.log(cid);

            if (cid != '-1') {
                console.log('Hello');
                $.ajax({
                    type: "POST",
                    url: "./AddNewChallanAjax/getSubcategoriesFromCategories.php",
                    data: { cid: cid },
                    dataType: "json",
                    success: function (Data) {
                        console.log(Data);
                        if (Data[0].FLAG == 'OK') {
                            let n = Data.length;
                            for (let i = 1; i < n; i++) {
                                scn = Data[i].scn;
                                sci = Data[i].sci;
                                $("#subcategories").append(new Option(scn, sci));
                            }
                        }
                        else if (Data[0].FLAG == "NORECORDFOUND") {
                            console.log("No Subcategory Found For Given Category");
                            swal('No Subcategory Found For Given Category', '', 'error');
                        }
                        else if (Data[0].FLAG == "NOTOK") {
                            console.log("Error In Executing Query");
                            swal('Something went wrong', '', 'error');
                        }
                        else {
                            console.log('Other Response Found');
                            swal('Something Went Wrong', '', 'error');
                        }
                    },
                    error: function (Data) {
                        console.log("Error In Ajax Call In Categories Change Event");
                        swal('Something Went Wrong', '', 'error');
                        console.log(Data.status);
                        console.log(Data.statusText);
                        console.log(Data.responseText);
                    }
                });
            }
            else {
                ReloadSubcategoriesSelectMenu();
            }
        });

        $("#subcategories").on('change', function () {
            ResetSelectMenu($("#getbrandname"));
            ResetSelectMenu($("#getgrade"));
            $("#hsn").val(" ");
            $("#gst").val(" ");
            $("#searchedTable tbody").empty();
            var subcatid = $("#subcategories").val();
            console.log(subcatid);
            if (subcatid != "-1") {
                $.ajax({
                    type: "POST",
                    url: "./AddNewChallanAjax/getBrandsFromSubcategory.php",
                    data: { subcatid: subcatid },
                    dataType: 'json',
                    success: function (Data) {
                        console.log(Data);
                        if (Data[0].FLAG == "OKK") {
                            var n = Data.length;

                            for (var i = 1; i < n; i++) {
                                $("#getbrandname").append(new Option(Data[i].brandname, Data[i].brandid));
                                //$("#selectbrand").append('<option value='+Data[i].brandid+' showvalue='+Data[i].brandname+'>'+Data[i].brandname+'</option>');
                            }
                        }
                        else if (Data[0].FLAG == "RECORDNOTFOUND") {
                            console.log("No Brands Found For Selected Category And Subcategory");
                            swal("No Brands Found For Selected Category And Subcategory", '', 'error');
                        }
                        else if (Data[0].FLAG == 'ERRORINEXECUTINGQUERY') {
                            console.log("ERROR IN EXECUTING QUERY");
                            swal("Something Went Wrong", '', 'error');
                        }
                        else {
                            console.log('Other Then Flag');
                            swal('Something Went Wrong', '', 'error');
                        }
                    },
                    error: function (Data) {
                        console.log('Error In Ajax Call ' + Data);
                        swal('Something Went Wrong', '', 'error');
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "./AddNewChallanAjax/getHSNGSTFromSubcategory.php",
                    data: { subcatid: subcatid },
                    dataType: 'json',
                    success: function (Data) {
                        console.log(Data);
                        if (Data[0].FLAG == "OKK") {
                            $("#hsn").val(Data[1].hsnnum);
                            $("#gst").val(Data[1].gstnum);
                        } else if (Data[0].FLAG == "RECORDNOTFOUND") {
                            console.log("No Brands Found For Selected Category And Subcategory");
                            swal("No Brands Found For Selected Category And Subcategory", '', 'error');
                        } else if (Data[0].FLAG == 'ERRORINEXECUTINGQUERY') {
                            console.log("ERROR IN EXECUTING QUERY");
                            swal("Something Went Wrong", '', 'error');
                        } else {
                            console.log('Other Then Flag');
                            swal('Something Went Wrong', '', 'error');
                        }
                    },
                    error: function (Data) {
                        console.log('Error In Ajax Call ' + Data);
                        swal('Something Went Wrong', '', 'error');
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "./AddNewChallanAjax/getGradesFromSubcategory.php",
                    data: { subcatid: subcatid },
                    dataType: 'json',
                    success: function (Data) {
                        console.log(Data);
                        if (Data[0].FLAG == "OKK") {
                            var n = Data.length;

                            for (var i = 1; i < n; i++) {
                                $("#getgrade").append(new Option(Data[i].gradetext, Data[i].gradeid));
                                //$("#selectgrade").append('<option value='+Data[i].gradeid+' showvalue='+Data[i].gradetext+'>'+Data[i].gradetext+'</option>');
                            }
                        }
                        else if (Data[0].FLAG == "RECORDNOTFOUND") {
                            console.log("No Grade Found For Selected Category And Subcategory");
                            swal("No Grade Found For Selected Category And Subcategory", '', 'error');
                        }
                        else if (Data[0].FLAG == 'ERRORINEXECUTINGQUERY') {
                            console.log("ERROR IN EXECUTING QUERY");
                            swal("Something Went Wrong", '', 'error');
                        }
                        else {
                            console.log('Other Then Flag');
                            swal('Something Went Wrong', '', 'error');
                        }
                    },
                    error: function (Data) {
                        console.log('Error In Ajax Call ' + Data);
                        swal('Something Went Wrong', '', 'error');
                    }
                });
            }
            else {
                ReloadGradeSelectMenu();
                ReloadBrandSelectMenu();
            }

        });

        $("#searchbtn").click(function () {
            $("#searchedTable tbody").empty();
            var category = $("#category_name").val();
            var subcategory = $("#subcategories").val();
            var brandname = $("#getbrandname").val();
            var hsncode = $("#hsn").val();
            var grade = $("#getgrade").val();
            var colortype = $("#getProductTypeColor").val();
            var dimension = $("#getdimension").val();
            var qtyperunit = $("#getqtyperunit").val();
            var packingunit = $("#getpackingunit").val();
            var codeno = $("#getcode").val();
            var gstno = $("#gst").val();

            if (category != '-1' && subcategory != '-1' && brandname != '-1' && hsncode != ' ' && grade != '-1' && colortype != '-1' && dimension != '-1' && qtyperunit != '-1' && packingunit != '-1' && codeno != '-1' && gstno != ' ') {
                $.ajax({
                    type: "POST",
                    url: "./AddNewChallanAjax/searchProductId.php",
                    data: { category: category, subcategory: subcategory, brandname: brandname, hsncode: hsncode, grade: grade, colortype: colortype, dimension: dimension, qtyperunit: qtyperunit, packingunit: packingunit, codeno: codeno, gstno: gstno },
                    dataType: 'json',
                    success: function (Data) {
                        console.log(Data);
                        if (Data[0].FLAG == "OKK") {
                            $("#pid").val(Data[1].productid);
                            var productid = $("#pid").val();
                            $.ajax({
                                type: "POST",
                                url: "./AddNewChallanAjax/searchFromStocks.php",
                                data: { productid: productid },
                                dataType: 'json',
                                success: function (Data) {
                                    console.log(Data);
                                    if (Data[0].FLAG == "RECORDFOUND") {
                                        let n = Data.length;
                                        console.log(Data);
                                        for (let i = 1; i < n; i++) {
                                            var category = $('#category_name option:selected').html();
                                            var subcategory = $('#subcategories option:selected').html();
                                            var brandname = $('#getbrandname option:selected').html();
                                            var grade = $('#getgrade option:selected').html();
                                            var billingqty = Data[i].billingqty;
                                            var otherqty = Data[i].otherqty;
                                            var baseprice = Data[i].baseprice;
                                            var dateadded = Data[i].dateAdded;
                                            var stockid = Data[i].stockid;
                                            var batchno = Data[i].batchno;
                                            dateadded = splitDate(dateadded);

                                            $("#searchedTable tbody:last-child").append(
                                                '<tr>' +
                                                '<td>' + category + '</td>' +
                                                '<td>' + subcategory + '</td>' +
                                                // '<td>' + hsncode + '</td>' +
                                                '<td>' + colortype + '</td>' +
                                                '<td>' + brandname + '</td>' +
                                                '<td>' + dimension + '</td>' +
                                                '<td>' + qtyperunit + '</td>' +
                                                '<td>' + packingunit + '</td>' +
                                                '<td>' + grade + '</td>' +
                                                '<td>' + codeno + '</td>' +
                                                '<td>' + gstno + '</td>' +
                                                '<td>' + dateadded + '</td>' +
                                                '<td>' + batchno + '</td>' +
                                                '<td>' + billingqty + '</td>' +
                                                '<td>' + otherqty + '</td>' +
                                                '<td>' + baseprice + '</td>' +
                                                '<td><input type="button" class="btn btn-primary selectbtn" pid="' + productid + '" stockid="' + stockid + '"value="Select"></center></td>' +
                                                '</tr>'
                                            );
                                        }
                                    } else if (Data[0].FLAG == "NORECORDFOUND") {
                                        swal('NO Record Found For Your Search Result', '', 'error');
                                    } else if (Data[0].FLAG == "ERRORINQUERY") {
                                        swal('Error In Query', '', 'error');
                                    }
                                },
                                error: function (Data) {
                                    console.log('Error In Ajax Call ' + Data);
                                    swal('Something Went Wrong', '', 'error');
                                }
                            });
                        } else if (Data[0].FLAG == "RECORDNOTFOUND") {
                            console.log("No Such Product Found");
                            swal("No Such Product Found", '', 'error');
                        }
                        else if (Data[0].FLAG == 'ERRORINEXECUTINGQUERY') {
                            console.log("ERROR IN EXECUTING QUERY");
                            swal("Something Went Wrong", '', 'error');
                        }
                        else {
                            console.log('Other Then Flag');
                            swal('Something Went Wrong', '', 'error');
                        }
                    },
                    error: function (Data) {
                        console.log('Error In Ajax Call ' + Data);
                        swal('Something Went Wrong', '', 'error');
                    }
                });
            } else {
                swal('All Fields are Required.', '', 'error');
            }
        });

        $("#searchedTable").on('click', '.selectbtn', function () {
            console.log($(this).attr('stockid'));
            var stockid = $(this).attr('stockid');

            if (!stockIdsToBePurchased.has(stockid)) {
                stockIdsToBePurchased.add(stockid);
                let tr = $(this).parent().siblings();

                let obj = Array();

                for (let i = 0; i < 15; i++) {
                    obj.push(tr.html());
                    tr = tr.next();
                }

                var trToBeAppend =
                    '<tr>' +
                    '<td>' + obj[0] + '</td>' +
                    '<td>' + obj[1] + '</td>' +
                    '<td>' + obj[2] + '</td>' +
                    '<td>' + obj[3] + '</td>' +
                    '<td>' + obj[4] + '</td>' +
                    '<td>' + obj[5] + '</td>' +
                    '<td>' + obj[6] + '</td>' +
                    '<td>' + obj[7] + '</td>' +
                    '<td>' + obj[8] + '</td>' +
                    '<td>' + obj[10] + '</td>' +
                    '<td>' + obj[11] + '</td>' +
                    '<td>' + obj[12] + '</td>' +
                    '<td>' + obj[13] + '</td>' +
                    '<td>' + obj[14] + '</td>' +
                    '<td width="7%" ><input type="number" step="1" class="form-control purchase-qty calprice" onkeyup="validateQty(this,' + obj[12] + '); calprice();calsubtotal();" id="billingqty_' + $(this).attr("stockid") + '" >' +
                    '<td width="7%" ><input type="number" step="1" class="form-control purchase-qty calprice" onkeyup="validateQty(this,' + obj[13] + '); calprice();calsubtotal();" id="otherqty_' + $(this).attr("stockid") + '" >' +
                    '<td width="7%" ><input class="form-control selling-price calprice" type="number" onkeyup="calprice();calsubtotal();" id="sellingprice_' + $(this).attr("stockid") + '">' + '</td>' +
                    '<td><button value="Remove" class="btn btn-danger removebtn" stockid="' + $(this).attr('stockid') + '">Remove</button></td>' +
                    '</tr>';

                $("#purchasedTable tbody:last-child").append(trToBeAppend);
            }
            else {
                swal('Item Alredy Present Inside Purchased Items List', '', 'error');
            }
        });

        $("#purchasedTable").on('click', '.removebtn', function () {
            var stockid = $(this).attr('stockid');
            console.log(stockid);
            if (stockIdsToBePurchased.delete(stockid)) {
                var p = $(this).parent().parent().remove();
                calprice();
                calsubtotal();
            }
            else {
                console.log('Error in remove')
            }
        });

        $("#confirmchallan").click(function () {
            if ($("#purchasedTable tbody").children().length) {
                var challandate = $("#getChallanDate").val();
                var customerId = $("#getCustomerName").val();
                var totalamt = $("#totalcost").val();
                var discount = $("#discount").val();
                var transport = $("#transportcost").val();
                var extraCost = 0;
                var paymentAdvance = 0;

                if (addAnotherChargesFlag == true) {
                    extraCost = $("#extraCost").val();
                    console.log(extraCost);
                    extraCostDesc = $("#extraCostDes").val();
                    if (extraCost == "") {
                        swal("Enter Extra Cost Amount", '', 'info');
                        return;
                    }
                    if (extraCostDesc == "") {
                        swal("Enter Extra Cost Description", '', 'info');
                        return;
                    }
                }else {
                    extraCost = 0;
                    extraCostDesc = "";
                }

                if ($("#complete").prop('checked') == true || $("#pending").prop("checked") == true) {
                    if($("#complete").prop('checked') == true){
                        paymentAdvance = $("#subtotal").val();
                    }else{
                        if ($("#Amt").val() == "") {
                            swal("Please Enter Payment Amount", '', 'info');
                            return;
                        }
                        paymentAdvance = $("#Amt").val();
                    }
                }else {
                    swal("Payment Details Empty ", 'Select Complete Payment Or Partial Payment', 'info');
                    return;
                }

                if (totalamt == "") {
                    swal('Total Amount Empty', '', 'info');
                    return;
                }else {
                    totalamt = parseFloat(totalamt);
                    if (totalamt <= 0) {
                        swal("Total Amount Can't Be Nagetive").then(() => {
                            return;
                        });
                    }
                }

                if (discount == "") {
                    swal('Discount Empty', '', 'info');
                    return;
                }else {
                    discount = parseFloat(discount);
                    if (discount < 0) {
                        swal("Discount Can't Be Nagetive", '', 'info').then(() => {
                            return;
                        });
                    }else if (discount > totalamt) {
                        swal("Discount Can't Be Greater Then Total Amount").then(() => {
                            return;
                        });
                    }
                }

                if (transport == "") {
                    swal('Transportation Cost Empty', '', 'info');
                    return;
                }else {
                    transport = parseFloat(transport);
                    if (transport < 0) {
                        swal("Transporatation Cost Can't Be Nagetive", '', 'info').then(() => {
                            return;
                        });
                    }
                }

                console.log("Payment At Time : " + paymentAdvance);
                
                if (customerId != '-1' && challandate != '') {
                    var itr = stockIdsToBePurchased[Symbol.iterator]();
                    var n = stockIdsToBePurchased.size;
                    var challanpack = Array();
                    var custidobj = { challandate: challandate, customerId: customerId, totalamt: totalamt, discount: discount, transport: transport, extracost: extraCost, extracostdesc: extraCostDesc, advancepayment: paymentAdvance };
                    challanpack.push(custidobj);

                    for (let i = 0; i < n; i++) {
                        var tempstockid = itr.next().value;
                        var billingQty = parseInt($("#billingqty_" + tempstockid).val());
                        var otherQty = parseInt($("#otherqty_" + tempstockid).val());
                        var sellingPrice = parseFloat($("#sellingprice_" + tempstockid).val());

                        if(billingQty == 0 && otherQty == 0){
                            swal('Billing Quantity and Other Quantity both shuld not be 0 for same product','','error');
                            return;
                        }
                            
                        var challanitemobj = {
                            stockid: tempstockid,
                            billqty: billingQty,
                            otherqty: otherQty,
                            sellprice: sellingPrice
                        };
                        challanpack.push(challanitemobj);
                    }

                    $.ajax({
                        type: "POST",
                        url: "./AddNewChallanAjax/addNewChallanInDatabase.php",
                        data: JSON.stringify(challanpack),
                        dataType: 'json',
                        success: function (Data) {
                            console.log(Data);
                            if (Data[0].FLAG == "SUCCESS") {
                                var challanid = Data[1].CHALLANID;
                                $("#challanid").val(challanid);
                                console.log('CHALLAN ID IN FORM : ' + $('#challanid').val());
                                swal('Challan Generated Successfully.', '', 'success').then(function () {
                                    $("#makepdf").submit();
                                    location.reload(true);
                                });
                            } else if (Data[0].FLAG == "ERRCOMMIT") {
                                console.log('Error While Commit');
                                swal('Something Went Wrong', '', 'error');

                            } else if (Data[0].FLAG == "MIDERR") {
                                console.log('Error In Middle Execution');
                                swal('Something Went Wrong', '', 'error');

                            } else if (Data[0].FLAG == "ERRINSERTMST") {
                                console.log('Error While Inserting In Challan MST');
                                swal('Something Went Wrong', '', 'error');

                            } else if (Data[0].FLAG == "PARAMEMPTY") {
                                console.log('Parameter Empty');
                                swal('Something Went Wrong', '', 'error');

                            }
                            else if (Data[0].FLAG == "ERRINM") {
                                console.log("Error In Inserting Month");
                                swal('Something Went Wrong', '', 'error');
                            }
                            else if (Data[0].FLAG == "ERRINGLMID") {
                                console.log("Error In Getting Last Month Id");
                                swal('Something Went Wrong', '', 'error');
                            }
                            else if (Data[0].FLAG == "ERRINULMID") {
                                console.log("Error In Updating Last Challan No Of Month");
                                swal('Something Went Wrong', '', 'error');
                            }
                            else if (Data[0].FLAG == "ERRINULMID") {
                                console.log("Error In Insertiong Payment Details in tblinwardpayment");
                                swal('Something Went Wrong', '', 'error');
                            }
                            else {
                                console.log('Other Flag Recived');
                                swal('Something Went Wrong', '', 'error');
                            }
                        },
                        error: function (Data) {
                            console.log('Error In Ajax Call');
                            swal("Something Went Wrong", '', 'error');
                        }
                    });
                } else {
                    console.log("CustomerId is Null");
                    swal('Please Fill All The Details', '', 'error');
                }
            } else {
                swal("No Items Selected", '', 'error');
            }
        });

        function ReloadGradeSelectMenu() {
            ResetSelectMenu($("#getgrade"));
            $.ajax({
                type: "POST",
                url: "./AddNewChallanAjax/getGrades.php",
                dataType: 'json',
                success: function (Data) {
                    if (Data[0].FLAG == 'OKK') {
                        var n = Data.length;
                        for (var i = 1; i < n; i++) {
                            $("#getgrade").append(new Option(Data[i].gradetext, Data[i].gradeid));
                        }
                        //$("#getgrade").prop('disabled', false);
                    }
                    else if (Data[0] == 'ERRORINEXECUTINGQUERY') {
                        console.log("ERROR IN EXECUTING QUERY");
                        swal('Something Went Wrong', '', 'error');
                    }
                    else {
                        console.log('OTHER THEN FLAG');
                        swal('Something Went Wrong', '', 'error');
                    }
                },
                error: function (Data) {
                    console.log(Data);
                    swal('Something Went Wrong', '', 'error');
                }
            });
        }

        function ReloadBrandSelectMenu() {
            ResetSelectMenu($("#getbrandname"));
            $.ajax({
                type: "POST",
                url: "./AddNewChallanAjax/getBrandNames.php",
                dataType: 'json',
                success: function (Data) {
                    if (Data[0].FLAG == 'OKK') {
                        var n = Data.length;
                        for (var i = 1; i < n; i++) {
                            $("#getbrandname").append(new Option(Data[i].brandname, Data[i].brandid));
                        }
                        //$("#getbrandname").prop('disabled', false);
                    }
                    else if (Data[0] == 'ERRORINEXECUTINGQUERY') {
                        console.log("ERROR IN EXECUTING QUERY");
                        swal('Something Went Wrong', '', 'error');
                    }
                    else {
                        console.log('OTHER THEN FLAG');
                        swal('Something Went Wrong', '', 'error');
                    }
                },
                error: function (Data) {
                    console.log(Data);
                    swal('Something Went Wrong', '', 'error');
                }
            });
        }

        function ReloadSubcategoriesSelectMenu() {
            ResetSelectMenu($("#subcategories"));
            $.ajax({
                type: "POST",
                url: "./AddNewChallanAjax/getAllSubCategories.php",
                dataType: 'json',
                success: function (Data) {
                    console.log(Data);
                    if (Data[0].FLAG == 'OK') {
                        let n = Data.length;
                        for (let i = 1; i < n; i++) {
                            scn = Data[i].scn;
                            sci = Data[i].sci;
                            $("#subcategories").append(new Option(scn, sci));
                        }
                    }
                    else if (Data[0].FLAG == "NORECORDFOUND") {
                        console.log("No Subcategory Found For Given Category");
                        swal('No Subcategory Found For Given Category', '', 'error');
                    }
                    else if (Data[0].FLAG == "NOTOK") {
                        console.log("Error In Executing Query");
                        swal("Something Went Wrong", '', 'error');
                    }
                    else {
                        console.log('Other Response Found');
                        swal('Something Went Wrong', '', 'error');
                    }
                },
                error: function (Data) {
                    console.log("Error In ./AddNewChallanAjax/getAllSubCategories.php   Ajax Call");
                    console.log(Data.responseText);
                    console.log(Data.statusText);
                }
            });
        }

        function ReloadDimesionSelectMenu() {

            ResetSelectMenu($("#getdimension"));
            $.ajax({
                type: "POST",
                url: "./AddNewChallanAjax/getAllDimesnsions.php",
                dataType: 'json',
                success: function (Data) {
                    console.log(Data);
                    if (Data[0].FLAG == "OKK") {
                        var n = Data.length;

                        for (var i = 1; i < n; i++) {
                            $("#getdimension").append(new Option(Data[i].dimension, Data[i].dimension));
                        }
                    }
                    else if (Data[0].FLAG == "NORECORD") {
                        console.log("No Record Found");
                        swal("No Record Found", '', 'error');
                    }
                    else if (Data[0].FLAG == "ERREXECUTINGQUERY") {
                        console.log('Error In Executing Query');
                        swal("Something Went Wrong", '', 'error');
                    }
                    else {
                        console.log("Other Response FOund");
                        swal('Something Went Wrong', '', 'error');
                    }
                },
                error: function (Data) {
                    console.log("Erroe In ./AddNewChallanAjax/getAllDimesnsions.php   AJax Call");
                    swal("Something Went Wrong", '', 'error');
                }
            });
        }

        function ReloadQtyPerUnitSelectMenu() {
            ResetSelectMenu($("#getqtyperunit"));

            $.ajax({
                type: "POST",
                url: "./AddNewChallanAjax/getQtyPerUnit.php",
                dataType: 'json',
                success: function (Data) {
                    console.log(Data);
                    if (Data[0].FLAG == "OKK") {
                        var n = Data.length;

                        for (var i = 1; i < n; i++) {
                            $("#getqtyperunit").append(new Option(Data[i].qtyperunit, Data[i].qtyperunit));
                        }
                    }
                    else if (Data[0].FLAG == "NORECORD") {
                        console.log("No Record Found");
                        swal("No Record Found", '', 'error');
                    }
                    else if (Data[0].FLAG == "ERREXECUTINGQUERY") {
                        console.log('Error In Executing Query');
                        swal("Something Went Wrong", '', 'error');
                    }
                    else {
                        console.log("Other Response FOund");
                        swal('Something Went Wrong', '', 'error');
                    }
                },
                error: function (Data) {
                    console.log("Erroe In ./AddNewChallanAjax/getAllDimesnsions.php   AJax Call");
                    swal("Something Went Wrong", '', 'error');
                }
            });
        }

        function ReloadProductTypeColorMenu() {
            //function getProductTypeColor(){
            ResetSelectMenu($("#getProductTypeColor"));
            $.ajax({
                type: "POST",
                url: "./AddNewChallanAjax/getProductTypeColor.php",
                dataType: 'json',
                success: function (Data) {
                    console.log(Data);
                    if (Data[0].FLAG == "OKK") {
                        var n = Data.length;
                        for (var i = 1; i < n; i++) {
                            $("#getProductTypeColor").append(new Option(Data[i].producttypecolor, Data[i].producttypecolor));
                        }
                    }
                    else if (Data[0].FLAG == "NORECORD") {
                        console.log("No Record Found");
                        swal("No Record Found", '', 'error');
                    }
                    else if (Data[0].FLAG == "ERREXECUTINGQUERY") {
                        console.log('Error In Executing Query');
                        swal("Something Went Wrong", '', 'error');
                    }
                    else {
                        console.log("Other Response FOund");
                        swal('Something Went Wrong', '', 'error');
                    }
                },
                error: function (Data) {
                    console.log("Erroe In  ./AddNewChallanAjax/getProductTypeColor.php AJax Call");
                    swal("Something Went Wrong", '', 'error');
                }
            });
        }

        function ReloadCodeSelectMenu() {
            ResetSelectMenu($("#getcode"));

            $.ajax({
                type: "POST",
                url: "./AddNewChallanAjax/getCode.php",
                dataType: 'json',
                success: function (Data) {
                    console.log(Data);
                    if (Data[0].FLAG == "OKK") {
                        var n = Data.length;

                        for (var i = 1; i < n; i++) {
                            $("#getcode").append(new Option(Data[i].code, Data[i].code));
                        }
                    }
                    else if (Data[0].FLAG == "NORECORD") {
                        console.log("No Record Found");
                        swal("No Record Found", '', 'error');
                    }
                    else if (Data[0].FLAG == "ERREXECUTINGQUERY") {
                        console.log('Error In Executing Query');
                        swal("Something Went Wrong", '', 'error');
                    }
                    else {
                        console.log("Other Response FOund");
                        swal('Something Went Wrong', '', 'error');
                    }
                },
                error: function (Data) {
                    console.log("Error In  ./AddNewChallanAjax/getCode.php AJax Call");
                    swal("Soething Went Wrong", '', 'error');
                }
            });
        }

        function ResetSelectMenu(sm) {
            sm.empty();
            sm.append(new Option("Select", "-1"));
        }

    });

    function validateQty(obj, maxqty) {
        var qty = obj.value;

        dotqty = qty - Math.trunc(qty)
        if (dotqty <= 0) {
            if (qty > maxqty) {
                alert('Max Stock Qty = ' + maxqty);
                obj.value = "";
            }
            else if (qty < 0) {
                alert('Quantity Cant Be Minus');
                obj.value = "";
            }
        }
        else {
            alert("Qty Cant Be Float");
            obj.value = "";
        }
    }

    function calprice() {
        var itr = stockIdsToBePurchased[Symbol.iterator]();
        var n = stockIdsToBePurchased.size;
        var totalprice = 0;
        for (let i = 0; i < n; i++) {

            var tempstockid = itr.next().value;
            var billingQty = parseInt($("#billingqty_" + tempstockid).val());
            var otherQty = parseInt($("#otherqty_" + tempstockid).val());
            var sellingPrice = parseFloat($("#sellingprice_" + tempstockid).val());
            totalprice = parseFloat((totalprice + (billingQty * sellingPrice) + (otherQty * sellingPrice)));
        }
        document.getElementById("totalcost").value = totalprice;

    }

    function calsubtotal() {
        console.log("HELLLLO");
        var total = document.getElementById("totalcost").value;
        var discount = document.getElementById("discount").value;
        if (discount == "") {
            discount = 0;
            return;
        }
        total = parseFloat(total);
        discount = parseFloat(discount);
        if (discount > total) {
            swal("Discount Can't Be Greater Then Total").then(() => {
                document.getElementById("discount").value = 0;
                $("#discount").focus();
                $("#Amt").val("");
                return;
            });
        }
        if (discount < 0) {
            swal("Discount Can't Be Nagetive").then(() => {
                document.getElementById("discount").value = 0;
                $("#discount").focus();
                $("#Amt").val("");
                return;
            });
        }
        var transport = document.getElementById("transportcost").value;
        transport = parseFloat(transport);
        if (transport < 0) {
            swal("Transportation Cost Can't Be Nagetive").then(() => {
                document.getElementById("transportcost").value = 0;
                $("#transportcost").focus();
                return;
            });
        }

        var extraCost = 0;
        if (addAnotherChargesFlag == true) {
            extraCost = $('#extraCost').val();
            if (extraCost == "") {
                extraCost = 0;
            }
        }
        var subtotal = total - discount + Number.parseFloat(transport) + Number.parseFloat(extraCost);
        document.getElementById("subtotal").value = subtotal;
        calrem();
    }

    function splitDate(date) {
        var DateArray = date.split(" ");
        DateArray = DateArray[0];
        DateArray = DateArray.split("-");
        return (DateArray[2]+"-"+DateArray[1]+"-"+DateArray[0]);
    }

    function validateCost() {
        if (parseFloat($("#extraCost").val()) <= 0) {
            swal("Extra Cost Can't Be Nagetive Or Zero", '', 'info').then(() => {
                $("#extraCost").val("0");
                return;
            });
        }
    }
</script>