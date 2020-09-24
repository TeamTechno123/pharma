<?php
defined('BASEPATH') OR exit('No direct script access allowed');

  class Master extends CI_Controller{
    public function __construct(){
      parent::__construct();
      date_default_timezone_set('Asia/Kolkata');
    }

    public function index(){

    }


/********************************* Unit ***********************************/
  // Add Unit...
  public function unit(){
    $resto_user_id = $this->session->userdata('resto_user_id');
    $resto_company_id = $this->session->userdata('resto_company_id');
    $resto_role_id = $this->session->userdata('resto_role_id');
    if($resto_user_id == '' || $resto_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('unit_name', 'Unit Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $unit_status = $this->input->post('unit_status');
      if(!isset($unit_status)){ $unit_status = '1'; }
      $save_data = $_POST;
      $save_data['unit_status'] = $unit_status;
      $save_data['company_id'] = $resto_company_id;
      $save_data['unit_addedby'] = $resto_user_id;
      $user_id = $this->Master_Model->save_data('rest_unit', $save_data);

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Master/unit');
    }

    $data['unit_list'] = $this->Master_Model->get_list_by_id3($resto_company_id,'','','','','','','unit_id','ASC','rest_unit');
    $data['page'] = 'Unit';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Master/unit', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Unit...
  public function edit_unit($unit_id){
    $resto_user_id = $this->session->userdata('resto_user_id');
    $resto_company_id = $this->session->userdata('resto_company_id');
    $resto_role_id = $this->session->userdata('resto_role_id');
    if($resto_user_id == '' || $resto_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('unit_name', 'Unit Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $unit_status = $this->input->post('unit_status');
      if(!isset($unit_status)){ $unit_status = '1'; }
      $update_data = $_POST;
      $update_data['unit_status'] = $unit_status;
      $update_data['unit_addedby'] = $resto_user_id;
      $this->Master_Model->update_info('unit_id', $unit_id, 'rest_unit', $update_data);

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Master/unit');
    }

    $unit_info = $this->Master_Model->get_info_arr('unit_id',$unit_id,'rest_unit');
    if(!$unit_info){ header('location:'.base_url().'Master/unit'); }
    $data['update'] = 'update';
    $data['update_unit'] = 'update';
    $data['unit_info'] = $unit_info[0];
    $data['act_link'] = base_url().'Master/edit_unit/'.$unit_id;

    $data['unit_list'] = $this->Master_Model->get_list_by_id3($resto_company_id,'','','','','','','unit_id','ASC','rest_unit');
    $data['page'] = 'Edit Unit';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Master/unit', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete Unit...
  public function delete_unit($unit_id){
    $resto_user_id = $this->session->userdata('resto_user_id');
    $resto_company_id = $this->session->userdata('resto_company_id');
    $resto_role_id = $this->session->userdata('resto_role_id');
    if($resto_user_id == '' || $resto_company_id == ''){ header('location:'.base_url().'User'); }
    $this->Master_Model->delete_info('unit_id', $unit_id, 'rest_unit');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Master/unit');
  }

/********************************* Tax Rate ***********************************/

  // Add Tax Rate...
  public function tax_rate(){
    $resto_user_id = $this->session->userdata('resto_user_id');
    $resto_company_id = $this->session->userdata('resto_company_id');
    $resto_role_id = $this->session->userdata('resto_role_id');
    if($resto_user_id == '' && $resto_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('tax_rate_name', 'tax_rate Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $tax_rate_status = $this->input->post('tax_rate_status');
      if(!isset($tax_rate_status)){ $tax_rate_status = '1'; }

      $save_data = $_POST;
      $save_data['tax_rate_status'] = $tax_rate_status;
      $save_data['company_id'] = $resto_company_id;
      $save_data['tax_rate_addedby'] = $resto_user_id;
      $tax_rate_id = $this->Master_Model->save_data('rest_tax_rate', $save_data);

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Master/tax_rate');
    }

    $data['tax_rate_list'] = $this->Master_Model->get_list_by_id3($resto_company_id,'','','','','','','tax_rate_id','DESC','rest_tax_rate');

    $data['page'] = 'Tax Rate';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Master/tax_rate', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit Tax Rate...
  public function edit_tax_rate($tax_rate_id){
    $resto_user_id = $this->session->userdata('resto_user_id');
    $resto_company_id = $this->session->userdata('resto_company_id');
    $resto_role_id = $this->session->userdata('resto_role_id');
    if($resto_user_id == '' && $resto_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('tax_rate_name', 'tax_rate title', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $tax_rate_status = $this->input->post('tax_rate_status');
      if(!isset($tax_rate_status)){ $tax_rate_status = '1'; }

      $update_data = $_POST;
      $update_data['tax_rate_status'] = $tax_rate_status;
      $update_data['tax_rate_addedby'] = $resto_user_id;
      $this->Master_Model->update_info('tax_rate_id', $tax_rate_id, 'rest_tax_rate', $update_data);

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Master/tax_rate');
    }
    $tax_rate_info = $this->Master_Model->get_info_arr('tax_rate_id',$tax_rate_id,'rest_tax_rate');
    if(!$tax_rate_info){ header('location:'.base_url().'Master/tax_rate'); }
    $data['update'] = 'update';
    $data['update_tax_rate'] = 'update';
    $data['tax_rate_info'] = $tax_rate_info[0];
    $data['act_link'] = base_url().'Master/edit_tax_rate/'.$tax_rate_id;

    $data['tax_rate_list'] = $this->Master_Model->get_list_by_id3($resto_company_id,'','','','','','','tax_rate_id','DESC','rest_tax_rate');
    $data['page'] = 'Edit Tax Rate';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Master/tax_rate', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Delete Tax Rate...
  public function delete_tax_rate($tax_rate_id){
    $resto_user_id = $this->session->userdata('resto_user_id');
    $resto_company_id = $this->session->userdata('resto_company_id');
    $resto_role_id = $this->session->userdata('resto_role_id');
    if($resto_user_id == '' && $resto_company_id == ''){ header('location:'.base_url().'User'); }
    $this->Master_Model->delete_info('tax_rate_id', $tax_rate_id, 'rest_tax_rate');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Master/tax_rate');
  }

/********************************* Shipping Method ***********************************/

  // Add Shipping Method...
  public function shipping_method(){
    $resto_user_id = $this->session->userdata('resto_user_id');
    $resto_company_id = $this->session->userdata('resto_company_id');
    $resto_role_id = $this->session->userdata('resto_role_id');
    if($resto_user_id == '' && $resto_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('shipping_method_name', 'shipping_method Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $shipping_method_status = $this->input->post('shipping_method_status');
      if(!isset($shipping_method_status)){ $shipping_method_status = '1'; }

      $save_data = $_POST;
      $save_data['shipping_method_status'] = $shipping_method_status;
      $save_data['company_id'] = $resto_company_id;
      $save_data['shipping_method_addedby'] = $resto_user_id;
      $shipping_method_id = $this->Master_Model->save_data('rest_shipping_method', $save_data);

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Master/shipping_method');
    }

    $data['shipping_method_list'] = $this->Master_Model->get_list_by_id3($resto_company_id,'','','','','','','shipping_method_id','DESC','rest_shipping_method');

    $data['page'] = 'Shipping Method';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Master/shipping_method', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit Shipping Method...
  public function edit_shipping_method($shipping_method_id){
    $resto_user_id = $this->session->userdata('resto_user_id');
    $resto_company_id = $this->session->userdata('resto_company_id');
    $resto_role_id = $this->session->userdata('resto_role_id');
    if($resto_user_id == '' && $resto_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('shipping_method_name', 'shipping_method title', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $shipping_method_status = $this->input->post('shipping_method_status');
      if(!isset($shipping_method_status)){ $shipping_method_status = '1'; }

      $update_data = $_POST;
      $update_data['shipping_method_status'] = $shipping_method_status;
      $update_data['shipping_method_addedby'] = $resto_user_id;
      $this->Master_Model->update_info('shipping_method_id', $shipping_method_id, 'rest_shipping_method', $update_data);

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Master/shipping_method');
    }
    $shipping_method_info = $this->Master_Model->get_info_arr('shipping_method_id',$shipping_method_id,'rest_shipping_method');
    if(!$shipping_method_info){ header('location:'.base_url().'Master/shipping_method'); }
    $data['update'] = 'update';
    $data['update_shipping_method'] = 'update';
    $data['shipping_method_info'] = $shipping_method_info[0];
    $data['act_link'] = base_url().'Master/edit_shipping_method/'.$shipping_method_id;

    $data['shipping_method_list'] = $this->Master_Model->get_list_by_id3($resto_company_id,'','','','','','','shipping_method_id','DESC','rest_shipping_method');
    $data['page'] = 'Edit Shipping Method';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Master/shipping_method', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Delete Shipping Method...
  public function delete_shipping_method($shipping_method_id){
    $resto_user_id = $this->session->userdata('resto_user_id');
    $resto_company_id = $this->session->userdata('resto_company_id');
    $resto_role_id = $this->session->userdata('resto_role_id');
    if($resto_user_id == '' && $resto_company_id == ''){ header('location:'.base_url().'User'); }
    $this->Master_Model->delete_info('shipping_method_id', $shipping_method_id, 'rest_shipping_method');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Master/shipping_method');
  }

/********************************* Order Status ***********************************/

  // Add Order Status...
  public function order_status(){
    $resto_user_id = $this->session->userdata('resto_user_id');
    $resto_company_id = $this->session->userdata('resto_company_id');
    $resto_role_id = $this->session->userdata('resto_role_id');
    if($resto_user_id == '' || $resto_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('order_status_name', 'Order Status Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $order_status = $this->input->post('order_status');
      if(!isset($order_status)){ $order_status = '1'; }
      $save_data = $_POST;
      $save_data['order_status_status'] = $order_status;
      $save_data['company_id'] = $resto_company_id;
      $save_data['order_status_addedby'] = $resto_user_id;
      $user_id = $this->Master_Model->save_data('rest_order_status', $save_data);

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Master/order_status');
    }

    $data['order_status_list'] = $this->Master_Model->get_list_by_id3($resto_company_id,'','','','','','','order_status_id','ASC','rest_order_status');
    $data['page'] = 'Order Status';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Master/order_status', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Order Status...
  public function edit_order_status($order_status_id){
    $resto_user_id = $this->session->userdata('resto_user_id');
    $resto_company_id = $this->session->userdata('resto_company_id');
    $resto_role_id = $this->session->userdata('resto_role_id');
    if($resto_user_id == '' || $resto_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('order_status_name', 'Order Status Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $order_status = $this->input->post('order_status');
      if(!isset($order_status)){ $order_status = '1'; }
      $update_data = $_POST;
      $update_data['order_status_status'] = $order_status;
      $update_data['order_status_addedby'] = $resto_user_id;
      $this->Master_Model->update_info('order_status_id', $order_status_id, 'rest_order_status', $update_data);

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Master/order_status');
    }

    $order_status_info = $this->Master_Model->get_info_arr('order_status_id',$order_status_id,'rest_order_status');
    if(!$order_status_info){ header('location:'.base_url().'Master/order_status'); }
    $data['update'] = 'update';
    $data['update_order_status'] = 'update';
    $data['order_status_info'] = $order_status_info[0];
    $data['act_link'] = base_url().'Master/edit_order_status/'.$order_status_id;

    $data['order_status_list'] = $this->Master_Model->get_list_by_id3($resto_company_id,'','','','','','','order_status_id','ASC','rest_order_status');
    $data['page'] = 'Edit Order Status';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Master/order_status', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete Order Status...
  public function delete_order_status($order_status_id){
    $resto_user_id = $this->session->userdata('resto_user_id');
    $resto_company_id = $this->session->userdata('resto_company_id');
    $resto_role_id = $this->session->userdata('resto_role_id');
    if($resto_user_id == '' || $resto_company_id == ''){ header('location:'.base_url().'User'); }
    $this->Master_Model->delete_info('order_status_id', $order_status_id, 'rest_order_status');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Master/order_status');
  }

/********************************* Food Category ***********************************/

  // Add Food Category...
  public function food_category(){
    $resto_user_id = $this->session->userdata('resto_user_id');
    $resto_company_id = $this->session->userdata('resto_company_id');
    $resto_role_id = $this->session->userdata('resto_role_id');
    if($resto_user_id == '' && $resto_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('food_category_name', 'food_category title', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $food_category_status = $this->input->post('food_category_status');
      if(!isset($food_category_status)){ $food_category_status = '1'; }
      $food_category_offer = $this->input->post('food_category_offer');
      if(!isset($food_category_offer)){ $food_category_offer = '0'; }

      $save_data = $_POST;
      $save_data['food_category_status'] = $food_category_status;
      $save_data['food_category_offer'] = $food_category_offer;
      $save_data['company_id'] = $resto_company_id;
      $save_data['food_category_addedby'] = $resto_user_id;

      $main_food_category_id = $this->input->post('main_food_category_id');
      if($main_food_category_id == '0'){
        $save_data['is_primary'] = 1;
        $save_data['main_food_category_id'] = 0;
      } else{
        $save_data['is_primary'] = 0;
      }
      $food_category_id = $this->Master_Model->save_data('rest_food_category', $save_data);

      if($_FILES['food_category_image']['name']){
        $time = time();
        $image_name = 'food_category_'.$food_category_id.'_'.$time;
        $config['upload_path'] = 'assets/images/food_category/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['food_category_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('food_category_image') && $food_category_id && $image_name && $ext && $filename){
          $food_category_image_up['food_category_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('food_category_id', $food_category_id, 'rest_food_category', $food_category_image_up);
          // unlink("assets/images/tours/".$food_category_image_old);
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Master/food_category');
    }
    $data['main_food_category_list'] = $this->Master_Model->get_list_by_id3($resto_company_id,'is_primary','1','','','','','food_category_id','DESC','rest_food_category');

    $data['food_category_list'] = $this->Master_Model->get_list_by_id3($resto_company_id,'','','','','','','food_category_id','DESC','rest_food_category');
    $data['page'] = 'Food Category';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Master/food_category', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit Food Category...
  public function edit_food_category($food_category_id){
    $resto_user_id = $this->session->userdata('resto_user_id');
    $resto_company_id = $this->session->userdata('resto_company_id');
    $resto_role_id = $this->session->userdata('resto_role_id');
    if($resto_user_id == '' && $resto_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('food_category_name', 'food_category title', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $food_category_status = $this->input->post('food_category_status');
      if(!isset($food_category_status)){ $food_category_status = '1'; }
      $food_category_offer = $this->input->post('food_category_offer');
      if(!isset($food_category_offer)){ $food_category_offer = '0'; }
      $update_data = $_POST;
      unset($update_data['old_food_category_img']);
      $update_data['food_category_status'] = $food_category_status;
      $update_data['food_category_offer'] = $food_category_offer;
      $update_data['food_category_addedby'] = $resto_user_id;
      $main_food_category_id = $this->input->post('main_food_category_id');
      if($main_food_category_id == '0'){
        $update_data['is_primary'] = 1;
        $update_data['main_food_category_id'] = 0;
      } else{
        $update_data['is_primary'] = 0;
      }
      $this->Master_Model->update_info('food_category_id', $food_category_id, 'rest_food_category', $update_data);

      if($_FILES['food_category_image']['name']){
        $time = time();
        $image_name = 'food_category_'.$food_category_id.'_'.$time;
        $config['upload_path'] = 'assets/images/food_category/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['food_category_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('food_category_image') && $food_category_id && $image_name && $ext && $filename){
          $food_category_image_up['food_category_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('food_category_id', $food_category_id, 'rest_food_category', $food_category_image_up);
          if($_POST['old_food_category_img']){ unlink("assets/images/food_category/".$_POST['old_food_category_img']); }
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }
      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Master/food_category');
    }
    $food_category_info = $this->Master_Model->get_info_arr('food_category_id',$food_category_id,'rest_food_category');
    if(!$food_category_info){ header('location:'.base_url().'Master/food_category'); }
    $data['update'] = 'update';
    $data['update_food_category'] = 'update';
    $data['food_category_info'] = $food_category_info[0];
    $data['act_link'] = base_url().'Master/edit_food_category/'.$food_category_id;
    $data['main_food_category_list'] = $this->Master_Model->get_list_by_id3($resto_company_id,'is_primary','1','','','','','food_category_id','DESC','rest_food_category');

    $data['food_category_list'] = $this->Master_Model->get_list_by_id3($resto_company_id,'','','','','','','food_category_id','DESC','rest_food_category');
    $data['page'] = 'Edit Food Category';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Master/food_category', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Delete Food Category...
  public function delete_food_category($food_category_id){
    $resto_user_id = $this->session->userdata('resto_user_id');
    $resto_company_id = $this->session->userdata('resto_company_id');
    $resto_role_id = $this->session->userdata('resto_role_id');
    if($resto_user_id == '' && $resto_company_id == ''){ header('location:'.base_url().'User'); }
    $food_category_info = $this->Master_Model->get_info_arr_fields('food_category_image, food_category_id', 'food_category_id', $food_category_id, 'rest_food_category');
    if($food_category_info){
      $food_category_image = $food_category_info[0]['food_category_image'];
      if($food_category_image){ unlink("assets/images/food_category/".$food_category_image); }
    }
    $this->Master_Model->delete_info('food_category_id', $food_category_id, 'rest_food_category');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Master/food_category');
  }


/********************************* Food ***********************************/

  // Add Food...
  public function food(){
    $resto_user_id = $this->session->userdata('resto_user_id');
    $resto_company_id = $this->session->userdata('resto_company_id');
    $resto_role_id = $this->session->userdata('resto_role_id');
    if($resto_user_id == '' && $resto_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('food_name', 'food title', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $food_status = $this->input->post('food_status');
      if(!isset($food_status)){ $food_status = '1'; }
      $food_offer = $this->input->post('food_offer');
      if(!isset($food_offer)){ $food_offer = '0'; }

      $save_data = $_POST;
      $save_data['food_status'] = $food_status;
      $save_data['food_offer'] = $food_offer;
      $save_data['company_id'] = $resto_company_id;
      $save_data['food_addedby'] = $resto_user_id;
      $food_id = $this->Master_Model->save_data('rest_food', $save_data);

      if($_FILES['food_image']['name']){
        $time = time();
        $image_name = 'food_'.$food_id.'_'.$time;
        $config['upload_path'] = 'assets/images/food/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['food_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('food_image') && $food_id && $image_name && $ext && $filename){
          $food_image_up['food_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('food_id', $food_id, 'rest_food', $food_image_up);
          // unlink("assets/images/tours/".$food_image_old);
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Master/food');
    }
    $data['main_food_category_list'] = $this->Master_Model->get_list_by_id3($resto_company_id,'is_primary','1','','','','','food_category_id','DESC','rest_food_category');
    // print_r($data['main_food_category_list']);
    // $data['food_list'] = $this->Master_Model->get_list_by_id3($resto_company_id,'','','','','','','food_id','DESC','rest_food');
    $data['page'] = 'Food';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Master/food', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit Food...
  public function edit_food($food_id){
    $resto_user_id = $this->session->userdata('resto_user_id');
    $resto_company_id = $this->session->userdata('resto_company_id');
    $resto_role_id = $this->session->userdata('resto_role_id');
    if($resto_user_id == '' && $resto_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('food_name', 'food title', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $food_status = $this->input->post('food_status');
      if(!isset($food_status)){ $food_status = '1'; }
      $food_offer = $this->input->post('food_offer');
      if(!isset($food_offer)){ $food_offer = '0'; }
      $update_data = $_POST;
      unset($update_data['old_food_img']);
      $update_data['food_status'] = $food_status;
      $update_data['food_offer'] = $food_offer;
      $update_data['food_addedby'] = $resto_user_id;

      $this->Master_Model->update_info('food_id', $food_id, 'rest_food', $update_data);

      if($_FILES['food_image']['name']){
        $time = time();
        $image_name = 'food_'.$food_id.'_'.$time;
        $config['upload_path'] = 'assets/images/food/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['food_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('food_image') && $food_id && $image_name && $ext && $filename){
          $food_image_up['food_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('food_id', $food_id, 'rest_food', $food_image_up);
          if($_POST['old_food_img']){ unlink("assets/images/food/".$_POST['old_food_img']); }
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }
      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Master/food');
    }
    $food_info = $this->Master_Model->get_info_arr('food_id',$food_id,'rest_food');
    if(!$food_info){ header('location:'.base_url().'Master/food'); }
    $data['update'] = 'update';
    $data['update_food'] = 'update';
    $data['food_info'] = $food_info[0];
    $data['act_link'] = base_url().'Master/edit_food/'.$food_id;
    $data['main_food_category_list'] = $this->Master_Model->get_list_by_id3($resto_company_id,'is_primary','1','','','','','food_category_id','DESC','rest_food_category');

    $data['food_list'] = $this->Master_Model->get_list_by_id3($resto_company_id,'','','','','','','food_id','DESC','rest_food');
    $data['page'] = 'Edit Food';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Master/food', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Delete Food...
  public function delete_food($food_id){
    $resto_user_id = $this->session->userdata('resto_user_id');
    $resto_company_id = $this->session->userdata('resto_company_id');
    $resto_role_id = $this->session->userdata('resto_role_id');
    if($resto_user_id == '' && $resto_company_id == ''){ header('location:'.base_url().'User'); }
    $food_info = $this->Master_Model->get_info_arr_fields('food_image, food_id', 'food_id', $food_id, 'rest_food');
    if($food_info){
      $food_image = $food_info[0]['food_image'];
      if($food_image){ unlink("assets/images/food/".$food_image); }
    }
    $this->Master_Model->delete_info('food_id', $food_id, 'rest_food');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Master/food');
  }




/*********************************** Announcement *********************************/

  // Add Announcement....
  public function announcement(){
    $resto_user_id = $this->session->userdata('resto_user_id');
    $resto_company_id = $this->session->userdata('resto_company_id');
    $resto_role_id = $this->session->userdata('resto_role_id');
    if($resto_user_id == '' && $resto_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('announcement_name', 'Batch Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $announcement_status = $this->input->post('announcement_status');
      if(!isset($announcement_status)){ $announcement_status = '1'; }
      $save_data = $_POST;
      $save_data['announcement_status'] = $announcement_status;
      $save_data['company_id'] = $resto_company_id;
      $save_data['announcement_addedby'] = $resto_user_id;
      $announcement_id = $this->Master_Model->save_data('rest_announcement', $save_data);

      if($_FILES['announcement_image']['name']){
        $time = time();
        $image_name = 'announcement_'.$announcement_id.'_'.$time;
        $config['upload_path'] = 'assets/images/announcement/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['announcement_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('announcement_image') && $announcement_id && $image_name && $ext && $filename){
          $announcement_image_up['announcement_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('announcement_id', $announcement_id, 'rest_announcement', $announcement_image_up);
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }
      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Master/announcement');
    }

    $data['announcement_list'] = $this->Master_Model->get_list_by_id3($resto_company_id,'','','','','','','announcement_id','DESC','rest_announcement');
    $data['page'] = 'Announcement';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Master/announcement', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Announcement...
  public function edit_announcement($announcement_id){
    $resto_user_id = $this->session->userdata('resto_user_id');
    $resto_company_id = $this->session->userdata('resto_company_id');
    $resto_role_id = $this->session->userdata('resto_role_id');
    if($resto_user_id == '' && $resto_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('announcement_name', 'First Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $announcement_status = $this->input->post('announcement_status');
      if(!isset($announcement_status)){ $announcement_status = '1'; }
      $update_data = $_POST;
      unset($update_data['old_announcement_img']);
      $update_data['announcement_status'] = $announcement_status;
      $update_data['announcement_addedby'] = $resto_user_id;
      $this->Master_Model->update_info('announcement_id', $announcement_id, 'rest_announcement', $update_data);

      if($_FILES['announcement_image']['name']){
        $time = time();
        $image_name = 'announcement_'.$announcement_id.'_'.$time;
        $config['upload_path'] = 'assets/images/announcement/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['announcement_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('announcement_image') && $announcement_id && $image_name && $ext && $filename){
          $announcement_image_up['announcement_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('announcement_id', $announcement_id, 'rest_announcement', $announcement_image_up);
          if($_POST['old_announcement_img']){ unlink("assets/images/announcement/".$_POST['old_announcement_img']); }
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Master/announcement');
    }

    $announcement_info = $this->Master_Model->get_info_arr('announcement_id',$announcement_id,'rest_announcement');
    if(!$announcement_info){ header('location:'.base_url().'Master/announcement'); }
    $data['update'] = 'update';
    $data['update_announcement'] = 'update';
    $data['announcement_info'] = $announcement_info[0];
    $data['act_link'] = base_url().'Master/edit_announcement/'.$announcement_id;

    $data['announcement_list'] = $this->Master_Model->get_list_by_id3($resto_company_id,'','','','','','','announcement_id','DESC','rest_announcement');
    $data['page'] = 'Edit Announcement';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Master/announcement', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete Announcement...
  public function delete_announcement($announcement_id){
    $resto_user_id = $this->session->userdata('resto_user_id');
    $resto_company_id = $this->session->userdata('resto_company_id');
    $resto_role_id = $this->session->userdata('resto_role_id');
    if($resto_user_id == '' && $resto_company_id == ''){ header('location:'.base_url().'User'); }
    $announcement_info = $this->Master_Model->get_info_arr_fields('announcement_image, announcement_id', 'announcement_id', $announcement_id, 'rest_announcement');
    if($announcement_info){
      $announcement_image = $announcement_info[0]['announcement_image'];
      if($announcement_image){ unlink("assets/images/announcement/".$announcement_image); }
    }
    $this->Master_Model->delete_info('announcement_id', $announcement_id, 'rest_announcement');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Master/announcement');
  }


/********************************* Customer ***********************************/

  // Add Customer...
  public function customer(){
    $resto_user_id = $this->session->userdata('resto_user_id');
    $resto_company_id = $this->session->userdata('resto_company_id');
    $resto_role_id = $this->session->userdata('resto_role_id');
    if($resto_user_id == '' && $resto_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('customer_name', 'customer title', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $customer_status = $this->input->post('customer_status');
      if(!isset($customer_status)){ $customer_status = '1'; }
      $save_data = $_POST;
      $save_data['customer_status'] = $customer_status;
      $save_data['company_id'] = $resto_company_id;
      $save_data['customer_addedby'] = $resto_user_id;
      $customer_id = $this->Master_Model->save_data('rest_customer', $save_data);

      if($_FILES['customer_logo']['name']){
        $time = time();
        $image_name = 'customer_'.$customer_id.'_'.$time;
        $config['upload_path'] = 'assets/images/customer/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['customer_logo']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('customer_logo') && $customer_id && $image_name && $ext && $filename){
          $customer_logo_up['customer_logo'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('customer_id', $customer_id, 'rest_customer', $customer_logo_up);
          // unlink("assets/images/tours/".$customer_logo_old);
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }
      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Master/customer');
    }
    $data['country_list'] = $this->Master_Model->get_list_by_id3('','','','','','','','country_name','ASC','country');
    // $data['state_list'] = $this->Master_Model->get_list_by_id3('','','','','','','','state_name','ASC','state');
    // $data['city_list'] = $this->Master_Model->get_list_by_id3('','','','','','','','city_name','ASC','city');

    $data['customer_list'] = $this->Master_Model->get_list_by_id3($resto_company_id,'','','','','','','customer_id','DESC','rest_customer');
    $data['page'] = 'Customer';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Master/customer', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit Customer...
  public function edit_customer($customer_id){
    $resto_user_id = $this->session->userdata('resto_user_id');
    $resto_company_id = $this->session->userdata('resto_company_id');
    $resto_role_id = $this->session->userdata('resto_role_id');
    if($resto_user_id == '' && $resto_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('customer_name', 'customer title', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $customer_status = $this->input->post('customer_status');
      if(!isset($customer_status)){ $customer_status = '1'; }
      $update_data = $_POST;
      unset($update_data['old_customer_logo']);
      $update_data['customer_status'] = $customer_status;
      $update_data['customer_addedby'] = $resto_user_id;
      $this->Master_Model->update_info('customer_id', $customer_id, 'rest_customer', $update_data);

      if($_FILES['customer_logo']['name']){
        $time = time();
        $image_name = 'customer_'.$customer_id.'_'.$time;
        $config['upload_path'] = 'assets/images/customer/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['customer_logo']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('customer_logo') && $customer_id && $image_name && $ext && $filename){
          $customer_logo_up['customer_logo'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('customer_id', $customer_id, 'rest_customer', $customer_logo_up);
          if($_POST['old_customer_logo']){ unlink("assets/images/customer/".$_POST['old_customer_logo']); }
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }
      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Master/customer');
    }
    $customer_info = $this->Master_Model->get_info_arr('customer_id',$customer_id,'rest_customer');
    if(!$customer_info){ header('location:'.base_url().'Master/customer'); }
    $data['update'] = 'update';
    $data['update_customer'] = 'update';
    $data['customer_info'] = $customer_info[0];
    $data['act_link'] = base_url().'Master/edit_customer/'.$customer_id;
    $state_id = $customer_info[0]['state_id'];
    $country_id = $customer_info[0]['country_id'];
    $data['country_list'] = $this->Master_Model->get_list_by_id3('','','','','','','','country_name','ASC','country');
    $data['state_list'] = $this->Master_Model->get_list_by_id3('','country_id',$country_id,'','','','','state_name','ASC','state');
    $data['city_list'] = $this->Master_Model->get_list_by_id3('','state_id',$state_id,'','','','','city_name','ASC','city');

    $data['customer_list'] = $this->Master_Model->get_list_by_id3($resto_company_id,'','','','','','','customer_id','DESC','rest_customer');
    $data['page'] = 'Edit Customer';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Master/customer', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Delete Customer...
  public function delete_customer($customer_id){
    $resto_user_id = $this->session->userdata('resto_user_id');
    $resto_company_id = $this->session->userdata('resto_company_id');
    $resto_role_id = $this->session->userdata('resto_role_id');
    if($resto_user_id == '' && $resto_company_id == ''){ header('location:'.base_url().'User'); }
    $customer_info = $this->Master_Model->get_info_arr_fields('customer_logo, customer_id', 'customer_id', $customer_id, 'rest_customer');
    if($customer_info){
      $customer_logo = $customer_info[0]['customer_logo'];
      if($customer_logo){ unlink("assets/images/customer/".$customer_logo); }
    }
    $this->Master_Model->delete_info('customer_id', $customer_id, 'rest_customer');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Master/customer');
  }


/*****************************************************************************************/
  // Check Duplication
  public function check_duplication(){
    $column_name = $this->input->post('column_name');
    $column_val = $this->input->post('column_val');
    $table_name = $this->input->post('table_name');
    $company_id = '';
    $cnt = $this->Master_Model->check_duplication($company_id,$column_val,$column_name,$table_name);
    echo $cnt;
  }

  // get_sub_testgroup_by_main
  // public function get_sub_testgroup_by_main(){
  //   $test_group_id = $this->input->post('test_group_id');
  //   $test_subgroup_list = $this->Master_Model->get_list_by_id3('','primary_test_group_id',$test_group_id,'test_group_status','1','','','test_group_name','ASC','test_group');
  //   echo "<option value='' selected >Select Test SubGroup</option>";
  //   foreach ($test_subgroup_list as $list) {
  //     echo "<option value='".$list->test_group_id."'> ".$list->test_group_name." </option>";
  //   }
  // }

  // get_state_by_country
  public function get_state_by_country(){
    $country_id = $this->input->post('country_id');
    $state_list = $this->Master_Model->get_list_by_id3('','country_id',$country_id,'','','','','state_name','ASC','state');
    echo "<option value='' selected >Select State</option>";
    foreach ($state_list as $list) {
      echo "<option value='".$list->state_id."'> ".$list->state_name." </option>";
    }
  }

  // get_city_by_state
  public function get_city_by_state(){
    $state_id = $this->input->post('state_id');
    $city_list = $this->Master_Model->get_list_by_id3('','state_id',$state_id,'','','','','city_name','ASC','city');
    echo "<option value='' selected >Select City</option>";
    foreach ($city_list as $list) {
      echo "<option value='".$list->city_id."'> ".$list->city_name." </option>";
    }
  }

  // category_by_type
  public function category_by_type(){
    $food_category_type = $this->input->post('food_category_type');
    $food_category_list = $this->Master_Model->get_list_by_id3('','food_category_type',$food_category_type,'food_category_status','1','','','food_category_name','ASC','rest_food_category');
    echo "<option value='' selected >Select Category</option>";
    foreach ($food_category_list as $list) {
      echo "<option value='".$list->food_category_id."'> ".$list->food_category_name." </option>";
    }
  }




  /********************************* Brand Information ***********************************/

  // Add Brand...
  public function brand(){
    $resto_user_id = $this->session->userdata('resto_user_id');
    $resto_company_id = $this->session->userdata('resto_company_id');
    $resto_role_id = $this->session->userdata('resto_role_id');
    if($resto_user_id == '' && $resto_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('brand_name', 'brand Name', 'trim|required');
    
      $data['page'] = 'Brand';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Master/brand', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit Brand...
  public function edit_brand($brand_id){
    $resto_user_id = $this->session->userdata('resto_user_id');
    $resto_company_id = $this->session->userdata('resto_company_id');
    $resto_role_id = $this->session->userdata('resto_role_id');
    if($resto_user_id == '' && $resto_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('brand_name', 'brand title', 'trim|required');
    
    
    $this->load->view('Admin/Include/head');
    $this->load->view('Admin/Include/navbar');
    $this->load->view('Admin/Master/brand');
    $this->load->view('Admin/Include/footer');
  }

  // Delete Brand...
  public function delete_brand($brand_id){
    $resto_user_id = $this->session->userdata('resto_user_id');
    $resto_company_id = $this->session->userdata('resto_company_id');
    $resto_role_id = $this->session->userdata('resto_role_id');
    if($resto_user_id == '' && $resto_company_id == ''){ header('location:'.base_url().'User'); }
    $this->Master_Model->delete_info('brand_id', $brand_id, 'rest_brand');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Master/brand');
  }




  /********************************* Category Information ***********************************/

  // Add Category...
  public function category(){
    $resto_user_id = $this->session->userdata('resto_user_id');
    $resto_company_id = $this->session->userdata('resto_company_id');
    $resto_role_id = $this->session->userdata('resto_role_id');
    if($resto_user_id == '' && $resto_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('category_name', 'category Name', 'trim|required');
    
      $data['page'] = 'Category';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Master/category', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit Category...
  public function edit_category($category_id){
    $resto_user_id = $this->session->userdata('resto_user_id');
    $resto_company_id = $this->session->userdata('resto_company_id');
    $resto_role_id = $this->session->userdata('resto_role_id');
    if($resto_user_id == '' && $resto_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('category_name', 'category title', 'trim|required');
    
    
    $this->load->view('Admin/Include/head');
    $this->load->view('Admin/Include/navbar');
    $this->load->view('Admin/Master/category');
    $this->load->view('Admin/Include/footer');
  }

  // Delete Category...
  public function delete_category($category_id){
    $resto_user_id = $this->session->userdata('resto_user_id');
    $resto_company_id = $this->session->userdata('resto_company_id');
    $resto_role_id = $this->session->userdata('resto_role_id');
    if($resto_user_id == '' && $resto_company_id == ''){ header('location:'.base_url().'User'); }
    $this->Master_Model->delete_info('category_id', $category_id, 'rest_category');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Master/category');
  }


  /********************************* Health Information ***********************************/

  // Add Health...
  public function health(){
    $resto_user_id = $this->session->userdata('resto_user_id');
    $resto_company_id = $this->session->userdata('resto_company_id');
    $resto_role_id = $this->session->userdata('resto_role_id');
    if($resto_user_id == '' && $resto_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('health_name', 'health Name', 'trim|required');
    
      $data['page'] = 'Health';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Master/health', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit Health...
  public function edit_health($health_id){
    $resto_user_id = $this->session->userdata('resto_user_id');
    $resto_company_id = $this->session->userdata('resto_company_id');
    $resto_role_id = $this->session->userdata('resto_role_id');
    if($resto_user_id == '' && $resto_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('health_name', 'health title', 'trim|required');
    
    
    $this->load->view('Admin/Include/head');
    $this->load->view('Admin/Include/navbar');
    $this->load->view('Admin/Master/health');
    $this->load->view('Admin/Include/footer');
  }

  // Delete Health...
  public function delete_health($health_id){
    $resto_user_id = $this->session->userdata('resto_user_id');
    $resto_company_id = $this->session->userdata('resto_company_id');
    $resto_role_id = $this->session->userdata('resto_role_id');
    if($resto_user_id == '' && $resto_company_id == ''){ header('location:'.base_url().'User'); }
    $this->Master_Model->delete_info('health_id', $health_id, 'rest_health');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Master/health');
  }

/********************************* Role Information ***********************************/

  // Add Role...
  public function role(){
    $resto_user_id = $this->session->userdata('resto_user_id');
    $resto_company_id = $this->session->userdata('resto_company_id');
    $resto_role_id = $this->session->userdata('resto_role_id');
    if($resto_user_id == '' && $resto_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('role_name', 'role Name', 'trim|required');
    
      $data['page'] = 'role';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Master/role', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit Role...
  public function edit_role($role_id){
    $resto_user_id = $this->session->userdata('resto_user_id');
    $resto_company_id = $this->session->userdata('resto_company_id');
    $resto_role_id = $this->session->userdata('resto_role_id');
    if($resto_user_id == '' && $resto_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('role_name', 'role title', 'trim|required');
    
    
    $this->load->view('Admin/Include/head');
    $this->load->view('Admin/Include/navbar');
    $this->load->view('Admin/Master/role');
    $this->load->view('Admin/Include/footer');
  }

  // Delete Role...
  public function delete_role($role_id){
    $resto_user_id = $this->session->userdata('resto_user_id');
    $resto_company_id = $this->session->userdata('resto_company_id');
    $resto_role_id = $this->session->userdata('resto_role_id');
    if($resto_user_id == '' && $resto_company_id == ''){ header('location:'.base_url().'User'); }
    $this->Master_Model->delete_info('role_id', $role_id, 'rest_role');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Master/role');
  }

  /********************************* Salt Information ***********************************/

  // Add Salt...
  public function salt(){
    $resto_user_id = $this->session->userdata('resto_user_id');
    $resto_company_id = $this->session->userdata('resto_company_id');
    $resto_role_id = $this->session->userdata('resto_role_id');
    if($resto_user_id == '' && $resto_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('salt_name', 'salt Name', 'trim|required');
    
      $data['page'] = 'salt';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Master/salt', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit Salt...
  public function edit_salt($salt_id){
    $resto_user_id = $this->session->userdata('resto_user_id');
    $resto_company_id = $this->session->userdata('resto_company_id');
    $resto_role_id = $this->session->userdata('resto_role_id');
    if($resto_user_id == '' && $resto_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('salt_name', 'role title', 'trim|required');
    
    
    $this->load->view('Admin/Include/head');
    $this->load->view('Admin/Include/navbar');
    $this->load->view('Admin/Master/salt');
    $this->load->view('Admin/Include/footer');
  }

  // Delete Salt...
  public function delete_salt($salt_id){
    $resto_user_id = $this->session->userdata('resto_user_id');
    $resto_company_id = $this->session->userdata('resto_company_id');
    $resto_role_id = $this->session->userdata('resto_role_id');
    if($resto_user_id == '' && $resto_company_id == ''){ header('location:'.base_url().'User'); }
    $this->Master_Model->delete_info('salt_id', $role_id, 'rest_role');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Master/salt');
  }


  /********************************* Side Effect Information ***********************************/

  // Add Side Effect...
  public function side_effect(){
    $resto_user_id = $this->session->userdata('resto_user_id');
    $resto_company_id = $this->session->userdata('resto_company_id');
    $resto_role_id = $this->session->userdata('resto_role_id');
    if($resto_user_id == '' && $resto_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('side_effect_name', 'side_effect Name', 'trim|required');
    
      $data['page'] = 'Side Effect';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Master/side_effect', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit Side Effect...
  public function edit_side_effect($side_effect_id){
    $resto_user_id = $this->session->userdata('resto_user_id');
    $resto_company_id = $this->session->userdata('resto_company_id');
    $resto_role_id = $this->session->userdata('resto_role_id');
    if($resto_user_id == '' && $resto_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('side_effect_name', 'role title', 'trim|required');
    
    
    $this->load->view('Admin/Include/head');
    $this->load->view('Admin/Include/navbar');
    $this->load->view('Admin/Master/side_effect');
    $this->load->view('Admin/Include/footer');
  }

  // Delete Side Effect...
  public function delete_side_effect($side_effect_id){
    $resto_user_id = $this->session->userdata('resto_user_id');
    $resto_company_id = $this->session->userdata('resto_company_id');
    $resto_role_id = $this->session->userdata('resto_role_id');
    if($resto_user_id == '' && $resto_company_id == ''){ header('location:'.base_url().'User'); }
    $this->Master_Model->delete_info('side_effect_id', $role_id, 'rest_role');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Master/side_effect');
  }


  /********************************* Slider Information ***********************************/

  // Add Slider...
  public function slider(){
    $resto_user_id = $this->session->userdata('resto_user_id');
    $resto_company_id = $this->session->userdata('resto_company_id');
    $resto_role_id = $this->session->userdata('resto_role_id');
    if($resto_user_id == '' && $resto_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('slider_name', 'slider Name', 'trim|required');
    
      $data['page'] = 'Slider';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Master/slider', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit Slider...
  public function edit_slider($slider_id){
    $resto_user_id = $this->session->userdata('resto_user_id');
    $resto_company_id = $this->session->userdata('resto_company_id');
    $resto_role_id = $this->session->userdata('resto_role_id');
    if($resto_user_id == '' && $resto_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('slider_name', 'role title', 'trim|required');
    
    
    $this->load->view('Admin/Include/head');
    $this->load->view('Admin/Include/navbar');
    $this->load->view('Admin/Master/slider');
    $this->load->view('Admin/Include/footer');
  }

  // Delete Slider...
  public function delete_slider($slider_id){
    $resto_user_id = $this->session->userdata('resto_user_id');
    $resto_company_id = $this->session->userdata('resto_company_id');
    $resto_role_id = $this->session->userdata('resto_role_id');
    if($resto_user_id == '' && $resto_company_id == ''){ header('location:'.base_url().'User'); }
    $this->Master_Model->delete_info('slider_id', $role_id, 'rest_role');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Master/slider');
  }


  /********************************* Test Group Information ***********************************/

  // Add Test Group...
  public function test_group(){
    $resto_user_id = $this->session->userdata('resto_user_id');
    $resto_company_id = $this->session->userdata('resto_company_id');
    $resto_role_id = $this->session->userdata('resto_role_id');
    if($resto_user_id == '' && $resto_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('test_group_name', 'test_group Name', 'trim|required');
    
      $data['page'] = 'Test Group';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Master/test_group', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit Test Group...
  public function edit_test_group($test_group_id){
    $resto_user_id = $this->session->userdata('resto_user_id');
    $resto_company_id = $this->session->userdata('resto_company_id');
    $resto_role_id = $this->session->userdata('resto_role_id');
    if($resto_user_id == '' && $resto_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('test_group_name', 'role title', 'trim|required');
    
    
    $this->load->view('Admin/Include/head');
    $this->load->view('Admin/Include/navbar');
    $this->load->view('Admin/Master/test_group');
    $this->load->view('Admin/Include/footer');
  }

  // Delete Test Group...
  public function delete_test_group($test_group_id){
    $resto_user_id = $this->session->userdata('resto_user_id');
    $resto_company_id = $this->session->userdata('resto_company_id');
    $resto_role_id = $this->session->userdata('resto_role_id');
    if($resto_user_id == '' && $resto_company_id == ''){ header('location:'.base_url().'User'); }
    $this->Master_Model->delete_info('test_group_id', $role_id, 'rest_role');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Master/test_group');
  }


  /********************************* Test  Information ***********************************/

  // Add Test ...
  public function test(){
    $resto_user_id = $this->session->userdata('resto_user_id');
    $resto_company_id = $this->session->userdata('resto_company_id');
    $resto_role_id = $this->session->userdata('resto_role_id');
    if($resto_user_id == '' && $resto_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('test_name', 'test Name', 'trim|required');
    
      $data['page'] = 'Test';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Master/test', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit Test ...
  public function edit_test($test_id){
    $resto_user_id = $this->session->userdata('resto_user_id');
    $resto_company_id = $this->session->userdata('resto_company_id');
    $resto_role_id = $this->session->userdata('resto_role_id');
    if($resto_user_id == '' && $resto_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('test_name', 'role title', 'trim|required');
    
    
    $this->load->view('Admin/Include/head');
    $this->load->view('Admin/Include/navbar');
    $this->load->view('Admin/Master/test');
    $this->load->view('Admin/Include/footer');
  }

  // Delete Test ...
  public function delete_test($test_id){
    $resto_user_id = $this->session->userdata('resto_user_id');
    $resto_company_id = $this->session->userdata('resto_company_id');
    $resto_role_id = $this->session->userdata('resto_role_id');
    if($resto_user_id == '' && $resto_company_id == ''){ header('location:'.base_url().'User'); }
    $this->Master_Model->delete_info('test_id', $role_id, 'rest_role');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Master/test');
  }

  /********************************* Medicine  Information ***********************************/

  // Add Medicine ...
  public function medicine(){
    $resto_user_id = $this->session->userdata('resto_user_id');
    $resto_company_id = $this->session->userdata('resto_company_id');
    $resto_role_id = $this->session->userdata('resto_role_id');
    if($resto_user_id == '' && $resto_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('medicine_name', 'medicine Name', 'trim|required');
    
      $data['page'] = 'Medicine';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/Master/medicine', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit Medicine ...
  public function edit_medicine($medicine_id){
    $resto_user_id = $this->session->userdata('resto_user_id');
    $resto_company_id = $this->session->userdata('resto_company_id');
    $resto_role_id = $this->session->userdata('resto_role_id');
    if($resto_user_id == '' && $resto_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('medicine_name', 'role title', 'trim|required');
    
    
    $this->load->view('Admin/Include/head');
    $this->load->view('Admin/Include/navbar');
    $this->load->view('Admin/Master/medicine');
    $this->load->view('Admin/Include/footer');
  }

  // Delete Medicine ...
  public function delete_medicine($medicine_id){
    $resto_user_id = $this->session->userdata('resto_user_id');
    $resto_company_id = $this->session->userdata('resto_company_id');
    $resto_role_id = $this->session->userdata('resto_role_id');
    if($resto_user_id == '' && $resto_company_id == ''){ header('location:'.base_url().'User'); }
    $this->Master_Model->delete_info('medicine_id', $role_id, 'rest_role');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Master/medicine');
  }

}
?>
