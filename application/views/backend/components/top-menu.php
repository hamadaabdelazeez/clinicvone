<!--Navigation Top Bar Start-->
<nav class="navigation">
<div class="container-fluid">
<!--Logo text start-->
<div class="header-logo">
<?php echo anchor($_backstage_dir.'', '<h1>'._lang("Dashboard").'</h1>'); ?>
</div>
<!--Logo text End-->
<div class="top-navigation">
<!--Collapse navigation menu icon start -->
    <div class="menu-control hidden-xs">
        <a href="javascript:void(0)">
            <i class="fa fa-bars"></i>
        </a>
    </div>
<!--Collapse navigation menu icon end -->
<style>
.top-navigation .dropdown-menu{min-width:135px;}
.ls-feed img{top:-3px !important;position: relative;}
</style>
<!--Top Navigation Start-->
<ul>
    <?php /*?><li>
    <?php echo anchor("", '<i class="fa fa-desktop"></i>','title="'._lang("Go to Frontend").'"'); ?>                
    </li><?php */?>
    <li>
    <a href="<?php echo ci_site_url($_backstage_dir."/clinics");?>" title="<?php _elang("Clinics");?>" ><i class="fa fa-building"></i></a>       
    </li>
    <li>
    <?php echo anchor($_backstage_dir.'/appointments', '<i class="fa fa-edit"></i>','title="'._lang("New Appointments").'"'); ?>        
    </li>
</ul>

<!--Top Navigation End-->
</div>
</div>
</nav>
<!--Navigation Top Bar End-->