$(document).ready(function() {        
	
	var userData = $('#listUser').DataTable({
		"searching": false,
		"lengthChange": false,
		"processing":true,
		"serverSide":true,
		"order":[],
		"ajax":{
			url:"user_action.php",
			type:"POST",
			data:{action:'listUser'},
			dataType:"json"
		},
		"columnDefs":[
			{
				"targets":[0, 6, 7],
				"orderable":false,
			},
		],
		"pageLength": 10
	});	

	$(document).on('click', '.update', function(){
		var userId = $(this).attr("id");
		var action = 'getUserDetails';
		$.ajax({
			url:'user_action.php',
			method:"POST",
			data:{userId:userId, action:action},
			dataType:"json",
			success:function(data){
				$('#userModal').modal('show');
				$('#userId').val(data.id);
				$('#userName').val(data.name);
				$('#email').val(data.email);
				$('#role').val(data.user_type);
				$('#status').val(data.status);				
				$('.modal-title').html("<i class='fa fa-plus'></i> Edit User");
				$('#action').val('updateUser');
				$('#save').val('Save');
			}
		})
	});		
	
	$('#addUser').click(function(){
		$('#userModal').modal('show');
		$('#userForm')[0].reset();
		$('.modal-title').html("<i class='fa fa-plus'></i> Add User");
		$('#action').val('addUser');
		$('#save').val('Save');
	});	
		
	$(document).on('submit','#userForm', function(event){
		event.preventDefault();
		$('#save').attr('disabled','disabled');
		var formData = $(this).serialize();
		$.ajax({
			url:"user_action.php",
			method:"POST",
			data:formData,
			success:function(data){				
				$('#userForm')[0].reset();
				$('#userModal').modal('hide');				
				$('#save').attr('disabled', false);
				userData.ajax.reload();
			}
		})
	});			
			
	$(document).on('click', '.delete', function(){
		var userId = $(this).attr("id");		
		var action = "deleteUser";
		if(confirm("Are you sure you want to delete this record?")) {
			$.ajax({
				url:"user_action.php",
				method:"POST",
				data:{userId:userId, action:action},
				success:function(data) {					
					userData.ajax.reload();
				}
			})
		} else {
			return false;
		}
	});	
    
});

