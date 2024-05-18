<?php
session_start();
require_once('../Database/database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize form inputs
    $title = $_POST['Title'];
    $desc = $_POST['Desc'];
    $user_id = $_POST['user_id'];

    // Insert data into the database
    $sql = "INSERT INTO complaint (title, content, user_id) VALUES ('$title', '$desc', '$user_id')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        // Insertion successful
        // Redirect to a success page or do something else
        header("Location: success.php");
        exit();
    } else {
        // Insertion failed
        echo "Error: " . mysqli_error($conn);
    }
} else {
    // Handle invalid requests
    echo "Invalid request!";
}
?>
