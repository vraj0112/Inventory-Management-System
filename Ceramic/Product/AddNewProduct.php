<?php
    include('./config.php');
?>
<!DOCTYPE html>
<html>

<head>
   <title>Add Product</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
   <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/table-to-json@1.0.0/lib/jquery.tabletojson.min.js"
      integrity="sha256-H8xrCe0tZFi/C2CgxkmiGksqVaxhW0PFcUKZJZo1yNU=" crossorigin="anonymous"></script>

   <script src="https://cdn.jsdelivr.net/npm/table-to-json@1.0.0/lib/jquery.tabletojson.min.js"
      integrity="sha256-H8xrCe0tZFi/C2CgxkmiGksqVaxhW0PFcUKZJZo1yNU=" crossorigin="anonymous"></script>
   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
   <style>
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
                  <h3 class="card-title" style="color: white" align="center">Add Product</h3>
               </div>
               <div class="card-body">
                  <form class="g-3" id='dataform' name="dataform">

                     <div class="row mt-2">
                        <div class="col-md-2">
                           <label class="form-label">Product Type: </label>
                        </div>
                        <div class="col-md-2">
                           <select id="category_name" class="form-select col-md-12">
                              <option value='-1' cid="-1" selected>Select Product</option>
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
                                    echo "<script>swal('Something Went Wrong', '', 'error');</script>";
                                    location.reload(true);
                                 }
                                 ?>
                           </select>
                        </div>

                        <div class="col-md-2">
                           <label class="form-label">Product Sub Type: </label>
                        </div>
                        <div class="col-md-2">
                           <select id="subcategories" class="form-select">
                              <option value='-1'>Select</option>
                           </select>
                        </div>

                        <div class="col-md-2">
                           <label class="form-label">Brand Name: </label>
                        </div>

                        <div class="col-md-2">
                           <!-- <input type="text" name='getBrandName' class="form-control" id='getBrandName'> -->
                           <select class="form-select" name="" id="selectbrand">
                              <option value="-1">Select</option>
                           </select>
                        </div>

                     </div>

                     <!-- <div class="form-group col-md-4">
                        <label class="form-label">HSN Code: </label>
                        <input type="number" name="HSN" class="form-control" id='hsn'
                           onKeyPress="if(this.value.length==8) return false;">
                     </div> -->

                     <div class="row mt-2">
                        <div class="col-md-2">
                           <label class="form-label">Grade: </label>
                        </div>

                        <div class="col-md-2">
                           <!-- <input type="text" name="grade" class="form-control" id="getGrade"> -->
                           <select class="form-select" name="" id="selectgrade">
                              <option value="-1">Select</option>
                           </select>
                        </div>

                        <div class="col-md-2">
                           <label class="form-label">Product Type/Color : </label>
                        </div>

                        <div class="col-md-2">
                           <input type="text" name='getProductTypeColor' class="form-control" id="getProductTypeColor">
                        </div>

                        <div class="col-md-2">
                           <label class="form-label">Qty/Unit</label>
                        </div>

                        <div class="col-md-2">
                           <input type="number" name="unit" class="form-control" id="getQtyPerUnit">
                        </div>
                     </div>

                     <div class="row mt-2">
                        <div class="col-md-2">
                           <label class='form-label' for="">Size Or Dimension : </label>
                        </div>
                        <div class="col-md-2">
                           <label class='form-check-label' for="sizeRadio">
                              <input class='form-check-input sizeordimension' id='sizeRadio' name='sizeordimension'
                              type="radio" value='size' checked>
                           Size</label>

                           <label class='form-check-label' for="dimensionRadio">
                              <input class='form-check-input sizeordimension' id='dimensionRadio' name='sizeordimension'
                              type="radio" value='dimension'>
                           Dimension</label>
                        </div>

                        <!-- <div class="col-md-1"></div> -->

                        <div class="col-md-2">
                           <label class="form-label">Dimension : </label>
                        </div>

                        <div class="col-md-1">
                           <input type="number" id='getDimensionFirst' name="SizeDimension"
                              class="form-control getDimension" disabled>
                        </div>

                        <div class="col-md-1">

                           <select class='form-select getDimension getDimensionSelect' name=""
                              id="getDimensionUnitFirst" disabled>
                              <option value="-1">Select</option>
                              <option value="mm">mm</option>
                              <option value="cm">cm</option>
                              <option value="m">m</option>
                              <option value="inch">inch</option>
                              <option value="feet">feet</option>
                           </select>
                        </div>

                        <div class="col-md-1">
                           <center><label for="">X</label></center>
                        </div>

                        <div class="col-md-1">
                           <input type="number" id='getDimensionSecond' name="SizeDimension"
                              class="form-control getDimension" disabled>
                        </div>

                        <div class="col-md-1">
                           <select class='form-select getDimension getDimensionSelect' name=""
                              id="getDimensionUnitSecond" disabled>
                              <option value="-1">Select</option>
                              <option value="mm">mm</option>
                              <option value="cm">cm</option>
                              <option value="m">m</option>
                              <option value="inch">inch</option>
                              <option value="feet">feet</option>
                           </select>
                        </div>




                     </div>

                     <div class="row mt-2">
                        <div class="col-md-2">
                           <label class="form-label">Packing Unit : </label>
                        </div>

                        <div class="col-md-2">

                           <select class='form-select' name="" id="getPackingUnit">
                              <option value="-1">Select</option>
                              <option value="KG">KG</option>
                              <option value="PIECE">PEICE</option>
                              <option value="BOX">BOX</option>
                           </select>
                        </div>

                        <!-- <div class="col-md-1"></div> -->
                        <div class="col-md-3">
                           <label class="form-label mt-1">Code No. / Model No. / Design No.: </label>
                        </div>
                        <div class="col-md-4">
                           <input type="text" name="cmd" class="form-control" id="getCode">
                        </div>
                     </div>

                     <br>

                     <div class="col-12">
                        <input type="Button" value="Add" id="add_data" class="btn btn-primary">
                        <input type="reset" value="Reset" id="reset" class="btn btn-primary">
                        <input type="button" value="Save" id="save" class="btn btn-primary" disabled>
                     </div>

                  </form>

               </div>
            </div>
         </div>
         <br>
         <div class="row">
            <div class="col-md-12">
               <div class="card card-primary" style="overflow-x:auto;">
                  <table class="table" id="data_table">
                     <thead>
                        <th>Type</th>
                        <th>Sub<br>Type</th>
                        <!-- <th>HSN<br>Code</th> -->
                        <th>Type/<br>Color</th>
                        <th>Brand</th>
                        <th>Dimension</th>
                        <th>Qty</th>
                        <th>Packing<br>Unit</th>
                        <th>Grade</th>
                        <th>Code</th>
                        <th hidden>BrandId</th>
                        <th hidden>GradeId</th>
                        <th hidden>SubCategoryId</th>
                        <!-- <th>GST</th> -->
                        <th>Action</th>
                     </thead>
                     <tbody id='tblbody'>
                        <!-- <tr>
                        <td>Ceramic</td>
                        <td>Floor Tiles</td>
                        <td>5</td>
                        <td>5</td>
                        <td>5</td>
                        <td>N/A</td>
                        <td>5</td>
                        <td>kg</td>
                        <td>5</td>
                        <td>5</td>
                        <td>18</td>
                        <td hidden>18</td>
                        <td hidden>18</td>
                        <td hidden>18</td>
                        <td><input type="button" class="btn btn-primary editbtn" value="Edit"> <input type="button"
                              class="btn btn-primary" value="Delete" onclick="SomeDeleteRowFunction(this)"></center>
                        </td>
                     </tr>
                     <tr>
                        <td>Ceramic</td>
                        <td>Floor Tiles</td>
                        <td>45454545</td>
                        <td>Grey</td>
                        <td>J.K.</td>
                        <td>2 feet X 2 feet</td>
                        <td>12</td>
                        <td>Piece</td>
                        <td>A</td>
                        <td>AC 2001</td>
                        <td>5</td>
                        <td hidden>5</td>
                        <td hidden>5</td>
                        <td hidden>5</td>
                        <td><input type="button" class="btn btn-primary editbtn" value="Edit"> <input type="button"
                              class="btn btn-primary" value="Delete" onclick="SomeDeleteRowFunction(this)"></center>
                        </td>
                     </tr>  -->
                     </tbody>
                  </table>
                  <div class="col-12">
                     <!-- <form action="../addProducts.php"> -->
                     <center><input type="submit" value="Submit" id="submit" class="btn btn-success"></center>
                     <!-- </form> -->
                  </div>
                  <!-- <link rel="stylesheet" href="../AddNewProductAjax/getSubcategoriesFromCatId.php"> -->
               </div>
            </div>
         </div>
      </div>

      </section>
</body>
<script type="text/javascript">
   $(function () {

      let rowref = null;



      $('#add_data').click(function () {

         var type = $('#category_name').val();
         var subtype = $('#subcategories').val();
         // var HSN = $('#hsn').val();
         var producttypeorcolor = $('#getProductTypeColor').val();
         var brandid = $('#selectbrand').val();
         var sizeordimension = "";
         var dimensionFirst = "";
         var dimensionSecond = "";
         var dimensionUnitFirst = "";
         var dimensionUnitSecond = "";
         var dimension = "";
         if ($("#sizeRadio").prop('checked') == true) {
            sizeordimension = $("#sizeRadio").val();
            dimension = "N/A";
         }
         else if ($('#dimensionRadio').prop('checked') == true) {
            sizeordimension = $("#dimensionRadio").val();
            dimensionFirst = $('#getDimensionFirst').val();
            dimensionSecond = $("#getDimensionSecond").val();
            dimensionUnitFirst = $("#getDimensionUnitFirst").val();
            dimensionUnitSecond = $("#getDimensionUnitSecond").val();
            dimension = dimensionFirst + " " + dimensionUnitFirst + " X " + dimensionSecond + " " + dimensionUnitSecond;
         }

         var qtyperunit = $('#getQtyPerUnit').val();
         var packingunit = $('#getPackingUnit').val();
         //qtyperunit = qtyperunit +" "+ packingunit;
         var gradeid = $('#selectgrade').val();
         var code = $('#getCode').val();


         if (type != -1 && subtype != -1 && producttypeorcolor != "" && brandid != -1 && ((sizeordimension == "size") || (sizeordimension == "dimension" && dimensionFirst != "" && dimensionSecond != "" && dimensionUnitFirst != -1 && dimensionUnitSecond != -1)) && qtyperunit != "" && packingunit != "-1" && gradeid != -1 && code != "") {

            var query =
            {
               type: type,
               subtype: subtype,
               //HSN: HSN,
               producttypeorcolor: producttypeorcolor,
               brandid: brandid,
               dimension: dimension,
               qtyperunit: qtyperunit,
               packingunit: packingunit,
               gradeid: gradeid,
               code: code,
            }

            console.log(query);

            $.ajax({
               type: "POST",
               url: "./AddNewProductAjax/checkForProductInsideDatabase.php",
               data: JSON.stringify(query),
               success: function (Data) {
                  console.log(Data);

                  if (Data == "0") {

                     console.log('Success');
                     $('#data_table tbody:last-child').append(
                        '<tr>' +
                        '<td>' + type + '</td>' +
                        '<td>' + $("#subcategories option:selected").html() + '</td>' +
                        // '<td>' + HSN + '</td>' +
                        '<td>' + producttypeorcolor + '</td>' +
                        '<td>' + $("#selectbrand option:selected").html() + '</td>' +
                        '<td>' + dimension + '</td>' +
                        '<td>' + qtyperunit + '</td>' +
                        '<td>' + packingunit + '</td>' +
                        '<td>' + $("#selectgrade option:selected").html() + '</td>' +
                        '<td>' + code + '</td>' +
                        '<td hidden>' + brandid + '</td>' +
                        '<td hidden>' + gradeid + '</td>' +
                        '<td hidden>' + subtype + '</td>' +
                        // '<td>' + gst + '</td>' +
                        '<td><input type="button" class="btn btn-primary editbtn" value="Edit"> <input type="button" class="btn btn-primary" value="Delete" onclick="SomeDeleteRowFunction(this)"></center></td>' +
                        '</tr>'
                     );
                  }
                  else if (Data == '1') {
                     console.log('Same Record Found In Database');
                     swal('Record Found In Database', '', 'info');
                  }
                  else if (Data == '-1') {
                     console.log('More Then One Record Found');
                     swal('Something Went Wrong', '', 'error');
                  }
                  else if (Data == "-2") {
                     console.log("Error In Executing Query");
                     swal('Something Went Wrong', '', 'error');
                  }
                  else {
                     console.log("Other Then Falg Recived");
                     swal('Something Went Wrong', '', 'error');
                  }


                  //var gototable = $("#data_table tbody:last-child").scrollIntoView();
                  //$(document).scrollToPosition($("#data_table tbody:last-child").position());
                  /*console.log('<tr>' +
                     '<td>' + type + '</td>' +
                     '<td>' + subtype + '</td>' +
                     '<td>' + HSN + '</td>' +
                     '<td>' + producttypeorcolor + '</td>' +
                     '<td>' + brandname + '</td>' +
                     '<td>' + dimension + '</td>' +
                     '<td>' + qtyperunit + '</td>' +
                     '<td>' + packingunit + '</td>' +
                     '<td>' + grade + '</td>' +
                     '<td>' + code + '</td>' +
                     '<td>' + gst + '</td>' +
                     '<td><input type="button" class="btn btn-primary editbtn" value="Edit"> <input type="button" class="btn btn-primary" value="Delete" onclick="SomeDeleteRowFunction(this)"></center></td>' +
                     '</tr>');*/
               }
            });
         }
         else {
            swal("All fields are required", '', 'warning');
         }

      });

      $('#category_name').on('change', function () {
         ResetSelectMenu($("#subcategories"));
         ResetSelectMenu($("#selectbrand"));
         ResetSelectMenu($("#selectgrade"));
         let cat = $('#category_name').val();

         if (cat != '-1') {
            //console.log('Hello');
            myobj = { scn: cat };

            $.ajax({
               type: "POST",
               url: "./AddNewProductAjax/getSubCategories2.php",
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
                        sci = Data[i].sci;
                        $("#subcategories").append(new Option(scn, sci))
                     }
                  }
                  else {
                     swal('Something Went Wrong', '', 'error');
                     location.reload(true);
                  }
               }
            });
         }
         else {
            //console.log('Uddhav');
            swal('Please Select Category', '', 'warning');
            $("#subcategories").empty();
            $("#subcategories").append(new Option('Select', '-1'));
         }

      });

      $("#subcategories").on('change', function () {
         ResetSelectMenu($("#selectbrand"));
         ResetSelectMenu($("#selectgrade"));

         if ($("#category_name").val() != "-1" && $("#subcategories").val() != "-1") {

            var subcategoryid = $("#subcategories").val();

            $.ajax({
               type: "POST",
               url: "./AddNewProductAjax/getBrandsFromSubcategory.php",
               data: { subcatid: subcategoryid },
               dataType: 'json',
               success: function (Data) {
                  console.log(Data);
                  if (Data[0].FLAG == "OKK") {
                     var n = Data.length;

                     for (var i = 1; i < n; i++) {
                        $("#selectbrand").append(new Option(Data[i].brandname, Data[i].brandid));
                        //$("#selectbrand").append('<option value='+Data[i].brandid+' showvalue='+Data[i].brandname+'>'+Data[i].brandname+'</option>');
                     }
                  }
                  else if (Data[0].FLAG == "RECORDNOTFOUND") {
                     console.log("No Brands Found For Selected Category And Subcategory");
                     swal("No Brands Found For Selected Category And Subcategory", '', 'info');
                  }
                  else if (Data[0].FLAG == 'ERRORINEXECUTINGQUERY') {
                     console.log("ERROR IN EXECUTING QUERY");
                     swal('Something Went Wrong', '', 'error');
                  }
                  else {
                     console.log('Other Then Flag');
                     swal('Something Went Wrong', '', 'error');
                  }
               },
               error: function (Data) {
                  console.log('Error In Ajax Call ' + Data);
                  swal('Something Went Wrong', '', 'error');
               }
            });

            if (subcategoryid != "-1") {
               $.ajax({
                  type: "POST",
                  url: "./AddNewProductAjax/getGradesFromSubcategory.php",
                  data: { subcatid: subcategoryid },
                  dataType: 'json',
                  success: function (Data) {
                     console.log(Data);
                     if (Data[0].FLAG == "OKK") {
                        var n = Data.length;

                        for (var i = 1; i < n; i++) {
                           $("#selectgrade").append(new Option(Data[i].gradetext, Data[i].gradeid));
                           //$("#selectgrade").append('<option value='+Data[i].gradeid+' showvalue='+Data[i].gradetext+'>'+Data[i].gradetext+'</option>');
                        }
                     }
                     else if (Data[0].FLAG == "RECORDNOTFOUND") {
                        console.log("No Grade Found For Selected Category And Subcategory");
                        swal("No Grade Found For Selected Category And Subcategory",'', 'info');
                     }
                     else if (Data[0].FLAG == 'ERRORINEXECUTINGQUERY') {
                        console.log("ERROR IN EXECUTING QUERY");
                        swal('Something Went Wrong', '', 'error');
                     }
                     else {
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
            else {
               swal("Please Select Category Or Subcategory", '', 'warning');
            }

         }
      });

      $(".sizeordimension").on('change', function () {

         //console.log($('#sizeRadio').prop('checked'));
         if ($('#sizeRadio').prop('checked')) {
            //console.log('SIZE');
            $(".getDimension").prop('disabled', true);
            $(".getDimension").val('');
            $(".getDimensionSelect").val('-1');
         }
         else if ($('#dimensionRadio').prop('checked')) {
            //console.log('Dimenson');
            $(".getDimension").prop('disabled', false);
         }
      });

      $("#submit").click(function () {

         var datatbl = $("#data_table").tableToJSON();
         console.log(datatbl);
         console.log(JSON.stringify(datatbl));

         $.ajax({
            type: "POST",
            url: "./AddNewProductAjax/addIntoProducts.php",
            data: JSON.stringify(datatbl),
            success: function (Data) {
               console.log(Data);

               if (Data == "1") {
                  swal("Succesfully Inserted", '', 'success').then(()=>{
                     location.reload(true);
                  });
               }
               else if (Data == "-1") {
                  console.log("Commit Fail");
                  swal('Something Went Wrong', '', 'error');
               }
               else if (Data == "-2") {
                  console.log("Error While Inserting Into Product Mst");
                  swal('Something Went Wrong', '', 'error');
               }
               else if (Data == "-3") {
                  console.log("Record All Ready Exista");
                  swal('Something Went Wrong', '', 'error');

               }
               else if (Data == "-4") {
                  console.log("More Then One Record Found");
                  swal('Something Went Wrong', '', 'error');
               }
               else {
                  console.log('Other Response Recived');
                  swal('Something Went Wrong', '', 'error');

               }
            },
            error: function (Data) {
               swal('Something Went Wrong', '', 'error');
            }
         });
      });

      $("tbody").on('click', '.editbtn', function () {

         let tr = $(this).parent().siblings();

         let obj = Array();

         for (let i = 0; i < 12; i++) {
            obj.push(tr.html());
            tr = tr.next();
         }

         $('#category_name').val(obj[0]);
         let cat = $('#category_name option:selected').attr('cid');

         $("#subcategories").empty();
         $("#subcategories").append(new Option('Select', '-1'));


         if (cat != '-1') {
            $.ajax({
               type: "POST",
               url: "./AddNewProductAjax/getSubcategoriesFromCatId.php",
               data: { catid: cat },
               dataType: "json",
               async: false,
               success: function (Data) {

                  if (Data[0].FLAG == 'OKK') {
                     let x = Data;
                     let scn;
                     let n = x.length;
                     for (let i = 1; i < n; i++) {
                        scn = Data[i].subcatname;
                        sci = Data[i].subcatid;
                        $("#subcategories").append(new Option(scn, sci));
                     }
                     $("#subcategories").val(obj[11]);
                  }
                  else if (Data[0].FLAG == "NORECORDFOUND") {
                     console.log("NORECORDFOUND");
                     swal('No Subcategory Found','', 'info');
                  }
                  else if (Data[0].FLAG == "ERRORINEXECUTINGQUERY") {
                     console.log("ERROR IN EXECUTING QUERY");
                     swal('Something Went Wrong', '', 'error');
                  }
                  else {
                     swal('Something Went Wrong', '', 'error');
                     //location.reload(true);
                  }
               },
               error: function (Data) {
                  console.log("error In tbody edit get subcategories Ajax Call");
                  swal('Something Went Wrong', '', 'error');
               }
            });
         }
         else {
            swal('Please Select Category', '', 'warning');
            $("#subcategories").empty();
            $("#subcategories").append(new Option('Select', '-1'));
         }

         ResetSelectMenu($("#selectbrand"));
         ResetSelectMenu($("#selectgrade"));

         if ($("#category_name").val() != "-1" && $("#subcategories").val() != "-1") {

            var subcategoryid = $("#subcategories").val();

            $.ajax({
               type: "POST",
               url: "./AddNewProductAjax/getBrandsFromSubcategory.php",
               data: { subcatid: subcategoryid },
               dataType: 'json',
               async: false,
               success: function (Data) {
                  console.log(Data);
                  if (Data[0].FLAG == "OKK") {

                     var n = Data.length;
                     for (var i = 1; i < n; i++) {
                        $("#selectbrand").append(new Option(Data[i].brandname, Data[i].brandid));
                        // $("#selectbrand").append('<option value='+Data[i].brandid+' showvalue='+Data[i].brandname+'>'+Data[i].brandname+'</option>');

                     }
                     $("#selectbrand").val(obj[9]);
                  }
                  else if (Data[0].FLAG == "RECORDNOTFOUND") {
                     console.log("No Brands Found For Selected Category And Subcategory");
                     swal("No Brands Found For Selected Category And Subcategory", '', 'info');
                  }
                  else if (Data[0].FLAG == 'ERRORINEXECUTINGQUERY') {
                     console.log("ERROR IN EXECUTING QUERY");
                     swal('Something Went Wrong', '', 'error');
                  }
                  else {
                     console.log('Other Then Flag');
                     swal('Something Went Wrong', '', 'error');
                  }
               },
               error: function (Data) {
                  console.log('Error In Ajax Call ' + Data);
                  swal('Something Went Wrong', '', 'error');
               }
            });

            if (subcategoryid != "-1") {
               $.ajax({
                  type: "POST",
                  url: "./AddNewProductAjax/getGradesFromSubcategory.php",
                  data: { subcatid: subcategoryid },
                  dataType: 'json',
                  async: false,
                  success: function (Data) {
                     console.log(Data);
                     if (Data[0].FLAG == "OKK") {
                        var n = Data.length;

                        for (var i = 1; i < n; i++) {
                           $("#selectgrade").append(new Option(Data[i].gradetext, Data[i].gradeid));
                        }
                        $("#selectgrade").val(obj[10]);
                     }
                     else if (Data[0].FLAG == "RECORDNOTFOUND") {
                        console.log("No Grade Found For Selected Category And Subcategory");
                        swal("No Grade Found For Selected Category And Subcategory", '', 'info');
                     }
                     else if (Data[0].FLAG == 'ERRORINEXECUTINGQUERY') {
                        console.log("ERROR IN EXECUTING QUERY");
                        swal('Something Went Wrong', '', 'error');
                     }
                     else {
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
            else {
               swal("Please Select Category Or Subcategory", '', 'warning');
            }
         }
         else {
            swal("Please Select Category Or Subcategory", '', 'warning');
         }


         $('#getProductTypeColor').val(obj[2]);
         //$('#getBrandName').val(obj[3]);

         if ($("#sizeRadio").prop('checked') == true) {
            sizeordimension = $("#sizeRadio").val();
            dimension = "N/A";
         }
         else if ($('#dimensionRadio').prop('checked') == true) {
            sizeordimension = $("#dimensionRadio").val();
            dimensionFirst = $('#getDimensionFirst').val();
            dimensionSecond = $("#getDimensionSecond").val();
            dimensionUnitFirst = $("#getDimensionUnitFirst").val();
            dimensionUnitSecond = $("#getDimensionUnitSecond").val();
            dimension = dimensionFirst + " " + dimensionUnitFirst + " X " + dimensionSecond + " " + dimensionUnitSecond;
         }

         if (obj[4] == "N/A") {
            $("#sizeRadio").prop('checked', true);
            $(".getDimension").prop('disabled', true);
            $(".getDimension").val('');
            $(".getDimensionSelect").val('-1');
         }
         else {
            $('#dimensionRadio').prop('checked', true);
            $(".getDimension").prop('disabled', false);
            var dimension = obj[4];
            //console.log(obj[5]);

            var split_dimension = dimension.split(' ');
            var firstDimension = split_dimension[0];
            var firstDimensionUnit = split_dimension[1];
            var SecondDimension = split_dimension[3];
            var SecondDimensionUnit = split_dimension[4];


            $('#getDimensionFirst').val(firstDimension);
            $("#getDimensionSecond").val(SecondDimension);
            $("#getDimensionUnitFirst").val(firstDimensionUnit);
            $("#getDimensionUnitSecond").val(SecondDimensionUnit);
         }

         $('#getQtyPerUnit').val(obj[5]);
         $('#getPackingUnit').val(obj[6]);
         $('#getGrade').val(obj[7]);
         $('#getCode').val(obj[8]);
         $('#getGst').val(obj[9]);

         rowref = $(this);
         $("#add_data").prop('disabled', true);
         $("#save").prop('disabled', false);
      });

      $("#reset").on('click', function () {
         $("#add_data").prop('disabled', false);
         $("#save").prop('disabled', true);
      });

      $("#save").click(function () {

         var type = $('#category_name').val();
         var subcatid = $('#subcategories').val();
         var subtype = $('#subcategories option:selected').html();
         var producttypeorcolor = $('#getProductTypeColor').val();
         var brandname = $('#selectbrand option:selected').html();
         var brandid = $('#selectbrand').val();
         var sizeordimension = "";
         var dimensionFirst = "";
         var dimensionSecond = "";
         var dimensionUnitFirst = "";
         var dimensionUnitSecond = "";
         var dimension = "";
         if ($("#sizeRadio").prop('checked') == true) {
            sizeordimension = $("#sizeRadio").val();
            dimension = "N/A";
         }
         else if ($('#dimensionRadio').prop('checked') == true) {
            sizeordimension = $("#dimensionRadio").val();
            dimensionFirst = $('#getDimensionFirst').val();
            dimensionSecond = $("#getDimensionSecond").val();
            dimensionUnitFirst = $("#getDimensionUnitFirst").val();
            dimensionUnitSecond = $("#getDimensionUnitSecond").val();
            dimension = dimensionFirst + " " + dimensionUnitFirst + " X " + dimensionSecond + " " + dimensionUnitSecond;
         }

         var qtyperunit = $('#getQtyPerUnit').val();
         var packingunit = $('#getPackingUnit').val();
         var gradeid = $('#selectgrade').val();
         var gradetext = $('#selectgrade option:selected').html();
         var code = $('#getCode').val();


         if (type != "-1" && subcatid != -1 && subtype != "" /*&& HSN != "" */ && producttypeorcolor != "" && brandname != "" && brandid != "-1" && ((sizeordimension == "size") || (sizeordimension == "dimension" && dimensionFirst != "" && dimensionSecond != "" && dimensionUnitFirst != -1 && dimensionUnitSecond != -1)) && qtyperunit != "" && packingunit != "" && gradetext != "" && gradeid != "-1" && code != "") {

            var query =
            {
               type: type,
               subtype: subtype,
               //HSN: HSN,
               subcatid: subcatid,
               producttypeorcolor: producttypeorcolor,
               brandname: brandname,
               brandid: brandid,
               dimension: dimension,
               qtyperunit: qtyperunit,
               packingunit: packingunit,
               gradeid: gradeid,
               gradetext: gradetext,
               code: code,
            }

            console.log(query);

            $.ajax({
               type: "POST",
               url: "./AddNewProductAjax/checkForProductAtSave.php",
               data: JSON.stringify(query),
               success: function (Data) {
                  console.log(Data);
                  if (Data == '1') {
                     console.log('Record Found In Database');
                  }
                  else if (Data == '-1') {
                     console.log('Sub Category ID Not Found')
                  }
                  else if (Data == '0') {

                     if (rowref != null) {
                        let tr = rowref.parent().siblings();


                        tr.html(type);
                        tr = tr.next();
                        tr.html(subtype);
                        tr = tr.next();
                        //tr.html(HSN);
                        //tr = tr.next();
                        tr.html(producttypeorcolor);
                        tr = tr.next();
                        tr.html(brandname);
                        tr = tr.next();
                        tr.html(dimension);
                        tr = tr.next();
                        tr.html(qtyperunit);
                        tr = tr.next();
                        tr.html(packingunit);
                        tr = tr.next();
                        tr.html(gradetext);
                        tr = tr.next();
                        tr.html(code);
                        tr = tr.next();
                        tr.html(brandid);
                        tr = tr.next();
                        tr.html(gradeid);
                        tr = tr.next();
                        tr.html(subcatid);
                        tr = tr.next();
                        tr.html('<input type="button" class="btn btn-primary editbtn" value="Edit"> ' + '<input type="button" class="btn btn-primary" value="Delete" onclick="SomeDeleteRowFunction(this)">');

                        rowref = null;

                        $("#save").prop('disabled', true);
                        $("#add_data").prop('disabled', false);
                        $('#reset').prop('disabled', false);
                     }
                     else {
                        swal('Please Select Row To Edit', '', 'warning');
                     }
                  }
                  else {
                     swal('Something Went Wrong', '', 'error');
                  }
               }
            });
         }
         else {
            swal("All fields are required", '', 'warning');
         }


      });

      function ResetSelectMenu(t) {
         t.empty();
         t.append(new Option("Select", "-1"));
      }

      function ReloadBrandAndGrade() {
         ResetSelectMenu($("#selectbrand"));
         ResetSelectMenu($("#selectgrade"));

         //console.log('Inside Reload');
         //console.log($("#category_name").val());
         // console.log($);
         if ($("#category_name").val() != "-1" && $("#subcategories").val() != "-1") {

            var subcategoryid = $("#subcategories").val();

            $.ajax({
               type: "POST",
               url: "./AddNewProductAjax/getBrandsFromSubcategory.php",
               data: { subcatid: subcategoryid },
               dataType: 'json',
               async: false,
               success: function (Data) {
                  console.log(Data);
                  if (Data[0].FLAG == "OKK") {

                     var n = Data.length;
                     for (var i = 1; i < n; i++) {
                        $("#selectbrand").append(new Option(Data[i].brandname, Data[i].brandid));
                        // $("#selectbrand").append('<option value='+Data[i].brandid+' showvalue='+Data[i].brandname+'>'+Data[i].brandname+'</option>');

                     }
                     $("#selectbrand").val(obj[9]);
                  }
                  else if (Data[0].FLAG == "RECORDNOTFOUND") {
                     console.log("No Brands Found For Selected Category And Subcategory");
                     swal("No Brands Found For Selected Category And Subcategory", '', 'info');
                  }
                  else if (Data[0].FLAG == 'ERRORINEXECUTINGQUERY') {
                     console.log("ERROR IN EXECUTING QUERY");
                     swal('Something Went Wrong', '', 'error');
                  }
                  else {
                     console.log('Other Then Flag');
                     swal('Something Went Wrong', '', 'error');
                  }
               },
               error: function (Data) {
                  console.log('Error In Ajax Call ' + Data);
                  swal('Something Went Wrong', '', 'error');
               }
            });

            if (subcategoryid != "-1") {
               $.ajax({
                  type: "POST",
                  url: "./AddNewProductAjax/getGradesFromSubcategory.php",
                  data: { subcatid: subcategoryid },
                  dataType: 'json',
                  async: false,
                  success: function (Data) {
                     console.log(Data);
                     if (Data[0].FLAG == "OKK") {
                        var n = Data.length;

                        for (var i = 1; i < n; i++) {
                           $("#selectgrade").append(new Option(Data[i].gradetext, Data[i].gradeid));
                        }
                     }
                     else if (Data[0].FLAG == "RECORDNOTFOUND") {
                        console.log("No Grade Found For Selected Category And Subcategory");
                        swal("No Grade Found For Selected Category And Subcategory", '', 'info');
                     }
                     else if (Data[0].FLAG == 'ERRORINEXECUTINGQUERY') {
                        console.log("ERROR IN EXECUTING QUERY");
                        swal('Something Went Wrong', '', 'error');
                     }
                     else {
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
            else {
               swal("Please Select Category Or Subcategory", '', 'warning');
            }

         }
         else {

         }
      }

   });

</script>
<script>
   function SomeDeleteRowFunction(o) {

      var p = o.parentNode.parentNode;
      p.parentNode.removeChild(p);
   }
</script>

</html>