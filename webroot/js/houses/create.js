Map.start.push(function() {
	var lat = $('#HouseLat').val(),
		lng = $('#HouseLng').val(),
		latlng = new google.maps.LatLng(lat, lng);
	
	var marker = new google.maps.Marker({
		position: latlng,
		map: Map.map,
		draggable: true,
		zIndex: 1000
	});
	
	Map.afterGetHouse.push(function() {
		var house_id = $('#HouseId').val(),
			house;
		
		if (house_id) {
			$.each(Map.units, function(i, unit) {
				if (unit.house_id === house_id) {
					house = unit;
					return false;
				}
			});
		}
		
		var changePosition = function() {
			var position = marker.getPosition(),
				lat = position.lat(),
				lng = position.lng(),
				latlng = new google.maps.LatLng(lat, lng);
			
			$('#HouseLat').val(lat);
			$('#HouseLng').val(lng);
			
			if (house) {
				house.setPosition(latlng);
			}
		};
		changePosition();
		google.maps.event.addListener(marker, 'position_changed', function() {
			changePosition();
		});
	});
});