<?php
$html_lang = ($direction == "ltr")?"en":"ar";
?>
<!DOCTYPE html>
<html lang="<?php echo $html_lang;?>" dir="<?php echo $direction;?>"  xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <!-- Viewport metatags -->
    <meta name="HandheldFriendly" content="true" />
    <meta name="MobileOptimized" content="320" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <!-- iOS webapp metatags -->
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />

    <!-- iOS webapp icons -->
    <link rel="apple-touch-icon-precomposed" href="<?php echo ci_site_url('assets/images/logo-256.png'); ?>" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo ci_site_url('assets/images/logo-72.png'); ?>" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo ci_site_url('assets/images/logo-114.png'); ?>" />

    <!-- TODO: Add a favicon -->
    <link rel="shortcut icon" href="<?php echo ci_site_url($_backstage_dir.'/images/favicon.png'); ?>">

    <title><?php echo $meta_title; ?></title>
	<?php 	
	if($direction == "ltr"):
	//load the LTR styles?>
    <!--Page loading plugin Start -->
    <link rel="stylesheet" href="<?php echo ci_site_url($_backstage_dir.'/css/plugins/pace.css'); ?>">
    <script src="<?php echo ci_site_url($_backstage_dir.'/js/pace.min.js'); ?>"></script>
    <!--Page loading plugin End   -->

    <!-- Plugin Css Put Here -->
    <link href="<?php echo ci_site_url($_backstage_dir.'/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo ci_site_url($_backstage_dir.'/css/plugins/bootstrap-switch.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo ci_site_url($_backstage_dir.'/css/plugins/ladda-themeless.min.css'); ?>">

    <link href="<?php echo ci_site_url($_backstage_dir.'/css/plugins/humane_themes/bigbox.css'); ?>" rel="stylesheet">
    <link href="<?php echo ci_site_url($_backstage_dir.'/css/plugins/humane_themes/libnotify.css'); ?>" rel="stylesheet">
    <link href="<?php echo ci_site_url($_backstage_dir.'/css/plugins/humane_themes/jackedup.css'); ?>" rel="stylesheet">

    <!-- Plugin Css End -->
    <!-- Custom styles Style -->
    <link href="<?php echo ci_site_url($_backstage_dir.'/css/style.css'); ?>" rel="stylesheet">
    <!-- Custom styles Style End-->
	
    <!-- Responsive Style For-->    
    <link href="<?php echo ci_site_url($_backstage_dir.'/css/responsive.css'); ?>" rel="stylesheet">
    <!-- Responsive Style For-->
    <link rel="stylesheet" href="<?php echo ci_site_url($_backstage_dir.'/css/plugins/validationEngine.jquery.css'); ?>">
    <?php 	
	else:
	//load the RTL styles?>  
    <!--Page loading plugin Start -->
    <link rel="stylesheet" href="<?php echo ci_site_url($_backstage_dir.'/css/rtl-css/plugins/pace-rtl.css'); ?>">
    <script src="<?php echo ci_site_url($_backstage_dir.'/js/pace.min.js'); ?>"></script>
    <!--Page loading plugin End   -->

    <!-- Plugin Css Put Here -->
    <link href="<?php echo ci_site_url($_backstage_dir.'/css/bootstrap-rtl.css'); ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo ci_site_url($_backstage_dir.'/css/plugins/bootstrap-switch.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo ci_site_url($_backstage_dir.'/css/plugins/ladda-themeless.min.css'); ?>">

    <link href="<?php echo ci_site_url($_backstage_dir.'/css/plugins/humane_themes/bigbox.css'); ?>" rel="stylesheet">
    <link href="<?php echo ci_site_url($_backstage_dir.'/css/plugins/humane_themes/libnotify.css'); ?>" rel="stylesheet">
    <link href="<?php echo ci_site_url($_backstage_dir.'/css/plugins/humane_themes/jackedup.css'); ?>" rel="stylesheet">

    <!-- Plugin Css End -->
    <!-- Custom styles Style -->
    <link href="<?php echo ci_site_url($_backstage_dir.'/css/rtl-css/style-rtl.css'); ?>" rel="stylesheet">
    <!-- Custom styles Style End-->

    <!-- Responsive Style For-->
    <link href="<?php echo ci_site_url($_backstage_dir.'/css/rtl-css/responsive-rtl.css'); ?>" rel="stylesheet">
    <!-- Responsive Style For-->
    <link rel="stylesheet" href="<?php echo ci_site_url($_backstage_dir.'/css/rtl-css/plugins/validationEngine.jquery-rtl.css'); ?>">
	<link rel="stylesheet" href="<?php echo ci_site_url($_backstage_dir.'/css/rtl-css/rtl.css'); ?>">
    <!-- Custom styles for this template -->
	<?php endif;?>    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>