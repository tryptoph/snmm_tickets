<?php 
include 'init.php'; 
if(!$users->isLoggedIn()) {
	header("Location: authenticate.php");	
}
include('inc/header.php');
$ticketDetails = $tickets->ticketInfo($_GET['id']);
$ticketReplies = $tickets->getTicketReplies($ticketDetails['id']);
$user = $users->getUserInfo();
$tickets->updateTicketReadStatus($ticketDetails['id']);
?>	
<title>Build Helpdesk System with PHP & MySQL</title>
<script src="js/general.js"></script>
<script src="js/tickets.js"></script>
<link rel="stylesheet" href="css/style.css" />
<?php include('inc/container.php');?>
<div class="container">
	<div class="row home-sections">
	<h2>Helpdesk System</h2>	
	<?php include('menus.php'); ?>		
	</div> 
	
	<section class="comment-list">          
		<article class="row">            
			<div class="col-md-10 col-sm-10">
				<div class="panel panel-default arrow left">
					<div class="panel-heading right">
					<?php if($ticketDetails['resolved']) { ?>
					<button type="button" class="btn btn-danger btn-sm">
					  <span class="glyphicon glyphicon-eye-close"></span> Closed
					</button>
					<?php } else { ?>
					<button type="button" class="btn btn-success btn-sm">
					  <span class="glyphicon glyphicon-eye-open"></span> Open
					</button>
					<?php } ?>
					<span class="ticket-title"><?php echo $ticketDetails['title']; ?></span>
					</div>
					<div class="panel-body">						
						<div class="comment-post">
						<p>
						<?php echo $ticketDetails['message']; ?>
						</p>
						</div>                 
					</div>
					<div class="panel-heading right">
						<span class="glyphicon glyphicon-time"></span> <time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> <?php echo $time->ago($ticketDetails['date']); ?></time>
						&nbsp;&nbsp;<span class="glyphicon glyphicon-user"></span> <?php echo $ticketDetails['creater']; ?>
						&nbsp;&nbsp;<span class="glyphicon glyphicon-briefcase"></span> <?php echo $ticketDetails['department']; ?>
					</div>
				</div>			 
			</div>
		</article>		
		
		<?php foreach ($ticketReplies as $replies) { ?>		
			<article class="row">
				<div class="col-md-10 col-sm-10">
					<div class="panel panel-default arrow right">
						<div class="panel-heading">
							<?php if($replies['user_type'] == 'admin') { ?>							
								<span class="glyphicon glyphicon-user"></span> <?php echo $ticketDetails['department']; ?>
							<?php } else { ?>
								<span class="glyphicon glyphicon-user"></span> <?php echo $replies['creater']; ?>
							<?php } ?>
							&nbsp;&nbsp;<span class="glyphicon glyphicon-time"></span> <time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> <?php echo $time->ago($replies['date']); ?></time>							
						</div>
						<div class="panel-body">						
							<div class="comment-post">
							<p>
							<?php echo $replies['message']; ?>
							</p>
							</div>                  
						</div>
						
					</div>
				</div>            
			</article> 		
		<?php } ?>
		
		<form method="post" id="ticketReply">
			<article class="row">
				<div class="col-md-10 col-sm-10">				
					<div class="form-group">							
						<textarea class="form-control" rows="5" id="message" name="message" placeholder="Enter your reply..." required></textarea>	
					</div>				
			</div>
			</article>  
			<article class="row">
				<div class="col-md-10 col-sm-10">
					<div class="form-group">							
						<input type="submit" name="reply" id="reply" class="btn btn-success" value="Reply" />		
					</div>
				</div>
			</article> 
			<input type="hidden" name="ticketId" id="ticketId" value="<?php echo $ticketDetails['id']; ?>" />	
			<input type="hidden" name="action" id="action" value="saveTicketReplies" />			
		</form>
	</section>	
	<?php include('add_ticket_model.php'); ?>
</div>
<?php include('inc/footer.php');?>