<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_Petty_Cash_Close extends CI_Controller {

	Public function __construct(){
	parent::__construct();
		
		$this->load->model('M_Report_Petty_Cash');
		$this->load->model('M_Report_Petty_Cash_Close');	
		
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
		
			$this->session->unset_userdata('page_rptc1');
			$this->session->unset_userdata('next_rptc1');
			$this->session->unset_userdata('src_rptc1');
		
			$this->session->set_userdata('fild_a_rptc1',0);
			$this->session->set_userdata('fild_b_rptc1',0);
			$this->session->set_userdata('fild_c_rptc1',0);
			$this->session->set_userdata('fild_d_rptc1',0);
			$this->session->unset_userdata('filter_date_aa_rptc1');
			
			$data['set_menu'] = '<li class="breadcrumb-item" aria-current="page">Report</li>';
			$data['set_submenu'] = '<li class="breadcrumb-item" aria-current="page">Report Petty Cash Close Data</li>';
			$data['set_action'] = '';
			
			/* pagging */
			$myrow	= ($this->session->userdata('myrow_rptc1')) ? $this->session->userdata('myrow_rptc1'):25;
			$page	= ($this->session->userdata('page_rptc1')) ? $this->session->userdata('page_rptc1'):1;
			$next	= ($this->session->userdata('next_rptc1')) ? $this->session->userdata('next_rptc1'):1;
			$start 	= $myrow * ($page-1);
			
			/* src */
			$src		= ($this->session->userdata('src_rptc1')) ? $this->session->userdata('src_rptc1'):''; 
			
			$filter_date_aa	= ($this->session->userdata('filter_date_aa_rptc1')) ? $this->session->userdata('filter_date_aa_rptc1'):'';
			
			/* oreder */
			$fild_a		= ($this->session->userdata('fild_a_rptc1')) ? $this->session->userdata('fild_a_rptc1'):0;
			$order_a	= ($this->session->userdata('order_a_rptc1')) ? $this->session->userdata('order_a_rptc1'):'ASC';
			$fild_b		= ($this->session->userdata('fild_b_rptc1')) ? $this->session->userdata('fild_b_rptc1'):0;
			$order_b	= ($this->session->userdata('order_b_rptc1')) ? $this->session->userdata('order_b_rptc1'):'ASC';
			$fild_c		= ($this->session->userdata('fild_c_rptc1')) ? $this->session->userdata('fild_c_rptc1'):0;
			$order_c	= ($this->session->userdata('order_c_rptc1')) ? $this->session->userdata('order_c_rptc1'):'ASC';
			$fild_d		= ($this->session->userdata('fild_d_rptc1')) ? $this->session->userdata('fild_d_rptc1'):0;
			$order_d	= ($this->session->userdata('order_d_rptc1')) ? $this->session->userdata('order_d_rptc1'):'ASC';
			
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
			'order_d' => $order_d,
			'filter_date_aa' => ($filter_date_aa)
			);
			
			$data['num_data']		= $this->M_Report_Petty_Cash_Close->M_Report_Petty_Cash_CloseNumRow($filter)->num_rows();
			$data['result_data']	= $this->M_Report_Petty_Cash_Close->M_Report_Petty_Cash_CloseData($filter)->result();
			
			/* pagging */
			$data['max']			= (ceil($data['num_data']/$myrow)); 
			$data['myrow'] 			= $myrow; 
			$data['page'] 			= $page;
			$data['next'] 			= $next;		
			$data['start'] 			= $start;
			$data['controller']		= 'Report_Petty_Cash_Close';
			
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
		
		$this->load->view('report_petty_cash_close',$data);
		
		}
	}

	public function Back()
	{
		if($this->session->userdata('id_tr') == ''){
			
			$this->M_Global->M_Logout();
			
		}else{
			
			$data['set_menu'] = '<li class="breadcrumb-item" aria-current="page">Report</li>';
			$data['set_submenu'] = '<li class="breadcrumb-item" aria-current="page">Report Petty Cash Close Data</li>';
			$data['set_action'] = '';
			
			/* pagging */
			$myrow	= ($this->session->userdata('myrow_rptc1')) ? $this->session->userdata('myrow_rptc1'):25;
			$page	= ($this->session->userdata('page_rptc1')) ? $this->session->userdata('page_rptc1'):1;
			$next	= ($this->session->userdata('next_rptc1')) ? $this->session->userdata('next_rptc1'):1;
			$start 	= $myrow * ($page-1);
			
			/* src */
			$src		= ($this->session->userdata('src_rptc1')) ? $this->session->userdata('src_rptc1'):''; 
			
			$filter_date_aa	= ($this->session->userdata('filter_date_aa_rptc1')) ? $this->session->userdata('filter_date_aa_rptc1'):'';
			
			/* oreder */
			$fild_a		= ($this->session->userdata('fild_a_rptc1')) ? $this->session->userdata('fild_a_rptc1'):0;
			$order_a	= ($this->session->userdata('order_a_rptc1')) ? $this->session->userdata('order_a_rptc1'):'ASC';
			$fild_b		= ($this->session->userdata('fild_b_rptc1')) ? $this->session->userdata('fild_b_rptc1'):0;
			$order_b	= ($this->session->userdata('order_b_rptc1')) ? $this->session->userdata('order_b_rptc1'):'ASC';
			$fild_c		= ($this->session->userdata('fild_c_rptc1')) ? $this->session->userdata('fild_c_rptc1'):0;
			$order_c	= ($this->session->userdata('order_c_rptc1')) ? $this->session->userdata('order_c_rptc1'):'ASC';
			$fild_d		= ($this->session->userdata('fild_d_rptc1')) ? $this->session->userdata('fild_d_rptc1'):0;
			$order_d	= ($this->session->userdata('order_d_rptc1')) ? $this->session->userdata('order_d_rptc1'):'ASC';
			
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
			'order_d' => $order_d,
			'filter_date_aa' => ($filter_date_aa)
			);
			
			$data['num_data']		= $this->M_Report_Petty_Cash_Close->M_Report_Petty_Cash_CloseNumRow($filter)->num_rows();
			$data['result_data']	= $this->M_Report_Petty_Cash_Close->M_Report_Petty_Cash_CloseData($filter)->result();
			
			/* pagging */
			$data['max']			= (ceil($data['num_data']/$myrow)); 
			$data['myrow'] 			= $myrow; 
			$data['page'] 			= $page;
			$data['next'] 			= $next;		
			$data['start'] 			= $start;
			$data['controller']		= 'Report_Petty_Cash_Close';
			
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
		
		$this->load->view('report_petty_cash_close',$data);
		
		}
	}
	
	public function Data_Table()
	{
		if($this->session->userdata('id_tr') == ''){
			
			$this->M_Global->M_Logout();
			
		}else{
			
			/* pagging */
			$myrow	= ($this->session->userdata('myrow_rptc1')) ? $this->session->userdata('myrow_rptc1'):25;
			$page	= ($this->session->userdata('page_rptc1')) ? $this->session->userdata('page_rptc1'):1;
			$next	= ($this->session->userdata('next_rptc1')) ? $this->session->userdata('next_rptc1'):1;
			$start 	= $myrow * ($page-1);
			
			/* src */
			$src		= ($this->session->userdata('src_rptc1')) ? $this->session->userdata('src_rptc1'):''; 
			
			$filter_date_aa	= ($this->session->userdata('filter_date_aa_rptc1')) ? $this->session->userdata('filter_date_aa_rptc1'):'';
			
			/* oreder */
			$fild_a		= ($this->session->userdata('fild_a_rptc1')) ? $this->session->userdata('fild_a_rptc1'):0;
			$order_a	= ($this->session->userdata('order_a_rptc1')) ? $this->session->userdata('order_a_rptc1'):'ASC';
			$fild_b		= ($this->session->userdata('fild_b_rptc1')) ? $this->session->userdata('fild_b_rptc1'):0;
			$order_b	= ($this->session->userdata('order_b_rptc1')) ? $this->session->userdata('order_b_rptc1'):'ASC';
			$fild_c		= ($this->session->userdata('fild_c_rptc1')) ? $this->session->userdata('fild_c_rptc1'):0;
			$order_c	= ($this->session->userdata('order_c_rptc1')) ? $this->session->userdata('order_c_rptc1'):'ASC';
			$fild_d		= ($this->session->userdata('fild_d_rptc1')) ? $this->session->userdata('fild_d_rptc1'):0;
			$order_d	= ($this->session->userdata('order_d_rptc1')) ? $this->session->userdata('order_d_rptc1'):'ASC';
			
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
			'order_d' => $order_d,
			'filter_date_aa' => ($filter_date_aa)
			);
			
			$data['num_data']		= $this->M_Report_Petty_Cash_Close->M_Report_Petty_Cash_CloseNumRow($filter)->num_rows();
			$data['result_data']	= $this->M_Report_Petty_Cash_Close->M_Report_Petty_Cash_CloseData($filter)->result();
			
			/* pagging */
			$data['max']			= (ceil($data['num_data']/$myrow)); 
			$data['myrow'] 			= $myrow; 
			$data['page'] 			= $page;
			$data['next'] 			= $next;		
			$data['start'] 			= $start;
			$data['controller']		= 'Report_Petty_Cash_Close';
			
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
		
		$this->load->view('report_petty_cash_close_data',$data);
		
		}
	}
	
	
	public function Order_a_asc()
	{						
			$this->session->set_userdata('fild_a_rptc1',1);
			$this->session->set_userdata('fild_b_rptc1',0);
			$this->session->set_userdata('fild_c_rptc1',0);
			$this->session->set_userdata('fild_d_rptc1',0);
			$this->session->set_userdata('order_a_rptc1','ASC');
			
			$this->Data_Table();
	}	

	public function Order_a_desc()
	{						
			$this->session->set_userdata('fild_a_rptc1',1);
			$this->session->set_userdata('fild_b_rptc1',0);
			$this->session->set_userdata('fild_c_rptc1',0);
			$this->session->set_userdata('fild_d_rptc1',0);
			$this->session->set_userdata('order_a_rptc1','DESC');
			
			$this->Data_Table();
	}
	
	public function Order_b_asc()
	{						
			$this->session->set_userdata('fild_a_rptc1',0);
			$this->session->set_userdata('fild_b_rptc1',1);
			$this->session->set_userdata('fild_c_rptc1',0);
			$this->session->set_userdata('fild_d_rptc1',0);
			$this->session->set_userdata('order_b_rptc1','ASC');
			
			$this->Data_Table();
	}	

	public function Order_b_desc()
	{						
			$this->session->set_userdata('fild_a_rptc1',0);
			$this->session->set_userdata('fild_b_rptc1',1);
			$this->session->set_userdata('fild_c_rptc1',0);
			$this->session->set_userdata('fild_d_rptc1',0);
			$this->session->set_userdata('order_b_rptc1','DESC');
			
			$this->Data_Table();
	}

	public function Order_c_asc()
	{						
			$this->session->set_userdata('fild_a_rptc1',0);
			$this->session->set_userdata('fild_b_rptc1',0);
			$this->session->set_userdata('fild_c_rptc1',1);
			$this->session->set_userdata('fild_d_rptc1',0);
			$this->session->set_userdata('order_c_rptc1','ASC');
			
			$this->Data_Table();
	}	

	public function Order_c_desc()
	{						
			$this->session->set_userdata('fild_a_rptc1',0);
			$this->session->set_userdata('fild_b_rptc1',0);
			$this->session->set_userdata('fild_c_rptc1',1);
			$this->session->set_userdata('fild_d_rptc1',0);
			$this->session->set_userdata('order_c_rptc1','DESC');
			
			$this->Data_Table();
	}

	public function Order_d_asc()
	{						
			$this->session->set_userdata('fild_a_rptc1',0);
			$this->session->set_userdata('fild_b_rptc1',0);
			$this->session->set_userdata('fild_c_rptc1',0);
			$this->session->set_userdata('fild_d_rptc1',1);
			$this->session->set_userdata('order_d_rptc1','ASC');
			
			$this->Data_Table();
	}	

	public function Order_d_desc()
	{						
			$this->session->set_userdata('fild_a_rptc1',0);
			$this->session->set_userdata('fild_b_rptc1',0);
			$this->session->set_userdata('fild_c_rptc1',0);
			$this->session->set_userdata('fild_d_rptc1',1);
			$this->session->set_userdata('order_d_rptc1','DESC');
			
			$this->Data_Table();
	}
	
	public function Rows($val)
	{
			$this->session->unset_userdata('page_rptc1');
			$this->session->unset_userdata('next_rptc1');
			$this->session->set_userdata('myrow_rptc1',$val);		
			$this->Data_Table();
		
	}
	
	public function Search()
	{						
			$this->session->unset_userdata('page_rptc1');
			$this->session->unset_userdata('next_rptc1');
			
			$src = string_src($this->input->post('input_src'));			
			
			$this->session->set_userdata('src_rptc1',$src);
			
			$this->Data_Table();
	}
	
	public function Page()
	{
	
			$page	= ($this->uri->segment('3')) ? $this->uri->segment('3'):1; 
			$next 	= ($this->uri->segment('4')) ? $this->uri->segment('4'):1; 
			
			$this->session->set_userdata('page_rptc1',$page);
			$this->session->set_userdata('next_rptc1',$next);
			
			$this->Data_Table();

	}
	
	public function Search_Date()
	{
		$date_aa	= date_input($this->input->post('input_date_a'));
		
		$this->session->set_userdata('filter_date_aa_rptc1',$date_aa);
		
		if($date_aa != ''){
			$this->Data_Table();
		}else{
			echo myalert('danger','Please complete the date');
		}
		
	}
	
	public function View($id_proccess)
	{
		if($this->session->userdata('id_tr') == ''){
			
			$this->M_Global->M_Logout();
			
		}else{
			
			$this->session->unset_userdata('filter_a_ptc');
			$this->session->unset_userdata('filter_b_ptc');
			$this->session->unset_userdata('filter_c_ptc');
			$this->session->unset_userdata('filter_d_ptc');
			$this->session->unset_userdata('filter_e_ptc');
			$this->session->unset_userdata('filter_g_ptc');
			$this->session->unset_userdata('filter_date_aa_ptc');
			$this->session->unset_userdata('filter_date_ab_ptc');
			
			$data['set_menu'] = '<li class="breadcrumb-item" aria-current="page">Report</li>';
			$data['set_submenu'] = '<li class="breadcrumb-item" aria-current="page">Petty Cash Close Detail</li>';
			$data['set_action'] = '';
			
			$filter_a		= ($this->session->userdata('filter_a_ptc')) ? $this->session->userdata('filter_a_ptc'):'';
			$filter_b		= ($this->session->userdata('filter_b_ptc')) ? $this->session->userdata('filter_b_ptc'):'';
			$filter_c		= ($this->session->userdata('filter_c_ptc')) ? $this->session->userdata('filter_c_ptc'):'';
			$filter_d		= ($this->session->userdata('filter_d_ptc')) ? $this->session->userdata('filter_d_ptc'):'';
			$filter_e		= ($this->session->userdata('filter_e_ptc')) ? $this->session->userdata('filter_e_ptc'):'';
			$filter_g		= ($this->session->userdata('filter_g_ptc')) ? $this->session->userdata('filter_g_ptc'): enid_get(60);
			$filter_date_aa	= ($this->session->userdata('filter_date_aa_ptc')) ? $this->session->userdata('filter_date_aa_ptc'):'';
			$filter_date_ab	= ($this->session->userdata('filter_date_ab_ptc')) ? $this->session->userdata('filter_date_ab_ptc'):'';
			$petty_name		= ($this->session->userdata('petty_name_ptc')) ? $this->session->userdata('petty_name_ptc'):'ALL';
			
			$filter = array(
			'filter_a' => $filter_a,
			'filter_b' => $filter_b,
			'filter_c' => $filter_c,
			'filter_d' => $filter_d,
			'filter_e' => $filter_e,
			'filter_f' => desid_get($id_proccess),
			'filter_g' => desid_get($filter_g),
			'filter_date_aa' => $filter_date_aa,
			'filter_date_ab' => $filter_date_ab,
			'export' => 0
			);
			
			$data['num_data_courier']		= 0;
			$data['num_data_driver']		= 0;
			
			if($filter_b != 1){
				$data['num_data_driver']		= $this->M_Report_Petty_Cash->M_Report_Petty_CashNumRow_Driver($filter)->num_rows();
				$data['result_data_driver']		= $this->M_Report_Petty_Cash->M_Report_Petty_CashData_Driver($filter)->result();
			}
			if($filter_a != 1){
				$data['num_data_courier']		= $this->M_Report_Petty_Cash->M_Report_Petty_CashNumRow_Courier($filter)->num_rows();
				$data['result_data_courier']	= $this->M_Report_Petty_Cash->M_Report_Petty_CashData_Courier($filter)->result();
			}
			
			$data['num_expense_header']		= $this->M_Report_Petty_Cash->M_Expense_Header()->num_rows();
			$data['result_data_expense_header']	= $this->M_Report_Petty_Cash->M_Expense_Header()->result();
			
			$data['num_marked_driver']			= $this->M_Report_Petty_Cash->M_Marked_Driver_Num($filter)->num_rows();
			$data['num_marked_courier']			= $this->M_Report_Petty_Cash->M_Marked_Courier_Num($filter)->num_rows();
			
			$x = '';
			$data['result_company']				= $this->M_Global->M_Search_List_Company($x)->result();
			
			$y = array('id_parameter' => (int)desid_get($filter_g));
			$result_company_row					= $this->M_Global->M_Select_Where('transport_request.parameter',$y)->row();
			
			$data['company_name'] 	= $result_company_row->name;
			$data['petty_name'] 	= $petty_name;
			$data['filter_a'] 		= $filter_a;
			$data['filter_b'] 		= $filter_b;
			$data['id_proccess'] 			= $id_proccess;
			
			$this->load->view('report_petty_cash_close_detail',$data);
		
		}
	}
	
	public function View_Data_Table($id_proccess)
	{
		if($this->session->userdata('id_tr') == ''){
			
			$this->M_Global->M_Logout();
			
		}else{
			
			$submenu_report	= ($this->session->userdata('submenu_report_ptc')) ? $this->session->userdata('submenu_report_ptc'):'petty-c-general';
			
			$filter_a		= ($this->session->userdata('filter_a_ptc')) ? $this->session->userdata('filter_a_ptc'):'';
			$filter_b		= ($this->session->userdata('filter_b_ptc')) ? $this->session->userdata('filter_b_ptc'):'';
			$filter_c		= ($this->session->userdata('filter_c_ptc')) ? $this->session->userdata('filter_c_ptc'):'';
			$filter_d		= ($this->session->userdata('filter_d_ptc')) ? $this->session->userdata('filter_d_ptc'):'';
			$filter_e		= ($this->session->userdata('filter_e_ptc')) ? $this->session->userdata('filter_e_ptc'):'';
			$filter_g		= ($this->session->userdata('filter_g_ptc')) ? $this->session->userdata('filter_g_ptc'): enid_get(60);
			$filter_date_aa	= ($this->session->userdata('filter_date_aa_ptc')) ? $this->session->userdata('filter_date_aa_ptc'):'';
			$filter_date_ab	= ($this->session->userdata('filter_date_ab_ptc')) ? $this->session->userdata('filter_date_ab_ptc'):'';
			$petty_name		= ($this->session->userdata('petty_name_ptc')) ? $this->session->userdata('petty_name_ptc'):'ALL';
			
			$filter = array(
			'filter_a' => $filter_a,
			'filter_b' => $filter_b,
			'filter_c' => $filter_c,
			'filter_d' => $filter_d,
			'filter_e' => $filter_e,
			'filter_e' => $filter_e,
			'filter_f' => desid_get($id_proccess),
			'filter_g' => desid_get($filter_g),
			'filter_date_aa' => $filter_date_aa,
			'filter_date_ab' => $filter_date_ab,
			'export' => 0
			);
			
			$data['num_data_courier']		= 0;
			$data['num_data_driver']		= 0;
			
			if($filter_b != 1){
				$data['num_data_driver']		= $this->M_Report_Petty_Cash->M_Report_Petty_CashNumRow_Driver($filter)->num_rows();
				$data['result_data_driver']		= $this->M_Report_Petty_Cash->M_Report_Petty_CashData_Driver($filter)->result();
			}
			if($filter_a != 1){
				$data['num_data_courier']		= $this->M_Report_Petty_Cash->M_Report_Petty_CashNumRow_Courier($filter)->num_rows();
				$data['result_data_courier']	= $this->M_Report_Petty_Cash->M_Report_Petty_CashData_Courier($filter)->result();
			}
			
			$data['num_expense_header']		= $this->M_Report_Petty_Cash->M_Expense_Header()->num_rows();
			$data['result_data_expense_header']	= $this->M_Report_Petty_Cash->M_Expense_Header()->result();
			
			$data['num_marked_driver']			= $this->M_Report_Petty_Cash->M_Marked_Driver_Num($filter)->num_rows();
			$data['num_marked_courier']			= $this->M_Report_Petty_Cash->M_Marked_Courier_Num($filter)->num_rows();
			
			$x = '';
			$data['result_company']				= $this->M_Global->M_Search_List_Company($x)->result();
			
			$y = array('id_parameter' => (int)desid_get($filter_g));
			$result_company_row					= $this->M_Global->M_Select_Where('transport_request.parameter',$y)->row();
			
			$data['company_name'] 	= $result_company_row->name;
			$data['petty_name'] 	= $petty_name;
			$data['filter_a'] 		= $filter_a;
			$data['filter_b'] 		= $filter_b;
			$data['id_proccess'] 	= $id_proccess;
			
		$this->load->view('report_petty_cash_close_detail_data',$data);
		
		}
	}

	public function Petty_Company($id_proccess,$target){
			
			$this->session->set_userdata('filter_g_ptc',$target);
		$this->session->unset_userdata('filter_a_ptc');
		$this->session->unset_userdata('filter_b_ptc');
		$this->session->unset_userdata('filter_c_ptc');
		$this->session->unset_userdata('filter_d_ptc');
		$this->session->unset_userdata('filter_e_ptc');
		$this->session->set_userdata('petty_name_ptc','ALL');
		$this->View_Data_Table($id_proccess);
		
	}
	
	public function Petty_General($id_proccess){
		
		$this->session->unset_userdata('filter_a_ptc');
		$this->session->unset_userdata('filter_b_ptc');
		$this->session->unset_userdata('filter_c_ptc');
		$this->session->unset_userdata('filter_d_ptc');
		$this->session->unset_userdata('filter_e_ptc');
		$this->session->set_userdata('submenu_report_ptc','ALL');
		$this->View_Data_Table($id_proccess);
		
	}	
	
	public function Petty_Driver($id_proccess){
		
			$this->session->set_userdata('filter_a_ptc',1);
		$this->session->unset_userdata('filter_b_ptc');
		$this->session->unset_userdata('filter_c_ptc');
		$this->session->unset_userdata('filter_d_ptc');
		$this->session->unset_userdata('filter_e_ptc');
		$this->session->set_userdata('submenu_report_ptc','DRIVER');
		$this->View_Data_Table($id_proccess);
		
	}	
	
	public function Petty_Courier($id_proccess){
		
		$this->session->unset_userdata('filter_a_ptc');
			$this->session->set_userdata('filter_b_ptc',1);
		$this->session->unset_userdata('filter_c_ptc');
		$this->session->unset_userdata('filter_d_ptc');
		$this->session->unset_userdata('filter_e_ptc');
		$this->session->set_userdata('submenu_report_ptc','COURIER');
		$this->View_Data_Table($id_proccess);
		
	}
	
	public function Petty_Gs($id_proccess){
		
		$this->session->unset_userdata('filter_a_ptc');
		$this->session->unset_userdata('filter_b_ptc');
			$this->session->set_userdata('filter_c_ptc',1);
		$this->session->unset_userdata('filter_d_ptc');
		$this->session->unset_userdata('filter_e_ptc');
		$this->session->set_userdata('submenu_report_ptc','POSTING GS');
		$this->View_Data_Table($id_proccess);
		
	}
	
	public function Petty_To($id_proccess){
		
		$this->session->unset_userdata('filter_a_ptc');
		$this->session->unset_userdata('filter_b_ptc');
		$this->session->unset_userdata('filter_c_ptc');
			$this->session->set_userdata('filter_d_ptc',1);
		$this->session->unset_userdata('filter_e_ptc');
		$this->session->set_userdata('submenu_report_ptc','POSTING TO');
		$this->View_Data_Table($id_proccess);
		
	}
	
	
	public function Petty_Tc($id_proccess){
		
		$this->session->unset_userdata('filter_a_ptc');
		$this->session->unset_userdata('filter_b_ptc');
		$this->session->unset_userdata('filter_c_ptc');
		$this->session->unset_userdata('filter_d_ptc');
			$this->session->set_userdata('filter_e_ptc',1);
		$this->session->set_userdata('submenu_report_ptc','POSTING T&C');
		$this->View_Data_Table($id_proccess);
		
	}

	
	public function Export($id_proccess,$export)
	{
		if($this->session->userdata('id_tr') == ''){
			
			$this->M_Global->M_Logout();
			
		}else{
		
			$filter_a		= ($this->session->userdata('filter_a_ptc')) ? $this->session->userdata('filter_a_ptc'):'';
			$filter_b		= ($this->session->userdata('filter_b_ptc')) ? $this->session->userdata('filter_b_ptc'):'';
			$filter_c		= ($this->session->userdata('filter_c_ptc')) ? $this->session->userdata('filter_c_ptc'):'';
			$filter_d		= ($this->session->userdata('filter_d_ptc')) ? $this->session->userdata('filter_d_ptc'):'';
			$filter_e		= ($this->session->userdata('filter_e_ptc')) ? $this->session->userdata('filter_e_ptc'):'';
			$filter_g		= ($this->session->userdata('filter_g_ptc')) ? $this->session->userdata('filter_g_ptc'): enid_get(60);
			$filter_date_aa	= ($this->session->userdata('filter_date_aa_ptc')) ? $this->session->userdata('filter_date_aa_ptc'):'';
			$filter_date_ab	= ($this->session->userdata('filter_date_ab_ptc')) ? $this->session->userdata('filter_date_ab_ptc'):'';
			$petty_name		= ($this->session->userdata('petty_name_ptc')) ? $this->session->userdata('petty_name_ptc'):'ALL';
			
			$filter = array(
			'filter_a' => $filter_a,
			'filter_b' => $filter_b,
			'filter_c' => $filter_c,
			'filter_d' => $filter_d,
			'filter_e' => $filter_e,
			'filter_e' => $filter_e,
			'filter_f' => desid_get($id_proccess),
			'filter_g' => desid_get($filter_g),
			'filter_date_aa' => $filter_date_aa,
			'filter_date_ab' => $filter_date_ab,
			'export' => 0
			);
			
			$data['num_data_driver']		= 0;
			$data['num_data_courier']		= 0;
			
			if($filter_b != 1){
				$data['num_data_driver']		= $this->M_Report_Petty_Cash->M_Report_Petty_CashNumRow_Driver($filter)->num_rows();
				$data['result_data_driver']		= $this->M_Report_Petty_Cash->M_Report_Petty_CashData_Driver($filter)->result();
			}
			if($filter_a != 1){
				$data['num_data_courier']		= $this->M_Report_Petty_Cash->M_Report_Petty_CashNumRow_Courier($filter)->num_rows();
				$data['result_data_courier']	= $this->M_Report_Petty_Cash->M_Report_Petty_CashData_Courier($filter)->result();
			}
			
			$data['num_expense_header']			= $this->M_Report_Petty_Cash->M_Expense_Header()->num_rows();
			$data['result_data_expense_header']	= $this->M_Report_Petty_Cash->M_Expense_Header()->result();
			
			//$data['num_marked_driver']			= $this->M_Report_Petty_Cash->M_Marked_Driver_Num($filter)->num_rows();
			//$data['num_marked_courier']			= $this->M_Report_Petty_Cash->M_Marked_Courier_Num($filter)->num_rows();
			
			$target_proccess = array('id_proccess' => (int)desid_get($id_proccess));
			$result_proccess_row	= $this->M_Global->M_Select_Where('transport_request.request_proccess',$target_proccess)->row();
			
			
			$data['export_to']	 = $export;
			$data['petty_name']  = $petty_name;
			$data['filter_a'] 	 = $filter_a;
			$data['filter_b'] 	 = $filter_b;
			$data['id_proccess'] = $id_proccess;
			
			$data['title_report']	= $result_proccess_row->description;

						
			$this->load->view('report_petty_cash_export',$data);
		}
	}
	
/* end */	
}
