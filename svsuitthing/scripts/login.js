$(function() {
	$('#loginForm').submit(function(event) {
		event.preventDefault();
		var formData = $(this).serialize();
		$.post("lib/validatelogin.php", formData, function(data) {
			if(data == 'valid') {
	  			window.location.href = "index.php";
	  		}
	  		else if(data == 'invalid') {
	  			$('#loginAlert').show();
	  		}
		});
	});
});