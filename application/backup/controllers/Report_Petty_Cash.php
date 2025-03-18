<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_Petty_Cash extends CI_Controller {

	Public function __construct(){
	parent::__construct();
		
		$this->load->model('M_Request_Courier');	
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
			
			$this->session->unset_userdata('filter_a_rpty');
			$this->session->unset_userdata('filter_b_rpty');
			$this->session->unset_userdata('filter_c_rpty');
			$this->session->unset_userdata('filter_d_rpty');
			$this->session->unset_userdata('filter_e_rpty');
			$this->session->unset_userdata('filter_g_rpty');
			$this->session->unset_userdata('filter_date_aa_rpty');
			$this->session->unset_userdata('filter_date_ab_rpty');
			$this->session->unset_userdata('petty_name_rpty');

			$data['set_menu'] = '<li class="breadcrumb-item" aria-current="page">Report</li>';
			$data['set_submenu'] = '<li class="breadcrumb-item" aria-current="page">Petty Cash Data</li>';
			$data['set_action'] = '';
			
			$filter_a		= ($this->session->userdata('filter_a_rpty')) ? $this->session->userdata('filter_a_rpty'):'';
			$filter_b		= ($this->session->userdata('filter_b_rpty')) ? $this->session->userdata('filter_b_rpty'):'';
			$filter_c		= ($this->session->userdata('filter_c_rpty')) ? $this->session->userdata('filter_c_rpty'):'';
			$filter_d		= ($this->session->userdata('filter_d_rpty')) ? $this->session->userdata('filter_d_rpty'):'';
			$filter_e		= ($this->session->userdata('filter_e_rpty')) ? $this->session->userdata('filter_e_rpty'):'';
			$filter_g		= ($this->session->userdata('filter_g_rpty')) ? $this->session->userdata('filter_g_rpty'): $this->session->userdata('set_company_default');
			$filter_date_aa	= ($this->session->userdata('filter_date_aa_rpty')) ? $this->session->userdata('filter_date_aa_rpty'):'';
			$filter_date_ab	= ($this->session->userdata('filter_date_ab_rpty')) ? $this->session->userdata('filter_date_ab_rpty'):'';
			$petty_name		= ($this->session->userdata('petty_name_rpty')) ? $this->session->userdata('petty_name_rpty'):'ALL';
			
			$filter = array(
			'filter_a' => $filter_a,
			'filter_b' => $filter_b,
			'filter_c' => $filter_c,
			'filter_d' => $filter_d,
			'filter_e' => $filter_e,
			'filter_f' => 0,
			'filter_g' => desid_get($filter_g),
			'filter_date_aa' => $filter_date_aa,
			'filter_date_ab' => $filter_date_ab,
			'export' => 0
			);
			
			$data['num_data_courier']		= 0;
			$data['num_data_driver']		= 0;
			$data['num_marked_driver']		= 0;
			$data['num_marked_courier']		= 0;
			
			if($filter_b != 1){
				$data['num_data_driver']		= $this->M_Report_Petty_Cash->M_Report_Petty_CashNumRow_Driver($filter)->num_rows();
				$data['result_data_driver']		= $this->M_Report_Petty_Cash->M_Report_Petty_CashData_Driver($filter)->result();
				$data['num_marked_driver']		= $this->M_Report_Petty_Cash->M_Marked_Driver_Num($filter)->num_rows();
			}
			if($filter_a != 1){
				$data['num_data_courier']		= $this->M_Report_Petty_Cash->M_Report_Petty_CashNumRow_Courier($filter)->num_rows();
				$data['result_data_courier']	= $this->M_Report_Petty_Cash->M_Report_Petty_CashData_Courier($filter)->result();
				$data['num_marked_courier']		= $this->M_Report_Petty_Cash->M_Marked_Courier_Num($filter)->num_rows();
			}
			
			$data['num_expense_header']			= $this->M_Report_Petty_Cash->M_Expense_Header()->num_rows();
			$data['result_data_expense_header']	= $this->M_Report_Petty_Cash->M_Expense_Header()->result();
			
			$x = '';
			$data['result_company']				= $this->M_Global->M_Search_List_Company($x)->result();
			
			$y = array('id_parameter' => (int)desid_get($filter_g));
			$result_company_row					= $this->M_Global->M_Select_Where('transport_request.parameter',$y)->row();
			
			$data['company_name'] 	= $result_company_row->name;
			$data['petty_name'] 	= $petty_name;
			$data['filter_a'] 		= $filter_a;
			$data['filter_b'] 		= $filter_b;
			
			$this->load->view('report_petty_cash',$data);
		
		}
	}
	
	
	public function Data_Table()
	{
		if($this->session->userdata('id_tr') == ''){
			
			$this->M_Global->M_Logout();
			
		}else{
			
			$filter_a		= ($this->session->userdata('filter_a_rpty')) ? $this->session->userdata('filter_a_rpty'):'';
			$filter_b		= ($this->session->userdata('filter_b_rpty')) ? $this->session->userdata('filter_b_rpty'):'';
			$filter_c		= ($this->session->userdata('filter_c_rpty')) ? $this->session->userdata('filter_c_rpty'):'';
			$filter_d		= ($this->session->userdata('filter_d_rpty')) ? $this->session->userdata('filter_d_rpty'):'';
			$filter_e		= ($this->session->userdata('filter_e_rpty')) ? $this->session->userdata('filter_e_rpty'):'';
			$filter_g		= ($this->session->userdata('filter_g_rpty')) ? $this->session->userdata('filter_g_rpty'): $this->session->userdata('set_company_default');
			$filter_date_aa	= ($this->session->userdata('filter_date_aa_rpty')) ? $this->session->userdata('filter_date_aa_rpty'):'';
			$filter_date_ab	= ($this->session->userdata('filter_date_ab_rpty')) ? $this->session->userdata('filter_date_ab_rpty'):'';
			$petty_name	= ($this->session->userdata('petty_name_rpty')) ? $this->session->userdata('petty_name_rpty'):'ALL';
			
			$filter = array(
			'filter_a' => $filter_a,
			'filter_b' => $filter_b,
			'filter_c' => $filter_c,
			'filter_d' => $filter_d,
			'filter_e' => $filter_e,
			'filter_f' => 0,
			'filter_g' => desid_get($filter_g),
			'filter_date_aa' => $filter_date_aa,
			'filter_date_ab' => $filter_date_ab,
			'export' => 0
			);
			
			$data['num_data_driver']		= 0;
			$data['num_data_courier']		= 0;
			$data['num_marked_driver']		= 0;
			$data['num_marked_courier']		= 0;
			
			if($filter_b != 1){
				$data['num_data_driver']		= $this->M_Report_Petty_Cash->M_Report_Petty_CashNumRow_Driver($filter)->num_rows();
				$data['result_data_driver']		= $this->M_Report_Petty_Cash->M_Report_Petty_CashData_Driver($filter)->result();
				$data['num_marked_driver']			= $this->M_Report_Petty_Cash->M_Marked_Driver_Num($filter)->num_rows();
			}
			if($filter_a != 1){
				$data['num_data_courier']		= $this->M_Report_Petty_Cash->M_Report_Petty_CashNumRow_Courier($filter)->num_rows();
				$data['result_data_courier']	= $this->M_Report_Petty_Cash->M_Report_Petty_CashData_Courier($filter)->result();
				$data['num_marked_courier']			= $this->M_Report_Petty_Cash->M_Marked_Courier_Num($filter)->num_rows();
			}
			
			$data['num_expense_header']			= $this->M_Report_Petty_Cash->M_Expense_Header()->num_rows();
			$data['result_data_expense_header']	= $this->M_Report_Petty_Cash->M_Expense_Header()->result();			
			
			$x = '';
			$data['result_company']				= $this->M_Global->M_Search_List_Company($x)->result();
			
			$y = array('id_parameter' => (int)desid_get($filter_g));
			$result_company_row					= $this->M_Global->M_Select_Where('transport_request.parameter',$y)->row();
			
			$data['company_name'] 	= $result_company_row->name;
			$data['petty_name'] 	= $petty_name;
			$data['filter_a'] 		= $filter_a;
			$data['filter_b'] 		= $filter_b;
			
		$this->load->view('report_petty_cash_data',$data);
		
		}
	}

	public function Petty_Company($target){
			
			$this->session->set_userdata('filter_g_rpty',$target);
		$this->session->unset_userdata('filter_a_rpty');
		$this->session->unset_userdata('filter_b_rpty');
		$this->session->unset_userdata('filter_c_rpty');
		$this->session->unset_userdata('filter_d_rpty');
		$this->session->unset_userdata('filter_e_rpty');
		$this->session->set_userdata('petty_name_rpty','ALL');
		$this->Data_Table();
		
	}
	
	public function Petty_General(){
		
		$this->session->unset_userdata('filter_a_rpty');
		$this->session->unset_userdata('filter_b_rpty');
		$this->session->unset_userdata('filter_c_rpty');
		$this->session->unset_userdata('filter_d_rpty');
		$this->session->unset_userdata('filter_e_rpty');
		$this->session->set_userdata('petty_name_rpty','ALL');
		$this->Data_Table();
		
	}	
	
	public function Petty_Driver(){
		
			$this->session->set_userdata('filter_a_rpty',1);
		$this->session->unset_userdata('filter_b_rpty');
		$this->session->unset_userdata('filter_c_rpty');
		$this->session->unset_userdata('filter_d_rpty');
		$this->session->unset_userdata('filter_e_rpty');
		$this->session->set_userdata('petty_name_rpty','DRIVER');
		$this->Data_Table();
		
	}	
	
	public function Petty_Courier(){
		
		$this->session->unset_userdata('filter_a_rpty');
			$this->session->set_userdata('filter_b_rpty',1);
		$this->session->unset_userdata('filter_c_rpty');
		$this->session->unset_userdata('filter_d_rpty');
		$this->session->unset_userdata('filter_e_rpty');
		$this->session->set_userdata('petty_name_rpty','COURIER');
		$this->Data_Table();
		
	}
	
	public function Petty_Gs(){
		
		$this->session->unset_userdata('filter_a_rpty');
		$this->session->unset_userdata('filter_b_rpty');
			$this->session->set_userdata('filter_c_rpty',1);
		$this->session->unset_userdata('filter_d_rpty');
		$this->session->unset_userdata('filter_e_rpty');
		$this->session->set_userdata('petty_name_rpty','POSTING GS');
		$this->Data_Table();
		
	}
	
	public function Petty_To(){
		
		$this->session->unset_userdata('filter_a_rpty');
		$this->session->unset_userdata('filter_b_rpty');
		$this->session->unset_userdata('filter_c_rpty');
			$this->session->set_userdata('filter_d_rpty',1);
		$this->session->unset_userdata('filter_e_rpty');
		$this->session->set_userdata('petty_name_rpty','POSTING TO');
		$this->Data_Table();
		
	}	
	
	public function Petty_Tc(){
		
		$this->session->unset_userdata('filter_a_rpty');
		$this->session->unset_userdata('filter_b_rpty');
		$this->session->unset_userdata('filter_c_rpty');
		$this->session->unset_userdata('filter_d_rpty');
			$this->session->set_userdata('filter_e_rpty',1);
		$this->session->set_userdata('petty_name_rpty','POSTING T&C');
		$this->Data_Table();
		
	}
	
	public function Search_Date()
	{
		$date_aa	= date_input($this->input->post('input_date_a'));
		$date_ab	= date_input($this->input->post('input_date_b'));
		
		$this->session->set_userdata('filter_date_aa_rpty',$date_aa);
		$this->session->set_userdata('filter_date_ab_rpty',$date_ab);
		
		if($date_aa != '' && $date_ab != ''){
			$this->Data_Table();
		}else{
			echo myalert('danger','Please complete the date');
		}
		
	}
	
	public function Mark_Add(){
		
		$index  	  = (int)desid_get($this->input->post('input_index')); 
		$request	  = (int)$this->input->post('input_request');  
		$iduser		  = (int)desid_get($this->session->userdata('id_tr'));
		
		$data = array(
			'id_request' => $index,
			'created_by' => $iduser,
			'request' => $request
		);
		
		$trans_status = $this->M_Global->M_Save('transport_request.request_mark',$data);
		
		if($trans_status === TRUE){
				
			echo 'success';
				
		} else {
				
			echo 'failed';
				
		}
			
	}
	
	public function Mark_Delete(){
		
		$index  	  = (int)desid_get($this->input->post('input_index')); 
		$request	  = (int)$this->input->post('input_request');  
		
		$target = array(
			'id_request' => $index,
			'id_proccess' => null,
			'request' => $request
		);
		
		$trans_status = $this->M_Global->M_Delete('transport_request.request_mark',$target);
		
		if($trans_status === TRUE){
				
			echo 'success';
				
		} else {
				
			echo 'failed';
				
		}
	}	
	
	public function Mark_All_Add(){
		
			$filter_a		= ($this->session->userdata('filter_a_rpty')) ? $this->session->userdata('filter_a_rpty'):'';
			$filter_b		= ($this->session->userdata('filter_b_rpty')) ? $this->session->userdata('filter_b_rpty'):'';
			$filter_c		= ($this->session->userdata('filter_c_rpty')) ? $this->session->userdata('filter_c_rpty'):'';
			$filter_d		= ($this->session->userdata('filter_d_rpty')) ? $this->session->userdata('filter_d_rpty'):'';
			$filter_e		= ($this->session->userdata('filter_e_rpty')) ? $this->session->userdata('filter_e_rpty'):'';
			$filter_g		= ($this->session->userdata('filter_g_rpty')) ? $this->session->userdata('filter_g_rpty'): $this->session->userdata('set_company_default');
			$filter_date_aa	= ($this->session->userdata('filter_date_aa_rpty')) ? $this->session->userdata('filter_date_aa_rpty'):'';
			$filter_date_ab	= ($this->session->userdata('filter_date_ab_rpty')) ? $this->session->userdata('filter_date_ab_rpty'):'';
			$petty_name	= ($this->session->userdata('petty_name_rpty')) ? $this->session->userdata('petty_name_rpty'):'ALL';
			
			$filter = array(
			'filter_a' => $filter_a,
			'filter_b' => $filter_b,
			'filter_c' => $filter_c,
			'filter_d' => $filter_d,
			'filter_e' => $filter_e,
			'filter_f' => 0,
			'filter_g' => desid_get($filter_g),
			'filter_date_aa' => $filter_date_aa,
			'filter_date_ab' => $filter_date_ab,
			'export' => 0
			);
			
			$trans_status 			= FALSE;
			$num_data_driver		= 0;
			$num_data_courier		= 0;
			
			if($filter_b != 1){
				$num_data_driver		= $this->M_Report_Petty_Cash->M_Marked_Driver_Check($filter)->num_rows();
				$result_data_driver		= $this->M_Report_Petty_Cash->M_Marked_Driver_Check($filter)->result();
			}
			if($filter_a != 1){
				$num_data_courier		= $this->M_Report_Petty_Cash->M_Marked_Courier_Check($filter)->num_rows();
				$result_data_courier	= $this->M_Report_Petty_Cash->M_Marked_Courier_Check($filter)->result();
			}
			
			$iduser	      				= (int)desid_get($this->session->userdata('id_tr'));
			
			if($filter_b != 1){
			if($num_data_driver > 0){
			foreach($result_data_driver as $data_driver){				
				
				$data = array(
					'id_request' => $data_driver->id_request,
					'created_by' => $iduser,
					'request' => 1
				);
				
				$trans_status = $this->M_Global->M_Save('transport_request.request_mark',$data);
				
			}}}
			
			if($filter_a != 1){
			if($num_data_courier > 0){
			foreach($result_data_courier as $data_courier){
			
				$data = array(
					'id_request' => $data_courier->id_request,
					'created_by' => $iduser,
					'request' => 2
				);
				
				$trans_status = $this->M_Global->M_Save('transport_request.request_mark',$data);
				
			}}}		
			
		if($trans_status === TRUE){
				
			echo 'success';
				
		} else {
				
			echo 'failed ';
				
		}
	}
	
	public function Mark_All_Delete(){
		
			$filter_a		= ($this->session->userdata('filter_a_rpty')) ? $this->session->userdata('filter_a_rpty'):'';
			$filter_b		= ($this->session->userdata('filter_b_rpty')) ? $this->session->userdata('filter_b_rpty'):'';
			$filter_c		= ($this->session->userdata('filter_c_rpty')) ? $this->session->userdata('filter_c_rpty'):'';
			$filter_d		= ($this->session->userdata('filter_d_rpty')) ? $this->session->userdata('filter_d_rpty'):'';
			$filter_e		= ($this->session->userdata('filter_e_rpty')) ? $this->session->userdata('filter_e_rpty'):'';
			$filter_g		= ($this->session->userdata('filter_g_rpty')) ? $this->session->userdata('filter_g_rpty'): $this->session->userdata('set_company_default');
			$filter_date_aa	= ($this->session->userdata('filter_date_aa_rpty')) ? $this->session->userdata('filter_date_aa_rpty'):'';
			$filter_date_ab	= ($this->session->userdata('filter_date_ab_rpty')) ? $this->session->userdata('filter_date_ab_rpty'):'';
			$petty_name	= ($this->session->userdata('petty_name_rpty')) ? $this->session->userdata('petty_name_rpty'):'ALL';
			
			$filter = array(
			'filter_a' => $filter_a,
			'filter_b' => $filter_b,
			'filter_c' => $filter_c,
			'filter_d' => $filter_d,
			'filter_e' => $filter_e,
			'filter_f' => 0,
			'filter_g' => desid_get($filter_g),
			'filter_date_aa' => $filter_date_aa,
			'filter_date_ab' => $filter_date_ab,
			'export' => 0
			);
			
			$trans_status			= FALSE;
			$num_data_driver		= 0;
			$num_data_courier		= 0;
			
			if($filter_b != 1){
				$num_data_driver		= $this->M_Report_Petty_Cash->M_UnMarked_Driver_Check($filter)->num_rows();
				$result_data_driver		= $this->M_Report_Petty_Cash->M_UnMarked_Driver_Check($filter)->result();
			}
			if($filter_a != 1){
				$num_data_courier		= $this->M_Report_Petty_Cash->M_UnMarked_Courier_Check($filter)->num_rows();
				$result_data_courier	= $this->M_Report_Petty_Cash->M_UnMarked_Courier_Check($filter)->result();
			}
			
			$iduser	      			= (int)desid_get($this->session->userdata('id_tr'));
			
			if($filter_b != 1){
			if($num_data_driver > 0){
			foreach($result_data_driver as $data_driver){				
				
				$target_delete1 = array(
					'id_request' => $data_driver->id_request,
					'id_proccess' => null,
					'request' => 1
				);
				
				$trans_status = $this->M_Global->M_Delete('transport_request.request_mark',$target_delete1);
				
			}}}
			
			if($filter_a != 1){
			if($num_data_courier > 0){
			foreach($result_data_courier as $data_courier){
			
				$target_delete2 = array(
					'id_request' => $data_courier->id_request,
					'id_proccess' => null,
					'request' => 2
				);
				
				$trans_status = $this->M_Global->M_Delete('transport_request.request_mark',$target_delete2);
				
			}}}	
		
		if($trans_status === TRUE){
				
			echo 'success';
				
		} else {
				
			echo 'failed';
				
		}
	}
	
	public function Proccess_Petty(){
		
		$iduser	= (int)desid_get($this->session->userdata('id_tr'));
		
		$filter_g		= ($this->session->userdata('filter_g_rpty')) ? $this->session->userdata('filter_g_rpty'): $this->session->userdata('set_company_default');
		$y = array('id_parameter' => (int)desid_get($filter_g));
		$result_company_row	= $this->M_Global->M_Select_Where('transport_request.parameter',$y)->row();
			
		if($this->session->userdata('filter_date_aa_rpty') != ''){$strip = ' - ';}else{$strip = '';}
		$title_report	= $result_company_row->name.' '.$this->session->userdata('petty_name_rpty').' EXPENSE REPORT '.date_ind($this->session->userdata('filter_date_aa_rpty')).$strip.date_ind($this->session->userdata('filter_date_ab_rpty'));

		
		$data = array(
			'created_by' => $iduser,
			'created_date' => my_date(),
			'created_time' => my_time(),
			'description' => $title_report
		);
				
		$trans_status = $this->M_Global->M_Save('transport_request.request_proccess',$data);
		
		if($trans_status === TRUE){
			
			$new_idtarget = $this->M_Global->M_CheckId('id_proccess','transport_request.request_proccess')->row();

			$filter_a		= ($this->session->userdata('filter_a_rpty')) ? $this->session->userdata('filter_a_rpty'):'';
			$filter_b		= ($this->session->userdata('filter_b_rpty')) ? $this->session->userdata('filter_b_rpty'):'';
			$filter_c		= ($this->session->userdata('filter_c_rpty')) ? $this->session->userdata('filter_c_rpty'):'';
			$filter_d		= ($this->session->userdata('filter_d_rpty')) ? $this->session->userdata('filter_d_rpty'):'';
			$filter_e		= ($this->session->userdata('filter_e_rpty')) ? $this->session->userdata('filter_e_rpty'):'';
			$filter_g		= ($this->session->userdata('filter_g_rpty')) ? $this->session->userdata('filter_g_rpty'): $this->session->userdata('set_company_default');
			$filter_date_aa	= ($this->session->userdata('filter_date_aa_rpty')) ? $this->session->userdata('filter_date_aa_rpty'):'';
			$filter_date_ab	= ($this->session->userdata('filter_date_ab_rpty')) ? $this->session->userdata('filter_date_ab_rpty'):'';
			$petty_name	= ($this->session->userdata('petty_name_rpty')) ? $this->session->userdata('petty_name_rpty'):'ALL';
			
			$filter = array(
			'filter_a' => $filter_a,
			'filter_b' => $filter_b,
			'filter_c' => $filter_c,
			'filter_d' => $filter_d,
			'filter_e' => $filter_e,
			'filter_f' => 0,
			'filter_g' => desid_get($filter_g),
			'filter_date_aa' => $filter_date_aa,
			'filter_date_ab' => $filter_date_ab,
			'export' => 0
			);
			
			$num_data_driver		= 0;
			$num_data_courier		= 0;
			
			if($filter_b != 1){
				$num_data_driver		= $this->M_Report_Petty_Cash->M_UnMarked_Driver_Check($filter)->num_rows();
				$result_data_driver		= $this->M_Report_Petty_Cash->M_UnMarked_Driver_Check($filter)->result();
			}
			if($filter_a != 1){
				$num_data_courier		= $this->M_Report_Petty_Cash->M_UnMarked_Courier_Check($filter)->num_rows();
				$result_data_courier	= $this->M_Report_Petty_Cash->M_UnMarked_Courier_Check($filter)->result();
			}
			
			$iduser	      			= (int)desid_get($this->session->userdata('id_tr'));
			
			if($filter_b != 1){
			if($num_data_driver > 0){
			foreach($result_data_driver as $data_driver){				
			
				$target_update1 = array(
					'id_request' => $data_driver->id_request,
					'id_proccess' => null,
					'request' => 1
				);
				$data_update1   = array('id_proccess' => $new_idtarget->id_proccess);
				$this->M_Global->M_Update('transport_request.request_mark',$data_update1,$target_update1);
				
			}}}
			
			if($filter_a != 1){
			if($num_data_courier > 0){
			foreach($result_data_courier as $data_courier){
			
				$target_update2 = array(
					'id_request' => $data_courier->id_request,
					'id_proccess' => null,
					'request' => 2
				);
				$data_update2   = array('id_proccess' => $new_idtarget->id_proccess);
				$this->M_Global->M_Update('transport_request.request_mark',$data_update2,$target_update2);
				
			}}}	
			
			echo myalert('success','Proccess successfully');
			
			$this->Data_Table();
			
		} else {
				
			echo myalert('danger','Proccess failed');
			
			$this->Data_Table();
				
		}
	}
	

	public function Export($export)
	{
		if($this->session->userdata('id_tr') == ''){
			
			$this->M_Global->M_Logout();
			
		}else{
		
			$filter_a		= ($this->session->userdata('filter_a_rpty')) ? $this->session->userdata('filter_a_rpty'):'';
			$filter_b		= ($this->session->userdata('filter_b_rpty')) ? $this->session->userdata('filter_b_rpty'):'';
			$filter_c		= ($this->session->userdata('filter_c_rpty')) ? $this->session->userdata('filter_c_rpty'):'';
			$filter_d		= ($this->session->userdata('filter_d_rpty')) ? $this->session->userdata('filter_d_rpty'):'';
			$filter_e		= ($this->session->userdata('filter_e_rpty')) ? $this->session->userdata('filter_e_rpty'):'';
			$filter_g		= ($this->session->userdata('filter_g_rpty')) ? $this->session->userdata('filter_g_rpty'): $this->session->userdata('set_company_default');
			$filter_date_aa	= ($this->session->userdata('filter_date_aa_rpty')) ? $this->session->userdata('filter_date_aa_rpty'):'';
			$filter_date_ab	= ($this->session->userdata('filter_date_ab_rpty')) ? $this->session->userdata('filter_date_ab_rpty'):'';
			$petty_name	= ($this->session->userdata('petty_name_rpty')) ? $this->session->userdata('petty_name_rpty'):'ALL';
			
			$filter = array(
			'filter_a' => $filter_a,
			'filter_b' => $filter_b,
			'filter_c' => $filter_c,
			'filter_d' => $filter_d,
			'filter_e' => $filter_e,
			'filter_f' => 0,
			'filter_g' => desid_get($filter_g),
			'filter_date_aa' => $filter_date_aa,
			'filter_date_ab' => $filter_date_ab,
			'export' => 1
			);
			
			$data['num_data_driver']		= 0;
			$data['num_data_courier']		= 0;
			///$data['num_marked_driver']		= 0;
			///$data['num_marked_courier']		= 0;
			
			if($filter_b != 1){
				$data['num_data_driver']		= $this->M_Report_Petty_Cash->M_Report_Petty_CashNumRow_Driver($filter)->num_rows();
				$data['result_data_driver']		= $this->M_Report_Petty_Cash->M_Report_Petty_CashData_Driver($filter)->result();
				///$data['num_marked_driver']		= $this->M_Report_Petty_Cash->M_Marked_Driver_Num($filter)->num_rows();
			}
			if($filter_a != 1){
				$data['num_data_courier']		= $this->M_Report_Petty_Cash->M_Report_Petty_CashNumRow_Courier($filter)->num_rows();
				$data['result_data_courier']	= $this->M_Report_Petty_Cash->M_Report_Petty_CashData_Courier($filter)->result();
				///$data['num_marked_courier']		= $this->M_Report_Petty_Cash->M_Marked_Courier_Num($filter)->num_rows();
			}
			
			$data['num_expense_header']			= $this->M_Report_Petty_Cash->M_Expense_Header()->num_rows();
			$data['result_data_expense_header']	= $this->M_Report_Petty_Cash->M_Expense_Header()->result();
			
			$target_company = array('id_parameter' => (int)desid_get($filter_g));
			$result_company_row	= $this->M_Global->M_Select_Where('transport_request.parameter',$target_company)->row();
			
			$data['export_to']	 	= $export;
			$data['petty_name'] 	= $petty_name;
			$data['filter_a'] 	 	= $filter_a;
			$data['filter_b'] 	 	= $filter_b;
			
			if($this->session->userdata('filter_date_aa_rpty') != ''){$strip = ' - ';}else{$strip = '';}
			$data['title_report']	= $result_company_row->name.' '.$this->session->userdata('petty_name_rpty').' EXPENSE REPORT '.date_ind($this->session->userdata('filter_date_aa_rpty')).$strip.date_ind($this->session->userdata('filter_date_ab_rpty'));

			$this->load->view('report_petty_cash_export',$data);
		}
	}
	
	
/* end */	
}
