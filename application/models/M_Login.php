<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Login extends CI_Model {
	
	public function M_Login_Validate($email, $password)
	{

		// harus sama dengan secretkey active servermaster
		$hash = hash_hmac(
			'sha256',
			$password,
			'22ERTV-6r-ux+q-N+5j-L5nogGv.&9$3*av}=YR~o|]duBW{}' 
		);

		$this->db->select('a.id_login,a.access,b.email,c.name as username ');
		
		$this->db->from('transport_request.user a');
		
		$this->db->where('a.status',1);
		$this->db->where('b.email',$email);
		$this->db->where('b.password', $hash);
		$this->db->where('d.id_aplikasi',$this->session->userdata('set_application'));
			
		$this->db->join('login.login_user b', 'a.id_login = b.id_login','LEFT');
		$this->db->join('public.public_view_employee c', 'b.id_employee = c.id_employee','LEFT');
		$this->db->join('login.user_aplikasi d', 'a.id_login = d.id_login','LEFT');
		
		return $this->db->get();
	}

	
/* end*/
}
