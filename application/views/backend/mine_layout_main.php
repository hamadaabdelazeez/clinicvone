<?php 
$body_class = (empty($user_color))?"default":$user_color->meta_value;
?>
<body class="<?php echo $body_class;?>">
<?php //load topbar view; ?>
<?php $this->load->view($_backstage_dir.'/components/top-menu'); ?>
<section id="main-container">
<?php //load Side menu; ?>
<?php $this->load->view($_backstage_dir.'/components/side-menu'); ?>
<!--Page main section start-->
<section id="min-wrapper">
<div id="main-content">
<div class="container-fluid">
<?php if(empty($is_404)){?>
<div class="row">
    <div class="col-md-12">
        <!--Top header start-->
        <h3 class="ls-top-header"><?php echo $Module_title;?></h3>
        <!--Top header end -->
        <!--Top breadcrumb start -->
        <ol class="breadcrumb">
            <li><?php echo anchor($_backstage_dir.'/dashboard', '<i class="fa fa-home"></i>'); ?> </li>
            <li class="active"><?php echo (!empty($_method) && $_method != "index")?anchor($_backstage_dir.'/' . $_controller,$Module_title):$Module_title;?></li>
        </ol>
        <!--Top breadcrumb start -->
    </div>
</div>
<?php }?>
<div class="row">
    <div class="col-md-12">
        <?php $this->load->view($_backstage_dir."/components/flashdata");?>
    </div>
</div>
<!-- Main Content Element  Start-->
<?php /*?>=================LOAD FILTER FORM==================<?php */?>
<?php 
//load Module Filter form
if($_method == "index" && $has_access && empty($nofilter)){ 
	if(file_exists(APPPATH.'views/'.$_backstage_dir."/filter/filter_".$_controller.".php"))
		$this->load->view($_backstage_dir."/filter/filter_".$_controller); 
}?>
<?php /*?>===================LOAD SUBVIEW===================<?php */?>
<?php 
//load Module SubView; 
$this->load->view($subview); ?>
<!-- Main Content Element  End-->
</div>
</div>
<section id="footer" class="text-center"><a target="_blank" href="#">© <?php echo date("Y");?>   Clinics V1 </a></section>
</section>
<!--Page main section end -->
<?php //load Right Wrapper; ?>
<?php $this->load->view($_backstage_dir.'/components/side-wrapper'); ?>
<?php //load Change Color options; ?>
</section>
