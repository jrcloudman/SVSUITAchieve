$(function() {
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
});

$(function() {
	$('#editStudent').click(function(){
		$('#editModal').modal('show');
	});
});

$(function() {
	$('#expGradDate').datetimepicker({
		pickTime: false
	});
});