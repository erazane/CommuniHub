<?php include_once'header.php';
?>

<div class="bg">

	<!-- Content -->
	<div class="container">
		<!--Grid row-->
		<div class="row">

			<div class="col-md-6 col-xl-5 mt-xl-5 wow fadeInRight" data-wow-delay="0.3s">
				<img src="" alt="" class="img-fluid">
			</div>
			<!--Grid column-->
		</div>
		<!--Grid row-->
	</div>
	<!-- Content -->
</div>

<section id="about-sec">
	<div class="container">
		<div class="row text-center">
			<br>
			<h3>Filter your school:</h3>
				<br>
			<!-- <br> -->
			<!-- <h5>Choose school stage:</h5> -->
			<!-- <h3><br>WE NEED YOUR HELP TO HELP OTHERS</h3> -->
			<form action="" method="post">
<div class="center-on-page">
			<div class="col-md-3">
				<div class="center-on-page">
					<select id="" name="school">
		
						<?php
						$category = $connection->query("SELECT * FROM school_category");
						while ($row = $category->fetch_array()){ ?>
						<option value="<?php echo $row['school_catID'];?>"><?php $row['category_name'];?></option>
					<?php } ?>
					</select>
				</div>



			             <!-- <select class="col-sm 3" name="category" id="cat">
			                 <option>Select category..</option>
			                    <option>Primary</option>
													 <option>Secondary</option>
			             </select> -->
			</div>

		  <div class="col col-lg-2">
				<div class="center-on-page">
					 <select id="monthlyfees" name="monthly">
						 <option value=""><a href="https://www.jqueryscript.net/menu/">Select Monthly Fees</a></option>
						 <option value="100-200">RM 100 - RM 200</option>
						 <option value="201-300">RM 201 - RM 300</option>
						 <option value="301-400">RM 301 - RM 400</option>
					 </select>
				</div>
			             <!-- <select class=" " name="fees" id="fees">
			                 <option>Select monthly fees..</option>
			                     <option>RM 280.00</option>
													  <option>RM 170.00</option>
														 <option>RM 150.00</option>
														  <option>RM 120.00</option>
			             </select> -->
			</div>

			<div class="col-md-3">
				<div class="center-on-page">
					 <select id="state" name="state">
						 <option value=""><a href="https://www.jqueryscript.net/menu/">Select State</a></option>
						 <option value="KualaLumpur">WP Kuala Lumpur</option>
						 <br>
						 <option value="Selangor">Selangor</option>
					 </select>
				 </div>
			</div>
	</div>
</div>

</div>
<div class="col-md submit-button text-center">
<input type="submit" value="SUBMIT" class="btn2" id="submit" style="border:none; margin: 20px 0 0 0">
</div>

			</form>
			<br>
				<h4 class ="h4-responsive font-weight-bold my-2 text-center black-text">List of Tahfiz School</h4>
			          <hr>
			     <table class="table table-hover">
			                     <thead>
			                         <tr>
			                             <th class="text-center"><strong>School Name</strong></th>
			                             <th class="text-center"><strong>Category</strong></th>
			                               <th class="text-center"><strong>Address</strong></th>
			                              <th class="text-center"><strong>Monthly Fees</strong></th>
			                         </tr>
			                     </thead>
			                     <tbody>

			                         <tr>
			                             <td class="text-center"><em></em></</td>
			                             <td class="text-center"></td>
			                              <td class="text-center"></td>
			                             <td class="text-center"></td>
			                         </tr>

			         </table>
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
