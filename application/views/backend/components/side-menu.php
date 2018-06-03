<!--Left navigation section start-->

<section id="left-navigation">
  
  <!--Left navigation user details start-->
  
  <div class="user-image"> <img src="<?php echo ci_site_url($_backstage_dir.'/images/avatar-doc.png'); ?>" alt="" width="80" />
    <div class="user-online-status"><span class="user-status is-online  "></span> </div>
  </div>
  <ul class="social-icon">
    <li><a href="javascript:void(0)">Clinics V1</a></li>
    <?php /*?><li><a href="javascript:void(0)"><i class="fa fa-facebook"></i></a></li>

    <li><a href="javascript:void(0)"><i class="fa fa-twitter"></i></a></li>

    <li><a href="javascript:void(0)"><i class="fa fa-github"></i></a></li>

    <li><a href="javascript:void(0)"><i class="fa fa-bitbucket"></i></a></li><?php */?>
  </ul>
  
  <!--Left navigation user details end--> 
  
  <!--Phone Navigation Menu icon start-->
  
  <div class="phone-nav-box visible-xs"> <?php echo anchor($_backstage_dir.'/dashboard', '<h1>'.$admin_head_title.'</h1>','title="" class="phone-logo"'); ?>
    <?php //echo anchor('Javascript:void(0)', '<span class="fa fa-bars"></span>','class="phone-nav-control"'); ?>
    <a href="Javascript:void(0)" class="phone-nav-control"><span class="fa fa-bars"></span></a>
    <div class="clearfix"></div>
  </div>
  
  <!--Phone Navigation Menu icon start--> 
  
  <!--Left navigation start-->
  
  <ul class="mainNav">
    
    <!--***********Dashboard Menu Item***********-->
    
    <?php $_active = ($_controller == "clinics")?'class="active"':"";?>
    <li <?php echo $_active;?>> <a href="#"><i class="fa fa-sitemap"></i> <span>Clinics</span></a>
      <ul>
        <?php $_active = ($_controller == "clinics" && $_method != "add")?'class="active"':"";?>
        <li><?php echo anchor($_backstage_dir.'/clinics', "Clinics" ,$_active); ?></li>
        <?php $_active = ($_controller == "clinics" && $_method == "add")?'class="active"':"";?>
        <li><?php echo anchor($_backstage_dir.'/clinics/add', "Add Clinic",$_active); ?></li>
      </ul>
    </li>
    <?php $_active = ($_controller == "appointments")?'class="active"':"";?>
    <li <?php echo $_active;?>> <a href="#"><i class="fa fa-edit"></i> <span>Appointments</span></a>
      <ul>
        <?php $_active = ($_controller == "appointments" && $_method != "add")?'class="active"':"";?>
        <li><?php echo anchor($_backstage_dir.'/appointments', "Appointments" ,$_active); ?></li>
        <?php $_active = ($_controller == "appointments" && $_method == "add")?'class="active"':"";?>
        <li><?php echo anchor($_backstage_dir.'/appointments/add', "Add Appointment",$_active); ?></li>
      </ul>
    </li>
  </ul>
  
  <!--Left navigation end--> 
  
</section>

<!--Left navigation section end-->