<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Report_Request_Chart extends CI_Model {


	public function M_Select_Req_Driver_Num($m,$y)
	{
		$this->db->select('id_request');
		$this->db->where('extract(month FROM start_date) =',$m); 
		$this->db->where('extract(year FROM start_date) =',$y); 
		//$this->db->where('request_option',1); 
		return $this->db->get('transport_request.request_driver');
	}	

	/*
	public function M_Select_Req_Driver_D_Num($m,$y)
	{
		$this->db->select('id_request');
		$this->db->where('extract(month FROM start_date) =',$m); 
		$this->db->where('extract(year FROM start_date) =',$y); 
		$this->db->where('request_option',2); 
		return $this->db->get('transport_request.request_driver');
	}	
	
	public function M_Select_Req_Driver_C_Num($m,$y)
	{
		$this->db->select('id_request');
		$this->db->where('extract(month FROM start_date) =',$m); 
		$this->db->where('extract(year FROM start_date) =',$y); 
		$this->db->where('request_option',3); 
		return $this->db->get('transport_request.request_driver');
	}*/
	
	public function M_Select_Req_Courier_Num($m,$y)
	{
		$this->db->select('id_request');
		$this->db->where('extract(month FROM start_date) =',$m); 
		$this->db->where('extract(year FROM start_date) =',$y); 
		return $this->db->get('transport_request.request_courier');
	}	
	
/* end  */
}
