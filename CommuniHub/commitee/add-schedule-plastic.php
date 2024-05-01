<?php include('../commitee/includes/menuCom.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Schedule</h1>
        <br>
        <br>



        <form action="#" method="post">
            <table class="tbl-30">
            <h2>Plastic </h2>
      
        <tr>
            <td>Pick Up Day: </td>
            <td>
                <select name="PlasticPickupDay" >
                    <option value="" disabled selected>Select Status</option>
                    <option value="Monday">Monday</option>
                    <option value="Tuesday">Tuesday</option>
                    <option value="Wednesday">Wednesday</option>
                    <option value="Thursday">Thursday</option>
                    <option value="Friday">Friday</option>
                    <option value="Saturday">Saturday</option>
                    <option value="Sunday">Sunday</option>
                    <!-- will add more later -->
                </select>
            </td>
        </tr>
        <tr>
            <td>Pick Up Time:</td>
            <td>
                <select name="PlasticPickupHour">
                    <option value="" disabled selected>Select Hour</option>
                    <?php for ($hour = 0; $hour < 24; $hour++) : ?>
                        <option value="<?php echo str_pad($hour, 2, '0', STR_PAD_LEFT); ?>">
                            <?php echo str_pad($hour, 2, '0', STR_PAD_LEFT); ?>
                        </option>
                    <?php endfor; ?>
                </select>

                <select name="PlasticPickupMinute">
                    <option value="" disabled selected>Select Minutes</option>
                    <?php for ($minute = 0; $minute < 60; $minute += 5) : ?>
                        <option value="<?php echo str_pad($minute, 2, '0', STR_PAD_LEFT); ?>">
                            <?php echo str_pad($minute, 2, '0', STR_PAD_LEFT); ?>
                        </option>
                    <?php endfor; ?>
                </select>
            </td>
        </tr>
        <tr>
                    <td colspan="2">
                    <input type="submit" name="SubmitPaperSchedule" value="Submit Schedule" class="btn-primary"/>
                        <a href="manage-schedule.php" class="btn-primary">Manage Schedule</a> 
                    </td>
                </tr>
    </table>
                 

       
           
<?php
// Initialize variables
$PlasticPickupDay = '';
$PlasticPickupHour = '';
$PlasticPickupMinute	 = '';
$errors = [];

// Check if form is submitted
if (isset($_POST['SubmitPaperSchedule'])) {
    require_once('../Database/database.php');

    // Validate and assign Garbage Day
    if (!empty($_POST['PlasticPickupDay'])) {
        $PlasticPickupDay = $_POST['PlasticPickupDay'];
    } else {
        $errors[] = 'Must select a day.';
    }

    // Validate and assign Garbage Pickup Hour
    if (!empty($_POST['PlasticPickupHour'])) {
        $PlasticPickupHour = $_POST['PlasticPickupHour'];
    } else {
        $errors[] = 'Must select an hour.';
    }

    // Validate and assign Garbage Pickup Minute
    if (!empty($_POST['PlasticPickupMinute'])) {
        $PlasticPickupMinute	 = $_POST['PlasticPickupMinute'];
    } else {
        $errors[] = 'Must select a minute.';
    }

    // Insert into database if no errors
    if (empty($errors)) {
        $query = "INSERT INTO plasticSchedule (PlasticPickupDay, PlasticPickupHour, PlasticPickupMinute	) 
                  VALUES ('$PlasticPickupDay', '$PlasticPickupHour', '$PlasticPickupMinute	')";
        $result = @mysqli_query($dbc, $query);

        if ($result) {
            echo '<h1>Successful Registration</h1><p>Schedule has been created.</p>';
        } else {
            echo "<h1>System Error</h1><p class='error'>Schedule could not be registered due to a system error. We apologize for any inconvenience.</p>";
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

<?php include('../commitee/includes/footerCom.php'); ?> 

