<?php
    include_once'../admin/header.php';
?>
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-header">
                    <strong>Approval</strong> Confirmation - Send Email
                </div>
                <div class="card-body">

                  <?php
                  if (isset($_POST['submit'])) {
                      if (mail($_POST['email'], $_POST['subject'], $_POST['message']))
                      {
                          echo "<script type='text/javascript'>alert('Your email has sent!');
                        window.location='schoolauth.php';
        </script>";
                      }
                      else
                      {
                          echo"Failed!";                          }
                  }
                  ?>

                   <?php
                    $sch = $connection->query("SELECT * FROM schools WHERE schools_ID='".$_GET['schools_ID']."'");
                    while($row2 = $sch->fetch_array()){
                ?>
                  <form class="forms-sample" method="post" action="">
                    <div class="form-group row">
                      <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Email</label>
                      <div class="col-sm-9">
                        <input type="email" name="email" class="form-control" id="exampleInputEmail2" placeholder="enter email" value="<?php echo $row2['email'];?>">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Subject</label>
                      <div class="col-sm-9">
                          <input type="text" name="subject" class="form-control" id="exampleInputPassword2" placeholder="enter subject" value="Approval Status">
                      </div>
                    </div>
                      <div class="form-group row">
                      <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Message</label>
                      <div class="col-sm-9">
                          <textarea type="text" name="message" class="form-control" id="exampleInputPassword2" placeholder="enter message" rows="5">Your registration is now approved. Now, you are able to login to Tahfiz Care.
Here is your login details:

Email: <?php echo $row2['email'];?> &nbsp;
Password: <?php echo $row2['password'];?> &nbsp;
Link: http://localhost/tahfiz/logintahfiz.php
                          </textarea>
                      </div>
                    </div>
                    <button type="submit" name="submit" class="btn btn-success mr-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                  </form>
                    <?php } ?>
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
