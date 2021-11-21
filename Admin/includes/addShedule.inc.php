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
    $aTime = $_POST["aTime"];
    $dTime = $_POST["dTime"];

    if ($aTime == NULL && $dTime == NULL){
        header("location: ../Admin-viewTrainSchedule.php?error=invalidTime&trainNo=$trainNo&trainName=$trainName");
        exit();
    }
    if ($aTime == $dTime){
        header("location: ../Admin-viewTrainSchedule.php?error=sameTime&trainNo=$trainNo&trainName=$trainName");
        exit();
    }

    if(RecordExists($conn, $location, $aTime, $dTime)==true){
        header("location: ../Admin-viewTrainSchedule.php?error=recordExist&trainNo=$trainNo&trainName=$trainName");
        exit();
    }

    $sql = "INSERT INTO schedules (trainNo, arrival, aTime, dTime) VALUES (?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    
    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("location: ../Admin-viewTrainSchedule.php?error=stmtfailed&trainNo=$trainNo&trainName=$trainName");
        exit();
    }

    mysqli_stmt_bind_param($stmt,"ssss", $trainNo, $location, $aTime, $dTime);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../Admin-viewTrainSchedule.php?error=none_1&trainNo=$trainNo&trainName=$trainName");
    exit();

}
else
{
    header("location: ../Admin-viewTrainSchedule.php?trainNo=$trainNo&trainName=$trainName");
    exit();
}

function RecordExists($conn, $location, $aTime, $dTime){
    $trainNo = $_GET['trainNo'];
    $sql = "SELECT * FROM schedules WHERE trainNo = $trainNo AND arrival = '$location' AND aTime = '$aTime' AND dTime = '$dTime';";
    $result = mysqli_query($conn, $sql) or die( mysqli_error($conn));
    if(mysqli_fetch_assoc($result)){
        return true;
    }
    else{
        return false;
    }
}
