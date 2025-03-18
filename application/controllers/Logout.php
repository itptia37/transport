<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {
	Public function __construct(){
	parent::__construct();

	}
	
	public function index()
	{
		if($this->session->userdata('id_tr') != ''){
			$data_log = array(
				'id_login' => (int)desid_get($this->session->userdata('id_tr')),
				'id_aplication' => (int)$this->session->userdata('set_application'),
				'action' => 'Logout',
				'activity_time' => my_date_time()
			);				
			$this->M_Global->M_Save('audit_trail_public.activity_user',$data_log);
		}
		
		$this->session->unset_userdata('id_tr');
		$this->session->unset_userdata('email_tr');
		$this->session->unset_userdata('name_tr');
		$this->session->unset_userdata('access_tr');	
		redirect(base_url());	
	}
}
