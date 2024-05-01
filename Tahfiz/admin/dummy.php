<?php
    include_once'../admin/header.php';
?>

<div class="main-panel">
        <div class="content-wrapper">
             <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Approval Request</h4>
                      <p class="card-description">
                       Approval Request - Send email
                      </p>

                      <?php
                      if (isset($_POST['submit'])) {
                          if (mail($_POST['email'], $_POST['subject'], $_POST['message']))
                          {
                              echo "<script type='text/javascript'>alert('Your email has sent!.');
                            window.location='schoolauth.php';
            </script>";
                          }
                          else
                          {
                              echo"failed!";                          }
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
                              <textarea type="text" name="message" class="form-control" id="exampleInputPassword2" placeholder="enter message" rows="5">Your registration is now approved by us. You are now can login to our website. Here is your detail for login:
Email: <?php echo $row2['email'];?>
Password:<?php echo $row2['password'];?> &nbsp;
http://localhost/tahfiz/logintahfiz.php
                              </textarea>
                          </div>
                        </div>
                        <button type="submit" name="submit" class="btn btn-success mr-2">Submit</button>
                        <button class="btn btn-light">Cancel</button>
                      </form>
                        <?php } ?>
                    </div>
                  </div>
                </div>
        </div>

<?php
    include_once'../admin/footer.php';
?>
