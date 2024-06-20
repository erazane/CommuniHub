<?php
session_start();
include('include/header.php');
?>
</div>
<?php
require_once('../Database/database.php');

// Get DonationID from the GET request or POST data
$DonationID = isset($_GET['DonationID']) ? intval($_GET['DonationID']) : 0;

// Fetch existing donation data
$query = "SELECT * FROM donation WHERE DonationID = '$DonationID'";
$result = mysqli_query($dbc, $query);

if ($result && mysqli_num_rows($result) == 1) {
    $donation = mysqli_fetch_assoc($result);
} else {
    die('Invalid Donation ID or Donation not found.');
}
?>
<br>
<br>
<div class="container" style="max-width: 1500px;">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="heading_container heading_center">
                <h2>Update : <?php echo htmlspecialchars($donation['DonationName']); ?></h2>
                <hr style="width: 350px; text-align: center">
            </div>
        </div>
    </div>

    <div class="row justify-content-center mt-3">
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box">
                                <!-- Ensure image path is correct -->
                                <?php if (!empty($donation['image'])): ?>
                                    <img class="card-img-top img-fluid" src="../Committee/images/donations/<?php echo htmlspecialchars($donation['image']); ?>" alt="<?php echo htmlspecialchars($donation['DonationName']); ?>" style="height: 350px; object-fit: cover;">
                                <?php else: ?>
                                    <img class="card-img-top img-fluid" src="path/to/default_image.jpg" alt="Default Image" style="height: 200px; object-fit: cover;">
                                <?php endif; ?>
                                <!-- Form for updating donation details -->
                                <form id="UpdateDonation" action="process-donation-update.php" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="DonationID" value="<?php echo $DonationID; ?>">
                                    <div class="form-group">
                                        <label for="DonationName">Title:</label>
                                        <input type="text" class="form-control" id="DonationName" name="DonationName" value="<?php echo htmlspecialchars($donation['DonationName']); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="DonationDesc">Description:</label>
                                        <textarea class="form-control" id="DonationDesc" name="DonationDesc" rows="5" required><?php echo htmlspecialchars($donation['DonationDesc']); ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="DonationTarget">Target:</label>
                                        <input type="text" class="form-control" id="DonationTarget" name="DonationTarget" value="<?php echo htmlspecialchars($donation['DonationTarget']); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="DonationStartDate">Start Date:</label>
                                        <input type="date" class="form-control" id="DonationStartDate" name="DonationStartDate" value="<?php echo htmlspecialchars($donation['DonationStartDate']); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="DonationEndDate">End Date:</label>
                                        <input type="date" class="form-control" id="DonationEndDate" name="DonationEndDate" value="<?php echo htmlspecialchars($donation['DonationEndDate']); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="DonationStatus">Priority:</label>
                                        <select class="form-control" id="DonationStatus" name="DonationStatus" required>
                                            <option value="High" <?php if ($donation['DonationStatus'] == 'High') echo 'selected'; ?>>High Priority</option>
                                            <option value="Medium" <?php if ($donation['DonationStatus'] == 'Medium') echo 'selected'; ?>>Medium Priority</option>
                                            <option value="Low" <?php if ($donation['DonationStatus'] == 'Low') echo 'selected'; ?>>Low Priority</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Status:</label>
                                        <select class="form-control" id="status" name="status" required>
                                            <option value="Ongoing" <?php if ($donation['status'] == 'Ongoing') echo 'selected'; ?>>Ongoing</option>
                                            <option value="Completed" <?php if ($donation['status'] == 'Completed') echo 'selected'; ?>>Completed</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Image:</label>
                                        <input type="file" class="form-control-file" id="image" name="image" accept=".jpg, .jpeg, .png">
                                    </div>
                                </form>
                                <div class="text-right">
                                    <a href="manage-donation.php" class="btn btn-secondary btn-lg">Back</a>
                                    <button type="button" onclick="UpdateDonation();" class="btn btn-primary btn-lg">Confirm</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function UpdateDonation() {
        var DonationName = document.getElementById("DonationName").value.trim();
        var DonationDesc = document.getElementById("DonationDesc").value.trim();
        var DonationTarget = document.getElementById("DonationTarget").value.trim();
        var DonationStartDate = document.getElementById("DonationStartDate").value.trim();
        var DonationEndDate = document.getElementById("DonationEndDate").value.trim();
        var DonationStatus = document.getElementById("DonationStatus").value.trim();
        var status = document.getElementById("status").value.trim();
        var image = document.getElementById("image").files[0]; // Get the file object

       
        Swal.fire({
            title: "Would you like to update this donation?",
            text: "Click confirm if you wish to proceed",
            icon: "info",
            showCancelButton: true,
            confirmButtonText: "Confirm",
            cancelButtonText: "Cancel",
        }).then((willProceed) => {
            if (willProceed.isConfirmed) {
                document.getElementById("UpdateDonation").submit();
            } else {
                console.log("User cancelled.");
            }
        });
    }
</script>

<?php include('include/footer.php'); ?>
