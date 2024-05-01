<?php include('../commitee/includes/menuCom.php'); ?>


<!-- Main Content Section Starts -->

<div class="MainContent">
   <div class="wrapper">
      <h1>Manage Activities</h1>
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

       if(isset($_SESSION['update']))
       {
           //display the session message
           echo '<div class="session-message">' . $_SESSION['update'] . '</div>';   
           //remove session message
           unset($_SESSION['update']);
       }

       

      ?>
      
      <!--Button to add admin -->
      <div class="button-container">
            <!-- Button to add admin -->
            <a href="add-activity.php" class="btn-primary">Add activity</a>
        </div>

      <br>
      <br>

      <table class="tbl-full">
         <tr>
            <th>Activity ID</th>
            <th>Activity Name</th>
            <th>Activity Location</th>
            <th>Activity Date</th>
            <th>Activity Time</th>
            <th>Activity type</th>
            <th>Activity Actions</th>
         </tr>

         <?php
         //Displaying the admin from database into the table
         require_once ('../Database/database.php');// Connect to the db.
         global $dbc;

         // Make the query.
         $query = "SELECT ActivityID, ActivityName, ActivityLocation, 
         ActivityDate,ActivityTime,ActivityType
		   FROM activities ORDER BY ActivityID ASC";
         $result = @mysqli_query($dbc, $query); // Run the query.

         //to check if there is data inserted into the database
         $num = mysqli_num_rows($result);
         //if it is more then 0 then it proves we have data in the database
         if ($num > 0) {
            while($row=mysqli_fetch_assoc($result))
            {
               //using while loop to get all the data from database
               //while loop will run as long as we have data in the database

               //get data
               $ActivityID=$row['ActivityID'];
               $ActivityName=$row['ActivityName'];
               $ActivityLocation=$row['ActivityLocation'];
               $ActivityDate=$row['ActivityDate'];
               $ActivityTime=$row['ActivityTime'];
               $ActivityType=$row['ActivityType'];


               //display values into the table
               ?>
               <tr>
                  <td><?php echo $ActivityID;?></td>
                  <td><?php echo $ActivityName;?></td>
                  <td><?php echo $ActivityLocation;?></td>
                  <td><?php echo $ActivityDate;?></td>
                  <td><?php echo $ActivityTime;?></td>
                  <td><?php echo $ActivityType;?></td>

                  <td>

                     <a href="update-activity.php?ActivityID=<?php echo $ActivityID ?>" class="btn-sec">Update </a>
                     <a href="delete-activity.php?ActivityID=<?php echo $ActivityID ?>" class="btn-sec">Delete </a>
                  </td>
               </tr>

               <?php
               
            }

         //theres no data in database
         }
         else
         {
            echo"No data in the database";
         }
         ?>

      </table>
   </div>
</div>

<!--Main Content Section ends -->


<?php include('../commitee/includes/footerCom.php'); ?>