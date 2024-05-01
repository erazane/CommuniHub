<?php
include_once'../parents/header.php';
?>

<div class="bg">
    <div class="container">
    </div>
</div>

<section id="about-sec">
    <div class="container">
        <div class="row">
          <div class="col-lg-3">
              <ul id="menu-dashboard" class="nav nav-pills nav-stacked" style="padding-left: 0px; width: 100%; margin-right: 0px;">
                  <li><a href="index.php"><span class="icon-home4"></span> <span class="hidden-xs">Dashboard</span></a></li>
                  <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="collapse" data-target="#submenu" aria-expanded="false">
                          <span class="icon-link2"></span>
                          Tahfiz School<span class="caret" style="margin-left: 5px;"></span></a>
                      <ul class="nav collapse" id="submenu" role="menu" aria-labelledby="btn-1" style="padding-left: 0px;">
                          <li class="active"><a href="listschool.php">List of Tahfiz School</a></li>
                          <li><a href="favoriteview.php">Favorited Tahfiz School</a></li>
                      </ul>
                  </li>
                  <li><a href="editprofileside.php"><span class="icon-user3"></span> <span class="hidden-xs">Profile</span></a></li>
                  <li><a href="editpaymentside.php"><span class="icon-search-2"></span> <span class="hidden-xs">Bank Details</span></a></li>
              </ul>
          </div>
          <div class="col-md-8">
              <?php
                     $admin = $connection->query("SELECT * FROM parents WHERE parents_ID='".$_SESSION['parents_ID']."'");
                     while($row2 = $admin->fetch_array()){
              ?>
              <h5>
                  View school profile and mark as favorite.</h5>
              <hr style="margin-left: 0px; width: 350px;">
          </div>
          <div class="col-md-8">
            <table class="table table-striped table-borderless">
              <thead>
                  <tr>
                      <th style="padding-left: 20px; font-weight: 600;">School ID</th>
                      <th style="font-weight: 600;">School Name</th>
                      <th style="font-weight: 600;">State</th>

                      <th style="font-weight: 600;">Details</th>
                  </tr>
              </thead>
              <tbody>
                  <tr>
                    <?php
   $don = $connection->query("SELECT * FROM schools WHERE status = 'Approved'");
   while($row2 = $don->fetch_array()){
           ?>
                      <td style="font-size: 15px; padding-left: 20px; font-weight: 500;"><?php echo $row2['schools_ID'];?></td>
                      <td style="font-size: 15px; font-weight: 500;"><?php echo $row2['school_name'];?></td>
                      <td style="font-size: 15px; font-weight: 500;"><?php echo $row2['state'];?></td>
                      <td><a class="btn btn-primary btn-sm" style="font-size: 13px; font-weight: 500; border-radius: 4px; background: #19a164; border-color: #12774a;" href="schoolprofile.php?schools_ID=<?php echo $row2['schools_ID'] ?>">View</a></td>
                  </tr>
                  <?php } ?>
              </tbody>
            </table>
          </div>



          <?php } ?>
        </div>
        <br>

    </div>
</section>

<?php
include_once'../parents/footer.php';
?>
