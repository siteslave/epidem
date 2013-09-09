<ul class="breadcrumb">
    <li><a href="<?=site_url()?>">หน้าหลัก</a> </li>
    <li class="active">ส่งออกข้อมูล</li>
</ul>
<div class="navbar navbar-default">
    <form action="#" class="navbar-form">
        <label>ตั้งแต่วันที่</label>
        <input type="text" id="txt_start_date" data-type="date" class="form-control"
               placeholder="วว/ดด/ปปปป" title="เช่น 01/01/2556" data-rel="tooltip" style="width: 110px;">

        <label>ถึงวันที่</label>
        <input type="text" id="txt_end_date" data-type="date" class="form-control"
               placeholder="วว/ดด/ปปปป" style="width: 110px;" title="เช่น 31/01/2556" data-rel="tooltip">
        <div class="btn-group">
            <button type="button" class="btn btn-primary" id="btn_get_list">
                <i class="glyphicon glyphicon-search"></i> แสดง
            </button>
        </div>
        <button type="button" class="btn btn-success pull-right" id="btn_do_export">
            <i class="glyphicon glyphicon-floppy-save"></i> ส่งออก (.txt)
        </button>
    </form>
</div>

<table class="table table-striped" id="tbl_list">
    <thead>
    <tr>
        <th>E0</th>
        <th>E1</th>
        <th>CODE506</th>
        <th>ชื่อ - สกุล</th>
        <th>สัญชาติ</th>
        <th>ที่อยู่</th>
        <th>วันที่ป่วย</th>
        <th>สถานะ</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td colspan="8">ระบุเงื่อนไขเพื่อแสดงข้อมูล</td>
    </tr>
    </tbody>
</table>

<ul class="pagination" id="paging"></ul>

<script src="<?=base_url()?>assets/apps/js/exports.js" charset="utf-8"></script>