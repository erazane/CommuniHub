<?php
session_start();
include('include/header.php');
?>
</div>
<?php
require_once('../Database/database.php');

$filterType = isset($_GET['filterType']) ? $_GET['filterType'] : '';
$filterOrder = isset($_GET['filterOrder']) ? $_GET['filterOrder'] : 'DESC';

// Set pagination parameters
$recordsPerPage = 10; // Number of records per page
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Current page number
$offset = ($currentPage - 1) * $recordsPerPage; // Offset for the query

// Initial query
$query = "SELECT c.ComplaintID, c.ComplainTitle, c.ComplaintDesc, c.ComplaintDate, c.ComplaintType, c.UserID, c.image 
          FROM complaint c 
          LEFT JOIN respondComplaint r ON c.ComplaintID = r.ComplaintID
          WHERE r.status != 'Completed' OR r.status IS NULL";

// Add filter for type of discussion
if ($filterType) {
    $query .= " AND ComplaintType = '" . mysqli_real_escape_string($dbc, $filterType) . "'";
}

// Add order by clause
$query .= " ORDER BY c.ComplaintDate " . $filterOrder;

// Count total records for pagination
$countQuery = "SELECT COUNT(*) AS total FROM ($query) AS total";
$countResult = mysqli_query($dbc, $countQuery);
$totalRecords = mysqli_fetch_assoc($countResult)['total'];

// Modify query to add pagination
$query .= " LIMIT $offset, $recordsPerPage";

$result = mysqli_query($dbc, $query); // Run the query

if (!$result) {
    die('Query failed: ' . mysqli_error($dbc));
}

// Calculate total pages
$totalPages = ceil($totalRecords / $recordsPerPage);
?>

<section class="service_section layout_padding wider_section">
    <div class="container" style="max-width: 1500px;">
        <div class="heading_container heading_center">
            <h2>Complaints Dashboard</h2>
            <hr>
        </div>
        <div class="row">
            <br>
            <br>
            <div class="col-lg-3">
                <div class="pillbox border">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="manage-donations.php">Current Complaint</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="history-complaint.php">History</a>
                        </li>
                    </ul>
                </div>
                <br>
                <br>
                <!-- filter -->
                <form class="form-inline justify-content-end" method="GET" action="">
                    <div class="form-row align-items-center">
                        <div class="col-auto mb-2">
                            <label for="filterType" class="mr-2">Type:</label>
                            <select class="form-control" id="filterType" name="filterType">
                                <option value="" <?php if ($filterType == '') echo 'selected'; ?>>All</option>
                                <option value="Safety & Wellbeing" <?php if ($filterType == 'Safety & Wellbeing') echo 'selected'; ?>>Safety & Wellbeing</option>
                                <option value="Infrastructure" <?php if ($filterType == 'Infrastructure') echo 'selected'; ?>>Infrastructure</option>
                                <option value="Noise" <?php if ($filterType == 'Noise') echo 'selected'; ?>>Noise</option>
                                <option value="Public Services" <?php if ($filterType == 'Public Services') echo 'selected'; ?>>Public Services</option>
                            </select>
                        </div>
                        
                        <div class="col-auto mb-2">
                            <label for="filterOrder" class="mr-2">Order:</label>
                            <select class="form-control" id="filterOrder" name="filterOrder">
                                <option value="DESC" <?php if ($filterOrder == 'DESC') echo 'selected'; ?>>Descending</option>
                                <option value="ASC" <?php if ($filterOrder == 'ASC') echo 'selected'; ?>>Ascending</option>
                            </select>
                        </div>
                        <div class="form-group mb-2 w-100">
                        <button type="submit" class="btn btn-primary btn-block">Apply Filters</button>
                    </div>
                    </div>
                </form>
                <!-- end filter -->
            </div>
            <div class="col-lg-9">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Type</th>
                            <th scope="col">Date</th>
                            <th scope="col">Image</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $counter = $offset + 1; // Adjust counter to reflect pagination
                        while ($row = mysqli_fetch_assoc($result)) : ?>
                            <tr>
                                <td><?php echo $counter++ ?></td>
                                <td><?php echo $row['ComplainTitle']; ?></td>
                                <td style="text-align: justify;"><?php echo $row['ComplaintDesc']; ?></td>
                                <td><?php echo $row['ComplaintType']; ?></td>
                                <td><?php echo $row['ComplaintDate']; ?></td>
                                <td>
                                    <?php if (!empty($row['image'])) : ?>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#imageModal<?php echo $row['ComplaintID']; ?>">
                                            View 
                                        </button>
                                    <?php else : ?>
                                        No Image
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="btn-group" style="padding: 5;">
                                        <a href="resolve-complaint.php?ComplaintID=<?php echo $row['ComplaintID']; ?>" class="btn btn-primary">Resolve</a>
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal -->
                            <div class="modal fade" id="imageModal<?php echo $row['ComplaintID']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"><?php echo $row['ComplainTitle']; ?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="profile_picture_container text-center mb-4" style="padding: 10%;">
                                                <img class="img-fluid" src="../front-end/images/complaint/<?php echo $row['image'] ? $row['image'] : "nodata.jpg"; ?>" alt="<?php echo $row['ComplainTitle']; ?>">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </tbody>
                </table>
<hr>
                <!-- Pagination -->
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <?php if ($currentPage > 1) : ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?php echo $currentPage - 1; ?>&filterType=<?php echo $filterType; ?>&filterOrder=<?php echo $filterOrder; ?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php for ($page = 1; $page <= $totalPages; $page++) : ?>
                            <li class="page-item <?php if ($page == $currentPage) echo 'active'; ?>">
                                <a class="page-link" href="?page=<?php echo $page; ?>&filterType=<?php echo $filterType; ?>&filterOrder=<?php echo $filterOrder; ?>"><?php echo $page; ?></a>
                            </li>
                        <?php endfor; ?>
                        <?php if ($currentPage < $totalPages) : ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?php echo $currentPage + 1; ?>&filterType=<?php echo $filterType; ?>&filterOrder=<?php echo $filterOrder; ?>" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
                <!-- End Pagination -->
            </div>
        </div>
    </div>
</section>

<?php include('include/footer.php'); ?>
