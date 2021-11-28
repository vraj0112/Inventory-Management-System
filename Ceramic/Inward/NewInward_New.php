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
      
   }
   </style>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
   <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
   <script>
      x = 1;
      pcnt = 0;
      tbill = 0; tgst = 0; ttracost = 0; tpaid = 0; trem = 0;
      function as() {
         console.log("after");
         console.log(x);
         document.getElementById("count").value = x;
         document.getElementById("count2").value = pcnt;
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
         if(document.getElementById('bill').checked)
         {
         document.getElementById('cgst').value = cgst;
         document.getElementById('sgst').value = sgst;

         document.getElementById('tp').value = price + tax + tp - dis;
         }
         else
         {
           document.getElementById('cgst').value = 0;
         document.getElementById('sgst').value = 0; 

         document.getElementById('tp').value = price + tp - dis;
         }



      }
      function calc() {
         console.log("asdf");
         var bp = parseInt(document.getElementById('mbasep').value);
         var qty = parseInt(document.getElementById('mqu').value);
         var gst = parseInt(document.getElementById('mgst').value);
         // var sgst = parseInt(document.getElementById('sgst').value);
         var dis = parseInt(document.getElementById('mdisc').value);
         var tp = parseInt(document.getElementById('mtc').value);


         var price = bp * qty;
         var cgst = price * (gst / 2) / 100;
         var sgst = price * (gst / 2) / 100;
         var tax = cgst + sgst;
         if(document.getElementById('bill').checked)
         {
         document.getElementById('mcgst').value = cgst;
         document.getElementById('msgst').value = sgst;
         }
         else
         {
            document.getElementById('cgst').value = 0;
         document.getElementById('sgst').value = 0; 
         }
         document.getElementById('mtp').value = price + tax + tp - dis;



      }



      function calextra(){
         var c = parseInt(document.getElementById('extraCost').value);
         var b = parseInt(document.getElementById('totalbill').value);
         document.getElementById('totalbill').value=b+c;
      }





      function SomeDeleteRowFunction(o,y) {

         var a = parseInt(document.getElementById('tp_'+y).value);
         var b = parseInt(document.getElementById('sgst_'+y).value);
         var c = parseInt(document.getElementById('cgst_'+y).value);
         var d = parseInt(document.getElementById('thost_'+y).value);
           
         var s = parseInt(document.getElementById('totalbill').value) - a;
         tbill = s;
         var r = parseInt(document.getElementById('totalcost').value) - d;
         ttracost = r;
         var t = parseInt(document.getElementById('totalgst').value) - (b+c);
         tgst = t;
         document.getElementById('totalbill').value=s;
         document.getElementById('totalcost').value=r;
         document.getElementById('totalgst').value=t;
         if(s<0)
         {
            document.getElementById('totalbill').value=0;
            tbill = 0;
         }
         if(r<0)
         {
            document.getElementById('totalcost').value=0;
            ttracost = 0;
         }
         if(t<0)
         {
            document.getElementById('totalgst').value=0;
            tgst = 0;
         }
         var p = o.parentNode.parentNode;
         console.log("before delete: ");
         console.log(x);
         p.parentNode.removeChild(p);
         pcnt = pcnt - 1;
         if(pcnt == 0)
         {
            document.getElementById('totalgst').value=0;
            ttracost = 0;
            document.getElementById('totalcost').value=0;
            tgst = 0;
            document.getElementById('totalbill').value=0;
            tbill = 0;
         }
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
            document.getElementById("button").innerHTML = "<select id='vname' name='vname' class='form-select col-md-4'><option selected>Select Vendor</option></select>";
         }
         else if (radio.id === "nv") {
            window.location.href = '../Vendor/NewVendor.php';
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

<body onload="alert1();">
   <div class="container-fluid col-lg-12">
      <form name="inwardform" id="inwardform" method="POST">
         <div class="row">
            <div class="col-md-12">
               <div class="card card-primary">
                  <div class="card-header" style="background-color: #2B60DE">
                     <h3 class="card-title" style="color: white" align="center">New Inward</h3>
                  </div>
                  <div class="card-body">
                     <div class="row g-4">
                        <div class="form-group col-md-1">
                           <label class="form-label">Date</label>
<!--                            <input type="date" name="dop" id="dop" class="form-control"> -->
                        </div>
                        <div class="form-group col-md-2">
                           <input type="date" name="dop" id="dop" class="form-control">
                        </div>
                        <div class="form-group col-md-8">
                           <label class="form-label">Vendor :</label>
                           <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="nv" id="nv" value="nv"
                                 onchange="checkRadio(this)">
                              <label class="form-check-label" for="inlineRadio1">New Vendor</label>
                           </div>
                           <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="nv" id="ev" value="ev"
                                 onchange="checkRadio(this)">
                              <label class="form-check-label" for="inlineRadio2">Existing Vendor</label>
                              <div id="button" class="form-check-inline"></div>
                           </div>
                           <label class="form-label" style="margin-left: 100px;">Stock Type: </label>
                           <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="bill" id="bill" value="bill"
                                 onchange="checkRadio(this)">
                              <label class="form-check-label" for="inlineRadio1">Billing</label>
                           </div>
                           <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="bill" id="other" value="other"
                                 onchange="checkRadio(this)">
                              <label class="form-check-label" for="inlineRadio1">Other</label>
                           </div>

                        </div>
<!--                         <div class="form-group col-md-6">
                           
                        </div> --><hr>
                        
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
                           <select id="subcategories" class="form-select">
                              <option value='-1'>Select</option>
                           </select>

                        </div>
                        <div class="form-group col-md-1">
                           <label class="form-label">HSN Code: </label>
                           <input type="Text" name="HSN" class="form-control" id='hsn' disabled>
                        </div>
                        <div class="form-group col-md-1">
                           <label class="form-label">GST %: </label>
                           <input type="text" name="gst" class="form-control" id="gst" disabled>
                        </div>
                        <div class="form-group col-md-2">
                           <label class="form-label">Brand Name: </label>
                           <select id="com" class="form-select resetsearchparam class-brand">
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
                              <option value="KG">KG</option>
                              <option value="PIECE">Peice</option>
                              <option value="BOX">Box</option>
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
                           <input type="number" name="cgst" class="form-control" id="cgst" disabled="">
                           <!-- <select class="form-select" id="cgst" onchange="calp()">
                                 <option value="5">5</option>
                                 <option value="12">12</option>
                                 <option value="18">18</option>
                                 <option value="28">28</option>
                                 </select> -->
                        </div>
                        <div class="form-group col-md-2">
                           <label class="form-label">SGST: </label>
                           <input type="number" name="sgst" class="form-control" id="sgst" disabled="">
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
                           <input type="number" name="tp" class="form-control" id="tp" onfocus="calp()" disabled="">
                        </div>
                        <div class="col-12">
                           <input type="Button" value="Add" id="add_data" class="btn btn-primary">
                           <input type="reset" value="Reset" id="reset" class="btn btn-primary">
                           <input type="button" value="Close" name="close" id="close" class="btn btn-primary" onclick="location.href = '../admin.php';">

                           <input type="hidden" id="count" name="count">
                           <input type="hidden" id="count2" name="count2">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-12">
               <div class="card card-primary" style="overflow-x:auto;">
                  <table class="table" id="data_table">
                     <thead>
                        <tr valign="middle">
                           <th style="width: 100px;">Product Type</th>
                           <th>Brand Name</th>
                           <th>Color</th>
                           <th>Grade</th>
                           <th>code No.</th>
                           <th>Packing Unit</th>
                           <th>QtyPerUnit</th>
                           <th>Dimension</th>
                           <th>Batch No</th>
                           <th>Base Price</th>
                           <th>CGST</th>
                           <th>SGST</th>
                           <th>gst</th> 
                           <th>Discount</th>
                           <th>Qty</th>
                           <th>Transport Cost</th>
                           <th>Total Price</th>
                           <th>Update</th>
                        </tr>
                     </thead>
                     <tbody style="height: 100px;overflow-y: auto;overflow-x: hidden;">
                     </tbody>
                  </table>
                  <div class="col-12">
                     <input type="Button" value="Add Other Charge" id="addOtherCharge" class="btn btn-success"
                        style="margin-left: 30px;margin-bottom: 10px;">
                     <!-- <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" style="margin-left: 20px;"> -->
                     <!-- <label class="form-check-label" for="flexCheckDefault" style="margin-left: 10px;">Add Other Charges</label> -->
                  </div>
                  <!-- </form> -->
                  <div id="ExtraCost">
                     
                  </div>
                  <div class="card-body">
                     
                     <div class="grid1">
                        <div style="grid-column-start: 1;
                              grid-column-end: 4;">
                              <div class="form-group col-md-12">
                        <label class="form-label">Payment detail :</label>
                        <div class="form-check form-check-inline">
                           <input class="form-check-input" type="radio" name="cash" id="cash" value="cash"
                              onchange="checkRadio(this)">
                           <label class="form-check-label" for="inlineRadio3">Cash</label>
                        </div>
                        <div class="form-check form-check-inline">
                           <input class="form-check-input" type="radio" name="cash" id="credit" value="credit"
                              onchange="checkRadio(this)">
                           <label class="form-check-label" for="inlineRadio4">Credit</label>
                        </div>
                     </div>
                     <div class="form-group col-md-12">
                        <div id="rb1">
                        </div>
                     </div>
                     <div class="form-group col-md-2">
                        <div id="rb2">
                        </div>
                     </div>
                     <div class="form-group col-md-9"></div>
                     <div class="form-group col-md-2">
                        <label class="form-label">Remaining Payment: </label>
                        <input type="text" name="rp" class="form-control" id="rp" onfocus="calrem()">
                     </div>
                           <div class="form-group col-md-3">
                              <label class="form-label">Notes: </label>
                              <input type="text" name="n" class="form-control" id="n">
                           </div>
                           <div class="form-group col-md-3">
                              <label class="form-label">Upload Bill: </label>
                              <input type="file" name="uploadBill" class="form-control" id="uploadBill">
                           </div>
                        </div>
                        <div style="grid-column-start: 4;
                              grid-column-end: 5;">
                           <p class="col-md-6">Total Bill: <input type="number" name="totalbill" class="form-control"
                                 id="totalbill" readonly></span></p>
                           <p class="col-md-6">Total GST: <input type="number" name="totalgst" class="form-control"
                                 id="totalgst" readonly></p>
                           <p class="col-md-6">Total Transport Cost: <input type="number" name="totalcost"
                                 class="form-control" id="totalcost" readonly></p>
                           <p class="col-md-6">Total Paid: <input type="number" name="totalpaid" class="form-control"
                                 id="totalpaid" readonly></p>
                           <p class="col-md-6">Total Pending: <input type="number" name="totalpending"
                                 class="form-control" id="totalpending" readonly></p>
                        </div>
                     </div>
                  </div>
                  <div class="col-12">
                     <center><input type="Submit" value="Save" id="save" name="submit" class="btn btn-success"
                           onclick="return as();">
                        <input type="Button" value="Close" id="close" class="btn btn-success"
                           onclick="window.location.href = '../admin.php'">
                     </center>
                  </div>
                  <br>
               </div>
            </div>
         </div>
      </form>
   </div>
   <div class="modal fade" id="EpicModal" tabindex="-1" aria-labelledby="EpicModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="EpicModalLabel">Edit Inward Item</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <form>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="card card-primary">

                           <div class="card-body">
                              <div class="row g-3">

                                 
                                 <div class="form-group col-md-2">
                                    <label class="form-label">Product Type: </label>
                                    <input type="text" id="mtype" name="mtype" class="form-control">
                                 </div>
                                
                                 
                                 <div class="form-group col-md-2">
                                    <label class="form-label">Brand Name: </label>
                                    <input id="mcom" name="mbrand" class="form-control" type="text">
                                       
                                 </div>
                                 <div class="form-group col-md-2">
                                    <label class="form-label">Color / Type / Series: </label>
                                    <input type="text" name="mcolor" id="mtoc" class="form-control">
                                 </div>
                                 <div class="form-group col-md-2">
                                    <label class="form-label">Grade: </label>
                                    <input type="text" name="mgrade" id="mgrade" class="form-control">
                                 </div>
                                 <div class="form-group col-md-2">
                                    <label class="form-label">Code No. / Model No. / Design No.: </label>
                                    <input type="text" name="mcmd" class="form-control" id="mcmd">
                                 </div>
                                 
                                 <div class="form-group col-md-2">
                                    <label class="form-label">Unit of Purchase: </label>
                                    <input type="text" name="munit1" class="form-control" id="munit">
                                 </div>
                                 <div class="form-group col-md-2">
                                    <label class="form-label">Taxable GST %: </label>
                                    <input type="text" name="mgst" class="form-control" id="mgst">
                                 </div>
                                 <div class="form-group col-md-2">
                                    <label class="form-label">Qty Per Unit: </label>
                                    <input type="text" name="msize" class="form-control" id="mwp">
                                 </div>
                                 <div class="form-group col-md-2">
                                    <label class="form-label">Dimension: </label>
                                    <input type="text" name="mdie" class="form-control" id="mdie">
                                 </div>
                                 <div class="form-group col-md-2">
                                    <label class="form-label">Batch No.: </label>
                                    <input type="text" name="mbatch" class="form-control" id="mbn">
                                 </div>
                                 <div class="form-group col-md-2">
                                    <label class="form-label">Base Price: </label>
                                    <input type="number" name="mbprice" class="form-control" id="mbasep"
                                       onchange="calp()">
                                 </div>
                                 <div class="form-group col-md-2">
                                    <label class="form-label">Quantity: </label>
                                    <input type="number" name="mqty" class="form-control" id="mqu" onchange="calc()">
                                 </div> 
                                 <div class="form-group col-md-2">
                                    <label class="form-label">Discount: </label>
                                    <input type="number" name="mdisc" class="form-control" id="mdisc" onchange="calc()">
                                 </div>
                                 <div class="form-group col-md-2">
                                    <label class="form-label">CGST: </label>
                                    <input type="number" name="mcgst" class="form-control" id="mcgst" readonly>
                                    <!-- <select class="form-select" id="cgst" onchange="calp()">
                                 <option value="5">5</option>
                                 <option value="12">12</option>
                                 <option value="18">18</option>
                                 <option value="28">28</option>
                                 </select> -->
                                 </div>
                                 <div class="form-group col-md-2">
                                    <label class="form-label">SGST: </label>
                                    <input type="number" name="msgst" class="form-control" id="msgst" readonly>
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
                                    <label class="form-label">Transpotation Cost: </label>
                                    <input type="number" name="mtcost" class="form-control" id="mtc" onchange="calc()">
                                 </div>
                                 <div class="form-group col-md-2">
                                    <label class="form-label">Total Price: </label>
                                    <input type="number" name="mtp" class="form-control" id="mtp" onfocus="calc()" readonly>
                                 </div>
                                 <br>
                                 <div class="col-12">

                                    <input type="hidden" name="xyz">
                                    <input type="Button" value="Update" id="update_data" class="btn btn-primary update">
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

               </form>
            </div>
         </div>
      </div>
   </div>
</body>
<script type="text/javascript">

   var totalBill = 0;
   var gst = 0;
   var r = 0;
   var trcost = 0;

   $(function () {

      

      $('#addOtherCharge').click(function () {
         $('#ExtraCost').append(
            '<div class="row g-3">' +
            '<div class="form-group col-md-1" style="margin-left: 30px; margin-top: 30px;" id="AddChargesRs.">' +
            '<input type="text" name="extraCost" class="form-control col-md-2" id="extraCost" placeholder="Extra Cost" onchange="calextra()">' +
            '</div>' +
            '<div class="form-group col-md-4" style="margin-top: 30px;" id="AddChargesDes">' +
            '<input type="text" name="extraCostDes" class="form-control" id="extraCostDes" placeholder="Description of Extra Cost">' +
            '</div>' +
            '<div class="form-group col-md-1" style="margin-top: 35px;height:0px;" id="CancelField" >' +
            '<button type="button" class="btn-close" id="closeButton" onclick="cancelField()"></button>' +
            '</div>' +
            '<div></div>' +
            '</div>'
         );
         $('#addOtherCharge').attr("disabled", true);
      });

      $('#add_data').click(function () {

         var name = $('#category_name').val();
         var type = $('#subcategories').val();
         var HSN = $('#hsn').val();
         var com = $('#com').val();
         var unit = $('#unit').val();
         var size = $('#wp').val();
         var grade = $('#grade').val();
         var code = $('#cmd').val();
         var gst = $('#gst').val();
         var cgst = $('#cgst').val();
         var sgst = $('#sgst').val();
         var datep = $('#dop').val();
         var vname = $('#vname').val();
         var qty = $('#qu').val();
         var disc = $('#disc').val();
         var tcost = $('#tc').val();
         var tp = $('#tp').val();
         var batchno = $('#bn').val();
         var bprice = $('#basep').val();
         var die = $('#die').val();
         var color_type = $('#toc').val();



         // document.getElementById("tbill").innerHTML=totalBill;
         //document.getElementById("tgst").innerHTML=gst;
         //document.getElementById("trem").innerHTML=r;
         //document.getElementById("ttcost").innerHTML=trcost;
         if (name == "Other") {
            name = $('#newname').val();
            type = $('#newtype').val();
            com = $('#newcom').val();
         }

         if (name != "Select Product" && com!="-1" && type != "-1" && HSN != "" && unit != "" && size != "" && grade != "" && code != "" && cgst != "" && sgst != "") {

            $('#data_table tbody:last-child').append(
               '<tr>' +
               '<td>' + '<input readonly id="type_' + x + '" name="type_' + x + '" style="border-width:0px;border:none;width:80px" size="12" type=text value="' + type + '"></td>' +
               '<td>' + '<input readonly id="com_' + x + '" name="com_' + x + '" style="border-width:0px;border:none;width:80px" size="12" type=text value="' + com + '"></td>' +
               '<td>' + '<input readonly id="color_' + x + '" name="color_' + x + '" style="border-width:0px;border:none;width:50px" size="7" type=text value="' + color_type + '"></td>' +
               '<td>' + '<input readonly id="grade_' + x + '" name="grade_' + x + '" style="border-width:0px;border:none;" size="5" type=text value="' + grade + '"></td>' +
               '<td>' + '<input readonly id="code_' + x + '" name="code_' + x + '" style="border-width:0px;border:none;" size="7" type=text value="' + code + '"></td>' +
               '<td>' + '<input readonly id="unit_' + x + '" name="unit_' + x + '" style="border-width:0px;border:none;width:50px;" size="5" type=text value="' + unit + '"></td>' +
               '<td>' + '<input readonly id="size_' + x + '" name="size_' + x + '" style="border-width:0px;border:none;width:50px" size="7" type=text value="' + size + '"></td>' +
               '<td>' + '<input readonly id="die_' + x + '" name="die_' + x + '" style="border-width:0px;border:none;" size="7" type=text value="' + die + '"></td>' +
               '<td>' + '<input readonly id="batch_' + x + '" name="batch_' + x + '" style="border-width:0px;border:none;" size="7" type=text value="' + batchno + '"></td>' +
               '<td>' + '<input readonly id="bprice_' + x + '" name="bprice_' + x + '" style="border-width:0px;border:none;width:50px" size="7" type=text value="' + bprice + '"></td>' +
               '<td>' + '<input readonly id="cgst_' + x + '" name="cgst_' + x + '" style="border-width:0px;border:none;width:40px;" size="4" type=text value="' + cgst + '"></td>' +
               '<td>' + '<input readonly id="sgst_' + x + '" name="sgst_' + x + '" style="border-width:0px;border:none;width:40px;" size="4" type=text value="' + sgst + '"></td>' +
               '<td>' + '<input readonly id="gst_' + x + '" name="gst_' + x + '" style="border-width:0px;border:none;width:30px;" size="3" type=text value="' + gst + '"></td>' +
               '<td>' + '<input readonly id="disc_' + x + '" name="disc_' + x + '" style="border-width:0px;border:none;width:30px;" size="5" type=text value="' + disc + '"></td>' +
               '<td>' + '<input readonly id="qty_' + x + '" name="qty_' + x + '" style="border-width:0px;border:none;width:50px;" size="5" type=text value="' + qty + '"></td>' +
               '<td>' + '<input readonly id="thost_' + x + '" name="tcost_' + x + '" style="border-width:0px;border:none;" size="4" type=text value="' + tcost + '"></td>' +
               '<td>' + '<input readonly id="tp_' + x + '" name="tp_' + x + '" style="border-width:0px;border:none;" size="5" type=text value="' + tp + '"></td>' +
               '<td><button type="button" id="edit_' + x + '" class="btn btn-link btn-sm edit">Edit</button><input type="button" class="btn btn-link btn-sm" value="Delete" onclick="SomeDeleteRowFunction(this,'+ x +')"></td>' +
               '</tr>'
            );
            x = x + 1;
            pcnt = pcnt + 1;
            tbill = parseInt(tbill) + parseInt(tp);
            tgst = parseInt(tgst) + parseInt(cgst) + parseInt(sgst);
            ttracost = parseInt(ttracost) + parseInt(tcost);
            tpaid = parseInt(tpaid) + parseInt(tp);
            trem = parseInt(trem) + parseInt(tp);
            $("[name='totalbill']").val(tbill);
            $("[name='totalgst']").val(tgst);
            $("[name='totalcost']").val(ttracost);

         }
         else {
            alert("All fields are required");
         }


      });
      $(document).on('click', '.edit', function () {


         var id = this.id;
         var split_id = id.split('_');
         var num = split_id[1];
         var datep1 = $("#datep_" + num).val();
         var vname1 = $("#vname_" + num).val();
         var name1 = $("#name_" + num).val();
         var type1 = $("#type_" + num).val();
         var hsn1 = $("#hsn_" + num).val();
         var com1 = $("#com_" + num).val();
         var color1 = $("#color_" + num).val();
         var grade1 = $("#grade_" + num).val();
         var code1 = $("#code_" + num).val();
         var unit1 = $("#unit_" + num).val();
         var size1 = $("#size_" + num).val();
         var batch1 = $("#batch_" + num).val();
         var bprice1 = $("#bprice_" + num).val();
         var gst1 = $('#gst_' + num).val();
         var cgst1 = $("#cgst_" + num).val();
         var sgst1 = $("#sgst_" + num).val();
         var disc1 = $("#disc_" + num).val();
         var qty1 = $("#qty_" + num).val();
         var tcost1 = $("#thost_" + num).val();
         var tp1 = $("#tp_"+ num).val();
         var die = $("#die_" + num).val();
         console.log(tp1);
         $("[name='mname']").val(name1);
         $("[name='mtype']").val(type1);
         $("[name='mHSN']").val(hsn1);
         $("[name='mbrand']").val(com1);
         $("[name='munit1']").val(unit1);
         $("[name='msize']").val(size1);
         $("[name='mcolor']").val(color1);
         $("[name='mgrade']").val(grade1);
         $("[name='mcmd']").val(code1);
         $("[name='mgst']").val(gst1);
         $("[name='xyz']").val(num);
         $("[name='mbatch']").val(batch1);
         $("[name='mbprice']").val(bprice1);
         $("[name='mcgst']").val(cgst1);
         $("[name='msgst']").val(sgst1);
         $("[name='mdisc']").val(disc1);
         $("[name='mqty']").val(qty1);
         $("[name='mcode']").val(code1);
         $("[name='mtcost']").val(tcost1);
         $("[name='mtp']").val(tp1);
         $("[name='mdie']").val(die);
         /*$("[name='Address1']").val(data.Address1);
         $("[name='Address2']").val(data.Address2);
         $("[name='State']").val(data.State);
         $("[name='City']").val(data.City);
         $("[name='Person_Name']").val(data.ContactPersonName);
         $("[name='Mobile_no']").val(data.Mobile);
         $("[name='Email']").val(data.EmailID);
         $("[name='Sysid']").val(data.Sysid);
         document.getElementById("submit").value = "Update";
         console.log(document.getElementById("Sysid").value);*/
         $('#EpicModal').modal('show');

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
      $('#mpname').on('change', function () {
         let cat = $('#mpname').val();
         //console.log(cat);
         $("#mtype").empty();
         $("#mtype").append(new Option('Select', '-1'));
         if (cat != '-1') {
            //console.log('Hello');
            myobj = { scn: cat };

            $.ajax({
               type: "POST",
               url: "../getSubCategories2.php",
               data: JSON.stringify(myobj),
               dataType: "json",
               success: function (Data) {
                  //console.log(Data);
                  if (Data[0].FLAG == 'OK') {
                     let x = Data;
                     let scn;
                     let n = x.length;
                     for (let i = 1; i < n; i++) {
                        scn = Data[i].scn;
                        $("#mtype").append(new Option(scn, scn))
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
            $("#mtype").empty();
            $("#mtype").append(new Option('Select', '-1'));
         }

      });
      
      $('#ev').on('click', function () {
         console.log("asdf");
         $("#vname").empty();
         $("#vname").append(new Option('Select', '-1'));

            myobj = { scn: 0 };

            $.ajax({
               type: "POST",
               url: "./getvendor.php",
               data: JSON.stringify(myobj),
               dataType: "json",
               success: function (Data) {
                  //console.log(Data);
                  if (Data[0].FLAG == 'OK') {
                     let x = Data;
                     let scn;
                     let n = x.length;
                     for (let i = 1; i < n; i++) {
                        scn = Data[i].scn;
                        $("#vname").append(new Option(scn, Data[i].sci))
                     }
                  }
                  else {
                     alert('Something Went Wrong');
                     location.reload(true);
                  }
               }
            });
         
         

      });

      $(document).on('click', '.update', function () {


         var xval = $("[name='xyz']").val();
         var pname2 = $("[name='mname']").val();
         var type2 = $("[name='mtype']").val();
         var hsn2 = $("[name='mHSN']").val();
         var brand2 = $("[name='mbrand']").val();
         var unit2 = $("[name='munit1']").val();
         var size2 = $("[name='msize']").val();
         var color2 = $("[name='mcolor']").val();
         var grade2 = $("[name='mgrade']").val();
         var cmd2 = $("[name='mcmd']").val();
         var cgst2 = $("[name='mcgst']").val();
         var sgst2 = $("[name='msgst']").val();
         var disc2 = $("[name='mdisc']").val();
         var qty2 = $("[name='mqty']").val();
         var batch2 = $("[name='mbatch']").val();
         var basep2 = $("[name='mbprice']").val();
         var tcost2 = $("[name='mtcost']").val();
         var tp2 = $("[name='mtp']").val();
         var die2 = $("[name='mdie']").val();
         if (pname2 == "Other") {
            pname2 = $('#newname').val();
            type2 = $('#newtype').val();
            brand2 = $('#newcom').val();
         }
         console.log(tcost2);
         $("#type_" + xval).val(type2);
         $("#com_" + xval).val(brand2);
         $("#unit_" + xval).val(unit2);
         $("#size_" + xval).val(size2);
         $("#color_" + xval).val(color2);
         $("#grade_" + xval).val(grade2);
         $("#code_" + xval).val(cmd2);
         $("#cgst_" + xval).val(cgst2);
         $("#sgst_" + xval).val(sgst2);
         $("#batch_" + xval).val(batch2);
         $("#bprice_" + xval).val(basep2);
         $("#disc_" + xval).val(disc2);
         $("#qty_" + xval).val(qty2);
         $("#thost_" + xval).val(tcost2);
         $("#tp_" + xval).val(tp2);
         $("#die_"+xval).val(die2);
         /*$("[name='Address1']").val(data.Address1);
         $("[name='Address2']").val(data.Address2);
         $("[name='State']").val(data.State);
         $("[name='City']").val(data.City);
         $("[name='Person_Name']").val(data.ContactPersonName);
         $("[name='Mobile_no']").val(data.Mobile);
         $("[name='Email']").val(data.EmailID);
         $("[name='Sysid']").val(data.Sysid);
         document.getElementById("submit").value = "Update";
         console.log(document.getElementById("Sysid").value);*/

         $('#EpicModal').modal('toggle');

      });

      $('#inwardform').submit(function (e) {
         e.preventDefault();
         var formData = new FormData(this);
         $.ajax({
            url: "DBoperationInward.php?log1=1",
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
                        window.open("NewInward_New.php", "_self");
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