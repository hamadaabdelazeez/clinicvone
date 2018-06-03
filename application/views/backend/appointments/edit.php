<style type="text/css">
.appt-status > label{
	vertical-align:middle;
	margin-right: 20px;
}
.appt-status > label > input{
	vertical-align:text-bottom;
}
.appt-status{
    line-height: 32px;
}
.mine-submit-cont{
	margin-top: 20px;
}
.mine-submit-cont .btn{
	min-width:70px;
}
@media (min-width: 992px){
	.appointment-date-cont .col-md-2.time-cont {
		width: 13%;
	}
	#appt_date{
		max-width:153px;
	}
	.appt_form .appt-icon{
		position: absolute;
		top: 0px;
		right: 0px;
	}
}
.pat_num_loading{
	position: absolute;
    right: 25px;
    top: 10px;
    color: #909090;
}
.appt_form .appt-icon{
	font-size:22px;
	color: #585858;
	display:inline-block;
	vertical-align:middle;
}
</style>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><?php echo empty($appointment->appt_id) ? _lang("Add new appointment"):_lang("Edit appointment ") . $appointment->appt_id; ?></h3>
      </div>			
      <div class="panel-body"> 
	  <?php echo form_open("",array("class"=>"form-horizontal ls_form validate_form appt_form","id"=>"appt_form")); ?>
      <input type="hidden" id="appt_patient_id" name="appt_patient_id" value="<?php echo $appointment->appt_patient_id;?>"/>
        <div class="row">
          <div class="form-group">
            <label class="col-xs-3 col-sm-3 col-md-2 control-label">
              <?php echo _lang("Patient Number:"); ?>
            </label>
            <div class="col-xs-9 col-sm-7 col-md-5">
			<?php echo form_input('appt_patient_num', set_value('appt_patient_num', $appointment->appt_patient_num),'class="form-control validate[required,minSize[16]]" id="appt_patient_num" autofocus maxlength="16"');?> <i class="fa fa-refresh fa-spin pat_num_loading" style="display:none;"></i>  </div>
          </div>
          <div class="form-group">
            <label class="col-xs-3 col-sm-3 col-md-2 control-label">
              <?php echo _lang("Patient Name:"); ?>
            </label>
            <div class="col-xs-9 col-sm-7 col-md-2">
			<?php echo form_input('patient_name', set_value('patient_name', $appointment->patient_name),'class="form-control validate[required]" id="patient_name"'); ?>
		    </div>
             <label class="col-xs-3 col-sm-3 col-md-1 control-label">
               <?php echo _lang("Mobile:"); ?>
             </label>
             <div class="col-xs-9 col-sm-7 col-md-2">
        <?php echo form_input('patient_mobile', set_value('patient_mobile', $appointment->patient_mobile),'class="form-control validate[required]" id="patient_mobile"'); ?>
	        </div>
            <label class="col-xs-3 col-sm-3 col-md-1 control-label">
              <?php echo _lang("Gender:"); ?>
            </label>
            <div class="col-xs-9 col-sm-7 col-md-2">
            <?php //echo form_input('patient_gender', set_value('patient_gender', ''),'class="form-control validate[required]" id="patient_gender"'); ?>
            <?php 
			echo form_dropdown('patient_gender', array(""=>"Select","male"=>"Male","female"=>"Female"), (!empty($appointment->patient_gender)) ? $appointment->patient_gender: "",'class="form-control validate[required]" id="patient_gender"'); ?>
            </div>
          </div>
		  <div class="form-group">
            <label class="col-md-2 control-label">
              <?php echo _lang("Status:"); ?>
            </label>
            <div class="col-xs-12 col-sm-10 col-md-8 appt-status">
              <label><input type="radio" name="appt_status" id="appt_status_confirmed" class="validate[required]" <?php echo ($appointment->appt_status == "confirmed")?"checked='checked'":"";?> value="confirmed" /> <?php echo _lang("Confirmed");?></label>&nbsp;&nbsp;&nbsp;
              <label><input type="radio" name="appt_status" id="toconfirm" class="validate[required]" <?php echo ($appointment->appt_status == "toconfirm")?"checked='checked'":"";?> value="toconfirm" /> <?php echo _lang("To Confirm");?></label>&nbsp;&nbsp;&nbsp;
              <label><input type="radio" name="appt_status" id="treated" class="validate[required]" <?php echo ($appointment->appt_status == "treated")?"checked='checked'":"";?> value="treated" /> <?php echo _lang("Closed - Patient Treated");?></label>&nbsp;&nbsp;&nbsp;
              <label><input type="radio" name="appt_status" id="skipped" class="validate[required]" <?php echo ($appointment->appt_status == "skipped")?"checked='checked'":"";?> value="skipped" /> <?php echo _lang("Closed - Visit Skipped");?></label>&nbsp;&nbsp;&nbsp;
            	<label><input type="radio" name="appt_status" id="cancelled" class="validate[required]" <?php echo ($appointment->appt_status == "cancelled")?"checked='checked'":"";?> value="cancelled" /> <?php echo _lang("Cancelled");?></label>&nbsp;&nbsp;&nbsp;
            </div>
          </div>
          <div class="form-group">
            <label class="col-xs-3 col-sm-3 col-md-2 control-label">
			<?php echo _lang("Clinic:"); ?>            </label>
            <div class="col-xs-9 col-sm-7 col-md-5">
            <?php
			echo form_dropdown('appt_clinic_id', $clinics_options, (!empty($appointment->appt_clinic_id)) ? $appointment->appt_clinic_id: "",'class="form-control validate[required]" id="appt_clinic_id"'); ?>  </div>
          </div>
          <div class="form-group appointment-date-cont">
            <label class="col-xs-3 col-sm-3 col-md-2 control-label">
              <?php echo _lang("Appointments Date:"); ?>
            </label>
            <div class="col-xs-9 col-sm-7 col-md-2">
            <input type="date" name="appt_date" value="<?php echo $appointment->appt_date;?>" class="form-control validate[required] datePickerOnly" id="appt_date">
            <label class="appt-icon" for="appt_date"><i class="fa fa-calendar"></i></label>
		    </div>
             <label class="col-xs-3 col-sm-3 col-md-2 control-label">
               <?php echo _lang("Appointment Starts at:"); ?>
             </label>
             <div class="col-xs-9 col-sm-7 col-md-2 time-cont">
        	<input type="time" name="appt_start" value="<?php echo $appointment->appt_start;?>" class="form-control timePickerOnly" id="appt_start">
	        </div>
            <label class="col-xs-3 col-sm-3 col-md-2 control-label">
              <?php echo _lang("Appointment Ends at:"); ?>
            </label>
            <div class="col-xs-9 col-sm-7 col-md-2 time-cont">
            <input type="time" name="appt_end" value="<?php echo $appointment->appt_end;?>" class="form-control timePickerOnly" id="appt_end">
            </div>
          </div>
          <div class="form-group">
            <label class="col-xs-3 col-sm-3 col-md-2 control-label">
              <?php echo _lang("Estimated Cost:"); ?>
            </label>
            <div class="col-xs-9 col-sm-7 col-md-2">
                <div class="input-group">
                    <input type="number"  name="appt_cost" class="form-control validate[required]" min="0" value="<?php echo !empty($appointment->appt_cost)?$appointment->appt_cost :0;?>" >
                    <span class="input-group-addon" id="basic-addon2">USD</span>
                </div>
          </div>
          </div>
          <div class="form-group">
            <label class="col-xs-3 col-sm-3 col-md-2 control-label">
              <?php _elang("Comments:"); ?>
            </label>
            <div class="col-xs-9 col-sm-7 col-md-4">
              <?php
          $textarea_data = array(
              'name'        => 'appt_comments',
              'id'          => 'appt_comments',
              'value'       => set_value('appt_comments',$appointment->appt_comments),
              'rows'        => '5',
              'cols'        => '30',
              'class'       => 'form-control'
          );
          echo form_textarea($textarea_data);
?>
            </div>
          </div>
        </div>
        <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 text-center mine-submit-cont">
        <a class="btn btn-success" href="<?php echo ci_site_url($_backstage_dir."/appointments/add");?>"><?php _elang("New");?></a>
		<?php echo form_submit('submit', _lang('Save'), 'class="btn btn-primary"'); ?>
        <input type="reset" name="reset_appointment" id="reset_appointment" class="btn btn-warning" value="<?php echo _lang("Cancel");?>" />
        <a class="btn ls-brown-btn" href="<?php echo ci_site_url($_backstage_dir."/appointments");?>"><?php _elang("Back");?></a>
        </div>
        <?php echo form_close();?> </div>
    </div>
  </div>
</div>
</div>
