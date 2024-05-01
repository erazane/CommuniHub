<?php
        include('../connection.php');
	session_start();

        $parents_ID = $_SESSION['parents_ID'];


        $don_amount = $_POST['don_amount'];

        $schools_ID = $_POST['schools_ID'];

        $randomno = rand();

          $insert = $connection->query("INSERT INTO donationpayment(don_amount, schools_ID, parents_ID, receiptno)"
          . "VALUES ('$don_amount', '$schools_ID', '$parents_ID', '$randomno')");

          if($insert){
                  $_SESSION['success'] = '';
                   header('location:donatingconfirmation.php?parents_ID='.$parents_ID.'& schools_ID='.$schools_ID.' & receiptno='.$randomno);
          }
      else {
          echo "<script type='text/javascript'>alert('Please enter the correct input for donation amount.');"
          . "window.location='donating.php?schools_ID=". $schools_ID . "';"
                  . "</script>";
      }



?>
