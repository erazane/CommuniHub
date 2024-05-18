<?php
include_once 'config/Database.php';
include_once 'class/Owner.php';
include_once 'class/Category.php';
include_once 'class/Topic.php';

$database = new Database();
$db = $database->getConnection();

$owner = new Owner($db);
$categories = new Category($db);
$topics = new Topic($db);

if($owner->loggedIn()) {	
	header("Location: dashboard.php");	
}

$loginMessage = '';
if(!empty($_POST["login"]) && !empty($_POST["email"]) && !empty($_POST["password"])) {	
	$owner->email = $_POST["email"];
	$owner->password = $_POST["password"];	
	if($owner->login()) {		
		header("Location: dashboard.php");					
	} else {
		$loginMessage = 'Invalid login! Please try again.';
	}	
} else if (!isset($_POST["login"])){
	$loginMessage = 'Enter emailand pasword to login.';
}

include('inc/header.php');
?>
<title>Discussion Forum with PHP and MySQL</title> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/style.css">
<?php include('inc/container.php'); ?>
<div class="container">		
	<div class="row">
		<h2>Discussion Forum with PHP and MySQL</h2>		
		
		<div class="single category">
			<h2>Forum Administrator Login</h2>		
			<div style="padding-top:30px;width:400px;" class="panel-body" >
				<?php if ($loginMessage != '') { ?>
					<div id="login-alert" class="alert alert-danger col-sm-12"><?php echo $loginMessage; ?></div>                            
				<?php } ?>
				<form id="loginform" class="form-horizontal" role="form" method="POST" action="">                                    
					<div style="margin-bottom: 25px" class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
						<input type="text" class="form-control" id="email" name="email" value="<?php if(!empty($_POST["email"])) { echo $_POST["email"]; } ?>" placeholder="email" style="background:white;" required>                                        
					</div>                                
					<div style="margin-bottom: 25px" class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
						<input type="password" class="form-control" id="password" name="password" value="<?php if(!empty($_POST["password"])) { echo $_POST["password"]; } ?>" placeholder="password" required>
					</div>	
										
					<div style="margin-top:10px" class="form-group">    
						<input type="hidden" name="referal_url" value="<?php if(!empty($_SERVER['HTTP_REFERER'])) { echo $_SERVER['HTTP_REFERER']; } ?>">
						<div class="col-sm-12 controls">
						  <input type="submit" name="login" value="Login" class="btn btn-info">						  
						</div>						
					</div>						
				</form>  				
			</div>       
		 
		
		
		
		</div>
		
		
	</div>		
</div>
<?php include("inc/footer.php"); ?>