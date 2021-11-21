<?php
session_start();
$id = $_SESSION['userid'];
require_once 'dbh.inc.php';
require_once 'functions.inc.php';

if (isset($_POST["submit"])) {

    $title = $_POST['title'];
    $content = $_POST['content'];

    $sql = "INSERT INTO notifications (title, content , adminID) VALUES (?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    
    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("location: ../Admin-createNotifications.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt,"sss", $title, $content, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../Admin-createNotifications.php?error=none1");
    exit();

}
else
{
    header("location: ../Admin-createNotifications.php");
    exit();
}
?>