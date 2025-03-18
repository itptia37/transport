<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_Parameter extends CI_Model {


	public function M_ParameterNumRow($filter,$category)
	{
		
		$this->db->distinct('id_parameter');
		
		$this->db->select('id_parameter');
		
		$this->db->where('id_parameter_category',$category);
		
		if($filter['src'] != ''){$this->db->like('name',strtoupper($filter['src']));}			
			
		return $this->db->get('transport_request.parameter');
		
	}
	
	public function M_ParameterData($filter,$category)
	{
		
		$this->db->distinct('a.id_parameter');
		
		$this->db->where('id_parameter_category',$category);
		
		if($filter['src'] != ''){$this->db->like('name',strtoupper($filter['src']));}	

		if($filter['fild_a'] == 1){$this->db->order_by('name', $filter['order_a']);}
		if($filter['fild_b'] == 1){$this->db->order_by('status', $filter['order_b']);}
		else{$this->db->order_by('id_parameter', 'DESC');}	
		
		$this->db->limit($filter['myrow'],$filter['start']);
		
		return $this->db->get('transport_request.parameter');
		
	}

	public function M_Parameter_Detail($target,$category)
	{
		
		$this->db->distinct('a.id_parameter');
		
		$this->db->select('a.*,c.name as creater,e.name as updater');
		
		$this->db->from('transport_request.parameter a');
		$this->db->where('a.id_parameter',$target);
		$this->db->where('a.id_parameter_category',$category);
	
		$this->db->join('login.login_user b', 'a.created_by = b.id_login','LEFT');
		$this->db->join('public.public_view_employee c', 'b.id_employee = c.id_employee','LEFT');
		
		$this->db->join('login.login_user d', 'a.updated_by = d.id_login','LEFT');
		$this->db->join('public.public_view_employee e', 'd.id_employee = e.id_employee','LEFT');
		
		return $this->db->get();
		
	}
	
	
	
/* end */
}
?>