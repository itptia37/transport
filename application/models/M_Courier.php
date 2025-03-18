<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_Courier extends CI_Model {


	public function M_CourierNumRow($filter)
	{
		
		$this->db->distinct('a.id_courier');
		
		$this->db->select('a.id_courier');
		
		$this->db->from('transport_request.parameter_courier a');
		
		if($filter['src'] != ''){$this->db->like('b.name',strtoupper($filter['src']));}			
	
		$this->db->join('public.public_view_employee b', 'a.courier = b.id_employee','LEFT');
		
		return $this->db->get();
		
	}
	
	public function M_CourierData($filter)
	{
		
		$this->db->distinct('a.id_courier');
		
		$this->db->select('a.*,b.name as courier_name');
		
		$this->db->from('transport_request.parameter_courier a');
		
		if($filter['src'] != ''){$this->db->like('b.name',strtoupper($filter['src']));}		
		
		$this->db->join('public.public_view_employee b', 'a.courier = b.id_employee','LEFT');
		
		if($filter['fild_a'] == 1){$this->db->order_by('b.name', $filter['order_a']);}
		if($filter['fild_b'] == 1){$this->db->order_by('a.status', $filter['order_b']);}
		else{$this->db->order_by('a.id_courier', 'DESC');}	
		
		$this->db->limit($filter['myrow'],$filter['start']);
		
		return $this->db->get();
		
	}

	public function M_Courier_Detail($target)
	{
		
		$this->db->distinct('a.id_courier');
		
		$this->db->select('a.*,b.name as courier_name,d.name as creater,f.name as updater');
		
		$this->db->from('transport_request.parameter_courier a');
		
		$this->db->where('a.id_courier',$target);		
		
		$this->db->join('public.public_view_employee b', 'a.courier = b.id_employee','LEFT');
		
		$this->db->join('login.login_user c', 'a.created_by = c.id_login','LEFT');
		$this->db->join('public.public_view_employee d', 'c.id_employee = d.id_employee','LEFT');
		
		$this->db->join('login.login_user e', 'a.updated_by = e.id_login','LEFT');
		$this->db->join('public.public_view_employee f', 'e.id_employee = f.id_employee','LEFT');
		
		return $this->db->get();
		
	}
	
	
	public function M_Search_List_Courier($src)
	{
		
		$this->db->distinct('a.id_employee');
		
		$this->db->select('a.id_employee,a.name');
		
		$this->db->from('public.public_view_employee a');
		
		$this->db->like('a.name', strtoupper($src));		
		
		$this->db->where('a.id_employee NOT IN (select b.courier from transport_request.parameter_courier b)');	
		
		$this->db->where('a.id_employee NOT IN (select c.courier from transport_request.parameter_courier c)');			
		
		$this->db->limit(10);
		
		return $this->db->get();
		
	}
	
	
/* end */
}
?>