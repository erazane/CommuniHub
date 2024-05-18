<?php 
include_once 'config/Database.php';
include_once 'class/Owner.php';
include_once 'class/User.php';

$database = new Database();
$db = $database->getConnection();

$owner = new Owner($db);
if(!$owner->loggedIn()) {	
	header("Location: cp_login.php");	
}
$user = new User($db);
include('inc/header.php');
?>
<title>Discussion Forum - Users</title>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>		
<link rel="stylesheet" href="css/dataTables.bootstrap.min.css" />
<script src="js/user.js"></script>
<script src="js/general.js"></script>
<link rel="stylesheet" href="css/style.css">
<?php include('inc/container.php');?>
<div class="container">  
	<?php include('menus.php'); ?>
	<h2>User Manager</h2>
	<div class="panel-heading">
		<div class="row">
			<div class="col-md-10">
				<h3 class="panel-title"></h3>
			</div>
			<div class="col-md-2" align="right">
				<button type="button" id="addUser" class="btn btn-info" title="Add User"><span class="glyphicon glyphicon-plus"></span></button>
			</div>
		</div>
	</div>
	<table id="userListing" class="table table-bordered table-striped">
		<thead>
			<tr>						
				<th>Id</th>					
				<th>Name</th>				
				<th>Email</th>
				<th>Usergroup</th>				
				<th></th>
				<th></th>					
			</tr>
		</thead>
	</table>
	
	<div id="userModal" class="modal fade">
		<div class="modal-dialog">
			<form method="post" id="userForm">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title"><i class="fa fa-plus"></i> Edit User</h4>
					</div>
					<div class="modal-body">						
						<div class="form-group">
							<div class="row">
								<label class="col-md-4 text-right">Full Name <span class="text-danger">*</span></label>
								<div class="col-md-8">
									<input type="text" name="userName" id="userName" autocomplete="off" class="form-control" required />
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="row">
								<label class="col-md-4 text-right">Email <span class="text-danger">*</span></label>
								<div class="col-md-8">
									<input type="email" name="userEmail" id="userEmail" autocomplete="off" class="form-control" required />
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="row">
								<label class="col-md-4 text-right">Password <span class="text-danger"></span></label>
								<div class="col-md-8">
									<input type="password" name="userPassword" id="userPassword" autocomplete="off" class="form-control"  />
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="row">
								<label class="col-md-4 text-right">Usergroup <span class="text-danger">*</span></label>
								<div class="col-md-8">
									<select name="usergroup" id="usergroup" class="form-control">									
										<?php 
										$usergroupResult = $user->getUserGroupList();
										while ($usergroup = $usergroupResult->fetch_assoc()) { 	
										?>
											<option value="<?php echo $usergroup['usergroup_id']; ?>"><?php echo $usergroup['title']; ?></option>							
										<?php } ?>									
									</select>
								</div>
							</div>
						</div>	
								
					</div>
					<div class="modal-footer">
						<input type="hidden" name="id" id="id" />						
						<input type="hidden" name="action" id="action" value="" />
						<input type="submit" name="save" id="save" class="btn btn-info" value="Save" />
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	
</div>
<?php include('inc/footer.php');?>