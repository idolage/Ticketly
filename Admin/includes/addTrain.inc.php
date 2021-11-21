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
        header("location: ../Admin-addTrain.php?error=invalidTrainNo");
        exit();
    }
    if (!is_numeric($stops)) {
        header("location: ../Admin-addTrain.php?error=invalidStop");
        exit();
    }
    if (!is_numeric($distance)) {
        header("location: ../Admin-addTrain.php?error=invalidDist");
        exit();
    }
    if (!is_numeric($first)) {
        header("location: ../Admin-addTrain.php?error=invalidFirst");
        exit();
    }
    if (!is_numeric($second)) {
        header("location: ../Admin-addTrain.php?error=invalidSecond");
        exit();
    }
    if (!is_numeric($third)) {
        header("location: ../Admin-addTrain.php?error=invalidThird");
        exit();
    }
    if(trainNoExists ($conn, $tNo)==true){
        header("location: ../Admin-addTrain.php?error=trainNoExist");
        exit();
    }
    
    addNewTrain ($conn, $tNo, $tName, $line, $stops, $frequency, $start, $end, $distance, $first, $second, $third, $A , $B , $C , $D , $E , $F , $G); 
    
}
else
{
    header("location: ../Admin-addTrain.php");
    exit();
}

?>