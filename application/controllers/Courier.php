<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Courier extends CI_Controller {

	Public function __construct(){
	parent::__construct();
		
		$this->load->model('M_Courier');	
		
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
		
			$this->session->unset_userdata('page_crr');
			$this->session->unset_userdata('next_crr');
			$this->session->unset_userdata('src_crr');
		
			$this->session->set_userdata('fild_a_crr',0);
			$this->session->set_userdata('fild_b_crr',0);
			$this->session->set_userdata('fild_c_crr',0);
			$this->session->set_userdata('fild_d_crr',0);
	
			$data['set_menu'] = '<li class="breadcrumb-item" aria-current="page">Setup</li>';
			$data['set_submenu'] = '<li class="breadcrumb-item" aria-current="page">Courier Data</li>';
			$data['set_action'] = '';
			
			/* pagging */
			$myrow	= ($this->session->userdata('myrow_crr')) ? $this->session->userdata('myrow_crr'):25;
			$page	= ($this->session->userdata('page_crr')) ? $this->session->userdata('page_crr'):1;
			$next	= ($this->session->userdata('next_crr')) ? $this->session->userdata('next_crr'):1;
			$start 	= $myrow * ($page-1);
			
			/* src */
			$src		= ($this->session->userdata('src_crr')) ? $this->session->userdata('src_crr'):''; 
			
			/* oreder */
			$fild_a		= ($this->session->userdata('fild_a_crr')) ? $this->session->userdata('fild_a_crr'):0;
			$order_a	= ($this->session->userdata('order_a_crr')) ? $this->session->userdata('order_a_crr'):'ASC';
			$fild_b		= ($this->session->userdata('fild_b_crr')) ? $this->session->userdata('fild_b_crr'):0;
			$order_b	= ($this->session->userdata('order_b_crr')) ? $this->session->userdata('order_b_crr'):'ASC';
			$fild_c		= ($this->session->userdata('fild_c_crr')) ? $this->session->userdata('fild_c_crr'):0;
			$order_c	= ($this->session->userdata('order_c_crr')) ? $this->session->userdata('order_c_crr'):'ASC';
			$fild_d		= ($this->session->userdata('fild_d_crr')) ? $this->session->userdata('fild_d_crr'):0;
			$order_d	= ($this->session->userdata('order_d_crr')) ? $this->session->userdata('order_d_crr'):'ASC';
			
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
			
			$data['num_data']		= $this->M_Courier->M_CourierNumRow($filter)->num_rows();
			$data['result_data']	= $this->M_Courier->M_CourierData($filter)->result();
			
			/* pagging */
			$data['max']			= (ceil($data['num_data']/$myrow)); 
			$data['myrow'] 			= $myrow; 
			$data['page'] 			= $page;
			$data['next'] 			= $next;		
			$data['start'] 			= $start;
			$data['controller']		= 'Courier';
			
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
		
		$this->load->view('courier',$data);
		
		}
	}

	public function Data_Table()
	{
		if($this->session->userdata('id_tr') == ''){
			
			$this->M_Global->M_Logout();
			
		}else{
			
			/* pagging */
			$myrow	= ($this->session->userdata('myrow_crr')) ? $this->session->userdata('myrow_crr'):25;
			$page	= ($this->session->userdata('page_crr')) ? $this->session->userdata('page_crr'):1;
			$next	= ($this->session->userdata('next_crr')) ? $this->session->userdata('next_crr'):1;
			$start 	= $myrow * ($page-1);
			
			/* src */
			$src		= ($this->session->userdata('src_crr')) ? $this->session->userdata('src_crr'):''; 
			
			/* oreder */
			$fild_a		= ($this->session->userdata('fild_a_crr')) ? $this->session->userdata('fild_a_crr'):0;
			$order_a	= ($this->session->userdata('order_a_crr')) ? $this->session->userdata('order_a_crr'):'ASC';
			$fild_b		= ($this->session->userdata('fild_b_crr')) ? $this->session->userdata('fild_b_crr'):0;
			$order_b	= ($this->session->userdata('order_b_crr')) ? $this->session->userdata('order_b_crr'):'ASC';
			$fild_c		= ($this->session->userdata('fild_c_crr')) ? $this->session->userdata('fild_c_crr'):0;
			$order_c	= ($this->session->userdata('order_c_crr')) ? $this->session->userdata('order_c_crr'):'ASC';
			$fild_d		= ($this->session->userdata('fild_d_crr')) ? $this->session->userdata('fild_d_crr'):0;
			$order_d	= ($this->session->userdata('order_d_crr')) ? $this->session->userdata('order_d_crr'):'ASC';
			
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
			
			$data['num_data']		= $this->M_Courier->M_CourierNumRow($filter)->num_rows();
			$data['result_data']	= $this->M_Courier->M_CourierData($filter)->result();
			
			/* pagging */
			$data['max']			= (ceil($data['num_data']/$myrow)); 
			$data['myrow'] 			= $myrow; 
			$data['page'] 			= $page;
			$data['next'] 			= $next;		
			$data['start'] 			= $start;
			$data['controller']		= 'Courier';
			
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
		
		$this->load->view('courier_data',$data);
		
		}
	}
	
	
	public function Order_a_asc()
	{						
			$this->session->set_userdata('fild_a_crr',1);
			$this->session->set_userdata('fild_b_crr',0);
			$this->session->set_userdata('fild_c_crr',0);
			$this->session->set_userdata('fild_d_crr',0);
			$this->session->set_userdata('order_a_crr','ASC');
			
			$this->Data_Table();
	}	

	public function Order_a_desc()
	{						
			$this->session->set_userdata('fild_a_crr',1);
			$this->session->set_userdata('fild_b_crr',0);
			$this->session->set_userdata('fild_c_crr',0);
			$this->session->set_userdata('fild_d_crr',0);
			$this->session->set_userdata('order_a_crr','DESC');
			
			$this->Data_Table();
	}
	
	public function Order_b_asc()
	{						
			$this->session->set_userdata('fild_a_crr',0);
			$this->session->set_userdata('fild_b_crr',1);
			$this->session->set_userdata('fild_c_crr',0);
			$this->session->set_userdata('fild_d_crr',0);
			$this->session->set_userdata('order_b_crr','ASC');
			
			$this->Data_Table();
	}	

	public function Order_b_desc()
	{						
			$this->session->set_userdata('fild_a_crr',0);
			$this->session->set_userdata('fild_b_crr',1);
			$this->session->set_userdata('fild_c_crr',0);
			$this->session->set_userdata('fild_d_crr',0);
			$this->session->set_userdata('order_b_crr','DESC');
			
			$this->Data_Table();
	}

	public function Order_c_asc()
	{						
			$this->session->set_userdata('fild_a_crr',0);
			$this->session->set_userdata('fild_b_crr',0);
			$this->session->set_userdata('fild_c_crr',1);
			$this->session->set_userdata('fild_d_crr',0);
			$this->session->set_userdata('order_c_crr','ASC');
			
			$this->Data_Table();
	}	

	public function Order_c_desc()
	{						
			$this->session->set_userdata('fild_a_crr',0);
			$this->session->set_userdata('fild_b_crr',0);
			$this->session->set_userdata('fild_c_crr',1);
			$this->session->set_userdata('fild_d_crr',0);
			$this->session->set_userdata('order_c_crr','DESC');
			
			$this->Data_Table();
	}

	public function Order_d_asc()
	{						
			$this->session->set_userdata('fild_a_crr',0);
			$this->session->set_userdata('fild_b_crr',0);
			$this->session->set_userdata('fild_c_crr',0);
			$this->session->set_userdata('fild_d_crr',1);
			$this->session->set_userdata('order_d_crr','ASC');
			
			$this->Data_Table();
	}	

	public function Order_d_desc()
	{						
			$this->session->set_userdata('fild_a_crr',0);
			$this->session->set_userdata('fild_b_crr',0);
			$this->session->set_userdata('fild_c_crr',0);
			$this->session->set_userdata('fild_d_crr',1);
			$this->session->set_userdata('order_d_crr','DESC');
			
			$this->Data_Table();
	}
	
	public function Rows($val)
	{
			$this->session->unset_userdata('page_crr');
			$this->session->unset_userdata('next_crr');
			$this->session->set_userdata('myrow_crr',$val);		
			$this->Data_Table();
		
	}
	
	public function Search()
	{						
			$this->session->unset_userdata('page_crr');
			$this->session->unset_userdata('next_crr');
			
			$src = string_src($this->input->post('input_src'));			
			
			$this->session->set_userdata('src_crr',$src);
			
			$this->Data_Table();
	}
	
	public function Page()
	{
	
			$page	= ($this->uri->segment('3')) ? $this->uri->segment('3'):1; 
			$next 	= ($this->uri->segment('4')) ? $this->uri->segment('4'):1; 
			
			$this->session->set_userdata('page_crr',$page);
			$this->session->set_userdata('next_crr',$next);
			
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
					'courier' => '',
					'courier_name' => ph(1),
					'creater' => '',
					'creater_email' => '',
					'created_date' => '',
					'updater' => '',
					'updater_email' => '',
					'updated_date' => ''
					);
				
				$this->load->view('courier_form',$data);
				
			}elseif($act == 'Edit' && desid_get($target) > 0){
				
				$get = $this->M_Courier->M_Courier_Detail(desid_get($target))->row();
				
				$data = array(
					'action' => 'Edit',
					'target' => $target,
					'courier' => enid_get(xxs_filter($get->courier)),
					'courier_name' => xxs_filter($get->courier_name),
					'creater' => xxs_filter($get->creater),
					'creater_email' => '',
					'created_date' => date_time_ind_full($get->created_date),
					'updater' => xxs_filter($get->updater),
					'updater_email' => '',
					'updated_date' => date_time_ind_full($get->updated_date)
					);
					
				$this->load->view('courier_form',$data);
			
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
		
		$id_courier = (int)desid_get($this->input->post('input_target'));
		$courier	= (int)desid_get($this->input->post('input_courier'));
		
		$iduser		= (int)desid_get($this->session->userdata('id_tr'));
		$date		= my_date_time();
		$table		= 'transport_request.parameter_courier';
		
		if($id_courier <= 0){
			
			$data = array(
				'courier' => $courier,
				'status' => 1,
				'created_by' => $iduser,
				'created_date' => $date
				);
				
			$trans_status = $this->M_Global->M_Save($table,$data);
			
			if($trans_status === TRUE){
				
				echo myalert('success','Data has been saved');
				
				
				$new_idtarget = $this->M_Global->M_CheckId('id_courier',$table)->row();
				$this->Form('Edit',enid_get($new_idtarget->id_courier));
			
			}else{
				
				echo myalert('danger','Proccess failed');
				
				$this->Form('Add',enid_get(0));
			
			}
			
		}
		elseif($id_courier > 0){
			
			$data = array(
				'courier' => $courier,
				'updated_by' => $iduser,
				'updated_date' => $date				
				);
				
			$target = array('id_courier' => $id_courier);
			
			$trans_status = $this->M_Global->M_Update($table,$data,$target);
			
			if($trans_status === TRUE){
				
				echo myalert('success','Data has been saved');
		
				$this->Form('Edit',enid_get($id_courier));
			
			}else{
			
				echo myalert('danger','Proccess failed');
				
				$this->Form('Edit',enid_get($id_courier));
				
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
			$target = array('id_courier' => $index);
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
			$table	= 'transport_request.parameter_courier';
			
			$data = array(
				'status' => $status,
				'updated_by' => $iduser,
				'updated_date' => $date				
				);
			
			$target = array('id_courier' => $index);
			
			$trans_status = $this->M_Global->M_Update($table,$data,$target);
			
			
			if($trans_status === TRUE){
				
				echo 'Status has been changed';
				
			} else {
				
				echo 'Proccess failed';
				
			}
			
		}
	}	
	
	public function Search_List_Courier()
	{						
		if($this->session->userdata('id_tr') == ''){
			
			$this->M_Global->M_Logout();
			
		}else{
		
			$src = string_src($this->input->post('input_src_list'));			
			
			$query = $this->M_Courier->M_Search_List_Courier($src)->result();
			
			foreach($query as $data){
				echo'<li><a href="#" 
				onclick="ListDataSelect(
				&#39;my-list-box-courier_name&#39;,
				&#39;input_courier&#39;,
				&#39;'.enid_get($data->id_employee).'&#39;,
				&#39;input_courier_name&#39;,
				&#39;'.$data->name.'&#39;
				)">'.$data->name.'</li>';
			}
			
		}
	}


	
	
/* end */	
}
