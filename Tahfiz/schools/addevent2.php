<?php

        include('../connection.php');
	session_start();

        $id = $_SESSION['schools_ID'];

        $upload_images = array();
        $upload_dir = "../images/";

        $eventtitle = $_POST['eventtitle'];
        $eventdescription = $_POST['eventdescription'];
        $eventvenue = $_POST['eventvenue'];
        $eventstartdate = $_POST['eventstartdate'];
        $eventenddate = $_POST['eventenddate'];
        $eventtime = $_POST['eventtime'];

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
                                    $insert = $connection->query("INSERT INTO event (eventtitle, eventdescription, eventvenue, eventstartdate, eventenddate, eventtime, image, schools_ID)"
                                    . "VALUES ('$eventtitle', '$eventdescription', '$eventvenue', '$eventstartdate', '$eventenddate', '$eventtime', '$filename', '$id')");
                                     echo "<script type='text/javascript'>alert('Events has been added.');
                                        window.location='index.php';
                                    </script>";


                                }

                     }
        }


?>
