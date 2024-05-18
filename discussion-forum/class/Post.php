<?php
class Post {	
   
	private $postTable = 'forum_posts';
	private $userTable = 'forum_users';
	private $conn;
	
	public function __construct($db){
        $this->conn = $db;
    }	
	
	public function getPost(){		
		$sqlQuery = "
			SELECT *
			FROM ".$this->postTable." ORDER BY post_id DESC LIMIT 3";
		
		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->execute();
		$result = $stmt->get_result();			
		return $result;	
	}
	
	public function insert(){				
		if($this->message && $this->topic_id && $_SESSION["userid"]) {

			$stmt = $this->conn->prepare("
				INSERT INTO ".$this->postTable."(`message`, `topic_id`, `user_id`)
				VALUES(?, ?, ?)");
						
			$stmt->bind_param("sii", $this->message, $this->topic_id, $_SESSION["userid"]);
			
			if($stmt->execute()){	
				$lastPid = $stmt->insert_id;
				$sqlQuery = "
					SELECT post.post_id, post.message, post.user_id, DATE_FORMAT(post.created,'%d %M %Y %H:%i:%s') AS post_date, user.name
					FROM ".$this->postTable." post
					LEFT JOIN ".$this->userTable." user ON post.user_id = user.user_id
					WHERE post.post_id = '".$lastPid."'";
				$stmt2 = $this->conn->prepare($sqlQuery);				
				$stmt2->execute();
				$result = $stmt2->get_result();
				$record = $result->fetch_assoc();
				echo json_encode($record);
			}		
		}
	}

	public function update(){
		
		if($this->post_id && $this->message) {

			$stmt = $this->conn->prepare("
				UPDATE ".$this->postTable." SET message = ? 
				WHERE post_id = ?");
						
			$stmt->bind_param("si", $this->message, $this->post_id);
			
			if($stmt->execute()){					
				$sqlQuery = "
					SELECT post.post_id, post.message, post.user_id, DATE_FORMAT(post.created,'%d %M %Y %H:%i:%s') AS post_date, user.name
					FROM ".$this->postTable." post
					LEFT JOIN ".$this->userTable." user ON post.user_id = user.user_id
					WHERE post.post_id = '".$this->post_id."'";
				$stmt2 = $this->conn->prepare($sqlQuery);				
				$stmt2->execute();
				$result = $stmt2->get_result();
				$record = $result->fetch_assoc();
				echo json_encode($record);
			}		
		}
	}
}
?>