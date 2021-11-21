<?php
session_start();
$id = $_SESSION['userid'];

if (isset($_POST["profile_update"])) {
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    $admin_name = $_POST["admin_name"];
    $admin_username = $_POST["admin_username"];
    $admin_email = $_POST["admin_email"];
    $tel = $_POST["tel"];
    $position = $_POST["position"];

    if (invalidEmail($admin_email) !== false) {
        header("location: ../Admin-viewProfile.php?error=invalidemail");
        exit();
    }
    if (!is_numeric($tel)) {
        header("location: ../Admin-viewProfile.php?error=invalidTel");
        exit();
    }
    if (mb_strlen($tel) != 10) {
        header("location: ../Admin-viewProfile.php?error=invalidTel");
        exit();
    }
    if (invalidUid($admin_username) !== false) {
        header("location: ../Admin-viewProfile.php?error=invaliduid");
        exit();
    }

    if (adminuidExistsUpdate($conn, $admin_username, $admin_email,$id) !== false) {
        header("location: ../Admin-viewProfile.php?error=uidexist");
        exit();
    }
 
    $sql = "UPDATE admins SET adminsName = ?, adminsEmail = ?, adminsUid = ?, contact_no = ?, position = ? WHERE admisId = ?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("location:  ../Admin-viewProfile.php?error=stmtfailed");
        exit();
    }
    
    mysqli_stmt_bind_param($stmt,"ssssss",$admin_name, $admin_email, $admin_username, $tel, $position, $id);
    mysqli_stmt_execute($stmt);
    header("location: ../Admin-viewProfile.php?error=none");
    exit();
}
else
{
    header("location: ../Admin-viewProfile.php");
    exit();
}
?>