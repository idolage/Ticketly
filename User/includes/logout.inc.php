<?php

session_start();
unset($_SESSION[""]);
//session_unset();
$_SESSION = array();
session_destroy();

header("location: ../User-Login.php");
exit();