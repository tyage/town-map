$(function() {
	$('#MailCheck').mailCheck();
	setInterval(function() {
		$('#MailCheck').mailCheck();
	}, 10*1000);
});

$.fn.extend({
	mailCheck: function() {
		return this.each(function() {
			var self = this;
			$.ajax({
				url: '/town_dev/mails/check',
				dataType: 'json',
				success: function(data) {
					var count = data.count,
						newMail = count - ($('.text', self).text() || 0);
					if (newMail > 0) {
						$.pnotify({
							pnotify_title: 'メールを受信しました',
							pnotify_text: '新しいメールが'+newMail+'件届いています'
						});
					}
					count > 0 ? $(self).show() : $(self).hide();
					
					$('.text', self).text(count);
				}
			})
		});
	}
});