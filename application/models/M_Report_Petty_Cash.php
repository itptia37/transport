<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_Report_Petty_Cash extends CI_Model {

	public function M_Report_Petty_CashNumRow_Driver($filter)
	{
		
		$this->db->distinct('a.id_request');		
		$this->db->select('a.id_request');		
		$this->db->from('transport_request.request_driver a');
		
		$this->db->where('a.status',3);		
		$this->db->join('transport_request.request_expense l', 
			'a.id_request = l.id_request and 
			l.request = 1 and l.expense_type <> 67 ');
		
		
		if($filter['filter_a'] == 1){$this->db->where('a.driver > ',0);}
		if($filter['filter_c'] == 1){$this->db->where('a.expense_purpose',9);} //general
		if($filter['filter_d'] == 1){$this->db->where('a.expense_purpose',8);} //to
		if($filter['filter_e'] == 1){$this->db->where('a.expense_purpose',7);} //future
		if($filter['filter_g'] > 0){$this->db->where('a.company',$filter['filter_g']);}		
		if($filter['filter_date_aa'] != '' && $filter['filter_date_ab'] != ''){
			$this->db->where("a.start_date between '".$filter['filter_date_aa']."' and '".$filter['filter_date_ab']."' ");
		}		
		
		if($filter['filter_f'] > 0){
			$this->db->join('transport_request.request_mark k', 'a.id_request = k.id_request and k.request = 1','INNER');
			$this->db->where('k.id_proccess',$filter['filter_f']);
		}else{
			if($filter['export'] == 1) {$join = 'INNER';}else{$join = 'LEFT';}
			$this->db->join('transport_request.request_mark k', 'a.id_request = k.id_request and k.request = 1',$join);
			$this->db->where('k.id_proccess',null);	
		}

		
		return $this->db->get();
		
	}
	
	public function M_Report_Petty_CashData_Driver($filter)
	{
		
		$this->db->distinct('a.id_request');
		
		$this->db->select('a.*,
		b.email as requestor_email,
		c.name as requestor,c.department,
		e.name as driver_name,
		g.name as external_name,
		h.name as request_option_name,
		i.name as car_name,
		j.name as expense_purpose_name,
		k.id_mark');
		
		$this->db->from('transport_request.request_driver a');
		
		$this->db->join('login.login_user b', 'a.created_by = b.id_login','LEFT');
		$this->db->join('public.public_view_employee c', 'b.id_employee = c.id_employee','LEFT');
		
		$this->db->join('transport_request.parameter_driver d', 'a.driver = d.driver','LEFT');
		$this->db->join('public.public_view_employee e', 'd.driver = e.id_employee','LEFT');
		
		$this->db->join('transport_request.parameter g', 'a.external = g.id_parameter','LEFT');
		$this->db->join('transport_request.parameter h', 'a.request_option = h.id_parameter','LEFT');
		$this->db->join('transport_request.parameter i', 'a.car = i.id_parameter','LEFT');
		$this->db->join('transport_request.parameter j', 'a.expense_purpose = j.id_parameter','LEFT');
		
		$this->db->where('a.status',3);			
		$this->db->join('transport_request.request_expense l', 
			'a.id_request = l.id_request and 
			l.request = 1 and 
			l.expense_type <> 67 ');
		
		if($filter['filter_a'] == 1){$this->db->where('a.driver > ',0);}
		if($filter['filter_c'] == 1){$this->db->where('a.expense_purpose',9);} //general
		if($filter['filter_d'] == 1){$this->db->where('a.expense_purpose',8);} //to
		if($filter['filter_e'] == 1){$this->db->where('a.expense_purpose',7);} //future
		if($filter['filter_g'] > 0){$this->db->where('a.company',$filter['filter_g']);}		
		if($filter['filter_date_aa'] != '' && $filter['filter_date_ab'] != ''){
			$this->db->where("a.start_date between '".$filter['filter_date_aa']."' and '".$filter['filter_date_ab']."' ");
		}	
		
		if($filter['filter_f'] > 0){
			$this->db->join('transport_request.request_mark k', 'a.id_request = k.id_request and k.request = 1','INNER');
			$this->db->where('k.id_proccess',$filter['filter_f']);
		}else{
			if($filter['export'] == 1) {$join = 'INNER';}else{$join = 'LEFT';}
			$this->db->join('transport_request.request_mark k', 'a.id_request = k.id_request and k.request = 1',$join);
			$this->db->where('k.id_proccess',null);	
		}
		
		 $this->db->order_by('id_request','ASC');
		
		return $this->db->get();
		
	}
	
	public function M_Marked_Driver_Num ($filter){
		
		$this->db->distinct('a.id_request');		
		$this->db->select('a.id_request');		
		$this->db->from('transport_request.request_mark a');
		
		$this->db->join('transport_request.request_driver b', 
			'a.id_request = b.id_request','INNER');			
		
		$this->db->where('a.request',1);	
		$this->db->where('b.status',3);				
	
		if($filter['filter_a'] == 1){$this->db->where('b.driver > ',0);}
		if($filter['filter_c'] == 1){$this->db->where('b.expense_purpose',9);} //general
		if($filter['filter_d'] == 1){$this->db->where('b.expense_purpose',8);} //to
		if($filter['filter_e'] == 1){$this->db->where('b.expense_purpose',7);} //future		
		if($filter['filter_g'] > 0){$this->db->where('b.company',$filter['filter_g']);}		
		if($filter['filter_date_aa'] != '' && $filter['filter_date_ab'] != ''){
			$this->db->where("b.start_date between '".$filter['filter_date_aa']."' and '".$filter['filter_date_ab']."' ");
		}	
		
		if($filter['filter_f'] > 0){
			$this->db->where('a.id_proccess',$filter['filter_f']);
		}else{
			$this->db->where('a.id_proccess',null);	
		}
	
		return $this->db->get();	
	
	}
	
	public function M_Marked_Driver_Check($filter)
	{
		
		$this->db->distinct('a.id_request');		
		$this->db->select('a.id_request');		
		$this->db->from('transport_request.request_driver a');
		$this->db->join('transport_request.request_expense b', 
			'a.id_request = b.id_request and 
			b.request = 1 and 
			b.expense_type <> 67 ');
			
		/* NOT IN */
		$this->db->where('a.status',3);
		$this->db->where('a.id_request not in (select c.id_request 
		from transport_request.request_mark c where c.request = 1 )');
		
		if($filter['filter_a'] == 1){$this->db->where('a.driver > ',0);}
		if($filter['filter_c'] == 1){$this->db->where('a.expense_purpose',9);} //general
		if($filter['filter_d'] == 1){$this->db->where('a.expense_purpose',8);} //to
		if($filter['filter_e'] == 1){$this->db->where('a.expense_purpose',7);} //future		
		if($filter['filter_g'] > 0){$this->db->where('a.company',$filter['filter_g']);}		
		if($filter['filter_date_aa'] != '' && $filter['filter_date_ab'] != ''){
			$this->db->where("a.start_date between '".$filter['filter_date_aa']."' and '".$filter['filter_date_ab']."' ");
		}	
		
		return $this->db->get();
		
	}	
	
	public function M_UnMarked_Driver_Check($filter)
	{
		
		$this->db->distinct('a.id_request');		
		$this->db->select('a.id_request');		
		$this->db->from('transport_request.request_driver a');
		$this->db->join('transport_request.request_expense b', 
			'a.id_request = b.id_request and 
			b.request = 1 and 
			b.expense_type <> 67 ');
		
		/* INNER but NULL */
		$this->db->where('a.status',3);
		$this->db->join('transport_request.request_mark c', 
			'a.id_request = c.id_request and c.request = 1');
		$this->db->where('c.id_proccess',null);
		
		if($filter['filter_a'] == 1){$this->db->where('a.driver > ',0);}
		if($filter['filter_c'] == 1){$this->db->where('a.expense_purpose',9);} //general
		if($filter['filter_d'] == 1){$this->db->where('a.expense_purpose',8);} //to
		if($filter['filter_e'] == 1){$this->db->where('a.expense_purpose',7);} //future		
		if($filter['filter_g'] > 0){$this->db->where('a.company',$filter['filter_g']);}		
		if($filter['filter_date_aa'] != '' && $filter['filter_date_ab'] != ''){
			$this->db->where("a.start_date between '".$filter['filter_date_aa']."' and '".$filter['filter_date_ab']."' ");
		}	
		
		return $this->db->get();
		
	}	
	
	
	
	
	
	
	
	
	
	public function M_Report_Petty_CashNumRow_Courier($filter)
	{
		
		$this->db->distinct('a.id_request');		
		$this->db->select('a.id_request');		
		$this->db->from('transport_request.request_courier a');
		
		$this->db->where('a.status',3);
		$this->db->join('transport_request.request_expense l', 
			'a.id_request = l.id_request and 
			l.request = 2 and l.expense_type <> 67 ');
			
		if($filter['filter_b'] == 1){$this->db->where('a.courier > ',0);}
		if($filter['filter_c'] == 1){$this->db->where('a.expense_purpose',9);} //general
		if($filter['filter_d'] == 1){$this->db->where('a.expense_purpose',8);} //to
		if($filter['filter_e'] == 1){$this->db->where('a.expense_purpose',7);} //future		
		if($filter['filter_g'] > 0){$this->db->where('a.company',$filter['filter_g']);}		
		if($filter['filter_date_aa'] != '' && $filter['filter_date_ab'] != ''){
			$this->db->where("a.start_date between '".$filter['filter_date_aa']."' and '".$filter['filter_date_ab']."' ");
		}	
		
		if($filter['filter_f'] > 0){
			$this->db->join('transport_request.request_mark k', 'a.id_request = k.id_request and k.request = 2','INNER');
			$this->db->where('k.id_proccess',$filter['filter_f']);
		}else{
			if($filter['export'] == 1) {$join = 'INNER';}else{$join = 'LEFT';}
			$this->db->join('transport_request.request_mark k', 'a.id_request = k.id_request and k.request = 2',$join);
			$this->db->where('k.id_proccess',null);	
		}
		
		return $this->db->get();
		
	}
	
	public function M_Report_Petty_CashData_Courier($filter)
	{
		
		$this->db->distinct('a.id_request');
		
		$this->db->select('a.*,
		b.email as requestor_email,
		c.name as requestor,c.department,
		e.name as courier_name,
		g.name as external_name,
		h.name as request_option_name,
		i.name as delivery_name,
		j.name as expense_purpose_name,
		k.id_mark');
		
		$this->db->from('transport_request.request_courier a');
		
		$this->db->join('login.login_user b', 'a.created_by = b.id_login','LEFT');
		$this->db->join('public.public_view_employee c', 'b.id_employee = c.id_employee','LEFT');
		
		$this->db->join('transport_request.parameter_courier d', 'a.courier = d.courier','LEFT');
		$this->db->join('public.public_view_employee e', 'd.courier = e.id_employee','LEFT');
		
		$this->db->join('transport_request.parameter g', 'a.external = g.id_parameter','LEFT');
		$this->db->join('transport_request.parameter h', 'a.request_option = h.id_parameter','LEFT');
		$this->db->join('transport_request.parameter i', 'a.delivery = i.id_parameter','LEFT');
		$this->db->join('transport_request.parameter j', 'a.expense_purpose = j.id_parameter','LEFT');
		
		$this->db->where('a.status',3);
		$this->db->join('transport_request.request_expense l', 
			'a.id_request = l.id_request and 
			l.request = 2 and 
			l.expense_type <> 67 ');
			
		if($filter['filter_b'] == 1){$this->db->where('a.courier > ',0);}
		if($filter['filter_c'] == 1){$this->db->where('a.expense_purpose',9);} //general
		if($filter['filter_d'] == 1){$this->db->where('a.expense_purpose',8);} //to
		if($filter['filter_e'] == 1){$this->db->where('a.expense_purpose',7);} //future
		if($filter['filter_g'] > 0){$this->db->where('a.company',$filter['filter_g']);}		
		if($filter['filter_date_aa'] != '' && $filter['filter_date_ab'] != ''){
			$this->db->where("a.start_date between '".$filter['filter_date_aa']."' and '".$filter['filter_date_ab']."' ");
		}	
		
		if($filter['filter_f'] > 0){
			$this->db->join('transport_request.request_mark k', 'a.id_request = k.id_request and k.request = 2','INNER');
			$this->db->where('k.id_proccess',$filter['filter_f']);
		}else{
			if($filter['export'] == 1) {$join = 'INNER';}else{$join = 'LEFT';}
			$this->db->join('transport_request.request_mark k', 'a.id_request = k.id_request and k.request = 2',$join);
			$this->db->where('k.id_proccess',null);	
		}
		
		$this->db->order_by('id_request','ASC');
		
		return $this->db->get();
		
	}
	
	public function M_Marked_Courier_Num ($filter){
		
	$this->db->distinct('a.id_request');		
		$this->db->select('a.id_request');		
		$this->db->from('transport_request.request_mark a');
		
		$this->db->join('transport_request.request_courier b', 
			'a.id_request = b.id_request','INNER');			
		
		$this->db->where('a.request',2);	
		$this->db->where('b.status',3);					
	
		if($filter['filter_a'] == 1){$this->db->where('b.driver > ',0);}
		if($filter['filter_c'] == 1){$this->db->where('b.expense_purpose',9);} //general
		if($filter['filter_d'] == 1){$this->db->where('b.expense_purpose',8);} //to
		if($filter['filter_e'] == 1){$this->db->where('b.expense_purpose',7);} //future		
		if($filter['filter_g'] > 0){$this->db->where('b.company',$filter['filter_g']);}		
		if($filter['filter_date_aa'] != '' && $filter['filter_date_ab'] != ''){
			$this->db->where("b.start_date between '".$filter['filter_date_aa']."' and '".$filter['filter_date_ab']."' ");
		}	
		
		if($filter['filter_f'] > 0){
			$this->db->where('a.id_proccess',$filter['filter_f']);
		}else{
			$this->db->where('a.id_proccess',null);	
		}
	
		return $this->db->get();		
	
	}

	public function M_Marked_Courier_Check($filter)
	{
		
		$this->db->distinct('a.id_request');		
		$this->db->select('a.id_request');		
		$this->db->from('transport_request.request_courier a');
		$this->db->join('transport_request.request_expense b', 
			'a.id_request = b.id_request and 
			b.request = 2 and 
			b.expense_type <> 67 ');
			
		/* NOT IN */
		$this->db->where('a.status',3);
		$this->db->where('a.id_request not in (select c.id_request 
		from transport_request.request_mark c where c.request = 2 )');
		
		if($filter['filter_b'] == 1){$this->db->where('a.courier > ',0);}
		if($filter['filter_c'] == 1){$this->db->where('a.expense_purpose',9);} //general
		if($filter['filter_d'] == 1){$this->db->where('a.expense_purpose',8);} //to
		if($filter['filter_e'] == 1){$this->db->where('a.expense_purpose',7);} //future				
		if($filter['filter_g'] > 0){$this->db->where('a.company',$filter['filter_g']);}		
		if($filter['filter_date_aa'] != '' && $filter['filter_date_ab'] != ''){
			$this->db->where("a.start_date between '".$filter['filter_date_aa']."' and '".$filter['filter_date_ab']."' ");
		}	
		
		return $this->db->get();
		
	}
	
	public function M_UnMarked_Courier_Check($filter)
	{
		
		$this->db->distinct('a.id_request');		
		$this->db->select('a.id_request');		
		$this->db->from('transport_request.request_courier a');
		$this->db->join('transport_request.request_expense b', 
			'a.id_request = b.id_request and 
			b.request = 2 and 
			b.expense_type <> 67 ');
			
		/* INNER but NULL */
		$this->db->where('a.status',3);
		$this->db->join('transport_request.request_mark c', 
			'a.id_request = c.id_request and c.request = 2');
		$this->db->where('c.id_proccess',null);
		
		if($filter['filter_b'] == 1){$this->db->where('a.courier > ',0);}
		if($filter['filter_c'] == 1){$this->db->where('a.expense_purpose',9);} //general
		if($filter['filter_d'] == 1){$this->db->where('a.expense_purpose',8);} //to
		if($filter['filter_e'] == 1){$this->db->where('a.expense_purpose',7);} //future				
		if($filter['filter_g'] > 0){$this->db->where('a.company',$filter['filter_g']);}		
		if($filter['filter_date_aa'] != '' && $filter['filter_date_ab'] != ''){
			$this->db->where("a.start_date between '".$filter['filter_date_aa']."' and '".$filter['filter_date_ab']."' ");
		}	
		
		return $this->db->get();
		
	}
	
	
	
	
	
	
	
	
	
	public function M_Expense_Header()
	{
		$this->db->select('id_parameter,name');
		$this->db->where('id_parameter_category',$this->session->userdata('set_expense_type'));
		$this->db->where('status',1);
		$this->db->where('id_parameter !=',67);
		$this->db->order_by('seq');
		return $this->db->get('transport_request.parameter');
	}
	

	public function M_Expense_Detail($expense_type,$id_request,$request)
	{
		$this->db->select('balance');
		$this->db->where('id_request',$id_request);
		$this->db->where('expense_type',$expense_type);
		$this->db->where('request',$request);
		$this->db->where('status',1);
		return $this->db->get('transport_request.request_expense');
	}
	
	public function M_Expense_Total($id_request,$request)
	{
		$this->db->select('sum(balance) as total');
		$this->db->where('id_request',$id_request);
		$this->db->where('request',$request);
		$this->db->where('status',1);
		return $this->db->get('transport_request.request_expense');
	}
	
/* end */
}
?>