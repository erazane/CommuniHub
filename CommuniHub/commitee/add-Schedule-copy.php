<?php include('../commitee/includes/menuCom.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Schedule</h1>
        <br>
        <br>



        <form action="#" method="post">
            <table class="tbl-30">
            <h2>Garbage </h2>
      
        <tr>
            <td>Pick Up Day: </td>
            <td>
                <select name="GarbageDay" >
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
                <select name="GarbagePickUpHour">
                    <option value="" disabled selected>Select Hour</option>
                    <?php for ($hour = 0; $hour < 24; $hour++) : ?>
                        <option value="<?php echo str_pad($hour, 2, '0', STR_PAD_LEFT); ?>">
                            <?php echo str_pad($hour, 2, '0', STR_PAD_LEFT); ?>
                        </option>
                    <?php endfor; ?>
                </select>

                <select name="GarbagePickupMinute">
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
                    <input type="submit" name="SubmitSchedule" value="Submit Schedule" class="btn-primary"/>
                        <a href="manage-schedule.php" class="btn-primary">Manage Schedule</a> 
                    </td>
                </tr>
    </table>
                 
</form>


<!-- to check if submitted -->
<?php
if (isset($_POST['SubmitGarbage'])) {
    require_once('../Database/database.php');

    if (empty($_POST['GarbageDay'])) {
        $errors[] = 'Must select a day.';
    } else {
        $GarbageDay = $_POST['GarbageDay'];
    }

    if (empty($_POST['GarbagePickUpHour'])) {
        $errors[] = 'Must select an hour';
    } else {
        $GarbagePickUpHour = $_POST['GarbagePickUpHour'];
    }

    if (empty($_POST['GarbagePickupMinute'])) { // Correct the field name here
        $errors[] = 'Must select a minute';
    } else {
        $GarbagePickupMinute = $_POST['GarbagePickupMinute'];
    }
}



// Display errors (if any)
 // Display errors (if any)
 // ... [earlier code]

if (empty($errors)) { 
    $query = "INSERT INTO schedule (GarbageDay, GarbagePickUpHour, GarbagePickupMinute) 
    VALUES ('$GarbageDay', '$GarbagePickUpHour', '$GarbagePickupMinute')";        
    $result = @mysqli_query($dbc, $query);

    if ($result) {
        // If the query was successful
        echo '<h1 id="mainhead">Successful Registration</h1>
        <p>Schedule has been created. </p><p><br /></p>'; 
    } else {
        // If the query failed
        echo '<h1 id="mainhead">System Error</h1>
        <p class="error">Schedule could not be registered due to a system error. We apologize for any inconvenience.</p>';
        echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $query . '</p>';
        exit();
    }
} else {
    // Report the errors.
    echo '<h1 id="mainhead">Error!</h1>
    <p class="error">The following error(s) occurred:<br />';
    foreach ($errors as $msg) {
        echo " - $msg<br />\n";
    }
    echo '</p><p>Please try again.</p><p><br /></p>';
}

mysqli_close($dbc); // Close the database connection.



?>

<?php include('../commitee/includes/footerCom.php'); ?> 


