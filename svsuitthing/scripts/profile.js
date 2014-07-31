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
	
	$('#editStudent').click(function() {
		var tab = $('ul.nav-tabs').find('li.active a');
		var studentId = tab.attr('href').match(/\d+$/)[0];
		$.getJSON("lib/student.php?studentId=" + studentId, function(data) {
			$('#expGradDate').val(data.expextedGraduation);
			$('#aboutMe').html(data.aboutMe);
		});
		$('#editModal').modal('show');
	});
	
	$('#expGradDate').datetimepicker({
		pickTime: false
	});
});