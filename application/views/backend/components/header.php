<?php
$html_lang = ($direction == "ltr")?"en":"ar";
?>
<!DOCTYPE html>
<html lang="<?php echo $html_lang;?>" dir="<?php echo $direction;?>" xmlns="http://www.w3.org/1999/html">
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

    <!-- TODO: Add a favicon -->
    <link rel="shortcut icon" href="<?php echo ci_site_url('assets/images/favicon.png'); ?>">

    <title><?php echo _lang($meta_title)." - ".$Module_title; ?></title>
    <!--Page loading plugin Start -->
    <link rel="stylesheet" href="<?php echo ci_site_url($_backstage_dir.'/css/rtl-css/plugins/pace-rtl.css'); ?>">
    <script src="<?php echo ci_site_url($_backstage_dir.'/js/pace.min.js'); ?>"></script>
    <!--Page loading plugin End   -->

    <?php
	/*==================================*/
	/*            Load En Styles        */
	/*==================================*/
	?>	
     <link rel="stylesheet" href="<?php echo ci_site_url($_backstage_dir.'/css/plugins/pace.css'); ?>">
    <script src="<?php echo ci_site_url($_backstage_dir.'/js/pace.min.js'); ?>"></script>
    <!--Page loading plugin End   -->
    <!-- Plugin Css Put Here -->
    <link href="<?php echo ci_site_url($_backstage_dir.'/css/bootstrap.css'); ?>" rel="stylesheet">
    <?php if($_controller == "dashboard"){ ?>
		<link rel="stylesheet" href="<?php echo ci_site_url($_backstage_dir.'/css/plugins/c3js/c3.css'); ?>">
	<?php } ?>
    <link rel="stylesheet" href="<?php echo ci_site_url($_backstage_dir.'/css/plugins/bootstrap-progressbar-3.1.1.css'); ?>">
	<?php  if($_controller == "request" || $_controller == "dashboard"){ ?>
        <link rel="stylesheet" href="<?php echo ci_site_url($_backstage_dir.'/css/plugins/rangeSlider/ion.rangeSlider.css'); ?>">
        <link rel="stylesheet" href="<?php echo ci_site_url($_backstage_dir.'/css/plugins/rangeSlider/ion.rangeSlider.skinFlat.css'); ?>">
    <?php } ?>
    <link rel="stylesheet" href="<?php echo ci_site_url($_backstage_dir.'/css/plugins/fileinput.css'); ?>">
    <link rel="stylesheet" href="<?php echo ci_site_url($_backstage_dir.'/css/plugins/icheck/skins/all.css'); ?>">
    <?php if($_controller == 'pages' && $_method != "index"){ ?>
    <?php /*?><link rel="stylesheet" href="<?php echo ci_site_url($_backstage_dir.'/css/plugins/summernote.css'); ?>"><?php */?>
    <link rel="stylesheet" href="<?php echo ci_site_url($_backstage_dir.'/css/bootstrap3-wysihtml5.min.css'); ?>">
    <?php } ?>
    <!--AmaranJS Css End -->
    <link href="<?php echo ci_site_url($_backstage_dir.'/css/plugins/easyTree.css'); ?>" rel="stylesheet" />
    <!-- Custom styles Style -->
    <link href="<?php echo ci_site_url($_backstage_dir.'/css/style.css'); ?>" rel="stylesheet">
    <!-- Custom styles Style End-->
    <?php if($_controller == "request" || $_controller == "report"){?>
	<link rel="stylesheet" media="print" href="<?php echo ci_site_url($_backstage_dir.'/css/print.css'); ?>" type="text/css" />
    <?php } ?>
    <!-- Responsive Style For-->
    <link href="<?php echo ci_site_url($_backstage_dir.'/css/responsive.css'); ?>" rel="stylesheet">
    <!-- Responsive Style For-->
    <link rel="stylesheet" href="<?php echo ci_site_url($_backstage_dir.'/css/plugins/validationEngine.jquery.css'); ?>">
    <link rel="stylesheet" href="<?php echo ci_site_url($_backstage_dir.'/css/plugins/accordion.css'); ?>" />
    <?php if($_controller == "order"){ ?>
    <link rel="stylesheet" href="<?php echo ci_site_url($_backstage_dir.'/css/plugins/jquery.datetimepicker.css'); ?>" />
    <?php } ?>
    <script>
 	   var theRemoveLabel = "Remove";
    </script>
    
    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="<?php echo ci_site_url($_backstage_dir.'/css/added-css.css'); ?>">
    <link rel="stylesheet" media="print" href="<?php echo ci_site_url($_backstage_dir.'/css/print.css'); ?>">    
</head>