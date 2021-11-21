<?php
session_start();
if (isset($_POST["submit"])) {
    $pwd = $_POST["npwd"];
    $Rpwd = $_POST["nrpwd"];
    $id = $_SESSION["userid"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if (pwdMatch($pwd, $Rpwd) !== false) {
        header("location: ../User-dashboard.php?error=missmatchpwd");
        exit();
    }

    changePWD($conn, $id, $pwd);

}
else{
    header("location: ../User-dashboard.php");
    exit();
}
?>