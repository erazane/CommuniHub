<?php
session_start();
include('include/header.php');
?>
</div>
<!-- end header section -->
<?php
require_once('../Database/database.php');
global $dbc;

// Pagination variables
$results_per_page = 10; // Number of results per page
$current_page = isset($_GET['page']) ? $_GET['page'] : 1; // Current page number

// Calculate the starting point of the results
$offset = ($current_page - 1) * $results_per_page;

// Fetch donations with current collection and pagination
$query = "SELECT d.DonationID, d.DonationDesc, d.DonationName, d.DonationTarget, 
                 COALESCE(SUM(dj.DonationTotal), 0) AS DonationCollectionAmount, 
                 d.DonationStartDate, d.DonationEndDate, d.DonationStatus
          FROM donation d
          LEFT JOIN donationjoined dj ON d.DonationID = dj.DonationID
          WHERE d.status = 'Completed'
          GROUP BY d.DonationID
          ORDER BY d.DonationID ASC
          LIMIT $offset, $results_per_page";

$result = mysqli_query($dbc, $query);
if (!$result) {
    die('Query Error: ' . mysqli_error($dbc));
}

// Count total number of results for pagination
$count_query = "SELECT COUNT(*) AS total FROM donation WHERE status = 'Completed'";
$count_result = mysqli_query($dbc, $count_query);
if (!$count_result) {
    die('Count Query Error: ' . mysqli_error($dbc));
}
$row_count = mysqli_fetch_assoc($count_result)['total'];
$total_pages = ceil($row_count / $results_per_page);
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
                            <a class="nav-link active" href="donation-history.php">History</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Target</th>
                            <th scope="col">Current Collection</th>
                            <th scope="col">Start Date</th>
                            <th scope="col">End Date</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $counter = ($current_page - 1) * $results_per_page + 1;
                        while ($row = mysqli_fetch_assoc($result)) : ?>
                        <tr>
                            <td><?php echo $counter++; ?></td>
                            <td><?php echo htmlspecialchars($row['DonationName']); ?></td>
                            <td style="text-align: justify;"><?php echo htmlspecialchars($row['DonationDesc']); ?></td>
                            <td><?php echo htmlspecialchars($row['DonationTarget']); ?></td>
                            <td><?php echo number_format($row['DonationCollectionAmount'], 2); ?></td>
                            <td><?php echo htmlspecialchars($row['DonationStartDate']); ?></td>
                            <td><?php echo htmlspecialchars($row['DonationEndDate']); ?></td>
                            <td><?php echo htmlspecialchars($row['DonationStatus']); ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <hr>
                <!-- Pagination -->
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <?php for ($page = 1; $page <= $total_pages; $page++) : ?>
                            <li class="page-item <?php if ($current_page == $page) echo 'active'; ?>">
                                <a class="page-link" href="donation-history.php?page=<?php echo $page; ?>">
                                    <?php echo $page; ?>
                                </a>
                            </li>
                        <?php endfor; ?>
                    </ul>
                </nav>
                <!-- End Pagination -->
            </div>
        </div>
    </div>
</section>

<?php include('include/footer.php'); ?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    function deleteDonation(DonationID) {
        console.log("Deleting donation with ID: " + DonationID);
        Swal.fire({
            title: 'Are you sure?',
            text: 'You will not be able to recover this.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Confirm',
            cancelButtonText: 'Cancel',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect to delete-admin.php with DonationID
                window.location.href = 'delete-donation.php?DonationID=' + DonationID;
            }
        });
    }
</script>
