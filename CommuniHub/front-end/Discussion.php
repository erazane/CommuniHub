<?php
session_start();
require_once('include/header.php');
?>
</div>
<?php
require_once('../Database/database.php'); // Include database connection file

// Get the selected filter values from the form submission
$filterOrder = isset($_GET['filterOrder']) ? $_GET['filterOrder'] : 'DESC';

// Define the number of discussions per page
$discussionsPerPage = 10;

// Calculate the offset
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $discussionsPerPage;

// Fetch data for discussions/complaints with filters
$query = "
    SELECT d.DiscussionID, d.title AS ComplainTitle, d.description AS ComplaintDescription, d.date AS ComplaintDate, u.UserFirstName, u.UserLastName, u.image AS image, COUNT(dr.DiscussionRepliesID) AS replyCount
    FROM discussion d
    JOIN user u ON d.UserID = u.UserID
    LEFT JOIN discussionreplies dr ON d.DiscussionID = dr.DiscussionID
";

// Add order by clause
$query .= " GROUP BY d.DiscussionID ORDER BY d.DiscussionID $filterOrder LIMIT $offset, $discussionsPerPage";

$result = mysqli_query($dbc, $query);

if (!$result) {
    die('Query failed: ' . mysqli_error($dbc));
}

$discussions = [];
while ($row = mysqli_fetch_assoc($result)) {
    $discussions[] = $row;
}
?>

<br>
<div class="container" style="max-width: 1500px;">
<br>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="heading_container heading_center">
                <h2>Discussion Board</h2>
                <hr style="width: 350px; text-align: center">
            </div>
        </div>
    </div>

    <div class="row justify-content-between align-items-center mt-3">
        <div class="col-md-3">
            <a href="AddDiscussion.php" class="btn btn-primary">Add Discussion</a>
        </div>
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

    <div class="row justify-content-center mt-3">
        <div class="col-md-12">
            <?php foreach ($discussions as $discussion): ?>
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                            <img src="images/profile-picture/<?php echo $discussion['image'] ? $discussion['image'] : "default_profile_picture.png"; ?>" alt="Profile Picture" class="img-fluid rounded-circle">
                                <!-- <img src="./images/profile-picture/default_profile_picture.png" style="width: 100%;" alt="Profile Picture"> -->
                            </div>
                            <div class="col-md-10">
                                <div class="box">
                                    <div class="d-flex justify-content-between">
                                        <h5>Name: <?php echo htmlspecialchars($discussion['UserFirstName']) . ' ' . htmlspecialchars($discussion['UserLastName']); ?></h5>
                                        <h5>Date: <?php echo htmlspecialchars($discussion['ComplaintDate']); ?></h5>
                                    </div>
                                    <br>
                                    <h5> Title: <?php echo htmlspecialchars($discussion['ComplainTitle']); ?></h5>
                                    <h5> <?php echo htmlspecialchars($discussion['ComplaintDescription']); ?></h5>

                                    <div class="text-left">
                                        <h5 class='card-text'><small class='text-muted'>Replies: <?php echo htmlspecialchars($discussion['replyCount']); ?></small></h5>
                                    </div>
                                    <div class="text-right">
                                        <a href="replies.php?discussionID=<?php echo htmlspecialchars($discussion['DiscussionID']); ?>&userID=<?php echo htmlspecialchars($_SESSION['UserID']); ?>" class="btn btn-primary mt-3">Reply</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

         <!-- Pagination -->
        <div class="row justify-content-center">
            <div class="col-md-12">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <?php
                        // Query for the total number of discussions
                        $totalCountQuery = "SELECT COUNT(*) AS totalDiscussions FROM discussion";
                        $totalCountResult = mysqli_query($dbc, $totalCountQuery);
                        $totalCountRow = mysqli_fetch_assoc($totalCountResult);
                        $totalDiscussions = $totalCountRow['totalDiscussions'];
                        $totalPages = ceil($totalDiscussions / $discussionsPerPage);

                        // Pagination links
                        for ($i = 1; $i <= $totalPages; $i++) {
                            echo "<li class='page-item'><a class='page-link' href='?page=$i&filterOrder=$filterOrder'>$i</a></li>";
                        }
                        ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
 


<br>
<br>




<?php include('include/footer.php'); ?>
