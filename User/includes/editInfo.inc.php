<?php
session_start();
if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST["uid"];
    $contactNo = $_POST["contactNo"];
    $gender = $_POST["gender"];
    $id = $_SESSION["userid"];

require_once 'dbh.inc.php';
require_once 'functions.inc.php';

    if ($gender != 'M' && $gender != 'F' && $gender != 'O') {
        header("location: ../User-dashboard.php?error=invalidGender");
        exit();
    }

    if (invalidUid($username,$conn,$id) == false) {
        header("location: ../User-dashboard.php?error=invaliduid");
        exit();
    }

    if (invalidName($name) !== false) {
        header("location: ../User-dashboard.php?error=invalidFormat");
        exit();
    }

    if (invalidTelNo($contactNo) !== false) {
        header("location: ../User-dashboard.php?error=invalidNo");
        exit();
    }

    if (invalidEmail($conn,$email,$id) == false) {
        header("location: ../User-dashboard.php?error=invalidemail");
        exit();
    }

    updateUser($conn, $id, $username, $name, $gender, $email, $contactNo);

}
else{
    header("location: ../User-dashboard.php");
    exit();
}
?>