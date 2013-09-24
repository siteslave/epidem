<ul class="breadcrumb">
    <li><a href="<?=site_url()?>">หน้าหลัก</a> </li>
    <li class="active">นำเข้าข้อมูล</li>
</ul>

<ul class="nav nav-tabs">
    <li class="active"><a href="#tab_patient" data-toggle="tab"><i class="glyphicon glyphicon-th"></i> ทะเบียนทั้งหมด <span class="badge" id="spn_total">0</span></a></li>
    <li><a href="#tab_wait" data-toggle="tab"><i class="glyphicon glyphicon-time"></i> รอตรวจสอบ <span class="badge" id="spn_wait">0</span></a></li>
    <li><a href="#tab_other" data-toggle="tab"><i class="glyphicon glyphicon-eye-close"></i> จากสถานบริการอื่น <span class="badge" id="spn_other">0</span></a></li>
</ul>
<div class="tab-content">
    <div class="tab-pane active" id="tab_patient">
        <br>
        <div class="navbar navbar-default">
            <form action="#" class="navbar-form">
                <label>ตั้งแต่วันที่</label>
                <input type="text" id="txt_query_start_date" data-type="date" class="form-control"
                       placeholder="วว/ดด/ปปปป" title="เช่น 01/01/2556" data-rel="tooltip" style="width: 110px;">

                <label>ถึงวันที่</label>
                <input type="text" id="txt_query_end_date" data-type="date" class="form-control"
                       placeholder="วว/ดด/ปปปป" style="width: 110px;" title="เช่น 31/01/2556" data-rel="tooltip">

                <select class="form-control" style="width: 130px;" id="sl_query_ptstatus" autocomplete="off">
                    <option value="">ทั้งหมด</option>
                    <option value="1">หาย</option>
                    <option value="2">เสียชีวิต</option>
                    <option value="3">ยังรักษาอยู่</option>
                </select>

                <select id="sl_query_nation" style="width: 180px;" class="form-control">
                    <option value="">ทั้งหมด</option>
                    <?php
                    foreach($nation as $r) {
                        echo '<option value="' . $r->code . '">' . $r->name . '</option>';
                    } ?>
                </select>

                <div class="btn-group">
                    <button type="button" class="btn btn-primary" id="btn_get_list">
                        <i class="glyphicon glyphicon-search"></i> แสดง
                    </button>
                </div>
                <!--
                <label>ค้นหา</label>
                <input type="text" id="txt_query" class="form-control"
                       placeholder="ระบุสิ่งที่ต้องการค้นหา" title="หมายเลขบัตรประชาชน, ชื่อ, HN"
                       data-rel="tooltip" style="width: 210px;">

                -->
                <div class="btn-group pull-right">
                    <button type="button" class="btn btn-default" id="btn_search">
                        <i class="glyphicon glyphicon-search"></i> ค้นหา
                    </button>

                    <button type="button" class="btn btn-success" id="btn_refresh">
                        <i class="glyphicon glyphicon-refresh"></i> รีเฟรช
                    </button>
                </div>
            </form>
        </div>

        <table class="table table-striped" id="tbl_list">
            <thead>
            <tr>
				<th></th>
                <th>E0</th>
                <th>E1</th>
                <th>วันที่ป่วย</th>
                <th>เลขบัตรประชาชน</th>
                <th>ชื่อ - สกุล</th>
                <th>วันเกิด</th>
                <th>อายุ (ปี)</th>
                <th>สถานะ</th>
                <th>CODE506</th>
                <th>หน่วยบริการ</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td colspan="12">...</td>
            </tr>
            </tbody>
        </table>

        <ul class="pagination" id="main_paging"></ul>
    </div>

    <div class="tab-pane" id="tab_wait">
        <br>

        <div class="navbar navbar-default">
            <form action="#" class="navbar-form">
                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-default" data-name="opt_ptstatus">
                        <input type="radio" name="options">
                        <i class="glyphicon glyphicon-th-list"></i> ทั้งหมด
                    </label>
                    <label class="btn btn-success" data-name="opt_ptstatus" data-value="1">
                        <input type="radio" name="options">
                        <i class="glyphicon glyphicon-check"></i> หาย
                    </label>
                    <label class="btn btn-default" data-name="opt_ptstatus" data-value="2">
                        <input type="radio" name="options">
                        <i class="glyphicon glyphicon-fire"></i> เสียชีวิต
                    </label>
                    <label class="btn btn-primary" data-name="opt_ptstatus" data-value="3">
                        <input type="radio" name="options">
                        <i class="glyphicon glyphicon-eye-close"></i> ยังรักษาอยู่
                    </label>
                </div>
                <!--<label for="">สถานะ</label>
                <select id="sl_wait_ptstatus" class="form-control" style="width: 180px;">
                    <option value="">ทั้งหมด</option>
                    <option value="1">หาย</option>
                    <option value="2">เสียชีวิต</option>
                    <option value="3">ยังรักษาอยู่</option>
                </select>--><!--
                <button type="button" class="btn btn-primary" id="btn_get_wait_filter">
                    <i class="glyphicon glyphicon-search"></i> แสดง
                </button>-->

                <div class="btn-group pull-right">
                    <button type="button" class="btn btn-success" id="btn_check_all" title="เลือกทั้งหมด" data-rel="tooltip">
                        <i class="glyphicon glyphicon-check"></i> เลือก
                    </button>
                    <button type="button" class="btn btn-default" id="btn_clear_all" title="ยกเลิกทั้งหมด" data-rel="tooltip">
                        <i class="glyphicon glyphicon-refresh"></i> ยกเลิก
                    </button>
                    <button type="button" class="btn btn-danger" id="btn_do_import" title="นำเข้ารายการ" data-rel="tooltip">
                        <i class="glyphicon glyphicon-share"></i> นำเข้า
                    </button>
                </div>


            </form>
        </div>

        <table class="table table-striped" id="tbl_waiting_list">
            <thead>
            <tr>
                <th>#</th>
                <th>วันที่ป่วย</th>
                <th>เลขบัตรประชาชน</th>
                <th>ชื่อ - สกุล</th>
                <th>วันเกิด</th>
                <th>อายุ (ปี)</th>
                <th>สถานะ</th>
                <th>กลุ่มโรค 506</th>
                <th>สถานบริการ</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td colspan="10">...</td>
            </tr>
            </tbody>
        </table>
        <ul class="pagination" id="waiting_paging"></ul>
    </div>

    <div class="tab-pane" id="tab_other">
        <br>
        <div class="navbar navbar-default">
            <form action="#" class="navbar-form">
                <label>ตั้งแต่วันที่</label>
                <input type="text" id="txt_other_start_date" data-type="date" class="form-control"
                       placeholder="วว/ดด/ปปปป" title="เช่น 01/01/2556" data-rel="tooltip" style="width: 110px;">

                <label>ถึงวันที่</label>
                <input type="text" id="txt_other_end_date" data-type="date" class="form-control"
                       placeholder="วว/ดด/ปปปป" style="width: 110px;" title="เช่น 31/01/2556" data-rel="tooltip">

                <button type="button" class="btn btn-primary" id="btn_get_other_list">
                    <i class="glyphicon glyphicon-search"></i> แสดง
                </button>
                <button type="button" class="btn btn-success pull-right" id="btn_get_other_refresh">
                    <i class="glyphicon glyphicon-refresh"></i> ทั้งหมด
                </button>

            </form>
        </div>

        <table class="table table-striped" id="tbl_other_list">
            <thead>
            <tr>
				<th></th>
                <th>E0</th>
                <th>E1</th>
                <th>วันที่ป่วย</th>
                <th>เลขบัตรประชาชน</th>
                <th>ชื่อ - สกุล</th>
                <th>วันเกิด</th>
                <th>อายุ (ปี)</th>
                <th>สถานะ</th>
                <th>CODE506</th>
                <th>หน่วยบริการ</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td colspan="12">...</td>
            </tr>
            </tbody>
        </table>

        <ul class="pagination" id="other_paging"></ul>
    </div>

    <div class="modal fade" id="mdl_search">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="glyphicon glyphicon-search"></i> ค้นหาข้อมูล</h4>
                </div>
                <div class="modal-body">
                    <form action="#" class="form-inline">
                        <div class="input-group">
                            <input type="text" class="form-control" id="txt_query"
                                placeholder="เลขบัตรประชาชน, ชื่อ, HN">
                            <span class="input-group-btn">
                                <button class="btn btn-primary" id="btn_do_search" type="button">
                                    <i class="glyphicon glyphicon-search"></i> ค้นหา!</button>
                            </span>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <!--<a href="javascript:void(0);" class="btn btn-success" id="btn_do_approve"><i class="glyphicon glyphicon-floppy-save"></i> ใช่ ยืนยัน</a>
                    <a href="javascript:void(0);" class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> ปิดหน้าต่าง</a>-->
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="mdl_approve">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="glyphicon glyphicon-question-sign"></i> ยืนยันข้อมูล?</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="txt_ap_id" />
                    <input type="hidden" id="txt_ap_code506" />
                    <h3>คุณต้องการยืนยันข้อมูลของ <span class="label label-warning" id="txt_ap_ptname"></span> <br> ใช่หรือไม่?</h3>
                </div>
                <div class="modal-footer">
                    <a href="javascript:void(0);" class="btn btn-success" id="btn_do_approve"><i class="glyphicon glyphicon-floppy-save"></i> ใช่ ยืนยัน</a>
                    <a href="javascript:void(0);" class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> ปิดหน้าต่าง</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="mdl_info">
        <div class="modal-dialog" style="width: 960px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">ข้อมูลระบาดวิทยา</h4>
                </div>
                <div class="modal-body">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_patient_info" data-toggle="tab"><i class="glyphicon glyphicon-list"></i> ข้อมูลทั่วไป</a></li>
                        <li><a href="#tab_address_info" data-toggle="tab"><i class="glyphicon glyphicon-envelope"></i> ที่อยู่ขณะป่วย </a></li>
                        <li><a href="#tab_service_info" data-toggle="tab"><i class="glyphicon glyphicon-check"></i> ข้อมูลการเจ็บป่วย </a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_patient_info">
                            <br>
                            <form action="#" class="form-inline">
                                <input type="hidden" value="" id="txt_edit_id" />
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="">ชื่อ</label>
                                        <input type="text" id="txt_name" class="form-control" disabled />
                                    </div>
                                    <div class="col-md-3">
                                        <label for="">สกุล</label>
                                        <input type="text" id="txt_lname" class="form-control" disabled />
                                    </div>
                                    <div class="col-md-3">
                                        <label for="">เลขบัตรประชาชน</label>
                                        <input type="text" id="txt_cid" class="form-control" disabled />
                                    </div>
                                    <div class="col-md-2">
                                        <label for="">วันเกิด</label>
                                        <input type="text" id="txt_birth" data-type="date" class="form-control" disabled
                                               placeholder="วว/ดด/ปปปป" title="ระบุวันที่" data-rel="tooltip" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label for="">อายุ (ป-ด-ว)</label>
                                        <input type="text" id="txt_age" class="form-control" disabled />
                                    </div>
                                    <div class="col-md-2">
                                        <label for="">เพศ</label>
                                        <select id="sl_sex" class="form-control" disabled>
                                            <option value="1">ชาย</option>
                                            <option value="2">หญิง</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="">HN</label>
                                        <input type="text" id="txt_hn" class="form-control" disabled />
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">ผู้ปกครอง</label>
                                        <input type="text" id="txt_nmepate" class="form-control" disabled />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label for="">สถานะสมรส</label>
                                        <select id="sl_mstatus" class="form-control" disabled >
                                            <option value="">-*-</option>
                                            <option value="1">โสด</option>
                                            <option value="2">คู่</option>
                                            <option value="3">หม้าย</option>
                                            <option value="4">หย่า</option>
                                            <option value="5">แยก</option>
                                            <option value="6">สมณะ</option>
                                            <option value="9">ไม่ทราบ</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="">สัญชาติ</label>
                                        <select id="sl_nations" class="form-control" disabled >
                                            <option value="">-*-</option>
                                            <?php foreach($nation as $r) echo '<option value="'.$r->code.'">['.$r->code.'] '.$r->name.'</option>';?>
                                        </select>
                                    </div>
                                    <div class="col-md-7">
                                        <label for="">อาชีพ</label>
                                        <select id="sl_occupation" class="form-control" disabled >
                                            <?php foreach($occpuation as $r) echo '<option value="'.$r->code.'">['.$r->code.'] '.$r->name.'</option>';?>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane" id="tab_address_info">
                            <br>
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="">เลขที่</label>
                                    <input type="text" id="txt_address" class="form-control" disabled />
                                </div>
                                <div class="col-md-4">
                                    <label for="">ซอย</label>
                                    <input type="text" id="txt_soi" class="form-control" disabled />
                                </div>
                                <div class="col-md-5">
                                    <label for="">ถนน</label>
                                    <input type="text" id="txt_road" class="form-control" disabled />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="">จังหวัด</label>
                                    <select id="sl_changwat" class="form-control" disabled >
                                        <option value="">-*-</option>
                                        <?php
                                        foreach($chw as $r)
                                        {
                                            echo '<option value="'.$r->chw.'">['. $r->chw .'] '.$r->name.'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="">อำเภอ</label>
                                    <select id="sl_ampur" class="form-control" disabled ></select>
                                </div>
                                <div class="col-md-3">
                                    <label for="">ตำบล</label>
                                    <select id="sl_tambon" class="form-control" disabled ></select>
                                </div>
                                <div class="col-md-2">
                                    <label for="">หมู่</label>
                                    <select id="sl_moo" class="form-control" disabled >
                                        <option value="">-*-</option>
                                        <?php
                                        for($i=1;$i<=30;$i++) {
                                            $str_moo = strlen($i) < 2 ? '0' . $i : $i;
                                            echo '<option value="'. $str_moo .'">'.$str_moo.'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="">ในเขต/นอกเขต</label>
                                    <select id="sl_address_type" class="form-control" disabled >
                                        <option value="">-*-</option>
                                        <option value="1">ในเขตเทศบาล</option>
                                        <option value="2">นอกเขตเทศบาล</option>
                                        <option value="3">ไม่ทราบ</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="">โรงเรียน</label>
                                    <input type="text" id="txt_school" class="form-control" disabled />
                                </div>
                                <div class="col-md-3">
                                    <label for="">ชั้นเรียน</label>
                                    <input type="text" id="txt_school_class" class="form-control" disabled />
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_service_info">
                            <br>
                            <form action="#">
                                <div class="row">
                                    <div class="col-md-2">
                                        <label for="">วันที่เขียน</label>
                                        <input type="text" id="txt_date_record" data-type="date" class="form-control"
                                               data-rel="tooltip" title="ระบุวันที่" placeholder="วว/ดด/ปปปป" disabled />
                                    </div>
                                    <div class="col-md-3">
                                        <label for="">วันที่รายงาน</label>
                                        <input type="text" id="txt_date_report" data-type="date" class="form-control"
                                               data-rel="tooltip" title="ระบุวันที่" placeholder="วว/ดด/ปปปป" disabled />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label for="">วันที่เริ่มป่วย</label>
                                        <input type="text" disabled placeholder="วว/ดด/ปปปป" id="txt_illdate" class="form-control"
                                               data-type="date" title="ระบุวันที่เริ่มป่วย" data-rel="title" disabled />
                                    </div>
                                    <div class="col-md-2">
                                        <label for="">วันที่รับรักษา</label>
                                        <input type="text" disabled placeholder="วว/ดด/ปปปป" id="txt_date_serv" class="form-control"
                                               data-type="date" title="ระบุวันที่เริ่มป่วย" data-rel="title" disabled />
                                    </div>
                                    <div class="col-md-2">
                                        <label for="">ประเภทผู้ป่วย</label>
                                        <select id="sl_patient_type" class="form-control" disabled >
                                            <option value="">-*-</option>
                                            <option value="1">ผู้ป่วยนอก</option>
                                            <option value="2">ผู้ป่วยใน</option>
                                            <option value="3">ค้นพบในชุมชน</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">รักษาที่</label>
                                        <select id="sl_service_place" class="form-control" disabled >
                                            <option value="">-*-</option>
                                            <?php foreach($hospital_type as $r) echo '<option value="'.$r->code.'">['.$r->code.'] '.$r->name.'</option>';?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label for="">ICD10</label>
                                        <input type="text" id="txt_icd10_code" class="form-control" disabled />
                                    </div>
                                    <div class="col-md-10">
                                        <label for="">ชื่อการวินิจฉัยโรค</label>
                                        <input type="text" id="txt_icd10_name" class="form-control" disabled />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="">กลุ่มโรค 506</label>
                                        <select id="sl_code506" class="form-control" disabled >
                                            <option value="">-*-</option>
                                            <?php
                                            foreach($code506 as $r)
                                            {
                                                echo '<option value="'.$r->code.'">['. $r->code .'] '. $r->name . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Organism</label>
                                        <select id="sl_organism" class="form-control" title="เลือกกลุ่มโรค 506 ก่อน"
                                                data-rel="tooltip" disabled >
                                            <option value="">-*-</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Complication</label>
                                        <select id="sl_complication" class="form-control" disabled >
                                            <option value="">-*-</option>
                                            <?php
                                            foreach($comp as $r)
                                            {
                                                echo '<option value="'.$r->code.'">['. $r->code .'] '. $r->name . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="">ผลการรักษา</label>
                                        <select id="sl_ptstatus" class="form-control" disabled >
                                            <option value="">-*-</option>
                                            <option value="1">หาย</option>
                                            <option value="2">เสียชีวิต</option>
                                            <option value="3">ยังรักษาอยู่</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2" id="div_date_death" style="display: none;">
                                        <label for="">วันที่เสียชีวิต</label>
                                        <input type="text" data-type="date" class="form-control" disabled
                                               data-rel="tooltip" title="ระบุวันที่เสียชีวิต" placeholder="วว/ดด/ปปปป" />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                   <a href="javascript:void(0);" class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> ปิดหน้าต่าง</a>
                </div>
            </div>
        </div>
    </div>


<script src="<?=base_url()?>assets/apps/js/ampur.js" charset="utf-8"></script>