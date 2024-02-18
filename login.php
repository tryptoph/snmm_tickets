<?php 
include 'init.php';
if($users->isLoggedIn()) {
	header('Location: ticket.php');
}

$errorMessage = $users->login();
include('inc/header.php');
?>
<title>snmm système de gestion des réclamations with PHP & MySQL</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="css/style2.css">
<link rel="icon" type="image/png" href="css/favicon.png">



<div class="all">
<?php include('inc/container.php');?>

<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;" >
	<div class="col-md-6">
	<h1 align="center" ></h1>	
		<div class="panel panel-info" >
			<div class="panel-heading" style="background:#00796B;color:white;
			">
				<div class="panel-title text-center"><h1> Système de gestion des réclamations </h1>Login</div>                        
			</div> 
			<div style="padding-top:30px" class="panel-body" >
				<?php if ($errorMessage != '') { ?>
					<div id="login-alert" class="alert alert-danger col-sm-12"
					style="font-size:20px"><?php echo $errorMessage; ?></div>                            
				<?php } ?>
				<form id="loginform" class="form-horizontal" role="form" method="POST" action="">                                    
					<div style="margin-bottom: 25px" class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user" style="right:6.5px"
						></i></span>
						<input type="text" class="form-control" id="email" name="email" placeholder="email" style="background:white;"
						style="margin-left: 25px" required>                                        
					</div>                                
					<div style="margin-bottom: 25px" class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-lock" style="right:6.5px" ></i></span>
						<input type="password" class="form-control" id="password" name="password"placeholder="password"  required>
					</div>
					<div style="margin-top:10px" class="form-group">                               
						<div class="col-sm-12 controls" >
						<input type="submit" name="login" value="Login" class="btn btn-success"
						  style="font-size:25px;" ></div>




						<div class="forget-btn">
							<button type="button"><a href="forgot-password.php">Password oublié? </a></button>
						
						</div>

					</div>	
					<div style="margin-top:10px" class="form-group">           					
					</div>
						
				</form>   
			</div>                     
		</div> 
	</div>
</div>
</div>


<?php include('inc/footer.php');?>