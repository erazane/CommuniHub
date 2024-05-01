<?php
    include_once'../admin/header.php';
?>
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-12 grid-margin">

                <div class="card">
                    <form action="" method="post" class="form-sample">
                        <div class="card-header">
                            <strong>Members</strong> Information
                        </div>

                        <div class="card-body card-block">
                            <?php
                 $sch = $connection->query("SELECT * FROM parents WHERE parents_ID='".$_GET['parents_ID']."'");
                 while($row2 = $sch->fetch_array()){
                         ?>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="disabled-input" class="form-control-label" style="margin-top:5px;">Members ID</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="disabled-input" name="disabled-input" value="<?php echo $row2['parents_ID'];?>" disabled="" class="form-control">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label" style="margin-top:5px;">Name</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="text-input" name="school_name" value="<?php echo $row2['firstname'];?> <?php echo $row2['lastname'];?>" disabled="" class="form-control">
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
                                    <input type="password" id="text-input" name="password" value="<?php echo $row2['password'];?>" disabled="" class="form-control">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label" style="margin-top:5px;">Phone Number</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="text-input" name="phonenum" value="<?php echo $row2['phoneno'];?>" disabled="" class="form-control">
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
                                    <label for="text-input" class=" form-control-label" style="margin-top:5px;">IC Number</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="text-input" name="ic_number" value="<?php echo $row2['ic_number'];?>" disabled="" class="form-control">
                                </div>
                            </div>
                            <?php }?>

                        </div>
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
