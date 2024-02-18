<?php
include 'init.php';

if(!empty($_POST['action']) && $_POST['action'] == 'listDepartment') {
	$department->listDepartment();
}

if(!empty($_POST['action']) && $_POST['action'] == 'getDepartmentDetails') {
	$department->departmentId = $_POST["departmentId"];
	$department->getDepartmentDetails();
}

if(!empty($_POST['action']) && $_POST['action'] == 'addDepartment') {
	$department->department = $_POST["department"];
    $department->status = $_POST["status"];    
	$department->insert();
}

if(!empty($_POST['action']) && $_POST['action'] == 'updateDepartment') {
	$department->departmentId = $_POST["departmentId"]; 
	$department->department = $_POST["department"];
    $department->status = $_POST["status"]; 
	$department->update();
}

if(!empty($_POST['action']) && $_POST['action'] == 'deleteDepartment') {
	$department->departmentId = $_POST["departmentId"];
	$department->delete();
}

?>