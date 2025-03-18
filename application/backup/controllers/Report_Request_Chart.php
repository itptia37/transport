<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_Request_Chart extends CI_Controller {
	
	public function __construct(){
	parent::__construct();
	
		$this->load->model('M_Report_Request_Chart');
	}
	

	public function index()
	{ 
		
		if($this->session->userdata('id_tr')!=''){
		
		$this->load->view('report_req_chart');	
		
		}else{$this->M_logout->index();}
	}
	

/* end */
}