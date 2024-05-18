<?php

class Owner {	
   
	private $ownerTable = 'forum_owner';	
	private $conn;
	
	public function __construct($db){
        $this->conn = $db;
    }	    
	
	public function login(){
		if($this->email && $this->password) {			
			$sqlQuery = "
				SELECT * FROM ".$this->ownerTable." 
				WHERE email = ? AND password = ?";			
			$stmt = $this->conn->prepare($sqlQuery);
			$password = md5($this->password);			
			$stmt->bind_param("ss", $this->email, $password);	
			$stmt->execute();
			$result = $stmt->get_result();			
			if($result->num_rows > 0){
				$user = $result->fetch_assoc();
				$_SESSION["ownerId"] = $user['id'];				
				$_SESSION["ownerUser"] = $user['username'];								
				return 1;		
			} else {
				return 0;		
			}			
		} else {
			return 0;
		}
	}
	
	public function loggedIn (){
		if(!empty($_SESSION["ownerId"])) {
			return 1;
		} else {
			return 0;
		}
	}
}
?>