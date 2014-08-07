$(function() {
	$('#profileForm').submit(function(event) {
		event.preventDefault();
		var formData = $(this).serialize();
		$.ajax( {
			url: "lib/student.php",
			type: 'post',
			data: new FormData(this),
			processData: false,
			contentType: false
		}).done(function(data) {
			alert(data);
			location.reload(); 
		});
	});
	$('.tooltipped').tooltip();
	$('.badgeImage').tooltip();
	$('.manageableBadge').click(function() {
		var image = $(this);
		var id = $(this).attr('id');
		var studentId = id.substring(0, id.indexOf('_'));
		var badgeId = id.substring(id.indexOf('_') + 1)
		var postData = "studentId=" + studentId + "&badgeId=" + badgeId + "&action="; 

		if($(this).hasClass('faded')) {
			postData += "award";
			$.post("lib/awardbadge.php", postData, function(data) {
				image.removeClass('faded');
			});
		}
		else {
			postData += "remove";
			$.post("lib/awardbadge.php", postData, function(data) {
				image.addClass('faded');
			});
		}
	});
	
	$('.editProfileLink').click(function() {
		var tab = $('ul.nav-tabs').find('li.active a');
		var studentId = tab.attr('href').match(/\d+$/)[0];
		$('#studentId').val(studentId);
		$.getJSON("lib/student.php?studentId=" + studentId, function(data) {
			var profileImage;
			if(data.profileImage != null) {
				profileImage = data.profileImage;
			}
			else {
				profileImage = "profileDefault.jpg";
			}
			$('.fileinput-preview.thumbnail').html('<img src="images/profile/' + profileImage + '">');
			$('#expGradDate').val(data.expectedGraduation);
			$('#aboutMe').html(data.aboutMe);
			$('#major').val(data.major);
			$('#minor').val(data.minor);
		});
		$('#editModal').modal('show');
	});
	
	$('#expGradDate').datetimepicker({
		pickTime: false
	});
});