<?php
session_start();
$id = $_SESSION['userid'];
require_once 'dbh.inc.php';
require_once 'functions.inc.php';

if (isset($_POST["submit"])) 
{
    // Sanitize POST Array
    $POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);

    $from = $_POST['from'];
    $to = $_POST['to'];
    $type = $_POST['type'];
    $dt = $_POST['dt'];
    $price = "0";
    $fromAb = $toAb = '';

    if($from == $to){
        header("location: ../User-buyTrainTicket.php?error=Samecity");
        exit();
    }

    $sql2 = "SELECT * FROM abbreviations WHERE cityName='$from';";
    $result2 = mysqli_query($conn,$sql2);
    if ($result2) {
                                    
        while ($row2=mysqli_fetch_array($result2)) {
            $fromAb = $row2["cityAb"];
        }
    }

    $sql3 = "SELECT * FROM abbreviations WHERE cityName='$to';";
    $result3 = mysqli_query($conn,$sql3);
    if ($result3) {
                                    
        while ($row3=mysqli_fetch_array($result3)) {
            $toAb = $row3["cityAb"];
        }
    }

    $sql5 = "SELECT COUNT(token) FROM purchases WHERE DT='$dt' AND cityA='$from' AND  cityB='$to' AND Ttype='$type';";
    $result5 = mysqli_query($conn,$sql5);
    if ($result5) {
                                    
        while ($row5=mysqli_fetch_array($result5)) {
            echo $row5["COUNT(token)"];
            if($row5["COUNT(token)"] >= 1 ){
                header("location: ../User-buyTrainTicket.php?error=exceed");
                exit();
            }
        }
    }

    $sql = "SELECT * FROM price WHERE (cityA='$fromAb' OR  cityA='$toAb') AND (cityB='$fromAb' OR  cityB='$toAb') AND Ttype='$type';";
    $result = mysqli_query($conn,$sql);
    if ($result) {
                                    
        while ($row=mysqli_fetch_array($result)) {
            $price = $row["price"];
        }
    }

    if ($price == "0") {
        header("location: ../User-buyTrainTicket.php?error=noTrain");
        exit();
    }
    else {
        $_SESSION['from'] = $from;
        $_SESSION['to'] = $to;
        $_SESSION['fromAb'] = $fromAb;
        $_SESSION['toAb'] = $toAb;
        $_SESSION['type'] = $type;
        $_SESSION['dt'] = $dt;
        $_SESSION['price'] = $price;
        header("location: ../User-TicketAvailable.php");        
        exit();
    }

}
else
{
    header("location: ../User-buyTrainTicket.php");
    exit();
}