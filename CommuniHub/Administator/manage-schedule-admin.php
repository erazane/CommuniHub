<?php
session_start();
include('include/header.php');
?>
</div>
<!-- end header section -->

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
                            <a class="nav-link active" href="manage-schedule-admin.php">Current Schedule</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="waste.php">General waste</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="paper.php">Paper </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="plastic.php">Plastic</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="glass.php">Glass</a>
                        </li>
            
                        <li class="nav-item">
                            <a class="nav-link" href="#">History</a>
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
                        <tr>
                            <!-- <td><?php echo $row['UserID']; ?></td>
                            <td><?php echo $row['UserFirstName']; ?></td>
                            <td><?php echo $row['UserLastName']; ?></td>
                            <td><?php echo $row['UserUserName']; ?></td>
                            <td><?php echo $row['UserAge']; ?></td>
                            <td><?php echo $row['UserMartialStatus']; ?></td>
                            <td><?php echo $row['UserOccupation']; ?></td>
                            <td><?php echo $row['UserContactDetails']; ?></td>
                            <td><?php echo ($row['CommiteeID']) ? "Committee" : "Resident"; ?></td> -->
                            <td>
                                <div class="btn-group" style="padding: 5;">
                                    <br><br>
                                    <button type="button" class="btn btn-secondary" onclick="deleteUser(<?php echo $row['UserID']; ?>)">Delete </button>
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
