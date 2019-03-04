<?php
class Membership_model extends CI_Model {
 function validate()
 {
	 
  $this->db->where('EmployeeID', $this->input->post('EmployeeID')); 
  $this->db->where('password', md5($this->input->post('password'))); 
  $query = $this->db->get('signup'); 

  $totalfound = $query->num_rows();
  echo $totalfound;
  if($totalfound == 1)
  {
   return true;
  } 
 }
 function create_member()
 {
  $new_member_insert_data = array(
   'Firstname' => $this->input->post('Firstname'),
   'Lastname' => $this->input->post('Lastname'),
   'EmailID' => $this->input->post('EmailID'),   
   'EmployeeID' => $this->input->post('EmployeeID'),
   'password' => md5($this->input->post('password'))      
  );

   
  $insert = $this->db->insert('signup', $new_member_insert_data);
  return $insert;
 } 

}