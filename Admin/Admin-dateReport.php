<?php
require_once 'includes/dbh.inc.php';
require('includes/fpdf.php');

$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];

$query = "SELECT ticketNo, token, DATE(purchasedAt), userId, cityA, cityB, Ttype, amount 
          FROM  purchases 
          WHERE DATE(purchasedAt) >= '$start_date' AND  DATE(purchasedAt) <= '$end_date';";
$result = mysqli_query($conn, $query);
$pdf = new FPDF('p', 'mm', 'A4');
$pdf->AddPage();
$pdf->Rect(5, 5, 200, 287, 'D'); //For A4
$pdf->Image('img/logo.png', 20, 10, 24, 35);

$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, 'RAILWAY DEPARTMENT, SRI LANKA', 0, 1, 'C');

$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, 'Transaction Report ( '.$start_date.' - '.$end_date.' )', 0, 1, 'C');
$pdf->SetLeftMargin(65);

$pdf->SetLeftMargin(0);

$pdf->SetFont('Arial', 'B', 11);
$pdf->ln(18);
$pdf->SetLeftMargin(5);

if (mysqli_num_rows($result) > 0) {

    $pdf->Cell(35, 10, 'Date', 1, 0, 'C');
    $pdf->Cell(20, 10, 'Ticket No', 1, 0, 'C');
    $pdf->Cell(80, 10, 'Token ID', 1, 0, 'C');
    $pdf->Cell(15, 10, 'User ID', 1, 0, 'C');
    $pdf->Cell(15, 10, 'Type', 1, 0, 'C');
    $pdf->Cell(35, 10, 'Amount', 1, 1, 'C');

    while ($data = mysqli_fetch_assoc($result)) {
        $pdf->Cell(35, 10, $data['DATE(purchasedAt)'], 1, 0, 'C');
        $pdf->Cell(20, 10, $data['ticketNo'], 1, 0, 'C');
        $pdf->Cell(80, 10, $data['token'], 1, 0, 'C');
        $pdf->Cell(15, 10, $data['userId'], 1, 0, 'C');
        $pdf->Cell(15, 10, $data['Ttype'], 1, 0, 'C');
        $pdf->Cell(35, 10, $data['amount'], 1, 1, 'C');
    }
}
else{
    $pdf->SetLeftMargin(65);

    $pdf->Cell(80, 10, 'No data to be displayed', 0, 0, 'C');
}
$pdf->Output('Date_Report.pdf','I'); // Send to browser and display
?>