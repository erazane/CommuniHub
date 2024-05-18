$(document).ready(function(){	
	var userRecords = $('#userListing').DataTable({
		"lengthChange": false,
		"processing":true,
		"serverSide":true,		
		"bFilter": false,
		'serverMethod': 'post',		
		"order":[],
		"ajax":{
			url:"action.php",
			type:"POST",
			data:{action:'userListing'},
			dataType:"json"
		},
		"columnDefs":[
			{
				"targets":[0, 4, 5],
				"orderable":false,
			},
		],
		"pageLength": 10
	});		
	
	
	$('#addUser').click(function(){
		$('#userModal').modal({
			backdrop: 'static',
			keyboard: false
		});		
		$("#userModal").on("shown.bs.modal", function () {
			$('#userForm')[0].reset();			
			$('.modal-title').html("<i class='fa fa-plus'></i> Add User");					
			$('#action').val('addUser');
			$('#save').val('Save');
		});
	});		
	
	$("#userListing").on('click', '.update', function(){
		var id = $(this).attr("id");
		var action = 'getUserDetails';
		$.ajax({
			url:'action.php',
			method:"POST",
			data:{id:id, action:action},
			dataType:"json",
			success:function(respData){				
				$("#userModal").on("shown.bs.modal", function () { 
					$('#userForm')[0].reset();
					respData.data.forEach(function(item){						
						$('#id').val(item['user_id']);						
						$('#userName').val(item['name']);
						$('#userEmail').val(item['email']);	
						$('#usergroup').val(item['usergroup']);
					});														
					$('.modal-title').html("<i class='fa fa-plus'></i> Edit User");
					$('#action').val('updateUser');
					$('#save').val('Save');
				}).modal({
					backdrop: 'static',
					keyboard: false
				});			
			}
		});
	});
	
	$("#userModal").on('submit','#userForm', function(event){
		event.preventDefault();
		$('#save').attr('disabled','disabled');
		var formData = $(this).serialize();
		$.ajax({
			url:"action.php",
			method:"POST",
			data:formData,
			success:function(data){				
				$('#userForm')[0].reset();
				$('#userModal').modal('hide');				
				$('#save').attr('disabled', false);
				userRecords.ajax.reload();
			}
		})
	});		

	$("#userListing").on('click', '.delete', function(){
		var id = $(this).attr("id");		
		var action = "deleteUser";
		if(confirm("Are you sure you want to delete this record?")) {
			$.ajax({
				url:"action.php",
				method:"POST",
				data:{id:id, action:action},
				success:function(data) {					
					userRecords.ajax.reload();
				}
			})
		} else {
			return false;
		}
	});	
});