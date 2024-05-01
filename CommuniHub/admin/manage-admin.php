<?php include('includes/menu.php'); ?>


<!-- Main Content Section Starts -->

<div class="MainContent">
   <div class="wrapper">
      <h1>Dashboard Admin</h1>
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

       if(isset($_SESSION['user-not-found']))
       {
           //display the session message
           echo '<div class="session-message">' . $_SESSION['user-not-found'] . '</div>';   
           //remove session message
           unset($_SESSION['user-not-found']);
       }

       if(isset($_SESSION['passwordNotMatched']))
       {
           //display the session message
           echo '<div class="session-message">' . $_SESSION['passwordNotMatched'] . '</div>';   
           //remove session message
           unset($_SESSION['passwordNotMatched']);
       }

       if(isset($_SESSION['ChangePassword']))
       {
           //display the session message
           echo '<div class="session-message">' . $_SESSION['ChangePassword'] . '</div>';   
           //remove session message
           unset($_SESSION['ChangePassword']);
       }

      ?>
      
      <!--Button to add admin -->
      <div class="button-container">
            <!-- Button to add admin -->
            <a href="add-admin.php" class="btn-primary">Add Admin</a>
        </div>

      <br>
      <br>

      <table class="tbl-full">
         <tr>
            <th>Admin ID</th>
            <th>Admin Name</th>
            <th>Admin Username</th>
            <th>Admin Actions</th>
         </tr>

         <?php
         //Displaying the admin from database into the table
         require_once ('../Database/database.php');// Connect to the db.
         global $dbc;

         // Make the query.
         $query = "SELECT adminID, adminName, adminUserName, adminPwd
		   FROM admin ORDER BY adminID ASC";
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
               $AdminID=$row['adminID'];
               $NewAdminName=$row['adminName'];
               $AdminUsername=$row['adminUserName'];
;

               //display values into the table
               ?>
               <tr>
                  <td><?php echo $AdminID;?></td>
                  <td><?php echo $NewAdminName;?></td>
                  <td><?php echo $AdminUsername;?></td>

                  <td>
                     <a href="update-passwordAdmin.php?adminID=<?php echo $AdminID ?>" class="btn-primary">Change Password</a>
                     <a href="update-admin.php?adminID=<?php echo $AdminID ?>" class="btn-sec">Update Admin</a>
                     <a href="delete-admin.php?adminID=<?php echo $AdminID ?>" class="btn-sec">Delete Admin</a>
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