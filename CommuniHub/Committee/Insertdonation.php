<?php
session_start();
include('include/header.php');

require_once('../Database/database.php');

// Fetch ongoing donations
$query = "SELECT DonationID, DonationName FROM donation WHERE status = 'Ongoing'";
$result = mysqli_query($dbc, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($dbc));
}

$ongoingDonations = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Check for form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $DonationID = isset($_POST['DonationID']) ? $_POST['DonationID'] : "";
    $DonationTotal = isset($_POST['DonationTotal']) ? $_POST['DonationTotal'] : "";
    $DateJoined = isset($_POST['DateJoined']) ? $_POST['DateJoined'] : "";
    $ReceiptImages = isset($_FILES['ReceiptImages']['name']) ? $_FILES['ReceiptImages']['name'] : "";

    // Handle file upload
    if ($_FILES["ReceiptImages"]["error"] != 4) {
        $filename = $_FILES["ReceiptImages"]["name"];
        $filesize = $_FILES["ReceiptImages"]["size"];
        $tmpName = $_FILES["ReceiptImages"]["tmp_name"];

        $validImageExtension = ['jpg', 'jpeg', 'png'];
        $imageExtension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        if (!in_array($imageExtension, $validImageExtension)) {
            $_SESSION['status'] = "Invalid Image Extension";
            $_SESSION['status_code'] = "error";
        } elseif ($filesize > 1000000) {
            $_SESSION['status'] = "Image Size Too large";
            $_SESSION['status_code'] = "error";
        } else {
            $newImageName = uniqid() . '.' . $imageExtension;
            move_uploaded_file($tmpName, '../Committee/images/donations/receipts/' . $newImageName);

            // Insert into database
            $query = "INSERT INTO donationjoined (DonationID, DateJoined, DonationTotal, ReceiptImages) 
                      VALUES ('$DonationID', '$DateJoined', '$DonationTotal', '$newImageName')";
            $insertResult = mysqli_query($dbc, $query);

            if ($insertResult) {
                $_SESSION['status'] = "Inserted successfully!";
                $_SESSION['status_code'] = "success";
            } else {
                $_SESSION['status'] = "Error: " . mysqli_error($dbc);
                $_SESSION['status_code'] = "error";
            }
        }
    } else {
        $_SESSION['status'] = "Please select a receipt image.";
        $_SESSION['status_code'] = "error";
    }

}
?>

<!-- HTML form with dropdown of ongoing donations -->

<section class="service_section layout_padding wider_section">
    <div class="container" style="max-width: 1500px;">
        <div class="heading_container heading_center">
            <h2>Add Donation</h2>
            <hr>
        </div>
        <div class="row">
        <div class="col-lg-3">
                <div class="pillbox border">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a class="nav-link " href="manage-donation.php">Current Donations</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="donation-joined.php">Donations Joined</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="add-donation.php">Add Donations</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="Insertdonation.php">Manual Insert</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="donation-history.php">History</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <form id="addDonationForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                            <h4><strong>Fill out the form below to manually key in a donation amount.</strong></h4>
                            <hr>
                            <?php
                            // Display session status message if set
                            if (isset($_SESSION['status']) && isset($_SESSION['status_code'])) {
                                echo '<script>swal("Alert!", "' . htmlspecialchars($_SESSION['status']) . '", "' . htmlspecialchars($_SESSION['status_code']) . '");</script>';
                                unset($_SESSION['status']);
                                unset($_SESSION['status_code']);
                            }
                            ?>
                            <div class="form-group">
                                <label for="DonationID">Select Donation:</label>
                                <select class="form-control" id="DonationID" name="DonationID" required>
                                    <option value="">Select an ongoing donation</option>
                                    <?php foreach ($ongoingDonations as $donation): ?>
                                        <option value="<?php echo $donation['DonationID']; ?>"><?php echo $donation['DonationName']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="DonationTotal">Total Donation:</label>
                                <input type="text" class="form-control" id="DonationTotal" name="DonationTotal" required>
                            </div>
                            <div class="form-group">
                                <label for="DateJoined">Date Joined:</label>
                                <input type="date" class="form-control" id="DateJoined" name="DateJoined" required>
                            </div>
                            <div class="form-group">
                                <label for="ReceiptImages">Receipt Image:</label>
                                <input type="file" class="form-control-file" id="ReceiptImages" name="ReceiptImages" required>
                            </div>
                            <div class="text-right">
                                <button type="button" onclick="addDonation();" class="btn btn-primary btn-lg">Confirm</button>
                            </div>
                            <script>
                                function addDonation() {
                                    var DonationID = document.getElementById("DonationID").value.trim();
                                    var DonationTotal = document.getElementById("DonationTotal").value.trim();
                                    var DateJoined = document.getElementById("DateJoined").value.trim();
                                    var ReceiptImages = document.getElementById("ReceiptImages").value.trim();

                                    if (DonationID === "" || DonationTotal === "" || DateJoined === "" || ReceiptImages === "") {
                                        swal("Error!", "Please fill out all required fields and select an image.", "error");
                                        return;
                                    }

                                    swal({
                                        title: "Add this donation?",
                                        text: "Click confirm if you would like to add this donation",
                                        icon: "info",
                                        showCancelButton: true,
                                        confirmButtonText: 'Confirm',
                                        cancelButtonText: 'Cancel',
                                        reverseButtons: true
                                    }).then((willJoin) => {
                                        if (willJoin) {
                                            // If user confirms, submit the form
                                            document.getElementById('addDonationForm').submit();
                                        } else {
                                            // If user cancels, do nothing
                                            console.log("User cancelled.");
                                        }
                                    });
                                }
                            </script>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include('include/footer.php'); ?>
