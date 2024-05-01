<?php
include_once'header.php';
include('connection.php');
?>

<div class="bg">
    <div class="container">
    </div>
</div>

<section id="about-sec">

    <div class="container">
        <div class="row">
            <h2 class="text-center">Tahfiz School</h2>
            <br>
            <h5 class="text-center" style="font-weight: 600; font-size: 15px; color:#118f56; margin-top: -10px;">Find the best tahfiz school for your child
                <br>
                by filtering the school criteria.
            </h5>
            <hr>
            <!-- <h3 class="text-center"><br>WE NEED YOUR HELP TO HELP OTHERS</h3> -->
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <b>Search:</b>
                        <input class="form-control" name="cari" placeholder="Search by school name" type="text">
                    </div>
                </div>
        </div>
        <div class="col-md submit-button text-center">
            <input type="submit" value="Search" name="searchname" class="btn2 glyphicon-search" id="submit" style="border:none; margin: 10px 0 10px 0; transform:none;">
        </div>
        <br>

        <?php if (isset($_POST['searchname'])) {
        $search = $_POST['cari'];
        ?>
        <div class="col-md-12">
            <?php
            $list = $connection->query("SELECT * FROM schools
        WHERE school_name LIKE '%" . $search . "%' && status='Approved'");
        while ($fetch = $list->fetch_array()) {
           ?>
            <div class="row row-search-result" style="background: #ffffff; border-radius: 10px; box-shadow: 0px 0px 14px -6px rgba(0,0,0,0.54); margin-bottom: 10px;">
                <div class="col-md-2 col-sm-3 col-xs-2 hidden-xs">

                    <?php if ($fetch['file_name'] == '') { ?>
                    <img class="img-fluid" src="images/missing.png" alt="Sample image" style="height:150px; width:150px;">
                    <?php } else { ?>
                    <img class="avatar img-circle img-thumbnail" src="images/<?php echo $fetch['file_name']; ?>" alt="missing.png" style="height:150px; width:150px; ">

                    <?php } ?>
                </div>
                <div class="col-md-8 col-sm-8 col-xs-12">
                    <div class="row">
                        <div class="col-md-12 clear-fix">


                            <h3>
                                <a href="" style="font-weight: 700;">
                                    <?php echo $fetch['school_name']; ?>
                                </a>

                            </h3>
                            <p class="block black margin-b-15" style="font-weight: 500; margin: 0px 0 10px 0;" >
                                <span class="glyphicon glyphicon-map-marker"></span>
                                <?php echo $fetch['street_name']; ?>,
                                <?php echo $fetch['state']; ?>
                            </p>
                        </div>


                        <div class="col-md-3 col-sm-3 col-xs-3 font-12">
                            <img src="https://www.goodschools.com.au/images/icons/Education_sector.png" class="icon hidden-xs hidden-sm" alt="Sector">
                            <p class="bold" style="margin: 0px 0 0 0;">Sector:</p>
                            <p style="margin:0px;">
                                Independent
                            </p>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-3 font-12">
                            <img src="https://www.goodschools.com.au/images/icons/Education_level.png" class="icon hidden-xs hidden-sm" alt="Level">
                            <p class="bold" style="margin: 0px 0 0 0;">Level:</p>
                            <p style="margin:0px;">
                                <?php echo $fetch['category']; ?>
                            </p>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-3 font-12">
                            <img src="https://www.goodschools.com.au/images/icons/Co-ed.png" class="icon hidden-xs hidden-sm" alt="Coeducational">
                            <p class="bold" style="margin: 0px 0 0 0;">Gender:</p>
                            <p style="margin:0px;">
                                Coeducational
                            </p>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-3 font-12">
                        </div>
                    </div>
                </div>

                    <!-- <a class="btn btn-default btn-search-result btn-black-border btn-add-to-compare track-event-click" href="#" data-event-id="5216" data-event-name="Add compare" data-school-id="5216" data-loading-text="adding...">
                        Compare
                        <span class="glyphicon glyphicon-plus"></span>
                    </a> -->
                    <!-- <a href="#" class="btn btn-default btn-search-result btn-orange-border btn-add-to-shortlist" data-school-id="5216" data-loading-text="adding...">
                        Shortlist
                        <span class="glyphicon glyphicon-plus"></span>
                    </a> -->


            </div>
            <?php } ?>
        </div>

        <?php } else{ ?>
        <div class="col-md-12">
            <?php
            $list = $connection->query("SELECT * FROM schools WHERE status='Approved'");
        while ($fetch = $list->fetch_array()) {
           ?>
            <div class="row row-search-result" style="background: #ffffff; border-radius: 10px; box-shadow: 0px 0px 14px -6px rgba(0,0,0,0.54); margin-bottom: 10px;">
                <div class="col-md-2 col-sm-3 col-xs-2 hidden-xs">

                    <?php if ($fetch['file_name'] == '') { ?>
                    <img class="img-fluid" src="images/missing.png" alt="Sample image" style="height:150px; width:150px;">
                    <?php } else { ?>
                    <img class="avatar img-circle img-thumbnail" src="images/<?php echo $fetch['file_name']; ?>" alt="missing.png" style="height:150px; width:150px; ">

                    <?php } ?>
                </div>
                <div class="col-md-8 col-sm-8 col-xs-12">
                    <div class="row">
                        <div class="col-md-12 clear-fix">


                            <h3>
                                <a href="" style="font-weight: 700;">
                                    <?php echo $fetch['school_name']; ?>
                                </a>

                            </h3>
                            <p class="block black margin-b-15" style="font-weight: 500; margin: 0px 0 10px 0;" >
                                <span class="glyphicon glyphicon-map-marker"></span>
                                <?php echo $fetch['street_name']; ?>,
                                <?php echo $fetch['state']; ?>
                            </p>
                        </div>


                        <div class="col-md-3 col-sm-3 col-xs-3 font-12">
                            <img src="https://www.goodschools.com.au/images/icons/Education_sector.png" class="icon hidden-xs hidden-sm" alt="Sector">
                            <p class="bold" style="margin: 0px 0 0 0;">Sector:</p>
                            <p style="margin:0px;">
                                Independent
                            </p>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-3 font-12">
                            <img src="https://www.goodschools.com.au/images/icons/Education_level.png" class="icon hidden-xs hidden-sm" alt="Level">
                            <p class="bold" style="margin: 0px 0 0 0;">Level:</p>
                            <p style="margin:0px;">
                                <?php echo $fetch['category']; ?>
                            </p>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-3 font-12">
                            <img src="https://www.goodschools.com.au/images/icons/Co-ed.png" class="icon hidden-xs hidden-sm" alt="Coeducational">
                            <p class="bold" style="margin: 0px 0 0 0;">Gender:</p>
                            <p style="margin:0px;">
                                Coeducational
                            </p>
                        </div>
                        <!-- <div class="col-md-3 col-sm-3 col-xs-3 font-12">
                        </div> -->
                    </div>
                </div>
                <!-- <div class="col-md-2 col-sm-12 col-xs-12 margin-t-50 tablet-margin-t-10 mobile-margin-t-10" style="margin-top: 60px;"> -->
                    <!-- <a class="btn btn-default btn-search-result btn-black-border btn-add-to-compare track-event-click" href="#" data-event-id="5216" data-event-name="Add compare" data-school-id="5216" data-loading-text="adding...">
                        Compare
                        <span class="glyphicon glyphicon-plus"></span>
                    </a> -->
                    <!-- <a href="#" class="btn btn-default btn-search-result btn-orange-border btn-add-to-shortlist" data-school-id="5216" data-loading-text="adding...">
                        Shortlist
                        <span class="glyphicon glyphicon-plus"></span>
                    </a> -->
                <!-- </div> -->

            </div>
            <?php } ?>
        </div>
        <?php } ?>
    </div>
    <br>
</section>
<?php include_once'footer.php';
  ?>
