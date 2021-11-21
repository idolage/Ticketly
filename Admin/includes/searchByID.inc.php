<?php
session_start();
require_once 'dbh.inc.php';
require_once 'functions.inc.php';
if (isset($_POST["submitID"])) 
{
    $uid = $_POST["uid"];
    $usersStatus = 0;
    $sql = "UPDATE users SET usersStatus = ? WHERE usersId = ?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("location:  ../Admin-deleteUser.php?error=stmtfailed");
        exit();
    }
    
    mysqli_stmt_bind_param($stmt,"ss",$usersStatus, $uid);
    mysqli_stmt_execute($stmt);
    header("location: ../Admin-deleteUser.php?error=none");
    exit();  
}
else
{
    header("location: ../Admin-deleteUser.php");
    exit();
}