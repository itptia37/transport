<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Login extends CI_Model {
	
	public function M_Login_Validate($email,$password)
	{
		$this->db->select('a.id_login,a.access,b.email,c.name as username ');
		
		$this->db->from('transport_request.user a');
		
		$this->db->where('a.status',1);
		$this->db->where('b.email',$email);
		$this->db->where('b.password',md5(md5($password.'ptiajakarta')));
		$this->db->where('d.id_aplikasi',$this->session->userdata('set_application'));
			
		$this->db->join('login.login_user b', 'a.id_login = b.id_login','LEFT');
		$this->db->join('public.view_employee c', 'b.id_employee = c.id_employee','LEFT');
		$this->db->join('login.user_aplikasi d', 'a.id_login = d.id_login','LEFT');
		
		return $this->db->get();
	}

	
/* end*/
}
