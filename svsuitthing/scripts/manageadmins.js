$(function() {
	$.validator.messages.required = 'Required';
	var validator = 
	$('#adminForm').validate({
	    rules: {
	        firstName: "required",
	        lastName: "required",
	        username: "required",
	        tempPassword: "required"
	    },
	    highlight: function(element) {
	        $(element).closest('.form-group').addClass('has-error');
	    },
	    unhighlight: function(element) {
	        $(element).closest('.form-group').removeClass('has-error');
	    }
	});

	$('.selectpicker').selectpicker();
	$('#adminForm').submit(function(event) {
		event.preventDefault();
		if($(this).valid()) {
			var formData = $(this).serialize();
			$.post("lib/admin.php", formData, function( data ) {
		  		location.reload();
			});
		}
	});

	$('#newAdminBtn').click(function() {
		validator.resetForm();
		$('.form-group').removeClass('has-error');
		$('#adminFormSubmit').html('Add');
		$('#myModalLabel').html("Add New Administrator");
		$('#action').val('add');
		$('#adminForm').find('input[type=text], textarea, select').val('');
		$('input[name="permissions"][value="group"]').prop('checked', true);
		$('#groups').prop('disabled', false);
		$('#groups').selectpicker('deselectAll');
		$('#groups').selectpicker('refresh');
		$('#adminFormDelete').hide();
		$('#generatePassword').show();
		$('#resetPassword').hide();
		$('#tempPassword').prop('disabled', false);
	});
	
	$('.admin_table tr:not(#tableHeader)').click(function() {
		validator.resetForm();
		$('.form-group').removeClass('has-error');
		var adminId = $(this).find('td.adminId').html();
		$('#myModalLabel').html("Edit Administrator #" + adminId);
		$('#adminFormSubmit').html('Save Changes');
		$('#action').val('modify');
		$('#adminId').val(adminId);
		$('#adminFormDelete').show();
		$('#generatePassword').hide();
		$('#resetPassword').show();
		$('#tempPassword').val('');	
		$('#tempPassword').prop('disabled', true);
		$('#groups').selectpicker('deselectAll');
		$.getJSON("lib/admin.php?adminId=" + adminId, function(data) {
			$('#firstName').val(data.firstName);
			$('#lastName').val(data.lastName);
			$('#username').val(data.username);
			$('input[name="permissions"]:checked').prop('checked', false);
			$('input[name="permissions"][value="' + data.permissions + '"]').prop('checked', true);
			if(data.permissions == 'group') {
				$('#groups').prop('disabled', false);
				$('#groups').selectpicker('val', data.groups);
			}
			else {
				$('#groups').prop('disabled', true);
			}
			$('#groups').selectpicker('refresh');
		});
		$('#adminModal').modal('show');
	});

	$('#resetPassword').click(function() {
		$('#resetPassword').hide();
		$('#generatePassword').show();
		$('#tempPassword').prop('disabled', false);
	});
	$('#generatePassword').click(function() {
		$('#tempPassword').val(randomString(6));
	});

	$('input:radio[name="permissions"]').change(function() {
		if($(this).val() == 'group') {
			$('#groups').prop('disabled', false);
		}
		else {
			$('#groups').prop('disabled', true);
		}
		$('#groups').selectpicker('deselectAll');
		$('#groups').selectpicker('refresh');
	});
	$('#adminFormSubmit').click(function() {
		$("#adminForm").submit();
	});
	$('#adminFormDelete').click(function() {
		$('#action').val('delete');
		$("#adminForm").submit();
	});
});

function randomString(length)
{
    var str = "";
    var characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    for(var i=0; i < length; i++)
        str += characters.charAt(Math.floor(Math.random() * characters.length));
    return str;
}