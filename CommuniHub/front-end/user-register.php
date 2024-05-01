<?php
session_start();
require_once ('../Database/database.php');

if (isset($_POST['Submit'])){
    
        
    $UserFirstName = $_POST['UserFirstName'];
    $UserLastName = $_POST['UserLastName'];
    $UserUserName = $_POST['UserUserName'];
    $UserPwd = crypt($_POST['UserPwd'], 'ahookdemok');
      
    // Check for empty fields
    if (!empty($UserFirstName) && !empty($UserLastName) && !empty($UserUserName) && !empty($UserPwd)) {
        // Check for existing user
        $query = "SELECT UserID FROM user WHERE UserFirstName='$UserFirstName' AND UserLastName='$UserLastName'";
        $result = mysqli_query($dbc, $query);
        if (mysqli_num_rows($result) == 0) {
            // Insert user data into the database
            $query = "INSERT INTO user (UserFirstName, UserLastName, UserUserName, UserPwd) 
                      VALUES ('$UserFirstName', '$UserLastName', '$UserUserName', '$UserPwd')";
            $result = mysqli_query($dbc, $query);

            $userRow = mysqli_fetch_assoc($result);
            $_SESSION['user'] = $UserUserName;
            $_SESSION['UserFirstName'] = $userRow['UserFirstName'];
            $_SESSION['UserLastName'] = $userRow['UserLastName'];
            
            if ($result) {
                // Registration successful
                $_SESSION['register'] = "<div class='success'>Registration Successful.</div>";
                header('Location: http://localhost/php-projects/CommuniHub/front-end/indexLogin.php');
                exit();
            } else {
                // Registration failed
                $_SESSION['register'] = "<div class='error text-center'>Registration failed. Please try again.</div>";
                header('Location: http://localhost/php-projects/CommuniHub/front-end/index.php');
                exit();
            }
        } else {
            // User already exists
            $_SESSION['register'] = "<div class='error text-center'>User already exists.</div>";
            header('Location: http://localhost/php-projects/CommuniHub/front-end/index.php');
            exit();
        }
    } else {
        // Empty fields
        $_SESSION['register'] = "<div class='error text-center'>Please fill in all fields.</div>";
        header('Location: http://localhost/php-projects/CommuniHub/front-end/index.php');
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Committee Login Page</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- SweetAlert CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.4/sweetalert2.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <style>
        body {
            background-color: #f8f9fa; /* Set background color */
        }
        .login-box {
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2); /* Add shadow */
            padding: 20px;
            border-radius: 2px;
            background-color: #ffffff; /* Set background color */
        }
        .login-image {
            width: 100%;
            height: auto;
        }
        .login-title {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 20px;
            padding: 2%;
        }
    </style>
</head>
<body>

<div class="container-fluid" style="background-image: url('../Administator/images/loginpic.jpg')">
    <div class="row justify-content-center align-items-center" style="height: 100vh;">
        <div class="col-md-8">
            <div class="login-box" style="padding-left: 2.5%;">
                <div class="row">
                    <div class="col-md-6" style="background-image: url('../Administator/images/loginpic.jpg'); background-size: cover; background-position: center;"></div>
                    <div class="col-md-6">
                        <div class="login-title">
                            <h2> Register</h2>
                            <p>Fill in the details below to create an account.</p>
                        </div>
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <div class="user-details">
                                <div class="form-group">
                                    <label for="UserFirstName">First Name:</label>
                                    <input type="text" class="form-control" name="UserFirstName" placeholder="Enter First Name" required>
                                </div>
                                <div class="form-group">
                                    <label for="UserLastName">Last Name:</label>
                                    <input type="text" class="form-control" name="UserLastName" placeholder="Enter Last Name" required>
                                </div>
                                <div class="form-group">
                                    <label for="UserUserName">Username:</label>
                                    <input type="text" class="form-control" name="UserUserName" placeholder="Enter Username" required>
                                </div>
                                <div class="form-group">
                                    <label for="UserPwd">Password:</label>
                                    <input type="password" class="form-control" name="UserPwd" placeholder="Enter Password" required>
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary btn-lg btn-block" name="Submit" value="Register">
                                    <a href="../front-end/index.php" class="btn btn-secondary btn-lg btn-block btn-back">Back</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- SweetAlert JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
