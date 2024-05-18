<?php
class User {	
   
	private $userTable = 'forum_users';	
	private $usergroupTable = 'forum_usergroup';
	private $conn;
	
	public function __construct($db){
        $this->conn = $db;
    }	    
	
	public function login(){
		if($this->email && $this->password) {			
			$sqlQuery = "
				SELECT * FROM ".$this->userTable." 
				WHERE email = ? AND password = ?";			
			$stmt = $this->conn->prepare($sqlQuery);
			$password = md5($this->password);			
			$stmt->bind_param("ss", $this->email, $password);	
			$stmt->execute();
			$result = $stmt->get_result();			
			if($result->num_rows > 0){
				$user = $result->fetch_assoc();
				$_SESSION["userid"] = $user['user_id'];					
				$_SESSION["name"] = $user['name'];				
				return 1;		
			} else {
				return 0;		
			}			
		} else {
			return 0;
		}
	}
	
	public function loggedIn (){
		if(!empty($_SESSION["userid"])) {
			return 1;
		} else {
			return 0;
		}
	}
	
	public function listUsers(){			
		$sqlQuery = "
			SELECT user.user_id, user.name, user.email, usergroup.title
			FROM ".$this->userTable." user
			LEFT JOIN ".$this->usergroupTable." usergroup ON user.usergroup = usergroup.usergroup_id ";
				
		if(!empty($_POST["order"])){
			$sqlQuery .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
		} else {
			$sqlQuery .= 'ORDER BY user_id ASC ';
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
	
		while ($user = $result->fetch_assoc()) { 				
			$rows = array();			
			$rows[] = $user['user_id'];
			$rows[] = ucfirst($user['name']);
			$rows[] = $user['email'];
			$rows[] = $user['title'];					
			$rows[] = '<button type="button" name="update" id="'.$user["user_id"].'" class="btn btn-warning btn-xs update"><span class="glyphicon glyphicon-edit" title="Edit"></span></button>';			
			$rows[] = '<button type="button" name="delete" id="'.$user["user_id"].'" class="btn btn-danger btn-xs delete" ><span class="glyphicon glyphicon-remove" title="Delete"></span></button>';
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
	
	public function getUserDetails(){
		if($this->id) {			
			$sqlQuery = "
			SELECT user_id, name, email, usergroup
			FROM ".$this->userTable." 
			WHERE user_id = ?";			
					
			$stmt = $this->conn->prepare($sqlQuery);
			$stmt->bind_param("i", $this->id);	
			$stmt->execute();
			$result = $stmt->get_result();				
			$records = array();		
			while ($user = $result->fetch_assoc()) { 				
				$rows = array();	
				$rows['user_id'] = $user['user_id'];				
				$rows['name'] = $user['name'];
				$rows['email'] = $user['email'];
				$rows['usergroup'] = $user['usergroup'];				
				$records[] = $rows;
			}		
			$output = array(			
				"data"	=> 	$records
			);
			echo json_encode($output);
		}
	}

	function getUserGroupList(){		
		$stmt = $this->conn->prepare("
		SELECT usergroup_id, title 
		FROM ".$this->usergroupTable);				
		$stmt->execute();			
		$result = $stmt->get_result();		
		return $result;	
	}
	
	public function insert(){
		
		if($this->userEmail && $_SESSION["ownerId"]) {
			
			$stmt = $this->conn->prepare("
				INSERT INTO ".$this->userTable."(`name`, `email`, `password`, `usergroup`)
				VALUES(?, ?, ?, ?)");
		
			$this->userName = htmlspecialchars(strip_tags($this->userName));
			$this->userEmail = htmlspecialchars(strip_tags($this->userEmail));
			$this->usergroup = htmlspecialchars(strip_tags($this->usergroup));
			$this->userPassword = htmlspecialchars(strip_tags($this->userPassword));
			
			$this->userPassword = md5($this->userPassword);
			
			$stmt->bind_param("sssi", $this->userName, $this->userEmail, $this->userPassword, $this->usergroup);
			
			if($stmt->execute()){
				return true;
			}		
		}
	}
	
	public function update(){
		
		if($this->id && $this->userEmail && $_SESSION["ownerId"]) {
			
			$passwordUpdate = '';
			if($this->userPassword) {
				$passwordUpdate = ", password = '".md5($this->userPassword)."'";
			}
			
			$stmt = $this->conn->prepare("
				UPDATE ".$this->userTable." 
				SET name = ?, email = ?, usergroup = ? $passwordUpdate
				WHERE user_id = ?");
	 
			$this->userName = htmlspecialchars(strip_tags($this->userName));
			$this->userEmail = htmlspecialchars(strip_tags($this->userEmail));
			$this->usergroup = htmlspecialchars(strip_tags($this->usergroup));			
					
			$stmt->bind_param("ssii", $this->userName, $this->userEmail, $this->usergroup, $this->id);
			
			if($stmt->execute()){				
				return true;
			}			
		}	
	}
	
	public function delete(){
		if($this->id && $_SESSION["ownerId"]) {			

			$stmt = $this->conn->prepare("
				DELETE FROM ".$this->userTable." 
				WHERE user_id = ? ");

			$this->id = htmlspecialchars(strip_tags($this->id));

			$stmt->bind_param("i", $this->id);

			if($stmt->execute()){				
				return true;
			}
		}
	} 
}
?>