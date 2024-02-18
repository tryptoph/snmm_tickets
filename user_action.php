<?php
include 'init.php';

if(!empty($_POST['action']) && $_POST['action'] == 'listUser') {
	$users->listUser();
}

if(!empty($_POST['action']) && $_POST['action'] == 'getUserDetails') {
	$users->id = $_POST["userId"];
	$users->getUserDetails();
}

if(!empty($_POST['action']) && $_POST['action'] == 'addUser') {
	$users->userName = $_POST["userName"];
	$users->email = $_POST["email"];
	$users->role = $_POST["role"];
	$users->newPassword = $_POST["newPassword"];
    $users->status = $_POST["status"];   
	$users->insert();
}

if(!empty($_POST['action']) && $_POST['action'] == 'updateUser') {
	$users->updateUserId = $_POST["userId"]; 
	$users->userName = $_POST["userName"];
	$users->email = $_POST["email"];
	$users->role = $_POST["role"];
	$users->newPassword = $_POST["newPassword"];
    $users->status = $_POST["status"]; 
	$users->update();
}

if(!empty($_POST['action']) && $_POST['action'] == 'deleteUser') {
	$users->deleteUserId = $_POST["userId"];
	$users->delete();
}

?>