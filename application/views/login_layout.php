<!DOCTYPE html>
<html lang="en">
<head>
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
    <style>
    body {
    padding-top: 40px;
    padding-bottom: 40px;
    background-color: #f5f5f5;
    }

    .form-signin {
    max-width: 400px;
    padding: 19px 29px 29px;
    margin: 0 auto 20px;
    background-color: #fff;
    border: 1px solid #e5e5e5;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
    -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
    -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
    box-shadow: 0 1px 2px rgba(0,0,0,.05);
    }
    .form-signin .form-signin-heading,
    .form-signin .checkbox {
    margin-bottom: 10px;
    }
    .form-signin input[type="text"],
    .form-signin input[type="password"] {
    font-size: 16px;
    height: auto;
    margin-bottom: 15px;
    padding: 7px 9px;
    }

    </style>
    <!-- Bootstrap core CSS -->
    <link href="<?=base_url()?>assets/css/bootstrap.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/bootstrap-glyphicons.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/freeow/freeow.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/apps/css/app.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="<?=base_url()?>assets/js/html5shiv.js"></script>
    <script src="<?=base_url()?>assets/js/respond/respond.min.js"></script>
    <![endif]-->

    <!-- Favicons -->
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
    <script src="<?=base_url()?>assets/js/jquery.maskedinput.min.js"></script>
    <script src="<?=base_url()?>assets/js/jquery.numeric.js"></script>
    <script src="<?=base_url()?>assets/js/jquery.paging.min.js"></script>
    <script src="<?=base_url()?>assets/js/numeral.min.js"></script>


    <!-- load application -->
    <script src="<?=base_url()?>assets/apps/js/apps.js"></script>
</head>

<body>

<div id="freeow" class="freeow freeow-top-right"></div>

<div class="container">
   <?php echo $content_for_layout; ?>
</div>
</body>
</html>