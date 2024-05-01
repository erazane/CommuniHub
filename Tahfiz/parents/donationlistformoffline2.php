<?php
        include('../connection.php');
	session_start();

        $parents_ID = $_SESSION['parents_ID'];

        $upload_images = array();
        $upload_dir = "../images/";

        $don_amount = $_POST['don_amount'];

        $schools_ID = $_POST['schools_ID'];

        $donation_ID = $_POST['donation_ID'];

        $donationDate = date("Y/m/d");

        $randomno = rand();
        foreach($_FILES['images_upload']['name'] as $key=>$val)
            {
                 $file_path = $upload_dir.$_FILES['images_upload']['name'][$key];
                 $filename = $_FILES['images_upload']['name'][$key];
                 if(is_uploaded_file($_FILES['images_upload']['tmp_name'][$key]))
                     {
                        if(move_uploaded_file($_FILES['images_upload']['tmp_name'][$key],$file_path))
                                {
                                    $upload_images[] = $file_path;
                                    $insert = $connection->query("INSERT INTO donationpaymentoffline(don_amount, schools_ID, parents_ID, donation_ID, donoff_date, receiptno, donoff_receipt)"
                                    . "VALUES ('$don_amount', '$schools_ID', '$parents_ID', '$donation_ID','$donationDate', '$randomno', '$filename')");

                                    if($insert){
                                      $_SESSION['success'] = '';
                                      echo "<script type='text/javascript'>alert('Donation has been added, the system will review the receipt.');
                                         window.location='index.php';
                                     </script>";
                                    }
                                    else {
                                      echo "<script type='text/javascript'>alert('Please enter the correct input for donation amount.');"
                                      . "window.location='donationlistform.php?schools_ID=". $schools_ID . " &donation_ID=". $donation_ID ." ';"
                                      . "</script>";
                                    }
                                  }
                                }
                              }




?>
