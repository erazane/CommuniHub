<?php
        include('../connection.php');
	session_start();

        $id = $_SESSION['schools_ID'];

        $upload_images = array();
        $upload_dir = "../images/";

        $school_name = $_POST['school_name'];
        $street_name = $_POST['street_name'];
        $state = $_POST['state'];
        $postcode = $_POST['postcode'];
        $phonenum = $_POST['phonenum'];
        $register_no = $_POST['register_no'];
        $category = $_POST['category'];
        $monthlyfees = $_POST['monthlyfees'];
        $descriptions= $_POST['descriptions'];
        $date_joined = $_POST['date_joined'];
        $sector = $_POST['sector'];
        $school_url = $_POST['school_url'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $bank_name = $_POST['bank_name'];
  			$acc_name = $_POST['acc_name'];
  			$acc_no = $_POST['acc_no'];

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
                                    $insert = $connection->query("UPDATE schools SET school_name = '$school_name', street_name = '$street_name', state = '$state',
                                      postcode = '$postcode', phonenum = '$phonenum', register_no = '$register_no', category = '$category', monthlyfees = '$monthlyfees', descriptions = '$descriptions',
                                      date_joined = '$date_joined', sector = '$sector', school_url = '$school_url', email = '$email', password = '$password', file_name = '$filename', bank_name = '$bank_name', acc_name = '$acc_name', acc_no = '$acc_no', certificate_school = '$certfile' WHERE schools_ID = '$id'");
                                     echo "<script type='text/javascript'>alert('You have update your school profile.');
                                        window.location='editprofile.php';
                                    </script>";


                                }

                     }
                     else
                     {
                          $insert = $connection->query("UPDATE schools SET school_name = '$school_name', street_name = '$street_name', state = '$state',
                            postcode = '$postcode', phonenum = '$phonenum', register_no = '$register_no', category = '$category', monthlyfees = '$monthlyfees', descriptions = '$descriptions',
                            date_joined = '$date_joined', sector = '$sector', school_url = '$school_url', email = '$email', password = '$password', bank_name = '$bank_name', acc_name = '$acc_name', acc_no = '$acc_no', certificate_school = '$certfile' WHERE schools_ID = '$id'");
                          echo "<script type='text/javascript'>alert('You have update your school profile.');
                                        window.location='editprofile.php';
                                    </script>";
                     }
            }

?>
