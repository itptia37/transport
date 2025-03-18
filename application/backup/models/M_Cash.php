<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_Cash extends CI_Model {


	public function M_CashNumRow($filter)
	{
		
		$this->db->distinct('a.id_cash');		
		$this->db->select('a.id_cash');		
		$this->db->from('transport_request.cash_receipt a');		
			if($filter['src'] != ''){
				$this->db->like('a.no_cash',strtoupper($filter['src']));
				$this->db->like('b.name',strtoupper($filter['src']));
			}			
		$this->db->join('public.view_employee b', 'a.receiver = b.id_employee','LEFT');
		$this->db->join('transport_request.parameter_driver c', 'a.receiver = c.driver','LEFT');
		$this->db->join('transport_request.parameter_courier d', 'a.receiver = d.courier','LEFT');
		$this->db->join('transport_request.settelment e', 'a.id_cash = e.id_cash','LEFT');
		
		if($filter['filter_a'] != ''){$this->db->where('a.receiver',$filter['filter_a']);}		
		if($filter['filter_date_aa'] != '' && $filter['filter_date_ab'] != ''){
			$date_aa = $filter['filter_date_aa'];
			$date_ab = $filter['filter_date_ab'];
			$this->db->where("a.start_date between '$date_aa' and '$date_ab' ");
		}
		if($filter['filter_st'] != ''){$this->db->where('a.status',($filter['filter_st']-2));}
		
		return $this->db->get();
		
	}
	
	public function M_CashData($filter)
	{
		
		$this->db->distinct('a.id_cash');		
		$this->db->select('a.*,
		b.name as receiver_name,
		c.driver as par_driver,
		d.courier as par_courier,
		e.approved_by');		
		$this->db->from('transport_request.cash_receipt a');		
			if($filter['src'] != ''){
				$this->db->like('a.no_cash',strtoupper($filter['src']));
				$this->db->like('b.name',strtoupper($filter['src']));
			}
		
		$this->db->join('public.view_employee b', 'a.receiver = b.id_employee','LEFT');
		$this->db->join('transport_request.parameter_driver c', 'a.receiver = c.driver','LEFT');
		$this->db->join('transport_request.parameter_courier d', 'a.receiver = d.courier','LEFT');
		$this->db->join('transport_request.settelment e', 'a.id_cash = e.id_cash','LEFT');
		
		if($filter['filter_a'] != ''){$this->db->where('a.receiver',$filter['filter_a']);}		
		if($filter['filter_date_aa'] != '' && $filter['filter_date_ab'] != ''){
			$date_aa = $filter['filter_date_aa'];
			$date_ab = $filter['filter_date_ab'];
			$this->db->where("a.start_date between '$date_aa' and '$date_ab' ");
		}
		if($filter['filter_st'] != ''){$this->db->where('a.status',($filter['filter_st']-2));}
		
		if($filter['fild_a'] == 1){$this->db->order_by('a.no_cash', $filter['order_a']);}
		if($filter['fild_b'] == 1){$this->db->order_by('b.name', $filter['order_b']);}
		if($filter['fild_c'] == 1){$this->db->order_by('a.amount', $filter['order_c']);}
		if($filter['fild_d'] == 1){$this->db->order_by('a.start_date', $filter['order_d']);}
		if($filter['fild_e'] == 1){$this->db->order_by('a.status', $filter['order_e']);}
		else{$this->db->order_by('a.status', 'ASC');}	
		
		$this->db->limit($filter['myrow'],$filter['start']);
		
		return $this->db->get();
		
	}

	public function M_Cash_Detail($target)
	{
		
		$this->db->distinct('a.id_cash');
		
		$this->db->select('a.*,
		b.name as receiver_name,
		c.email as creater_email,
		d.name as creater,
		e.email as updater_email,
		f.name as updater,
		g.driver as par_driver,
		h.courier as par_courier');
		
		$this->db->from('transport_request.cash_receipt a');
		
		$this->db->where('a.id_cash',$target);		
		
		$this->db->join('public.view_employee b', 'a.receiver = b.id_employee','LEFT');
		
		$this->db->join('login.login_user c', 'a.created_by = c.id_login','LEFT');
		$this->db->join('public.view_employee d', 'c.id_employee = d.id_employee','LEFT');
		
		$this->db->join('login.login_user e', 'a.updated_by = e.id_login','LEFT');
		$this->db->join('public.view_employee f', 'e.id_employee = f.id_employee','LEFT');
		
		$this->db->join('transport_request.parameter_driver g', 'a.receiver = g.driver','LEFT');
		$this->db->join('transport_request.parameter_courier h', 'a.receiver = h.courier','LEFT');
		
		return $this->db->get();
		
	}
	
	public function M_Sum_Expense($receiver,$target_request,$start_date,$end_date)
	{
		$this->db->select_sum('balance');
		$this->db->from('transport_request.request_expense a');
		$this->db->where('a.status',1);
		$this->db->where('a.request',(int)$target_request);
		
		if($target_request == 1){			
			$this->db->where('b.status <', 4);
			$this->db->where('b.driver',$receiver);
			$this->db->where("b.start_date between '".$start_date."' and '".$end_date."' ");
			$this->db->join('transport_request.request_driver b','a.id_request = b.id_request','LEFT');
		}
		elseif($target_request == 2){			
			$this->db->where('b.status <', 4);
			$this->db->where('b.courier',$receiver);
			$this->db->where("b.start_date between '".$start_date."' and '".$end_date."' ");
			$this->db->join('transport_request.request_courier b','a.id_request = b.id_request','LEFT');
		}
		return $this->db->get();
	}
	
	public function M_Search_List_Driver($src)
	{
		
		$this->db->distinct('a.id_employee');		
		$this->db->select('a.id_employee,a.name');		
		$this->db->from('public.view_employee a');	
		$this->db->join('transport_request.parameter_driver b', 'a.id_employee = b.driver','LEFT');		
		$this->db->like('a.name', strtoupper($src));	
		$this->db->where('b.status',1);
		$this->db->limit(10);		
		return $this->db->get();
		
	}
	
	public function M_Search_List_Courier($src)
	{
		
		$this->db->distinct('a.id_employee');		
		$this->db->select('a.id_employee,a.name');		
		$this->db->from('public.view_employee a');	
		$this->db->join('transport_request.parameter_courier b', 'a.id_employee = b.courier','LEFT');		
		$this->db->like('a.name', strtoupper($src));	
		$this->db->where('b.status',1);
		$this->db->limit(10);		
		return $this->db->get();
		
	}
	
	public function M_Filter_Search_List_Driver($src)
	{
		
		$this->db->distinct('a.id_employee');		
		$this->db->select('a.id_employee,a.name');		
		$this->db->from('public.view_employee a');	
		$this->db->join('transport_request.parameter_driver b', 'a.id_employee = b.driver','LEFT');	
		$this->db->join('transport_request.cash_receipt c', 'b.driver = c.receiver','INNER');	
		$this->db->like('a.name', strtoupper($src));	
		$this->db->limit(10);		
		return $this->db->get();
		
	}
	
	public function M_Filter_Search_List_Courier($src)
	{
		
		$this->db->distinct('a.id_employee');		
		$this->db->select('a.id_employee,a.name');		
		$this->db->from('public.view_employee a');	
		$this->db->join('transport_request.parameter_courier b', 'a.id_employee = b.courier','LEFT');	
		$this->db->join('transport_request.cash_receipt c', 'b.courier = c.receiver','INNER');	
		$this->db->like('a.name', strtoupper($src));	
		$this->db->limit(10);		
		return $this->db->get();
		
	}
	
	public function M_Check_Last_Date($receiver)
	{
		$this->db->distinct('id_cash');
		$this->db->select('end_date');
		$this->db->where('receiver',$receiver);
		$this->db->where('status <',3);
		$this->db->order_by('end_date','DESC');
		$this->db->limit(1);
		return $this->db->get('transport_request.cash_receipt');
	}

/* end */
}
?>