<?php
$connection = mysqli_connect("localhost", "root", "", "tbl_product");
session_start();

if(isset($_POST["add_to_list"]))
{
	if(isset($_SESSION["compare_school"]))
	{
		$item_array_id = array_column($_SESSION["compare_school"], "schools_ID");
		if(!in_array($_GET["id"], $item_array_id))
		{
			$count = count($_SESSION["compare_school"]);
			$item_array = array(
				'schools_ID'			=>	$_GET["id"],
				'school_name'			=>	$_POST["hidden_name"],
				'state'		=>	$_POST["hidden_price"],
				'category'		=>	$_POST["quantity"]
			);
			$_SESSION["compare_school"][$count] = $item_array;
		}
		else
		{
			echo '<script>alert("Item Already Added")</script>';
		}
	}
	else
	{
		$item_array = array(
			'schools_ID'			=>	$_GET["id"],
			'school_name'			=>	$_POST["hidden_name"],
			'state'		=>	$_POST["hidden_price"],
			'category'		=>	$_POST["quantity"]
		);
		$_SESSION["compare_school"][0] = $item_array;
	}
}

if(isset($_GET["action"]))
{
	if($_GET["action"] == "delete")
	{
		foreach($_SESSION["compare_school"] as $keys => $values)
		{
			if($values["schools_ID"] == $_GET["id"])
			{
				unset($_SESSION["compare_school"][$keys]);
				echo '<script>alert("Item Removed")</script>';
				echo '<script>window.location="index.php"</script>';
			}
		}
	}
}

?>
