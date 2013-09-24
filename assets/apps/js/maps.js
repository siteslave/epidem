// create namespace for mch map
var mm = {};
// base icon url
//mm.iconBase = '/static/img/markers/';
// latitude
mm.latitude = 16.1817729;
// longitude
mm.longitude = 103.29929419999999;
// enable/disable mark map
mm.ready_for_mark = false;

mm.patientLatLng = {};

mm.patient = [];


mm.markers = [];

// check browser support Geolocation
if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(
        function(position) {
            mm.latitude = position.coords.latitude;
            mm.longitude = position.coords.longitude;
        },
        function(msg) {
            //alert(msg);
        });

};

function addMarker(location, v) {
    var marker = new google.maps.Marker({
        position: location,
        map: mm.map
    });
	
    google.maps.event.addListener(marker, 'click', function() {

		var ptstatus = v.ptstatus == '1' ? 'หาย' : 
			v.ptstatus == '2' ? '<span style="color: red;">เสียชีวิต </span>' : 
			v.ptstatus == '3' ? 'ยังรักษาอยู่' : 'ไม่ทราบ';
						
        var content = '<strong>ชื่อ:</strong> ' + v.name + ' <br /> ' +
		'<strong>วันเกิด:</strong> ' + v.birth + ' <strong>อายุ:</strong> ' + v.age + ' ปี<br /> ' +
		'<strong>สัญชาติ:</strong> ' + v.nation + '<br />' +  
		'<strong>Disease: </strong> ' + v.code506 + '<br />' +
		'<strong>Diag: </strong>' + v.diag + '<br />' + 
		'<strong>สถานะ: </strong>' + ptstatus;

        var infoWindow = new google.maps.InfoWindow({
            content: content
        });

        mm.map.setZoom(18);
        mm.map.setCenter(location);

        infoWindow.open(mm.map, marker);
    });
	
    mm.markers.push(marker);
}

// Sets the map on all markers in the array.
function setAllMap(map) {
    for (var i = 0; i < mm.markers.length; i++) {
        mm.markers[i].setMap(map);
    }
}

// Removes the overlays from the map, but keeps them in the array.
function clearOverlays() {
    setAllMap(null);
}

// Shows any overlays currently in the array.
function showOverlays() {
    setAllMap(mm.map);
}

// Deletes all markers in the array by removing references to them.
function deleteOverlays() {
    clearOverlays();
    mm.markers = [];
}

mm.ajax = {
    get_data: function (a, s, e, c, n, p, cb) {
        var url = '/maps/get_map',
            params = {
                a: a,
                s: s,
                e: e,
                c: c,
                n: n,
                p: p
            }
        app.ajax(url, params, function (err, data) {
            err ? cb(err) : cb(null, data);
        });
    }
};

$(function(){

    var pLat = $('#txt_lat').val();
    var pLng = $('#txt_lng').val();

    if(pLat && pLng) {
        mm.latLng = new google.maps.LatLng(
            pLat, pLng
        );
    } else {
        mm.latLng = new google.maps.LatLng(
            mm.latitude, mm.longitude
        );
    }

    var mapId = document.getElementById('map');

    var options = {
        center: mm.latLng,
        zoom: 9,
        mapTypeId: google.maps.MapTypeId.ROADMAP //HYBRID
    };

    //create map
    mm.map = new google.maps.Map(mapId, options);
	mm.mc = new MarkerClusterer(mm.map);
    //mm.clearMarker();
    //mm.addMarker(mm.latLng);

    /*google.maps.event.addListener(mm.marker, 'click', function() {
        mm.map.setCenter(mm.latLng);
        mm.map.setZoom(18);
    });*/

    mm.set_map = function(d) {

        deleteOverlays();
        
		mm.mc.setIgnoreHidden(true);

        mm.markers = [];

        $.each(d, function(i, v) {
            if(v.lat && v.lng) {
                var latLng = new google.maps.LatLng(v.lat, v.lng);
                //var marker = new google.maps.Marker({'position': latLng});
                addMarker(latLng, v);
                //mm.markers.push(marker);
            }
        });

        mm.mc.addMarkers(mm.markers);
    };

/*
    google.maps.event.addListener(mm.map, 'click', function(e) {

        mm.clearMarker();

        var latLng = new google.maps.LatLng(
            e.latLng.lat(), e.latLng.lng()
        );

        mm.addMarker(latLng);
        //console.log(e.latLng.nb);
        //var msg = e.latLng.mb + ', ' + e.latLng.nb;
        // mb = Latitude, nb = Longitude
        //alert(e.latLng.lat());

        $('#txt_lat').val(e.latLng.lat());
        $('#txt_lng').val(e.latLng.lng());

    });*/

    $('#btn_get_map').on('click', function(e) {

        e.preventDefault();

        var start_date = $('#txt_start_date').val();
        var end_date = $('#txt_end_date').val();
        var ampur = $('#sl_ampur').val();
        var code506 = $('#sl_code506').val();
        var nation = $('#sl_nation').val();
        var ptstatus = $('#sl_ptstatus').val();

        if(start_date && end_date) {
            mm.ajax.get_data(ampur, start_date, end_date, code506, nation, ptstatus, function(err, data) {
                if(err) {
                    app.alert(err);
                } else {
					
					$.each(mm.markers, function(k, v){
					    v.setVisible(false);
					});
					
					mm.mc.repaint();
					
                    mm.set_map(data.rows);
                }
            });
        } else {
            app.alert('กรุณาระบุวันที่');
        }
    });

});
