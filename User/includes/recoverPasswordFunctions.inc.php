<?php

function emptyInputdouble($email, $uid){
    $result = true;
    if (empty($email)||empty($uid)) {
        $result = true;        
    }
    else{
        $result = false;
    }
    return $result;
}

function invalidEmaildouble($email){
    $result = true; 
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    }
    else{
        $result  = false;
    }
    return $result;
}

function uidExistsdouble($conn, $username, $email){
    $sql = "SELECT * FROM users WHERE usersUid = ? AND usersEmail = ?;";
    $stmt = mysqli_stmt_init($conn);
    
    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("location:  ../User-recoverPassword.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt,"ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    }
    else{
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function sendOTP($conn,$email, $username){

    $randstr = uniqid($username);
    
    $sql = "UPDATE users SET usersPwd = ? WHERE usersUid = ? AND usersEmail = ?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("location:  ../User-recoverPassword.php?error=stmtfailed");
        exit();
    }
    $hashedPwd = password_hash($randstr, PASSWORD_DEFAULT); //hashing auto updates
    mysqli_stmt_bind_param($stmt,"sss",$hashedPwd, $username, $email);
    mysqli_stmt_execute($stmt);

    require_once 'email.inc.php';
    $subject = "ticketly Recovery code";
    $body = "Hello " .$username. "! <br>Your temporary password is <strong>" .$randstr."</strong><br>Please reset your password once you logged in.<br><a href='http://localhost/Ticketly/User/User-Login.php' style='text-decoration:none;'> CLICK HERE TO LOGIN </a>";
    
    //sendEmail($email, $name, $body, $subject);

    header("location: ../User-login.php?error=none2");
    exit();   
}

?>