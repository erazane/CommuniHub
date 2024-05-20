<?php 
session_start();
require_once('include/header.php'); 
?>
</div>
<?php
require_once('../Database/database.php'); // Include database connection file

// Fetch data for discussions/complaints
$query = "
    SELECT d.DiscussionID, d.title AS ComplainTitle, d.description AS ComplaintDescription, d.date AS ComplaintDate, u.UserFirstName, u.UserLastName
    FROM discussion d
    JOIN user u ON d.UserID = u.UserID
    ORDER BY d.DiscussionID DESC
";
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

    <div class="row justify-content-center">
        <div class="col-md-12">
            <a href="AddComplaint.php" class="btn btn-primary mr-2" >Add Complaint </a>
            <a href="AddDiscussion.php" class="btn btn-primary mr-2" >Add Discussion </a>
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
