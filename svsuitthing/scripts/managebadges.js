$(function() {
	$('.tooltipped').tooltip();
	$('#badgeGroup').selectpicker();
	$('#difficulty').selectpicker();
	$('.admin_table').DataTable();
	$('#expirationDate').datetimepicker({
		pickTime: false
	});

	$('#badgeForm').submit(function(event) {
		event.preventDefault();
		var formData = $(this).serialize();
		$.ajax( {
			url: "lib/badge.php",
			type: 'post',
			data: new FormData(this),
			processData: false,
			contentType: false
		}).done(function(data) {
			location.reload(); 
		});
	});

	$("#badgegroupForm").submit(function(event) {
		event.preventDefault();
		var formData = $(this).serialize();
		$.post("lib/badgegroup.php", formData, function(data) {
			alert(data);
			location.reload();
		});
	})
	$('#newBadgeBtn').click(function() {
		$('#badgeFormSubmit').html('Add');
		var tab = $('ul.nav-tabs').find('li.active a');
		var groupName = tab.html();
		var groupId = tab.attr('href').match(/\d+$/)[0];
		$('#badgeModalLabel').html("Add New Badge to " + groupName);
		$('.fileinput-preview.thumbnail').html('');
		$('#action').val('add');
		$('#badgeForm').find('input[type=text], textarea, select').val('');		
		$('#badgeFormDelete').hide();
		$('#groupId').val(groupId);
		$('input[name="permissions"][value="Standard"]').prop('checked', true);
		$('#expirationDate').prop('disabled', true);
		fillBadgeGroups(groupId);
		$('#difficulty').selectpicker('refresh');
	});

	$('.admin_table tr:not(#tableHeader)').click(function() {
		var badgeId = $(this).attr('id');
		var tab = $('ul.nav-tabs').find('li.active a');
		var groupId = tab.attr('href').match(/\d+$/)[0];
		$('#badgeModalLabel').html("Edit Badge #" + badgeId);
		$('#badgeFormSubmit').html('Save Changes');
		$('#action').val('modify');
		$('#badgeId').val(badgeId);
		$('#groupId').val(groupId);
		$('#badgeFormDelete').show();
		fillBadgeGroups(groupId);
		$.getJSON("lib/badge.php?badgeId=" + badgeId, function(data) {
			$('.fileinput-preview.thumbnail').html('<img src="images/badges/' + data.imageFile + '">');
			$('#existingImage').val(data.imageFile);
			$('#badgeName').val(data.badgeName);
			$('#badgeDescription').val(data.badgeDescription);
			$('#username').val(data.username);
			$('#badgeGroup').selectpicker('val', data.badgegroupId);
			$('#difficulty').selectpicker('val', data.difficulty);
			$('input[name="badgeType"]:checked').prop('checked', false);
			$('input[name="badgeType"][value="' + data.badgeType + '"]').prop('checked', true);
			if(data.badgeType == 'Recurring') {
				$('#expirationDate').prop('disabled', false);
				$('#expirationDate').val(data.expirationDate);
			}
			else {
				$('#expirationDate').prop('disabled', true);
			}
			$('#badgeGroup').selectpicker('refresh');
			$('#difficulty').selectpicker('refresh');
		});
		$('#badgeModal').modal('show');
	});

	$('input:radio[name="badgeType"]').change(function() {
		if($(this).val() == 'Recurring') {
			$('#expirationDate').prop('disabled', false);
		}
		else {
			$('#expirationDate').prop('disabled', true);
		}
		$('#expirationDate').val('');
	});

	$('#badgeFormSubmit').click(function() {
		$("#badgeForm").submit();
	});

	$('#badgeFormDelete').click(function() {
		$('#action').val('delete');
		$("#badgeForm").submit();
	});

	$("#badgegroupFormSubmit").click(function() {
		$("#badgegroupForm").submit();
	});

	$("#chooseExistingBtn").click(function() {
		$('#badgeImageModal').modal('show');
	});

	$("#manageBadgegroupsBtn").click(function() {
		var tab = $('ul.nav-tabs').find('li.active a');
		var groupId = tab.attr('href').match(/\d+$/)[0];
		var groupName = tab.html();
		$('#badgegroup_groupId').val(groupId);
		$('#badgegroupModalLabel').html("Manage Badge Groups for " + groupName);
		$.getJSON("lib/badgegroup.php?groupId=" + groupId, function(data) {
			var html = "";
			for(var i = 0; i < data.length; i++) {
				html += '<div class="form-group"><label class="col-md-3 control-label">Badge Group #' + (i + 1) + '</label><div class="col-md-5"><input type="text" class="form-control badgegroupName" name="badgegroupName[]" placeholder="Name" value="' + data[i].badgegroupName + '"></div><div class="col-md-4 input-group color"><input type="text" value="' + data[i].color + '" class="form-control badgegroupColor" name="badgegroupColor[]" placeholder="Color" /><span class="input-group-addon"><i></i></span></div></div><input type="hidden" name="badgegroupId[]" value="' + data[i].badgegroupId + '">';
			}
			$('#badgegroupForm').append(html);
			$('.color').colorpicker();
		});
	});

	$('.badgeImage').click(function() {
		var imgSrc = $(this).attr('src');
		$('.fileinput-preview.thumbnail').html('<img src="' + imgSrc + '">');
		$('#existingImage').val(imgSrc.substr(imgSrc.lastIndexOf('/') + 1));
		$('#badgeImageModal').modal('hide');
	});
});

function fillBadgeGroups(groupId) {
	$.getJSON("lib/badgegroup.php?groupId=" + groupId, function(data) {
		var html = "";
		for(var i = 0; i < data.length; i++) {
			html += '<option value="' + data[i].badgegroupId + '">' + data[i].badgegroupName + '</option>';
		}
		$('#badgeGroup').html(html);
		$('#badgeGroup').selectpicker('refresh');
	});
}
