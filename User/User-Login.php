<?php
require_once 'includes/functions.inc.php';
require_once 'includes/login.inc.php';
session_start();
if(isset($_SESSION[""]))
{
    test(); 
}
$connect = mysqli_connect("localhost", "root", "", "project_01");  
if(isset($_POST["submit"]))   
{  
    if(!empty($_POST["uid"]) && !empty($_POST["pwd"]))
    {
    $name = mysqli_real_escape_string($connect, $_POST["uid"]);
    $sql = "SELECT * FROM users WHERE usersUid = '" . $name . "' or usersEmail = '" . $name . "'";  
    $result = mysqli_query($connect,$sql);  
    $user = mysqli_fetch_array($result);  
    if($user)   
    {  
    if(!empty($_POST["rem"]))   
    {  
        setcookie ("member_login",$name,time()+ (10 * 365 * 24 * 60 * 60));
        $_SESSION[""] = $name;
    }  
    else  
    {  
        if(isset($_COOKIE["member_login"]))   
        {  
        setcookie ("member_login","");  
        }
    }  
    test(); 
    } 
    else  
  {  
    test();
  }  
    }
    else
 {
    test();
 }
 } 
 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title translate='no'>User Login | ticketly</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="../Admin/AdminLogin/images/icons/favicon.ico" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../Admin/AdminLogin/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../Admin/AdminLogin/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../Admin/AdminLogin/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../Admin/AdminLogin/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../Admin/AdminLogin/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../Admin/AdminLogin/css/util.css">
    <link rel="stylesheet" type="text/css" href="../Admin/AdminLogin/css/main.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" href="../Admin/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../Admin/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../Admin/css/themify-icons.css" />
    <link rel="stylesheet" href="../Admin/css/owl.carousel.css" />
    <link rel="stylesheet" href="../Admin/css/style.css" />
    <link rel="stylesheet" href="customstyle.css" />
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
            <a class="navbar-brand" href="../homepage/index.php" translate='no'>
               ticketly
            </a>
            <div id="google_translate_element" style="padding-left: 5px;padding-right: 5px;"></div>
            <span class="navbar-text">
               <a href="../homepage/index.php">Home&nbsp;&nbsp;</a>
               <a href="User-Login.php">User Login&nbsp;&nbsp;</a>
               <a href="../Admin/Admin-Login.php">Admin Login&nbsp;&nbsp;</a>
               <a href="../Admin/Admin-validate.php">Validate Ticket&nbsp;&nbsp;</a>
            </span>
        </nav>
        
        
    </header>
    
    <div class="limiter">
    
        <div class="container-login100">
        <br><br><br><br>
            <div class="wrap-login100" style="padding: 30px 50px 30px 50px;">
           
                <div class="col2">
                
                <p style="text-align: center;">Welcome back!<br>Please Login to continue</p>
                <form class="login100-form" action="" method="post"> 
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
                        else if ($_GET["error"] == "wronglogin") { 
                            $msg = 'Incorrect login information!';
                            ?>
                            <script> 
                            $(document).ready(function(){
                                $('#ErrorModal').modal('show');
                            });
                            </script>
                            <?php
                        }
                        else if ($_GET["error"] == "none2") {
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
                    <div class="wrap-input100 validate-input " data-validate="Valid email is required: ex@abc.xyz ">
                        <input class="input100" type="text " name="uid" value="<?php if(isset($_COOKIE["member_login"])) { echo $_COOKIE["member_login"]; } ?>" placeholder="Username/Email...">
                        <span class="focus-input100 "></span>
                        <span class="symbol-input100 ">
							<i class="fa fa-user " aria-hidden="true "></i>
						</span>
                    </div>
                    <div class="wrap-input100 validate-input " data-validate="Password is required ">
                        <input class="input100" type="password" name="pwd" placeholder="Password...">
                        <span class="focus-input100 "></span>
                        <span class="symbol-input100 ">
							<i class="fa fa-lock " aria-hidden="true "></i>
						</span>
                    </div>
                    <div class="wrap-input100 custom-control ">

                        <input type="checkbox" name="rem" <?php if(isset($_COOKIE["member_login"])) { ?> checked <?php } ?> ><span class="txt1 float-left">Remember Username &nbsp;</span>
                    </div>

                    <div class="text-center p-t-12 ">
                        <span class="txt1 ">
							Forgot
						</span>
                        <a class="txt2 " href="User-recoverPassword.php"> 
							Username / Password?
						</a>
                    </div>
                    
                    <div class="container-login100-form-btn ">
                        <button class="login100-form-btn " type="submit " name="submit">
							Log in
						</button>
                    </div>

                    
                </form>   
                </div>

                <div class="vl" style="position:10px">
                    <span class="vl-innertext" >or</span>
                </div>
                
                <div class="col">
                <img src="..\Admin\AdminLogin\images\img-01.png" alt="IMG" style="width: 190px;">
                <p style="text-align: center;">New here?<br> Register to get started</p>
                <div class="container-login100-form-btn ">
                <a href="User-signup.php">
                        <button class="login100-form-btn " type="submit " name="submit">
							Register
						</button>
                </a>
                    </div>
                </div>                
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
    <script src="../Admin/js/jquery-3.2.1.min.js "></script>
    <script src="../Admin/js/owl.carousel.min.js "></script>
    <script src="../Admin/js/main.js "></script>


    <!--===============================================================================================-->
    <script src="../Admin/AdminLogin/vendor/jquery/jquery-3.2.1.min.js "></script>
    <!--===============================================================================================-->
    <script src="../Admin/AdminLogin/vendor/bootstrap/js/popper.js "></script>
    <script src="../Admin/AdminLogin/vendor/bootstrap/js/bootstrap.min.js "></script>
    <!--===============================================================================================-->
    <script src="../Admin/AdminLogin/vendor/select2/select2.min.js "></script>
    <!--===============================================================================================-->
    <script src="../Admin/AdminLogin/js/main.js "></script>
    
</body>

</html>