<form id="frm_login" class="form-signin" action="<?=site_url('users/do_login')?>" method="post">

    <?php if(isset($error)) { ?>
    <div class="alert alert-danger">
        <a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
        <p>ชื่อผู้ใช้งาน หรือ รหัสผ่าน ไม่ถูกต้อง</p>
    </div>
    <?php } ?>

    <input type="text" name="username" id="txt_password" class="form-control" placeholder="ชื่อผู้ใช้งาน" autofocus>
    <input type="password" name="password" id="txt_username" class="form-control" placeholder="รหัสผ่าน">
    <input type="hidden" name="csrf_token" value="<?=$this->security->get_csrf_hash()?>">
    <button class="btn btn-lg btn-primary btn-block" type="submit" id="btn_login">Sign in</button>
</form>
<script src="<?=base_url()?>assets/apps/js/users.js" charset="utf-8"></script>