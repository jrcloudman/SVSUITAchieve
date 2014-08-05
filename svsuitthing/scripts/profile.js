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