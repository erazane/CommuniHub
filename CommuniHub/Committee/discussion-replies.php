<?php
session_start();
include('include/header.php');
?>
</div>
<?php
require_once('../Database/database.php');

// Getting the filter value from the form
$filterOrder = isset($_GET["filterOrder"]) ? $_GET["filterOrder"] : "DESC";

// Get the discussionID from the URL
$discussionID = isset($_GET["DiscussionID"]) ? intval($_GET["DiscussionID"]) : 0;

// Validate discussionID
if ($discussionID <= 0) {
    die("Invalid Discussion ID");
}

// Check if page number is set in the URL, default to 1 if not set
$page = isset($_GET["page"]) ? intval($_GET["page"]) : 1;

// Define the number of replies per page
$repliesPerPage = 10;

// Calculate the offset for pagination
$offset = ($page - 1) * $repliesPerPage;

// Fetch the specific discussion based on its ID
$queryDiscussion = "
    SELECT d.DiscussionID, d.title AS ComplainTitle, d.description AS ComplaintDescription, d.date AS ComplaintDate, u.UserFirstName, u.UserLastName, u.image AS image
    FROM discussion d
    JOIN user u ON d.UserID = u.UserID
    WHERE d.DiscussionID = $discussionID
";
$resultDiscussion = mysqli_query($dbc, $queryDiscussion);

if (!$resultDiscussion) {
    die("Query failed: " . mysqli_error($dbc));
}

$discussion = mysqli_fetch_assoc($resultDiscussion);

if (!$discussion) {
    die("Discussion not found");
}

// Fetch the total number of replies for pagination
$queryTotalReplies = "
    SELECT COUNT(*) AS totalReplies
    FROM discussionreplies
    WHERE DiscussionID = $discussionID
";
$resultTotalReplies = mysqli_query($dbc, $queryTotalReplies);
$totalRepliesRow = mysqli_fetch_assoc($resultTotalReplies);
$totalReplies = $totalRepliesRow['totalReplies'];

// Calculate total pages
$totalPages = ceil($totalReplies / $repliesPerPage);

// Fetch the replies for the specific discussion with pagination
$queryReplies = "
    SELECT r.DiscussionRepliesID, r.description AS ReplyDescription, r.dateReplied AS ReplyDate, r.UserID, u.UserFirstName, u.UserLastName, u.image AS UserImage
    FROM discussionreplies r
    JOIN user u ON r.UserID = u.UserID
    WHERE r.DiscussionID = $discussionID
    ORDER BY r.dateReplied $filterOrder
    LIMIT $offset, $repliesPerPage
";
$resultReplies = mysqli_query($dbc, $queryReplies);

if (!$resultReplies) {
    die("Query failed: " . mysqli_error($dbc));
}

$replies = [];
while ($row = mysqli_fetch_assoc($resultReplies)) {
    $replies[] = $row;
}
?>

<section class="service_section layout_padding wider_section">
    <div class="container" style="max-width: 1500px;">
        <div class="heading_container heading_center">
            <h2>Discussion Replies</h2>
            <hr>
            <h3>Discussion Title: <?php echo htmlspecialchars($discussion['ComplainTitle']); ?></h3>
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
                    <!-- Hidden input for discussionID -->
                    <input type="hidden" name="DiscussionID" value="<?php echo $discussionID; ?>">
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
                            <th scope="col">User</th>
                            <th scope="col">Reply Description</th>
                            <th scope="col">Date Replied</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $counter = ($page - 1) * $repliesPerPage + 1;
                        foreach ($replies as $reply) : ?>
                            <tr>
                                <td><?php echo $counter++; ?></td>
                                <td><?php echo $reply['UserFirstName'] . ' ' . $reply['UserLastName']; ?></td>
                                <td><?php echo $reply['ReplyDescription']; ?></td>
                                <td><?php echo $reply['ReplyDate']; ?></td>
                                <td>
                                    <div class="btn-group" style="padding: 5px;">
                                    <!-- <button type="button" class="btn btn-warning" onclick="deleteDiscussioneReplies(<?php echo $row['DiscussionRepliesID ']; ?>)"><i class="fa fa-trash" aria-hidden="true"></i></button> -->
                                    <button type="button" class="btn btn-warning" onclick="deleteDiscussioneReplies(<?php echo $reply['DiscussionRepliesID']; ?>)"><i class="fa fa-trash" aria-hidden="true"></i></button>

                                        <!-- <a href="discussion-replies.php?DiscussionID=<?php echo $discussionID; ?>&page=<?php echo $page; ?>&filterOrder=<?php echo $filterOrder; ?>" class="btn btn-secondary"><i class="fa fa-eye" aria-hidden="true"></i> View</a> -->
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <hr>
                <!-- Pagination -->
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <?php if ($page > 1) : ?>
                            <li class="page-item">
                                <a class="page-link" href="discussion-replies.php?DiscussionID=<?php echo $discussionID; ?>&page=<?php echo $page - 1; ?>&filterOrder=<?php echo $filterOrder; ?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                            <li class="page-item <?php echo ($i === $page) ? 'active' : ''; ?>">
                                <a class="page-link" href="discussion-replies.php?DiscussionID=<?php echo $discussionID; ?>&page=<?php echo $i; ?>&filterOrder=<?php echo $filterOrder; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php endfor; ?>

                        <?php if ($page < $totalPages) : ?>
                            <li class="page-item">
                                <a class="page-link" href="discussion-replies.php?DiscussionID=<?php echo $discussionID; ?>&page=<?php echo $page + 1; ?>&filterOrder=<?php echo $filterOrder; ?>" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
                <!-- End Pagination -->
                <div class="text-right">
                <a href="manage-discussions.php" class="btn btn-primary btn-lg">Back</a>
            </div>
            </div>
        </div>
    </div>
    
</section>

<?php include "include/footer.php"; ?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function deleteDiscussioneReplies(DiscussionRepliesID) {
    Swal.fire({
        title: 'Are you sure?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Confirm',
        cancelButtonText: 'Cancel',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = 'delete-discussionreplies.php?DiscussionRepliesID=' + DiscussionRepliesID;
        }
    });
}

</script>