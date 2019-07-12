function map_ini(){
	elm = document.getElementById("map");
	// var coord = $(elm).data()["coords"].split("/");	
	var coord = elm.dataset.coords.split( "/" );	
	var	myOptions = {
		  center: new google.maps.LatLng( coord[0] , coord[1]),
		  zoom: 17,
		  mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	map = new google.maps.Map(elm, myOptions);
	marker = new google.maps.Marker({
		position: new google.maps.LatLng(coord[0],  coord[1]),
		map: map
	});
	var info = new google.maps.InfoWindow({	content : document.getElementById("info") });
	info.open(map , marker);
}

window.onload = function(){
    rollToContent();
	map_ini();
};

