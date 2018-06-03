<link href="<?php echo ci_site_url($_backstage_dir.'/css/plugins/humane_themes/bigbox.css'); ?>" rel="stylesheet">
<div class="row">
  <div class="col-md-3"></div>
  <div class="col-md-6">
    <?php /*?><div class="humane-bigbox humane-bigbox-error" style="opacity: 0.8;"> <span class="fa fa-lock"></span></div><?php */?>
    <div class="alert alert-danger text-center error4-cont">
      <?php /*?><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php */?>
      <div class="error4-icon"><i class="fa fa-meh-o"></i></div>
      <strong>
      <?php _elang("Error , ")?>
      </strong>
      <?php _elang("You do not have right permissions for this action");?>
    </div>
  </div>
  <div class="col-md-3"></div>
</div>
