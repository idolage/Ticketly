<?php
require_once 'includes/dbh.inc.php';
require_once 'includes/header.inc.php';
?>
<div class="card">
    <div class="card-body">
    <br>
    <div class="row">
    <img src="img/page-info-bg.png" style="width: 100vw; height: 15px;">
    </div>
    <h5 class="card-title text-primary"><strong>Fill in details to register new adminstrator</strong></h5>
        <br>
        <?php

            if (isset($_GET["error"])) {
                if ($_GET["error"] == "none") {
                    echo "<div class= 'alert alert-success'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <strong>New Admin Registration Successful!</strong>
                    </div>";
                }
                if ($_GET["error"] == "stmtfailed") {
                    echo "<div class= 'alert alert-warning'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <strong>Cannot connect to the database! Please try again later</strong>
                    </div>";
                }
                if ($_GET["error"] == "invalidemail") {
                    echo "<div class= 'alert alert-warning'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <strong>Invalid email! Please use a valid email address</strong>
                    </div>";
                }
                if ($_GET["error"] == "invaliduid") {
                    echo "<div class= 'alert alert-warning'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <strong>Invalid username! Please use another username</strong>
                    </div>";
                }
                if ($_GET["error"] == "invalidTel") {
                    echo "<div class= 'alert alert-warning'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <strong>Invalid contact number! Please enter a valid telephone/mobile number</strong>
                    </div>";
                }
                if ($_GET["error"] == "uidexist") {
                    echo "<div class= 'alert alert-warning'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <strong>Username or Email already taken by another user!</strong>
                    </div>";
                }
            }
        ?>

        <form class='form' method="POST" action="includes/registerAdmin.inc.php">
            <div class="form-group">
                <h6>Full Name</h6>
                <input type="text" class="form-control" name="name" placeholder="Enter Full Name" required>
            </div>
            <br>
            <div class="form-group">
                <h6>Email Address</h6>
                <input type="email" class="form-control" name="email" placeholder="Enter Email Address" required>
            </div>
            <br>
            <div class="form-group">
                <h6>Username</h6>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">@</div>
                    </div>
                    <input type="text" class="form-control" name="uid" placeholder="Enter Username" required>
                </div>
            </div>
            <br>
            <div class="form-group row">
                <div class = 'col-md-6'>
                    <h6>Contact No</h6>
                    <input type="text" class="form-control" name="tel" placeholder="Enter Contact Number" required>                                
                </div>
                <div class="col-md-6">
                    <h6>Position</h6>
                    <input type="text" class="form-control" name="position" placeholder="Enter Position" required>                                
                </div>
            </div>
            <br>
            <div class="form-group">
                <input type="checkbox" value='1' name ="cb" required> &nbsp; Check here to indicate that you grant administartor level access to this person under the impression of 
                he/she will not take advantage of his/her accessibility to this system to conduct any form of illegal activity 
            </div>
            <br>
            <br>
            <div class="form-group row justify-content-center">
                <button class="btn btn-success" input type="submit " name="submit" style="width: 250px;">Register</button>                                
            </div>
        </form>
    </div>
</div>
<?php
require_once 'includes/footer.inc.php';
?>