// create namespace for mch map
var mm = {};
// base icon url
mm.iconBase = '/static/img/markers/';

// enable/disable mark map
mm.ready_for_mark = false;

mm.patientLatLng = {};

mm.patient = [];

// latitude
mm.latitude = 16.1817729;
// longitude
mm.longitude = 103.29929419999999;

// check browser support Geolocation
if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(
        function(position) {
            mm.latitude = position.coords.latitude;
            mm.longitude = position.coords.longitude;
        },
        function(msg) {
            // latitude
            mm.latitude = 16.1817729;
            // longitude
            mm.longitude = 103.29929419999999;
        });

};

mm.clearMarker = function() {
    if(mm.marker)
        mm.marker.setMap(null);
};

mm.addMarker = function(latLng) {
    mm.marker = new google.maps.Marker({
        position: latLng,
        map: mm.map,
        //icon: mm.iconBase + 'offices/apartment-3.png',
        title: 'คุณอยู่ที่นี่'
    });
};

mm.modal = {
    show_info: function () {
        $('#mdl_info').modal({
            keyboard: false,
            backdrop: 'static'
        })
    }
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
    },

    get_detail: function (id, cb) {
        var url = '/maps/get_detail',
            params = {
                id: id
            }

        app.ajax(url, params, function (err, data) {
            err ? cb(err) : cb(null, data);
        });
    },
    get_ampur_list: function (chw, cb) {
        var url = '/basic/get_ampur_list',
            params = {
                chw: chw
            }

        app.ajax(url, params, function (err, data) {
            err ? cb(err) : cb(null, data);
        });
    },

    get_tambon_list: function (chw, amp, cb) {
        var url = '/basic/get_tambon_list',
            params = {
                chw: chw,
                amp: amp
            }

        app.ajax(url, params, function (err, data) {
            err ? cb(err) : cb(null, data);
        });
    },
    get_organism_list: function (code506, cb) {
        var url = '/basic/get_organism_list',
            params = {
                code506: code506
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


    $('#btn_get_direction').on('click', function(e) {

        e.preventDefault();

        var lat = $('#txt_lat').val();
        var lng = $('#txt_lng').val();
        var id = $('#txt_id').val();

        if(lat && lng && id) {

            var directionsDisplay;
            var directionsService = new google.maps.DirectionsService();

            var src_latlng = new google.maps.LatLng(mm.latitude, mm.longitude);
            var dst_latlng = new google.maps.LatLng(lat, lng);

            directionsDisplay = new google.maps.DirectionsRenderer();
            //direct_map = new google.maps.Maps

            var options = {
                //center: mm.latLng,
                //zoom: 14,
                mapTypeId: google.maps.MapTypeId.ROADMAP //ROADMAP
            };

            //create map
            mm.map = new google.maps.Map(mapId, options);

            //set direction
            directionsDisplay.setMap(mm.map);

            var request = {
                origin: src_latlng,
                destination: dst_latlng,
                travelMode: google.maps.DirectionsTravelMode.DRIVING
            };

            directionsService.route(request, function(response, status) {
                if (status == google.maps.DirectionsStatus.OK) {
                    directionsDisplay.setDirections(response);
                }
            });

        } else {
            app.alert('กรุณาระบุพิกัด');
        }
    });

    $('#btn_get_detail').on('click', function(e) {

        e.preventDefault();

        var id = $('#txt_id').val();

        mm.get_detail(id);

    });

    mm.get_detail = function (id) {

        mm.ajax.get_detail(id, function (err, data) {
            if (err) {
                app.alert(err);
            } else {
                mm.set_detail(data.rows);
                mm.modal.show_info();
            }
        });

    };

    mm.set_detail = function (v) {

        var ptname = v.name.split(' ');

        $('#txt_edit_id').val(v.id);
        $('#txt_name').val(ptname[0]);
        $('#txt_lname').val(ptname[1]);
        $('#txt_cid').val(v.cid);
        $('#txt_birth').val(v.birth);
        $('#txt_age').val(v.age.year + '-' + v.age.month + '-' + v.age.day);
        $('#sl_sex').val(v.sex);
        $('#txt_hn').val(v.hn);
        $('#txt_nmepate').val(v.nmepate);
        $('#sl_mstatus').val(v.mstatus);
        $('#sl_nations').val(v.nation);
        $('#sl_occupation').val(v.occupation);
        $('#txt_address').val(v.address);
        $('#txt_soi').val(v.soi);
        $('#txt_road').val(v.road);
        $('#sl_changwat').val(v.chw);
        mm.get_ampur_list(v.chw, v.amp);
        mm.get_tambon_list(v.chw, v.amp, v.tmb);
        $('#sl_moo').val(v.moo);
        $('#sl_address_type').val(v.address_type);
        $('#txt_school').val(v.school);
        $('#txt_school_class').val(v.school_class);
        $('#txt_illdate').val(v.illdate);
        $('#txt_date_serv').val(v.date_serv);
        $('#sl_patient_type').val(v.patient_type);
        $('#sl_service_place').val(v.service_place);
        $('#txt_icd10_code').val(v.diagcode);
        $('#txt_icd10_name').val(v.diagname);
        $('#sl_code506').val(v.code506);
        $('#txt_e0_code506').val(v.code506);
        $('#sl_organism');
        mm.get_organism(v.code506, v.organism);
        $('#sl_complication').val(v.complication);
        $('#sl_ptstatus').val(v.ptstatus);
        if (v.ptstatus == '2') $('#div_date_death').fadeIn('slow');
        $('#txt_date_death').val(v.date_death);
        $('#txt_date_record').val(v.date_record);
        $('#txt_date_report').val(v.date_report);
    };

    mm.get_ampur_list = function (chw, amp) {

        $('#sl_ampur').empty();

        mm.ajax.get_ampur_list(chw, function (err, data) {
            if (!err) {
                $('#sl_ampur').append('<option value="">-*-</option>');
                _.each(data.rows, function (v) {
                    if (v.code == amp)
                        $('#sl_ampur').append('<option value="' + v.code + '" selected="selected">[' + v.code + '] ' + v.name + '</option>');

                    $('#sl_ampur').append('<option value="' + v.code + '">[' + v.code + '] ' + v.name + '</option>');
                });
            }
        });

    };

    mm.get_tambon_list = function (chw, amp, tmb) {

        $('#sl_tambon').empty();

        mm.ajax.get_tambon_list(chw, amp, function (err, data) {
            if (!err) {
                $('#sl_tambon').append('<option value="">-*-</option>');
                _.each(data.rows, function (v) {
                    if (v.code == tmb)
                        $('#sl_tambon').append('<option value="' + v.code + '" selected="selected">[' + v.code + '] ' + v.name + '</option>');

                    $('#sl_tambon').append('<option value="' + v.code + '">[' + v.code + '] ' + v.name + '</option>');
                });
            }
        });

    };

    mm.get_moo_list = function (chw, amp, tmb, moo) {

        $('#sl_moo').empty();

        mm.ajax.get_moo_list(chw, amp, tmb, function (err, data) {
            if (!err) {
                $('#sl_moo').append('<option value="">-*-</option>');
                _.each(data.rows, function (v) {
                    if (v.code == moo)
                        $('#sl_moo').append('<option value="' + v.code + '" selected="selected">[' + v.code + '] ' + v.name + '</option>');

                    $('#sl_moo').append('<option value="' + v.code + '">[' + v.code + '] ' + v.name + '</option>');
                });
            }
        });

    };

    mm.clear_form = function () {
        $('#txt_edit_id').val('');
        $('#txt_name').val('');
        $('#txt_lname').val('');
        $('#txt_cid').val('');
        $('#txt_birth').val('');
        $('#txt_age').val('');
        app.set_first_selected($('#sl_sex'));
        $('#sl_sex').removeProp('disabled');
        $('#txt_hn').val('');
        $('#txt_nmepate').val('').removeProp('disabled');

        app.set_first_selected($('#sl_mstatus'));
        app.set_first_selected($('#sl_nations'));
        app.set_first_selected($('#sl_occupation'));

        $('#sl_mstatus').removeProp('disabled');
        $('#sl_nations').removeProp('disabled');
        $('#sl_occupation').removeProp('disabled');

        $('#txt_address').val('').removeProp('disabled');
        $('#txt_soi').val('').removeProp('disabled');
        $('#txt_road').val('').removeProp('disabled');
        app.set_first_selected($('#sl_changwat'));

        $('#sl_changwat').removeProp('disabled');
        $('#sl_ampur').empty().removeProp('disabled');
        $('#sl_tambon').empty().removeProp('disabled');

        app.set_first_selected($('#sl_moo'));
        app.set_first_selected($('#sl_address_type'));

        $('#sl_address_type').removeProp('disabled');
        $('#sl_moo').removeProp('disabled');

        $('#sl_service_place').removeProp('disabled');
        $('#sl_patient_type').removeProp('disabled');

        $('#txt_school').val('').removeProp('disabled');
        $('#txt_school_class').val('').removeProp('disabled');
        $('#txt_illdate').val('');
        $('#txt_date_serv').val('');

        app.set_first_selected($('#sl_patient_type'));
        app.set_first_selected($('#sl_service_place'));

        $('#txt_icd10_code').val('');
        $('#txt_icd10_name').val('');

        app.set_first_selected($('#sl_code506'));
        app.set_first_selected($('#sl_ptstatus'));

        $('#sl_code506').removeProp('disabled');
        $('#sl_ptstatus').removeProp('disabled');
        $('#sl_complication').removeProp('disabled');
        $('#sl_organism').removeProp('disabled');


        $('#txt_date_death').val('').removeProp('disabled');
        $('#txt_date_record').val('').removeProp('disabled');
        $('#txt_date_report').val('').removeProp('disabled');

        $('#btn_save').fadeIn('slow');
    };

    mm.get_organism = function (code506, org) {

        mm.ajax.get_organism_list(code506, function (err, data) {
            $('#sl_organism').empty();
            if (!err) {
                _.each(data.rows, function (v) {
                    if (org == v.code)
                        $('#sl_organism').append('<option value="' + v.code + '" selected="selected">' + v.name + '</option>');
                    $('#sl_organism').append('<option value="' + v.code + '">' + v.name + '</option>');
                });
            }
        });

    };

    app.set_runtime();

});
