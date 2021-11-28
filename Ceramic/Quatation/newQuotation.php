<!DOCTYPE html>
<html lang="en">

<?php
    $month = date('m');
    $day = date('d');
    $year = date('Y');

    $today = $year . '-' . $month . '-' . $day;
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Quotation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <link href="https://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <script src="https://cdn.jsdelivr.net/npm/table-to-json@1.0.0/lib/jquery.tabletojson.min.js"
        integrity="sha256-H8xrCe0tZFi/C2CgxkmiGksqVaxhW0PFcUKZJZo1yNU=" crossorigin="anonymous"></script>
    <style type="text/css">
        .grid1 {
            display: grid;
            width: '100%';
            grid-template-columns: '50px 1fr';
        }

        th input {
            width: 100px;
        }

        td input {
            width: 100px;
            border: 0px;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        th,
        td {
            text-align: center;
        }

        .desc {
            padding-left: 15px;
            text-align: left !important;
        }

        tr:nth-child(even) {
            background-color: aqua;
        }

        thead {
            background-color: lightgrey;
        }
    </style>
</head>

<body>
    <div class="container-fluid col-lg-12">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header" style="background-color: #2B60DE">
                        <h3 class="card-title" style="color: white" align="center">Quatation</h3>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label">Name</label>
                                <input type="text" name="qname" class="form-control" id="getName" maxlength="25">
                            </div>

                            <div class="form-group col-md-3">
                                <label class="form-label">Date : </label>
                                <input type="date" name="dop" id="getDate" class="form-control"
                                    value="<?php echo $today; ?>">
                            </div>
                        </div>

                        <div class="row mt-1">
                            <div class="form-group col-md-6">
                                <label class="form-label">Description: </label>
                                <input type="text" name="qdis" class="form-control" id="getDescription" maxlength='40'
                                    required>
                            </div>

                            <div class="form-group col-md-2">
                                <label class="form-label">Quantity: </label>
                                <input type="number" name="qqan" class="form-control" id="getQuantity"
                                    pattern="[0-9]{10}" required>
                            </div>

                            <div class="form-group col-md-2">
                                <label class="form-label">Rate: </label>
                                <input type="number" name="qrate" class="form-control" id="getRate" pattern="[0-9]{10}"
                                    required>
                            </div>

                            <div class="form-group col-md-2">
                                <label class="form-label">Taxable GST: </label>
                                <select class="form-select" id="getGst" name="qgst">
                                    <option value="0" selected="selected">N/A</option>
                                    <option value="5">5</option>
                                    <option value="12">12</option>
                                    <option value="18">18</option>
                                    <option value="28">28</option>
                                </select>
                            </div>
                        </div>

                        <br>

                        <div class="col-12">
                            <button id='addbtn' class="btn btn-primary">Add</button>
                            <button id='resetbtn' class="btn btn-primary">Reset</button>
                            <button id='updatebtn' class="btn btn-primary" disabled>Update</button>
                        </div>
                    </div>
                </div>

                <div class="card card-primary" style="overflow-x:auto; overflow-y: auto; height: 310px;">
                    <table id='desc_table'>
                        <thead style="height: 80px;">
                            <tr>
                                <th class='desc' width="550px">Description</th>
                                <th>Qty</th>
                                <th>Rate</th>
                                <th>GST</th>
                                <th>Total</th>
                                <th>GST Amount</th>
                                <th>Net Amount</th>
                                <th width="40px" colspan="2">
                                    <center>Action</center>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- <tr>
                                <td class="desc">23</td>
                                <td>23</td>
                                <td>23.50</td>
                                <td>12</td>
                                <td>540.5</td>
                                <td>64.86</td>
                                <td>605.36</td>
                                <td>
                                    <center><button class="btn btn-primary"> Edit </button> <button
                                            class="btn btn-danger"> Remove </button></center>
                                </td>
                            </tr>
                            <tr>
                                <td class="desc">23</td>
                                <td>23</td>
                                <td>23.50</td>
                                <td>12</td>
                                <td>540.5</td>
                                <td>64.86</td>
                                <td>605.36</td>
                                <td>
                                    <center><button class="btn btn-primary"> Edit </button> <button
                                            class="btn btn-danger"> Remove </button></center>
                                </td>
                            </tr> -->
                        </tbody>
                    </table>
                </div>


                <div class="row mt-3">
                    <div class="col-md-2">
                        <center><label class='mt-1' for="">Total Amount</label></center>
                    </div>
                    <div class="col-md-2">
                        <input type="number" name="" id="setTotalAmount" class="form-control" disabled>
                    </div>
                    <div class="col-md-2">
                        <center><label class='mt-1' for="">GST Amount</label></center>
                    </div>
                    <div class="col-md-2">
                        <input type="number" name="" id="setGstAmount" class="form-control" disabled>
                    </div>
                    <div class="col-md-2">
                        <center><label class='mt-1' for="">Net Amount</label></center>
                    </div>
                    <div class="col-md-2">
                        <input type="number" name="" id="setNetAmount" class="form-control" disabled>
                    </div>
                </div>

                <div class="row mt-3">
                    <center>
                        <button class="btn btn-primary" id='savebtn'> Save </button>
                        <button id='closebtn' class="btn btn-primary"
                            onclick="window.location='../admin.php'">Close</button>
                    </center>
                </div>

                <form action="./makepdf.php" target="_blank" method='POST' id='makepdfform'><input type="hidden"
                        name='quotationid' id='quotationid'></form>
            </div>
        </div>

    </div>

</body>
<script>
    $(function () {

        var globaltotalamount = 0;
        var globalgstamount = 0;
        var globalnetamount = 0;

        var temptotalamount;
        var tempgstamount;
        var tempnetamount;

        var rowref;

        $("#addbtn").on('click', function () {

            var description = $('#getDescription').val();
            var qty = $('#getQuantity').val();
            var rate = $('#getRate').val();
            var gst = $('#getGst').val();
            //var date        = $('#getDate').val();


            if (description != "" && qty != "" && rate != "" && gst != "") {

                var totalamount = qty * rate;
                var gstamount = ((qty * rate * gst) / 100);
                var netamount = gstamount + totalamount;
                $('#desc_table tbody:last-child').append(
                    '<tr>' +
                    '<td class="desc">' + description + '</td>' +
                    '<td>' + qty + '</td>' +
                    '<td>' + rate + '</td>' +
                    '<td>' + gst + '</td>' +
                    '<td>' + totalamount + '</td>' +
                    '<td>' + gstamount + '</td>' +
                    '<td>' + netamount + '</td>' +
                    '<td>' +
                    '<button class="btn btn-primary editbtn"> Edit </button> ' +
                    ' <button class="btn btn-danger removebtn"> Remove </button>' +
                    '</td>' +
                    '</tr>'
                );

                globaltotalamount += totalamount;
                globalgstamount += gstamount;
                globalnetamount += netamount;

                $('#setTotalAmount').val(globaltotalamount);
                $('#setGstAmount').val(globalgstamount);
                $('#setNetAmount').val(globalnetamount);

                ResetForm();

            }
            else {
                swal('Please Fill All The Field', '', 'info');
            }


        });

        $('#resetbtn').on('click', function () {
            ResetForm();
        });

        $('#desc_table').on('click', '.removebtn', function () {

            let tr = $(this).parent().siblings();

            let obj = Array();

            for (let i = 0; i < 8; i++) {
                obj.push(tr.html());
                tr = tr.next();
            }

            console.log(obj);

            globaltotalamount -= obj[4];
            globalgstamount -= obj[5];
            globalnetamount -= obj[6];

            $('#setTotalAmount').val(globaltotalamount);
            $('#setGstAmount').val(globalgstamount);
            $('#setNetAmount').val(globalnetamount);


            var p = $(this).parent().parent().remove();
        });

        $('#desc_table').on('click', '.editbtn', function () {
            let tr = $(this).parent().siblings();

            let obj = Array();

            for (let i = 0; i < 8; i++) {
                obj.push(tr.html());
                tr = tr.next();
            }

            console.log(obj);

            rowref = $(this);

            $('#getDescription').val(obj[0]);
            $('#getQuantity').val(obj[1]);
            $('#getRate').val(obj[2]);
            $('#getGst').val(obj[3]);


            temptotalamount = obj[4];
            tempgstamount = obj[5];
            tempnetamount = obj[6];

            $('#addbtn').prop('disabled', true);
            $('#updatebtn').prop('disabled', false);

        });

        $('#updatebtn').on('click', function () {
            var description = $('#getDescription').val();
            var qty = $('#getQuantity').val();
            var rate = $('#getRate').val();
            var gst = $('#getGst').val();
            //var date        = $('#getDate').val();


            if (description != "" && qty != "" && rate != "" && gst != "") {

                var totalamount = qty * rate;
                var gstamount = ((qty * rate * gst) / 100);
                var netamount = gstamount + totalamount;

                let tr = rowref.parent().siblings();

                tr.html(description);
                tr = tr.next();
                tr.html(qty);
                tr = tr.next();
                tr.html(rate);
                tr = tr.next();
                tr.html(gst);
                tr = tr.next();
                tr.html(totalamount);
                tr = tr.next();
                tr.html(gstamount);
                tr = tr.next();
                tr.html(netamount);
                tr = tr.next();
                tr.html('<button class="btn btn-primary editbtn"> Edit </button> <button class="btn btn-danger removebtn"> Remove </button>');

                globaltotalamount -= temptotalamount;
                globalgstamount -= tempgstamount;
                globalnetamount -= tempnetamount;

                globaltotalamount += totalamount;
                globalgstamount += gstamount;
                globalnetamount += netamount;

                $('#setTotalAmount').val(globaltotalamount);
                $('#setGstAmount').val(globalgstamount);
                $('#setNetAmount').val(globalnetamount);

                ResetForm();
            }
        });

        $('#savebtn').on('click', function () {

            var name = $('#getName').val();
            console.log(name);
            var date = $('#getDate').val();
            var tbl = $("#desc_table");

            console.log($("#desc_table tr").length);
            var tblJSON = tbl.tableToJSON();
            console.log(tblJSON);
            console.log(JSON.stringify(tblJSON));

            if (name != "" && date != "" && $("#desc_table tr").length != 1) {

                $.ajax({
                    type: 'POST',
                    url: './addNewQuotation.php',
                    data: { name: name, date: date, datatable: JSON.stringify(tblJSON), totalamount: globaltotalamount, gstamount: globalgstamount, netamount: globalnetamount },
                    dataType: 'json',
                    success: function (Data) {
                        console.log(Data);

                        if (Data[0].FLAG == "SUCCESS") {
                            console.log(Data[1].QID);
                            setTimeout(function () {
                                swal({
                                    title: "Quotation Generated Succesfully",
                                    text: "",
                                    type: "success",
                                    confirmButtonText: "OK"
                                },
                                    function (isConfirm) {
                                        if (isConfirm) {
                                            var qid = Data[1].QID;
                                            $('#quotationid').val(qid);
                                            $('#makepdfform').submit();
                                        }
                                    });
                            }, 1);
                        }
                        else if (Data[0].FLAG == "COMMITFAIL") {
                            console.log('Commit Fail');
                            swal('Something Went Wrong', '', 'error');
                        }
                        else if (Data[0].FLAG == "ERRINQUOTATIONDETAILS") {
                            console.log('ERR IN QUOTATION DETAILS');
                            swal('Something Went Wrong', '', 'error');
                        }
                        else if (Data[0].FLAG == "ERRINQUOTATIONMST") {
                            console.log('ERR IN QUOTATION MST');
                            swal('Something Went Wrong', '', 'error');
                        }
                        else {
                            console.log('Other Flag Recived');
                            swal('Something Went Wrong', '', 'error');
                        }
                    },
                    error: function (Data) {
                        console.log('Error In ./addNewQuotation.php AJAX call');
                        swal('Something Went Wrong', '', 'error');
                        console.log(Data.status + Data.statusText);
                    }
                });

            }
            else {
                if (name == "") {
                    swal('Please Enter Name', '', 'info');
                }
                else if (date == "") {
                    swal('Please Fill Date', '', 'info');
                }
                else {
                    swal('Please Add Items', '', 'info');
                }
            }


        });

        function ResetForm() {
            $('#getDescription').val('');
            $('#getQuantity').val('');
            $('#getRate').val('');
            $('#getGst').val("0");
            $('#addbtn').prop('disabled', false);
            $('#updatebtn').prop('disabled', true);
        }
    });
</script>

</html>