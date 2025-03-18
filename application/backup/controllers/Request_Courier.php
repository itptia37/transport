<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request_Courier extends CI_Controller {

	Public function __construct(){
	parent::__construct();
		
		$this->load->model('M_Request_Courier');	
		
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
			
			$this->session->unset_userdata('page_rc');
			$this->session->unset_userdata('next_rc');
			$this->session->unset_userdata('src_rc');
		
			$this->session->set_userdata('fild_a_rc',0);
			$this->session->set_userdata('fild_b_rc',0);
			$this->session->set_userdata('fild_c_rc',0);
			$this->session->set_userdata('fild_d_rc',0);
			$this->session->set_userdata('fild_e_rc',0);
			$this->session->set_userdata('fild_f_rc',0);
			$this->session->set_userdata('fild_g_rc',0);
		
	
			$data['set_menu'] = '<li class="breadcrumb-item" aria-current="page">Request</li>';
			$data['set_submenu'] = '<li class="breadcrumb-item" aria-current="page">Request Courier Data</li>';
			$data['set_action'] = '';
			
			/* pagging */
			$myrow	= ($this->session->userdata('myrow_rc')) ? $this->session->userdata('myrow_rc'):25;
			$page	= ($this->session->userdata('page_rc')) ? $this->session->userdata('page_rc'):1;
			$next	= ($this->session->userdata('next_rc')) ? $this->session->userdata('next_rc'):1;
			$start 	= $myrow * ($page-1);
			
			/* src */
			$src		= ($this->session->userdata('src_rc')) ? $this->session->userdata('src_rc'):''; 
			
			/* oreder */
			$fild_a	= ($this->session->userdata('fild_a_rc')) ? $this->session->userdata('fild_a_rc'):0;
			$order_a	= ($this->session->userdata('order_a_rc')) ? $this->session->userdata('order_a_rc'):'ASC';
			$fild_b	= ($this->session->userdata('fild_b_rc')) ? $this->session->userdata('fild_b_rc'):0;
			$order_b	= ($this->session->userdata('order_b_rc')) ? $this->session->userdata('order_b_rc'):'ASC';
			$fild_c	= ($this->session->userdata('fild_c_rc')) ? $this->session->userdata('fild_c_rc'):0;
			$order_c	= ($this->session->userdata('order_c_rc')) ? $this->session->userdata('order_c_rc'):'ASC';
			$fild_d	= ($this->session->userdata('fild_d_rc')) ? $this->session->userdata('fild_d_rc'):0;
			$order_d	= ($this->session->userdata('order_d_rc')) ? $this->session->userdata('order_d_rc'):'ASC';
			$fild_e	= ($this->session->userdata('fild_e_rc')) ? $this->session->userdata('fild_e_rc'):0;
			$order_e	= ($this->session->userdata('order_e_rc')) ? $this->session->userdata('order_e_rc'):'ASC';
			$fild_f	= ($this->session->userdata('fild_f_rc')) ? $this->session->userdata('fild_f_rc'):0;
			$order_f	= ($this->session->userdata('order_f_rc')) ? $this->session->userdata('order_f_rc'):'ASC';
			$fild_g	= ($this->session->userdata('fild_g_rc')) ? $this->session->userdata('fild_g_rc'):0;
			$order_g	= ($this->session->userdata('order_g_rc')) ? $this->session->userdata('order_g_rc'):'ASC';
			
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
			'order_g' => $order_g
			);
			
			$data['num_data']		= $this->M_Request_Courier->M_Request_CourierNumRow($filter)->num_rows();
			$data['result_data']	= $this->M_Request_Courier->M_Request_CourierData($filter)->result();
			
			/* pagging */
			$data['max']			= (ceil($data['num_data']/$myrow)); 
			$data['myrow'] 			= $myrow; 
			$data['page'] 			= $page;
			$data['next'] 			= $next;		
			$data['start'] 			= $start;
			$data['controller']		= 'Request_Courier';
			
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
			
			$this->Read_Notif();
			
		$this->load->view('req_courier',$data);
		
		}
	}
	
	public function Back()
	{
		if($this->session->userdata('id_tr') == ''){
			
			$this->M_Global->M_Logout();
			
		}else{
			
			$data['set_menu'] = '<li class="breadcrumb-item" aria-current="page">Request</li>';
			$data['set_submenu'] = '<li class="breadcrumb-item" aria-current="page">Request Courier Data</li>';
			$data['set_action'] = '';
				
			/* pagging */
			$myrow	= ($this->session->userdata('myrow_rc')) ? $this->session->userdata('myrow_rc'):25;
			$page	= ($this->session->userdata('page_rc')) ? $this->session->userdata('page_rc'):1;
			$next	= ($this->session->userdata('next_rc')) ? $this->session->userdata('next_rc'):1;
			$start 	= $myrow * ($page-1);
			
			/* src */
			$src		= ($this->session->userdata('src_rc')) ? $this->session->userdata('src_rc'):''; 
			
			/* oreder */
			$fild_a	= ($this->session->userdata('fild_a_rc')) ? $this->session->userdata('fild_a_rc'):0;
			$order_a	= ($this->session->userdata('order_a_rc')) ? $this->session->userdata('order_a_rc'):'ASC';
			$fild_b	= ($this->session->userdata('fild_b_rc')) ? $this->session->userdata('fild_b_rc'):0;
			$order_b	= ($this->session->userdata('order_b_rc')) ? $this->session->userdata('order_b_rc'):'ASC';
			$fild_c	= ($this->session->userdata('fild_c_rc')) ? $this->session->userdata('fild_c_rc'):0;
			$order_c	= ($this->session->userdata('order_c_rc')) ? $this->session->userdata('order_c_rc'):'ASC';
			$fild_d	= ($this->session->userdata('fild_d_rc')) ? $this->session->userdata('fild_d_rc'):0;
			$order_d	= ($this->session->userdata('order_d_rc')) ? $this->session->userdata('order_d_rc'):'ASC';
			$fild_e	= ($this->session->userdata('fild_e_rc')) ? $this->session->userdata('fild_e_rc'):0;
			$order_e	= ($this->session->userdata('order_e_rc')) ? $this->session->userdata('order_e_rc'):'ASC';
			$fild_f	= ($this->session->userdata('fild_f_rc')) ? $this->session->userdata('fild_f_rc'):0;
			$order_f	= ($this->session->userdata('order_f_rc')) ? $this->session->userdata('order_f_rc'):'ASC';
			$fild_g	= ($this->session->userdata('fild_g_rc')) ? $this->session->userdata('fild_g_rc'):0;
			$order_g	= ($this->session->userdata('order_g_rc')) ? $this->session->userdata('order_g_rc'):'ASC';
			
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
			'order_g' => $order_g
			);
			
			$data['num_data']		= $this->M_Request_Courier->M_Request_CourierNumRow($filter)->num_rows();
			$data['result_data']	= $this->M_Request_Courier->M_Request_CourierData($filter)->result();
			
			/* pagging */
			$data['max']			= (ceil($data['num_data']/$myrow)); 
			$data['myrow'] 			= $myrow; 
			$data['page'] 			= $page;
			$data['next'] 			= $next;		
			$data['start'] 			= $start;
			$data['controller']		= 'Request_Courier';
			
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
		
			$this->Read_Notif();
			
		$this->load->view('req_courier',$data);
		
		}
	}

	public function Data_Table()
	{
		if($this->session->userdata('id_tr') == ''){
			
			$this->M_Global->M_Logout();
			
		}else{
			
			/* pagging */
			$myrow	= ($this->session->userdata('myrow_rc')) ? $this->session->userdata('myrow_rc'):25;
			$page	= ($this->session->userdata('page_rc')) ? $this->session->userdata('page_rc'):1;
			$next	= ($this->session->userdata('next_rc')) ? $this->session->userdata('next_rc'):1;
			$start 	= $myrow * ($page-1);
			
			/* src */
			$src		= ($this->session->userdata('src_rc')) ? $this->session->userdata('src_rc'):''; 
			
			/* oreder */
			$fild_a	= ($this->session->userdata('fild_a_rc')) ? $this->session->userdata('fild_a_rc'):0;
			$order_a	= ($this->session->userdata('order_a_rc')) ? $this->session->userdata('order_a_rc'):'ASC';
			$fild_b	= ($this->session->userdata('fild_b_rc')) ? $this->session->userdata('fild_b_rc'):0;
			$order_b	= ($this->session->userdata('order_b_rc')) ? $this->session->userdata('order_b_rc'):'ASC';
			$fild_c	= ($this->session->userdata('fild_c_rc')) ? $this->session->userdata('fild_c_rc'):0;
			$order_c	= ($this->session->userdata('order_c_rc')) ? $this->session->userdata('order_c_rc'):'ASC';
			$fild_d	= ($this->session->userdata('fild_d_rc')) ? $this->session->userdata('fild_d_rc'):0;
			$order_d	= ($this->session->userdata('order_d_rc')) ? $this->session->userdata('order_d_rc'):'ASC';
			$fild_e	= ($this->session->userdata('fild_e_rc')) ? $this->session->userdata('fild_e_rc'):0;
			$order_e	= ($this->session->userdata('order_e_rc')) ? $this->session->userdata('order_e_rc'):'ASC';
			$fild_f	= ($this->session->userdata('fild_f_rc')) ? $this->session->userdata('fild_f_rc'):0;
			$order_f	= ($this->session->userdata('order_f_rc')) ? $this->session->userdata('order_f_rc'):'ASC';
			$fild_g	= ($this->session->userdata('fild_g_rc')) ? $this->session->userdata('fild_g_rc'):0;
			$order_g	= ($this->session->userdata('order_g_rc')) ? $this->session->userdata('order_g_rc'):'ASC';
			
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
			'order_g' => $order_g
			);
			
			$data['num_data']		= $this->M_Request_Courier->M_Request_CourierNumRow($filter)->num_rows();
			$data['result_data']	= $this->M_Request_Courier->M_Request_CourierData($filter)->result();
			
			/* pagging */
			$data['max']			= (ceil($data['num_data']/$myrow)); 
			$data['myrow'] 			= $myrow; 
			$data['page'] 			= $page;
			$data['next'] 			= $next;		
			$data['start'] 			= $start;
			$data['controller']		= 'Request_Courier';
			
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
		
			$this->Read_Notif();
			
		$this->load->view('req_courier_data',$data);
		
		}
	}
	
	
	Public function Order_a_asc()
	{
		if($this->session->userdata('id_tr')!=''){
			
		$this->session->set_userdata('fild_a_rc',1);
		$this->session->set_userdata('fild_b_rc',0);
		$this->session->set_userdata('fild_c_rc',0);
		$this->session->set_userdata('fild_d_rc',0);
		$this->session->set_userdata('fild_e_rc',0);
		$this->session->set_userdata('fild_f_rc',0);
		$this->session->set_userdata('fild_g_rc',0);
		$this->session->set_userdata('order_a_rc','ASC');		
		$this->Data_Table();
		
		}else{$this->M_logout->index();}
	}
	
	Public function Order_a_desc()
	{
		if($this->session->userdata('id_tr')!=''){
			
		$this->session->set_userdata('fild_a_rc',1);
		$this->session->set_userdata('fild_b_rc',0);
		$this->session->set_userdata('fild_c_rc',0);
		$this->session->set_userdata('fild_d_rc',0);
		$this->session->set_userdata('fild_e_rc',0);
		$this->session->set_userdata('fild_f_rc',0);
		$this->session->set_userdata('fild_g_rc',0);
		$this->session->set_userdata('order_a_rc','DESC');		
		$this->Data_Table();
		
		}else{$this->M_logout->index();}
	}
	
	Public function Order_b_asc()
	{
		if($this->session->userdata('id_tr')!=''){
			
		$this->session->set_userdata('fild_a_rc',0);
		$this->session->set_userdata('fild_b_rc',1);
		$this->session->set_userdata('fild_c_rc',0);
		$this->session->set_userdata('fild_d_rc',0);
		$this->session->set_userdata('fild_e_rc',0);
		$this->session->set_userdata('fild_f_rc',0);
		$this->session->set_userdata('fild_g_rc',0);
		$this->session->set_userdata('order_b_rc','ASC');		
		$this->Data_Table();
		
		}else{$this->M_logout->index();}
	}
	
	Public function Order_b_desc()
	{
		if($this->session->userdata('id_tr')!=''){
			
		$this->session->set_userdata('fild_a_rc',0);
		$this->session->set_userdata('fild_b_rc',1);
		$this->session->set_userdata('fild_c_rc',0);
		$this->session->set_userdata('fild_d_rc',0);
		$this->session->set_userdata('fild_e_rc',0);
		$this->session->set_userdata('fild_f_rc',0);
		$this->session->set_userdata('fild_g_rc',0);
		$this->session->set_userdata('order_b_rc','DESC');		
		$this->Data_Table();
		
		}else{$this->M_logout->index();}
	}

	Public function Order_c_asc()
	{
		if($this->session->userdata('id_tr')!=''){
			
		$this->session->set_userdata('fild_a_rc',0);
		$this->session->set_userdata('fild_b_rc',0);
		$this->session->set_userdata('fild_c_rc',1);
		$this->session->set_userdata('fild_d_rc',0);
		$this->session->set_userdata('fild_e_rc',0);
		$this->session->set_userdata('fild_f_rc',0);
		$this->session->set_userdata('fild_g_rc',0);
		$this->session->set_userdata('order_c_rc','ASC');		
		$this->Data_Table();
		
		}else{$this->M_logout->index();}
	}
	
	Public function Order_c_desc()
	{
		if($this->session->userdata('id_tr')!=''){
			
		$this->session->set_userdata('fild_a_rc',0);
		$this->session->set_userdata('fild_b_rc',0);
		$this->session->set_userdata('fild_c_rc',1);
		$this->session->set_userdata('fild_d_rc',0);
		$this->session->set_userdata('fild_e_rc',0);
		$this->session->set_userdata('fild_f_rc',0);
		$this->session->set_userdata('fild_g_rc',0);
		$this->session->set_userdata('order_c_rc','DESC');		
		$this->Data_Table();
		
		}else{$this->M_logout->index();}
	}


	Public function Order_d_asc()
	{
		if($this->session->userdata('id_tr')!=''){
			
		$this->session->set_userdata('fild_a_rc',0);
		$this->session->set_userdata('fild_b_rc',0);
		$this->session->set_userdata('fild_c_rc',0);
		$this->session->set_userdata('fild_d_rc',1);
		$this->session->set_userdata('fild_e_rc',0);
		$this->session->set_userdata('fild_f_rc',0);
		$this->session->set_userdata('fild_g_rc',0);
		$this->session->set_userdata('order_d_rc','ASC');		
		$this->Data_Table();
		
		}else{$this->M_logout->index();}
	}
	
	Public function Order_d_desc()
	{
		if($this->session->userdata('id_tr')!=''){
			
		$this->session->set_userdata('fild_a_rc',0);
		$this->session->set_userdata('fild_b_rc',0);
		$this->session->set_userdata('fild_c_rc',0);
		$this->session->set_userdata('fild_d_rc',1);
		$this->session->set_userdata('fild_e_rc',0);
		$this->session->set_userdata('fild_f_rc',0);
		$this->session->set_userdata('fild_g_rc',0);
		$this->session->set_userdata('order_d_rc','DESC');		
		$this->Data_Table();
		
		}else{$this->M_logout->index();}
	}


	Public function Order_e_asc()
	{
		if($this->session->userdata('id_tr')!=''){
			
		$this->session->set_userdata('fild_a_rc',0);
		$this->session->set_userdata('fild_b_rc',0);
		$this->session->set_userdata('fild_c_rc',0);
		$this->session->set_userdata('fild_d_rc',0);
		$this->session->set_userdata('fild_e_rc',1);
		$this->session->set_userdata('fild_f_rc',0);
		$this->session->set_userdata('fild_g_rc',0);
		$this->session->set_userdata('order_e_rc','ASC');	
		$this->Data_Table();
		
		}else{$this->M_logout->index();}
	}
	
	Public function Order_e_desc()
	{
		if($this->session->userdata('id_tr')!=''){
			
		$this->session->set_userdata('fild_a_rc',0);
		$this->session->set_userdata('fild_b_rc',0);
		$this->session->set_userdata('fild_c_rc',0);
		$this->session->set_userdata('fild_d_rc',0);
		$this->session->set_userdata('fild_e_rc',1);
		$this->session->set_userdata('fild_f_rc',0);
		$this->session->set_userdata('fild_g_rc',0);
		$this->session->set_userdata('order_e_rc','DESC');		
		$this->Data_Table();
		
		}else{$this->M_logout->index();}
	}

	Public function Order_f_asc()
	{
		if($this->session->userdata('id_tr')!=''){
			
		$this->session->set_userdata('fild_a_rc',0);
		$this->session->set_userdata('fild_b_rc',0);
		$this->session->set_userdata('fild_c_rc',0);
		$this->session->set_userdata('fild_d_rc',0);
		$this->session->set_userdata('fild_e_rc',0);
		$this->session->set_userdata('fild_f_rc',1);
		$this->session->set_userdata('fild_g_rc',0);
		$this->session->set_userdata('order_f_rc','ASC');		
		$this->Data_Table();
		
		}else{$this->M_logout->index();}
	}
	
	Public function Order_f_desc()
	{
		if($this->session->userdata('id_tr')!=''){
			
		$this->session->set_userdata('fild_a_rc',0);
		$this->session->set_userdata('fild_b_rc',0);
		$this->session->set_userdata('fild_c_rc',0);
		$this->session->set_userdata('fild_d_rc',0);
		$this->session->set_userdata('fild_e_rc',0);
		$this->session->set_userdata('fild_f_rc',1);
		$this->session->set_userdata('fild_g_rc',0);
		$this->session->set_userdata('order_f_rc','DESC');		
		$this->Data_Table();
		
		}else{$this->M_logout->index();}
	}	
	
	Public function Order_g_asc()
	{
		if($this->session->userdata('id_tr')!=''){
			
		$this->session->set_userdata('fild_a_rc',0);
		$this->session->set_userdata('fild_b_rc',0);
		$this->session->set_userdata('fild_c_rc',0);
		$this->session->set_userdata('fild_d_rc',0);
		$this->session->set_userdata('fild_e_rc',0);
		$this->session->set_userdata('fild_f_rc',0);
		$this->session->set_userdata('fild_g_rc',1);
		$this->session->set_userdata('order_g_rc','ASC');		
		$this->Data_Table();
		
		}else{$this->M_logout->index();}
	}
	
	Public function Order_g_desc()
	{
		if($this->session->userdata('id_tr')!=''){
			
		$this->session->set_userdata('fild_a_rc',0);
		$this->session->set_userdata('fild_b_rc',0);
		$this->session->set_userdata('fild_c_rc',0);
		$this->session->set_userdata('fild_d_rc',0);
		$this->session->set_userdata('fild_e_rc',0);
		$this->session->set_userdata('fild_f_rc',0);
		$this->session->set_userdata('fild_g_rc',1);
		$this->session->set_userdata('order_g_rc','DESC');		
		$this->Data_Table();
		
		}else{$this->M_logout->index();}
	}	
	
	public function Rows($val)
	{
			$this->session->unset_userdata('page_rc');
			$this->session->unset_userdata('next_rc');
			$this->session->set_userdata('myrow_rc',$val);		
			$this->Data_Table();
		
	}
	
	public function Search()
	{						
			$this->session->unset_userdata('page_rc');
			$this->session->unset_userdata('next_rc');
			
			$src = string_src($this->input->post('input_src'));			
			
			$this->session->set_userdata('src_rc',$src);
			
			$this->Data_Table();
	}
	
	public function Page()
	{
	
			$page	= ($this->uri->segment('3')) ? $this->uri->segment('3'):1; 
			$next 	= ($this->uri->segment('4')) ? $this->uri->segment('4'):1; 
			
			$this->session->set_userdata('page_rc',$page);
			$this->session->set_userdata('next_rc',$next);
			
			$this->Data_Table();

	}
	
	public function Form($act,$target)
	{		
		if($this->session->userdata('id_tr') == ''){
			
			$this->M_Global->M_Logout();
			
		}else{
			
			$access_tr = $this->session->userdata('access_tr');
			
			$form = 'req_courier_form_1';
			
			if($act == 'Add' || desid_get($target) == 0){
				
				$data = array(
				'set_menu' => '<li class="breadcrumb-item" aria-current="page">Request</li>',
				'set_submenu' => '<li class="breadcrumb-item" aria-current="page">Request Courier Data</li>',
				'set_action' => '<li class="breadcrumb-item" aria-current="page">Add New</li>',
				'action' => 'Add',
				'target' => enid_get(0), 
				'no_request' => '',
				'request_option' => '',
				'created_by' => '',
				'created_date' => '', 
				'updated_by' => '',
				'updated_date' => '', 
				'start_date' => date_ind(my_date()),
				'start_time' => '',
				'start_time_a' => get_hour(my_time()),
				'start_time_b' => '',
				'destination' => '',
				'description' => '',
				'courier' => '',
				'external' => '',
				'departur' => '',
				'return' => '',
				'delivery' => '',
				'status' => 0,
				'comment' => '',
				'requestor' => '',
				'requestor_email' => '',
				'request_option_name' => ph(1),
				'courier_name' => ph(1),
				'delivery_name' => ph(1),
				'external_name' => ph(1),
				'updater' => '',
				'expense_purpose' => '',
				'expense_purpose_name' => ph(1),
				'project_number' => '',
				'finish_date' => '',
				'finish_time' => '',
				'finish_time_a' => (get_hour(my_time())+4),
				'finish_time_b' => '',
				'creater' => '',
				'creater_email' => '',
				'created_date' => '',
				'updater' => '',
				'updater_email' => '',
				'updated_date' => '',
				'company' => '',
				'company_name' => ph(1)				
				);	
				
				$data['num_attachment'] = 0;
				
				$this->load->view($form,$data);
				
			}elseif($act == 'Edit' && desid_get($target) > 0){
				
				$get = $this->M_Request_Courier->M_Request_Courier_Detail(desid_get($target))->row();
				
				$title = 'Edit';
				
				//basic
				if($access_tr == 24) {
					
					if($get->status <= 0){
						$form  = 'req_courier_form_1';
					}else{
						$title = 'Detail';
						$form = 'req_courier_detail';
					}
				}//middle && advanced
				elseif($access_tr == 25 || $access_tr == 26) {
					
					if($get->status <= 0){
						
						$form = 'req_courier_form_1';
						
					}else{
						
						//perubahan status ke proses
						if($get->status == 1 && $access_tr == 25){
									
							$iduser	= (int)desid_get($this->session->userdata('id_tr'));
							$date	= my_date_time();
							$table	= 'transport_request.request_courier';
							
							$data_update = array(
								'status' => 2,
								'updated_by' => $iduser,
								'updated_date' => $date				
								);
							
							$target_update = array('id_request' => desid_get($target));
							
							$trans_status = $this->M_Global->M_Update($table,$data_update,$target_update);
							
							$this->SendEmail(desid_get($target),2);
							
						}
						
						//personal
						if($get->request_option == 6){
							
							$form = 'req_courier_form_1';
							
						}else{
							
							$form = 'req_courier_form_2';
							
						}
					}
				}
				
				/*request option */
					if($get->request_option <= 0){
						$request_option_name = ph(1);
					}else{ $request_option_name = xxs_filter($get->request_option_name); }
					
				/* courier */	
					if($get->courier <= 0){
						$courier_name = ph(1);
					}else{ $courier_name = xxs_filter($get->courier_name); }
				
				/* external_name*/	
					if($get->external <= 0){
						$external_name = ph(1);
					}else{ $external_name = xxs_filter($get->external_name); }
				
				/* departur_vehicle */	
					if($get->departur_vehicle <= 0){
						$departur_name = ph(1);
					}else{ $departur_name = xxs_filter($get->departur_name); }
					
				/* return_vehicle */	
					if($get->return_vehicle <= 0){
						$return_name = ph(1);
					}else{ $return_name = xxs_filter($get->return_name); }
					
				/* delivery */	
					if($get->delivery <= 0){
						$delivery_name = ph(1);
					}else{ $delivery_name = xxs_filter($get->delivery_name); }
					
				/* expense_purpose */
					if($get->expense_purpose <= 0){
						$expense_purpose_name = ph(1);
					}else{ $expense_purpose_name = xxs_filter($get->expense_purpose_name); }
				
						$data = array(
						'set_menu' => '<li class="breadcrumb-item" aria-current="page">Request</li>',
						'set_submenu' => '<li class="breadcrumb-item" aria-current="page">Request Courier Data</li>',
						'set_action' => '<li class="breadcrumb-item" aria-current="page">'.$title.'</li>',
						'action' => 'Edit',
						'target' => enid_get($get->id_request), 
						'no_request' => 'No.'.xxs_filter($get->no_request), 
						'request_option' => $get->request_option,
						'created_by' => enid_get($get->created_by), 
						'created_date' => date_time_ind_full($get->created_date), 
						'updated_by' => enid_get($get->updated_by), 
						'updated_date' => date_time_ind_full($get->updated_date), 
						'start_date' => date_ind($get->start_date),
						'start_time' => $get->start_time,
						'start_time_a' => get_hour($get->start_time),
						'start_time_b' => get_minute($get->start_time),
						'destination' => xxs_filter($get->destination),
						'description' => xxs_filter($get->description),
						
						'courier' => enid_get($get->courier),
						'external' => enid_get($get->external),
						'departur' => enid_get($get->departur_vehicle),
						'return' => enid_get($get->return_vehicle),
						'delivery' => enid_get($get->delivery),
								
						'status' => $get->status,
						'comment' => xxs_filter($get->comment),
						'requestor' => xxs_filter($get->requestor),
						'requestor_email' => xxs_filter($get->requestor_email),
						'request_option_name' => $request_option_name,
						'courier_name' => $courier_name,
						'external_name' => $external_name,
						'departur_name' => $departur_name,
						'return_name' => $return_name,
						'delivery_name' => $delivery_name,
						'updater' => xxs_filter($get->updater),
						
						'expense_purpose' => $get->expense_purpose,
						'expense_purpose_name' => $expense_purpose_name,
						'project_number' => xxs_filter($get->project_number),
						
						'finish_date' => date_ind($get->finish_date),
						'finish_time' => $get->finish_time,
						'finish_time_a' => get_hour($get->finish_time),
						'finish_time_b' => get_minute($get->finish_time),
						'creater' => xxs_filter($get->creater),
						'creater_email' => xxs_filter($get->creater_email),
						'created_date' => date_time_ind_full($get->created_date),
						'updater' => xxs_filter($get->updater),
						'updater_email' => xxs_filter($get->updater_email),
						'updated_date' => date_time_ind_full($get->updated_date),
						
						'company' => enid_get($get->company),
						'company_name' => $get->company_name
						);								
						
				/* attachment */
				$target_attachment = array('a.id_request' => desid_get($target));
				
				$table_attachment = 'transport_request.attachment a';
				
				$query_attachment = $this->M_Global->M_Select_File($target_attachment,$table_attachment,2);
				
				$data['num_attachment'] = $query_attachment->num_rows();
				
				$data['result_attachment'] = $query_attachment->result();
				
				/* expense_type */
				$data['num_expense'] = $this->M_Global->M_ExpenseData($get->id_request,2)->num_rows();
				
				$data['expense'] = $this->M_Global->M_ExpenseData($get->id_request,2)->result();
					
				$this->load->view($form,$data);
			
			
			}elseif($act == 'Print' && desid_get($target) > 0){
				
				$get = $this->M_Request_Courier->M_Request_Courier_Detail(desid_get($target))->row();
				
				/*request option */
					if($get->request_option <= 0){
						$request_option_name = ph(1);
					}else{ $request_option_name = xxs_filter($get->request_option_name); }
					
				/* courier */	
					if($get->courier <= 0){
						$courier_name = ph(1);
					}else{ $courier_name = xxs_filter($get->courier_name); }
				
				/* external_name*/	
					if($get->external <= 0){
						$external_name = ph(1);
					}else{ $external_name = xxs_filter($get->external_name); }
				
				/* departur_vehicle */	
					if($get->departur_vehicle <= 0){
						$departur_name = ph(1);
					}else{ $departur_name = xxs_filter($get->departur_name); }
					
				/* return_vehicle */	
					if($get->return_vehicle <= 0){
						$return_name = ph(1);
					}else{ $return_name = xxs_filter($get->return_name); }
					
				/* delivery */	
					if($get->delivery <= 0){
						$delivery_name = ph(1);
					}else{ $delivery_name = xxs_filter($get->delivery_name); }
					
				/* expense_purpose */
					if($get->expense_purpose <= 0){
						$expense_purpose_name = ph(1);
					}else{ $expense_purpose_name = xxs_filter($get->expense_purpose_name); }
				
						$data = array(
						'set_menu' => '<li class="breadcrumb-item" aria-current="page">Request</li>',
						'set_submenu' => '<li class="breadcrumb-item" aria-current="page">Request Courier Data</li>',
						'set_action' => '<li class="breadcrumb-item" aria-current="page">Edit</li>',
						'action' => 'Edit',
						'target' => enid_get($get->id_request), 
						'no_request' => 'No.'.xxs_filter($get->no_request), 
						'request_option' => $get->request_option,
						'created_by' => enid_get($get->created_by), 
						'created_date' => date_time_ind_full($get->created_date), 
						'updated_by' => enid_get($get->updated_by), 
						'updated_date' => date_time_ind_full($get->updated_date), 
						'start_date' => date_ind($get->start_date),
						'start_time' => $get->start_time,
						'destination' => xxs_filter($get->destination),
						'description' => xxs_filter($get->description),
						
						'courier' => enid_get($get->courier),
						'external' => enid_get($get->external),
						'departur' => enid_get($get->departur_vehicle),
						'return' => enid_get($get->return_vehicle),
						'delivery' => enid_get($get->delivery),
								
						'status' => $get->status,
						'comment' => xxs_filter($get->comment),
						'requestor' => xxs_filter($get->requestor),
						'requestor_email' => xxs_filter($get->requestor_email),
						'request_option_name' => $request_option_name,
						'courier_name' => $courier_name,
						'external_name' => $external_name,
						'departur_name' => $departur_name,
						'return_name' => $return_name,
						'delivery_name' => $delivery_name,
						'updater' => xxs_filter($get->updater),
						
						'expense_purpose' => $get->expense_purpose,
						'expense_purpose_name' => $expense_purpose_name,
						'project_number' => xxs_filter($get->project_number),
						
						'finish_date' => date_ind($get->finish_date),
						'finish_time' => $get->finish_time,
						'creater' => xxs_filter($get->creater),
						'creater_email' => xxs_filter($get->creater_email),
						'created_date' => date_time_ind_full($get->created_date),
						'updater' => xxs_filter($get->updater),
						'updater_email' => xxs_filter($get->updater_email),
						'updated_date' => date_time_ind_full($get->updated_date),
						
						'company' => enid_get($get->company),
						'company_name' => $get->company_name
						);		
						
				/* expense_type */
				$data['num_expense'] = $this->M_Global->M_ExpenseData($get->id_request,2)->num_rows();
				
				$data['expense'] = $this->M_Global->M_ExpenseData($get->id_request,2)->result();
					
				$this->load->view('req_courier_print',$data);
			
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
		
		$id_request  			= (int)desid_get($this->input->post('input_target'));
		$request_option 		= (int)$this->input->post('input_request_option');
		$expense_purpose 		= (int)$this->input->post('input_expense_purpose');
		
		$input_project_number 	= (int)$this->input->post('input_project_number');
			if($expense_purpose == 8){ $project_number = $input_project_number; }
				else{$project_number = 0;}
		
		$start_date 			= date_input($this->input->post('input_start_date'));
		$start_time  			= $this->input->post('input_start_time');
	
		$destination 			= text_br_input(nl2br($this->input->post('input_destination')));
		$description 			= text_br_input(nl2br($this->input->post('input_description')));	
		
		$finish_date 			= date_input($this->input->post('input_finish_date'));
		$finish_time 			= time_input($this->input->post('input_finish_time'));
		
		$comment	 			= text_br_input(nl2br($this->input->post('input_comment')));
		$status	 	 			= (int)$this->input->post('input_status');
		
		$courier 	 			= (int)desid_get($this->input->post('input_courier'));
		$external 				= (int)desid_get($this->input->post('input_external'));
		$departur 	 			= (int)desid_get($this->input->post('input_departur'));
		$return 	 			= (int)desid_get($this->input->post('input_return'));
		$delivery 	 			= (int)desid_get($this->input->post('input_delivery'));
		
		$company 	 			= (int)desid_get($this->input->post('input_company'));
		
		$iduser					= (int)desid_get($this->session->userdata('id_tr'));
		$date					= my_date_time();
		$table					= 'transport_request.request_courier';
		
		
		$input_action  			= $this->input->post('input_action');
		
		if($input_action == 'send'){ 
			if($request_option == 6){ //personal motorcycle
				$status = 3; 
			}else{
				$status = 1; 	
			}
		}
		
		if($id_request <= 0){
			
			$val_no   = '/GS-COURIER/'.Romawi(date('m'));
			$no_request = $this->M_Global->Create_No_request($val_no,$table);
					
			$data = array(
				'no_request' => $no_request,
				'created_by' => $iduser,
				'created_date' => $date,
				'updated_by' => $iduser,
				'updated_date' => $date,
				'request_option' => $request_option,
				'start_date' => $start_date,
				'start_time' => $start_time,
				'finish_time' => $finish_time,
				'destination' => $destination,
				'description' => $description,
				'courier' => 0,
				'external' => 0,
				'status' => $status,
				'expense_purpose' => $expense_purpose,
				'project_number' => $project_number,
				'comment' => $comment,
				'read' => 0,
				'tone' => 0,
				'company' => $company
				);
				
			$trans_status = $this->M_Global->M_Save($table,$data);
			
			if($trans_status === TRUE){
				
				echo myalert('success','Data has been saved');
				
				$new_idtarget = $this->M_Global->M_CheckId('id_request',$table)->row();
				
				if($input_action == 'send'){ 
					$this->SendEmail($new_idtarget->id_request,1); 
				}
				
				$this->Form('Edit',enid_get($new_idtarget->id_request));
				
			
			}else{
				
				echo myalert('danger','Proccess failed');
				
				$this->Form('Add',enid_get(0));
			
			}
			
		}
		elseif($id_request > 0){
			
			$to_done = 0;
			if($courier > 0 || $external > 0 ){$to_done = 1;}
				
			if($finish_date != '' && $finish_time != '' && $to_done == 1 ){
				
				
				if($status == 2){
					$this->SendEmail($id_request,3);
				}
				
				$num_expense = 1;//$this->M_Global->M_ExpenseData($id_request,2)->num_rows();
				
				if($num_expense > 0){
					$status = 3;
				}
			}
			
			$data = array(
				'updated_by' => $iduser,
				'updated_date' => $date,
				'request_option' => $request_option,
				'start_date' => $start_date,
				'start_time' => $start_time,
				'destination' => $destination,
				'description' => $description,
				'status' => $status,
				'expense_purpose' => $expense_purpose,
				'project_number' => $project_number,
				'courier' => $courier,
				'external' => $external,
				'departur_vehicle' => $departur,
				'return_vehicle' => $return,
				'delivery' => $delivery,
				'finish_date' => $finish_date,
				'finish_time' => $finish_time,
				'comment' => $comment,
				'company' => $company
				);
				
			$target = array('id_request' => $id_request);
			
			$trans_status = $this->M_Global->M_Update($table,$data,$target);
			
			if($trans_status === TRUE){
				
				echo myalert('success','Data has been saved');
				
				if($input_action == 'send'){ 
					$this->SendEmail($id_request,1); 
				}
		
				$this->Form('Edit',enid_get($id_request));
			
			}else{
			
				echo myalert('danger','Proccess failed');
				
				$this->Form('Edit',enid_get($id_request));
				
			}
			
		} else {
		
			echo myalert('danger','Proccess failed');
			
			$this->Form('Add',enid_get(0));
			
			}
		
		}
	}
	
	public function Cancel()
	{
		if($this->session->userdata('id_tr') == ''){
			
			$this->M_Global->M_Logout();
			
		}else{

			$index = desid_get($this->input->post('input_index'));		
				
			$target = array('id_request' => $index);
			
			$data = array('status' => 4);
			
			$trans_status = $this->M_Global->M_Update('transport_request.request_courier',$data,$target);
				
				if($trans_status === TRUE){	
					
					echo myalert('success','Data has been canceled');
					
					$this->SendEmail($index,4); 
					
					$this->Form('Edit',enid_get($index));
				
				}else{	
				
					echo myalert('danger','Proccess failed');
					
					$this->Form('Edit',enid_get($index));
				}
			

		}
	}
	
	public function Upload_File()
	{
		if($this->session->userdata('id_tr') == ''){
			
			$this->M_Global->M_Logout();
			
		}else{

			$this->load->library('upload');
			$this->load->helper("file");
			
			$id_request  = (int)desid_get($this->input->post('input_target'));
			$iduser		 = (int)desid_get($this->session->userdata('id_tr'));
			$date		 = my_date_time();
			
			$file_name = my_file_name('Courier-');		
			$config['upload_path'] = './attachment/';		
			$config['allowed_types'] = 'pdf|png|jpg|jpeg';	
			$config['file_name'] = $file_name;
			
			$this->upload->initialize($config);
			
			if ($this->upload->do_upload('file_attachment')){
				
				$file = $this->upload->data();
				
				$data = array(
					'id_request' => $id_request,
					'attachment' => $file['file_name'],
					'flag' => 2,
					'created_by' => $iduser,
					'created_date' => $date
					);
				
				$table = 'transport_request.attachment';
				
				$trans_status = $this->M_Global->M_Save($table,$data);
				
				if($trans_status === TRUE){	
				
					echo'File has been uploaded';
				
				}else{	
				
					echo'Proses failed';	
					
				}
			}

		}
	}	
	
	public function Delete_File()
	{
		if($this->session->userdata('id_tr') == ''){
			
			$this->M_Global->M_Logout();
			
		}else{

			$this->load->library('upload');
			$this->load->helper("file");
			
			$id_attachment = desid_get($this->input->post('input_index'));
			$attachment	= $this->input->post('input_attachment');
			
				$table = 'transport_request.attachment';
				
				$target = array('id_attachment' => $id_attachment);
				
				$trans_status = $this->M_Global->M_Delete($table,$target);
				
				if($trans_status === TRUE){	
				
					unlink('./attachment/'.$attachment);
					
					echo'File has been deleted';
				
				}else{	
				
					echo'Proses failed';	
					
				}
			

		}
	}
	
	public function Search_List_Company()
	{												
		if($this->session->userdata('id_tr') == ''){
			
			$this->M_Global->M_Logout();
			
		}else{
		
			$src = string_src($this->input->post('input_src_list'));			
			
			$query = $this->M_Global->M_Search_List_Company($src)->result();
			
			foreach($query as $data){
				echo'<li><a href="#" 
				onclick="ListDataSelect(
				&#39;my-list-box-company&#39;,
				&#39;input_company&#39;,
				&#39;'.enid_get($data->id_parameter).'&#39;,
				&#39;input_company_name&#39;,
				&#39;'.$data->name.'&#39;
				)">'.$data->name.'</li>';
			}
			
		}
	}

	public function Search_List_Request_Option()
	{						
		if($this->session->userdata('id_tr') == ''){
			
			$this->M_Global->M_Logout();
			
		}else{
		
			$src = string_src($this->input->post('input_src_list'));			
			
			$query = $this->M_Request_Courier->M_Search_List_Request_Option($src)->result();
			
			foreach($query as $data){
				echo'<li><a href="#" 
				onclick="ListDataSelect(
				&#39;my-list-box-request_option&#39;,
				&#39;input_request_option&#39;,
				'.($data->id_parameter).',
				&#39;input_request_option_name&#39;,
				&#39;'.$data->name.'&#39;
				)">'.$data->name.'</li>';
			}
			
		}
	}		
	
	public function Search_List_Expense_Purpose()
	{						
		if($this->session->userdata('id_tr') == ''){
			
			$this->M_Global->M_Logout();
			
		}else{
		
			$src = string_src($this->input->post('input_src_list'));			
			
			$query = $this->M_Request_Courier->M_Search_List_Expense_Purpose($src)->result();
			
			foreach($query as $data){
				echo'<li><a href="#" 
				onclick="ListDataSelect(
				&#39;my-list-box-expense_purpose&#39;,
				&#39;input_expense_purpose&#39;,
				'.($data->id_parameter).',
				&#39;input_expense_purpose_name&#39;,
				&#39;'.$data->name.'&#39;
				)">'.$data->name.'</li>';
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

	public function Search_List_Courier()
	{						
		if($this->session->userdata('id_tr') == ''){
			
			$this->M_Global->M_Logout();
			
		}else{
		
			$src = string_src($this->input->post('input_src_list'));			
			
			$query = $this->M_Request_Courier->M_Search_List_Courier($src)->result();
			
			foreach($query as $data){
				echo'<li><a href="#" 
				onclick="ListDataSelect(
				&#39;my-list-box-courier&#39;,
				&#39;input_courier&#39;,
				&#39;'.enid_get($data->courier).'&#39;,
				&#39;input_courier_name&#39;,
				&#39;'.$data->courier_name.'&#39;
				)">'.$data->courier_name.'</li>';
			}
			
		}
	}			
	
	public function Search_List_External()
	{						
		if($this->session->userdata('id_tr') == ''){
			
			$this->M_Global->M_Logout();
			
		}else{
			
			$src = string_src($this->input->post('input_src_list'));			
			$target = array('id_parameter_category' => $this->session->userdata('set_external'));
			$query = $this->M_Global->M_List_Parameter_Src($target,strtoupper($src))->result();
			
			foreach($query as $data){
				echo'<li><a href="#" 
				onclick="ListDataSelect(
				&#39;my-list-box-external&#39;,
				&#39;input_external&#39;,
				&#39;'.enid_get($data->id_parameter).'&#39;,
				&#39;input_external_name&#39;,
				&#39;'.$data->name.'&#39;
				)">'.$data->name.'</li>';
			}
			
		}
	}	

	public function Search_List_Departur()
	{						
		if($this->session->userdata('id_tr') == ''){
			
			$this->M_Global->M_Logout();
			
		}else{
		
			$src = string_src($this->input->post('input_src_list'));			
			$target = array('id_parameter_category' => $this->session->userdata('set_external'));
			$query = $this->M_Global->M_List_Parameter_Src($target,strtoupper($src))->result();
			
			foreach($query as $data){
				echo'<li><a href="#" 
				onclick="ListDataSelect(
				&#39;my-list-box-departur&#39;,
				&#39;input_departur&#39;,
				&#39;'.enid_get($data->id_parameter).'&#39;,
				&#39;input_departur_name&#39;,
				&#39;'.$data->name.'&#39;
				)">'.$data->name.'</li>';
			}
			
		}
	}
	
	public function Search_List_Return()
	{						
		if($this->session->userdata('id_tr') == ''){
			
			$this->M_Global->M_Logout();
			
		}else{
		
			$src = string_src($this->input->post('input_src_list'));			
			$target = array('id_parameter_category' => $this->session->userdata('set_external'));
			$query = $this->M_Global->M_List_Parameter_Src($target,strtoupper($src))->result();
			
			foreach($query as $data){
				echo'<li><a href="#" 
				onclick="ListDataSelect(
				&#39;my-list-box-return&#39;,
				&#39;input_return&#39;,
				&#39;'.enid_get($data->id_parameter).'&#39;,
				&#39;input_return_name&#39;,
				&#39;'.$data->name.'&#39;
				)">'.$data->name.'</li>';
			}
			
		}
	}
	
	public function Search_List_Delivery()
	{						
		if($this->session->userdata('id_tr') == ''){
			
			$this->M_Global->M_Logout();
			
		}else{
		
			$target = array('id_parameter_category' => $this->session->userdata('set_delivery_status'));
			$query = $this->M_Global->M_List_Parameter($target)->result();
			
			foreach($query as $data){
				echo'<li><a href="#" 
				onclick="ListDataSelect(
				&#39;my-list-box-delivery&#39;,
				&#39;input_delivery&#39;,
				&#39;'.enid_get($data->id_parameter).'&#39;,
				&#39;input_delivery_name&#39;,
				&#39;'.$data->name.'&#39;
				)">'.$data->name.'</li>';
			}
			
		}
	}
	
	
	
	public function Read_Notif()
	{
		if($this->session->userdata('access_tr') == 25){//middle
			
		$data = array('read' => 1);
		$target = array('read' => 0,'status' => 1,'tone' => 1);
		$table = 'transport_request.request_courier';	
		$this->M_Global->M_Update($table,$data,$target);							

		}
	}	
	
	public function SendEmail($id_request,$status){
			
			$email 			= $this->session->userdata('email_tr');
			$subject 		= 'Notification Transport Request ('.status_transaction($status).')';			
			
				$get = $this->M_Request_Courier->M_Request_Courier_Detail($id_request)->row();
				
				$em_text_courier  = '';
				$em_text_external = '';
				$em_text_departur = '';
				$em_text_return   = '';
				$em_text_delivery = '';
				$em_text_finish   = '';
				$finish_time_personal   = '';
				
				if($status > 1){
					
					if($get->request_option == 5){
						
						if($get->courier > 0){ 
				
							$em_text_courier ='<tr>
								<td valign="top">Courier</td><td width="5px" valign="top">:</td>
								<td valign="top" align="left">'.$get->courier_name.'</td>
							</tr>';
						} 
						if($get->external > 0){
								
							$em_text_external = '<tr>
								<td valign="top">External</td><td width="5px" valign="top">:</td>
								<td valign="top" align="left">'.xxs_filter($get->external_name).'</td>
							</tr>';
						} 
						if($get->departur_vehicle > 0){
								
							$em_text_departur = '<tr>
								<td valign="top">Departure Vehicle</td><td width="5px" valign="top">:</td>
								<td valign="top" align="left">'.xxs_filter($get->departur_name).'</td>
							</tr>';
						}
						if($get->return_vehicle > 0){
								
							$em_text_return = '<tr>
								<td valign="top">Return Vehicle</td><td width="5px" valign="top">:</td>
								<td valign="top" align="left">'.xxs_filter($get->return_name).'</td>
							</tr>';
						}
						if($get->delivery > 0){
								
							$em_text_delivery = '<tr>
								<td valign="top">Delivery Status</td><td width="5px" valign="top">:</td>
								<td valign="top" align="left">'.xxs_filter($get->delivery_name).'</td>
							</tr>';
						}
						if($get->finish_date != ''){
								
							$em_text_finish = '<tr>
								<td valign="top">Return Date</td><td width="5px" valign="top">:</td>
								<td valign="top" align="left">'.date_ind($get->finish_date).' '.$get->finish_time.'</td>
							</tr>';
						}
						
						
					}else{
						
						if($get->finish_time){
								
							$finish_time_personal = xxs_filter($get->finish_time);
						}
						
					}
						
				}
			

				/* expense_type */
				$dt 	= $this->M_Global->M_Request_Sum($id_request,2)->row();
				
				$new_requestor = my_user_name($get->requestor,$get->requestor_email);
			
			$body = 
				'<center>
				<span class="my-heading"><h4>No.'.$get->no_request.'</h4></span><br>
				<hr> 
				</center>
					<table width="100%" class="table-condensed"><tr>
					<td valign="top" align="left">
						<table width="100%" class="table-condensed">
						<tr>
							<td width="32%" valign="top">Requestor</td><td width="5px" valign="top">:</td>
							<td width="68%" valign="top" align="left">'.$new_requestor.'</td>
						</tr>
						<tr>
							<td valign="top">Company</td><td width="5px" valign="top">:</td>
							<td valign="top" align="left">'.xxs_filter($get->company_name).'</td>
						</tr>
						<tr>
							<td valign="top">Request For</td><td width="5px" valign="top">:</td>
							<td valign="top" align="left">'.xxs_filter($get->request_option_name).'</td>
						</tr>
						<tr>
							<td valign="top">Departure Date</td><td width="5px" valign="top">:</td>
							<td valign="top" align="left">'.date_ind($get->start_date).' '.$get->start_time.' '.$finish_time_personal.'</td>
						</tr>
						<tr>
							<td valign="top">Destination</td><td width="5px" valign="top">:</td>
							<td valign="top" align="left">'.xxs_filter($get->destination).'</td>
						</tr>
						<tr>
							<td valign="top">Description</td><td width="5px" valign="top">:</td>
							<td valign="top" align="left">'.xxs_filter($get->description).'</td>
						</tr>
						<tr>
							<td valign="top">Comment</td><td width="5px" valign="top">:</td>
							<td valign="top" align="left">'.xxs_filter($get->comment).'</td>
						</tr>
						</table>
					</td>
					<td width="50%" valign="top" align="left">
						<table width="100%" class="table-condensed">'
			
						.$em_text_courier.$em_text_external.$em_text_departur.$em_text_return.$em_text_delivery.$em_text_finish.				
			
						'<tr>
							<td valign="top">Expense Total</td><td width="5px" valign="top">:</td>
							<td valign="top" align="left">'.curr_ind($dt->total).'</td>
						</tr>
						<tr>
							<td width="32%" valign="top">Request Status</td><td width="5px" valign="top">:</td>
							<td width="68%" valign="top" align="left">'.status_transaction($status).'</td>
						</tr>
						</table>
			
				</td>
				</tr></table>
		
				<hr><br>
				This email is sent automatically by the Transport Request system.<br>
				<a href="'.base_url().'">Unsubscribe</a>';
		
				$this->M_Global->M_SendEmail($email,$subject,$body);
			
		}
		
	public function Form_Expense($act,$id_request,$id_expense)
	{		
		if($this->session->userdata('id_tr') == ''){
			
			$this->M_Global->M_Logout();
			
		}else{
		
			if($act == 'Add' || desid_get($id_expense) == 0){
				
				$data = array(
				'action' => 'Add',
				'target' => $id_request,
				'target_control' => 'Request_Courier',
				'id_expense' => enid_get(0),
				'expense_type' => '',
				'expense_type_name' =>  ph(1),
				'balance' => ''
				);
				
				/* expense_type */
				$data['num_expense'] = $this->M_Global->M_ExpenseData(desid_get($id_request),2)->num_rows();
				
				$data['expense'] = $this->M_Global->M_ExpenseData(desid_get($id_request),2)->result();
				
				$this->load->view('req_expense_form',$data);
			
			}elseif($act == 'Edit' && desid_get($id_expense) > 0){
				
				$get = $this->M_Global->M_Expense_Detail(desid_get($id_expense),2)->row();
				
				$data = array(
				'action' => 'Edit',
				'target' => $id_request,
				'target_control' => 'Request_Courier',
				'id_expense' => enid_get($get->id_expense),
				'expense_type' => enid_get($get->expense_type),
				'expense_type_name' =>  xxs_filter($get->name),
				'balance' => ($get->balance)
				);
				
				/* expense_type */
				$data['num_expense'] = $this->M_Global->M_ExpenseData(desid_get($id_request),2)->num_rows();
				
				$data['expense'] = $this->M_Global->M_ExpenseData(desid_get($id_request),2)->result();
				
				$this->load->view('req_expense_form',$data);
				
			}
			
		}		
	}
	
	public function Save_Expense()
	{
		if($this->session->userdata('id_tr') == ''){
			
			$this->M_Global->M_Logout();
			
		}else{
			
			$id_request  	= (int)desid_get($this->input->post('input_target'));
			$id_expense  	= (int)desid_get($this->input->post('input_id_expense'));
			$expense_type 	= (int)desid_get($this->input->post('input_expense_type'));
			$balance 		= curr_ind_input($this->input->post('input_balance'));
			
			$iduser		 	= (int)desid_get($this->session->userdata('id_tr'));
			$date		 	= my_date_time();
			
			$table			= 'transport_request.request_expense';			
				
			if($expense_type == '') {
					
				echo myalert('danger','Please Complete The Text');
					
				if($id_expense <= 0){
						
					$this->Form_Expense('Add',enid_get($id_request),enid_get(0));
						
				}else{
					
					$this->Form_Expense('Edit',enid_get($id_request),enid_get($id_expense));
					
				}
				
			}else{
				
				if($id_expense <= 0){
					
					$check 			= $this->M_Global->M_Check_Expense($id_request,$expense_type,2)->num_rows();
			
					if($check > 0){
						
						echo myalert('danger','Item has been inputed');
						
						$this->Form_Expense('Add',enid_get($id_request),enid_get(0));
						
					} else {
						
						$data = array(
						'id_request' => $id_request,
						'expense_type' => $expense_type,
						'balance' => $balance,
						'status' => 1,
						'request' => 2
						);
					
						$trans_status = $this->M_Global->M_Save($table,$data);
					
						if($trans_status === TRUE){
							
							/* updated_by */
							$target_update = array('id_request' => $id_request);
							$data_update = array('updated_by' => $iduser,'updated_date' => $date);
							$this->M_Global->M_Update('transport_request.request_courier',$data_update,$target_update);
							
							echo myalert('success','Data has been saved');
							
							//$new_idtarget = $this->M_Global->M_CheckId('id_expense',$table)->row();
							//$this->Form_Expense('Edit',enid_get($id_request),enid_get($new_idtarget->id_expense));
							$this->Form_Expense('Add',enid_get($id_request),enid_get(0));
							
						}else {
							
							echo myalert('danger','Process failed');
							
							$this->Form_Expense('Add',enid_get($id_request),enid_get(0));
							
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
						$this->M_Global->M_Update('transport_request.request_courier',$data_update,$target_update);
						
						echo myalert('success','Data has been saved');
							
						$this->Form_Expense('Edit',enid_get($id_request),enid_get($id_expense));
						
					}else {
						
						echo myalert('danger','Process failed');
						
						$this->Form_Expense('Edit',enid_get($id_request),enid_get($id_expense));
						
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
					$this->M_Global->M_Update('transport_request.request_courier',$data_update,$target_update);	
						
					echo myalert('success','Data has been deleted');
					
					$this->Form_Expense('Add',enid_get($id_request),enid_get(0));
					
				} else {
					
					echo myalert('danger','Proccess failed');
					
					$this->Form_Expense('Add',enid_get($id_request),enid_get(0));
				}			
	
		}
	}
	
/* end */	
}
