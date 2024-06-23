<?php
session_start();
include('include/header.php');
?>
</div>
<!-- end header section -->
<?php
require_once('../Database/database.php');

// Initialize filter variables
$filterType = isset($_GET['filterType']) ? $_GET['filterType'] : '';
$filterOrder = isset($_GET['filterOrder']) ? $_GET['filterOrder'] : 'DESC';
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

// Pagination variables
$results_per_page = 10;
$offset = ($current_page - 1) * $results_per_page;

// Construct the base query
$query = "
    SELECT a.ActivityID, a.Activityname, a.ActivityLocation , a.ActivityDate, a.ActivityTime, a.ActivityType,
           COUNT(aj.UserID) AS NumJoined
    FROM activities a
    LEFT JOIN activitiesJoined aj ON a.ActivityID = aj.ActivityID 
    WHERE a.Status = 'Completed'
";

// Apply filters
if (!empty($filterType)) {
    $query .= " AND a.ActivityType = '$filterType'";
}

$query .= " GROUP BY a.ActivityID, a.Activityname, a.ActivityLocation , a.ActivityDate, a.ActivityTime, a.ActivityType
           ORDER BY a.ActivityID $filterOrder
           LIMIT $offset, $results_per_page";

$result = mysqli_query($dbc, $query); // Run the query

// Check if query was successful
if (!$result) {
    // Display error message and exit if query fails
    echo "Error: " . mysqli_error($dbc);
    exit();
}

// Count total number of results for pagination
$count_query = "SELECT COUNT(*) AS total FROM activities WHERE Status = 'Completed'";
$count_result = mysqli_query($dbc, $count_query);
if (!$count_result) {
    die('Count Query Error: ' . mysqli_error($dbc));
}
$row_count = mysqli_fetch_assoc($count_result)['total'];
$totalPages = ceil($row_count / $results_per_page);
?>

<section class="service_section layout_padding wider_section">
    <div class="container" style="max-width: 1500px;">
        <div class="heading_container heading_center">
            <h2>Activity Dashboard</h2>
            <hr>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="pillbox border">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a class="nav-link " href="manage-activities.php">Current Activities</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="activities-history.php">History</a>
                        </li>
                    </ul>
                </div>
                <!-- Filter form -->
                <form class="form-inline justify-content-end" method="GET" action="">
                    <div class="form-row align-items-center">
                        <div class="col-auto mb-2">
                            <label for="filterType" class="mr-2">Type:</label>
                            <select class="form-control" id="filterType" name="filterType">
                                <option value="">All</option>
                                <option value="Clean-up Day" <?= ($filterType == 'Clean-up Day') ? 'selected' : '' ?>>Clean-up Day</option>
                                <option value="Block-Party" <?= ($filterType == 'Block-Party') ? 'selected' : '' ?>>Block-Party</option>
                                <option value="Community-Garden" <?= ($filterType == 'Community-Garden') ? 'selected' : '' ?>>Community Garden</option>
                                <option value="Fitness-Classes" <?= ($filterType == 'Fitness-Classes') ? 'selected' : '' ?>>Fitness-Classes</option>
                                <option value="Holiday-Celebrations" <?= ($filterType == 'Holiday-Celebrations') ? 'selected' : '' ?>>Holiday Celebrations</option>
                                <option value="Workshops" <?= ($filterType == 'Workshops') ? 'selected' : '' ?>>Workshops</option>
                                <option value="Other" <?= ($filterType == 'Other') ? 'selected' : '' ?>>Other</option>
                            </select>
                        </div>
                        
                        <div class="col-auto mb-2">
                            <label for="filterOrder" class="mr-2">Order:</label>
                            <select class="form-control" id="filterOrder" name="filterOrder">
                                <option value="DESC" <?= ($filterOrder == 'DESC') ? 'selected' : '' ?>>Descending</option>
                                <option value="ASC" <?= ($filterOrder == 'ASC') ? 'selected' : '' ?>>Ascending</option>
                            </select>
                        </div>
                        <div class="form-group mb-2 w-100">
                            <button type="submit" class="btn btn-primary btn-block">Apply Filters</button>
                        </div>
                    </div>
                </form>

            </div>
            <div class="col-lg-9">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Title</th>
                            <th scope="col">Location</th>
                            <th scope="col">Date</th>
                            <th scope="col">Time</th>
                            <th scope="col">Type</th>
                            <th scope="col">Participation</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $counter = ($current_page - 1) * $results_per_page + 1;
                        while ($row = mysqli_fetch_assoc($result)) : ?>
                        <tr>
                            <td><?php echo $counter++; ?></td>
                            <td><?php echo $row['Activityname']; ?></td>
                            <td style="text-align: justify;"><?php echo $row['ActivityLocation']; ?></td>
                            <td><?php echo $row['ActivityDate']; ?></td>
                            <td><?php echo $row['ActivityTime']; ?></td>
                            <td><?php echo $row['ActivityType']; ?></td>
                            <td><?php echo $row['NumJoined']; ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <hr>
                <!-- Pagination -->
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <?php if ($current_page > 1): ?>
                            <li class="page-item"><a class="page-link" href="?page=<?= $current_page - 1 ?>&filterType=<?= $filterType ?>&filterOrder=<?= $filterOrder ?>">Previous</a></li>
                        <?php endif; ?>
                        
                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <li class="page-item <?= ($current_page == $i) ? 'active' : '' ?>">
                                <a class="page-link" href="?page=<?= $i ?>&filterType=<?= $filterType ?>&filterOrder=<?= $filterOrder ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>
                        
                        <?php if ($current_page < $totalPages): ?>
                            <li class="page-item"><a class="page-link" href="?page=<?= $current_page + 1 ?>&filterType=<?= $filterType ?>&filterOrder=<?= $filterOrder ?>">Next</a></li>
                        <?php endif; ?>
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
    function deleteActivity(ActivityID) {
        console.log("Deleting activity with ID: " + ActivityID);
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
                // Redirect to delete-activities.php with ActivityID
                window.location.href = 'delete-activities.php?ActivityID=' + ActivityID;
            }
        });
    }
</script>
