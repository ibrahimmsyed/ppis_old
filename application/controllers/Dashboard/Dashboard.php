<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	function __construct()
	{
	parent::__construct();
		$this->load->library('template');
		$this->load->helper('url');
	}
	
	public function index()
	{
		// print_r($this->session->userdata['is_logged_in']);
		// $data=$this->template->display();
		// $data['is_logged'] = true;
		// $this->load->view('includes/template', $data);

		$this->template
				->title('Dashboard','My App')
				->build('dashboard/index');
	}
}
