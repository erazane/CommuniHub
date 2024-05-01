<?php include('../admin/includes/menu.php'); ?>


<!-- Main Content Section Starts -->

<div class="MainContent">
   <div class="wrapper">
      <h1>Commitee</h1>
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

       if(isset($_SESSION['updateUser']))
       {
           //display the session message
           echo '<div class="session-message">' . $_SESSION['updateUser'] . '</div>';   
           //remove session message
           unset($_SESSION['updateUser']);
       }

       if(isset($_SESSION['user-not-found']))
       {
           //display the session message
           echo '<div class="session-message">' . $_SESSION['user-not-found'] . '</div>';   
           //remove session message
           unset($_SESSION['user-not-found']);
       }

       if(isset($_SESSION['UserpasswordNotMatched']))
       {
           //display the session message
           echo '<div class="session-message">' . $_SESSION['UserpasswordNotMatched'] . '</div>';   
           //remove session message
           unset($_SESSION['UserpasswordNotMatched']);
       }

       if(isset($_SESSION['ChangeUserPassword']))
       {
           //display the session message
           echo '<div class="session-message">' . $_SESSION['ChangeUserPassword'] . '</div>';   
           //remove session message
           unset($_SESSION['ChangeUserPassword']);
       }

      ?>

      <br>
      <br>

      <table class="tbl-full">
         <tr>
             <th>User ID</th>
            <th>Committee ID</th>
            <th>Position</th>
            <!-- <th>Activity History</th> -->
            <th>Start Date</th>
            <th>End Date</th>
            <!-- <th>User Type</th> -->
            <th>Admin Actions</th>
         </tr>

         <?php
         //Displaying the admin from database into the table
         require_once ('../Database/database.php');// Connect to the db.
         global $dbc;

         // Make the query.
         $query = "SELECT c.UserID,c.CommiteeID, c.CommiteePost, c.CommStartDate, c.CommEndDate
          FROM commitee c
          INNER JOIN user u ON c.UserID = u.UserID
          ORDER BY c.CommiteeID ASC";

         $result = mysqli_query($dbc, $query); // Run the query.

         //to check if there is data inserted into the database
         $num = mysqli_num_rows($result);
         //if it is more then 0 then it proves we have data in the database
         if ($num > 0) {
            while($row=mysqli_fetch_assoc($result))
            {
               //using while loop to get all the data from database
               //while loop will run as long as we have data in the database

               //get data
               $UserID=$row['UserID'];
               $CommiteeID=$row['CommiteeID'];
               // $ActivityHistory=$row['ActivityHistory'];
               $CommStartDate=$row['CommStartDate'];
               $CommEndDate=$row['CommEndDate'];
               $CommiteePost=$row['CommiteePost'];


               //display values into the table
               ?>
               <tr>  
                  <td><?php echo $UserID;?></td>
                  <td><?php echo $CommiteeID;?></td>
                  <td><?php echo $CommiteePost;?></td> 
                  <!-- <td><?php echo $ActivityHistory;?></td> -->
                  <td><?php echo $CommStartDate;?></td>
                  <td><?php echo $CommEndDate;?></td>

                  <td>
                     <a href="delete-committee.php?CommiteeID=<?php echo $CommiteeID ?>" class="btn-sec">Delete Committee</a>
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

<?php include('includes/footer.php'); ?> 