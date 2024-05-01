<?php
include('connection.php');
	session_start();

      $firstname = $_POST['firstname'];
      $lastname = $_POST['lastname'];
      $icnumber = $_POST['icnumber'];
      $phoneno = $_POST['phoneno'];
      $email = $_POST['email'];
      $password = $_POST['password'];
      $street = $_POST['street'];
      $state = $_POST['state'];
      $city = $_POST['city'];
      $postcode = $_POST['postcode'];

        $joinedDate = date("Y/m/d");

                        $insert = $connection->query("INSERT INTO parents(firstname, lastname, phoneno, email, street_name, state, city, postcode, ic_number, password)"
                        . "VALUES ('$firstname', '$lastname', '$phoneno', '$email', '$street', '$state', '$city', '$postcode', '$icnumber', '$password')");

                         $last_inserted_row = mysqli_insert_id($connection);
                         $insert2 = $connection->query("INSERT INTO login(email, password, type, parents_ID, status)"
												 . "VALUES ('$email', '$password', 'parent', '$last_inserted_row', 'Approved')");


                    if ($insert && $insert2){
           						$_SESSION['success'] = '';
           					echo "<script type='text/javascript'>alert('Thank You for to be part of Tahfiz Care. You are now can directly login to Tahfiz Care');
                			window.location='loginparents.php';
                				</script>";
       							}
       					else {
         						echo "<script type='text/javascript'>alert('Error');
              				window.location='reguser.php';
              				</script>";
										}
         ?>
