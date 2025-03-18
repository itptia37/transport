<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	
	public function __construct(){
	parent::__construct();
	
		$this->load->model('M_Login');
		
	}
	
	public function index()
	{
		$data = array(
			'set_menu' => '<li class="breadcrumb-item active" aria-current="page"><a href="#">Login</a></li>',
			'set_submenu' => ''
			);
		
		$this->load->view('login',$data);
	}
	
	public function Login_Validate()
	{
				
		$email			= $this->input->post('input_email');
		$password 		= $this->input->post('input_password');
		
		if($email == '' || $password == '' ){
			
			$this->session->set_userdata('notif_login','Access Denied');			
			
			redirect(base_url());
			
		}else{
			
				$get_query = $this->M_Login->M_Login_Validate($email,$password);
				
				$get_num = $get_query->num_rows();
				
				if($get_num <= 0){
					
					$this->session->set_userdata('notif_login','Access Denied');

					redirect(base_url());
				
				} elseif($get_num > 0){
					
					$get_data = $get_query->row();
				
					$data_session = array(
						'id_tr' => enid_get($get_data->id_login),
						'email_tr' => $get_data->email,
						'name_tr' => $get_data->username,
						'access_tr' => $get_data->access
						);
						
					$this->session->set_userdata($data_session);
					
					$this->session->unset_userdata('notif_login');
					
						$data_log = array(
						'id_login' => (int)$get_data->id_login,
						'id_aplication' => (int)$this->session->userdata('set_application'),
						'action' => 'Login',
						'activity_time' => my_date_time()
						);				
						$this->M_Global->M_Save('audit_trail_public.activity_user',$data_log);
					
					redirect(base_url());
					
				}
			
			
			
			
			
		}
	}

}
