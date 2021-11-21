<?php
session_start();
$id = $_SESSION['userid'];
$trainNo = $_GET['trainNo'];
$trainName = $_GET['trainName'];
require_once 'dbh.inc.php';
require_once 'functions.inc.php';
if (isset($_POST["submit"])) 
{
    $location = ucwords(strtolower($_POST["location"]));
    $sql = "SELECT * FROM schedules WHERE trainNo = $trainNo AND arrival = '$location';";
    $result = mysqli_query($conn, $sql) or die( mysqli_error($conn));
    while ($row = mysqli_fetch_assoc($result)) 
    {
        $recNo = $row["recNo"];
        $aTime = $row["aTime"];
        $dTime = $row["dTime"];
        header("location: ../User-viewTrainSchedule.php?error=results&trainNo=$trainNo&trainName=$trainName&recNo=$recNo&aTime=$aTime&dTime=$dTime&location=$location");
        exit();
    }

    header("location: ../User-viewTrainSchedule.php?error=Noresults&trainNo=$trainNo&trainName=$trainName");
    exit();
}
else
{
    header("location: ../User-viewTrainSchedule.php?trainNo=$trainNo&trainName=$trainName");
    exit();
}