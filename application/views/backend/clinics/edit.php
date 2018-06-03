<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><?php echo empty($clinic->clinic_id) ? _lang('Add new Clinic') : _lang('Edit Clinic ') . $clinic->clinic_title;?></h3>
      </div>
      <div class="panel-body"> <?php echo form_open("",array("class"=>"form-horizontal ls_form validate_form","id"=>"clinic_form")); ?>
        <div class="row">
          <div class="form-group">
            <label class="col-xs-3 col-sm-3 col-md-2 control-label">
              <?php _elang("Clinic Title");?>
            </label>
            <div class="col-xs-9 col-sm-7 col-md-6">
			<?php echo form_input('clinic_title', set_value('clinic_title', html_entity_decode($clinic->clinic_title)),'class="form-control validate[required]" id="clinic_title" autofocus'); ?>  </div>
          </div>
        </div>
        <div class="row">
        <div class="col-xs-12 col-sm-10 col-md-8 text-center mine-submit-cont">
        <?php echo form_submit('submit', _lang('Save'), 'class="btn btn-primary"'); ?>
        <a class="btn ls-brown-btn" href="<?php echo ci_site_url($_backstage_dir."/clinics");?>"><?php _elang("Cancel");?></a>
        </div>
        <?php echo form_close();?> </div>
    </div>
  </div>
</div>
</div>
