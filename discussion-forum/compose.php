<?php
include_once 'config/Database.php';
include_once 'class/User.php';
include_once 'class/Category.php';
include_once 'class/Topic.php';
include_once 'class/Post.php';
$database = new Database();
$db = $database->getConnection();
$user = new User($db);
$topics = new Topic($db);
$categories = new Category($db);
echo $user->loggedIn();
if(!$user->loggedIn()) {	
	header("Location: login.php");	
}
$categories->category_id = $_GET['category_id'];
$categoryDetails = $categories->getCategory();
if(!empty($_POST['saveTopic']) && $_POST['saveTopic'] && $_POST['message']) {
	$topics->save();	
}
include('inc/header.php');
?>
<title>Discussion Forum with PHP and MySQL</title> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="tinymce/tinymce.min.js"></script>
<script src="js/tinymce_editor.js"></script>
<script src="js/topics.js"></script>
<link rel="stylesheet" href="css/style.css">
<?php include('inc/container.php'); ?>
<div class="container">		
	<div class="row">
		<h2>Discussion Forum with PHP and MySQL</h2>
		<?php include("top_menus.php"); ?>
		<br>
		<span style="font-size:20px;"><a href="category.php"><< <?php echo $categoryDetails['name']; ?></a></span>
		<br><br>
		<div id="createNewtopic">	
			<form id="topicForm" name="topicForm" method="post">
				<div class="form-group">
					<label for="email">Topic Name:</label>
					<input type="text" name="topicName" id="topicName" class="form-control">
				</div>	
				<div class="form-group">
					<label for="email">Message:</label>
					<textarea name="message" id="message"></textarea>
				</div>	
				<input type="hidden" name="action" value="createTopic">
				<input type="hidden" name="categoryId" value="<?php echo $_GET['category_id']; ?>">
				<button type="submit" id="saveTopic" name="saveTopic" class="btn btn-info">Create Topic</button>
			</form>	
		</div>		
	</div>	
</div>
<?php include("inc/footer.php"); ?>