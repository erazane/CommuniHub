<?php

        include('../connection.php');
	session_start();

        $status = $_POST['status'];
        $id = $_POST['schools_ID'];

        $update = $connection->query("UPDATE schools SET status = '$status' WHERE schools_ID = '$id'");

         $update = $connection->query("UPDATE login SET status = '$status' WHERE schools_ID = '$id'");

        if($update){
            $_SESSION['success'] = '';
            echo "<script type='text/javascript'>alert('You have update the approval status.');
            window.location='schoolauthdetails.php?schools_ID=".$id."';
            </script>";
           }
             else
              {
               echo 'error';
              }

            ?>
