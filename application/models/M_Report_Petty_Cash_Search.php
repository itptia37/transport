<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Report_Petty_Cash_Search extends CI_Model {

	public function M_Select_Department()
	{
		$this->db->distinct('id_department');
		$this->db->select('id_department,department');
		return $this->db->get('public.public_view_employee');
	}
	
	public function M_Select_Requestor()
	{
		$this->db->distinct('a.id_login');
		$this->db->select('a.id_login,b.email,c.name');
		$this->db->from('transport_request.user a');
		$this->db->where('c.status','Active');
		$this->db->join('login.login_user b', 'a.id_login = b.id_login','LEFT');
		$this->db->join('public.public_view_employee c', 'b.id_employee = c.id_employee','LEFT');
		return $this->db->get();
	}

	public function M_Select_Driver()
	{
		$this->db->distinct('a.driver');
		$this->db->select('a.driver,b.name');
		$this->db->from('transport_request.parameter_driver a');
		$this->db->where('a.status',1);
		$this->db->join('public.public_view_employee b', 'a.driver = b.id_employee','LEFT');
		return $this->db->get();
	}
	

	public function M_Select_Courier()
	{
		$this->db->distinct('a.courier');
		$this->db->select('a.courier,b.name');
		$this->db->from('transport_request.parameter_courier a');
		$this->db->where('a.status',1);
		$this->db->join('public.public_view_employee b', 'a.courier = b.id_employee','LEFT');
		return $this->db->get();
	}
	
	
	public function M_Report_Petty_CashNumRow_Driver($filter)
	{		
		$this->db->distinct('a.id_request');		
		$this->db->select('a.id_request');		
		$this->db->from('transport_request.request_driver a');
		
		$this->db->join('login.login_user b', 'a.created_by = b.id_login','LEFT');
		$this->db->join('public.public_view_employee c', 'b.id_employee = c.id_employee','LEFT');
		
		$this->db->join('transport_request.parameter_driver d', 'a.driver = d.driver','LEFT');
		$this->db->join('public.public_view_employee e', 'd.driver = e.id_employee','LEFT');
		
		$this->db->join('transport_request.parameter g', 'a.external = g.id_parameter','LEFT');
		$this->db->join('transport_request.parameter h', 'a.request_option = h.id_parameter','LEFT');
		$this->db->join('transport_request.parameter i', 'a.car = i.id_parameter','LEFT');
		$this->db->join('transport_request.parameter j', 'a.expense_purpose = j.id_parameter','LEFT');
		
		$this->db->join('transport_request.request_expense l', 'a.id_request = l.id_request and l.request = 1 and l.expense_type <> 67 ');
		
		$this->db->where('a.status',3);	
		if($filter['filter_a'] > 0){$this->db->where('a.company ',$filter['filter_a']);}
		//$filter['filter_b'] diletakan di controller (request 1=driver 2=courier)
		if($filter['filter_c'] > 0){$this->db->where('a.expense_purpose',$filter['filter_c']);} 
		if($filter['filter_d'] > 0){$this->db->where('c.id_department',$filter['filter_d']);} 
		if($filter['filter_e'] > 0){$this->db->where('a.created_by',$filter['filter_e']);} 
		if($filter['filter_f'] > 0){$this->db->where('a.driver',$filter['filter_f']);}
		//$filter['filter_g'] adalah courier
		if($filter['filter_date_aa'] != '' && $filter['filter_date_ab'] != ''){
			$this->db->where("a.start_date between '".$filter['filter_date_aa']."' and '".$filter['filter_date_ab']."' ");
		}	
		
		if($filter['filter_i'] == 2){
			$this->db->join('transport_request.request_mark k', 'a.id_request = k.id_request and k.request = 1','INNER');
			$this->db->where('k.id_proccess <> ',null);	
		}elseif($filter['filter_i'] == 1){
			$this->db->join('transport_request.request_mark k', 'a.id_request = k.id_request and k.request = 1','INNER');
			$this->db->where('k.id_proccess',null);	
			$this->db->or_where('a.id_request not in(select m.id_request from transport_request.request_mark m where m.request = 1)');
			/*	
				$this->db->where('a.status',3);	
				if($filter['filter_a'] > 0){$this->db->where('a.company ',$filter['filter_a']);}
				//$filter['filter_b'] diletakan di controller (request 1=driver 2=courier)
				if($filter['filter_c'] > 0){$this->db->where('a.expense_purpose',$filter['filter_c']);} 
				if($filter['filter_d'] > 0){$this->db->where('c.id_department',$filter['filter_d']);} 
				if($filter['filter_e'] > 0){$this->db->where('a.created_by',$filter['filter_e']);} 
				if($filter['filter_f'] > 0){$this->db->where('a.driver',$filter['filter_f']);}
				//$filter['filter_g'] adalah courier
				if($filter['filter_date_aa'] != '' && $filter['filter_date_ab'] != ''){
					$this->db->where("a.start_date between '".$filter['filter_date_aa']."' and '".$filter['filter_date_ab']."' ");
				}	
			*/
		}else{
			$this->db->join('transport_request.request_mark k', 'a.id_request = k.id_request and k.request = 1','LEFT');
		}					
			
		
		//-----------------------------or_where
		
		if($filter['filter_h'] > 0){$this->db->or_where('a.external',$filter['filter_h']);} 
		
		
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
		
		$this->db->join('transport_request.request_expense l', 'a.id_request = l.id_request and l.request = 1 and l.expense_type <> 67 ');
		
		$this->db->where('a.status',3);	
		if($filter['filter_a'] > 0){$this->db->where('a.company ',$filter['filter_a']);}
		//$filter['filter_b'] diletakan di controller (request 1=driver 2=courier)
		if($filter['filter_c'] > 0){$this->db->where('a.expense_purpose',$filter['filter_c']);} 
		if($filter['filter_d'] > 0){$this->db->where('c.id_department',$filter['filter_d']);} 
		if($filter['filter_e'] > 0){$this->db->where('a.created_by',$filter['filter_e']);} 
		if($filter['filter_f'] > 0){$this->db->where('a.driver',$filter['filter_f']);}
		//$filter['filter_g'] adalah courier
		if($filter['filter_date_aa'] != '' && $filter['filter_date_ab'] != ''){
			$this->db->where("a.start_date between '".$filter['filter_date_aa']."' and '".$filter['filter_date_ab']."' ");
		}
		
		if($filter['filter_i'] == 2){
			$this->db->join('transport_request.request_mark k', 'a.id_request = k.id_request and k.request = 1','INNER');
			$this->db->where('k.id_proccess <> ',null);	
		}elseif($filter['filter_i'] == 1){
			$this->db->join('transport_request.request_mark k', 'a.id_request = k.id_request and k.request = 1','INNER');
			$this->db->where('k.id_proccess',null);	
			$this->db->or_where('a.id_request not in(select m.id_request from transport_request.request_mark m where m.request = 1)');	
			/*
				$this->db->where('a.status',3);	
				if($filter['filter_a'] > 0){$this->db->where('a.company ',$filter['filter_a']);}
				//$filter['filter_b'] diletakan di controller (request 1=driver 2=courier)
				if($filter['filter_c'] > 0){$this->db->where('a.expense_purpose',$filter['filter_c']);} 
				if($filter['filter_d'] > 0){$this->db->where('c.id_department',$filter['filter_d']);} 
				if($filter['filter_e'] > 0){$this->db->where('a.created_by',$filter['filter_e']);} 
				if($filter['filter_f'] > 0){$this->db->where('a.driver',$filter['filter_f']);}
				//$filter['filter_g'] adalah courier
				if($filter['filter_date_aa'] != '' && $filter['filter_date_ab'] != ''){
					$this->db->where("a.start_date between '".$filter['filter_date_aa']."' and '".$filter['filter_date_ab']."' ");
				}	
			*/	
		}else{
			$this->db->join('transport_request.request_mark k', 'a.id_request = k.id_request and k.request = 1','LEFT');
		}					
						
		//-----------------------------or_where
		
		if($filter['filter_h'] > 0){$this->db->or_where('a.external',$filter['filter_h']);} 
		
		return $this->db->get();
		
	}	
	
	
	
	
	
	
	public function M_Report_Petty_CashNumRow_Courier($filter)
	{
		
		$this->db->distinct('a.id_request');		
		$this->db->select('a.id_request');		
		$this->db->from('transport_request.request_courier a');
		
		$this->db->join('login.login_user b', 'a.created_by = b.id_login','LEFT');
		$this->db->join('public.public_view_employee c', 'b.id_employee = c.id_employee','LEFT');
		
		$this->db->join('transport_request.parameter_courier d', 'a.courier = d.courier','LEFT');
		$this->db->join('public.public_view_employee e', 'd.courier = e.id_employee','LEFT');
		
		$this->db->join('transport_request.parameter g', 'a.external = g.id_parameter','LEFT');
		$this->db->join('transport_request.parameter h', 'a.request_option = h.id_parameter','LEFT');
		$this->db->join('transport_request.parameter j', 'a.expense_purpose = j.id_parameter','LEFT');
		
		$this->db->join('transport_request.request_expense l', 'a.id_request = l.id_request and l.request = 2 and l.expense_type <> 67 ');
		
		$this->db->where('a.status',3);	
		if($filter['filter_a'] > 0){$this->db->where('a.company ',$filter['filter_a']);}
		//$filter['filter_b'] diletakan di controller (request 1=driver 2=courier)
		if($filter['filter_c'] > 0){$this->db->where('a.expense_purpose',$filter['filter_c']);} 
		if($filter['filter_d'] > 0){$this->db->where('c.id_department',$filter['filter_d']);} 
		if($filter['filter_e'] > 0){$this->db->where('a.created_by',$filter['filter_e']);} 
		//$filter['filter_f'] adalah driver
		if($filter['filter_g'] > 0){$this->db->where('a.courier',$filter['filter_g']);}	
		if($filter['filter_date_aa'] != '' && $filter['filter_date_ab'] != ''){
			$this->db->where("a.start_date between '".$filter['filter_date_aa']."' and '".$filter['filter_date_ab']."' ");
		}	

		
		if($filter['filter_i'] == 2){
			$this->db->join('transport_request.request_mark k', 'a.id_request = k.id_request and k.request = 2','INNER');
			$this->db->where('k.id_proccess <> ',null);	
		}elseif($filter['filter_i'] == 1){
			$this->db->join('transport_request.request_mark k', 'a.id_request = k.id_request and k.request = 2','INNER');
			$this->db->where('k.id_proccess',null);	
			$this->db->or_where('a.id_request not in(select m.id_request from transport_request.request_mark m where m.request = 2)');	
			/*
				$this->db->where('a.status',3);	
				if($filter['filter_a'] > 0){$this->db->where('a.company ',$filter['filter_a']);}
				//$filter['filter_b'] diletakan di controller (request 1=driver 2=courier)
				if($filter['filter_c'] > 0){$this->db->where('a.expense_purpose',$filter['filter_c']);} 
				if($filter['filter_d'] > 0){$this->db->where('c.id_department',$filter['filter_d']);} 
				if($filter['filter_e'] > 0){$this->db->where('a.created_by',$filter['filter_e']);} 
				//$filter['filter_f'] adalah driver
				if($filter['filter_g'] > 0){$this->db->where('a.courier',$filter['filter_g']);}	
				if($filter['filter_date_aa'] != '' && $filter['filter_date_ab'] != ''){
					$this->db->where("a.start_date between '".$filter['filter_date_aa']."' and '".$filter['filter_date_ab']."' ");
				}	
			*/
		}else{
			$this->db->join('transport_request.request_mark k', 'a.id_request = k.id_request and k.request = 2','LEFT');
		}						
	
		
		//-----------------------------or_where
		
		if($filter['filter_h'] > 0){$this->db->or_where('a.external',$filter['filter_h']);} 
				
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
		
		$this->db->join('transport_request.request_expense l', 'a.id_request = l.id_request and l.request = 2 and l.expense_type <> 67 ');
		
		$this->db->where('a.status',3);	
		if($filter['filter_a'] > 0){$this->db->where('a.company ',$filter['filter_a']);}
		//$filter['filter_b'] diletakan di controller (request 1=driver 2=courier)
		if($filter['filter_c'] > 0){$this->db->where('a.expense_purpose',$filter['filter_c']);} 
		if($filter['filter_d'] > 0){$this->db->where('c.id_department',$filter['filter_d']);} 
		if($filter['filter_e'] > 0){$this->db->where('a.created_by',$filter['filter_e']);} 
		//$filter['filter_f'] adalah driver
		if($filter['filter_g'] > 0){$this->db->where('a.courier',$filter['filter_g']);}			
		if($filter['filter_date_aa'] != '' && $filter['filter_date_ab'] != ''){
			$this->db->where("a.start_date between '".$filter['filter_date_aa']."' and '".$filter['filter_date_ab']."' ");
		}
		
		if($filter['filter_i'] == 2){
			$this->db->join('transport_request.request_mark k', 'a.id_request = k.id_request and k.request = 2','INNER');
			$this->db->where('k.id_proccess <> ',null);	
		}elseif($filter['filter_i'] == 1){			
			$this->db->join('transport_request.request_mark k', 'a.id_request = k.id_request and k.request = 2','INNER');
			$this->db->where('k.id_proccess',null);	
			$this->db->or_where('a.id_request not in(select m.id_request from transport_request.request_mark m where m.request = 2)');	
			/*
				$this->db->where('a.status',3);	
				if($filter['filter_a'] > 0){$this->db->where('a.company ',$filter['filter_a']);}
				//$filter['filter_b'] diletakan di controller (request 1=driver 2=courier)
				if($filter['filter_c'] > 0){$this->db->where('a.expense_purpose',$filter['filter_c']);} 
				if($filter['filter_d'] > 0){$this->db->where('c.id_department',$filter['filter_d']);} 
				if($filter['filter_e'] > 0){$this->db->where('a.created_by',$filter['filter_e']);} 
				//$filter['filter_f'] adalah driver
				if($filter['filter_g'] > 0){$this->db->where('a.courier',$filter['filter_g']);}	
				if($filter['filter_date_aa'] != '' && $filter['filter_date_ab'] != ''){
					$this->db->where("a.start_date between '".$filter['filter_date_aa']."' and '".$filter['filter_date_ab']."' ");
				}	
			*/
		}else{
			$this->db->join('transport_request.request_mark k', 'a.id_request = k.id_request and k.request = 2','LEFT');
		}
				
		
		//-----------------------------or_where
		
		if($filter['filter_h'] > 0){$this->db->or_where('a.external',$filter['filter_h']);} 
		
		return $this->db->get();
		
	}		
	
	
	
	
	
	
	
}
?>