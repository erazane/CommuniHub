<?php
session_start();
require_once('include/header.php');
require_once('../Database/database.php'); // Establish database connection

// Initialize variables
$UserID = $_GET['UserID'] ?? null;
$DonationID = $_GET['DonationID'] ?? null;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["receiptFile"])) {
    $DateJoined = date("Y-m-d H:i:s");  // Get the current date and time

    $filename = $_FILES["receiptFile"]["name"];
    $filesize = $_FILES["receiptFile"]["size"];
    $tmpName = $_FILES["receiptFile"]["tmp_name"];

    $validExtensions = ['jpg', 'jpeg', 'png']; // Valid file extensions
    $fileExtension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

    if (!in_array($fileExtension, $validExtensions)) {
        $_SESSION['status'] = "Invalid File Extension";
        $_SESSION['status_code'] = "error";
        header('Location: uploadReceipt.php');
        exit;
    }

    // Adjust file size limit as needed (1MB in this case)
    if ($filesize > 1000000) {
        $_SESSION['status'] = "File Size Too large";
        $_SESSION['status_code'] = "error";
        header('Location: uploadReceipt.php');
        exit;
    }

    $newFileName = uniqid() . '.' . $fileExtension;
    $uploadDirectory = '../front-end/images/receipt/'; // Adjust the path as per your setup
    $destination = $uploadDirectory . $newFileName;

    if (move_uploaded_file($tmpName, $destination)) {
        // File uploaded successfully, proceed to database insertion
        $query = "
        INSERT INTO donationjoined (UserID, DonationID, DateJoined, ReceiptImages)
        VALUES ('$UserID', '$DonationID', '$DateJoined', '$newFileName')";
        
        $insertResult = mysqli_query($dbc, $query);

        if ($insertResult) {
            $_SESSION['status'] = "File uploaded successfully";
            $_SESSION['status_code'] = "success";
            header('Location: donations.php'); // Redirect to donations.php after successful upload
            exit;
        } else {
            $_SESSION['status'] = "Error: " . mysqli_error($dbc);
            $_SESSION['status_code'] = "error";
            header('Location: uploadReceipt.php');
            exit;
        }
    } else {
        $_SESSION['status'] = "File upload failed: " . $_FILES["receiptFile"]["error"];
        $_SESSION['status_code'] = "error";
        header('Location: uploadReceipt.php');
        exit;
    }
}
?>

<!-- HTML and PHP for the upload form -->
<div>
    <section class="service_section layout_padding wider_section">
        <div class="container" style="max-width: 1500px;">
            <div class="heading_container heading_center">
                <h2>Upload Receipt</h2>
                <p class="text-muted mb-4">Please upload a JPEG, JPG, or PNG image of your proof of donation.</p>
                <hr style="width: 350px; text-align: center">
            </div>
            <div class="row justify-content-center align-items-start mt-3">
                <div class="col-md-8">
                    <div class="card p-4">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?UserID=' . $UserID . '&DonationID=' . $DonationID; ?>" method="POST" enctype="multipart/form-data" id="uploadForm">
                            <div class="form-group text-center">
                                <label for="receiptFile" id="uploadLabel" class="file-label">
                                    <img src="images/receipt/upload.jpg" class="img-fluid rounded-circle" width="300" height="300" alt="Upload Receipt File">
                                    <span class="upload-text">Click here to upload file</span>
                                </label>
                                <input type="file" class="form-control-file" id="receiptFile" name="receiptFile" accept=".jpg,.jpeg,.png,.pdf" style="display: none;">
                            </div>
                            <div id="fileSelectedMsg" class="text-center mb-3" style="display: none;">
                                <span class="text-success">File Selected: </span><span id="fileName"></span>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" id="uploadBtn" disabled>Confirm</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include('include/footer.php'); ?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Function to update file name display when file is selected
    document.getElementById('receiptFile').addEventListener('change', function() {
        var fileName = this.files[0].name;
        document.getElementById('fileName').textContent = fileName;
        document.getElementById('fileSelectedMsg').style.display = 'block';
        document.getElementById('uploadBtn').disabled = false; // Enable upload button
    });

    // Form submission confirmation using SweetAlert
    document.getElementById('uploadForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the form from submitting normally

        Swal.fire({
            title: 'Are you sure?',
            text: "You are about to upload this file!",
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
