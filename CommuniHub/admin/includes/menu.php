<?php
///connect to db 
require_once ('../Database/database.php');
//include('login-check.php');  //ill figure this out later
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    
<link rel="stylesheet" type="text/css" href="../Styles/admin.css">

</head>
<body>

    <!-- Menu Section Starts -->

    <div class="menu">
        <div class="wrapper">
        <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="manage-admin.php">Admin</a></li>
                <li><a href="manage-user.php">Register New User</a></li>
                <li><a href="register-committee.php">Committee</a></li>
                <li><a href="manage-schedule-admin.php">Schedules</a></li>
                <li><a href="Donations.php">Donations</a></li>
                <li><a href="Complaint.php">Complaints</a></li>

                <li><a href="adminLogout.php">Logout</a></li>
            </ul>
        </div>
    </div>
    <!--Menu Section ends -->