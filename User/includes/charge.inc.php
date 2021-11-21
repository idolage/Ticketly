<?php
session_start();
$id = $_SESSION['userid'];
require_once '../../vendor/autoload.php';
require_once 'dbh.inc.php';
require_once 'functions.inc.php';
require_once 'email.inc.php';

\Stripe\Stripe::setApiKey('sk_test_51I2wZ8EG7KGMl4QwyFek7A5Tdi5HmY1zhvfDZXF3tOg5nmEthyYa0TiQqhU36ElpmdQYHdrvRC4ywfzOJZQEWi1p00U56ikRwn');

// Sanitize POST Array
$POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);

$token = $POST['stripeToken'];
$cityA = $_SESSION['from'];
$cityB = $_SESSION['to'];
$dt = $_SESSION['dt'];
$amount = $_SESSION['price'];
$type = $_SESSION['type'];
$tClass = $ticketNo ='';

if($type=='ac'){
    $tClass='First Class';
}
else if($type=='sc'){
    $tClass='Second Class';
}
else if($type=='tc'){
    $tClass='Third Class';
}
echo $tClass;
$query = "SELECT COUNT(token) FROM purchases;";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_array($result)) {
    $ticketNo = $row["COUNT(token)"]+1;
}

date_default_timezone_set('Asia/Colombo');
$dtt = date('Y-m-d H:i:s');

$sql = "INSERT INTO purchases (ticketNo, token, userId, cityA, cityB, Ttype, amount, DT) VALUES (?,?,?,?,?,?,?,?);";
$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt,$sql)) {
    header("location: ../User-buyTrainTicket.php?error=stmtfailed");
    exit();
}
mysqli_stmt_bind_param($stmt,"ssssssss",$ticketNo,$token,$id,$cityA,$cityB,$type,$amount,$dt);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

$subject= "Purchased From Ticketly";
$name = $_SESSION["userName"];
$email = $_SESSION["userEmail"];
$body = "<strong>Hello ".$name."!</strong><br>You have successfully purchased your e-ticket from Ticketly.<br><br>Ticket details:<br>
<table class='0 border'>
        <tr>
            <td>Ticket No</td>
            <td>:</td>
            <td>".$ticketNo."</td>
        </tr> 
        <tr>
            <td>Token ID</td>
            <td>:</td>
            <td>".$token."</td>
        </tr> 
        <tr>
            <td>Payment method</td>
            <td>:</td>
            <td>Online</td>
        </tr> 
        <tr>
            <td>Amount</td>
            <td>:</td>
            <td>".$amount.".00 LKR</td>
        </tr> 
        <tr>
            <td>From</td>
            <td>:</td>
            <td>".$cityA."</td>
        </tr>
        <tr>
            <td>To</td>
            <td>:</td>
            <td>".$cityB."</td>
        </tr>
        <tr>
            <td>Class</td>
            <td>:</td>
            <td>".$tClass."</td>
        </tr>
        <tr>
            <td>Date of Travel</td>
            <td>:</td>
            <td>".$dt."</td>
        </tr>
        <tr>
            <td>Purchased Date & Time</td>
            <td>:</td>
            <td>".$dtt."</td>
        </tr>
        </table>Thank you for using Ticketly!";

        sendEmail($email, $name, $body, $subject);

        header("Location: ../User-buyTrainTicket.php?error=paid");
        exit();
?>