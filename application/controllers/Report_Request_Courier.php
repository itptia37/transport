<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_Request_Courier extends CI_Controller {

	Public function __construct(){
	parent::__construct();
		
		$this->load->model('M_Request_Courier');	
		$this->load->model('M_Report_Request_Courier');	
		
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
			
			$this->session->unset_userdata('page_rrc');
			$this->session->unset_userdata('next_rrc');
			$this->session->unset_userdata('src_rrc');
		
			$this->session->set_userdata('fild_a_rrc',0);
			$this->session->set_userdata('fild_b_rrc',0);
			$this->session->set_userdata('fild_c_rrc',0);
			$this->session->set_userdata('fild_d_rrc',0);
			$this->session->set_userdata('fild_e_rrc',0);
			$this->session->set_userdata('fild_f_rrc',0);
			$this->session->set_userdata('fild_g_rrc',0);
			$this->session->set_userdata('fild_h_rrc',0);
			$this->session->set_userdata('fild_i_rrc',0);
			
			$this->session->unset_userdata('filter_a_rrc');
			$this->session->unset_userdata('filter_b_rrc');
			$this->session->unset_userdata('filter_c_rrc');
			$this->session->unset_userdata('filter_d_rrc');
			$this->session->unset_userdata('filter_e_rrc');
			$this->session->unset_userdata('filter_f_rrc');
			$this->session->unset_userdata('filter_st_rrc');	
			$this->session->unset_userdata('filter_date_aa_rrc');	
			$this->session->unset_userdata('filter_date_ab_rrc');
	
			$data['set_menu'] = '<li class="breadcrumb-item" aria-current="page">Request</li>';
			$data['set_submenu'] = '<li class="breadcrumb-item" aria-current="page">Request Courier Data</li>';
			$data['set_action'] = '';
			
			/* pagging */
			$myrow	= ($this->session->userdata('myrow_rrc')) ? $this->session->userdata('myrow_rrc'):25;
			$page	= ($this->session->userdata('page_rrc')) ? $this->session->userdata('page_rrc'):1;
			$next	= ($this->session->userdata('next_rrc')) ? $this->session->userdata('next_rrc'):1;
			$start 	= $myrow * ($page-1);
			
			/* src */
			$src		= ($this->session->userdata('src_rrc')) ? $this->session->userdata('src_rrc'):''; 
			
			/* oreder */
			$fild_a	= ($this->session->userdata('fild_a_rrc')) ? $this->session->userdata('fild_a_rrc'):0;
			$order_a	= ($this->session->userdata('order_a_rrc')) ? $this->session->userdata('order_a_rrc'):'ASC';
			$fild_b	= ($this->session->userdata('fild_b_rrc')) ? $this->session->userdata('fild_b_rrc'):0;
			$order_b	= ($this->session->userdata('order_b_rrc')) ? $this->session->userdata('order_b_rrc'):'ASC';
			$fild_c	= ($this->session->userdata('fild_c_rrc')) ? $this->session->userdata('fild_c_rrc'):0;
			$order_c	= ($this->session->userdata('order_c_rrc')) ? $this->session->userdata('order_c_rrc'):'ASC';
			$fild_d	= ($this->session->userdata('fild_d_rrc')) ? $this->session->userdata('fild_d_rrc'):0;
			$order_d	= ($this->session->userdata('order_d_rrc')) ? $this->session->userdata('order_d_rrc'):'ASC';
			$fild_e	= ($this->session->userdata('fild_e_rrc')) ? $this->session->userdata('fild_e_rrc'):0;
			$order_e	= ($this->session->userdata('order_e_rrc')) ? $this->session->userdata('order_e_rrc'):'ASC';
			$fild_f	= ($this->session->userdata('fild_f_rrc')) ? $this->session->userdata('fild_f_rrc'):0;
			$order_f	= ($this->session->userdata('order_f_rrc')) ? $this->session->userdata('order_f_rrc'):'ASC';
			$fild_g	= ($this->session->userdata('fild_g_rrc')) ? $this->session->userdata('fild_g_rrc'):0;
			$order_g	= ($this->session->userdata('order_g_rrc')) ? $this->session->userdata('order_g_rrc'):'ASC';
			$fild_h	= ($this->session->userdata('fild_h_rrc')) ? $this->session->userdata('fild_h_rrc'):0;
			$order_h	= ($this->session->userdata('order_h_rrc')) ? $this->session->userdata('order_h_rrc'):'ASC';
			$fild_i	= ($this->session->userdata('fild_i_rrc')) ? $this->session->userdata('fild_i_rrc'):0;
			$order_i	= ($this->session->userdata('order_i_rrc')) ? $this->session->userdata('order_i_rrc'):'ASC';
			
			$filter_a		= ($this->session->userdata('filter_a_rrc')) ? $this->session->userdata('filter_a_rrc'):'';
			$filter_b		= ($this->session->userdata('filter_b_rrc')) ? $this->session->userdata('filter_b_rrc'):'';
			$filter_c		= ($this->session->userdata('filter_c_rrc')) ? $this->session->userdata('filter_c_rrc'):'';
			$filter_d		= ($this->session->userdata('filter_d_rrc')) ? $this->session->userdata('filter_d_rrc'):'';
			$filter_e		= ($this->session->userdata('filter_e_rrc')) ? $this->session->userdata('filter_e_rrc'):'';
			$filter_f		= ($this->session->userdata('filter_f_rrc')) ? $this->session->userdata('filter_f_rrc'):'';
			$filter_st		= ($this->session->userdata('filter_st_rrc')) ? $this->session->userdata('filter_st_rrc'):'';
			$filter_date_aa	= ($this->session->userdata('filter_date_aa_rrc')) ? $this->session->userdata('filter_date_aa_rrc'):'';
			$filter_date_ab	= ($this->session->userdata('filter_date_ab_rrc')) ? $this->session->userdata('filter_date_ab_rrc'):'';
			
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
			'filter_e' => desid_get($filter_e),
			'filter_f' => $filter_f,
			'filter_st' => $filter_st,
			'filter_date_aa' => $filter_date_aa,
			'filter_date_ab' => $filter_date_ab,
			'export' => 0
			);
			
			$data['num_data']		= $this->M_Report_Request_Courier->M_Report_Request_CourierNumRow($filter)->num_rows();
			$data['result_data']	= $this->M_Report_Request_Courier->M_Report_Request_CourierData($filter)->result();
			
			/* pagging */
			$data['max']			= (ceil($data['num_data']/$myrow)); 
			$data['myrow'] 			= $myrow; 
			$data['page'] 			= $page;
			$data['next'] 			= $next;		
			$data['start'] 			= $start;
			$data['controller']		= 'Report_Request_Courier';
			
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
			
		$this->load->view('report_req_courier',$data);
		
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
			$myrow	= ($this->session->userdata('myrow_rrc')) ? $this->session->userdata('myrow_rrc'):25;
			$page	= ($this->session->userdata('page_rrc')) ? $this->session->userdata('page_rrc'):1;
			$next	= ($this->session->userdata('next_rrc')) ? $this->session->userdata('next_rrc'):1;
			$start 	= $myrow * ($page-1);
			
			/* src */
			$src		= ($this->session->userdata('src_rrc')) ? $this->session->userdata('src_rrc'):''; 
			
			/* oreder */
			$fild_a	= ($this->session->userdata('fild_a_rrc')) ? $this->session->userdata('fild_a_rrc'):0;
			$order_a	= ($this->session->userdata('order_a_rrc')) ? $this->session->userdata('order_a_rrc'):'ASC';
			$fild_b	= ($this->session->userdata('fild_b_rrc')) ? $this->session->userdata('fild_b_rrc'):0;
			$order_b	= ($this->session->userdata('order_b_rrc')) ? $this->session->userdata('order_b_rrc'):'ASC';
			$fild_c	= ($this->session->userdata('fild_c_rrc')) ? $this->session->userdata('fild_c_rrc'):0;
			$order_c	= ($this->session->userdata('order_c_rrc')) ? $this->session->userdata('order_c_rrc'):'ASC';
			$fild_d	= ($this->session->userdata('fild_d_rrc')) ? $this->session->userdata('fild_d_rrc'):0;
			$order_d	= ($this->session->userdata('order_d_rrc')) ? $this->session->userdata('order_d_rrc'):'ASC';
			$fild_e	= ($this->session->userdata('fild_e_rrc')) ? $this->session->userdata('fild_e_rrc'):0;
			$order_e	= ($this->session->userdata('order_e_rrc')) ? $this->session->userdata('order_e_rrc'):'ASC';
			$fild_f	= ($this->session->userdata('fild_f_rrc')) ? $this->session->userdata('fild_f_rrc'):0;
			$order_f	= ($this->session->userdata('order_f_rrc')) ? $this->session->userdata('order_f_rrc'):'ASC';
			$fild_g	= ($this->session->userdata('fild_g_rrc')) ? $this->session->userdata('fild_g_rrc'):0;
			$order_g	= ($this->session->userdata('order_g_rrc')) ? $this->session->userdata('order_g_rrc'):'ASC';
			$fild_h	= ($this->session->userdata('fild_h_rrc')) ? $this->session->userdata('fild_h_rrc'):0;
			$order_h	= ($this->session->userdata('order_h_rrc')) ? $this->session->userdata('order_h_rrc'):'ASC';
			$fild_i	= ($this->session->userdata('fild_i_rrc')) ? $this->session->userdata('fild_i_rrc'):0;
			$order_i	= ($this->session->userdata('order_i_rrc')) ? $this->session->userdata('order_i_rrc'):'ASC';
			
			$filter_a		= ($this->session->userdata('filter_a_rrc')) ? $this->session->userdata('filter_a_rrc'):'';
			$filter_b		= ($this->session->userdata('filter_b_rrc')) ? $this->session->userdata('filter_b_rrc'):'';
			$filter_c		= ($this->session->userdata('filter_c_rrc')) ? $this->session->userdata('filter_c_rrc'):'';
			$filter_d		= ($this->session->userdata('filter_d_rrc')) ? $this->session->userdata('filter_d_rrc'):'';
			$filter_e		= ($this->session->userdata('filter_e_rrc')) ? $this->session->userdata('filter_e_rrc'):'';
			$filter_f		= ($this->session->userdata('filter_f_rrc')) ? $this->session->userdata('filter_f_rrc'):'';
			$filter_st		= ($this->session->userdata('filter_st_rrc')) ? $this->session->userdata('filter_st_rrc'):'';
			$filter_date_aa	= ($this->session->userdata('filter_date_aa_rrc')) ? $this->session->userdata('filter_date_aa_rrc'):'';
			$filter_date_ab	= ($this->session->userdata('filter_date_ab_rrc')) ? $this->session->userdata('filter_date_ab_rrc'):'';
			
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
			'filter_e' => desid_get($filter_e),
			'filter_f' => $filter_f,
			'filter_st' => $filter_st,
			'filter_date_aa' => $filter_date_aa,
			'filter_date_ab' => $filter_date_ab,
			'export' => 0
			);
			
			$data['num_data']		= $this->M_Report_Request_Courier->M_Report_Request_CourierNumRow($filter)->num_rows();
			$data['result_data']	= $this->M_Report_Request_Courier->M_Report_Request_CourierData($filter)->result();
			
			/* pagging */
			$data['max']			= (ceil($data['num_data']/$myrow)); 
			$data['myrow'] 			= $myrow; 
			$data['page'] 			= $page;
			$data['next'] 			= $next;		
			$data['start'] 			= $start;
			$data['controller']		= 'Report_Request_Courier';
			
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
		
		$this->load->view('report_req_courier',$data);
		
		}
	}

	public function Data_Table()
	{
		if($this->session->userdata('id_tr') == ''){
			
			$this->M_Global->M_Logout();
			
		}else{
			
			/* pagging */
			$myrow	= ($this->session->userdata('myrow_rrc')) ? $this->session->userdata('myrow_rrc'):25;
			$page	= ($this->session->userdata('page_rrc')) ? $this->session->userdata('page_rrc'):1;
			$next	= ($this->session->userdata('next_rrc')) ? $this->session->userdata('next_rrc'):1;
			$start 	= $myrow * ($page-1);
			
			/* src */
			$src		= ($this->session->userdata('src_rrc')) ? $this->session->userdata('src_rrc'):''; 
			
			/* oreder */
			$fild_a	= ($this->session->userdata('fild_a_rrc')) ? $this->session->userdata('fild_a_rrc'):0;
			$order_a	= ($this->session->userdata('order_a_rrc')) ? $this->session->userdata('order_a_rrc'):'ASC';
			$fild_b	= ($this->session->userdata('fild_b_rrc')) ? $this->session->userdata('fild_b_rrc'):0;
			$order_b	= ($this->session->userdata('order_b_rrc')) ? $this->session->userdata('order_b_rrc'):'ASC';
			$fild_c	= ($this->session->userdata('fild_c_rrc')) ? $this->session->userdata('fild_c_rrc'):0;
			$order_c	= ($this->session->userdata('order_c_rrc')) ? $this->session->userdata('order_c_rrc'):'ASC';
			$fild_d	= ($this->session->userdata('fild_d_rrc')) ? $this->session->userdata('fild_d_rrc'):0;
			$order_d	= ($this->session->userdata('order_d_rrc')) ? $this->session->userdata('order_d_rrc'):'ASC';
			$fild_e	= ($this->session->userdata('fild_e_rrc')) ? $this->session->userdata('fild_e_rrc'):0;
			$order_e	= ($this->session->userdata('order_e_rrc')) ? $this->session->userdata('order_e_rrc'):'ASC';
			$fild_f	= ($this->session->userdata('fild_f_rrc')) ? $this->session->userdata('fild_f_rrc'):0;
			$order_f	= ($this->session->userdata('order_f_rrc')) ? $this->session->userdata('order_f_rrc'):'ASC';
			$fild_g	= ($this->session->userdata('fild_g_rrc')) ? $this->session->userdata('fild_g_rrc'):0;
			$order_g	= ($this->session->userdata('order_g_rrc')) ? $this->session->userdata('order_g_rrc'):'ASC';
			$fild_h	= ($this->session->userdata('fild_h_rrc')) ? $this->session->userdata('fild_h_rrc'):0;
			$order_h	= ($this->session->userdata('order_h_rrc')) ? $this->session->userdata('order_h_rrc'):'ASC';
			$fild_i	= ($this->session->userdata('fild_i_rrc')) ? $this->session->userdata('fild_i_rrc'):0;
			$order_i	= ($this->session->userdata('order_i_rrc')) ? $this->session->userdata('order_i_rrc'):'ASC';
			
			$filter_a		= ($this->session->userdata('filter_a_rrc')) ? $this->session->userdata('filter_a_rrc'):'';
			$filter_b		= ($this->session->userdata('filter_b_rrc')) ? $this->session->userdata('filter_b_rrc'):'';
			$filter_c		= ($this->session->userdata('filter_c_rrc')) ? $this->session->userdata('filter_c_rrc'):'';
			$filter_d		= ($this->session->userdata('filter_d_rrc')) ? $this->session->userdata('filter_d_rrc'):'';
			$filter_e		= ($this->session->userdata('filter_e_rrc')) ? $this->session->userdata('filter_e_rrc'):'';
			$filter_f		= ($this->session->userdata('filter_f_rrc')) ? $this->session->userdata('filter_f_rrc'):'';
			$filter_st		= ($this->session->userdata('filter_st_rrc')) ? $this->session->userdata('filter_st_rrc'):'';
			$filter_date_aa	= ($this->session->userdata('filter_date_aa_rrc')) ? $this->session->userdata('filter_date_aa_rrc'):'';
			$filter_date_ab	= ($this->session->userdata('filter_date_ab_rrc')) ? $this->session->userdata('filter_date_ab_rrc'):'';
			
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
			'filter_e' => desid_get($filter_e),
			'filter_f' => $filter_f,
			'filter_st' => $filter_st,
			'filter_date_aa' => $filter_date_aa,
			'filter_date_ab' => $filter_date_ab,
			'export' => 0
			);
			
			$data['num_data']		= $this->M_Report_Request_Courier->M_Report_Request_CourierNumRow($filter)->num_rows();
			$data['result_data']	= $this->M_Report_Request_Courier->M_Report_Request_CourierData($filter)->result();
			
			/* pagging */
			$data['max']			= (ceil($data['num_data']/$myrow)); 
			$data['myrow'] 			= $myrow; 
			$data['page'] 			= $page;
			$data['next'] 			= $next;		
			$data['start'] 			= $start;
			$data['controller']		= 'Report_Request_Courier';
			
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
		
		$this->load->view('report_req_courier_data',$data);
		
		}
	}
	
	
	Public function Order_a_asc()
	{
		if($this->session->userdata('id_tr')!=''){
			
		$this->session->set_userdata('fild_a_rrc',1);
		$this->session->set_userdata('fild_b_rrc',0);
		$this->session->set_userdata('fild_c_rrc',0);
		$this->session->set_userdata('fild_d_rrc',0);
		$this->session->set_userdata('fild_e_rrc',0);
		$this->session->set_userdata('fild_f_rrc',0);
		$this->session->set_userdata('fild_g_rrc',0);
		$this->session->set_userdata('fild_h_rrc',0);
		$this->session->set_userdata('fild_i_rrc',0);
		$this->session->set_userdata('order_a_rrc','ASC');		
		$this->Data_Table();
		
		}else{$this->M_logout->index();}
	}
	
	Public function Order_a_desc()
	{
		if($this->session->userdata('id_tr')!=''){
			
		$this->session->set_userdata('fild_a_rrc',1);
		$this->session->set_userdata('fild_b_rrc',0);
		$this->session->set_userdata('fild_c_rrc',0);
		$this->session->set_userdata('fild_d_rrc',0);
		$this->session->set_userdata('fild_e_rrc',0);
		$this->session->set_userdata('fild_f_rrc',0);
		$this->session->set_userdata('fild_g_rrc',0);
		$this->session->set_userdata('fild_h_rrc',0);
		$this->session->set_userdata('fild_i_rrc',0);
		$this->session->set_userdata('order_a_rrc','DESC');		
		$this->Data_Table();
		
		}else{$this->M_logout->index();}
	}
	
	Public function Order_b_asc()
	{
		if($this->session->userdata('id_tr')!=''){
			
		$this->session->set_userdata('fild_a_rrc',0);
		$this->session->set_userdata('fild_b_rrc',1);
		$this->session->set_userdata('fild_c_rrc',0);
		$this->session->set_userdata('fild_d_rrc',0);
		$this->session->set_userdata('fild_e_rrc',0);
		$this->session->set_userdata('fild_f_rrc',0);
		$this->session->set_userdata('fild_g_rrc',0);
		$this->session->set_userdata('fild_h_rrc',0);
		$this->session->set_userdata('fild_i_rrc',0);
		$this->session->set_userdata('order_b_rrc','ASC');		
		$this->Data_Table();
		
		}else{$this->M_logout->index();}
	}
	
	Public function Order_b_desc()
	{
		if($this->session->userdata('id_tr')!=''){
			
		$this->session->set_userdata('fild_a_rrc',0);
		$this->session->set_userdata('fild_b_rrc',1);
		$this->session->set_userdata('fild_c_rrc',0);
		$this->session->set_userdata('fild_d_rrc',0);
		$this->session->set_userdata('fild_e_rrc',0);
		$this->session->set_userdata('fild_f_rrc',0);
		$this->session->set_userdata('fild_g_rrc',0);
		$this->session->set_userdata('fild_h_rrc',0);
		$this->session->set_userdata('fild_i_rrc',0);
		$this->session->set_userdata('order_b_rrc','DESC');		
		$this->Data_Table();
		
		}else{$this->M_logout->index();}
	}

	Public function Order_c_asc()
	{
		if($this->session->userdata('id_tr')!=''){
			
		$this->session->set_userdata('fild_a_rrc',0);
		$this->session->set_userdata('fild_b_rrc',0);
		$this->session->set_userdata('fild_c_rrc',1);
		$this->session->set_userdata('fild_d_rrc',0);
		$this->session->set_userdata('fild_e_rrc',0);
		$this->session->set_userdata('fild_f_rrc',0);
		$this->session->set_userdata('fild_g_rrc',0);
		$this->session->set_userdata('fild_h_rrc',0);
		$this->session->set_userdata('fild_i_rrc',0);
		$this->session->set_userdata('order_c_rrc','ASC');		
		$this->Data_Table();
		
		}else{$this->M_logout->index();}
	}
	
	Public function Order_c_desc()
	{
		if($this->session->userdata('id_tr')!=''){
			
		$this->session->set_userdata('fild_a_rrc',0);
		$this->session->set_userdata('fild_b_rrc',0);
		$this->session->set_userdata('fild_c_rrc',1);
		$this->session->set_userdata('fild_d_rrc',0);
		$this->session->set_userdata('fild_e_rrc',0);
		$this->session->set_userdata('fild_f_rrc',0);
		$this->session->set_userdata('fild_g_rrc',0);
		$this->session->set_userdata('fild_h_rrc',0);
		$this->session->set_userdata('fild_i_rrc',0);
		$this->session->set_userdata('order_c_rrc','DESC');		
		$this->Data_Table();
		
		}else{$this->M_logout->index();}
	}


	Public function Order_d_asc()
	{
		if($this->session->userdata('id_tr')!=''){
			
		$this->session->set_userdata('fild_a_rrc',0);
		$this->session->set_userdata('fild_b_rrc',0);
		$this->session->set_userdata('fild_c_rrc',0);
		$this->session->set_userdata('fild_d_rrc',1);
		$this->session->set_userdata('fild_e_rrc',0);
		$this->session->set_userdata('fild_f_rrc',0);
		$this->session->set_userdata('fild_g_rrc',0);
		$this->session->set_userdata('fild_h_rrc',0);
		$this->session->set_userdata('fild_i_rrc',0);
		$this->session->set_userdata('order_d_rrc','ASC');		
		$this->Data_Table();
		
		}else{$this->M_logout->index();}
	}
	
	Public function Order_d_desc()
	{
		if($this->session->userdata('id_tr')!=''){
			
		$this->session->set_userdata('fild_a_rrc',0);
		$this->session->set_userdata('fild_b_rrc',0);
		$this->session->set_userdata('fild_c_rrc',0);
		$this->session->set_userdata('fild_d_rrc',1);
		$this->session->set_userdata('fild_e_rrc',0);
		$this->session->set_userdata('fild_f_rrc',0);
		$this->session->set_userdata('fild_g_rrc',0);
		$this->session->set_userdata('fild_h_rrc',0);
		$this->session->set_userdata('fild_i_rrc',0);
		$this->session->set_userdata('order_d_rrc','DESC');		
		$this->Data_Table();
		
		}else{$this->M_logout->index();}
	}


	Public function Order_e_asc()
	{
		if($this->session->userdata('id_tr')!=''){
			
		$this->session->set_userdata('fild_a_rrc',0);
		$this->session->set_userdata('fild_b_rrc',0);
		$this->session->set_userdata('fild_c_rrc',0);
		$this->session->set_userdata('fild_d_rrc',0);
		$this->session->set_userdata('fild_e_rrc',1);
		$this->session->set_userdata('fild_f_rrc',0);
		$this->session->set_userdata('fild_g_rrc',0);
		$this->session->set_userdata('fild_h_rrc',0);
		$this->session->set_userdata('fild_i_rrc',0);
		$this->session->set_userdata('order_e_rrc','ASC');	
		$this->Data_Table();
		
		}else{$this->M_logout->index();}
	}
	
	Public function Order_e_desc()
	{
		if($this->session->userdata('id_tr')!=''){
			
		$this->session->set_userdata('fild_a_rrc',0);
		$this->session->set_userdata('fild_b_rrc',0);
		$this->session->set_userdata('fild_c_rrc',0);
		$this->session->set_userdata('fild_d_rrc',0);
		$this->session->set_userdata('fild_e_rrc',1);
		$this->session->set_userdata('fild_f_rrc',0);
		$this->session->set_userdata('fild_g_rrc',0);
		$this->session->set_userdata('fild_h_rrc',0);
		$this->session->set_userdata('fild_i_rrc',0);
		$this->session->set_userdata('order_e_rrc','DESC');		
		$this->Data_Table();
		
		}else{$this->M_logout->index();}
	}

	Public function Order_f_asc()
	{
		if($this->session->userdata('id_tr')!=''){
			
		$this->session->set_userdata('fild_a_rrc',0);
		$this->session->set_userdata('fild_b_rrc',0);
		$this->session->set_userdata('fild_c_rrc',0);
		$this->session->set_userdata('fild_d_rrc',0);
		$this->session->set_userdata('fild_e_rrc',0);
		$this->session->set_userdata('fild_f_rrc',1);
		$this->session->set_userdata('fild_g_rrc',0);
		$this->session->set_userdata('fild_h_rrc',0);
		$this->session->set_userdata('fild_i_rrc',0);
		$this->session->set_userdata('order_f_rrc','ASC');		
		$this->Data_Table();
		
		}else{$this->M_logout->index();}
	}
	
	Public function Order_f_desc()
	{
		if($this->session->userdata('id_tr')!=''){
			
		$this->session->set_userdata('fild_a_rrc',0);
		$this->session->set_userdata('fild_b_rrc',0);
		$this->session->set_userdata('fild_c_rrc',0);
		$this->session->set_userdata('fild_d_rrc',0);
		$this->session->set_userdata('fild_e_rrc',0);
		$this->session->set_userdata('fild_f_rrc',1);
		$this->session->set_userdata('fild_g_rrc',0);
		$this->session->set_userdata('fild_h_rrc',0);
		$this->session->set_userdata('fild_i_rrc',0);
		$this->session->set_userdata('order_f_rrc','DESC');		
		$this->Data_Table();
		
		}else{$this->M_logout->index();}
	}	
	
	Public function Order_g_asc()
	{
		if($this->session->userdata('id_tr')!=''){
			
		$this->session->set_userdata('fild_a_rrc',0);
		$this->session->set_userdata('fild_b_rrc',0);
		$this->session->set_userdata('fild_c_rrc',0);
		$this->session->set_userdata('fild_d_rrc',0);
		$this->session->set_userdata('fild_e_rrc',0);
		$this->session->set_userdata('fild_f_rrc',0);
		$this->session->set_userdata('fild_g_rrc',1);
		$this->session->set_userdata('fild_h_rrc',0);
		$this->session->set_userdata('fild_i_rrc',0);
		$this->session->set_userdata('order_g_rrc','ASC');		
		$this->Data_Table();
		
		}else{$this->M_logout->index();}
	}
	
	Public function Order_g_desc()
	{
		if($this->session->userdata('id_tr')!=''){
			
		$this->session->set_userdata('fild_a_rrc',0);
		$this->session->set_userdata('fild_b_rrc',0);
		$this->session->set_userdata('fild_c_rrc',0);
		$this->session->set_userdata('fild_d_rrc',0);
		$this->session->set_userdata('fild_e_rrc',0);
		$this->session->set_userdata('fild_f_rrc',0);
		$this->session->set_userdata('fild_g_rrc',1);
		$this->session->set_userdata('fild_h_rrc',0);
		$this->session->set_userdata('fild_i_rrc',0);
		$this->session->set_userdata('order_g_rrc','DESC');		
		$this->Data_Table();
		
		}else{$this->M_logout->index();}
	}	
	
	Public function Order_h_asc()
	{
		if($this->session->userdata('id_tr')!=''){
			
		$this->session->set_userdata('fild_a_rrc',0);
		$this->session->set_userdata('fild_b_rrc',0);
		$this->session->set_userdata('fild_c_rrc',0);
		$this->session->set_userdata('fild_d_rrc',0);
		$this->session->set_userdata('fild_e_rrc',0);
		$this->session->set_userdata('fild_f_rrc',0);
		$this->session->set_userdata('fild_g_rrc',0);
		$this->session->set_userdata('fild_h_rrc',1);
		$this->session->set_userdata('fild_i_rrc',0);
		$this->session->set_userdata('order_h_rrc','ASC');		
		$this->Data_Table();
		
		}else{$this->M_logout->index();}
	}
	
	Public function Order_h_desc()
	{
		if($this->session->userdata('id_tr')!=''){
			
		$this->session->set_userdata('fild_a_rrc',0);
		$this->session->set_userdata('fild_b_rrc',0);
		$this->session->set_userdata('fild_c_rrc',0);
		$this->session->set_userdata('fild_d_rrc',0);
		$this->session->set_userdata('fild_e_rrc',0);
		$this->session->set_userdata('fild_f_rrc',0);
		$this->session->set_userdata('fild_g_rrc',0);
		$this->session->set_userdata('fild_h_rrc',1);
		$this->session->set_userdata('fild_i_rrc',0);
		$this->session->set_userdata('order_h_rrc','DESC');		
		$this->Data_Table();
		
		}else{$this->M_logout->index();}
	}	
	
	Public function Order_i_asc()
	{
		if($this->session->userdata('id_tr')!=''){
			
		$this->session->set_userdata('fild_a_rrc',0);
		$this->session->set_userdata('fild_b_rrc',0);
		$this->session->set_userdata('fild_c_rrc',0);
		$this->session->set_userdata('fild_d_rrc',0);
		$this->session->set_userdata('fild_e_rrc',0);
		$this->session->set_userdata('fild_f_rrc',0);
		$this->session->set_userdata('fild_g_rrc',0);
		$this->session->set_userdata('fild_h_rrc',0);
		$this->session->set_userdata('fild_i_rrc',1);
		$this->session->set_userdata('order_i_rrc','ASC');		
		$this->Data_Table();
		
		}else{$this->M_logout->index();}
	}
	
	Public function Order_i_desc()
	{
		if($this->session->userdata('id_tr')!=''){
			
		$this->session->set_userdata('fild_a_rrc',0);
		$this->session->set_userdata('fild_b_rrc',0);
		$this->session->set_userdata('fild_c_rrc',0);
		$this->session->set_userdata('fild_d_rrc',0);
		$this->session->set_userdata('fild_e_rrc',0);
		$this->session->set_userdata('fild_f_rrc',0);
		$this->session->set_userdata('fild_g_rrc',0);
		$this->session->set_userdata('fild_h_rrc',0);
		$this->session->set_userdata('fild_i_rrc',1);
		$this->session->set_userdata('order_i_rrc','DESC');		
		$this->Data_Table();
		
		}else{$this->M_logout->index();}
	}	
	
	public function Rows($val)
	{
			$this->session->unset_userdata('page_rrc');
			$this->session->unset_userdata('next_rrc');
			$this->session->set_userdata('myrow_rrc',$val);		
			$this->Data_Table();
		
	}
	
	public function Search()
	{						
			$this->session->unset_userdata('page_rrc');
			$this->session->unset_userdata('next_rrc');
			
			$src = string_src($this->input->post('input_src'));			
			
			$this->session->set_userdata('src_rrc',$src);
			
			$this->Data_Table();
	}
	
	public function Page()
	{
	
			$page	= ($this->uri->segment('3')) ? $this->uri->segment('3'):1; 
			$next 	= ($this->uri->segment('4')) ? $this->uri->segment('4'):1; 
			
			$this->session->set_userdata('page_rrc',$page);
			$this->session->set_userdata('next_rrc',$next);
			
			$this->Data_Table();

	}
	
	public function Form($act,$target)
	{		
		if($this->session->userdata('id_tr') == ''){
			
			$this->M_Global->M_Logout();
			
		}else{
			
			$access_tr = $this->session->userdata('access_tr');
			
			if($act == 'Edit' && desid_get($target) > 0){
				
				$get = $this->M_Report_Request_Courier->M_Report_Request_Courier_Detail(desid_get($target))->row();
				
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
						'updated_date' => date_time_ind_full($get->updated_date)
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
					
				$this->load->view('report_req_courier_detail',$data);
			
			
			}elseif($act == 'Print' && desid_get($target) > 0){
				
				$get = $this->M_Report_Request_Courier->M_Report_Request_Courier_Detail(desid_get($target))->row();
				
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
						
				/* attachment */
				$target_attachment = array('a.id_request' => desid_get($target));
				
				$table_attachment = 'transport_request.attachment a';
				
				$query_attachment = $this->M_Global->M_Select_File($target_attachment,$table_attachment,2);
				
				$data['num_attachment'] = $query_attachment->num_rows();
				
				$data['result_attachment'] = $query_attachment->result();
				
				/* expense_type */
				$data['num_expense'] = $this->M_Global->M_ExpenseData($get->id_request,2)->num_rows();
				
				$data['expense'] = $this->M_Global->M_ExpenseData($get->id_request,2)->result();
					
				$this->load->view('req_courier_print',$data);
			
			
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
			
			$query = $this->M_Report_Request_Courier->M_Filter_Search_List_Requestor($src)->result();
			
			foreach($query as $data){
				
				echo'<li onclick="LoadDataTable(&#39;Report_Request_Courier/Filter_List_a/'.enid_get($data->id_login).'&#39;)"><a href="#">'.$data->requestor.'</a></li>';
			
			}
			
		}
	}		
	
	public function Filter_Search_List_Department()
	{						
		if($this->session->userdata('id_tr') == ''){
			
			$this->M_Global->M_Logout();
			
		}else{
		
			$src = string_src($this->input->post('input_src_list'));			
			
			$query = $this->M_Report_Request_Courier->M_Filter_Search_List_Department($src)->result();
			
			foreach($query as $data){
				
				echo'<li onclick="LoadDataTable(&#39;Report_Request_Courier/Filter_List_b/'.enid_get($data->id_department).'&#39;)"><a href="#">'.$data->department.'</a></li>';
			
			}
			
		}
	}	
	
	public function Filter_Search_List_Request()
	{						
		if($this->session->userdata('id_tr') == ''){
			
			$this->M_Global->M_Logout();
			
		}else{
		
			$src = string_src($this->input->post('input_src_list'));			
			
			$query = $this->M_Report_Request_Courier->M_Filter_Search_List_Request($src)->result();
			
			foreach($query as $data){
				
				echo'<li onclick="LoadDataTable(&#39;Report_Request_Courier/Filter_List_c/'.enid_get($data->request_option).'&#39;)"><a href="#">'.$data->name.'</a></li>';
			
			}
			
		}
	}
	
	public function Filter_Search_List_Courier()
	{						
		if($this->session->userdata('id_tr') == ''){
			
			$this->M_Global->M_Logout();
			
		}else{
		
			$src = string_src($this->input->post('input_src_list'));			
			
			$query = $this->M_Report_Request_Courier->M_Filter_Search_List_Courier($src)->result();
			
			foreach($query as $data){
				
				echo'<li onclick="LoadDataTable(&#39;Report_Request_Courier/Filter_List_d/'.enid_get($data->courier).'&#39;)"><a href="#">'.$data->name.'</a></li>';
			
			}
			
		}
	}
	
	public function Filter_Search_List_Purpose()
	{						
		if($this->session->userdata('id_tr') == ''){
			
			$this->M_Global->M_Logout();
			
		}else{
		
			$src = string_src($this->input->post('input_src_list'));			
			
			$query = $this->M_Report_Request_Courier->M_Filter_Search_List_Purpose($src)->result();
			
			foreach($query as $data){
				
				echo'<li onclick="LoadDataTable(&#39;Report_Request_Courier/Filter_List_e/'.enid_get($data->expense_purpose).'&#39;)"><a href="#">'.$data->name.'</a></li>';
			
			}
			
		}
	}
	
	public function Filter_List_a($target)
	{
		$this->session->set_userdata('filter_a_rrc',$target);		
		$this->Data_Table();
		
	}
	
	public function Filter_List_b($target)
	{
		$this->session->set_userdata('filter_b_rrc',$target);		
		$this->Data_Table();
		
	}

	public function Filter_List_c($target)
	{
		$this->session->set_userdata('filter_c_rrc',$target);		
		$this->Data_Table();
		
	}
	
	public function Filter_List_d($target)
	{
		$this->session->set_userdata('filter_d_rrc',$target);		
		$this->Data_Table();
		
	}
	
	public function Filter_List_e($target)
	{
		$this->session->set_userdata('filter_e_rrc',$target);		
		$this->Data_Table();
		
	}
	
	public function Filter_Balance($target)
	{
		$this->session->set_userdata('filter_f_rrc',$target);		
		$this->Data_Table();
		
	}
	
	public function Filter_Status($target)
	{
		$this->session->set_userdata('filter_st_rrc',$target);		
		$this->Data_Table();
		
	}

	public function Filter_Date_a()
	{
		$date_aa	= date_input($this->input->post('input_date_a'));
		$date_ab	= date_input($this->input->post('input_date_b'));
		
		$this->session->set_userdata('filter_date_aa_rrc',$date_aa);
		$this->session->set_userdata('filter_date_ab_rrc',$date_ab);
		
		$this->Data_Table();
		
	}
	
	
	
	public function Export($export)
	{
		if($this->session->userdata('id_tr') == ''){
			
			$this->M_Global->M_Logout();
			
		}else{
		
			/* pagging */
			$myrow	= ($this->session->userdata('myrow_rrc')) ? $this->session->userdata('myrow_rrc'):25;
			$page	= ($this->session->userdata('page_rrc')) ? $this->session->userdata('page_rrc'):1;
			$next	= ($this->session->userdata('next_rrc')) ? $this->session->userdata('next_rrc'):1;
			$start 	= $myrow * ($page-1);
			
			/* src */
			$src		= ($this->session->userdata('src_rrc')) ? $this->session->userdata('src_rrc'):''; 
			
			/* oreder */
			$fild_a	= ($this->session->userdata('fild_a_rrc')) ? $this->session->userdata('fild_a_rrc'):0;
			$order_a	= ($this->session->userdata('order_a_rrc')) ? $this->session->userdata('order_a_rrc'):'ASC';
			$fild_b	= ($this->session->userdata('fild_b_rrc')) ? $this->session->userdata('fild_b_rrc'):0;
			$order_b	= ($this->session->userdata('order_b_rrc')) ? $this->session->userdata('order_b_rrc'):'ASC';
			$fild_c	= ($this->session->userdata('fild_c_rrc')) ? $this->session->userdata('fild_c_rrc'):0;
			$order_c	= ($this->session->userdata('order_c_rrc')) ? $this->session->userdata('order_c_rrc'):'ASC';
			$fild_d	= ($this->session->userdata('fild_d_rrc')) ? $this->session->userdata('fild_d_rrc'):0;
			$order_d	= ($this->session->userdata('order_d_rrc')) ? $this->session->userdata('order_d_rrc'):'ASC';
			$fild_e	= ($this->session->userdata('fild_e_rrc')) ? $this->session->userdata('fild_e_rrc'):0;
			$order_e	= ($this->session->userdata('order_e_rrc')) ? $this->session->userdata('order_e_rrc'):'ASC';
			$fild_f	= ($this->session->userdata('fild_f_rrc')) ? $this->session->userdata('fild_f_rrc'):0;
			$order_f	= ($this->session->userdata('order_f_rrc')) ? $this->session->userdata('order_f_rrc'):'ASC';
			$fild_g	= ($this->session->userdata('fild_g_rrc')) ? $this->session->userdata('fild_g_rrc'):0;
			$order_g	= ($this->session->userdata('order_g_rrc')) ? $this->session->userdata('order_g_rrc'):'ASC';
			$fild_h	= ($this->session->userdata('fild_h_rrc')) ? $this->session->userdata('fild_h_rrc'):0;
			$order_h	= ($this->session->userdata('order_h_rrc')) ? $this->session->userdata('order_h_rrc'):'ASC';
			$fild_i	= ($this->session->userdata('fild_i_rrc')) ? $this->session->userdata('fild_i_rrc'):0;
			$order_i	= ($this->session->userdata('order_i_rrc')) ? $this->session->userdata('order_i_rrc'):'ASC';
			
			$filter_a		= ($this->session->userdata('filter_a_rrc')) ? $this->session->userdata('filter_a_rrc'):'';
			$filter_b		= ($this->session->userdata('filter_b_rrc')) ? $this->session->userdata('filter_b_rrc'):'';
			$filter_c		= ($this->session->userdata('filter_c_rrc')) ? $this->session->userdata('filter_c_rrc'):'';
			$filter_d		= ($this->session->userdata('filter_d_rrc')) ? $this->session->userdata('filter_d_rrc'):'';
			$filter_e		= ($this->session->userdata('filter_e_rrc')) ? $this->session->userdata('filter_e_rrc'):'';
			$filter_f		= ($this->session->userdata('filter_f_rrc')) ? $this->session->userdata('filter_f_rrc'):'';
			$filter_st		= ($this->session->userdata('filter_st_rrc')) ? $this->session->userdata('filter_st_rrc'):'';
			$filter_date_aa	= ($this->session->userdata('filter_date_aa_rrc')) ? $this->session->userdata('filter_date_aa_rrc'):'';
			$filter_date_ab	= ($this->session->userdata('filter_date_ab_rrc')) ? $this->session->userdata('filter_date_ab_rrc'):'';
			
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
			'filter_e' => desid_get($filter_e),
			'filter_f' => $filter_f,
			'filter_st' => $filter_st,
			'filter_date_aa' => $filter_date_aa,
			'filter_date_ab' => $filter_date_ab,
			'export' => 1
			);
			
			$data['num_data']		= $this->M_Report_Request_Courier->M_Report_Request_CourierNumRow($filter)->num_rows();
			$data['result_data']	= $this->M_Report_Request_Courier->M_Report_Request_CourierData($filter)->result();
			
			$data['export_to']	 = $export;
			
			$this->load->view('report_req_courier_export',$data);
		}
	}
	
	
	
/*
	public function Summary()
	{
		if($this->session->userdata('id_tr') == ''){
			
			$this->M_Global->M_Logout();
			
		}else{
		
			
			$src			= ($this->session->userdata('src_rrc')) ? $this->session->userdata('src_rrc'):''; 
			
			$filter_a		= ($this->session->userdata('filter_a_rrc')) ? $this->session->userdata('filter_a_rrc'):'';
			$filter_b		= ($this->session->userdata('filter_b_rrc')) ? $this->session->userdata('filter_b_rrc'):'';
			$filter_c		= ($this->session->userdata('filter_c_rrc')) ? $this->session->userdata('filter_c_rrc'):'';
			$filter_d		= ($this->session->userdata('filter_d_rrc')) ? $this->session->userdata('filter_d_rrc'):'';
			$filter_st		= ($this->session->userdata('filter_st_rrc')) ? $this->session->userdata('filter_st_rrc'):'';
			$filter_date_aa	= ($this->session->userdata('filter_date_aa_rrc')) ? $this->session->userdata('filter_date_aa_rrc'):'';
			$filter_date_ab	= ($this->session->userdata('filter_date_ab_rrc')) ? $this->session->userdata('filter_date_ab_rrc'):'';
				
			$filter = array(
			'src' => strtoupper($src),
			'filter_a' => desid_get($filter_a),
			'filter_b' => desid_get($filter_b),
			'filter_c' => desid_get($filter_c),
			'filter_d' => desid_get($filter_d),
			'filter_st' => $filter_st,
			'filter_date_aa' => $filter_date_aa,
			'filter_date_ab' => $filter_date_ab
			);
			
			
			$data['result_name'] 	= $this->M_Summary->M_Select_Summary_Name_Courier($filter)->result();
			$data['result_month'] 	= $this->M_Summary->M_Select_Summary_Month_Courier($filter)->result();
			$data['src']			= $src;
			$data['filter_a']		= $filter_a;
			$data['filter_b']		= $filter_b;
			$data['filter_c']		= $filter_c;
			$data['filter_d']		= $filter_d;
			$data['filter_e']		= $filter_e;
			$data['filter_date_aa']	= $filter_date_aa;
			$data['filter_date_ab'] = $filter_date_ab;
			
			$this->load->view('sum_courier_data',$data);	
			
		}
	}
*/	

/* end */	
}
