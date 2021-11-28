<?php
    include('./config.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ManageSubCategories</title>
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
                        <h3 class="card-title" style="color: white" align="center">Manage Sub Categories</h3>
                    </div>
                    <div class="card-body" style="background-color: #8da9bd;">
                        <div class='row'>
                            <div class="col-md-2 mt-1">
                                <label class='form-label' for="categories_name">Categories :</label>
                            </div>
                            <div class="col-md-4">
                                <select class='form-control form-select' name="categories_name" id="categories_name">
                                    <option value="-1">Select</option>
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
                                                "<option value=".$category_id.">".$category_name."</option>";
                                            }
                                        }
                                        else
                                        {
                                            echo "<script>alert('Something Went Wrong');</script>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-2"></div>
                            <div class="col-md-4 row">
                                <div class="col-md-1">
                                    <input class='form-check-input' id='addcheck' type="checkbox">
                                </div>
                                <div class="col-md-11">
                                    <label for="">Add New Sub Category</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-2 mt-1">
                                <label class='form-label' for="SubCategoryLabel">Sub Category :</label>
                            </div>
                            <div class="col-md-4">
                                <input class='form-control' id='getSubCategoryName' type="text" disabled>
                                <input class='form-control' id='getSubCategoryId' type="text" disabled hidden>
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

                        <div class="row mt-4">
                            <div class="col-md-2 mt-1">
                                <label class='form-label' for="HSNCodeLabel">HSN Code :</label>
                            </div>
                            <div class="col-md-4">
                                <input class='form-control' id='getHSNCode' type="number"
                                    onKeyPress="if(this.value.length==8) return false;" disabled>
                            </div>
                            <div class="col-md-2">
                                <center><label class='form-label' id='OldHSNCodeLabel' for="OldHSNCodeLabel" hidden>Old
                                        HSN Code
                                        :</label></center>
                            </div>
                            <div class="col-md-4">
                                <input class='form-control' id='OldHSNCode' type="number" hidden disabled>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-2 mt-1">
                                <label class='form-label' for="GSTLabel">GST :</label>
                            </div>
                            <div class="col-md-4">
                                <select name="" id="selectgst" class='form-select' disabled>
                                    <option value="-1">Select</option>
                                    <option value="5">5</option>
                                    <option value="12">12</option>
                                    <option value="18">18</option>
                                    <option value="28">28</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <center><label class='form-label' id='OldGstLabel' for="OldGst" hidden>Old
                                        GST
                                        :</label></center>
                            </div>
                            <div class="col-md-4">
                                <input class='form-control' id='OldGst' type="number" hidden disabled>
                            </div>
                        </div>

                        <button id='addbtn' class='btn btn-primary mt-3' disabled>Add</button>
                        <button id='savebtn' class='btn btn-primary mt-3' disabled>Save</button>
                        <button id='cancelbtn' class='btn btn-primary mt-3' disabled>Cancel</button>
                        <button id='loadbtn' class='btn btn-primary mt-3'>Load</button>


                        <table class="table" id="data_table">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Categories</th>
                                    <th>HSN Code</th>
                                    <th>GST</th>
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


    <script>
        let editflag = false;

        $(document).ready(function () {

            $("tbody").on('click', '.btn-active', function () {
                let id = $(this).attr("scid");
                let as = $(this).attr("as");
                let t = $(this);

                if (id != '' && as != '') {
                    let myobj = { cid: id, as: as };
                    $.ajax({
                        type: "POST",
                        url: './ManageSubCategoryAjax/changeActiveStatusSubCategory.php',
                        data: JSON.stringify(myobj),
                        success: function (Data) {
                            if (as == '1' && Data == '1') {
                                t.attr("as", '0');
                                t.removeClass('btn-success');
                                t.addClass('btn-danger');
                                t.html('Active');
                            }
                            else if (as == '1' && Data == '0') {
                                alert('Status Not Changed');
                            }
                            else if (as == '0' && Data == '1') {
                                t.attr("as", '1');
                                t.removeClass('btn-danger');
                                t.addClass('btn-success');
                                t.html('Deactive');
                            }
                            else {
                                alert('Status Not Changed');
                            }
                        }
                    });
                }
            });

            $("tbody").on('click', '.btn-edit', function () {
                editflag = true;
                let id = $(this).attr("scid");
                let t = $(this);
                $("#categories_name").prop('disabled', true);
                if (id != '') {
                    let myobj = { scid: id };
                    $.ajax({
                        type: "POST",
                        url: './ManageSubCategoryAjax/editSubCategoryfetchData.php',
                        data: JSON.stringify(myobj),
                        dataType: 'json',
                        success: function (Data) {
                            //console.log(Data);

                            if (Data[0].FLAG == "RECORDFOUND") {

                                $('#getSubCategoryId').val(id);
                                $("#getSubCategoryName").val(Data[1].subcategory_name);
                                $("#getOldSubCategoryName").val(Data[1].subcategory_name);
                                $("#getHSNCode").val(Data[1].hsncode);
                                $("#OldHSNCode").val(Data[1].hsncode);
                                $("#getSubCategoryName").attr('disabled', false);
                                $("#getHSNCode").attr('disabled', false);
                                $("#OldSubCategoryLabel").attr('hidden', false);
                                $("#getOldSubCategoryName").attr('hidden', false);
                                $("#OldHSNCodeLabel").attr('hidden', false);
                                $("#OldHSNCode").attr('hidden', false);
                                $("#selectgst").prop('disabled', false);
                                $("#selectgst").val(Data[1].gst);
                                $("#OldGstLabel").prop('hidden', false);
                                $("#OldGst").prop('hidden', false);
                                $("#OldGst").val(Data[1].gst);


                                $("#addbtn").attr('disabled', true);
                                $("#savebtn").attr('disabled', false);
                                $("#loadbtn").attr('disabled', true);
                                $("#cancelbtn").attr('disabled', false);
                            }
                            else if (Data[0].FLAG == "ERROR") {
                                console.log("ERROR IN EXECUTING ERROR");
                                alert("Something Went Wrong");
                            }
                        }
                    });
                }
            });

            $('#savebtn').on('click', function () {
                let id = $('#getSubCategoryId').val();
                let subcategory_name = $('#getSubCategoryName').val();
                let hsncode = $("#getHSNCode").val();
                let gst = $("#selectgst").val();
                let myobj = { scid: id, scname: subcategory_name, hsncode: hsncode, gst: gst };

                if (subcategory_name != '' && id != '-1' && hsncode != '' && gst != '') {
                    $.ajax({
                        type: "POST",
                        url: './ManageSubCategoryAjax/editSubCategory.php',
                        data: JSON.stringify(myobj),
                        success: function (Data) {
                            //console.log(Data);
                            if (Data == "1") {
                                swal('Succesfully Updated Subcategory', '', 'success').then(() => {
                                    ReloadSettings();
                                    ReloadTable();
                                });
                            }
                            else if (Data == "-3") {
                                console.log('RECORD FOUND');
                                //swal('Subcategory Already Exists', '', 'info');
                                swal({
                                    title: "It Seems Subcategory Already Exists",
                                    text: "Do you Want To Update GST Or HSN Code For This Subcategory",
                                    icon: "warning",
                                    buttons: true,
                                    dangerMode: true,
                                    buttons: ["NO", "YES"],
                                })
                                    .then((willDelete) => {
                                        if (willDelete) {

                                            if (subcategory_name != '' && id != '-1' && hsncode != '' && gst != '') {
                                                $.ajax({
                                                    type: "POST",
                                                    url: "./ManageSubCategoryAjax/updateGSTORHSN.php",
                                                    data: { scid: id, scname: subcategory_name, hsncode: hsncode, gst: gst },
                                                    success: function (Data) {
                                                        console.log(Data);
                                                        if(Data == 1){
                                                            swal('Successfully Updated HSN Code And GST', '', 'success').then(()=>{
                                                                ReloadSettings();
                                                                ReloadTable();
                                                            });
                                                        }
                                                        else if(Data == "-1"){
                                                            console.log(' parameter empty');
                                                            swal('Something Went Wrong', '', 'error');
                                                        }
                                                        else if(Data == "-2"){
                                                            console.log('commit fail');
                                                            swal('Something Went Wrong', '', 'error');
                                                        }
                                                        else if(Data == '-3'){
                                                            console.log('Error While Executing Query');
                                                            swal('Something Went Wrong', '', 'error');
                                                        }
                                                    },
                                                    error: function (Data) {    
                                                        console.log('ERROR IN ./ManageSubCategoryAjax/updateGSTORHSN.php  AJax Call');
                                                        swal('Something Went Wrong', '', 'error');
                                                    }
                                                });
                                            }
                                            else {
                                                swal('Please Fill All The Fields', '', 'warning');
                                            }

                                        }
                                        else {
                                            console.log('ABORTED proccess of updateing gst and HSN Code');
                                            ReloadSettings();
                                        }
                                    });
                            }
                            else if (Data == "-1") {
                                console.log('Commit Fail');
                                swal("Something Went Wrong", '', 'error');
                            }
                            else if (Data == "-2") {
                                console.log('err in update query');
                                swal("Something Went Wrong", '', 'error');
                            }
                            else if (Data == "-4") {
                                console.log('morethen one record or err');
                                swal("Something Went Wrong", '', 'error');
                            }
                            else if (Data == "-5") {
                                console.log("err in checking query");
                                swal("Something Went Wrong", '', 'error');
                            }
                            else if (Data == "-6") {
                                console.log("parameter empty");
                                swal("Something Went Wrong", '', 'error');
                            }
                            else {
                                console.log("Other Then Flag");
                                swal("Something Went Wrong", '', 'error');
                            }
                        },
                        error: function (Data) {
                            console.log('Error In edit dubcategory Ajax Call');
                            swal("Something Went Wrong", '', 'error');
                        }
                    });

                }
                else {
                    swal("Please Fill All The Field", '', 'info').then(() => {
                        location.reload(true);
                    });
                }
            });

            $('#addbtn').on('click', function () {
                let category_id = $('#categories_name').val();
                let subcategory_name = $('#getSubCategoryName').val();
                let hsncode = $('#getHSNCode').val();
                let gst = $('#selectgst').val();

                if (subcategory_name != '' && category_id != '-1' && hsncode != '' && gst != "-1") {
                    myobj = { scname: subcategory_name, cid: category_id, hsncode: hsncode, gst: gst };
                    $.ajax({
                        type: "POST",
                        url: './ManageSubCategoryAjax/addSubCategory.php',
                        data: JSON.stringify(myobj),
                        success: function (Data) {
                            //console.log(Data);
                            if (Data == "1") {
                                swal('SubCategory Added Successfully', '', 'success').then(() => {
                                    $('#getSubCategoryId').val('');
                                    $("#getSubCategoryName").val('');
                                    $("#getSubCategoryName").prop('disabled', true);
                                    $("#getOldSubCategoryName").val('');
                                    $("#OldSubCategoryLabel").attr('hidden', true);
                                    $("#getOldSubCategoryName").attr('hidden', true);
                                    $("#getHSNCode").val('');
                                    $("#getHSNCode").prop('disabled', true);
                                    $("#OldHSNCodeLabel").attr('hidden', true);
                                    $("#OldHSNCode").attr('hidden', true);
                                    $("#addcheck").prop("checked", false);
                                    $("#addbtn").attr('disabled', true);
                                    $("#savebtn").attr('disabled', true);
                                    $("#cancelbtn").attr('disabled', true);
                                    $("#loadbtn").attr('disabled', false);
                                    editflag = false;
                                    $("#categories_name").prop('disabled', false);
                                    $("#OldGstLabel").prop('hidden', true);
                                    $("#OldGst").prop('hidden', true);
                                    $("#OldGst").val("");
                                    $("#selectgst").val('-1');
                                    $("#selectgst").prop('disabled', true);
                                    ReloadTable();
                                });
                            }
                            else if (Data == "-3") {
                                console.log('RECORD FOUND');
                                swal("Subcategory Already Exists", '', 'info');
                            }
                            else if (Data == "-1") {
                                console.log('Commit Fail');
                                swal("Something Went Wrong", '', 'error');
                            }
                            else if (Data == "-4") {
                                console.log('More Then One Record Found');
                                swal("Something Went Wrong", '', 'error');
                            }
                            else if (Data == "-5") {
                                console.log('Error In Cheacking');
                                swal("Something Went Wrong", '', 'error');
                            }
                            else if (Data == "-6") {
                                console.log("Parameters Empty");
                                swal("Something Went Wrong", '', 'error');
                            }
                            else if (Data == "-2") {
                                console.log("ERROR WHILE inserting");
                                swal("Something Went Wrong", '', 'error');
                            }
                            else {
                                console.log("Other Then Flag");
                                swal("Something Went Wrong", '', 'error');
                            }

                        }
                    });
                }
                else {
                    swal("Fields Empty", 'Please Fill All The Fields Of New Subcategory', 'info');
                }
            });

            $("#loadbtn").on('click', function () {
                let sel_id = $("#categories_name").val();

                if (sel_id != '-1') {
                    myobj = { cid: sel_id };
                    $.ajax({
                        type: "POST",
                        url: './ManageSubCategoryAjax/getSubCategories.php',
                        data: JSON.stringify(myobj),
                        dataType: "json",
                        success: function (Data) {
                            //console.log(Data);
                            if (Data[0].FLAG == "OK") {
                                var x = Data;
                                var appendInTable;
                                var sci;
                                var scn;
                                var as;
                                var color;
                                var btntext;
                                var hsncode;
                                for (var i = 1; i < x.length; i++) {
                                    scid = Data[i].sci;
                                    scn = Data[i].scn;
                                    as = Data[i].as;
                                    hsncode = Data[i].hsncode;
                                    gst = Data[i].gst;
                                    if (as == 1) {
                                        color = 'success';
                                        btntext = 'Deactive';
                                    }
                                    else {
                                        color = 'danger';
                                        btntext = 'Active';
                                    }

                                    appendInTable +=
                                        "<tr>" +
                                        "<td>" + i + "</td>" +
                                        "<td>" + scn + "</td>" +
                                        "<td>" + hsncode + "</td>" +
                                        "<td>" + gst + "</td>" +
                                        "<td>" +
                                        "<button class='btn btn-success btn-edit' scid=" + scid + " as=" + as + ">Edit</button> " +
                                        " <button class='btn btn-primary btn-" + color + " btn-active' scid=" + scid + " as=" + as + ">" + btntext + "</button>" +
                                        "</td>" +
                                        "</tr>";
                                    $("#tblbody").html(appendInTable);
                                }
                            }
                            else {
                                alert("Challan Id Not Found");
                            }
                        }
                    });
                }
                else {
                    alert('Please Select Category');
                }

            });

            $("#categories_name").on('change', function () {
                $("#tblbody").empty();
            });

            $("#addcheck").on('change', function () {


                if (editflag == 0) {

                    if ($("#categories_name").val() != "-1") {
                        if ($("#addcheck").prop("checked") == true) {

                            $("#categories_name").prop('disabled', true);

                            $("#getSubCategoryName").attr('disabled', false);
                            $("#getHSNCode").attr('disabled', false);

                            $('#loadbtn').attr('disabled', true);
                            $('#savebtn').attr('disabled', true);
                            $('#addbtn').attr('disabled', false);
                            $('#cancelbtn').attr('disabled', false);
                            $('#selectgst').prop('disabled', false);
                        }
                        else {
                            $('#getSubCategoryId').val('');

                            $("#getSubCategoryName").val('');
                            $("#getOldSubCategoryName").val('');
                            $("#OldSubCategoryLabel").attr('hidden', true);
                            $("#getOldSubCategoryName").attr('hidden', true);
                            $("#getHSNCode").val('');
                            $("#getHSNCode").prop('disabled', true);
                            $("#getHSNCode").val('');
                            $("#OldHSNCodeLabel").attr('hidden', true);
                            $("#OldHSNCode").attr('hidden', true);

                            $("#addcheck").prop("checked", false);

                            //$("#getOldSubCategoryName").val('');
                            $("#addbtn").attr('disabled', true);
                            $("#savebtn").attr('disabled', true);
                            $("#cancelbtn").attr('disabled', true);
                            $("#loadbtn").attr('disabled', false);
                            editflag = false;
                            $('#selectgst').prop('disabled', true);
                        }
                    }
                    else {
                        alert('Please Select Category');
                        $("#addcheck").prop('checked', false);
                    }

                }
                else {
                    alert("IN EDIT MODE");
                    $("#addcheck").prop('checked', false);
                }
            });

            $("#cancelbtn").click(function () {
                let id = null;
                let t = null;;
                if (id != undefined) {
                }
                else {
                    editflag = false;
                    $("#addcheck").prop('checked', false);

                    $('#getSubCategoryId').val('');
                    $("#getSubCategoryName").val('');
                    $("#getOldSubCategoryName").val('');
                    $("#getHSNCode").val('');
                    $("#OldHSNCode").val('');
                    $("#getSubCategoryName").attr('disabled', true);
                    $("#getHSNCode").attr('disabled', true);
                    $("#OldSubCategoryLabel").attr('hidden', true);
                    $("#getOldSubCategoryName").attr('hidden', true);
                    $("#OldHSNCodeLabel").attr('hidden', true);
                    $("#OldHSNCode").attr('hidden', true);
                    $("#categories_name").prop('disabled', false);
                    $("#categories_name").prop('disabled', false);
                    $("#OldGstLabel").prop('hidden', true);
                    $("#OldGst").prop('hidden', true);
                    $("#OldGst").val("");
                    $("#selectgst").val('-1');
                    $("#selectgst").prop('disabled', true);

                    $("#addbtn").attr('disabled', true);
                    $("#savebtn").attr('disabled', true);
                    $("#loadbtn").attr('disabled', false);
                    $("#cancelbtn").attr('disabled', true);
                }
            });

        });

        function ReloadTable() {

            $("#tblbody").empty();
            let sel_id = $("#categories_name").val();

            if (sel_id != '-1') {
                myobj = { cid: sel_id };
                $.ajax({
                    type: "POST",
                    url: './ManageSubCategoryAjax/getSubCategories.php',
                    data: JSON.stringify(myobj),
                    dataType: "json",
                    success: function (Data) {
                        //console.log(Data);
                        if (Data[0].FLAG == "OK") {
                            var x = Data;
                            var appendInTable;
                            var sci;
                            var scn;
                            var as;
                            var color;
                            var btntext;
                            var gst;
                            for (var i = 1; i < x.length; i++) {
                                scid = Data[i].sci;
                                scn = Data[i].scn;
                                as = Data[i].as;
                                gst = Data[i].gst;
                                hsncode = Data[i].hsncode;
                                if (as == 1) {
                                    color = 'success';
                                    btntext = 'Deactive';
                                }
                                else {
                                    color = 'danger';
                                    btntext = 'Active';
                                }

                                appendInTable +=
                                    "<tr>" +
                                    "<td>" + i + "</td>" +
                                    "<td>" + scn + "</td>" +
                                    "<td>" + hsncode + "</td>" +
                                    "<td>" + gst + "</td>" +
                                    "<td>" +
                                    "<button class='btn btn-success btn-edit' scid=" + scid + " as=" + as + ">Edit</button>  " +
                                    "<button class='btn btn-primary btn-" + color + " btn-active' scid=" + scid + " as=" + as + ">" + btntext + "</button>" +
                                    "</td>" +
                                    "</tr>";
                                $("#tblbody").html(appendInTable);
                            }
                        }
                        else {
                            swal("Something Went Wrong", '', 'error');
                        }
                    }
                });
            }
            else {
                swal('Please Select Category', '', 'info');
            }


        }

        function ReloadSettings() {
            $('#getSubCategoryId').val('');
            $("#getSubCategoryName").val('');
            $("#getSubCategoryName").prop('disabled', true);
            $("#getOldSubCategoryName").val('');
            $("#OldSubCategoryLabel").attr('hidden', true);
            $("#getOldSubCategoryName").attr('hidden', true);
            $("#getHSNCode").val('');
            $("#getHSNCode").prop('disabled', true);
            $("#OldHSNCodeLabel").attr('hidden', true);
            $("#OldHSNCode").attr('hidden', true);
            $("#addcheck").prop("checked", false);
            $("#addbtn").attr('disabled', true);
            $("#savebtn").attr('disabled', true);
            $("#cancelbtn").attr('disabled', true);
            $("#loadbtn").attr('disabled', false);
            editflag = false;
            $("#categories_name").prop('disabled', false);
            $("#OldGstLabel").prop('hidden', true);
            $("#OldGst").prop('hidden', true);
            $("#OldGst").val("");
            $("#selectgst").val('-1');
            $("#selectgst").prop('disabled', true);
            //ReloadTable();
        }
    </script>
</body>

</html>