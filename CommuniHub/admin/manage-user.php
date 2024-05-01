<?php include('includes/menu.php'); ?>


<!-- Main Content Section Starts -->

<div class="MainContent">
   <div class="wrapper">
      <h1>Manage Users</h1>
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
      
      <!--Button to add admin -->
      <div class="button-container">
            <!-- Button to add admin -->
            <a href="add-user.php" class="btn-primary">Add User</a>
        </div>

      <br>
      <br>

      <table class="tbl-full">
         <tr>
            <th>User ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Username</th>
            <th>Age</th>
            <th>Martial Status</th>
            <th>Occupation</th>
            <th>Contact</th>
            <th>Type</th>
            <th>Admin Actions</th>
         </tr>

         <?php
         //Displaying the admin from database into the table
         require_once ('../Database/database.php');// Connect to the db.
         global $dbc;

         // Make the query.
         $query = "SELECT user.UserID as UserID, UserFirstName, UserLastName,UserUserName, UserAge,UserMartialStatus,UserOccupation,UserContactDetails,CommiteeID 
         FROM user LEFT JOIN commitee ON user.UserID = commitee.UserID ORDER BY UserID ASC";
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
               $UserID=$row['UserID'];
               $UserFirstName=$row['UserFirstName'];
               $UserLastName=$row['UserLastName'];
               $UserUserName=$row['UserUserName'];
               $UserAge=$row['UserAge'];
               $UserMartialStatus=$row['UserMartialStatus'];
               $UserOccupation=$row['UserOccupation'];
               $UserContactDetails=$row['UserContactDetails'];
               $UserType=$row['CommiteeID'];


               //display values into the table
               ?>
               <tr>
                  <td><?php echo $UserID;?></td>
                  <td><?php echo $UserFirstName;?></td>
                  <td><?php echo $UserLastName;?></td>
                  <td><?php echo $UserUserName;?></td>
                  <td><?php echo $UserAge;?></td>
                  <td><?php echo $UserMartialStatus;?></td>
                  <td><?php echo $UserOccupation;?></td>
                  <td><?php echo $UserContactDetails;?></td>
                  <td><?php echo ($UserType) ? "Committee" : "Resident" ?></td>

                  <td>
                     <a href="update-passwordUser.php?UserID=<?php echo $UserID ?>" class="btn-primary">Change Password</a><br>
                     <a href="update-user.php?UserID=<?php echo $UserID ?>" class="btn-sec">Update User</a><br><br>
                     <a href="delete-user.php?UserID=<?php echo $UserID ?>" class="btn-sec">Delete User</a><br>
                     <a href="assign-committee.php?UserID=<?php echo $UserID ?>" class="btn-sec" <?php if($UserType) echo 'hidden'; ?> >Assign Comittee</a>
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