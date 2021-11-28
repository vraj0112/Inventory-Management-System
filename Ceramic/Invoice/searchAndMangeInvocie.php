<!DOCTYPE html>
<html lang="en">
<?php include('./config.php');?>

<head>
    <title>Search & Manage Invoice</title>
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
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="chosen/chosen.css">
    <script src="chosen/chosen.jquery.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/table-to-json@1.0.0/lib/jquery.tabletojson.min.js"
        integrity="sha256-H8xrCe0tZFi/C2CgxkmiGksqVaxhW0PFcUKZJZo1yNU=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script> -->
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
    // $invoiceno = $year.$month.$num;
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
                    </div>
                    <div class="card-body">
                        <form id="searchByForm" autocomplete="off">
                            <div class="row">
                                <div class="row col-md-12">
                                    <div class="col-md-2">
                                        <label class="form-label" style="margin-right: 10px;">Search By: </label>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-check-label" for="InvoiceNoRadio">
                                            <input class="form-check-input searchby" type="radio" name="searchBy"
                                                id="InvoiceNoRadio" value="Invoice No" onchange="checkRadio()">
                                            Invoice No</label>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-check-label" for="customerNameRadio">
                                            <input class="form-check-input searchby" type="radio" name="searchBy"
                                                id="customerNameRadio" value="Customer Name" onchange="checkRadio()">
                                            Customer Name</label>
                                    </div>
                                    <div class="col-md-2">
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
                            <div class="row">
                                <div class="col-md-3 form-group">
                                    <Label class="form-label">Invoice No :</Label>
                                    <input class="txt-box form-control" type="number" placeholder="Invoice No..."
                                        onKeyPress="if(this.value.length==10) return false;" id="Invoice-no"
                                        name="Invocie-no" disabled>
                                </div>
                                <div class="col-md-3 form-group">
                                    <Label>Customer Name :</Label>
                                    <select name="" class="customer-name form-select" id="customer-id" disabled>
                                    </select>
                                    <!-- <input class="txt-box form-control" type="text" placeholder="Customer Name" id="customer-name-txt" style=> -->
                                </div>
                                <div class="col-md-3">
                                        <label for="" class="form-label">From Date:</label>
                                        <input type="date" class='form-control get-date' id="getFromDate" disabled>
                                    </div>
                                    <!-- <div class="col-md-4">
                                    </div> -->
                                    <div class="col-md-3">
                                        <label for="" class="form-label">To Date:</label>
                                        <input type="date" class='form-control get-date' id="getToDate"
                                            value="<?php echo $today; ?>" disabled>
                                    </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mt-3">
                                    
                                        <input style="margin-right: 5px;" type="button" value="Search" id="searchbtn"
                                            class="btn btn-primary">
                                        <input style="margin-left: 5px;" type="button" value="Reset" id="resetbtn"
                                            class="btn btn-primary">
                                        <input style="margin-left: 8px;" type="button" value="Close"  name="close" id="close" class="btn btn-primary" onclick="location.href = '../admin.php';">
                                    
                                </div>
                            </div>
                            <!-- </div> -->
                        </form>
                    </div>
                    <table id='allinvoicetable'>
                        <thead>
                            <th>Invoice No</th>
                            <th>Invoice Date</th>
                            <th>Customer Name</th>
                            <th>Action</th>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    <form action="./SearchAndManageInvoiceAjax/viewInvoiceByInvoiceId.php" method="POST" target="_blank"
                        id='openform' hidden>
                        <input type="text" name='InvoiceId' id='openFormInvoice'>
                    </form>
                    <form action="./SearchAndManageInvoiceAjax/pdf.php" method="POST" target="_blank" id='pdfform'
                        hidden>
                        <input type="text" name='InvoiceId' id='pdfFormInvoice'>
                    </form>
                    <form action="./SearchAndManageInvoiceAjax/editInvoice.php" method="POST" id='editform' target="_blank"
                        hidden>
                        <input type="text" name='InvoiceId' id='editFormInvoice'>
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
                $("#allinvoicetable tbody").empty();

                if ($("#InvoiceNoRadio").prop('checked') == false && $("#customerNameRadio").prop('checked') == false && $("#dateRadio").prop('checked') == false) {
                    swal("Please Select Search By Option", '', 'info');
                    return;
                }

                if ($("#InvoiceNoRadio").prop('checked') == true) {
                    var invoiceno = $("#Invoice-no").val();
                    if (invoiceno == "") {
                        swal("Please Enter Invoice No", '', 'info');
                        return;
                    }
                    if (invoiceno.length != 10) {
                        swal("Please Enter Valid Invoice No", '', 'info');
                        return;
                    }
                    searchInvoiceByinvoiceno(invoiceno);
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
                    serchInvoiceByCustomerId(customerid, fromdate, todate);
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
                    serchInvoiceByDate(fromdate, todate);
                    
                }


            });

            $("#Invoice-no").keyup(function (event) {
                if (event.which === 13) {
                    $("#searchbtn").click();
                }
            });

            $("#allinvoicetable tbody").on('click', '.editbtn', function(){
                var InvoiceId = $(this).attr('InvoiceId');
                $("#editFormInvoice").val(InvoiceId);
                $("#editform").submit();

            });

            $("#allinvoicetable tbody").on('click', '.openbtn', function () {
                var InvoiceId = $(this).attr('InvoiceId');
                $("#openFormInvoice").val(InvoiceId);
                $("#openform").submit();
            });

            $("#allinvoicetable tbody").on('click', '.pdfbtn', function () {
                var InvoiceId = $(this).attr("InvoiceId");
                console.log(InvoiceId);
                $("#pdfFormInvoice").val(InvoiceId);
                $("#pdfform").submit();
            });
            
            $("#allinvoicetable tbody").on('click', '.deletebtn', function () {
                var InvoiceId = $(this).attr("InvoiceId");
                var invoiceno = $(this).attr("invoiceno");

                swal({
                    title: "Are You Sure You Want To Delete Invoice : " + invoiceno,
                    text: "Once deleted, you will not be able to recover this Invoice back!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true
                }).then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                                type: "POST",
                                url: "./SearchAndManageInvoiceAjax/deleteInvoice.php",
                                data: { InvoiceId: InvoiceId },
                                success: function (Data) {
                                    console.log(Data);
                                    if (Data == "1") {
                                        $("#searchbtn").click();
                                        swal("Invoice Deleted Successfully", '', 'success');
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
                                    console.log("Error In  ./SearchAndManageInvocieAjax/deleteChallan.php   Ajax Call");
                                    swal("Something Went Wrong", '', 'error');
                                    return;
                                }
                            });
                        } else {
                            swal("Invoice Not Deleted", '', 'info');
                        }
                   });
            });
            
            function loadCustomerName() {
                $.ajax({
                    type: "POST",
                    url: "./SearchAndManageInvoiceAjax/getCustomerNames.php",
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
                        console.log("Error  ./SearchAndManageInvoiceAjax/getCustomerNames.php   Ajax Call");
                    }
                });
                $("#customer-name-select-menu")
            }
            
            function resetFrame() {
                $(".searchby").prop('checked', false);
                $("#getFromDate").val("");
                $("#getToDate").val("<?php echo $today; ?>");
                $(".get-date").prop('disabled', true);
                $("#Invoice-no").val("");
                $("#Invoice-no").prop('disabled', true);
                $("#customer-id").val("-1");
                $("#customer-id").prop('disabled', true).chosen();
                $("#customer-id").prop('disabled', true).trigger('chosen:updated');
                $("#allinvoicetable tbody").empty();
            }
            function searchInvoiceByinvoiceno(invoiceno) {
                if (invoiceno != "") {
                    $.ajax({
                        type: "POST",
                        url: "./SearchAndManageInvoiceAjax/getInvoiceByInvoiceNo.php",
                        data: { invoiceno: invoiceno },
                        dataType: 'json',
                        success: function (Data) {
                            if (Data[0].FLAG == "OKK") {
                                var invoicedate = Data[1].invoicedate;
                                var customername = Data[1].customername;
                                var recstatus = Data[1].recstatus;
                                var invoiceid = Data[1].invoiceid;
                                if (recstatus == '0') {
                                    var color = "style='background-color:#ff8080'";
                                    var isDisabled = "disabled";
                                }
                                else {
                                    color = "";
                                    isDisabled = "";
                                }
                                $("#allinvoicetable tbody:last-child").append(
                                    "<tr " + color + ">" +
                                    "<td>" + invoiceno + "</td>" +
                                    "<td>" + invoicedate + "</td>" +
                                    "<td>" + customername + "</td>" +
                                    "<td>" +
                                    "<button class='btn btn-primary editbtn' " + isDisabled + " invoiceid='" + invoiceid + "'>Edit</button>" +
                                    " <button class='btn btn-success openbtn' invoiceid='" + invoiceid + "'>Open</button>" +
                                    " <button class='btn btn-warning pdfbtn' invoiceid='" + invoiceid + "'>Pdf</button>" +
                                    " <button class='btn btn-danger deletebtn' " + isDisabled + " invoiceid='" + invoiceid + "' invoiceno='" + invoiceno + "'>Delete</button>" +
                                    "</td>" +
                                    "</tr>"
                                );
                            }
                            else if (Data[0].FLAG == "NORECORDFOUND") {
                                swal("Invoice Not Found For Given Invoice No.", '', 'warning');
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
                            console.log("Err In ./SearchAndManageInvoiceAjax/getInvoiceByInvoiceNo.php Ajax Call");
                            swal("Something Went Wrong", '', 'error');
                            console.log(Data.status);
                        console.log(Data.statusText);
                        console.log(Data.responseText);
                            return;
                        }
                    });
                }
                else {
                    swal("Please Enter Invoice No", '', 'info');
                    return;
                }
            }
            function serchInvoiceByCustomerId(customerid, fromdate, todate) {
                if (customerid != "-1" && fromdate != "" && todate != "") {
                    $.ajax({
                        type: "POST",
                        url: "./SearchAndManageInvoiceAjax/searchInvoiceByCustomerId.php",
                        data: { customerid: customerid, fromdate: fromdate, todate: todate },
                        dataType: 'json',
                        success: function (Data) {
                            if (Data[0].FLAG == "OKK") {
                                var n = Data.length;
                                for (var i = 1; i < n; i++) {
                                    var invoiceid = Data[i].Invoiceid;
                                    var invoiceno = Data[i].Invoiceno;
                                    var InvoiceDate = Data[i].InvoiceDate;
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
                                    $("#allinvoicetable tbody:last-child").append(
                                        "<tr " + color + ">" +
                                        "<td>" + invoiceno + "</td>" +
                                        "<td>" + InvoiceDate + "</td>" +
                                        "<td>" + customername + "</td>" +
                                        "<td>" +
                                        "<button class='btn btn-primary editbtn' "+isDisabled+" invoiceid='" + invoiceid + "'>Edit</button>" +
                                        " <button class='btn btn-success openbtn' invoiceid='" + invoiceid + "'>Open</button>" +
                                        " <button class='btn btn-warning pdfbtn' invoiceid='" + invoiceid + "'>Pdf</button>" +
                                        " <button class='btn btn-danger deletebtn' " + isDisabled + " invoiceid='" + invoiceid + "' invoiceno='" + invoiceno + "'>Delete</button>" +
                                        "</td>" +
                                        "</tr>"
                                    );
                                }
                            }
                            else if (Data[0].FLAG == "NORECORDFOUND") {
                                swal("Invoice Not Found For Selected Customer Or Given Range Of Date", '', 'warning');
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
                            console.log("Err In ./SearchAndManageInvoiceAjax/searchInvoiceByCustomerId.php Ajax Call");
                            swal("Something Went Wrong", '', 'error');
                            console.log(Data.status);
                        console.log(Data.statusText);
                        console.log(Data.responseText);
                            return;
                        }
                    });
                }
                else {
                    swal("Customer Or From Date Or To Date Empty", "", 'info');
                    return;
                }

            }
            function serchInvoiceByDate(fromdate, todate) {
                if (fromdate != "" && todate != "") {
                    $.ajax({
                        type: "POST",
                        url: "./SearchAndManageInvoiceAjax/searchInvoiceByDate.php",
                        data: { fromdate: fromdate, todate: todate },
                        dataType: 'json',
                        success: function (Data) {
                            if (Data[0].FLAG == "OKK") {
                                var n = Data.length;
                                for (var i = 1; i < n; i++) {
                                    var invoiceid = Data[i].Invoiceid;
                                    var invoiceno = Data[i].Invoiceno;
                                    var InvoiceDate = Data[i].InvoiceDate;
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
                                    $("#allinvoicetable tbody:last-child").append(
                                        "<tr " + color + ">" +
                                        "<td>" + invoiceno + "</td>" +
                                        "<td>" + InvoiceDate + "</td>" +
                                        "<td>" + customername + "</td>" +
                                        "<td>" +
                                        "<button class='btn btn-primary editbtn' "+isDisabled+" invoiceid='" + invoiceid + "'>Edit</button>" +
                                        " <button class='btn btn-success openbtn' invoiceid='" + invoiceid + "'>Open</button>" +
                                        " <button class='btn btn-warning pdfbtn' invoiceid='" + invoiceid + "'>Pdf</button>" +
                                        " <button class='btn btn-danger deletebtn' " + isDisabled + " invoiceid='" + invoiceid + "' invoiceno='" + invoiceno + "'>Delete</button>" +
                                        "</td>" +
                                        "</tr>"
                                    );
                                }
                            }
                            else if (Data[0].FLAG == "NORECORDFOUND") {
                                swal("Invoice Not Found For Selected Customer Or Given Range Of Date", '', 'warning');
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
                            console.log("Err In ./SearchAndManageInvoiceAjax/searchInvoiceByCustomerId.php Ajax Call");
                            swal("Something Went Wrong", '', 'error');
                            console.log(Data.status);
                        console.log(Data.statusText);
                        console.log(Data.responseText);
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
            if ($("#InvoiceNoRadio").prop('checked') == true) {
                $("#Invoice-no").prop('disabled', false);
                $(".get-date").prop('disabled', true);
                $("#customer-id").val("-1");
                $("#customer-id").prop('disabled', true).chosen();
                $("#customer-id").prop('disabled', true).trigger('chosen:updated');
                $("#getFromDate").val("");
                $("#getToDate").val("<?php echo $today; ?>");
            }
            else if ($("#customerNameRadio").prop('checked') == true) {
                $("#Invoice-no").prop('disabled', true);
                $(".get-date").prop('disabled', false);
                $("#customer-id").prop('disabled', false).chosen();
                $("#customer-id").prop('disabled', false).trigger('chosen:updated');
                $("#Invoice-no").val("");
            }
            else {
                $(".get-date").prop('disabled', false);
                $("#customer-id").val("-1");
                $("#customer-id").prop('disabled', true).chosen();
                $("#customer-id").prop('disabled', true).trigger('chosen:updated');
                $("#Invoice-no").val("");
                $("#Invoice-no").prop('disabled', true);
                $("#getFromDate").val("");
                $("#getToDate").val("<?php echo $today; ?>");
            }
            $("#allchallantable tbody").empty();
        }

    </script>
</body>




