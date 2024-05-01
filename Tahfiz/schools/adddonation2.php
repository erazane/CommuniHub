<?php

        include('../connection.php');
	session_start();

        $id = $_SESSION['schools_ID'];

        $upload_images = array();
        $upload_dir = "../images/";

        $donationtitle = $_POST['donationtitle'];
        $donationdesc = $_POST['donationdesc'];
        $donationamount = $_POST['donationamount'];
        $donationstartdate = $_POST['donationstartdate'];
        $donationenddate = $_POST['donationenddate'];

        // $referenceno = rand();
        // $dateposted = date("Y/m/d");

        foreach($_FILES['images_upload']['name'] as $key=>$val)
            {
                 $file_path = $upload_dir.$_FILES['images_upload']['name'][$key];
                 $filename = $_FILES['images_upload']['name'][$key];
                 if(is_uploaded_file($_FILES['images_upload']['tmp_name'][$key]))
                     {
                        if(move_uploaded_file($_FILES['images_upload']['tmp_name'][$key],$file_path))
                                {
                                    $upload_images[] = $file_path;
                                    $insert = $connection->query("INSERT INTO donation (donationtitle, donationdesc, donationamount, donationstartdate, donationenddate, image, schools_ID)"
                                    . "VALUES ('$donationtitle', '$donationdesc', '$donationamount', '$donationstartdate', '$donationenddate', '$filename', '$id')");
                                     echo "<script type='text/javascript'>alert('Donation has been added.');
                                        window.location='index.php';
                                    </script>";


                                }

                     }
        }


?>
