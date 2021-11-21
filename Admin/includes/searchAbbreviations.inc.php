<?php
session_start();
$id = $_SESSION['userid'];
require_once 'dbh.inc.php';
require_once 'functions.inc.php';
if (isset($_POST["submit"])) 
{
    $location = ucwords(strtolower($_POST["location"]));
    $sql = "SELECT * FROM abbreviations WHERE cityName = '$location';";
    $result = mysqli_query($conn, $sql) or die( mysqli_error($conn));
    while ($row = mysqli_fetch_assoc($result)) 
    {
        $ab = $row['cityAb'];
        header("location: ../Admin-addTrainRoute.php?error=results&AbName=$ab&location=$location");
        exit();
    }

    header("location: ../Admin-addTrainRoute.php?error=Noresults");
    exit();
}
else
{
    header("location: ../Admin-addTrainRoute.php");
    exit();
}