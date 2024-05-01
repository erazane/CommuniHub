<?php 
session_start();
include('include/header.php');
?>

<!-- end header section -->
</div>

<?php
require_once('../Database/database.php');

// Make the query.
$query = "SELECT c.UserID,c.CommiteeID, c.CommiteePost, c.CommStartDate, c.CommEndDate
FROM commitee c
INNER JOIN user u ON c.UserID = u.UserID
ORDER BY c.CommiteeID ASC";

$result = mysqli_query($dbc, $query);



?>

<section class="service_section layout_padding wider_section">
    <div class="container" style="max-width: 1500px;">
        <div class="heading_container heading_center">
            <h2>User Dashboard</h2>
            <hr>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="pillbox border">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a class="nav-link " href="manage-user.php">Active Users</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="add-user.php">Add User</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="committee.php">Committee</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Committee ID</th>
                            <th scope="col">CommStartDate</th>
                            <th scope="col">CommEndDate</th>
                            <th scope="col">CommiteePost</th>               
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                        <tr>
                            <td><?php echo $row['UserID']; ?></td>
                            <td><?php echo $row['CommiteeID']; ?></td>
                            <td><?php echo $row['CommStartDate']; ?></td>
                            <td><?php echo $row['CommEndDate']; ?></td>
                            <td><?php echo $row['CommiteePost']; ?></td>

                            <td>
                                <div class="btn-group" style="padding: 5;">
                                    <br><br>
                                    <button type="button" class="btn btn-secondary" onclick="deleteCommittee(<?php echo $row['CommiteeID']; ?>)">Remove </button>
                                    <br><br>
                                
                                </div>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<?php include('include/footer.php'); ?>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    function deleteCommittee(CommiteeID) {
        console.log("deleteUser called with CommiteeID: ", CommiteeID);
        Swal.fire({
            title: 'Are you sure?',
            text: 'Unnassign this user from committee!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Confirm',
            cancelButtonText: 'Cancel',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect to delete-committee.php with CommiteeID
                window.location.href = 'delete-committee.php?CommiteeID=' + CommiteeID;
            }
        });
    }
</script>
