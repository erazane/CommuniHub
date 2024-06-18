<?php
session_start();
include('include/header.php');
?>
</div>
<?php
require_once('../Database/database.php');

// Define number of records per page
$recordsPerPage = 10;

// Retrieve filter parameters
$filterOrder = isset($_GET['filterOrder']) ? $_GET['filterOrder'] : 'DESC';

// Determine current page number
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']) : 1;

// Calculate the starting record for the current page
$startFrom = ($page - 1) * $recordsPerPage;

// Initial query to retrieve discussions with pagination
$query = "SELECT d.DiscussionID, d.Title, d.description, d.date, d.UserID
          FROM discussion d 
          LEFT JOIN discussionreplies r ON d.DiscussionID = r.DiscussionID
          GROUP BY d.DiscussionID
          ORDER BY d.date $filterOrder
          LIMIT $startFrom, $recordsPerPage";

$result = mysqli_query($dbc, $query); // Run the query

if (!$result) {
    die('Query failed: ' . mysqli_error($dbc));
}

// Query to count total number of discussions for pagination
$countQuery = "SELECT COUNT(DISTINCT d.DiscussionID) AS totalDiscussions
               FROM discussion d";

$countResult = mysqli_query($dbc, $countQuery);
$rowCount = mysqli_fetch_assoc($countResult);
$totalRecords = $rowCount['totalDiscussions'];

// Calculate total number of pages
$totalPages = ceil($totalRecords / $recordsPerPage);

?>

<section class="service_section layout_padding wider_section">
    <div class="container" style="max-width: 1500px;">
        <div class="heading_container heading_center">
            <h2>Discussion Dashboard</h2>
            <hr>
        </div>
        <div class="row">
            <br>
            <br>
            <div class="col-lg-12">
                <!-- Filter -->
                <form class="form-inline justify-content-end mb-4" method="GET" action="">
                    <div class="form-row align-items-center">
                        <div class="col-auto">
                            <label for="filterOrder" class="mr-2">Order:</label>
                            <select class="form-control" id="filterOrder" name="filterOrder">
                                <option value="DESC" <?php if ($filterOrder == 'DESC') echo 'selected'; ?>>Descending</option>
                                <option value="ASC" <?php if ($filterOrder == 'ASC') echo 'selected'; ?>>Ascending</option>
                            </select>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary">Apply</button>
                        </div>
                    </div>
                </form>
                <!-- End Filter -->

                <?php if (isset($_SESSION['delete'])): ?>
                    <div class="alert alert-<?php echo $_SESSION['delete_data'] === 'success' ? 'success' : 'danger'; ?>">
                        <?php echo $_SESSION['delete']; ?>
                    </div>
                    <?php unset($_SESSION['delete']); unset($_SESSION['delete_data']); ?>
                <?php endif; ?>

                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">UserID</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Date</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $counter = ($page - 1) * $recordsPerPage + 1;
                        while ($row = mysqli_fetch_assoc($result)) : ?>
                            <tr>
                                <td><?php echo $counter++; ?></td>
                                <td><?php echo $row['UserID']; ?></td>
                                <td><?php echo $row['Title']; ?></td>
                                <td style="text-align: justify;"><?php echo $row['description']; ?></td>
                                <td><?php echo $row['date']; ?></td>
                                <td>
                                    <div class="btn-group" style="padding: 5;">
                                        <button type="button" class="btn btn-warning" onclick="deleteDiscussion(<?php echo $row['DiscussionID']; ?>)"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                        <a href="discussion-replies.php?DiscussionID=<?php echo $row['DiscussionID']; ?>" class="btn btn-secondary"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <hr>
                <!-- Pagination -->
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <?php if ($page > 1) : ?>
                            <li class="page-item">
                                <a class="page-link" href="discussion-dashboard.php?page=<?php echo $page - 1; ?>&filterOrder=<?php echo $filterOrder; ?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                            <li class="page-item <?php echo ($i === $page) ? 'active' : ''; ?>">
                                <a class="page-link" href="discussion-dashboard.php?page=<?php echo $i; ?>&filterOrder=<?php echo $filterOrder; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php endfor; ?>

                        <?php if ($page < $totalPages) : ?>
                            <li class="page-item">
                                <a class="page-link" href="discussion-dashboard.php?page=<?php echo $page + 1; ?>&filterOrder=<?php echo $filterOrder; ?>" aria-label="Next">
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function deleteDiscussion(DiscussionID) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You will not be able to recover this discussion',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Confirm',
            cancelButtonText: 'Cancel',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'delete-discussion.php?DiscussionID=' + DiscussionID;
            }
        });
    }
</script>
