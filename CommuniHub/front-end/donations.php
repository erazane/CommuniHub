<?php 
session_start();
require_once('include/header.php'); 
?>

<!-- end header section -->
</div>

<?php

// Get user ID
require_once('../Database/database.php');
$UserID = $_SESSION["UserID"];

$query = "SELECT  
    DonationID, DonationDesc, DonationName, 
    DonationTarget, DonationStatus, image
    FROM donation WHERE status='Ongoing'
    ORDER BY  DonationID DESC";
$result = @mysqli_query($dbc, $query);

if (!$result) {
    die('Query failed: ' . mysqli_error($dbc));
}
?>

<section class="service_section layout_padding wider_section">
    <div class="container" style="max-width: 1500px;">
        <div class="heading_container heading_center">
            <h2>Active Donations</h2>
        </div>
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

                // Open a new row after every third card
                if ($count % 3 == 0) {
                    echo '<div class="row">';
                }
            ?>
            <div class="col-md-4">
                <div class="card h-100"> <!-- Ensure cards have equal height -->
                    <img class="card-img-top img-fluid" src="../Committee/images/donations/<?php echo $image; ?>" alt="<?php echo $DonationName; ?>" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($DonationName); ?></h5>
                        <p class="card-text text-justify"><?php echo htmlspecialchars($DonationDesc); ?></p>
                    
                            <!-- <p class="card-text"><?php echo htmlspecialchars($DonationDesc); ?></p> -->
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-between">
                                <strong><p>Target: <?php echo htmlspecialchars($DonationTarget); ?></p></strong>
                                <strong><p>Status: <?php echo htmlspecialchars($DonationStatus); ?></p></strong>
                            </div>
                        <br>
                        <div class="progress" style="height: 20px;">
                            <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <br>
                        <a href="join-donation.php?DonationID=<?php echo $DonationID; ?>&UserID=<?php echo $UserID; ?>" class="btn btn-primary btn-lg btn-block">Join</a>
                    </div>
                </div>
            </div>
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

<?php include('include/footer.php'); ?>
