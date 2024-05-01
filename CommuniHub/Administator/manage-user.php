<?php 
session_start();
include('include/header.php');
?>

<!-- end header section -->
</div>

<?php
require_once('../Database/database.php');

// Make the query.
$query = "SELECT user.UserID as UserID, UserFirstName, UserLastName, UserUserName, UserAge, UserMartialStatus, UserOccupation, UserContactDetails, CommiteeID 
FROM user LEFT JOIN commitee ON user.UserID = commitee.UserID ORDER BY user.UserID ASC";
$result = mysqli_query($dbc, $query); // Run the query.



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
                            <a class="nav-link active" href="manage-user.php">Active Users</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="add-user.php">Add User</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="committee.php">Committee</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Username</th>
                            <th scope="col">Age</th>
                            <th scope="col">Martial Status</th>
                            <th scope="col">Occupation</th>
                            <th scope="col">Contact Details</th>
                            <th scope="col">Type</th>               
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                            
                        <?php 
                            // Get UserType here inside the loop
                            $UserType = ($row['CommiteeID']) ? "Committee" : "Resident";
                        ?>
                        <tr>
                            <td><?php echo $row['UserID']; ?></td>
                            <td><?php echo $row['UserFirstName']; ?></td>
                            <td><?php echo $row['UserLastName']; ?></td>
                            <td><?php echo $row['UserUserName']; ?></td>
                            <td><?php echo $row['UserAge']; ?></td>
                            <td><?php echo $row['UserMartialStatus']; ?></td>
                            <td><?php echo $row['UserOccupation']; ?></td>
                            <td><?php echo $row['UserContactDetails']; ?></td>
                            <td><?php echo ($row['CommiteeID']) ? "Committee" : "Resident"; ?></td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic outlined example">
                                    <button type="button" class="btn btn-secondary" onclick="deleteUser(<?php echo $row['UserID']; ?>)">Delete</button>
                                    
                                    <button type="submit" class="btn btn-secondary" <?php if($UserType == 'Committee') echo 'disabled'; ?> onclick="window.location.href='assign-committee.php?UserID=<?php echo $row['UserID']; ?>'">Assign</button>
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
    function deleteUser(UserID) {
        console.log("deleteUser called with UserID: ", UserID);
        Swal.fire({
            title: 'Are you sure?',
            text: 'You will not be able to recover this user!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Confirm',
            cancelButtonText: 'Cancel',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect to delete-user.php with userID
                window.location.href = 'delete-user.php?UserID=' + UserID;
            }
        });
    }
</script>
