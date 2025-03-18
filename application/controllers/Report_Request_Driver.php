<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_Request_Driver extends CI_Controller {

	Public function __construct(){
	parent::__construct();
		
		$this->load->model('M_Request_Driver');	
		$this->load->model('M_Report_Request_Driver');	
		
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
			
			$this->session->unset_userdata('page_rrd');
			$this->session->unset_userdata('next_rrd');
			$this->session->unset_userdata('src_rrd');
		
			$this->session->set_userdata('fild_a_rrd',0);
			$this->session->set_userdata('fild_b_rrd',0);
			$this->session->set_userdata('fild_c_rrd',0);
			$this->session->set_userdata('fild_d_rrd',0);
			$this->session->set_userdata('fild_e_rrd',0);
			$this->session->set_userdata('fild_f_rrd',0);
			$this->session->set_userdata('fild_g_rrd',0);
			$this->session->set_userdata('fild_h_rrd',0);
			$this->session->set_userdata('fild_i_rrd',0);
			
			$this->session->unset_userdata('filter_a_rrd');
			$this->session->unset_userdata('filter_b_rrd');
			$this->session->unset_userdata('filter_c_rrd');
			$this->session->unset_userdata('filter_d_rrd');
			$this->session->unset_userdata('filter_e_rrd');
			$this->session->unset_userdata('filter_st_rrd');	
			$this->session->unset_userdata('filter_date_aa_rrd');	
			$this->session->unset_userdata('filter_date_ab_rrd');
	
			$data['set_menu'] = '<li class="breadcrumb-item" aria-current="page">Request</li>';
			$data['set_submenu'] = '<li class="breadcrumb-item" aria-current="page">Request Driver Data</li>';
			$data['set_action'] = '';
			
			/* pagging */
			$myrow	= ($this->session->userdata('myrow_rrd')) ? $this->session->userdata('myrow_rrd'):25;
			$page	= ($this->session->userdata('page_rrd')) ? $this->session->userdata('page_rrd'):1;
			$next	= ($this->session->userdata('next_rrd')) ? $this->session->userdata('next_rrd'):1;
			$start 	= $myrow * ($page-1);
			
			/* src */
			$src		= ($this->session->userdata('src_rrd')) ? $this->session->userdata('src_rrd'):''; 
			
			/* oreder */
			$fild_a	= ($this->session->userdata('fild_a_rrd')) ? $this->session->userdata('fild_a_rrd'):0;
			$order_a	= ($this->session->userdata('order_a_rrd')) ? $this->session->userdata('order_a_rrd'):'ASC';
			$fild_b	= ($this->session->userdata('fild_b_rrd')) ? $this->session->userdata('fild_b_rrd'):0;
			$order_b	= ($this->session->userdata('order_b_rrd')) ? $this->session->userdata('order_b_rrd'):'ASC';
			$fild_c	= ($this->session->userdata('fild_c_rrd')) ? $this->session->userdata('fild_c_rrd'):0;
			$order_c	= ($this->session->userdata('order_c_rrd')) ? $this->session->userdata('order_c_rrd'):'ASC';
			$fild_d	= ($this->session->userdata('fild_d_rrd')) ? $this->session->userdata('fild_d_rrd'):0;
			$order_d	= ($this->session->userdata('order_d_rrd')) ? $this->session->userdata('order_d_rrd'):'ASC';
			$fild_e	= ($this->session->userdata('fild_e_rrd')) ? $this->session->userdata('fild_e_rrd'):0;
			$order_e	= ($this->session->userdata('order_e_rrd')) ? $this->session->userdata('order_e_rrd'):'ASC';
			$fild_f	= ($this->session->userdata('fild_f_rrd')) ? $this->session->userdata('fild_f_rrd'):0;
			$order_f	= ($this->session->userdata('order_f_rrd')) ? $this->session->userdata('order_f_rrd'):'ASC';
			$fild_g	= ($this->session->userdata('fild_g_rrd')) ? $this->session->userdata('fild_g_rrd'):0;
			$order_g	= ($this->session->userdata('order_g_rrd')) ? $this->session->userdata('order_g_rrd'):'ASC';
			$fild_h	= ($this->session->userdata('fild_h_rrd')) ? $this->session->userdata('fild_h_rrd'):0;
			$order_h	= ($this->session->userdata('order_h_rrd')) ? $this->session->userdata('order_h_rrd'):'ASC';
			$fild_i	= ($this->session->userdata('fild_i_rrd')) ? $this->session->userdata('fild_i_rrd'):0;
			$order_i	= ($this->session->userdata('order_i_rrd')) ? $this->session->userdata('order_i_rrd'):'ASC';
			
			$filter_a		= ($this->session->userdata('filter_a_rrd')) ? $this->session->userdata('filter_a_rrd'):'';
			$filter_b		= ($this->session->userdata('filter_b_rrd')) ? $this->session->userdata('filter_b_rrd'):'';
			$filter_c		= ($this->session->userdata('filter_c_rrd')) ? $this->session->userdata('filter_c_rrd'):'';
			$filter_d		= ($this->session->userdata('filter_d_rrd')) ? $this->session->userdata('filter_d_rrd'):'';
			$filter_e		= ($this->session->userdata('filter_e_rrd')) ? $this->session->userdata('filter_e_rrd'):'';
			$filter_st		= ($this->session->userdata('filter_st_rrd')) ? $this->session->userdata('filter_st_rrd'):'';
			$filter_date_aa	= ($this->session->userdata('filter_date_aa_rrd')) ? $this->session->userdata('filter_date_aa_rrd'):'';
			$filter_date_ab	= ($this->session->userdata('filter_date_ab_rrd')) ? $this->session->userdata('filter_date_ab_rrd'):'';
			
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
			'fild_h' => $fild_h,
			'order_h' => $order_h,
			'fild_i' => $fild_i,
			'order_i' => $order_i,
			'filter_a' => desid_get($filter_a),
			'filter_b' => desid_get($filter_b),
			'filter_c' => desid_get($filter_c),
			'filter_d' => desid_get($filter_d),
			'filter_e' => $filter_e,
			'filter_st' => $filter_st,
			'filter_date_aa' => $filter_date_aa,
			'filter_date_ab' => $filter_date_ab,
			'export' => 0
			);
			
			$data['num_data']		= $this->M_Report_Request_Driver->M_Report_Request_DriverNumRow($filter)->num_rows();
			$data['result_data']	= $this->M_Report_Request_Driver->M_Report_Request_DriverData($filter)->result();
			
			/* pagging */
			$data['max']			= (ceil($data['num_data']/$myrow)); 
			$data['myrow'] 			= $myrow; 
			$data['page'] 			= $page;
			$data['next'] 			= $next;		
			$data['start'] 			= $start;
			$data['controller']		= 'Report_Request_Driver';
			
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
			$data['fild_h'] = $fild_h; 
			$data['order_h']= $order_h; 
			$data['fild_i'] = $fild_i; 
			$data['order_i']= $order_i; 
			
		$this->load->view('report_req_driver',$data);
		
		}
	}
	
	public function Back()
	{
		if($this->session->userdata('id_tr') == ''){
			
			$this->M_Global->M_Logout();
			
		}else{
			
			$data['set_menu'] = '<li class="breadcrumb-item" aria-current="page">Request</li>';
			$data['set_submenu'] = '<li class="breadcrumb-item" aria-current="page">Request Driver Data</li>';
			$data['set_action'] = '';
				
			/* pagging */
			$myrow	= ($this->session->userdata('myrow_rrd')) ? $this->session->userdata('myrow_rrd'):25;
			$page	= ($this->session->userdata('page_rrd')) ? $this->session->userdata('page_rrd'):1;
			$next	= ($this->session->userdata('next_rrd')) ? $this->session->userdata('next_rrd'):1;
			$start 	= $myrow * ($page-1);
			
			/* src */
			$src		= ($this->session->userdata('src_rrd')) ? $this->session->userdata('src_rrd'):''; 
			
			/* oreder */
			$fild_a	= ($this->session->userdata('fild_a_rrd')) ? $this->session->userdata('fild_a_rrd'):0;
			$order_a	= ($this->session->userdata('order_a_rrd')) ? $this->session->userdata('order_a_rrd'):'ASC';
			$fild_b	= ($this->session->userdata('fild_b_rrd')) ? $this->session->userdata('fild_b_rrd'):0;
			$order_b	= ($this->session->userdata('order_b_rrd')) ? $this->session->userdata('order_b_rrd'):'ASC';
			$fild_c	= ($this->session->userdata('fild_c_rrd')) ? $this->session->userdata('fild_c_rrd'):0;
			$order_c	= ($this->session->userdata('order_c_rrd')) ? $this->session->userdata('order_c_rrd'):'ASC';
			$fild_d	= ($this->session->userdata('fild_d_rrd')) ? $this->session->userdata('fild_d_rrd'):0;
			$order_d	= ($this->session->userdata('order_d_rrd')) ? $this->session->userdata('order_d_rrd'):'ASC';
			$fild_e	= ($this->session->userdata('fild_e_rrd')) ? $this->session->userdata('fild_e_rrd'):0;
			$order_e	= ($this->session->userdata('order_e_rrd')) ? $this->session->userdata('order_e_rrd'):'ASC';
			$fild_f	= ($this->session->userdata('fild_f_rrd')) ? $this->session->userdata('fild_f_rrd'):0;
			$order_f	= ($this->session->userdata('order_f_rrd')) ? $this->session->userdata('order_f_rrd'):'ASC';
			$fild_g	= ($this->session->userdata('fild_g_rrd')) ? $this->session->userdata('fild_g_rrd'):0;
			$order_g	= ($this->session->userdata('order_g_rrd')) ? $this->session->userdata('order_g_rrd'):'ASC';
			$fild_h	= ($this->session->userdata('fild_h_rrd')) ? $this->session->userdata('fild_h_rrd'):0;
			$order_h	= ($this->session->userdata('order_h_rrd')) ? $this->session->userdata('order_h_rrd'):'ASC';
			$fild_i	= ($this->session->userdata('fild_i_rrd')) ? $this->session->userdata('fild_i_rrd'):0;
			$order_i	= ($this->session->userdata('order_i_rrd')) ? $this->session->userdata('order_i_rrd'):'ASC';
			
			$filter_a		= ($this->session->userdata('filter_a_rrd')) ? $this->session->userdata('filter_a_rrd'):'';
			$filter_b		= ($this->session->userdata('filter_b_rrd')) ? $this->session->userdata('filter_b_rrd'):'';
			$filter_c		= ($this->session->userdata('filter_c_rrd')) ? $this->session->userdata('filter_c_rrd'):'';
			$filter_d		= ($this->session->userdata('filter_d_rrd')) ? $this->session->userdata('filter_d_rrd'):'';
			$filter_e		= ($this->session->userdata('filter_e_rrd')) ? $this->session->userdata('filter_e_rrd'):'';
			$filter_st		= ($this->session->userdata('filter_st_rrd')) ? $this->session->userdata('filter_st_rrd'):'';
			$filter_date_aa	= ($this->session->userdata('filter_date_aa_rrd')) ? $this->session->userdata('filter_date_aa_rrd'):'';
			$filter_date_ab	= ($this->session->userdata('filter_date_ab_rrd')) ? $this->session->userdata('filter_date_ab_rrd'):'';
			
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
			'fild_h' => $fild_h,
			'order_h' => $order_h,
			'fild_i' => $fild_i,
			'order_i' => $order_i,
			'filter_a' => desid_get($filter_a),
			'filter_b' => desid_get($filter_b),
			'filter_c' => desid_get($filter_c),
			'filter_d' => desid_get($filter_d),
			'filter_e' => $filter_e,
			'filter_st' => $filter_st,
			'filter_date_aa' => $filter_date_aa,
			'filter_date_ab' => $filter_date_ab,
			'export' => 0
			);
			
			$data['num_data']		= $this->M_Report_Request_Driver->M_Report_Request_DriverNumRow($filter)->num_rows();
			$data['result_data']	= $this->M_Report_Request_Driver->M_Report_Request_DriverData($filter)->result();
			
			/* pagging */
			$data['max']			= (ceil($data['num_data']/$myrow)); 
			$data['myrow'] 			= $myrow; 
			$data['page'] 			= $page;
			$data['next'] 			= $next;		
			$data['start'] 			= $start;
			$data['controller']		= 'Report_Request_Driver';
			
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
			$data['fild_h'] = $fild_h; 
			$data['order_h']= $order_h; 
			$data['fild_i'] = $fild_i; 
			$data['order_i']= $order_i; 
		
		$this->load->view('report_req_driver',$data);
		
		}
	}

	public function Data_Table()
	{
		if($this->session->userdata('id_tr') == ''){
			
			$this->M_Global->M_Logout();
			
		}else{
			
			/* pagging */
			$myrow	= ($this->session->userdata('myrow_rrd')) ? $this->session->userdata('myrow_rrd'):25;
			$page	= ($this->session->userdata('page_rrd')) ? $this->session->userdata('page_rrd'):1;
			$next	= ($this->session->userdata('next_rrd')) ? $this->session->userdata('next_rrd'):1;
			$start 	= $myrow * ($page-1);
			
			/* src */
			$src		= ($this->session->userdata('src_rrd')) ? $this->session->userdata('src_rrd'):''; 
			
			/* oreder */
			$fild_a	= ($this->session->userdata('fild_a_rrd')) ? $this->session->userdata('fild_a_rrd'):0;
			$order_a	= ($this->session->userdata('order_a_rrd')) ? $this->session->userdata('order_a_rrd'):'ASC';
			$fild_b	= ($this->session->userdata('fild_b_rrd')) ? $this->session->userdata('fild_b_rrd'):0;
			$order_b	= ($this->session->userdata('order_b_rrd')) ? $this->session->userdata('order_b_rrd'):'ASC';
			$fild_c	= ($this->session->userdata('fild_c_rrd')) ? $this->session->userdata('fild_c_rrd'):0;
			$order_c	= ($this->session->userdata('order_c_rrd')) ? $this->session->userdata('order_c_rrd'):'ASC';
			$fild_d	= ($this->session->userdata('fild_d_rrd')) ? $this->session->userdata('fild_d_rrd'):0;
			$order_d	= ($this->session->userdata('order_d_rrd')) ? $this->session->userdata('order_d_rrd'):'ASC';
			$fild_e	= ($this->session->userdata('fild_e_rrd')) ? $this->session->userdata('fild_e_rrd'):0;
			$order_e	= ($this->session->userdata('order_e_rrd')) ? $this->session->userdata('order_e_rrd'):'ASC';
			$fild_f	= ($this->session->userdata('fild_f_rrd')) ? $this->session->userdata('fild_f_rrd'):0;
			$order_f	= ($this->session->userdata('order_f_rrd')) ? $this->session->userdata('order_f_rrd'):'ASC';
			$fild_g	= ($this->session->userdata('fild_g_rrd')) ? $this->session->userdata('fild_g_rrd'):0;
			$order_g	= ($this->session->userdata('order_g_rrd')) ? $this->session->userdata('order_g_rrd'):'ASC';
			$fild_h	= ($this->session->userdata('fild_h_rrd')) ? $this->session->userdata('fild_h_rrd'):0;
			$order_h	= ($this->session->userdata('order_h_rrd')) ? $this->session->userdata('order_h_rrd'):'ASC';
			$fild_i	= ($this->session->userdata('fild_i_rrd')) ? $this->session->userdata('fild_i_rrd'):0;
			$order_i	= ($this->session->userdata('order_i_rrd')) ? $this->session->userdata('order_i_rrd'):'ASC';
			
			$filter_a		= ($this->session->userdata('filter_a_rrd')) ? $this->session->userdata('filter_a_rrd'):'';
			$filter_b		= ($this->session->userdata('filter_b_rrd')) ? $this->session->userdata('filter_b_rrd'):'';
			$filter_c		= ($this->session->userdata('filter_c_rrd')) ? $this->session->userdata('filter_c_rrd'):'';
			$filter_d		= ($this->session->userdata('filter_d_rrd')) ? $this->session->userdata('filter_d_rrd'):'';
			$filter_e		= ($this->session->userdata('filter_e_rrd')) ? $this->session->userdata('filter_e_rrd'):'';
			$filter_st		= ($this->session->userdata('filter_st_rrd')) ? $this->session->userdata('filter_st_rrd'):'';
			$filter_date_aa	= ($this->session->userdata('filter_date_aa_rrd')) ? $this->session->userdata('filter_date_aa_rrd'):'';
			$filter_date_ab	= ($this->session->userdata('filter_date_ab_rrd')) ? $this->session->userdata('filter_date_ab_rrd'):'';
			
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
			'fild_h' => $fild_h,
			'order_h' => $order_h,
			'fild_i' => $fild_i,
			'order_i' => $order_i,
			'filter_a' => desid_get($filter_a),
			'filter_b' => desid_get($filter_b),
			'filter_c' => desid_get($filter_c),
			'filter_d' => desid_get($filter_d),
			'filter_e' => $filter_e,
			'filter_st' => $filter_st,
			'filter_date_aa' => $filter_date_aa,
			'filter_date_ab' => $filter_date_ab,
			'export' => 0
			);
			
			$data['num_data']		= $this->M_Report_Request_Driver->M_Report_Request_DriverNumRow($filter)->num_rows();
			$data['result_data']	= $this->M_Report_Request_Driver->M_Report_Request_DriverData($filter)->result();
			
			/* pagging */
			$data['max']			= (ceil($data['num_data']/$myrow)); 
			$data['myrow'] 			= $myrow; 
			$data['page'] 			= $page;
			$data['next'] 			= $next;		
			$data['start'] 			= $start;
			$data['controller']		= 'Report_Request_Driver';
			
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
			$data['fild_h'] = $fild_h; 
			$data['order_h']= $order_h; 
			$data['fild_i'] = $fild_i; 
			$data['order_i']= $order_i; 
		
		$this->load->view('report_req_driver_data',$data);
		
		}
	}
	
	
	Public function Order_a_asc()
	{
		if($this->session->userdata('id_tr')!=''){
			
		$this->session->set_userdata('fild_a_rrd',1);
		$this->session->set_userdata('fild_b_rrd',0);
		$this->session->set_userdata('fild_c_rrd',0);
		$this->session->set_userdata('fild_d_rrd',0);
		$this->session->set_userdata('fild_e_rrd',0);
		$this->session->set_userdata('fild_f_rrd',0);
		$this->session->set_userdata('fild_g_rrd',0);
		$this->session->set_userdata('fild_h_rrd',0);
		$this->session->set_userdata('fild_i_rrd',0);
		$this->session->set_userdata('order_a_rrd','ASC');		
		$this->Data_Table();
		
		}else{$this->M_logout->index();}
	}
	
	Public function Order_a_desc()
	{
		if($this->session->userdata('id_tr')!=''){
			
		$this->session->set_userdata('fild_a_rrd',1);
		$this->session->set_userdata('fild_b_rrd',0);
		$this->session->set_userdata('fild_c_rrd',0);
		$this->session->set_userdata('fild_d_rrd',0);
		$this->session->set_userdata('fild_e_rrd',0);
		$this->session->set_userdata('fild_f_rrd',0);
		$this->session->set_userdata('fild_g_rrd',0);
		$this->session->set_userdata('fild_h_rrd',0);
		$this->session->set_userdata('fild_i_rrd',0);
		$this->session->set_userdata('order_a_rrd','DESC');		
		$this->Data_Table();
		
		}else{$this->M_logout->index();}
	}
	
	Public function Order_b_asc()
	{
		if($this->session->userdata('id_tr')!=''){
			
		$this->session->set_userdata('fild_a_rrd',0);
		$this->session->set_userdata('fild_b_rrd',1);
		$this->session->set_userdata('fild_c_rrd',0);
		$this->session->set_userdata('fild_d_rrd',0);
		$this->session->set_userdata('fild_e_rrd',0);
		$this->session->set_userdata('fild_f_rrd',0);
		$this->session->set_userdata('fild_g_rrd',0);
		$this->session->set_userdata('fild_h_rrd',0);
		$this->session->set_userdata('fild_i_rrd',0);
		$this->session->set_userdata('order_b_rrd','ASC');		
		$this->Data_Table();
		
		}else{$this->M_logout->index();}
	}
	
	Public function Order_b_desc()
	{
		if($this->session->userdata('id_tr')!=''){
			
		$this->session->set_userdata('fild_a_rrd',0);
		$this->session->set_userdata('fild_b_rrd',1);
		$this->session->set_userdata('fild_c_rrd',0);
		$this->session->set_userdata('fild_d_rrd',0);
		$this->session->set_userdata('fild_e_rrd',0);
		$this->session->set_userdata('fild_f_rrd',0);
		$this->session->set_userdata('fild_g_rrd',0);
		$this->session->set_userdata('fild_h_rrd',0);
		$this->session->set_userdata('fild_i_rrd',0);
		$this->session->set_userdata('order_b_rrd','DESC');		
		$this->Data_Table();
		
		}else{$this->M_logout->index();}
	}

	Public function Order_c_asc()
	{
		if($this->session->userdata('id_tr')!=''){
			
		$this->session->set_userdata('fild_a_rrd',0);
		$this->session->set_userdata('fild_b_rrd',0);
		$this->session->set_userdata('fild_c_rrd',1);
		$this->session->set_userdata('fild_d_rrd',0);
		$this->session->set_userdata('fild_e_rrd',0);
		$this->session->set_userdata('fild_f_rrd',0);
		$this->session->set_userdata('fild_g_rrd',0);
		$this->session->set_userdata('fild_h_rrd',0);
		$this->session->set_userdata('fild_i_rrd',0);
		$this->session->set_userdata('order_c_rrd','ASC');		
		$this->Data_Table();
		
		}else{$this->M_logout->index();}
	}
	
	Public function Order_c_desc()
	{
		if($this->session->userdata('id_tr')!=''){
			
		$this->session->set_userdata('fild_a_rrd',0);
		$this->session->set_userdata('fild_b_rrd',0);
		$this->session->set_userdata('fild_c_rrd',1);
		$this->session->set_userdata('fild_d_rrd',0);
		$this->session->set_userdata('fild_e_rrd',0);
		$this->session->set_userdata('fild_f_rrd',0);
		$this->session->set_userdata('fild_g_rrd',0);
		$this->session->set_userdata('fild_h_rrd',0);
		$this->session->set_userdata('fild_i_rrd',0);
		$this->session->set_userdata('order_c_rrd','DESC');		
		$this->Data_Table();
		
		}else{$this->M_logout->index();}
	}


	Public function Order_d_asc()
	{
		if($this->session->userdata('id_tr')!=''){
			
		$this->session->set_userdata('fild_a_rrd',0);
		$this->session->set_userdata('fild_b_rrd',0);
		$this->session->set_userdata('fild_c_rrd',0);
		$this->session->set_userdata('fild_d_rrd',1);
		$this->session->set_userdata('fild_e_rrd',0);
		$this->session->set_userdata('fild_f_rrd',0);
		$this->session->set_userdata('fild_g_rrd',0);
		$this->session->set_userdata('fild_h_rrd',0);
		$this->session->set_userdata('fild_i_rrd',0);
		$this->session->set_userdata('order_d_rrd','ASC');		
		$this->Data_Table();
		
		}else{$this->M_logout->index();}
	}
	
	Public function Order_d_desc()
	{
		if($this->session->userdata('id_tr')!=''){
			
		$this->session->set_userdata('fild_a_rrd',0);
		$this->session->set_userdata('fild_b_rrd',0);
		$this->session->set_userdata('fild_c_rrd',0);
		$this->session->set_userdata('fild_d_rrd',1);
		$this->session->set_userdata('fild_e_rrd',0);
		$this->session->set_userdata('fild_f_rrd',0);
		$this->session->set_userdata('fild_g_rrd',0);
		$this->session->set_userdata('fild_h_rrd',0);
		$this->session->set_userdata('fild_i_rrd',0);
		$this->session->set_userdata('order_d_rrd','DESC');		
		$this->Data_Table();
		
		}else{$this->M_logout->index();}
	}


	Public function Order_e_asc()
	{
		if($this->session->userdata('id_tr')!=''){
			
		$this->session->set_userdata('fild_a_rrd',0);
		$this->session->set_userdata('fild_b_rrd',0);
		$this->session->set_userdata('fild_c_rrd',0);
		$this->session->set_userdata('fild_d_rrd',0);
		$this->session->set_userdata('fild_e_rrd',1);
		$this->session->set_userdata('fild_f_rrd',0);
		$this->session->set_userdata('fild_g_rrd',0);
		$this->session->set_userdata('fild_h_rrd',0);
		$this->session->set_userdata('fild_i_rrd',0);
		$this->session->set_userdata('order_e_rrd','ASC');	
		$this->Data_Table();
		
		}else{$this->M_logout->index();}
	}
	
	Public function Order_e_desc()
	{
		if($this->session->userdata('id_tr')!=''){
			
		$this->session->set_userdata('fild_a_rrd',0);
		$this->session->set_userdata('fild_b_rrd',0);
		$this->session->set_userdata('fild_c_rrd',0);
		$this->session->set_userdata('fild_d_rrd',0);
		$this->session->set_userdata('fild_e_rrd',1);
		$this->session->set_userdata('fild_f_rrd',0);
		$this->session->set_userdata('fild_g_rrd',0);
		$this->session->set_userdata('fild_h_rrd',0);
		$this->session->set_userdata('fild_i_rrd',0);
		$this->session->set_userdata('order_e_rrd','DESC');		
		$this->Data_Table();
		
		}else{$this->M_logout->index();}
	}

	Public function Order_f_asc()
	{
		if($this->session->userdata('id_tr')!=''){
			
		$this->session->set_userdata('fild_a_rrd',0);
		$this->session->set_userdata('fild_b_rrd',0);
		$this->session->set_userdata('fild_c_rrd',0);
		$this->session->set_userdata('fild_d_rrd',0);
		$this->session->set_userdata('fild_e_rrd',0);
		$this->session->set_userdata('fild_f_rrd',1);
		$this->session->set_userdata('fild_g_rrd',0);
		$this->session->set_userdata('fild_h_rrd',0);
		$this->session->set_userdata('fild_i_rrd',0);
		$this->session->set_userdata('order_f_rrd','ASC');		
		$this->Data_Table();
		
		}else{$this->M_logout->index();}
	}
	
	Public function Order_f_desc()
	{
		if($this->session->userdata('id_tr')!=''){
			
		$this->session->set_userdata('fild_a_rrd',0);
		$this->session->set_userdata('fild_b_rrd',0);
		$this->session->set_userdata('fild_c_rrd',0);
		$this->session->set_userdata('fild_d_rrd',0);
		$this->session->set_userdata('fild_e_rrd',0);
		$this->session->set_userdata('fild_f_rrd',1);
		$this->session->set_userdata('fild_g_rrd',0);
		$this->session->set_userdata('fild_h_rrd',0);
		$this->session->set_userdata('fild_i_rrd',0);
		$this->session->set_userdata('order_f_rrd','DESC');		
		$this->Data_Table();
		
		}else{$this->M_logout->index();}
	}	
	
	Public function Order_g_asc()
	{
		if($this->session->userdata('id_tr')!=''){
			
		$this->session->set_userdata('fild_a_rrd',0);
		$this->session->set_userdata('fild_b_rrd',0);
		$this->session->set_userdata('fild_c_rrd',0);
		$this->session->set_userdata('fild_d_rrd',0);
		$this->session->set_userdata('fild_e_rrd',0);
		$this->session->set_userdata('fild_f_rrd',0);
		$this->session->set_userdata('fild_g_rrd',1);
		$this->session->set_userdata('fild_h_rrd',0);
		$this->session->set_userdata('fild_i_rrd',0);
		$this->session->set_userdata('order_g_rrd','ASC');		
		$this->Data_Table();
		
		}else{$this->M_logout->index();}
	}
	
	Public function Order_g_desc()
	{
		if($this->session->userdata('id_tr')!=''){
			
		$this->session->set_userdata('fild_a_rrd',0);
		$this->session->set_userdata('fild_b_rrd',0);
		$this->session->set_userdata('fild_c_rrd',0);
		$this->session->set_userdata('fild_d_rrd',0);
		$this->session->set_userdata('fild_e_rrd',0);
		$this->session->set_userdata('fild_f_rrd',0);
		$this->session->set_userdata('fild_g_rrd',1);
		$this->session->set_userdata('fild_h_rrd',0);
		$this->session->set_userdata('fild_i_rrd',0);
		$this->session->set_userdata('order_g_rrd','DESC');		
		$this->Data_Table();
		
		}else{$this->M_logout->index();}
	}	
	
	Public function Order_h_asc()
	{
		if($this->session->userdata('id_tr')!=''){
			
		$this->session->set_userdata('fild_a_rrd',0);
		$this->session->set_userdata('fild_b_rrd',0);
		$this->session->set_userdata('fild_c_rrd',0);
		$this->session->set_userdata('fild_d_rrd',0);
		$this->session->set_userdata('fild_e_rrd',0);
		$this->session->set_userdata('fild_f_rrd',0);
		$this->session->set_userdata('fild_g_rrd',0);
		$this->session->set_userdata('fild_h_rrd',1);
		$this->session->set_userdata('fild_i_rrd',0);
		$this->session->set_userdata('order_h_rrd','ASC');		
		$this->Data_Table();
		
		}else{$this->M_logout->index();}
	}
	
	Public function Order_h_desc()
	{
		if($this->session->userdata('id_tr')!=''){
			
		$this->session->set_userdata('fild_a_rrd',0);
		$this->session->set_userdata('fild_b_rrd',0);
		$this->session->set_userdata('fild_c_rrd',0);
		$this->session->set_userdata('fild_d_rrd',0);
		$this->session->set_userdata('fild_e_rrd',0);
		$this->session->set_userdata('fild_f_rrd',0);
		$this->session->set_userdata('fild_g_rrd',0);
		$this->session->set_userdata('fild_h_rrd',1);
		$this->session->set_userdata('fild_i_rrd',0);
		$this->session->set_userdata('order_h_rrd','DESC');		
		$this->Data_Table();
		
		}else{$this->M_logout->index();}
	}	
	
	Public function Order_i_asc()
	{
		if($this->session->userdata('id_tr')!=''){
			
		$this->session->set_userdata('fild_a_rrd',0);
		$this->session->set_userdata('fild_b_rrd',0);
		$this->session->set_userdata('fild_c_rrd',0);
		$this->session->set_userdata('fild_d_rrd',0);
		$this->session->set_userdata('fild_e_rrd',0);
		$this->session->set_userdata('fild_f_rrd',0);
		$this->session->set_userdata('fild_g_rrd',0);
		$this->session->set_userdata('fild_h_rrd',0);
		$this->session->set_userdata('fild_i_rrd',1);
		$this->session->set_userdata('order_i_rrd','ASC');		
		$this->Data_Table();
		
		}else{$this->M_logout->index();}
	}
	
	Public function Order_i_desc()
	{
		if($this->session->userdata('id_tr')!=''){
			
		$this->session->set_userdata('fild_a_rrd',0);
		$this->session->set_userdata('fild_b_rrd',0);
		$this->session->set_userdata('fild_c_rrd',0);
		$this->session->set_userdata('fild_d_rrd',0);
		$this->session->set_userdata('fild_e_rrd',0);
		$this->session->set_userdata('fild_f_rrd',0);
		$this->session->set_userdata('fild_g_rrd',0);
		$this->session->set_userdata('fild_h_rrd',0);
		$this->session->set_userdata('fild_i_rrd',1);
		$this->session->set_userdata('order_i_rrd','DESC');		
		$this->Data_Table();
		
		}else{$this->M_logout->index();}
	}	
	
	public function Rows($val)
	{
			$this->session->unset_userdata('page_rrd');
			$this->session->unset_userdata('next_rrd');
			$this->session->set_userdata('myrow_rrd',$val);		
			$this->Data_Table();
		
	}
	
	public function Search()
	{						
			$this->session->unset_userdata('page_rrd');
			$this->session->unset_userdata('next_rrd');
			
			$src = string_src($this->input->post('input_src'));			
			
			$this->session->set_userdata('src_rrd',$src);
			
			$this->Data_Table();
	}
	
	public function Page()
	{
	
			$page	= ($this->uri->segment('3')) ? $this->uri->segment('3'):1; 
			$next 	= ($this->uri->segment('4')) ? $this->uri->segment('4'):1; 
			
			$this->session->set_userdata('page_rrd',$page);
			$this->session->set_userdata('next_rrd',$next);
			
			$this->Data_Table();

	}
	
	public function Form($act,$target)
	{		
		if($this->session->userdata('id_tr') == ''){
			
			$this->M_Global->M_Logout();
			
		}else{
			
			$access_tr = $this->session->userdata('access_tr');
			
			if($act == 'Edit' && desid_get($target) > 0){
				
				$get = $this->M_Report_Request_Driver->M_Report_Request_Driver_Detail(desid_get($target))->row();
				
				/*request option */
					if($get->request_option <= 0){
						$request_option_name = ph(1);
					}else{ $request_option_name = xxs_filter($get->request_option_name); }
					
				/* driver */	
					if($get->driver <= 0){
						$driver_name = ph(1);
					}else{ $driver_name = xxs_filter($get->driver_name); }
				
				/* car */	
					if($get->car <= 0){
						$car_name = ph(1);
					}else{ $car_name = xxs_filter($get->car_name); }
					
				/* external_name*/	
					if($get->external <= 0){
						$external_name = ph(1);
					}else{ $external_name = xxs_filter($get->external_name); }
					
				/* expense_purpose */
					if($get->expense_purpose <= 0){
						$expense_purpose_name = ph(1);
					}else{ $expense_purpose_name = xxs_filter($get->expense_purpose_name); }
				
						$data = array(
						'set_menu' => '<li class="breadcrumb-item" aria-current="page">Request</li>',
						'set_submenu' => '<li class="breadcrumb-item" aria-current="page">Request Driver Data</li>',
						'set_action' => '<li class="breadcrumb-item" aria-current="page">Detail</li>',
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
						'return_plan_date' => date_ind($get->return_plan_date),
						'return_plan_time' => $get->return_plan_time,
						'destination' => xxs_filter($get->destination),
						'description' => xxs_filter($get->description),
						
						'driver' => enid_get($get->driver),
						'car' => enid_get($get->car),
						'external' => enid_get($get->external),
						
						'status' => $get->status,
						'comment' => xxs_filter($get->comment),
						'requestor' => xxs_filter($get->requestor),
						'requestor_email' => xxs_filter($get->requestor_email),
						'request_option_name' => $request_option_name,
						'driver_name' => $driver_name,
						'car_name' => $car_name,
						'external_name' => $external_name,
						'updater' => xxs_filter($get->updater),
						
						'begin_km' => xxs_filter($get->begin_km),
						'end_km' => xxs_filter($get->end_km),
						
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
						'updated_date' => date_time_ind_full($get->updated_date)
						);								
						
				/* attachment */
				$target_attachment = array('a.id_request' => desid_get($target));
				
				$table_attachment = 'transport_request.attachment a';
				
				$query_attachment = $this->M_Global->M_Select_File($target_attachment,$table_attachment,1);
				
				$data['num_attachment'] = $query_attachment->num_rows();
				
				$data['result_attachment'] = $query_attachment->result();
				
				/* expense_type */
				$data['num_expense'] = $this->M_Global->M_ExpenseData($get->id_request,1)->num_rows();
				
				$data['expense'] = $this->M_Global->M_ExpenseData($get->id_request,1)->result();
					
				$this->load->view('report_req_driver_detail',$data);
			
			
			}elseif($act == 'Print' && desid_get($target) > 0){
				
				$get = $this->M_Report_Request_Driver->M_Report_Request_Driver_Detail(desid_get($target))->row();
				
				/*request option */
					if($get->request_option <= 0){
						$request_option_name = ph(1);
					}else{ $request_option_name = xxs_filter($get->request_option_name); }
					
				/* driver */	
					if($get->driver <= 0){
						$driver_name = ph(1);
					}else{ $driver_name = xxs_filter($get->driver_name); }
				
				/* car */	
					if($get->car <= 0){
						$car_name = ph(1);
					}else{ $car_name = xxs_filter($get->car_name); }
					
				/* external_name*/	
					if($get->external <= 0){
						$external_name = ph(1);
					}else{ $external_name = xxs_filter($get->external_name); }
					
				/* expense_purpose */
					if($get->expense_purpose <= 0){
						$expense_purpose_name = ph(1);
					}else{ $expense_purpose_name = xxs_filter($get->expense_purpose_name); }
				
						$data = array(
						'set_menu' => '<li class="breadcrumb-item" aria-current="page">Request</li>',
						'set_submenu' => '<li class="breadcrumb-item" aria-current="page">Request Driver Data</li>',
						'set_action' => '<li class="breadcrumb-item" aria-current="page">Detail</li>',
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
						'return_plan_date' => date_ind($get->return_plan_date),
						'return_plan_time' => $get->return_plan_time,
						'destination' => xxs_filter($get->destination),
						'description' => xxs_filter($get->description),
						
						'driver' => enid_get($get->driver),
						'car' => enid_get($get->car),
						'external' => enid_get($get->external),
						
						'status' => $get->status,
						'comment' => xxs_filter($get->comment),
						'requestor' => xxs_filter($get->requestor),
						'requestor_email' => xxs_filter($get->requestor_email),
						'request_option_name' => $request_option_name,
						'driver_name' => $driver_name,
						'car_name' => $car_name,
						'external_name' => $external_name,
						'updater' => xxs_filter($get->updater),
						
						'begin_km' => xxs_filter($get->begin_km),
						'end_km' => xxs_filter($get->end_km),
						
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
						
				/* attachment */
				$target_attachment = array('a.id_request' => desid_get($target));
				
				$table_attachment = 'transport_request.attachment a';
				
				$query_attachment = $this->M_Global->M_Select_File($target_attachment,$table_attachment,1);
				
				$data['num_attachment'] = $query_attachment->num_rows();
				
				$data['result_attachment'] = $query_attachment->result();
				
				/* expense_type */
				$data['num_expense'] = $this->M_Global->M_ExpenseData($get->id_request,1)->num_rows();
				
				$data['expense'] = $this->M_Global->M_ExpenseData($get->id_request,1)->result();
					
				$this->load->view('req_driver_print',$data);
			
			
			}else{
			
				$this->Error_404();
			
			}
		
		}
	}
	
	public function Filter_Search_List_Requestor()
	{						
		if($this->session->userdata('id_tr') == ''){
			
			$this->M_Global->M_Logout();
			
		}else{
		
			$src = string_src($this->input->post('input_src_list'));			
			
			$query = $this->M_Report_Request_Driver->M_Filter_Search_List_Requestor($src)->result();
			
			foreach($query as $data){
				
				echo'<li onclick="LoadDataTable(&#39;Report_Request_Driver/Filter_List_a/'.enid_get($data->id_login).'&#39;)"><a href="#">'.$data->requestor.'</a></li>';
			
			}
			
		}
	}		
	
	public function Filter_Search_List_Department()
	{						
		if($this->session->userdata('id_tr') == ''){
			
			$this->M_Global->M_Logout();
			
		}else{
		
			$src = string_src($this->input->post('input_src_list'));			
			
			$query = $this->M_Report_Request_Driver->M_Filter_Search_List_Department($src)->result();
			
			foreach($query as $data){
				
				echo'<li onclick="LoadDataTable(&#39;Report_Request_Driver/Filter_List_b/'.enid_get($data->id_department).'&#39;)"><a href="#">'.$data->department.'</a></li>';
			
			}
			
		}
	}	
	
	public function Filter_Search_List_Request()
	{						
		if($this->session->userdata('id_tr') == ''){
			
			$this->M_Global->M_Logout();
			
		}else{
		
			$src = string_src($this->input->post('input_src_list'));			
			
			$query = $this->M_Report_Request_Driver->M_Filter_Search_List_Request($src)->result();
			
			foreach($query as $data){
				
				echo'<li onclick="LoadDataTable(&#39;Report_Request_Driver/Filter_List_c/'.enid_get($data->request_option).'&#39;)"><a href="#">'.$data->name.'</a></li>';
			
			}
			
		}
	}
	
	public function Filter_Search_List_Driver()
	{						
		if($this->session->userdata('id_tr') == ''){
			
			$this->M_Global->M_Logout();
			
		}else{
		
			$src = string_src($this->input->post('input_src_list'));			
			
			$query = $this->M_Report_Request_Driver->M_Filter_Search_List_Driver($src)->result();
			
			foreach($query as $data){
				
				echo'<li onclick="LoadDataTable(&#39;Report_Request_Driver/Filter_List_d/'.enid_get($data->driver).'&#39;)"><a href="#">'.$data->name.'</a></li>';
			
			}
			
		}
	}
	
	public function Filter_Search_List_Purpose()
	{						
		if($this->session->userdata('id_tr') == ''){
			
			$this->M_Global->M_Logout();
			
		}else{
		
			$src = string_src($this->input->post('input_src_list'));			
			
			$query = $this->M_Report_Request_Driver->M_Filter_Search_List_Purpose($src)->result();
			
			foreach($query as $data){
				
				echo'<li onclick="LoadDataTable(&#39;Report_Request_Driver/Filter_List_e/'.enid_get($data->expense_purpose).'&#39;)"><a href="#">'.$data->name.'</a></li>';
			
			}
			
		}
	}
	
	public function Filter_List_a($target)
	{
		$this->session->set_userdata('filter_a_rrd',$target);		
		$this->Data_Table();
		
	}
	
	public function Filter_List_b($target)
	{
		$this->session->set_userdata('filter_b_rrd',$target);		
		$this->Data_Table();
		
	}

	public function Filter_List_c($target)
	{
		$this->session->set_userdata('filter_c_rrd',$target);		
		$this->Data_Table();
		
	}
	
	public function Filter_List_d($target)
	{
		$this->session->set_userdata('filter_d_rrd',$target);		
		$this->Data_Table();
		
	}
	
	public function Filter_List_e($target)
	{
		$this->session->set_userdata('filter_e_rrd',$target);		
		$this->Data_Table();
		
	}
	
	public function Filter_Balance($target)
	{
		$this->session->set_userdata('filter_e_rrd',$target);		
		$this->Data_Table();
		
	}
	
	public function Filter_Status($target)
	{
		$this->session->set_userdata('filter_st_rrd',$target);		
		$this->Data_Table();
		
	}

	public function Filter_Date_a()
	{
		$date_aa	= date_input($this->input->post('input_date_a'));
		$date_ab	= date_input($this->input->post('input_date_b'));
		
		$this->session->set_userdata('filter_date_aa_rrd',$date_aa);
		$this->session->set_userdata('filter_date_ab_rrd',$date_ab);
		
		$this->Data_Table();
		
	}
	
	
	
	public function Export($export)
	{
		if($this->session->userdata('id_tr') == ''){
			
			$this->M_Global->M_Logout();
			
		}else{
		
			/* pagging */
			$myrow	= ($this->session->userdata('myrow_rrd')) ? $this->session->userdata('myrow_rrd'):25;
			$page	= ($this->session->userdata('page_rrd')) ? $this->session->userdata('page_rrd'):1;
			$next	= ($this->session->userdata('next_rrd')) ? $this->session->userdata('next_rrd'):1;
			$start 	= $myrow * ($page-1);
			
			/* src */
			$src		= ($this->session->userdata('src_rrd')) ? $this->session->userdata('src_rrd'):''; 
			
			/* oreder */
			$fild_a	= ($this->session->userdata('fild_a_rrd')) ? $this->session->userdata('fild_a_rrd'):0;
			$order_a	= ($this->session->userdata('order_a_rrd')) ? $this->session->userdata('order_a_rrd'):'ASC';
			$fild_b	= ($this->session->userdata('fild_b_rrd')) ? $this->session->userdata('fild_b_rrd'):0;
			$order_b	= ($this->session->userdata('order_b_rrd')) ? $this->session->userdata('order_b_rrd'):'ASC';
			$fild_c	= ($this->session->userdata('fild_c_rrd')) ? $this->session->userdata('fild_c_rrd'):0;
			$order_c	= ($this->session->userdata('order_c_rrd')) ? $this->session->userdata('order_c_rrd'):'ASC';
			$fild_d	= ($this->session->userdata('fild_d_rrd')) ? $this->session->userdata('fild_d_rrd'):0;
			$order_d	= ($this->session->userdata('order_d_rrd')) ? $this->session->userdata('order_d_rrd'):'ASC';
			$fild_e	= ($this->session->userdata('fild_e_rrd')) ? $this->session->userdata('fild_e_rrd'):0;
			$order_e	= ($this->session->userdata('order_e_rrd')) ? $this->session->userdata('order_e_rrd'):'ASC';
			$fild_f	= ($this->session->userdata('fild_f_rrd')) ? $this->session->userdata('fild_f_rrd'):0;
			$order_f	= ($this->session->userdata('order_f_rrd')) ? $this->session->userdata('order_f_rrd'):'ASC';
			$fild_g	= ($this->session->userdata('fild_g_rrd')) ? $this->session->userdata('fild_g_rrd'):0;
			$order_g	= ($this->session->userdata('order_g_rrd')) ? $this->session->userdata('order_g_rrd'):'ASC';
			$fild_h	= ($this->session->userdata('fild_h_rrd')) ? $this->session->userdata('fild_h_rrd'):0;
			$order_h	= ($this->session->userdata('order_h_rrd')) ? $this->session->userdata('order_h_rrd'):'ASC';
			$fild_i	= ($this->session->userdata('fild_i_rrd')) ? $this->session->userdata('fild_i_rrd'):0;
			$order_i	= ($this->session->userdata('order_i_rrd')) ? $this->session->userdata('order_i_rrd'):'ASC';
			
			$filter_a		= ($this->session->userdata('filter_a_rrd')) ? $this->session->userdata('filter_a_rrd'):'';
			$filter_b		= ($this->session->userdata('filter_b_rrd')) ? $this->session->userdata('filter_b_rrd'):'';
			$filter_c		= ($this->session->userdata('filter_c_rrd')) ? $this->session->userdata('filter_c_rrd'):'';
			$filter_d		= ($this->session->userdata('filter_d_rrd')) ? $this->session->userdata('filter_d_rrd'):'';
			$filter_e		= ($this->session->userdata('filter_e_rrd')) ? $this->session->userdata('filter_e_rrd'):'';
			$filter_st		= ($this->session->userdata('filter_st_rrd')) ? $this->session->userdata('filter_st_rrd'):'';
			$filter_date_aa	= ($this->session->userdata('filter_date_aa_rrd')) ? $this->session->userdata('filter_date_aa_rrd'):'';
			$filter_date_ab	= ($this->session->userdata('filter_date_ab_rrd')) ? $this->session->userdata('filter_date_ab_rrd'):'';
			
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
			'fild_h' => $fild_h,
			'order_h' => $order_h,
			'fild_i' => $fild_i,
			'order_i' => $order_i,
			'filter_a' => desid_get($filter_a),
			'filter_b' => desid_get($filter_b),
			'filter_c' => desid_get($filter_c),
			'filter_d' => desid_get($filter_d),
			'filter_e' => $filter_e,
			'filter_st' => $filter_st,
			'filter_date_aa' => $filter_date_aa,
			'filter_date_ab' => $filter_date_ab,
			'export' => 1
			);
			
			$data['num_data']		= $this->M_Report_Request_Driver->M_Report_Request_DriverNumRow($filter)->num_rows();
			$data['result_data']	= $this->M_Report_Request_Driver->M_Report_Request_DriverData($filter)->result();
			
			$data['export_to']	 = $export;
			
			$this->load->view('report_req_driver_export',$data);
		}
	}
		

/* end */	
}
