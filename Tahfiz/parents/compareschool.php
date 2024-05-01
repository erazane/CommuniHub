<?php
include_once'../parents/headercompare.php';
include('connection.php');

?>

<div class="bg" style="background: #F4F4F4">
    <div class="container">
    </div>
</div>

<section id="about-sec" style="background: #F4F4F4; margin-bottom: 0px;">
  <div class="compare-basket">
    <button class="action action--button action--compare"><i class="fa fa-check"></i><span class="action__text">Compare</span></button>
  </div>
    <div class="container">
        <div class="row">
          <h2 class="text-center">TAHFIZ SCHOOL COMPARISON</h2>
          <!-- <h5 class="text-center" style="font-weight: 600; font-size: 15px; color:#118f56; margin-top: -10px;">Find the best tahfiz school for your child
              <br>
              by comparing the school side by side.
          </h5> -->
          <hr>
        </div>
        <div class="view">
          <section class="grid">
    				<?php
    				$sch = $connection->query("SELECT * FROM schools WHERE status='Approved'");
    				while ($fetch = $sch->fetch_array()) {
    						?>
    				<!-- Products -->
    				<div class="product">
    					<div class="product__info">
    						<img class="product__image" src="../images/<?php echo $fetch['file_name']; ?>" alt="Product 1" style="width:150px;" />
    						<h3 class="product__title" style="line-height: 25px; color: #555;"><?php echo $fetch['school_name']; ?></h3>
    						<span class="product__year extra highlight" style="font-weight: 600; color: #15945b;"><label style="color: #555;"><i class="fas fa-map-marker-alt"></i> Address:</label> <?php echo $fetch['street_name']; ?></span>
                <span class="product__price extra highlight" style="font-weight: 600; color: #15945b;"><label style="color: #555;"><i class="fas fa-map-pin"></i> State:</label> <?php echo $fetch['state']; ?></span>
    						<span class="product__region extra highlight" style="font-weight: 600; color: #15945b;"><label style="color: #555;"><i class="fas fa-phone"></i> Phone Number:</label> <?php echo $fetch['phonenum']; ?></span>
    						<span class="product__varietal extra highlight" style="font-weight: 600; color: #15945b;"><label style="color: #555;"><i class="fas fa-graduation-cap"></i> School Level:</label> <?php echo $fetch['category']; ?></span>
    						<span class="product__alcohol extra highlight" style="font-weight: 600; color: #15945b;"><label style="color: #555;"><i class="fas fa-money-bill-alt"></i> Monthly Fees:</label> RM <?php echo $fetch['monthlyfees']; ?></span>
    					</div>
    					<label class="action action--compare-add" style="font-size: 16px;"><input class="check-hidden" style="cursor: pointer;" type="checkbox" /><i class="fas fa-plus-square"></i><i class="fas fa-check-square" style="margin-top: 3px;"></i><span class="action__text action__text--invisible">Add to compare</span></label>

    				</div>
    				<?php } ?>
    			</section>
        </div>
        <section class="compare">
    			<button class="action action--close"><i class="fa fa-remove"></i><span class="action__text action__text--invisible">Close comparison overlay</span></button>
    		</section>
    </div>
</section>

<?php
include_once'../parents/footer.php';
?>
