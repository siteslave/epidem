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
    <!-- load library -->
    <script src="<?=base_url()?>assets/js/underscore.min.js"></script>
    <script src="<?=base_url()?>assets/js/jquery.blockUI.js"></script>
    <script src="<?=base_url()?>assets/js/jquery.cookie.min.js"></script>
    <script src="<?=base_url()?>assets/js/jquery.freeow.min.js"></script>

    <script src="<?=base_url()?>assets/js/numeral.min.js"></script>
	<script src="<?=base_url()?>assets/js/jquery.maskedinput.min.js"></script>
	<script src="<?=base_url()?>assets/js/jquery.numeric.js"></script>
	
    <!-- load application -->
    <script src="<?=base_url()?>assets/apps/js/apps.js"></script>
</head>
<body>

<style>

    html, body {
        height: 100%;
        overflow: hidden;
    }
    body { padding-top: 50px; margin: 0;}

    #map {
        background-color: #e5e3df;
        height: 100%;
    }

</style>

<div id="freeow" class="freeow freeow-bottom-right"></div>

<?=$content_for_layout?>

</body>
</html>
