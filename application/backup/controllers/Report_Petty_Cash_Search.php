<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_Petty_Cash_Search extends CI_Controller {

	Public function __construct(){
	parent::__construct();
		
		$this->load->model('M_Request_Courier');	
		$this->load->model('M_Report_Petty_Cash');	
		$this->load->model('M_Report_Petty_Cash_Search');
		
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
			
			$this->session->unset_userdata('filter_a_rpts');
			$this->session->unset_userdata('filter_b_rpts');
			$this->session->unset_userdata('filter_c_rpts');
			$this->session->unset_userdata('filter_d_rpts');
			$this->session->unset_userdata('filter_e_rpts');
			$this->session->unset_userdata('filter_f_rpts');
			$this->session->unset_userdata('filter_g_rpts');
			$this->session->unset_userdata('filter_h_rpts');
			$this->session->unset_userdata('filter_i_rpts');
			$this->session->unset_userdata('filter_date_aa_rpts');
			$this->session->unset_userdata('filter_date_ab_rpts');
			
			$data['set_menu'] 		= '<li class="breadcrumb-item" aria-current="page">Report</li>';
			$data['set_submenu'] 	= '<li class="breadcrumb-item" aria-current="page">Petty Cash Search</li>';
			$data['set_action'] 	= '';
			
			$target_company 		= array('id_parameter_category' => $this->session->userdata('set_company'),'status' => 1);
			$data['result_company']	= $this->M_Global->M_List_Parameter($target_company)->result();
			
			$target_purpose 		= array('id_parameter_category' => $this->session->userdata('set_expense_purpose'),'status' => 1);
			$data['result_purpose']	= $this->M_Global->M_List_Parameter($target_purpose)->result();
			
			$data['result_department']	= $this->M_Report_Petty_Cash_Search->M_Select_Department()->result();
			
			$data['result_requestor']	= $this->M_Report_Petty_Cash_Search->M_Select_Requestor()->result();
			
			$data['result_driver']		= $this->M_Report_Petty_Cash_Search->M_Select_Driver()->result();
			$data['result_courier']		= $this->M_Report_Petty_Cash_Search->M_Select_Courier()->result();
			
			$target_external 			= array('id_parameter_category' => $this->session->userdata('set_external'),'status' => 1);
			$data['result_external']	= $this->M_Global->M_List_Parameter($target_external)->result();
			
			$data['date_a']	= date_ind(my_date());
			$data['date_b']	= date_ind(my_date());
			
			$this->load->view('report_petty_cash_search',$data);
		
		}
	}

	public function Search()
	{
		if($this->session->userdata('id_tr') == ''){
			
			$this->M_Global->M_Logout();
			
		}else{
			
		$this->session->set_userdata('filter_a_rpts',$this->input->post('input_company'));
		$this->session->set_userdata('filter_b_rpts',$this->input->post('input_request'));
		$this->session->set_userdata('filter_c_rpts',$this->input->post('input_purpose'));
		$this->session->set_userdata('filter_d_rpts',$this->input->post('input_department'));
		$this->session->set_userdata('filter_e_rpts',$this->input->post('input_requestor'));
		$this->session->set_userdata('filter_f_rpts',$this->input->post('input_driver'));
		$this->session->set_userdata('filter_g_rpts',$this->input->post('input_courier'));
		$this->session->set_userdata('filter_h_rpts',$this->input->post('input_external'));
		$this->session->set_userdata('filter_i_rpts',$this->input->post('input_close'));
		$this->session->set_userdata('filter_date_aa_rpts',$this->input->post('input_date_a'));
		$this->session->set_userdata('filter_date_ab_rpts',$this->input->post('input_date_b'));
		
			$this->Data_Table();
		
		}
	}	
	
	public function Data_Table()
	{
		if($this->session->userdata('id_tr') == ''){
			
			$this->M_Global->M_Logout();
			
		}else{
			
			$filter_a		= ($this->session->userdata('filter_a_rpts')) ? $this->session->userdata('filter_a_rpts'):'';
			$filter_b		= ($this->session->userdata('filter_b_rpts')) ? $this->session->userdata('filter_b_rpts'):'';
			$filter_c		= ($this->session->userdata('filter_c_rpts')) ? $this->session->userdata('filter_c_rpts'):'';
			$filter_d		= ($this->session->userdata('filter_d_rpts')) ? $this->session->userdata('filter_d_rpts'):'';
			$filter_e		= ($this->session->userdata('filter_e_rpts')) ? $this->session->userdata('filter_e_rpts'):'';
			$filter_f		= ($this->session->userdata('filter_f_rpts')) ? $this->session->userdata('filter_f_rpts'):'';
			$filter_g		= ($this->session->userdata('filter_g_rpts')) ? $this->session->userdata('filter_g_rpts'):'';
			$filter_h		= ($this->session->userdata('filter_h_rpts')) ? $this->session->userdata('filter_h_rpts'):'';
			$filter_i		= ($this->session->userdata('filter_i_rpts')) ? $this->session->userdata('filter_i_rpts'):'';
			$filter_date_aa	= ($this->session->userdata('filter_date_aa_rpts')) ? $this->session->userdata('filter_date_aa_rpts'):'';
			$filter_date_ab	= ($this->session->userdata('filter_date_ab_rpts')) ? $this->session->userdata('filter_date_ab_rpts'):'';
			
			$filter_a = (int)$filter_a;
			$filter_b = (int)$filter_b;
			$filter_c = (int)$filter_c;
			$filter_d = (int)$filter_d;
			$filter_e = (int)$filter_e;
			$filter_f = (int)$filter_f;
			$filter_g = (int)$filter_g;
			$filter_h = (int)$filter_h;
			$filter_i = (int)$filter_i;
			
			$filter = array(
			'filter_a' => $filter_a, // company 
			'filter_b' => $filter_b, // request 1=driver 2=courier
			'filter_c' => $filter_c, // purpose
			'filter_d' => $filter_d, // department
			'filter_e' => $filter_e, // requestor
			'filter_f' => $filter_f, //driver
			'filter_g' => $filter_g, //courier
			'filter_h' => $filter_h, //external
			'filter_i' => $filter_i, // petty new or close
			'filter_date_aa' => date_input($filter_date_aa),
			'filter_date_ab' => date_input($filter_date_ab)
			);
			$data['num_data_driver']		= 0;
			$data['num_data_courier']		= 0;
			
			if($filter_b == 2){}
			else{
				
				$data['num_data_driver']		= $this->M_Report_Petty_Cash_Search->M_Report_Petty_CashNumRow_Driver($filter)->num_rows();
				$data['result_data_driver']		= $this->M_Report_Petty_Cash_Search->M_Report_Petty_CashData_Driver($filter)->result();
				
			}
			if($filter_b == 1){}
			else{
				
				$data['num_data_courier']		= $this->M_Report_Petty_Cash_Search->M_Report_Petty_CashNumRow_Courier($filter)->num_rows();
				$data['result_data_courier']	= $this->M_Report_Petty_Cash_Search->M_Report_Petty_CashData_Courier($filter)->result();
				
			}
			
			$data['num_expense_header']			= $this->M_Report_Petty_Cash->M_Expense_Header()->num_rows();
			$data['result_data_expense_header']	= $this->M_Report_Petty_Cash->M_Expense_Header()->result();			
						
		$this->load->view('report_petty_cash_search_data',$data);
		
		}
	}


	public function Export($export)
	{
		if($this->session->userdata('id_tr') == ''){
			
			$this->M_Global->M_Logout();
			
		}else{
			
			$filter_a		= ($this->session->userdata('filter_a_rpts')) ? $this->session->userdata('filter_a_rpts'):'';
			$filter_b		= ($this->session->userdata('filter_b_rpts')) ? $this->session->userdata('filter_b_rpts'):'';
			$filter_c		= ($this->session->userdata('filter_c_rpts')) ? $this->session->userdata('filter_c_rpts'):'';
			$filter_d		= ($this->session->userdata('filter_d_rpts')) ? $this->session->userdata('filter_d_rpts'):'';
			$filter_e		= ($this->session->userdata('filter_e_rpts')) ? $this->session->userdata('filter_e_rpts'):'';
			$filter_f		= ($this->session->userdata('filter_f_rpts')) ? $this->session->userdata('filter_f_rpts'):'';
			$filter_g		= ($this->session->userdata('filter_g_rpts')) ? $this->session->userdata('filter_g_rpts'):'';
			$filter_h		= ($this->session->userdata('filter_h_rpts')) ? $this->session->userdata('filter_h_rpts'):'';
			$filter_i		= ($this->session->userdata('filter_i_rpts')) ? $this->session->userdata('filter_i_rpts'):'';
			$filter_date_aa	= ($this->session->userdata('filter_date_aa_rpts')) ? $this->session->userdata('filter_date_aa_rpts'):'';
			$filter_date_ab	= ($this->session->userdata('filter_date_ab_rpts')) ? $this->session->userdata('filter_date_ab_rpts'):'';
			
			$filter_a = (int)$filter_a;
			$filter_b = (int)$filter_b;
			$filter_c = (int)$filter_c;
			$filter_d = (int)$filter_d;
			$filter_e = (int)$filter_e;
			$filter_f = (int)$filter_f;
			$filter_g = (int)$filter_g;
			$filter_h = (int)$filter_h;
			$filter_i = (int)$filter_i;
			
			$filter = array(
			'filter_a' => $filter_a, // company 
			'filter_b' => $filter_b, // request 1=driver 2=courier
			'filter_c' => $filter_c, // purpose
			'filter_d' => $filter_d, // department
			'filter_e' => $filter_e, // requestor
			'filter_f' => $filter_f, //driver
			'filter_g' => $filter_g, //courier
			'filter_h' => $filter_h, //external
			'filter_i' => $filter_i, // petty new or close
			'filter_date_aa' => date_input($filter_date_aa),
			'filter_date_ab' => date_input($filter_date_ab)
			);
			$data['num_data_driver']		= 0;
			$data['num_data_courier']		= 0;
			
			if($filter_b == 2){}
			else{
				
				$data['num_data_driver']		= $this->M_Report_Petty_Cash_Search->M_Report_Petty_CashNumRow_Driver($filter)->num_rows();
				$data['result_data_driver']		= $this->M_Report_Petty_Cash_Search->M_Report_Petty_CashData_Driver($filter)->result();
				
			}
			if($filter_b == 1){}
			else{
				
				$data['num_data_courier']		= $this->M_Report_Petty_Cash_Search->M_Report_Petty_CashNumRow_Courier($filter)->num_rows();
				$data['result_data_courier']	= $this->M_Report_Petty_Cash_Search->M_Report_Petty_CashData_Courier($filter)->result();
				
			}
			
			$data['num_expense_header']			= $this->M_Report_Petty_Cash->M_Expense_Header()->num_rows();
			$data['result_data_expense_header']	= $this->M_Report_Petty_Cash->M_Expense_Header()->result();			
			
			$data['export_to']	 	= $export;
			$data['title_report']	= 'Report Petty Cash';
		$this->load->view('report_petty_cash_search_data_export',$data);
		
		}
	}
	
/* end */	
}
