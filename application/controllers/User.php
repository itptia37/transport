<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	Public function __construct(){
	parent::__construct();
		
		$this->load->model('M_User');	
		
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
		
			$this->session->unset_userdata('page_usr');
			$this->session->unset_userdata('next_usr');
			$this->session->unset_userdata('src_usr');
		
			$this->session->set_userdata('fild_a_usr',0);
			$this->session->set_userdata('fild_b_usr',0);
			$this->session->set_userdata('fild_c_usr',0);
			$this->session->set_userdata('fild_d_usr',0);
	
			$data['set_menu'] = '<li class="breadcrumb-item" aria-current="page">User</li>';
			$data['set_submenu'] = '<li class="breadcrumb-item" aria-current="page">User Data</li>';
			$data['set_action'] = '';
			
			/* pagging */
			$myrow	= ($this->session->userdata('myrow_usr')) ? $this->session->userdata('myrow_usr'):25;
			$page	= ($this->session->userdata('page_usr')) ? $this->session->userdata('page_usr'):1;
			$next	= ($this->session->userdata('next_usr')) ? $this->session->userdata('next_usr'):1;
			$start 	= $myrow * ($page-1);
			
			/* src */
			$src		= ($this->session->userdata('src_usr')) ? $this->session->userdata('src_usr'):''; 
			
			/* oreder */
			$fild_a		= ($this->session->userdata('fild_a_usr')) ? $this->session->userdata('fild_a_usr'):0;
			$order_a	= ($this->session->userdata('order_a_usr')) ? $this->session->userdata('order_a_usr'):'ASC';
			$fild_b		= ($this->session->userdata('fild_b_usr')) ? $this->session->userdata('fild_b_usr'):0;
			$order_b	= ($this->session->userdata('order_b_usr')) ? $this->session->userdata('order_b_usr'):'ASC';
			$fild_c		= ($this->session->userdata('fild_c_usr')) ? $this->session->userdata('fild_c_usr'):0;
			$order_c	= ($this->session->userdata('order_c_usr')) ? $this->session->userdata('order_c_usr'):'ASC';
			$fild_d		= ($this->session->userdata('fild_d_usr')) ? $this->session->userdata('fild_d_usr'):0;
			$order_d	= ($this->session->userdata('order_d_usr')) ? $this->session->userdata('order_d_usr'):'ASC';
			
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
			
			$data['num_data']		= $this->M_User->M_UserNumRow($filter)->num_rows();
			$data['result_data']	= $this->M_User->M_UserData($filter)->result();
			
			/* pagging */
			$data['max']			= (ceil($data['num_data']/$myrow)); 
			$data['myrow'] 			= $myrow; 
			$data['page'] 			= $page;
			$data['next'] 			= $next;		
			$data['start'] 			= $start;
			$data['controller']		= 'User';
			
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
		
		$this->load->view('user',$data);
		
		}
	}

	public function Data_Table()
	{
		if($this->session->userdata('id_tr') == ''){
			
			$this->M_Global->M_Logout();
			
		}else{
			
			/* pagging */
			$myrow	= ($this->session->userdata('myrow_usr')) ? $this->session->userdata('myrow_usr'):25;
			$page	= ($this->session->userdata('page_usr')) ? $this->session->userdata('page_usr'):1;
			$next	= ($this->session->userdata('next_usr')) ? $this->session->userdata('next_usr'):1;
			$start 	= $myrow * ($page-1);
			
			/* src */
			$src		= ($this->session->userdata('src_usr')) ? $this->session->userdata('src_usr'):''; 
			
			/* oreder */
			$fild_a		= ($this->session->userdata('fild_a_usr')) ? $this->session->userdata('fild_a_usr'):0;
			$order_a	= ($this->session->userdata('order_a_usr')) ? $this->session->userdata('order_a_usr'):'ASC';
			$fild_b		= ($this->session->userdata('fild_b_usr')) ? $this->session->userdata('fild_b_usr'):0;
			$order_b	= ($this->session->userdata('order_b_usr')) ? $this->session->userdata('order_b_usr'):'ASC';
			$fild_c		= ($this->session->userdata('fild_c_usr')) ? $this->session->userdata('fild_c_usr'):0;
			$order_c	= ($this->session->userdata('order_c_usr')) ? $this->session->userdata('order_c_usr'):'ASC';
			$fild_d		= ($this->session->userdata('fild_d_usr')) ? $this->session->userdata('fild_d_usr'):0;
			$order_d	= ($this->session->userdata('order_d_usr')) ? $this->session->userdata('order_d_usr'):'ASC';
			
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
			
			$data['num_data']		= $this->M_User->M_UserNumRow($filter)->num_rows();
			$data['result_data']	= $this->M_User->M_UserData($filter)->result();
			
			/* pagging */
			$data['max']			= (ceil($data['num_data']/$myrow)); 
			$data['myrow'] 			= $myrow; 
			$data['page'] 			= $page;
			$data['next'] 			= $next;		
			$data['start'] 			= $start;
			$data['controller']		= 'User';
			
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
		
		$this->load->view('user_data',$data);
		
		}
	}
	
	
	public function Order_a_asc()
	{						
			$this->session->set_userdata('fild_a_usr',1);
			$this->session->set_userdata('fild_b_usr',0);
			$this->session->set_userdata('fild_c_usr',0);
			$this->session->set_userdata('fild_d_usr',0);
			$this->session->set_userdata('order_a_usr','ASC');
			
			$this->Data_Table();
	}	

	public function Order_a_desc()
	{						
			$this->session->set_userdata('fild_a_usr',1);
			$this->session->set_userdata('fild_b_usr',0);
			$this->session->set_userdata('fild_c_usr',0);
			$this->session->set_userdata('fild_d_usr',0);
			$this->session->set_userdata('order_a_usr','DESC');
			
			$this->Data_Table();
	}
	
	public function Order_b_asc()
	{						
			$this->session->set_userdata('fild_a_usr',0);
			$this->session->set_userdata('fild_b_usr',1);
			$this->session->set_userdata('fild_c_usr',0);
			$this->session->set_userdata('fild_d_usr',0);
			$this->session->set_userdata('order_b_usr','ASC');
			
			$this->Data_Table();
	}	

	public function Order_b_desc()
	{						
			$this->session->set_userdata('fild_a_usr',0);
			$this->session->set_userdata('fild_b_usr',1);
			$this->session->set_userdata('fild_c_usr',0);
			$this->session->set_userdata('fild_d_usr',0);
			$this->session->set_userdata('order_b_usr','DESC');
			
			$this->Data_Table();
	}

	public function Order_c_asc()
	{						
			$this->session->set_userdata('fild_a_usr',0);
			$this->session->set_userdata('fild_b_usr',0);
			$this->session->set_userdata('fild_c_usr',1);
			$this->session->set_userdata('fild_d_usr',0);
			$this->session->set_userdata('order_c_usr','ASC');
			
			$this->Data_Table();
	}	

	public function Order_c_desc()
	{						
			$this->session->set_userdata('fild_a_usr',0);
			$this->session->set_userdata('fild_b_usr',0);
			$this->session->set_userdata('fild_c_usr',1);
			$this->session->set_userdata('fild_d_usr',0);
			$this->session->set_userdata('order_c_usr','DESC');
			
			$this->Data_Table();
	}

	public function Order_d_asc()
	{						
			$this->session->set_userdata('fild_a_usr',0);
			$this->session->set_userdata('fild_b_usr',0);
			$this->session->set_userdata('fild_c_usr',0);
			$this->session->set_userdata('fild_d_usr',1);
			$this->session->set_userdata('order_d_usr','ASC');
			
			$this->Data_Table();
	}	

	public function Order_d_desc()
	{						
			$this->session->set_userdata('fild_a_usr',0);
			$this->session->set_userdata('fild_b_usr',0);
			$this->session->set_userdata('fild_c_usr',0);
			$this->session->set_userdata('fild_d_usr',1);
			$this->session->set_userdata('order_d_usr','DESC');
			
			$this->Data_Table();
	}
	
	public function Rows($val)
	{
			$this->session->unset_userdata('page_usr');
			$this->session->unset_userdata('next_usr');
			$this->session->set_userdata('myrow_usr',$val);		
			$this->Data_Table();
		
	}
	
	public function Search()
	{						
			$this->session->unset_userdata('page_usr');
			$this->session->unset_userdata('next_usr');
			
			$src = string_src($this->input->post('input_src'));			
			
			$this->session->set_userdata('src_usr',$src);
			
			$this->Data_Table();
	}
	
	public function Page()
	{
	
			$page	= ($this->uri->segment('3')) ? $this->uri->segment('3'):1; 
			$next 	= ($this->uri->segment('4')) ? $this->uri->segment('4'):1; 
			
			$this->session->set_userdata('page_usr',$page);
			$this->session->set_userdata('next_usr',$next);
			
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
					'id_login' => '',
					'email' => ph(1),
					'access' => '',
					'creater' => '',
					'creater_email' => '',
					'created_date' => '',
					'updater' => '',
					'updater_email' => '',
					'updated_date' => ''
					
					);
				
				/* parameter user access */
				$target						= array('id_parameter_category' => $this->session->userdata('set_user_access'));
				$data['list_user_access'] 	= $this->M_Global->M_List_Parameter($target)->result();
		
				
				$this->load->view('user_form',$data);
				
			}elseif($act == 'Edit' && desid_get($target) > 0){
				
				$get = $this->M_User->M_User_Detail(desid_get($target))->row();
				
				$data = array(
					'action' => 'Edit',
					'target' => $target,
					'id_login' => enid_get(xxs_filter($get->id_login)),
					'email' => xxs_filter($get->email),
					'access' => xxs_filter($get->access),
					'creater' => xxs_filter($get->creater),
					'creater_email' => '',
					'created_date' => date_time_ind_full($get->created_date),
					'updater' => xxs_filter($get->updater),
					'updater_email' => '',
					'updated_date' => date_time_ind_full($get->updated_date)
					);
					
				/* parameter user access */
				$target						= array('id_parameter_category' => $this->session->userdata('set_user_access'));
				$data['list_user_access'] 	= $this->M_Global->M_List_Parameter($target)->result();		
				
				$this->load->view('user_form',$data);
			
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
		
		$id_user 	= (int)desid_get($this->input->post('input_target'));
		$id_login	= (int)desid_get($this->input->post('input_id_login'));
		$access		= (int)$this->input->post('input_access');
		$name		= $this->input->post('input_name');
		
		$iduser		= (int)desid_get($this->session->userdata('id_tr'));
		$date		= my_date_time();
		
		if($id_user <= 0){
			
			$new_iduser_aplikasi = $this->M_Global->M_Create_Id('id_user_aplikasi','login.user_aplikasi');
			
			$data1 = array(
				'id_user_aplikasi' => $new_iduser_aplikasi,
				'id_login' => $id_login,
				'id_aplikasi' => $this->session->userdata('set_application'),
				'id_created_by' => $iduser,
				'created_date' => $date
				);
				
			$trans_status = $this->M_Global->M_Save('login.user_aplikasi',$data1);
			
			if($trans_status === TRUE){
				
				echo myalert('success','Data has been saved');
				
				$data2 = array(
				'id_login' => $id_login,
				'status' => 1,
				'access' => $access
				);
				
				$this->M_Global->M_Save('transport_request.user',$data2);
				
				$new_idtarget = $this->M_Global->M_CheckId('id_user','transport_request.user')->row();
				$this->Form('Edit',enid_get($new_idtarget->id_user));
			
			}else{
				
				echo myalert('danger','Proccess failed');
				
				$this->Form('Add',enid_get(0));
			
			}
			
		}
		elseif($id_user > 0){
			
			$data = array(
				'access' => $access			
				);
				
			$target = array('id_user' => $id_user);
			
			$trans_status = $this->M_Global->M_Update('transport_request.user',$data,$target);
			
			if($trans_status === TRUE){
				
				echo myalert('success','Data has been saved');
		
				$this->Form('Edit',enid_get($id_user));
			
			}else{
			
				echo myalert('danger','Proccess failed');
				
				$this->Form('Edit',enid_get($id_user));
				
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
			
			$table  = 'transport_request.user';
			$target = array('id_user' => $index);
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
			
			$data1   = array('status' => $status);
			$target1 = array('id_user' => $index);
			$trans_status = $this->M_Global->M_Update('transport_request.user',$data1,$target1);
			
			
			$get_query = $this->M_Global->M_Select_Where('transport_request.user',$target1);
			$get_data  = $get_query->row();
			$target2   = array(
				'id_login' => $get_data->id_login,
				'id_aplikasi' => $this->session->userdata('set_application')
				);
			$data2     = array('id_updated_by' => $iduser,'updated_date' => $date);
			$trans_status = $this->M_Global->M_Update('login.user_aplikasi',$data2,$target2);
			
			if($trans_status === TRUE){
				
				echo 'Status has been changed';
				
			} else {
				
				echo 'Proccess failed';
				
			}
			
		}
	}	
	
	public function Search_List_User()
	{						
		if($this->session->userdata('id_tr') == ''){
			
			$this->M_Global->M_Logout();
			
		}else{
		
			$src = string_src($this->input->post('input_src_list'));			
			
			$query = $this->M_User->M_Search_List_User($src)->result();
			
			foreach($query as $data){
				echo'<li><a href="#" 
				onclick="ListDataSelect(
				&#39;my-list-box-user&#39;,
				&#39;input_id_login&#39;,
				&#39;'.enid_get($data->id_login).'&#39;,
				&#39;input_user&#39;,
				&#39;'.$data->email.'&#39;
				)">'.$data->email.'</li>';
			}
			
		}
	}
	
/* end */	
}
