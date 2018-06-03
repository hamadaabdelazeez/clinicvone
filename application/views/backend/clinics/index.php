<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><?php echo ($_method != "trash")?_lang("clinics"):_lang("Trash")?></h3>
      </div>
      <div class="panel-body">
        <?php
			 echo anchor($_backstage_dir.'/clinics/add', ' <i class="fa fa-plus"></i> '." "._lang("Add New"),'class="btn btn-success pull-right mine-add-btn"');

    ?>
        <!--Table Wrapper Start-->
        <div id="clinic_list" class="table-responsive ls-table" >
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th><?php _elang("Clinic title")?></th>
                <th class="order-field"><?php _elang("Register Date")?></th>
              </tr>
            </thead>
            <tbody>
            <?php
			if(count($clinics)):
				$counter = intval($_per_page * intval($_page - 1)) + 1;
				foreach($clinics as $clinic): ?>
              <tr class="clinic_edit" id="<?php echo $clinic->clinic_id;?>">
                <td><?php echo $counter;?></td>
                <td><?php echo $clinic->clinic_title;?></td>
                <td><?php echo date("Y-m-d",strtotime($clinic->clinic_created_at));?></td>
              </tr>
              <?php $counter++; endforeach; ?>
              <?php else: ?>
              <tr>
                <td colspan="3"><?php _elang("No items added yet...");?></td>
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
