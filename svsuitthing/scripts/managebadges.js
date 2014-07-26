$(function() {
	$('.tooltipped').tooltip();
	$('#badgeGroup').selectpicker();
	$('.admin_table').DataTable();
	$('#expirationDate').datetimepicker({
		pickTime: false
	});

	$('#badgeForm').submit(function(event) {
		event.preventDefault();
		var formData = $(this).serialize();
		$.post("lib/badge.php", formData, function( data ) {
			alert(data);
	  		location.reload();
		});
	});

	$('#newBadgeBtn').click(function() {
		$('#badgeFormSubmit').html('Add');
		var tab = $('ul.nav-tabs').find('li.active a');
		var groupName = tab.html();
		var groupId = tab.attr('href').match(/\d+$/)[0];
		$('#myModalLabel').html("Add New Badge to " + groupName);
		$('#action').val('add');
		$('#studentForm').find('input[type=text], textarea, select').val('');
		$('#badgeFormDelete').hide();
		$('#groupId').val(groupId);
		$.getJSON("lib/badgegroup.php?groupId=" + groupId, function(data) {
			var html = "";
			for(var i = 0; i < data.length; i++) {
				html += '<option value="' + data[i].badgegroupId + '">' + data[i].badgegroupName + '</option>';
			}
			$('#badgeGroup').html(html);
			$('#badgeGroup').selectpicker('refresh');
		});
	});

	$('#badgeFormSubmit').click(function() {
		$("#badgeForm").submit();
	});
});
