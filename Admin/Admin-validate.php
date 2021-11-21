<!DOCTYPE html> 
<html lang="en">

<head>
    <title translate='no'>Validate Ticket | ticketly</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="AdminLogin/images/icons/favicon.ico" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="AdminLogin/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="AdminLogin/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="AdminLogin/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="AdminLogin/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="AdminLogin/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="AdminLogin/css/util.css">
    <link rel="stylesheet" type="text/css" href="AdminLogin/css/main.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/font-awesome.min.css" />
    <link rel="stylesheet" href="css/themify-icons.css" />
    <link rel="stylesheet" href="css/owl.carousel.css" />
    <link rel="stylesheet" href="css/style.css" />

    <link rel="stylesheet" href="../translate.css"> 
    <script type="text/javascript" src="../translate.js"></script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

</head>
<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>
    <header>
        <!-- Image and text -->
        <nav class="navbar fixed-top navbar-light bg-light">
            <a class="navbar-brand" href="../../index.php" translate='no'>
               ticketly
            </a>
            <div id="google_translate_element" style="padding-left: 5px;padding-right: 5px;"></div>
            <span class="navbar-text">
                <a href="../../index.php">Home&nbsp;&nbsp;</a>
                <a href="../User/User-Login.php">User Login&nbsp;&nbsp;</a>
               <a href="Admin-Login.php">Admin Login&nbsp;&nbsp;</a>
               <a href="">Validate Ticket&nbsp;&nbsp;</a>
              </span>
        </nav>
    </header>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100" style="padding: 5px 50px 15px 50px; position:relative; top:50px;">
                <form class="login100-form" action="includes/validate.inc.php" method="post" style="width:70vw;">
                <br>
                <p class='text-primary' style="margin-bottom: 5px;">Enter ticket number to get details</p>
                    <span class="login100-form-title" style="padding-bottom: 15px;">
                        <img src="..\Admin\AdminLogin\images\img-01.png" alt="IMG">
                    </span>
                    <div class="input-group">
                        <button class="btn btn-secondary text-light" disabled ><i class="fa fa-search fa-lg"></i></button>
                        <input type="text" name="ticketNo" class="form-control" placeholder="ticket number...">
                        <button class="btn btn-outline-primary" type="submit" name="submit">Search</button>
                    </div>
                    <br>
                        <?php
                            if (isset($_GET["error"])) {
                                if ($_GET["error"] == "Noresults") {
                                    echo "<div class= 'alert alert-warning'>
                                    <strong>Invalid Ticket !</strong>
                                    </div>";
                                }
                                if ($_GET["error"] == "results") {
                                    echo "<div class= 'alert alert-info'>
                                    <table class='table-responsive table-sm font-sm'>
                                        <tr>
                                            <td>Ticket Number</td>
                                            <td></td>
                                            <td>".$_GET["ticketNo"]."</td>
                                        </tr>
                                        <tr>
                                            <td>Token ID</td>
                                            <td></td>
                                            <td>".$_GET["token"]."</td>
                                        </tr>
                                        <tr>
                                            <td>City of Arrival</td>
                                            <td></td>
                                            <td>".$_GET["cityA"]."</td>
                                        </tr>
                                        <tr>
                                            <td>City of Departure</td>
                                            <td></td>
                                            <td>".$_GET["cityB"]."</td>
                                        </tr>
                                        <tr>
                                            <td>Class</td>
                                            <td></td>
                                            <td>".$_GET["Ttype"]."</td>
                                        </tr>
                                        <tr>
                                            <td>Date</td>
                                            <td></td>
                                            <td>".$_GET["DT"]."</td>
                                        </tr>
                                    </table>
                                    </div>";
                                }
                            }
                        ?>
                </form>
            </div>
        </div>
    </div>
</body>
<!-- Footer section -->
<footer class="footer-section">
        <div class="container">
            <div class="row spad" style="padding-bottom: 20px; padding-top:20px;">
                <div class="col-md-6 col-lg-3 footer-widget">
                    <img src="..\Admin\AdminLogin\images\img-01.png" class="mb-4" alt="">
                    <p>The Best Online Train Ticketing System</p>


                </div>
                <div class="col-md-6 col-lg-2 offset-lg-1 footer-widget">
                    <h5 class="widget-title">Resources</h5>
                    <ul>
                        <li><a href="http://www.railway.gov.lk/">Sri Lanka Railways</a></li>
                        <li><a href="https://www.transport.gov.lk/">Ministry of Transport</a></li>
                        <li><a href="http://gic.gov.lk/">Government Information Center</a></li>                        
                    </ul>
                </div>
                <div class="col-md-6 col-lg-2 offset-lg-1 footer-widget">
                    <h5 class="widget-title">Quick Links</h5>
                    <ul>
                        <li><a href="../../index.php">Home</a></li>
                        <li><a href="../User/User-Login.php">User Login</a></li>
                        <li><a href="../Admin/Admin-Login.php">Admin Login</a></li>
                </div>
                <div class="col-md-6 col-lg-3 footer-widget pl-lg-5 pl-3">
                    <h5 class="widget-title">Follow Us</h5>
                    <div class="social">
                        <a href="" class="facebook"><i class="fa fa-facebook"></i></a>
                        <a href="" class="google"><i class="fa fa-google-plus"></i></a>
                        <a href="" class="instagram"><i class="fa fa-instagram"></i></a>
                        <a href="" class="twitter"><i class="fa fa-twitter"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="row">

                    <div class="col-lg-8 text-center text-lg-right">
                        <ul class="footer-nav">
                            <li style="color: gray;" translate='no'>&copy;&nbsp;ticketly</li>
                            <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
                            <li style="color: gray;" translate='no'>ticketly@gmail.com</li>
                            <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
                            <li style="color: gray;">(123) 456-7890</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--====== Javascripts & Jquery ======-->
    <script src="js/jquery-3.2.1.min.js "></script>
    <script src="js/owl.carousel.min.js "></script>
    <script src="js/main.js "></script>


    <!--===============================================================================================-->
    <script src="AdminLogin/vendor/jquery/jquery-3.2.1.min.js "></script>
    <!--===============================================================================================-->
    <script src="AdminLogin/vendor/bootstrap/js/popper.js "></script>
    <script src="AdminLogin/vendor/bootstrap/js/bootstrap.min.js "></script>
    <!--===============================================================================================-->
    <script src="AdminLogin/vendor/select2/select2.min.js "></script>
    <!--===============================================================================================-
    <script src="vendor/tilt/tilt.jquery.min.js "></script>
    <script>
        $('.js-tilt').tilt({
            scale: 1.1
        })
    </script>
    ==============================================================================================-->
    <script src="AdminLogin/js/main.js "></script>
    
</body>

</html>