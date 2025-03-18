<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_Control extends CI_Controller {

	Public function __construct(){
	parent::__construct();
		$this->load->model('M_Login');
	}

	public function index()
	{
		$data_set = array(
			'set_web' => 'Transport Request',
			'set_application' => 15,
			'set_external' => 1,
			'set_delivery_status' => 2,
			'set_email_receiver' => 3,
			'set_request_option_driver' => 4,
			'set_request_option_courier' => 5,
			'set_expense_purpose' => 6,
			'set_expense_type' => 7,			
			'set_user_access' => 8,
			'set_car' => 9,
			'set_company' => 10,
			'set_company_default' => enid_get(60)
			);
				
			$this->session->set_userdata($data_set);
		
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
			
			
		$this->load->view('set_main',$data);
		
	}
	
	
	public function ToneNew()
	{	
		echo'<audio autoplay>
		<source src="'.base_url().'assets/tones/to-the-point.mp3" type="audio/mpeg">
		</audio>';
	}
	
	public function Get_Request()
	{
		if($this->session->userdata('access_tr') == 25){//middle
			
			$num_driver = $this->M_Global->M_Get_Request('driver')->num_rows();
			
			$num_courier = $this->M_Global->M_Get_Request('courier')->num_rows();
			
			if(($num_driver+$num_courier) <= 0){
				
				echo'none';
			
			}elseif(($num_driver+$num_courier) > 0){
			
	
				echo'<div class="request-notification" style="text-align:left; padding-left:5px;">';
				
				if($num_driver > 0){
					
					$result_data = $this->M_Global->M_Get_Tone('driver')->result();
					
					foreach($result_data as $rd){
						
						$this->ToneNew();
						
					}
					
					$data = array('tone' => 1);
					$target = array('tone' => 0,'status' => 1);
					$table = 'transport_request.request_driver';	
					$this->M_Global->M_Update($table,$data,$target);
					
					echo'<div style="margin-top:5px;" class="btn btn-info notification-item" onclick="SubmenuSelect(&#39;Request_Driver&#39;,&#39;Request_Driver/index&#39;)">';
					echo'New Request Driver <span class="btn btn-primary btn-sm">'.$num_driver.'</span>';
					echo'</div><br>';
				}
				if($num_courier > 0){
					
					$result_data = $this->M_Global->M_Get_Tone('courier')->result();
					
					foreach($result_data as $rd){
						
						$this->ToneNew();
						
					}
					
					$data = array('tone' => 1);
					$target = array('tone' => 0,'status' => 1);
					$table = 'transport_request.request_courier';	
					$this->M_Global->M_Update($table,$data,$target);
					
					echo'<div style="margin-top:5px;" class="btn btn-info notification-item" onclick="SubmenuSelect(&#39;Request_Courier&#39;,&#39;Request_Courier/index&#39;)">';
					echo'New Request Courier <span class="btn btn-primary btn-sm">'.$num_courier.'</span>';
					echo'</div>';
				}
				
				echo'</div>';
				
				
			
			}
		}else{
			
			echo'none';
			
		}
	}
	
	
	public function Search_List_Project()
	{						
		if($this->session->userdata('id_tr') == ''){
			
			$this->M_Global->M_Logout();
			
		}else{
		
			$src = string_src($this->input->post('input_src_list'));			
			$query = $this->M_Global->M_Search_List_Project($src)->result();
			
			foreach($query as $data){
				echo'<li><a href="#" 
				onclick="ListDataSelect(
				&#39;my-list-box-project_number&#39;,
				&#39;input_project_number&#39;,
				&#39;'.($data->project_no).'&#39;,
				&#39;input_project_number_name&#39;,
				&#39;'.$data->project_no.'&#39;
				)">'.$data->project_no.'</li>';
			}
			
		}
	}	
	
/* end */
}
