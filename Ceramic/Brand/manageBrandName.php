<!DOCTYPE html>
<html lang="en">
<?php include('./config.php');?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Brand</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <style>
        .old-category:disabled {
            background-color: lightslategrey;
        }

        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }

        th {
            text-align: center;
        }

        td {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container-fluid col-lg-12">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header" style="background-color: #2B60DE">
                        <h3 class="card-title" style="color: white" align="center">Manage Brand Name</h3>
                    </div>
                    <div class="card-body" style="background-color: #8da9bd;">
                        <div class='row'>
                            <div class="col-md-2">
                                <label class='form-label' for="categories_name">Categories :</label>
                            </div>
                            <div class="col-md-4">
                                <select class='form-control form-select' name="categories_name" id="categories_name"
                                    disabled>
                                    <option value="-1">Select</option>

                                </select>
                            </div>
                        </div>


                        <div class="row mt-4">
                            <div class="col-md-2">
                                <label class='form-label' for="SubCategoryLabel">Sub Category :</label>
                            </div>
                            <div class="col-md-4">
                                <select class='form-select' name="" id="subcategory_name">
                                    <option value="-1">Select</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <center><label class='form-label' id='OldSubCategoryLabel' for="OldSubCategoryLabel"
                                        hidden>Old
                                        Sub Category :</label></center>
                            </div>
                            <div class="col-md-4">
                                <input class='form-control' id='getOldSubCategoryName' type="text" hidden disabled>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-1">
                                <button id='lockbtn' class='btn btn-primary mt-3'>Lock</button>
                            </div>
                            <div class="col-md-1">
                                <button id='unlockbtn' class='btn btn-primary mt-3' disabled>UnLock</button>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-2">
                                <label class='mt-1' for="">Brand Name: </label>
                            </div>
                            <div class="col-md-4">
                                <select class='form-select' name="" id="selectbrandname" disabled>
                                    <option value="-1">Select</option>
                                </select>
                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-md-2">
                                <button id='addbrandbtn' class="btn btn-primary" disabled>Add Brand</button>
                            </div>
                        </div>

                        <!-- <button id='addbtn' class='btn btn-primary mt-3' disabled>Add</button> -->
                        <!-- <button id='savebtn' class='btn btn-primary mt-3' disabled>Save</button> -->
                        <!-- <button id='cancelbtn' class='btn btn-primary mt-3' disabled>Cancel</button> -->
                        <!-- <button id='loadbtn' class='btn btn-primary mt-3'>Load</button> -->
                    
                        <div class="row mt-5">

                        </div>

                        <table class="table" id="data_table">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Brand name</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody id='tblbody'>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    $(document).ready(function () {

        var lockflag = false;
        ReloadCategoriesOptions();

        $("#categories_name").on('change', function () {
            cat_name = $("#categories_name").val();
            $("#subcategory_name").empty();
            $("#subcategory_name").append(new Option("Select", "-1"));

            if (cat_name != "-1") {
                $.ajax({
                    type: "POST",
                    url: './ManageBrandNameAjax/getSubCategories.php',
                    data: { catname: cat_name },
                    dataType: 'json',
                    success: function (Data) {
                        if (Data[0].FLAG == 'OKK') {
                            var n = Data.length;
                            for (var i = 1; i < n; i++) {

                                $("#subcategory_name").append(new Option(Data[i].subcategory_name, Data[i].subcategoryid));
                            }
                        }
                        else if (Data[0].FLAG == 'ERRORINEXECUTINGQUERY') {
                            console.log("ERROR IN EXECUTING QUERY");
                            swal('Something Went Wrong', '', 'error');
                        }
                        else {
                            console.log('OTHER THEN FLAG');
                            swal('Something Went Wrong', '', 'error');
                        }
                    },
                    error: function (Data) {
                        console.log('Error In Ajax Call ' + Data);
                        swal('Something Went Wrong', '', 'error');
                    }
                });
            }
        });

        $("#lockbtn").click(function () {
            if ($("#categories_name").val() != "-1" && $("#subcategory_name").val() != "-1") {
                $("#lockbtn").prop('disabled', true);
                $("#unlockbtn").prop('disabled', false);
                lockflag = true;
                $("#selectbrandname").prop('disabled', false);
                $("#addbrandbtn").prop('disabled', false);

                $("#categories_name").prop('disabled', true);
                $("#subcategory_name").prop('disabled', true);
                ReloadTable();
                ReloadBrandNameOptions();
            }
            else {
                swal('Please Select Category Or Subcategory', '', 'warning');
            }
        });

        $("#unlockbtn").click(function () {

            $("#categories_name").empty();
            $("#categories_name").append(new Option("Select", "-1"));
            $("#categories_name").val("-1");

            $("#subcategory_name").empty();
            $("#subcategory_name").append(new Option("Select", "-1"));
            $("#subcategory_name").val("-1");
            ReloadCategoriesOptions();

            $("#unlockbtn").prop('disabled', true);
            $("#lockbtn").prop('disabled', false);

            lockflag = false;
            $("#selectbrandname").prop('disabled', true);
            $("#addbrandbtn").prop('disabled', true);

            $("#categories_name").prop('disabled', false);
            $("#subcategory_name").prop('disabled', false);

            $("#selectbrandname").empty();
            $("#selectbrandname").append(new Option("Select", "-1"));
            $("#selectbrandname").val("-1");

            $("#data_table tbody").empty();
        });

        $("#addbrandbtn").click(function () {   
            var subcategoryid = $("#subcategory_name").val();
            var brandid = $("#selectbrandname").val();
           
            if (brandid != "-1" && subcategoryid != "-1") {
                $.ajax({
                    type: "POST",
                    url: "./ManageBrandNameAjax/mapBrandName.php",
                    data: {subcategoryid: subcategoryid, brandid: brandid},
                    success: function(Data){

                        //console.log(Data);

                        if(Data == "1")
                        {
                            swal("Successfully Assigned " + $("#subcategory_name").children("option:selected").text() + " to " + $("#selectbrandname").children("option:selected").text(), '', 'success').then(()=>{ReloadTable();});
                            
                            $("#selectbrandname").val("-1");
                        }
                        else if(Data == "-3")
                        {
                            console.log("Brand Already Mapped With Subcategory");
                            swal("Brand Already Mapped With Subcategory",'', 'info');
                        }
                        else if (Data == "-1") {
                            console.log("Commit Failuier");
                            swal('Something Went Wrong', '', 'error');
                        }
                        else if (Data == "-2") {
                            console.log("Error While Mapping SubcategoryId With Brand");
                            swal('Something Went Wrong', '', 'error');
                        }
                        else if(Data == "-4")
                        {
                            console.log("More Then One Record Found");
                            swal('Something Went Wrong', '', 'error');
                        }
                        else if(Data == "-5")
                        {
                            console.log("Error In Cheacking Query");
                            swal('Something Went Wrong', '', 'error');
                        }
                        else {
                            console.log("Other Flag Error");
                            swal('Something Went Wrong', '', 'error');
                        }
                    },
                    error: function(Data){
                        console.log('Error While Mapping Subcategory with Brand Ajax Call');
                        swal('Something Went Wrong', '', 'error');
                    }
                });
            }
            else {
                swal('Please Select Brand Name', '', 'warning');
            }
        });

        $('#tblbody').on('click', '.changeMapStatus', function(){
            var brandmapid = $(this).attr('brandmapid');
            var recstatus  = $(this).attr('recstatus');
            var btnref = $(this);
            console.log(brandmapid);

            $.ajax({
                type: 'POST',
                url: './ManageBrandNameAjax/changeMapStatus.php',
                data: {brandmapid:brandmapid, recstatus:recstatus},
                success: function(Data){
                    console.log(Data);
                    if(Data == '1'){
                        var btntext = '';
                        var oldbtnclass = '';
                        var btnclass = '';

                        if(recstatus == 1){
                            btntext = 'Map';
                            newrecstatus = '0';
                            btnclass = 'btn-success';
                            oldbtnclass = 'btn-danger';
                        }
                        else{
                            btntext = 'Unmap';
                            newrecstatus = '1';
                            btnclass = 'btn-danger';
                            oldbtnclass = 'btn-success';
                        }
                        btnref.html(btntext);
                        btnref.attr('recstatus', newrecstatus);
                        btnref.removeClass(oldbtnclass);
                        btnref.addClass(btnclass);
                        
                        if(recstatus == 1){
                            swal('Brand Unmaped', '', 'warning');
                        }
                        else{
                            swal('Successfully Mapped Brand With Selected Subcategory', '', 'success');
                        }

                    }
                    else if(Data == '-1'){
                        console.log('commit fail');
                        swal('Something Went Wrong', '', 'error');
                    }
                    else if(Data == '-2'){
                        console.log('err in update query');
                        swal('Something Went Wrong', '', 'error');
                    }
                    else{
                        console.log('Other Flag Recived');
                        swal('Something Went Wrong', '', 'error');
                    }
                    
                },
                error: function(Data){
                    console.log("Error In  ./ManageBrandNameAjax/changeMapStatus.php   Ajax Call");
                    swal('Something Went Wrong', '', 'error');
                }
            });
        });

        function ReloadOptions() {

            $("#categories_name").empty();
            $("#categories_name").append(new Option("Select", "-1"));

            $.ajax({
                type: "POST",
                url: "./ManageBrandNameAjax/getBrandNames.php",
                dataType: "json",
                success: function (Data) {
                    if (Data[0].FLAG == 'OKK') {
                        var n = Data.length;
                        for (var i = 1; i < n; i++) {
                            $("#categories_name").append(new Option(Data[i].brandname, Data[i].brandid));
                        }
                        $("#categories_name").prop('disabled', false);
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
                    //console.log(Data);
                    swal('Something Went Wrong', '', 'error');
                }
            });

        }

        function ReloadCategoriesOptions() {

            $("#categories_name").empty();
            $("#categories_name").append(new Option("Select", "-1"));

            $.ajax({
                type: "POST",
                url: "./ManageBrandNameAjax/getCategories.php",
                dataType: "json",
                success: function (Data) {
                    if (Data[0].FLAG == 'OKK') {
                        var n = Data.length;
                        for (var i = 1; i < n; i++) {
                            $("#categories_name").append(new Option(Data[i].category_name, Data[i].category_id));
                        }
                        $("#categories_name").prop('disabled', false);
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
                    //console.log(Data);
                    swal('Something Went Wrong', '', 'error');
                }
            });
        }

        function ReloadBrandNameOptions() {

            $("#selectbrandname").empty();
            $("#selectbrandname").append(new Option("Select", "-1"));

            $.ajax({
                type: "POST",
                url: "./ManageBrandNameAjax/getBrandNames.php",
                dataType: 'json',
                success: function (Data) {
                    if (Data[0].FLAG == 'OKK') {
                        var n = Data.length;
                        for (var i = 1; i < n; i++) {
                            $("#selectbrandname").append(new Option(Data[i].brandname, Data[i].brandid));
                        }
                        $("#selectbrandname").prop('disabled', false);
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

        function ReloadTable() {
            $("#tblbody").empty();
            var subcategoryid = $("#subcategory_name").val();

            $.ajax({
                type: "POST",
                url: "./ManageBrandNameAjax/getBrandsFromSubcategory.php",
                data: { subcatid: subcategoryid },
                dataType: 'json',
                success: function (Data) {
                    console.log(Data);
                    if(Data[0].FLAG == "OKK")
                    {
                        var n = Data.length;

                        for(var i=1; i<n; i++)
                        {
                            var brandmapid  = Data[i].brandmapid;
                            var brandname   = Data[i].brandname;
                            var recstatus   = Data[i].recstatus;
                            var btncolor    = '';
                            if(recstatus == 1){
                                btncolor = 'btn-danger';
                                btntext  = 'Unmap';
                            }
                            else{
                                btncolor = 'btn-success';
                                btntext  = 'Map';
                            }

                            $("#data_table tbody:last-child").append(
                                '<tr>' +
                                    '<td>' + i + '</td>' +
                                    '<td>' + brandname + '</td>' +
                                    '<td>' + 
                                        '<button class="btn '+ btncolor +' changeMapStatus" brandmapid='+brandmapid+'  recstatus='+recstatus+'> '+ btntext +' </button>' +
                                    '</td>' +
                                '</tr>'
                            );
                        }
                    }
                    else if(Data[0].FLAG == "RECORDNOTFOUND")
                    {
                        console.log("RECORD NOT FOUND");
                        swal("No Brands Are Mapped With Selected Category And Subcategory", '', 'info');
                    }
                    else if(Data[0].FLAG == 'ERRORINEXECUTINGQUERY')
                    {
                        console.log("ERROR IN EXECUTING QUERY");
                        swal('Something Went Wrong', '', 'error');
                    }
                    else
                    {
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
    });
</script>

</html>