<?php
session_start();
require_once('include/header.php'); 
require_once('../Database/database.php');

// Display success message using SweetAlert
if (isset($_SESSION['status']) && isset($_SESSION['status_code'])) {
    echo '<script>swal("Success!", "' . htmlspecialchars($_SESSION['status']) . '", "' . htmlspecialchars($_SESSION['status_code']) . '");</script>';
    unset($_SESSION['status']);
    unset($_SESSION['status_code']);
}

if (!isset($_GET['ComplaintID'])) {
    // Handle the case where ComplaintID is not set
    echo 'ComplaintID is not set.';
    exit();
}

$ComplaintID = $_GET['ComplaintID'];

// Fetch complaint details from the database
$query = "SELECT c.ComplainTitle, c.ComplaintDesc, c.ComplaintDate, c.ComplaintType, c.image,u.UserFirstName, u.UserLastName 
          FROM complaint c 
          JOIN user u ON c.UserID = u.UserID 
          WHERE c.ComplaintID = '$ComplaintID'";
$result = mysqli_query($dbc, $query);

if ($result) {
    if ($row = mysqli_fetch_assoc($result)) {
        // $ComplaintID = $row['ComplaintID'];
        $ComplainTitle = $row['ComplainTitle'];
        $ComplaintDesc = $row['ComplaintDesc'];
        $ComplaintDate = $row['ComplaintDate'];
        $ComplaintType = $row['ComplaintType'];
        $image = $row['image'] ? $row['image'] : "nodata.jpg";
        $UserFirstName =$row['UserFirstName'];
        $UserLastName = $row['UserLastName'];
    } else {
        echo 'No complaint found with the given ID.';
        exit();
    }
} else {
    echo 'Error executing query: ' . mysqli_error($dbc);
    exit();
}

    // Process form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $respondTitle = isset($_POST['respondTitle']) ? $_POST['respondTitle'] : '';
        $respondDesc = isset($_POST['respondDesc']) ? $_POST['respondDesc'] : '';
        

        if (!empty($respondTitle) && !empty($respondDesc)) {
            $UserID = $_SESSION['UserID'];
            $respondDate = date("Y-m-d H:i:s");

            // Insertinggresponse into the database
                $query = "INSERT INTO respondComplaint (UserID, ComplaintID, respondTitle, respondDesc, respondDate)
                            VALUES ('$UserID', '$ComplaintID', '$respondTitle', '$respondDesc', '$respondDate')";
                $insertResult = mysqli_query($dbc, $query);

            if ($insertResult) {
                $_SESSION['status'] = "Inserted successfully!";
                $_SESSION['status_code'] = "success";
            } else {
                $_SESSION['status'] = "Error: " . mysqli_error($dbc);
                $_SESSION['status_code'] = "error";
            }
        } else {
            $_SESSION['status'] = "Please fill out all fields.";
            $_SESSION['status_code'] = "error";
        }

        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    }
    ?>

<section class="service_section layout_padding wider_section">
<div class="container" style="max-width: 1500px;">
        <div class="heading_container heading_center">
            <!-- <h2>Complaint Details</h2> -->
            <hr>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                    <h4><strong>Complaint Details</strong></h4>
                    <hr>
                        <div class="row">
                            <div class="col-md-2">
                                <img src="../front-end/images/complaint/<?php echo htmlspecialchars($image); ?>" alt="Complaint Image" class="img-fluid" style="max-width: 250px; max-height: 250px;">
                                    <p>No Image</p>
                            </div>
                            <div class="col-md-10">
                               <div class="container">
                                <div class="d-flex justify-content-between">
                                <h5>Name: <?php echo htmlspecialchars($UserFirstName) . ' ' . htmlspecialchars($UserLastName); ?></h5>
                                <h5>Complaint ID: <?php echo htmlspecialchars($ComplaintID); ?></h5>  
                                </div>
                               <h5>Title: <?php echo htmlspecialchars($ComplainTitle); ?></h5>
                                <h5>Description: <br><br>
                                <?php echo htmlspecialchars($ComplaintDesc); ?></h5>
                                <h5>Type: <?php echo htmlspecialchars($ComplaintType); ?></h5>
                                <h5>Date: <?php echo htmlspecialchars($ComplaintDate); ?></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form id="respondComplaint" action="#" method="POST" enctype="multipart/form-data">
                            <h4><strong>Respond to complaint</strong></h4>
                            <hr>
                            <?php
                                // Check if success message is set
                                if (isset($_SESSION['success'])) {
                                    // Display success message using SweetAlert
                                    echo '<script>swal("Success!", "' . $_SESSION['success'] . '", "success");</script>';
                                    // Unset the session variable
                                    unset($_SESSION['success']);
                                }
                            ?>
                            <div class="form-group">
                                <label for="respondTitle">Title:</label>
                                <input type="text" class="form-control" id="respondTitle" name="respondTitle" required>
                            </div>
                            <div class="form-group">
                                <label for="respondDesc">Description:</label>
                                <textarea class="form-control" id="respondDesc" name="respondDesc" rows="10" required></textarea>
                            </div>
                            <div class="text-right">
                                <button type="button" onclick="respondComplaint();" class="btn btn-primary btn-lg">Confirm</button>
                            </div>
                            <div class="form-group">
                                <label for="status">status:</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="" disabled selected>Select Type</option>
                                    <option value="Completed">Completed</option>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
                <br>
            </div>  
        </div>
    </div>
</section>

<script>
    function respondComplaint() {
        var respondTitle = document.getElementById("respondTitle").value.trim();
        var respondDesc = document.getElementById("respondDesc").value.trim();

        if (respondTitle === "" || respondDesc === "" ) {
            swal("Error!", "Please fill out all required fields.", "error");
            return;
        }

        swal({
            title: "Respond to this complaint?",
            text: "Click confirm if you wish to proceed",
            icon: "info",
            buttons: true,
            dangerMode: true,
        }).then((willProceed) => {
            if (willProceed) {
                document.getElementById("respondComplaint").submit();
            } else {
                console.log("User cancelled.");
            }
        });
    }
</script>

<?php include('include/footer.php'); ?>
