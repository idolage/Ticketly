<?php
session_start();
$id = $_SESSION['userid'];
require_once 'dbh.inc.php';
require_once 'functions.inc.php';

if (isset($_POST["submit"])) {

    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST["uid"];
    $tel = $_POST["tel"];
    $position = $_POST["position"];

    if (invalidUid($username) !== false) {
        header("location: ../Admin-registerNewAdmin.php?error=invaliduid");
        exit();
    }

    if (invalidEmail($email) !== false) {
        header("location: ../Admin-registerNewAdmin.php?error=invalidemail");
        exit();
    }

    if (!is_numeric($tel)) {
        header("location: ../Admin-registerNewAdmin.php?error=invalidTel");
        exit();
    }

    if (mb_strlen($tel) != 10) {
        header("location: ../Admin-registerNewAdmin.php?error=invalidTel");
        exit();
    }

    if (adminuidExists($conn, $username, $email) !== false) {
        header("location: ../Admin-registerNewAdmin.php?error=uidexist");
        exit();
    }

    createAdmin($conn, $name, $email, $username, $tel, $position);
}
else
{
    header("location: ../Admin-registerNewAdmin.php");
    exit();
}
?>