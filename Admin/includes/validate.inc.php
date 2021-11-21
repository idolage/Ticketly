<?php
require_once 'dbh.inc.php';
if (isset($_POST["submit"])) 
{
    $ticketNo = $_POST["ticketNo"];
    $sql = "SELECT * FROM purchases WHERE ticketNo = $ticketNo;";
    $result = mysqli_query($conn, $sql) or die( mysqli_error($conn));
    while ($row = mysqli_fetch_assoc($result)) 
    {
        $ticketNo = $row["ticketNo"];
        $token = $row["token"];
        $cityA = $row["cityA"];
        $cityB = $row["cityB"];
        $DT = $row["DT"];

        if($row["Ttype"] = 'ac'){
            $Ttype='First Class';
        }
        elseif($row["Ttype"] = 'sc'){
            $Ttype='Second Class';
        }
        else{
            $Ttype='Third Class';
        }
        header("location: ../Admin-validate.php?error=results&ticketNo=$ticketNo&token=$token&cityA=$cityA&cityB=$cityB&DT=$DT&Ttype=$Ttype");
        exit();
    }

    header("location: ../Admin-validate.php?error=Noresults");
    exit();
}
else
{
    header("location: ../Admin-validate.php");
    exit();
}