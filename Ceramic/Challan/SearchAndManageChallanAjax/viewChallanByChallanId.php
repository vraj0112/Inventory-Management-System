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
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                        <hr>

                        <div class="row">
                            <div class="grid1">
                                <div style="grid-column-start: 1;grid-column-end: 4;">
                                    <div class="row" style="margin-bottom:2%;margin-top: 5%;">
                                        <div class="col-md-4">
                                            <label class="form-label">Extra Cost Desc.</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="extraCostDescription" value="<?php echo $extracostdesc;?>" disabled>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-bottom:2%;">
                                        <div class="col-md-4">
                                            <label class="form-label">Extra Cost Amt.</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="number" class="form-control" id="extraCost" value="<?php echo $extracost;?>" disabled>
                                        </div>
                                    </div>

                                    <div class="row" style="margin-bottom:2%;">
                                        <div class="col-md-4">
                                            <label class="form-label">Remainig Payment.</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="number" class="form-control" id="remainingAmt" value="<?php echo $dueamount;?>" disabled>
                                        </div>
                                    </div>
                                </div>


                                <div style="grid-column-start: 5;grid-column-end: 6;">
                                    <div class="row" style="margin-bottom:2%;margin-top: 5%;">
                                        <div class="col-md-4">
                                            <label class="form-label">Total :</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="number" class="form-control" id="totalcost" disabled>
                                        </div>
                                    </div>

                                    <div class="row" style="margin-bottom:2%;">
                                        <div class="col-md-4">
                                            <label class="form-label">Discount :</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="number" class="form-control" id="discount" value="<?php echo $discount;?>"disabled>
                                        </div>
                                    </div>

                                    <div class="row" style="margin-bottom:2%;">
                                        <div class="col-md-4">
                                            <label class="form-label">Transportation Cost :</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="number" class="form-control" id="transportcost" value="<?php echo $transport;?>" disabled>
                                        </div>
                                    </div>

                                    <div class="row" style="margin-bottom:2%;">
                                        <div class="col-md-4">
                                            <label class="form-label">Sub Total:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="number" class="form-control" id="subtotal" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">

        $(function () {

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
                            total = total + (parseInt(billingqty) + parseInt(otherqty))*parseFloat(sellingprice);
                            console.log(total);
                            $("#purchasedtable").append(
                                "<tr>" +
                                "<td>" + subcategoryname + "</td>" +
                                "<td>" + typeorcolor + "</td>" +
                                "<td>" + brandname + "</td>" +
                                "<td>" + dimension + "</td>" +
                                "<td>" + qtyperunit + "</td>" +
                                "<td>" + packingunit + "</td>" +
                                "<td>" + grade + "</td>" +
                                "<td>" + code + "</td>" +
                                "<td>" + date + "</td>" +
                                "<td>" + batchno + "</td>" +
                                "<td>" + billingqty + "</td>" +
                                "<td>" + otherqty + "</td>" +
                                "<td>" + sellingprice + "</td>" +
                                "</tr>"
                            );
                        }

                        $("#totalcost").val(total.toFixed(2));
                        var sub = parseFloat($("#totalcost").val()) - parseFloat($("#discount").val()) + parseFloat($("#transportcost").val()) + parseFloat($("#extraCost").val());
                        $("#subtotal").val(sub.toFixed(2));

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



        });
    </script>
</body>