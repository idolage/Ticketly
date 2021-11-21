<?php
require_once 'includes/dbh.inc.php';
require('includes/fpdf.php');
$cNo = $_GET['cNo'];
$query = "SELECT * FROM  complaints INNER JOIN users ON users.usersId = complaints.userId WHERE complaints.cNo = $cNo;";
$result = mysqli_query($conn, $query);

$pdf = new FPDF('p', 'mm', 'A4');
$pdf->AddPage();
$pdf->Rect(5, 5, 200, 287, 'D'); //For A4
$pdf->Image('img/logo.png', 20, 10, 24, 35);

$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, 'RAILWAY DEPARTMENT, SRI LANKA', 0, 1, 'C');

$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, 'Harassment Complaint', 0, 1, 'C');
$pdf->SetLeftMargin(65);

$pdf->SetLeftMargin(0);

$pdf->SetFont('Arial', 'B', 11);
$pdf->ln(18);
$pdf->SetLeftMargin(25);

if (mysqli_num_rows($result) > 0) {

    while ($data = mysqli_fetch_assoc($result)) {
    $pdf->Cell(40, 10, "COMPLAINER'S DETAILS",0, 1, 'L');
    $pdf->SetFont('Arial', '', 10);

    $pdf->Cell(40, 8, 'FULL NAME', 0, 0, 'L');
    $pdf->Cell(40, 8, $data['usersName'], 0, 1, 'L');

    $pdf->Cell(40, 8, 'EMAIL', 0, 0, 'L');
    $pdf->Cell(40, 8, $data['usersEmail'], 0, 1, 'L');

    $pdf->Cell(40, 8, 'CONTACT NUMBER', 0, 0, 'L');
    $pdf->Cell(40, 8, '0'.$data['contactNo'], 0, 1, 'L');

    $pdf->Cell(40, 8, 'GENDER', 0, 0, 'L');
    if ($data['gender'] == 'M') {
        $pdf->Cell(40, 8, "Male", 0, 1, 'L');
    } else if ($data['gender'] == 'F') {
        $pdf->Cell(40, 8, "Female", 0, 1, 'L');
    }else if ($data['gender'] == 'O') {
        $pdf->Cell(40, 8, "Other", 0, 1, 'L');
    }else {
        $pdf->Cell(40, 8, "Not Mentioned", 0, 1, 'L');
    }

    $pdf->ln(9);
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Cell(40, 10, "COMPLAINT DETAILS",0, 1, 'L');
    $pdf->SetFont('Arial', '', 10);

    $pdf->Cell(40, 8, 'TRAIN NO', 0, 0, 'L');
    $pdf->Cell(40, 8, $data['trainNo'], 0, 1, 'L');

    $pdf->Cell(40, 8, 'DESCRIPTION', 0, 0, 'L');
    $pdf->MultiCell(0,5, $data['detail']);
    $pdf->Cell(0,5,'',0,1,'L');

    $pdf->Cell(40, 8, 'DATE & TIME', 0, 0, 'L');
    $pdf->Cell(40, 8, $data['DT'], 0, 1, 'L');

    $pdf->Cell(40, 8, 'REVIEWED BY', 0, 0, 'L'); 
    $pdf->Cell(40, 8, $data['adminsName'], 0, 1, 'L');

    if ($data['photo'] == NULL) {
    }
    else{
        $pdf->ln(9);
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(40, 8, 'UPLOADED IMAGE', 0, 1, 'L'); 

        $file_content = $data['photo'];
        $name = $data['cNo'] . '.png';
        file_put_contents('E:/wamp/www/Ticketly/Admin/img/complaints' . '/' . $name, $file_content);

        $filepath = 'E:/wamp/www/Ticketly/Admin/img/complaints' . '/' . $name;
        $pdf->Image($filepath, 60, 200, 60, 60);
    }

    $pdf->SetFont('Arial', '', 8);
    $pdf->ln(80);
    $pdf->SetTextColor(220,50,50);
    $pdf->Cell(40, 8, 'Disclosure of information to any third party other than the legal authorities is considered as a crime', 0, 1, 'L');

}
}

$pdf->Output('Hcomplaint.pdf','I'); // Send to browser and display
?>

