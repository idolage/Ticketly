<?php
session_start();
$id = $_SESSION['userid'];
require_once 'dbh.inc.php';
require_once 'functions.inc.php';

if (isset($_POST["submit"])) {
     $n1 = $_POST['n1'];
     $n2 = $_POST['n2'];
     $n3 = $_POST['n3'];
     $n4 = $_POST['n4'];
     $n5 = $_POST['n5'];

    if (!is_numeric($n1)) {
        header("location: ../Admin-createNotifications.php?error=notNumeric");
        exit();
    }

    else{
        deleteNotification($conn,$n1);
    }

    if ($n2 != NULL){
        if (!is_numeric($n2)) {
            header("location: ../Admin-createNotifications.php?error=notNumeric");
            exit();
        }
        else{
            deleteNotification($conn,$n2);
        }
    }
    if ($n3 != NULL){
        if (!is_numeric($n3)) {
            header("location: ../Admin-createNotifications.php?error=notNumeric");
            exit();
        }
        else{
            deleteNotification($conn,$n3);
        }
    }
    if ($n4 != NULL){
        if (!is_numeric($n4)) {
            header("location: ../Admin-createNotifications.php?error=notNumeric");
            exit();
        }
        else{
            deleteNotification($conn,$n4);
        }
    }
    if ($n5 != NULL){
        if (!is_numeric($n5)) {
            header("location: ../Admin-createNotifications.php?error=notNumeric");
            exit();
        }
        else{
            deleteNotification($conn,$n5);
        }
    }

    header("location: ../Admin-createNotifications.php?error=none2");
    exit(); 
    
}
else
{
    header("location: ../Admin-createNotifications.php");
    exit();
}


function deleteNotification($conn,$no){
    $sql = "DELETE FROM notifications WHERE notNo = ?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("location:  ../Admin-createNotifications.php?error=stmtfailed");
        exit();
    }
    
    mysqli_stmt_bind_param($stmt,"s",$no);
    mysqli_stmt_execute($stmt);
}
?>
