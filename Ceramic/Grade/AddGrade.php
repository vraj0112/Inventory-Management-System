<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Grade</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
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
                        <center>
                            <h3 class="card-title" style="color: white">Add Grade</h3>
                        </center>
                    </div>
                    <div class="card-body" style="background-color: #8da9bd;">
                        <div class="row mt-4">
                            <div class="col-md-2">
                                <label class="mt-1" for="">Select Grade : </label>
                            </div>
                            <div class="col-md-6">
                                <select name="" id="selectgrade" class="form-select" disabled>
                                    <option value="-1">Select</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-2">
                                <label class="mt-1" for="">Grade : </label>
                            </div>

                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-1">
                                        <input class='form-check-input mt-2' type="checkbox" id='addcheck'>
                                    </div>
                                    <div class="col-md-11">
                                        <input id='getGrade' type="text" brandid="" class="form-control" disabled>
                                        <input id='tempgradeid' type="hidden" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="row mt-4">
                            <div class="col-md-6">
                                <button class='btn btn-primary' id='searchbtn'>Search</button>
                                <button class='btn btn-primary' id='addbtn' disabled>Add</button>
                                <button class='btn btn-primary' id="savebtn" disabled>Save</button>
                                <button class='btn btn-primary' id='cancelbtn' disabled>Cancel</button>
                            </div>
                        </div>



                        <table class="mt-4" id='gradetbl' hidden>
                            <thead>
                                <tr>
                                    <th width="5%">GradeID</th>
                                    <th>Grade Text</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="mt-4">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    $(function () {

        ReloadSelectGrade();

        $("#addcheck").on('change', function () {

            if ($(this).prop('checked') == true) {
                $("#selectgrade").val("-1");  // select grade will be set to default 
                $("#selectgrade").prop('disabled', true); // disable select grade when check box is checked
                $("#getGrade").prop('disabled', false); // eneable add grade text box
                $("#addbtn").prop('disabled', false); // enebles add btn
                $("#savebtn").prop('disabled', true); // enables save btn 
                $("#cancelbtn").prop('disabled', false); // disabales cancel btn
                $("#searchbtn").prop('disabled', true); // disables Search btn
                ResetTableWithHide();
            }
            else {
                $("#selectgrade").prop('disabled', false); // eneable select grade when check box is checked
                $("#getGrade").prop('disabled', true); // disable add grade text box
                $("#addbtn").prop('disabled', true); // disables add btn
                $("#savebtn").prop('disabled', true); // disables save btn 
                $("#cancelbtn").prop('disabled', true); // disabales cancel btn
                $("#searchbtn").prop('disabled', false); // eneables Search btn
                $("#selectgrade").val("-1"); // set select grade to default
                $("#getGrade").val(""); // set "" in get Grade txet box
            }
        });

        $("#cancelbtn").click(function(){
            Reload();
            ResetTableWithHide()
        });

        $("#addbtn").click(function(){

            var gradetext = $("#getGrade").val();
            
            if(gradetext != "")
            {
                gradetext = gradetext.toUpperCase();

                $.ajax({
                    type: "POST",
                    url: "./AddGradeAjax/addNewGradeInDatabase.php",
                    data: {gradetext : gradetext},
                    success: function(Data){
                        if(Data == "1")
                        {
                            Reload();
                            ReloadSelectGrade();
                            swal("Grade Added Successfully", '', 'success');
                        }
                        else if(Data == "-1")
                        {
                            console.log("Record Exists For Given Grade Text");
                            swal("Grade Already Exists", '', 'info');
                        }   
                        else if(Data == "-5")
                        {
                            console.log("Error In finding grade text exists or not in Data base");
                            swal("Something Went Wrong", '', 'error');
                        }
                        else if(Data == "-3")
                        {
                            console.log("Failes To Insert Into Grades");
                            swal("Something Went Wrong", '', 'error');
                        }
                        else if(Data == "-2")
                        {
                            console.log("Commit Failuer");
                            swal("Something Went Wrong", '', 'error');
                        }
                        else if(Data == '-4')
                        {
                            console.log("Other Then 0 and 1 Record found for GradeText");
                            swal("Something Went Wrong", '', 'error');
                        }
                        else
                        {
                            console.log('Other Then Expecting Response Recieved');
                            swal("Something Went Wrong", '', 'error');
                        }
                    },
                    error: function(Data){
                        console.log("Error In Adding New Grade Text In The Database Ajax Call");
                        swal("Something Went Wrong", '', 'error');
                    }
                });

            }
            else
            {
                swal("Please Enter Grade Text", '', 'warning');
            }
        });

        $("#searchbtn").click(function(){

            ResetTable();
            var gradeid = $("#selectgrade").val();

            if(gradeid != "-1")
            {
                $.ajax({
                    type: "POST",
                    url: "./AddGradeAjax/searchByGradeId.php",
                    data: {gradeid : gradeid},
                    dataType: 'json',
                    success: function(Data){
                        //console.log(Data);
                        if(Data[0].FLAG == "OKK")
                        {
                            var gradeid = Data[1].gradeid;
                            var gradetext = Data[1].gradetext;
                            var recstatus = Data[1].recstatus;
                            var btncolor = '';
                            var btntext = '';
                            if(recstatus == 1){
                                btntext='Deactive';
                                btncolor = 'btn-danger';
                            }
                            else{
                                btntext = 'Active';
                                btncolor = 'btn-success';
                            }   
                            $("#gradetbl tbody").append(
                                '<tr>' +
                                    '<td>' + gradeid + '</td>' +
                                    '<td>' + gradetext + '</td>' +
                                    '<td>' +
                                        '<button class="btn btn-success btn-edit" gradeid='+Data[1].gradeid+' gradetext="'+Data[1].gradetext+'">Edit</button> ' +
                                        ' <button class="btn '+ btncolor +' activestatus"  recstatus="'+recstatus+'"  gradeid="'+ gradeid +'">'+ btntext +'</button>' +
                                        '</td>' +
                                '</tr>'
                            );
                            $("#gradetbl").prop('hidden', false);
                        }
                        else if(Data[0].FLAG == "GRADEIDNOTFOUND")
                        {
                            console.log("GRADE ID NOT FOUND IN PHP FILE");
                            swal('Something Went Wrong', '', 'error');
                        }
                        else if(Data[0].FLAG == "ESBGIQ")
                        {
                            console.log("Error In Search By Grade Id Query");
                            swal('Something Went Wrong', '', 'error');
                        }
                        else if(Data[0].FLAG == 'NRFFGI')
                        {
                            console.log("No Record Found For Grade Id");
                            swal('Something Went Wrong', '', 'error');
                        }
                        else
                        {
                            console.log('Other Then Expecting Response Recieved');
                            swal('Something Went Wrong', '', 'error');
                        }
                    },
                    error: function(Data){
                        console.log('Error In Getting Grade Details By Grade Id On Search Btn Click Ajax Call Error');
                        swal('Something Went Wrong', '', 'error');
                    }
                });
            }
            else
            {
                ResetTable();
                swal("Please Select Grade", '', 'info');
            }

        });

        $("#gradetbl tbody").on('click', '.btn-edit', function(){
            console.log($(this).attr('gradeid'));

            $("#selectgrade").prop('disabled', true);
            $("#getGrade").prop('disabled', false);
            $("#getGrade").val($(this).attr('gradetext'));
            $("#searchbtn").prop('disabled', true); // disables Search btn
            $("#addbtn").prop('disabled', true); // disables add btn
            $("#savebtn").prop('disabled', false); // enables save btn 
            $("#cancelbtn").prop('disabled', false); // enabales cancel btn
            $("#addcheck").prop('disabled', true); // disables addcheck btn
            $("#tempgradeid").val($(this).attr('gradeid'));

        });

        $("#savebtn").click(function(){
            var gradeid = $("#tempgradeid").val();

            if(gradeid != "")
            {
                if($("#getGrade").val() != "")
                {
                    var gradetext = $('#getGrade').val();
                    gradetext = gradetext.toUpperCase();
                    $.ajax({
                        type: "POST",
                        url: './AddGradeAjax/editGradeTextFromGradeId.php',
                        data: {gradeid : gradeid, gradetext : gradetext},
                        //dataType: 'json',
                        success: function(Data){
                            console.log(Data);
                            if(Data == '1')
                            {
                                ResetTableWithHide();
                                ReloadSelectGrade();
                                Reload();
                                swal("Succesfully Updated", '', 'success');
                            }
                            else if(Data == "-5")
                            {
                                console.log('Same Grade Text Available In Database');
                                swal('Grade Already Exists', '', 'info');

                            }
                            else if(Data == '-1')
                            {
                                console.log("Parameter Empty");
                                swal('Something Went Wrong', '', 'error');

                            }
                            else if(Data == '-2')
                            {
                                console.log("Error In Cheacking For Same value available in Database or not");
                                swal('Something Went Wrong', '', 'error');
                            }
                            else if(Data == '-3')
                            {
                                console.log("Error In Updating Grade Text");
                                swal('Something Went Wrong', '', 'error');

                            }
                            else if(Data == '-4')
                            {
                                console.log('Commit Failure');
                                swal('Something Went Wrong', '', 'error');

                            }
                            else if(Data == "-6")
                            {
                                console.log("Error In finding No Of Record");
                                swal('Something Went Wrong', '', 'error');
                            }
                            else
                            {
                                console.log('Other Then Expecting Response Recieved');
                                swal('Something Went Wrong', '', 'error');
                            }
                        },
                        error: function(Data){
                            console.log('Error In Edit Grade Text From Grade Id Ajax Call');
                            swal('Something Went Wrong', '', 'error');
                        }
                    });
                }
                else
                {
                    swal('Please Fill Grade Text', '', 'warning');
                }
            }
            else
            {
                console.log('Not Getting Grade Id Form tempgradeid');
                swal('Something Went Wrong', '', 'error');
            }
        });

        $("#gradetbl tbody").on('click', '.activestatus', function(){
            var gradeid = $(this).attr('gradeid');
            var recstatus = $(this).attr('recstatus');
            var rowref = $(this);

            $.ajax({
                type: "POST",
                url: './AddGradeAjax/changeActiveStatus.php',
                data: {gradeid:gradeid, recstatus: recstatus},
                success: function(Data){
                    if(Data == '1'){
                        var btntext = '';
                        var btncolor = '';
                        var oldbtncolor = '';
                        if(recstatus == 1){
                            btncolor = 'btn-success';
                            btntext = 'Active';
                            oldbtncolor = 'btn-danger';
                        }
                        else{
                            btncolor = 'btn-danger';
                            btntext  = 'Deactive';
                            oldbtncolor = 'btn-success';
                        }

                        rowref.removeClass(oldbtncolor);
                        rowref.addClass(btncolor);
                        rowref.html(btntext);
                        
                        
                        if(recstatus == 1){
                            rowref.attr('recstatus', '0');
                            swal('Grade Deactivated', '', 'warning');
                        }   
                        else{
                            rowref.attr('recstatus', '1');
                            swal('Grade Activated', '', 'success');
                        }
                    }
                    else if(Data == '-1'){
                        console.log('Commit Fail');
                        swal('Something Went Wrong', '', 'error');
                    }
                    else if(Data == '-2'){
                        console.log('err in update query');
                        swal('Something Went Wrong', '', 'error');
                    }
                    else{
                        console.log('other flag recived');
                        swal('Something Went Wrong', '', 'error');
                    }
                },
                error: function(Data){
                    console.log('err in ./AddGradeAjax/changeActiveStatus.php  Ajax Call');
                    swal('Something Went Wrong', '', 'error');
                }
            });

        });

        function Reload() {

            $("#selectgrade").prop('disabled', false); // disable select grade when reloaded
            $("#getGrade").prop('disabled', true); // disable add grade text box
            $("#addbtn").prop('disabled', true); // disables add btn
            $("#savebtn").prop('disabled', true); // disables save btn 
            $("#cancelbtn").prop('disabled', true); // disabales cancel btn
            $("#searchbtn").prop('disabled', false); // eneables Search btn
            $("#addcheck").prop('checked', false);  // unchecks add check checkbox
            $("#selectgrade").val("-1"); // set select grade to default
            $("#getGrade").val(""); // set "" in get Grade txet box
            $("#addcheck").prop('disabled', false); // enebles add check cheackbox           
            $("#tempgradeid").val(""); // resets tempgradeid
        }

        function ReloadSelectGrade(){

            $("#selectgrade").empty();
            $("#selectgrade").append(new Option('Select', '-1'));

            $.ajax({
                type: "POST",
                url: "./AddGradeAjax/getGrades.php",
                dataType: 'json',
                success: function(Data){
                    console.log(Data);
                    if(Data[0].FLAG == "OKK")
                    {
                        var n = Data.length;

                        for(var i=1; i<n; i++)
                        {
                            $("#selectgrade").append(new Option(Data[i].gradetext, Data[i].gradeid));
                        }

                        $("#selectgrade").prop('disabled', false); // disables select grade menu after succesfull ajax call
                    }
                    else if(Data[0].FLAG == "NORECORDFOUND")
                    {
                        console.log("NO RECORD FOUND")
                        swal('No Record Found', '', 'info');
                    }
                    else if(Data[0].FLAG == 'ERRORINEXECUTINGQUERY')
                    {
                        console.log("ERROR IN EXECUTING QUERY");
                        swal('Something Went Wrong', '', 'error');
                    }
                },
                error: function(Data){
                    console.log("Error In ReloadSelectGrade Ajax Call");
                    console.log("Error Data = " + Data[0]);
                    swal('Something Went Wrong', '', 'error');
                }
            });
        }
    
        function ResetTable(){
            $("#gradetbl tbody").empty();   
        }
        
        function ResetTableWithHide(){
            ResetTable();
            $("#gradetbl").prop('hidden', true);   
        }
        

    });
</script>

</html>