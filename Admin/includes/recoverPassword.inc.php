<?php
if (isset($_POST["submit"])) {

    $email = $_POST["recoverEmail"];
    $username = $_POST["uid"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if (emptyInputdouble($email, $username) !== false) {
        header("location: ../Admin-recoverPassword.php?error=emptyinput");
        exit();
    }

    if (invalidEmail($email) !== false) {
        header("location: ../Admin-recoverPassword.php?error=invalidemail");
        exit();
    }

    if (adminuidExists($conn, $username, $email) == false) {
        header("location: ../Admin-recoverPassword.php?error=invalidinfo");
        exit();
    }

    sendOTP($conn,$email, $username);
}

else{
    header("location: ../Admin-recoverPassword.php");
    exit();
}
?> 