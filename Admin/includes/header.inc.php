<?php
session_start();
require_once 'dbh.inc.php'; 
if (!isset($_SESSION["useruid"])) {
    header('location: ../Admin-Login.php');
}
?> 
<!DOCTYPE html>
<html lang="en">
  
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../Admin/img/favicon.ico" type="image/ico" />
    <title translate='no'>ticketly</title>

    <!--meta http-equiv="Content-Type" content="text/html; charset=UTF-8"-->
    <!-- Meta, title, CSS, favicons, etc. -->
    
    <!--meta http-equiv="X-UA-Compatible" content="IE=edge"-->
    
     <!-- Bootstrap -->
    <link rel="stylesheet" type=text/css href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.min.css">

  <!-- Font Awesome -->
    <link href="../Admin/Header/vendors/font-awesome/css/font-awesome.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="../Admin/Header/build/css/custom.min.css" rel="stylesheet">
    <link href="includes/language.css" rel="stylesheet">
    
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script><!---->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script><!---->
    
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <br>
            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_details">
              <img src="../Admin/AdminLogin/images/img-01.png" alt="IMG">
              
              <h6>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <?php
                      $id = $_SESSION["userid"];
                      $sql = "SELECT * FROM admins WHERE admisId = $id;";
                      $result = mysqli_query($conn, $sql) or die( mysqli_error($conn));
                      while ($row = mysqli_fetch_assoc($result)) {
                      echo "Hello,<span translate='no'> ".$row["adminsUid"]." !</span>";}
                  ?>
              </h6>
              </div>
            </div> 

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <ul class="nav side-menu text-dark">
                  <li><a href="Admin-dashboard.php" class="text-dark"><i class="fa fa-th-large"></i>Dashboard </a></li>
                  <li><a href="Admin-viewProfile.php" class="text-dark"><i class="fa fa-user"></i>View Profile</a></li>
                  <li><a href="Admin-registerNewAdmin.php" class="text-dark"><i class="fa fa-user-plus"></i>Register New Admin</a></li>
                 
                  
                  <li><a class="text-dark"><i class="fa fa-map"></i>Train Routes<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu bg-white">
                      <li><a class="text-dark" href="Admin-addTrainRoute.php">Add New Train Route</a></li>  
                      <li><a class="text-dark" href="Admin-checkTrainRoute.php">Check Train Routes</a></li>
                    </ul>
                  </li>

                  <li><a class="text-dark"><i class="fa fa-train"></i>Trains<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu bg-white">
                      <li><a class="text-dark" href="Admin-addTrain.php">Add New Train</a></li>
                      <li><a class="text-dark" href="Admin-checkTrainDetails.php">Check Train Details</a></li>  
                    </ul>
                  </li>

                  <li><a href="Admin-viewComplaints.php" class="text-dark"><i class="fa fa-comments"></i>View Complaints</a></li>
                  <li><a href="Admin-createNotifications.php" class="text-dark"><i class="fa fa-bell"></i>Create Notification</a></li>
                  <li><a href="Admin-deleteUser.php" class="text-dark"><i class="fa fa-user-times"></i>Delete User Accounts</a></li>
                  <li><a href="Admin-report.php" class="text-dark"><i class="fa fa-file-text"></i>Generate Transaction Report</a></li>
              </div>
             

            </div>
         
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars text-dark"></i></a>
              </div>
              <nav class="nav navbar-nav">
              <ul class=" navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-user" style="color: #15202c;"></i>

                    </a>
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown"> 
                        <a class="dropdown-item"  href="includes/logout.inc.php"><i class="fa fa-sign-out pull-right"></i><strong> Log Out</strong></a>
                    </div>
                    </li>
                    <li><div id="google_translate_element" style="padding-left: 35px;padding-right: 15px;"></div></li>

              </ul>
            </nav>
          </div>
        </div>

        <script type="text/javascript">
                function googleTranslateElementInit() {
                    new google.translate.TranslateElement({
                        includedLanguages: 'en,si,ta',
                        layout: google.translate.TranslateElement.InlineLayout.SIMPLE
                    }, 'google_translate_element');
                }
            </script>
            <script src="includes/language.js"></script>

           <!-- page content -->
<div class="right_col" role="main">
<div class="container">