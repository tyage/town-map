var getSelf = function(callback) {
	if (callback) {
		if (getSelf.self) {
			return getSelf.self;
		} else {
			$.ajax({
				url: '/town_dev/users/self/',
				dataType: 'json',
				success: function(user) {
					getSelf.self = user;
					callback(user);
				},
				error: function() {
					callback(null);
				}
			});
		}
	}

	return getSelf.self;
};

$(function() {
	$('.switch').switchForm();
	$('a.window').live('click', function() {
		$(this).openWindow();
		return false;
	});
});

$.fn.extend({
	switchForm: function() {
		return this.each(function() {
			var self = this;
			$('.switch-content', this).each(function() {
				var name = $(this).attr('name');
				$('.switch-trigger[name='+name+']', self).data('content', this);
				$(this).filter(':not(.default)').remove();
			});
			
			$('.switch-trigger', this).click(function() {
				$('.switch-trigger', self).removeClass('selected');
				$(this).addClass('selected');
				
				$('.switch-content', self).remove();
				$(self).append($(this).data('content'));
			})
		})
	},
	openWindow: function() {
		return this.each(function() {
			var href = $(this).attr('href'),
				bodyWidth = $(document).width(),
				bodyHeight = $(document).height(),
				width = 500,
				height = 500,
				x = (bodyWidth - width) / 2,
				y = (bodyHeight - height) / 2,
				option = "width=" + width + 
					",height=" + height + 
					",left=" + x + 
					",top=" + y;
			window.open(href, "window"+href, option);
		});
	}
})