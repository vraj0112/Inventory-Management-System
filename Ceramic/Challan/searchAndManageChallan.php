<!DOCTYPE html>
<html lang="en">
<?php include('./config.php');?>

<head>
    <title>Seach & Manage Challan</title>
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
    <script src="https://cdn.jsdelivr.net/npm/table-to-json@1.0.0/lib/jquery.tabletojson.min.js"
        integrity="sha256-H8xrCe0tZFi/C2CgxkmiGksqVaxhW0PFcUKZJZo1yNU=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
                            <h3 class="card-title" style="color: white">Manage Challan</h3>
                        </center>
                    </div>
                    <div class="card-body">
                        <form id="searchByForm" autocomplete="off">
                            <div class="row">
                                <div class="row col-md-6">
                                    <div class="col-md-2">
                                        <label class="form-label" style="margin-right: 10px;">Search By: </label>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-check-label" for="challanNoRadio">
                                            <input class="form-check-input searchby" type="radio" name="searchBy"
                                                id="challanNoRadio" value="Challan No" onchange="checkRadio()">
                                            Challan No</label>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-check-label" for="customerNameRadio">
                                            <input class="form-check-input searchby" type="radio" name="searchBy"
                                                id="customerNameRadio" value="Customer Name" onchange="checkRadio()">
                                            Customer Name</label>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-check-label" for="dateRadio">
                                            <input class="form-check-input searchby" type="radio" name="searchBy"
                                                id="dateRadio" value="Date" onchange="checkRadio()">
                                            Date</label>
                                    </div>
                                </div>
                                <div class="row col-md-6">
                                    
                                    <!-- <div class="col-md-4">
                                    </div> -->
                                </div>
                            </div>


                            <!-- <div class="form-check form-check-inline">
                            </div> -->
                            <!-- <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="searchBy" id="ChallanDate"
                                        value=" Challan Date" onchange="checkRadio()">
                                    <label class="form-check-label" for="inlineCheck2">Date</label>
                                </div> -->
                            <!-- <div class="form-check form-check-inline">
                            </div> -->
                            <!-- <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="searchBy" id="CustomerContactNo"
                                        value="Contact Number" onchange="checkRadio()">
                                    <label class="form-check-label" for="inlineCheck4">Customer Contact Number</label>
                                </div> -->

                            <div class="row">
                                <div class="col-md-3 form-group">
                                    <Label class="form-label">Challan No :</Label>
                                    <input class="txt-box form-control" type="number" placeholder="Challan No..."
                                        onKeyPress="if(this.value.length==10) return false;" id="challan-no"
                                        name="challan-no" disabled>
                                </div>
                                <div class="col-md-3 form-group">
                                    <Label >Customer Name :</Label>
                                    <select name="" class="customer-name form-select" id="customer-id" disabled>
                                    </select>
                                    <!-- <input class="txt-box form-control" type="text" placeholder="Customer Name" id="customer-name-txt" style=> -->
                                </div>
                                <div class="col-md-3 form-group">
                                        <label class="form-label">From Date:</label>
                                        <input type="date" class='form-control get-date' id="getFromDate" disabled>
                                    </div>
                                    <!-- <div class="col-md-4">
                                    </div> -->
                                    <div class="col-md-3 form-group">
                                        <label class="form-label">To Date:</label>
                                        <input type="date" class='form-control get-date' id="getToDate"
                                            value="<?php echo $today; ?>" disabled>
                                    </div>
                            </div>

                            <!-- <div class="row mt-3">
                                <div class="col-md-3 form-group">
                                    <Label>Mobile No :</Label>
                                    <input class="txt-box form-control" type="number" placeholder="Mobile No..."
                                        onKeyPress="if(this.value.length==10) return false;" style="margin-top: 8px;"
                                        id="mobile-no-txt" disabled>
                                </div>
                                <div class="col-md-3 form-group">
                                    <Label>Invoice Date :</Label>
                                    <input type="date" class="form-control" style="margin-top: 8px;" id="date-input"
                                        disabled>
                                </div>
                            </div> -->

                            <div class="row">
                                <div class="col-md-6 mt-3">
                                    
                                        <input style="margin-right: 5px;" type="button" value="Search" id="searchbtn"
                                            class="btn btn-primary">
                                        <input style="margin-left: 5px;" type="button" value="Reset" id="resetbtn"
                                            class="btn btn-primary">
                                        <input style="margin-left: 5px;" type="button" value="Close" id="closebtn"
                                            class="btn btn-primary" onclick="location.href = '../admin.php';">
                                                                    </div>
                            </div>
                            <!-- </div> -->
                        </form>
                    </div>
                    <!-- <link rel="stylesheet" href="./SearchAndManageChallanAjax/getChallanByChallanNo.php"> -->
                    <table id='allchallantable'>
                        <thead>
                            <th>Challan No</th>
                            <th>Challan Date</th>
                            <th>Customer Name</th>
                            <th>Action</th>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    <form action="./SearchAndManageChallanAjax/viewChallanByChallanId.php" method="POST" target="_blank"
                        id='openform' hidden>
                        <input type="text" name='challanid' id='openFormChallanId'>
                    </form>
                    <form action="./SearchAndManageChallanAjax/pdf.php" method="POST" target="_blank" id='pdfform'
                        hidden>
                        <input type="text" name='challanid' id='pdfFormChallanId'>
                    </form>
                    <form action="./SearchAndManageChallanAjax/editChallan.php" method="POST" id='editform'
                        target="_blank" hidden>
                        <input type="text" name='challanid' id='editFormChallanId'>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function () {

            $("#customer-id").chosen();
            loadCustomerName();

            $("#resetbtn").click(function () {
                resetFrame();
            });

            $("#searchbtn").click(function () {
                $("#allchallantable tbody").empty();

                if ($("#challanNoRadio").prop('checked') == false && $("#customerNameRadio").prop('checked') == false && $("#dateRadio").prop('checked') == false) {
                    swal("Please Select Search By Option", '', 'info');
                    return;
                }

                if ($("#challanNoRadio").prop('checked') == true) {
                    var challanno = $("#challan-no").val();
                    if (challanno == "") {
                        swal("Please Enter Challan No", '', 'info');
                        return;
                    }
                    if (challanno.length != 10) {
                        swal("Please Enter Valid Challan No", '', 'info');
                        return;
                    }
                    searchChallanByChallanNo(challanno);
                }
                else if ($("#customerNameRadio").prop('checked') == true) {
                    var customerid = $("#customer-id").val();
                    if (customerid == '-1') {
                        swal("Please Select Customer", '', 'info');
                        return;
                    }
                    var fromdate = $("#getFromDate").val();
                    if (fromdate == "") {
                        swal("Please Select From Date", '', 'info');
                        return;
                    }
                    var todate = $("#getToDate").val();
                    if (todate == "") {
                        swal("Please Select To Date", '', 'info');
                        return;
                    }
                    serchChallanByCustomerId(customerid, fromdate, todate);
                }
                else {
                    var fromdate = $("#getFromDate").val();
                    if (fromdate == "") {
                        swal("Please Select From Date", '', 'info');
                        return;
                    }
                    var todate = $("#getToDate").val();
                    if (todate == "") {
                        swal("Please Select To Date", '', 'info');
                        return;
                    }
                    searchChallanByDate(fromdate, todate);
                }


            });

            $("#challan-no").keyup(function (event) {
                if (event.which === 13) {
                    $("#searchbtn").click();
                }
            });

            $("#allchallantable tbody").on('click', '.editbtn', function () {
                var challanid = $(this).attr('challanid');
                $("#editFormChallanId").val(challanid);
                $("#editform").submit();

            });

            $("#allchallantable tbody").on('click', '.openbtn', function () {
                var challanid = $(this).attr('challanid');
                $("#openFormChallanId").val(challanid);
                $("#openform").submit();
            });

            $("#allchallantable tbody").on('click', '.pdfbtn', function () {
                var challanid = $(this).attr("challanid");
                console.log(challanid);
                $("#pdfFormChallanId").val(challanid);
                $("#pdfform").submit();
            });

            $("#allchallantable tbody").on('click', '.deletebtn', function () {
                var challanid = $(this).attr("challanid");
                var challanno = $(this).attr("challanno");

                swal({
                    title: "Are You Sure You Want To Delete Challan : " + challanno,
                    text: "Once deleted, you will not be able to recover this challan back!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                                type: "POST",
                                url: "./SearchAndManageChallanAjax/deleteChallan.php",
                                data: { challanid: challanid },
                                success: function (Data) {
                                    console.log(Data);
                                    if (Data == "1") {
                                        $("#searchbtn").click();
                                        swal("Challan Deleted Successfully", '', 'success');
                                    }
                                    else if (Data == "-1") {
                                        console.log("Error In Query");
                                        swal("Something Went Wrong", '', 'error');
                                    }
                                    else if (Data == "-2") {
                                        console.log("No Record Found");
                                        swal("Something Went Wrong", '', 'error');
                                    }
                                    else if (Data == "-3") {
                                        console.log("Error In Updating Stocks");
                                        swal("Something Went Wrong", '', 'error');
                                    }
                                    else if (Data == "-4") {
                                        console.log("Error In Commit");
                                        swal("Something Went Wrong", '', 'error');
                                    }
                                    else if (Data == "-5") {
                                        console.log("Error In Updating Rec Status");
                                        swal("Something Went Wrong", '', 'error');
                                    }
                                    else {
                                        console.log("Other Response Found");
                                        swal("Something Went Wrong", '', 'error');
                                    }
                                },
                                error: function (Data) {
                                    console.log("Error In  ./SearchAndManageChallanAjax/deleteChallan.php   Ajax Call");
                                    swal("Something Went Wrong", '', 'error');
                                    return;
                                }
                            });
                        } else {
                            swal("Challan Not Deleted", '', 'info');
                        }
                    });

            });

            function loadCustomerName() {
                $.ajax({
                    type: "POST",
                    url: "./SearchAndManageChallanAjax/getCustomerNames.php",
                    dataType: 'json',
                    success: function (Data) {
                        console.log(Data);
                        if (Data[0].FLAG == "OKK") {
                            $("#customer-id").append(new Option("Select", '-1'));
                            var n = Data.length;
                            for (var i = 1; i < n; i++) {
                                $("#customer-id").append(new Option(Data[i].customername + " " + Data[i].mobileno, Data[i].customerid));
                            }
                        }
                        else if (Data[0].FLAG == "NORECORDFOUND") {
                            console.log('No Record Found !!!');
                        }
                        else if (Data[0].FLAG == "ERRINQUERY") {
                            console.log('Error In Query');
                        }
                        else {
                            console.log("Other Response Found");
                        }
                    },
                    error: function (Data) {
                        console.log("Error  ./SearchAndManageChallanAjax/getCustomerNames.php   Ajax Call");
                    }
                });
                $("#customer-name-select-menu")
            }

            function resetFrame() {
                $(".searchby").prop('checked', false);
                $("#getFromDate").val("");
                $("#getToDate").val("<?php echo $today; ?>");
                $(".get-date").prop('disabled', true);
                $("#challan-no").val("");
                $("#challan-no").prop('disabled', true);
                $("#customer-id").val("-1");
                $("#customer-id").prop('disabled', true).chosen();
                $("#customer-id").prop('disabled', true).trigger('chosen:updated');
                $("#allchallantable tbody").empty();
            }

            function searchChallanByChallanNo(challanno) {
                if (challanno != "") {
                    $.ajax({
                        type: "POST",
                        url: "./SearchAndManageChallanAjax/getChallanByChallanNo.php",
                        data: { challanno: challanno },
                        dataType: 'json',
                        success: function (Data) {
                            if (Data[0].FLAG == "OKK") {
                                var challandate = Data[1].challandate;
                                var customername = Data[1].customername;
                                var recstatus = Data[1].recstatus;
                                var challanid = Data[1].challanid;
                                if (recstatus == '0') {
                                    var color = "style='background-color:#ff8080'";
                                    var isDisabled = "disabled";
                                }
                                else {
                                    color = "";
                                    isDisabled = "";
                                }
                                $("#allchallantable tbody:last-child").append(
                                    "<tr " + color + ">" +
                                    "<td>" + challanno + "</td>" +
                                    "<td>" + challandate + "</td>" +
                                    "<td>" + customername + "</td>" +
                                    "<td>" +
                                    "<button class='btn btn-primary editbtn' " + isDisabled + " challanid='" + challanid + "'>Edit</button>" +
                                    " <button class='btn btn-success openbtn' challanid='" + challanid + "'>Open</button>" +
                                    " <button class='btn btn-warning pdfbtn' challanid='" + challanid + "'>Pdf</button>" +
                                    " <button class='btn btn-danger deletebtn' " + isDisabled + " challanid='" + challanid + "' challanno='" + challanno + "'>Delete</button>" +
                                    "</td>" +
                                    "</tr>"
                                );
                            }
                            else if (Data[0].FLAG == "NORECORDFOUND") {
                                swal("Challan Not Found For Given Challan No.", '', 'warning');
                            }
                            else if (Data[0].FLAG == "ERRMULRECORD") {
                                console.log("Error In Query Or Multiple Record found");
                                swal('Something Went Wrong', '', 'error');
                            }
                            else if (Data[0].FLAG == "ERRINQUERY") {
                                console.log("Error In Query");
                                swal('Something Went Wrong', '', 'error');
                            }
                            else {
                                console.log("other Response Found");
                                swal('Something Went Wrong', '', 'error');
                            }
                        },
                        error: function (Data) {
                            console.log("Err In ./SearchAndManageChallanAjax/getChallanByChallanNo.php Ajax Call");
                            swal("Something Went Wrong", '', 'error');
                            return;
                        }
                    });
                }
                else {
                    swal("Please Enter Challan No", '', 'info');
                    return;
                }
            }

            function serchChallanByCustomerId(customerid, fromdate, todate) {
                if (customerid != "-1" && fromdate != "" && todate != "") {
                    $.ajax({
                        type: "POST",
                        url: "./SearchAndManageChallanAjax/searchChallanByCustomerId.php",
                        data: { customerid: customerid, fromdate: fromdate, todate: todate },
                        dataType: 'json',
                        success: function (Data) {
                            if (Data[0].FLAG == "OKK") {
                                var n = Data.length;
                                for (var i = 1; i < n; i++) {
                                    var challanid = Data[i].challanid;
                                    var challanno = Data[i].challanno;
                                    var challandate = Data[i].challandate;
                                    var customername = Data[i].customername;
                                    var recstatus = Data[i].recstatus;
                                    if (recstatus == '0') {
                                        var color = "style='background-color:#ff8080'";
                                        var isDisabled = "disabled";
                                    }
                                    else {
                                        color = "";
                                        isDisabled = "";
                                    }
                                    $("#allchallantable tbody:last-child").append(
                                        "<tr " + color + ">" +
                                        "<td>" + challanno + "</td>" +
                                        "<td>" + challandate + "</td>" +
                                        "<td>" + customername + "</td>" +
                                        "<td>" +
                                        "<button class='btn btn-primary editbtn' " + isDisabled + " challanid='" + challanid + "'>Edit</button>" +
                                        " <button class='btn btn-success openbtn' challanid='" + challanid + "'>Open</button>" +
                                        " <button class='btn btn-warning pdfbtn' challanid='" + challanid + "'>Pdf</button>" +
                                        " <button class='btn btn-danger deletebtn' " + isDisabled + " challanid='" + challanid + "' challanno='" + challanno + "'>Delete</button>" +
                                        "</td>" +
                                        "</tr>"
                                    );
                                }
                            }
                            else if (Data[0].FLAG == "NORECORDFOUND") {
                                swal("Challan Not Found For Selected Customer Or Given Range Of Date", '', 'warning');
                            }
                            else if (Data[0].FLAG == "ERRINQUERY") {
                                console.log("Error In Query");
                                swal('Something Went Wrong', '', 'error');
                            }
                            else {
                                console.log("other Response Found");
                                swal('Something Went Wrong', '', 'error');
                            }
                        },
                        error: function (Data) {
                            console.log("Err In ./SearchAndManageChallanAjax/searchChallanByCustomerId.php Ajax Call");
                            swal("Something Went Wrong", '', 'error');
                            return;
                        }
                    });
                }
                else {
                    swal("Customer Or From Date Or To Date Empty", "", 'info');
                    return;
                }
            }

            function searchChallanByDate(fromdate, todate) {
                if (fromdate != "" && todate != "") {
                    $.ajax({
                        type: "POST",
                        url: "./SearchAndManageChallanAjax/searchChallanByDate.php",
                        data: {fromdate: fromdate, todate: todate },
                        dataType: 'json',
                        success: function (Data) {
                            if (Data[0].FLAG == "OKK") {
                                var n = Data.length;
                                for (var i = 1; i < n; i++) {
                                    var challanid = Data[i].challanid;
                                    var challanno = Data[i].challanno;
                                    var challandate = Data[i].challandate;
                                    var customername = Data[i].customername;
                                    var recstatus = Data[i].recstatus;
                                    if (recstatus == '0') {
                                        var color = "style='background-color:#ff8080'";
                                        var isDisabled = "disabled";
                                    }
                                    else {
                                        color = "";
                                        isDisabled = "";
                                    }
                                    $("#allchallantable tbody:last-child").append(
                                        "<tr " + color + ">" +
                                        "<td>" + challanno + "</td>" +
                                        "<td>" + challandate + "</td>" +
                                        "<td>" + customername + "</td>" +
                                        "<td>" +
                                        "<button class='btn btn-primary editbtn' " + isDisabled + " challanid='" + challanid + "'>Edit</button>" +
                                        " <button class='btn btn-success openbtn' challanid='" + challanid + "'>Open</button>" +
                                        " <button class='btn btn-warning pdfbtn' challanid='" + challanid + "'>Pdf</button>" +
                                        " <button class='btn btn-danger deletebtn' " + isDisabled + " challanid='" + challanid + "' challanno='" + challanno + "'>Delete</button>" +
                                        "</td>" +
                                        "</tr>"
                                    );
                                }
                            }
                            else if (Data[0].FLAG == "NORECORDFOUND") {
                                swal("Challan Not Found For Selected Customer Or Given Range Of Date", '', 'warning');
                            }
                            else if (Data[0].FLAG == "ERRINQUERY") {
                                console.log("Error In Query");
                                swal('Something Went Wrong', '', 'error');
                            }
                            else {
                                console.log("other Response Found");
                                swal('Something Went Wrong', '', 'error');
                            }
                        },
                        error: function (Data) {
                            console.log("Err In ./SearchAndManageChallanAjax/searchChallanByCustomerId.php Ajax Call");
                            swal("Something Went Wrong", '', 'error');
                            return;
                        }
                    });
                }
                else {
                    swal("Customer Or From Date Or To Date Empty", "", 'info');
                    return;
                }
            }
        });

        function checkRadio() {
            if ($("#challanNoRadio").prop('checked') == true) {
                $("#challan-no").prop('disabled', false);
                $(".get-date").prop('disabled', true);
                $("#customer-id").val("-1");
                $("#customer-id").prop('disabled', true).chosen();
                $("#customer-id").prop('disabled', true).trigger('chosen:updated');
                $("#getFromDate").val("");
                $("#getToDate").val("<?php echo $today; ?>");
            }
            else if ($("#customerNameRadio").prop('checked') == true) {
                $("#challan-no").prop('disabled', true);
                $(".get-date").prop('disabled', false);
                $("#customer-id").prop('disabled', false).chosen();
                $("#customer-id").prop('disabled', false).trigger('chosen:updated');
                $("#challan-no").val("");
            }
            else {
                $(".get-date").prop('disabled', false);
                $("#customer-id").val("-1");
                $("#customer-id").prop('disabled', true).chosen();
                $("#customer-id").prop('disabled', true).trigger('chosen:updated');
                $("#challan-no").val("");
                $("#challan-no").prop('disabled', true);
                $("#getFromDate").val("");
                $("#getToDate").val("<?php echo $today; ?>");
            }
            $("#allchallantable tbody").empty();
        }

    </script>
</body>