<?php
include_once'../parents/header.php';
?>

<div class="bg">
    <div class="container">
    </div>
</div>

<section id="about-sec">
    <div class="container">
        <div class="row text-center">
            <h2>Donate</h2>
            <hr>
            <h5>You can choose which school do you want to donate to here</h5>
            <br>

        </div>
        <?php
        $sch = $connection->query("SELECT * FROM schools WHERE status='Approved'");
        while ($fetch = $sch->fetch_array()) {
            ?>

            <div class="row text-center">
                <div class="item col-lg-4">
                    <div class="thumbnail">
                      <div style="border-color: black;" class="overlay rounded mb-4">
                        <br>
                        <?php if ($fetch['file_name'] == '') { ?>
                            <img class="img-fluid" src="../images/missing.png" alt="Sample image" style="height:150px; width:150px;">
                        <?php } else { ?>
                            <img class="img-fluid" src="../images/<?php echo $fetch['file_name']; ?>" alt="missing.png" style="height:150px; width:150px;"/>
                        <?php } ?>
                      </div>

                            <h4><?php echo $fetch['school_name']; ?></h4>
                            <p><?php echo $fetch['email']; ?></p>
                            <p class="lead">$21.000</p>
                            <a class="btn2" style="margin-left:0px;" href="profileorg.php?Org_ID=<?php echo $fetch['Org_ID'] ?>">View profile</a>

                    </div>
                </div>
                <?php } ?>
            </div>

    </div>
</section>
<?php
include_once'../parents/footer.php';
?>
