$(function() {
	$('#groupForm').submit(function(event) {
		event.preventDefault();
		var formData = $(this).serialize();
		$.post("lib/group.php", formData, function( data ) {
	  		location.reload();
		});
	});

	$('#newGroupBtn').click(function() {
		$('#groupFormSubmit').html('Add');
		$('#myModalLabel').html("Add New Group");
		$('#action').val('add');
		$('#groupName').val('');
		$('#groupFormDelete').hide();
	});
	
	$('.admin_table tr:not(#tableHeader)').click(function() {
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