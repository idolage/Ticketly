<?php
session_start();
$id = $_SESSION['userid'];
require_once 'dbh.inc.php';
require_once 'functions.inc.php';

$type = $_GET["Ttype"];
$price = $_GET["price"];
$cityA = $_GET["cityA"];
$cityB = $_GET["cityB"];

    $sql = "DELETE FROM price WHERE cityA = ? AND cityB = ? AND Ttype = ? AND price = ?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("location:  ../Admin-checkTrainRoute.php?error=stmtfailed");
        exit();
    }
    
    mysqli_stmt_bind_param($stmt,"ssss",$cityA , $cityB, $type, $price);
    mysqli_stmt_execute($stmt);

    header("location: ../Admin-checkTrainRoute.php?error=deleted");
    exit(); 
?>   