<?php
session_start();
include('include/header.php');
?>
</div>
<!-- end header section -->
<?php
require_once('../Database/database.php');

$UserID = $_SESSION["UserID"];
$filterOrder = isset($_GET['filterOrder']) ? $_GET['filterOrder'] : 'DESC';

// Pagination variables
$recordsPerPage = 10; // Number of records to display per page
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1; // Current page number

// Calculate the offset for the query based on current page
$offset = ($currentPage - 1) * $recordsPerPage;

// Define the query to fetch donations made by the user with pagination
$query = "SELECT dj.DateJoined, d.DonationName, d.DonationDesc, dj.DonationTotal
          FROM donationjoined dj
          INNER JOIN donation d ON dj.DonationID = d.DonationID
          WHERE dj.UserID = $UserID
          ORDER BY dj.DateJoined $filterOrder
          LIMIT $recordsPerPage
          OFFSET $offset";

$result = mysqli_query($dbc, $query); // Run the query

// Check if query was successful
if (!$result) {
    echo "Error: " . mysqli_error($dbc);
    exit();
}

// Query to count total number of records (for pagination)
$countQuery = "SELECT COUNT(*) AS totalRecords
               FROM donationjoined dj
               INNER JOIN donation d ON dj.DonationID = d.DonationID
               WHERE dj.UserID = $UserID";
$countResult = mysqli_query($dbc, $countQuery);
$rowCount = mysqli_fetch_assoc($countResult);
$totalRecords = $rowCount['totalRecords'];

// Calculate total pages
$totalPages = ceil($totalRecords / $recordsPerPage);

?>

<section class="service_section layout_padding wider_section">
    <div class="container" style="max-width: 1500px;">
        <div class="heading_container heading_center">
            <h2>Donation History</h2>
            <hr>
        </div>
        <div class="row justify-content-between align-items-center mt-3">
            <div class="col-md-9">
                <!-- Filter Form -->
                <form class="form-inline justify-content-end" method="GET" action="">
                    <div class="form-group mx-sm-3 mb-2">
                        <label for="filterOrder" class="mr-2">Order:</label>
                        <select class="form-control" id="filterOrder" name="filterOrder">
                            <option value="ASC" <?php if ($filterOrder == 'ASC') echo 'selected'; ?>>Ascending</option>
                            <option value="DESC" <?php if ($filterOrder == 'DESC') echo 'selected'; ?>>Descending</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mb-2">Apply Filters</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Donation Title</th>
                            <th scope="col">Donation Description</th>
                            <th scope="col">Date Joined</th>
                            <th scope="col">Donation Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $counter = ($currentPage - 1) * $recordsPerPage + 1; // Counter for displaying serial number
                        while ($row = mysqli_fetch_assoc($result)) : ?>
                            <tr>
                                <td><?php echo $counter++; ?></td>
                                <td><?php echo $row['DonationName']; ?></td>
                                <td><?php echo $row['DonationDesc']; ?></td>
                                <td><?php echo $row['DateJoined']; ?></td>
                                <td>RM<?php echo $row['DonationTotal']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
              
                <hr>
                  <!-- Pagination Links -->
                  <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <?php if ($currentPage > 1) : ?>
                            <li class="page-item"><a class="page-link" href="?page=<?php echo ($currentPage - 1); ?>&filterOrder=<?php echo $filterOrder; ?>">Previous</a></li>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                            <li class="page-item <?php if ($i == $currentPage) echo 'active'; ?>"><a class="page-link" href="?page=<?php echo $i; ?>&filterOrder=<?php echo $filterOrder; ?>"><?php echo $i; ?></a></li>
                        <?php endfor; ?>

                        <?php if ($currentPage < $totalPages) : ?>
                            <li class="page-item"><a class="page-link" href="?page=<?php echo ($currentPage + 1); ?>&filterOrder=<?php echo $filterOrder; ?>">Next</a></li>
                        <?php endif; ?>
                    </ul>
                </nav>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a class="btn btn-primary me-md-2" href="UserProfile-read.php">Back</a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include('include/footer.php'); ?>
