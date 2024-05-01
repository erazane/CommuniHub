<html>
    <head>
        <title>Login Page</title>
        <link rel="stylesheet" href="../user/style.css">
    </head>

<div class="main-content">
    <div class="wrapper">
        <h1>Register</h1>
        <p>Please enter the information below</p>
        <br>
        <br>



        <form action="#" method="post">
            <table class="tbl-30">
                <tr>
                    <td>First Name: </td>
                    <td><input type="text" name="UserFirstName" placeholder="Enter First Name" size="20" maxlength="40" value="<?php if (isset($_POST['UserFirstName'])) echo $_POST['UserFirstName']; ?>"  /></td>
                    
                </tr>
               
                <tr>
                    <td>Last Name: </td>
                    <td><input type="text" name="UserLastName" placeholder="Enter Last Name"  size="20" maxlength="40" value="<?php if (isset($_POST['UserLastName'])) echo $_POST['UserLastName']; ?>"  /></td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="UserUserName" placeholder="Enter Username"  size="20" maxlength="40" value="<?php if (isset($_POST['UserUserName'])) echo $_POST['UserUserName']; ?>"  /></td>
                </tr>
                <tr>
                    <td>Password: </td>
                    <td><input type="password" name="UserPwd" placeholder="Enter Password" size="20" maxlength="40" value="<?php if (isset($_POST['UserPwd'])) echo $_POST['UserPwd']; ?>"  /></td>
                </tr>
                
            
                <tr>
                    <td colspan="2">
                        <input type="submit" name="Submit" value="Add User" class="btn-primary"/>
                        <button type="button" onclick="window.location.href='//localhost/php-projects/CommuniHub/front-end/index.php'" class="btn-primary">Back</button>
                    </td>
                </tr>
            </table>
	        
        </form>
        
    </div>
</div>
</html>
<?php
//check form is submitted and save the value or not

//check if button is clicked or not
if (isset($_POST['Submit'])){
 
    require_once ('../Database/database.php');
    $errors = array();

    //Get data from the form

    //check for user first name
    // if (empty($_POST['UserFirstName'])) {
	// 	$errors[] = 'Must fill in first name.';
	// } else {
	// 	$UserFirstName = ($_POST['UserFirstName']);
	// }
	
	// Check for user last name.
	if (empty($_POST['UserLastName'])) {
		$errors[] = 'Must fill in last name';
	} else {
		$UserLastName = ($_POST['UserLastName']);
	}

    //check username
	if (empty($_POST['UserUserName'])) {
		$errors[] = 'Must fill in Username';
	} else {
		$UserUserName = ($_POST['UserUserName']);
	}

    //check for user password
    //check for user password
    if (empty($_POST['UserPwd'])) {
		$errors[] = 'Must include password.';
	} else {
       // Hash the user password using crypt
       $UserPwd = crypt($_POST['UserPwd'], 'ahookdemok');
	} 
    // Check for user age
	// if (empty($_POST['UserAge'])) {
	// 	$errors[] = 'Must include age.';
	// } else {
	// 	$UserAge = ($_POST['UserAge']);  //password encryption with md5
	// } 

    // //check user martial status
    // if (empty($_POST['UserMartialStatus'])) {
	// 	$errors[] = 'Must include full name.';
	// } else {
	// 	$UserMartialStatus = ($_POST['UserMartialStatus']);
	// }
	
	// // Check for user occupation.
	// if (empty($_POST['UserOccupation'])) {
	// 	$errors[] = 'Must include occupation';
	// } else {
	// 	$UserOccupation = ($_POST['UserOccupation']);
	// }

    // Check for user contant details.
	// if (empty($_POST['UserContactDetails'])) {
	// 	$errors[] = 'Must include contact details.';
	// } else {
	// 	$UserContactDetails = ($_POST['UserContactDetails']);  //password encryption with md5
	// } 
 
	
    //end

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

        //get data

        $UserFirstName=$_POST['UserFirstName'];
        $UserLastName=$_POST['UserLastName'];
        $UserUserName=$_POST['UserUserName'];
        // $UserPwd=$_POST['UserPwd'];
        // $UserAge=$_POST['UserAge'];
        // $UserMartialStatus=$_POST['UserMartialStatus'];
        // $UserOccupation=$_POST['UserOccupation'];
        // $UserContactDetails=$_POST['UserContactDetails'];

        
      
       //SQL query to save data in database
      // Make the query.
      if (empty($errors)) { 

        // Check for previous registration.
        $query = "SELECT UserID FROM user WHERE UserFirstName='$UserFirstName' AND UserLastName='$UserLastName'";
        $result = @mysqli_query ($dbc,$query); // Run the query.
        if (mysqli_num_rows($result) == 0) {

        $query = "INSERT INTO user (UserFirstName, UserLastName,UserUserName, UserPwd ) 
        VALUES ('$UserFirstName', '$UserLastName','$UserUserName', '$UserPwd')";		
        $result = @mysqli_query ($dbc,$query);

        if ($result) { // If it ran OK. == IF TRUE
            $_SESSION['register'] = "<div class='success'>Login Successful.</div>";

            // to check whether the user is logged in or not and logout will unset it
            $_SESSION['register'] ;
            header('Location:http://localhost/php-projects/CommuniHub/front-end/index.php');
            exit();
        } else {
            $_SESSION['register'] = "<div class='error text-center'>Username or password is incorrect.</div>";
            header('Location:http://localhost/php-projects/CommuniHub/front-end/index.php');;
            exit();
        }   

      }else { // Already registered.
        echo '<h1 id="mainhead">Error!</h1>
        <p class="error">This User has already been added to the database.</p>';
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


