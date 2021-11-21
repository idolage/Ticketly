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
    if(RecNoExists($conn, $recNo)==false){
        header("location: ../Admin-viewTrainSchedule.php?error=Norec&trainNo=$trainNo&trainName=$trainName");
        exit();
    }
    if(RecordExists($conn, $location, $aTime, $dTime)==true){
        header("location: ../Admin-viewTrainSchedule.php?error=recordExist&trainNo=$trainNo&trainName=$trainName");
        exit();
    }

    $sql = "UPDATE schedules SET arrival = ?, aTime = ?, dTime = ? WHERE recNo = ? AND trainNo = ?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("location:  ../Admin-viewTrainSchedule.php?error=stmtfailed&trainNo=$trainNo&trainName=$trainName");
        exit();
    }
    
    mysqli_stmt_bind_param($stmt,"sssss",$location, $aTime, $dTime, $recNo, $trainNo);
    mysqli_stmt_execute($stmt);
    header("location: ../Admin-viewTrainSchedule.php?error=none_2&trainNo=$trainNo&trainName=$trainName");
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
