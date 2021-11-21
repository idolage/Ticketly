<?php
function test(){
    if (isset($_POST["submit"])) {

        $username = $_POST["uid"];
        $pwd = $_POST["pwd"];

        require_once 'dbh.inc.php';
        require_once 'functions.inc.php';

        if (emptyInputLogin($username, $pwd) !== false) {
            header("location: ../Admin/Admin-Login.php?error=emptyinput");
            exit();
        }

        loginAdmin($conn,$username,$pwd);
        
    }

    else {
        header("location: ../Admin/Admin-Login.php");
        exit();
    }
}
?>