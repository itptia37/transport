<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_Request_Courier extends CI_Model {

	public function M_Request_CourierNumRow($filter)
	{
		
		$this->db->distinct('a.id_request');
		
		$this->db->select('a.id_request');
		
		$this->db->from('transport_request.request_courier a');
		
		$this->db->join('login.login_user b', 'a.created_by = b.id_login','LEFT');
		$this->db->join('public.public_view_employee c', 'b.id_employee = c.id_employee','LEFT');
		
		$this->db->join('transport_request.parameter_courier d', 'a.courier = d.id_courier','LEFT');
		$this->db->join('public.public_view_employee e', 'd.courier = e.id_employee','LEFT');
		
		$this->db->join('transport_request.parameter g', 'a.external = g.id_parameter','LEFT');
		$this->db->join('transport_request.parameter h', 'a.request_option = h.id_parameter','LEFT');
		
		$this->db->join('transport_request.parameter i', 'a.company = i.id_parameter','LEFT');
		
		/*
		$src1  = '';
		if($filter['src'] != '')
			{ $src1 = "a.no_request like '%".$filter['src']."%' and "; }
		
		$src2  = '';
		if($filter['src'] != '')
			{ $src2 = "c.name like '%".$filter['src']."%' and "; }

		$src3  = '';
		if($filter['src'] != '')
			{ $src3 = "LOWER(a.destination) like '%".strtolower($filter['src'])."%' and "; }
		
		$src4  = '';
		if($filter['src'] != '')
			{ $src4 = "LOWER(a.description) like '%".strtolower($filter['src'])."%' and "; }
		
		$access_tr = $this->session->userdata('access_tr');
		
		if($this->session->userdata('access_tr') == 24){ //basic
			
			$this->db->where("$src1 a.created_by = '".desid_get($this->session->userdata('id_tr'))."' ");
			$this->db->or_where("$src2 a.created_by = '".desid_get($this->session->userdata('id_tr'))."' ");
			$this->db->or_where("$src3 a.created_by = '".desid_get($this->session->userdata('id_tr'))."' ");
			$this->db->or_where("$src4 a.created_by = '".desid_get($this->session->userdata('id_tr'))."' ");
			
		}elseif($access_tr == 25){ //middle
			$this->db->where("$src1 a.status >= 1 and a.status <= 2 and a.created_by != '".desid_get($this->session->userdata('id_tr'))."' ");
			$this->db->or_where("$src1 a.status >= 0 and a.status <= 2 and a.created_by = '".desid_get($this->session->userdata('id_tr'))."' ");
			$this->db->or_where("$src2 a.status >= 1 and a.status <= 2 and a.created_by != '".desid_get($this->session->userdata('id_tr'))."' ");
			$this->db->or_where("$src2 a.status >= 0 and a.status <= 2 and a.created_by = '".desid_get($this->session->userdata('id_tr'))."' ");
			
		}else{ //advanced
			$this->db->where("$src1 a.id_request != 0 ");
			$this->db->or_where("$src2 a.id_request != 0 ");
			$this->db->or_where("$src3 a.id_request != 0 ");
			$this->db->or_where("$src4 a.id_request != 0 ");
		}			
		*/
		
		$access_tr = $this->session->userdata('access_tr');
		
		if($this->session->userdata('access_tr') == 24){ //basic
			
			$this->db->where("
				(
				a.no_request like '%".$filter['src']."%' or 
				c.name like '%".$filter['src']."%' or 
				LOWER(a.destination) like '%".strtolower($filter['src'])."%' or 
				LOWER(a.description) like '%".strtolower($filter['src'])."%' or 
				to_char( a.project_number, a.project_number :: TEXT ) like '%".strtolower($filter['src'])."%' 
				) and a.created_by = '".desid_get($this->session->userdata('id_tr'))."' 
			");
			
		}elseif($access_tr == 25){ //middle
		
			$this->db->where("
				(
				a.no_request like '%".$filter['src']."%' or 
				c.name like '%".$filter['src']."%' or 
				LOWER(a.destination) like '%".strtolower($filter['src'])."%' or 
				LOWER(a.description) like '%".strtolower($filter['src'])."%' or 
				to_char( a.project_number, a.project_number :: TEXT ) like '%".strtolower($filter['src'])."%' 
				) 
				and 
				(
					a.status >= 1 and a.status <= 2 and a.created_by != '".desid_get($this->session->userdata('id_tr'))."' 
					or 
					a.status >= 0 and a.status <= 2 and a.created_by = '".desid_get($this->session->userdata('id_tr'))."' 
				)			
			");
			
		}else{ //advanced
		
			$this->db->where("
				(
				a.no_request like '%".$filter['src']."%' or 
				c.name like '%".$filter['src']."%' or 
				LOWER(a.destination) like '%".strtolower($filter['src'])."%' or 
				LOWER(a.description) like '%".strtolower($filter['src'])."%' or 
				to_char( a.project_number, a.project_number :: TEXT ) like '%".strtolower($filter['src'])."%' 
				) and a.id_request != 0 
			");
			
		}	
		
		return $this->db->get();
		
	}
	
	public function M_Request_CourierData($filter)
	{
		
		$this->db->distinct('a.id_request');
		
		$this->db->select('a.*,
		b.email as requestor_email,
		c.name as requestor,
		e.name as courier_name,
		g.name as external_name,
		h.name as request_option_name,
		i.name as delivery_name,
		j.name as expense_purpose_name,
		k.name as company_name');
		
		$this->db->from('transport_request.request_courier a');
		
		$this->db->join('login.login_user b', 'a.created_by = b.id_login','LEFT');
		$this->db->join('public.public_view_employee c', 'b.id_employee = c.id_employee','LEFT');
		
		$this->db->join('transport_request.parameter_courier d', 'a.courier = d.courier','LEFT');
		$this->db->join('public.public_view_employee e', 'd.courier = e.id_employee','LEFT');
		
		$this->db->join('transport_request.parameter g', 'a.external = g.id_parameter','LEFT');
		$this->db->join('transport_request.parameter h', 'a.request_option = h.id_parameter','LEFT');
		$this->db->join('transport_request.parameter i', 'a.company = i.id_parameter','LEFT');
		$this->db->join('transport_request.parameter j', 'a.expense_purpose = j.id_parameter','LEFT');		
		$this->db->join('transport_request.parameter k', 'a.company = k.id_parameter','LEFT');
		
		/*
		$src1  = '';
		if($filter['src'] != '')
			{ $src1 = "a.no_request like '%".$filter['src']."%' and "; }
		
		$src2  = '';
		if($filter['src'] != '')
			{ $src2 = "c.name like '%".$filter['src']."%' and "; }

		$src3  = '';
		if($filter['src'] != '')
			{ $src3 = "LOWER(a.destination) like '%".strtolower($filter['src'])."%' and "; }
		
		$src4  = '';
		if($filter['src'] != '')
			{ $src4 = "LOWER(a.description) like '%".strtolower($filter['src'])."%' and "; }
		
		$access_tr = $this->session->userdata('access_tr');
		
		if($this->session->userdata('access_tr') == 24){ //basic
			
			$this->db->where("$src1 a.created_by = '".desid_get($this->session->userdata('id_tr'))."' ");
			$this->db->or_where("$src2 a.created_by = '".desid_get($this->session->userdata('id_tr'))."' ");
			$this->db->or_where("$src3 a.created_by = '".desid_get($this->session->userdata('id_tr'))."' ");
			$this->db->or_where("$src4 a.created_by = '".desid_get($this->session->userdata('id_tr'))."' ");
			
		}elseif($access_tr == 25){ //middle
			$this->db->where("$src1 a.status >= 1 and a.status <= 2 and a.created_by != '".desid_get($this->session->userdata('id_tr'))."' ");
			$this->db->or_where("$src1 a.status >= 0 and a.status <= 2 and a.created_by = '".desid_get($this->session->userdata('id_tr'))."' ");
			$this->db->or_where("$src2 a.status >= 1 and a.status <= 2 and a.created_by != '".desid_get($this->session->userdata('id_tr'))."' ");
			$this->db->or_where("$src2 a.status >= 0 and a.status <= 2 and a.created_by = '".desid_get($this->session->userdata('id_tr'))."' ");
			
		}else{ //advanced
			$this->db->where("$src1 a.id_request != 0 ");
			$this->db->or_where("$src2 a.id_request != 0 ");
			$this->db->or_where("$src3 a.id_request != 0 ");
			$this->db->or_where("$src4 a.id_request != 0 ");
		}			
		*/
		
		$access_tr = $this->session->userdata('access_tr');
		
		if($this->session->userdata('access_tr') == 24){ //basic
			
			$this->db->where("
				(
				a.no_request like '%".$filter['src']."%' or 
				c.name like '%".$filter['src']."%' or 
				LOWER(a.destination) like '%".strtolower($filter['src'])."%' or 
				LOWER(a.description) like '%".strtolower($filter['src'])."%' or 
				to_char( a.project_number, a.project_number :: TEXT ) like '%".strtolower($filter['src'])."%' 
				) and a.created_by = '".desid_get($this->session->userdata('id_tr'))."' 
			");
			
		}elseif($access_tr == 25){ //middle
		
			$this->db->where("
				(
				a.no_request like '%".$filter['src']."%' or 
				c.name like '%".$filter['src']."%' or 
				LOWER(a.destination) like '%".strtolower($filter['src'])."%' or 
				LOWER(a.description) like '%".strtolower($filter['src'])."%' or 
				to_char( a.project_number, a.project_number :: TEXT ) like '%".strtolower($filter['src'])."%' 
				) 
				and 
				(
					a.status >= 1 and a.status <= 2 and a.created_by != '".desid_get($this->session->userdata('id_tr'))."' 
					or 
					a.status >= 0 and a.status <= 2 and a.created_by = '".desid_get($this->session->userdata('id_tr'))."' 
				)			
			");
			
		}else{ //advanced
		
			$this->db->where("
				(
				a.no_request like '%".$filter['src']."%' or 
				c.name like '%".$filter['src']."%' or 
				LOWER(a.destination) like '%".strtolower($filter['src'])."%' or 
				LOWER(a.description) like '%".strtolower($filter['src'])."%' or 
				to_char( a.project_number, a.project_number :: TEXT ) like '%".strtolower($filter['src'])."%' 
				) and a.id_request != 0 
			");
			
		}	
		
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
		
		else{$this->db->order_by('a.status','ASC');}

		$this->db->limit($filter['myrow'],$filter['start']);
		
		return $this->db->get();
		
	}
	
	public function M_Request_Courier_Detail($target)
	{
		$this->db->select('a.*,
		b.email as requestor_email,
		c.name as requestor,
		d.name as courier_name,
		e.name as delivery_name,
		f.name as external_name,
		g.email as creater_email,
		h.name as creater,
		i.email as updater_email,
		j.name as updater,
		k.name as request_option_name,
		l.name as expense_purpose_name,
		m.name as departur_name,
		n.name as return_name,
		o.name as company_name
		');
		$this->db->from('transport_request.request_courier a');
		$this->db->join('login.login_user b', 'a.created_by = b.id_login','LEFT');
		$this->db->join('public.public_view_employee c', 'b.id_employee = c.id_employee','LEFT');
		$this->db->join('public.public_view_employee d', 'a.courier = d.id_employee','LEFT');
		$this->db->join('transport_request.parameter e', 'a.delivery = e.id_parameter','LEFT');
		$this->db->join('transport_request.parameter f', 'a.external = f.id_parameter','LEFT');
		$this->db->join('login.login_user g', 'a.created_by = g.id_login','LEFT');
		$this->db->join('public.public_view_employee h', 'g.id_employee = h.id_employee','LEFT');
		$this->db->join('login.login_user i', 'a.updated_by = i.id_login','LEFT');
		$this->db->join('public.public_view_employee j', 'i.id_employee = j.id_employee','LEFT');
		
		$this->db->join('transport_request.parameter k', 'a.request_option = k.id_parameter','LEFT');
		$this->db->join('transport_request.parameter l', 'a.expense_purpose = l.id_parameter','LEFT');
		
		$this->db->join('transport_request.parameter m', 'a.departur_vehicle = m.id_parameter','LEFT');
		$this->db->join('transport_request.parameter n', 'a.departur_vehicle = n.id_parameter','LEFT');
		
		$this->db->join('transport_request.parameter o', 'a.company = o.id_parameter','LEFT');
		
		$this->db->where('a.id_request',$target);
		
		return $this->db->get();		
		
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
	
	public function M_Search_List_Expense_Purpose($src)
	{
		
		$this->db->select('id_parameter,name');		
		$this->db->like('name',strtoupper($src));		
		$this->db->where('id_parameter_category',$this->session->userdata('set_expense_purpose'));		
		$this->db->where('status',1); 
		$this->db->order_by('seq');		
		$this->db->limit(10);		
		return $this->db->get('transport_request.parameter');
		
	}
	
	public function M_Search_List_Courier($src)
	{
		
		$this->db->distinct('a.courier');
		$this->db->select('a.courier,b.name as courier_name');
		$this->db->from('transport_request.parameter_courier a');
		$this->db->where('a.status',1);
		$this->db->join('public.public_view_employee b', 'a.courier = b.id_employee','LEFT');
		$this->db->like('b.name', strtoupper($src));
		$this->db->limit(10);
		return $this->db->get();
		
	}
	

	
/* end */
}
?>