<?php
session_start();
$id = $_SESSION['userid'];
$trainNo = $_GET['trainNo'];
$trainName = $_GET['trainName'];
require_once 'dbh.inc.php';
require_once 'functions.inc.php';
if (isset($_POST["submit"])) 
{
    $recNo = $_POST["recNo"];
    if(RecNoExists($conn, $recNo)==false){
        header("location: ../Admin-viewTrainSchedule.php?error=Norec&trainNo=$trainNo&trainName=$trainName");
        exit();
    }
    $sql = "DELETE FROM schedules WHERE recNo = ? AND trainNo = ?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("location:  ../Admin-viewTrainSchedule.php?error=stmtfailed&trainNo=$trainNo&trainName=$trainName");
        exit();
    }
    
    mysqli_stmt_bind_param($stmt,"ss",$recNo, $trainNo);
    mysqli_stmt_execute($stmt);
    header("location: ../Admin-viewTrainSchedule.php?error=none_3&trainNo=$trainNo&trainName=$trainName");
    exit();  
}
else
{
    header("location: ../Admin-viewTrainSchedule.php?trainNo=$trainNo&trainName=$trainName");
    exit();
}

function RecNoExists($conn,$recNo){
    $trainNo = $_GET['trainNo'];
    $trainName = $_GET['trainName'];
    $sql = "SELECT * FROM schedules WHERE recNo = ?;";
    $stmt = mysqli_stmt_init($conn);
    $result = true;
    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("location: ../Admin-viewTrainSchedule.php?error=stmtfailed&trainNo=$trainNo&trainName=$trainName");
        exit();
    }

    mysqli_stmt_bind_param($stmt,"s",$recNo);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if (mysqli_fetch_assoc($resultData)) {
        return $result;
    }
    else{
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}