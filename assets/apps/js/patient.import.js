$(function () {
    var patient = {};

    patient.ajax = {
        get_import_list: function (s, e, cb) {
            var url = '/patients/get_import_list',
                params = {
                    s: s,
                    e: e
                }

            app.ajax(url, params, function (err, data) {
                err ? cb(err) : cb(null, data);
            });
        },

        get_import: function (s, e, start, stop, cb) {
            var url = '/patients/get_import',
                params = {
                    s: s,
                    e: e,
                    start: start,
                    stop: stop
                }

            app.ajax(url, params, function (err, data) {
                err ? cb(err) : cb(null, data);
            });
        },

        get_import_total: function (s, e, cb) {
            var url = '/patients/get_import_total',
                params = {
                    s: s,
                    e: e
                }

            app.ajax(url, params, function (err, data) {
                err ? cb(err) : cb(null, data);
            });
        },

        get_tmp_detail: function (id, cb) {
            var url = '/patients/get_tmp_detail',
                params = {
                    id: id
                }

            app.ajax(url, params, function (err, data) {
                err ? cb(err) : cb(null, data);
            });
        },

        remove_tmp: function (id, cb) {
            var url = '/patients/remove_tmp',
                params = {
                    id: id
                }

            app.ajax(url, params, function (err, data) {
                err ? cb(err) : cb(null, data);
            });
        },

        do_import: function (id, cb) {
            var url = '/patients/do_import',
                params = {
                    id: id
                }

            app.ajax(url, params, function (err, data) {
                err ? cb(err) : cb(null, data);
            });
        }
    };

    patient.modal = {
        show_info: function () {
            $('#mdl_info').modal({ 'keyboard': false });
        }
    };

    patient.get_import_list = function () {
        var s = $('#txt_start_date').val(),
            e = $('#txt_end_date').val();

        if (!s) {
            app.alert('กรุณาระบุวันที่เริ่มต้น');
        } else if (!e) {
            app.alert('กรุณาระบุวันที่สิ้นสุด');
        } else { 
            patient.ajax.get_import_list(s, e, function (err, data) {
                if (err) {
                    app.alert(err);
                }
                else {
                    patient.get_import();
                }
            });
        }
    };

    $('#btn_get_list').on('click', function (e) {
        patient.get_import_list();
    });

    patient.set_import = function (data) {

        $('#tbl_list > tbody').empty();
        if (_.size(data.rows) > 0) {
            _.each(data.rows, function (v) {
                var tr_death = v.ptstatus == '2' ? 'class="danger"' : '';
                var chk_import = v.record_status == '1' || v.record_status == '2' ? '<input type="checkbox" disabled>' : '<input type="checkbox" data-name="chk_import" data-id="' + v.id + '">';
                var ptstatus = v.ptstatus == '1' ? 'หาย' : v.ptstatus == '2' ? 'ตาย' : v.ptstatus == '3' ? 'ยังรักษาอยู่' : v.ptstatus == '9' ? 'ไม่ทราบ' : '-';
                $('#tbl_list > tbody').append(
                    '<tr ' + tr_death + '>' +

                        '<td>' + app.mysql_to_thai_date(v.date_serv) + '</td>' +
                        '<td>' + v.cid + '</td>' +
                        '<td>' + v.name + ' ' + v.lname + '</td>' +
                        '<td>' + app.mysql_to_thai_date(v.birth) + '</td>' +
                        '<td>' + app.count_age(v.birth) + '</td>' +
                        '<td>' + ptstatus + '</td>' +
                        '<td>' + v.diagcode + ' ' + app.strip(v.diagname, 35) + '</td>' +
                        '<td><div class="btn-group">' +
                        '<a href="javascript:void(0);" class="btn btn-small btn-success" data-id="' + v.id + '" ' +
                        'data-name="btn_get_info"><i class="glyphicon glyphicon-search"></i></a>' +
                        '<a href="javascript:void(0);" class="btn btn-small btn-danger" data-id="' + v.id + '"' +
                        'data-name="btn_remove_tmp" data-status="' + v.record_status + '" data-ptstatus="' + v.ptstatus + '"><i class="glyphicon glyphicon-remove"></i></a>' +
                        '</div></td>' +
                        '</tr>'
                );

            });
        }
        else {
            $('#tbl_list > tbody').append('<tr><td colspan="8">ไม่พบรายการ</td></tr>');
        }
    };

    patient.get_import = function () {

        var s = $('#txt_start_date').val(),
            e = $('#txt_end_date').val();

        $('#tbl_list > tbody').empty();

        patient.ajax.get_import_total(s, e, function (err, data) {
            if (err) {
                app.alert(err);
                $('#tbl_list > tbody').append('<tr><td colspan="9">ไม่พบรายการ</td></tr>');
            } else {
                $('#spn_total').html(app.add_commars_with_out_decimal(data.total));
                $('#main_paging').paging(data.total, {
                    format: " < . (qq -) nnncnnn (- pp) . >",
                    perpage: app.record_per_page,
                    lapping: 1,
                    page: app.get_cookie('patient_index_paging'),
                    onSelect: function (page) {
                        app.set_cookie('patient_index_paging', page);
                        patient.ajax.get_import(s, e, this.slice[0], this.slice[1], function (err, data) {
                            if (err) {
                                app.alert(err);
                                $('#tbl_list > tbody').append('<tr><td colspan="9">ไม่พบรายการ</td></tr>');
                            } else {
                                patient.set_import(data);
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


    $('#btn_check_all').on('click', function () {
        $('input[data-name="chk_import"]').each(function () {
            $(this).prop('checked', true);
        });
    });
    $('#btn_clear_all').on('click', function () {
        $('input[data-name="chk_import"]').each(function () {
            $(this).prop('checked', false);
        });
    });

    $('#btn_do_import').on('click', function () {
        var id = [];
        $('input[data-name="chk_import"]').each(function () {
            if ($(this).prop('checked')) {
                id.push($(this).data('id'));
            }
        });

        if (id.length == 0) {
            app.alert('กรุณาเลือกรายการที่ต้องการนำเข้า');
        }
        else {
            if (confirm('คุณต้องการนำเข้ารายการทั้งหมด ' + id.length + ' รายการ ใช่หรือไม่?')) {
                patient.ajax.do_import(id, function (err) {
                    if (err) {
                        app.alert(err);
                    }
                    else {
                        app.alert('นำเข้าข้อมูลเสร็จเรียบร้อยแล้ว');
                        patient.get_import();
                    }
                });
            }
        }
    });

    patient.get_tmp_detail = function (id) {
        patient.ajax.get_tmp_detail(id, function (err, data) {
            if (err) {
                app.alert(err);
            }
            else {
                patient.set_tmp_detail(data.rows);
                patient.modal.show_info();
            }
        });
    };

    patient.set_tmp_detail = function (v) {
        var fullname = v.name + ' ' + v.lname;
        var age = v.age.year + ' ปี ' + v.age.month + ' เดือน ' + v.age.day + ' วัน';
        var ptstatus = v.ptstatus == '1' ? 'หาย' : v.ptstatus == '2' ? 'ตาย' : v.ptstatus == '3' ? 'ยังรักษาอยู่' : v.ptstatus == '9' ? 'ไม่ทราบ' : '-';

        $('#txt_tdetail_fullname').val(fullname);
        $('#txt_tdetail_cid').val(v.cid);
        $('#txt_tdetail_birth').val(v.birth);
        $('#txt_tdetail_age').val(age);
        $('#txt_tdetail_date_serv').val(v.date_serv);
        $('#txt_tdetail_illdate').val(v.illdate);
        $('#txt_tdetail_ptstatus').val(ptstatus);
        $('#txt_tdetail_date_death').val(v.date_death);
        $('#txt_tdetail_code506').val(v.code506);
        $('#txt_tdetail_code506_name').val(v.code506_name);
        $('#txt_tdetail_diagcode').val(v.diagcode);
        $('#txt_tdetail_diagname').val(v.diagname);
    };

    $(document).on('click', 'a[data-name="btn_get_info"]', function () {
        var id = $(this).data('id');
        patient.get_tmp_detail(id);
    });

    $(document).on('click', 'a[data-name="btn_remove_tmp"]', function () {
        var status = $(this).data('status');
        var id = $(this).data('id');

        if (status == '1') {
            app.alert('รายการนี้ไม่สามารถลบได้ เนื่องจากได้มีการนำเข้าฐานข้อมูลแล้ว');
        }
        else {
            if (confirm('คุณต้องการลบรายการ ใช่หรือไม่?')) {
                patient.ajax.remove_tmp(id, function (err) {
                    if (err) {
                        app.alert();
                    }
                    else {
                        app.alert('ลบรายการเสร็จเรียบร้อยแล้ว');
                        patient.get_import_list();
                    }
                });
            }
        }

    });
}); 


