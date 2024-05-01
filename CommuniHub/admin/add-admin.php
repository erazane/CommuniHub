<?php include('includes/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br>
        <br>



        <form action="#" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td><input type="text" name="NewAdminName" placeholder="Enter Full Name" size="20" maxlength="40" value="<?php if (isset($_POST['NewAdminName'])) echo $_POST['NewAdminName']; ?>"  /></td>
                </tr>
               
                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="AdminUsername" placeholder="Enter Username"  size="20" maxlength="40" value="<?php if (isset($_POST['AdminUsername'])) echo $_POST['AdminUsername']; ?>"  /></td>
                </tr>

                <tr>
                    <td>Password: </td>
                    <td><input type="password" name="AdminPassword" placeholder="Enter Password" size="20" maxlength="40" value="<?php if (isset($_POST['AdminPassword'])) echo $_POST['AdminPassword']; ?>"  /></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="Submit" value="Add Admin" class="btn-primary"/>
                        <a href="manage-admin.php" class="btn-primary">Manage Admin</a> 
                    </td>
                </tr>
            </table>
	        
        </form>
    </div>
</div>

<?php
//check form is submitted and save the value or not

//check if button is clicked or not
if (isset($_POST['Submit'])){
 
    require_once ('../Database/database.php');
    $errors = array();

    //Get data from the form
    if (empty($_POST['NewAdminName'])) {
		$errors[] = 'Must include full name.';
	} else {
		$NewAdminName = ($_POST['NewAdminName']);
	}
	
	// Check for a admin username.
	if (empty($_POST['AdminUsername'])) {
		$errors[] = 'Must include username';
	} else {
		$AdminUsername = ($_POST['AdminUsername']);
	}

    	// Check for an admin password.
	if (empty($_POST['AdminPassword'])) {
		$errors[] = 'Must include password.';
	} else {
        //password encryption with md5
		// $AdminPassword = md5($_POST['AdminPassword']);
        $AdminPassword = crypt($_POST['AdminPassword'], 'ahookdemok');
	} 

    // Display errors (if any)
    if (!empty($errors)) {
        echo '<div class="error">';
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
        echo '</div>';
    } else {
        // Process the form data if no errors
        //processing the data goes here wowowo

       $NewAdminName=$_POST['NewAdminName'];
       $AdminUsername=$_POST['AdminUsername'];
    //    $AdminPassword=$_POST['AdminPassword'];
        
       //SQL query to save data in database
      // Make the query.
      if (empty($errors)) { 

        // Check for previous registration.
        $query = "SELECT adminID FROM admin WHERE adminName='$NewAdminName'";
        $result = @mysqli_query ($dbc,$query); // Run the query.
        if (mysqli_num_rows($result) == 0) {

        $query = "INSERT INTO admin (adminName, adminUserName, adminPwd ) 
        VALUES ('$NewAdminName', '$AdminUsername', '$AdminPassword')";		
        $result = @mysqli_query ($dbc,$query);

        if ($result) { // If it ran OK. == IF TRUE
            
            // Print a message.
            echo '<h1 id="mainhead">Successful Registration</h1>
            <p>The Administrator is now added. </p><p><br /></p>';	
            
        } else { // If it did not run OK.
            echo '<h1 id="mainhead">System Error</h1>
            <p class="error">Administrator could not be registered due to a system error. We apologize for any inconvenience.</p>'; // Public message.
            echo '<p>' . mysqli_error($dbc)  . '<br /><br />Query: ' . $query . '</p>'; // Debugging message.

            exit();
        }// end if for run message

      }else { // Already registered.
        echo '<h1 id="mainhead">Error!</h1>
        <p class="error">This Administrator has already been added to the database.</p>';
    }//end else for register

    }else { // Report the errors.
	
		echo '<h1 id="mainhead">Error!</h1>
		<p class="error">The following error(s) occurred:<br />';
		foreach ($errors as $msg) { // Print each error.
			echo " - $msg<br />\n";
		}
		echo '</p><p>Please try again.</p><p><br /></p>';
		
	} // End of if (empty($errors)) IF.

	mysqli_close($dbc); // Close the database connection.
		
    } // End of the main Submit conditional.
        
    
}//end conditional for submitted button



?>

<?php include('includes/footer.php'); ?> 

