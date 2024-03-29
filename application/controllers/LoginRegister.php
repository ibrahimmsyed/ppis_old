<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginRegister extends CI_Controller{
 function __construct()
  {
   parent::__construct();
    $this->load->helper(array('form', 'url'));
  }
 function index($msg = NULL)
 {

  $this->template
        ->title('Login','Login Page')      
        ->set_layout('access')
        ->build('access/login');

  $data['msg'] = $msg;
  $data['is_logged'] = false;
  $data['_content'] = 'login_form';

  

  //$this->load->view('includes/template', $data); 
 } 
 function validate_credentials()
 {  
  $this->load->model('membership_model'); 
  $query = $this->membership_model->validate();
  if($query) // if the user's credentials validated...
  {
   $data = array(
    'EmployeeID' => $this->input->post('EmployeeID'),
    'is_logged_in' => true
   );
   $this->session->set_userdata($data);
   redirect('/Dashboard/Dashboard');
  }
  else // incorrect username or password
  {
   $msg = '<p class=error>Invalid username and/or password.</p>';
            $this->index($msg);
  }  

 }
  function signup()
 {
  $data['main_content'] = 'signup_form';
  $this->load->view('includes/template', $data);
 }
  function logged_in_area()
 {
  $data['main_content'] = 'logged_in_area';
  $this->load->view('includes/template', $data);
 }
 function create_member()
 {
  $this->load->library('form_validation');

  
  // field name, error message, validation rules
  $this->form_validation->set_rules('Firstname', 'Name', 'trim|required');
  $this->form_validation->set_rules('Lastname', 'Last Name', 'trim|required');
  $this->form_validation->set_rules('EmailID', 'Email Address', 'trim|required|valid_email');
  $this->form_validation->set_rules('EmployeeID', 'Username', 'trim|required|min_length[4]');
  $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
  $this->form_validation->set_rules('password2', 'Password Confirmation', 'trim|required|matches[password]');
   
  if($this->form_validation->run() == FALSE)
  {
   $this->load->view('signup_form');
  }
  else
  {   
   $this->load->model('membership_model');
    
   if($query = $this->membership_model->create_member())
   {
    $data['main_content'] = 'signup_successful';
    $this->load->view('includes/template', $data);
   }
   else
   {
    $this->load->view('signup_form');   
   }
  }
 
   
 }
  function logout()
 {
  $this->session->sess_destroy();
  $this->index();
 }
}
