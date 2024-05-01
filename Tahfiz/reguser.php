<?php include_once'header.php';
?>

<section id="about-sec">
    <div class="container">
        <form method="post" action="reguser2.php">
            <div class="row text-center">
                <h2 style="margin-top:1;">Members Registration<br>

                </h2>
                <hr>
            </div>

            <div class="row">
                <div class="col-md-6 form-group">
                    <label>First Name:</label>
                    <input type="text" name="firstname" size="40" class="form-control" aria-required="true" aria-invalid="false" placeholder="">
                </div>
                <div class="col-md-6 form-group">
                    <label>Last Name:</label>
                    <input type="text" name="lastname" size="40" class="form-control" aria-required="true" aria-invalid="false" placeholder="">
                </div>
                <div class="col-md-6 form-group">
                    <label>IC Number:</label>
                    <input type="text" name="icnumber" size="40" class="form-control" aria-required="true" aria-invalid="false" placeholder="">
                </div>
                <div class="col-md-6 form-group">
                    <label>Phone Number:</label>
                    <input type="text" name="phoneno" size="40" class="form-control" aria-required="true" aria-invalid="false" placeholder="">
                </div>
                <div class="col-md-6 form-group">
                    <label>Email Address:</label>
                    <input type="text" name="email" size="40" class="form-control" aria-required="true" aria-invalid="false" placeholder="">
                </div>
                <div class="col-md-6 form-group">
                    <label>Password:</label>
                    <input type="text" name="password" size="40" class="form-control" aria-required="true" aria-invalid="false" placeholder="">
                </div>
                <div class="col-md-6 form-group">
                    <label>Street:</label>
                    <input type="text" name="street" size="40" class="form-control" aria-required="true" aria-invalid="false" placeholder="">
                </div>
                <div class="col-md-6 form-group">
                    <label>State:</label>
                    <input type="text" name="state" size="40" class="form-control" aria-required="true" aria-invalid="false" placeholder="">
                </div>
                <div class="col-md-6 form-group">
                    <label>City:</label>
                    <input type="text" name="city" size="40" class="form-control" aria-required="true" aria-invalid="false" placeholder="">
                </div>
                <div class="col-md-6 form-group">
                    <label>Postcode:</label>
                    <input type="text" name="postcode" size="40" class="form-control" aria-required="true" aria-invalid="false" placeholder="">
                </div>

                <div class="col-xs-12 submit-button text-center">
                    <input type="submit" value="Register" class="btn2" name="reg_user" style="border:none; margin: 20px 0 0 0">
                </div>
            </div>
    </div>
</section>

<?php include_once'footer.php';
?>
