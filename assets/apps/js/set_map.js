// create namespace for mch map
var mm = {};
// base icon url
mm.iconBase = '/static/img/markers/';
// latitude
mm.latitude = 16.1817729;
// longitude
mm.longitude = 103.29929419999999;
// enable/disable mark map
mm.ready_for_mark = false;

mm.patientLatLng = {};

mm.patient = [];

// check browser support Geolocation
if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(
        function(position) {
            mm.latitude = position.coords.latitude;
            mm.longitude = position.coords.longitude;
        },
        function(msg) {
            alert(msg);
        });

};

mm.clearMarker = function() {
    if(mm.marker)
        mm.marker.setMap(null);
};

mm.addMarker = function(latLng) {
    mm.marker = new google.maps.Marker({
        position: latLng,
        map: mm.map
        //icon: mm.iconBase + 'offices/apartment-3.png',
        //title: 'คุณอยู่ที่นี่'
    });
};


mm.ajax = {
    save_map: function (id, lat, lng, cb) {
        var url = '/maps/save_map',
            params = {
                id: id,
                lat: lat,
                lng: lng
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
        zoom: 16,
        mapTypeId: google.maps.MapTypeId.HYBRID
    };

    //create map
    mm.map = new google.maps.Map(mapId, options);

    mm.clearMarker();
    mm.addMarker(mm.latLng);

    google.maps.event.addListener(mm.marker, 'click', function() {
        mm.map.setCenter(mm.latLng);
        mm.map.setZoom(18);
    });

    mm.set_map = function(d) {

         var markers = [];

         for (var i = 0; i < 100; i++) {

             var latLng = new google.maps.LatLng(d.lat, d.lng);
             var marker = new google.maps.Marker({'position': latLng});

             markers.push(marker);
         }

         new MarkerClusterer(map, markers);
    };

    $('#btn_get_data').on('click', function(e) {
        var ampur_code = $('#sl_ampur').val(),
            code506 = $('#sl_code506').val(),
            ptstatus = $('#sl_ptstatus').val();

        mm.get_data(ampur_code, code506, ptstatus);
    });


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

    });

    $('#btn_save').on('click', function(e) {

        e.preventDefault();

        var lat = $('#txt_lat').val();
        var lng = $('#txt_lng').val();
        var id = $('#txt_id').val();

        if(lat && lng && id) {
            if(confirm('คุณต้องการบันทึกพิกัดนี้ใช่หรือไม่?')) {
                mm.ajax.save_map(id, lat, lng, function(err) {
                    if(err) {
                        app.alert(err);
                    } else {
                        history.go(-1);
                    }
                });
            }
        } else {
            app.alert('กรุณาระบุพิกัด');
        }
    });

});
