    <?php include('../commitee/includes/menuCom.php'); ?>
    <?php
    // Initialize variables
    $DonationDesc ='';
    $DonationName = '';
    $DonationTarget = '';
    $DonationStartDate	 = '';
    $DonationEndDate= '';
    $DonationStatus= '';
    $image='';
    $errors = [];   

    // Check if form is submitted
    if (isset($_POST['Submit'])) {
        require_once('../Database/database.php');

        // Validate and assign Garbage Day
        if (!empty($_POST['DonationDesc'])) {
            $DonationDesc = $_POST['DonationDesc'];
        } else {
            $errors[] = 'Must select a day.';
        }
        // Validate and assign Garbage Day
        if (!empty($_POST['DonationName'])) {
            $DonationName = $_POST['DonationName'];
        } else {
            $errors[] = 'Must select a day.';
        }
        // Validate and assign Garbage Pickup Hour
        if (!empty($_POST['DonationTarget'])) {
            $DonationTarget = $_POST['DonationTarget'];
        } else {
            $errors[] = 'Must select an hour.';
        }

        // Validate and assign Garbage Pickup Minute
        if (!empty($_POST['DonationStartDate'])) {
            $DonationStartDate	 = $_POST['DonationStartDate'];
        } else {
            $errors[] = 'Must select a minute a.';
        }
        
        // Validate and assign Garbage Pickup Minute
        if (!empty($_POST['DonationEndDate'])) {
            $DonationEndDate	 = $_POST['DonationEndDate'];
        } else {
            $errors[] = 'Must select a minute b.';
        }
        
        // Validate and assign Garbage Pickup Minute
        if (!empty($_POST['DonationStatus'])) {
            $DonationStatus	 = $_POST['DonationStatus'];
        } else {
            $errors[] = 'Must select a minute d.';
        }

        // Image upload handling
        if ($_FILES["image"]["error"] == 4  ) {
            echo "<script>alert('Image does not exist');</script>";
        } else {
            $filename = $_FILES["image"]["name"];
            $filesize = $_FILES["image"]["size"];
            $tmpName = $_FILES["image"]["tmp_name"];

            $validImageExtension = ['jpg', 'jpeg', 'png'];
            $imageExtension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

            if (!in_array($imageExtension, $validImageExtension)) {
                echo "<script>alert('Invalid Image Extension');</script>";
            } 
            
            if ($filesize > 1000000) {
                echo "<script>alert('Image Size Too large');</script>";
            } 

            $newImageName = uniqid() . '.' . $imageExtension;
            
            move_uploaded_file($tmpName, '../commitee/images/' . $newImageName);
        }

        if (empty($errors)) {
            $query = "INSERT INTO donation (DonationName,DonationDesc, DonationTarget, DonationStartDate, DonationEndDate, DonationStatus, image) 
                    VALUES ('$DonationName', '$DonationDesc', '$DonationTarget', '$DonationStartDate', '$DonationEndDate', '$DonationStatus', '$newImageName')";
            $result = mysqli_query($dbc, $query);
        
            if ($result) {
                echo '<h1>Successful Registration</h1><p>Donation has been created.</p>';
            } else {
                echo "<h1>System Error</h1><p class='error'>Donation could not be registered due to a system error. We apologize for any inconvenience.</p>";
                // Debugging
                echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $query . '</p>';
            }
        } else {
            foreach ($errors as $error) {
                echo "<p class='error'>$error</p>";
            }
        }
        
        mysqli_close($dbc);
    }


    ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Add Donation</h1>
            <br>
            <br>
            <form action="#" method="POST" enctype="multipart/form-data">
    
                <table class="tbl-30">
                    <tr>
                        <td> Title: </td>
                        <td><input type="text" name="DonationName" placeholder=" Title" size="20" maxlength="40" value="<?php if (isset($_POST['DonationName'])) echo $_POST['DonationName']; ?>"  /></td>
                    </tr>
                    <tr>
                        <td> Description: </td>
                        <td><input type="text" name="DonationDesc" placeholder=" Title" size="100" maxlength="100" value="<?php if (isset($_POST['DonationDesc'])) echo $_POST['DonationDesc']; ?>"  /></td>
                    </tr>
                    <tr>
                        <td>Target: </td>
                        <td><input type="text" name="DonationTarget" placeholder="Total Target"  size="20" maxlength="40" value="<?php if (isset($_POST['DonationTarget'])) echo $_POST['DonationTarget']; ?>"  /></td>
                    </tr>

                    <tr>
                        <td>Start Date: </td>
                        <td><input type="date" name="DonationStartDate" placeholder="Enter Date" size="20" maxlength="40" value="<?php if (isset($_POST['DonationStartDate'])) echo $_POST['DonationStartDate']; ?>"  /></td>
                    </tr>
                    <tr>
                        <td>End Date: </td>
                        <td><input type="date" name="DonationEndDate" placeholder="Enter Date" size="20" maxlength="40" value="<?php if (isset($_POST['DonationEndDate'])) echo $_POST['DonationEndDate']; ?>"  /></td>
                    </tr>
                    <tr>
                    <td>Status: </td>
                    <td>
                        <select name="DonationStatus" >
                            <option value="" disabled selected>Select Status</option>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Image :</td>
                    <td>
                        <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png" value="">
                    </td>
                </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="Submit" value="Add Activity" class="btn-primary"/>
                            <a href="manage-donations.php" class="btn-primary">Manage Activities</a> 
                        </td>
                    </tr>
                </table>
                
            </form>
        </div>
    </div>   
        

        
            

    <?php include('../commitee/includes/footerCom.php'); ?> 

