<style type="text/css">
.appt_form .appt-label{
	display:inline-block;
	width:100px;
}
@media (min-width: 768px){
	.appt_form #appt_to_label{
		width:40px;
	}
}
.appt_form input[type=text],
.appt_form input[type=date],
.appt_form select{
	display:inline-block;
	width:200px;
}
.appt_form #appt_from,
.appt_form #appt_to{
	width:140px;
}
.appt_form .appt-icon{
	font-size:26px;
	color: #585858;
    vertical-align: middle;
}
.appt_form .btn{
	min-width:100px;
}
.appt_edit{
	cursor:pointer;
}
</style>
<div class="row not-printable">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Search Appointments</h3>
      </div>
      <div class="panel-body"> <?php echo form_open("",array("class"=>"form-horizontal ls_form validate_form appt_form","role"=>"form","id"=>"filter_form","method"=>"get")); ?>
      <input type="hidden" name="real_filter" value="true" />
      <?php if(!empty($_GET["order_by"])){?>
      <input type="hidden" name="order_by" id="order_by" value="<?php echo $_GET["order_by"];?>" />
      <?php }?>
      <?php if(!empty($_GET["order_type"])){?>
      <input type="hidden" name="order_type" id="order_type" value="<?php echo $_GET["order_type"];?>" />
      <?php }?>
          <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
            <div class="form-group">
              <label class="appt-label" for="appt_from">From</label>
              <input type="date" name="appt_from" value="<?php echo ci_get_str_parameter('appt_from');?>" class="form-control datePickerOnly" id="appt_from">
              <label class="appt-icon" for="appt_from"><i class="fa fa-calendar"></i></label>
            </div>
          </div>
          <div class="hidden-xs col-sm-2 col-md-1 col-lg-1">&nbsp;</div>
          <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
          	<div class="form-group">
              <label class="appt-label" for="appt_to" id="appt_to_label">To</label>
              <input type="date" name="appt_to" value="<?php echo ci_get_str_parameter('appt_to');?>" class="form-control datePickerOnly" id="appt_to">
              <label class="appt-icon" for="appt_to"><i class="fa fa-calendar"></i></label>
            </div>
          </div>
        <div class="clearfix"></div>        
          <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
            <div class="form-group">
              <label class="appt-label" for="s">Patient Number:</label>
              <?php echo form_input('s', ci_get_str_parameter('s'),'class="form-control validate[minSize[3]]" id="s" placeholder=""'); ?> </div>
          </div>
        <div class="clearfix"></div>
          <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">    
            <div class="form-group">
              <label class="appt-label" for="clinic_id">Clinic</label>
              <?php 
                    $clinics_options = array(""=>"Select a value") + $clinics_options;
                    echo form_dropdown('clinic_id', $clinics_options, (ci_get_str_parameter('clinic_id') != "") ? ci_get_str_parameter('clinic_id') : "",'class="form-control" id="clinic_id"'); ?>
            </div>
          </div>
        <div class="row">  
          <div class="col-xs-12 col-sm-10 col-md-8 col-lg-8 text-center filter-submit-cont"> 
		  	<?php echo form_submit('submit', _lang('Search'), 'class="btn btn-info"'); ?> 
            <a class="btn ls-brown-btn" href="<?php echo ci_site_url($_backstage_dir."/".$_controller);?>">Cancel</a> 
          </div>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
