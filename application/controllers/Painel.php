<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Painel extends CI_Controller {
	
	
	function __construct()
	{
		
		parent::__construct();
		
		date_default_timezone_set('America/Sao_Paulo');
		
		if(!$this->session->userdata('log_in'))
		{
				
			redirect(base_url(), 'refresh');
				
		}
		
	}
	
	
	public function index(){
		
		date_default_timezone_set('America/Sao_Paulo');
		
		$this->load->view('include/header');
		$this->load->view('painel');
		$this->load->view('include/footer');
		
	}
	
	
	
	
	
	
	
	
	
}