<?php
session_start();
require_once('include/header.php');
?>
</div>
<?php
require_once('../Database/database.php'); // Include database connection file

// Get the selected filter values from the form submission
$filterType = isset($_GET['filterType']) ? $_GET['filterType'] : '';
$filterOrder = isset($_GET['filterOrder']) ? $_GET['filterOrder'] : 'DESC';

// Fetch data for discussions/complaints with filters
$query = "
    SELECT d.DiscussionID, d.title AS ComplainTitle, d.description AS ComplaintDescription, d.date AS ComplaintDate, u.UserFirstName, u.UserLastName
    FROM discussion d
    JOIN user u ON d.UserID = u.UserID
";

// Add filter for type of discussion
if ($filterType) {
    $query .= " WHERE d.type = '" . mysqli_real_escape_string($dbc, $filterType) . "'";
}

// Add order by clause
$query .= " ORDER BY d.DiscussionID $filterOrder";

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
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="heading_container heading_center">
                <h2>Schedule Dashboard</h2>
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
                <div class="form-group mb-2">
                    <label for="filterType" class="mr-2">Type:</label>
                    <select class="form-control" id="filterType" name="filterType">
                        <option value="" <?php if ($filterType == '') echo 'selected'; ?>>All</option>
                        <option value="Safety & Wellbeing" <?php if ($filterType == 'Safety & Wellbeing') echo 'selected'; ?>>Safety & Wellbeing</option>
                        <option value="Infrastructure" <?php if ($filterType == 'Infrastructure') echo 'selected'; ?>>Infrastructure</option>
                        <option value="Noise" <?php if ($filterType == 'Noise') echo 'selected'; ?>>Noise</option>
                        <option value="Public Services" <?php if ($filterType == 'Public Services') echo 'selected'; ?>>Public Services</option>
                    </select>
                </div>
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
                                <img src="./images/profile-picture/default_profile_picture.png" style="width: 100%;" alt="Profile Picture">
                            </div>
                            <div class="col-md-10">
                                <div class="box">
                                    <div class="d-flex justify-content-between">
                                        <h5>Name: <?php echo htmlspecialchars($discussion['UserFirstName']) . ' ' . htmlspecialchars($discussion['UserLastName']); ?></h5>
                                        <h5>Date: <?php echo htmlspecialchars($discussion['ComplaintDate']); ?></h5>
                                    </div>
                                    <br>
                                    <h5>Complain Title: <?php echo htmlspecialchars($discussion['ComplainTitle']); ?></h5>
                                    <p>Complaint Description: <?php echo htmlspecialchars($discussion['ComplaintDescription']); ?></p>

                                    <div class="text-left">
                                        <a href="" class="btn btn-secondary mt-3">Back</a> 
                                        <a href="reply.php" class="btn btn-primary mt-3">Reply</a> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">Next</a></li>
        </ul>
    </nav>
</div>

<br>
<br>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function submitForm() {
        var ComplaintDesc = document.getElementById("ComplaintDesc").value.trim();
        var ComplainTitle = document.getElementById("ComplainTitle").value.trim();

        if (ComplaintDesc === "" || ComplainTitle === "") {
            Swal.fire(
                "Error!",
                "Please fill out all required fields.",
                "error"
            );
            return; // Stop further execution
        }

        Swal.fire({
            title: "Add Discussion",
            icon: "info",
            showCancelButton: true,
            confirmButtonText: 'Confirm',
            cancelButtonText: 'Cancel',
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById("addDiscussionForm").submit(); // Submit the form
            }
        });
    }
</script>

<?php include('include/footer.php'); ?>
