<?php
        include('../connection.php');
	session_start();

        $id = $_SESSION['parents_ID'];

        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $phoneno = $_POST['phoneno'];
        $email = $_POST['email'];
        $street_name = $_POST['street_name'];
        $state = $_POST['state'];
        $city= $_POST['city'];
        $postcode = $_POST['postcode'];
        $ic_number = $_POST['ic_number'];
        $password = $_POST['password'];

        $update = $connection->query("UPDATE parents SET firstname = '$firstname', lastname = '$lastname', phoneno = '$phoneno', email = '$email', street_name = '$street_name', state = '$state', city = '$city',
          postcode = '$postcode', ic_number = '$ic_number', password = '$password' WHERE parents_ID = '$id'");

          if ($update){
            $_SESSION['success'] = '';
          echo "<script type='text/javascript'>alert('Your profile are successfully updated.');
            window.location='index.php';
              </script>";
          }
          else {
          echo "<script type='text/javascript'>alert('Error!');
            window.location='index.php';
            </script>";
          }

?>
