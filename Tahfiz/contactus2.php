<?php
        include('connection.php');
	session_start();

        $name = $_POST['name'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];

        $date = date("Y/m/d");

        $insert = $connection->query("INSERT INTO feedback (name, email, subject, message, date) VALUES"
                . "('$name','$email','$subject','$message','$date')");

          if($insert){
                $_SESSION['success'] = '';
                echo "<script type='text/javascript'>alert('Thank you for taking the time to provide us with your feedback.');
            window.location='contactus.php';
            </script>";
        }
        else
        {
            echo "<script type='text/javascript'>alert('There is something went wrong! Please try again!');
            window.location='contactus.php';
            </script>";
        }
      ?>
