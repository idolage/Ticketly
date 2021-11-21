<?php
session_start();
$id = $_SESSION['userid'];
require_once 'dbh.inc.php';
require_once 'functions.inc.php';
$trainNo = $_GET['trainNo'];

if (isset($_POST["submit"])) {

    $tNo = $_POST["tNo"];
    $tName = $_POST["tName"];
    $line = $_POST["line"];
    $stops = $_POST["stops"];
    $start = ucwords(strtolower($_POST["start"]));
    $end = ucwords(strtolower($_POST["end"]));
    $distance = $_POST["distance"];
    $first = $_POST["first"];
    $second = $_POST["second"];
    $third = $_POST["third"];
    $frequency = $_POST["frequency"];
    $A = $B = $C = $D = $E = $F = $G = 0;

    if(isset($_POST["A"])){
        $A = 1;
    }
    if(isset($_POST["B"])){
        $B = 1;
    }
    if(isset($_POST["C"])){
        $C = 1;
    }
    if(isset($_POST["D"])){
        $D = 1;
    }
    if(isset($_POST["E"])){
        $E = 1;
    }
    if(isset($_POST["F"])){
        $F = 1;
    }
    if(isset($_POST["G"])){
        $G = 1;
    }

    if (!is_numeric($tNo)) {
        header("location: ../Admin-viewTrainDetails.php?error=invalidTrainNo&trainNo=$trainNo");
        exit();
    }
    if (!is_numeric($stops)) {
        header("location: ../Admin-viewTrainDetails.php?error=invalidStop&trainNo=$trainNo");
        exit();
    }
    if (!is_numeric($distance)) {
        header("location: ../Admin-viewTrainDetails.php?error=invalidDist&trainNo=$trainNo");
        exit();
    }
    if (!is_numeric($first)) {
        header("location: ../Admin-viewTrainDetails.php?error=invalidFirst&trainNo=$trainNo");
        exit();
    }
    if (!is_numeric($second)) {
        header("location: ../Admin-viewTrainDetails.php?error=invalidSecond&trainNo=$trainNo");
        exit();
    }
    if (!is_numeric($third)) {
        header("location: ../Admin-viewTrainDetails.php?error=invalidThird&trainNo=$trainNo");
        exit();
    }
    if(trainNoExists ($conn, $tNo)==true && $tNo!=$trainNo){
        header("location: ../Admin-viewTrainDetails.php?error=trainNoExist&trainNo=$trainNo");
        exit();
    }

    $sql = "UPDATE trains SET trainNo = ?, trainName = ?, lineType = ?, frequency = ?, stops = ?, startCity = ?, endCity = ?, distance = ?, firstClass = ?, 
    second = ?, third = ?, A = ?, B = ?, C = ?, D = ?, E = ?, F = ?, G = ? WHERE trainNo = ?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("location:  ../Admin-viewTrainDetails.php?error=stmtfailed&trainNo=$trainNo");
        exit();
    }
    
    mysqli_stmt_bind_param($stmt,"sssssssssssssssssss",$tNo, $tName, $line, $frequency, $stops, $start, $end, $distance, $first, $second, $third, $A , $B , $C , $D , $E , $F , $G, $trainNo);
    mysqli_stmt_execute($stmt);
    header("location: ../Admin-viewTrainDetails.php?error=none&trainNo=$tNo");
    exit();
}
else
{
    header("location: ../Admin-viewTrainDetails.php?trainNo=$trainNo");
    exit();
}
?>