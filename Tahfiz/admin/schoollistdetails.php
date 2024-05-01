<?php
    include_once'../admin/header.php';
?>
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-12 grid-margin">

                <div class="card">
                    <form action="schoollistdetails2.php" method="post" class="form-sample">
                        <div class="card-header">
                            <strong>Schools</strong> Details
                        </div>

                        <div class="card-body card-block">
                            <?php
                 $sch = $connection->query("SELECT * FROM schools WHERE status='approved' && schools_ID='".$_GET['schools_ID']."'");
                 while($row2 = $sch->fetch_array()){
                         ?>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="disabled-input" class="form-control-label" style="margin-top:5px;">School ID</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="disabled-input" name="schools_ID" value="<?php echo $row2['schools_ID'];?>"  class="form-control">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label" style="margin-top:5px;">School Name</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="text-input" name="school_name" value="<?php echo $row2['school_name'];?>" disabled="" class="form-control">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label" style="margin-top:5px;">Email</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="text-input" name="email" value="<?php echo $row2['email'];?>" disabled="" class="form-control">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label" style="margin-top:5px;">Password</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="text-input" name="password" value="<?php echo $row2['password'];?>" disabled="" class="form-control">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label" style="margin-top:5px;">Phone Number</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="text-input" name="phonenum" value="<?php echo $row2['phonenum'];?>" disabled="" class="form-control">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label" style="margin-top:5px;">Address</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="text-input" name="street_name" value="<?php echo $row2['street_name'];?>" disabled="" class="form-control">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label" style="margin-top:5px;">State</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="text-input" name="state" value="<?php echo $row2['state'];?>" disabled="" class="form-control">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label" style="margin-top:5px;">Postcode</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="text-input" name="postcode" value="<?php echo $row2['postcode'];?>" disabled="" class="form-control">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label" style="margin-top:5px;">Registration Number</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="text-input" name="register_no" value="<?php echo $row2['register_no'];?>" disabled="" class="form-control">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="textarea-input" class=" form-control-label" style="margin-top:5px;">Description</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <textarea name="descriptions" id="textarea-input" rows="9" placeholder="" disabled="" class="form-control"><?php echo $row2['descriptions'];?></textarea>
                                </div>
                            </div>
                            <?php }?>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="select" class=" form-control-label" style="margin-top:5px; color:#c46b02; font-weight: 500;">Approval Status</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <select name="stat" id="status" class="form-control">
                                        <option>Status</option>
                                        <option value="Pending" style="color:#4285F4;">Pending</option>
                                        <option value="Approved" style="color:#0F9D58;">Approve</option>
                                        <option value="Rejected" style="color:#DB4437;">Reject</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="card-footer">
                            <button type="submit" name="submit" class="btn btn-primary btn-sm">
                                <i class="fas fa-check"></i> Submit
                            </button>
                            <button type="reset" value="Reset" class="btn btn-danger btn-sm">
                                <i class="fas fa-sync-alt"></i> Revert
                            </button>
                        </div>
                    </form>
                </div>
                <br />
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
