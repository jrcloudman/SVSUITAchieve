$(function() {
	$.validator.messages.required = 'Required';
	var validator = 
	$('#changePassForm').validate({
	    rules: {
	        oldPassword: "required",
	        newPassword: "required",
	        confirmNewPassword: {required: true, equalTo: "#newPassword"},
	    },
		messages: {
			confirmNewPassword: {equalTo: "Passwords must match"}
		},
	    highlight: function(element) {
	        $(element).closest('.form-group').addClass('has-error');
	    },
	    unhighlight: function(element) {
	        $(element).closest('.form-group').removeClass('has-error');
	    }
	});

	$('#changePassForm').submit(function(event) {
		$('.alert').hide();
		event.preventDefault();
		if($(this).valid()) {
			var formData = $(this).serialize();
			$.post("lib/passchange.php", formData, function(data) {
				if(data == 'valid') {
		  			$('#validAlert').show();
		  		}
		  		else if(data == 'invalid') {
		  			$('#invalidAlert').show();
		  		}
	  			$('#changePassForm').find('input[type=password]').val('');
			});
		}
	});
});