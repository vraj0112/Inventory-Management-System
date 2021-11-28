<!DOCTYPE html>
<html lang="en">
<?php include('./config.php');?>

<head>
    <title>Search And Manage Breakage And Damage</title>
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

        tbody td {
            text-align: center;
            border: 1px solid black;
        }

        thead th {
            text-align: center;
            border: 1px solid black;
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
    <!-- <link rel="stylesheet" href="chosen/chosen.css"> -->
    <!-- <script src="chosen/chosen.jquery.js" type="text/javascript"></script> -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<!-- <?php 
    $month = date('m');
    $day = date('d');
    $year = date('Y');
    // $num=1;
    
    $today = $year . '-' . $month . '-' . $day;
    $first_day_of_month = $year. '-' . $month . '-' . '01';
    // $num=str_pad($num, 3, "0", STR_PAD_LEFT);
    // $challanNo = $year.$month.$num;
?> -->

<body>
    <div class="container-fluid col-lg-12">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header" style="background-color: #2B60DE">
                        <center>
                            <h3 class="card-title" style="color: white">Search And Manage Breakage And Damage</h3>
                        </center>
                        <?php //echo $challanNo;?>
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-2">
                                <label class="form-label mt-1" style="margin-left: 2px">From Date:</label>
                                <input type="date" id="from-date" name="from-date" class="form-control date-class"
                                    value="<?php echo $first_day_of_month; ?>">
                            </div>

                            <div class="col-md-2">
                                <label class="form-label mt-1" style="margin-left: 2px">To Date:</label>
                                <input type="date" id="to-date" name="to-date" class="form-control date-class"
                                    value="<?php echo $today; ?>">
                            </div>
                            
                            <div class="col-md-1">
                                <input type="Button" style="margin: 16%;" value="lockbtn" id="lockbtn" class="btn btn-primary">
                            </div>

                            <div class="col-md-1">
                                <input type="Button" style="margin: 16%;" value="unlockbtn" id="unlockbtn" class="btn btn-primary">
                            </div>

                            <div class="col-md-1">
                                <input type="text" id="pid1" hidden>
                            </div>
                            <hr>

                            <center><h3>Or Search By</h3></center>

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
                                                    //"<option value='".$category_id."' cid=".$category_id.">".$category_name."</option>";
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
                                <input type="Button" value="Search" id="searchbtn" class="btn btn-success">
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
                            <!-- <th>HSN<br>Code</th> -->
                            <th>Type/<br>Color</th>
                            <th>Brand</th>
                            <th>Dimension</th>
                            <th>Qty/Unit</th>
                            <th>Packing<br>Unit</th>
                            <th>Grade</th>
                            <th>Code</th>
                            <th>Batch<br>No</th>
                            <!-- <th>GST</th> -->
                            <th hidden>Billing<br>Qty</th>
                            <th hidden>Other<br>Qty</th>
                            <th>Base<br>Price</th>
                            <th style="width: 150px;">Inward<br>Date</th>
                            <th>Damaged<br>Billing<br>Quentity</th>
                            <th>Damaged<br>Other<br>Quentity</th>
                            <th style="width: 150px;">Damaged<br>Addition<br>Date</th>
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
                    <div class="card-header" style="background-color: #2B60DE">
                        <center>
                            <h3 class="card-title" style="color: white">Update Items</h3>
                        </center>
                        <?php //echo $challanNo;?>
                    </div>

                    <div class="card card-body">

                    </div>
                    <table id="purchasedTable">
                        <thead>
                            <th>Prod.<br>Desc.</th>
                            <!-- <th>Type</th> -->
                            <!-- <th>Sub<br>Type</th> -->
                            <!-- <th>HSN<br>Code</th> -->
                            <th>Type/<br>Color</th>
                            <th>Brand</th>
                            <th>Dimension</th>
                            <th>Qty/Unit</th>
                            <th>Packing<br>Unit</th>
                            <th>Grade</th>
                            <th>Code</th>
                            <th>Batch<br>No</th>
                            <th hidden>Billing<br>Qty</th>
                            <th hidden>Other<br>Qty</th>
                            <th>Base<br>Price</th>
                            <th>Stock<br>Added<br>Date</th>
                            <th>Damaged<br>Billing<br>Qty</th>
                            <th>Damaged<br>Other<br>Qty</th>
                            <!-- <th>Selling<br>Price</th> -->
                            <th>Damaged<br>Added<br>Date</th>
                            <th>Updated<br>Billing<br>Qty</th>
                            <th>Updated<br>Other<br>Qty</th>
                            <th>Action</th>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    <br><br>
                </div>
            </div>
        </div>
    </div>
</body>

<script type="text/javascript">
    var stockIdsToBePurchased;
    var lockflag = false;
    var mode = -1;
    $(function () {
        ReloadSubcategoriesSelectMenu();
        ReloadGradeSelectMenu();
        ReloadBrandSelectMenu();
        ReloadDimesionSelectMenu();
        ReloadQtyPerUnitSelectMenu();
        ReloadProductTypeColorMenu();
        ReloadCodeSelectMenu();
        sysIdsToBeUpdated = new Set();

        $("#lockbtn").on('click', function(){
            lockflag = true;
            $(".date-class").prop('disabled', true);

            $("#searchedTable tbody").empty();

            var fromdate = $("#from-date").val();
            var todate = $("#to-date").val();

            $.ajax({
                type: "POST",
                url: "./SearchAndManageBreakageAndDamageAjax/getDamageDetailsFromDate.php",
                data: {fromdate: fromdate, todate: todate},
                dataType: 'json',
                success: function(Data){
                    console.log(Data);
                    if(Data[0].FLAG == "OKK"){
                        var n = Data.length;

                        for(var i=1; i<n; i++){
                            var category            = Data[i].category;
                            var subcategory         = Data[i].subcategory;
                            var typeorcolor         = Data[i].typeorcolor;
                            var brand               = Data[i].brand;
                            var dimension           = Data[i].dimension;
                            var qtyperunit          = Data[i].qtyperunit;
                            var packingunit         = Data[i].packingunit;
                            var grade               = Data[i].grade;
                            var code                = Data[i].code;
                            var batchno             = Data[i].batchno;
                            var baseprice           = Data[i].baseprice;
                            var billingqty          = Data[i].billingqty;
                            var otherqty            = Data[i].otherqty;
                            var stockaddeddate      = splitDate(Data[i].dateadded);
                            var dbillingqty         = Data[i].dbillingqty;
                            var dotherqty           = Data[i].dotherqty;
                            var damageadditiondate  = splitDate(Data[i].damageadditiondate);
                            var stockid             = Data[i].stockid;
                            var sysid               = Data[i].sysid;
                            var productid           = Data[i].productid;

                            $("#searchedTable tbody:last-child").append(
                                '<tr>' +
                                    '<td>' + category + '</td>' + 
                                    '<td>' + subcategory + '</td>' + 
                                    '<td>' + typeorcolor + '</td>' + 
                                    '<td>' + brand + '</td>' + 
                                    '<td>' + dimension + '</td>' + 
                                    '<td>' + qtyperunit + '</td>' + 
                                    '<td>' + packingunit + '</td>' + 
                                    '<td>' + grade + '</td>' + 
                                    '<td>' + code + '</td>' + 
                                    '<td>' + batchno + '</td>' + 
                                    '<td hidden>' + billingqty + '</td>' + 
                                    '<td hidden>' + otherqty + '</td>' + 
                                    '<td>' + baseprice + '</td>' + 
                                    '<td style="width: 150px;">' + stockaddeddate + '</td>' + 
                                    '<td>' + dbillingqty + '</td>' + 
                                    '<td>' + dotherqty + '</td>' + 
                                    '<td style="width: 150px;">' + damageadditiondate + '</td>' + 
                                    '<td><input type="button" class="btn btn-primary selectbtn" pid="' + productid + '" stockid="' + stockid + '" value="Select" sysid = "'+ sysid +'"></center></td>' + 
                                '</tr>'
                            );
                            

                        }
                    }
                    else if(Data[0].FLAG == "NORECORD"){
                        console.log("No Record Found");
                        swal("No Damage Records Found For Given Range Of Date", '','info').then(()=>{return;});
                        return;
                    }
                    else if(Data[0].FLAG == "ERROR"){
                        console.log("Error In Query");
                        swal("Something Went Wrong", '','error').then(()=>{return;});
                        return;
                    }
                    else{
                        console.log("Other Response Recieved");
                        swal("Something Went Wrong", '','error').then(()=>{return;});
                        return;
                    }
                },
                error: function(Data){
                    console.log("Error In   ./SearchAndManageBreakageAndDamageAjax/getDamageDetailsFromDate.php  Ajax Call");
                    swal("Somehing Went Wrong", '', 'error').then(()=>{return;});
                    return;
                }
            });
            mode = 2;
        });
        
        $("#unlockbtn").on('click', function(){
            lockflag = false;
            $(".date-class").prop('disabled', false);
            $("#searchedTable tbody").empty();
            $("#purchasedTable tbody").empty();
        });

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
                    url: "./SearchAndManageBreakageAndDamageAjax/getSubcategoriesFromCategories.php",
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
                            swal('No Subcategory Found For Given Category', '', 'info');
                        }
                        else if (Data[0].FLAG == "NOTOK") {
                            console.log("Error In Executing Query");
                            swal("Something Went Wrong", '', 'error');
                        }
                        else {
                            console.log('Other Response Found');
                            swal("Something Went Wrong", '', 'error');
                        }
                    },
                    error: function (Data) {
                        console.log("Error In Ajax Call In Categories Change Event");
                        swal("Something Went Wrong", '', 'error');
                        //console.log(Data.status);
                        //console.log(Data.statusText);
                        //console.log(Data.responseText);
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
                    url: "./SearchAndManageBreakageAndDamageAjax/getBrandsFromSubcategory.php",
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
                            swal("No Brands Found For Selected Category And Subcategory", '', 'info');
                        }
                        else if (Data[0].FLAG == 'ERRORINEXECUTINGQUERY') {
                            console.log("ERROR IN EXECUTING QUERY");
                            swal("Something Went Wrong", '', 'error');
                        }
                        else {
                            console.log('Other Then Flag');
                            swal("Something Went Wrong", '', 'error');
                        }
                    },
                    error: function (Data) {
                        console.log('Error In ./SearchAndManageBreakageAndDamageAjax/getBrandsFromSubcategory.php  Ajax Call ' + Data);
                        swal("Something Went Wrong", '', 'error');
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "./SearchAndManageBreakageAndDamageAjax/getHSNGSTFromSubcategory.php",
                    data: { subcatid: subcatid },
                    dataType: 'json',
                    success: function (Data) {
                        console.log(Data);
                        if (Data[0].FLAG == "OKK") {
                            $("#hsn").val(Data[1].hsnnum);
                            $("#gst").val(Data[1].gstnum);
                        } else if (Data[0].FLAG == "RECORDNOTFOUND") {
                            console.log("No Brands Found For Selected Category And Subcategory");
                            swal("No Brands Found For Selected Category And Subcategory", '','info');
                        } else if (Data[0].FLAG == 'ERRORINEXECUTINGQUERY') {
                            console.log("ERROR IN EXECUTING QUERY");
                            swal("Something Went Wrong", '', 'error');
                        } else {
                            console.log('Other Then Flag');
                            swal("Something Went Wrong", '', 'error');
                        }
                    },
                    error: function (Data) {
                        console.log('Error In Ajax Call ' + Data);
                        swal("Something Went Wrong", '', 'error');
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "./SearchAndManageBreakageAndDamageAjax/getGradesFromSubcategory.php",
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
                            swal("No Grade Found For Selected Category And Subcategory", '', 'info');
                        }
                        else if (Data[0].FLAG == 'ERRORINEXECUTINGQUERY') {
                            console.log("ERROR IN EXECUTING QUERY");
                            swal("Something Went Wrong", '', 'error');
                        }
                        else {
                            console.log('Other Then Flag');
                            swal("Something Went Wrong", '', 'error');
                        }
                    },
                    error: function (Data) {
                        console.log('Error In  ./SearchAndManageBreakageAndDamageAjax/getGradesFromSubcategory.php Ajax Call ' + Data);
                        swal("Something Went Wrong", '', 'error');
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
            if(lockflag == false){
                swal("Please Lock The Date", '', 'info').then(()=>{return;});
                return;
            }
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
            var fromdate = $("#from-date").val();
            var todate = $("#to-date").val();
            console.log(fromdate);
            console.log(todate);

            if (category != '-1' && subcategory != '-1' && brandname != '-1' && hsncode != ' ' && grade != '-1' && colortype != '-1' && dimension != '-1' && qtyperunit != '-1' && packingunit != '-1' && codeno != '-1' && gstno != ' ') {
                $.ajax({
                    type: "POST",
                    url: "./SearchAndManageBreakageAndDamageAjax/searchProductId.php",
                    data: { category: category, subcategory: subcategory, brandname: brandname, hsncode: hsncode, grade: grade, colortype: colortype, dimension: dimension, qtyperunit: qtyperunit, packingunit: packingunit, codeno: codeno, gstno: gstno },
                    dataType: 'json',
                    success: function (Data) {
                        console.log(Data);
                        if (Data[0].FLAG == "OKK") {
                            $("#pid").val(Data[1].productid);
                            var productid = $("#pid").val();
                            $.ajax({
                                type: "POST",
                                url: "./SearchAndManageBreakageAndDamageAjax/getDamageDetailsOfSearch.php",
                                data: { productid: productid , fromdate: fromdate, todate: todate},
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
                                            var dateadded = splitDate(Data[i].dateadded);
                                            var stockid = Data[i].stockid;
                                            var sysid = Data[i].sysid;
                                            var damagedbillingqty = Data[i].dbillingqty;
                                            var damagedotherqty = Data[i].dotherqty;
                                            var dcreateddate = splitDate(Data[i].dcreateddate);
                                            var batchno = Data[i].batchno;
                                            //stockids=stockid;

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
                                                '<td>' + batchno + '</td>' +
                                                // '<td>' + gstno + '</td>' +
                                                '<td hidden>' + billingqty + '</td>' +
                                                '<td hidden>' + otherqty + '</td>' + 
                                                '<td>' + baseprice + '</td>' +
                                                '<td style="width: 150px;">' + dateadded + '</td>' +
                                                '<td>' + damagedbillingqty + '</td>' +
                                                '<td>' + damagedotherqty + '</td>' +
                                                '<td style="width: 150px;">' + dcreateddate + '</td>' +
                                                '<td><input type="button" class="btn btn-primary selectbtn" pid="' + productid + '" stockid="' + stockid + '"value="Select" sysid = "'+ sysid +'"></center></td>' +
                                                '</tr>'
                                            );
                                        }
                                    } else if (Data[0].FLAG == "NORECORDFOUND") {
                                        swal('NO Record Found For Your Search Result','','info');
                                    } else if (Data[0].FLAG == "ERRORINQUERY") {
                                        console.log("Error In Query");
                                        swal("Something Went Wrong", '', 'error');
                                    }
                                },
                                error: function (Data) {
                                    console.log('Error In Ajax Call ' + Data);
                                    swal("Something Went Wrong", '', 'error');
                                }
                            });
                        } else if (Data[0].FLAG == "RECORDNOTFOUND") {
                            console.log("No Such Product Found");
                            swal("No Such Product Found", '', 'info');
                        }
                        else if (Data[0].FLAG == 'ERRORINEXECUTINGQUERY') {
                            console.log("ERROR IN EXECUTING QUERY");
                            swal("Something Went Wrong", '', 'error');
                        }
                        else {
                            console.log('Other Then Flag');
                            swal("Something Went Wrong", '', 'error');
                        }
                    },
                    error: function (Data) {
                        console.log('Error In Ajax Call ' + Data);
                        swal("Something Went Wrong", '', 'error');
                    }
                });
            } else {
                swal('All Fields are Required.', '', 'warning');
            }
            mode = 1;
        });

        $("#searchedTable").on('click', '.selectbtn', function () {
            console.log($(this).attr('stockid'));
            var stockid = $(this).attr('stockid');
            var sysid = $(this).attr('sysid');
            //stockids=stockid;

            //console.log(stockids);

            if (!sysIdsToBeUpdated.has(sysid)) {
                sysIdsToBeUpdated.add(sysid);
                let tr = $(this).parent().siblings();

                let obj = Array();

                for (let i = 0; i < 17; i++) {
                    obj.push(tr.html());
                    tr = tr.next();
                }
                var ids=$(this).attr("stockid");
                var trToBeAppend =
                    '<tr>' +
                        
                        '<td>' + obj[0] + ", " + obj[1] + '</td>' +
                        // '<td>' + obj[1] + '</td>' +
                        '<td>' + obj[2] + '</td>' +
                        '<td>' + obj[3] + '</td>' +
                        '<td>' + obj[4] + '</td>' +
                        '<td>' + obj[5] + '</td>' +
                        '<td>' + obj[6] + '</td>' +
                        '<td>' + obj[7] + '</td>' +
                        '<td>' + obj[8] + '</td>' +
                        '<td>' + obj[9] + '</td>' +
                        '<td hidden>' + obj[10] + '</td>' +
                        '<td hidden>' + obj[11] + '</td>' +
                        '<td>' + obj[12] + '</td>' +
                        '<td>' + obj[13] + '</td>' +
                        '<td>' + obj[14] + '</td>' +
                        '<td>' + obj[15] + '</td>' +
                        '<td>' + obj[16] + '</td>' +
                        '<td width="7%" ><input class="form-control purchase-qty calprice" type="number" onkeyup="cheakValidityOfStock(this, '+obj[10]+', '+obj[14]+')" step="1" id="updatedbillingqty_' + sysid + '" >' +
                        '<td width="7%" ><input class="form-control purchase-qty calprice" type="number" onkeyup="cheakValidityOfStock(this, '+obj[11]+', '+obj[15]+')" step="1" id="updatedotherqty_' + sysid + '" >' +
                        '<td><button value="Update" class="btn btn-danger updatebtn" sysid="'+sysid+'"  stockid="'+stockid+'">Update</button></td>' +
                    '</tr>';

                $("#purchasedTable tbody:last-child").append(trToBeAppend);
            }// Only once the row gets copied from breakage n damage table to purchased item table
            else {
                swal('Item Alredy Present Inside Purchased Items List', '','info');
            }
        });

        $("#purchasedTable").on('click', '.updatebtn', function(){
            var sysid = $(this).attr('sysid');
            var stockid = $(this).attr('stockid');
            var ref = $(this);
            var updateBillingQty = $("#updatedbillingqty_"+sysid).val();
            var updateOtherQty   = $("#updatedotherqty_"+sysid).val();

            if(updateBillingQty == ""){
                swal("Update In Damaged Billing Qty Is Empty", '' ,'warning')/then(()=>{
                    $("#updatedbillingqty_"+sysid).focus();
                });
                return;
            }

            if(updateOtherQty == ""){
                swal("Update In Damaged Other Qty Is Empty", '' ,'warning').then(()=>{
                    $("#updatedotherqty_"+sysid).focus();
                });
                return;
            }

            

            if(sysid != ""){
                $.ajax({
                    type: "POST",
                    url: "./SearchAndManageBreakageAndDamageAjax/updateDamageQuentity.php",
                    data: {sysid: sysid, updatebillingqty: updateBillingQty, updateotherqty: updateOtherQty, stockid: stockid},
                    success: function(Data){
                        if(Data == "1"){
                            swal("Successfully Updated Damaged Stock Quentity", '', 'success').then(()=>{
                                sysIdsToBeUpdated.delete(sysid.toString());
                                ref.parent().parent().remove();
                                if(mode == 1){
                                    $("#searchbtn").click();
                                }
                                else if(mode == 2){
                                    $("#lockbtn").click();
                                }
                                return;

                            });
                            return;
                        }   
                        else if(Data == "-1"){
                            console.log("Error In Query");
                            swal("Something Went Wrong", '', 'error').then(()=>{return;});
                            return;
                        }   
                        else{
                            console.log("Other Responce Recived");
                            swal("Something Went Wrong", '', 'error').then(()=>{return;});
                            return;
                        }                 
                    },
                    error: function(Data){
                        console.log("Error In  ./SearchAndManageBreakageAndDamageAjax/updateDamageQuentity.php  Ajax Call");
                        swal("Something Went Wrong", '', 'error');
                        return;
                    }
                });
            }
            else{
                console.log("Sys Id Not Found Or NULL");
                swal("Something Went Wrong", '', 'error');
                return;
            }

        });

        function ReloadGradeSelectMenu() {
            ResetSelectMenu($("#getgrade"));
            $.ajax({
                type: "POST",
                url: "./SearchAndManageBreakageAndDamageAjax/getGrades.php",
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
                        swal("Something Went Wrong", '', 'error');
                    }
                    else {
                        console.log('OTHER THEN FLAG');
                        swal("Something Went Wrong", '', 'error');
                    }
                },
                error: function (Data) {
                    console.log(Data);
                    swal("Something Went Wrong", '', 'error');
                }
            });
        }

        function ReloadBrandSelectMenu() {
            ResetSelectMenu($("#getbrandname"));
            $.ajax({
                type: "POST",
                url: "./SearchAndManageBreakageAndDamageAjax/getBrandNames.php",
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
                        swal("Something Went Wrong", '', 'error');
                    }
                    else {
                        console.log('OTHER THEN FLAG');
                        swal("Something Went Wrong", '', 'error');
                    }
                },
                error: function (Data) {
                    console.log(Data);
                    swal("Something Went Wrong", '', 'error');
                }
            });
        }

        function ReloadSubcategoriesSelectMenu() {
            ResetSelectMenu($("#subcategories"));
            $.ajax({
                type: "POST",
                url: "./SearchAndManageBreakageAndDamageAjax/getAllSubCategories.php",
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
                        swal('No Subcategory Found For Given Category', '','info');
                    }
                    else if (Data[0].FLAG == "NOTOK") {
                        console.log("Error In Executing Query");
                        swal("Something Went Wrong", '', 'error');
                    }
                    else {
                        console.log('Other Response Found');
                        swal("Something Went Wrong", '', 'error');
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
                url: "./SearchAndManageBreakageAndDamageAjax/getAllDimesnsions.php",
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
                        swal("No Record Found", '', 'info');
                    }
                    else if (Data[0].FLAG == "ERREXECUTINGQUERY") {
                        console.log('Error In Executing Query');
                        swal("Something Went Wrong", '', 'error');
                    }
                    else {
                        console.log("Other Response FOund");
                        swal("Something Went Wrong", '', 'error');
                    }
                },
                error: function (Data) {
                    console.log("Erroe In ./SearchAndManageProductAjax/getAllDimesnsions.php   AJax Call");
                    swal("Something Went Wrong", '', 'error');
                }
            });
        }

        function ReloadQtyPerUnitSelectMenu() {
            ResetSelectMenu($("#getqtyperunit"));

            $.ajax({
                type: "POST",
                url: "./SearchAndManageBreakageAndDamageAjax/getQtyPerUnit.php",
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
                        swal("No Record Found", '', 'info');
                    }
                    else if (Data[0].FLAG == "ERREXECUTINGQUERY") {
                        console.log('Error In Executing Query');
                        swal("Something Went Wrong", '', 'error');
                    }
                    else {
                        console.log("Other Response FOund");
                        swal("Something Went Wrong", '', 'error');
                    }
                },
                error: function (Data) {
                    console.log("Error In ./SearchAndManageProductAjax/getAllDimesnsions.php   AJax Call");
                    swal("Something Went Wrong", '', 'error');
                }
            });
        }

        function ReloadProductTypeColorMenu() {
            //function getProductTypeColor(){
            ResetSelectMenu($("#getProductTypeColor"));
            $.ajax({
                type: "POST",
                url: "./SearchAndManageBreakageAndDamageAjax/getProductTypeColor.php",
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
                        swal("No Record Found", '', 'info');
                    }
                    else if (Data[0].FLAG == "ERREXECUTINGQUERY") {
                        console.log('Error In Executing Query');
                        swal("Something Went Wrong", '', 'error');
                    }
                    else {
                        console.log("Other Response FOund");
                        swal("Something Went Wrong", '', 'error');
                    }
                },
                error: function (Data) {
                    console.log("Error In  ./SearchAndManageProductAjax/getProductTypeColor.php AJax Call");
                    swal("Something Went Wrong", '', 'error');
                }
            });
        }

        function ReloadCodeSelectMenu() {
            ResetSelectMenu($("#getcode"));

            $.ajax({
                type: "POST",
                url: "./SearchAndManageBreakageAndDamageAjax/getCode.php",
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
                        swal("No Record Found", '', 'info');
                    }
                    else if (Data[0].FLAG == "ERREXECUTINGQUERY") {
                        console.log('Error In Executing Query');
                        swal("Something Went Wrong", '', 'error');
                    }
                    else {
                        console.log("Other Response FOund");
                        swal("Something Went Wrong", '', 'error');
                    }
                },
                error: function (Data) {
                    console.log("Error In  ./SearchAndManageProductAjax/getCode.php AJax Call");
                    swal("Something Went Wrong", '', 'error');
                }
            });
        }

        function ResetSelectMenu(sm) {
            sm.empty();
            sm.append(new Option("Select", "-1"));
        }

    });

    function cheakValidityOfStock(ref, maxqty, minqty){
        var qty = ref.value;

        if(qty > 0){
            if(qty > maxqty){
                swal("Quantity Not Available", 'Max Stock : ' + maxqty, 'warning').then(()=>{
                    ref.value = "";
                    ref.focus();
                });
                return;
            }
        }

        if(qty < 0){
            qty = Math.abs(qty);
            if(qty > minqty ){
                swal("More Then Previously Enterd Quentity", 'Max Decrement : ' + minqty, 'warning').then(()=>{
                    ref.value = "";
                    ref.focus();
                });
                return;
            }
        }
    }

    function splitDate(date) {
        var DateArray = date.split(" ");
        DateArray = DateArray[0];
        DateArray = DateArray.split("-");
        return (DateArray[2]+"-"+DateArray[1]+"-"+DateArray[0]);
    }
</script>