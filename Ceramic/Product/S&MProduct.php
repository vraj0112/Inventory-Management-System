<?php
   include('./config.php');
?>
<!DOCTYPE html>
<html>

<head>
   <title>Search and Manage Product</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
   <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
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
      <div class="row searchitem">
         <div class="col-md-12">
            <div class="card card-primary">
               <div class="card-header" style="background-color: #2B60DE">
                  <h3 class="card-title" style="color: white">
                     <center>Search and Manage Product</center>
                  </h3>
               </div>

               <div class="card-body">
                  <form class="row g-3 seachitem" id="smpform">
                     <div class="form-group col-md-12">

                        <div class="row">
                           <div class="col-md-1">
                              <label class="form-label">Search By: </label>
                           </div>

                           <div class="row col-md-11">
                              <div class="col-md-2">
                                 <label class="form-check-label" for="categoriesCheck">
                                    <input class="form-check-input searchby" type="checkbox" name="categoriesCheck"
                                       id="categoriesCheck">
                                    Category</label>
                              </div>

                              <div class="col-md-2">
                                 <label class="form-check-label" for="subcategoriesCheck">
                                    <input class="form-check-input searchby" type="checkbox" name="subcategoriesCheck"
                                       id="subcategoriesCheck">
                                    Sub Category</label>
                              </div>

                              <div class="col-md-2">
                                 <label class="form-check-label" for="hsncodeCheck">
                                    <input class="form-check-input searchby" type="checkbox" name="hsncodeCheck"
                                       id="hsncodeCheck">
                                    HSN Code</label>
                              </div>

                              <div class="col-md-2">
                                 <label class="form-check-label" for="typeorcolorCheck">
                                    <input class="form-check-input searchby" type="checkbox" name="typeorcolorCheck"
                                       id="typeorcolorCheck">
                                    Type/Color</label>
                              </div>

                              <div class="col-md-2">
                                 <label class="form-check-label" for="brandnameCheck">
                                    <input class="form-check-input searchby" type="checkbox" name="brandnameCheck"
                                       id="brandnameCheck">
                                    Brand Name</label>
                              </div>

                              <div class="col-md-2">
                                 <label class="form-check-label" for="dimensionCheck">
                                    <input class="form-check-input searchby" type="checkbox" name="dimensionCheck"
                                       id="dimensionCheck">
                                    Dimension</label>
                              </div>
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-md-1"></div>

                           <div class="col-md-11 row">
                              <div class="col-md-2">
                                 <label class="form-check-label" for="qtyperunitCheck">
                                    <input class="form-check-input searchby" type="checkbox" name="qtyperunitCheck"
                                       id="qtyperunitCheck">
                                    Qty/Unit</label>
                              </div>

                              <div class="col-md-2">
                                 <label class="form-check-label" for="packingunitCheck">
                                    <input class="form-check-input searchby" type="checkbox" name="packingunitCheck"
                                       id="packingunitCheck">
                                    Packing Unit</label>
                              </div>

                              <div class="col-md-2">
                                 <label class="form-check-label" for="gradeCheck">
                                    <input class="form-check-input searchby" type="checkbox" name="gradeCheck"
                                       id="gradeCheck">
                                    Grade</label>
                              </div>

                              <div class="col-md-4">
                                 <label class="form-check-label" for="codeCheck">
                                    <input class="form-check-input searchby" type="checkbox" name="codeCheck"
                                       id="codeCheck">
                                    Code No. / Model No. / Design No.</label>
                              </div>

                              <div class="col-md-2">
                                 <label class="form-check-label" for="gstCheck">
                                    <input class="form-check-input searchby" type="checkbox" name="gstCheck"
                                       id="gstCheck">
                                    Gst</label>
                              </div>

                           </div>
                        </div>


                        <div class="row">

                           <div class="mt-4"></div>

                           <div class="form-group col-md-4">
                              <label class="form-label">Product Type: </label>
                              <select id="category_name" class="form-select col-md-12" disabled>
                                 <option value='-1' selected>Select</option>
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
                                             /*"<option value='".$category_name."' cid='".$category_id."'>".$category_name."</option>";*/
                                             "<option value='".$category_id."'>".$category_name."</option>";
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

                           <div class="form-group col-md-4">
                              <label class="form-label">Product Sub Type: </label>
                              <select id="subcategories" class="form-select" disabled>
                                 <option value='-1'>Select</option>

                              </select>
                           </div>

                           <div class="form-group col-md-4">
                              <label class="form-label">HSN Code: </label>
                              <input type="number" name="HSN" class="form-control" id='hsn'
                                 onKeyPress="if(this.value.length==8) return false;" disabled>
                           </div>

                        </div>

                        <div class="row mt-3">

                           <div class="col-md-2">
                              <label class="form-label">Grade: </label>
                           </div>
                           <div class="col-md-4">

                              <select id="getgrade" class="form-select col-md-12" disabled>
                                 <option value='-1' selected>Select</option>

                              </select>
                           </div>



                           <div class="col-md-2">
                              <center><label class="form-label">Brand Name: </label></center>
                           </div>

                           <div class="col-md-4">

                              <select id="getbrandname" class="form-select" disabled>
                                 <option value='-1'>Select</option>

                              </select>
                           </div>
                        </div>

                        <div class="row mt-3">
                           <div class="col-md-2">
                              <label class="form-label">Dimension : </label>
                           </div>

                           <div class="col-md-4">
                              <select id="getdimension" class="form-select col-md-12" disabled>
                                 <option value='-1' selected>Select</option>

                              </select>
                           </div>
                        </div>

                        <div class="row mt-3">
                           <div class="col-md-2">
                              <label class="form-label">Qty Per Unit: </label>
                           </div>

                           <div class="col-md-4">
                              <select id="getqtyperunit" class="form-select col-md-12" disabled>
                                 <option value='-1' selected>Select</option>

                              </select>
                           </div>
                        </div>

                        <div class="row mt-3">
                           <div class="col-md-2">
                              <label class="form-label">Packing Unit : </label>
                           </div>

                           <div class="col-md-4">
                              <select class='form-select' name="" id="getpackingunit" disabled>
                                 <option value="-1">Select</option>
                                 <option value="KG">KG</option>
                                 <option value="PIECE">PEICE</option>
                                 <option value="BOX">BOX</option>
                              </select>
                           </div>
                        </div>

                        <div class="row mt-3">
                           <div class="col-md-2">
                              <label class="form-label">Product Type/Color : </label>
                           </div>

                           <div class="col-md-4">

                              <select name='getProductTypeColor' class="form-control form-select"
                                 id="getProductTypeColor" disabled>
                                 <option value="-1">Select</option>

                              </select>
                           </div>
                        </div>

                        <div class="row mt-3">
                           <div class="col-md-3">
                              <label class="form-label">Code No. / Model No. / Design No.: </label>
                           </div>

                           <div class="col-md-3">

                              <select id="getcode" class="form-select col-md-12" disabled>
                                 <option value='-1' selected>Select</option>

                              </select>
                           </div>
                        </div>

                        <div class="row mt-3">
                           <div class="col-md-2">
                              <label class="form-label">GST % : </label>
                           </div>

                           <div class="col-md-4">
                              <select class="form-select" id="getgst" disabled>
                                 <option value="-1">Select</option>
                                 <option value="5">5</option>
                                 <option value="12">12</option>
                                 <option value="18">18</option>
                                 <option value="28">28</option>
                              </select>
                           </div>
                        </div>

                        <div class="row mt-4">
                           <div class="col-md-2">
                              <input type="Button" value="Search" id="searchbtn" class="btn btn-success">
                           </div>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>

      <div class="row edititem" hidden>
         <div class="col-md-12">
            <div class="card card-primary">
               <div class="card-header" style="background-color: #2B60DE">
                  <h3 class="card-title" style="color: white" align="center">Edit Product</h3>
               </div>
               <div class="card-body">
                  <form class="g-3" id='dataform' name="dataform">
                     <input type="hidden" id='pid'>

                     <div class="row">

                        <div class="col-md-2">
                           <label class="mt-1 form-label">Product Type: </label>
                        </div>
                        <div class="col-md-4">
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
                                             /*"<option value='".$category_name."' cid='".$category_id."'>".$category_name."</option>";*/
                                             "<option value='".$category_id."'>".$category_name."</option>";
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
                           <label class="mt-1 form-label">Product Sub Type: </label>
                        </div>
                        <div class="col-md-4">
                           <select id="subcategories" class="form-select">
                              <option value='-1'>Select</option>
                           </select>
                        </div>
                     </div>


                     <div class="row mt-4">
                        <div class="col-md-2">
                           <label class="mt-1 form-label">Grade: </label>
                        </div>
                        <div class="col-md-4">
                           <select name="getgrade" id="getgrade" class='form-select'>
                              <option value="-1">Select</option>
                           </select>
                        </div>
                        <div class="col-md-2">
                           <center><label class="mt-1 form-label">Brand Name: </label></center>
                        </div>

                        <div class="col-md-4">
                           <select name="getbrand" id="getbrand" class='form-select'>
                              <option value="-1">Select</option>
                           </select>
                        </div>
                     </div>

                     <div class="row mt-4">
                        <div class="col-md-2">
                           <label for="getProductTypeColor" class="mt-1 ">Product Type/Color : </label>
                        </div>

                        <div class="col-md-4">
                           <input type="text" name='getProductTypeColor' class="form-control" id="getProductTypeColor">
                        </div>
                     </div>

                     <div class="row mt-4">
                        <div class="col-md-2">
                           <label class='mt-1 form-label' for="">Size Or Dimension : </label>
                        </div>

                        <div class="col-md-6 mt-1 ">
                           <label class='form-check-label' for="sizeRadio">
                              <input class='form-check-input sizeordimension' id='sizeRadio' name='sizeordimension'
                                 type="radio" value='size' checked>
                              Size</label>

                           <label class='form-check-label' for="dimensionRadio">
                              <input class='form-check-input sizeordimension' id='dimensionRadio' name='sizeordimension'
                                 type="radio" value='dimension'>
                              Dimension</label>
                        </div>
                     </div>

                     <div class="row mt-3">
                        <div class="col-md-2">
                           <label class="mt-1 form-label">Dimension : </label>
                        </div>

                        <div class="col-md-2">
                           <input type="number" id='getDimensionFirst' name="SizeDimension"
                              class="form-control getDimension" disabled>
                        </div>

                        <div class="col-md-2">

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

                        <div class="col-md-2">
                           <center><label for="">X</label></center>
                        </div>

                        <div class="col-md-2">
                           <input type="number" id='getDimensionSecond' name="SizeDimension"
                              class="form-control getDimension" disabled>
                        </div>

                        <div class="col-md-2">

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

                     <div class="row mt-3">
                        <div class="col-md-2">
                           <label class="mt-1 form-label">Qty Per Unit: </label>
                        </div>

                        <div class="col-md-4">
                           <input type="text" name="unit" class="form-control" id="getQtyPerUnit">
                        </div>
                     </div>

                     <div class="row mt-3">
                        <div class="col-md-2">
                           <label class="mt-1 form-label">Packing Unit : </label>
                        </div>

                        <div class="col-md-4">

                           <select class='form-select' name="" id="getPackingUnit">
                              <option value="KG">KG</option>
                              <option value="PIECE">PEICE</option>
                              <option value="BOX">BOX</option>
                           </select>
                        </div>
                     </div>

                     <div class="row mt-3">
                        <div class="col-md-3">
                           <label class="mt-1 form-label">Code No. / Model No. / Design No.: </label>
                        </div>
                        <div class="col-md-3">
                           <input type="text" name="cmd" class="form-control" id="getCode">
                        </div>
                     </div>

                     <div class="mt-4 col-12">
                        <input type="button" value="Save" id="save" class="btn btn-primary">
                        <input type="button" value="Cancel" id="cancel" class="btn btn-primary">
                     </div>
               </div>

               <br>
            </div>
         </div>
      </div>

   </div>
   <br>
   <div class="card card-primary">
   </div>
   <div class="card-body">
      <table class="table" id="data_table">
         <thead>
            <th>Type</th>
            <th>Sub<br>Type</th>
            <th>HSN<br>Code</th>
            <th>Type/<br>Color</th>
            <th>Brand</th>
            <th>Dimension</th>
            <th>Qty/Unit</th>
            <th>Packing<br>Unit</th>
            <th>Grade</th>
            <th>Code</th>
            <th>GST</th>
            <th>Action</th>
         </thead>
         <tbody>
            <!-- <td>Ciramic</td>
                        <td>Tiles</td>
                        <td>123456</td>
                        <td>Abc</td>
                        <td>KG</td>
                        <td>5</td>
                        <td>std</td>
                        <td>123</td>
                        <td>2</td>
                        <td>2</td> -->
         </tbody>
      </table>

   </div>

   </div>

</body>

<script>
   $(function () {

      ReloadSubcategoriesSelectMenu();
      ReloadGradeSelectMenu();
      ReloadBrandSelectMenu();
      ReloadDimesionSelectMenu();
      ReloadQtyPerUnitSelectMenu();
      ReloadProductTypeColorMenu();
      ReloadCodeSelectMenu();

      $('.searchby').on('change', function () {


         if ($('#categoriesCheck').prop('checked') == true) {
            $("#category_name").prop('disabled', false);
         }
         else {
            $("#category_name").val('-1');
            $("#category_name").prop('disabled', true);
         }

         if ($('#subcategoriesCheck').prop('checked') == true) {
            $('#subcategories').prop('disabled', false);
         }
         else {
            $('#subcategories').val('-1');
            $('#subcategories').prop('disabled', true);
         }

         if ($('#hsncodeCheck').prop('checked') == true) {
            $('#hsn').prop('disabled', false);
         }
         else {
            $('#hsn').val('');
            $('#hsn').prop('disabled', true);
         }

         if ($('#typeorcolorCheck').prop('checked') == true) {
            $('#getProductTypeColor').prop('disabled', false);
         }
         else {
            $('#getProductTypeColor').val('-1');
            $('#getProductTypeColor').prop('disabled', true);
         }

         if ($('#brandnameCheck').prop('checked') == true) {
            $('#getbrandname').prop('disabled', false);
         }
         else {
            $('#getbrandname').val('-1');
            $('#getbrandname').prop('disabled', true);
         }

         if ($('#dimensionCheck').prop('checked') == true) {
            $('#getdimension').prop('disabled', false);
         }
         else {
            $('#getdimension').val('-1');
            $('#getdimension').prop('disabled', true);
         }

         if ($('#qtyperunitCheck').prop('checked') == true) {
            $('#getqtyperunit').prop('disabled', false);
         }
         else {
            $('#getqtyperunit').val('-1');
            $('#getqtyperunit').prop('disabled', true);
         }

         if ($('#packingunitCheck').prop('checked') == true) {
            $('#getpackingunit').prop('disabled', false);
         }
         else {
            $('#getpackingunit').val('-1');
            $('#getpackingunit').prop('disabled', true);
         }

         if ($('#gradeCheck').prop('checked') == true) {
            $('#getgrade').prop('disabled', false);
         }
         else {
            $('#getgrade').val('-1');
            $('#getgrade').prop('disabled', true);
         }

         if ($('#codeCheck').prop('checked') == true) {
            $('#getcode').prop('disabled', false);
         }
         else {
            $('#getcode').val('-1');
            $('#getcode').prop('disabled', true);
         }

         if ($('#gstCheck').prop('checked') == true) {
            $('#getgst').prop('disabled', false);
         }
         else {
            $('#getgst').val('-1');
            $('#getgst').prop('disabled', true);
         }

      });

      $('#searchbtn').click(function () {

         $("#data_table tbody").empty();

         let query = "SELECT *, productmst.RecStatus as recordstatus FROM `productmst` join brandnames, grades, subcategories, categories WHERE productmst.BrandId = brandnames.BrandId and productmst.GradeId = grades.GradeId and subcategories.subcategory_id= productmst.ProductSubCategoryID and subcategories.category_id= categories.category_id    ";

         let validflag = 0;

         if ($('#categoriesCheck').prop('checked') == true) {

            if ($("#category_name").val() != '-1') {
               // query = query + " and category_name='" + $("#category_name option:selected").html() + "' ";
               query = query + " and subcategories.category_id='" + $("#category_name").val() + "' ";
            }
            else {
               validflag = 1;
               swal("Please Select Category", '', 'warning');
            }
         }

         if ($('#subcategoriesCheck').prop('checked') == true) {

            if ($('#subcategories').val() != '-1') {
               query = query + " and productmst.ProductSubCategoryID='" + $('#subcategories').val() + "' ";
            }
            else {
               validflag = 1;
               swal("Please Select Subcategory", '', 'warning');
            }
         }

         if ($('#hsncodeCheck').prop('checked') == true) {

            if ($('#hsn').val() != "") {
               query = query + " and ProductHSNCode='" + $('#hsn').val() + "' ";
            }
            else {
               validflag = 1;
               swal("Please Enter HSN Code", '', 'warning');
            }
         }

         if ($('#typeorcolorCheck').prop('checked') == true) {

            if ($('#getProductTypeColor').val() != '-1') {
               query = query + " and ProductTypeColor='" + $('#getProductTypeColor').val() + "' ";
            }
            else {
               validflag = 1;
               swal("Please Enter Type/Color Code", '', 'warning');
            }
         }

         if ($('#brandnameCheck').prop('checked') == true) {

            if ($('#getbrandname').val() != '-1') {
               query = query + " and productmst.BrandId='" + $('#getbrandname').val() + "' ";
            }
            else {
               validflag = 1;
               swal("Please Select Brand Name", '', 'warning');
            }
         }

         if ($('#dimensionCheck').prop('checked') == true) {

            if ($('#getdimension').val() != '-1') {
               query = query + " and SizeOrDimension='" + $('#getdimension').val() + "' ";
            }
            else {
               validflag = 1;
               swal("Please Select Dimension", '', 'warning');
            }
         }

         if ($('#qtyperunitCheck').prop('checked') == true) {

            if ($('#getqtyperunit').val() != '-1') {
               query = query + " and QtyPerUnit=" + $('#getqtyperunit').val() + " ";
            }
            else {
               validflag = 1;
               swal("Please Select Qty Per Unit", '', 'warning');
            }
         }

         if ($('#packingunitCheck').prop('checked') == true) {

            if ($('#getpackingunit').val() != '-1') {
               query = query + " and PackingUnit='" + $('#getpackingunit').val() + "' ";
            }
            else {
               validflag = 1;
               swal("Please Select Packing Unit", '', 'warning');

            }
         }

         if ($('#gradeCheck').prop('checked') == true) {

            if ($('#getgrade').val() != '-1') {
               query = query + " and productmst.GradeId='" + $('#getgrade').val() + "' ";
            }
            else {
               validflag = 1;
               swal("Please Select Grade", '', 'warning');
            }
         }

         if ($('#codeCheck').prop('checked') == true) {

            if ($('#getcode').val() != '-1') {
               query = query + " and Code='" + $('#getcode').val() + "' ";
            }
            else {
               validflag = 1;
               swal("Please Select Code No. / Design No. / Model No.", '', 'warning');
            }
         }

         if ($('#gstCheck').prop('checked') == true) {

            if ($('#getgst').val() != '-1') {
               query = query + " and ProductGST=" + $('#getgst').val() + " ";
            }
            else {
               validflag = 1;
               swal("Please Select GST", '', 'warning');
            }
         }

         if (validflag == 0) {

            $.ajax({
               method: "POST",
               url: "./SearchAndManageProductAjax/searchByParam.php",
               data: { query: query },
               dataType: 'json',
               success: function (Data) {
                  //console.log(Data);

                  if (Data[0].FLAG == "RECORDFOUND") {
                     let n = Data.length;

                     for (let i = 1; i < n; i++) {
                        var type = Data[i].type;
                        var subtype = Data[i].subtype;
                        var hsn = Data[i].hsn;
                        var typeorcolor = Data[i].typeorcolor;
                        var brandname = Data[i].brandname;
                        var dimension = Data[i].dimension;
                        var qtyperunit = Data[i].qtyperunit;
                        var packingunit = Data[i].packingunit;
                        var grade = Data[i].gradetext;
                        var code = Data[i].code;
                        var gst = Data[i].gst;
                        var productid = Data[i].productid;
                        var recstatus = Data[i].recstatus;


                        var btncolor = '';
                        var btntext = '';

                        if (recstatus == 1) {
                           btncolor = 'btn-danger';
                           btntext = 'Deactive';
                        }
                        else {
                           btncolor = 'btn-success';
                           btntext = 'Active';
                        }

                        $('#data_table tbody:last-child').append(
                           '<tr>' +
                           '<td>' + type + '</td>' +
                           '<td>' + subtype + '</td>' +
                           '<td>' + hsn + '</td>' +
                           '<td>' + typeorcolor + '</td>' +
                           '<td>' + brandname + '</td>' +
                           '<td>' + dimension + '</td>' +
                           '<td>' + qtyperunit + '</td>' +
                           '<td>' + packingunit + '</td>' +
                           '<td>' + grade + '</td>' +
                           '<td>' + code + '</td>' +
                           '<td>' + gst + '</td>' +
                           '<td>' +
                           '<input type="button" class="btn btn-primary editbtn" pid="' + productid + '" value="Edit"> ' +
                           ' <input type="button" class="btn ' + btncolor + '  changestatus" value="' + btntext + '"  productid="' + productid + '"  recstatus="' + recstatus + '"></td>' +
                           '</tr>');
                     }

                  }
                  else if (Data[0].FLAG == "NORECORDFOUND") {
                     swal('NO Record Found For Your Search Result', '', 'info');
                  }
                  else if (Data[0].FLAG == "ERRORINQUERY") {
                     swal('Something Went Wrong', '', 'error');
                  }
               },
               error: function (Data) {
                  console.log("Error In ./SearchAndManageProductAjax/searchByParam.php  Ajax Call");
                  swal('Something Went Wrong', '', 'error');
               }
            });
         }
         else {
            console.log('CURRUPTED');
         }
      });

      $("tbody").on('click', '.changestatus', function () {
         var productid = $(this).attr('productid');
         var recstatus = $(this).attr('recstatus');
         var rowref = $(this);

         $.ajax({
            type: "POST",
            url: './SearchAndManageProductAjax/changeActiveStatus.php',
            data: { productid: productid, recstatus: recstatus },
            success: function (Data) {
               //console.log(Data);

               if (Data == '1') {
                  var oldbtncolor = '';
                  var btncolor = '';
                  var btntext = '';

                  if (recstatus == 1) {
                     oldbtncolor = 'btn-danger';
                     btntext = ' Active ';
                     btncolor = 'btn-success';
                     rowref.attr('recstatus', 0);
                  }
                  else {
                     oldbtncolor = 'btn-success';
                     btntext = 'Deactive';
                     btncolor = 'btn-danger';
                     rowref.attr('recstatus', 1);
                  }

                  rowref.removeClass(oldbtncolor);
                  rowref.addClass(btncolor);
                  rowref.val(btntext);
                  if (recstatus == 1) {
                     swal('Product Deactivated', '', 'warning');
                  }
                  else {
                     swal('Product Activated', '', 'success');
                  }
               }
               else if (Data == '-1') {
                  console.log("Err While Update QUery");
                  swal('Something Went Wrong', '', 'error');
               }
               else {
                  console.log("Other Flag Recived");
                  swal('Something Went Wrong', '', 'error');
               }
            },
            error: function (Data) {
               console.log('err in  ./SearchAndManageProductAjax/changeActiveStatus.php   Ajax Call');
               swal('Something Went Wrong', '', 'error');
            }
         });
      });

      $("tbody").on('click', '.editbtn', function () {

         $('.edititem').prop('hidden', false);
         $('.searchitem').prop('hidden', true);
         $('#data_table').prop('hidden', true);

         let tr = $(this).parent().siblings();
         $('.edititem #pid').val($(this).attr('pid'));

         let obj = Array();

         for (let i = 0; i < 11; i++) {
            obj.push(tr.html());
            tr = tr.next();
         }

         //console.log(obj);

         $(".edititem #category_name option").each(function () {
            if ($(this).text() == obj[0]) {
               $(this).prop('selected', true);
               return false;
            }
         });

         let cid = $('.edititem #category_name').val();

         $(".edititem #subcategories").empty();
         $(".edititem #subcategories").append(new Option('Select', '-1'));

         if (cid != '-1') {

            $.ajax({
               type: "POST",
               url: "./SearchAndManageProductAjax/getSubcategoriesFromCategories.php",
               data: { cid: cid },
               dataType: "json",
               async: false,
               success: function (Data) {

                  if (Data[0].FLAG == 'OK') {

                     let n = Data.length;
                     for (let i = 1; i < n; i++) {
                        let scn = Data[i].scn;
                        let sci = Data[i].sci;
                        $(".edititem #subcategories").append(new Option(scn, sci))
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
            $(".edititem #subcategories").empty();
            $(".edititem #subcategories").append(new Option('Select', '-1'));
         }

         //console.log(obj[1]);
         $(".edititem #subcategories option").each(function () {
            if ($(this).text() == obj[1]) {
               $(this).prop('selected', true);
               return false;
            }
         });


         var subcatid = $(".edititem #subcategories").val();

         //console.log(subcatid);

         if (subcatid != "-1") {
            ResetSelectMenu($(".edititem #getbrand"));
            ResetSelectMenu($(".edititem #getgrade"));

            $.ajax({
               type: "POST",
               url: "./SearchAndManageProductAjax/getBrandsFromSubcategory.php",
               data: { subcatid: subcatid },
               dataType: 'json',
               success: function (Data) {
                  //console.log(Data);
                  if (Data[0].FLAG == "OKK") {
                     var n = Data.length;

                     for (var i = 1; i < n; i++) {
                        $(".edititem #getbrand").append(new Option(Data[i].brandname, Data[i].brandid));
                     }

                     $(".edititem #getbrand option").each(function () {
                        if ($(this).text() == obj[4]) {
                           $(this).prop('selected', true);
                           return false;
                        }
                     });
                  }
                  else if (Data[0].FLAG == "RECORDNOTFOUND") {
                     console.log("No Brands Found For Selected Category And Subcategory");
                     swal("No Brands Found For Selected Category And Subcategory", '', 'warning');
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

            $.ajax({
               type: "POST",
               url: "./SearchAndManageProductAjax/getGradesFromSubcategory.php",
               data: { subcatid: subcatid },
               dataType: 'json',
               success: function (Data) {
                  //console.log(Data);
                  if (Data[0].FLAG == "OKK") {
                     var n = Data.length;

                     for (var i = 1; i < n; i++) {
                        $(".edititem #getgrade").append(new Option(Data[i].gradetext, Data[i].gradeid));
                        //$("#selectgrade").append('<option value='+Data[i].gradeid+' showvalue='+Data[i].gradetext+'>'+Data[i].gradetext+'</option>');
                     }
                     $(".edititem #getgrade option").each(function () {
                        if ($(this).text() == obj[8]) {
                           $(this).prop('selected', true);
                           return false;
                        }
                     });
                  }
                  else if (Data[0].FLAG == "RECORDNOTFOUND") {
                     console.log("No Grade Found For Selected Category And Subcategory");
                     swal("No Grade Found For Selected Category And Subcategory", '', 'warning');
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
            ResetSelectMenu($(".edititem #getbrand"));
            ResetSelectMenu($(".edititem #getgrade"));
         }


         $('.edititem #getProductTypeColor').val(obj[3]);

         if ($(".edititem #sizeRadio").prop('checked') == true) {
            sizeordimension = $(".edititem #sizeRadio").val();
            dimension = "N/A";
         }
         else if ($('.edititem #dimensionRadio').prop('checked') == true) {
            sizeordimension = $(".edititem #dimensionRadio").val();
            dimensionFirst = $('.edititem #getDimensionFirst').val();
            dimensionSecond = $(".edititem #getDimensionSecond").val();
            dimensionUnitFirst = $(".edititem #getDimensionUnitFirst").val();
            dimensionUnitSecond = $(".edititem #getDimensionUnitSecond").val();
            dimension = dimensionFirst + " " + dimensionUnitFirst + " X " + dimensionSecond + " " + dimensionUnitSecond;
         }

         if (obj[5] == "N/A") {
            $(".edititem #sizeRadio").prop('checked', true);
            $(".edititem .getDimension").prop('disabled', true);
            $(".edititem .getDimension").val('');
            $(".edititem .getDimensionSelect").val('-1');
         }
         else {
            $('.edititem #dimensionRadio').prop('checked', true);
            $(".edititem .getDimension").prop('disabled', false);
            var dimension = obj[5];

            var split_dimension = dimension.split(' ');
            var firstDimension = split_dimension[0];
            var firstDimensionUnit = split_dimension[1];
            var SecondDimension = split_dimension[3];
            var SecondDimensionUnit = split_dimension[4];


            $('.edititem #getDimensionFirst').val(firstDimension);
            $(".edititem #getDimensionSecond").val(SecondDimension);
            $(".edititem #getDimensionUnitFirst").val(firstDimensionUnit);
            $(".edititem #getDimensionUnitSecond").val(SecondDimensionUnit);
         }

         $('.edititem #getQtyPerUnit').val(obj[6]);
         $('.edititem #getPackingUnit').val(obj[7]);
         $('.edititem #getGrade').val(obj[8]);
         $('.edititem #getCode').val(obj[9]);
         $('.edititem #getGst').val(obj[10]);

         rowref = $(this);
         $("#add_data").prop('disabled', true);
         $("#save").prop('disabled', false);
      });

      $('.edititem #category_name').on('change', function () {
         ResetSelectMenu($(".edititem #subcategories"));
         ResetSelectMenu($(".edititem #getbrand"));
         ResetSelectMenu($(".edititem #getgrade"));

         let cid = $('.edititem #category_name').val(); // cid == categoryid
         //console.log(cid);

         if (cid != '-1') {

            $.ajax({
               type: "POST",
               url: "./SearchAndManageProductAjax/getSubcategoriesFromCategories.php",
               data: { cid: cid },
               dataType: "json",
               success: function (Data) {
                  //console.log(Data);
                  if (Data[0].FLAG == 'OK') {
                     let n = Data.length;
                     for (let i = 1; i < n; i++) {
                        scn = Data[i].scn;
                        sci = Data[i].sci;
                        $(".edititem #subcategories").append(new Option(scn, sci));
                     }
                  }
                  else if (Data[0].FLAG == "NORECORDFOUND") {
                     console.log("No Subcategory Found For Given Category");
                     swal('No Subcategory Found For Given Category', '', 'warning');
                  }
                  else if (Data[0].FLAG == "NOTOK") {
                     console.log("Error In Executing Query");
                     swal('Something Went Wrong', '', 'error');
                  }
                  else {
                     console.log('Other Response Found');
                     swal('Something Went Wrong', '', 'error');
                  }
               },
               error: function (Data) {
                  console.log("Error In Ajax Call In .edititem Categories Change Event");
                  swal('Something Went Wrong', '', 'error');
               }
            });
         }
         else {
            ResetSelectMenu($(".edititem #subcategories"));
            ResetSelectMenu($(".edititem #getbrand"));
            ResetSelectMenu($(".edititem #getgrade"));
         }

      });

      $('.edititem #subcategories').on('change', function () {
         ResetSelectMenu($(".edititem #getbrand"));
         ResetSelectMenu($(".edititem #getgrade"));

         var subcatid = $(".edititem #subcategories").val();

         if (subcatid != "-1") {

            $.ajax({
               type: "POST",
               url: "./SearchAndManageProductAjax/getBrandsFromSubcategory.php",
               data: { subcatid: subcatid },
               dataType: 'json',
               success: function (Data) {
                  //console.log(Data);
                  if (Data[0].FLAG == "OKK") {
                     var n = Data.length;

                     for (var i = 1; i < n; i++) {
                        $(".edititem #getbrand").append(new Option(Data[i].brandname, Data[i].brandid));
                     }
                  }
                  else if (Data[0].FLAG == "RECORDNOTFOUND") {
                     console.log("No Brands Found For Selected Category And Subcategory");
                     swal("No Brands Found For Selected Category And Subcategory", '', 'warning');
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


            $.ajax({
               type: "POST",
               url: "./SearchAndManageProductAjax/getGradesFromSubcategory.php",
               data: { subcatid: subcatid },
               dataType: 'json',
               success: function (Data) {
                  //console.log(Data);
                  if (Data[0].FLAG == "OKK") {
                     var n = Data.length;

                     for (var i = 1; i < n; i++) {
                        $(".edititem #getgrade").append(new Option(Data[i].gradetext, Data[i].gradeid));
                     }
                  }
                  else if (Data[0].FLAG == "RECORDNOTFOUND") {
                     console.log("No Grade Found For Selected Category And Subcategory");
                     swal("No Grade Found For Selected Category And Subcategory", '', 'warning');
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
            ResetSelectMenu($(".edititem #getbrand"));
            ResetSelectMenu($(".edititem #getgrade"));
         }
      })

      $(".edititem #save").click(function () {

         var pid = $(".edititem #pid").val();
         var type = $('.edititem #category_name').val();
         var subtypeid = $('.edititem #subcategories').val();
         //var HSN = $('.edititem #hsn').val();
         var producttypeorcolor = $('.edititem #getProductTypeColor').val();
         var brandid = $('.edititem #getbrand').val();
         var sizeordimension = "";
         var dimensionFirst = "";
         var dimensionSecond = "";
         var dimensionUnitFirst = "";
         var dimensionUnitSecond = "";
         var dimension = "";
         if ($(".edititem #sizeRadio").prop('checked') == true) {
            sizeordimension = $(".edititem #sizeRadio").val();
            dimension = "N/A";
         }
         else if ($('.edititem #dimensionRadio').prop('checked') == true) {
            sizeordimension = $(".edititem #dimensionRadio").val();
            dimensionFirst = $('.edititem #getDimensionFirst').val();
            dimensionSecond = $(".edititem #getDimensionSecond").val();
            dimensionUnitFirst = $(".edititem #getDimensionUnitFirst").val();
            dimensionUnitSecond = $(".edititem #getDimensionUnitSecond").val();
            dimension = dimensionFirst + " " + dimensionUnitFirst + " X " + dimensionSecond + " " + dimensionUnitSecond;
         }

         var qtyperunit = $('.edititem #getQtyPerUnit').val();
         var packingunit = $('.edititem #getPackingUnit').val();

         var gradeid = $('.edititem #getgrade').val();
         var code = $('.edititem #getCode').val();



         if (pid != "" && type != -1 && subtypeid != -1 /*&& HSN != "" */ && producttypeorcolor != "" && brandid != "-1" && ((sizeordimension == "size") || (sizeordimension == "dimension" && dimensionFirst != "" && dimensionSecond != "" && dimensionUnitFirst != -1 && dimensionUnitSecond != -1)) && qtyperunit != "" && packingunit != "-1" && gradeid != "-1" && code != "" /*&& gst != -1*/) {

            var param =
            {
               pid: pid,
               type: type,
               subtypeid: subtypeid,
               //HSN: HSN,
               producttypeorcolor: producttypeorcolor,
               brandid: brandid,
               dimension: dimension,
               qtyperunit: qtyperunit,
               packingunit: packingunit,
               gradeid: gradeid,
               code: code
               //gst: gst
            }

            //console.log(param);
            $.ajax({
               type: "POST",
               url: "./SearchAndManageProductAjax/updateProductInTableCheckSaveStatus.php",
               data: JSON.stringify(param),
               success: function (Data) {
                  //console.log(Data);
                  if (Data == "1") {
                     swal('Succesfully Updated Product', '', 'success');
                     $('.edititem').prop('hidden', true);
                     $('.searchitem').prop('hidden', false);
                     $('#data_table').prop('hidden', false);
                     $('.edititem #pid').val('');
                     ReloadTable();
                  }
                  else if (Data == "-3") {
                     console.log('Record Already Exists');
                     swal('Record Already Exists', '', 'info');
                  }
                  else if (Data == "-4") {
                     console.log('More Then One Record Found');
                     swal('Something Went Wrong', '', 'error');
                  }
                  else if (Data == "-6") {
                     console.log("Commit Fail");
                     swal('Something Went Wrong', '', 'error');
                  }
                  else if (Data == "-5") {
                     console.log("Error In Update Query ");
                     swal('Something Went Wrong', '', 'error');
                  }
                  else if (Data == "-2") {
                     console.log('Error Check Query');
                     swal('Something Went Wrong', '', 'error');
                  }
                  else if (Data == "-1") {
                     console.log("Parameters Empty");
                     swal('Something Went Wrong', '', 'error');
                  }
                  else {
                     console.log('Other Response Recieved');
                     swal('Something Went Wrong', '', 'error');
                  }
               }
            });
         }
         else {
            if (pid == "") {
               swal('Something Went Wrong', '', 'error');
            }
            swal("All fields are required", '', 'warning');
         }
      });

      $('.edititem #cancel').click(function () {
         $('.edititem').prop('hidden', true);
         $('.searchitem').prop('hidden', false);
         $('#data_table').prop('hidden', false);
         $('.edititem #pid').val('');
      });

      $(".sizeordimension").on('change', function () {
         if ($('.edititem #sizeRadio').prop('checked')) {
            $(".getDimension").prop('disabled', true);
            $(".getDimension").val('');
            $(".getDimensionSelect").val('-1');
         }
         else if ($('.edititem #dimensionRadio').prop('checked')) {
            $(".getDimension").prop('disabled', false);
         }
      });

      $("#category_name").on('change', function () {

         ResetSelectMenu($("#subcategories"));

         let cid = $('#category_name').val(); // cid == categoryid
         //console.log(cid);

         if (cid != '-1') {
            $.ajax({
               type: "POST",
               url: "./SearchAndManageProductAjax/getSubcategoriesFromCategories.php",
               data: { cid: cid },
               dataType: "json",
               success: function (Data) {
                  //console.log(Data);
                  if (Data[0].FLAG == 'OK') {
                     let n = Data.length;
                     for (let i = 1; i < n; i++) {
                        scn = Data[i].scn;
                        sci = Data[i].sci;
                        $("#subcategories").append(new Option(scn, sci));
                     }
                  }
                  else if (Data[0].FLAG == "NORECORDFOUND") {
                     console.log("No Subcategory Found For Given Category");
                     swal('No Subcategory Found For Given Category', '', 'warning');
                  }
                  else if (Data[0].FLAG == "NOTOK") {
                     console.log("Error In Executing Query");
                     swal('Something Went Wrong', '', 'error');
                  }
                  else {
                     console.log('Other Response Found');
                     swal('Something Went Wrong', '', 'error');
                  }
               },
               error: function (Data) {
                  console.log("Error In Ajax Call In Categories Change Event");
                  swal('Something Went Wrong', '', 'error');
               }
            });
         }
         else {
            ReloadSubcategoriesSelectMenu();
         }
      });

      $("#categoriesCheck").on('change', function () {
         if ($("#categoriesCheck").prop('checked') == false) {
            ReloadSubcategoriesSelectMenu();
            ReloadGradeSelectMenu();
            ReloadBrandSelectMenu();
         }
      });

      $("#subcategories").on('change', function () {

         ResetSelectMenu($("#getbrandname"));
         ResetSelectMenu($("#getgrade"));
         var subcatid = $("#subcategories").val();
         if (subcatid != "-1") {


            $.ajax({
               type: "POST",
               url: "./SearchAndManageProductAjax/getBrandsFromSubcategory.php",
               data: { subcatid: subcatid },
               dataType: 'json',
               success: function (Data) {
                  //console.log(Data);
                  if (Data[0].FLAG == "OKK") {
                     var n = Data.length;

                     for (var i = 1; i < n; i++) {
                        $("#getbrandname").append(new Option(Data[i].brandname, Data[i].brandid));
                     }
                  }
                  else if (Data[0].FLAG == "RECORDNOTFOUND") {
                     console.log("No Brands Found For Selected Category And Subcategory");
                     swal("No Brands Found For Selected Category And Subcategory", '', 'warning');
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


            $.ajax({
               type: "POST",
               url: "./SearchAndManageProductAjax/getGradesFromSubcategory.php",
               data: { subcatid: subcatid },
               dataType: 'json',
               success: function (Data) {
                  //console.log(Data);
                  if (Data[0].FLAG == "OKK") {
                     var n = Data.length;

                     for (var i = 1; i < n; i++) {
                        $("#getgrade").append(new Option(Data[i].gradetext, Data[i].gradeid));
                        //$("#selectgrade").append('<option value='+Data[i].gradeid+' showvalue='+Data[i].gradetext+'>'+Data[i].gradetext+'</option>');
                     }
                  }
                  else if (Data[0].FLAG == "RECORDNOTFOUND") {
                     console.log("No Grade Found For Selected Category And Subcategory");
                     swal("No Grade Found For Selected Category And Subcategory", '', 'warning');
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
            ReloadGradeSelectMenu();
            ReloadBrandSelectMenu();
         }

      });

      $("#subcategoriesCheck").on('change', function () {
         if ($("#subcategoriesCheck").prop('checked') == false) {
            ReloadSubcategoriesSelectMenu();
            ReloadGradeSelectMenu();
            ReloadBrandSelectMenu();
         }
      });

      $("#getgrade").on('change', function () {

      });

      $("#gradeCheck").on('change', function () {
         if ($("#gradeCheck").prop('checked') == false) {
            //ReloadSubcategoriesSelectMenu();
            ReloadGradeSelectMenu();
            //ReloadBrandSelectMenu();
         }
      });

      $("#brandnameCheck").on('change', function () {
         if ($("#brandnameCheck").prop('checked') == false) {
            //ReloadSubcategoriesSelectMenu();
            //ReloadGradeSelectMenu();
            ReloadBrandSelectMenu();
         }
      });

      function ResetSelectMenu(sm) {
         sm.empty();
         sm.append(new Option("Select", "-1"));
      }

      function ReloadSubcategoriesSelectMenu() {

         ResetSelectMenu($("#subcategories"));

         $.ajax({
            type: "POST",
            url: "./SearchAndManageProductAjax/getAllSubCategories.php",
            dataType: 'json',
            success: function (Data) {
               //console.log(Data);
               if (Data[0].FLAG == 'OK') {
                  let n = Data.length;
                  for (let i = 1; i < n; i++) {
                     scn = Data[i].scn;
                     sci = Data[i].sci;
                     $("#subcategories").append(new Option(scn, sci));
                  }
               }
               else if (Data[0].FLAG == "NORECORDFOUND") {
                  console.log("No Subcategory Found For Given Category");
                  swal('No Subcategory Found For Given Category', '', 'warning');
               }
               else if (Data[0].FLAG == "NOTOK") {
                  console.log("Error In Executing Query");
                  swal('Something Went Wrong', '', 'error');
               }
               else {
                  console.log('Other Response Found');
                  swal('Something Went Wrong', '', 'error');
               }
            },
            error: function (Data) {
               console.log("Error In ./SearchAndManageProductAjax/getAllSubCategories.php   Ajax Call");
            }
         });
      }

      function ReloadGradeSelectMenu() {

         ResetSelectMenu($("#getgrade"));

         $.ajax({
            type: "POST",
            url: "./SearchAndManageProductAjax/getGrades.php",
            dataType: 'json',
            success: function (Data) {
               if (Data[0].FLAG == 'OKK') {
                  var n = Data.length;
                  for (var i = 1; i < n; i++) {
                     $("#getgrade").append(new Option(Data[i].gradetext, Data[i].gradeid));
                  }
                  //$("#getgrade").prop('disabled', false);
               }
               else if (Data[0] == 'ERRORINEXECUTINGQUERY') {
                  console.log("ERROR IN EXECUTING QUERY");
                  swal('Something Went Wrong', '', 'error');
               }
               else {
                  console.log('OTHER THEN FLAG');
                  swal('Something Went Wrong', '', 'error');
               }
            },
            error: function (Data) {
               console.log(Data);
               swal('Something Went Wrong', '', 'error');
            }
         });
      }

      function ReloadBrandSelectMenu() {

         ResetSelectMenu($("#getbrandname"));

         $.ajax({
            type: "POST",
            url: "./SearchAndManageProductAjax/getBrandNames.php",
            dataType: 'json',
            success: function (Data) {
               if (Data[0].FLAG == 'OKK') {
                  var n = Data.length;
                  for (var i = 1; i < n; i++) {
                     $("#getbrandname").append(new Option(Data[i].brandname, Data[i].brandid));
                  }
                  //$("#getbrandname").prop('disabled', false);
               }
               else if (Data[0] == 'ERRORINEXECUTINGQUERY') {
                  console.log("ERROR IN EXECUTING QUERY");
                  swal('Something Went Wrong', '', 'error');
               }
               else {
                  console.log('OTHER THEN FLAG');
                  swal('Something Went Wrong', '', 'error');
               }
            },
            error: function (Data) {
               console.log(Data);
               swal('Something Went Wrong', '', 'error');
            }
         });
      }

      function ReloadDimesionSelectMenu() {

         ResetSelectMenu($("#getdimension"));
         $.ajax({
            type: "POST",
            url: "./SearchAndManageProductAjax/getAllDimesnsions.php",
            dataType: 'json',
            success: function (Data) {
               //console.log(Data);
               if (Data[0].FLAG == "OKK") {
                  var n = Data.length;

                  for (var i = 1; i < n; i++) {
                     $("#getdimension").append(new Option(Data[i].dimension, Data[i].dimension));
                  }
               }
               else if (Data[0].FLAG == "NORECORD") {
                  console.log("No Record Found");
                  swal("No Record Found", '', 'info');
               }
               else if (Data[0].FLAG == "ERREXECUTINGQUERY") {
                  console.log('Error In Executing Query');
                  swal('Something Went Wrong', '', 'error');
               }
               else {
                  console.log("Other Response FOund");
                  swal('Something Went Wrong', '', 'error');
               }
            },
            error: function (Data) {
               console.log("Erroe In ./SearchAndManageProductAjax/getAllDimesnsions.php   AJax Call");
               swal('Something Went Wrong', '', 'error');
            }
         });
      }

      function ReloadQtyPerUnitSelectMenu() {
         ResetSelectMenu($("#getqtyperunit"));

         $.ajax({
            type: "POST",
            url: "./SearchAndManageProductAjax/getQtyPerUnit.php",
            dataType: 'json',
            success: function (Data) {
               //console.log(Data);
               if (Data[0].FLAG == "OKK") {
                  var n = Data.length;

                  for (var i = 1; i < n; i++) {
                     $("#getqtyperunit").append(new Option(Data[i].qtyperunit, Data[i].qtyperunit));
                  }
               }
               else if (Data[0].FLAG == "NORECORD") {
                  console.log("No Record Found");
                  swal("No Record Found", '', 'warning');
               }
               else if (Data[0].FLAG == "ERREXECUTINGQUERY") {
                  console.log('Error In Executing Query');
                  swal('Something Went Wrong', '', 'error');
               }
               else {
                  console.log("Other Response FOund");
                  swal('Something Went Wrong', '', 'error');
               }
            },
            error: function (Data) {
               console.log("Erroe In ./SearchAndManageProductAjax/getAllDimesnsions.php   AJax Call");
               swal('Something Went Wrong', '', 'error');
            }
         });
      }

      function ReloadPackingUnitSelectMenu() {
         $("#getpackingunit").val("-1");
      }

      function ReloadProductTypeColorMenu() {
         //function getProductTypeColor(){
         ResetSelectMenu($("#getProductTypeColor"));
         $.ajax({
            type: "POST",
            url: "./SearchAndManageProductAjax/getProductTypeColor.php",
            dataType: 'json',
            success: function (Data) {
               //console.log(Data);
               if (Data[0].FLAG == "OKK") {
                  var n = Data.length;

                  for (var i = 1; i < n; i++) {
                     $("#getProductTypeColor").append(new Option(Data[i].producttypecolor, Data[i].producttypecolor));
                  }
               }
               else if (Data[0].FLAG == "NORECORD") {
                  console.log("No Record Found");
                  swal("No Record Found", '', 'warning');
               }
               else if (Data[0].FLAG == "ERREXECUTINGQUERY") {
                  console.log('Error In Executing Query');
                  swal('Something Went Wrong', '', 'error');
               }
               else {
                  console.log("Other Response FOund");
                  swal('Something Went Wrong', '', 'error');
               }
            },
            error: function (Data) {
               console.log("Erroe In  ./SearchAndManageProductAjax/getProductTypeColor.php AJax Call");
               swal('Something Went Wrong', '', 'error');
            }
         });
      }

      function ReloadCodeSelectMenu() {
         ResetSelectMenu($("#getcode"));

         $.ajax({
            type: "POST",
            url: "./SearchAndManageProductAjax/getCode.php",
            dataType: 'json',
            success: function (Data) {
               //console.log(Data);
               if (Data[0].FLAG == "OKK") {
                  var n = Data.length;

                  for (var i = 1; i < n; i++) {
                     $("#getcode").append(new Option(Data[i].code, Data[i].code));
                  }
               }
               else if (Data[0].FLAG == "NORECORD") {
                  console.log("No Record Found");
                  swal("No Record Found", '', 'warning');
               }
               else if (Data[0].FLAG == "ERREXECUTINGQUERY") {
                  console.log('Error In Executing Query');
                  swal('Something Went Wrong', '', 'error');
               }
               else {
                  console.log("Other Response FOund");
                  swal('Something Went Wrong', '', 'error');
               }
            },
            error: function (Data) {
               console.log("Erroe In  ./SearchAndManageProductAjax/getCode.php AJax Call");
               swal('Something Went Wrong', '', 'error');
            }
         });
      }

      function ReloadGSTSelectMenu() {
         $("getgst").val("-1");
      }

   });

   function ReloadTable() {

      $("#data_table tbody").empty();


      let query = "SELECT *, productmst.RecStatus as recordstatus FROM `productmst` join brandnames, grades, subcategories, categories WHERE productmst.BrandId = brandnames.BrandId and productmst.GradeId = grades.GradeId and subcategories.subcategory_id= productmst.ProductSubCategoryID and subcategories.category_id= categories.category_id   ";

      let validflag = 0;

      if ($('#categoriesCheck').prop('checked') == true) {

         if ($("#category_name").val() != '-1') {
            query = query + " and subcategories.category_id='" + $("#category_name").val() + "' ";
         }
         else {
            validflag = 1;
            swal("Please Select Category", '', 'warning');
         }
      }

      if ($('#subcategoriesCheck').prop('checked') == true) {

         if ($('#subcategories').val() != '-1') {
            query = query + " and productmst.ProductSubCategoryID='" + $('#subcategories').val() + "' ";
         }
         else {
            validflag = 1;
            swal("Please Select Subcategory", '', 'warning');
         }
      }

      if ($('#hsncodeCheck').prop('checked') == true) {

         if ($('#hsn').val() != "") {
            query = query + " and ProductHSNCode='" + $('#hsn').val() + "' ";
         }
         else {
            validflag = 1;
            swal("Please Enter HSN Code", '', 'warning');
         }
      }

      if ($('#typeorcolorCheck').prop('checked') == true) {

         if ($('#getProductTypeColor').val() != '-1') {
            query = query + " and ProductTypeColor='" + $('#getProductTypeColor').val() + "' ";
         }
         else {
            validflag = 1;
            swal("Please Enter Type/Color Code", '', 'warning');
         }
      }

      if ($('#brandnameCheck').prop('checked') == true) {

         if ($('#getbrandname').val() != '-1') {
            query = query + " and productmst.BrandId='" + $('#getbrandname').val() + "' ";
         }
         else {
            validflag = 1;
            swal('Please Select Brand Name', '', 'warning');
         }
      }

      if ($('#dimensionCheck').prop('checked') == true) {

         if ($('#getdimension').val() != '-1') {
            query = query + " and SizeOrDimension='" + $('#getdimension').val() + "' ";
         }
         else {
            validflag = 1;
            swal('Please Select Dimension', '', 'warning');
         }
      }

      if ($('#qtyperunitCheck').prop('checked') == true) {

         if ($('#getqtyperunit').val() != '-1') {
            query = query + " and QtyPerUnit=" + $('#getqtyperunit').val() + " ";
         }
         else {
            validflag = 1;
            swal('Please Select Qty Per Unit', '', 'warning');
         }
      }

      if ($('#packingunitCheck').prop('checked') == true) {

         if ($('#getpackingunit').val() != '-1') {
            query = query + " and PackingUnit='" + $('#getpackingunit').val() + "' ";
         }
         else {
            validflag = 1;
            swal('Please Select Packing Unit', '', 'warning');
         }
      }

      if ($('#gradeCheck').prop('checked') == true) {

         if ($('#getgrade').val() != '-1') {
            query = query + " and productmst.GradeId='" + $('#getgrade').val() + "' ";
         }
         else {
            validflag = 1;
            swal('Please Select Grade', '', 'warning');
         }
      }

      if ($('#codeCheck').prop('checked') == true) {

         if ($('#getcode').val() != '-1') {
            query = query + " and Code='" + $('#getcode').val() + "' ";
         }
         else {
            validflag = 1;
            swal('Please Select Code No. / Design No. / Model No.','', 'warning');
         }
      }

      if ($('#gstCheck').prop('checked') == true) {

         if ($('#getgst').val() != '-1') {
            query = query + " and ProductGST=" + $('#getgst').val() + " ";
         }
         else {
            validflag = 1;
            swal('Please Select GST', '', 'warning');
         }
      }

      if (validflag == 0) {

         //console.log(query);
         $.ajax({
            method: "POST",
            url: "./SearchAndManageProductAjax/searchByParam.php",
            data: { query: query },
            dataType: 'json',
            success: function (Data) {
               //console.log(Data);

               if (Data[0].FLAG == "RECORDFOUND") {
                  let n = Data.length;
                  //console.log(Data);

                  for (let i = 1; i < n; i++) {
                     var type = Data[i].type;
                     var subtype = Data[i].subtype;
                     var hsn = Data[i].hsn;
                     var typeorcolor = Data[i].typeorcolor;
                     var brandname = Data[i].brandname;
                     var dimension = Data[i].dimension;
                     var qtyperunit = Data[i].qtyperunit;
                     var packingunit = Data[i].packingunit;
                     var grade = Data[i].gradetext;
                     var code = Data[i].code;
                     var gst = Data[i].gst;
                     var productid = Data[i].productid;
                     var recstatus = Data[i].recstatus;
                     //$('.edititem #pid').val(productid);

                     var btncolor = '';
                     var btntext = '';

                     if (recstatus == 1) {
                        btncolor = 'btn-danger';
                        btntext = 'Deactive';
                     }
                     else {
                        btncolor = 'btn-success';
                        btntext = 'Active';
                     }

                     $('#data_table tbody:last-child').append(
                        '<tr>' +
                        '<td>' + type + '</td>' +
                        '<td>' + subtype + '</td>' +
                        '<td>' + hsn + '</td>' +
                        '<td>' + typeorcolor + '</td>' +
                        '<td>' + brandname + '</td>' +
                        '<td>' + dimension + '</td>' +
                        '<td>' + qtyperunit + '</td>' +
                        '<td>' + packingunit + '</td>' +
                        '<td>' + grade + '</td>' +
                        '<td>' + code + '</td>' +
                        '<td>' + gst + '</td>' +
                        '<td>' + 
                           '<input type="button" class="btn btn-primary editbtn" pid="' + productid + '" value="Edit"> ' +
                           ' <input type="button" class="btn ' + btncolor + '  changestatus" value="' + btntext + '"  productid="' + productid + '"  recstatus="' + recstatus + '"></td>' +
                        '</tr>');
                  }

               }
               else if (Data[0].FLAG == "NORECORDFOUND") {
                  swal('NO Record Found For Your Search Result', '', 'info');
               }
               else if (Data[0].FLAG == "ERRORINQUERY") {
                  swal('Something Went Wrong', '', 'error');
               }
            },
            error: function (Data) {
               console.log("Error In ./SearchAndManageProductAjax/searchByParam.php  Ajax Call");
            }
         });
      }
      else {
         console.log('CURRUPTED');
      }
   }

</script>
<script>
   function SomeDeleteRowFunction(o) {

      var p = o.parentNode.parentNode;
      p.parentNode.removeChild(p);
   }
</script>

</html>