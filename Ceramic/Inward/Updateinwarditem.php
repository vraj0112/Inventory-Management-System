<?php
    include('./config.php');
?>

<!DOCTYPE html>
<html>
<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
<meta content="utf-8" http-equiv="encoding">

<head>
   <title>Ceramic Hub</title>
   <style type="text/css">
      .grid1 {
         display: grid;
         width: '100%';
         grid-template-columns: '50px 1fr';
      }
   </style>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
   <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
   <script>
      x = 1;
      function as() {
         console.log("after");
         console.log(x);
         document.getElementById("count").value = x;
      }
      function calp() {
         var bp = parseInt(document.getElementById('basep').value);
         var qty = parseInt(document.getElementById('qu').value);
         var gst = parseInt(document.getElementById('gst').value);
         // var sgst = parseInt(document.getElementById('sgst').value);
         var dis = parseInt(document.getElementById('disc').value);
         var tp = parseInt(document.getElementById('tc').value);


         var price = bp * qty;
         var cgst = price * (gst / 2) / 100;
         var sgst = price * (gst / 2) / 100;
         var tax = cgst + sgst;
         document.getElementById('cgst').value = cgst;
         document.getElementById('sgst').value = sgst;
         document.getElementById('tp').value = price + tax + tp - dis;



      }
      function SomeDeleteRowFunction(o) {

         var p = o.parentNode.parentNode;
         console.log("before delete: ");
         console.log(x);
         p.parentNode.removeChild(p);
         x = x - 1;
         console.log("after delete: ");
         console.log(x);
         as();


      }
      function select1() {
         var a = document.getElementById('category_name').value;
         var b = document.getElementById('unit').value;
         var c = document.getElementById('grade').value;
         if (a === "Cement") {
            document.getElementById("addOther").innerHTML = "";
            document.getElementById("addOther2").innerHTML = "";
            document.getElementById("addOther3").innerHTML = "";
            document.getElementById("grade").innerHTML = "";
            document.getElementById("type").innerHTML = "";
            var Arr = ["Select", "White Cement", "Grey Cement"];
            var Arr2 = ["Select", "White Cement", "Grey Cement"];
            var x = document.getElementById("type");
            for (i = 0; i < Arr.length; i++) {
               var option = document.createElement("option");
               option.text = Arr[i];
               option.value = Arr2[i];
               x.add(option);
            }
         }

         else if (a === "Ceramic") {

            document.getElementById("addOther").innerHTML = "";
            document.getElementById("addOther2").innerHTML = "";
            document.getElementById("addOther3").innerHTML = "";
            document.getElementById("type").innerHTML = "";
            document.getElementById("grade").innerHTML = "";
            document.getElementById('unit').value = "Box";
            var Arr = ["Select", "Vitrified Tiles", "Wall Tiles", "Floor Tiles", "Parking Tiles"];
            var Arr3 = ["Select", "Vitrified Tiles", "Wall Tiles", "Floor Tiles", "Parking Tiles"];

            var x = document.getElementById("type");
            for (i = 0; i < Arr.length; i++) {
               var option = document.createElement("option");
               option.text = Arr[i];
               option.value = Arr3[i];
               x.add(option);
            }
            var arr2 = ["Premium", "Standard", "Commercial", "Economical"];
            var y = document.getElementById("grade");
            for (i = 0; i < arr2.length; i++) {
               var option = document.createElement("option");
               option.text = arr2[i];
               y.add(option);
            }
         }
         else if (a === "Senitryware") {

            document.getElementById("addOther").innerHTML = "";
            document.getElementById("addOther2").innerHTML = "";
            document.getElementById("addOther3").innerHTML = "";
            document.getElementById("type").innerHTML = "";
            document.getElementById('unit').value = "Piece";
            document.getElementById("grade").innerHTML = "";

            var Arr = ["Select", "One Piece", "Wall Huge", "Table Top", "Full Pedestal Set", "Half Pedestal Set", "Wash Basin", "Water Closet", "Pan", "Urinal", "P-Trap", "Designer Set", "Designer TT", "Designer Basin", "Seat Cover"];
            var Arr3 = ["Select", "One Piece", "Wall Huge", "Table Top", "Full Pedestal Set", "Half Pedestal Set", "Wash Basin", "Water Closet", "Pan", "Urinal", "P-Trap", "Designer Set", "Designer TT", "Designer Basin", "Seat Cover"];
            var x = document.getElementById("type");
            for (i = 0; i < Arr.length; i++) {
               var option = document.createElement("option");
               option.text = Arr[i];
               option.value = Arr3[i];
               x.add(option);
            }
            var arr2 = ["Premium", "Standard", "Commercial"];
            var y = document.getElementById("grade");
            for (i = 0; i < arr2.length; i++) {
               var option = document.createElement("option");
               option.text = arr2[i];
               y.add(option);
            }
         }
         else if (a === "Bathroom Fitting") {

            document.getElementById("addOther").innerHTML = "";
            document.getElementById("addOther2").innerHTML = "";
            document.getElementById("addOther3").innerHTML = "";
            document.getElementById("type").innerHTML = "";
            document.getElementById('unit').value = "Piece";
            var Arr = ["Select", "Faucets", "Showers", "Arms", "Faucets", "Tubes", "Allies Faucets", "Allied", "Concealed", "Accessories"];
            var Arr3 = ["Select", "Faucets", "Showers", "Arms", "Faucets", "Tubes", "Allies Faucets", "Allied", "Concealed", "Accessories"];
            var x = document.getElementById("type");
            for (i = 0; i < Arr.length; i++) {
               var option = document.createElement("option");
               option.text = Arr[i];
               option.value = Arr3[i];
               x.add(option);
            }
         }
         else if (a === "Stone") {

            document.getElementById("addOther").innerHTML = "";
            document.getElementById("addOther2").innerHTML = "";
            document.getElementById("addOther3").innerHTML = "";
            document.getElementById("type").innerHTML = "";
            document.getElementById('unit').value = "Feet";
            document.getElementById("grade").innerHTML = "";
            var Arr = ["Select", "Marble", "Granite", "Cota Stone", "Stone", "Etc"];
            var Arr3 = ["Select", "Marble", "Granite", "Cota Stone", "Stone", "Etc"];
            var x = document.getElementById("type");
            for (i = 0; i < Arr.length; i++) {
               var option = document.createElement("option");
               option.text = Arr[i];
               option.value = Arr3[i];
               x.add(option);
            }
         }
         else if (a === "Kichen Sink") {

            document.getElementById("addOther").innerHTML = "";
            document.getElementById("addOther2").innerHTML = "";
            document.getElementById("addOther3").innerHTML = "";
            document.getElementById("type").innerHTML = "";
            document.getElementById('unit').value = "Piece";
            document.getElementById("grade").innerHTML = "";
            var Arr = ["Select", "Granite Sink", "Steel Sink"];

            var Arr3 = ["Select", "Granite Sink", "Steel Sink"];
            var x = document.getElementById("type");
            for (i = 0; i < Arr.length; i++) {
               var option = document.createElement("option");
               option.text = Arr[i];
               option.value = Arr3[i];
               x.add(option);
            }
         }
         else if (a === "Chemicals") {

            document.getElementById("addOther").innerHTML = "";
            document.getElementById("addOther2").innerHTML = "";
            document.getElementById("addOther3").innerHTML = "";

            document.getElementById("type").innerHTML = "";
            document.getElementById('unit').value = "KG";
            document.getElementById("grade").innerHTML = "";
            var Arr = ["Select", "Adhersives", "Epoxy", "Grouts", "Admixer", "Cleaner", "Accessories"];
            var Arr3 = ["Select", "Adhersives", "Epoxy", "Grouts", "Admixer", "Cleaner", "Accessories"];
            var x = document.getElementById("type");
            for (i = 0; i < Arr.length; i++) {
               var option = document.createElement("option");
               option.text = Arr[i];
               option.value = Arr3[i];
               x.add(option);
            }
         }
         else if (a === "Hardware") {

            document.getElementById("addOther").innerHTML = "";
            document.getElementById("addOther2").innerHTML = "";
            document.getElementById("addOther3").innerHTML = "";
            document.getElementById("type").innerHTML = "";
            document.getElementById('unit').value = "Piece";
            document.getElementById("grade").innerHTML = "";
            var Arr = ["Select", "Waste Pipe", "Coupling", "Supply Pipe", "Waste Jali", "Rack Bolts", "Tank", "Seat Cover", "Brackets", "Showers", "Arms", "Tubes", "Jet Spary", "C.P. Nippels", "Accessories", "Etc"];
            var Arr3 = ["Select", "Waste Pipe", "Coupling", "Supply Pipe", "Waste Jali", "Rack Bolts", "Tank", "Seat Cover", "Brackets", "Showers", "Arms", "Tubes", "Jet Spary", "C.P. Nippels", "Accessories", "Etc"];
            var x = document.getElementById("type");
            for (i = 0; i < Arr.length; i++) {
               var option = document.createElement("option");
               option.text = Arr[i];
               option.value = Arr3[i];
               x.add(option);
            }
         }
         else if (a === "Other") {
            /*var input = document.createElement("input");
            input.type = "text";
            input.className = "form-control"; // set the CSS class
            document.getElementById("addOther").appendChild(input);*/
            document.getElementById("addOther").innerHTML = "<input type='text' class='form-control' id='newname' placeholder='Enter Name'>";
            document.getElementById("addOther2").innerHTML = "<input type='text' class='form-control' id='newtype' placeholder='Enter Type'>";
            document.getElementById("addOther3").innerHTML = "<input type='text' class='form-control' id='newcom' placeholder='Enter Brand'>";
         }


      }
      function com1() {
         var a = document.getElementById('type').value;


         if (a === "White Cement") {
            document.getElementById("com").innerHTML = "";
            document.getElementById('unit').value = "KG";
            var Arr = ["JK", "Birla", "Global", "Others"];
            var Arr2 = ["JK", "Birla", "Global", "Others"];
            var x = document.getElementById("com");
            for (i = 0; i < Arr.length; i++) {
               var option = document.createElement("option");
               option.text = Arr[i];
               option.value = Arr2[i];
               x.add(option);
            }
         }
         else if (a === "Grey Cement") {

            document.getElementById("com").innerHTML = "";
            document.getElementById('unit').value = "Bag";
            var Arr = ["JK", "Others"];
            var Arr2 = ["JK", "Others"];
            var x = document.getElementById("com");
            for (i = 0; i < Arr.length; i++) {
               var option = document.createElement("option");
               option.text = Arr[i];
               option.value = Arr2[i];
               x.add(option);
            }
         }
         else if (a === "Vitrified Tiles") {

            document.getElementById("com").innerHTML = "";
            document.getElementById('unit').value = "Box";
            var Arr = ["Color Granito", "Capron Vitrified", "Roton Vitrified", "Ramest Vitrified", "Platina Vitrified"];
            var Arr2 = ["Color Granito", "Capron Vitrified", "Roton Vitrified", "Ramest Vitrified", "Platina Vitrified"];
            var x = document.getElementById("com");
            for (i = 0; i < Arr.length; i++) {
               var option = document.createElement("option");
               option.text = Arr[i];
               option.value = Arr2[i];
               x.add(option);
            }
         }
         else if (a === "Floor Tiles") {

            document.getElementById("com").innerHTML = "";
            document.getElementById('unit').value = "Bag";
            var Arr = ["Satyam Ceramic", "Super Star Ceramic", "Plazma Ceramic"];
            var Arr2 = ["Satyam Ceramic", "Super Star Ceramic", "Plazma Ceramic"];
            var x = document.getElementById("com");
            for (i = 0; i < Arr.length; i++) {
               var option = document.createElement("option");
               option.text = Arr[i];
               option.value = Arr2[i];
               x.add(option);
            }
         }
         else if (a === "Wall Tiles") {

            document.getElementById("com").innerHTML = "";
            document.getElementById('unit').value = "Box";
            var Arr = ["Color Tiles", "Platinum Ceramic", "Cefon Ceramic", "Diliso Ceramic", "Zibon Ceramic", "Sonara Ceramic", "Amodh Ceramic", "Manish Ceramic"];
            var Arr2 = ["Color Tiles", "Platinum Ceramic", "Cefon Ceramic", "Diliso Ceramic", "Zibon Ceramic", "Sonara Ceramic", "Amodh Ceramic", "Manish Ceramic"];
            var x = document.getElementById("com");
            for (i = 0; i < Arr.length; i++) {
               var option = document.createElement("option");
               option.text = Arr[i];
               option.value = Arr2[i];
               x.add(option);
            }
         }
         else if (a == "Parking Tiles") {
            document.getElementById("com").innerHTML = "";
            document.getElementById('unit').value = "Box";
            var Arr = ["Auckland Ceramic", "Yuvi Ceramic", "Luton Ceramic", "Others"];
            var Arr2 = ["Auckland Ceramic", "Yuvi Ceramic", "Luton Ceramic", "Others"];
            var x = document.getElementById("com");
            for (i = 0; i < Arr.length; i++) {
               var option = document.createElement("option");
               option.text = Arr[i];
               option.value = Arr2[i];
               x.add(option);
            }
         }
      }
      function checkRadio(radio) {
         if (radio.id === "ev") {
            document.getElementById("button").innerHTML = "<select id='vname' name='vname' class='form-select col-md-12'><option selected>Select Vendor</option><option value='1'>A</option><option value='2'>B</option><option value='3'>C</option><option value='4'>D</option></select>";
         }
         else if (radio.id === "nv") {
            window.location.href = 'newvendor.html';
         }
         else if (radio.id == "cash") {
            document.getElementById("rb1").innerHTML = "<div class='form-group col-md-2'></div><div class='form-group col-md-10'><div class ='form-check form-check-inline'><input type='radio' class ='form-check-input' name ='credit' id ='c' onchange='checkRadio(this)'><label class ='form-check-label' for ='inlineRadio5'>Partial</label></div><div class='form-check form-check-inline'><input type='radio' class ='form-check-input' name ='credit' id ='cr' onchange='checkRadio(this)'><label class ='form-check-label' for ='inlineRadio6'>Full</label></div></div>";
         }
         else if (radio.id == "credit") {
            document.getElementById('rb1').innerHTML = "";
            document.getElementById('rp').value = '0';
            document.getElementById('totalpending').value = '0';
            document.getElementById('totalpaid').value = document.getElementById('totalbill').value;

         }
         else if (radio.id == "c") {
            document.getElementById("rb2").innerHTML = "<input type='text' name='paid' id='paid' placeholder='Enter Paid Ammount' class='form-control' onchange='calrem()'>";


         }
         else if (radio.id == "cr") {
            document.getElementById("rb2").innerHTML = "";
            document.getElementById("rp").value = "0";
            document.getElementById("totalpending").value = 0;
            document.getElementById('totalpaid').value = document.getElementById('totalbill').value;

         }


      }
      function calpen()
      {
         var paid = document.getElementById('paid').value;
         var totalp = document.getElementById('tp').value;
         var pend = totalp - paid;
         document.getElementById('pending').value = pend;
      }
      function calrem() {
         var pay = document.getElementById('paid').value;
         var totalp = document.getElementById('totalbill').value;
         var left = totalp - pay;
         document.getElementById('rp').value = left;
         document.getElementById('totalpending').value = left;
         document.getElementById('totalpaid').value = pay;

      }

      function cancelField() {
         document.getElementById("ExtraCost").innerHTML = "";
         document.getElementById("addOtherCharge").disabled = false;
      }
      function alert1() {


      }
      function select2() {
         var a = document.getElementById('mpname').value;
         var b = document.getElementById('munit').value;
         var c = document.getElementById('mgrade').value;
         if (a === "Cement") {
            document.getElementById("maddOther").innerHTML = "";
            document.getElementById("maddOther2").innerHTML = "";
            document.getElementById("maddOther3").innerHTML = "";
            document.getElementById("mgrade").innerHTML = "";
            document.getElementById("mtype").innerHTML = "";
            var Arr = ["Select", "White Cement", "Grey Cement"];
            var Arr2 = ["Select", "White Cement", "Grey Cement"];
            var x = document.getElementById("mtype");
            for (i = 0; i < Arr.length; i++) {
               var option = document.createElement("option");
               option.text = Arr[i];
               option.value = Arr2[i];
               x.add(option);
            }
         }

         else if (a === "Ceramic") {

            document.getElementById("maddOther").innerHTML = "";
            document.getElementById("maddOther2").innerHTML = "";
            document.getElementById("maddOther3").innerHTML = "";
            document.getElementById("mtype").innerHTML = "";
            document.getElementById("mgrade").innerHTML = "";
            document.getElementById('munit').value = "Box";
            var Arr = ["Select", "Vitrified Tiles", "Wall Tiles", "Floor Tiles", "Parking Tiles"];
            var Arr3 = ["Select", "Vitrified Tiles", "Wall Tiles", "Floor Tiles", "Parking Tiles"];

            var x = document.getElementById("mtype");
            for (i = 0; i < Arr.length; i++) {
               var option = document.createElement("option");
               option.text = Arr[i];
               option.value = Arr3[i];
               x.add(option);
            }
            var arr2 = ["Premium", "Standard", "Commercial", "Economical"];
            var y = document.getElementById("mgrade");
            for (i = 0; i < arr2.length; i++) {
               var option = document.createElement("option");
               option.text = arr2[i];
               y.add(option);
            }
         }

         else if (a === "Senitryware") {

            document.getElementById("maddOther").innerHTML = "";
            document.getElementById("maddOther2").innerHTML = "";
            document.getElementById("maddOther3").innerHTML = "";
            document.getElementById("mtype").innerHTML = "";
            document.getElementById('munit').value = "Piece";
            document.getElementById("mgrade").innerHTML = "";

            var Arr = ["Select", "One Piece", "Wall Huge", "Table Top", "Full Pedestal Set", "Half Pedestal Set", "Wash Basin", "Water Closet", "Pan", "Urinal", "P-Trap", "Designer Set", "Designer TT", "Designer Basin", "Seat Cover"];
            var Arr3 = ["Select", "One Piece", "Wall Huge", "Table Top", "Full Pedestal Set", "Half Pedestal Set", "Wash Basin", "Water Closet", "Pan", "Urinal", "P-Trap", "Designer Set", "Designer TT", "Designer Basin", "Seat Cover"];
            var x = document.getElementById("mtype");
            for (i = 0; i < Arr.length; i++) {
               var option = document.createElement("option");
               option.text = Arr[i];
               option.value = Arr3[i];
               x.add(option);
            }
            var arr2 = ["Premium", "Standard", "Commercial"];
            var y = document.getElementById("mgrade");
            for (i = 0; i < arr2.length; i++) {
               var option = document.createElement("option");
               option.text = arr2[i];
               y.add(option);
            }
         }
         else if (a === "Bathroom Fitting") {

            document.getElementById("maddOther").innerHTML = "";
            document.getElementById("maddOther2").innerHTML = "";
            document.getElementById("maddOther3").innerHTML = "";
            document.getElementById("mtype").innerHTML = "";
            document.getElementById('munit').value = "Piece";
            var Arr = ["Select", "Faucets", "Showers", "Arms", "Faucets", "Tubes", "Allies Faucets", "Allied", "Concealed", "Accessories"];
            var Arr3 = ["Select", "Faucets", "Showers", "Arms", "Faucets", "Tubes", "Allies Faucets", "Allied", "Concealed", "Accessories"];
            var x = document.getElementById("mtype");
            for (i = 0; i < Arr.length; i++) {
               var option = document.createElement("option");
               option.text = Arr[i];
               option.value = Arr3[i];
               x.add(option);
            }
         }
         else if (a === "Stone") {

            document.getElementById("maddOther").innerHTML = "";
            document.getElementById("maddOther2").innerHTML = "";
            document.getElementById("maddOther3").innerHTML = "";
            document.getElementById("mtype").innerHTML = "";
            document.getElementById('munit').value = "Feet";
            document.getElementById("mgrade").innerHTML = "";
            var Arr = ["Select", "Marble", "Granite", "Cota Stone", "Stone", "Etc"];
            var Arr3 = ["Select", "Marble", "Granite", "Cota Stone", "Stone", "Etc"];
            var x = document.getElementById("mtype");
            for (i = 0; i < Arr.length; i++) {
               var option = document.createElement("option");
               option.text = Arr[i];
               option.value = Arr3[i];
               x.add(option);
            }
         }
         else if (a === "Kichen Sink") {

            document.getElementById("maddOther").innerHTML = "";
            document.getElementById("maddOther2").innerHTML = "";
            document.getElementById("maddOther3").innerHTML = "";
            document.getElementById("mtype").innerHTML = "";
            document.getElementById('munit').value = "Piece";
            document.getElementById("mgrade").innerHTML = "";
            var Arr = ["Select", "Granite Sink", "Steel Sink"];

            var Arr3 = ["Select", "Granite Sink", "Steel Sink"];
            var x = document.getElementById("mtype");
            for (i = 0; i < Arr.length; i++) {
               var option = document.createElement("option");
               option.text = Arr[i];
               option.value = Arr3[i];
               x.add(option);
            }
         }
         else if (a === "Chemicals") {

            document.getElementById("maddOther").innerHTML = "";
            document.getElementById("maddOther2").innerHTML = "";
            document.getElementById("maddOther3").innerHTML = "";

            document.getElementById("mtype").innerHTML = "";
            document.getElementById('munit').value = "KG";
            document.getElementById("mgrade").innerHTML = "";
            var Arr = ["Select", "Adhersives", "Epoxy", "Grouts", "Admixer", "Cleaner", "Accessories"];
            var Arr3 = ["Select", "Adhersives", "Epoxy", "Grouts", "Admixer", "Cleaner", "Accessories"];
            var x = document.getElementById("mtype");
            for (i = 0; i < Arr.length; i++) {
               var option = document.createElement("option");
               option.text = Arr[i];
               option.value = Arr3[i];
               x.add(option);
            }
         }
         else if (a === "Hardware") {

            document.getElementById("maddOther").innerHTML = "";
            document.getElementById("maddOther2").innerHTML = "";
            document.getElementById("maddOther3").innerHTML = "";
            document.getElementById("mtype").innerHTML = "";
            document.getElementById('munit').value = "Piece";
            document.getElementById("mgrade").innerHTML = "";
            var Arr = ["Select", "Waste Pipe", "Coupling", "Supply Pipe", "Waste Jali", "Rack Bolts", "Tank", "Seat Cover", "Brackets", "Showers", "Arms", "Tubes", "Jet Spary", "C.P. Nippels", "Accessories", "Etc"];
            var Arr3 = ["Select", "Waste Pipe", "Coupling", "Supply Pipe", "Waste Jali", "Rack Bolts", "Tank", "Seat Cover", "Brackets", "Showers", "Arms", "Tubes", "Jet Spary", "C.P. Nippels", "Accessories", "Etc"];
            var x = document.getElementById("mtype");
            for (i = 0; i < Arr.length; i++) {
               var option = document.createElement("option");
               option.text = Arr[i];
               option.value = Arr3[i];
               x.add(option);
            }
         }
         else if (a === "Other") {
            /*var input = document.createElement("input");
            input.type = "text";
            input.className = "form-control"; // set the CSS class
            document.getElementById("addOther").appendChild(input);*/
            document.getElementById("maddOther").innerHTML = "<input type='text' class='form-control' id='newname' placeholder='Enter Name'>";
            document.getElementById("maddOther2").innerHTML = "<input type='text' class='form-control' id='newtype' placeholder='Enter Type'>";
            document.getElementById("maddOther3").innerHTML = "<input type='text' class='form-control' id='newcom' placeholder='Enter Brand'>";
         }


      }
      function maddunit1() {
         document.getElementById("mUnit1").value = "KG";
         document.getElementById("mUnit1").readOnly = true;
      }
      function maddunit2() {
         document.getElementById("mUnit1").value = "Pieces";
         document.getElementById("mUnit1").readOnly = true;
      }
      function maddunit3() {

         document.getElementById("mUnit1").value = "";
         document.getElementById("mUnit1").readOnly = false;
      }
   </script>
</head>

<body">
   <div class="container-fluid col-lg-12">
      <form name="inwardform" id="inwardform" action="DBoperationUI.php" method="POST">
         <div class="row">
            <div class="col-md-12">
               <div class="card card-primary">
                  <div class="card-header" style="background-color: #2B60DE">
                     <h3 class="card-title" style="color: white" align="center">New Inward</h3>
                  </div>
                  <?php                              
                              $inwardid = $_GET['iid'];
                              $inwardno = $_GET['ino'];
                              $type = $_GET['type'];
                              
                   ?>        
                   <input type="hidden" name="iid" value="<?php echo $inwardid ?>">
                   <input type="hidden" name="ino" value="<?php echo $inwardno ?>">
                   <input type="hidden" name="type1" value="<?php echo $type ?>">
                  <div class="card-body">
                     <div class="row g-3">
                        <div class="form-group col-md-2">
                           <label class="form-label">Product Name: </label>
                           <select id="category_name" class="form-select col-md-12">

                              <option value='-1' selected>Select Product</option>
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
                                       "<option value='".$category_name."' cid=".$category_id.">".$category_name."</option>";
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
                        <div class="form-group col-md-2">
                           <label class="form-label">Product Type: </label>
                           <select id="subcategories" name="type" class="form-select">
                              <option value='-1'>Select</option>
                           </select>

                        </div>
                        <div class="form-group col-md-1">
                           <label class="form-label">HSN Code: </label>
                           <input type="Text" name="HSN" class="form-control" id='hsn' disabled>
                        </div>
                        <div class="form-group col-md-1">
                           <label class="form-label">Taxable GST %: </label>
                           <input type="text" name="gst" class="form-control" id="gst" disabled>
                        </div>
                        <div class="form-group col-md-2">
                           <label class="form-label">Brand Name: </label>
                           <select id="com" name="com" class="form-select resetsearchparam class-brand">
                              <option value='-1'>Select</option>
                              <?php
                                        /*$query = "SELECT DISTINCT ProductBrandName FROM Productmst";
                                        $result = mysqli_query($conn, $query);
          
                                        if($result)
                                        {
                                           while($row = $result -> fetch_assoc())
                                           {
                                              $brandname = $row['ProductBrandName'];
                                              echo
                                                 "<option value='".$brandname."'>".$brandname."</option>";
                                           }
                                        }
                                        else
                                        {
                                           echo "<script>alert('Something Went Wrong');</script>";
                                           location.reload(true);
                                        }*/
                                        ?>
                           </select>
                        </div>
                        <div class="form-group col-md-2">
                           <label class="form-label">Color / Type / Series: </label>
                           <select name='toc' id='toc' class="form-control form-select resetsearchparam">
                              <option value="-1">Select</option>
                              <?php
                                     $query = "SELECT DISTINCT ProductTypeColor FROM productmst";
                                     $result = mysqli_query($conn, $query);
       
                                     if($result)
                                     {
                                        while($row = $result -> fetch_assoc())
                                        {
                                           $producttypeorcolor = $row['ProductTypeColor'];
                                           echo
                                              "<option value='".$producttypeorcolor."'>".$producttypeorcolor."</option>";
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
                        <div class="form-group col-md-2">
                           <label class="form-label">Grade: </label>
                           <select id="grade" name="grade" class="form-select col-md-12 resetsearchparam class-grade">
                              <option value='-1' selected>Select</option>
                              <?php
                                        /*$query = "SELECT DISTINCT grade FROM productmst ORDER BY grade ASC";
                                        $result = mysqli_query($conn, $query);
          
                                        if($result)
                                        {
                                           while($row = $result -> fetch_assoc())
                                           {
                                              $grade = $row['grade'];
                                              echo
                                                 "<option value='".$grade."'>".$grade."</option>";
                                           }
                                        }
                                        else
                                        {
                                           echo "<script>alert('Something Went Wrong');</script>";
                                           location.reload(true);
                                        }*/
                                        ?>
                           </select>
                        </div>
                        <div class="form-group col-md-2">
                           <label class="form-label">Code/Model/Design No.: </label>
                           <select id="cmd" class="form-select col-md-12 resetsearchparam" name="cmd">
                              <option value='-1' selected>Select</option>
                              <?php
                                        $query = "SELECT DISTINCT code FROM productmst ORDER BY code ASC";
                                        $result = mysqli_query($conn, $query);
          
                                        if($result)
                                        {
                                           while($row = $result -> fetch_assoc())
                                           {
                                              $code = $row['code'];
                                              echo
                                                 "<option value='".$code."'>".$code."</option>";
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

                        <div class="form-group col-md-2">
                           <label class="form-label">Unit of Purchase: </label>
                           <select class='form-select resetsearchparam' name="unit" id="unit">
                              <option value="-1">Select</option>
                              <option value="kg">KG</option>
                              <option value="Piece">Peice</option>
                              <option value="Box">Box</option>
                           </select>
                        </div>
                        
                        <div class="form-group col-md-2">
                           <label class="form-label">Qty Per Unit: </label>
                           <input type="number" name="size" class="form-control" id="wp">
                        </div>
                        <div class="form-group col-md-2">
                           <label class="form-label">Dimension: </label>
                           <select name="die" class="form-select" id="die">
                           <option value='-1' selected>Select</option>
                              <?php
                                        $query = "SELECT DISTINCT SizeOrDimension FROM productmst ORDER BY code ASC";
                                        $result = mysqli_query($conn, $query);
          
                                        if($result)
                                        {
                                           while($row = $result -> fetch_assoc())
                                           {
                                              $code = $row['SizeOrDimension'];
                                              echo
                                                 "<option value='".$code."'>".$code."</option>";
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
                        <div class="form-group col-md-2">
                           <label class="form-label">Batch No.: </label>
                           <input type="text" name="bn" class="form-control" id="bn">
                        </div>
                        <div class="form-group col-md-2">
                           <label class="form-label">Base Price: </label>
                           <input type="number" name="basep" class="form-control" id="basep" onchange="calp()">
                        </div>
                        <div class="form-group col-md-2">
                           <label class="form-label">Quantity: </label>
                           <input type="number" name="qu" class="form-control" id="qu" onchange="calp()">
                        </div>
                        <div class="form-group col-md-2">
                           <label class="form-label">Discount: </label>
                           <input type="number" name="disc" class="form-control" id="disc" onchange="calp()">
                        </div>
                        <div class="form-group col-md-2">
                           <label class="form-label">Transpotation Cost: </label>
                           <input type="number" name="tc" class="form-control" id="tc" onchange="calp()">
                        </div>
                        <div class="form-group col-md-2">
                           <label class="form-label">CGST: </label>
                           <input type="number" name="cgst" class="form-control" id="cgst" readonly>
                           <!-- <select class="form-select" id="cgst" onchange="calp()">
                                 <option value="5">5</option>
                                 <option value="12">12</option>
                                 <option value="18">18</option>
                                 <option value="28">28</option>
                                 </select> -->
                        </div>
                        <div class="form-group col-md-2">
                           <label class="form-label">SGST: </label>
                           <input type="number" name="sgst" class="form-control" id="sgst" readonly>
                           <!--                            <select class="form-select" id="sgst" onchange="calp()">
                                 <option value="5">5</option>
                                 <option value="12">12</option>
                                 <option value="18">18</option>
                                 <option value="28">28</option>
                                 </select> -->
                        </div>
                        <!--                         <div class="form-group col-md-2">
                              <label class="form-label">Quantity: </label>
                              <input type="text" name="qu" class="form-control" id="qu" onchange="calp()">
                              </div> -->
                        
                        <div class="form-group col-md-2">
                           <label class="form-label">Total Price: </label>
                           <input type="number" name="tp" class="form-control" id="tp" onfocus="calp()" readonly>
                        </div>
                        <div class="form-group col-md-2">
                           <label class="form-label">Paid Amount: </label>
                           <input type="number" name="paid" id="paid" class="form-control" id="tp" onfocus="calpen()">
                        </div>
                        <div class="form-group col-md-2">
                           <label class="form-label">Pending Price: </label>
                           <input type="number" name="pending" id="pending" class="form-control" id="tp" onfocus="calpen()">
                        </div>
                        <div class="col-12">
                           <input type="submit" value="Add" id="add_data" class="btn btn-primary">
                           <input type="reset" value="Reset" id="reset" class="btn btn-primary">

                           <input type="hidden" id="count" name="count">
                           <input type="hidden" id="count2" name="count2">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
        
      </form>
   </div>
   
</body>
<script type="text/javascript">

   var totalBill = 0;
   var gst = 0;
   var r = 0;
   var trcost = 0;
   $(function () {

      var tbill = 0, tgst = 0, ttracost = 0, tpaid = 0, trem = 0;

      $('#addOtherCharge').click(function () {
         $('#ExtraCost').append(
            '<form class="row g-3">' +
            '<div class="form-group col-md-1" style="margin-left: 30px; margin-top: 30px;" id="AddChargesRs.">' +
            '<input type="text" name="extraCost" class="form-control col-md-2" id="extraCost" placeholder="Extra Cost">' +
            '</div>' +
            '<div class="form-group col-md-4" style="margin-top: 30px;" id="AddChargesDes">' +
            '<input type="text" name="extraCostDes" class="form-control" id="extraCostDes" placeholder="Description of Extra Cost">' +
            '</div>' +
            '<div class="form-group col-md-1" style="margin-top: 35px;height:0px;" id="CancelField" >' +
            '<button type="button" class="btn-close" id="closeButton" onclick="cancelField()"></button>' +
            '</div>' +
            '<div></div>' +
            '</form>'
         );
         $('#addOtherCharge').attr("disabled", true);
      });

      $('#category_name').on('change', function () {
         let cat = $('#category_name').val();
         //console.log(cat);
         $("#subcategories").empty();
         $("#subcategories").append(new Option('Select', '-1'));
         if (cat != '-1') {
            //console.log('Hello');
            myobj = { scn: cat };

            $.ajax({
               type: "POST",
               url: "./getSubCategories2.php",
               data: JSON.stringify(myobj),
               dataType: "json",
               success: function (Data) {
                  //console.log(Data);
                  if (Data[0].FLAG == 'OK') {
                     let x = Data;
                     let scn;
                     let sci;
                     let n = x.length;
                     console.log(Data);
                     for (let i = 1; i < n; i++) {
                        scn = Data[i].scn;
                        $("#subcategories").append(new Option(scn, scn))
                     }
                  }
                  else {
                     alert('Something Went Wrong');
                     location.reload(true);
                  }
               }
            });
         }
         else {
            //console.log('Uddhav');
            alert('Please Select Category');
            $("#subcategories").empty();
            $("#subcategories").append(new Option('Select', '-1'));
            $("#grade").empty();
            $("#grade").append(new Option('Select', '-1'));

            $("#com").empty();
            $("#com").append(new Option('Select', "-1"));

            $("#gst").val("");
            $("#hsn").val("");
         }

      });
      
      

      $('#inwardform').submit(function (e) {
         e.preventDefault();
         var formData = new FormData(this);
         $.ajax({
            url: "DBoperationUI.php?log1=1",
            type: 'POST',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
               console.log(data);
               if (data == " done ") {

                  swal({
                     text: "Operation Performed Successful",
                     icon: "success",
                     button: "OK",
                  }).then(function (isConfirm) {
                     if (isConfirm) {
                        window.open("Updateinward.php?id=<?php echo $inwardid;?>&type=<?php echo $type;?>", "_self");
                     }
                  })
                  // after successfully insert reset form...
                  $("#inwardform")[0].reset();
               }
               else {
                  swal({
                     text: "Add Product First",
                     icon: "error",
                     button: "OK",
                  });
               }
            }
         });

      });


      $("#subcategories").on('change', function () {

         /*$("#grade").empty();
         $("#grade").append(new Option('Select', '-1'));

         $("#com").empty();
         $("#com").append(new Option('Select', "-"));*/

         if ($('#subcategories').val() != "-1") {
            ReloadGradeFromSubcategory();
            ReloadBrandsFromSubcategory();
            ReloadGSTAndHSNFromSubcategory();
         }
         else {
            $("#grade").empty();
            $("#grade").append(new Option('Select', '-1'));

            $("#com").empty();
            $("#com").append(new Option('Select', "-1"));

            $("#gst").val("");
            $("#hsn").val("");
         }




      });

      function ReloadGradeFromSubcategory() {

         //ResetSelectMenu($("#grades"));

         $("#grade").empty();
         $("#grade").append(new Option('Select', '-1'));

         var subcatname = $('#subcategories').val();

         console.log(subcatname);

         if (subcatname != "-1") {
            $.ajax({
               type: "POST",
               url: './getGradesFromSubcategoryID.php',
               data: { subcatname: subcatname },
               dataType: 'json',
               success: function (Data) {
                  console.log(Data);

                  if (Data[0].FLAG == "OK") {
                     var n = Data.length;

                     for (var i = 1; i < n; i++) {
                        $('#grade').append(new Option(Data[i].gradetext, Data[i].gradetext));
                     }
                  }
                  else if (Data[0].FLAG == "NORECORDFOUND") {
                     console.log("NO RECORD FOUND");
                     alert("No Record Found For Selected Category");
                  }
                  else if (Data[0].FLAG == "ERRINFINDINGGRADES") {
                     console.log("Error In Executing Grades Query");
                     alert("Something Went Wrong");
                  }
                  else if (Data[0].FLAG == 'ERRFINDINGSUBCATID') {
                     console.log("Error While Finding Subcat id");
                     alert("Something Went Wrong");
                  }
                  else {
                     console.log('Other FLAG Recived');
                     alert('Something Went Wrong');
                  }
               },
               error: function (Data) {
                  console.log('Error In   getGradesFromSubcategoryID.php   Ajax Call');
                  alert("Something Went Wrong");
               }
            });
         }

      }

      function ReloadBrandsFromSubcategory() {

         $("#com").empty();
         $("#com").append(new Option('Select', '-1'));

         var subcatname = $('#subcategories').val();
         console.log(subcatname);

         if (subcatname != "-1") {
            $.ajax({
               type: "POST",
               url: './getBrandsFromSubcategoryID.php',
               data: { subcatname: subcatname },
               dataType: 'json',
               success: function (Data) {
                  console.log(Data);

                  if (Data[0].FLAG == "OK") {
                     var n = Data.length;

                     for (var i = 1; i < n; i++) {
                        $('#com').append(new Option(Data[i].brandname, Data[i].brandname));
                     }
                  }
                  else if (Data[0].FLAG == "NORECORDFOUND") {
                     console.log("NO RECORD FOUND");
                     alert("No Brand Found For Selected Sub Category");
                  }
                  else if (Data[0].FLAG == "ERRINFINDINGBRANDS") {
                     console.log("Error In Executing Brands Query");
                     alert("Something Went Wrong");
                  }
                  else if (Data[0].FLAG == 'ERRFINDINGSUBCATID') {
                     console.log("Error While Finding Subcat id");
                     alert("Something Went Wrong");
                  }
                  else {
                     console.log('Other FLAG Recived');
                     alert('Something Went Wrong');
                  }
               },
               error: function (Data) {
                  console.log('Error In   getBrandsFromSubcategoryID.php   Ajax Call');
                  alert("Something Went Wrong");
               }
            });
         }
      }

      function ReloadGSTAndHSNFromSubcategory() {

         var subcatname = $('#subcategories').val();

         if (subcatname != "-1") {
            $.ajax({
               type: "POST",
               url: './getHSNandGSTFromSubcategory.php',
               data: { subcatname: subcatname },
               dataType: 'json',
               success: function (Data) {
                  console.log(Data);

                  if (Data[0].FLAG == "OK") {
                     $("#hsn").val(Data[1].hsn);
                     $("#gst").val(Data[1].gst);
                  }
                  else if (Data[0].FLAG == "NORECORDFOUND") {
                     console.log("NO RECORD FOUND");
                     alert("No Brand Found For Selected Sub Category");
                  }
                  else if (Data[0].FLAG == "ERRINFINDINGHSNANDGST") {
                     console.log("Error In Executing GST AND HSN Query");
                     alert("Something Went Wrong");
                  }
                  else if (Data[0].FLAG == 'ERRFINDINGSUBCATID') {
                     console.log("Error While Finding Subcat id");
                     alert("Something Went Wrong");
                  }
                  else {
                     console.log('Other FLAG Recived');
                     alert('Something Went Wrong');
                  }
               },
               error: function (Data) {
                  console.log('Error In   getHSNandGSTFromSubcategory.php   Ajax Call');
                  alert("Something Went Wrong");
               }
            });
         }

      }
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

</html>