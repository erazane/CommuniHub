<?php 
session_start();
require_once('include/header.php'); 
?>

<!-- end header section -->
</div>

<?php
require_once('../Database/database.php');

$filterType = isset($_GET['filterType']) ? $_GET['filterType'] : 'Ongoing'; // Default to 'Ongoing'

// Get UserID from session or URL parameter
if (isset($_SESSION["UserID"])) {
    $UserID = $_SESSION["UserID"];
} elseif (isset($_GET['UserID'])) {
    $UserID = $_GET['UserID'];
    $_SESSION["UserID"] = $UserID; // Set UserID in session if not already set
} else {
    die('UserID is required');
}

// Prepare the query with the filter type
$query = "SELECT  
    DonationID, DonationDesc, DonationName, 
    DonationTarget, DonationStatus, image
    FROM donation 
    WHERE status = '" . mysqli_real_escape_string($dbc, $filterType) . "'
    ORDER BY DonationID DESC";

$result = mysqli_query($dbc, $query);

if (!$result) {
    die('Query failed: ' . mysqli_error($dbc));
}
?>

<section class="service_section layout_padding wider_section">
    <div class="container" style="max-width: 1500px;">
        <div class="heading_container heading_center">
            <h2>Active Donations</h2>
            <hr style="width: 350px; text-align: center">
        </div>
        <div class="row justify-content-center align-items-center mt-3">
            <div class="col-md-9 d-flex justify-content-center">
                <form class="form-inline" method="GET" action="">
                    <div class="form-group mx-sm-3 mb-2">
                        <label for="filterType" class="mr-2">Status:</label>
                        <select class="form-control" id="filterType" name="filterType">
                            <option value="Ongoing" <?php if ($filterType == 'Ongoing') echo 'selected'; ?>>Ongoing</option>
                            <option value="Completed" <?php if ($filterType == 'Completed') echo 'selected'; ?>>Completed</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mb-2">Apply Filters</button>
                </form>
            </div>
        </div>
        <br>
        <div class="row">
            <?php
            $count = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $DonationID = $row['DonationID'];
                $DonationDesc = $row['DonationDesc'];
                $DonationName = $row['DonationName'];
                $DonationTarget = $row['DonationTarget'];
                $DonationStatus = $row['DonationStatus'];
                $image = $row['image'];

                // Calculate the total donations collected for this donation
                $query_total_collected = "SELECT SUM(DonationTotal) AS total_collected FROM donationjoined WHERE DonationID = $DonationID";
                $result_total_collected = mysqli_query($dbc, $query_total_collected);

                if($result_total_collected && mysqli_num_rows($result_total_collected) > 0) {
                    $row_total_collected = mysqli_fetch_assoc($result_total_collected);
                    $DonationCollectionAmount = $row_total_collected['total_collected'];
                } else {
                    $DonationCollectionAmount = 0;
                }

                // Calculate the progress percentage for this donation
                if ($DonationTarget > 0) {
                    $progress = ($DonationCollectionAmount / $DonationTarget) * 100;
                } else {
                    $progress = 0;
                }

                // Open a new row after every third card
                if ($count % 3 == 0) {
                    echo '<div class="row">';
                }
            ?>
            <div class="col-md-4" style="margin-bottom: 50px;">
                <div class="card h-100"> <!-- Ensure cards have equal height -->
                    <img class="card-img-top img-fluid" src="../Committee/images/donations/<?php echo htmlspecialchars($image); ?>" alt="<?php echo htmlspecialchars($DonationName); ?>" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($DonationName); ?></h5>
                        <p class="card-text text-justify"><?php echo htmlspecialchars($DonationDesc); ?></p>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-between">
                            <strong><p>Target:RM  <?php echo htmlspecialchars($DonationTarget); ?></p></strong>
                            <strong><p>Status: <?php echo htmlspecialchars($DonationStatus); ?></p></strong>
                        </div>
                        <div class="text-left">
                            <strong><p>Currently Donated: RM <span><?php echo htmlspecialchars($DonationCollectionAmount); ?></p></strong>
                        </div>
                        <br>
                        <div class="progress" style="height: 20px;">
                            <div class="progress-bar" role="progressbar" style="width: <?php echo $progress; ?>%;" aria-valuenow="<?php echo $progress; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <br>
                        <a href="#" class="btn btn-primary btn-block md-2" onclick="confirmJoin(<?php echo $row['DonationID']; ?>, '<?php echo htmlspecialchars($UserID); ?>');">Join</a>
                    </div>
                </div>
            </div>
            <br>
            <?php
                // Close the row after every third card
                $count++;
                if ($count % 3 == 0) {
                    echo '</div>';
                }
            }
            // Close the row if the number of cards is not a multiple of 3
            if ($count % 3 != 0) {
                echo '</div>';
            }
            ?>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function confirmJoin(DonationID, UserID){
        Swal.fire({
            title: "Join this donation?",
            icon: "info",
            showCancelButton: true,
            confirmButtonText: 'Confirm',
            cancelButtonText: 'Cancel',
        })
        .then((result) => {
            if (result.isConfirmed) {
                // If the user confirms, redirect to paymentPage.php with parameters
                window.location.href = `paymentPage.php?DonationID=${DonationID}&UserID=${UserID}`;
            } else {
                // If the user cancels, do nothing
            }
        });
    }
</script>

<?php include('include/footer.php'); ?>
