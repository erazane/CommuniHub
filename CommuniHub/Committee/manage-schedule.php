<?php
session_start();
include('include/header.php');
?>
</div>

<section class="service_section layout_padding wider_section">
    <div class="container" style="max-width: 1500px;">
        <div class="heading_container heading_center">
            <h2>Schedule Dashboard</h2>
            <hr style="width: 350px; text-align: center">
            <hr>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-3 mb-4">
                <div class="card" style="width: 18rem;">
                    <img src="./images/waste.jpg" class="card-img-top" alt="...">
                    <a href="https://www.freepik.com/free-photo/three-miniature-recycle-bins_12977563.htm#fromView=search&page=1&position=16&uuid=804fda5d-13af-4ca5-8c00-0e40395aaf0b">Image by freepik</a>
                    <div class="card-body">
                        <h5 class="card-title">General Waste</h5>
                        <p class="card-text">Efficiently handle your neighborhood's waste collection schedule.</p>
                        <a href="schedule-waste.php" class="btn btn-primary">Manage</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card" style="width: 18rem;">
                    <img src="./images/plastic.jpg" class="card-img-top" alt="general waste image">
                    <a href="https://www.freepik.com/free-photo/assortment-different-trashed-objects_15175051.htm">Image by freepik</a>
                    <div class="card-body">
                        <h5 class="card-title">Plastics</h5>
                        <p class="card-text">Efficiently handle your neighborhood's waste plastic recylables schedule.</p>
                        <a href="schedule-plastics.php" class="btn btn-primary">Manage</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card" style="width: 18rem;">
                    <img src="./images/paper.jpg" class="card-img-top" alt="...">
                    <a href="https://www.freepik.com/free-photo/arrangement-different-trashed-objects_15175056.htm">Image by freepik</a>
                    <div class="card-body">
                        <h5 class="card-title">Paper</h5>
                        <p class="card-text">Efficiently handle your neighborhood's paper recyclable schedule.</p>
                        <a href="schedule-paper.php" class="btn btn-primary">Manage</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card" style="width: 18rem;">
                    <img src="./images/glass.jpg" class="card-img-top" alt="...">
                    <a href="https://www.freepik.com/free-photo/glasses-water-table_12551317.htm#fromView=search&page=1&position=7&uuid=fc94261d-92a8-4416-93c8-88836a895c96">Image by freepik</a>
                    <div class="card-body">
                        <h5 class="card-title">Glass</h5>
                        <p class="card-text">Efficiently handle your neighborhood's glass recyclable schedule.</p>
                        <a href="schedule-glass.php" class="btn btn-primary">Manage</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include('include/footer.php'); ?>
