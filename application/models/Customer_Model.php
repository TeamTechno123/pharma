<?php
class Customer_Model extends CI_Model{

  function check_login($mobile, $password){
    $this->db->select('*');
    $this->db->where('customer_mobile', $mobile);
    $this->db->where('customer_password', $password);
    $this->db->where('customer_status', '1');
    $this->db->from('smm_customer');
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
  }

  // public function user_list($company_id){
  //   $this->db->select('*');
  //   $this->db->where('is_admin', 0);
  //   if($company_id != ''){
  //     $this->db->where('company_id', $company_id);
  //   }
  //   $this->db->from('user');
  //   $query = $this->db->get();
  //   $result = $query->result();
  //   return $result;
  // }



}
?>
