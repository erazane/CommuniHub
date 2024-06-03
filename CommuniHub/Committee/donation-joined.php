<?php
session_start();
include('include/header.php');
?>
</div>
<!-- end header section -->
<?php
require_once('../Database/database.php');

// Make the query to retrieve donation details
$query = "
    SELECT d.DonationID, d.DonationName, d.DonationStartDate,
           COUNT(dj.UserID) AS NumJoined
    FROM donation d
    LEFT JOIN donationjoined dj ON d.DonationID = dj.DonationID
    WHERE d.Status = 'Ongoing'
    GROUP BY d.DonationID, d.DonationName, d.DonationStartDate
";

$result = mysqli_query($dbc, $query); // Run the query

// Check for query execution errors
if (!$result) {
    die('Error: ' . mysqli_error($dbc));
}
?>

<section class="service_section layout_padding wider_section">
    <div class="container" style="max-width: 1500px;">
        <div class="heading_container heading_center">
            <h2>Donation Dashboard</h2>
            <hr>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="pillbox border">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a class="nav-link " href="manage-donation.php">Current Donation</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="joined-donation.php">Donations Joined</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="add-donation.php">Add Donations</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="donation-history.php">History</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <div id="accordion">
                    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                        <div class="card">
                            <div class="card-header" id="heading<?php echo $row['DonationID']; ?>">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapse<?php echo $row['DonationID']; ?>" aria-expanded="true" aria-controls="collapse<?php echo $row['DonationID']; ?>">
                                        <?php echo $row['DonationName']; ?>
                                    </button>
                                </h5>
                            </div>

                            <div id="collapse<?php echo $row['DonationID']; ?>" class="collapse" aria-labelledby="heading<?php echo $row['DonationID']; ?>" data-parent="#accordion">
                                <div class="card-body">
                                    <table class="table">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Contact</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // Make the query to retrieve user details who have joined this donation
                                            $userQuery = "
                                                SELECT u.UserID, u.UserFirstName, u.UserLastName, u.UserEmail, u.UserContactDetails, dj.DonationTotal
                                                FROM user u
                                                INNER JOIN donationjoined dj ON u.UserID = dj.UserID
                                                WHERE dj.DonationID = {$row['DonationID']}
                                            ";
                                            $userResult = mysqli_query($dbc, $userQuery); // Run the query

                                            // Check for query execution errors
                                            if (!$userResult) {
                                                die('Error: ' . mysqli_error($dbc));
                                            }

                                            // Display user details
                                            $counter = 1;
                                            while ($userRow = mysqli_fetch_assoc($userResult)) :
                                            ?>
                                                <tr>
                                                    <td><?php echo $counter++; ?></td>
                                                    <td><?php echo $userRow['UserFirstName'] . ' ' . $userRow['UserLastName']; ?></td>
                                                    <td><?php echo $userRow['UserContactDetails']; ?></td>
                                                    <td><?php echo $userRow['UserEmail']; ?></td>
                                                    <td><?php echo $userRow['DonationTotal']; ?></td>
                                                </tr>
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include('include/footer.php'); ?>
