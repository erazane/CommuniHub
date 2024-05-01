<?php include_once'header.php';
?>

<section id="about-sec">
    <div class="container">
        <div class="row text-center">
            <img class="avatar" src="images/missing.png" alt="Sample image" style="height:100px; width:100px;">
            <h2>Member Login</h2>
            <br />
            <!-- <h3><br>WE NEED YOUR HELP TO HELP OTHERS</h3> -->
            <form method="post" action="login2.php">
        </div>
        <div class="row">
            <div class="col-md-4 col-md-offset-4 form-group">
                <label>Email:</label>
                <input type="text" name="email" size="40" class="form-control" aria-required="true" aria-invalid="false" placeholder="">
            </div>
            <div class="col-md-4 col-md-offset-4">
                <label>Password:</label>
                <input type="password" name="password" size="40" class="form-control" aria-required="true" aria-invalid="false" placeholder="">
            </div>

            <div class="col-md-4 col-md-offset-4 text-center">
                <a style="margin-left:-240px; font-weight: 500;" href="reguser.php">Create an account</a>
            </div>

            <div class="col-xs-12 submit-button text-center">
                <input type="submit" value="Login" class="btn2" name="login_user" style="border:none; margin: 20px 0 0 0">
            </div>

        </div>
    </div>
</section>

<!-- <div class="callout">
<div class="container">
		<div class="row">
			<div class="col-md-6">
				<h2>Change Their World. Change Yours. This changes everything.</h2>
			</div>

			<div class="col-md-6">
				<div class="callout-actions">
					<a href="contact.html" class="button">Become Volunteer</a>

					<span class="callout-separator">
						<span>Or</span>
					</span>

					<a href="donate.html" class="button">Donate For Cause</a>
				</div>
			</div>
		</div>
</div>
</div> -->

<?php include_once'footer.php';
?>
