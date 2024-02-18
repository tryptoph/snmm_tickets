<?php
include 'init.php';
if(!empty($_POST['action']) && $_POST['action'] == 'auth') {
	$users->login();
}
if(!empty($_POST['action']) && $_POST['action'] == 'listTicket') {
	$tickets->showTickets();
}

if(!empty($_POST['action']) && $_POST['action'] == 'listTicket1') {
	$tickets->showUserTickets();
}

if(!empty($_POST['action']) && $_POST['action'] == 'createTicket') {
	$tickets->createTicket();
}
if(!empty($_POST['action']) && $_POST['action'] == 'getTicketDetails') {
	$tickets->getTicketDetails();
}
if(!empty($_POST['action']) && $_POST['action'] == 'updateTicket') {
	$tickets->updateTicket();
}
if(!empty($_POST['action']) && $_POST['action'] == 'closeTicket') {
	$tickets->closeTicket();
}
if(!empty($_POST['action']) && $_POST['action'] == 'saveTicketReplies') {
	$tickets->saveTicketReplies();
}
?>