<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <script src="https://cdn.jsdelivr.net/npm/table-to-json@1.0.0/lib/jquery.tabletojson.min.js"
        integrity="sha256-H8xrCe0tZFi/C2CgxkmiGksqVaxhW0PFcUKZJZo1yNU=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <title> Login </title>
    <style>
        body {
            background-color: #eceee3;
        }

        a {
            color: #1f1f1f;
            text-decoration: none;
            outline: none;
        }

        a:hover {
            color: white;
        }

        .login {
            width: 35%;
            height: auto;
            margin: 30px;
            padding: 35px;
            background-color: #eceee3;
        }

        .input-container {
            display: flex;
            width: 100%;
            height: fit-content;
            margin-bottom: 15px;
            border-color: #4c5a7d;
        }

        .icon {
            background-color: #4c5a7d;
            color: white;
            padding: 10px;
            min-width: 50px;
            text-align: center;
        }

        .input-field {
            width: 100%;
            padding: 10px;
            outline: none;
        }

        .btns {
            background-color: #4c5a7d;
            color: white;
            border: none;
            cursor: pointer;
            width: 100%;
            opacity: 0.9;
            height: 40px;
        }

        .bg-light {
            background: #4c5a7d !important;
        }
    </style>
</head>

<body>
    <center>
        <div class="login">
            <img src="../assets/images/ceramic.svg" alt="" style="width: 100%;">
            <br>
                <div class="input-container">
                    <i class="fa fa-user icon"></i>
                    <input class="input-field form-control" type="text" placeholder="Username" name="username" id="username" autofocus autocomplete="off" value="<?php if (isset($_POST['login_admin'])) {
                                                                                                                                                                                $_POST['username'];                                                                                                                                         } ?>">
                </div>

                <div class="input-container form-group">
                    <i class="fa fa-key icon"></i>
                    <input class="input-field form-control" autocomplete="off" type="password" placeholder="Password" name="admin_pass" id="admin_pass">
                </div>
                <input type="submit" class="btns" value="LOGIN" onclick="checkData()" name="login_admin">
        </div>
        
    </center>
    
</body>
<script>
    function checkData() {
        var password = "ceramichub";

        if (document.getElementById('admin_pass').value == "" || document.getElementById('username').value == "") {
            swal("Please enter username and password!", '' , 'error');
        }else if(document.getElementById('username').value == "ceramichub" && document.getElementById('admin_pass').value == password){
            window.location.href = './admin.php';
        }else{
            swal("Invalid Username or Password",'', 'error');
        }
    }
</script>

</html>