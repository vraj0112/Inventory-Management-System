<!DOCTYPE html>
<html lang="en">
<?php include('./config.php');?>

<head>
    <title>Invoice</title>
    <style type="text/css">
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
    <script src="https://cdn.jsdelivr.net/npm/table-to-json@1.0.0/lib/jquery.tabletojson.min.js" integrity="sha256-H8xrCe0tZFi/C2CgxkmiGksqVaxhW0PFcUKZJZo1yNU=" crossorigin="anonymous"></script>
	
    <script>
	  

        function checkRadio(radio) {
            if (radio.id === "complete") {
                document.getElementById("rpy").value = "0";
                document.getElementById("rpy").readOnly = true;
                document.getElementById("RemAmt").style.display = "none";
            } else if (radio.id === "pending") {
                document.getElementById("RemAmt").style.display = "block";
            }
        }

        function calrem() {
            var tot = parseInt(document.getElementById('tp').value);
            var pen = parseInt(document.getElementById('Amt').value);
            var remain = tot - pen;
            document.getElementById('rpy').value = remain;
        }

        function cancelField() {
            document.getElementById("ExtraCost").innerHTML = "";
            document.getElementById("addOtherCharge").disabled = false;
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
    // $num=1;
    
    $today = $year . '-' . $month . '-' . $day;
    // $num=str_pad($num, 3, "0", STR_PAD_LEFT);
    // $challanNo = $year.$month.$num;
?>

<body>
    <div class="container-fluid col-lg-12">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header" style="background-color: #2B60DE">
                        <center>
                            <h3 class="card-title" style="color: white">Invoice</h3>
                        </center>
                        <?php //echo $challanNo;?>
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-2">
                                <label class="form-label mt-1" style="margin-left: 2px">Date:</label>
                                <input type="date" id="getInvoiceDate" name="getInvoiceDate" class="form-control"
                                    value="<?php echo $today; ?>">
                            </div>

                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label mt-1" style="margin-left: 20%;">Customer :</label>

                                        <label for="ec" class="mt-1" style="margin-left: 5%;"><input
                                                class="form-check-input mt-1 radio" type="radio" name="customer" id="ec"
                                                value="ec"> Existing Customer</label>


                                        <label for="nc" class="mt-1" style="margin-left: 5%;"><input
                                                class="form-check-input mt-1 radio" type="radio" name="customer" id="nc"
                                                value="nc"> New Customer</label>
                                    </div>
                                </div>
                                <div class="col-md-4" style="margin-left: 20%;">
                                    <select class="form-select" name="" id="getCustomerName">
                                        <option value="-1">Select</option>

                                    </select>
                                </div>

                            </div>
                        </div>

                        <hr>

                        <div class="row mt-3">
                            <div class="form-group col-md-1">
                                <label class="form-label">Product Type: </label>
                            </div>
                            <div class="col-md-2">
                                <select id="category_name"
                                    class="form-select col-md-12 resetsearchparam class-category">
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
                                                    //"<option value='".$category_id."' cid=".$category_id.">".$category_name."</option>";
                                                    "<option value='".$category_id."'>".$category_name."</option>";
                                            }
                                        }
                                        else
                                        {
                                            echo "<script>alert('Something Went Wrong');</script>";
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
                                    <option value="kg">KG</option>
                                    <option value="Piece">Piece</option>
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
                            <div class="col-md-6">
                                <input type="Button" value="Search" id="searchbtn" class="btn btn-success">
                                <input style="margin-left: 8px;" type="button" value="Close"  name="close" id="close" class="btn btn-success" onclick="location.href = '../admin.php';">
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
                            <th>HSN<br>Code</th>
                            <th>Type/<br>Color</th>
                            <th>Brand</th>
                            <th>Dimension</th>
                            <th>Qty/Unit</th>
                            <th>Packing<br>Unit</th>
                            <th>Grade</th>
                            <th>Code</th>
                            <th>GST</th>
                            <th>Billing<br>Qty</th>
                         <!--  <th>Other<br>Qty</th> -->
                            <th>Base<br>Price</th>
                            <th>Date</th>
                            <th>Action</th>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
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
                            <th>Date</th>
                            <th>Code</th>
                            <th>Billing<br>Qty</th>
                            <th>Purchase<br>Billing Qty</th>
                            <th> GST</th>
                            <th>Selling<br>Price</th>
                            <th>Base<br>Price</th>
                            <th>Total<br>GST</th>
                            <th>Grand<br>TOtal</th> 
                            <th>Action</th>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>

                    <div class="grid1">
                        <div style="grid-column-start: 1;grid-column-end: 4;">
                            <div class="col-12">
<!--                                 <input type="Button" value="Add Other Charge" id="addOtherCharge"
                                    class="btn btn-success"
                                    style="margin-left: 30px;margin-bottom: 10px; margin-top: 3%;"> -->
                            </div>
                            <div id="ExtraCost">
                            </div>

<!--                             <div class="card-body">
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
                                        <label class="form-check-label" for="inlineRadio4">Pending</label>
                                    </div>
                                    <div id="RemAmt" style="display: none;">
                                        <div class="col-md-4">
                                            <input type="number" style="margin-top: 10px;margin-bottom: 10px;"
                                                name="Amt" class="form-control" id="Amt" placeholder="Enter Paid Amount"
                                                onchange="calrem()">
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
                                    <input type="number" name="rpy" class="form-control" id="rpy" onfocus="calrem()"
                                        disabled>
                                </div>
                            </div> -->
                        </div>
                        <div style="grid-column-start: 5;grid-column-end: 6;">

                            <div class="row" style="margin-bottom:2%;margin-top: 5%;">
                                <div class="col-md-4">
                                    <label class="form-label">Total :</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="number" name="totalcost" class="form-control calsubtotal"
                                        id="totalcost" onkeyup="calsubtotal()" disabled>
                                </div>
                            </div>

                            <div class="row" style="margin-bottom:2%;">
                                <div class="col-md-4">
                                    <label class="form-label">Discount :</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="number" name="discount" class="form-control calsubtotal" id="discount"
                                        onkeyup="calsubtotal()" value=0>
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
                                        onkeyup="callsubtotal()" disabled>
                                </div>
                            </div>


                        </div>
                    </div>

                    <form action="../Invoice/AddNewInvocieAjax/pdf.php" method="POST" target="_blank" id='makepdf'> <input
                            type="hidden" name="Invoiceid" id="Invoiceid"></form>
                    <div class="row mt-5">
                        <center><button class="btn btn-success" id='confirmInvoice'> Confirm Invoice </button> <button
                                class="btn btn-success" id='closechallan' onclick="window.location='../admin.php'"> Close </button></center>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script type="text/javascript">
    var stockIdsToBePurchased;
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
                '<div class="form-group col-md-1" style="margin-left: 30px; margin-top: 30px;" id="AddChargesRs.">' +
                '<input type="text" name="extraCost" class="form-control col-md-2" id="extraCost" placeholder="Extra Cost">' +
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
        });

        $('input[type=radio][name=customer]').change(function () {
            if (this.id == 'ec') {

                $.ajax({
                    type: 'POST',
                    url: "./AddNewInvocieAjax/getCustomerName.php",
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
                            alert('Something Went Wrong');
                        }
                        else if (Data[0].FLAG == "ERRORINQUERYEXECUTION") {
                            console.log("ERROR IN QUERY EXECUTION");
                            alert('Something Went Wrong');
                        }
                        else {
                            console.log("ERROR");
                            alert('Something Went Wrong');
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

        $("#closechallan").click(function () {
            //window.location.href = '../Ceramic/admin.php';
        });

        function validateChallanMetaData() {
            var InvocieDate = $("#getInvoiceDate").val();
            var customerId = $("#getCustomerName").val();
            if (InvoiceDate != '' && customerId != "-1") {
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
                    url: "./AddNewInvocieAjax/getSubcategoriesFromCategories.php",
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
                            alert('No Subcategory Found For Given Category');
                        }
                        else if (Data[0].FLAG == "NOTOK") {
                            console.log("Error In Executing Query");
                            alert("Something Went Wrong");
                        }
                        else {
                            console.log('Other Response Found');
                            alert('Something Went Wrong');
                        }
                    },
                    error: function (Data) {
                        console.log("Error In Ajax Call In Categories Change Event");
                        alert('Something Went Wrong');
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
                    url: "./AddNewInvocieAjax/getBrandsFromSubcategory.php",
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
                            alert("No Brands Found For Selected Category And Subcategory");
                        }
                        else if (Data[0].FLAG == 'ERRORINEXECUTINGQUERY') {
                            console.log("ERROR IN EXECUTING QUERY");
                            alert("Something Went Wrong");
                        }
                        else {
                            console.log('Other Then Flag');
                            alert('Something Went Wrong');
                        }
                    },
                    error: function (Data) {
                        console.log('Error In Ajax Call ' + Data);
                        alert('Something Went Wrong');
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "./AddNewInvocieAjax/getHSNGSTFromSubcategory.php",
                    data: { subcatid: subcatid },
                    dataType: 'json',
                    success: function (Data) {
                        console.log(Data);
                        if (Data[0].FLAG == "OKK") {
                            $("#hsn").val(Data[1].hsnnum);
                            $("#gst").val(Data[1].gstnum);
                        } else if (Data[0].FLAG == "RECORDNOTFOUND") {
                            console.log("No Brands Found For Selected Category And Subcategory");
                            alert("No Brands Found For Selected Category And Subcategory");
                        } else if (Data[0].FLAG == 'ERRORINEXECUTINGQUERY') {
                            console.log("ERROR IN EXECUTING QUERY");
                            alert("Something Went Wrong");
                        } else {
                            console.log('Other Then Flag');
                            alert('Something Went Wrong');
                        }
                    },
                    error: function (Data) {
                        console.log('Error In Ajax Call ' + Data);
                        alert('Something Went Wrong');
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "./AddNewInvocieAjax/getGradesFromSubcategory.php",
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
                            alert("No Grade Found For Selected Category And Subcategory");
                        }
                        else if (Data[0].FLAG == 'ERRORINEXECUTINGQUERY') {
                            console.log("ERROR IN EXECUTING QUERY");
                            alert("Something Went Wrong");
                        }
                        else {
                            console.log('Other Then Flag');
                            alert('Something Went Wrong');
                        }
                    },
                    error: function (Data) {
                        console.log('Error In Ajax Call ' + Data);
                        alert('Something Went Wrong');
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
                    url: "./AddNewInvocieAjax/searchProductId.php",
                    data: { category: category, subcategory: subcategory, brandname: brandname, hsncode: hsncode, grade: grade, colortype: colortype, dimension: dimension, qtyperunit: qtyperunit, packingunit: packingunit, codeno: codeno, gstno: gstno },
                    dataType: 'json',
                    success: function (Data) {
                        console.log(Data);
                        if (Data[0].FLAG == "OKK") {
                            $("#pid").val(Data[1].productid);
                            var productid = $("#pid").val();
                            $.ajax({
                                type: "POST",
                                url: "./AddNewInvocieAjax/searchFromStocks.php",
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

                                            $("#searchedTable tbody:last-child").append(
                                                '<tr>' +
                                                '<td>' + category + '</td>' +
                                                '<td>' + subcategory + '</td>' +
                                                '<td>' + hsncode + '</td>' +
                                                '<td>' + colortype + '</td>' +
                                                '<td>' + brandname + '</td>' +
                                                '<td>' + dimension + '</td>' +
                                                '<td>' + qtyperunit + '</td>' +
                                                '<td>' + packingunit + '</td>' +
                                                '<td>' + grade + '</td>' +
                                                '<td>' + codeno + '</td>' +
                                                '<td>' + gstno + '</td>' +
                                                '<td>' + billingqty + '</td>' +
                                              //  '<td>' + otherqty + '</td>' +
                                                '<td>' + baseprice + '</td>' +
                                                '<td>' + dateadded + '</td>' +
                                                '<td><input type="button" class="btn btn-primary selectbtn" pid="' + productid + '" stockid="' + stockid + '"value="Select"></center></td>' +
                                                '</tr>'
                                            );
                                        }
                                    } else if (Data[0].FLAG == "NORECORDFOUND") {
                                        alert('NO Record Found For Your Search Result');
                                    } else if (Data[0].FLAG == "ERRORINQUERY") {
                                        alert('Error In Query');
                                    }
                                },
                                error: function (Data) {
                                    console.log('Error In Ajax Call ' + Data);
                                    alert('Something Went Wrong');
                                }
                            });
                        } else if (Data[0].FLAG == "RECORDNOTFOUND") {
                            console.log("No Such Product Found");
                            alert("No Such Product Found");
                        }
                        else if (Data[0].FLAG == 'ERRORINEXECUTINGQUERY') {
                            console.log("ERROR IN EXECUTING QUERY");
                            alert("Something Went Wrong");
                        }
                        else {
                            console.log('Other Then Flag');
                            alert('Something Went Wrong');
                        }
                    },
                    error: function (Data) {
                        console.log('Error In Ajax Call ' + Data);
                        alert('Something Went Wrong');
                    }
                });
            } else {
                alert('All Fields are Required.');
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
                        '<td>' + obj[3] + '</td>' +
                        '<td>' + obj[4] + '</td>' +
                        '<td>' + obj[5] + '</td>' +
                        '<td>' + obj[6] + '</td>' +
                        '<td>' + obj[7] + '</td>' +
                        '<td>' + obj[8] + '</td>' +
                        '<td>' + obj[13] + '</td>' +
                        '<td>' + obj[9] + '</td>' +
                        '<td>' + obj[11] + '</td>' +
                        '<td width="7%" ><input class="form-control purchase-qty calprice" onkeyup="validateQty(this,' + obj[11] + ');calprice();" type="number" step="1" id="billingqty_' + $(this).attr("stockid") + '" >' +
                        
                        //'<td>' + '' + '</td>' +
                        '<td>' + '<span id="gstvalue" name="gstvalue">'+obj[10]+'</span>' + '</td>' +
                        '<td width="7%" ><input class="form-control selling-price calprice" type="number" onkeyup="calprice();" id="sellingprice_' + $(this).attr("stockid") + '">' + '</td>' +
                        '<td>' + obj[12] + '</td>' +
                       // '<td width="7%" ><input class="form-control purchase-qty calprice" onkeyup="validateQty(this,' + obj[12] + '); calprice();calsubtotal();" type="number" step="1" id="otherqty_' + $(this).attr("stockid") + '" >' +
                       '<td>' +' <input type="number" name="totalgst" id="totalgst' + $(this).attr("stockid") + '" onkeyup="calprice();" disabled>'+ '</td>'+
                       '<td>' +' <input type="number" name="total" id="grandtotal' + $(this).attr("stockid") + '" onkeyup="calprice();" disabled>'+ '</td>'+
                       
                       '<td><button value="Remove" class="btn btn-danger removebtn" stockid="' + $(this).attr('stockid') + '">Remove</button></td>' +
                    '</tr>';

                $("#purchasedTable tbody:last-child").append(trToBeAppend);
            }
            else {
                alert('Item Alredy Present Inside Purchased Items List');
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

        $("#confirmInvoice").click(function () {
            if ($("#purchasedTable tbody").children().length) {
                var invoicedate =$("#getInvoiceDate").val();
                var customerId = $("#getCustomerName").val();
                var totalamt = $("#totalcost").val();
                var discount = $("#discount").val();
                var transport = $("#transportcost").val();
                console.log(customerId);
				
				var tbl = $("#purchasedTable");
				var tbljson = tbl.tableToJSON();
				console.log(tbljson);
				
                if (customerId != '-1') {
                    var itr = stockIdsToBePurchased[Symbol.iterator]();
                    var n = stockIdsToBePurchased.size;
                    var challanpack = Array();
                    var custidobj = { customerId: customerId, invoicedate: invoicedate, totalamt: totalamt, discount: discount, transport: transport };
                    challanpack.push(custidobj);

                    for (let i = 0; i < n; i++) {
                        var tempstockid = itr.next().value;
                        var billingQty = $("#billingqty_" + tempstockid).val();
                       // var otherQty = $("#otherqty_" + tempstockid).val();
                        var sellingPrice = $("#sellingprice_" + tempstockid).val();


                        var challanitemobj = {
                            stockid: tempstockid,
                            billqty: billingQty,
                            //otherqty: otherQty,
                            sellprice: sellingPrice
                        };
                        challanpack.push(challanitemobj);
                    }

                    console.log(challanpack);
                    console.log(JSON.stringify(challanpack));
                    $.ajax({
                        type: "POST",
                        url: "./AddNewInvocieAjax/addNewInvoiceInDatabase.php",
                        data: JSON.stringify(challanpack),
                        dataType: 'json',
                        success: function (Data) {
                            console.log(Data);
                            if (Data[0].FLAG == "SUCCESS") {
                                var Invoiceid = Data[1].InvoiceId;
                                alert("Invoice Id : " + Invoiceid);
                                $("#Invoiceid").val(Invoiceid);
                                console.log('Invocie ID IN FORM : ' + $('#Invoiceid').val());
                                $("#makepdf").submit();
                                //location.reload(true);
                            } else if (Data[0].FLAG == "ERRCOMMIT") {
                                console.log('Error While Commit');
                                alert('Something Went Wrong');

                            } else if (Data[0].FLAG == "MIDERR") {
                                console.log('Error In Middle Execution');
                                alert('Something Went Wrong');

                            } else if (Data[0].FLAG == "ERRINSERTMST") {
                                console.log('Error While Inserting In Challan MST');
                                alert('Something Went Wrong');

                            } else if (Data[0].FLAG == "PARAMEMPTY") {
                                console.log('Parameter Empty');
                                alert('Something Went Wrong');

                            } else {
                                console.log('Other Flag Recived');
                                alert('Something Went Wrong');
                            }
                        },
                        error: function (Data) {
                            console.log('Error In Ajax Call');
                            alert("Something Went Wrong");
                            console.log(Data.status);
                        console.log(Data.statusText);
                        console.log(Data.responseText);
                        }
                    });
                } else {
                    console.log("CustomerId is Null");
                    alert('Customer is Not Selected');
                }
            } else {
                alert("No Items Selected");
            }
        });

        function ReloadGradeSelectMenu() {
            ResetSelectMenu($("#getgrade"));
            $.ajax({
                type: "POST",
                url: "./AddNewInvocieAjax/getGrades.php",
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
                        alert('Something Went Wrong');
                    }
                    else {
                        console.log('OTHER THEN FLAG');
                        alert('Something Went Wrong');
                    }
                },
                error: function (Data) {
                    console.log(Data);
                    alert('Something Went Wrong');
                }
            });
        }

        function ReloadBrandSelectMenu() {
            ResetSelectMenu($("#getbrandname"));
            $.ajax({
                type: "POST",
                url: "./AddNewInvocieAjax/getBrandNames.php",
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
                        alert('Something Went Wrong');
                    }
                    else {
                        console.log('OTHER THEN FLAG');
                        alert('Something Went Wrong');
                    }
                },
                error: function (Data) {
                    console.log(Data);
                    alert('Something Went Wrong');
                }
            });
        }

        function ReloadSubcategoriesSelectMenu() {
            ResetSelectMenu($("#subcategories"));
            $.ajax({
                type: "POST",
                url: "./AddNewInvocieAjax/getAllSubCategories.php",
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
                        alert('No Subcategory Found For Given Category');
                    }
                    else if (Data[0].FLAG == "NOTOK") {
                        console.log("Error In Executing Query");
                        alert("Something Went Wrong");
                    }
                    else {
                        console.log('Other Response Found');
                        alert('Something Went Wrong');
                    }
                },
                error: function (Data) {
                    console.log("Error In ./SearchAndManageProductAjax/getAllSubCategories.php   Ajax Call");
                    console.log(Data.responseText);
                    console.log(Data.statusText);
                }
            });
        }

        function ReloadDimesionSelectMenu() {

            ResetSelectMenu($("#getdimension"));
            $.ajax({
                type: "POST",
                url: "./AddNewInvocieAjax/getAllDimesnsions.php",
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
                        alert("No Record Found");
                    }
                    else if (Data[0].FLAG == "ERREXECUTINGQUERY") {
                        console.log('Error In Executing Query');
                        alert("Something Went Wrong");
                    }
                    else {
                        console.log("Other Response FOund");
                        alert('Something Went Wrong');
                    }
                },
                error: function (Data) {
                    console.log("Erroe In ./SearchAndManageProductAjax/getAllDimesnsions.php   AJax Call");
                    alert("Soething Went Wrong");
                }
            });
        }

        function ReloadQtyPerUnitSelectMenu() {
            ResetSelectMenu($("#getqtyperunit"));

            $.ajax({
                type: "POST",
                url: "./AddNewInvocieAjax/getQtyPerUnit.php",
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
                        alert("No Record Found");
                    }
                    else if (Data[0].FLAG == "ERREXECUTINGQUERY") {
                        console.log('Error In Executing Query');
                        alert("Something Went Wrong");
                    }
                    else {
                        console.log("Other Response FOund");
                        alert('Something Went Wrong');
                    }
                },
                error: function (Data) {
                    console.log("Erroe In ./SearchAndManageProductAjax/getAllDimesnsions.php   AJax Call");
                    alert("Soething Went Wrong");
                }
            });
        }

        function ReloadProductTypeColorMenu() {
            //function getProductTypeColor(){
            ResetSelectMenu($("#getProductTypeColor"));
            $.ajax({
                type: "POST",
                url: "./AddNewInvocieAjax/getProductTypeColor.php",
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
                        alert("No Record Found");
                    }
                    else if (Data[0].FLAG == "ERREXECUTINGQUERY") {
                        console.log('Error In Executing Query');
                        alert("Something Went Wrong");
                    }
                    else {
                        console.log("Other Response FOund");
                        alert('Something Went Wrong');
                    }
                },
                error: function (Data) {
                    console.log("Erroe In  ./SearchAndManageProductAjax/getProductTypeColor.php AJax Call");
                    alert("Soething Went Wrong");
                }
            });
        }

        function ReloadCodeSelectMenu() {
            ResetSelectMenu($("#getcode"));

            $.ajax({
                type: "POST",
                url: "./AddNewInvocieAjax/getCode.php",
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
                        alert("No Record Found");
                    }
                    else if (Data[0].FLAG == "ERREXECUTINGQUERY") {
                        console.log('Error In Executing Query');
                        alert("Something Went Wrong");
                    }
                    else {
                        console.log("Other Response FOund");
                        alert('Something Went Wrong');
                    }
                },
                error: function (Data) {
                    console.log("Error In  ./SearchAndManageProductAjax/getCode.php AJax Call");
                    alert("Soething Went Wrong");
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
                alert('Quentity Cant Be Minus');
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
		var totalgst=0;
        var subTotal=0;
        var grandTotal=0;
        for (let i = 0; i < n; i++) {

            var tempstockid = itr.next().value;
            var billingQty = $("#billingqty_" + tempstockid).val();
           
            var sellingPrice = $("#sellingprice_" + tempstockid).val();
            // totalprice = (totalprice + (billingQty * sellingPrice));

            var gst = document.getElementById("gstvalue").textContent;
        console.log(gst,"hello");
		totalgst = billingQty*sellingPrice*(gst/100);
		
        grandTotal = totalgst+(sellingPrice*billingQty);

        document.getElementById("grandtotal"+ tempstockid).value=grandTotal;
		document.getElementById("totalgst"+ tempstockid).value=totalgst;

        subTotal += grandTotal;
        }
        document.getElementById("totalcost").value = subTotal;
        document.getElementById("subtotal").value = subTotal;
        
        
    }
     

    function calsubtotal() {
        var total = document.getElementById("totalcost").value;
        var discount = document.getElementById("discount").value;
        var transport = document.getElementById("transportcost").value;
        transport=Number.parseFloat(transport);
        transport=(transport*0.18)+transport;
        var subtotal = total - discount + transport;
        document.getElementById("subtotal").value = subtotal;
    }

</script>