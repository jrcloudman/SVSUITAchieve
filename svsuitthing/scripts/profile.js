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
	
	$('#editStudent').click(function(){
		$('#editModal').modal('show');
	});
	
	$('#expGradDate').datetimepicker({
		pickTime: false
	});
});