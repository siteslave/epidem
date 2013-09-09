// main module
var exports = {};

exports.ajax = {
    get_list: function (start_date, end_date, start, stop, cb) {
        var url = '/exports/get_list',
            params = {
                s: start_date,
                e: end_date,
                start: start,
                stop: stop
            }

        app.ajax(url, params, function (err, data) {
            err ? cb(err) : cb(null, data);
        });
    },

    get_total: function (start_date, end_date, cb) {
        var url = '/exports/get_total',
            params = {
                s: start_date,
                e: end_date
            }

        app.ajax(url, params, function (err, data) {
            err ? cb(err) : cb(null, data);
        });
    }
};

exports.set_list = function (data) {
    $('#tbl_list > tbody').empty();
    if (_.size(data.rows) > 0) {
        _.each(data.rows, function (v) {

            var ptstatus = v.ptstatus == '1' ? 'หาย' : v.ptstatus == '2' ? 'ตาย' : v.ptstatus == '3' ? 'ยังรักษาอยู่' : v.ptstatus== '9' ? 'ไม่ทราบ' : '-';
            var tr_death = v.ptstatus == '2' ? 'class="danger"' : '';
            $('#tbl_list > tbody').append(
                '<tr class="'+tr_death+'">' +
                    '<td>' + v.e0 + '</td>' +
                    '<td>' + v.e1 + '</td>' +
                    '<td>' + app.strip(v.code506, 45) + '</td>' +
                    '<td>' + v.name + '</td>' +
                    '<td>' + v.nation + '</td>' +
                    '<td>' + app.strip(v.address, 40) + '</td>' +
                    '<td>' + v.datesick + '</td>' +
                    '<td>' + ptstatus + '</td>'
            );
        });

        app.set_runtime();
    }
    else {
        $('#tbl_list > tbody').append('<tr><td colspan="8">ไม่พบรายการ</td></tr>');
    }
};

exports.get_list = function (start_date, end_date) {

    $('#tbl_list > tbody').empty();

    exports.ajax.get_total(start_date, end_date, function (err, data) {
        if (err) {
            app.alert(err);
            $('#tbl_list > tbody').append('<tr><td colspan="8">ไม่พบรายการ</td></tr>');
        } else {
            $('#spn_total').html(app.add_commars_with_out_decimal(data.total));
            $('#paging').paging(data.total, {
                format: " < . (qq -) nnncnnn (- pp) . >",
                perpage: app.record_per_page,
                lapping: 0,
                page: 1,
                onSelect: function (page) {
                    exports.ajax.get_list(start_date, end_date, this.slice[0], this.slice[1], function (err, data) {
                        if (err) {
                            app.alert(err);
                            $('#tbl_list > tbody').append('<tr><td colspan="8">ไม่พบรายการ</td></tr>');
                        } else {
                            exports.set_list(data);
                        }
                    });

                },
                onFormat: function (type) {
                    switch (type) {

                        case 'block':

                            if (!this.active)
                                return '<li class="disabled"><a href="">' + this.value + '</a></li>';
                            else if (this.value != this.page)
                                return '<li><a href="#' + this.value + '">' + this.value + '</a></li>';
                            return '<li class="active"><a href="#">' + this.value + '</a></li>';

                        case 'right':
                        case 'left':

                            if (!this.active) {
                                return "";
                            }
                            return '<li><a href="#' + this.value + '">' + this.value + '</a></li>';

                        case 'next':

                            if (this.active) {
                                return '<li><a href="#' + this.value + '">&raquo;</a></li>';
                            }
                            return '<li class="disabled"><a href="">&raquo;</a></li>';

                        case 'prev':

                            if (this.active) {
                                return '<li><a href="#' + this.value + '">&laquo;</a></li>';
                            }
                            return '<li class="disabled"><a href="">&laquo;</a></li>';

                        case 'first':

                            if (this.active) {
                                return '<li><a href="#' + this.value + '">&lt;</a></li>';
                            }
                            return '<li class="disabled"><a href="">&lt;</a></li>';

                        case 'last':

                            if (this.active) {
                                return '<li><a href="#' + this.value + '">&gt;</a></li>';
                            }
                            return '<li class="disabled"><a href="">&gt;</a></li>';

                        case 'fill':
                            if (this.active) {
                                return '<li class="disabled"><a href="#">...</a></li>';
                            }
                    }
                    return ""; // return nothing for missing branches
                }
            });
        }
    });
};


$(function(){

    $('#btn_get_list').on('click', function(e) {
        e.preventDefault();

        var start_date = $('#txt_start_date').val(),
            end_date = $('#txt_end_date').val();

        if(start_date && end_date) {
            exports.get_list(start_date, end_date);
        } else {
            app.alert('กรุณาระบุวันที่');
        }
    });

    $('#btn_do_export').on('click', function(e) {
        e.preventDefault();

        var start_date = $('#txt_start_date').val(),
            end_date = $('#txt_end_date').val();

        if(confirm('คุณต้องการส่งออกข้อมูล ใช่หรือไม่?')) {
            if(start_date && end_date) {
                //exports.ajax.do_export(start_date, end_date);
                window.open(site_url + '/exports/do_export?s=' + start_date + '&e=' + end_date);
            } else {
                app.alert('กรุณาระบุวันที่');
            }
        }
    });
});