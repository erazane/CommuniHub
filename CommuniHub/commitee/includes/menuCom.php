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
    
<link rel="stylesheet" type="text/css" href="../Styles/committee.css">

</head>
<body>

    <!-- Menu Section Starts -->

    <div class="menu">
        <div class="wrapper">
        <ul>
                <li><a href="Committee-index.php">Home</a></li>
                <li><a href="manage-schedule.php">Schedule</a></li>
                <li><a href="manage-donations.php">Donations</a></li>
                <li><a href="manage-activities.php">Activities</a></li>
                <li><a href="manage-alerts.php">Alerts</a></li>
                <li><a href="Committee-profile-read.php">User Profile</a></li>
                <li><a href="committeeLogout.php">Logout</a></li>
            </ul>
        </div>
    </div>
    <!--Menu Section ends -->