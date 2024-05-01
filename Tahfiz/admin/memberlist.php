<?php
    include_once'../admin/header.php';
?>
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
          <div class="row">
              <div class="col-md-12">
                  <div class="overview-wrap">
                      <h2 class="title-1">Registered Members List</h2>

                  </div>
              </div>
          </div>
          <div class="row m-t-30">
              <div class="col-md-12">
                  <!-- DATA TABLE-->
                  <div class="table-responsive m-b-40">
                      <table class="table table-borderless table-data3">
                          <thead>
                              <tr>

                                  <th>Members ID</th>
                                  <th>Members Name</th>
                                  <th>Email</th>
                                  <th>Phone Number</th>
                                  <th>Details</th>
                              </tr>

                          </thead>
                          <tbody>
                              <tr>
                                <?php
               $par = $connection->query("SELECT * FROM parents");
               while($row2 = $par->fetch_array()){
                       ?>
                                  <td><?php echo $row2['parents_ID'];?></td>
                                  <td><?php echo $row2['firstname'];?> <?php echo $row2['lastname'];?></td>
                                  <td><?php echo $row2['email'];?></td>
                                  <td><?php echo $row2['phoneno'];?></td>
                                  <td><a class="btn btn-outline-primary btn-sm" href="memberlistdetails.php?parents_ID=<?php echo $row2['parents_ID'];?>">View</a></td>
                              </tr>
                              <?php } ?>
                          </tbody>
                      </table>
                  </div>
                  <!-- END DATA TABLE-->
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
