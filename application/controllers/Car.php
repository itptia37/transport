<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Car extends CI_Controller {

	Public function __construct(){
	parent::__construct();
		
		$this->load->model('M_Parameter');	
		
	}
	
	public function Error_404()
	{
		echo myalert('danger','Sorry something wrong');
	}

	public function index()
	{
		if($this->session->userdata('id_tr') == ''){
			
			$this->M_Global->M_Logout();
			
		}else{
		
			$this->session->unset_userdata('page_cr');
			$this->session->unset_userdata('next_cr');
			$this->session->unset_userdata('src_cr');
		
			$this->session->set_userdata('fild_a_cr',0);
			$this->session->set_userdata('fild_b_cr',0);
			$this->session->set_userdata('fild_c_cr',0);
			$this->session->set_userdata('fild_d_cr',0);
	
			$data['set_menu'] = '<li class="breadcrumb-item" aria-current="page">Setup</li>';
			$data['set_submenu'] = '<li class="breadcrumb-item" aria-current="page">Car Data</li>';
			$data['set_action'] = '';
			
			/* pagging */
			$myrow	= ($this->session->userdata('myrow_cr')) ? $this->session->userdata('myrow_cr'):25;
			$page	= ($this->session->userdata('page_cr')) ? $this->session->userdata('page_cr'):1;
			$next	= ($this->session->userdata('next_cr')) ? $this->session->userdata('next_cr'):1;
			$start 	= $myrow * ($page-1);
			
			/* src */
			$src		= ($this->session->userdata('src_cr')) ? $this->session->userdata('src_cr'):''; 
			
			/* oreder */
			$fild_a		= ($this->session->userdata('fild_a_cr')) ? $this->session->userdata('fild_a_cr'):0;
			$order_a	= ($this->session->userdata('order_a_cr')) ? $this->session->userdata('order_a_cr'):'ASC';
			$fild_b		= ($this->session->userdata('fild_b_cr')) ? $this->session->userdata('fild_b_cr'):0;
			$order_b	= ($this->session->userdata('order_b_cr')) ? $this->session->userdata('order_b_cr'):'ASC';
			$fild_c		= ($this->session->userdata('fild_c_cr')) ? $this->session->userdata('fild_c_cr'):0;
			$order_c	= ($this->session->userdata('order_c_cr')) ? $this->session->userdata('order_c_cr'):'ASC';
			$fild_d		= ($this->session->userdata('fild_d_cr')) ? $this->session->userdata('fild_d_cr'):0;
			$order_d	= ($this->session->userdata('order_d_cr')) ? $this->session->userdata('order_d_cr'):'ASC';
			
			$filter=array(
			'myrow' => $myrow,
			'page' => $page,
			'next' => $next,
			'start' => $start,
			'src' => $src,
			'fild_a' => $fild_a,
			'order_a' => $order_a,
			'fild_b' => $fild_b,
			'order_b' => $order_b,
			'fild_c' => $fild_c,
			'order_c' => $order_c,
			'fild_d' => $fild_d,
			'order_d' => $order_d
			);
			
			$category				= $this->session->userdata('set_car');
			$data['num_data']		= $this->M_Parameter->M_ParameterNumRow($filter,$category)->num_rows();
			$data['result_data']	= $this->M_Parameter->M_ParameterData($filter,$category)->result();
			
			/* pagging */
			$data['max']			= (ceil($data['num_data']/$myrow)); 
			$data['myrow'] 			= $myrow; 
			$data['page'] 			= $page;
			$data['next'] 			= $next;		
			$data['start'] 			= $start;
			$data['controller']		= 'Car';
			
			/* src */
			$data['src'] 			= $src; 
			
			/* oreder */
			$data['fild_a'] 		= $fild_a; 
			$data['order_a']		= $order_a; 
			$data['fild_b'] 		= $fild_b;
			$data['order_b']		= $order_b;	
			$data['fild_c'] 		= $fild_c;
			$data['order_c']		= $order_c;	
			$data['fild_d'] 		= $fild_d;
			$data['order_d']		= $order_d;	
		
		$this->load->view('car',$data);
		
		}
	}

	public function Data_Table()
	{
		if($this->session->userdata('id_tr') == ''){
			
			$this->M_Global->M_Logout();
			
		}else{
			
			/* pagging */
			$myrow	= ($this->session->userdata('myrow_cr')) ? $this->session->userdata('myrow_cr'):25;
			$page	= ($this->session->userdata('page_cr')) ? $this->session->userdata('page_cr'):1;
			$next	= ($this->session->userdata('next_cr')) ? $this->session->userdata('next_cr'):1;
			$start 	= $myrow * ($page-1);
			
			/* src */
			$src		= ($this->session->userdata('src_cr')) ? $this->session->userdata('src_cr'):''; 
			
			/* oreder */
			$fild_a		= ($this->session->userdata('fild_a_cr')) ? $this->session->userdata('fild_a_cr'):0;
			$order_a	= ($this->session->userdata('order_a_cr')) ? $this->session->userdata('order_a_cr'):'ASC';
			$fild_b		= ($this->session->userdata('fild_b_cr')) ? $this->session->userdata('fild_b_cr'):0;
			$order_b	= ($this->session->userdata('order_b_cr')) ? $this->session->userdata('order_b_cr'):'ASC';
			$fild_c		= ($this->session->userdata('fild_c_cr')) ? $this->session->userdata('fild_c_cr'):0;
			$order_c	= ($this->session->userdata('order_c_cr')) ? $this->session->userdata('order_c_cr'):'ASC';
			$fild_d		= ($this->session->userdata('fild_d_cr')) ? $this->session->userdata('fild_d_cr'):0;
			$order_d	= ($this->session->userdata('order_d_cr')) ? $this->session->userdata('order_d_cr'):'ASC';
			
			$filter=array(
			'myrow' => $myrow,
			'page' => $page,
			'next' => $next,
			'start' => $start,
			'src' => $src,
			'fild_a' => $fild_a,
			'order_a' => $order_a,
			'fild_b' => $fild_b,
			'order_b' => $order_b,
			'fild_c' => $fild_c,
			'order_c' => $order_c,
			'fild_d' => $fild_d,
			'order_d' => $order_d
			);
			
			$category				= $this->session->userdata('set_car');
			$data['num_data']		= $this->M_Parameter->M_ParameterNumRow($filter,$category)->num_rows();
			$data['result_data']	= $this->M_Parameter->M_ParameterData($filter,$category)->result();
			
			/* pagging */
			$data['max']			= (ceil($data['num_data']/$myrow)); 
			$data['myrow'] 			= $myrow; 
			$data['page'] 			= $page;
			$data['next'] 			= $next;		
			$data['start'] 			= $start;
			$data['controller']		= 'Car';
			
			/* src */
			$data['src'] 			= $src; 
			
			/* oreder */
			$data['fild_a'] 		= $fild_a; 
			$data['order_a']		= $order_a; 
			$data['fild_b'] 		= $fild_b;
			$data['order_b']		= $order_b;		
			$data['fild_c'] 		= $fild_c;
			$data['order_c']		= $order_c;	
			$data['fild_d'] 		= $fild_d;
			$data['order_d']		= $order_d;	
		
		$this->load->view('car_data',$data);
		
		}
	}
	
	
	public function Order_a_asc()
	{						
			$this->session->set_userdata('fild_a_cr',1);
			$this->session->set_userdata('fild_b_cr',0);
			$this->session->set_userdata('fild_c_cr',0);
			$this->session->set_userdata('fild_d_cr',0);
			$this->session->set_userdata('order_a_cr','ASC');
			
			$this->Data_Table();
	}	

	public function Order_a_desc()
	{						
			$this->session->set_userdata('fild_a_cr',1);
			$this->session->set_userdata('fild_b_cr',0);
			$this->session->set_userdata('fild_c_cr',0);
			$this->session->set_userdata('fild_d_cr',0);
			$this->session->set_userdata('order_a_cr','DESC');
			
			$this->Data_Table();
	}
	
	public function Order_b_asc()
	{						
			$this->session->set_userdata('fild_a_cr',0);
			$this->session->set_userdata('fild_b_cr',1);
			$this->session->set_userdata('fild_c_cr',0);
			$this->session->set_userdata('fild_d_cr',0);
			$this->session->set_userdata('order_b_cr','ASC');
			
			$this->Data_Table();
	}	

	public function Order_b_desc()
	{						
			$this->session->set_userdata('fild_a_cr',0);
			$this->session->set_userdata('fild_b_cr',1);
			$this->session->set_userdata('fild_c_cr',0);
			$this->session->set_userdata('fild_d_cr',0);
			$this->session->set_userdata('order_b_cr','DESC');
			
			$this->Data_Table();
	}

	public function Order_c_asc()
	{						
			$this->session->set_userdata('fild_a_cr',0);
			$this->session->set_userdata('fild_b_cr',0);
			$this->session->set_userdata('fild_c_cr',1);
			$this->session->set_userdata('fild_d_cr',0);
			$this->session->set_userdata('order_c_cr','ASC');
			
			$this->Data_Table();
	}	

	public function Order_c_desc()
	{						
			$this->session->set_userdata('fild_a_cr',0);
			$this->session->set_userdata('fild_b_cr',0);
			$this->session->set_userdata('fild_c_cr',1);
			$this->session->set_userdata('fild_d_cr',0);
			$this->session->set_userdata('order_c_cr','DESC');
			
			$this->Data_Table();
	}

	public function Order_d_asc()
	{						
			$this->session->set_userdata('fild_a_cr',0);
			$this->session->set_userdata('fild_b_cr',0);
			$this->session->set_userdata('fild_c_cr',0);
			$this->session->set_userdata('fild_d_cr',1);
			$this->session->set_userdata('order_d_cr','ASC');
			
			$this->Data_Table();
	}	

	public function Order_d_desc()
	{						
			$this->session->set_userdata('fild_a_cr',0);
			$this->session->set_userdata('fild_b_cr',0);
			$this->session->set_userdata('fild_c_cr',0);
			$this->session->set_userdata('fild_d_cr',1);
			$this->session->set_userdata('order_d_cr','DESC');
			
			$this->Data_Table();
	}
	
	public function Rows($val)
	{
			$this->session->unset_userdata('page_cr');
			$this->session->unset_userdata('next_cr');
			$this->session->set_userdata('myrow_cr',$val);		
			$this->Data_Table();
		
	}
	
	public function Search()
	{						
			$this->session->unset_userdata('page_cr');
			$this->session->unset_userdata('next_cr');
			
			$src = string_src($this->input->post('input_src'));			
			
			$this->session->set_userdata('src_cr',$src);
			
			$this->Data_Table();
	}
	
	public function Page()
	{
	
			$page	= ($this->uri->segment('3')) ? $this->uri->segment('3'):1; 
			$next 	= ($this->uri->segment('4')) ? $this->uri->segment('4'):1; 
			
			$this->session->set_userdata('page_cr',$page);
			$this->session->set_userdata('next_cr',$next);
			
			$this->Data_Table();

	}
	
	public function Form($act,$target)
	{		
		if($this->session->userdata('id_tr') == ''){
			
			$this->M_Global->M_Logout();
			
		}else{
		
			if($act == 'Add' || desid_get($target) == 0){
				
				$data = array(
					'action' => 'Add',
					'target' => '',
					'car_name' => '',
					'creater' => '',
					'creater_email' => '',
					'created_date' => '',
					'updater' => '',
					'updater_email' => '',
					'updated_date' => ''
					);
				
				$this->load->view('car_form',$data);
				
			}elseif($act == 'Edit' && desid_get($target) > 0){
				
				$category	= $this->session->userdata('set_car');
				$get 		= $this->M_Parameter->M_Parameter_Detail(desid_get($target),$category)->row();
				
				$data = array(
					'action' => 'Edit',
					'target' => $target,
					'car_name' => xxs_filter($get->name),
					'creater' => xxs_filter($get->creater),
					'creater_email' => '',
					'created_date' => date_time_ind_full($get->created_date),
					'updater' => xxs_filter($get->updater),
					'updater_email' => '',
					'updated_date' => date_time_ind_full($get->updated_date)
					);
					
				$this->load->view('car_form',$data);
			
			}else{
			
				$this->Error_404();
			
			}
		
		}
	}
	
	public function Save()
	{
		if($this->session->userdata('id_tr') == ''){
			
			$this->M_Global->M_Logout();
			
		}else{
		
		$id_car 	= (int)desid_get($this->input->post('input_target'));
		$car_name	= $this->input->post('input_car_name');
		
		$iduser		= (int)desid_get($this->session->userdata('id_tr'));
		$date		= my_date_time();
		$table		= 'transport_request.parameter';
		
		if($id_car <= 0){
			
			$data = array(
				'id_parameter_category' => $this->session->userdata('set_car'),
				'name' => $car_name,
				'status' => 1,
				'created_by' => $iduser,
				'created_date' => $date
				);
				
			$trans_status = $this->M_Global->M_Save($table,$data);
			
			if($trans_status === TRUE){
				
				echo myalert('success','Data has been saved');
				
				
				$new_idtarget = $this->M_Global->M_CheckId('id_parameter',$table)->row();
				$this->Form('Edit',enid_get($new_idtarget->id_parameter));
			
			}else{
				
				echo myalert('danger','Proccess failed');
				
				$this->Form('Add',enid_get(0));
			
			}
			
		}
		elseif($id_car > 0){
			
			$data = array(
				'name' => $car_name,
				'updated_by' => $iduser,
				'updated_date' => $date				
				);
				
			$target = array('id_parameter' => $id_car);
			
			$trans_status = $this->M_Global->M_Update($table,$data,$target);
			
			if($trans_status === TRUE){
				
				echo myalert('success','Data has been saved');
		
				$this->Form('Edit',enid_get($id_car));
			
			}else{
			
				echo myalert('danger','Proccess failed');
				
				$this->Form('Edit',enid_get($id_car));
				
			}
			
		} else {
		
			echo myalert('danger','Proccess failed');
			
			$this->Form('Add',enid_get(0));
			
			}
		
		}
	}
	
	/*
	public function Delete()
	{
		if($this->session->userdata('id_tr') == ''){
			
			$this->M_Global->M_Logout();
			
		}else{
		
			$index = (int)desid_get($this->input->post('input_index'));
			
			$table  = 'transport_request.car';
			$target = array('id_car' => $index);
			$trans_status = $this->M_Global->M_Delete($table,$target);
			
			if($trans_status === TRUE){
				
				echo 'Data has been deleted';
				
			} else {
				
				echo 'Proccess failed';
				
			}
		
		}
	}
	*/
	
	public function Status()
	{
		if($this->session->userdata('id_tr') == ''){
			
			$this->M_Global->M_Logout();
			
		}else{

			$index 	= (int)desid_get($this->input->post('input_index'));
			$status = (int)$this->input->post('input_status');
			$iduser	= (int)desid_get($this->session->userdata('id_tr'));
			$date	= my_date_time();
			$table	= 'transport_request.parameter';
			
			$data = array(
				'status' => $status,
				'updated_by' => $iduser,
				'updated_date' => $date				
				);
			
			$target = array('id_parameter' => $index);
			
			$trans_status = $this->M_Global->M_Update($table,$data,$target);
			
			
			if($trans_status === TRUE){
				
				echo 'Status has been changed';
				
			} else {
				
				echo 'Proccess failed';
				
			}
			
		}
	}	
	

/* end */	
}
