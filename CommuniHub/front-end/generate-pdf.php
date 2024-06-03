<?php
require('../fpdf/fpdf.php');

if (isset($_SESSION["UserID"])) {
    $UserID = $_SESSION["UserID"];
} elseif (isset($_GET['UserID'])) {
    $UserID = $_GET['UserID'];
    $_SESSION["UserID"] = $UserID; // Set UserID in session if not already set
} else {
    die('UserID is required');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once('../Database/database.php');

    $UserID = $_POST['UserID'];
    $DonationID = $_POST['DonationID'];
    $DonationTotal = $_POST['DonationTotal'];
    $DonationMessage = $_POST['DonationMessage'];
    $cardType = $_POST['cardType'];

    // Fetch user details from the database
    $query = "SELECT UserFirstName, UserLastName FROM user WHERE UserID = $UserID";
    $result = mysqli_query($dbc, $query);

    if ($result) {
        $userData = mysqli_fetch_assoc($result);
        $UserFirstName = $userData['UserFirstName'];
        $UserLastName = $userData['UserLastName'];
    } else {
        echo "Error: " . mysqli_error($dbc);
    }
}

// Create a new PDF document
class PDF extends FPDF {
    // Page header
    function Header() {
        $this->SetFont('Arial', 'B', 15);
        $this->SetTextColor(255, 255, 255); // White text
        $this->SetFillColor(0, 102, 204); // Blue background
        $this->Cell(0, 10, 'Invoice', 0, 1, 'C', true);
        $this->Ln(10);
    }

// Page footer
function Footer() {
    $this->SetY(-15);
    $this->SetFont('Arial', 'I', 8);
    $this->SetTextColor(255, 255, 255);
    $this->SetFillColor(0, 102, 204);
    $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C', true);
}
}

// Instantiate the PDF object
$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);

$pdf->Image('./images/receipt/logo.png', 10, 30, 30); 

$pdf->Cell(71, 5, '', 0, 0);
$pdf->Cell(60, 5, '', 0, 0);
$pdf->Cell(60, 5, 'Invoice Number', 0, 1);

$pdf->Ln(10);

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, "Donor's Details", 0, 1);

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 10, "Name: 'UserFirstName 'UserLastName", 0, 1);
$pdf->Cell(0, 10, "Date: " . date("Y-m-d"), 0, 1);

$pdf->Ln(10);

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(63, 10, 'Type', 1, 0, 'C');
$pdf->Cell(63, 10, 'Amount', 1, 0, 'C');
$pdf->Cell(64, 10, 'Date', 1, 1, 'C');

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(63, 10, 'cardType', 1, 0);
$pdf->Cell(63, 10, 'DonationTotal', 1, 0);
$pdf->Cell(64, 10, date("Y-m-d"), 1, 1);

$pdf->Ln(10);



$pdf->Ln(10);

$pdf->SetFont('Arial', 'I', 12);
$pdf->MultiCell(0, 10, "Thank you for the kind donation,\nEvery penny will be going straight to improving our community!\n\nDate issued: " . date("Y-m-d"));

$pdf->Output();
?>
