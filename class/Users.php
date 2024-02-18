<?php
class Users extends Database { 
	private $userTable = 'snmm_users';
	private $dbConnect = false;
	public function __construct(){		
        $this->dbConnect = $this->dbConnect();
    }	
	public function isLoggedIn () {
		if(isset($_SESSION["userid"])) {
			return true; 			
		} else {
			return false;
		}
	}
	
	public function login(){     
		$errorMessage = '';
		if(!empty($_POST["login"]) && $_POST["email"]!=''&& $_POST["password"]!='') {    
			$email = $_POST['email'];
			$password = $_POST['password'];
			
			// Utiliser une requête paramétrée.
			$sqlQuery = "SELECT * FROM ".$this->userTable." 
				WHERE email=? AND password=? AND status = 1";
			
			// Préparez l'instruction
			$stmt = mysqli_prepare($this->dbConnect, $sqlQuery);
			
			// Lier les paramètres au placehoders
			mysqli_stmt_bind_param($stmt, "ss", $email, sha1($password));
			
			// Exécuter l'instruction
			mysqli_stmt_execute($stmt);
			
			// Obtenir le résultat
			$resultSet = mysqli_stmt_get_result($stmt);
			
			$isValidLogin = mysqli_num_rows($resultSet);    
			if($isValidLogin){
				$userDetails = mysqli_fetch_assoc($resultSet);
				$_SESSION["userid"] = $userDetails['id'];
				$_SESSION["user_name"] = $userDetails['name'];
				if($userDetails['user_type'] == 'admin') {
					$_SESSION["admin"] = 1;
				}
				header("location: ticket.php");       
			} else {        
				$errorMessage = "Invalid login!";         
			}
		} else if(!empty($_POST["login"])){
			$errorMessage = "Enter Both user and password!";    
		}
		return $errorMessage;        
	}
	




/*		$errorMessage = '';
		if(!empty($_POST["login"]) && $_POST["email"]!=''&& $_POST["password"]!='') {	
			$email = $_POST['email'];
			$password = $_POST['password'];
			$sqlQuery = "SELECT * FROM ".$this->userTable." 
				WHERE email='".$email."' AND password='".sha1($password)."' AND status = 1";
				
			$resultSet = mysqli_query($this->dbConnect, $sqlQuery);
			$isValidLogin = mysqli_num_rows($resultSet);	
			if($isValidLogin){
				$userDetails = mysqli_fetch_assoc($resultSet);
				$_SESSION["userid"] = $userDetails['id'];
				$_SESSION["user_name"] = $userDetails['name'];
				if($userDetails['user_type'] == 'admin') {
					$_SESSION["admin"] = 1;
				}
				header("location: ticket.php"); 		
			} else {		
				$errorMessage = "Invalid login!";		 
			}
		} else if(!empty($_POST["login"])){
			$errorMessage = "Enter Both user and password!";	
		}
		return $errorMessage; 		
	}*/
	public function getUserInfo() {
		if(!empty($_SESSION["userid"])) {
			$sqlQuery = "SELECT * FROM ".$this->userTable." 
				WHERE id ='".$_SESSION["userid"]."'";
			$result = mysqli_query($this->dbConnect, $sqlQuery);		
			$userDetails = mysqli_fetch_assoc($result);
			return $userDetails;
		}		
	}
	public function getColoumn($id, $column) {     
        $sqlQuery = "SELECT * FROM ".$this->userTable." 
			WHERE id ='".$id."'";
		$result = mysqli_query($this->dbConnect, $sqlQuery);		
		$userDetails = mysqli_fetch_assoc($result);
		return $userDetails[$column];       
    }
	
	public function listUser() {
		$sqlQuery = "SELECT id, name, email, create_date, user_type, status, dep
			FROM " . $this->userTable;
	
		if (!empty($_POST["search"]["value"])) {
			$sqlQuery .= ' WHERE id LIKE "%' . $_POST["search"]["value"] . '%" ';
			$sqlQuery .= ' OR name LIKE "%' . $_POST["search"]["value"] . '%" ';
			$sqlQuery .= ' OR status LIKE "%' . $_POST["search"]["value"] . '%" ';
		}
		if (!empty($_POST["order"])) {
			$sqlQuery .= ' ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST['order']['0']['dir'] . ' ';
		} else {
			$sqlQuery .= ' ORDER BY id DESC ';
		}
		if ($_POST["length"] != -1) {
			$sqlQuery .= ' LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}
	
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		$numRows = mysqli_num_rows($result);
		$userData = array();
		while ($user = mysqli_fetch_assoc($result)) {
			$userRows = array();
			$status = ($user['status'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';
	
			$sqlQuery = "SELECT d.name FROM snmm_departments as d
			WHERE d.id = '".$user['dep']."'";
			$departmentResult = mysqli_query($this->dbConnect, $sqlQuery);
			$departmentData = mysqli_fetch_assoc($departmentResult);
			$departmentName = ($departmentData !== null) ? $departmentData['name'] : '<span class="label label-default">Unknown</span>';
			$departmentLabel = '<span class="label label-default">' . htmlspecialchars($departmentName) . '</span>';

			$userRole = ($user['user_type'] == 'admin') ? '<span class="label label-danger">Admin</span>' : '<span class="label label-warning">Member</span>';
	
			$userRows[] = $user['id'];
			$userRows[] = $user['name'];
			$userRows[] = $user['email'];
			$userRows[] = $user['create_date'];
			$userRows[] = $userRole;
			$userRows[] = $departmentLabel;
			$userRows[] = $status;
	
			$userRows[] = '<button type="button" name="update" id="' . $user["id"] . '" class="btn btn-warning btn-xs update">Edit</button>';
			$userRows[] = '<button type="button" name="delete" id="' . $user["id"] . '" class="btn btn-danger btn-xs delete">Delete</button>';
			$userData[] = $userRows;
		}
	
		$output = array(
			"draw" => intval($_POST["draw"]),
			"recordsTotal" => $numRows,
			"recordsFiltered" => $numRows,
			"data" => $userData
		);
		echo json_encode($output);
	}


		
	
	
	public function getUserDetails(){		
		if($this->id) {		
			$sqlQuery = "
				SELECT id, name, email, password, create_date, user_type, status , dep
				FROM ".$this->userTable." 
				WHERE id = '".$this->id."'";
			$result = mysqli_query($this->dbConnect, $sqlQuery);	
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			echo json_encode($row);
		}		
	}
	
	public function insert() {
		if ($_POST['action'] == 'addUser') {
			$userName = $_POST['userName'];
			$email = $_POST['email'];
			$role = $_POST['role'];
			$status = $_POST['status'];
			$newPassword = sha1($_POST['newPassword']);
			$dep = $_POST['dep']; 
		
			$queryInsert = "
				INSERT INTO " . $this->userTable . "(name, email, user_type, status, password, dep) VALUES(
				'" . $userName . "', '" . $email . "', '" . $role . "', '" . $status . "', '" . $newPassword . "', '" . $dep . "')";
			
			mysqli_query($this->dbConnect, $queryInsert);
		}
	}
	
	public function update() {
		if ($_POST['action'] == 'updateUser') {
			$userName = $_POST['userName'];
			$email = $_POST['email'];
			$role = $_POST['role'];
			$status = $_POST['status'];
			$dep = $_POST['dep']; 
	
			$changePassword = '';
			if ($this->newPassword) {
				$this->newPassword = sha1($this->newPassword);
				$changePassword = ", password = '".$this->newPassword."'";
			}

			$queryUpdate = "
				UPDATE " . $this->userTable . " 
				SET name = '".$userName."', email = '".$email."', user_type = '".$role."', status = '".$status."' $changePassword, dep = '".$dep."'
				WHERE id = '".$this->updateUserId."'";
			
			mysqli_query($this->dbConnect, $queryUpdate);
		}
	}
		
	
	public function delete() {      
		if($this->deleteUserId) {		          
			$queryUpdate = "
				DELETE FROM ".$this->userTable." 
				WHERE id = '".$this->deleteUserId."'";				
			mysqli_query($this->dbConnect, $queryUpdate);			
		}
	}
	
}