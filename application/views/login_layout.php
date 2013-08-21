<!DOCTYPE html>
<html lang="en">
<head>
<head>
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> EPIDEM :: Login </title>
    <!-- Bootstrap core CSS -->
    <link href="<?=base_url()?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/signin.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/freeow/freeow.css" rel="stylesheet">

    <script src="<?=base_url()?>assets/js/jquery.js"></script>
    <script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>

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

    <script type="text/javascript" charset="utf-8">
        var site_url = '<?=site_url()?>';
        var base_url = '<?=base_url()?>';

        var csrf_token = '<?php echo $this->security->get_csrf_hash(); ?>';
    </script>

    <script src="<?=base_url()?>assets/js/jquery.freeow.min.js"></script>
</head>

<body>
    <div id="freeow" class="freeow freeow-bottom-right"></div>

    <div class="container">
       <?php echo $content_for_layout; ?>
    </div>
</body>
</html>