<?php
session_start();
$id = $_SESSION['userid'];
$trainNo = $_GET['trainNo'];
$trainName = $_GET['trainName'];
require_once 'dbh.inc.php';
require_once 'functions.inc.php';
if (isset($_POST["no"])) 
{
    header("../Admin-viewTrainSchedule.php?trainNo=$trainNo&trainName=$trainName");
    exit();
}

else if (isset($_POST["yes"])) 
{
    $sql = "DELETE FROM schedules WHERE trainNo = ?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("location:  ../Admin-viewTrainSchedule.php?error=stmtfailed&trainNo=$trainNo&trainName=$trainName");
        exit();
    }
    
    mysqli_stmt_bind_param($stmt,"s", $trainNo);
    mysqli_stmt_execute($stmt);
    header("location: ../Admin-viewTrainSchedule.php?error=none_4&trainNo=$trainNo&trainName=$trainName");
    exit();  
}

else
{
    header("location: ../Admin-viewTrainSchedule.php?trainNo=$trainNo&trainName=$trainName");
    exit();
}