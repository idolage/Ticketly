<?php
require_once 'dbh.inc.php';
session_start();
if (!isset($_SESSION["useruid"])) {
    header('location: User-Login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="../../Admin/img/favicon.ico" type="image/ico" />

    <title translate='no'>ticketly</title>
     <!-- Bootstrap -->
    <link rel="stylesheet" type=text/css href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.min.css">

  <!-- Font Awesome -->
    <link href="Header/vendors/font-awesome/css/font-awesome.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="Header/build/css/custom.min.css" rel="stylesheet">
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
              <img src="..\Admin\AdminLogin\images\img-01.png" alt="IMG">
              <h6>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <?php 
                                        $id = $_SESSION['userid'];
                                        $sql = "SELECT usersUid FROM users WHERE usersId = $id;";
                                        $result = mysqli_query($conn, $sql) or die( mysqli_error($conn));
                                        while ($row = mysqli_fetch_assoc($result)) {
                                        $_SESSION["useruid"] = $row["usersUid"];
                                    }   
                                    ?>
                  <?php echo "Hello,<span translate='no'> ".$_SESSION["useruid"]?>!</span></h6>
              </div>
            </div>

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <ul class="nav side-menu text-dark">
                  <li><a href="User-dashboard.php" class="text-dark"><i class="fa fa-th-large"></i>Dashboard </a></li>
                  <li><a href="User-buyTrainTicket.php" class="text-dark"><i class="fa fa-train"></i>Buy Train Ticket </a></li>

                  <li><a class="text-dark"><i class="fa fa-info-circle"></i>Check Details<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu bg-white">
                      <li><a class="text-dark" href="User-trainDetails.php">Trains Details</a></li>  
                      <li><a class="text-dark" href="User-routeDetails.php">Routes Details</a></li>
                    </ul>
                  </li>                  
                  <li><a href="User-complaints.php" class="text-dark"><i class="fa fa-comments"></i>Complaints</a></li>
                  <li><a href="User-transactionHistory.php" class="text-dark"><i class="fa fa-history"></i>View Transaction History</a></li>
              </div>
             

            </div>
         
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
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

                <!--li role="presentation" class="nav-item dropdown open">
                    <a href="javascript:;" class="dropdown-toggle info-number text-dark" id="navbarDropdown1" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-bell" style="color: #15202c;"></i>
                        <span class="badge bg-green"></span>
                    </a>
                    <ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1">
                        <a class="dropdown-item">
                        <strong>Check Notifications</strong>
                        <i class="fa fa-angle-right"></i>
                        </a>
                    </ul>
                </li-->
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