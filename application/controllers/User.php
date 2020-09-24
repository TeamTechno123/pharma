<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller{
  public function __construct(){
    parent::__construct();
    date_default_timezone_set('Asia/Kolkata');
  }

  public function logout(){
    // $this->session->sess_destroy();
    $this->session->unset_userdata('resto_user_id');
    $this->session->unset_userdata('resto_company_id');
    $this->session->unset_userdata('resto_role_id');
    header('location:'.base_url().'User');
  }

/**************************      Login      ********************************/
  public function index(){
    $resto_user_id = $this->session->userdata('resto_user_id');
    $resto_company_id = $this->session->userdata('resto_company_id');
    $resto_role_id = $this->session->userdata('resto_role_id');
    if($resto_user_id == '' || $resto_company_id == ''){
      $this->form_validation->set_rules('mobile', 'Mobile No', 'trim|required');
      $this->form_validation->set_rules('password', 'Password', 'trim|required');
      if ($this->form_validation->run() == FALSE) {
      	$this->load->view('Admin/User/login');
      } else{
        $mobile = $this->input->post('mobile');
        $password = $this->input->post('password');

        $login = $this->User_Model->check_login($mobile, $password);
        // print_r($login);
        if($login == null){
          $this->session->set_flashdata('msg','login_error');
          header('location:'.base_url().'User');
        } else{
          // echo 'null not';
          $this->session->set_userdata('resto_user_id', $login[0]['user_id']);
          $this->session->set_userdata('resto_company_id', $login[0]['company_id']);
          $this->session->set_userdata('resto_role_id', $login[0]['role_id']);
          // $this->session->set_userdata('branch_id', $login[0]['branch_id']);
          header('location:'.base_url().'User/dashboard');
        }
      }
    }
    else{
      header('location:'.base_url().'User/dashboard');
    }
  }

/**************************      Dashboard      ********************************/
  public function dashboard(){
    $resto_user_id = $this->session->userdata('resto_user_id');
    $resto_company_id = $this->session->userdata('resto_company_id');
    $resto_role_id = $this->session->userdata('resto_role_id');
    if($resto_user_id == '' || $resto_company_id == ''){ header('location:'.base_url().'User'); }

    // $data['regular_bed_cnt'] = $this->Master_Model->get_sum('','avlb_regular_bed','hospital_status','1','','','','','hospital');
    // $data['oxygen_bed_cnt'] = $this->Master_Model->get_sum('','avlb_oxygen_bed','hospital_status','1','','','','','hospital');
    // $data['icu_bed_cnt'] = $this->Master_Model->get_sum('','avlb_icu_bed','hospital_status','1','','','','','hospital');
    // $data['special_bed_cnt'] = $this->Master_Model->get_sum('','avlb_special_bed','hospital_status','1','','','','','hospital');
    //
    // $data['hospital_cnt'] = $this->Master_Model->get_count('hospital_id','','hospital_type','1','','','','','hospital');
    // $data['gov_qua_cnt'] = $this->Master_Model->get_count('hospital_id','','hospital_type','2','','','','','hospital');
    // $data['private_qua_cnt'] = $this->Master_Model->get_count('hospital_id','','hospital_type','3','','','','','hospital');
    // $data['hotel_qua_cnt'] = $this->Master_Model->get_count('hospital_id','','hospital_type','4','','','','','hospital');

    $data['page'] = 'Admin Dashboard';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/User/dashboard', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

/**************************      Company Information      ********************************/

  // Company List...
  public function company_list(){
    $resto_user_id = $this->session->userdata('resto_user_id');
    $resto_company_id = $this->session->userdata('resto_company_id');
    $resto_role_id = $this->session->userdata('resto_role_id');
    if($resto_user_id == '' && $resto_company_id == ''){ header('location:'.base_url().'User'); }

    $data['company_list'] = $this->Master_Model->get_list($resto_company_id,'company_id','ASC','company');
    $data['page'] = 'Company';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/User/company_list', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit Company...
  public function edit_company($company_id){
    $resto_user_id = $this->session->userdata('resto_user_id');
    $resto_company_id = $this->session->userdata('resto_company_id');
    $resto_role_id = $this->session->userdata('resto_role_id');
    if($resto_user_id == '' && $resto_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('company_name', 'company_name', 'trim|required');
    $this->form_validation->set_rules('company_address', 'company_address', 'trim|required');

    if ($this->form_validation->run() != FALSE) {
      $up_data = $_POST;
      unset($up_data['old_company_logo']);
      unset($up_data['old_company_fevicon']);
      $this->Master_Model->update_info('company_id', $company_id, 'company', $up_data);

      if($_FILES['company_logo']['name']){
        $time = time();
        $image_name = 'company_logo_'.$company_id.'_'.$time;
        $config['upload_path'] = 'assets/images/master/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['company_logo']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('company_logo') && $company_id && $image_name && $ext && $filename){
          $company_logo_up['company_logo'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('company_id', $company_id, 'company', $company_logo_up);
          if($_POST['old_company_logo']){ unlink("assets/images/master/".$_POST['old_company_logo']); }
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }

      if($_FILES['company_fevicon']['name']){
        $time = time();
        $image_name = 'company_fevicon_'.$company_id.'_'.$time;
        $config['upload_path'] = 'assets/images/master/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['company_fevicon']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('company_fevicon') && $company_id && $image_name && $ext && $filename){
          $company_fevicon_up['company_fevicon'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('company_id', $company_id, 'company', $company_fevicon_up);
          if($_POST['old_company_fevicon']){ unlink("assets/images/master/".$_POST['old_company_fevicon']); }
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'User/company_list');
    }
    $company_info = $this->Master_Model->get_info('company_id', $company_id, 'company');
    $data['country_list'] = $this->Master_Model->get_list('','country_name','ASC','country');
    $data['state_list'] = $this->Master_Model->get_list('','state_name','ASC','state');
    $data['district_list'] = $this->Master_Model->get_list('','district_name','ASC','district');
    $data['city_list'] = $this->Master_Model->get_list('','city_name','ASC','city');

    $company_info = $this->Master_Model->get_info_arr('company_id',$company_id,'company');
    if(!$company_info){ header('location:'.base_url().'User/company_list'); }
    $data['update'] = 'update';
    $data['update_company'] = 'update';
    $data['company_info'] = $company_info[0];
    $data['act_link'] = base_url().'User/edit_company/'.$company_id;

    $data['page'] = 'Update Company';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/User/company_information', $data);
    $this->load->view('Admin/Include/footer', $data);
  }


/*******************************    Branch Information      ****************************/

  // Add Branch...
  public function branch(){
    $resto_user_id = $this->session->userdata('resto_user_id');
    $resto_company_id = $this->session->userdata('resto_company_id');
    $resto_role_id = $this->session->userdata('resto_role_id');
    if($resto_user_id == '' || $resto_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('branch_name', 'First Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $branch_status = $this->input->post('branch_status');
      if(!isset($branch_status)){ $branch_status = '1'; }
      $save_data = $_POST;
      $save_data['branch_status'] = $branch_status;
      $save_data['company_id'] = $resto_company_id;
      $save_data['branch_addedby'] = $resto_user_id;
      $user_id = $this->Master_Model->save_data('rest_branch', $save_data);

      if($_FILES['branch_image']['name']){
        $time = time();
        $image_name = 'branch_'.$branch_id.'_'.$time;
        $config['upload_path'] = 'assets/images/master/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['branch_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('branch_image') && $branch_id && $image_name && $ext && $filename){
          $branch_image_up['branch_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('branch_id', $branch_id, 'rest_branch', $branch_image_up);
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'User/branch');
    }
    $data['country_list'] = $this->Master_Model->get_list('','country_name','ASC','country');
    $data['state_list'] = $this->Master_Model->get_list('','state_name','ASC','state');
    $data['district_list'] = $this->Master_Model->get_list('','district_name','ASC','district');
    $data['city_list'] = $this->Master_Model->get_list('','city_name','ASC','city');

    $data['branch_list'] = $this->Master_Model->get_list_by_id3($resto_company_id,'','','','','','','branch_id','ASC','rest_branch');
    $data['page'] = 'Branch';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/User/branch', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Branch...
  public function edit_branch($branch_id){
    $resto_user_id = $this->session->userdata('resto_user_id');
    $resto_company_id = $this->session->userdata('resto_company_id');
    $resto_role_id = $this->session->userdata('resto_role_id');
    if($resto_user_id == '' || $resto_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('branch_name', 'Branch Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $branch_status = $this->input->post('branch_status');
      if(!isset($branch_status)){ $branch_status = '1'; }
      $update_data = $_POST;
      unset($update_data['old_branch_image']);
      $update_data['branch_status'] = $branch_status;
      $update_data['branch_addedby'] = $resto_user_id;
      $this->Master_Model->update_info('branch_id', $branch_id, 'rest_branch', $update_data);

      if($_FILES['branch_image']['name']){
        $time = time();
        $image_name = 'branch_'.$branch_id.'_'.$time;
        $config['upload_path'] = 'assets/images/master/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['branch_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('branch_image') && $branch_id && $image_name && $ext && $filename){
          $branch_image_up['branch_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('branch_id', $branch_id, 'rest_branch', $branch_image_up);
          if($_POST['old_branch_img']){ unlink("assets/images/master/".$_POST['old_branch_img']); }
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'User/branch');
    }

    $branch_info = $this->Master_Model->get_info_arr('branch_id',$branch_id,'rest_branch');
    if(!$branch_info){ header('location:'.base_url().'User/branch'); }
    $data['update'] = 'update';
    $data['update_branch'] = 'update';
    $data['branch_info'] = $branch_info[0];
    $data['act_link'] = base_url().'User/edit_branch/'.$branch_id;
    $country_id = $branch_info[0]['country_id'];
    $state_id = $branch_info[0]['state_id'];

    $data['country_list'] = $this->Master_Model->get_list_by_id3('','','','','','','','country_name','ASC','country');
    $data['state_list'] = $this->Master_Model->get_list_by_id3('','country_id',$country_id,'','','','','state_name','ASC','state');
    $data['district_list'] = $this->Master_Model->get_list_by_id3('','state_id',$state_id,'','','','','district_name','ASC','district');
    $data['city_list'] = $this->Master_Model->get_list_by_id3('','state_id',$state_id,'','','','','city_name','ASC','city');

    $data['branch_list'] = $this->Master_Model->get_list_by_id3($resto_company_id,'','','','','','','branch_id','ASC','rest_branch');
    $data['page'] = 'Edit Branch';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/User/branch', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete Branch...
  public function delete_branch($branch_id){
    $resto_user_id = $this->session->userdata('resto_user_id');
    $resto_company_id = $this->session->userdata('resto_company_id');
    $resto_role_id = $this->session->userdata('resto_role_id');
    if($resto_user_id == '' || $resto_company_id == ''){ header('location:'.base_url().'User'); }
    // $branch_info = $this->Master_Model->get_info_arr_fields('branch_image, branch_id', 'branch_id', $branch_id, 'rest_branch');
    // if($branch_info){
    //   $branch_image = $branch_info[0]['branch_image'];
    //   if($branch_image){ unlink("assets/images/master/".$branch_image); }
    // }
    $this->Master_Model->delete_info('branch_id', $branch_id, 'rest_branch');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'User/branch');
  }


/*******************************    User Information      ****************************/

  // Add User...
  public function user_information(){
    $resto_user_id = $this->session->userdata('resto_user_id');
    $resto_company_id = $this->session->userdata('resto_company_id');
    $resto_role_id = $this->session->userdata('resto_role_id');
    if($resto_user_id == '' || $resto_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('user_name', 'First Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $user_status = $this->input->post('user_status');
      if(!isset($user_status)){ $user_status = '1'; }
      $save_data = $_POST;
      $save_data['user_status'] = $user_status;
      $save_data['company_id'] = $resto_company_id;
      $save_data['user_addedby'] = $resto_user_id;
      $user_id = $this->Master_Model->save_data('rest_user', $save_data);

      if($_FILES['user_image']['name']){
        $time = time();
        $image_name = 'user_'.$user_id.'_'.$time;
        $config['upload_path'] = 'assets/images/master/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['user_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('user_image') && $user_id && $image_name && $ext && $filename){
          $user_image_up['user_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('user_id', $user_id, 'rest_user', $user_image_up);
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'User/user_information');
    }
    $data['role_list'] = $this->Master_Model->get_list_by_id3($resto_company_id,'','','','','','','role_id','ASC','rest_role');
    $data['country_list'] = $this->Master_Model->get_list('','country_name','ASC','country');
    $data['state_list'] = $this->Master_Model->get_list('','state_name','ASC','state');
    $data['district_list'] = $this->Master_Model->get_list('','district_name','ASC','district');
    $data['city_list'] = $this->Master_Model->get_list('','city_name','ASC','city');

    $data['user_list'] = $this->Master_Model->get_list_by_id3($resto_company_id,'is_admin','0','','','','','user_id','ASC','rest_user');
    $data['page'] = 'User';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/User/user_information', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update User...
  public function edit_user($user_id){
    $resto_user_id = $this->session->userdata('resto_user_id');
    $resto_company_id = $this->session->userdata('resto_company_id');
    $resto_role_id = $this->session->userdata('resto_role_id');
    if($resto_user_id == '' || $resto_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('user_name', 'First Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $user_status = $this->input->post('user_status');
      if(!isset($user_status)){ $user_status = '1'; }
      $update_data = $_POST;
      unset($update_data['old_user_image']);
      $update_data['user_status'] = $user_status;
      $update_data['user_addedby'] = $resto_user_id;
      $this->Master_Model->update_info('user_id', $user_id, 'rest_user', $update_data);

      if($_FILES['user_image']['name']){
        $time = time();
        $image_name = 'user_'.$user_id.'_'.$time;
        $config['upload_path'] = 'assets/images/master/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['user_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('user_image') && $user_id && $image_name && $ext && $filename){
          $user_image_up['user_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('user_id', $user_id, 'rest_user', $user_image_up);
          if($_POST['old_user_img']){ unlink("assets/images/master/".$_POST['old_user_img']); }
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'User/user_information');
    }

    $user_info = $this->Master_Model->get_info_arr('user_id',$user_id,'rest_user');
    if(!$user_info){ header('location:'.base_url().'User/user_information'); }
    $data['update'] = 'update';
    $data['update_user'] = 'update';
    $data['user_info'] = $user_info[0];
    $data['act_link'] = base_url().'User/edit_user/'.$user_id;

    $data['role_list'] = $this->Master_Model->get_list_by_id3($resto_company_id,'','','','','','','role_id','ASC','rest_role');
    $data['country_list'] = $this->Master_Model->get_list_by_id3('','','','','','','','country_name','ASC','country');
    $data['state_list'] = $this->Master_Model->get_list_by_id3('','','','','','','','state_name','ASC','state');
    $data['district_list'] = $this->Master_Model->get_list_by_id3('','','','','','','','district_name','ASC','district');
    $data['city_list'] = $this->Master_Model->get_list_by_id3('','','','','','','','city_name','ASC','city');

    $data['user_list'] = $this->Master_Model->get_list_by_id3($resto_company_id,'is_admin','0','','','','','user_id','ASC','rest_user');
    $data['page'] = 'Edit User';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/User/user_information', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete User...
  public function delete_user($user_id){
    $resto_user_id = $this->session->userdata('resto_user_id');
    $resto_company_id = $this->session->userdata('resto_company_id');
    $resto_role_id = $this->session->userdata('resto_role_id');
    if($resto_user_id == '' || $resto_company_id == ''){ header('location:'.base_url().'User'); }
    $user_info = $this->Master_Model->get_info_arr_fields('user_image, user_id', 'user_id', $user_id, 'rest_user');
    if($user_info){
      $user_image = $user_info[0]['user_image'];
      if($user_image){ unlink("assets/images/master/".$user_image); }
    }
    $this->Master_Model->delete_info('user_id', $user_id, 'rest_user');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'User/user_information');
  }

/******************************* User Profile ************************************/
  // Profile
  public function user_profile(){
    $resto_user_id = $this->session->userdata('resto_user_id');
    $resto_company_id = $this->session->userdata('resto_company_id');
    $resto_role_id = $this->session->userdata('resto_role_id');
    if($resto_user_id == '' || $resto_company_id == ''){ header('location:'.base_url().'User'); }
    $user_id = $resto_user_id;
    $this->form_validation->set_rules('user_name', 'First Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      // $user_status = $this->input->post('user_status');
      // if(!isset($user_status)){ $user_status = '1'; }
      $update_data = $_POST;
      unset($update_data['old_user_image']);
      // $update_data['user_status'] = $user_status;
      $update_data['user_addedby'] = $resto_user_id;
      $this->Master_Model->update_info('user_id', $user_id, 'rest_user', $update_data);

      if($_FILES['user_image']['name']){
        $time = time();
        $image_name = 'user_'.$user_id.'_'.$time;
        $config['upload_path'] = 'assets/images/master/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['user_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('user_image') && $user_id && $image_name && $ext && $filename){
          $user_image_up['user_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('user_id', $user_id, 'rest_user', $user_image_up);
          if($_POST['old_user_img']){ unlink("assets/images/master/".$_POST['old_user_img']); }
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'User/dashboard');
    }

    $user_info = $this->Master_Model->get_info_arr('user_id',$user_id,'rest_user');
    if(!$user_info){ header('location:'.base_url().'User/user_information'); }
    $data['update'] = 'update';
    $data['update_user'] = 'update';
    $data['user_info'] = $user_info[0];
    $data['act_link'] = base_url().'User/user_profile';

    $data['role_list'] = $this->Master_Model->get_list_by_id3($resto_company_id,'','','','','','','role_id','ASC','rest_role');
    $data['country_list'] = $this->Master_Model->get_list_by_id3('','','','','','','','country_name','ASC','country');
    $data['state_list'] = $this->Master_Model->get_list_by_id3('','','','','','','','state_name','ASC','state');
    $data['district_list'] = $this->Master_Model->get_list_by_id3('','','','','','','','district_name','ASC','district');
    $data['city_list'] = $this->Master_Model->get_list_by_id3('','','','','','','','city_name','ASC','city');

    // $data['user_list'] = $this->Master_Model->get_list_by_id3($resto_company_id,'is_admin','0','','','','','user_id','ASC','rest_user');
    $data['page'] = 'Edit Profile';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/User/user_profile', $data);
    $this->load->view('Admin/Include/footer', $data);
  }


/*******************************    Role Information      ****************************/

  // Add Role...
  public function role(){
    $resto_user_id = $this->session->userdata('resto_user_id');
    $resto_company_id = $this->session->userdata('resto_company_id');
    $resto_role_id = $this->session->userdata('resto_role_id');
    if($resto_user_id == '' || $resto_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('role_name', 'Role Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $role_status = $this->input->post('role_status');
      if(!isset($role_status)){ $role_status = '1'; }
      $save_data = $_POST;
      $save_data['role_status'] = $role_status;
      $save_data['company_id'] = $resto_company_id;
      $save_data['role_addedby'] = $resto_user_id;
      $user_id = $this->Master_Model->save_data('rest_role', $save_data);

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'User/role');
    }

    $data['role_list'] = $this->Master_Model->get_list_by_id3($resto_company_id,'','','','','','','role_id','ASC','rest_role');
    $data['page'] = 'Role';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/User/role', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Role...
  public function edit_role($role_id){
    $resto_user_id = $this->session->userdata('resto_user_id');
    $resto_company_id = $this->session->userdata('resto_company_id');
    $resto_role_id = $this->session->userdata('resto_role_id');
    if($resto_user_id == '' || $resto_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('role_name', 'Role Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $role_status = $this->input->post('role_status');
      if(!isset($role_status)){ $role_status = '1'; }
      $update_data = $_POST;
      $update_data['role_status'] = $role_status;
      $update_data['role_addedby'] = $resto_user_id;
      $this->Master_Model->update_info('role_id', $role_id, 'rest_role', $update_data);

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'User/role');
    }

    $role_info = $this->Master_Model->get_info_arr('role_id',$role_id,'rest_role');
    if(!$role_info){ header('location:'.base_url().'User/role'); }
    $data['update'] = 'update';
    $data['update_role'] = 'update';
    $data['role_info'] = $role_info[0];
    $data['act_link'] = base_url().'User/edit_role/'.$role_id;

    $data['role_list'] = $this->Master_Model->get_list_by_id3($resto_company_id,'','','','','','','role_id','ASC','rest_role');
    $data['page'] = 'Edit Role';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/User/role', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete Role...
  public function delete_role($role_id){
    $resto_user_id = $this->session->userdata('resto_user_id');
    $resto_company_id = $this->session->userdata('resto_company_id');
    $resto_role_id = $this->session->userdata('resto_role_id');
    if($resto_user_id == '' || $resto_company_id == ''){ header('location:'.base_url().'User'); }
    $this->Master_Model->delete_info('role_id', $role_id, 'rest_role');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'User/role');
  }

/**************************************************************************************************/

  public function forgot_password(){
    $this->load->view('Admin/User/forgot_password');
  }


/*******************************  Check Duplication  ****************************/
  public function check_duplication(){
    $column_name = $this->input->post('column_name');
    $column_val = $this->input->post('column_val');
    $table_name = $this->input->post('table_name');
    $company_id = '';
    $cnt = $this->Master_Model->check_duplication($company_id,$column_val,$column_name,$table_name);
    echo $cnt;
  }





}
?>
