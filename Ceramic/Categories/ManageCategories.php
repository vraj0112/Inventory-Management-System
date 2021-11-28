<?php
    include('./config.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Categories</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <style>
        .old-category:disabled {
            background-color: lightslategrey;
        }
    </style>
</head>

<body>
    <div class="container-fluid col-lg-12">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header" style="background-color: #2B60DE">
                        <h3 class="card-title" style="color: white" align="center">Manage Categories</h3>
                    </div>
                    <div class="card-body" style="background-color: #8da9bd;">
                        <!-- <form> -->
                        <!-- <div>
                            <label for="ManageOption" class="form-label">Options:</label>
                            <div class="form-check form-check-inline">
                                <input type="radio" id='category' name='ManageOption' class='form-check-input'>
                                <label for="category" class="form-label">Category</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" id='SubCategory' name='ManageOption' class='form-check-input'>
                                <label for="SubCategory" class="form-label">SubCategory</label>
                            </div>
                        </div> -->

                        <!-- <div>
                            <label for="Function" class="form-label">Function :</label>
                            <div class="form-check form-check-inline">
                                <input type="radio" id='add' name='Function' class='form-check-input'>
                                <label for="Add" class="form-label">Add</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" id='Update' name='Function' class='form-check-input'>
                                <label for="Update" class="form-label">Update</label>
                            </div>
                        </div> -->

                        <!-- <div class="row mt-2">
                            <div class="col-md-2 form-group">
                                <label for="categoryname" class="form-label">Category :</label>
                            </div>
                            <div class="col-md-4 form-group">
                                <input type="text" id='getCategoryName' class="form-control" disabled>
                            </div>
                            <div class="col-md-2 form-group">
                                <label for="selectcategory" class="form-label">Category :</label>
                            </div>
                            <div class="col-md-4 form-group">
                                <select name="Category" id="SelectCategory" class="form-select" disabled>
                                    <option value="-1">Select</option>
                                </select>
                            </div>
                        </div> -->

                        <div>
                            <div class="row">
                                <div class="col-md-2">
                                    <label class='form-label' for="CategoryName">Category Name : </label>
                                </div>
                                <div class="col-md-4">
                                    <input class='form-control' type="text" id='CategoryName'>
                                </div>
                                <div class="col-md-2">
                                    <label class='form-label' for="OldCategoryName" id='OldCategoryLabel' hidden>Old
                                        Category Name : </label>
                                </div>
                                <div class="col-md-4">
                                    <input class='form-control old-category' type="text" id='OldCategoryName' disabled
                                        hidden>
                                    <input type="text" id='OldCategoryId' value='' disabled hidden>
                                </div>
                            </div>
                            <button id='addbtn' class='btn btn-primary mt-3'>Add</button>
                            <button id='savebtn' class='btn btn-primary mt-3' disabled>Save</button>
                        </div>

                        <table class="table" id="data_table">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>SubCategories</th>
                                    <!-- <th>SubCategory</th> -->
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody id='tblbody'>
                                <?php
                                    $query = "SELECT * from categories";
                                    $result = mysqli_query($conn, $query);
                                    if($result->num_rows > 0)
                                    {
                                        while($row = $result->fetch_assoc())
                                        {
                                            $category_no = $row['category_id'];
                                            $category = $row['category_name'];
                                            $active_status = $row['active_status'];
                                            $color;
                                            $btnname;
                                            if($active_status == '1')
                                            {
                                                $color = 'success';
                                                $btnname = 'Deactive';
                                            }
                                            else
                                            {
                                                $color = 'danger';
                                                $btnname = 'Active';
                                            }
                                            echo
                                            "<tr>
                                                <td>".$category_no."</td>
                                                <td>".$category."</td>
                                                <td>
                                                    <button class='btn btn-success btn-edit' cid=".$category_no.">Edit</button>
                                                    <button class='btn btn-".$color." btn-active' cid=".$category_no." as=".$active_status.">".$btnname."</button>
                                                </td>
                                            </tr>";
                                        }
                                    }
                                    else
                                    {
                                        echo "<script> swal('No Categories Found', '', 'info')</script>";
                                    }
                                ?>
                            </tbody>
                        </table>
                        <!-- </form>    -->
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function () {
            $("tbody").on('click', '.btn-active', function () {
                let id = $(this).attr("cid");
                let as = $(this).attr("as");
                let t = $(this);
                console.log(as);
                if (id != '' && as != '') {
                    let myobj = { cid: id, as: as };
                    //console.log(JSON.stringify(myobj));
                    $.ajax({
                        type: "POST",
                        url: 'changeActiveStatus.php',
                        data: JSON.stringify(myobj),
                        success: function (Data) {
                            //console.log(id);
                            if (as == '1' && Data == '1') {
                                t.attr("as", '0');
                                t.removeClass('btn-success');
                                t.addClass('btn-danger');
                                t.html('Active');
                            }
                            else if (as == '1' && Data == '0') {
                                swal('Status Not Changed', '', 'warning');
                            }
                            else if (as == '0' && Data == '1') {
                                t.attr("as", '1');
                                t.removeClass('btn-danger');
                                t.addClass('btn-success');
                                t.html('Deactive');
                            }
                            else {
                                swal('Status Not Changed', '', 'warning');
                            }
                        }
                    });
                }
            });

            $("tbody").on('click', '.btn-edit', function () {
                let id = $(this).attr("cid");
                let t = $(this);

                if (id != '') {
                    let myobj = { cid: id };
                    $.ajax({
                        type: "POST",
                        url: 'editCategoryfetchData.php',
                        data: JSON.stringify(myobj),
                        success: function (Data) {
                            console.log(Data);
                            if (Data) {


                                $('#OldCategoryId').val(id);
                                $("#CategoryName").val(Data);
                                $("#OldCategoryLabel").attr('hidden', false);
                                $("#OldCategoryName").attr('hidden', false);
                                $("#OldCategoryName").val(Data);
                                $("#addbtn").attr('disabled', true);
                                $("#savebtn").attr('disabled', false);

                            }
                            else {
                                swal('Something Went Wrong', '', 'error');
                            }
                        }
                    });
                }
            });

            $('#savebtn').on('click', function () {
                let id = $('#OldCategoryId').val();
                let category_name = $('#CategoryName').val();
                let myobj = { cid: id, cname: category_name };

                if (category_name != '' && id != '') {
                    $.ajax({
                        type: "POST",
                        url: 'editCategory.php',
                        data: JSON.stringify(myobj),
                        success: function (Data) {
                            //console.log(Data);
                            if (Data) {

                                if (Data == '1') {
                                    swal('Category Updated Successfully', '', 'success').then(()=>{location.reload(true)});
                                }
                                else if (Data = '-3') {
                                    swal('Category Already Exists', '', 'info');
                                }
                                else if (Data = '-1') {
                                    swal('Something Went Wrong', '', 'error');
                                }
                                else if (Data = '-2') {
                                    swal('Something Went Wrong', '', 'error');
                                }
                                else if (Data = '-3') {
                                    swal('Something Went Wrong', '', 'error');
                                }
                                else if (Data = '-4') {
                                    swal('Something Went Wrong', '', 'error');
                                }
                                else if (Data = '-5') {
                                    swal('Something Went Wrong', '', 'error');
                                }
                                else if (Data = '-6') {
                                    swal('Something Went Wrong', '', 'error');
                                }
                                else {
                                    swal('Something Went Wrong', '', 'error');
                                }

                                //$('#OldCategoryId').val('');
                                //$("#CategoryName").val('');
                                //$("#OldCategoryLabel").attr('hidden', true);
                                //$("#OldCategoryName").attr('hidden', true);
                                //$("#OldCategoryName").val('');
                                //$("#addbtn").attr('disabled', false);
                                //$("#savebtn").attr('disabled', true);
                            }
                            else {
                                swal('Something Went Wrong', '', 'error');
                            }
                        }
                    });
                }
                else {
                    swal('Please Fill All The Field', '', 'info');
                    location.reload(true);
                }
            });

            $('#addbtn').on('click', function () {
                let category_name = $('#CategoryName').val();

                if (category_name != '') {
                    myobj = { cname: category_name };
                    $.ajax({
                        type: "POST",
                        url: 'addCategory.php',
                        data: JSON.stringify(myobj),
                        success: function (Data) {
                            //console.log(Data);

                            if (Data == '1') {
                                swal('Category Added', '', 'success').then(()=>{location.reload(true)});
                                $('#CategoryName').val('');
                            }
                            else if (Data == '-4') {
                                swal('Category Alredy Exists', '', 'info');
                                $('#CategoryName').val('');
                            }
                            else if (Data == '-1') {
                                console.log('commit fail');
                                swal('Oops!', 'Something Went Wrong!', 'error');
                            }
                            else if (Data == '-2') {
                                console.log('transflag err');
                                swal('Oops!', 'Something Went Wrong!', 'error');
                            }
                            else if (Data == '-3') {
                                console.log('err in insert query');
                                swal('Oops!', 'Something Went Wrong!', 'error');
                            }
                            else if (Data == '-5') {
                                console.log('MORE THen one record or No record found');
                                swal('Oops!', 'Something Went Wrong!', 'error');
                            }
                            else if (Data == '-6') {
                                console.log('err in checking query');
                                swal('Oops!', 'Something Went Wrong!', 'error');
                            }
                            else if (Data == '-7') {
                                console.log('categoryname name empty');
                                swal('Oops!', 'Something Went Wrong!', 'error');
                            }
                            else {
                                console.log('Other Then Flag Recived');
                                swal('Oops!', 'Something Went Wrong!', 'error');
                            }
                        }
                    });
                }
                else {
                    swal('Please Fill All The Fields', '', 'info');
                }
            });

        });
    </script>
</body>

</html>