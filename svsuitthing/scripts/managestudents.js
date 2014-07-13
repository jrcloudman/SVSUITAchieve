$(function() {
	$('#addStudentSubmit').click(function() {
		$("#studentForm").submit();
	});
	$("#studentForm").submit(function(event) {
		alert('submit');
		event.preventDefault();
		var formData = $(this).serialize() + '&action=add&groupId=0';
	    $.ajax({
	        url: "lib/student.php",
	        type: "post",
	        data: formData,
	        success: function(data){
	        	alert(data);
	            alert("success");
	        },
	        error:function(){
	            alert("failure");
	        }
	    });
	});
});