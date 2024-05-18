<h2>Control Panel</h2>
<?php if($_SESSION["ownerId"] !='') { ?>
<h3><?php echo "Logged in : ".$_SESSION["ownerUser"];  ?> | <a href="category.php" target="_blank">Forum</a> | <a href="cp_logout.php">Logout</a> </h3>
<?php } else {	?>
<h3><a href="category.php" target="_blank">Forum</a> | <a href="cp_login.php">Login</a> </h3>
<?php } ?>
<br>
<ul class="nav nav-tabs">
	<li id="dashboard" class="active"><a href="dashboard.php">Dashboard</a></li>
	<li id="users"><a href="users.php">Users</a></li>
	<li id="category_manager"><a href="category_manager.php">Categories</a></li> 
</ul>