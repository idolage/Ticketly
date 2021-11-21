<?php

function emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat){
    $result = true;
    if (empty($name)||empty($email)||empty($username)||empty($pwd)||empty($pwdRepeat)) {
        $result = true;        
    }
    else{
        $result = false;
    }
    return $result;
}

function invalidUid($username,$conn,$id){

    $result = false;
    $sql = "SELECT * FROM users WHERE usersUid = ? AND usersId != ?;";
    $stmt = mysqli_stmt_init($conn);
    
    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("location: ../User-dashboard.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt,"ss", $username,$id);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if (mysqli_fetch_assoc($resultData)) {
        return $result;
    }
    else{

        $result = true; 
        if (!preg_match("/^[a-zA-Z0-9]*$/",$username)) {
            $result  = false;
            return $result;
        }
        else{
            $result = true;
            return $result;
        }
    }

    mysqli_stmt_close($stmt);
} 

function invalidName($name){
    $result = true;
    if (!preg_match('/^[\w\s?]+$/si',$name)) {
        $result = true;
    }
    else{
        $result  = false;
    }
    return $result;
}

function invalidTelNo($contactNo){
    $result = true;
    if((strlen($contactNo) == 10 || $contactNo == 0)&& is_numeric($contactNo)){
        $result = false;
    }
    return $result;; 
} 

function invalidEmail($conn,$email,$id){
    
    $result = false;
    $sql = "SELECT * FROM users WHERE usersEmail = ? AND usersId != ?;";
    $stmt = mysqli_stmt_init($conn);
    
    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("location: ../User-dashboard.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt,"ss", $email,$id);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if (mysqli_fetch_assoc($resultData)) {
        return $result;
    }
    else{

        $result = true; 
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $result  = false;
            return $result;
        }
        else{
            $result = true;
            return $result;
        }
    }

    mysqli_stmt_close($stmt);
} 

function updateUser($conn, $id, $username, $name, $gender,$email, $contactNo){
    $sql = "UPDATE users SET usersName = ?, usersEmail = ?, usersUid = ?, contactNo = ?, gender = ? WHERE usersId = ?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("location: ../User-dashboard.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt,"ssssss",$name,$email,$username,$contactNo,$gender,$id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("Location: ../User-dashboard.php?error=none");
    exit();
}

function pwdMatch($pwd, $pwdRepeat){
    $result = true; 
    if ($pwd !== $pwdRepeat) {
        $result = true;
    }
    else{
        $result  = false;
    }
    return $result;
} 

function uidExists($conn, $username, $email){
    $sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;";
    $stmt = mysqli_stmt_init($conn);
    
    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("location: ../User-signup.php?error=stmtfailed");
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

function createUser($conn, $name, $email, $username, $pwd){
    $sql = "INSERT INTO users (usersName, usersEmail, usersUid, usersPwd) VALUES (?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    
    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("location: ../User-signup.php?error=stmtfailed");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT); //hashing auto updates

    mysqli_stmt_bind_param($stmt,"ssss", $name, $email, $username, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    require_once 'email.inc.php';

    $body = "Hello " .$username. "!<br>You have signed up successfully!<br>You can now log in to your account and start using our services";
    $subject = "ticketly Sign Up Email Confirmation";
    sendEmail($email, $name, $body, $subject);
    
    header("location: ../User-signup.php?error=none");
    exit();
}

function emptyInputLogin($username, $pwd){
    $result = true;
    if (empty($username)||empty($pwd)) {
        $result = true;        
    }
    else{
        $result = false;
    }
    return $result;
}

function loginUser($conn,$username,$pwd){
    $uidExists = uidExists($conn, $username, $username);

    if ($uidExists == false) {
        header("location: ../User/User-Login.php?error=wronglogin");
        exit();
    }

    $pwdHashed = $uidExists["usersPwd"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($checkPwd == false) {
        header("location: ../User/User-Login.php?error=wronglogin");
        exit();
    }
    if($uidExists["usersStatus"]=='0'){
        header("location: ../User/User-Login.php?error=inactive");
        exit();
    }
    else if (($checkPwd == true) && ($uidExists["usersStatus"]=='1')){
        session_start();
        $_SESSION["userid"]= $uidExists["usersId"];
        $_SESSION["useruid"]= $uidExists["usersUid"];
        $_SESSION["userName"]= $uidExists["usersName"];
        $_SESSION["userEmail"]= $uidExists["usersEmail"];
        header("location: ../User/User-dashboard.php");
        exit();
    }
}


function emptyInputChangePwd($username, $pwd, $newpwd, $newpwdRepeat){
    $result = true;
    if (empty($username)||empty($pwd)||empty($newpwd)||empty($newpwdRepeat)) {
        $result = true;        
    }
    else{
        $result = false;
    }
    return $result;
}

function uidExistsReg($conn, $username, $email){
    $sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;";
    $stmt = mysqli_stmt_init($conn);
    
    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("location: ../Users/changePassword.php?error=stmtfailed");
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

function changePwd($conn, $id, $pwd ){
    
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT); //hashing auto updates
    
    $sql = "UPDATE users SET usersPwd = ? WHERE usersId = ?;";
    
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("location: ../User-dashboard.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt,"ss",$hashedPwd,$id); 
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../User-dashboard.php?error=none2");
    exit();
}

function loginUserReg($conn,$username,$pwd,$newpwd){
    $uidExists = uidExists($conn, $username, $username);

    if ($uidExists == false) {
        header("location: ../Users/changePassword.php?error=wronglogin");
        exit();
    }

    $pwdHashed = $uidExists["usersPwd"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($checkPwd == false) {
        header("location: ../Users/changePassword.php?error=wronglogin");
        exit();
    }
    else if ($checkPwd == true){
        changePwd($conn, $username,$newpwd);
    }
}

function function_alert($message) { 
      
    // Display the alert box  
    echo "<script>alert('$message');</script>"; 
} 

