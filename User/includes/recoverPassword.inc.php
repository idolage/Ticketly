<?php
if (isset($_POST["submit"])) {

    $email = $_POST["recoverEmail"]; 
    $username = $_POST["uid"];

    require_once 'dbh.inc.php';
    require_once 'recoverPasswordFunctions.inc.php';

    if (emptyInputdouble($email, $username) !== false) {
        header("location: ../User-recoverPassword.php?error=emptyinput");
        exit();
    }

    if (invalidEmaildouble($email) !== false) {
        header("location: ../User-recoverPassword.php?error=invalidemail");
        exit();
    }

    if (uidExistsdouble($conn, $username, $email) == false) {
        header("location: ../User-recoverPassword.php?error=invalidinfo");
        exit();
    }

    sendOTP($conn,$email, $username);
}

else{
    header("location: ../User-recoverPassword.php");
    exit();
}
?> 