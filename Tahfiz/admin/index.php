<?php
    include_once'../admin/header.php';
?>
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <!-- <div class="row">
                <div class="col-md-12">
                    <div class="overview-wrap">
                        <h2 class="title-1">overview</h2>

                    </div>
                </div>
            </div> -->
            <div class="row m-t-25">
                <div class="col-sm-6 col-lg-3">
                  <?php $sch = $connection->query("SELECT COUNT(schools_ID) AS totalusers FROM schools");
                 while($fetch = $sch->fetch_array()){ ?>
                    <div class="overview-item overview-item--c0">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon">
                                    <i class="far fa-school" style="color: #00b5e9;"></i>
                                </div>
                                <div class="text">
                                    <h2><?php echo $fetch['totalusers'];?></h2>
                                    <span style="font-size: 16px; font-weight: 500;">Registered Schools</span>
                                </div>
                            </div>
                            <!-- <div class="overview-chart">
                                <canvas id="widgetChart1"></canvas>
                            </div> -->
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <div class="col-sm-6 col-lg-3">
                  <?php $user = $connection->query("SELECT COUNT(parents_ID) AS totalusers FROM parents");
                 while($fetch = $user->fetch_array()){ ?>
                    <div class="overview-item overview-item--c0">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon">
                                    <i class="far fa-users" style="color: #fa4251;"></i>
                                </div>
                                <div class="text">
                                    <h2><?php echo $fetch['totalusers'];?></h2>
                                    <span style="font-size: 16px; font-weight: 500;">Registered Members</span>
                                </div>
                            </div>
                            <!-- <div class="overview-chart">
                                <canvas id="widgetChart2"></canvas>
                            </div> -->
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <div class="col-sm-6 col-lg-3">
                  <?php $user = $connection->query("SELECT COUNT(event_ID) AS totalevents FROM event");
                 while($fetch = $user->fetch_array()){ ?>
                    <div class="overview-item overview-item--c0">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon">
                                    <i class="far fa-calendar-alt" style="color: #b947bf;"></i>
                                </div>
                                <br />
                                <div class="text">
                                    <h2><?php echo $fetch['totalevents'];?></h2>
                                    <span style="font-size: 16px; font-weight: 500;">Events Added</span>
                                </div>
                            </div>
                            <!-- <div class="overview-chart">
                                <canvas id="widgetChart3"></canvas>
                            </div> -->
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <div class="col-sm-6 col-lg-3">
                  <?php $user = $connection->query("SELECT SUM(don_amount) AS `total_donate` FROM donationpayment");
                 while($fetch = $user->fetch_array()){ ?>
                    <div class="overview-item overview-item--c0">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon">
                                    <i class="far fa-badge-dollar" style="color: #00ad5f;"></i>
                                </div>
                                <div class="text">
                                    <h2>RM <?php echo $fetch['total_donate'];?></h2>
                                    <span style="font-size: 16px; font-weight: 500;">Online Donation Made</span>
                                </div>
                            </div>
                            <!-- <div class="overview-chart">
                                <canvas id="widgetChart4"></canvas>
                            </div> -->
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <div class="col-sm-6 col-lg-3">
                  <?php $user = $connection->query("SELECT SUM(don_amount) AS `total_donate` FROM donationpaymentoffline");
                 while($fetch = $user->fetch_array()){ ?>
                    <div class="overview-item overview-item--c0">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon">
                                    <i class="far fa-badge-dollar" style="color: #ff7a00;"></i>
                                </div>
                                <div class="text">
                                    <h2>RM <?php echo $fetch['total_donate'];?></h2>
                                    <span style="font-size: 16px; font-weight: 500;">Offline Donation Made</span>
                                </div>
                            </div>
                            <!-- <div class="overview-chart">
                                <canvas id="widgetChart4"></canvas>
                            </div> -->
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <!-- <div class="col-lg-6">
                    <div class="au-card chart-percent-card">
                        <div class="au-card-inner">
                            <h3 class="title-2 tm-b-5">char by %</h3>
                            <div class="row no-gutters">
                                <div class="col-xl-6">
                                    <div class="chart-note-wrap">
                                        <div class="chart-note mr-0 d-block">
                                            <span class="dot dot--blue"></span>
                                            <span>products</span>
                                        </div>
                                        <div class="chart-note mr-0 d-block">
                                            <span class="dot dot--red"></span>
                                            <span>services</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="percent-chart">
                                        <canvas id="percent-chart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
            <!-- <div class="row">
                <div class="col-lg-6">
                    <div class="au-card recent-report">
                        <div class="au-card-inner">
                            <h3 class="title-2">recent reports</h3>
                            <div class="chart-info">
                                <div class="chart-info__left">
                                    <div class="chart-note">
                                        <span class="dot dot--blue"></span>
                                        <span>products</span>
                                    </div>
                                    <div class="chart-note mr-0">
                                        <span class="dot dot--green"></span>
                                        <span>services</span>
                                    </div>
                                </div>
                                <div class="chart-info__right">
                                    <div class="chart-statis">
                                        <span class="index incre">
                                            <i class="zmdi zmdi-long-arrow-up"></i>25%</span>
                                        <span class="label">products</span>
                                    </div>
                                    <div class="chart-statis mr-0">
                                        <span class="index decre">
                                            <i class="zmdi zmdi-long-arrow-down"></i>10%</span>
                                        <span class="label">services</span>
                                    </div>
                                </div>
                            </div>
                            <div class="recent-report__chart">
                                <canvas id="recent-rep-chart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

            </div> -->
            <div class="row">
                <div class="col-md-12">
                    <div class="copyright">
                        <p>Copyright © 2018 <a href="index.php">Tahfiz Care</a>. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
<!-- END PAGE CONTAINER-->
</div>

</div>

<?php
    include_once'../admin/footer.php';
?>
