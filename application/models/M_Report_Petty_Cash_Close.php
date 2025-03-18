<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Report_Petty_Cash_Close extends CI_Model {


	public function M_Report_Petty_Cash_CloseNumRow($filter)
	{
		
		$this->db->distinct('a.id_proccess');
		
		$this->db->select('a.id_proccess');
		
		$this->db->from('transport_request.request_proccess a');
		
		if($filter['filter_date_aa'] != ''){$this->db->where('a.created_date',$filter['filter_date_aa']);}			
	
		$this->db->join('login.login_user b', 'a.created_by = b.id_login','LEFT');
		$this->db->join('public.public_view_employee c', 'b.id_employee = c.id_employee','LEFT');
		
		return $this->db->get();
		
	}
	
	public function M_Report_Petty_Cash_CloseData($filter)
	{
		
		$this->db->distinct('a.id_proccess');
		
		$this->db->select('a.*,c.name');
		
		$this->db->from('transport_request.request_proccess a');
		
		if($filter['filter_date_aa'] != ''){$this->db->where('a.created_date',$filter['filter_date_aa']);}			
	
		$this->db->join('login.login_user b', 'a.created_by = b.id_login','LEFT');
		$this->db->join('public.public_view_employee c', 'b.id_employee = c.id_employee','LEFT');
		
		if($filter['fild_a'] == 1){
			$this->db->order_by('a.created_date', $filter['order_a']);
			$this->db->order_by('a.created_time', $filter['order_a']);
		}
		if($filter['fild_b'] == 1){$this->db->order_by('c.name', $filter['order_b']);}
	//	if($filter['fild_c'] == 1){$this->db->order_by('a.access', $filter['order_c']);}
	//	if($filter['fild_d'] == 1){$this->db->order_by('a.status', $filter['order_d']);}
		else{$this->db->order_by('a.id_proccess', 'DESC');}	
		
		$this->db->limit($filter['myrow'],$filter['start']);
		
		return $this->db->get();
		
	}


	
/* end */
}
?>