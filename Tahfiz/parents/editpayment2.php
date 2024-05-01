<?php
        include('../connection.php');
	session_start();

        $id = $_SESSION['parents_ID'];

        $bankname = $_POST['bankname'];
        $card_name = $_POST['card_name'];
        $card_no = $_POST['card_no'];
        $cvv = $_POST['cvv'];
        $exp_date = $_POST['exp_date'];
        $address1 = $_POST['address1'];
        $address2 = $_POST['address2'];
        $state = $_POST['state'];
        $postcode = $_POST['postcode'];

        $update = $connection->query("UPDATE payment SET bankname = '$bankname', card_name = '$card_name', card_no = '$card_no', cvv = '$cvv', exp_date = '$exp_date', address1 = '$address1', address2 = '$address2',
          state = '$state', postcode = '$postcode' WHERE parents_ID = '$id'");

        // $insert = $connection->query("INSERT INTO payment SET card_name = '$card_name', card_no = '$card_no', cvv = '$cvv',
        //   exp_date = '$exp_date', address1 = '$address1', address2 = '$address2', state = '$state', postcode = '$postcode'
        //   WHERE payment_ID = '$id'");

          if ($update){
            $_SESSION['success'] = '';
          echo "<script type='text/javascript'>alert('Your profile are successfully updated.');
            window.location='editpayment.php';
              </script>";
          }
          else {
          echo "<script type='text/javascript'>alert('Error!');
            window.location='editpayment.php';
            </script>";
          }

?>
