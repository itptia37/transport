<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Expense_Driver extends CI_Controller {

	Public function __construct(){
	parent::__construct();
		
		$this->load->model('M_Expense_Driver');	
		$this->load->model('M_Report_Petty_Cash');
		
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
		
			$this->session->unset_userdata('page_erd');
			$this->session->unset_userdata('next_erd');
			$this->session->unset_userdata('src_erd');
		
			$this->session->set_userdata('fild_a_erd',0);
			$this->session->set_userdata('fild_b_erd',0);
			$this->session->set_userdata('fild_c_erd',0);
			$this->session->set_userdata('fild_d_erd',0);
			$this->session->set_userdata('fild_e_erd',0);
			$this->session->set_userdata('fild_f_erd',0);
			$this->session->set_userdata('fild_g_erd',0);
		
	
			$this->session->unset_userdata('filter_a_erc');
	
			$data['set_menu'] = '<li class="breadcrumb-item" aria-current="page">Expense Driver</li>';
			$data['set_submenu'] = '<li class="breadcrumb-item" aria-current="page">Expense Driver Data</li>';
			$data['set_action'] = '';
			
			/* pagging */
			$myrow	= ($this->session->userdata('myrow_erd')) ? $this->session->userdata('myrow_erd'):25;
			$page	= ($this->session->userdata('page_erd')) ? $this->session->userdata('page_erd'):1;
			$next	= ($this->session->userdata('next_erd')) ? $this->session->userdata('next_erd'):1;
			$start 	= $myrow * ($page-1);
			
			/* src */
			$src		= ($this->session->userdata('src_erd')) ? $this->session->userdata('src_erd'):''; 
			
			/* oreder */
			$fild_a	= ($this->session->userdata('fild_a_erd')) ? $this->session->userdata('fild_a_erd'):0;
			$order_a	= ($this->session->userdata('order_a_erd')) ? $this->session->userdata('order_a_erd'):'ASC';
			$fild_b	= ($this->session->userdata('fild_b_erd')) ? $this->session->userdata('fild_b_erd'):0;
			$order_b	= ($this->session->userdata('order_b_erd')) ? $this->session->userdata('order_b_erd'):'ASC';
			$fild_c	= ($this->session->userdata('fild_c_erd')) ? $this->session->userdata('fild_c_erd'):0;
			$order_c	= ($this->session->userdata('order_c_erd')) ? $this->session->userdata('order_c_erd'):'ASC';
			$fild_d	= ($this->session->userdata('fild_d_erd')) ? $this->session->userdata('fild_d_erd'):0;
			$order_d	= ($this->session->userdata('order_d_erd')) ? $this->session->userdata('order_d_erd'):'ASC';
			$fild_e	= ($this->session->userdata('fild_e_erd')) ? $this->session->userdata('fild_e_erd'):0;
			$order_e	= ($this->session->userdata('order_e_erd')) ? $this->session->userdata('order_e_erd'):'ASC';
			$fild_f	= ($this->session->userdata('fild_f_erd')) ? $this->session->userdata('fild_f_erd'):0;
			$order_f	= ($this->session->userdata('order_f_erd')) ? $this->session->userdata('order_f_erd'):'ASC';
			$fild_g	= ($this->session->userdata('fild_g_erd')) ? $this->session->userdata('fild_g_erd'):0;
			$order_g	= ($this->session->userdata('order_g_erd')) ? $this->session->userdata('order_g_erd'):'ASC';
			
			$filter_a		= ($this->session->userdata('filter_a_erc')) ? $this->session->userdata('filter_a_erc'):'';
			
			$filter = array(
			'myrow' => $myrow,
			'start' => $start,
			'src' => strtoupper($src),
			'fild_a' => $fild_a,
			'order_a' => $order_a,
			'fild_b' => $fild_b,
			'order_b' => $order_b,
			'fild_c' => $fild_c,
			'order_c' => $order_c,
			'fild_d' => $fild_d,
			'order_d' => $order_d,
			'fild_e' => $fild_e,
			'order_e' => $order_e,
			'fild_f' => $fild_f,
			'order_f' => $order_f,
			'fild_g' => $fild_g,
			'order_g' => $order_g,
			'filter_a' => (int) desid_get($filter_a)
			);
			
			$data['num_data']		= $this->M_Expense_Driver->M_Expense_Driver_NumRow($filter)->num_rows();
			$data['result_data']	= $this->M_Expense_Driver->M_Expense_Driver_Data($filter)->result();
			
			/* pagging */
			$data['max']			= (ceil($data['num_data']/$myrow)); 
			$data['myrow'] 			= $myrow; 
			$data['page'] 			= $page;
			$data['next'] 			= $next;		
			$data['start'] 			= $start;
			$data['controller']		= 'Expense_Driver';
			
			/* src */
			$data['src'] 			= $src; 
			
			/* oreder */
			$data['fild_a'] = $fild_a; 
			$data['order_a']= $order_a; 
			$data['fild_b'] = $fild_b; 
			$data['order_b']= $order_b; 
			$data['fild_c'] = $fild_c; 
			$data['order_c']= $order_c; 
			$data['fild_d'] = $fild_d; 
			$data['order_d']= $order_d; 
			$data['fild_e'] = $fild_e; 
			$data['order_e']= $order_e;
			$data['fild_f'] = $fild_f; 
			$data['order_f']= $order_f; 
			$data['fild_g'] = $fild_g; 
			$data['order_g']= $order_g; 
			
			$data['num_expense_header']		= $this->M_Report_Petty_Cash->M_Expense_Header()->num_rows();
			$data['result_data_expense_header']	= $this->M_Report_Petty_Cash->M_Expense_Header()->result();
			
		$this->load->view('expense_driver',$data);
		
		}
	}
	
	public function Back()
	{
		if($this->session->userdata('id_tr') == ''){
			
			$this->M_Global->M_Logout();
			
		}else{
			
			$data['set_menu'] = '<li class="breadcrumb-item" aria-current="page">Expense Driver</li>';
			$data['set_submenu'] = '<li class="breadcrumb-item" aria-current="page">Expense Driver Data</li>';
			$data['set_action'] = '';
				
			/* pagging */
			$myrow	= ($this->session->userdata('myrow_erd')) ? $this->session->userdata('myrow_erd'):25;
			$page	= ($this->session->userdata('page_erd')) ? $this->session->userdata('page_erd'):1;
			$next	= ($this->session->userdata('next_erd')) ? $this->session->userdata('next_erd'):1;
			$start 	= $myrow * ($page-1);
			
			/* src */
			$src		= ($this->session->userdata('src_erd')) ? $this->session->userdata('src_erd'):''; 
			
			/* oreder */
			$fild_a	= ($this->session->userdata('fild_a_erd')) ? $this->session->userdata('fild_a_erd'):0;
			$order_a	= ($this->session->userdata('order_a_erd')) ? $this->session->userdata('order_a_erd'):'ASC';
			$fild_b	= ($this->session->userdata('fild_b_erd')) ? $this->session->userdata('fild_b_erd'):0;
			$order_b	= ($this->session->userdata('order_b_erd')) ? $this->session->userdata('order_b_erd'):'ASC';
			$fild_c	= ($this->session->userdata('fild_c_erd')) ? $this->session->userdata('fild_c_erd'):0;
			$order_c	= ($this->session->userdata('order_c_erd')) ? $this->session->userdata('order_c_erd'):'ASC';
			$fild_d	= ($this->session->userdata('fild_d_erd')) ? $this->session->userdata('fild_d_erd'):0;
			$order_d	= ($this->session->userdata('order_d_erd')) ? $this->session->userdata('order_d_erd'):'ASC';
			$fild_e	= ($this->session->userdata('fild_e_erd')) ? $this->session->userdata('fild_e_erd'):0;
			$order_e	= ($this->session->userdata('order_e_erd')) ? $this->session->userdata('order_e_erd'):'ASC';
			$fild_f	= ($this->session->userdata('fild_f_erd')) ? $this->session->userdata('fild_f_erd'):0;
			$order_f	= ($this->session->userdata('order_f_erd')) ? $this->session->userdata('order_f_erd'):'ASC';
			$fild_g	= ($this->session->userdata('fild_g_erd')) ? $this->session->userdata('fild_g_erd'):0;
			$order_g	= ($this->session->userdata('order_g_erd')) ? $this->session->userdata('order_g_erd'):'ASC';
			
			$filter_a		= ($this->session->userdata('filter_a_erc')) ? $this->session->userdata('filter_a_erc'):'';
			
			$filter = array(
			'myrow' => $myrow,
			'start' => $start,
			'src' => strtoupper($src),
			'fild_a' => $fild_a,
			'order_a' => $order_a,
			'fild_b' => $fild_b,
			'order_b' => $order_b,
			'fild_c' => $fild_c,
			'order_c' => $order_c,
			'fild_d' => $fild_d,
			'order_d' => $order_d,
			'fild_e' => $fild_e,
			'order_e' => $order_e,
			'fild_f' => $fild_f,
			'order_f' => $order_f,
			'fild_g' => $fild_g,
			'order_g' => $order_g,
			'filter_a' => (int) desid_get($filter_a)
			);
			
			$data['num_data']		= $this->M_Expense_Driver->M_Expense_Driver_NumRow($filter)->num_rows();
			$data['result_data']	= $this->M_Expense_Driver->M_Expense_Driver_Data($filter)->result();
			
			/* pagging */
			$data['max']			= (ceil($data['num_data']/$myrow)); 
			$data['myrow'] 			= $myrow; 
			$data['page'] 			= $page;
			$data['next'] 			= $next;		
			$data['start'] 			= $start;
			$data['controller']		= 'Expense_Driver';
			
			/* src */
			$data['src'] 			= $src; 
			
			/* oreder */
			$data['fild_a'] = $fild_a; 
			$data['order_a']= $order_a; 
			$data['fild_b'] = $fild_b; 
			$data['order_b']= $order_b; 
			$data['fild_c'] = $fild_c; 
			$data['order_c']= $order_c; 
			$data['fild_d'] = $fild_d; 
			$data['order_d']= $order_d; 
			$data['fild_e'] = $fild_e; 
			$data['order_e']= $order_e;
			$data['fild_f'] = $fild_f; 
			$data['order_f']= $order_f; 
			$data['fild_g'] = $fild_g; 
			$data['order_g']= $order_g; 
			
			$data['num_expense_header']		= $this->M_Report_Petty_Cash->M_Expense_Header()->num_rows();
			$data['result_data_expense_header']	= $this->M_Report_Petty_Cash->M_Expense_Header()->result();
			
		$this->load->view('expense_driver',$data);
		
		}
	}

	public function Data_Table()
	{
		if($this->session->userdata('id_tr') == ''){
			
			$this->M_Global->M_Logout();
			
		}else{
			
			/* pagging */
			$myrow	= ($this->session->userdata('myrow_erd')) ? $this->session->userdata('myrow_erd'):25;
			$page	= ($this->session->userdata('page_erd')) ? $this->session->userdata('page_erd'):1;
			$next	= ($this->session->userdata('next_erd')) ? $this->session->userdata('next_erd'):1;
			$start 	= $myrow * ($page-1);
			
			/* src */
			$src		= ($this->session->userdata('src_erd')) ? $this->session->userdata('src_erd'):''; 
			
			/* oreder */
			$fild_a	= ($this->session->userdata('fild_a_erd')) ? $this->session->userdata('fild_a_erd'):0;
			$order_a	= ($this->session->userdata('order_a_erd')) ? $this->session->userdata('order_a_erd'):'ASC';
			$fild_b	= ($this->session->userdata('fild_b_erd')) ? $this->session->userdata('fild_b_erd'):0;
			$order_b	= ($this->session->userdata('order_b_erd')) ? $this->session->userdata('order_b_erd'):'ASC';
			$fild_c	= ($this->session->userdata('fild_c_erd')) ? $this->session->userdata('fild_c_erd'):0;
			$order_c	= ($this->session->userdata('order_c_erd')) ? $this->session->userdata('order_c_erd'):'ASC';
			$fild_d	= ($this->session->userdata('fild_d_erd')) ? $this->session->userdata('fild_d_erd'):0;
			$order_d	= ($this->session->userdata('order_d_erd')) ? $this->session->userdata('order_d_erd'):'ASC';
			$fild_e	= ($this->session->userdata('fild_e_erd')) ? $this->session->userdata('fild_e_erd'):0;
			$order_e	= ($this->session->userdata('order_e_erd')) ? $this->session->userdata('order_e_erd'):'ASC';
			$fild_f	= ($this->session->userdata('fild_f_erd')) ? $this->session->userdata('fild_f_erd'):0;
			$order_f	= ($this->session->userdata('order_f_erd')) ? $this->session->userdata('order_f_erd'):'ASC';
			$fild_g	= ($this->session->userdata('fild_g_erd')) ? $this->session->userdata('fild_g_erd'):0;
			$order_g	= ($this->session->userdata('order_g_erd')) ? $this->session->userdata('order_g_erd'):'ASC';
			
			$filter_a		= ($this->session->userdata('filter_a_erc')) ? $this->session->userdata('filter_a_erc'):'';
			
			$filter = array(
			'myrow' => $myrow,
			'start' => $start,
			'src' => strtoupper($src),
			'fild_a' => $fild_a,
			'order_a' => $order_a,
			'fild_b' => $fild_b,
			'order_b' => $order_b,
			'fild_c' => $fild_c,
			'order_c' => $order_c,
			'fild_d' => $fild_d,
			'order_d' => $order_d,
			'fild_e' => $fild_e,
			'order_e' => $order_e,
			'fild_f' => $fild_f,
			'order_f' => $order_f,
			'fild_g' => $fild_g,
			'order_g' => $order_g,
			'filter_a' => (int) desid_get($filter_a)
			);
			
			$data['num_data']		= $this->M_Expense_Driver->M_Expense_Driver_NumRow($filter)->num_rows();
			$data['result_data']	= $this->M_Expense_Driver->M_Expense_Driver_Data($filter)->result();
			
			/* pagging */
			$data['max']			= (ceil($data['num_data']/$myrow)); 
			$data['myrow'] 			= $myrow; 
			$data['page'] 			= $page;
			$data['next'] 			= $next;		
			$data['start'] 			= $start;
			$data['controller']		= 'Expense_Driver';
			
			/* src */
			$data['src'] 			= $src; 
			
			/* oreder */
			$data['fild_a'] = $fild_a; 
			$data['order_a']= $order_a; 
			$data['fild_b'] = $fild_b; 
			$data['order_b']= $order_b; 
			$data['fild_c'] = $fild_c; 
			$data['order_c']= $order_c; 
			$data['fild_d'] = $fild_d; 
			$data['order_d']= $order_d; 
			$data['fild_e'] = $fild_e; 
			$data['order_e']= $order_e;
			$data['fild_f'] = $fild_f; 
			$data['order_f']= $order_f; 
			$data['fild_g'] = $fild_g; 
			$data['order_g']= $order_g; 
			
			$data['num_expense_header']		= $this->M_Report_Petty_Cash->M_Expense_Header()->num_rows();
			$data['result_data_expense_header']	= $this->M_Report_Petty_Cash->M_Expense_Header()->result();
			
		$this->load->view('expense_driver_data',$data);
		
		}
	}
	
	
	Public function Order_a_asc()
	{
		if($this->session->userdata('id_tr')!=''){
			
		$this->session->set_userdata('fild_a_erd',1);
		$this->session->set_userdata('fild_b_erd',0);
		$this->session->set_userdata('fild_c_erd',0);
		$this->session->set_userdata('fild_d_erd',0);
		$this->session->set_userdata('fild_e_erd',0);
		$this->session->set_userdata('fild_f_erd',0);
		$this->session->set_userdata('fild_g_erd',0);
		$this->session->set_userdata('order_a_erd','ASC');		
		$this->Data_Table();
		
		}else{$this->M_logout->index();}
	}
	
	Public function Order_a_desc()
	{
		if($this->session->userdata('id_tr')!=''){
			
		$this->session->set_userdata('fild_a_erd',1);
		$this->session->set_userdata('fild_b_erd',0);
		$this->session->set_userdata('fild_c_erd',0);
		$this->session->set_userdata('fild_d_erd',0);
		$this->session->set_userdata('fild_e_erd',0);
		$this->session->set_userdata('fild_f_erd',0);
		$this->session->set_userdata('fild_g_erd',0);
		$this->session->set_userdata('order_a_erd','DESC');		
		$this->Data_Table();
		
		}else{$this->M_logout->index();}
	}
	
	Public function Order_b_asc()
	{
		if($this->session->userdata('id_tr')!=''){
			
		$this->session->set_userdata('fild_a_erd',0);
		$this->session->set_userdata('fild_b_erd',1);
		$this->session->set_userdata('fild_c_erd',0);
		$this->session->set_userdata('fild_d_erd',0);
		$this->session->set_userdata('fild_e_erd',0);
		$this->session->set_userdata('fild_f_erd',0);
		$this->session->set_userdata('fild_g_erd',0);
		$this->session->set_userdata('order_b_erd','ASC');		
		$this->Data_Table();
		
		}else{$this->M_logout->index();}
	}
	
	Public function Order_b_desc()
	{
		if($this->session->userdata('id_tr')!=''){
			
		$this->session->set_userdata('fild_a_erd',0);
		$this->session->set_userdata('fild_b_erd',1);
		$this->session->set_userdata('fild_c_erd',0);
		$this->session->set_userdata('fild_d_erd',0);
		$this->session->set_userdata('fild_e_erd',0);
		$this->session->set_userdata('fild_f_erd',0);
		$this->session->set_userdata('fild_g_erd',0);
		$this->session->set_userdata('order_b_erd','DESC');		
		$this->Data_Table();
		
		}else{$this->M_logout->index();}
	}

	Public function Order_c_asc()
	{
		if($this->session->userdata('id_tr')!=''){
			
		$this->session->set_userdata('fild_a_erd',0);
		$this->session->set_userdata('fild_b_erd',0);
		$this->session->set_userdata('fild_c_erd',1);
		$this->session->set_userdata('fild_d_erd',0);
		$this->session->set_userdata('fild_e_erd',0);
		$this->session->set_userdata('fild_f_erd',0);
		$this->session->set_userdata('fild_g_erd',0);
		$this->session->set_userdata('order_c_erd','ASC');		
		$this->Data_Table();
		
		}else{$this->M_logout->index();}
	}
	
	Public function Order_c_desc()
	{
		if($this->session->userdata('id_tr')!=''){
			
		$this->session->set_userdata('fild_a_erd',0);
		$this->session->set_userdata('fild_b_erd',0);
		$this->session->set_userdata('fild_c_erd',1);
		$this->session->set_userdata('fild_d_erd',0);
		$this->session->set_userdata('fild_e_erd',0);
		$this->session->set_userdata('fild_f_erd',0);
		$this->session->set_userdata('fild_g_erd',0);
		$this->session->set_userdata('order_c_erd','DESC');		
		$this->Data_Table();
		
		}else{$this->M_logout->index();}
	}


	Public function Order_d_asc()
	{
		if($this->session->userdata('id_tr')!=''){
			
		$this->session->set_userdata('fild_a_erd',0);
		$this->session->set_userdata('fild_b_erd',0);
		$this->session->set_userdata('fild_c_erd',0);
		$this->session->set_userdata('fild_d_erd',1);
		$this->session->set_userdata('fild_e_erd',0);
		$this->session->set_userdata('fild_f_erd',0);
		$this->session->set_userdata('fild_g_erd',0);
		$this->session->set_userdata('order_d_erd','ASC');		
		$this->Data_Table();
		
		}else{$this->M_logout->index();}
	}
	
	Public function Order_d_desc()
	{
		if($this->session->userdata('id_tr')!=''){
			
		$this->session->set_userdata('fild_a_erd',0);
		$this->session->set_userdata('fild_b_erd',0);
		$this->session->set_userdata('fild_c_erd',0);
		$this->session->set_userdata('fild_d_erd',1);
		$this->session->set_userdata('fild_e_erd',0);
		$this->session->set_userdata('fild_f_erd',0);
		$this->session->set_userdata('fild_g_erd',0);
		$this->session->set_userdata('order_d_erd','DESC');		
		$this->Data_Table();
		
		}else{$this->M_logout->index();}
	}


	Public function Order_e_asc()
	{
		if($this->session->userdata('id_tr')!=''){
			
		$this->session->set_userdata('fild_a_erd',0);
		$this->session->set_userdata('fild_b_erd',0);
		$this->session->set_userdata('fild_c_erd',0);
		$this->session->set_userdata('fild_d_erd',0);
		$this->session->set_userdata('fild_e_erd',1);
		$this->session->set_userdata('fild_f_erd',0);
		$this->session->set_userdata('fild_g_erd',0);
		$this->session->set_userdata('order_e_erd','ASC');	
		$this->Data_Table();
		
		}else{$this->M_logout->index();}
	}
	
	Public function Order_e_desc()
	{
		if($this->session->userdata('id_tr')!=''){
			
		$this->session->set_userdata('fild_a_erd',0);
		$this->session->set_userdata('fild_b_erd',0);
		$this->session->set_userdata('fild_c_erd',0);
		$this->session->set_userdata('fild_d_erd',0);
		$this->session->set_userdata('fild_e_erd',1);
		$this->session->set_userdata('fild_f_erd',0);
		$this->session->set_userdata('fild_g_erd',0);
		$this->session->set_userdata('order_e_erd','DESC');		
		$this->Data_Table();
		
		}else{$this->M_logout->index();}
	}

	Public function Order_f_asc()
	{
		if($this->session->userdata('id_tr')!=''){
			
		$this->session->set_userdata('fild_a_erd',0);
		$this->session->set_userdata('fild_b_erd',0);
		$this->session->set_userdata('fild_c_erd',0);
		$this->session->set_userdata('fild_d_erd',0);
		$this->session->set_userdata('fild_e_erd',0);
		$this->session->set_userdata('fild_f_erd',1);
		$this->session->set_userdata('fild_g_erd',0);
		$this->session->set_userdata('order_f_erd','ASC');		
		$this->Data_Table();
		
		}else{$this->M_logout->index();}
	}
	
	Public function Order_f_desc()
	{
		if($this->session->userdata('id_tr')!=''){
			
		$this->session->set_userdata('fild_a_erd',0);
		$this->session->set_userdata('fild_b_erd',0);
		$this->session->set_userdata('fild_c_erd',0);
		$this->session->set_userdata('fild_d_erd',0);
		$this->session->set_userdata('fild_e_erd',0);
		$this->session->set_userdata('fild_f_erd',1);
		$this->session->set_userdata('fild_g_erd',0);
		$this->session->set_userdata('order_f_erd','DESC');		
		$this->Data_Table();
		
		}else{$this->M_logout->index();}
	}	
	
	Public function Order_g_asc()
	{
		if($this->session->userdata('id_tr')!=''){
			
		$this->session->set_userdata('fild_a_erd',0);
		$this->session->set_userdata('fild_b_erd',0);
		$this->session->set_userdata('fild_c_erd',0);
		$this->session->set_userdata('fild_d_erd',0);
		$this->session->set_userdata('fild_e_erd',0);
		$this->session->set_userdata('fild_f_erd',0);
		$this->session->set_userdata('fild_g_erd',1);
		$this->session->set_userdata('order_g_erd','ASC');		
		$this->Data_Table();
		
		}else{$this->M_logout->index();}
	}
	
	Public function Order_g_desc()
	{
		if($this->session->userdata('id_tr')!=''){
			
		$this->session->set_userdata('fild_a_erd',0);
		$this->session->set_userdata('fild_b_erd',0);
		$this->session->set_userdata('fild_c_erd',0);
		$this->session->set_userdata('fild_d_erd',0);
		$this->session->set_userdata('fild_e_erd',0);
		$this->session->set_userdata('fild_f_erd',0);
		$this->session->set_userdata('fild_g_erd',1);
		$this->session->set_userdata('order_g_erd','DESC');		
		$this->Data_Table();
		
		}else{$this->M_logout->index();}
	}	
	
	public function Rows($val)
	{
			$this->session->unset_userdata('page_erd');
			$this->session->unset_userdata('next_erd');
			$this->session->set_userdata('myrow_erd',$val);		
			$this->Data_Table();
		
	}
	
	public function Search()
	{						
			$this->session->unset_userdata('page_erd');
			$this->session->unset_userdata('next_erd');
			
			$src = string_src($this->input->post('input_src'));			
			
			$this->session->set_userdata('src_erd',$src);
			
			$this->Data_Table();
	}
	
	public function Page()
	{
	
			$page	= ($this->uri->segment('3')) ? $this->uri->segment('3'):1; 
			$next 	= ($this->uri->segment('4')) ? $this->uri->segment('4'):1; 
			
			$this->session->set_userdata('page_erd',$page);
			$this->session->set_userdata('next_erd',$next);
			
			$this->Data_Table();

	}
	
	public function Form($act,$id_request,$id_expense)
	{		
		if($this->session->userdata('id_tr') == ''){
			
			$this->M_Global->M_Logout();
			
		}else{
						
			if(desid_get($id_request) > 0){
				
				$get1 = $this->M_Expense_Driver->M_Request_Driver_Detail((int)desid_get($id_request))->row();
				$request = enid_get($get1->id_request);
				$request_name = $get1->no_request;
				
			}else{
				$request = enid_get(0);
				$request_name = ph(1);
				
			}
			
			if($act == 'Add' || desid_get($id_expense) == 0){
				
				$data = array(
				'action' => 'Add',
				'target_control' => 'Expense_Driver',
				'id_expense' => enid_get(0),
				'expense_type' => '',
				'expense_type_name' =>  ph(1),
				'request' => $request,
				'request_name' => $request_name,				
				'balance' => ''
				);				
				
				if(desid_get($id_request) > 0){
					/* expense_type */
					$data['num_expense'] = $this->M_Global->M_ExpenseData(desid_get($id_request),1)->num_rows();	
					$data['expense'] = $this->M_Global->M_ExpenseData(desid_get($id_request),1)->result();
				
				}else{
					/* expense_type */
					$data['num_expense'] = 0;				
					$data['expense'] = 0;
				}
				
				$this->load->view('expense_form',$data);
			
			}elseif($act == 'Edit' && desid_get($id_expense) > 0){
				
				$get = $this->M_Global->M_Expense_Detail(desid_get($id_expense),1)->row();
				
				$data = array(
				'action' => 'Edit',
				'target_control' => 'Expense_Driver',				
				'id_expense' => enid_get($get->id_expense),
				'expense_type' => enid_get($get->expense_type),
				'expense_type_name' =>  xxs_filter($get->name),
				'balance' => ($get->balance),
				'request' => $request,
				'request_name' => $request_name,
				);
				
				/* expense_type */
				$data['num_expense'] = $this->M_Global->M_ExpenseData(desid_get($id_request),1)->num_rows();
				
				$data['expense'] = $this->M_Global->M_ExpenseData(desid_get($id_request),1)->result();
				
				$this->load->view('expense_form',$data);
				
			}
		}
	}
	
	public function Save_Expense()
	{
		if($this->session->userdata('id_tr') == ''){
			
			$this->M_Global->M_Logout();
			
		}else{
			
			$id_request  	= (int)desid_get($this->input->post('input_request'));
			$id_expense  	= (int)desid_get($this->input->post('input_id_expense'));
			$expense_type 	= (int)desid_get($this->input->post('input_expense_type'));
			$balance 		= curr_ind_input($this->input->post('input_balance'));
			
			$iduser		 	= (int)desid_get($this->session->userdata('id_tr'));
			$date		 	= my_date_time();
			
			$table			= 'transport_request.request_expense';
			
			if($expense_type == '') {
				
				echo myalert('danger','Please Complete The Text');
				
				if($id_expense <= 0){
					
					$this->Form('Add',enid_get($id_request),enid_get(0));
					
				}else{
					
					$this->Form('Add',enid_get($id_request),enid_get($id_expense));
					
				}
				
			}else{
				
				if($id_expense <= 0){
					
									
				$check 			= $this->M_Global->M_Check_Expense($id_request,$expense_type,1)->num_rows();
			
				if($check > 0){
					
					echo myalert('danger','Item has been inputed');
					
					$this->Form('Add',enid_get($id_request),enid_get(0));
					
				} else {
					
					$data = array(
					'id_request' => $id_request,
					'expense_type' => $expense_type,
					'balance' => $balance,
					'status' => 1,
					'request' => 1
					);
				
					$trans_status = $this->M_Global->M_Save($table,$data);
				
					if($trans_status === TRUE){
						
						/* updated_by */
						$target_update = array('id_request' => $id_request);
						$data_update = array('updated_by' => $iduser,'updated_date' => $date);
						$this->M_Global->M_Update('transport_request.request_driver',$data_update,$target_update);
						
						echo myalert('success','Data has been saved');
						
						//$new_idtarget = $this->M_Global->M_CheckId('id_expense',$table)->row();							
						//$this->Form('Edit',enid_get($id_request),enid_get($new_idtarget->id_expense));
						$this->Form('Add',enid_get($id_request),enid_get(0));
						
					}else {
						
						echo myalert('danger','Process failed');
						
						$this->Form('Add',enid_get($id_request),enid_get(0));
						
						}						
					}
				}
				elseif($id_expense > 0){
					
					$data = array(
					'expense_type' => $expense_type,
					'balance' => $balance
					);
					
					$target = array('id_expense' => $id_expense);
			
					$trans_status = $this->M_Global->M_Update($table,$data,$target);
					
					if($trans_status === TRUE){
						
						/* updated_by */
						$target_update = array('id_request' => $id_request);
						$data_update = array('updated_by' => $iduser,'updated_date' => $date);
						$this->M_Global->M_Update('transport_request.request_driver',$data_update,$target_update);
						
						echo myalert('success','Data has been saved');
							
						$this->Form('Add',enid_get($id_request),enid_get($id_expense));
						
					}else {
						
						echo myalert('danger','Process failed');
						
						$this->Form('Add',enid_get($id_request),enid_get($id_expense));
							
						
					}					
				}		
			}
		}
	}
	
	public function Delete_Expense(){
		
		if($this->session->userdata('id_tr') == ''){
			
			$this->M_Global->M_Logout();
			
		}else{		
			
			$id_request  	= (int)desid_get($this->input->post('input_target'));
			$id_expense 	= (int)desid_get($this->input->post('input_index'));
			
			$iduser		 	= (int)desid_get($this->session->userdata('id_tr'));
			$date		 	= my_date_time();
			
			$target = array('id_expense' => $id_expense);
			$result = $this->M_Global->M_Delete('transport_request.request_expense',$target);
				
				if($result === TRUE){
					
					/* updated_by */
					$target_update 	= array('id_request' => $id_request);
					$data_update 	= array('updated_by' => $iduser,'updated_date' => $date);					
					$this->M_Global->M_Update('transport_request.request_driver',$data_update,$target_update);	
						
					echo myalert('success','Data has been deleted');
					
					$this->Form('Add',enid_get($id_request),enid_get($id_expense));
					
				}else {
					
					echo myalert('danger','Proccess failed');
					
					$this->Form('Add',enid_get($id_request),enid_get($id_expense));
				}			
	
		}
	}
	
	public function Search_List_Request()
	{						
		if($this->session->userdata('id_tr') == ''){
			
			$this->M_Global->M_Logout();
			
		}else{
		
			$src = string_src($this->input->post('input_src_list'));			
			
			$query = $this->M_Expense_Driver->M_Search_List_Request($src)->result();
			
			foreach($query as $data){
				echo'<li><a href="#" 
				onclick="ListDataSelect(
				&#39;my-list-box-request&#39;,
				&#39;input_request&#39;,
				&#39;'.enid_get($data->id_request).'&#39;,
				&#39;input_request_name&#39;,
				&#39;'.$data->no_request.'&#39;
				)">'.$data->no_request.'</li>';
			}
			
		}
	}	
	
	public function Search_List_Expense_Type()
	{						
		if($this->session->userdata('id_tr') == ''){
			
			$this->M_Global->M_Logout();
			
		}else{
		
			$src = string_src($this->input->post('input_src_list'));			
			
			$query = $this->M_Global->M_Search_List_Expense_Type($src)->result();
			
			foreach($query as $data){
				echo'<li><a href="#" 
				onclick="ListDataSelect(
				&#39;my-list-box-expense_type&#39;,
				&#39;input_expense_type&#39;,
				&#39;'.enid_get($data->id_parameter).'&#39;,
				&#39;input_expense_type_name&#39;,
				&#39;'.$data->name.'&#39;
				)">'.$data->name.'</li>';
			}
			
		}
	}
	
	public function Filter_Search_List_Driver()
	{						
		if($this->session->userdata('id_tr') == ''){
			
			$this->M_Global->M_Logout();
			
		}else{
		
			$src = string_src($this->input->post('input_src_list'));			
			
			$query = $this->M_Expense_Driver->M_Filter_Search_List_Driver($src)->result();
			
			foreach($query as $data){
				
				echo'<li onclick="LoadDataTable(&#39;Expense_Driver/Filter_List_a/'.enid_get($data->driver).'&#39;)"><a href="#">'.$data->name.'</a></li>';
			
			}
			
		}
	}
	
	public function Filter_List_a($target)
	{
		$this->session->set_userdata('filter_a_erc',$target);		
		$this->Data_Table();
		
	}
/* end */	
}
