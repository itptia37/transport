<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_Expense_Driver extends CI_Model {

	public function M_Expense_Driver_NumRow($filter)
	{
		
		$this->db->distinct('a.id_request');		
		$this->db->select('a.id_request');		
		$this->db->from('transport_request.request_driver a');	
		
		$this->db->join('login.login_user b', 
			'a.created_by = b.id_login','LEFT');
		$this->db->join('public.public_view_employee c', 
			'b.id_employee = c.id_employee','LEFT');
		
		$this->db->join('transport_request.parameter_driver d', 
			'a.driver = d.id_driver','LEFT');
		$this->db->join('public.public_view_employee e', 
			'd.driver = e.id_employee','LEFT');
		
		$this->db->join('transport_request.parameter g', 
			'a.external = g.id_parameter','LEFT');
		$this->db->join('transport_request.parameter h', 
			'a.request_option = h.id_parameter','LEFT');
		$this->db->join('transport_request.parameter i', 
			'a.car = i.id_parameter','LEFT');
		
		//inner
		$this->db->join('transport_request.request_expense j', 
			'a.id_request = j.id_request and j.request = 1 
				and j.expense_type <> 67 ');
		
		$this->db->join('transport_request.request_mark k', 
			'a.id_request=k.id_request and k.request = 1 ','LEFT');
		
		$this->db->where('k.id_proccess',null); 
		
		if($filter['src'] != ''){ 
			$this->db->like('a.no_request',$filter['src']); 
		}
		
		if($filter['filter_a'] != ''){$this->db->where('a.driver',$filter['filter_a']);}
		
		return $this->db->get();
		
	}
	
	public function M_Expense_Driver_Data($filter)
	{
		
		$this->db->distinct('a.id_request');
		
		$this->db->select('a.*,
		b.email as requestor_email,
		c.name as requestor,c.department,
		e.name as driver_name,
		g.name as external_name,
		h.name as request_option_name,
		i.name as car_name,
		k.id_proccess');
		
		$this->db->from('transport_request.request_driver a');
		
		$this->db->join('login.login_user b', 
			'a.created_by = b.id_login','LEFT');
		$this->db->join('public.public_view_employee c', 
			'b.id_employee = c.id_employee','LEFT');
		
		$this->db->join('transport_request.parameter_driver d', 
			'a.driver = d.driver','LEFT');
		$this->db->join('public.public_view_employee e', 
			'd.driver = e.id_employee','LEFT');
		
		$this->db->join('transport_request.parameter g', 
			'a.external = g.id_parameter','LEFT');
		$this->db->join('transport_request.parameter h', 
			'a.request_option = h.id_parameter','LEFT');
		$this->db->join('transport_request.parameter i', 
			'a.car = i.id_parameter','LEFT');
		
		//inner
		$this->db->join('transport_request.request_expense j', 
			'a.id_request = j.id_request and j.request = 1 
				and j.expense_type <> 67 ');
		
		$this->db->join('transport_request.request_mark k', 
			'a.id_request=k.id_request and k.request = 1 ','LEFT');
		
		$this->db->where('k.id_proccess',null); 
		
		if($filter['src'] != ''){ 
			$this->db->like('a.no_request',$filter['src']); 
		}
		
		if($filter['fild_a'] == 1){	$this->db->order_by('a.no_request', $filter['order_a']); }
		if($filter['fild_b'] == 1){	$this->db->order_by('e.name', $filter['order_b']); }
		
		else{$this->db->order_by('k.id_proccess','DESC');}

		$this->db->limit($filter['myrow'],$filter['start']);
		
		if($filter['filter_a'] != ''){$this->db->where('a.driver',$filter['filter_a']);}
		
		return $this->db->get();
		
	}
	
	public function M_Request_Driver_Detail($id_expense)
	{		
		$this->db->distinct('id_request');
		$this->db->select('id_request,no_request');		
		$this->db->where('id_request',($id_expense));		
		return $this->db->get('transport_request.request_driver');
		
	}
	
	public function M_Search_List_Request_Option($src)
	{
		
		$this->db->select('id_parameter,name');		
		$this->db->like('name',strtoupper($src));		
		$this->db->where('id_parameter_category',$this->session->userdata('set_request_option_courier'));
		$this->db->where('status',1); 
		$this->db->order_by('seq');		
		$this->db->limit(10);		
		return $this->db->get('transport_request.parameter');
		
	}
	
	public function M_Search_List_Request($src)
	{		
		$this->db->distinct('a.id_request');
		$this->db->select('a.id_request,a.no_request');	
		$this->db->from('transport_request.request_driver a');
		$this->db->like('a.no_request',($src));		
		$this->db->where('a.status >= 2 and a.status <=3'); 
		
		$this->db->join('transport_request.request_mark k', 
			'a.id_request=k.id_request and k.request = 1','LEFT'); 
		
		/*
		$this->db->where("(
			k.id_proccess is null
			or a.id_request NOT IN (
				SELECT id_request
				FROM transport_request.request_mark 
				WHERE request=1
			)
		)"); */
		
		$this->db->where('k.id_proccess',null); 
		
		$this->db->limit(10);		
		return $this->db->get();
		
	}
	
	public function M_Filter_Search_List_Driver($src){
		
		$this->db->distinct('a.driver');
		$this->db->select('a.driver,b.name');
		$this->db->from('transport_request.request_driver a');
		$this->db->join('public.public_view_employee b', 'a.driver = b.id_employee','LEFT');
		$this->db->like('b.name',strtoupper($src));	
		$this->db->limit(10);
		return $this->db->get();
		
	}

	
/* end */
}
?>