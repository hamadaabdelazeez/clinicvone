<?php 
if(strlen($this->session->flashdata('result'))) :
	$result_type = (strlen($this->session->flashdata('result_type')))?$this->session->flashdata('result_type'):"success";
	$head_msg = (!empty($result_type) && $result_type == "danger")?_lang("Sorry!"):_lang("Well done!");?>
  <div class="alert alert-<?php echo $result_type;?>">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <strong> <?php echo $head_msg;?></strong> <?php echo $this->session->flashdata('result');?>
    </div>
<?php endif ?>