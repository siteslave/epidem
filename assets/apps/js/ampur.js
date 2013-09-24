$(function () {

    var ampur = {};

    ampur.modal = {
        show_info: function () {
            $('#mdl_info').modal({
                keyboard: false,
                backdrop: 'static'
            })
        },

        show_approve: function () {
            $('#mdl_approve').modal({
                keyboard: false,
                backdrop: 'static'
            })
        },

        show_search: function() {
            $('#mdl_search').modal({
                keyboard: false,
                backdrop: 'static'
            });
        },

        hide_approve: function() {
            $('#mdl_approve').modal('hide');
        },

        hide_search: function() {
            $('#mdl_search').modal('hide');
        }
    };

    ampur.ajax = {
        get_list: function (start_date, end_date, ptstatus, nation, start, stop, cb) {
            var url = '/ampur/get_list',
                params = {
                    s: start_date,
                    e: end_date,
                    start: start,
                    stop: stop,
                    p: ptstatus,
                    n: nation
                }

            app.ajax(url, params, function (err, data) {
                err ? cb(err) : cb(null, data);
            });
        },

        get_other_list: function (start_date, end_date,  start, stop, cb) {
            var url = '/ampur/get_other_list',
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

        get_list_total: function (start_date, end_date, ptstatus, nation, cb) {
            var url = '/ampur/get_list_total',
                params = {
                    p: ptstatus,
                    s: start_date,
                    e: end_date,
                    n: nation
                }

            app.ajax(url, params, function (err, data) {
                err ? cb(err) : cb(null, data);
            });
        },

        get_other_total: function (start_date, end_date, cb) {
            var url = '/ampur/get_other_total',
                params = {
                    s: start_date,
                    e: end_date
                }

            app.ajax(url, params, function (err, data) {
                err ? cb(err) : cb(null, data);
            });
        },
/*

        get_list_total_filter: function (start_date, end_date, p, n, cb) {
            var url = '/ampur/get_list_total_filter',
                params = {
                    p: p,
                    s: start_date,
                    e: end_date,
                    n: n
                }

            app.ajax(url, params, function (err, data) {
                err ? cb(err) : cb(null, data);
            });
        },
*/

        get_waiting_list: function (p, start, stop, cb) {
            var url = '/ampur/get_waiting_list',
                params = {
                    start: start,
                    stop: stop,
                    p: p
                }

            app.ajax(url, params, function (err, data) {
                err ? cb(err) : cb(null, data);
            });
        },
        get_waiting_list_total: function (p, cb) {
            var url = '/ampur/get_waiting_list_total',
                params = {
                    p: p
                }

            app.ajax(url, params, function (err, data) {
                err ? cb(err) : cb(null, data);
            });
        },

        get_detail: function (id, cb) {
            var url = '/ampur/get_detail',
                params = {
                    id: id
                }

            app.ajax(url, params, function (err, data) {
                err ? cb(err) : cb(null, data);
            });
        },
        do_approve: function (id, code506, cb) {
            var url = '/ampur/do_approve',
                params = {
                    id: id,
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
        get_organism_list: function (code506, cb) {
            var url = '/basic/get_organism_list',
                params = {
                    code506: code506
                }

            app.ajax(url, params, function (err, data) {
                err ? cb(err) : cb(null, data);
            });
        },

        search: function (q, cb) {
            var url = '/ampur/search',
                params = {
                    q: q
                }

            app.ajax(url, params, function (err, data) {
                err ? cb(err) : cb(null, data);
            });
        },
        do_import: function (items, cb) {
            var url = '/ampur/do_import',
                params = {
                    items: items
                }

            app.ajax(url, params, function (err, data) {
                err ? cb(err) : cb(null, data);
            });
        }
    }

    ampur.set_list = function (data) {
        $('#tbl_list > tbody').empty();
        if (_.size(data.rows) > 0) {
            _.each(data.rows, function (v) {

                var ptstatus = v.ptstatus == '1' ? 'หาย' : v.ptstatus == '2' ? 'เสียชีวิต' : v.ptstatus == '3' ? 'ยังรักษาอยู่' : v.ptstatus== '9' ? 'ไม่ทราบ' : '-';
                var tr_death = v.ptstatus == '2' ? 'class="danger"' : '';
				var latlng = v.latlng == '1' ? 
				'<a href="javascript:void(0);" class="btn btn-default" data-name="btn_get_map" title="ดูแผนที่" data-rel="tooltip" ' +
				'data-id="' + v.id + '"><i class="glyphicon glyphicon-new-window"></i> </a>' : 
				'';
                
				$('#tbl_list > tbody').append(
                    '<tr '+tr_death+'">' +
                        '<td>' + latlng + '</td>' +
                        '<td>' + v.e0 + '</td>' +
                        '<td>' + v.e1 + '</td>' +
                        '<td>' + v.datesick + '</td>' +
                        '<td>' + v.cid + '</td>' +
                        '<td>' + v.name + '</td>' +
                        '<td>' + v.birth + '</td>' +
                        '<td>' + v.age + '</td>' +
                        '<td>' + ptstatus + '</td>' +
                        '<td>' + app.strip(v.code506, 45) + '</td>' +
                        '<td>' + v.hospcode + ' ' + app.strip(v.hospname, 20) + '</td>' +
                        '<td><div class="btn-group">' +
                        '<button type="button" class="btn btn-default btn-small dropdown-toggle" data-toggle="dropdown">' +
                        '<i class="glyphicon glyphicon-cog"></i> <span class="caret"></span>' +
                        '</button>' +
                        '<ul class="dropdown-menu pull-right" role="menu">' +
                        '<li>' +
                        '<a href="javascript:void(0);" data-id="' + v.id + '" data-name="btn_detail">' +
                        '<i class="glyphicon glyphicon-edit"></i> ดูข้อมูล' +
                        '</a>' +
                        '</li>' +
                        /*'<li>' +
                        '<a href="javascript:void(0);" data-id="'+ v.id +'" data-name="btn_get_map"> ' +
                        '<i class="glyphicon glyphicon-log-out"></i> ดูแผนที่' +
                        '</a>' +
                        '</li>' + */
                        '<li>' +
                        '<a href="javascript:void(0);" data-id="'+ v.id +'" data-name="btn_set_map"> ' +
                        '<i class="glyphicon glyphicon-map-marker"></i> แก้ไขพิกัด' +
                        '</a>' +
                        '</li>' +
                        '</ul>' +
                        '</div></td>' +
                        '</tr>'
                );
            });

            app.set_runtime();
        }
        else {
            $('#tbl_list > tbody').append('<tr><td colspan="12">ไม่พบรายการ</td></tr>');
        }
    };

    ampur.set_other_list = function (data) {
        $('#tbl_other_list > tbody').empty();
        if (_.size(data.rows) > 0) {
            _.each(data.rows, function (v) {

                var ptstatus = v.ptstatus == '1' ? 'หาย' : v.ptstatus == '2' ? 'เสียชีวิต' : v.ptstatus == '3' ? 'ยังรักษาอยู่' : v.ptstatus== '9' ? 'ไม่ทราบ' : '-';
                var tr_death = v.ptstatus == '2' ? 'class="danger"' : '';

				var latlng = v.latlng == '1' ? 
				'<a href="javascript:void(0);" class="btn btn-default" data-name="btn_get_map" title="ดูแผนที่" data-rel="tooltip" ' +
				'data-id="' + v.id + '"><i class="glyphicon glyphicon-new-window"></i> </a>' : 
				'';
				
                $('#tbl_other_list > tbody').append(
                    '<tr '+tr_death+'">' +
                        '<td>' + latlng + '</td>' +
                        '<td>' + v.e0 + '</td>' +
                        '<td>' + v.e1 + '</td>' +
                        '<td>' + v.datesick + '</td>' +
                        '<td>' + v.cid + '</td>' +
                        '<td>' + v.name + '</td>' +
                        '<td>' + v.birth + '</td>' +
                        '<td>' + v.age + '</td>' +
                        '<td>' + ptstatus + '</td>' +
                        '<td>' + app.strip(v.code506, 45) + '</td>' +
                        '<td>' + v.hospcode + ' ' + app.strip(v.hospname, 20) + '</td>' +
                        '<td><div class="btn-group">' +
                        '<button type="button" class="btn btn-default btn-small dropdown-toggle" data-toggle="dropdown">' +
                        '<i class="glyphicon glyphicon-cog"></i> <span class="caret"></span>' +
                        '</button>' +
                        '<ul class="dropdown-menu pull-right" role="menu">' +
                        '<li>' +
                        '<a href="javascript:void(0);" data-id="' + v.id + '" data-name="btn_detail">' +
                        '<i class="glyphicon glyphicon-edit"></i> ดูข้อมูล' +
                        '</a>' +
                        '</li>' +
                        /*'<li>' +
                        '<a href="javascript:void(0);" data-id="'+ v.id +'" data-name="btn_get_map"> ' +
                        '<i class="glyphicon glyphicon-log-out"></i> ดูแผนที่' +
                        '</a>' +*/
                        '<li>' +
                        '<a href="javascript:void(0);" data-id="'+ v.id +'" data-name="btn_set_map"> ' +
                        '<i class="glyphicon glyphicon-map-marker"></i> แก้ไขพิกัด' +
                        '</a>' +
                        '</li>' +
                        '</ul>' +
                        '</div></td>' +
                        '</tr>'
                );
            });

            app.set_runtime();
        }
        else {
            $('#tbl_other_list > tbody').append('<tr><td colspan="12">ไม่พบรายการ</td></tr>');
        }
    };

    ampur.get_other_list = function (start_date, end_date) {

        $('#main_paging').fadeIn('slow');

        $('#tbl_other_list > tbody').empty();

        ampur.ajax.get_other_total(start_date, end_date, function (err, data) {
            if (err) {
                app.alert(err);
                $('#tbl_other_list > tbody').append('<tr><td colspan="12">ไม่พบรายการ</td></tr>');
            } else {
                $('#spn_other').html(app.add_commars_with_out_decimal(data.total));
                $('#other_paging').paging(data.total, {
                    format: " < . (qq -) nnncnnn (- pp) . >",
                    perpage: app.record_per_page,
                    lapping: 0,
                    page: app.get_cookie('ampur_other_paging'),
                    onSelect: function (page) {
                        app.set_cookie('ampur_other_paging', page);
                        ampur.ajax.get_other_list(start_date, end_date, this.slice[0], this.slice[1], function (err, data) {
                            if (err) {
                                app.alert(err);
                                $('#tbl_other_list > tbody').append('<tr><td colspan="12">ไม่พบรายการ</td></tr>');
                            } else {
                                ampur.set_other_list(data);
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

    ampur.get_list = function (start_date, end_date, ptstatus, nation) {

        $('#main_paging').fadeIn('slow');

        $('#tbl_list > tbody').empty();

        ampur.ajax.get_list_total(start_date, end_date, ptstatus, nation , function (err, data) {
            if (err) {
                app.alert(err);
                $('#tbl_list > tbody').append('<tr><td colspan="11">ไม่พบรายการ</td></tr>');
            } else {
                $('#spn_total').html(app.add_commars_with_out_decimal(data.total));
                $('#main_paging').paging(data.total, {
                    format: " < . (qq -) nnncnnn (- pp) . >",
                    perpage: app.record_per_page,
                    lapping: 0,
                    page: app.get_cookie('ampur_index_paging'),
                    onSelect: function (page) {
                        app.set_cookie('ampur_index_paging', page);
                        ampur.ajax.get_list(start_date, end_date, ptstatus, nation, this.slice[0], this.slice[1], function (err, data) {
                            if (err) {
                                app.alert(err);
                                $('#tbl_list > tbody').append('<tr><td colspan="11">ไม่พบรายการ</td></tr>');
                            } else {
                                ampur.set_list(data);
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

    ampur.get_list_filter = function (start_date, end_date, ptstatus, nation) {

        $('#main_paging').fadeIn('slow');

        $('#tbl_patient_list > tbody').empty();

        ampur.ajax.get_list_total_filter(start_date, end_date, ptstatus, nation, function(err, data) {
            if (err) {
                app.alert(err);
                $('#tbl_patient_list > tbody').append('<tr><td colspan="11">ไม่พบรายการ</td></tr>');
            } else {
                $('#spn_total').html(app.add_commars_with_out_decimal(data.total));
                $('#main_paging').paging(data.total, {
                    format: " < . (qq -) nnncnnn (- pp) . >",
                    perpage: app.record_per_page,
                    lapping: 0,
                    page: app.get_cookie('ampur_index_paging'),
                    onSelect: function (page) {
                        app.set_cookie('ampur_index_paging', page);
                        ampur.ajax.get_list_filter(start_date, end_date, ptstatus, nation, this.slice[0], this.slice[1], function (err, data) {
                            if (err) {
                                app.alert(err);
                                $('#tbl_patient_list > tbody').append('<tr><td colspan="11">ไม่พบรายการ</td></tr>');
                            } else {
                                ampur.set_list(data);
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

    $(document).on('click', 'a[data-name="btn_set_map"]', function(e) {
        e.preventDefault();

        var id = $(this).data('id');

        app.go_to_url('/maps/set_map/' + id);
    });

    $('#btn_refresh').on('click', function () {
        ampur.get_list();
    });

    $('a[href="#tab_wait"]').on('click', function () {
        ampur.get_waiting_list();
    });

    $('a[href="#tab_patient"]').on('click', function () {
        ampur.get_list();
    });

    ampur.get_waiting_list = function (p) {
        ampur.ajax.get_waiting_list_total(p, function (err, data) {
            if (err) {
                app.alert(err);
                $('#tbl_waiting_list > tbody').empty();
                $('#tbl_waiting_list > tbody').append('<tr><td colspan="10">ไม่พบรายการ</td></tr>');
            } else {
                $('#spn_wait').html(app.add_commars_with_out_decimal(data.total));

                $('#waiting_paging').paging(data.total, {
                    format: " < . (qq -) nnncnnn (- pp) . >",
                    perpage: app.record_per_page,
                    lapping: 1,
                    page: app.get_cookie('ampur_index_wait_paging'),
                    onSelect: function (page) {
                        app.set_cookie('ampur_index_wait_paging', page);
                        ampur.ajax.get_waiting_list(p, this.slice[0], this.slice[1], function (err, data) {
                            if (err) {
                                app.alert(err);
                                $('#tbl_waiting_list > tbody').empty();
                                $('#tbl_waiting_list > tbody').append('<tr><td colspan="10">ไม่พบรายการ</td></tr>');
                            } else {
                                ampur.set_waiting_list(data);
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

    ampur.set_waiting_list = function (data) {

        $('#tbl_waiting_list > tbody').empty();

        if (_.size(data.rows) > 0) {
            var i = 1;

            _.each(data.rows, function (v) {
                var tr_death = v.ptstatus == '2' ? 'class="danger"' : '';
                var ptstatus = v.ptstatus == '1' ? 'หาย' : v.ptstatus == '2' ? 'ตาย' : v.ptstatus == '3' ? 'ยังรักษาอยู่' : v.ptstatus== '9' ? 'ไม่ทราบ' : '-';

                $('#tbl_waiting_list > tbody').append(
                    '<tr ' + tr_death + '>' +
                        '<td><input type="checkbox" data-name="chk_import" data-id="' + v.id + '" data-code506="'+ v.code506 +'"></td>' +
                        '<td>' + v.datesick +'</td>' +
                        '<td>' + app.clear_null(v.cid) + '</td>' +
                        '<td>' + app.clear_null(v.name) + '</td>' +
                        '<td>' + app.clear_null(v.birth) + '</td>' +
                        '<td>' + v.age + '</td>' +
                        '<td>' + ptstatus + '</td>' +
                        '<td>' + v.code506 + ' ' + app.strip(v.code506_name, 40) + '</td>' +
                        '<td>' + v.hospcode + ' ' + app.strip(v.hospname, 20) + '</td>' +
                        '<td><div class="btn-group">' +
                        '<a href="javascript:void(0);" class="btn btn-default" data-id="' + v.id + '" data-code506="' + v.code506 + '" ' +
                        'data-name="btn_approve" data-ptname="' + v.name + '" title="ยืนยันข้อมูล" data-rel="tooltip"><i class="glyphicon glyphicon-check"></i></a>' +
                        '<a href="javascript:void(0);" class="btn btn-default" data-id="' + v.id + '" title="ดูข้อมูล"' +
                        'data-name="btn_detail" data-rel="tooltip"><i class="glyphicon glyphicon-info-sign"></i></a>' +
                        '</div></td>' +
                        '</tr>'
                );
                i++;
            });

            app.set_runtime();
        }
        else {
            $('#tbl_waiting_list > tbody').append('<tr><td colspan="10">ไม่พบรายการ</td></tr>');
        }

    };

    $(document).on('click', 'a[data-name="btn_approve"]', function(e) {
        e.preventDefault();

        var ptname = $(this).data('ptname');
        var id = $(this).data('id');
        var code506 = $(this).data('code506');

        $('#txt_ap_id').val(id);
        $('#txt_ap_code506').val(code506);
        $('#txt_ap_ptname').html(ptname);

        ampur.modal.show_approve();
    });

    $('#btn_do_approve').on('click', function(e) {
        e.preventDefault();

        var id = $('#txt_ap_id').val();
        var code506 = $('#txt_ap_code506').val();

        if(!id) {
            app.alert('กรุณาระบุรหัส');
        } else {
            ampur.ajax.do_approve(id, code506, function(e) {
                if(e) {
                    app.alert(e);
                } else {
                    app.alert('ยืนยันข้อมูลเสร็จเรียบร้อยแล้ว');
                    ampur.modal.hide_approve();
                    ampur.get_waiting_list();
                    ampur.get_list();
                }
            });
        }
    });

    $(document).on('click', 'a[data-name="btn_detail"]', function(e) {
        e.preventDefault();

        var id = $(this).data('id');

        ampur.get_detail(id);
    });

    ampur.get_detail = function (id) {

        ampur.ajax.get_detail(id, function (err, data) {
            if (err) {
                app.alert(err);
            } else {
                ampur.set_detail(data.rows);
                ampur.modal.show_info();
            }
        });

    };

    ampur.get_organism = function (code506, org) {

        ampur.ajax.get_organism_list(code506, function (err, data) {
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

    ampur.clear_form = function () {
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

    ampur.set_detail = function (v) {

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
        ampur.get_ampur_list(v.chw, v.amp);
        ampur.get_tambon_list(v.chw, v.amp, v.tmb);
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
        ampur.get_organism(v.code506, v.organism);
        $('#sl_complication').val(v.complication);
        $('#sl_ptstatus').val(v.ptstatus);
        if (v.ptstatus == '2') $('#div_date_death').fadeIn('slow');
        $('#txt_date_death').val(v.date_death);
        $('#txt_date_record').val(v.date_record);
        $('#txt_date_report').val(v.date_report);
    };

    ampur.get_ampur_list = function (chw, amp) {

        $('#sl_ampur').empty();

        ampur.ajax.get_ampur_list(chw, function (err, data) {
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

    ampur.get_tambon_list = function (chw, amp, tmb) {

        $('#sl_tambon').empty();

        ampur.ajax.get_tambon_list(chw, amp, function (err, data) {
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

    ampur.get_moo_list = function (chw, amp, tmb, moo) {

        $('#sl_moo').empty();

        ampur.ajax.get_moo_list(chw, amp, tmb, function (err, data) {
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

    $('#mdl_edit_for_approve').on('hidden.bs.modal', function () {
        ampur.clear_form();
    })

    ampur.clear_form = function () {
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

    $('#btn_save').on('click', function () {
        var items = {};
        items.id = $('#txt_e0_id').val();
        items.code506=$('#txt_e0_code506').val();
            if (confirm('คุณต้องการบันทึกรายการใช่หรือไม่?')) {
                ampur.ajax.save(items, function (err) {
                    if (err) {
                        app.alert(err);
                    } else {
                        app.alert('บันทึกรายการเสร็จเรียบร้อยแล้ว');
                        ampur.clear_form();
                        ampur.modal.hide_approve()
                        ampur.get_waiting_list();
                    }
                });
            }

    });


    $('#btn_do_search').on('click', function(e) {
        e.preventDefault();

        var query = $('#txt_query').val();

        if(query)
        {
            ampur.ajax.search(query, function(err, data) {
                if(err)
                {
                    app.alert(err);
                }
                else
                {
                    ampur.modal.hide_search();
                    $('#main_paging').fadeOut('slow');

                    ampur.set_list(data);
                }
            });
        }
        else
        {
            app.alert('กรุณาระบุคำค้นหา');
        }
    });

    // search
    $('#btn_search').on('click', function(e) {
        e.preventDefault();

        ampur.modal.show_search();

    });

    $('#btn_get_list').on('click', function(e) {

        e.preventDefault();

        var start_date = $('#txt_query_start_date').val(),
            end_date = $('#txt_query_end_date').val(),
            ptstatus = $('#sl_query_ptstatus').val(),
            nation = $('#sl_query_nation').val();

        /*if(start_date && end_date) {
            ampur.get_list_filter(start_date, end_date, ptstatus, nation);
        }
        else
        {
            ampur.get_list(ptstatus);
        }*/

        ampur.get_list(start_date, end_date, ptstatus, nation);
    });


    $('#btn_do_import').on('click', function () {
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
        var data = [];
        var id = [];

        $('input[data-name="chk_import"]').each(function () {
            if ($(this).prop('checked')) {
                var obj = {};
                obj.id = $(this).data('id');
                obj.code506 = $(this).data('code506');
                data.push(obj);
                //id.push($(this).data('id'));
            }
        });

        if (data.length == 0) {
            app.alert('กรุณาเลือกรายการที่ต้องการนำเข้า');
        }
        else {
            if (confirm('คุณต้องการนำเข้ารายการทั้งหมด ' + data.length + ' รายการ ใช่หรือไม่?')) {
                ampur.ajax.do_import(data, function (err) {
                    if (err) {
                        app.alert(err);
                    }
                    else {
                        app.alert('นำเข้าข้อมูลเสร็จเรียบร้อยแล้ว');
                        ampur.get_waiting_list();
                    }
                });
            }
        }
    });

    $('label[data-name="opt_ptstatus"]').on('click', function(e) {

        e.preventDefault();

        var ptstatus = $(this).data('value');
        ampur.get_waiting_list(ptstatus);
    });


    ampur.ajax.get_waiting_list_total(null, function (err, v) {

        $('#spn_wait').html(app.add_commars_with_out_decimal(v.total));

    });

    ampur.ajax.get_other_total(null, null, function (err, v) {

        $('#spn_other').html(app.add_commars_with_out_decimal(v.total));

    });


    $('a[href="#tab_other"]').on('click', function () {
        ampur.get_other_list();
    });

    $('#btn_get_other_list').on('click', function(e) {

        e.preventDefault();

        var start_date = $('#txt_other_start_date').val();
        var end_date = $('#txt_other_end_date').val();

        ampur.get_other_list(start_date, end_date);
    });

    $('#btn_get_other_refresh').on('click', function(e) {

        e.preventDefault();

        ampur.get_other_list();
    });

    $(document).on('click', 'a[data-name="btn_get_map"]', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        app.go_to_url('/maps/show_map/' + id);
    });

    ampur.get_list();

    app.set_runtime();
});