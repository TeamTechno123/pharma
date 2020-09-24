<?php
  $resto_user_id = $this->session->userdata('resto_user_id');
  $resto_company_id = $this->session->userdata('resto_company_id');
  $resto_role_id = $this->session->userdata('resto_role_id');
  $company_info = $this->Master_Model->get_info_arr_fields('company_name, company_shortname, company_logo','company_id', $resto_company_id, 'company');
  $user_info = $this->Master_Model->get_info_arr_fields('user_name,user_image','user_id', $resto_user_id, 'rest_user');
?>
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </li>
  </ul>
  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
          <i class="far fa-user"></i>
          <?php echo $user_info[0]['user_name']; ?>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <div class="row">
              <div class="col-6 text-center">
                <a href="<?php echo base_url(); ?>User/user_profile" class="dropdown-item py-4">
                  <i class="far fa-user f-22"></i><br>Profile
                </a>
              </div>
              <div class="col-6 text-center">
                <a href="<?php echo base_url(); ?>User/dashboard" class="dropdown-item py-4">
                  <i class="fas fa-th f-22"></i><br>Dashboard
                </a>
              </div>
            </div>
          <div class="dropdown-divider"></div>
          <a href="<?php echo base_url(); ?>User/logout" class="dropdown-item dropdown-footer"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
      </li>
    <!-- <li class="nav-item">
      <a class="nav-link" href="<?php echo base_url(); ?>User/logout">
        <i class="fas fa-sign-out-alt"></i>
      </a>
    </li> -->
    <li class="nav-item">
      <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
        <i class="fas fa-th-large"></i>
      </a>
    </li>
  </ul>
</nav>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="<?php echo base_url(); ?>User" class="brand-link">
    <?php if($company_info[0]['company_logo']){ ?>
      <img src="<?php echo base_url() ?>assets/images/master/<?php echo $company_info[0]['company_logo']; ?>" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">
    <?php } ?>
    <span class="brand-text font-weight-light"><?php echo $company_info[0]['company_shortname']; ?></span>
  </a>
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <?php if($user_info[0]['user_image']){ ?>
          <img src="<?php echo base_url() ?>assets/images/master/<?php echo $user_info[0]['user_image'];  ?>" class="img-circle elevation-2" alt="User Image">
        <?php } ?>
      </div>
      <div class="info">
        <a href="<?php echo base_url(); ?>User/user_profile" class="d-block"><?php echo $user_info[0]['user_name']; ?></a>
      </div>
    </div>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="<?php echo base_url(); ?>User/dashboard" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link head">
            <i class="nav-icon fas fa-chart-pie"></i>
            <p>
              Company
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" style="display: none;">
            <li class="nav-item">
              <a <?php if(isset($update_company)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>User/company_list" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Company Information</p>
              </a>
            </li>
            <li class="nav-item">
              <a <?php if(isset($update_branch)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>User/branch" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Branch</p>
              </a>
            </li>
            <li class="nav-item">
              <a <?php if(isset($update_user)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>User/user_information" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>User</p>
              </a>
            </li>
            <li class="nav-item">
              <a <?php if(isset($update_role)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>User/role" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Role</p>
              </a>
            </li>
          </ul>
        </li>

        



        <li class="nav-item has-treeview">
          <a href="#" class="nav-link head">
            <i class="nav-icon fas fa-cog"></i>
            <p>
              Master
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" style="display: none;">
            <li class="nav-item">
              <a <?php if(isset($update_tax_rate)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Master/brand" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Brand information</p>
              </a>
            </li>
            <li class="nav-item">
              <a <?php if(isset($update_shipping_method)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Master/category" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Category Information</p>
              </a>
            </li>
            <li class="nav-item">
              <a <?php if(isset($update_unit)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Master/health" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Health Information</p>
              </a>
            </li>

            <li class="nav-item">
              <a <?php if(isset($update_unit)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Master/medicine" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Medicine Information</p>
              </a>
            </li>

            <li class="nav-item">
              <a <?php if(isset($update_order_status)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Master/role" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Role Information</p>
              </a>
            </li>

             <li class="nav-item">
              <a <?php if(isset($update_order_status)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Master/unit" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Unit Information</p>
              </a>
            </li>

            <li class="nav-item">
              <a <?php if(isset($update_order_status)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Master/salt" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Salt Information</p>
              </a>
            </li>
            <li class="nav-item">
              <a <?php if(isset($update_order_status)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Master/side_effect" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Side Effect Information</p>
              </a>
            </li>

             <li class="nav-item">
              <a <?php if(isset($update_order_status)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Master/slider" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Slider Information</p>
              </a>
            </li>

            <li class="nav-item">
              <a <?php if(isset($update_order_status)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Master/test" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Test Information</p>
              </a>
            </li>

             <li class="nav-item">
              <a <?php if(isset($update_order_status)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Master/test_group" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Test Group Information</p>
              </a>
            </li>

            

          </ul>
        </li>

        <!-- <li class="nav-item has-treeview">
          <a href="#" class="nav-link head">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Customer
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" style="display: none;">
            <li class="nav-item">
              <a <?php if(isset($update_customer)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Master/customer" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Customer</p>
              </a>
            </li>
          </ul>
        </li> -->



        <li class="nav-item">
          <a <?php if(isset($update_announcement)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Master/announcement" <?php } ?> class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Announcement</p>
          </a>
        </li>

      </nav>
    <!-- /.sidebar-menu -->
    </div>
  <!-- /.sidebar -->
  </aside>
