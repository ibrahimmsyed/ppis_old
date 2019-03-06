<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Template{ 
    protected $_ci; 
    function __construct(){ 
        $this->_ci=&get_instance();
    }
    function display($data=null){
        $data['_content']=$this->_ci->load->view('includes/content',$data,true);
        $data['_header']=$this->_ci->load->view('includes/header',$data,true);
        $data['_sidebar']=$this->_ci->load->view('includes/sidebar',$data,true);
        $data['_footer']=$this->_ci->load->view('includes/footer',$data,true);
        $this->_ci->load->view('includes/template.php',$data);
    }
}