<!--Layout Script start -->
<script type="text/javascript" src="<?php echo ci_site_url($_backstage_dir.'/js/color.js'); ?>"></script>
<?php if($_controller == 'polls' && in_array($_method,array('add',"edit"))){ ?>
<script type="text/javascript" src="<?php echo ci_site_url($_backstage_dir.'/js/lib/jquery-1.12.4.js'); ?>"></script>
<?php }else{?>
<script type="text/javascript" src="<?php echo ci_site_url($_backstage_dir.'/js/lib/jquery-1.11.min.js'); ?>"></script>
<?php }?>
<script type="text/javascript" src="<?php echo ci_site_url($_backstage_dir.'/js/bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo ci_site_url($_backstage_dir.'/js/multipleAccordion.js'); ?>"></script>
<script>var site_url = '<?php echo base_url(); ?>'; </script>
<script>var ajaxurl = site_url+"qajax/";</script>
<!--easing Library Script Start -->
<script src="<?php echo ci_site_url($_backstage_dir.'/js/lib/jquery.easing.js'); ?>"></script>
<!--easing Library Script End -->
<script src="<?php echo ci_site_url($_backstage_dir.'/js/jquery.cookie.js'); ?>"></script>
<!--Nano Scroll Script Start -->
<script src="<?php echo ci_site_url($_backstage_dir.'/js/jquery.nanoscroller.min.js'); ?>"></script>
<!--Nano Scroll Script End -->
<!--switchery Script Start -->
<script src="<?php echo ci_site_url($_backstage_dir.'/js/switchery.min.js'); ?>"></script>
<!--switchery Script End -->
<!--bootstrap switch Button Script Start-->
<script src="<?php echo ci_site_url($_backstage_dir.'/js/bootstrap-switch.js'); ?>"></script>
<!--bootstrap switch Button Script End-->
<!--bootstrap-progressbar Library script Start-->
<script src="<?php echo ci_site_url($_backstage_dir.'/js/bootstrap-progressbar.min.js'); ?>"></script>
<!--bootstrap-progressbar Library script End-->
<!--FLoat library Script Start -->
<!--FLoat library Script End -->
<script type="text/javascript" src="<?php echo ci_site_url($_backstage_dir.'/js/pages/layout.js'); ?>"></script>
<!-- Script For Icheck -->
<script src="<?php echo ci_site_url($_backstage_dir.'/js/icheck.min.js'); ?>"></script>
<!-- Script For Icheck -->
<!--Advance Radio and checkbox demo start-->
<script src="<?php echo ci_site_url($_backstage_dir.'/js/pages/checkboxRadio.js'); ?>"></script>
<!--Advance Radio and checkbox demo start-->
<!--Layout Script End -->
<?php if($_controller == "dashboard"):?>
<script src="<?php echo ci_site_url($_backstage_dir.'/js/pages/dashboard.js'); ?>"></script>
<?php endif;?>
<?php if($_controller == "media"):?>
<!--Gallery Plugin Start-->
<!-- Shuffle! -->
<script type="text/javascript" src="<?php echo ci_site_url($_backstage_dir.'/js/gallery/shuffle.js'); ?>"></script>
<!-- Syntax highlighting via Prism -->
<script type="text/javascript" src="<?php echo ci_site_url($_backstage_dir.'/js/gallery/prism.js'); ?>"></script>
<script type="text/javascript" src="<?php echo ci_site_url($_backstage_dir.'/js/gallery/page.js'); ?>"></script>
<script type="text/javascript" src="<?php echo ci_site_url($_backstage_dir.'/js/gallery/evenheights.js'); ?>"></script>
<!--Gallery Plugin Finish-->
<script type="text/javascript" src="<?php echo ci_site_url($_backstage_dir.'/js/lightGallery.js'); ?>"></script>
<!-- Gallery Js Call Start -->
<script type="text/javascript" src="<?php echo ci_site_url($_backstage_dir.'/js/pages/demo.gallery.js'); ?>"></script>
<!-- Gallery Js Finish -->
<?php
// for jquery uploader ....
if(!empty($_method) && $_method == "add"):?>
<!--Iimage Cropper Plugin Start-->
<!--New Drop Zone Scripts-->
<script src="<?php echo ci_site_url($_backstage_dir.'/js/dropzone.js'); ?>"></script>
<!--End Drop Zone Scripts-->
<?php endif;?>
<?php endif;?>
<?php /*=======================FORMS SCRIPTS=====================*/?>
<!--Upload button Script Start-->
<script src="<?php echo ci_site_url($_backstage_dir.'/js/fileinput.min.js'); ?>"></script>
<!--Upload button Script End-->
<!--Auto resize  text area Script Start-->
<script src="<?php echo ci_site_url($_backstage_dir.'/js/jquery.autosize.js'); ?>"></script>
<!--Auto resize  text area Script Start-->
 <!--Masked Library Script Start-->
<script src="<?php echo ci_site_url($_backstage_dir.'/js/jquery.maskedinput.min.js'); ?>"></script>
<script src="<?php echo ci_site_url($_backstage_dir.'/js/jquery.autosize.js'); ?>"></script>
<!--Masked Library Script End-->
<script>
var Insert_Image = "<?php _elang("Insert Image"); ?>";
var Select_from_files = "<?php _elang("Select from files"); ?>";
var Image_URL = "<?php _elang("Image URL"); ?>";
</script>
<script src="<?php echo ci_site_url($_backstage_dir.'/js/pages/sampleForm.js'); ?>"></script>
<?php if($_method != "index"){ ?>
<!-- summernote Editor Script For Layout start-->
<script src="<?php echo ci_site_url($_backstage_dir.'/js/summernote.min.js'); ?>"></script>
<!-- summernote Editor Script For Layout End-->
<!-- Demo Ck Editor Script For Layout Start-->
<script src="<?php echo ci_site_url($_backstage_dir.'/js/pages/editor.js'); ?>"></script>
<!-- Demo Ck Editor Script For Layout ENd-->
<?php } ?>
<?php
if(($_controller == 'contact' && $_method=='preview')){ ?>
<script src="<?php echo ci_site_url($_backstage_dir.'/js/pages/composMail.js'); ?>"></script>
<?php }
if(($_controller == 'contact' && $_method=='preview')){ ?>
<script type="text/javascript" src="<?php echo ci_site_url($_backstage_dir.'/js/pages/mail.js'); ?>"></script>
<?php } ?>
<?php
// die($_controller);
if($_controller == 'clinics' && in_array($_method,array('add',"edit","index")) || $_controller == 'appointments' && in_array($_method,array('add',"edit","index"))){ ?>
<script type="text/javascript" src="<?php echo ci_site_url($_backstage_dir.'/js/mine.js'); ?>"></script>
<?php } ?>
<!--validationEngine Library Script Start-->
    <script src="<?php echo ci_site_url($_backstage_dir.'/js/validationEngine/languages/jquery.validationEngine-en.js'); ?>"></script>
<script src="<?php echo ci_site_url($_backstage_dir.'/js/validationEngine/jquery.validationEngine.js'); ?>"></script>
<!--validationEngine Library Script End-->
<!--bootstrap validation Library Script Start-->
<script src="<?php echo ci_site_url($_backstage_dir.'/js/bootstrapvalidator/bootstrapValidator.js'); ?>"></script>
<!--bootstrap validation Library Script End-->
 <!--Form validation  Script Start-->
<script src="<?php echo ci_site_url($_backstage_dir.'/js/pages/formValidation.js'); ?>"></script>
<!--Form validation  Script End-->
<script src="<?php echo ci_site_url($_backstage_dir.'/js/jquery-ui.min.js'); ?>"></script>
<link rel="stylesheet" href="<?php echo ci_site_url($_backstage_dir.'/css/plugins/jquery.datetimepicker.css'); ?>">
<!-- Date & Time Picker Library Script Start -->
<script src="<?php echo ci_site_url($_backstage_dir.'/js/jquery.datetimepicker.js'); ?>"></script>
<!-- Date & Time Picker Library Script End -->
<!--Demo for Date, Time Color Picker Script Start -->
<script src="<?php echo ci_site_url($_backstage_dir.'/js/pages/pickerTool.js'); ?>"></script>
<!--Demo for Date, Time Color Picker Script End -->
<script src="<?php echo ci_site_url($_backstage_dir.'/js/jquery.toolbar.min.js'); ?>"></script>
<script src="<?php echo ci_site_url($_backstage_dir.'/js/pages/uiElements.js'); ?>"></script>
<?php if($_controller == "messages" || $_controller == "adsense" || $_controller == "services"):?>
<script src="<?php echo ci_site_url($_backstage_dir.'/js/added-js.js'); ?>"></script>
<?php endif;?>
<script>
var site_url="<?php echo ci_site_url(); ?>";
</script>
</body>
</html>
