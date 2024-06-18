<?php
session_start();
include('include/header.php');
require_once('../Database/database.php'); // Connect to the db.
global $dbc;

// Determine the number of records per page
$records_per_page = 10;

// Determine the current page number
$current_page = 1; // Default to page 1
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $current_page = (int) $_GET['page'];
}

// Calculate the offset for the SQL query
$offset = ($current_page - 1) * $records_per_page;

// Make the query to count total records
$queryCount = "SELECT COUNT(*) as total FROM glassschedule";
$resultCount = mysqli_query($dbc, $queryCount);
$total_records = mysqli_fetch_assoc($resultCount)['total'];

// Calculate the total number of pages
$total_pages = ceil($total_records / $records_per_page);

// Make the query for the schedule history with limit and offset
$queryHistory = "SELECT GlassPickupday, Time, DateUpdated
                FROM glassschedule
                ORDER BY glassscheduleID DESC
                LIMIT $records_per_page
                OFFSET $offset";
$resultHistory = mysqli_query($dbc, $queryHistory);

?>
</div>
<section class="service_section layout_padding wider_section">
    <div class="container" style="max-width: 1500px;">
        <div class="heading_container heading_center">
            <h2>Schedule History</h2>
            <hr>
            <!-- Button group for switching between current and history -->
            <div class="btn-group" role="group" aria-label="Basic example">
                <a href="schedule-glass.php" class="btn btn-secondary ">Current</a>
                <a href="history-glass.php" class="btn btn-primary active">History</a>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-3">
                <div class="pillbox border">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="manage-schedule-admin.php">Current Schedule</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="waste.php">General waste</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="paper.php">Paper</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="plastic.php">Plastic</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="glass.php">Glass</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Day</th>
                            <th scope="col">Time</th>
                            <th scope="col">Date Updated</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $counter = ($current_page - 1) * $records_per_page + 1; // Start counter from the correct number
                        while ($historyRow = mysqli_fetch_assoc($resultHistory)) : ?>
                            <tr>
                                <td><?php echo $counter++ ?></td>
                                <td><?php echo $historyRow['GlassPickupday']; ?></td>
                                <td><?php echo $historyRow['Time']; ?></td>
                                <td><?php echo $historyRow['DateUpdated']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>

                <!-- Pagination links -->
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <!-- Previous Page Link -->
                        <?php if ($current_page > 1): ?>
                            <li class="page-item">
                                <a class="page-link" href="history-glass.php?page=<?php echo $current_page - 1; ?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                        <?php else: ?>
                            <li class="page-item disabled">
                                <span class="page-link">&laquo;</span>
                            </li>
                        <?php endif; ?>

                        <!-- Page Number Links -->
                        <?php for ($page = 1; $page <= $total_pages; $page++): ?>
                            <li class="page-item <?php echo ($page == $current_page) ? 'active' : ''; ?>">
                                <a class="page-link" href="history-glass.php?page=<?php echo $page; ?>"><?php echo $page; ?></a>
                            </li>
                        <?php endfor; ?>

                        <!-- Next Page Link -->
                        <?php if ($current_page < $total_pages): ?>
                            <li class="page-item">
                                <a class="page-link" href="history-glass.php?page=<?php echo $current_page + 1; ?>" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        <?php else: ?>
                            <li class="page-item disabled">
                                <span class="page-link">&raquo;</span>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</section>

<?php include('include/footer.php'); ?>
