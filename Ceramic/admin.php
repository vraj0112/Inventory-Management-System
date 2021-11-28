<?php

  session_start();  
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <title>Ceramic Hub</title>

        <!-- App css -->
        <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/style.css" rel="stylesheet" type="text/css" />

        <script src="../assets/js/modernizr.min.js"></script>

         <!--Fonts in title-->
        <link href='https://fonts.googleapis.com/css?family=Aclonica' rel='stylesheet'>
        <style type="text/css">
            .heading{
            font-family: 'Aclonica';color: black;font-size: 3vw;}
      .banner {
      position: relative;
      height: 5vw; 
      background-size: cover;
      display: flex;
      justify-content: center;
      align-items: center;
      text-align: center;
      }
      .banner::after {
      content: "";
      background-color: rgba(0, 0, 0, 0.5); 
      position: absolute;
      width: 100%;
      height: 100%;
      }

   .btn-group   .button {
     display: block;
  border-radius: 12px;
  border: none;
  color: #0000000;
  text-align: center;
  font-size: 20px;
  padding: 10px;
  width: 200px;
  transition: all 0.5s;
  cursor: pointer;
  margin: 25px;
}

.button span {
  cursor: pointer;
  display: inline-block;
  position: relative;
  transition: 0.5s;
}

.button span:after {
  content: '\00bb';
  position: absolute;
  opacity: 0;
  top: 0;
  right: -20px;
  transition: 0.5s;
}

.button:hover span {
  padding-right: 25px;
}

.button:hover span:after {
  opacity: 1;
  right: 0;
}

#mybutton {
    margin-left: 270px;
}
        </style>

    </head>


    <body class="fixed-left">

            <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">


<!--                 <div class="user-box">
                        <div class="user-img">
                            <img src="assets/images/users/avatar-1.png" alt="user-img" title="admin" class="rounded-circle img-thumbnail img-responsive">
                            <div class="user-status offline"><i class="mdi mdi-adjust"></i></div>
                        </div>
                        <h5><a href="#"><?php echo $_SESSION['username']; ?></a> </h5>
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <a href="#" >
                                    <i class="mdi mdi-settings"></i>
                                </a>
                            </li>

                            <li class="list-inline-item">
                                <a href="logout.php" class="text-custom">
                                    <i class="mdi mdi-power"></i>
                                </a>
                            </li>
                        </ul>
                    </div> -->


                    <div id="sidebar-menu">

                        <!-- <div class="topbar-left">
                            <a href="index.html" class="logo"><span><img src="assets/images/img.png" height="120px" width="120px"></span><i class="mdi mdi-layers"></i>
                            </a>
                        </div> -->
                        <br><br><br>
<br>                    <br><br><br>
<br>                    <br><br><br>
<br><br><br>
<br>	
                        <ul>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-account-box"></i> <span>Inward </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="Inward/NewInward_New.php">New Inward</a></li>
                                    <li><a href="Inward/s&minward.php">Search & Manage Inward</a></li>            
                                </ul>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-account-box"></i> <span>Challan </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="Challan/addNewChallan.php">New Challan</a></li>
                                    <li><a href="Challan/searchAndManageChallan.php">Search & Manage Challan</a></li>           
                                </ul>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-account-box"></i> <span>Invoice </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="./Invoice/addNewInvoice.php">New Invoice</a></li>
                                    <li><a href="./Invoice/searchAndMangeInvocie.php">Search & Manage Invoice</a></li> 
                                    <!-- <li><a href="temp.html">Convert Invoice to Challan</a></li>             -->
                                </ul>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-account-box"></i> <span>Return </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="./Return/CustomerReturn.php">New Return</a></li>
                                    <li><a href="./Return/SearchAndManageCustomerReturn.php">Search & Manage Return</a></li>             
                                </ul>
                            </li>

                           <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-account-box"></i> <span>Breakage & Damage </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="./Breakage&Damage/Breakage&Damage.php">New Bracakage & Damage</a></li>
                                    <li><a href="./Breakage&Damage/SearchAndManagebreakage&damage.php">Search Bracakage & Damage</a></li>            
                                </ul>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-account-box"></i> <span>Expance </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="./Expense/NewExpense.php">New Expence</a></li>
                                    <li><a href="./Expense/ManageExpense.php">Search & Manage Expance</a></li>            
                                </ul>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-account-box"></i> <span>Quatation </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="./Quatation/newQuotation.php">New Quatation</a></li>
                                    <li><a href="./Quatation/ManageQuatation.php">Search & Manage Quatation</a></li>            
                                </ul>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-account-box"></i> <span>Payment </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="./Payment/NewPayment.php">New Payment</a></li>
                                    <li><a href="./Payment/Managepayment.php">Search & Manage Payment</a></li> 
                                </ul>
                            </li>
                        </ul>
                        
                        <div class="clearfix"></div>
                    </div>

                    <div class="clearfix"></div>

                </div>

            </div>

        <div id="wrapper">

            <div class="topbar">

                <div class="topbar-left">
                    <!-- <a href="index.html" class="logo"><span>Admin<span> Dashboard</span></span><i class="mdi mdi-layers"></i></a> -->
                    <img src="../assets/images/ceramic.svg" alt="Logo is placed here" height="200px" width="200px">
                </div>
                

               
                <div class="navbar navbar-default" role="navigation">
                <div class="myclass">   
                    <div class="container-fluid">

<div class="testbox">
    <div class="banner">
<center><h1 class="heading">Ceramic Hub</h1></center>
</div>


<div id="sidebar-menu">


                        <ul>
                            <li class="has_sub1">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-account-box"></i> <span>Categories </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="Categories/ManageCategories.php">Manage Categories</a></li>
                                    <li><a href="Subcategories/ManageSubCategories.php">Manage Sub Categories</a></li>
                                    <li><a href="Brand/AddBrandName.php">Add Brands</a></li>
                                    <li><a href="Brand/manageBrandName.php">Manage Brands Mapping</a></li> 
                                    <li><a href="Grade/AddGrade.php">Add Grade</a></li>
                                    <li><a href="Grade/manageGrade.php">Manage Grade</a></li>           
                                </ul>
                            </li>

                            <li class="has_sub1">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-account-box"></i> <span>Product </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="Product/AddNewProduct.php">New Product</a></li>
                                    <li><a href="Product/S&MProduct.php">Search & Manage Product</a></li>            
                                </ul>
                            </li>

                            <li class="has_sub1">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-account-box"></i> <span>Vendor </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="Vendor/NewVendor.php">New Vendor</a></li>
                                    <li><a href="Vendor/ManageVendor.php">Search & Manage Vendor</a></li>           
                                </ul>
                            </li>

                            <li class="has_sub1">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-account-box"></i> <span>Customer </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="Customer/NewCustomer.php">New Customer</a></li>
                                    <li><a href="Customer/ManageCustomer.php">Search & Manage Customer</a></li>             
                                </ul>
                            </li>

                            <li class="has_sub1">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-account-box"></i> <span>Stock </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="./Stocks/otherstock.php">Stock</a></li>             
                                    <li><a href="./Stocks/billingstock.php">Virtual Stock</a></li>
                                </ul>
                            </li>

                           <li class="has_sub1">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-account-box"></i><span>Report</span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="./Report/paymentreport.php">Payment Report</a></li>
                                    <li><a href="./Report/perticulerreport.php">Perticular Report</a></li>            
                                    <li><a href="./Report/profitloss.php">Profit-Loss Report</a></li>            
                                </ul>
                            </li>

                            
                        </ul>
                        <div class="clearfix"></div>
                    </div>

                    <div class="clearfix"></div>

                </div>

    
</div>



                        <!-- <ul class="nav navbar-nav list-inline navbar-left">
                            <li class="list-inline-item">
                                <button class="button-menu-mobile open-left">
                                    <i class="mdi mdi-menu"></i>
                                </button>
                            </li>
                            <li class="list-inline-item">
                                <h4 class="page-title">Dashboard</h4>
                            </li>
                        </ul>

                        <nav class="navbar-custom">

                            <ul class="list-unstyled topbar-right-menu float-right mb-0">


                                <li class="hide-phone">
                                    <form class="app-search">
                                        <input type="text" placeholder="Search..."
                                                  class="form-control">
                                        <button type="submit"><i class="fa fa-search"></i></button>
                                    </form>
                                </li>

                            </ul>
                        </nav> -->
 
                </div>
            </div>
                    <!-- <div class="btn-group" id="mybutton">
                    <button class="button" onclick="location.href = 'Challan/addNewChallan.php';" ><span>New Challan </span></button>
                    <button class="button" onclick="location.href = 'temp.html';" ><span>New Invoice </span></button>
                    <button class="button" onclick="location.href = 'Quatation/NewQuatation.php';"><span>New Quatation </span></button>
                    <button class="button" onclick="location.href = 'temp.html';"><span>Add Payment </span></button>
                    <button class="button" onclick="location.href = 'Expance/NewExpence.php';"><span>New Expense </span></button>
                    </div> -->
                   </div>
            




                <footer class="footer text-right">
                    Copyright © Ceramic hub Anand
                </footer>

</div>


        <script src="../assets/js/jquery.min.js"></script>
        <script src="../assets/js/bootstrap.min.js"></script>
        <script src="../assets/js/jquery.app.js"></script>

    </body>
</html>

