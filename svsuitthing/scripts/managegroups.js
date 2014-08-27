$(function() {
	$.validator.messages.required = 'Required';
	var validator = 
	$('#groupForm').validate({
	    rules: {
	        groupName: "required"
	    },
	    highlight: function(element) {
	        $(element).closest('.form-group').addClass('has-error');
	    },
	    unhighlight: function(element) {
	        $(element).closest('.form-group').removeClass('has-error');
	    }
	});

	$('#groupForm').submit(function(event) {
		event.preventDefault();
		if($(this).valid()) {
			var formData = $(this).serialize();
			$.post("lib/group.php", formData, function( data ) {
		  		location.reload();
			});
		}
	});

	$('#newGroupBtn').click(function() {
		validator.resetForm();
		$('.form-group').removeClass('has-error');
		$('#groupFormSubmit').html('Add');
		$('#myModalLabel').html("Add New Group");
		$('#action').val('add');
		$('#groupName').val('');
		$('#groupFormDelete').hide();
	});
	
	$('.admin_table tbody tr').click(function() {
		validator.resetForm();
		$('.form-group').removeClass('has-error');
		var groupId = $(this).find('td.groupId').html();
		$('#myModalLabel').html("Edit Group #" + groupId);
		$('#groupFormSubmit').html('Save Changes');
		$('#groupName').val($(this).find('td.groupName').html());
		$('#action').val('modify');
		$('#groupId').val(groupId);
		$('#groupFormDelete').show();
		$('#adminModal').modal('show');
	});

	$('#groupFormSubmit').click(function() {
		$("#groupForm").submit();
	});
	$('#groupFormDelete').click(function() {
		$('#action').val('delete');
		$("#groupForm").submit();
	});
});