<ul class="breadcrumb">
    <li><a href="<?=site_url()?>">หน้าหลัก </a></li>
    <li class="active"> ข้อมูลผู้ใช้ </li>
</ul>
<div class="panel panel-primary col col-lg-12">
    <!-- Default panel contents -->
    <div class="panel-heading">ข้อมูลผู้ใช้ : User Profile จาก ระบบ Usercenter

    </div>
    <dl class="dl-horizontal">
        <dt>ระบบ : System</dt>
        <dd>ระบบราบงานระบาดวิทยา : Epidem online (5)</dd>
        <dt>ชื่อ สกุล</dt>
        <dd><?=$this->session->userdata('user_name')."( UserID : ".$this->session->userdata('user_id').")";?></dd>
        <dt>Username :</dt>
        <dd><?=$this->session->userdata('username')." (".$this->session->userdata('user_level').")";?></dd>
        <dt>หน่วยบริการ </dt>
        <dd><?=$this->session->userdata('off_name').' ('.$this->session->userdata('off_id').' )';?></dd>
        <dt>ประเภทหน่วยบริการ </dt>
        <dd><?=$this->session->userdata('user_type');?></dd>
        <dt>E-mail </dt>
        <dd><?=$this->session->userdata('hserv');?></dd>
        <dt>เบอร์โทร </dt>
        <dd><?=$this->session->userdata('amp_code');?></dd>
    </dl>
 <span class='pull-right text-right'>
            <a href='http://localhost/usercenter/index.php/users/login_auto?ck=<?php echo $user.$pass;?>' class='btn btn-info' target="_blank">แก้ไข</a>
        </span>
</div>

<div class="panel panel-primary col col-lg-12">
    <!-- Default panel contents -->
    <div class="panel-heading">ข้อมูลระบบระบาดวิทยา : Epidem Profile</div>
    <dl class="dl-horizontal">
        <dt>ระบบ : System</dt>
        <dd>ระบบราบงานระบาดวิทยา : Epidem online (5)</dd>

        <dt>หน่วยบริการ </dt>
        <dd><?=$this->session->userdata('off_name').' ('.$this->session->userdata('off_id').' )';?></dd>
        <dt>รหัสหน่วยบริการ 506 </dt>
        <dd><?=$this->session->userdata('hserv');?></dd>
        <dt>รหัสอำเภอ</dt>
        <dd><?=$this->session->userdata('amp_code');?></dd>
    </dl>
 <span class='pull-right text-right'>
            <a href='http://localhost/usercenter/index.php/users/login_auto?ck=<?php echo $user.$pass;?>' class='btn btn-info' target="_blank">แก้ไข</a>
 </span>
</div>
<?php
        /*echo "User".$user;
        echo "<br>Pass:".$pass;
       echo  "<br>",$user.$pass;*/

?>