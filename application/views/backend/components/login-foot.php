<script type="text/javascript">
var site_url = '<?php echo ci_site_url(); ?>';
var login_success_txt = '<?php echo '<i class="fa fa-smile-o"></i> '._lang("Successfully logged in");?>';
var login_fail_txt = '<?php echo '<i class="fa fa-frown-o"></i> '._lang("Login Failed");?>';
</script>
<script src="<?php echo ci_site_url($_backstage_dir.'/js/lib/jquery-2.1.1.min.js'); ?>"></script>
<script src="<?php echo ci_site_url($_backstage_dir.'/js/lib/jquery.easing.js'); ?>"></script>
<script src="<?php echo ci_site_url($_backstage_dir.'/js/bootstrap-switch.min.js'); ?>"></script>
<!--Script for notification start-->
<script src="<?php echo ci_site_url($_backstage_dir.'/js/loader/spin.js'); ?>"></script>
<script src="<?php echo ci_site_url($_backstage_dir.'/js/loader/ladda.js'); ?>"></script>
<script src="<?php echo ci_site_url($_backstage_dir.'/js/humane.min.js'); ?>"></script>
<!--Script for notification end-->

<script src="<?php echo ci_site_url($_backstage_dir.'/js/pages/login.js'); ?>"></script>
 <!--Masked Library Script Start-->
<script src="<?php echo ci_site_url($_backstage_dir.'/js/jquery.maskedinput.min.js'); ?>"></script>
<script src="<?php echo ci_site_url($_backstage_dir.'/js/jquery.autosize.js'); ?>"></script>
<!--Masked Library Script End-->
<!--validationEngine Library Script Start-->
<?php 	
if($direction == "ltr"):
//load the LTR styles?>
<script src="<?php echo ci_site_url($_backstage_dir.'/js/validationEngine/languages/jquery.validationEngine-en.js'); ?>"></script>
<?php else:?>    
<script src="<?php echo ci_site_url($_backstage_dir.'/js/validationEngine/languages/jquery.validationEngine-ar.js'); ?>"></script>
<?php endif;?>
<script src="<?php echo ci_site_url($_backstage_dir.'/js/validationEngine/jquery.validationEngine.js'); ?>"></script>
<!--validationEngine Library Script End-->
<!--bootstrap validation Library Script Start-->
<script src="<?php echo ci_site_url($_backstage_dir.'/js/bootstrapvalidator/bootstrapValidator.js'); ?>"></script>
<!--bootstrap validation Library Script End-->
 <!--Form validation  Script Start-->
<script src="<?php echo ci_site_url($_backstage_dir.'/js/pages/formValidation.js'); ?>"></script>
<!--Form validation  Script End-->
</html>