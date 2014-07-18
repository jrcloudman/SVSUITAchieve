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
	$('#editLink').click(function() {
		$('#adminModal').modal('show');
	});
});