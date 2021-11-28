<!DOCTYPE html>
<html lang="en">
<?php include('./config.php');?>


<head>
    <title>Customer Return</title>
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
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script> -->
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>   
    <link rel="stylesheet" href="chosen/chosen.css">
    <script src="chosen/chosen.jquery.js" type="text/javascript"></script>
    
    <!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/table-to-json@1.0.0/lib/jquery.tabletojson.min.js"
        integrity="sha256-H8xrCe0tZFi/C2CgxkmiGksqVaxhW0PFcUKZJZo1yNU=" crossorigin="anonymous"></script>
    
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
                            <h3 class="card-title" style="color: white">Customer Return</h3>
                        </center>
                    </div>
                    <div class="card-body">
                        <form id="searchByForm" autocomplete="off">
                            <div class="row">
                                <div class="row col-md-6">
                                    <div class="col-md-3">
                                        <label class="form-label" style="margin-right: 10px;">Search By: </label>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-check-label" for="challanNoRadio">
                                            <input class="form-check-input searchby" type="radio" name="searchBy"
                                                id="challanNoRadio" value="Challan No" onchange="checkRadio()">
                                            Challan No</label>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-check-label" for="customerNameRadio">
                                            <input class="form-check-input searchby" type="radio" name="searchBy"
                                                id="customerNameRadio" value="Customer Name" onchange="checkRadio()">
                                            Customer Name</label>
                                    </div>

                                </div>
                                <div class="col-md-4">
                                        <label class="form-check-label" for="dateRadio">
                                            <input class="form-check-input searchby" type="radio" name="searchBy"
                                                id="dateRadio" value="" onchange="checkRadio()">
                                            Date: </label>
                                    </div>
                                
                            </div>

                            <div class="row">
                                <div class="col-md-3 form-group">
                                    <Label class="form-label">Challan No :</Label>
                                    <input class="txt-box form-control" type="number" placeholder="Challan No..."
                                        onKeyPress="if(this.value.length==10) return false;" id="challan-no"
                                        name="challan-no" disabled>
                                </div>
                                <div class="col-md-3 form-group">
                                    <Label>Customer Name :</Label>
                                    <select name="" class="customer-name form-select" id="customer-id" disabled>
                                    </select>
                                </div>
                                <div class="row col-md-6">
                                    <div class="col-md-6">
                                        <label class="form-label">From Date:</label>
                                        <input type="date" class='form-control get-date' id="getFromDate" disabled>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">To Date:</label>
                                        <input type="date" class='form-control get-date' id="getToDate" value="<?php echo $today; ?>" disabled>
                                    </div>
                                    
                                </div>
                                
                            </div>

                            <div class="row">
                                <div class="col-md-6 mt-3">
                                    
                                        <input style="margin-right: 5px;" type="button" value="Search" id="searchbtn"
                                            class="btn btn-primary">
                                        <input style="margin-left: 5px;" type="button" value="Reset" id="resetbtn"
                                            class="btn btn-primary">
                                        <input type="button" value="Close" style="margin-left: 8px;" name="close" id="close" class="btn btn-primary" onclick="location.href = '../admin.php';">
                                    
                                </div>
                            </div>
                        </form>
                    </div>

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
                    <form action="./CustomerReturnAjax/viewCustomerReturnByChallanId.php" method="POST" target="_blank"
                        id='openform' hidden>
                        <input type="text" name='challanid' id='openFormChallanId'>
                    </form>
                    <form action="./CustomerReturnAjax/pdf.php" method="POST" target="_blank" id='pdfform'
                        hidden>
                        <input type="text" name='challanid' id='pdfFormChallanId'>
                    </form>
                    <form action="./CustomerReturnAjax/editCustomerReturn.php" method="POST" id='editform' target="_blank"
                        hidden>
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

                else if ($("#challanNoRadio").prop('checked') == true && $("#getFromDate").val() == "") {
                    var challanno = $("#challan-no").val();
                    if (challanno == "") {
                        swal("Please Enter Challan No", '', 'info');
                        return;
                    }
                    if (challanno.length != 10) {
                        swal("Please Enter Valid Challan No", '', 'info');
                        return;
                    }

                    searchChallanByOnlyChallanNo(challanno);
                }

                else if ($("#challanNoRadio").prop('checked') == true && $("#getFromDate").val() != "") {
                    var challanno = $("#challan-no").val();
                    if (challanno == "") {
                        swal("Please Enter Challan No", '', 'info');
                        return;
                    }
                    if (challanno.length != 10) {
                        swal("Please Enter Valid Challan No", '', 'info');
                        return;
                    }

                    var fromdate = $("#getFromDate").val();
                    var todate = $("#getToDate").val();

                    searchChallanByChallanNo(challanno, fromdate, todate);
                }

                else if($("#customerNameRadio").prop('checked') == true && $("#getFromDate").val() == ""){

                    var customerid = $("#customer-id").val();
                    if (customerid == '-1') 
                    {
                        swal("Please Select Customer", '', 'info');
                        return;
                    }

                    serchChallanByOnlyCustomerId(customerid);
                }

                else if($("#customerNameRadio").prop('checked') == true && $("#getFromDate").val() != ""){

                    var customerid = $("#customer-id").val();
                    if (customerid == '-1') 
                    {
                        swal("Please Select Customer", '', 'info');
                        return;
                    }
                    var fromdate = $("#getFromDate").val();
                    var todate = $("#getToDate").val();

                    serchChallanByCustomerId(customerid, fromdate, todate);
                }

                else{
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

                    serchChallanByDate(fromdate, todate);
                }
            });

            $("#challan-no").keyup(function (event) {
                if (event.which === 13) {
                    $("#searchbtn").click();
                }
            });

            $("#allchallantable tbody").on('click', '.editbtn', function(){
                var challanid = $(this).attr('challanid');
                $("#editFormChallanId").val(challanid);
                $("#editform").submit();

            });

            $("#allchallantable tbody").on('click', '.pdfbtn', function () {
                var challanid = $(this).attr("challanid");
                console.log(challanid);
                $("#pdfFormChallanId").val(challanid);
                $("#pdfform").submit();
            });

            function loadCustomerName() {
                $.ajax({
                    type: "POST",
                    url: "./CustomerReturnAjax/getCustomerNames.php",
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
                        console.log("Error  ./CustomerReturnAjax/getCustomerNames.php   Ajax Call");
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

            function searchChallanByOnlyChallanNo(challanno) {
                if (challanno != "") {
                    $.ajax({
                        type: "POST",
                        url: "./CustomerReturnAjax/getCustomerReturnByOnlyChallanNo.php",
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
                                    "<button class='btn btn-primary editbtn' " + isDisabled + " challanid='" + challanid + "'>Open</button>" +
                                    //" <button class='btn btn-success openbtn' challanid='" + challanid + "'>Open</button>" +
                                    " <button class='btn btn-warning pdfbtn' challanid='" + challanid + "'>Pdf</button>" +
                                    //" <button class='btn btn-danger deletebtn' " + isDisabled + " challanid='" + challanid + "' challanno='" + challanno + "'>Delete</button>" +
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
                            console.log("Err In ./CustomerReturnAjax/getCustomerReturnByChallanNo.php Ajax Call");
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

            function searchChallanByChallanNo(challanno , fromdate , todate) {
                if (challanno != ""&& fromdate != "" && todate != "") {
                    $.ajax({
                        type: "POST",
                        url: "./CustomerReturnAjax/getCustomerReturnByChallanNo.php",
                        data: { challanno: challanno,fromdate: fromdate , todate: todate },
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
                                    "<button class='btn btn-primary editbtn' " + isDisabled + " challanid='" + challanid + "'>Open</button>" +
                                    //" <button class='btn btn-success openbtn' challanid='" + challanid + "'>Open</button>" +
                                    " <button class='btn btn-warning pdfbtn' challanid='" + challanid + "'>Pdf</button>" +
                                    //" <button class='btn btn-danger deletebtn' " + isDisabled + " challanid='" + challanid + "' challanno='" + challanno + "'>Delete</button>" +
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
                            console.log("Err In ./CustomerReturnAjax/getCustomerReturnByChallanNo.php Ajax Call");
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

            function serchChallanByOnlyCustomerId(customerid) {
                if (customerid != "-1") {
                    $.ajax({
                        type: "POST",
                        url: "./CustomerReturnAjax/searchCustomerReturnByOnlyCustomerId.php",
                        data: { customerid: customerid },
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
                                        "<button class='btn btn-primary editbtn' "+isDisabled+" challanid='" + challanid + "'>Open</button>" +
                                        //" <button class='btn btn-success openbtn' challanid='" + challanid + "'>Open</button>" +
                                        " <button class='btn btn-warning pdfbtn' challanid='" + challanid + "'>Pdf</button>" +
                                        //" <button class='btn btn-danger deletebtn' " + isDisabled + " challanid='" + challanid + "' challanno='" + challanno + "'>Delete</button>" +
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
                            console.log("Err In ./CustomerReturnAjax/searchCustomerReturnByOnlyCustomerId.php Ajax Call");
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

            function serchChallanByCustomerId(customerid, fromdate, todate) {
                if (customerid != "-1" && fromdate != "" && todate != "") {
                    $.ajax({
                        type: "POST",
                        url: "./CustomerReturnAjax/searchCustomerReturnByCustomerId.php",
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
                                        "<button class='btn btn-primary editbtn' "+isDisabled+" challanid='" + challanid + "'>Open</button>" +
                                        //" <button class='btn btn-success openbtn' challanid='" + challanid + "'>Open</button>" +
                                        " <button class='btn btn-warning pdfbtn' challanid='" + challanid + "'>Pdf</button>" +
                                        //" <button class='btn btn-danger deletebtn' " + isDisabled + " challanid='" + challanid + "' challanno='" + challanno + "'>Delete</button>" +
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
                            console.log("Err In ./CustomerReturnAjax/searchCustomerReturnByCustomerId.php Ajax Call");
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

            function serchChallanByDate(fromdate, todate) {
                if (fromdate != "" && todate !="") {
                    $.ajax({
                        type: "POST",
                        url: "./CustomerReturnAjax/searchCustomerReturnByDate.php",
                        data: { fromdate: fromdate, todate:todate },
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
                                        "<button class='btn btn-primary editbtn' "+isDisabled+" challanid='" + challanid + "'>Open</button>" +
                                        //" <button class='btn btn-success openbtn' challanid='" + challanid + "'>Open</button>" +
                                        " <button class='btn btn-warning pdfbtn' challanid='" + challanid + "'>Pdf</button>" +
                                        //" <button class='btn btn-danger deletebtn' " + isDisabled + " challanid='" + challanid + "' challanno='" + challanno + "'>Delete</button>" +
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
                            console.log("Err In ./CustomerReturnAjax/searchCustomerReturnByOnlyCustomerId.php Ajax Call");
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
                $(".get-date").prop('disabled', false);
                $("#customer-id").val("-1");
                $("#customer-id").prop('disabled', true).chosen();
                $("#customer-id").prop('disabled', true).trigger('chosen:updated');
                $("#getFromDate").val("");
                $("#getToDate").val("<?php echo $today; ?>");
            }
            if($("#customerNameRadio").prop('checked') == true )
            {
                $("#challan-no").prop('disabled', true);
                $(".get-date").prop('disabled', false);
                $("#customer-id").prop('disabled', false).chosen();
                $("#customer-id").prop('disabled', false).trigger('chosen:updated');
                $("#challan-no").val("");
            }
            if($("#dateRadio").prop('checked') == true) {
                $("#challan-no").prop('disabled', true);
                $(".get-date").prop('disabled', false);
                $("#customer-id").prop('disabled', true).chosen();
                $("#customer-id").prop('disabled', true).trigger('chosen:updated');
                $("#challan-no").val("");
            }
            $("#allchallantable tbody").empty();
        }

    </script>
</body>
