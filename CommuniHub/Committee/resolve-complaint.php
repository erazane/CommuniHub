<?php
session_start();
require_once('include/header.php'); 
require_once('../Database/database.php');
?>
</div>
<?php

if (isset($_SESSION['status']) && isset($_SESSION['status_code'])) {
    // Display success message using SweetAlert
    echo '<script>swal("Success!", "' . htmlspecialchars($_SESSION['status']) . '", "' . htmlspecialchars($_SESSION['status_code']) . '");</script>';
    // Unset the session variables
    unset($_SESSION['status']);
    unset($_SESSION['status_code']);
}

// Initial query
$complaintID = $_GET['complaintID']; 

// Fetch complaint details from the database
$query = "SELECT c.ComplainTitle, c.ComplaintDesc, c.ComplaintDate, c.ComplaintType, c.image, u.UserLastName 
          FROM complaint c 
          JOIN users u ON c.UserID = u.UserID 
          WHERE c.ComplaintID = '$complaintID'";

$result = mysqli_query($dbc, $query);

if (!empty($ComplainTitle) && !empty($ComplaintDesc) && !empty($ComplaintType)) {
    $query = "INSERT INTO complaint (UserID, ComplainTitle, ComplaintDesc, ComplaintDate, ComplaintType, image)
              VALUES ('$UserID', '$ComplainTitle', '$ComplaintDesc', '$ComplaintDate', '$ComplaintType', '$newImageName')";

    $insertResult = mysqli_query($dbc, $query);

    if ($insertResult) {
        $_SESSION['status'] = "Inserted successfully!";
        $_SESSION['status_code'] = "success";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($dbc);
    }
} else {
    $_SESSION['status'] = "Unable to insert data";
    $_SESSION['status_code'] = "error";
}



?>
<section class="service_section layout_padding wider_section">
    <div class="container" style="max-width: 1500px;">
        <div class="heading_container heading_center">
            <h2>Add Complaint</h2>
            <hr>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body"></div>
                        <div class="col-md-2">
                            <img src="../front-end/images/complaint/ <?php echo $row['image'] ? $row['image'] : "nodata.jpg"; ?>" alt="NoData" style="max-width: 250px; max-height:250px;" >
                        </div>
                </div>
            </div>
        </div>
    </div>
</section>