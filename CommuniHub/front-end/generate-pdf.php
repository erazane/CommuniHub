<?php
session_start();
require('../fpdf/fpdf.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if required fields are set
    if (!isset($_POST['UserID'], $_POST['DonationID'], $_POST['DonationTotal'], $_POST['DonationMessage'], $_POST['cardType'])) {
        die('Required fields are missing');
    }

    $UserID = $_POST['UserID'];
    $DonationID = $_POST['DonationID'];
    $DonationTotal = $_POST['DonationTotal'];
    $DonationMessage = $_POST['DonationMessage'];
    $cardType = $_POST['cardType'];

    // Fetch user details from the database
    require_once('../Database/database.php'); // Adjust path as necessary
    $query = "SELECT UserFirstName, UserLastName FROM user WHERE UserID = $UserID";
    $result = mysqli_query($dbc, $query);

    if ($result) {
        $userData = mysqli_fetch_assoc($result);
        $UserFirstName = $userData['UserFirstName'];
        $UserLastName = $userData['UserLastName'];
    } else {
        die("Error: " . mysqli_error($dbc));
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

    // Adjust the position and content as per your layout needs
    $pdf->Cell(0, 10, "Donor's Details", 0, 1);
    $pdf->Cell(0, 10, "Name: $UserFirstName $UserLastName", 0, 1);
    // $pdf->Cell(0, 10, "Date: " . date("Y-m-d"), 0, 1);

    $pdf->Ln(10);

    $pdf->Cell(63, 10, 'Card Type', 1, 0, 'C');
    $pdf->Cell(63, 10, 'Amount', 1, 0, 'C');
    $pdf->Cell(64, 10, 'Date', 1, 1, 'C');

    $pdf->Cell(63, 10, $cardType, 1, 0);
    $pdf->Cell(63, 10, 'RM ' . $DonationTotal, 1, 0);
    $pdf->Cell(64, 10, date("Y-m-d"), 1, 1);

    $pdf->Ln(10);

    // $pdf->SetFont('Arial', 'I', 12);
    // $pdf->MultiCell(0, 10, "Thank you for the kind donation,\nAll the funds collected will be used stricly on making our community a better place for all its residents.\nDate issued: " . date("Y-m-d"));
    $pdf->SetFont('Arial', 'I', 12);
    $pdf->MultiCell(0, 10, "Thank you for your generous donation,\nYour contribution will play a vital role in transforming our community.\n\nWe assure you that every penny will be used strictly for initiatives aimed at enhancing the lives of our residents.\n\nDate issued: " . date("Y-m-d"));
    
    // Output the PDF
    $pdf->Output();
} else {
    die('Method not allowed');
}
?>
