<!DOCTYPE html>
<html lang="en">

<head>
    <title translate='no'>Reset Password | ticketly</title>
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
            <a class="navbar-brand" href="#" translate='no'>
               ticketly
            </a>
            <div id="google_translate_element" style="padding-left: 5px;padding-right: 5px;"></div>
            <span class="navbar-text">
                <a href="../homepage/index.php">Home&nbsp;&nbsp;</a>
                <a href="../User/User-Login.php">User Login&nbsp;&nbsp;</a>
               <a href="">Admin Login&nbsp;&nbsp;</a>
               <a href="Admin-validate.php">Validate Ticket&nbsp;&nbsp;</a>
              </span>
            
        </nav>
    </header>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100" style="padding: 30px 50px 30px 50px;">

                <form class="login100-form" action="includes/recoverPassword.inc.php" method="post">
                    <span class="login100-form-title" style="padding-bottom: 10px;" >
                        <img src="AdminLogin\images\img-01.png" alt="IMG">
                    </span>

                    <span>
                            <p style="text-align: center; font-size:13px;" >Further instructions will be sent to your email<br>
                            Enter an email address to get your<BR>One-Time-Password</p>
						</span>
                        <?php

                            if (isset($_GET["error"])) {
                                if ($_GET["error"] == "emptyinput") {
                                    $msg = 'Fill in all fields!';
                                    ?>
                                    <script> 
                                    $(document).ready(function(){
                                        $('#ErrorModal').modal('show');
                                    });
                                    </script>
                                    <?php 
                                }
                                else if ($_GET["error"] == "invalidinfo") {
                                    $msg = 'Invalid user information!'; 
                                    ?>
                                        <script> 
                                        $(document).ready(function(){
                                            $('#ErrorModal').modal('show');
                                        });
                                        </script>
                                    <?php 
                                }
                                else if ($_GET["error"] == "invalidemail") {
                                    $msg = 'Choose a proper email!';
                                    ?>
                                        <script> 
                                        $(document).ready(function(){
                                            $('#ErrorModal').modal('show');
                                        });
                                        </script>
                                    <?php 
                                }
                                else if ($_GET["error"] == "stmtfailed") {
                                    $msg = 'Something went wrong, try again!';
                                    ?>
                                        <script> 
                                        $(document).ready(function(){
                                            $('#ErrorModal').modal('show');
                                        });
                                        </script>
                                    <?php 
                                }
                                else if ($_GET["error"] == "none") {
                                    $msg = 'Your One-Time-Password has been sent to your email account. Please check your email';
                                    ?>
                                        <script> 
                                        $(document).ready(function(){
                                            $('#SuccessModal').modal('show');
                                        });
                                        </script>
                                    <?php 
                                }
                            }

                        ?>

                    <div class="wrap-input100 validate-input " data-validate="">
                        <input class="input100 " type="text " name="uid" placeholder="Username...">
                        <span class="focus-input100 "></span>
                        <span class="symbol-input100 ">
							<i class="fa fa-user" aria-hidden="true "></i>
						</span>
                    </div>

                    <div class="wrap-input100 validate-input " data-validate="Valid email is required: ex@abc.xyz ">
                        <input class="input100 " type="text " name="recoverEmail" placeholder="Enter recovery email...">
                        <span class="focus-input100 "></span>
                        <span class="symbol-input100 ">
							<i class="fa fa-envelope " aria-hidden="true "></i>
						</span>
                    </div>
                    
                    <div class="container-login100-form-btn ">
                        <button class="login100-form-btn " type="submit " name="submit">
							Send OTP to my Email
						</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!--Error modal start-->
<div class="modal fade" id="ErrorModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h4 class="modal-title text-light">Oops! Looks like something went wrong</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
            <?php echo $msg ?>
            </div>
        </div>
    </div>
</div>
<!--Error modal start end-->

<!--Success modal start-->
<div class="modal fade" id="SuccessModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title text-light">OTP Successfully Generated</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
            <?php echo $msg ?>
            </div>
        </div>
    </div>
</div>
<!--Success modal start end-->

    <!-- Footer section -->
    <footer class="footer-section">
        <div class="container">
            <div class="row spad" style="padding-bottom: 20px; padding-top:20px;">
                <div class="col-md-6 col-lg-3 footer-widget">
                    <img src="img/logo.png" class="mb-4" alt="">
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