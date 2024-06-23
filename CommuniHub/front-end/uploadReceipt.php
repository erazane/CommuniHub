<?php
session_start();
require_once('include/header.php');
require_once('../Database/database.php'); // Establish database connection

// Initialize variables
$UserID = null;
$DonationID = null;

// Get UserID and DonationID from URL parameters
if (isset($_GET['UserID']) && isset($_GET['DonationID'])) {
    $UserID = $_GET['UserID'];
    $DonationID = $_GET['DonationID'];

    // Set UserID in session if not already set
    if (!isset($_SESSION["UserID"])) {
        $_SESSION["UserID"] = $UserID;
    }
} else {
    // Handle gracefully if parameters are missing
    $_SESSION['status'] = "UserID and DonationID are required.";
    $_SESSION['status_code'] = "error";
    header('Location: joined-donation.php'); // Redirect to a meaningful page
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["receiptImage"])) {
    $UserID = $_SESSION["UserID"];
    $DonationID = $_GET['DonationID'];
    $DateJoined = date("Y-m-d H:i:s");  // Get the current date and time

    $newImageName = null;
    if ($_FILES["receiptImage"]["error"] != 4) {
        $filename = $_FILES["receiptImage"]["name"];
        $filesize = $_FILES["receiptImage"]["size"];
        $tmpName = $_FILES["receiptImage"]["tmp_name"];

        $validImageExtension = ['jpg', 'jpeg', 'png'];
        $imageExtension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        if (!in_array($imageExtension, $validImageExtension)) {
            $_SESSION['status'] = "Invalid Image Extension";
            $_SESSION['status_code'] = "error";
            header('Location: joined-donation.php'); // Redirect to a meaningful page
            exit;
        } elseif ($filesize > 1000000) {
            $_SESSION['status'] = "Image Size Too large";
            $_SESSION['status_code'] = "error";
            header('Location: joined-donation.php'); // Redirect to a meaningful page
            exit;
        } else {
            $newImageName = uniqid() . '.' . $imageExtension;
            move_uploaded_file($tmpName, '../front-end/images/receipt/' . $newImageName);
        }
    }

    // Insert into database
    $query = "INSERT INTO receipt (UserID, DonationID, DateJoined, ReceiptImage)
              VALUES ('$UserID', '$DonationID', '$DateJoined', '$newImageName')";

    $insertResult = mysqli_query($dbc, $query);

    if ($insertResult) {
        $_SESSION['status'] = "Receipt uploaded successfully";
        $_SESSION['status_code'] = "success";
        header('Location: joined-donation.php'); // Redirect to a meaningful page
        exit;
    } else {
        $_SESSION['status'] = "Error: " . mysqli_error($dbc);
        $_SESSION['status_code'] = "error";
        header('Location: joined-donation.php'); // Redirect to a meaningful page
        exit;
    }
}
?>
</div>

<section class="service_section layout_padding wider_section">
    <div class="container" style="max-width: 1500px;">
        <div class="heading_container heading_center">
            <h2>Upload Receipt</h2>
            <hr style="width: 350px; text-align: center">
        </div>
        <div class="row justify-content-center align-items-start mt-3">
            <div class="col-md-8">
                <div class="card p-4">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?UserID=' . $UserID . '&DonationID=' . $DonationID; ?>" method="POST" enctype="multipart/form-data" id="uploadForm">
                        <div class="form-group">
                            <label for="receiptImage">Upload Receipt Image:</label>
                            <input type="file" class="form-control-file" id="receiptImage" name="receiptImage" accept=".jpg,.jpeg,.png">
                        </div>
                        <button type="submit" class="btn btn-primary">Upload Receipt</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include('include/footer.php'); ?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('uploadForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the form from submitting normally

        Swal.fire({
            title: 'Are you sure?',
            text: "You are about to upload this receipt image!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Upload'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('uploadForm').submit(); // Submit the form programmatically
            }
        });
    });
</script>
