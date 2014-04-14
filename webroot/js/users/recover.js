$(function () {
	recover();
	setInterval(function () {
		recover();
	}, 30*1000);
});

var recover = function () {
	var self = this;
	$.ajax({
		url: '/town_dev/users/recover/',
		dataType: 'json',
		success: function (data) {
			if (data.spirit > 0 || data.energy > 0) {
				$.pnotify({
					pnotify_title: '回復しました',
					pnotify_text: '身体：+'+data.energy+', 精神：+'+data.spirit
				});
			}
		}
	});
};