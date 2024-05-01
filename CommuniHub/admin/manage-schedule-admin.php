<?php include('includes/menu.php'); ?>


<!-- Main Content Section Starts -->

<div class="MainContent">

   <div class="wrapper">
   <h1>Manage Schedule</h1>
     <br>
     <br>
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
     <h2> Garbage Schedule</h2>

      <br>
      <table class="tbl-full">
         <tr>
            <th>ID</th>
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
         ORDER BY ScheduleID ASC
         ";
        $result = @mysqli_query($dbc, $query);

        if (!$result) {
            die('Query failed: ' . mysqli_error($dbc));
        }

         //to check if there is data inserted into the database
         $num = mysqli_num_rows($result);
         if ($num > 0) {
             // Loop through each row in the result set
             while ($row = mysqli_fetch_assoc($result)) {
                 // Fetching data from the database row
                 $ScheduleID = $row['ScheduleID'];
                 $GarbageDay = $row['GarbageDay'];
                 $GarbagePickUpHour = $row['GarbagePickUpHour'];
                 $GarbagePickupMinute = $row['GarbagePickupMinute'];
         
                 // Formatting the time for display
                 $formattedTime = sprintf("%02d:%02d", $GarbagePickUpHour, $GarbagePickupMinute);
         
                 // Display values in the table
                 ?>
                 <tr>
                     <td><?php echo htmlspecialchars($ScheduleID); ?></td>
                     <td><?php echo htmlspecialchars($GarbageDay); ?></td>
                     <td><?php echo htmlspecialchars($formattedTime); ?></td>
                     <td>
                         <!-- <a href="../commitee/delete-schedule.php?ScheduleID=<?php echo $ScheduleID ?>" class="btn-sec">Delete Schedule</a> -->
                         <a href="delete-schedule-admin.php?ScheduleID=<?php echo $ScheduleID ?>" class="btn-sec">Delete Schedule</a>
                     </td>
                 </tr>

                 <?php
             }
         } else {
             echo '<tr><td colspan="4">No schedule data found.</td></tr>';
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
            <th>ID</th>
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
          FROM glassschedule
          ORDER BY glassScheduleID ASC";
         
        $result = @mysqli_query($dbc, $query);

        if (!$result) {
            die('Query failed: ' . mysqli_error($dbc));
        }

         //to check if there is data inserted into the database
         $num = mysqli_num_rows($result);
         if ($num > 0) {
             // Loop through each row in the result set
             while ($row = mysqli_fetch_assoc($result)) {
                 // Fetching data from the database row
                 $glassScheduleID = $row['glassScheduleID'];
                 $GlassPickupday = $row['GlassPickupday'];
                 $GlassPickupHour = $row['GlassPickupHour'];
                 $GlassPickupMinute = $row['GlassPickupMinute'];
         
                 // Formatting the time for display
                 $formattedTime = sprintf("%02d:%02d", $GlassPickupHour, $GlassPickupMinute);
         
                 // Display values in the table
                 ?>
                 <tr>
                     <td><?php echo htmlspecialchars($glassScheduleID); ?></td>
                     <td><?php echo htmlspecialchars($GlassPickupday); ?></td>
                     <td><?php echo htmlspecialchars($formattedTime); ?></td>
                     <td>
                         <a href="delete-glass-admin.php?glassScheduleID=<?php echo $glassScheduleID ?>" class="btn-sec">Delete Schedule</a>
                     </td>
                 </tr>
                 <?php
             }
         } else {
             echo '<tr><td colspan="4">No schedule data found.</td></tr>';
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
            <th>ID</th>
            <th>Paper Pick Up Day</th>
            <th>Paper Pick Up Time</th>
            <th> Actions</th>
         </tr>

         <?php
         //Displaying the admin from database into the table
         require_once ('../Database/database.php');// Connect to the db.
         global $dbc;

         // Make the query.
         $query = "SELECT paperScheduleID, PaperPickupDay, PaperPickupHour, PaperPickupMinute
          FROM paperschedule
          ORDER BY paperScheduleID ASC";
         
        $result = @mysqli_query($dbc, $query);

        if (!$result) {
            die('Query failed: ' . mysqli_error($dbc));
        }

         //to check if there is data inserted into the database
         $num = mysqli_num_rows($result);
         if ($num > 0) {
             // Loop through each row in the result set
             while ($row = mysqli_fetch_assoc($result)) {
                 // Fetching data from the database row
                 $paperScheduleID = $row['paperScheduleID'];
                 $PaperPickupDay = $row['PaperPickupDay'];
                 $PaperPickupHour = $row['PaperPickupHour'];
                 $PaperPickupMinute = $row['PaperPickupMinute'];
         
                 // Formatting the time for display
                 $formattedTime = sprintf("%02d:%02d", $PaperPickupHour, $PaperPickupMinute);
         
                 // Display values in the table
                 ?>
                 <tr>
                     <td><?php echo htmlspecialchars($paperScheduleID); ?></td>
                     <td><?php echo htmlspecialchars($PaperPickupDay); ?></td>
                     <td><?php echo htmlspecialchars($formattedTime); ?></td>
                     <td>
                         <a href="delete-paper-admin.php?paperScheduleID=<?php echo $paperScheduleID ?>" class="btn-sec">Delete Schedule</a>
                     </td>
                 </tr>
                 <?php
             }
         } else {
             echo '<tr><td colspan="4">No schedule data found.</td></tr>';
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
            <th>ID</th>
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
          FROM plasticschedule
          ORDER BY plasticScheduleID ASC";
         
        $result = @mysqli_query($dbc, $query);

        if (!$result) {
            die('Query failed: ' . mysqli_error($dbc));
        }

         //to check if there is data inserted into the database
         $num = mysqli_num_rows($result);
         if ($num > 0) {
             // Loop through each row in the result set
             while ($row = mysqli_fetch_assoc($result)) {
                 // Fetching data from the database row
                 $plasticScheduleID = $row['plasticScheduleID'];
                 $PlasticPickupDay = $row['PlasticPickupDay'];
                 $PlasticPickupHour = $row['PlasticPickupHour'];
                 $PlasticPickupMinute = $row['PlasticPickupMinute'];
         
                 // Formatting the time for display
                 $formattedTime = sprintf("%02d:%02d", $PlasticPickupHour, $PlasticPickupMinute);
         
                 // Display values in the table
                 ?>
                 <tr>
                     <td><?php echo htmlspecialchars($plasticScheduleID); ?></td>
                     <td><?php echo htmlspecialchars($PlasticPickupDay); ?></td>
                     <td><?php echo htmlspecialchars($formattedTime); ?></td>
                     <td>
                         <a href="delete-plastic-admin.php?plasticScheduleID=<?php echo $plasticScheduleID ?>" class="btn-sec">Delete Schedule</a>
                     </td>
                 </tr>
                 <?php
             }
         } else {
             echo '<tr><td colspan="4">No schedule data found.</td></tr>';
         }
         ?>
    </table>
   </div>
   <!-- end of plastic -->
</div>
</div>
<!--Main Content Section ends -->

<?php include('includes/footer.php'); ?>   