$(function() {
	$('#profileForm').submit(function(event) {
		event.preventDefault();
		var formData = $(this).serialize();
		$.post("lib/student.php", formData, function( data ) {
			alert(data);	
	  		location.reload();
		});
	});
	$('.tooltipped').tooltip();
	$('.badgeImage').tooltip();
	$('.badgeImage').click(function() {
		if($(this).hasClass('faded')) {
			$(this).removeClass('faded');
		}
		else {
			$(this).addClass('faded');
		}
	});
	
	$('#editStudent').click(function(){
		$('#editModal').modal('show');
	});
	
	$('#expGradDate').datetimepicker({
		pickTime: false
	});
});