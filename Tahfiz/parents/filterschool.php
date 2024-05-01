<?php
include_once'../parents/header.php';
include('connection.php');

?>

<div class="bg">
    <div class="container">
    </div>
</div>

<!-- <section id="about-sec" style="margin: 0px 0;"> -->
<section id="about-sec">
    <div class="container">
        <div class="row">
            <h2 class="text-center">SEARCH & COMPARE SCHOOL</h2>
            <br>
            <h5 class="text-center" style="font-weight: 600; font-size: 15px; color:#118f56; margin-top: -10px;">Find the best tahfiz school for your child
                <br>
                by comparing and filtering the school criteria.
            </h5>
            <hr>
            <!-- <h3 class="text-center"><br>WE NEED YOUR HELP TO HELP OTHERS</h3> -->
            <form action="" method="post">
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <b>Search by name:</b>
                        <input class="form-control" name="cari" placeholder="Search by school name" type="text">
                    </div>
                </div>
        </div>
        <div class="col-md submit-button text-center">
            <input type="submit" value="Search by School Name" name="searchname" class="btn2 glyphicon-search" id="submit" style="border:none; margin: 10px 0 10px 0; transform:none;">
        </div>

        <div class="col-md submit-button text-center">
            <input type="submit" value="Search All" name="searchall" class="btn2 glyphicon-search" id="submit" style="border:none; margin: 0px 0 0px 0; transform:none; background: #118f56;">
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
            <div class="row row-search-result">
                <div class="col-md-2 col-sm-3 col-xs-2 hidden-xs">

                    <?php if ($fetch['file_name'] == '') { ?>
                    <img class="img-fluid" src="../images/missing.png" alt="Sample image" style="height:150px; width:150px;">
                    <?php } else { ?>
                    <img class="avatar img-circle img-thumbnail" src="../images/<?php echo $fetch['file_name']; ?>" alt="missing.png" style="height:150px; width:150px; ">

                    <?php } ?>
                </div>
                <div class="col-md-8 col-sm-8 col-xs-12">
                    <div class="row">
                        <div class="col-md-12 clear-fix">


                            <h3>
                                <a href="/compare-schools/in-Arundel-4214/ab-paterson-college" style="font-weight: 700;">
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
                <div class="col-md-2 col-sm-12 col-xs-12 margin-t-50 tablet-margin-t-10 mobile-margin-t-10" style="margin-top: 60px;">
                    <a class="btn cd-add-to-cart" href="#0" data-price="<?php echo $fetch['schools_ID']; ?>," data-event-id="5216" data-event-name="Add compare" data-school-id="5216" data-loading-text="adding...">
                        Compare
                        <span class="glyphicon glyphicon-plus"></span>
                    </a>
                    <!-- <a href="#" class="btn btn-default btn-search-result btn-orange-border btn-add-to-shortlist" data-school-id="5216" data-loading-text="adding...">
                        Shortlist
                        <span class="glyphicon glyphicon-plus"></span>
                    </a> -->
                </div>

            </div>
            <?php } ?>
        </div>



        <?php } else{ ?>
        <div class="col-md-12">
            <?php
            $list = $connection->query("SELECT * FROM schools WHERE status='Approved'");
        while ($fetch = $list->fetch_array()) {
           ?>
            <div class="row row-search-result">
                <div class="col-md-2 col-sm-3 col-xs-2 hidden-xs">

                    <?php if ($fetch['file_name'] == '') { ?>
                    <img class="img-fluid" src="../images/missing.png" alt="Sample image" style="height:150px; width:150px;">
                    <?php } else { ?>
                    <img class="avatar img-circle img-thumbnail" src="../images/<?php echo $fetch['file_name']; ?>" alt="missing.png" style="height:150px; width:150px; ">

                    <?php } ?>
                </div>
                <div class="col-md-8 col-sm-8 col-xs-12">
                    <div class="row">
                        <div class="col-md-12 clear-fix">


                            <h3>
                                <a href="/compare-schools/in-Arundel-4214/ab-paterson-college" style="font-weight: 700;">
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
                <div class="col-md-2 col-sm-12 col-xs-12 margin-t-50 tablet-margin-t-10 mobile-margin-t-10" style="margin-top: 60px;">
                    <a class="btn cd-add-to-cart" id="<?php echo $fetch['schools_ID'];
                    $schools_ID[] = $fetch['schools_ID']; $loop = 0;
                   ?>," data-event-id="5216" data-event-name="Add compare" data-school-id="5216" data-loading-text="adding...">
                        Compare
                        <span class="glyphicon glyphicon-plus"></span>
                    </a>

                    <!-- <a href="#" class="btn btn-default btn-search-result btn-orange-border btn-add-to-shortlist" data-school-id="5216" data-loading-text="adding...">
                        Shortlist
                        <span class="glyphicon glyphicon-plus"></span>
                    </a> -->
                </div>

            </div>
            <?php   $loop = $loop+1; } ?>
        </div>
        <?php } ?>
    </div>



    <div class="cd-cart-container empty">
        <a href="#0" class="cd-cart-trigger">
            <ul class="count">
                <!-- cart items count -->
                <li>0</li>
                <li>0</li>
            </ul> <!-- .count -->
        </a>

        <div class="cd-cart">
            <div class="wrapper">
                <header>
                    <hk>Cart</hk>
                    <span class="undo">Item removed. <a href="#0">Undo</a></span>
                </header>

                <div class="body">
                    <?php
            $list = $connection->query("SELECT * FROM schools WHERE status='Approved' AND schools_ID = '$schools_ID[$loop]'");
        while ($fetch = $list->fetch_array()) {
           ?>
                    <ul>
                        <li class="product">
                            <div class="product-image"><a href="#0"><img src="images/<?php echo $fetch['file_name']; ?>" alt="placeholder" style="height: 100px; width: 100px;"></a></div>
                            <div class="product-details">
                                <hk>
                                    <?php echo $fetch['school_name']; ?>
                                </hk>
                                <div class="actions"><a href="#0" class="delete-item">Delete</a></div>
                        </li>
                    </ul>
                    <?php } ?>
                </div>

                <footer>
                    <a href="#0" class="checkout">COMPARE</a>
                </footer>
            </div>
        </div> <!-- .cd-cart -->
    </div> <!-- cd-cart-container -->
    <br>
</section>


<?php include_once'footer.php';
?>
