<?php
function test(){
    //session_start();
    if (isset($_POST["submit"])) {

        $username = $_POST["uid"];
        $pwd = $_POST["pwd"];  

        require_once 'dbh.inc.php';
        require_once 'functions.inc.php';    

        if (emptyInputLogin($username, $pwd) !== false) {
            header("location: ../User/User-Login.php?error=emptyinput");
            exit();
        }

        loginUser($conn,$username,$pwd);
    }

    else {
        header("location: ../User/User-Login.php.php");
        exit();
    }
}

?>
