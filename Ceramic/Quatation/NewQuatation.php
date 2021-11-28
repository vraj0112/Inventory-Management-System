<?php
include ("connection.php");

?>
<!DOCTYPE html>
<html>

<head>
   <title>Quatation</title>

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
   </style>

   <!--       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->

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





   <script type="text/javascript">
      x = 1;

      function SomeDeleteRowFunction(o, x) {
         // x=x-1;


         // console.log(x);

         // var table = document.getElementById("data_table");
         // var row = table.rows[index];
         // window.alert(row.id)

         var a = document.getElementById('amount_' + x).value;
         //window.alert(i);
         var b = document.getElementById('qgstamt_' + x).value;
         //window.alert(j);
         var c = document.getElementById('qtotal_' + x).value;

         var s = document.getElementById('tbill').value - c;
         var r = document.getElementById('tgst').value - b;
         var t = document.getElementById('ttcost').value - a;
         document.getElementById('tbill').value = s;
         document.getElementById('tgst').value = r;
         document.getElementById('ttcost').value = t;

         var p = o.parentNode.parentNode;
         p.parentNode.removeChild(p);
      }

      function SomeEditRowFunction(o, x) {
         var i = document.getElementById('qdis_' + x).value;
         var j = document.getElementById('qqan_' + x).value;
         var k = document.getElementById('qrate_' + x).value;
         var l = document.getElementById('qgst_' + x).value;
         console.log(i);
         console.log(j);
         console.log(k);
         console.log(l);

         document.getElementById('qdis').value = i;
         document.getElementById('qqan').value = j;
         document.getElementById('qrate').value = k;
         document.getElementById('qgst').value = l;



         var a = document.getElementById('amount_' + x).value;
         //window.alert(i);
         var b = document.getElementById('qgstamt_' + x).value;
         //window.alert(j);
         var c = document.getElementById('qtotal_' + x).value;

         var s = document.getElementById('tbill').value - c;
         var r = document.getElementById('tgst').value - b;
         var t = document.getElementById('ttcost').value - a;
         document.getElementById('tbill').value = s;
         document.getElementById('tgst').value = r;
         document.getElementById('ttcost').value = t;

         SomeDeleteRowFunction(o, x);


         var qdis = $('#qdis').val();
         var qqan = $('#qqan').val();
         var qrate = $('#qrate').val();
         var qgst = $('#qgst').val();
         var amt = qqan * qrate;
         var amount = (qqan * qrate) + (qqan * qrate * qgst / 100);
         var gstamount = qqan * qrate * qgst / 100;


         var p = parseFloat(document.getElementById('tbill').value);
         var q = parseFloat(document.getElementById('tgst').value);
         var r = parseFloat(document.getElementById('ttcost').value);


         totalBill = p + amt;
         // document.getElementById("tbill").value='totalBill';
         gst = q + gstamount;
         // document.getElementById("tgst").value='gst';
         trcost = r + amount;
         // document.getElementById("ttcost").value='trcost';


         document.getElementById("tbill").value = totalBill;
         document.getElementById("tgst").value = gst;
         //document.getElementById("trem").innerHTML=r;
         document.getElementById("ttcost").value = trcost;


      }





      function reseta() {
         document.getElementById('qdis').value = '';
         document.getElementById('qqan').value = '';
         document.getElementById('qrate').value = '';
         document.getElementById('qgst').value = '';
      }





      function as() {
         document.getElementById("count").value = x;

      }
      // function alert1() {
      //      <?php
      //       if (isset($_GET['alert'])) { ?>
      //       swal({
      //          text: "Operation Performed Successful",
      //          icon: "success",
      //          button: "OK",
      //       });
      // //       <? //php } ?>

      //   }



      function check1(v) {
         var re = /^(\d{0,5}\.\d{0,2}|\d{0,5}|\.\d{0,2})$/;
         document.getElementById('tbill').value = re.test(v);

      }

      function check2(v) {
         var re = /^(\d{0,5}\.\d{0,2}|\d{0,5}|\.\d{0,2})$/;
         document.getElementById('tgst').value = re.test(v);
      }

      function check3(v) {
         var re = /^(\d{0,5}\.\d{0,2}|\d{0,5}|\.\d{0,2})$/;
         document.getElementById('ttcost').value = re.test(v);
      }



   </script>
</head>

<body onload="alert1();">
   <div class="container-fluid col-lg-12">
      <form class="" action="NewQuatation.php?log1=1" method="post">
         <!-- ?log1=1 -->
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
                           <input type="text" name="qname" class="form-control" id="qname"
                              placeholder="Enter Name Here">
                        </div>

                        <div class="form-group col-md-6">
                           <label class="form-label">Date : </label>
                           <input type="date" name="dop" id="dop" class="form-control">
                        </div>
                     </div>

                     <div class="row">
                        <div class="form-group col-md-6">
                           <label class="form-label">Discrpition: </label>
                           <input type="text" name="qdis" class="form-control" id="qdis" placeholder="Enter Discrpition"
                              required="">
                        </div>

                        <div class="form-group col-md-2">
                           <label class="form-label">Quantity: </label>
                           <input type="number" name="qqan" class="form-control" id="qqan" pattern="[0-9]{10}"
                              placeholder="Enter Number of Product" required="">
                        </div>

                        <div class="form-group col-md-2">
                           <label class="form-label">Rate: </label>
                           <input type="number" name="qrate" class="form-control" id="qrate" pattern="[0-9]{10}"
                              placeholder="Enter Price of Product" required="">
                        </div>

                        <div class="form-group col-md-2">
                           <label class="form-label">Taxable GST: </label>
                           <select class="form-select" id="qgst" name="qgst" onchange="cal()">
                              <option value="0" selected="selected">NA</option>
                              <option value="5">5</option>
                              <option value="12">12</option>
                              <option value="18">18</option>
                              <option value="28">28</option>
                           </select>
                        </div>
                     </div>



                     <div class="form-group col-md-6">
                        <input type="hidden" name="qgstamt" class="form-control" id="qgstamt">
                     </div>
                     <div class="form-group col-md-6">
                        <input type="hidden" name="qamount" class="form-control" id="qamount">
                     </div>

                     <br>
                     <div class="col-12">
                        <input type="Button" value="Add" id="add_data" class="btn btn-primary">
                        <!-- <button type="button" id="updateButton" name="add" class="btn btn-primary" onclick="productUpdate();"> Add </button> -->
                        <input type="Button" value="Reset" id="reset" class="btn btn-primary" onclick="reseta()">
                        <input type="hidden" id="count" name="count">
                        <input type="Button" value="Close" id="close" class="btn btn-primary"
                           onclick="window.location='../admin.php'">
                     </div>

                  </div>
               </div>
            </div>
         </div>

         <div class="row">
            <div class="col-md-12">
               <div class="card card-primary" style="overflow-x:auto; overflow-y: auto; height: 310px;">
                  <table class="table" id="data_table">
                     <!-- id="productTable" -->
                     <thead>
                        <tr>
                           <!--                            <th width="50px">Sr. No</th>
 -->
                           <th width="550px">Discription</th>
                           <th>Qty</th>
                           <th>Rate</th>
                           <th>GST</th>
                           <th>Total</th>
                           <th>GST Amount</th>
                           <th>Amount</th>
                           <th width="40px" colspan="2">
                              <center>Action</center>
                           </th>


                        </tr>
                     </thead>
                     <tbody>
                     </tbody>
                  </table>

                  

               </div>
               <div style="grid-column-start: 4;grid-column-end: 5; margin-left: 70%; padding-top: -15px;">
                  <p>Total Price: <input type="number" step="0.01" onkeyup="check1(this.value)" readonly="" value="0.00"
                        name="tbill" id="tbill" style="border: 0px"></p>
                  <p style="margin-top: -15px">Total GST: <input type="number" step="0.01" onkeyup="check2(this.value)"
                        readonly="" value="0.00" name="tgst" id="tgst" style="border: 0px"></p>
                  <p style="margin-top: -15px;">Total Amount: <input type="number" step="0.01"
                        onkeyup="check3(this.value)" readonly="" value="0.00" name="ttcost" id="ttcost"
                        style="border: 0px"></p>
               </div>

               <div class="col-12">
                  <input type="submit" name="submit" value="Save" id="submit" class="btn btn-success"
                     onclick="return as();" style="margin-top: -8px; margin-left: 45%;">
                  <input type="Button" value="Print Quatation" id="print" class="btn btn-success"
                     style="margin-top: -8px; margin-left: 20px;">
               </div>





      </form>
      <form action="./quatation2.php" method="POST" id='makepdf' target="_blank"><input type="hidden" name="quid" id="quid">
                  </form>
      <br>




      <!-- <script>
    // Next id for adding a new Product
    var nextId = 1;
    // ID of Product currently editing
    var activeId = 0;

    function productDisplay(ctl) {
      var row = $(ctl).parents("tr");
      var cols = row.children("td");

		activeId = $($(cols[6]).children("button")[0]).data("id");
     	$("#qdis").val($(cols[0]).text());
    	$("#qqan").val($(cols[1]).text());
    	$("#qrate").val($(cols[2]).text());
    	$("#qgst").val($(cols[3]).text());
    	$("#qgstamt").val($(cols[4]).text());
    	$("#qamount").val($(cols[5]).text());
    
    // Change Update Button Text
   		$("#updateButton").text("Update");
    }

    function productUpdate() {
      if ($("#updateButton").text() == "Update") {
        productUpdateInTable(activeId);
      }
      else {
        productAddToTable();
      }

      // Clear form fields
      formClear();

      // Focus to product name field
      $("#qdis").focus();
    }

    // Add product to <table>
    function productAddToTable() {
      // First check if a <tbody> tag exists, add one if not
      if ($("#productTable tbody").length == 0) {
        $("#productTable").append("<tbody></tbody>");
      }

      // Append product to table
      $("#productTable tbody").append(
        productBuildTableRow(nextId));

      // Increment next ID to use
      nextId += 1;
    }

    // Update product in <table>
    function productUpdateInTable(id) {
      // Find Product in <table>
      var row = $("#productTable button[data-id='" + id + "']")
                .parents("tr")[0];

      // Add changed product to table
      $(row).after(productBuildTableRow(id));
      // Remove original product
      $(row).remove();

      // Clear form fields
      formClear();

      // Change Update Button Text
      $("#updateButton").text("Add");
    }

    // Build a <table> row of Product data
    function productBuildTableRow(id) {
      var ret =
      "<tr>" +
        	"<td>" + $("#qdis").val() + "</td>" +
        	"<td>" + $("#qqan").val() + "</td>" +
        	"<td>" + $("#qrate").val() + "</td>" +
        	"<td>" + $("#qgst").val() + "</td>" +
        	"<td>" + $("#qgstamt").val() + "</td>" +
        	"<td>" + $("#qamount").val() + "</td>" +
        	"<td> <center>" + "<button type='button' " + "onclick='productDisplay(this);' " + "class='btn btn-default' " + "data-id='" + id + "'>" + "<span class='fa fa-edit' />" + "</button>" + "</center> </td>" +
        	"<td> <center>" + "<button type='button' " + "onclick='productDelete(this);' " + "class='btn btn-default' " + "data-id='" + id + "'>" + "<span class='fa fa-trash-o' />" + "</button>" + "</center></td>" +
      "</tr>"

      return ret;
    }

    // Delete product from <table>
    function productDelete(ctl) {
      $(ctl).parents("tr").remove();
    }

    // Clear form fields
    function formClear() {
		$("#qdis").val("");
    	$("#qqan").val("");
    	$("#qrate").val("");
    	$("#qgst").val("");
    	$("#qgstamt").val("");
    	$("#qamount").val("");
    }



</script> -->







</body>





<script type="text/javascript">
   var totalBill = 0;
   var gst = 0;
   var r = 0;
   var trcost = 0;
   var qno = 1;
   var amount = 0;
   $(document).ready(function () {
      $('#add_data').click(function () {
         var qdis = $('#qdis').val();
         var qqan = $('#qqan').val();
         var qrate = $('#qrate').val();
         var qgst = $('#qgst').val();
         var amt = qqan * qrate;
         var amount = (qqan * qrate) + (qqan * qrate * qgst / 100);
         var gstamount = qqan * qrate * qgst / 100;


         var p = parseFloat(document.getElementById('tbill').value);
         var q = parseFloat(document.getElementById('tgst').value);
         var r = parseFloat(document.getElementById('ttcost').value);


         totalBill = p + amt;
         // document.getElementById("tbill").value='totalBill';
         gst = q + gstamount;
         // document.getElementById("tgst").value='gst';
         trcost = r + amount;
         // document.getElementById("ttcost").value='trcost';


         document.getElementById("tbill").value = totalBill;
         document.getElementById("tgst").value = gst;
         //document.getElementById("trem").innerHTML=r;
         document.getElementById("ttcost").value = trcost;
         // if(name=="Other")
         // {
         //    name=$('#newname').val();
         //    type=$('#newtype').val();
         //    com=$('#newcom').val();
         // }

         if (qname != "" && qdis != "" && qqan != "" && qrate != "" && qgst != "") {

            $('#data_table tbody:last-child').append(
               '<tr>' +
               // '<td width="50px">'+'<input readonly id="qno_'+x+'" name="qno_'+x+'" type=text value="'+qno+'"></td>'+
               '<td width="250px">' + '<input readonly id="qdis_' + x + '" name="qdis_' + x + '" type=text value="' + qdis + '"></td>' +
               '<td>' + '<input readonly id="qqan_' + x + '" name="qqan_' + x + '" type=text value="' + qqan + '"></td>' +
               '<td>' + '<input readonly id="qrate_' + x + '" name="qrate_' + x + '" type=text value="' + qrate + '"></td>' +
               '<td>' + '<input readonly id="qgst_' + x + '" name="qgst_' + x + '" type=text value="' + qgst + '"></td>' +
               '<td>' + '<input readonly id="qtotal_' + x + '" name="qtotal_' + x + '" type=text value="' + amt + '"></td>' +
               '<td>' + '<input readonly id="qgstamt_' + x + '" name="qgstamt_' + x + '" type=text value="' + gstamount + '"></td>' +
               '<td>' + '<input readonly id="amount_' + x + '" name="amount_' + x + '" type=text value="' + amount + '"></td>' +

               // '<td>'+color_type+'</td>'+
               // '<td>'+grade+'</td>'+
               // '<td>'+code+'</td>'+
               // '<td>'+unit+'</td>'+
               // '<td>'+size+'</td>'+
               // '<td>'+batchno+'</td>'+
               // '<td>'+bprice+'</td>'+
               // '<td>'+cgst+'</td>'+
               // '<td>'+sgst+'</td>'+
               // '<td>'+disc+'</td>'+
               // '<td>'+qty+'</td>'+
               // '<td>'+tcost+'</td>'+
               // '<td>'+tp+'</td>'+
               '<td><button type="button" id="edit_' + x + '" class="btn btn-primary" onclick="SomeEditRowFunction(this, ' + x + ')">Edit</button> <input type="button" class="btn btn-primary" valuex = "' + x + '" value="Delete" onclick="SomeDeleteRowFunction(this, ' + x + ')"></td>' +

               '</tr>'
            );
            x = x + 1;
            qno = qno + 1;
         }
         else {
            alert("All fields are required");
         }


      });




   });


</script>









<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
   integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
   integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/masonry/4.2.2/masonry.pkgd.min.js"
   integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous"
   async></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
   function makePdf(quid) {
      $('#quid').val(quid);
      console.log($('#quid').val());
      $('#makepdf').submit();
   }
</script>







</html>

<?php
// include ("connection.php");

// if (isset($_POST['add'])) {
// 	// $qno = $_POST['qno'];
// 	$qdis = $_POST['qdis'];
// 	$qqan = $_POST['qqan'];
// 	$qrate = $_POST['qrate'];
// 	$gst = $_POST['qgst'];
// 	$gstamount = $_POST['qgstamt'];
// 	$Amount = $_POST['amount'];

// 	$sql = "INSERT INTO tblqutationdetailss (Discription, Qty, Rate, Gst, GstAmount, Amount, CreatedDate, ModifiedDate ,RecStatus) VALUES ('$qdis' ,$qqan, '$qrate', '$gst', '$gstamount', '$Amount', NOW(), NOW(), 1)";

// 	echo $sql;

// 	mysqli_query($conn, $sql);
// 	# code...
// }











// if (isset($_POST['submit'])) {
// 	# code...
// 	// $qno = $_POST['qno_'];
// 	// $qdis = $_POST['qdis_'];
// 	// $qqan = $_POST['qqan_'];
// 	// $qrate = $_POST['qrate_'];
// 	// $gst = $_POST['qgst_'];
// 	// $gstamount = $_POST['qgstamt_'];
// 	// $Amount = $_POST['amount_'];

// 	include ("connection.php");


// 	$count= count(array($qno));
// 	for ($i=0; $i<$count; $i++){
//     	if($qno[$i] != null ||  !empty($qno[$i])){

//        		$sql = "INSERT INTO tblqutationdetails (QuatationNo, Discription, Qty, Rate, Gst, GstAmount, Amount) VALUES ( '$qno[$i]','$qdis[$i]','$qqan[$i]','$qrate[$i]','$gst[$i]','$gstamount[$i]','$Amount[$i]')";

//        		$query=mysqli_query($conn,$sql);
//        		if ($query) {
//        			echo "Successful";
//        			# code...
//        		}
//        		else{
//        			echo "Error";
//        		}

// 		}
		 
// 		else {
//     		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
// 		}
// 	}
// }













if (isset($_GET['log1'])) {
                                  error_reporting(E_ERROR | E_WARNING | E_PARSE);

		# code...
            
        $count = $_POST['count'];
        $name = $_POST['qname'];
		    $dop = $_POST['dop'];
		    $tbill = $_POST['tbill'];
		    $tgst = $_POST['tgst'];
		    $ttcost = $_POST['ttcost'];
		    $status = 1;


        $sql2 = "INSERT INTO TblQutationMst (Name, QDate, TotalPrice, TotalGST, TotalAmount, CreatedDate, ModifiedDate, RecStatus) VALUES ('$name', '$dop', $tbill, $tgst, $ttcost, NOW(), NOW(), '$status')";
        mysqli_query($conn, $sql2);

//         echo '<script> swal({
//   title: "Quatation Added Succesfully",
//   text: "",
//   icon: "success",
//   Button: "OK"
// });
//             </script>';



        $sql = "INSERT INTO tblqutationdetails (Discription, Qty, Rate, Gst, GstAmount, Amount, QutationNo, CreatedDate, ModifiedDate ,RecStatus, QutationId) VALUES ";
        $insertCount = 0;

        $qno = 1;
        for ($x = 1; $x < $count; $x++) {
           if(isset($_POST['qdis_'.$x])){
            

                $insertCount = $insertCount + 1;
                // $qno = $_POST['qno_'.$x];
                $qdis = $_POST['qdis_'.$x];
                $qqan = $_POST['qqan_'.$x];
                $qrate = $_POST['qrate_'.$x];
                $qgst = $_POST['qgst_'.$x];
                $qgstamt = $_POST['qgstamt_'.$x];
                $amount = $_POST['amount_'.$x];
                // $cdate = Current_Date();
                // $mdate = Current_Date();
                $status = 1;

                $sql .= "('$qdis', $qqan, '$qrate', $qgst, '$qgstamt', '$amount','$qno', NOW(), NOW(), $status, LAST_INSERT_ID()), ";

                $qno = $qno + 1; 

            
            }
        }
        $sql = rtrim($sql, ", ");
        $sql .= ";";
        // echo $insertCount;
        if($insertCount!=0) {
           // echo $sql;
            mysqli_query($conn, $sql);

            $getLastInsertId = "SELECT * FROM tblqutationmst ORDER BY tblqutationmst.QutationId DESC LIMIT 1";
            $result_getLastInsertId = mysqli_query($conn, $getLastInsertId);

            if($result_getLastInsertId)
            {     
               $r =  $result_getLastInsertId->fetch_assoc();
               $last_insert_id = $r['QutationId'];
               //echo $last_insert_id;

               require('./fpdf/fpdf.php');
               require("config.php");
               $watermark = './watermark.jpeg';
               $company_no = 1;
                           
               //$last_insert_id = $_POST['quid'];
               class PDF extends FPDF{


                  protected $company_no;
                  protected $last_insert_id;


                  function __construct($last_insert_id, $company_no)
                  {
                     parent::__construct();
                     $this->last_insert_id = $last_insert_id;
                     $this->company_no = $company_no;
                  }

                  function Header()
                  {
               
                     $conn =mysqli_connect('localhost', 'root', '','imsfinal');
                     $result=mysqli_query($conn,"select * from tblqutationmst where QutationId = ".$this->last_insert_id." ");
                     $rows = mysqli_fetch_assoc($result);
                     $this->Image('watermark.jpeg',30,100,150);
                     $this->Image('./ceramic.png',5,5,40);
                     $company_name = 'Ceramic Hub';

               
                     $this->SetFont('Arial','B',15);
                     $this->Cell(110 ,6,'',0,0);
                     $this->SetFont('Arial','B',12);
                     $this->Cell(80, 6, $company_name,0,1,'C');
                     $this->Cell(110 ,6,'',0,0);
                     $this->Cell(80 ,6,'Address',0,1,'C');
                     $this->Cell(110 ,6,'',0,0);
                     $this->Cell(80 ,6,'Adress',0,1,'C');
                     $this->Cell(110 ,6,'',0,0);
                     $this->Cell(80 ,6,'Contact',0,1,'C');

                     $this->Ln(5);
                     $this->SetFont('Times','B',18);
                     $this->Cell(190,7,'Quotation',1,1,'C');
//$p           df->  Title('Challan');
                     $this->SetFont('Times','',12);
                     $this->SetFont('Times','B',12);
                     $this->Cell(45,7, 'Customer Name    : ','L', 0, 'L');   
                     $this->SetFont('Times','',12);
                     $this->Cell(60,7, $rows['Name'] ,0, 0, 'L');
                     $this->SetFont('Times','B',12);
                     $this->Cell(45,7, 'Challan ID    :','L', 0, 'L');
                     $this->SetFont('Times','',12);
                     $this->Cell(40,7, $rows['QutationId'],'R',1, 'L');
                     $this->SetFont('Times','B',12);
                     $this->cell(105,7,'','L,B',0,'L');
                     $this->SetFont('Times','B',12);
                     $this->Cell(45,7, 'Date               : ', 'L,B', 0, 'L');
                     $this->SetFont('Times','',12);
                     $this->Cell(40,7, $rows['ModifiedDate'], 'R,B', 1, 'L');
               
                     $this->SetFont('Times','B',12);
                     $this->Cell(30, 6, 'SR No.', 1, 0, 'C');
                     $this->Cell(75, 6, 'Item Name', 1, 0, 'C');
                     $this->Cell(30, 6, 'Quentity', 1, 0, 'C');
                     $this->Cell(25, 6, 'Rate', 1, 0, 'C');
                     $this->Cell(30, 6, 'Total', 1, 1, 'C'); 
               }
            
               // Page footer
               function Footer()
               {
                  $this->SetY(-62);
                  $this->SetFont('Times','',12);
                  $this->Ln(5);
                  $this->Cell(190, 5, 'Terms and Condition:-', 0, 1, 'L');
                  $this->Cell(190, 5, '1. Not Responsible for Demages after the goods delivered from our godown', 0, 1, 'L');
                  $this->Cell(190, 5, '2. Goods once supplied will not be taken back or exchanged.', 0, 1, 'L');
                  $this->Cell(190, 5, '3. 18% interest will charged if this not paid in 7 days.', 0, 1, 'L');
                  $this->Cell(190, 5, '4. Subject to Anand jurisdiction.', 0, 1, 'L');
                  $this->Ln(15);
                  $this->Cell(70, 0, "", 'T', 0, 'C');
                  $this->Cell(50, 0, "", 0, 0, 'C');
                  $this->Cell(70, 0, "", 'T', 1, 'C');
                  $this->Ln(5);
                  $this->Cell(70, 3, "Reciever's Sign.", 0, 0, 'C');
                  $this->Cell(50, 3, "", 0, 0, 'C');
                  $this->Cell(70, 3, "Authorise's Sign.", 0, 1, 'C');
                  $this->SetFont('Arial','I',8);
                  $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
               }

               function Title($label)
               {
                  // Arial 12
                     $this->SetFont('Times','B',18);
                  // Background color
                     $this->SetFillColor(160, 163, 161);
                  // Title
                     $this->Cell(190,7,"$label",0,1,'C',true);
                  // Line break
                     $this->Ln(4);
               }
            
            
               function cal($amt) {
	               $Amount = $amt;
	               $main = $Amount;
	               $No_0 = floor($Amount);
	               $Paise = round($Amount - $No_0, 2) * 100;
	               $No_1 = strlen($No_0);
	               $No = 0;
               
                   $Array = array();
	               $Value = array ('',
	            	    'Hundred',
	            	    'Thousand',
	            	    'Lakh',
	            	    'Caror'
                   );
                
                
                   $Trans = array('',
	            	    'One',		'Two',		'Three',		'Four',		'Five',		'Six',		'Seven',		'Eight',		'Nine',		'Ten',
	            	    'Eleven',		'Twelve',		'Thirteen',		'Fourteen',		'Fifteen',	'Sixteen',		'Seventeen',		'Eighteen',		'Nineteen',		'Twenty',
	            	    'Twenty One',		'Twenty Two',		'Twenty Three',		'Twenty Four',		'Twenty Five',	'Twenty Six',		'Twenty Seven',		'Twenty Eight',		'Twenty Nine',		'Thirty',
	            	    'Thirty One',		'Thirty Two',		'Thirty Three',		'Thirty Four',		'Thirty Five',	'Thirty Six',		'Thirty Seven',		'Thirty Eight',		'Thirty Nine',		'Forty',
	            	    'Forty One',		'Forty Two',		'Forty Three',		'Forty Four',		'Forty Five',	'Forty Six',		'Forty Seven',		'Forty Eight',		'Forty Nine',		'Fifty',
	            	    'Fifty One',		'Fifty Two',		'Fifty Three',		'Fifty Four',		'Fifty Five',	'Fifty Six',		'Fifty Seven',		'Fifty Eight',		'Fifty Nine',		'Sixty',
	            	    'Sixty One',		'Sixty Two',		'Sixty Three',		'Sixty Four',		'Sixty Five',	'Sixty Six',		'Sixty Seven',		'Sixty Eight',		'Sixty Nine',		'Seventy',
	            	    'Seventy One',		'Seventy Two',		'Seventy Three',	'Seventy Four',		'Seventy Five',	'Seventy Six',		'Seventy Seven',	'Seventy Eight',	'Seventy Nine',		'Eighty',
	            	    'Eighty One',		'Eighty Two',		'Eighty Three',		'Eighty Four',		'Eighty Five',	'Eighty Six',		'Eighty Seven',		'Eighty Eight',		'Eighty Nine',		'Ninety',
	            	    'Ninety One',		'Ninety Two',		'Ninety Three',		'Ninety Four',		'Ninety Five',	'Ninety Six',		'Ninety Seven',		'Ninety Eight',		'Ninety Nine'
                   );
                
                
                  while($No < $No_1){
	                  $No_1 = ($No == 2) ? 10 : 100;
	                  $No_2 = floor($No_0 % $No_1);
	                  $No_0 = floor($No_0 / $No_1);
	                  $No += 	($No_1 == 10) ? : 2;
	                  if($No_2) {
	                     $No_3 = (($Count = count($Array)) && $No_2 > 9) ? '' : null;
	                     $No_4 = ($Count == 1 &&  $Array[0]) ? '' : null;
                     
                        $Array [] = ($No_2 < 21) ? $Trans[$No_2].
	                        ' '.$Value[$Count].$No_3.
	                        ' '.$No_4 : $Trans[floor($No_2 / 10) * 10].
	                        ' '.$Trans[$No_2 % 10].
	                        ' '.$Value[$Count].$No_3.
	                        ' '.$No_4;
                        }
                     else $Array[] = null;
                  }
            
            
	               $Rupees = array_reverse($Array);
	               $Rupees = implode('', $Rupees);
	               $Paise = $Trans[$Paise];
                  $this->Cell(135,6,$Rupees.'Rupees only',0,0,'L');
               }          
            }           

            $pdf = new PDF($last_insert_id, '1');
            $pdf->AliasNbPages();
            $pdf->AddPage();

            $discount = 1.5;
            $amount = 0;
            $conn =mysqli_connect('localhost', 'root', '','imsfinal');
            $result1=mysqli_query($conn,"select * from tblqutationdetails where QutationId = {$last_insert_id}");
            $rows1 = mysqli_fetch_assoc($result1);
            $pdf->SetFont('Times','',10);
            $total_of_row = $rows1['Amount'];
            $result4=mysqli_query($conn,"select sum(Amount) as sum from tblqutationdetails where QutationId = {$last_insert_id}");
            $rows5 = mysqli_fetch_assoc($result4);
            $sum_of_sub_total = $rows5['sum'];

            $conn =mysqli_connect('localhost', 'root', '','imsfinal');

            //echo 'console.log("Database connected!")';
            $select="select * from tblqutationdetails where QutationId = {$last_insert_id}";


            foreach($dbo->query($select) as $row2) {
                $i=0;
                $pdf->Cell(30, 6,($i+1), 'L', 0, 'C');
                $pdf->Cell(75, 6, $row2['Discription'],'L', 0, 'L');
                $pdf->Cell(30, 6, $row2['Qty'], 'L', 0, 'R');
                $pdf->Cell(25, 6, $row2['Rate'], 'L', 0, 'R');
                $pdf->Cell(30, 6, $total_of_row, 'L,R', 1, 'R');
            }

            $amount = (float)$sum_of_sub_total-(((float)$sum_of_sub_total*$discount)/100);

            $pdf->SetFont('Times','B',12);
            $pdf->Cell(135, 6, 'Amount In Words : ', 'T', 0, 'L');
            $pdf->Cell(25, 6, 'Sub Total', 1, 0, 'L');
            $pdf->Cell(30, 6, number_format((float) $sum_of_sub_total, 2, '.', ''), 1, 1, 'R');
            $pdf->cal($amount);
            $pdf->Cell(25, 6, 'Discount', 1, 0, 'L');
            $pdf->Cell(30, 6, $discount, 1, 1, 'R');
            $pdf->Cell(135, 6, '', 0, 0, 'L');
            $pdf->Cell(25, 6, 'Amount', 1, 0, 'L');
            $pdf->Cell(30, 6, number_format((float) $amount, 2, '.', ''), 1, 1, 'R');

            ob_end_clean();

            $pdf->Output();
         }
      }
   }
?>