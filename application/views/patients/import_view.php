<ul class="breadcrumb">
    <li><a href="<?=site_url()?>">หน้าหลัก</a> </li>
    <li class="active">นำเข้าข้อมูล</li>
</ul>

<div class="navbar">
    <form action="#" class="navbar-form">
        <label>ตั้งแต่วันที่</label>
        <input type="text" id="txt_start_date" data-type="date" 
        placeholder="dd/mm/yyyy" title="ระบุวันที่" rel="tooltip" style="width: 150px;">

        <label>ถึงวันที่</label>
        <input type="text" id="txt_end_date" data-type="date" 
        placeholder="dd/mm/yyyy" title="ระบุวันที่" rel="tooltip" style="width: 150px;">
        <button type="button" class="btn btn-primary" id="btn_get_list">
            <i class="icon-search"></i>
        </button>
    </form>
</div>


<table class="table talbe-stripped" id="tbl_list">
    <thead>
        <tr>
            <th>#</th>
            <th>วันที่</th>
            <th>เลขบัตรประชาชน</th>
            <th>ชื่อ - สกุล</th>
            <th>วันเกิด</th>
            <th>อายุ</th>
            <th>รหัสการวินิจฉัยโรค</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td colspan="8">...</td>
        </tr>
    </tbody>
</table>


<script src="<?=base_url()?>assets/apps/js/imports.js" charset="utf-8"></script>