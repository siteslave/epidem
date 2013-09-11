$(function () {

    var patient = {};

    patient.modal = {
        show_edit_approve: function () {
            $('#mdl_edit_for_approve').modal({
                keyboard: false,
                backdrop: 'static'
            })
        },

        hide_edit_approve: function () {
            $('#mdl_edit_for_approve').modal('hide');

        },

        hide_e0_approve: function () {
            $('#mdl_e0_for_approve').modal('hide');

        }
    };

    patient.ajax = {
        get_list: function (ptstatus, start, stop, cb) {
            var url = '/patients/get_list',
                params = {
                    start: start,
                    stop: stop,
                    p: ptstatus
                }

            app.ajax(url, params, function (err, data) {
                err ? cb(err) : cb(null, data);
            });
        },

        search: function (q, cb) {
            var url = '/patients/search',
                params = {
                    q: q
                }

            app.ajax(url, params, function (err, data) {
                err ? cb(err) : cb(null, data);
            });
        },

        get_list_filter: function (s, e, start, stop, ptstatus, cb) {
            var url = '/patients/get_list_filter',
                params = {
                    start: start,
                    stop: stop,
                    s: s,
                    e: e,
                    p: ptstatus
                }

            app.ajax(url, params, function (err, data) {
                err ? cb(err) : cb(null, data);
            });
        },

        get_list_total: function (ptstatus, cb) {
            var url = '/patients/get_list_total',
                params = {
                    p: ptstatus
                }

            app.ajax(url, params, function (err, data) {
                err ? cb(err) : cb(null, data);
            });
        },

        get_list_total_filter: function (s, e, ptstatus, cb) {
            var url = '/patients/get_list_total_filter',
                params = {
                    s: s,
                    e: e,
                    p: ptstatus
                }

            app.ajax(url, params, function (err, data) {
                err ? cb(err) : cb(null, data);
            });
        },

        get_waiting_list: function (start, stop, cb) {
            var url = '/patients/get_waiting_list',
                params = {
                    start: start,
                    stop: stop
                }

            app.ajax(url, params, function (err, data) {
                err ? cb(err) : cb(null, data);
            });
        },
        get_waiting_list_total: function (cb) {
            var url = '/patients/get_waiting_list_total',
                params = {}

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

        get_tmp_detail: function (id, cb) {
            var url = '/patients/get_tmp_detail',
                params = {
                    id: id
                }

            app.ajax(url, params, function (err, data) {
                err ? cb(err) : cb(null, data);
            });
        },get_e0_detail: function (id, cb) {
            var url = '/patients/get_e0_detail',
                params = {
                    id: id
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

        get_moo_list: function (chw, amp, tmb, cb) {
            var url = '/basic/get_moo_list',
                params = {
                    chw: chw,
                    amp: amp,
                    tmb: tmb
                }

            app.ajax(url, params, function (err, data) {
                err ? cb(err) : cb(null, data);
            });
        },

        save: function (items, cb) {
            var url = '/patients/save',
                params = {
                    data: items
                }

            app.ajax(url, params, function (err, data) {
                err ? cb(err) : cb(null, data);
            });
        },
        save_e0: function (items, cb) {
            var url = '/patients/save_e0',
                params = {
                    data: items
                }

            app.ajax(url, params, function (err, data) {
                err ? cb(err) : cb(null, data);
            });
        }
    }

    patient.set_list = function (data) {
        $('#tbl_patient_list > tbody').empty();
        if (_.size(data.rows) > 0) {
            _.each(data.rows, function (v) {

                var ptstatus = v.ptstatus == '1' ? 'หาย' : v.ptstatus == '2' ? 'ตาย' : v.ptstatus == '3' ? 'ยังรักษาอยู่' : v.ptstatus == '9' ? 'ไม่ทราบ' : '-';
                var tr_death = v.ptstatus == '2' ? 'class="danger"' : '';

                $('#tbl_patient_list > tbody').append(
                    '<tr ' + tr_death + '>' +
                        '<td>' + v.e0 + '</td>' +
                        '<td>' + v.e1 + '</td>' +
                        //'<td>' + v.pe0 + '</td>' +
                        '<td>' + v.hn + '</td>' +
                        '<td>' + v.name + '</td>' +
                        '<td>' + v.nation + '</td>' +
                        '<td>' + app.strip(v.address, 40) + '</td>' +
                        '<td>' + v.datesick + '</td>' +
                        '<td>' + ptstatus + '</td>' +
                        '<td>' + app.strip(v.code506, 45) + '</td>' +
                        '<td><a href="javascript:void(0);" class="btn btn-small btn-success" data-id="' + v.id + '" ' +
                        'data-name="btn_get_e0_detail"><i class="glyphicon glyphicon-edit"></i></a></td>' +
                        '</tr>'
                );
            });
        }
        else {
            $('#tbl_patient_list > tbody').append('<tr><td colspan="10">ไม่พบรายการ</td></tr>');
        }
    };

    patient.get_list = function (ptstatus) {

        $('#main_paging').fadeIn('slow');

        $('#tbl_patient_list > tbody').empty();

        patient.ajax.get_list_total(ptstatus, function (err, data) {
            if (err) {
                app.alert(err);
                $('#tbl_patient_list > tbody').append('<tr><td colspan="10">ไม่พบรายการ</td></tr>');
            } else {
                $('#spn_total').html(app.add_commars_with_out_decimal(data.total));
                $('#main_paging').paging(data.total, {
                    format: " < . (qq -) nnncnnn (- pp) . >",
                    perpage: app.record_per_page,
                    lapping: 0,
                    page: app.get_cookie('patient_index_paging'),
                    onSelect: function (page) {
                        app.set_cookie('patient_index_paging', page);
                        patient.ajax.get_list(ptstatus, this.slice[0], this.slice[1], function (err, data) {
                            if (err) {
                                app.alert(err);
                                $('#tbl_patient_list > tbody').append('<tr><td colspan="10">ไม่พบรายการ</td></tr>');
                            } else {
                                patient.set_list(data);
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

    patient.get_list_filter = function (start_date, end_date, ptstatus) {

        $('#main_paging').fadeIn('slow');

        $('#tbl_patient_list > tbody').empty();

        patient.ajax.get_list_total_filter(start_date, end_date, ptstatus, function (err, data) {
            if (err) {
                app.alert(err);
                $('#tbl_patient_list > tbody').append('<tr><td colspan="8">ไม่พบรายการ</td></tr>');
            } else {
                $('#spn_total').html(app.add_commars_with_out_decimal(data.total));
                $('#main_paging').paging(data.total, {
                    format: " < . (qq -) nnncnnn (- pp) . >",
                    perpage: app.record_per_page,
                    lapping: 0,
                    page: app.get_cookie('patient_filter_paging'),
                    onSelect: function (page) {
                        app.set_cookie('patient_filter_paging', page);
                        patient.ajax.get_list_filter(start_date, end_date, ptstatus, this.slice[0], this.slice[1], function (err, data) {
                            if (err) {
                                app.alert(err);
                                $('#tbl_patient_list > tbody').append('<tr><td colspan="8">ไม่พบรายการ</td></tr>');
                            } else {
                                patient.set_list(data);
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

    /*  $('#btn_get_list').on('click', function() {
    patient.get_list();
    });*/

    $('#btn_refresh').on('click', function () {
        patient.get_list();
    });

    $('a[href="#tab_wait"]').on('click', function () {
        patient.get_waiting_list();
    });

    $('a[href="#tab_patient"]').on('click', function () {
        patient.get_list();
    });

    patient.get_waiting_list = function () {
        patient.ajax.get_waiting_list_total(function (err, data) {
            if (err) {
                app.alert(err);
                $('#tbl_waiting_list > tbody').empty();
                $('#tbl_waiting_list > tbody').append('<tr><td colspan="7">ไม่พบรายการ</td></tr>');
            } else {
                //patient.set_waiting_list(data.rows)
                $('#spn_wait').html(app.add_commars_with_out_decimal(data.total));

                $('#waiting_paging').paging(data.total, {
                    format: " < . (qq -) nnncnnn (- pp) . >",
                    perpage: app.record_per_page,
                    lapping: 1,
                    page: app.get_cookie('patient_index_wait_paging'),
                    onSelect: function (page) {
                        app.set_cookie('patient_index_wait_paging', page);
                        patient.ajax.get_waiting_list(this.slice[0], this.slice[1], function (err, data) {
                            if (err) {
                                app.alert(err);
                                $('#tbl_waiting_list > tbody').empty();
                                $('#tbl_waiting_list > tbody').append('<tr><td colspan="7">ไม่พบรายการ</td></tr>');
                            } else {

                                //if(user_level==1||user_level==2){
                                //patient.set_waiting_list_e0(data);
                                //}else{

                                    patient.set_waiting_list(data);
                                //}
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
// #### set_waiting list pcu
    patient.set_waiting_list = function (data) {

        $('#tbl_waiting_list > tbody').empty();

        if (_.size(data.rows) > 0) {
            var i = 1;

            _.each(data.rows, function (v) {
                var tr_death = v.ptstatus == '2' ? 'class="danger"' : '';
                //var chk_import = v.RECORD_STATUS == '1' || v.RECORD_STATUS == '2' ? '<input type="checkbox" disabled>' : '<input type="checkbox" data-name="chk_import" data-id="' + v.ID + '">';
                var ptstatus = v.ptstatus == '1' ? 'หาย' : v.ptstatus == '2' ? 'ตาย' : v.ptstatus == '3' ? 'ยังรักษาอยู่' : v.ptstatus== '9' ? 'ไม่ทราบ' : '-';
                $('#tbl_waiting_list > tbody').append(
                    '<tr ' + tr_death + '>' +
                //'<td>' + i + '</td>' +
                //'<td>' + chk_import + '</td>' +
                        '<td>' + app.mysql_to_thai_date(v.date_serv)+'</td>' +
                        '<td>' + app.clear_null(v.cid) + '</td>' +
                        '<td>' + app.clear_null(v.name) + ' ' + app.clear_null(v.lname) + '</td>' +
                        '<td>' + app.mysql_to_thai_date(v.birth) + '</td>' +
                        '<td>' + app.count_age(v.birth) + '</td>' +
                        '<td>' + ptstatus + '</td>' +
                        '<td><strong>' + app.clear_null(v.code506) + '</strong> ' + app.strip(v.dname506, 40) + '</td>' +
                        '<td><div class="btn-group">' +
                        '<a href="javascript:void(0);" class="btn btn-small btn-success" data-id="' + v.id + '" ' +
                        'data-name="btn_edit_approve"><i class="glyphicon glyphicon-edit"></i></a>' +
                        '<a href="javascript:void(0);" class="btn btn-small btn-danger" data-id="' + v.id + '"' +
                        'data-name="btn_remove_tmp" data-status="' + v.record_status + '"><i class="glyphicon glyphicon-trash"></i></a>' +
                        '</div></td>' +
                        '</tr>'
                );

                i++;
            });
        }
        else {
            $('#tbl_waiting_list > tbody').append('<tr><td colspan="7">ไม่พบรายการ</td></tr>');
        }

    };

// #### set_waiting list สสจ. สสอ.
    patient.set_waiting_list_e0 = function (data) {

        $('#tbl_waiting_list > tbody').empty();

        if (_.size(data.rows) > 0) {
            var i = 1;

            _.each(data.rows, function (v) {
                var tr_death = v.ptstatus == '2' ? 'class="danger"' : '';
                //var chk_import = v.RECORD_STATUS == '1' || v.RECORD_STATUS == '2' ? '<input type="checkbox" disabled>' : '<input type="checkbox" data-name="chk_import" data-id="' + v.ID + '">';
                var ptstatus = v.result == '1' ? 'หาย' : v.result == '2' ? 'เสียชีวิต' : v.result == '3' ? 'ยังรักษาอยู่' : v.result == '9' ? 'ไม่ทราบ' : v.ptstatus == '3' ? 'หาย' : '-';
                $('#tbl_waiting_list > tbody').append(
                    '<tr ' + tr_death + '>' +
                //'<td>' + i + '</td>' +
                //'<td>' + chk_import + '</td>' +
                        '<td>'+app.clear_null(v.hospcode)+' : ' + app.mysql_to_thai_date(v.datesick)+'</td>' +
                        '<td>' + app.clear_null(v.cid) + '</td>' +
                        '<td>' + app.clear_null(v.name) +'</td>' +
                        '<td>' + app.mysql_to_thai_date(v.birth) + '</td>' +
                        '<td>' + app.count_age(v.birth) + '</td>' +
                        '<td>' + ptstatus + '</td>' +
                        '<td><strong>' + app.clear_null(v.disease) + '</strong> ' + app.strip(v.dname506, 40) + '</td>' +
                        '<td><div class="btn-group">' +
                        '<a href="javascript:void(0);" class="btn btn-small btn-success" data-id="' + v.id + '" ' +
                        'data-name="btn_e0_approve"><i class="glyphicon glyphicon-edit"></i></a>' +
                        '<a href="javascript:void(0);" class="btn btn-small btn-danger" data-id="' + v.id + '"' +
                        'data-name="btn_remove_tmp" data-status="' + v.record_status + '"><i class="glyphicon glyphicon-trash"></i></a>' +
                        '</div></td>' +
                        '</tr>'
                );

                i++;
            });
        }
        else {
            $('#tbl_waiting_list > tbody').append('<tr><td colspan="7">ไม่พบรายการ</td></tr>');
        }

    };

    //======= Remove record =======//
    $(document).on('click', 'a[data-name="btn_remove_tmp"]', function () {

        var id = $(this).data('id'),
            status = $(this).data('status'),

            obj = $(this).parent().parent().parent();

        if (status == '2') {
            app.alert('รายการนี้ถูกนำเข้าเรียบร้อยแล้ว ไม่สามารถลบรายการได้');
        }
        else {
            //do remove
            if (confirm('คุณต้องการลบรายการนี้ ใช่หรือไม่?')) {
                patient.ajax.remove_tmp(id, function (err) {
                    if (err) {
                        app.alert(err);
                    }
                    else {
                        app.alert('ลบรายการเสร็จเรียบร้อยแล้ว');
                        obj.fadeOut('slow');
                    }
                });
            }
        }

    });

    //========== show edit approve =============//
    $(document).on('click', 'a[data-name="btn_edit_approve"]', function () {

        var id = $(this).data('id');
        //get detail
        patient.get_tmp_detail(id);

    });
    $(document).on('click', 'a[data-name="btn_e0_approve"]', function () {

        var id = $(this).data('id');
        //get detail
        patient.get_e0_detail(id);

    });
    $(document).on('click', 'a[data-name="btn_get_e0_detail"]', function () {

        var id = $(this).data('id');
        //get detail
        patient.get_e0_detail(id);

    });
    patient.get_tmp_detail = function (id) {

            patient.ajax.get_tmp_detail(id, function (err, data) {
            if (err) {
                app.alert(err);
            } else {
                //clear form
                patient.clear_form();
                //set detail
                patient.set_edit_detail(data.rows);
                //show modal

                patient.modal.show_edit_approve();

            }
        });

    };
    patient.get_e0_detail = function (id) {

        patient.ajax.get_e0_detail(id, function (err, data) {
            if (err) {
                app.alert(err);
            } else {
                //clear form
                //set detail
                patient.set_e0_detail(data.rows);
                //show modal
                patient.modal.show_edit_approve();
            }
        });

    };

    patient.set_e0_detail = function (v) {

        var ptname = v.name.split(' ');

        $('#txt_edit_id').val(v.id);
        $('#txt_name').val(ptname[0]);
        $('#txt_lname').val(ptname[1]);
        $('#txt_cid').val(v.cid);
        $('#txt_birth').val(v.birth);
        $('#txt_age').val(v.age.year + '-' + v.age.month + '-' + v.age.day);
        $('#sl_sex').val(v.sex).prop('disabled', true).css('background-color', 'white');
        $('#txt_hn').val(v.hn);
        $('#txt_nmepate').val(v.nmepate).prop('disabled', true).css('background-color', 'white');
        $('#sl_mstatus').val(v.mstatus).prop('disabled', true).css('background-color', 'white');
        $('#sl_nations').val(v.nation).prop('disabled', true).css('background-color', 'white');
        $('#sl_occupation').val(v.occupation).prop('disabled', true).css('background-color', 'white');
        $('#txt_address').val(v.address).prop('disabled', true).css('background-color', 'white');
        $('#txt_soi').val(v.soi).prop('disabled', true).css('background-color', 'white');
        $('#txt_road').val(v.road).prop('disabled', true).css('background-color', 'white');
        $('#sl_changwat').val(v.chw).prop('disabled', true).css('background-color', 'white');
        $('#sl_ampur').prop('disabled', true).css('background-color', 'white');
        $('#sl_tambon').prop('disabled', true).css('background-color', 'white');
        patient.get_ampur_list(v.chw, v.amp);
        patient.get_tambon_list(v.chw, v.amp, v.tmb);
        $('#sl_moo').val(v.moo).prop('disabled', true).css('background-color', 'white');
        $('#sl_address_type').val(v.address_type).prop('disabled', true).css('background-color', 'white');
        $('#txt_school').val(v.school).prop('disabled', true).css('background-color', 'white');
        $('#txt_school_class').val(v.school_class).prop('disabled', true).css('background-color', 'white');
        $('#txt_illdate').val(v.illdate).prop('disabled', true).css('background-color', 'white');
        $('#txt_date_serv').val(v.date_serv).prop('disabled', true).css('background-color', 'white');
        $('#sl_patient_type').val(v.patient_type).prop('disabled', true).css('background-color', 'white');
        $('#sl_service_place').val(v.service_place).prop('disabled', true).css('background-color', 'white');
        $('#txt_icd10_code').val(v.diagcode).prop('disabled', true).css('background-color', 'white');
        $('#txt_icd10_name').val(v.diagname).prop('disabled', true).css('background-color', 'white');
        $('#sl_code506').val(v.code506).prop('disabled', true).css('background-color', 'white');
        $('#txt_e0_code506').val(v.code506).prop('disabled', true).css('background-color', 'white');
        $('#sl_organism').prop('disabled', true).css('background-color', 'white');
        patient.get_organism(v.code506, v.organism);
        $('#sl_complication').val(v.complication).prop('disabled', true).css('background-color', 'white');
        $('#sl_ptstatus').val(v.ptstatus).prop('disabled', true).css('background-color', 'white');
        if (v.ptstatus == '2') $('#div_date_death').fadeIn('slow');
        $('#txt_date_death').val(v.date_death).prop('disabled', true).css('background-color', 'white');
        $('#txt_date_record').val(v.date_record).prop('disabled', true).css('background-color', 'white');
        $('#txt_date_report').val(v.date_report).prop('disabled', true).css('background-color', 'white');

        $('#btn_save').fadeOut('slow');
    };

    patient.set_edit_detail = function (v) {

        $('#txt_edit_id').val(v.id);
        $('#txt_name').val(v.name);
        $('#txt_lname').val(v.lname);
        $('#txt_cid').val(v.cid);
        $('#txt_birth').val(v.birth);
        $('#txt_age').val(v.age.year + '-' + v.age.month + '-' + v.age.day);
        $('#sl_sex').val(v.sex);
        $('#txt_hn').val(v.hn);
        //$('#txt_nmepate').val('');
        $('#sl_mstatus').val(v.mstatus);
        $('#sl_nations').val(v.nation);
        $('#sl_occupation').val(v.occupation);
        $('#txt_address').val(v.illhouse);
        //$('#txt_soi').val();
        //$('#txt_road').val();
        $('#sl_changwat').val(v.illchangwat);
        patient.get_ampur_list(v.illchangwat, v.illampur);
        patient.get_tambon_list(v.illchangwat, v.illampur, v.illtambon);
        //$('#sl_tambon').val();
        $('#sl_moo').val(v.illmoo);
        //$('#sl_address_type').val();
        //$('#txt_school').val();
        //$('#txt_school_class').val();
        $('#txt_illdate').val(v.illdate);
        $('#txt_date_serv').val(v.date_serv);
        //$('#sl_patient_type').val();
        //$('#sl_service_place').val();
        $('#txt_icd10_code').val(v.diagcode);
        $('#txt_icd10_name').val(v.diagname);
        $('#sl_code506').val(v.code506);
        $('#txt_e0_code506').val(v.code506);
        patient.get_organism(v.code506, v.organism);
        $('#sl_complication').val(v.complication);
        $('#sl_ptstatus').val(v.ptstatus);
        if (v.ptstatus == '2') $('#div_date_death').fadeIn('slow');
        $('#txt_date_death').val(v.date_death);
        $('#txt_date_record').val(v.date_record);
        $('#txt_date_report').val(v.date_report);
    };

    $('#mdl_edit_for_approve').on('hidden.bs.modal', function () {
        patient.clear_form();
    })

    patient.clear_form = function () {
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

    //Save data
    $('#btn_save').on('click', function () {

        var items = {};

        items.id = $('#txt_edit_id').val();
        items.name = $('#txt_name').val();
        items.lname = $('#txt_lname').val();
        items.cid = $('#txt_cid').val();
        items.birth = $('#txt_birth').val();
        items.age = $('#txt_age').val();
        items.sex = $('#sl_sex').val();
        items.hn = $('#txt_hn').val();
        items.nmepate = $('#txt_nmepate').val();
        items.mstatus = $('#sl_mstatus').val();
        items.nation = $('#sl_nations').val();
        items.occupation = $('#sl_occupation').val();
        items.address = $('#txt_address').val();
        items.soi = $('#txt_soi').val();
        items.road = $('#txt_road').val();
        items.changwat = $('#sl_changwat').val();
        items.ampur = $('#sl_ampur').val();
        items.tambon = $('#sl_tambon').val();
        items.moo = $('#sl_moo').val();
        items.address_type = $('#sl_address_type').val();
        items.school = $('#txt_school').val();
        items.school_class = $('#txt_school_class').val();
        items.illdate = $('#txt_illdate').val();
        items.date_serv = $('#txt_date_serv').val();
        items.patient_type = $('#sl_patient_type').val();
        items.service_place = $('#sl_service_place').val();
        items.diagcode = $('#txt_icd10_code').val();
        //$('#txt_icd10_name').val();
        items.code506 = $('#sl_code506').val();
        items.ogranism = $('#sl_organism').val();
        items.complication = $('#sl_complication').val();

        items.ptstatus = $('#sl_ptstatus').val();
        if (items.ptstatus == '2') {
            items.date_death = $('#txt_date_death').val();
        } else {
            items.date_death = '';
        }

        items.date_record = $('#txt_date_record').val();
        items.date_report = $('#txt_date_report').val();

        if (!items.id) {
            app.alert('กรุณาระบุ ID');
        } else if (!items.address) {
            app.alert('กรุณาระบุบ้านเลขที่');
        } else if (!items.address_type) {
            app.alert('กรุณาระบุที่ตั้ง ในเขต/นอกเขต');
        } else if (!items.ampur) {
            app.alert('กรุณาระบุอำเภอ');
        } else if (!items.birth) {
            app.alert('กรุณาระบุวันเกิด');
        } else if (!items.changwat) {
            app.alert('กรุณาระบุจังหวัด');
        } else if (!items.cid) {
            app.alert('กรุณาระบุเลขบัตรประชาชน');
        } else if (!items.code506) {
            app.alert('กรุณาระบุกลุ่มโรค 506');
        } else if (!items.date_death && items.ptstatus == '2') {
            app.alert('กรุณาระบุวันที่เสียชีวิต');
        } else if (!items.date_record) {
            app.alert('กรุณาระบุวันที่บันทึก');
        } else if (!items.date_report) {
            app.alert('กรุณาระบุวันที่รายงาน');
        } else if (!items.date_serv) {
            app.alert('กรุณาระบุวันที่รับบริการ');
        } else if (!items.diagcode) {
            app.alert('กรุณาระบุรหัสการวินิจฉัยโรค');
        } else if (!items.hn) {
            app.alert('กรุณาระบุ HN');
        } else if (!items.illdate) {
            app.alert('กรุณาระบุวันที่ป่วย');
        } else if (!items.lname) {
            app.alert('กรุณาระบุสกุล');
        } else if (!items.name) {
            app.alert('กรุณระบุชื่อ');
        } else if (!items.moo) {
            app.alert('กรุณาระบุหมู่');
        } else if (!items.mstatus) {
            app.alert('กรุณาระบุสถานะสมรส');
        } else if (!items.nation) {
            app.alert('กรุณาระบุสัญชาติ');
        } else if (!items.occupation) {
            app.alert('กรุณาระบุอาชีพ');
        } else if (!items.patient_type) {
            app.alert('กรุณาระบุประเภทผู้ป่วย');
        } else if (!items.ptstatus) {
            app.alert('สถานะผู้ป่วย');
        } else if (!items.service_place) {
            app.alert('กรุณาระบุประเภทของสถานที่ให้การรักษา');
        } else if (!items.sex) {
            app.alert('กรุณาระบุเพศ');
        } else if (!items.tambon) {
            app.alert('กรุณาระบุตำบล');
        } else {
            if (confirm('คุณต้องการบันทึกรายการใช่หรือไม่?')) {
                patient.ajax.save(items, function (err) {
                    if (err) {
                        app.alert(err);
                    } else {
                        app.alert('บันทึกรายการเสร็จเรียบร้อยแล้ว');
                        patient.clear_form();
                        patient.modal.hide_edit_approve();
                        patient.get_waiting_list();
                    }
                });
            }
        }
    });

    $('#btn_save_e0').on('click', function () {
        var items = {};
        items.id = $('#txt_e0_id').val();
        items.code506=$('#txt_e0_code506').val();
            if (confirm('คุณต้องการบันทึกรายการใช่หรือไม่?')) {
                patient.ajax.save_e0(items, function (err) {
                    if (err) {
                        app.alert(err);
                    } else {
                        app.alert('บันทึกรายการเสร็จเรียบร้อยแล้ว');
                        patient.clear_form();
                        patient.modal.hide_e0_approve();
                        patient.get_waiting_list();
                    }
                });
            }

    });
    $('#sl_code506').on('change', function () {

        var code506 = $(this).val();
        patient.get_organism(code506);
    });

    patient.get_organism = function (code506, org) {

        patient.ajax.get_organism_list(code506, function (err, data) {
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

    //get ampur list
    $('#sl_changwat').on('change', function () {

        var chw = $(this).val();
        patient.get_ampur_list(chw);

    });

    //get tambon list
    $('#sl_ampur').on('change', function () {

        var chw = $('#sl_changwat').val();
        var amp = $(this).val();

        patient.get_tambon_list(chw, amp);

    });

    //get moo list
    $('#sl_tambon').on('change', function () {

        //var chw = $('#sl_changwat').val();
        //var amp = $('#sl_ampur').val();
        //var tmb = $(this).val();

        // patient.get_moo_list(chw, amp, tmb);

    });

    patient.get_ampur_list = function (chw, amp) {

        $('#sl_ampur').empty();

        patient.ajax.get_ampur_list(chw, function (err, data) {
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

    patient.get_tambon_list = function (chw, amp, tmb) {

        $('#sl_tambon').empty();

        patient.ajax.get_tambon_list(chw, amp, function (err, data) {
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

    patient.get_moo_list = function (chw, amp, tmb, moo) {

        $('#sl_moo').empty();

        patient.ajax.get_moo_list(chw, amp, tmb, function (err, data) {
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

    $('#sl_ptstatus').on('change', function () {
        var is_date = $(this).val() == '2' ? true : false;
        //alert(is_date);
        if (is_date) {
            $('#div_date_death').fadeIn('slow');
        } else {
            $('#div_date_death').fadeOut('slow');
            $('#txt_date_death').val('');
        }
    });

    $('#btn_get_list').on('click', function(e) {

        e.preventDefault();

        var start_date = $('#txt_query_start_date').val(),
            end_date = $('#txt_query_end_date').val(),
            ptstatus = $('#sl_query_ptstatus').val();

        if(start_date && end_date) {
            patient.get_list_filter(start_date, end_date, ptstatus);
        } else {
            patient.get_list(ptstatus);
        }

    });

    //get e0 list
    patient.get_list();

    patient.ajax.get_waiting_list_total(function (err, v) {

        $('#spn_wait').html(app.add_commars_with_out_decimal(v.total));

    });

    // search
    $('#btn_search').on('click', function(e) {
        e.preventDefault();

        var query = $('#txt_query').val();

        if(query)
        {
            patient.ajax.search(query, function(err, data) {
                if(err)
                {
                    app.alert(err);
                }
                else
                {
                    $('#main_paging').fadeOut('slow');
                    patient.set_list(data);
                }
            });
        }
        else
        {
            app.alert('กรุณาระบุคำค้นหา');
        }
    });
});