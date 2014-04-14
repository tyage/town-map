google.load('maps', 3, {other_params: 'sensor=false'});
$.getScript('/town_dev/js/markerclusterer.js');

var ImagePath = '/town_dev/img/';
var Map = {
	map: null,
	elem: null,
	users: {},
	ready: [],
	start: [],
	units: [],
	afterGetHouse: [],
	reloadCount: 0,
	hasUpdate: false
};

Map.createInfoWindow = function(content) {
	var infoWindow = new google.maps.InfoWindow({
		content: content,
		disableAutoPan: true
	});
	infoWindow.isOpen = false;
	infoWindow.toggle = function() {
		this.isOpen ? 
			this.close() : 
			this.open(Map.map);
		this.isOpen = !this.isOpen;
	};
	google.maps.event.addListener(infoWindow, 'closeclick', function() {
		this.isOpen = false;
	});
	google.maps.event.addListener(infoWindow, 'domready', function() {
		this.isOpen = true;
	});
	return infoWindow;
};

$(function() {
	Map.elem = $('#map').get(0)
	
	var ready = Map.ready;
	for (var i=0,l=ready.length;i<l;++i) {
		ready[i]();
	}
});

// マップ作成
Map.ready.push(function() {
	getSelf(function(self) {
		var latlng = self ? 
			new google.maps.LatLng(self.User.lat, self.User.lng) : 
			new google.maps.LatLng(35, 135);
		var option = {
			zoom: 7,
			center: latlng,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};
		Map.map = new google.maps.Map(Map.elem, option);
		
		var start = Map.start;
		for (var i=0,l=start.length;i<l;++i) {
			start[i]();
		}
	});
});

// overlayUnitの定義
Map.ready.push(function() {
	Map.overlayUnit = function(data) {
		this.setMap(Map.map);
		
		this.image = data.image;
		this.title = data.title;
		this.$image = $('<img src="'+this.image+'" />').addClass('unit-image');
		this.$title = $('<p>'+this.title+'</p>').addClass('unit-title');
		this.$unit = $('<div />').append(this.$image).append(this.$title)
			.addClass('unit').addClass(data.className);
		
		var infoWindow = this.infoWindow = Map.createInfoWindow(data.info);
		this.$unit.click(function () {
			infoWindow.toggle();
		});
		
		this.setPosition(data.latlng);
	};
	Map.overlayUnit.prototype = new google.maps.OverlayView();
	Map.overlayUnit.prototype.onAdd = function() {
		this.getPanes().overlayLayer.appendChild(this.$unit.get(0));
	};
	Map.overlayUnit.prototype.draw = function() {
		var overlayProjection = this.getProjection();
		if (overlayProjection) {
			var pos = overlayProjection.fromLatLngToDivPixel(this.latlng);

			this.$unit.css({
				left: pos.x - this.$image.width()/2,
				top: pos.y - this.$image.height()/2
			})
		}
	};
	Map.overlayUnit.prototype.setPosition = function(latlng) {
		this.latlng = latlng;
		this.infoWindow.setPosition(latlng);
		this.draw();
	};
	Map.overlayUnit.prototype.close = function() {
		this.$unit.hide();
		this.infoWindow.toggle();
	};
	Map.overlayUnit.prototype.onRemove = function() {
		this.$unit.remove();
	};
});

// unit用markerの定義
Map.ready.push(function() {
	Map.markerUnit = function(data) {
		var image = new google.maps.MarkerImage(
			data.image,
			new google.maps.Size(32, 32),
			new google.maps.Point(0,0),
			new google.maps.Point(16, 16)
		);
		var marker = new google.maps.Marker({
			position: data.latlng,
			map: Map.map,
			title: data.title,
			icon: image,
			zIndex: 100,
			draggable: true
		});
		marker.position_changed = function() {
			this.infoWindow.setPosition(this.getPosition());
			
			// マーカー画像を動かす (draggableであれば不要)
			//this.setVisible(true);
		};
		marker.close = function() {
			this.setVisible(false);
			if (this.infoWindow.isOpen) {
				this.infoWindow.toggle();
			}
		};
		
		marker.infoWindow = Map.createInfoWindow(data.info);
		marker.infoWindow.setPosition(data.latlng);
		google.maps.event.addListener(marker, 'click', function() {
			this.infoWindow.toggle();
		});
		return marker;
	};
});

Map.createCluster = function(markers) {
	option = {
		gridSize: 30,
		maxZoom: 6
	};
	if (Map.cluster) {
		Map.cluster.clearMarkers();
	}
	Map.cluster = new MarkerClusterer(Map.map, markers, option);
};

//ユーザーユニットの取得
Map.start.push(function() {
	setTimeout(arguments.callee, 1000*5);
	
	var createInfo = function(user) {
		var self = getSelf();
		return '<p>' + 
				'<img src="' + ImagePath + user.User.image + '" class="unit-image">' + 
				'<a href="/town_dev/iframe/users/view/' + user.User.id + '" class="window">' + user.User.username + '</a>' + 
				(self ? '　<a href="/town_dev/battles/start/' + user.User.id + '">戦う</a>' : '') + 
			'</p>' + 
			'<br>' + 
			'<p class="chat-message">' + (user.Chat.message || '') + '</p>';
	};
	var reloadUser = function(newData) {
		var latlng = new google.maps.LatLng(newData.User.lat, newData.User.lng),
			user = Map.users[newData.User.id];
		
		user.setPosition(latlng);
		if (user.$unit) {
			user.$unit.show();
		}
		
		// チャットで新たな発言があれば表示
		if (hasNewMessage(newData)) {
			user.chatId = newData.Chat.id;
			user.infoWindow.setContent(createInfo(newData));
			if (!user.infoWindow.isOpen) {
				user.infoWindow.toggle();
			}
		}
	};
	var hasNewMessage = function(newData) {
		var user = Map.users[newData.User.id];
		console.log(newData.Chat);
		return user.chatId !== newData.Chat.id && 
			(new Date()).getTime() - Date.parse(newData.Chat.created) < 30*60*1000;
	};
	var createUser = function(user) {
		var id = user.User.id,
			self = getSelf(),
			latlng = new google.maps.LatLng(user.User.lat, user.User.lng);
		
		var userUnit = new Map.markerUnit({
			latlng: latlng,
			image: ImagePath + user.User.image,
			title: user.User.username,
			info: createInfo(user),
			className: 'user',
			zIndex: 99
		});
		
		if (self && self.User.id === id) {
			//userUnit.$unit.attr('id', 'self');
			userUnit.self = true;
			userUnit.setZIndex(500);
		}
		
		return userUnit;
	};

	$.ajax({
		url: '/town_dev/users/entries/',
		dataType: 'json',
		success: function(data) {
			Map.reloadCount++;
			
			$.each(data, function(i, user) {
				var id = user.User.id;
				if (!Map.users[id]) {
					Map.users[id] = createUser(user);
					Map.hasUpdate = true;
				}
				Map.users[id].reloadCount = Map.reloadCount;
				
				if (Map.users[id].lat !== user.User.lat && 
					Map.users[id].lng !== user.User.lng &&
					!Map.users[id].self) {
					reloadUser(user);
					Map.users[id].lat = user.User.lat;
					Map.users[id].lng = user.User.lng;
					Map.hasUpdate = true;
				}
			});
			
			$.each(Map.users, function(i, user) {
				if (user.reloadCount !== Map.reloadCount) {
					user.close();
					Map.hasUpdate = true;
				}
			});
			
			if (Map.hasUpdate) {
				Map.hasUpdate = false;
				var markers = [];
				$.each(Map.users, function(i, user) {
					if (user && !user.self) {
						markers.push(user);
					}
				});
				Map.createCluster($.merge(markers, Map.units));
			}
		}
	});
});

// ユニットの取得
Map.start.push(function() {
	var info = function(unit) {
		var url = '/town_dev/' + unit.Unit.url;
		return '<img src="' + ImagePath + unit.Unit.image + '" class="unit-image">' + 
			'<a href="' + url + '">' + unit.Unit.name + '</a>';
	};
	
	$.ajax({
		url: '/town_dev/units/',
		dataType: 'json',
		success: function(data) {
			Map.hasUpdate = true;
			$.each(data, function(i, unit) {
				var latlng = new google.maps.LatLng(unit.Unit.lat, unit.Unit.lng);
				var unit = new Map.markerUnit({
					latlng: latlng,
					image: ImagePath + unit.Unit.image,
					title: unit.Unit.name,
					info: info(unit)
				});
				Map.units.push(unit);
			});
		}
	});
});

// お店ユニットの取得
Map.start.push(function() {
	var info = function(shop) {
		var url = '/town_dev/shops/view/' + shop.Shop.id;
		return '<img src="' + ImagePath + 'shop.gif" class="unit-image">' + 
			'<a href="' + url + '">' + shop.Shop.name + '</a>';
	};
	
	$.ajax({
		url: '/town_dev/shops/',
		dataType: 'json',
		success: function(data) {
			Map.hasUpdate = true;
			$.each(data, function(i, shop) {
				var latlng = new google.maps.LatLng(shop.Shop.lat, shop.Shop.lng);
				var unit = new Map.markerUnit({
					latlng: latlng,
					image: ImagePath + 'shop.gif',
					title: shop.Shop.name,
					info: info(shop)
				});
				Map.units.push(unit);
			});
		}
	});
});

// 家ユニットの取得
Map.start.push(function() {
	var info = function(house) {
		var url = '/town_dev/houses/view/' + house.House.id;
		return '<img src="' + ImagePath + house.House.image + '" class="unit-image">' + 
			'<a href="' + url + '">' + house.User.username + 'の家</a>';
	};
	
	$.ajax({
		url: '/town_dev/houses/',
		dataType: 'json',
		success: function(data) {
			Map.hasUpdate = true;
			$.each(data, function(i, house) {
				var latlng = new google.maps.LatLng(house.House.lat, house.House.lng);
				var unit = new Map.markerUnit({
					latlng: latlng,
					image: ImagePath + house.House.image,
					title: house.User.username + 'の家',
					info: info(house)
				});
				unit.house_id = house.House.id;
				Map.units.push(unit);
			});
			
			var func = Map.afterGetHouse;
			for (var i=0,l=func.length;i<l;++i) {
				func[i]();
			}
		}
	});
});
