<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cash extends CI_Controller {

	Public function __construct(){
	parent::__construct();
		
		$this->load->model('M_Cash');	
		
	}
	
	public function Check_Last_Date()
	{
		$start_date	= date_input($this->input->post('input_start_date'));
		$receiver	= (int)desid_get($this->input->post('input_receiver'));
		$id_cash 	= (int)desid_get($this->input->post('input_target'));
		
		if($id_cash <= 0){
			
			$qcheck_date	= $this->M_Cash->M_Check_Last_Date($receiver);
			
			if($qcheck_date->num_rows() > 0){ 
				$get_check_date = $qcheck_date->row();
				if(strtotime($start_date) <= strtotime($get_check_date->end_date)){
					
					echo 'NOT';
					
				}else{
					echo 'YES';
				}
			}else{
				echo 'YES';
			}
			
		}else{
			echo 'YES';	
		}
		
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
		
			$this->session->unset_userdata('page_crv');
			$this->session->unset_userdata('next_crv');
			$this->session->unset_userdata('src_crv');
		
			$this->session->set_userdata('fild_a_crv',0);
			$this->session->set_userdata('fild_b_crv',0);
			$this->session->set_userdata('fild_c_crv',0);
			$this->session->set_userdata('fild_d_crv',0);
			$this->session->set_userdata('fild_e_crv',0);
			
			$this->session->unset_userdata('filter_a_crv');
			$this->session->unset_userdata('filter_st_crv');	
			$this->session->unset_userdata('filter_date_aa_crv');	
			$this->session->unset_userdata('filter_date_ab_crv');
			
			$data['set_menu'] = '<li class="breadcrumb-item" aria-current="page">Cash Receipt</li>';
			$data['set_submenu'] = '<li class="breadcrumb-item" aria-current="page">Cash Receipt Data</li>';
			$data['set_action'] = '';
			
			/* pagging */
			$myrow	= ($this->session->userdata('myrow_crv')) ? $this->session->userdata('myrow_crv'):25;
			$page	= ($this->session->userdata('page_crv')) ? $this->session->userdata('page_crv'):1;
			$next	= ($this->session->userdata('next_crv')) ? $this->session->userdata('next_crv'):1;
			$start 	= $myrow * ($page-1);
			
			/* src */
			$src		= ($this->session->userdata('src_crv')) ? $this->session->userdata('src_crv'):''; 
			
			/* oreder */
			$fild_a		= ($this->session->userdata('fild_a_crv')) ? $this->session->userdata('fild_a_crv'):0;
			$order_a	= ($this->session->userdata('order_a_crv')) ? $this->session->userdata('order_a_crv'):'ASC';
			$fild_b		= ($this->session->userdata('fild_b_crv')) ? $this->session->userdata('fild_b_crv'):0;
			$order_b	= ($this->session->userdata('order_b_crv')) ? $this->session->userdata('order_b_crv'):'ASC';
			$fild_c		= ($this->session->userdata('fild_c_crv')) ? $this->session->userdata('fild_c_crv'):0;
			$order_c	= ($this->session->userdata('order_c_crv')) ? $this->session->userdata('order_c_crv'):'ASC';
			$fild_d		= ($this->session->userdata('fild_d_crv')) ? $this->session->userdata('fild_d_crv'):0;
			$order_d	= ($this->session->userdata('order_d_crv')) ? $this->session->userdata('order_d_crv'):'ASC';
			$fild_e		= ($this->session->userdata('fild_e_crv')) ? $this->session->userdata('fild_e_crv'):0;
			$order_e	= ($this->session->userdata('order_e_crv')) ? $this->session->userdata('order_e_crv'):'ASC';
			
			$filter_a		= ($this->session->userdata('filter_a_crv')) ? $this->session->userdata('filter_a_crv'):'';
			$filter_st		= ($this->session->userdata('filter_st_crv')) ? $this->session->userdata('filter_st_crv'):'';
			$filter_date_aa	= ($this->session->userdata('filter_date_aa_crv')) ? $this->session->userdata('filter_date_aa_crv'):'';
			$filter_date_ab	= ($this->session->userdata('filter_date_ab_crv')) ? $this->session->userdata('filter_date_ab_crv'):'';
			
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
			'fild_e' => $fild_e,
			'order_e' => $order_e,
			'filter_a' => (int)desid_get($filter_a),
			'filter_st' => $filter_st,
			'filter_date_aa' => $filter_date_aa,
			'filter_date_ab' => $filter_date_ab
			);
			
			$data['num_data']		= $this->M_Cash->M_CashNumRow($filter)->num_rows();
			$data['result_data']	= $this->M_Cash->M_CashData($filter)->result();
			
			/* pagging */
			$data['max']			= (ceil($data['num_data']/$myrow)); 
			$data['myrow'] 			= $myrow; 
			$data['page'] 			= $page;
			$data['next'] 			= $next;		
			$data['start'] 			= $start;
			$data['controller']		= 'Cash';
			
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
			$data['fild_e'] 		= $fild_e;
			$data['order_e']		= $order_e;	
		
		$this->load->view('cash',$data);
		
		}
	}

	public function Data_Table()
	{
		if($this->session->userdata('id_tr') == ''){
			
			$this->M_Global->M_Logout();
			
		}else{
			
			/* pagging */
			$myrow	= ($this->session->userdata('myrow_crv')) ? $this->session->userdata('myrow_crv'):25;
			$page	= ($this->session->userdata('page_crv')) ? $this->session->userdata('page_crv'):1;
			$next	= ($this->session->userdata('next_crv')) ? $this->session->userdata('next_crv'):1;
			$start 	= $myrow * ($page-1);
			
			/* src */
			$src		= ($this->session->userdata('src_crv')) ? $this->session->userdata('src_crv'):''; 
			
			/* oreder */
			$fild_a		= ($this->session->userdata('fild_a_crv')) ? $this->session->userdata('fild_a_crv'):0;
			$order_a	= ($this->session->userdata('order_a_crv')) ? $this->session->userdata('order_a_crv'):'ASC';
			$fild_b		= ($this->session->userdata('fild_b_crv')) ? $this->session->userdata('fild_b_crv'):0;
			$order_b	= ($this->session->userdata('order_b_crv')) ? $this->session->userdata('order_b_crv'):'ASC';
			$fild_c		= ($this->session->userdata('fild_c_crv')) ? $this->session->userdata('fild_c_crv'):0;
			$order_c	= ($this->session->userdata('order_c_crv')) ? $this->session->userdata('order_c_crv'):'ASC';
			$fild_d		= ($this->session->userdata('fild_d_crv')) ? $this->session->userdata('fild_d_crv'):0;
			$order_d	= ($this->session->userdata('order_d_crv')) ? $this->session->userdata('order_d_crv'):'ASC';
			$fild_e		= ($this->session->userdata('fild_e_crv')) ? $this->session->userdata('fild_e_crv'):0;
			$order_e	= ($this->session->userdata('order_e_crv')) ? $this->session->userdata('order_e_crv'):'ASC';
			
			$filter_a		= ($this->session->userdata('filter_a_crv')) ? $this->session->userdata('filter_a_crv'):'';
			$filter_st		= ($this->session->userdata('filter_st_crv')) ? $this->session->userdata('filter_st_crv'):'';
			$filter_date_aa	= ($this->session->userdata('filter_date_aa_crv')) ? $this->session->userdata('filter_date_aa_crv'):'';
			$filter_date_ab	= ($this->session->userdata('filter_date_ab_crv')) ? $this->session->userdata('filter_date_ab_crv'):'';
			
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
			'fild_e' => $fild_e,
			'order_e' => $order_e,
			'filter_a' => (int)desid_get($filter_a),
			'filter_st' => $filter_st,
			'filter_date_aa' => $filter_date_aa,
			'filter_date_ab' => $filter_date_ab
			);
			
			$data['num_data']		= $this->M_Cash->M_CashNumRow($filter)->num_rows();
			$data['result_data']	= $this->M_Cash->M_CashData($filter)->result();
			
			/* pagging */
			$data['max']			= (ceil($data['num_data']/$myrow)); 
			$data['myrow'] 			= $myrow; 
			$data['page'] 			= $page;
			$data['next'] 			= $next;		
			$data['start'] 			= $start;
			$data['controller']		= 'Cash';
			
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
			$data['fild_e'] 		= $fild_e;
			$data['order_e']		= $order_e;	
		
		$this->load->view('cash_data',$data);
		
		}
	}
	
	
	public function Order_a_asc()
	{						
			$this->session->set_userdata('fild_a_crv',1);
			$this->session->set_userdata('fild_b_crv',0);
			$this->session->set_userdata('fild_c_crv',0);
			$this->session->set_userdata('fild_d_crv',0);
			$this->session->set_userdata('fild_e_crv',0);
			$this->session->set_userdata('order_a_crv','ASC');
			
			$this->Data_Table();
	}	

	public function Order_a_desc()
	{						
			$this->session->set_userdata('fild_a_crv',1);
			$this->session->set_userdata('fild_b_crv',0);
			$this->session->set_userdata('fild_c_crv',0);
			$this->session->set_userdata('fild_d_crv',0);
			$this->session->set_userdata('fild_e_crv',0);
			$this->session->set_userdata('fild_e_crv',0);
			$this->session->set_userdata('order_a_crv','DESC');
			
			$this->Data_Table();
	}
	
	public function Order_b_asc()
	{						
			$this->session->set_userdata('fild_a_crv',0);
			$this->session->set_userdata('fild_b_crv',1);
			$this->session->set_userdata('fild_c_crv',0);
			$this->session->set_userdata('fild_d_crv',0);
			$this->session->set_userdata('fild_e_crv',0);
			$this->session->set_userdata('order_b_crv','ASC');
			
			$this->Data_Table();
	}	

	public function Order_b_desc()
	{						
			$this->session->set_userdata('fild_a_crv',0);
			$this->session->set_userdata('fild_b_crv',1);
			$this->session->set_userdata('fild_c_crv',0);
			$this->session->set_userdata('fild_d_crv',0);
			$this->session->set_userdata('fild_e_crv',0);
			$this->session->set_userdata('order_b_crv','DESC');
			
			$this->Data_Table();
	}

	public function Order_c_asc()
	{						
			$this->session->set_userdata('fild_a_crv',0);
			$this->session->set_userdata('fild_b_crv',0);
			$this->session->set_userdata('fild_c_crv',1);
			$this->session->set_userdata('fild_d_crv',0);
			$this->session->set_userdata('fild_e_crv',0);
			$this->session->set_userdata('order_c_crv','ASC');
			
			$this->Data_Table();
	}	

	public function Order_c_desc()
	{						
			$this->session->set_userdata('fild_a_crv',0);
			$this->session->set_userdata('fild_b_crv',0);
			$this->session->set_userdata('fild_c_crv',1);
			$this->session->set_userdata('fild_d_crv',0);
			$this->session->set_userdata('fild_e_crv',0);
			$this->session->set_userdata('order_c_crv','DESC');
			
			$this->Data_Table();
	}

	public function Order_d_asc()
	{						
			$this->session->set_userdata('fild_a_crv',0);
			$this->session->set_userdata('fild_b_crv',0);
			$this->session->set_userdata('fild_c_crv',0);
			$this->session->set_userdata('fild_d_crv',1);
			$this->session->set_userdata('fild_e_crv',0);
			$this->session->set_userdata('order_d_crv','ASC');
			
			$this->Data_Table();
	}	

	public function Order_d_desc()
	{						
			$this->session->set_userdata('fild_a_crv',0);
			$this->session->set_userdata('fild_b_crv',0);
			$this->session->set_userdata('fild_c_crv',0);
			$this->session->set_userdata('fild_d_crv',1);
			$this->session->set_userdata('fild_e_crv',0);
			$this->session->set_userdata('order_d_crv','DESC');
			
			$this->Data_Table();
	}
	
	public function Order_e_asc()
	{						
			$this->session->set_userdata('fild_a_crv',0);
			$this->session->set_userdata('fild_b_crv',0);
			$this->session->set_userdata('fild_c_crv',0);
			$this->session->set_userdata('fild_d_crv',0);
			$this->session->set_userdata('fild_e_crv',1);
			$this->session->set_userdata('order_e_crv','ASC');
			
			$this->Data_Table();
	}	

	public function Order_e_desc()
	{						
			$this->session->set_userdata('fild_a_crv',0);
			$this->session->set_userdata('fild_b_crv',0);
			$this->session->set_userdata('fild_c_crv',0);
			$this->session->set_userdata('fild_d_crv',0);
			$this->session->set_userdata('fild_e_crv',1);
			$this->session->set_userdata('order_e_crv','DESC');
			
			$this->Data_Table();
	}
	
	public function Rows($val)
	{
			$this->session->unset_userdata('page_crv');
			$this->session->unset_userdata('next_crv');
			$this->session->set_userdata('myrow_crv',$val);		
			$this->Data_Table();
		
	}
	
	public function Search()
	{						
			$this->session->unset_userdata('page_crv');
			$this->session->unset_userdata('next_crv');
			
			$src = string_src($this->input->post('input_src'));			
			
			$this->session->set_userdata('src_crv',$src);
			
			$this->Data_Table();
	}
	
	public function Page()
	{
	
			$page	= ($this->uri->segment('3')) ? $this->uri->segment('3'):1; 
			$next 	= ($this->uri->segment('4')) ? $this->uri->segment('4'):1; 
			
			$this->session->set_userdata('page_crv',$page);
			$this->session->set_userdata('next_crv',$next);
			
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
					'no_cash' => '',
					'start_date' => ph(5),
					'end_date' => ph(5),
					'receiver' => '',
					'receiver_name' => ph(1),
					'amount' => '',
					'words' => '',
					'creater' => '',
					'creater_email' => '',
					'created_date' => '',
					'updater' => '',
					'updater_email' => '',
					'updated_date' => '',
					'status' => ''
					);
				
				$this->load->view('cash_form',$data);
				
			}elseif($act == 'Edit' && desid_get($target) > 0){
				
				$get = $this->M_Cash->M_Cash_Detail(desid_get($target))->row();
				
				$data = array(
					'action' => 'Edit',
					'target' => $target,
					'no_cash' => $get->no_cash,
					'start_date' => date_ind(xxs_filter($get->start_date)),
					'end_date' => date_ind(xxs_filter($get->end_date)),
					'receiver' => enid_get(xxs_filter($get->receiver)),
					'receiver_name' => xxs_filter($get->receiver_name),
					'amount' => curr_ind(xxs_filter($get->amount)),
					'words' => to_words_ind(xxs_filter($get->amount)),
					'creater' => xxs_filter($get->creater),
					'creater_email' => xxs_filter($get->creater_email),
					'created_date' => date_time_ind_full($get->created_date),
					'updater' => xxs_filter($get->updater),
					'updater_email' => xxs_filter($get->updater_email),
					'updated_date' => date_time_ind_full($get->updated_date),
					'status' => $get->status
					);
				
				if($get->status == 0){
					$this->load->view('cash_form',$data);
				}else{
					$this->load->view('cash_view',$data);
				}
			
			}elseif($act == 'Print' && desid_get($target) > 0){
				
				$get = $this->M_Cash->M_Cash_Detail(desid_get($target))->row();
				
				$data = array(
					'action' => 'Print',
					'target' => $target,
					'no_cash' => $get->no_cash,
					'start_date' => date_ind(xxs_filter($get->start_date)),
					'end_date' => date_ind(xxs_filter($get->end_date)),
					'receiver' => enid_get(xxs_filter($get->receiver)),
					'receiver_name' => xxs_filter($get->receiver_name),
					'amount' => curr_ind(xxs_filter($get->amount)),
					'words' => to_words_ind(xxs_filter($get->amount)),
					'creater' => xxs_filter($get->creater),
					'creater_email' => xxs_filter($get->creater_email),
					'created_date' => date_time_ind_full($get->created_date),
					'updater' => xxs_filter($get->updater),
					'updater_email' => xxs_filter($get->updater_email),
					'updated_date' => date_time_ind_full($get->updated_date),
					'status' => $get->status
					);
					
				$this->load->view('cash_print',$data);
			
			}elseif($act == 'PTJ' && desid_get($target) > 0){
				
				$get = $this->M_Cash->M_Cash_Detail(desid_get($target))->row();
				
				if($get->par_driver > 0 && $get->par_courier <= 0){$target_request = 1; $label='Driver';}
				elseif($get->par_driver <= 0 && $get->par_courier > 0){$target_request = 2; $label='Courier';}
					
				$data = array(
					'action' => 'PTJ',
					'target' => $target,
					'no_cash' => $get->no_cash,
					'start_date' => date_ind(xxs_filter($get->start_date)),
					'end_date' => date_ind(xxs_filter($get->end_date)),
					'receiver' => enid_get(xxs_filter($get->receiver)),
					'receiver_name' => xxs_filter($get->receiver_name),
					'amount' =>curr_ind(xxs_filter($get->amount)),
					'words' => to_words_ind(xxs_filter($get->amount)),
					'creater' => xxs_filter($get->creater),
					'creater_email' => xxs_filter($get->creater_email),
					'created_date' => date_time_ind_full($get->created_date),
					'updater' => xxs_filter($get->updater),
					'updater_email' => xxs_filter($get->updater_email),
					'updated_date' => date_time_ind_full($get->updated_date),
					'status' => $get->status,
					'label' => $label
					);
					
					$sum_expense = $this->M_Cash->M_Sum_Expense($get->receiver,$target_request,xxs_filter($get->start_date),xxs_filter($get->end_date))->row();
					$difference	 = $get->amount-$sum_expense->balance;
					$data['total'] = curr_ind($sum_expense->balance);
					$data['difference'] = curr_ind($difference);
					
					if(($difference) < 0)
						{$data['note'] = 'GS bayar kepada '.xxs_filter($get->receiver_name).' sebesar Rp '.curr_ind(abs($difference));}
					elseif(($difference) > 0)
						{$data['note'] = xxs_filter($get->receiver_name).' bayar kepada GS sebesar Rp '.curr_ind(($difference));}
					else{
						$data['note'] = '';
					}
				$this->load->view('settelment_view',$data);
			
			}elseif($act == 'Print_PTJ' && desid_get($target) > 0){
				
				$get = $this->M_Cash->M_Cash_Detail(desid_get($target))->row();
				
				if($get->par_driver > 0 && $get->par_courier <= 0){$target_request = 1; $label='Driver';}
				elseif($get->par_driver <= 0 && $get->par_courier > 0){$target_request = 2; $label='Courier';}
					
				$data = array(
					'action' => 'Print_PTJ',
					'target' => $target,
					'no_cash' => $get->no_cash,
					'start_date' => date_ind(xxs_filter($get->start_date)),
					'end_date' => date_ind(xxs_filter($get->end_date)),
					'receiver' => enid_get(xxs_filter($get->receiver)),
					'receiver_name' => xxs_filter($get->receiver_name),
					'amount' =>curr_ind(xxs_filter($get->amount)),
					'words' => to_words_ind(xxs_filter($get->amount)),
					'creater' => xxs_filter($get->creater),
					'creater_email' => xxs_filter($get->creater_email),
					'created_date' => date_time_ind_full($get->created_date),
					'updater' => xxs_filter($get->updater),
					'updater_email' => xxs_filter($get->updater_email),
					'updated_date' => date_time_ind_full($get->updated_date),
					'status' => $get->status,
					'label' => $label
					);
					
					$sum_expense = $this->M_Cash->M_Sum_Expense($get->receiver,$target_request,xxs_filter($get->start_date),xxs_filter($get->end_date))->row();
					$difference	 = $get->amount-$sum_expense->balance;
					$data['total'] = curr_ind($sum_expense->balance);
					$data['difference'] = curr_ind($difference);
					
					if(($difference) < 0)
						{$data['note'] = 'GS bayar kepada '.xxs_filter($get->receiver_name).' sebesar Rp '.curr_ind(abs($difference));}
					elseif(($difference) > 0)
						{$data['note'] = xxs_filter($get->receiver_name).' bayar kepada GS sebesar Rp '.curr_ind(($difference));}
					else{
						$data['note'] = '';
					}
				$this->load->view('settelment_print',$data);
			
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
		
		$id_cash 	= (int)desid_get($this->input->post('input_target'));
		$start_date	= date_input($this->input->post('input_start_date'));
		$end_date	= date_input($this->input->post('input_end_date'));
		$receiver	= (int)desid_get($this->input->post('input_receiver'));
		$amount		= (float)curr_ind_input($this->input->post('input_amount'));
		
		$iduser		= (int)desid_get($this->session->userdata('id_tr'));
		$date		= my_date_time();
		$table		= 'transport_request.cash_receipt';
			
		if(strtotime($start_date) > strtotime($end_date)){
			
			echo myalert('success','End date may not be smaller than the start date');
			$this->Form('Add',enid_get(0));
			
		}else{
			
		if($id_cash <= 0){			
			
			$val_no   	= '/CR/'.Romawi(date('m'));
			$no_cash 	= $this->M_Global->Create_No_Cash($val_no,$table);
			
			$data = array(
				'no_cash' => $no_cash,
				'start_date' => $start_date,
				'end_date' => $end_date,
				'receiver' => $receiver,
				'amount' => $amount,
				'status' => 0,
				'created_by' => $iduser,
				'created_date' => $date
				);
				
			$trans_status = $this->M_Global->M_Save($table,$data);
			
			if($trans_status === TRUE){
				
				echo myalert('success','Data has been saved');
				
				
				$new_idtarget = $this->M_Global->M_CheckId('id_cash',$table)->row();
				$this->Form('Edit',enid_get($new_idtarget->id_cash));
			
			}else{
				
				echo myalert('danger','Proccess failed');
				
				$this->Form('Add',enid_get(0));
			
			}
			
		}
		elseif($id_cash > 0){
			
			$data = array(
				'start_date' => $start_date,
				'end_date' => $end_date,
				'receiver' => $receiver,
				'amount' => $amount,
				'updated_by' => $iduser,
				'updated_date' => $date				
				);
				
			$target = array('id_cash' => $id_cash);
			
			$trans_status = $this->M_Global->M_Update($table,$data,$target);
			
			if($trans_status === TRUE){
				
				echo myalert('success','Data has been saved');
		
				$this->Form('Edit',enid_get($id_cash));
			
			}else{
			
				echo myalert('danger','Proccess failed');
				
				$this->Form('Edit',enid_get($id_cash));
				
			}
			
		} else {
		
			echo myalert('danger','Proccess failed');
			
			$this->Form('Add',enid_get(0));
			
			}
		
		}
		
		}
	}
	
	
	public function Status()
	{
		if($this->session->userdata('id_tr') == ''){
			
			$this->M_Global->M_Logout();
			
		}else{

			$index 	= (int)desid_get($this->input->post('input_index'));
			$status = (int)$this->input->post('input_status');
			$iduser	= (int)desid_get($this->session->userdata('id_tr'));
			$date	= my_date_time();
			$table	= 'transport_request.cash_receipt';
			
			$data = array(
				'status' => $status,
				'updated_by' => $iduser,
				'updated_date' => $date				
				);
			
			$target = array('id_cash' => $index);
			
			$trans_status = $this->M_Global->M_Update($table,$data,$target);
			
			
			if($trans_status === TRUE){
				
				echo 'Status has been changed';
				
			} else {
				
				echo 'Proccess failed';
				
			}
			
		}
	}	
	
	public function Lock()
	{
		if($this->session->userdata('id_tr') == ''){
			
			$this->M_Global->M_Logout();
			
		}else{

			$id_cash= (int)desid_get($this->input->post('input_index'));
			
			$iduser	= (int)desid_get($this->session->userdata('id_tr'));
			$date	= my_date_time();
			$table	= 'transport_request.cash_receipt';
			
			$get = $this->M_Cash->M_Cash_Detail($id_cash)->row();				
			
			$data = array(
				'status' => 1, 
				'updated_by' => $iduser,
				'updated_date' => $date
				);
			$target = array('id_cash' => $id_cash);
			$trans_status = $this->M_Global->M_Update($table,$data,$target);		
			
			
			if($trans_status === TRUE){
				
					echo myalert('success','Status has been changed');
				
				$this->Form('Edit',enid_get($id_cash));
				
			} else {
				
				echo myalert('danger','Proccess failed');;
				
				$this->Form('Edit',enid_get($id_cash));
				
			}
			
		}
	}	
	
	public function Cancel()
	{
		if($this->session->userdata('id_tr') == ''){
			
			$this->M_Global->M_Logout();
			
		}else{
	
			$id_cash= (int)desid_get($this->input->post('input_index'));
			
			$iduser	= (int)desid_get($this->session->userdata('id_tr'));
			$date	= my_date_time();
			$table	= 'transport_request.cash_receipt';
			
			$get = $this->M_Cash->M_Cash_Detail($id_cash)->row();				
			
			$data = array(
				'status' => 3, 
				'updated_by' => $iduser,
				'updated_date' => $date
				);
			$target = array('id_cash' => $id_cash);
			$trans_status = $this->M_Global->M_Update($table,$data,$target);		
			
			
			if($trans_status === TRUE){
				
					echo myalert('success','Status has been changed');
				
				$this->Form('Edit',enid_get($id_cash));
				
			} else {
				
				echo myalert('danger','Proccess failed');;
				
				$this->Form('Edit',enid_get($id_cash));
				
			}
			
		}
	}	
	
	public function Approve()
	{
		if($this->session->userdata('id_tr') == ''){
			
			$this->M_Global->M_Logout();
			
		}else{

			$id_cash= (int)desid_get($this->input->post('input_index'));
			
			$iduser	= (int)desid_get($this->session->userdata('id_tr'));
			$date	= my_date_time();
			$table1	= 'transport_request.settelment';
			$table2	= 'transport_request.cash_receipt';
			
			$get = $this->M_Cash->M_Cash_Detail($id_cash)->row();				
			
			if($get->par_driver > 0 && $get->par_courier <= 0){$target_request = 1;}
				elseif($get->par_driver <= 0 && $get->par_courier > 0){$target_request = 2;}
				
			$sum_expense = $this->M_Cash->M_Sum_Expense($get->receiver,$target_request,xxs_filter($get->start_date),xxs_filter($get->end_date))->row();
			$difference	 = $get->amount-$sum_expense->balance;
			
			$data1 = array(
				'id_cash' => $id_cash,
				'difference' => $difference,
				'approved_by' => $iduser,
				'approved_date' => $date
				);
			
			$trans_status = $this->M_Global->M_Save($table1,$data1);
			
			
			if($trans_status === TRUE){
				
				$data2 = array(
					'status' => 2,
					'updated_by' => $iduser,
					'updated_date' => $date
					);
				$target = array('id_cash' => $id_cash);
				$this->M_Global->M_Update($table2,$data2,$target);
				
				echo myalert('success','Status has been changed');
				
				$this->Form('PTJ',enid_get($id_cash));
				
			} else {
				
				echo myalert('danger','Proccess failed');;
				
				$this->Form('PTJ',enid_get($id_cash));
				
			}
			
		}
	}	
	

	
	public function Search_List_Receiver()
	{						
		if($this->session->userdata('id_tr') == ''){
			
			$this->M_Global->M_Logout();
			
		}else{
		
			$src = string_src($this->input->post('input_src_list'));			
			
			$query1 = $this->M_Cash->M_Search_List_Driver($src)->result();
			$query2 = $this->M_Cash->M_Search_List_Courier($src)->result();
			
			foreach($query1 as $data1){
				echo'<li><a href="#" 
				onclick="ListDataSelect(
				&#39;my-list-box-receiver_name&#39;,
				&#39;input_receiver&#39;,
				&#39;'.enid_get($data1->id_employee).'&#39;,
				&#39;input_receiver_name&#39;,
				&#39;'.$data1->name.'&#39;
				)">'.$data1->name.'</li>';
			}
			
			foreach($query2 as $data2){
				echo'<li><a href="#" 
				onclick="ListDataSelect(
				&#39;my-list-box-receiver_name&#39;,
				&#39;input_receiver&#39;,
				&#39;'.enid_get($data2->id_employee).'&#39;,
				&#39;input_receiver_name&#39;,
				&#39;'.$data2->name.'&#39;
				)">'.$data2->name.'</li>';
			}
			
		}
	}

	public function Filter_Search_List_Receiver()
	{						
		if($this->session->userdata('id_tr') == ''){
			
			$this->M_Global->M_Logout();
			
		}else{
		
			$src = string_src($this->input->post('input_src_list'));			
			
			$query1 = $this->M_Cash->M_Filter_Search_List_Driver($src)->result();
			$query2 = $this->M_Cash->M_Filter_Search_List_Courier($src)->result();
			
			foreach($query1 as $data1){
				
				echo'<li onclick="LoadDataTable(&#39;Cash/Filter_List_a/'.enid_get($data1->id_employee).'&#39;)"><a href="#">'.$data1->name.'</a></li>';
			
			}
			
			foreach($query2 as $data2){
				
				echo'<li onclick="LoadDataTable(&#39;Cash/Filter_List_a/'.enid_get($data2->id_employee).'&#39;)"><a href="#">'.$data2->name.'</a></li>';
			
			}
			
		}
	}
	
	public function Filter_List_a($target)
	{
		$this->session->set_userdata('filter_a_crv',$target);		
		$this->Data_Table();
		
	}
	
	public function Filter_Status($target)
	{
		$this->session->set_userdata('filter_st_crv',$target);		
		$this->Data_Table();
		
	}

	public function Filter_Date_a()
	{
		$date_aa	= date_input($this->input->post('input_date_a'));
		$date_ab	= date_input($this->input->post('input_date_b'));
		
		$this->session->set_userdata('filter_date_aa_crv',$date_aa);
		$this->session->set_userdata('filter_date_ab_crv',$date_ab);
		
		$this->Data_Table();
		
	}
	
/* end */	
}
