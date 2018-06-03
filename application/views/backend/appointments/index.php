<style type="text/css">
.order-field > div {
	display:inline-block;
	float:right;
	width: 25px;
	height:20px;
	text-align: center;
	position:relative;
}
.order-field > div > a {
	position:absolute;
}
.order-field > div > a.inactive {
	color:#CCC;
}
.order-field > div > a.order-desc {
	top:-7px;
}
.order-field > div > a.order-asc {
	bottom:-7px;
}
.order-field > div > a:hover {
	text-decoration:none;
}
.panel-body .btn.pull-right{
	margin-left:10px;
}
.not-printable .btn{
	min-width:137px;
}
</style>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><?php echo ($_method != "trash")?_lang("Appointments"):_lang("Trash")?></h3>
      </div>
      <div class="panel-body">
      	<div class="not-printable">
        <?php
			 echo anchor($_backstage_dir.'/appointments/add', ' <i class="fa fa-plus"></i> '." "._lang("Add New"),'class="btn btn-success pull-right mine-add-btn"');
		?>
         <button class="btn btn-warning print_btn pull-right"><i class="fa fa-print"></i> Print</button>
         <?php 
		 $get_url = "";
		 if(!empty($_GET)){
			 $g_counter = 1;
			 foreach($_GET as $key=>$value){
				 $get_url .= ($g_counter == 1)?"?":"&";
				 $get_url .= $key."=".$value; 
				 $g_counter++;
			 }
		 } 
		 $pdf_url = $_backstage_dir.'/export/pdf/'.$get_url;
		 echo anchor($pdf_url, ' <i class="fa fa-file"></i> '." Export to PDF",'class="btn ls-red-btn pull-right"');
		 $export_url = $_backstage_dir.'/export/excel/'.$get_url;
		 echo anchor($export_url, ' <i class="fa fa-file-text"></i> '." Export to Excel",'class="btn ls-green-btn pull-right"');
		?>
         </div>
        <!--Table Wrapper Start-->
        <div class="table-responsive ls-table">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th class="order-field">Appointment Date
                  <?php 
				$_order_desc_data = get_order_by_link("appt_date","desc");
				$_order_asc_data = get_order_by_link("appt_date","asc");
				?>
                  <div><a href="<?php echo $_order_desc_data["url"];?>" class="order-desc <?php echo $_order_desc_data["class"];?>"><i class="fa fa-caret-up"></i></a><a href="<?php echo $_order_asc_data["url"];?>" class="order-asc <?php echo $_order_asc_data["class"];?>"><i class="fa fa-caret-down"></i></a></div></th>
                <th class="order-field">Patient Number
                  <?php 
				$_order_desc_data = get_order_by_link("patient_key","desc");
				$_order_asc_data = get_order_by_link("patient_key","asc");
				?>
                  <div><a href="<?php echo $_order_desc_data["url"];?>" class="order-desc <?php echo $_order_desc_data["class"];?>"><i class="fa fa-caret-up"></i></a><a href="<?php echo $_order_asc_data["url"];?>" class="order-asc <?php echo $_order_asc_data["class"];?>"><i class="fa fa-caret-down"></i></a></div>
                </th>
                <th>Patient Name</th>
                <th class="order-field">Clinic
                  <?php 
				$_order_desc_data = get_order_by_link("clinic_title","desc");
				$_order_asc_data = get_order_by_link("clinic_title","asc");
				?>
                  <div><a href="<?php echo $_order_desc_data["url"];?>" class="order-desc <?php echo $_order_desc_data["class"];?>"><i class="fa fa-caret-up"></i></a><a href="<?php echo $_order_asc_data["url"];?>" class="order-asc <?php echo $_order_asc_data["class"];?>"><i class="fa fa-caret-down"></i></a></div>
                </th>
                <th class="order-field">Estimated Cost
                  <?php 
				$_order_desc_data = get_order_by_link("appt_cost","desc");
				$_order_asc_data = get_order_by_link("appt_cost","asc");
				?>
                  <div><a href="<?php echo $_order_desc_data["url"];?>" class="order-desc <?php echo $_order_desc_data["class"];?>"><i class="fa fa-caret-up"></i></a><a href="<?php echo $_order_asc_data["url"];?>" class="order-asc <?php echo $_order_asc_data["class"];?>"><i class="fa fa-caret-down"></i></a></div>
                </th>
                <th class="order-field">Status
                  <?php 
				$_order_desc_data = get_order_by_link("appt_status","desc");
				$_order_asc_data = get_order_by_link("appt_status","asc");
				?>
                  <div><a href="<?php echo $_order_desc_data["url"];?>" class="order-desc <?php echo $_order_desc_data["class"];?>"><i class="fa fa-caret-up"></i></a><a href="<?php echo $_order_asc_data["url"];?>" class="order-asc <?php echo $_order_asc_data["class"];?>"><i class="fa fa-caret-down"></i></a></div>
                </th>
              </tr>
            </thead>
            <tbody>
              <?php
			if(count($appointments)):
				$counter = intval($_per_page * intval($_page - 1)) + 1;
				foreach($appointments as $appointment): ?>
              <tr class="appt_edit" id="<?php echo $appointment->appt_id;?>">
                <td><?php echo $counter;?></td>
                <td><?php echo date("Y-m-d",strtotime($appointment->appt_date));?></td>
                <td><?php echo $appointment->patient_key;?></td>
                <td><?php echo $appointment->patient_name;?></td>
                <td><?php echo $appointment->clinic_title;?></td>
                <td><?php echo $appointment->appt_cost;?> USD</td>
                <td><?php echo switch_appt_status($appointment->appt_status);?></td>
              </tr>
              <?php $counter++; endforeach; ?>
              <?php else: ?>
              <tr>
                <td colspan="9"><?php _elang("No items added yet...");?></td>
              </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
        <!--Table Wrapper Finish-->
        <div class="text-center">
          <div class="ls-button-group demo-btn ls-table-pagination"> <?php echo $links;?> </div>
        </div>
      </div>
    </div>
  </div>
</div>
