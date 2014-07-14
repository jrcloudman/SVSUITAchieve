$(function() {
	$('#adminForm').submit(function(event) {
		event.preventDefault();
		var formData = $(this).serialize();
		$.post("lib/admin.php", formData, function( data ) {
	  		location.reload();
		});
	});

	$('#newAdminBtn').click(function() {
		$('#groupFormSubmit').html('Add');
		$('#myModalLabel').html("Add New Administrator");
		$('#action').val('add');
		$('#adminForm').find('input[type=text], textarea, select').val('');
		$('.selectpicker').selectpicker('deselectAll');
		$('#adminFormDelete').hide();
	});
	
	$('.admin_table tr:not(#tableHeader)').click(function() {
		var adminId = $(this).find('td.adminId').html();
		$('#myModalLabel').html("Edit Administrator #" + adminId);
		$('#adminFormSubmit').html('Save Changes');
		$('#action').val('modify');
		$('#adminId').val(adminId);
		$('#adminFormDelete').show();
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