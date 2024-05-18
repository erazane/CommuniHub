<?php
class Topic {	
   
	private $topicTable = 'forum_topics';
	private $postTable = 'forum_posts';
	private $userTable = 'forum_users';
	private $categoryTable = 'forum_category';
	private $conn;
	
	public function __construct($db){
        $this->conn = $db;
    }	
	
	public function insert(){				
		if($this->topicName && $this->message && $this->categoryId && $_SESSION["userid"]) {

			$stmt = $this->conn->prepare("
				INSERT INTO ".$this->topicTable."(`subject`, `category_id`, `user_id`)
				VALUES(?, ?, ?)");
						
			$stmt->bind_param("sii", $this->topicName, $this->categoryId, $_SESSION["userid"]);
			
			if($stmt->execute()){	
				$lastTopicId = $stmt->insert_id;
				
				$stmt2 = $this->conn->prepare("
				INSERT INTO ".$this->postTable."(`message`, `topic_id`, `user_id`)
				VALUES(?, ?, ?)");
				
				$stmt2->bind_param("sii", $this->message, $lastTopicId, $_SESSION["userid"]);
				$stmt2->execute();
				echo $lastTopicId;
			}		
		}
	}
	
	public function getTopicList(){	
		if($this->category_id) {
			$sqlQuery = "
				SELECT c.name, c.category_id, t.subject, t.topic_id, t.user_id, t.created 			
				FROM ".$this->topicTable." as t 
				LEFT JOIN ".$this->categoryTable." as c ON t.category_id = c.category_id
				WHERE t.category_id = ".$this->category_id."
				ORDER BY t.topic_id DESC";			
			$stmt = $this->conn->prepare($sqlQuery);
			$stmt->execute();
			$result = $stmt->get_result();			
			return $result;	
		}
	}
	
	public function getTopic(){
		if($this->topic_id) {
			$sqlQuery = "
				SELECT subject, category_id
				FROM ".$this->topicTable." 
				WHERE topic_id = ".$this->topic_id;
			
			$stmt = $this->conn->prepare($sqlQuery);
			$stmt->execute();
			$result = $stmt->get_result();	
			$topicDetails = $result->fetch_assoc();			
			return $topicDetails;	
		}
	}
	
	public function getPosts(){	
		if($this->topic_id) {
			$sqlQuery = "
				SELECT t.topic_id, p.post_id, p.message, p.topic_id, p.user_id, p.created, u.name			
				FROM ".$this->topicTable." as t 
				LEFT JOIN ".$this->postTable." as p ON t.topic_id = p.topic_id
				LEFT JOIN ".$this->userTable." as u ON p.user_id = u.user_id
				WHERE p.topic_id = ".$this->topic_id."
				ORDER BY p.post_id ASC";			
			$stmt = $this->conn->prepare($sqlQuery);
			$stmt->execute();
			$result = $stmt->get_result();			
			return $result;	
		}
	}
	
	public function getTopicPostCount(){
		if($this->topic_id) {
			$sqlQuery = "
				SELECT count(*) as total_posts
				FROM ".$this->postTable." 
				WHERE topic_id = ".$this->topic_id;
			
			$stmt = $this->conn->prepare($sqlQuery);
			$stmt->execute();
			$result = $stmt->get_result();	
			$categoryDetails = $result->fetch_assoc();			
			return $categoryDetails['total_posts'];	
		}
	}
	
}
?>