<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_Report_Request_Driver extends CI_Model {

	public function M_Report_Request_DriverNumRow($filter)
	{
		
		$this->db->distinct('a.id_request');
		
		$this->db->select('a.id_request');
		
		$this->db->from('transport_request.request_driver a');
		
		$this->db->join('login.login_user b', 'a.created_by = b.id_login','LEFT');
		$this->db->join('public.view_employee c', 'b.id_employee = c.id_employee','LEFT');
		
		$this->db->join('transport_request.parameter_driver d', 'a.driver = d.id_driver','LEFT');
		$this->db->join('public.view_employee e', 'd.driver = e.id_employee','LEFT');
		
		$this->db->join('transport_request.parameter g', 'a.external = g.id_parameter','LEFT');
		$this->db->join('transport_request.parameter h', 'a.request_option = h.id_parameter','LEFT');
		$this->db->join('transport_request.parameter i', 'a.car = i.id_parameter','LEFT');
		$this->db->join('transport_request.parameter j', 'a.expense_purpose = j.id_parameter','LEFT');
		
		if($filter['filter_a'] != ''){$this->db->where('a.created_by',$filter['filter_a']);}
		if($filter['filter_b'] != ''){$this->db->where('c.id_department',$filter['filter_b']);}
		if($filter['filter_c'] != ''){$this->db->where('a.request_option',$filter['filter_c']);}
		if($filter['filter_d'] != ''){$this->db->where('a.driver',$filter['filter_d']);}
		
		if($filter['filter_e'] != ''){
			if($filter['filter_e'] == 1){
				$this->db->where('a.id_request NOT IN (select l.id_request from transport_request.request_expense l where l.request = 1 ) ');
			}elseif($filter['filter_e'] == 2){
				$this->db->join('transport_request.request_expense l', 'a.id_request = l.id_request and l.request = 1');
			}
		}
		
		if($filter['filter_date_aa'] != '' && $filter['filter_date_ab'] != ''){
			$date_aa = $filter['filter_date_aa'];
			$date_ab = $filter['filter_date_ab'];
			$this->db->where("a.start_date between '$date_aa' and '$date_ab' ");
		}
		if($filter['filter_st'] != ''){$this->db->where('a.status',($filter['filter_st']-2));}
		
		$src  = '';
		if($filter['src'] != '')
			{ $src = "(a.no_request like '%".$filter['src']."%' or c.name like '%".$filter['src']."%') and "; }
		
		$this->db->where("$src a.id_request != 0 ");
		
		return $this->db->get();
		
	}
	
	public function M_Report_Request_DriverData($filter)
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
		k.name as company_name');
		
		$this->db->from('transport_request.request_driver a');
		
		$this->db->join('login.login_user b', 'a.created_by = b.id_login','LEFT');
		$this->db->join('public.view_employee c', 'b.id_employee = c.id_employee','LEFT');
		
		$this->db->join('transport_request.parameter_driver d', 'a.driver = d.driver','LEFT');
		$this->db->join('public.view_employee e', 'd.driver = e.id_employee','LEFT');
		
		$this->db->join('transport_request.parameter g', 'a.external = g.id_parameter','LEFT');
		$this->db->join('transport_request.parameter h', 'a.request_option = h.id_parameter','LEFT');
		$this->db->join('transport_request.parameter i', 'a.car = i.id_parameter','LEFT');
		$this->db->join('transport_request.parameter j', 'a.expense_purpose = j.id_parameter','LEFT');
		$this->db->join('transport_request.parameter k', 'a.company = k.id_parameter','LEFT');
		
		if($filter['filter_a'] != ''){$this->db->where('a.created_by',$filter['filter_a']);}
		if($filter['filter_b'] != ''){$this->db->where('c.id_department',$filter['filter_b']);}
		if($filter['filter_c'] != ''){$this->db->where('a.request_option',$filter['filter_c']);}
		if($filter['filter_d'] != ''){$this->db->where('a.driver',$filter['filter_d']);}
		
		if($filter['filter_e'] != ''){
			if($filter['filter_e'] == 1){
				$this->db->where('a.id_request NOT IN (select l.id_request from transport_request.request_expense l where l.request = 1 ) ');
			}elseif($filter['filter_e'] == 2){
				$this->db->join('transport_request.request_expense l', 'a.id_request = l.id_request and l.request = 1');
			}
		}
		
		if($filter['filter_date_aa'] != '' && $filter['filter_date_ab'] != ''){
			$date_aa = $filter['filter_date_aa'];
			$date_ab = $filter['filter_date_ab'];
			$this->db->where("a.start_date between '$date_aa' and '$date_ab' ");
		}
		if($filter['filter_st'] != ''){$this->db->where('a.status',($filter['filter_st']-2));}
		
		$src  = '';
		if($filter['src'] != '')
			{ $src = "(a.no_request like '%".$filter['src']."%' or c.name like '%".$filter['src']."%') and "; }
		
		$this->db->where("$src a.id_request != 0 ");	
		
		if($filter['fild_a'] == 1){
			$this->db->order_by('a.no_request', $filter['order_a']);
		}
		
		elseif($filter['fild_b'] == 1){
			$this->db->order_by('e.name', $filter['order_b']);
		}
		
		elseif($filter['fild_c'] == 1){
			$this->db->order_by('a.start_date', $filter['order_c']);
			$this->db->order_by('a.start_time', $filter['order_c']);
		}
		
		elseif($filter['fild_d'] == 1){
			$this->db->order_by('a.finish_date', $filter['order_d']);
			$this->db->order_by('a.finish_time', $filter['order_d']);
		}
		
		if($filter['fild_e'] == 1){
			$this->db->order_by('a.request_option', $filter['order_e']);
		}
		
		elseif($filter['fild_f'] == 1){
			$this->db->order_by('e.name', $filter['order_f']);
			$this->db->order_by('g.name', $filter['order_f']);
		}
		
		elseif($filter['fild_g'] == 1){
			$this->db->order_by('a.status', $filter['order_g']);
		}
		
		elseif($filter['fild_h'] == 1){
			$this->db->order_by('c.department', $filter['order_h']);
		}
		
		else{$this->db->order_by('a.status','ASC');}

		if($filter['export'] == 0){$this->db->limit($filter['myrow'],$filter['start']);}
		
		return $this->db->get();
		
	}
	
	public function M_Report_Request_Driver_Detail($target)
	{
		$this->db->select('a.*,
		b.email as requestor_email,
		c.name as requestor,
		d.name as driver_name,
		e.name as car_name,
		f.name as external_name,
		g.email as creater_email,
		h.name as creater,
		i.email as updater_email,
		j.name as updater,
		k.name as request_option_name,
		l.name as expense_purpose_name
		');
		$this->db->from('transport_request.request_driver a');
		$this->db->join('login.login_user b', 'a.created_by = b.id_login','LEFT');
		$this->db->join('public.view_employee c', 'b.id_employee = c.id_employee','LEFT');
		$this->db->join('public.view_employee d', 'a.driver = d.id_employee','LEFT');
		$this->db->join('transport_request.parameter e', 'a.car = e.id_parameter','LEFT');
		$this->db->join('transport_request.parameter f', 'a.external = f.id_parameter','LEFT');
		$this->db->join('login.login_user g', 'a.created_by = g.id_login','LEFT');
		$this->db->join('public.view_employee h', 'g.id_employee = h.id_employee','LEFT');
		$this->db->join('login.login_user i', 'a.updated_by = i.id_login','LEFT');
		$this->db->join('public.view_employee j', 'i.id_employee = j.id_employee','LEFT');
		
		$this->db->join('transport_request.parameter k', 'a.request_option = k.id_parameter','LEFT');
		$this->db->join('transport_request.parameter l', 'a.expense_purpose = l.id_parameter','LEFT');
		
		$this->db->where('a.id_request',$target);
		
		return $this->db->get();		
		
	}	

	public function M_Filter_Search_List_Requestor($src)
	{	
		$this->db->distinct('b.id_login');
		$this->db->select('b.id_login,c.name as requestor');
		$this->db->from('transport_request.request_driver a');
		$this->db->join('login.login_user b', 'a.created_by = b.id_login','LEFT');
		$this->db->join('public.view_employee c', 'b.id_employee = c.id_employee','LEFT');
		$this->db->like('c.name',strtoupper($src));	
		$this->db->limit(10);
		return $this->db->get();
		
	}
	
	public function M_Filter_Search_List_Department($src)
	{	
		$this->db->distinct('c.id_department');
		$this->db->select('c.id_department,c.department');
		$this->db->from('transport_request.request_driver a');
		$this->db->join('login.login_user b', 'a.created_by = b.id_login','LEFT');
		$this->db->join('public.view_employee c', 'b.id_employee = c.id_employee','LEFT');
		$this->db->like('c.department',strtoupper($src));	
		$this->db->limit(10);
		return $this->db->get();
		
	}
	
	public function M_Filter_Search_List_Request($src)
	{	
		$this->db->distinct('a.request_optiont');
		$this->db->select('a.request_option,b.name');
		$this->db->from('transport_request.request_driver a');
		$this->db->join('transport_request.parameter b', 'a.request_option = b.id_parameter','LEFT');
		$this->db->like('b.name',strtoupper($src));	
		$this->db->limit(10);
		return $this->db->get();
		
	}
	
	public function M_Filter_Search_List_Driver($src)
	{	
		$this->db->distinct('a.driver');
		$this->db->select('a.driver,b.name');
		$this->db->from('transport_request.request_driver a');
		$this->db->join('public.view_employee b', 'a.driver = b.id_employee','LEFT');
		$this->db->like('b.name',strtoupper($src));	
		$this->db->limit(10);
		return $this->db->get();
		
	}
	
	public function M_Filter_Search_List_Purpose($src)
	{	
		$this->db->distinct('a.expense_purpose');
		$this->db->select('a.expense_purpose,b.name');
		$this->db->from('transport_request.request_courier a');
		$this->db->join('transport_request.parameter b', 'a.expense_purpose = b.id_parameter','LEFT');
		$this->db->like('b.name',strtoupper($src));	
		$this->db->limit(10);
		return $this->db->get();
		
	}
	
/* end */
}
?>