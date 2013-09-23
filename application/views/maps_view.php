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
            <input type="text" id="txt_start_date" data-type="date" class="form-control"
                   placeholder="วว/ดด/ปปปป" style="width: 110px;">
            - <input type="text" id="txt_end_date" data-type="date" class="form-control"
                   placeholder="วว/ดด/ปปปป" style="width: 110px;">
|
            <select style="width: 150px;" class="form-control" id="sl_ampur">
                <option value="">พื้นที่ [ทั้งหมด]</option>
                <option value="4401">อำเภอเมืองมหาสารคาม</option>
                <option value="4402">อำเภอแกดำ</option>
                <option value="4403">อำเภอโกสุมพิสัย</option>
                <option value="4404">อำเภอกันทรวิชัย</option>
                <option value="4405">อำเภอเชียงยืน</option>
                <option value="4406">อำเภอบรบือ</option>
                <option value="4407">อำเภอนาเชือก</option>
                <option value="4408">อำเภอพยัคฆภูมิพิสัย</option>
                <option value="4409">อำเภอวาปีปทุม</option>
            </select>
            <select style="width: 200px;" class="form-control" id="sl_code506">
                <option value="">กลุ่มโรค [ทั้งหมด]</option>
                <?php
                foreach($code506 as $r)
                {
                    echo '<option value="'.$r->code.'">['. $r->code .'] ' . $r->name . '</option>';
                }
                ?>
            </select>
            <select id="sl_nation" style="width: 120px;" class="form-control">
                <option value="">สัญชาติ [ทั้งหมด]</option>
                <?php
                foreach($nation as $r) {
                    echo '<option value="' . $r->code . '">' . $r->name . '</option>';
                } ?>
            </select>
            <select style="width: 130px;" class="form-control" id="sl_ptstatus">
                <option value="">สถานะ [ทั้งหมด]</option>
                <option value="1">หาย</option>
                <option value="2">เสียชีวิต</option>
                <option value="3">ยังรักษาอยู่</option>
            </select>
            <button type="button" class="btn btn-primary" id="btn_get_map">
                <i class="glyphicon glyphicon-search"></i>
            </button>
            <button type="button" class="btn btn-success" id="btn_get_data">
                <i class="glyphicon glyphicon-th-list"></i>
            </button>
        </form>
        <!--<ul class="nav navbar-nav pull-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="glyphicon glyphicon-th"></i> <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li class="dropdown-header">
                        <?/*=$this->session->userdata('hospcode')*/?> :
                        <?/*=$this->session->userdata('hospname')*/?> :
                        <?/*=$this->session->userdata('amp_code')*/?>
                    </li>
                    <li><a href="<?/*=site_url('/users/user_profile')*/?>"><i class="glyphicon glyphicon-user"></i> ข้อมูลส่วนตัว</a></li>
                    <li><a href="#"><i class="glyphicon glyphicon-lock"></i> เปลี่ยนรหัสผ่าน</a></li>
                    <li class="divider"></li>
                    <li><a href="<?/*=site_url('users/logout')*/?>"><i class="glyphicon glyphicon-log-out"></i> ออกจากระบบ</a></li>
                </ul>
            </li>
        </ul>-->
    </div>
</nav>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&language=th"></script>
<script src="<?=base_url()?>assets/js/markercluster.js" charset="utf-8"></script>
<script src="<?=base_url()?>assets/apps/js/maps.js" charset="utf-8"></script>

<div id="map"></div>