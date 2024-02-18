<?php

class Department extends Database {  
    
	private $departmentsTable = 'snmm_departments';
	
	private $dbConnect = false;
	public function __construct(){		
        $this->dbConnect = $this->dbConnect();
    } 
	public function listDepartment(){
			 			 
		$sqlQuery = "SELECT id, name, status
			FROM ".$this->departmentsTable;
			
		if(!empty($_POST["search"]["value"])){
			$sqlQuery .= ' (id LIKE "%'.$_POST["search"]["value"].'%" ';					
			$sqlQuery .= ' OR name LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR status LIKE "%'.$_POST["search"]["value"].'%" ';					
		}
		if(!empty($_POST["order"])){
			$sqlQuery .= ' ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
		} else {
			$sqlQuery .= ' ORDER BY id DESC ';
		}
		if($_POST["length"] != -1){
			$sqlQuery .= ' LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}	
		
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		$numRows = mysqli_num_rows($result);
		$departmentData = array();	
		while( $department = mysqli_fetch_assoc($result) ) {		
			$departmentRows = array();			
			$status = '';
			if($department['status'] == 1)	{
				$status = '<span class="label label-success">Enabled</span>';
			} else if($department['status'] == 0) {
				$status = '<span class="label label-danger">Disabled</span>';
			}	
			
			$departmentRows[] = $department['id'];
			$departmentRows[] = $department['name'];			
			$departmentRows[] = $status;
				
			$departmentRows[] = '<button type="button" name="update" id="'.$department["id"].'" class="btn btn-warning btn-xs update">Edit</button>';
			$departmentRows[] = '<button type="button" name="delete" id="'.$department["id"].'" class="btn btn-danger btn-xs delete">Delete</button>';
			$departmentData[] = $departmentRows;
		}
		$output = array(
			"draw"				=>	intval($_POST["draw"]),
			"recordsTotal"  	=>  $numRows,
			"recordsFiltered" 	=> 	$numRows,
			"data"    			=> 	$departmentData
		);
		echo json_encode($output);
	}	
	
		
	public function getDepartmentDetails(){		
		if($this->departmentId) {		
			$sqlQuery = "
				SELECT id, name, status 
				FROM ".$this->departmentsTable." 
				WHERE id = '".$this->departmentId."'";
			$result = mysqli_query($this->dbConnect, $sqlQuery);	
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			echo json_encode($row);
		}		
	}
	
	public function insert() {      
		if($this->department) {		              
			$this->department = strip_tags($this->department);              
			$queryInsert = "INSERT INTO ".$this->departmentsTable." (name, status) 
			VALUES('".$this->department."', '".$this->status."')";			
			mysqli_query($this->dbConnect, $queryInsert);			
		}
	}

	public function update() {      
		if($this->departmentId && $this->department) {		              
			$this->department = strip_tags($this->department);              
			$queryUpdate = "
				UPDATE ".$this->departmentsTable." 
				SET name = '".$this->department."', status = '".$this->status."' 
				WHERE id = '".$this->departmentId."'";				
			mysqli_query($this->dbConnect, $queryUpdate);			
		}
	}	
	
	public function delete() {      
		if($this->departmentId) {		          
			$queryUpdate = "
				DELETE FROM ".$this->departmentsTable." 
				WHERE id = '".$this->departmentId."'";				
			mysqli_query($this->dbConnect, $queryUpdate);			
		}
	}
	
}