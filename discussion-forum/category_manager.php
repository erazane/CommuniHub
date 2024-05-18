<?php 
include_once 'config/Database.php';
include_once 'class/Owner.php';
include_once 'class/Category.php';

$database = new Database();
$db = $database->getConnection();

$owner = new Owner($db);
if(!$owner->loggedIn()) {	
	header("Location: cp_login.php");	
}
$categories = new Category($db);
include('inc/header.php');
?>
<title>Discussion Forum - Category</title>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>		
<link rel="stylesheet" href="css/dataTables.bootstrap.min.css" />
<link rel="stylesheet" href="css/style.css">
<script src="js/general.js"></script>
<script src="js/manage_category.js"></script>
<?php include('inc/container.php');?>
<div class="container">  
	<?php include('menus.php'); ?>		
	<h2>Category Manager</h2>	
	<div class="panel-heading">
		<div class="row">
			<div class="col-md-10">
				<h3 class="panel-title"></h3>
			</div>
			<div class="col-md-2" align="right">
				<button type="button" id="addCategory" class="btn btn-info" title="Add Category"><span class="glyphicon glyphicon-plus"></span></button>
			</div>
		</div>
	</div>
	<table id="categoryListing" class="table table-bordered table-striped">
		<thead>
			<tr>							
				<th>Name</th>						
				<th></th>
				<th></th>					
			</tr>
		</thead>
	</table>
	
	<div id="categoryModal" class="modal fade">
		<div class="modal-dialog">
			<form method="post" id="categoryForm">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title"><i class="fa fa-plus"></i> Edit User</h4>
					</div>
					<div class="modal-body">						
						<div class="form-group">
							<div class="row">
								<label class="col-md-4 text-right">Name <span class="text-danger">*</span></label>
								<div class="col-md-8">
									<input type="text" name="categoryName" id="categoryName" autocomplete="off" class="form-control" required />
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="row">
								<label class="col-md-4 text-right">Description <span class="text-danger"></span></label>
								<div class="col-md-8">
									<textarea class="form-control" rows="5"  name="description" id="description"></textarea>
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