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

function invalidUid($username){
    $result = true;
    if (!preg_match("/^[a-zA-Z0-9]*$/",$username)) {
        $result = true;
    }
    else{
        $result  = false;
    }
    return $result; 
} 

function invalidEmail($email){
    $result = true; 
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    }
    else{
        $result  = false;
    }
    return $result;
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

function adminuidExists($conn, $username, $email){
    $sql = "SELECT * FROM admins WHERE adminsUid = ? OR adminsEmail = ?;";
    $stmt = mysqli_stmt_init($conn);
    
    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("location: ../Admin-registerNewAdmin.php?error=stmtfailed");
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

function adminuidExistsUpdate($conn, $username, $email,$id){
    $sql = "SELECT * FROM admins WHERE (adminsUid = ? OR adminsEmail = ?) AND admisId != ? ;";
    $stmt = mysqli_stmt_init($conn);
    
    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("location: ../Admin-registerNewAdmin.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt,"sss", $username, $email, $id);
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

function createAdmin($conn, $name, $email, $username, $tel, $position){
    $sql = "INSERT INTO admins (adminsName, adminsEmail, adminsUid, adminsPwd, contact_no, position) VALUES (?,?,?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    
    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("location: ../Admin-registerNewAdmin.php?error=stmtfailed");
        exit();
    }
    $randstr = uniqid($username);
    $hashedPwd = password_hash($randstr, PASSWORD_DEFAULT); //hashing auto updates

    mysqli_stmt_bind_param($stmt,"ssssss", $name, $email, $username, $hashedPwd, $tel, $position);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    require_once '../../User/includes/email.inc.php';
    $subject = "ticketly New Admin Confirmation Email";
    $body = "Hello " .$username. "! <br>Your temporary password is <strong>" .$randstr."</strong><br>Please reset your password once you logged in.<br><a href='http://localhost/Ticketly/Admin/Admin-Login.php' style='text-decoration:none;'> CLICK HERE TO LOGIN </a>";
    
    sendEmail($email, $name, $body, $subject);
    
    header("location: ../Admin-registerNewAdmin.php?error=none");
    exit();
}

function loginAdmin($conn,$username,$pwd){
    $uidExists = adminuidExists($conn, $username, $username);

    if ($uidExists == false) {
        header("location: ../Admin/Admin-Login.php?error=wronglogin");
        exit();
    }

    $pwdHashed = $uidExists["adminsPwd"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($checkPwd == false) {
        header("location: ../Admin/Admin-Login.php?error=wronglogin");
        exit();
    }
    else if ($checkPwd == true){
        session_start();
        $_SESSION["userid"]= $uidExists["admisId"];
        $_SESSION["useruid"]= $uidExists["adminsUid"];
        $_SESSION["userName"]= $uidExists["adminsName"];
        header("location: ../Admin/Admin-dashboard.php");
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

function function_alert($message) { 
      
    // Display the alert box  
    echo "<script>alert('$message');</script>"; 
} 

function sendOTP($conn,$email, $username){

    $randstr = uniqid($username);
    
    $sql = "UPDATE admins SET adminsPwd = ? WHERE adminsUid = ? AND adminsEmail = ?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("location:  ../Admin-recoverPassword.php?error=stmtfailed");
        exit();
    }
    $hashedPwd = password_hash($randstr, PASSWORD_DEFAULT); //hashing auto updates
    mysqli_stmt_bind_param($stmt,"sss",$hashedPwd, $username, $email);
    mysqli_stmt_execute($stmt);

    require_once '../../User/includes/email.inc.php';
    $subject = "ticketly Recovery code";
    $body = "Hello " .$username. "! <br>Your temporary password is <strong>" .$randstr."</strong><br>Please reset your password once you logged in.<br><a href='http://localhost/Ticketly/Admin/Admin-Login.php' style='text-decoration:none;'> CLICK HERE TO LOGIN </a>";
    
    sendEmail($email, $name, $body, $subject);

    header("location: ../Admin-recoverPassword.php?error=none");
    exit();   
}

function emptyInputAddTrain($locationA, $locationB, $locationAshort, $locationBshort, $type, $price){
    $result = true;
    if (empty($locationA)||empty($locationB)||empty($locationAshort)||empty($locationBshort)||empty($type)||empty($price)) {
        $result = true;        
    }
    else{
        $result = false;
    }
    return $result;
}

function invalidAb($locationAshort,$locationBshort){
    $result = true;
    if (strlen($locationAshort)!= 3 || strlen($locationBshort)!= 3) {
        $result = true;        
    }
    else{
        $result = false;
    }
    return $result;
}

function same($locationA,$locationB){
    $result = true; 
    if ($locationA == $locationB) {
        $result = true;
    }
    else{
        $result  = false;
    }
    return $result;
}

function locationAlreadyIn($conn,$location,$locationShort){
    $result = true;
    $sql = "SELECT * FROM abbreviations WHERE cityName = '$location';";
    $result1 = mysqli_query($conn, $sql) or die( mysqli_error($conn));
    while($row = mysqli_fetch_assoc($result1)){
    if($row["cityAb"] != $locationShort)
        {
            $result = false;
        }
        else
        {
            $result = true;
        }
    }
    
    return $result;
}

function AbIn($conn,$location,$locationShort){
    $result = true;
    $sql = "SELECT * FROM abbreviations WHERE cityAb = '$locationShort';";
    $result1 = mysqli_query($conn, $sql) or die( mysqli_error($conn));
    while($row = mysqli_fetch_assoc($result1)){
    if($row["cityName"] != $location)
        {
            $result = false;
        }
        else
        {
            $result = true;
        }
    }
    
    return $result;
}

function trainExists($conn,$locationAshort,$locationBshort,$type){
    $sql = "SELECT * FROM price WHERE (cityA = ? OR cityB = ?) AND (cityA = ? OR cityB = ?) AND Ttype = ?;";
    $stmt = mysqli_stmt_init($conn);
    
    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("location: ../Admin-addTrainRoute.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt,"sssss", $locationAshort, $locationAshort, $locationBshort, $locationBshort, $type);
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

function locationExists($conn,$location){
    $sql = "SELECT * FROM abbreviations WHERE cityName = ?;";
    $stmt = mysqli_stmt_init($conn);
    $result = true;
    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("location: ../Admin-addTrainRoute.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt,"s",$location);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $result;
    }
    else{
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function addTrain($conn,$locationA, $locationB, $locationAshort, $locationBshort, $type, $price){
    $sql = "INSERT INTO price (cityA, cityB, Ttype, price) VALUES (?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    
    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("location: ../Admin-addTrainRoute.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt,"ssss", $locationAshort, $locationBshort, $type, $price);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $cityExists = locationExists($conn,$locationA);
    if ($cityExists !== true) {
        $sql2 = "INSERT INTO abbreviations (cityName,cityAb) VALUES (?,?);";
        $stmt2 = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt2,$sql2)) {
            header("location: ../Admin-addTrainRoute.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt2,"ss", $locationA, $locationAshort);
        mysqli_stmt_execute($stmt2);
        mysqli_stmt_close($stmt2);
    }

    $cityExists2 = locationExists($conn,$locationB);
    if ($cityExists2 !== true) {
        $sql3 = "INSERT INTO abbreviations (cityName,cityAb) VALUES (?,?);";
        $stmt3 = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt3,$sql3)) {
            header("location: ../Admin-addTrainRoute.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt3,"ss", $locationB, $locationBshort);
        mysqli_stmt_execute($stmt3);
        mysqli_stmt_close($stmt3);
    }
    
    header("location: ../Admin-addTrainRoute.php?error=none");
    exit();
}

function trainNoExists ($conn, $tNo){
    $sql = "SELECT * FROM trains WHERE trainNo = ?;";
    $stmt = mysqli_stmt_init($conn);
    $result = true;
    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("location: ../Admin-addTrain.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt,"s",$tNo);
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

function addNewTrain ($conn, $tNo, $tName, $line, $stops, $frequency, $start, $end, $distance, $first, $second, $third, $A , $B , $C , $D , $E , $F , $G){
    $sql = "INSERT INTO trains (trainNo, trainName, lineType, frequency, stops, distance, startCity, endCity, firstClass, second, third, A, B, C, D, E, F, G) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    
    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("location: ../Admin-addTrain.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt,"ssssssssssssssssss", $tNo, $tName, $line, $frequency, $stops, $distance, $start, $end, $first, $second, $third, $A , $B , $C , $D , $E , $F , $G);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    
    header("location: ../Admin-addTrain.php?error=none");
    exit();
}
