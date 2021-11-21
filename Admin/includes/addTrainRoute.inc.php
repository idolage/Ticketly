<?php
session_start();
if (isset($_POST["submit"])) {

    $locationA = $_POST["locationA"];
    $locationB = $_POST["locationB"];
    $locationAshort = $_POST["locationAshort"];
    $locationBshort = $_POST["locationBshort"];
    $type = $_POST["type"];
    $price = $_POST["price"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if (emptyInputAddTrain($locationA, $locationB, $locationAshort, $locationBshort, $type, $price) !== false) {
        header("location: ../Admin-addTrainRoute.php?error=emptyinput");
        exit();
    }
    if (invalidAb($locationAshort,$locationBshort) !== false) {
        header("location: ../Admin-addTrainRoute.php?error=invalidab");
        exit();
    }
    if (same($locationA,$locationB) !== false) {
        header("location: ../Admin-addTrainRoute.php?error=samelocation");
        exit();
    }
    if (same($locationAshort,$locationBshort) !== false) {
        header("location: ../Admin-addTrainRoute.php?error=sameab");
        exit();
    }
    if (locationAlreadyIn($conn,$locationA,$locationAshort) == false) { //location taken, diff ab
        header("location: ../Admin-addTrainRoute.php?error=differentAbA");
        exit();
    }
    if (locationAlreadyIn($conn,$locationB,$locationBshort) == false) {
        header("location: ../Admin-addTrainRoute.php?error=differentAbB");
        exit();
    }
    if (AbIn($conn,$locationA,$locationAshort) == false) { //location taken, diff ab
        header("location: ../Admin-addTrainRoute.php?error=abtakenA");
        exit();
    }
    if (AbIn($conn,$locationB,$locationBshort) == false) {
        header("location: ../Admin-addTrainRoute.php?error=abtakenB");
        exit();
    }
    if (trainExists($conn,$locationAshort,$locationBshort,$type) !== false) {
        header("location: ../Admin-addTrainRoute.php?error=trainexist");
        exit();
    }
    if(is_numeric($price) !== true){
            header("location: ../Admin-addTrainRoute.php?error=invalidamount");
    }
    
    addTrain($conn,$locationA, $locationB, $locationAshort, $locationBshort, $type, $price);    
}

?>