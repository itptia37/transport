<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct(){
	parent::__construct();
		$this->load->model('M_Global');
	}
	
	public function index()
	{
		
		$data = array(
		'set_menu' => '<li class="breadcrumb-item active" aria-current="page"><a href="#">Home</a></li>',
		'set_submenu' => ''
		);
		
		
			$data['num_request_driver'] = $this->M_Global->M_Get_Request_Home('driver')->num_rows();
			$data['num_request_courier'] = $this->M_Global->M_Get_Request_Home('courier')->num_rows();
		
			$data['request_driver'] = $this->M_Global->M_Get_Request_Home('driver')->result();
			$data['request_courier'] = $this->M_Global->M_Get_Request_Home('courier')->result();
			
			$data['num_standby_driver'] = $this->M_Global->M_Get_Standby_Home('driver')->num_rows();
			$data['num_standby_courier'] = $this->M_Global->M_Get_Standby_Home('courier')->num_rows();
			
			$data['standby_driver'] = $this->M_Global->M_Get_Standby_Home('driver')->result();
			$data['standby_courier'] = $this->M_Global->M_Get_Standby_Home('courier')->result();
		
		$this->load->view('home',$data);
	}
}
