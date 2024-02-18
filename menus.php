<!DOCTYPE html>
<html>
<head>
    <style>
        .navbar-inverse .navbar-nav .active > a,
        .navbar-inverse .navbar-nav .active > a:focus,
        .navbar-inverse .navbar-nav .active > a:hover {
            background-color: #004d40; 
            color: #ffffff; 
        }
    </style>
</head>
<body>
<nav class="navbar navbar-inverse" style="background:#00796B;color:#f6f8f9;font-weight:bold;">
 <div class="container-fluid">
 <ul class="nav navbar-nav menus">
            <?php if(isset($_SESSION["admin"])) { ?>
                <li id="ticket"<?php if(basename($_SERVER['PHP_SELF']) == 'ticket.php') echo ' class="active"'; ?>><a href="ticket.php" class="navbar-brand">Tickets</a></li>
            <?php } else { ?>
                <li id="ticket_received"<?php if(basename($_SERVER['PHP_SELF']) == 'ticket.php') echo ' class="active"'; ?>><a href="ticket.php" class="navbar-brand">Tickets reçus  &nbsp; </a></li>
                <li id="ticket_created"<?php if(basename($_SERVER['PHP_SELF']) == 'ticket_created.php') echo ' class="active"'; ?>><a href="ticket_created.php" class="navbar-brand">&nbsp; Tickets créés </a></li>
            <?php } ?>
            <?php if(isset($_SESSION["admin"])) { ?>
                <li id="department"><a href="department.php" >Department</a></li>
                <li id="user"><a href="user.php" >Users</a></li>
            <?php } ?>
        </ul>
		<ul class="nav navbar-nav navbar-right">
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="label label-pill label-danger count"></span> 
				<img src="//gravatar.com/avatar/<?php echo sha1($user['email']); ?>?s=100" width="20px">&nbsp;<?php if(isset($_SESSION["userid"])) { echo $user['name']; } ?></a>
				<ul class="dropdown-menu">					
					<li><a href="logout.php">Logout</a></li>
				</ul>
			</li>
		</ul>
	</div>
</nav>
</body>
</html>