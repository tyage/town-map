$(function() {
	$('#select').hide();
	
	if (window.opener) {
		$('#select').show()
			.bind('click', function() {
				var id = $('#imageId').text(),
					filepath = $('#image').attr('src');
				$(window.opener.document).find('#imageId').val(id)
					.end().find('#imagePreview').attr('src', filepath);
				
				return false;
			});
	}
});
