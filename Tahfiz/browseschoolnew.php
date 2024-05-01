<?php
include_once'header.php';
include('connection.php');
?>

<section id="about-sec">
    <div class="container">
      <div class="row">
          <h2 class="text-center">FIND A SCHOOL</h2>
          <hr>
          <!-- <br> -->
          <!-- <h5>Choose school stage:</h5> -->
          <!-- <h3><br>WE NEED YOUR HELP TO HELP OTHERS</h3> -->
          <form action="" method="post">
              <div class="row">
                  <div class="col-md-4 col-md-offset-4">
                    <b>Search by name:</b>
                      <input class="form-control" name="cari" placeholder="Search by school name" type="text">
                  </div>
              </div>
      </div>
      <div class="col-md submit-button text-center">
          <input type="submit" value="Search by name" name="search" class="btn2 glyphicon-search" id="submit" style="border:none; margin: 10px 0 10px 0; transform:none;">
      </div>

      <div class="row">
              <div class="col-xs-3 col-md-offset-3" style="margin-bottom: 10px;">
                  <select class="form-control" name="level">
                      <option value="0" selected="selected">
                          Select Level...
                      </option>
                      <?php
                      $level = $connection->query("SELECT DISTINCT category_name FROM school_category");
                      while($fetch = $level->fetch_array()){ ?>
                      <option value="<?php echo $fetch['category_name'];?>">
                          <?php echo $fetch['category_name'];?>
                      </option>
                      <?php } ?>
                  </select>
              </div>

              <div class="col-xs-3">
                  <select class="form-control" name="state">
                      <option value="0" selected="selected">
                          Select State..
                      </option>
                      <?php
                      $state = $connection->query("SELECT DISTINCT school_liststate FROM school_list");
                      while($fetch = $state->fetch_array()){ ?>
                      <option value="<?php echo $fetch['school_liststate'];?>">
                          <?php echo $fetch['school_liststate'];?>
                      </option>
                      <?php } ?>

                  </select>
              </div>
      </div>
      <div class="col-md submit-button text-center">
          <input type="submit" value="Filter by school level & state" name="search" class="btn2 glyphicon-search" id="submit" style="border:none; margin: 0px 0 0px 0; transform:none;">
          <br>
          <input type="submit" value="Filter All" name="search" class="btn2 glyphicon-search" id="submit" style="border:none; margin: 10px 0 0px 0; transform:none; background: #118f56;">
      </div>
      <br>
      <?php
      $sch = $connection->query("SELECT * FROM schools WHERE status='approved'");
      while ($fetch = $sch->fetch_array()) {
          ?>
        <div class="col-md-12">
            <div class="row row-search-result">
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
                              <a href="/compare-schools/in-Arundel-4214/ab-paterson-college" style="font-weight: 500;">
                                    <?php echo $fetch['school_name']; ?>
                                  </a>

                            </h3>
                            <p class="block black margin-b-15" style="margin: 0px 0 10px 0;" style="font-weight: 500;">
                              <span class="glyphicon glyphicon-map-marker"></span>
                                <?php echo $fetch['street_name']; ?>, <?php echo $fetch['state']; ?>
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
                                <?php echo $fetch['category_name']; ?>
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
                <div class="col-md-2 col-sm-12 col-xs-12 margin-t-50 tablet-margin-t-10 mobile-margin-t-10">
                    <a class="btn btn-default btn-search-result btn-black-border btn-add-to-compare track-event-click" href="#" data-event-id="5216" data-event-name="Add compare" data-school-id="5216" data-loading-text="adding...">
                        Compare
                        <span class="glyphicon glyphicon-plus"></span>
                    </a>
                    <a href="#" class="btn btn-default btn-search-result btn-orange-border btn-add-to-shortlist" data-school-id="5216" data-loading-text="adding...">
                        Shortlist
                        <span class="glyphicon glyphicon-plus"></span>
                    </a>
                </div>

            </div>

        </div>
        <?php } ?>
    </div>
</section>

<?php include_once'footer.php';
?>
