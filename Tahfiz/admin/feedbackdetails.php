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
                      <?php
                     if (isset($_POST['sendmail'])) {
                         if (mail($_POST['email'], $_POST['subject'], $_POST['respond']))
                         {
                             echo "<script type='text/javascript'>alert('Your respond has been sent!');
                           window.location='feedback.php';
           </script>";
                         }
                         else
                         {
                             echo"Failed!";                          }
                     }
                     ?>
                        <div class="card-header">
                            <strong>Feedback</strong> Details
                        </div>

                        <div class="card-body card-block">
                            <?php
                 $feed = $connection->query("SELECT * FROM feedback");
                 while($row2 = $feed->fetch_array()){
                         ?>

                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label" style="margin-top:5px;">Name</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="text-input" name="name" value="<?php echo $row2['name'];?>" class="form-control">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label" style="margin-top:5px;">Email</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="text-input" name="email" value="<?php echo $row2['email'];?>" class="form-control">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label" style="margin-top:5px;">Subject</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="text-input" name="subject" value="<?php echo $row2['subject'];?>" class="form-control">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label" style="margin-top:5px;">Date Sent</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="text-input" name="date" value="<?php echo $row2['date'];?>" class="form-control">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="textarea-input" class=" form-control-label" style="margin-top:5px;">Message</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <textarea name="message" id="textarea-input" rows="9" placeholder="" class="form-control"><?php echo $row2['message'];?></textarea>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="textarea-input" class=" form-control-label" style="margin-top:5px;">Respond</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <textarea name="respond" id="textarea-input" rows="9" placeholder="" class="form-control"></textarea>
                                </div>
                            </div>


                        </div>
                        <div class="card-footer">
                            <button type="submit" name="sendmail" class="btn btn-primary btn-sm">
                                <i class="fas fa-check"></i> Submit
                            </button>
                            <button type="reset" value="Reset" class="btn btn-danger btn-sm">
                                <i class="fas fa-sync-alt"></i> Revert
                            </button>
                        </div>
                        <?php }?>
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
