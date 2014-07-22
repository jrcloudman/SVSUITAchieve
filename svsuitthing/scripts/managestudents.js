$(function() {	
	$('#startDate').datetimepicker({
		pickTime: false
	});

	$('#studentForm').submit(function(event) {
		event.preventDefault();
		var formData = $(this).serialize();
		$.post("lib/student.php", formData, function( data ) {
	  		location.reload();
		});
	});

	$('#newStudentBtn').click(function() {
		$('#studentFormSubmit').html('Add');
		var tab = $('ul.nav-tabs').find('li.active a');
		var groupName = tab.html();
		var groupId = tab.attr('href').slice(-1);
		$('#myModalLabel').html("Add New Student to " + groupName);
		$('#action').val('add');
		$('#studentForm').find('input[type=text], textarea, select').val('');
		$('#studentFormDelete').hide();
		$('#generatePassword').show();
		$('#resetPassword').hide();
		$('#tempPassword').prop('disabled', false);
		$('#groupId').val(groupId);
	});
	
	$('.admin_table tr:not(#tableHeader)').click(function() {
		var studentId = $(this).find('td.studentId').html();
		$('#myModalLabel').html("Edit Student #" + studentId);
		$('#adminFormSubmit').html('Save Changes');
		$('#action').val('modify');
		$('#studentId').val(studentId);
		$('#studentFormDelete').show();
		$('#generatePassword').hide();
		$('#resetPassword').show();
		$('#tempPassword').val('');	
		$("#tempPassword").prop('disabled', true);
		$.getJSON("lib/student.php?studentId=" + studentId, function(data) {
			$('#firstName').val(data.firstName);
			$('#lastName').val(data.lastName);
			$('#username').val(data.username);
			$('#startDate').val(data.startDate);
		});
		$('#studentModal').modal('show');
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
		if($(this).val() == '2') {
			$('#groups').prop('disabled', false);
		}
		else {
			$('#groups').prop('disabled', true);
		}
		$('#groups').selectpicker('deselectAll');
		$('#groups').selectpicker('refresh');
	});
	$('#studentFormSubmit').click(function() {
		$("#studentForm").submit();
	});
	$('#studentFormDelete').click(function() {
		$('#action').val('delete');
		$("#studentForm").submit();
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