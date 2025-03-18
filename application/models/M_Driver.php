<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_Driver extends CI_Model {


	public function M_DriverNumRow($filter)
	{
		
		$this->db->distinct('a.id_driver');
		
		$this->db->select('a.id_driver');
		
		$this->db->from('transport_request.parameter_driver a');
		
		if($filter['src'] != ''){$this->db->like('b.name',strtoupper($filter['src']));}			
	
		$this->db->join('public.public_view_employee b', 'a.driver = b.id_employee','LEFT');
		$this->db->join('transport_request.parameter c', 'a.car = c.id_parameter','LEFT');
		
		return $this->db->get();
		
	}
	
	public function M_DriverData($filter)
	{
		
		$this->db->distinct('a.id_driver');
		
		$this->db->select('a.*,b.name as driver_name,c.name as car_name');
		
		$this->db->from('transport_request.parameter_driver a');
		
		if($filter['src'] != ''){$this->db->like('b.name',strtoupper($filter['src']));}		
		
		$this->db->join('public.public_view_employee b', 'a.driver = b.id_employee','LEFT');
		$this->db->join('transport_request.parameter c', 'a.car = c.id_parameter','LEFT');
		
		if($filter['fild_a'] == 1){$this->db->order_by('b.name', $filter['order_a']);}
		if($filter['fild_b'] == 1){$this->db->order_by('c.name', $filter['order_b']);}
		if($filter['fild_c'] == 1){$this->db->order_by('a.status', $filter['order_c']);}
		else{$this->db->order_by('a.id_driver', 'DESC');}	
		
		$this->db->limit($filter['myrow'],$filter['start']);
		
		return $this->db->get();
		
	}

	public function M_Driver_Detail($target)
	{
		
		$this->db->distinct('a.id_driver');
		
		$this->db->select('a.*,b.name as driver_name,c.name as car_name,
		e.name as creater,g.name as updater');
		
		$this->db->from('transport_request.parameter_driver a');
		
		$this->db->where('a.id_driver',$target);		
		
		$this->db->join('public.public_view_employee b', 'a.driver = b.id_employee','LEFT');
		$this->db->join('transport_request.parameter c', 'a.car = c.id_parameter','LEFT');
		
		$this->db->join('login.login_user d', 'a.created_by = d.id_login','LEFT');
		$this->db->join('public.public_view_employee e', 'd.id_employee = e.id_employee','LEFT');
		
		$this->db->join('login.login_user f', 'a.updated_by = f.id_login','LEFT');
		$this->db->join('public.public_view_employee g', 'f.id_employee = g.id_employee','LEFT');
		
		return $this->db->get();
		
	}
	
	
	public function M_Search_List_Driver($src)
	{
		
		$this->db->distinct('a.id_employee');
		
		$this->db->select('a.id_employee,a.name');
		
		$this->db->from('public.public_view_employee a');
		
		$this->db->like('a.name', strtoupper($src));		
		
		$this->db->where('a.id_employee NOT IN (select b.driver from transport_request.parameter_driver b)');	
		
		$this->db->where('a.id_employee NOT IN (select c.courier from transport_request.parameter_courier c)');			
		
		$this->db->limit(10);
		
		return $this->db->get();
		
	}
	
	public function M_Search_List_Car($src)
	{
		
		$this->db->distinct('a.id_car');
		
		$this->db->select('a.id_parameter,a.name');
		
		$this->db->from('transport_request.parameter a');
		
		$this->db->where('a.status',1);
		
		$this->db->where('id_parameter_category',$this->session->userdata('set_car'));
		
		$this->db->like('a.name', strtoupper($src));		
		
		$this->db->where('a.id_parameter NOT IN (select b.car from transport_request.parameter_driver b)');	
			
		$this->db->limit(10);
		
		return $this->db->get();
		
	}
	
/* end */
}
?>