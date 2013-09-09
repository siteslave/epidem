<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> EPIDEM Online </title>
    
    <script type="text/javascript" charset="utf-8">
    var site_url = '<?=site_url()?>';
    var base_url = '<?=base_url()?>';

    var csrf_token = '<?php echo $this->security->get_csrf_hash(); ?>';
    </script>

    <!-- Bootstrap core CSS -->
    <link href="<?=base_url()?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/flags.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/freeow/freeow.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/apps/css/app.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="<?=base_url()?>assets/js/html5shiv.js"></script>
    <script src="<?=base_url()?>assets/js/respond.min.js"></script>
    <![endif]-->

    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?=base_url()?>assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?=base_url()?>assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?=base_url()?>assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?=base_url()?>assets/ico/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="<?=base_url()?>assets/ico/favicon.png">

    <script src="<?=base_url()?>assets/js/jquery.js"></script>
    <script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
    <script src="<?=base_url()?>assets/heighcharts/js/highcharts.js"></script>
    <!-- load library -->
    <script src="<?=base_url()?>assets/js/underscore.min.js"></script>
    <script src="<?=base_url()?>assets/js/jquery.blockUI.js"></script>
    <script src="<?=base_url()?>assets/js/jquery.cookie.min.js"></script>
    <script src="<?=base_url()?>assets/js/jquery.freeow.min.js"></script>
    <script src="<?=base_url()?>assets/js/jquery.maskedinput.min.js"></script>
    <script src="<?=base_url()?>assets/js/jquery.numeric.js"></script>
    <script src="<?=base_url()?>assets/js/jquery.paging.min.js"></script>
    <script src="<?=base_url()?>assets/js/numeral.min.js"></script>

    <!-- load application -->
    <script src="<?=base_url()?>assets/apps/js/apps.js"></script>
</head>
<body>

<style>
    body { padding-top: 60px; }
</style>

<div id="freeow" class="freeow freeow-bottom-right"></div>
<!-- Fixed navbar -->
<nav role="navigation" class="navbar navbar-default navbar-fixed-top">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">EPIDEM</a>
    </div>
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav">
            <li><a href="<?=site_url()?>"><i class="glyphicon glyphicon-home"></i> หน้าหลัก</a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-list"></i> บริการหลัก <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li role="presentation" class="dropdown-header">MAIN SERVICES</li>
                    <li><a href="<?=site_url('ampur')?>"><i class="glyphicon glyphicon-th-list"></i> ทะเบียนผู้ป่วย</a></li>
                </ul>
            </li>
            <li class="">
                <a href="<?=site_url('/reports')?>" class=""><i class="glyphicon glyphicon-print"></i> รายงาน </a>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-cog"></i> เครื่องมือ <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li class="dropdown-header">TOOLS</li>
                    <li><a href="<?=site_url('exports')?>"><i class="glyphicon glyphicon-cloud-download"></i> ส่งออกข้อมูล (R506)</a></li>
                </ul>
            </li>
        </ul>
        <ul class="nav navbar-nav pull-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="glyphicon glyphicon-cog"></i> <b class="caret"></b></a>
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
        <p class="navbar-text pull-right"> สวัสดี, <i><?=$this->session->userdata('fullname');?></i></p>
    </div>
</nav>

<div class="container">
    <?=$content_for_layout?>
</div>

</body>
</html>
