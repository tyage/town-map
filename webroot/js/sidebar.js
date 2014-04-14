$(function() {
	$('#Sidebar li').hover(
		function(){
			$(this).stop().animate({
				marginLeft: -30,
				opacity: 1
			},200);
		},
		function(){
			$(this).stop().filter(':not(.selected)').animate({
				marginLeft: -50,
				opacity: 0.6
			},200);
		}
	);
	$('#Sidebar li').click(function(e) {
		var selected = $(this).is('.selected');
		
		e.preventDefault();
		
		$(this)
			.toggleClass('selected')
			.siblings().removeClass('selected').mouseleave();
		
		$('#Side').animate({
			left: selected ? 0 : 700
		});
		
		if (!selected) {
			$('#SideLoading').show();
			$('#SideFrame').hide()
				.attr('src', $(this).find('a').attr('href'))
				.load(function () {
					$('#SideLoading').hide();
					$('#SideFrame').show();
				});
		}
	});
});
