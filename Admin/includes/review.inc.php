<?php
session_start();
require_once 'dbh.inc.php';
require_once '../../User/includes/email.inc.php';
$id = $_SESSION["userid"];
$adminsName = $_SESSION["userName"];
$cNo = $_SESSION['cNo']; 
$usersName = $_SESSION['usersName']; 
$usersEmail = $_SESSION['usersEmail'];
$feedback = $_POST['feedback'];

    $sql = "UPDATE complaints SET adminsName = ?, adminsID = ? WHERE cNo = ?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("location:  ../Admin-viewComplaints.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt,"sss",$adminsName, $id , $cNo);
    mysqli_stmt_execute($stmt);

    $subject = "Your Complaint Has Been Reviewed";
    $body = "Hello " .$usersName. "! <br>Thanks so much for reaching out and letting us know. The feedback reagarding complaint no: ".$cNo. " is as below, <br><strong>"
    .$feedback. "</strong><br>If you have any further concerns please don't hesitate to reach out.<br>Thank you,<br>".$adminsName." - Team Ticketly";

    sendEmail($usersEmail, $usersName, $body, $subject);
    
    header("location: ../Admin-viewComplaints.php?error=none");
    exit();

?>