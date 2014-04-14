$(function() {
	getSelf(function(self) {
		if (self && Map.users[self.User.id]) {
			//Map.users[self.User.id].$unit.attr('id', 'self');
		}
		
		google.maps.event.addListener(Map.map, 'center_changed', function() {
			var latlng = Map.map.getCenter();
			moveUser(latlng);
		});
	});
});

var moveUser = function(latlng) {
	var self = getSelf();
	Map.users[self.User.id].setPosition(latlng);
	
	if (moveUser.moving) {
		moveUser.last = latlng;
		return false;
	}
	moveUser.moving = true;
	
	$.ajax({
		url: '/town_dev/users/move/'+latlng.lat()+"/"+latlng.lng(),
		complete: function() {
			moveUser.moving = false;
			
			if (moveUser.last) {
				moveUser(moveUser.last);
			}
			moveUser.last = null;
		}
	});
};
