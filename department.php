<?php 
include 'init.php'; 
if(!$users->isLoggedIn()) {
	header("Location: login.php");	
}
include('inc/header.php');
$user = $users->getUserInfo();
?>
<title>Helpdesk System with PHP & MySQL</title>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>		
<link rel="stylesheet" href="css/dataTables.bootstrap.min.css" />
<script src="js/general.js"></script>
<script src="js/department.js"></script>
<link rel="stylesheet" href="css/style.css" />
<?php include('inc/container.php');?>
<div class="container">	
	<div class="row home-sections">
	<h2>SNMM tickets system</h2>	
	<?php include('menus.php'); ?>		
	</div> 
	
	<div class="panel-heading">
		<div class="row">
			<div class="col-md-10">
				<h3 class="panel-title"></h3>
			</div>
			<div class="col-md-2" align="right">
				<button type="button" name="add" id="addDepartment" class="btn btn-success btn-xs">Add New</button>
			</div>
		</div>
	</div>
			
	<table id="listDepartment" class="table table-bordered table-striped">
		<thead>
			<tr>
				<th>S/N</th>
				<th>Department</th>					
				<th>Status</th>
				<th></th>
				<th></th>									
			</tr>
		</thead>
	</table>
	
	<div id="departmentModal" class="modal fade">
		<div class="modal-dialog">
			<form method="post" id="departmentForm">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title"><i class="fa fa-plus"></i> Add Department</h4>
					</div>
					<div class="modal-body">
						<div class="form-group"
							<label for="department" class="control-label">Department</label>
							<input type="text" class="form-control" id="department" name="department" placeholder="department" required>			
						</div>
						<div class="form-group">
							<label for="status" class="control-label">Status</label>				
							<select id="status" name="status" class="form-control">
							<option value="1">Enable</option>				
							<option value="0">Disable</option>	
							</select>						
						</div>						
						
					</div>
					<div class="modal-footer">
						<input type="hidden" name="departmentId" id="departmentId" />
						<input type="hidden" name="action" id="action" value="" />
						<input type="submit" name="save" id="save" class="btn btn-info" value="Save" />
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>	
<?php include('inc/footer.php');?>