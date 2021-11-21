<?php
session_start();
$id = $_SESSION['userid'];
require_once 'dbh.inc.php';
require_once 'functions.inc.php';
$trainNo = $_GET['trainNo'];

if (isset($_POST["no"])) 
{
    header("location: ../Admin-viewTrainDetails.php?trainNo=$trainNo");
    exit();
}

else if (isset($_POST["yes"])) 
{
    $del = mysqli_query($conn,"DELETE FROM trains WHERE trainNo = $trainNo");
    $del = mysqli_query($conn,"DELETE FROM schedules WHERE trainNo = $trainNo");

    if($del)
    header("location: ../Admin-checkTrainDetails.php");
}

else
{
    header("location: ../Admin-viewTrainDetails.php?trainNo=$trainNo");
    exit();
}
?>