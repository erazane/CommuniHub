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
  <div class="col-sm-2">
    <div class="row">
      <div class="col-md-12">
        <input class="form-control" placeholder="Search by school name" type="text">
      </div>
    </div>
  </div>

  <div class="col-sm-2">
    <select class="form-control">
      <option value="0" selected="selected">
        Level
      </option>
      <option value="1">
        Primary
      </option>
      <option value="2">
        Secondary
      </option>
    </select>
  </div>

  <div class="col-sm-2">
    <select class="form-control">
      <option value="0" selected="selected">
        State
      </option>
      <option value="1">
        Kuala Lumpur
      </option>
      <option value="2">
        Selangor
      </option>
    </select>
  </div>

  <div class="col-sm-2">
    <select class="form-control">
      <option value="0" selected="selected">
        Average Fees
      </option>
      <option value="1">
        RM 100 -  RM 200
      </option>
      <option value="2">
        RM 200 -  RM 300
      </option>
      <option value="3">
        RM 300 -  RM 400
      </option>
      <option value="4">
        RM 400 -  RM 500
      </option>
    </select>
  </div>

  <!-- <div class="col-sm-2">
    <select class="form-control">
      <option value="0" selected="selected">
        Model
      </option>
      <option value="1">
        Verna
      </option>
      <option value="2">
        Wagon R
      </option>
      <option value="3">
        Alto
      </option>
      <option value="4">
        Activa
      </option>
      <option value="5">
        Ace
      </option>
      <option value="6">
        Corolla
      </option>
    </select>
  </div> -->
  <!-- <div class="col-sm-1">
    <button type="button" class="btn btn-primary site-btn">Submit</button>
  </div> -->
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

<?php include_once'footer.php';
?>
