<?php
class Category {	
   
	private $categoryTable = 'forum_category';
	private $topicTable = 'forum_topics';
	private $postTable = 'forum_posts';
	private $conn;
	
	public function __construct($db){
        $this->conn = $db;
    }	
	
	public function getCategoryList(){		
		$sqlQuery = "
			SELECT *
			FROM ".$this->categoryTable." ORDER BY category_id DESC";
		
		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->execute();
		$result = $stmt->get_result();			
		return $result;	
	}
	
	public function getCategory(){
		if($this->category_id) {
			$sqlQuery = "
				SELECT name
				FROM ".$this->categoryTable." 
				WHERE category_id = ".$this->category_id;
			
			$stmt = $this->conn->prepare($sqlQuery);
			$stmt->execute();
			$result = $stmt->get_result();	
			$categoryDetails = $result->fetch_assoc();			
			return $categoryDetails;	
		}
	}
	
	public function getCategoryTopicsCount(){
		if($this->category_id) {
			$sqlQuery = "
				SELECT count(*) as total_topic
				FROM ".$this->topicTable." 
				WHERE category_id = ".$this->category_id;
			
			$stmt = $this->conn->prepare($sqlQuery);
			$stmt->execute();
			$result = $stmt->get_result();	
			$categoryDetails = $result->fetch_assoc();			
			return $categoryDetails['total_topic'];	
		}
		
	}
	
	public function getCategorypostsCount(){
		if($this->category_id) {
			$sqlQuery = "
				SELECT count(p.post_id) as total_posts
				FROM ".$this->postTable." as p
				LEFT JOIN ".$this->topicTable." as t ON p.topic_id = t.topic_id
				LEFT JOIN ".$this->categoryTable." as c ON t.category_id = c.category_id				
				WHERE c.category_id = ".$this->category_id;			
			$stmt = $this->conn->prepare($sqlQuery);
			$stmt->execute();
			$result = $stmt->get_result();	
			$categoryDetails = $result->fetch_assoc();			
			return $categoryDetails['total_posts'];	
		}
	}
	
	
	public function listCategory(){			
		$sqlQuery = "
			SELECT category_id, name, description
			FROM ".$this->categoryTable." ";
				
		if(!empty($_POST["order"])){
			$sqlQuery .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
		} else {
			$sqlQuery .= 'ORDER BY category_id ASC ';
		}
		
		if($_POST["length"] != -1){
			$sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}
		
		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->execute();
		$result = $stmt->get_result();	
		
		$stmtTotal = $this->conn->prepare($sqlQuery);
		$stmtTotal->execute();
		$allResult = $stmtTotal->get_result();
		$allRecords = $allResult->num_rows;
		
		$displayRecords = $result->num_rows;
		$records = array();	
	
		while ($category = $result->fetch_assoc()) { 				
			$rows = array();				
			$rows[] = ucfirst($category['name']);							
			$rows[] = '<button type="button" name="update" id="'.$category["category_id"].'" class="btn btn-warning btn-xs update"><span class="glyphicon glyphicon-edit" title="Edit"></span></button>';			
			$rows[] = '<button type="button" name="delete" id="'.$category["category_id"].'" class="btn btn-danger btn-xs delete" ><span class="glyphicon glyphicon-remove" title="Delete"></span></button>';
			$records[] = $rows;
		}
		
		$output = array(
			"draw"	=>	intval($_POST["draw"]),			
			"iTotalRecords"	=> 	$displayRecords,
			"iTotalDisplayRecords"	=>  $allRecords,
			"data"	=> 	$records
		);
		
		echo json_encode($output);
	}
	
	public function getCategoryDetails(){
		if($this->id) {			
			$sqlQuery = "
			SELECT category_id, name, description
			FROM ".$this->categoryTable." 
			WHERE category_id = ?";			
					
			$stmt = $this->conn->prepare($sqlQuery);
			$stmt->bind_param("i", $this->id);	
			$stmt->execute();
			$result = $stmt->get_result();				
			$records = array();		
			while ($category = $result->fetch_assoc()) { 				
				$rows = array();	
				$rows['category_id'] = $category['category_id'];				
				$rows['name'] = $category['name'];
				$rows['description'] = $category['description'];							
				$records[] = $rows;
			}		
			$output = array(			
				"data"	=> 	$records
			);
			echo json_encode($output);
		}
	}
	
	public function insert(){
		
		if($this->categoryName && $_SESSION["ownerId"]) {
			
			$stmt = $this->conn->prepare("
				INSERT INTO ".$this->categoryTable."(`name`, `description`)
				VALUES(?, ?)");
		
			$this->categoryName = htmlspecialchars(strip_tags($this->categoryName));
			$this->description = htmlspecialchars(strip_tags($this->description));
		
			$stmt->bind_param("ss", $this->categoryName, $this->description);
			
			if($stmt->execute()){
				return true;
			}		
		}
	}
	
	public function update(){
		
		if($this->id && $this->categoryName && $_SESSION["ownerId"]) {
			
			$stmt = $this->conn->prepare("
				UPDATE ".$this->categoryTable." 
				SET name = ?, description = ?
				WHERE category_id = ?");
	 
			$this->categoryName = htmlspecialchars(strip_tags($this->categoryName));
			$this->description = htmlspecialchars(strip_tags($this->description));
					
			$stmt->bind_param("ssi", $this->categoryName, $this->description, $this->id);
			
			if($stmt->execute()){				
				return true;
			}			
		}	
	}	
	
	public function delete(){
		if($this->id && $_SESSION["ownerId"]) {			

			$stmt = $this->conn->prepare("
				DELETE FROM ".$this->categoryTable." 
				WHERE category_id = ? ");

			$this->id = htmlspecialchars(strip_tags($this->id));

			$stmt->bind_param("i", $this->id);

			if($stmt->execute()){				
				return true;
			}
		}
	} 
	
}
?>