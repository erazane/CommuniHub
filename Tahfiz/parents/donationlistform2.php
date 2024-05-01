<?php
        include('../connection.php');
	session_start();

        $parents_ID = $_SESSION['parents_ID'];


        $don_amount = $_POST['don_amount'];

        $schools_ID = $_POST['schools_ID'];

        $donation_ID = $_POST['donation_ID'];

        $donationDate = date("Y/m/d");

        $randomno = rand();

          $insert = $connection->query("INSERT INTO donationpayment(don_amount, schools_ID, parents_ID, donation_ID, don_date, receiptno)"
          . "VALUES ('$don_amount', '$schools_ID', '$parents_ID', '$donation_ID', '$donationDate', '$randomno')");

          if($insert){
                  $_SESSION['success'] = '';
                   header('location:donatingconfirmation.php?parents_ID='.$parents_ID.'& schools_ID='.$schools_ID.'& donation_ID='.$donation_ID.' & receiptno='.$randomno);
          }
      else {
          echo "<script type='text/javascript'>alert('Please enter the correct input for donation amount.');"
          . "window.location='donationlistform.php?schools_ID=". $schools_ID . " &donation_ID=". $donation_ID ." ';"
                  . "</script>";
      }



?>
