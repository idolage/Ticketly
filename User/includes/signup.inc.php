<?php
session_start();
if (isset($_POST["submit"])) {

    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdrepeat"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if (emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat) !== false) {
        header("location: ../User-signup.php?error=emptyinput");
        exit();
    }
    
    if (invalidUN($username,$conn) == false) {
        header("location: ../User-signup.php?error=invaliduid"); 
        exit();
    }

    if (invalidE($conn,$email) == false) {
        header("location: ../User-signup.php?error=invalidemail");
        exit();
    }

    if (pwdMatch($pwd, $pwdRepeat) !== false) {
        header("location: ../User-signup.php?error=missmatchpwd");
        exit();
    }

    if (uidExists($conn, $username, $email) !== false) {
        header("location: ../User-signup.php?error=uidexist");
        exit();
    }

   createUser($conn, $name, $email, $username, $pwd);
}

else{
    header("location: ../User-signup.php");
    exit();
}

function invalidUN($username,$conn){

    $result = false;
    $sql = "SELECT * FROM users WHERE usersUid = ?;";
    $stmt = mysqli_stmt_init($conn);
    
    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("location: ../User-signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt,"s", $username);
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

function invalidE($conn,$email){
    
    $result = false;
    $sql = "SELECT * FROM users WHERE usersEmail = ?;";
    $stmt = mysqli_stmt_init($conn);
    
    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("location: ../User-signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt,"s", $email);
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
?>