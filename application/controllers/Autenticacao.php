<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Autenticacao extends CI_Controller {
	
	function __construct()
	{
	
		parent::__construct();
		
		date_default_timezone_set('America/Sao_Paulo');
	
		if(!$this->session->userdata('log_in'))
		{
	
			redirect(base_url(), 'refresh');
	
		}
	
	}
	
	public function index()
	{
		
		$this->load->view('include/autentica');
		$this->load->view('include/footer');	
		
	}
	
}