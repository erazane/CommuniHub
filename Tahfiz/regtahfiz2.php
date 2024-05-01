<?php
include('connection.php');
	session_start();

			$upload_images = array();
			$upload_dir = "images/";
      $school_name = $_POST['school_name'];
      $street_name = $_POST['street_name'];
      $state = $_POST['state'];
      $postcode = $_POST['postcode'];
			$phonenum = $_POST['phonenum'];
      $register_no = $_POST['register_no'];
      $descriptions = $_POST['descriptions'];
			$category = $_POST['category'];
			$sector = $_POST['sector'];
			$monthlyfees = $_POST['monthlyfees'];
      $school_url = $_POST['school_url'];
      $email = $_POST['email'];
      $password = $_POST['password'];
			$bank_name = $_POST['bank_name'];
			$acc_name = $_POST['acc_name'];
			$acc_no = $_POST['acc_no'];

        $joinedDate = date("Y/m/d");
				foreach($_FILES['images_upload']['name'] as $key=>$val)
            {
                 $file_path = $upload_dir.$_FILES['images_upload']['name'][$key];
                 $filename = $_FILES['images_upload']['name'][$key];
								 $certfile = $_FILES['cert_upload']['name'][$key];
                 if(is_uploaded_file($_FILES['images_upload']['tmp_name'][$key]))
                     {
                        if(move_uploaded_file($_FILES['images_upload']['tmp_name'][$key],$file_path))
                                {
                                    $upload_images[] = $file_path;

                        $insert = $connection->query("INSERT INTO schools(school_name, street_name, state, postcode, phonenum, register_no, status, descriptions, category, sector, monthlyfees, date_joined, school_url, email, password, bank_name, acc_name, acc_no, file_name, certificate_school)"
                        . "VALUES ('$school_name', '$street_name', '$state', '$postcode', '$phonenum', '$register_no', 'Pending', '$descriptions', '$category', '$sector', '$monthlyfees', '$joinedDate', '$school_url', '$email', '$password', '$bank_name', '$acc_name', '$acc_no', '$filename', '$certfile')");

                         $last_inserted_row = mysqli_insert_id($connection);
                         $insert2 = $connection->query("INSERT INTO login(email, password, type, schools_ID, status)VALUES('$email', '$password', 'tahfiz', '$last_inserted_row', 'Pending')");


                    if ($insert && $insert2){
           						$_SESSION['success'] = '';
											echo "<script type='text/javascript'>alert('Thank you for being part of Tahfiz Care. We need 24 hours from now to verify your certificate before you can login.');
	                			window.location='logintahfiz.php';
	                				</script>";
       							}
       					else {
									echo "<script type='text/javascript'>alert('Error');
										window.location='regtahfiz.php';
										</script>";
										}
									}
								}
							}
         ?>
