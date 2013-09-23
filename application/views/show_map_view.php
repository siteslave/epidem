<nav role="navigation" class="navbar navbar-default navbar-fixed-top">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?=site_url()?>">EPIDEM</a>
    </div>
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <form action="#" class="navbar-form navbar-left">
            <input type="hidden" id="txt_id" value="<?=$id?>" />
            <label for="">CID</label>
            <input type="text" class="form-control" style="width: 160px;" value="<?=$cid?>"
                   id="txt_cid" disabled />
            <label for="">ชื่อ - สกุล</label>
            <input type="text" class="form-control" style="width: 200px;" value="<?=$fullname?>"
                   id="txt_fullname" disabled />
            <input type="text" class="form-control" style="width: 350px;" value="<?=$address?>"
                disabled />

            <input type="hidden" id="txt_lat" value="<?=$lat?>" />
            <input type="hidden" id="txt_lng" value="<?=$lng?>" />

            <div class="btn-group">
                <button type="button" class="btn btn-success" id="btn_get_direction"
                        data-placement="left" title="ขอเส้นทาง" data-rel="tooltip">
                    <i class="glyphicon glyphicon-road"></i>
                </button>
                <button type="button" class="btn btn-default" id="btn_get_detail"
                        data-placement="right" title="ข้อมูลระบาด" data-rel="tooltip">
                    <i class="glyphicon glyphicon-edit"></i>
                </button>
            </div>
        </form>
        <ul class="nav navbar-nav pull-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="glyphicon glyphicon-th"></i> <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li class="dropdown-header">
                        <?=$this->session->userdata('hospcode')?> :
                        <?=$this->session->userdata('hospname')?> :
                        <?=$this->session->userdata('amp_code')?>
                    </li>
                    <li><a href="<?=site_url('/users/user_profile')?>"><i class="glyphicon glyphicon-user"></i> ข้อมูลส่วนตัว</a></li>
                    <li><a href="#"><i class="glyphicon glyphicon-lock"></i> เปลี่ยนรหัสผ่าน</a></li>
                    <li class="divider"></li>
                    <li><a href="<?=site_url('users/logout')?>"><i class="glyphicon glyphicon-log-out"></i> ออกจากระบบ</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>

<div id="map"></div>


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
                    <?php foreach($occupation as $r) echo '<option value="'.$r->code.'">['.$r->code.'] '.$r->name.'</option>';?>
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

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&language=th"></script>
<script src="<?=base_url()?>assets/apps/js/show_map.js" charset="utf-8"></script>

