<?php
	include('../connection.php');
	session_start();


	session_destroy();

        echo "<script type='text/javascript'>alert('You are now sign out from your account');
                    window.location='../index.php';
                    </script>";

	?>
