<?php
include_once 'config/Database.php';
include_once 'class/User.php';
include_once 'class/Category.php';
include_once 'class/Topic.php';
include_once 'class/Post.php';

$database = new Database();
$db = $database->getConnection();

$categories = new Category($db);
$topic = new Topic($db);
$post = new Post($db);
$user = new User($db);

if(!empty($_POST['message']) && $_POST['message'] && $_POST['action'] == 'save') {	
	$post->message = $_POST['message'];	
	$post->topic_id = $_POST['topic_id'];	
	$post->insert();	
}
if(!empty($_POST['message']) && $_POST['message'] && $_POST['action'] == 'update') {	
	$post->message = $_POST['message'];	
	$post->post_id = $_POST['post_id'];	
	$post->update();	
}

if(!empty($_POST['action']) && $_POST['action'] == 'createTopic') {
	$topic->topicName = $_POST['topicName'];
	$topic->message = $_POST['message'];
	$topic->categoryId = $_POST['categoryId'];	
	$topic->insert();	
}

if(!empty($_POST['action']) && $_POST['action'] == 'userListing') {
	$user->listUsers();
}

if(!empty($_POST['action']) && $_POST['action'] == 'getUserDetails') {
	$user->id = $_POST["id"];
	$user->getUserDetails();
}

if(!empty($_POST['action']) && $_POST['action'] == 'addUser') {
	$user->userName = $_POST["userName"];
	$user->userEmail = $_POST["userEmail"];
	$user->userPassword = $_POST["userPassword"];
	$user->usergroup = $_POST["usergroup"];
	$user->insert();
}

if(!empty($_POST['action']) && $_POST['action'] == 'updateUser') {
	$user->id = $_POST["id"];
	$user->userName = $_POST["userName"];
	$user->userEmail = $_POST["userEmail"];
	$user->userPassword = $_POST["userPassword"];
	$user->usergroup = $_POST["usergroup"];
	$user->update();
}

if(!empty($_POST['action']) && $_POST['action'] == 'deleteUser') {
	$user->id = $_POST["id"];
	$user->delete();
}

if(!empty($_POST['action']) && $_POST['action'] == 'categoryListing') {
	$categories->listCategory();
} 

if(!empty($_POST['action']) && $_POST['action'] == 'getCategoryDetails') {
	$categories->id = $_POST["id"];
	$categories->getCategoryDetails();
}

if(!empty($_POST['action']) && $_POST['action'] == 'addCategory') {
	$categories->categoryName = $_POST["categoryName"];
	$categories->description = $_POST["description"];	
	$categories->insert();
}

if(!empty($_POST['action']) && $_POST['action'] == 'updateCategory') {
	$categories->id = $_POST["id"];
	$categories->categoryName = $_POST["categoryName"];
	$categories->description = $_POST["description"];
	$categories->update();
}

if(!empty($_POST['action']) && $_POST['action'] == 'deleteCategory') {
	$categories->id = $_POST["id"];
	$categories->delete();
}

?>