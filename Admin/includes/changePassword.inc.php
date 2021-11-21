<?php
session_start();
$id = $_SESSION['userid'];

if (isset($_POST["password_update"])) {
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';
    
    $admin_cpass = $_POST["admin_cpass"];
    $admin_npass = $_POST["admin_npass"];
    $admin_cnpass = $_POST["admin_cnpass"];

    if (pwdMatch($admin_npass, $admin_cnpass) !== false) {
        header("location:  ../Admin-viewProfile.php?error=missmatchpwd");
        exit();
    }

    if (pwdMatch($admin_cpass, $admin_npass) == false) {
        header("location:  ../Admin-viewProfile.php?error=samepwd");
        exit();
    }

    $hashedPwd = password_hash($admin_npass, PASSWORD_DEFAULT); //hashing auto updates
    $sql = "UPDATE admins SET adminsPwd = ? WHERE admisId = ?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("location:  ../Admin-viewProfile.php?error=stmtfailed_3");
        exit();
    }
    
    mysqli_stmt_bind_param($stmt,"ss",$hashedPwd, $id);
    mysqli_stmt_execute($stmt);
    header("location: ../Admin-viewProfile.php?error=none_3");
    exit();
}
else
{
    header("location: ../Admin-viewProfile.php");
    exit();
}
?>