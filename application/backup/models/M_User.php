<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_User extends CI_Model {


	public function M_UserNumRow($filter)
	{
		
		$this->db->distinct('a.id_user');
		
		$this->db->select('a.id_user');
		
		$this->db->from('transport_request.user a');
		
		if($filter['src'] != ''){
			$this->db->like('b.email',strtolower($filter['src']));
			$this->db->or_like('c.name',strtoupper($filter['src']));
		}			
		
		$this->db->where('d.id_aplikasi',$this->session->userdata('set_application'));
		
		$this->db->join('login.login_user b', 'a.id_login = b.id_login','LEFT');
		$this->db->join('public.view_employee c', 'b.id_employee = c.id_employee','LEFT');
		$this->db->join('login.user_aplikasi d', 'a.id_login = d.id_login','LEFT');
		$this->db->join('transport_request.parameter e', 'a.access = e.id_parameter','LEFT');
		
		return $this->db->get();
		
	}
	
	public function M_UserData($filter)
	{
		
		$this->db->distinct('a.id_user');
		
		$this->db->select('a.*,c.name as username,b.email,e.name as useraccess,a.status');
		
		$this->db->from('transport_request.user a');
		
		if($filter['src'] != ''){
			$this->db->like('b.email',strtolower($filter['src']));
			$this->db->or_like('c.name',strtoupper($filter['src']));
		}				
		
		$this->db->where('d.id_aplikasi',$this->session->userdata('set_application'));
		
		$this->db->join('login.login_user b', 'a.id_login = b.id_login','LEFT');
		$this->db->join('public.view_employee c', 'b.id_employee = c.id_employee','LEFT');
		$this->db->join('login.user_aplikasi d', 'a.id_login = d.id_login','LEFT');
		$this->db->join('transport_request.parameter e', 'a.access = e.id_parameter','LEFT');
		
		if($filter['fild_a'] == 1){$this->db->order_by('c.name', $filter['order_a']);}
		if($filter['fild_b'] == 1){$this->db->order_by('b.email', $filter['order_b']);}
		if($filter['fild_c'] == 1){$this->db->order_by('a.access', $filter['order_c']);}
		if($filter['fild_d'] == 1){$this->db->order_by('a.status', $filter['order_d']);}
		else{$this->db->order_by('a.id_user', 'DESC');}	
		
		$this->db->limit($filter['myrow'],$filter['start']);
		
		return $this->db->get();
		
	}

	public function M_User_Detail($target)
	{
		
		$this->db->distinct('a.id_user');
		
		$this->db->select('a.*,b.email,e.name as useraccess,d.created_date,d.updated_date,
		g.name as creater,i.name as updater');
		
		$this->db->from('transport_request.user a');
		$this->db->where('a.id_user',$target);		
		$this->db->where('d.id_aplikasi',$this->session->userdata('set_application'));
		
		$this->db->join('login.login_user b', 'a.id_login = b.id_login','LEFT');
		$this->db->join('public.view_employee c', 'b.id_employee = c.id_employee','LEFT');
		$this->db->join('login.user_aplikasi d','a.id_login = d.id_login','LEFT');
		
		$this->db->join('transport_request.parameter e', 'a.access = e.id_parameter','LEFT');
		
		$this->db->join('login.login_user f', 'd.id_created_by = f.id_login','LEFT');
		$this->db->join('public.view_employee g', 'f.id_employee = g.id_employee','LEFT');
		
		$this->db->join('login.login_user h', 'd.id_updated_by = h.id_login','LEFT');
		$this->db->join('public.view_employee i', 'h.id_employee = i.id_employee','LEFT');
		
		return $this->db->get();
		
	}
	
	
	public function M_Search_List_User($src)
	{
		
		$this->db->distinct('a.id_login');
		
		$this->db->select('a.id_login,a.email');
		
		$this->db->from('login.login_user a');
		
		$this->db->like('a.email',$src);		
		
		$this->db->where("a.id_login NOT IN 
		(select b.id_login from login.user_aplikasi b 
		where id_aplikasi = '".$this->session->userdata('set_application')."')");
		
		$this->db->where("a.id_login NOT IN (select c.id_login from transport_request.user c)");
		
		$this->db->limit(10);
		
		return $this->db->get();
		
	}
	
/* end */
}
?>