<?php include('../commitee/includes/menuCom.php'); ?>


<!-- Main Content Section Starts -->

<div class="MainContent">
<?php
          session_start();
          if(isset($_SESSION['delete']))
          {
              //display the session message
              echo '<div class="session-message">' . $_SESSION['delete'] . '</div>';   
              //remove session message
              unset($_SESSION['delete']);
          }
          
         ?>
   <div class="wrapper">
   <h1>Manage Schedule</h1>
     <br>
     <br>
     <h2> Garbage Schedule</h2>

      <br>
      <table class="tbl-full">
         <tr>
            <th>Garbage Pick Up Day</th>
            <th>Garbage Pick Up Time</th>
            <th> Actions</th>
         </tr>

         <?php
         //Displaying the admin from database into the table
         require_once ('../Database/database.php');// Connect to the db.
         global $dbc;

         // Make the query.
         $query = "SELECT ScheduleID, GarbageDay, GarbagePickUpHour, GarbagePickupMinute	
         FROM schedule
         ORDER BY ScheduleID DESC
         LIMIT 1";
        $result = @mysqli_query($dbc, $query);

        if (!$result) {
            die('Query failed: ' . mysqli_error($dbc));
        }

         //to check if there is data inserted into the database
         $num = mysqli_num_rows($result);
         //if it is more then 0 then it proves we have data in the database
         if ($num > 0) {
            $row = mysqli_fetch_assoc($result);

            // Fetching data from the database row
            $ScheduleID = $row['ScheduleID'];
            $GarbageDay = $row['GarbageDay'];
            $GarbagePickUpHour = $row['GarbagePickUpHour'];
            $GarbagePickupMinute = $row['GarbagePickupMinute'];
    
                // Formatting the time for display
                $formattedTime = sprintf("%02d:%02d", $GarbagePickUpHour, $GarbagePickupMinute	);
    
                // Display values in the table
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($GarbageDay); ?></td>
                    <td><?php echo htmlspecialchars($formattedTime); ?></td>
                    <td>
                        <a href="add-Schedule.php" class="btn-primary">Add Schedule</a>
                        <a href="delete-schedule.php?ScheduleID=<?php echo $ScheduleID ?>" class="btn-sec">Delete Schedule</a>
                    </td>
                </tr>
                <?php
            }
        else {
            echo '<tr><td colspan="3">No schedule data found.</td></tr>';
        }
        ?>
    </table>
   </div>
   <!-- start of glass -->
   <div class="wrapper">
     <br>
     <h2> Glass Schedule</h2>

      <br>
      <table class="tbl-full">
         <tr>
            <th>Glass Pick Up Day</th>
            <th>Glass Pick Up Time</th>
            <th> Actions</th>
         </tr>

         <?php
         //Displaying the admin from database into the table
         require_once ('../Database/database.php');// Connect to the db.
         global $dbc;

         // Make the query.
         $query = "SELECT glassScheduleID, GlassPickupday, GlassPickupHour, GlassPickupMinute	
         FROM glassSchedule
         ORDER BY glassScheduleID DESC
         LIMIT 1";
        $result = @mysqli_query($dbc, $query);

        if (!$result) {
            die('Query failed: ' . mysqli_error($dbc));
        }

         //to check if there is data inserted into the database
         $num = mysqli_num_rows($result);
         //if it is more then 0 then it proves we have data in the database
         if ($num > 0) {
            $row = mysqli_fetch_assoc($result);

            // Fetching data from the database row
            $glassScheduleID = $row['glassScheduleID'];
            $GlassPickupday = $row['GlassPickupday'];
            $GlassPickupHour = $row['GlassPickupHour'];
            $GlassPickupMinute = $row['GlassPickupMinute'];
    
                // Formatting the time for display
                $formattedTime = sprintf("%02d:%02d", $GlassPickupHour, $GlassPickupMinute	);
    
                // Display values in the table
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($GlassPickupday); ?></td>
                    <td><?php echo htmlspecialchars($formattedTime); ?></td>
                    <td>
                        <a href="add-schedule-glass.php" class="btn-primary">Add Schedule</a>
                        <a href="delete-schedule-glass.php?glassScheduleID=<?php echo $glassScheduleID ?>" class="btn-sec">Delete Schedule</a>
                    </td>
                </tr>
                <?php
            }
        else {
            echo '<tr><td colspan="3">No schedule data found.</td></tr>';
        }
        ?>
    </table>
   </div>

<!-- end of glass -->
<!-- start of paper -->
<div class="wrapper">
     <br>
     
     <h2> Paper Schedule</h2>
      <br>
      <table class="tbl-full">
         <tr>
            <th>Paper Pick Up Day</th>
            <th>Paper Pick Up Time</th>
            <th> Actions</th>
         </tr>

         <?php
         //Displaying the admin from database into the table
         require_once ('../Database/database.php');// Connect to the db.
         global $dbc;

         // Make the query.
         $query = "SELECT paperScheduleID, PaperPickupDay, 	PaperPickupHour, PaperPickupMinute	
         FROM paperSchedule
         ORDER BY paperScheduleID DESC
         LIMIT 1";
        $result = @mysqli_query($dbc, $query);

        if (!$result) {
            die('Query failed: ' . mysqli_error($dbc));
        }

         //to check if there is data inserted into the database
         $num = mysqli_num_rows($result);
         //if it is more then 0 then it proves we have data in the database
         if ($num > 0) {
            $row = mysqli_fetch_assoc($result);

            // Fetching data from the database row
            $paperScheduleID = $row['paperScheduleID'];
            $PaperPickupDay = $row['PaperPickupDay'];
            $PaperPickupHour = $row['PaperPickupHour'];
            $PaperPickupMinute = $row['PaperPickupMinute'];
    
                // Formatting the time for display
                $formattedTime = sprintf("%02d:%02d", $PaperPickupHour, $PaperPickupMinute	);
    
                // Display values in the table
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($PaperPickupDay); ?></td>
                    <td><?php echo htmlspecialchars($formattedTime); ?></td>
                    <td>
                        <a href="add-schedule-paper.php" class="btn-primary">Add Schedule</a>
                        <a href="delete-schedule-paper.php?paperScheduleID=<?php echo $paperScheduleID ?>" class="btn-sec">Delete Schedule</a>
                    </td>
                </tr>
                <?php
            }
        else {
            echo '<tr><td colspan="3">No schedule data found.</td></tr>';
        }
        ?>
    </table>
   </div>
   <!-- end of paper -->
   <!-- start of plastic -->
   <div class="wrapper">
     <br>
     
     <h2> Plastic Schedule</h2>
      <br>
      <table class="tbl-full">
         <tr>
            <th>Plastic Pick Up Day</th>
            <th>Plastic Pick Up Time</th>
            <th> Actions</th>
         </tr>

         <?php
         //Displaying the admin from database into the table
         require_once ('../Database/database.php');// Connect to the db.
         global $dbc;

         // Make the query.
         $query = "SELECT plasticScheduleID, PlasticPickupDay, PlasticPickupHour, PlasticPickupMinute	
          FROM plasticSchedule
          ORDER BY plasticScheduleID DESC
          LIMIT 1";
          $result = @mysqli_query($dbc, $query);

        if (!$result) {
            die('Query failed: ' . mysqli_error($dbc));
        }

         //to check if there is data inserted into the database
         $num = mysqli_num_rows($result);
         //if it is more then 0 then it proves we have data in the database
         if ($num > 0) {
            $row = mysqli_fetch_assoc($result);

            // Fetching data from the database row
            $plasticScheduleID = $row['plasticScheduleID'];
            $PlasticPickupDay = $row['PlasticPickupDay'];
            $PlasticPickupHour = $row['PlasticPickupHour'];
            $PlasticPickupMinute = $row['PlasticPickupMinute'];
    
                // Formatting the time for display
                $formattedTime = sprintf("%02d:%02d", $PlasticPickupHour, $PlasticPickupMinute	);
    
                // Display values in the table
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($PlasticPickupDay); ?></td>
                    <td><?php echo htmlspecialchars($formattedTime); ?></td>
                    <td>
                        <a href="add-schedule-plastic.php" class="btn-primary">Add Schedule</a>
                        <a href="delete-schedule-plastic.php?plasticScheduleID=<?php echo $plasticScheduleID ?>" class="btn-sec">Delete Schedule</a>
                    </td>
                </tr>
                <?php
            }
        else {
            echo '<tr><td colspan="3">No schedule data found.</td></tr>';
        }
        ?>
    </table>
   </div>
   <!-- end of plastic -->
</div>
</div>
<!--Main Content Section ends -->

<?php include('../commitee/includes/footerCom.php'); ?>