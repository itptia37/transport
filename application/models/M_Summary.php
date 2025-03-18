<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
/* belum digunakan*/
class M_summary extends CI_Model {


	public function M_Select_Summary_Name_Courier($filter)
	{
		$this->db->distinct('a.created_by');
		$this->db->select('a.created_by,c.name as requestor');
		
		$this->db->from('transport_request.request_courier a');
		$this->db->join('login.login_user b', 'a.created_by=b.id_login','LEFT');
		$this->db->join('public.public_view_employee c', 'b.id_employee=c.id_employee','LEFT');
		
		if($filter['filter_a']!=''){ $this->db->where('a.created_by',$filter['filter_a']); }	
		if($filter['filter_b']!=''){ $this->db->where('a.courier',$filter['filter_b']); }	
		if($filter['filter_c']!=''){ $this->db->where('a.status',$filter['filter_c']); }
		if($filter['filter_d']!=''){ $this->db->where('a.id_delivery_status',$filter['filter_d']); }
		if($filter['filter_e']!=''){ $this->db->where('c.id_department',$filter['filter_e']); }
		
		if($filter['filter_date_aa']!='' && $filter['filter_date_ab']!=''){
			$date_a = $filter['filter_date_aa']; $date_b = $filter['filter_date_ab'];
			$this->db->where(" a.start_date between '$date_a' and '$date_b' ");
		}
		
		if($filter['filter_date_ba']!='' && $filter['filter_date_bb']!=''){
			$date_a = $filter['filter_date_ba']; $date_b = $filter['filter_date_bb'];
			$this->db->where(" a.finish_date between '$date_a' and '$date_b' ");
		}	
		
		if($filter['src']!=''){
			
			$this->db->like('a.no_request',$filter['src']);
			
			if($filter['filter_a']!=''){ $this->db->where('a.created_by',$filter['filter_a']); }	
			if($filter['filter_b']!=''){ $this->db->where('a.courier',$filter['filter_b']); }	
			if($filter['filter_c']!=''){ $this->db->where('a.status',$filter['filter_c']); }
			if($filter['filter_d']!=''){ $this->db->where('a.id_delivery_status',$filter['filter_d']); }
			if($filter['filter_e']!=''){ $this->db->where('c.id_department',$filter['filter_e']); }
			
			if($filter['filter_date_aa']!='' && $filter['filter_date_ab']!=''){
				$date_a = $filter['filter_date_aa']; $date_b = $filter['filter_date_ab'];
				$this->db->where(" a.start_date between '$date_a' and '$date_b' ");
			}
			
			if($filter['filter_date_ba']!='' && $filter['filter_date_bb']!=''){
				$date_a = $filter['filter_date_ba']; $date_b = $filter['filter_date_bb'];
				$this->db->where(" a.finish_date between '$date_a' and '$date_b' ");
			}	
			
		}
		
		$this->db->order_by('c.name','ASC');
		
		return $this->db->get();

	}


	public function M_Select_Summary_Month_Courier($filter)
	{
		$this->db->distinct('extract(month FROM a.start_date)');
		$this->db->select('extract(month FROM a.start_date) as month,
		extract(year FROM a.start_date) as year');
		
		$this->db->from('transport_request.request_courier a');
		$this->db->join('login.login_user b', 'a.created_by=b.id_login','LEFT');
		$this->db->join('public.public_view_employee c', 'b.id_employee=c.id_employee','LEFT');
		
		if($filter['filter_a']!=''){ $this->db->where('a.created_by',$filter['filter_a']); }	
		if($filter['filter_b']!=''){ $this->db->where('a.courier',$filter['filter_b']); }	
		if($filter['filter_c']!=''){ $this->db->where('a.status',$filter['filter_c']); }
		if($filter['filter_d']!=''){ $this->db->where('a.id_delivery_status',$filter['filter_d']); }
		if($filter['filter_e']!=''){ $this->db->where('c.id_department',$filter['filter_e']); }
		
		if($filter['filter_date_aa']!='' && $filter['filter_date_ab']!=''){
			$date_a = $filter['filter_date_aa']; $date_b = $filter['filter_date_ab'];
			$this->db->where(" a.start_date between '$date_a' and '$date_b' ");
		}
		
		if($filter['filter_date_ba']!='' && $filter['filter_date_bb']!=''){
			$date_a = $filter['filter_date_ba']; $date_b = $filter['filter_date_bb'];
			$this->db->where(" a.finish_date between '$date_a' and '$date_b' ");
		}	
		
		if($filter['src']!=''){
			
			$this->db->like('a.no_request',$filter['src']);
			
			if($filter['filter_a']!=''){ $this->db->where('a.created_by',$filter['filter_a']); }	
			if($filter['filter_b']!=''){ $this->db->where('a.courier',$filter['filter_b']); }	
			if($filter['filter_c']!=''){ $this->db->where('a.status',$filter['filter_c']); }
			if($filter['filter_d']!=''){ $this->db->where('a.id_delivery_status',$filter['filter_d']); }
			if($filter['filter_e']!=''){ $this->db->where('c.id_department',$filter['filter_e']); }
			
			if($filter['filter_date_aa']!='' && $filter['filter_date_ab']!=''){
				$date_a = $filter['filter_date_aa']; $date_b = $filter['filter_date_ab'];
				$this->db->where(" a.start_date between '$date_a' and '$date_b' ");
			}
			
			if($filter['filter_date_ba']!='' && $filter['filter_date_bb']!=''){
				$date_a = $filter['filter_date_ba']; $date_b = $filter['filter_date_bb'];
				$this->db->where(" a.finish_date between '$date_a' and '$date_b' ");
			}	
			
		}
	
		$this->db->order_by('extract(month FROM a.start_date)','ASC');
		
		return $this->db->get();

	}

	
	public function M_Select_Courier_Count($filter,$created_by,$m,$y)
	{
		$this->db->select('count(a.id_request) as num_request');		
		$this->db->from('transport_request.request_courier a');
		$this->db->where('a.created_by',$created_by);
		$this->db->where('extract(month FROM a.start_date) =',$m);
		$this->db->where('extract(year FROM a.start_date) =',$y);
		$this->db->join('login.login_user b', 'a.created_by=b.id_login','LEFT');
		$this->db->join('public.public_view_employee c', 'b.id_employee=c.id_employee','LEFT');
		
		if($filter['filter_a']!=''){ $this->db->where('a.created_by',$filter['filter_a']); }	
		if($filter['filter_b']!=''){ $this->db->where('a.courier',$filter['filter_b']); }	
		if($filter['filter_c']!=''){ $this->db->where('a.status',$filter['filter_c']); }
		if($filter['filter_d']!=''){ $this->db->where('a.id_delivery_status',$filter['filter_d']); }
		if($filter['filter_e']!=''){ $this->db->where('c.id_department',$filter['filter_e']); }
		
		if($filter['filter_date_aa']!='' && $filter['filter_date_ab']!=''){
			$date_a = $filter['filter_date_aa']; $date_b = $filter['filter_date_ab'];
			$this->db->where(" a.start_date between '$date_a' and '$date_b' ");
		}
		
		if($filter['filter_date_ba']!='' && $filter['filter_date_bb']!=''){
			$date_a = $filter['filter_date_ba']; $date_b = $filter['filter_date_bb'];
			$this->db->where(" a.finish_date between '$date_a' and '$date_b' ");
		}	
		
		if($filter['src']!=''){
			
			$this->db->like('a.no_request',$filter['src']);
			
			if($filter['filter_a']!=''){ $this->db->where('a.created_by',$filter['filter_a']); }	
			if($filter['filter_b']!=''){ $this->db->where('a.courier',$filter['filter_b']); }	
			if($filter['filter_c']!=''){ $this->db->where('a.status',$filter['filter_c']); }
			if($filter['filter_d']!=''){ $this->db->where('a.id_delivery_status',$filter['filter_d']); }
			if($filter['filter_e']!=''){ $this->db->where('c.id_department',$filter['filter_e']); }
			
			if($filter['filter_date_aa']!='' && $filter['filter_date_ab']!=''){
				$date_a = $filter['filter_date_aa']; $date_b = $filter['filter_date_ab'];
				$this->db->where(" a.start_date between '$date_a' and '$date_b' ");
			}
			
			if($filter['filter_date_ba']!='' && $filter['filter_date_bb']!=''){
				$date_a = $filter['filter_date_ba']; $date_b = $filter['filter_date_bb'];
				$this->db->where(" a.finish_date between '$date_a' and '$date_b' ");
			}	
			
		}
		
		return $this->db->get();

	}
	
	
	public function M_Select_Courier_Count_Total($filter,$created_by)
	{
		$this->db->select('count(a.id_request) as num_request');		
		$this->db->from('transport_request.request_courier a');
		$this->db->where('a.created_by',$created_by);
		$this->db->join('login.login_user b', 'a.created_by=b.id_login','LEFT');
		$this->db->join('public.public_view_employee c', 'b.id_employee=c.id_employee','LEFT');
		
		if($filter['filter_a']!=''){ $this->db->where('a.created_by',$filter['filter_a']); }	
		if($filter['filter_b']!=''){ $this->db->where('a.courier',$filter['filter_b']); }	
		if($filter['filter_c']!=''){ $this->db->where('a.status',$filter['filter_c']); }
		if($filter['filter_d']!=''){ $this->db->where('a.id_delivery_status',$filter['filter_d']); }
		if($filter['filter_e']!=''){ $this->db->where('c.id_department',$filter['filter_e']); }
		
		if($filter['filter_date_aa']!='' && $filter['filter_date_ab']!=''){
			$date_a = $filter['filter_date_aa']; $date_b = $filter['filter_date_ab'];
			$this->db->where(" a.start_date between '$date_a' and '$date_b' ");
		}
		
		if($filter['filter_date_ba']!='' && $filter['filter_date_bb']!=''){
			$date_a = $filter['filter_date_ba']; $date_b = $filter['filter_date_bb'];
			$this->db->where(" a.finish_date between '$date_a' and '$date_b' ");
		}	
		
		if($filter['src']!=''){
			
			$this->db->like('a.no_request',$filter['src']);
			
			if($filter['filter_a']!=''){ $this->db->where('a.created_by',$filter['filter_a']); }	
			if($filter['filter_b']!=''){ $this->db->where('a.courier',$filter['filter_b']); }	
			if($filter['filter_c']!=''){ $this->db->where('a.status',$filter['filter_c']); }
			if($filter['filter_d']!=''){ $this->db->where('a.id_delivery_status',$filter['filter_d']); }
			if($filter['filter_e']!=''){ $this->db->where('c.id_department',$filter['filter_e']); }
			
			if($filter['filter_date_aa']!='' && $filter['filter_date_ab']!=''){
				$date_a = $filter['filter_date_aa']; $date_b = $filter['filter_date_ab'];
				$this->db->where(" a.start_date between '$date_a' and '$date_b' ");
			}
			
			if($filter['filter_date_ba']!='' && $filter['filter_date_bb']!=''){
				$date_a = $filter['filter_date_ba']; $date_b = $filter['filter_date_bb'];
				$this->db->where(" a.finish_date between '$date_a' and '$date_b' ");
			}	
			
		}
		
		return $this->db->get();

	}	
	

	
	
	public function M_Select_Summary_Name_Driver($filter)
	{
		$this->db->distinct('a.created_by');
		$this->db->select('a.created_by,c.name as requestor');
		
		$this->db->from('transport_request.request_driver a');
		$this->db->join('login.login_user b', 'a.created_by=b.id_login','LEFT');
		$this->db->join('public.public_view_employee c', 'b.id_employee=c.id_employee','LEFT');
		
		if($filter['filter_a']!=''){ $this->db->where('a.created_by',$filter['filter_a']); }	
		if($filter['filter_b']!=''){ $this->db->where('a.courier',$filter['filter_b']); }	
		if($filter['filter_c']!=''){ $this->db->where('a.status',$filter['filter_c']); }
		if($filter['filter_d']!=''){ $this->db->where('a.id_delivery_status',$filter['filter_d']); }
		if($filter['filter_e']!=''){ $this->db->where('c.id_department',$filter['filter_e']); }
		
		if($filter['filter_date_aa']!='' && $filter['filter_date_ab']!=''){
			$date_a = $filter['filter_date_aa']; $date_b = $filter['filter_date_ab'];
			$this->db->where(" a.start_date between '$date_a' and '$date_b' ");
		}
		
		if($filter['filter_date_ba']!='' && $filter['filter_date_bb']!=''){
			$date_a = $filter['filter_date_ba']; $date_b = $filter['filter_date_bb'];
			$this->db->where(" a.finish_date between '$date_a' and '$date_b' ");
		}	
		
		if($filter['src']!=''){
			
			$this->db->like('a.no_request',$filter['src']);
			
			if($filter['filter_a']!=''){ $this->db->where('a.created_by',$filter['filter_a']); }	
			if($filter['filter_b']!=''){ $this->db->where('a.courier',$filter['filter_b']); }	
			if($filter['filter_c']!=''){ $this->db->where('a.status',$filter['filter_c']); }
			if($filter['filter_d']!=''){ $this->db->where('a.id_delivery_status',$filter['filter_d']); }
			if($filter['filter_e']!=''){ $this->db->where('c.id_department',$filter['filter_e']); }
			
			if($filter['filter_date_aa']!='' && $filter['filter_date_ab']!=''){
				$date_a = $filter['filter_date_aa']; $date_b = $filter['filter_date_ab'];
				$this->db->where(" a.start_date between '$date_a' and '$date_b' ");
			}
			
			if($filter['filter_date_ba']!='' && $filter['filter_date_bb']!=''){
				$date_a = $filter['filter_date_ba']; $date_b = $filter['filter_date_bb'];
				$this->db->where(" a.finish_date between '$date_a' and '$date_b' ");
			}	
			
		}
		
		$this->db->order_by('c.name','ASC');
		
		return $this->db->get();

	}


	public function M_Select_Summary_Month_Driver($filter)
	{
		$this->db->distinct('extract(month FROM a.start_date)');
		$this->db->select('extract(month FROM a.start_date) as month,
		extract(year FROM a.start_date) as year');
		
		$this->db->from('transport_request.request_driver a');
		$this->db->join('login.login_user b', 'a.created_by=b.id_login','LEFT');
		$this->db->join('public.public_view_employee c', 'b.id_employee=c.id_employee','LEFT');
		
		if($filter['filter_a']!=''){ $this->db->where('a.created_by',$filter['filter_a']); }	
		if($filter['filter_b']!=''){ $this->db->where('a.courier',$filter['filter_b']); }	
		if($filter['filter_c']!=''){ $this->db->where('a.status',$filter['filter_c']); }
		if($filter['filter_d']!=''){ $this->db->where('a.id_delivery_status',$filter['filter_d']); }
		if($filter['filter_e']!=''){ $this->db->where('c.id_department',$filter['filter_e']); }
		
		if($filter['filter_date_aa']!='' && $filter['filter_date_ab']!=''){
			$date_a = $filter['filter_date_aa']; $date_b = $filter['filter_date_ab'];
			$this->db->where(" a.start_date between '$date_a' and '$date_b' ");
		}
		
		if($filter['filter_date_ba']!='' && $filter['filter_date_bb']!=''){
			$date_a = $filter['filter_date_ba']; $date_b = $filter['filter_date_bb'];
			$this->db->where(" a.finish_date between '$date_a' and '$date_b' ");
		}	
		
		if($filter['src']!=''){
			
			$this->db->like('a.no_request',$filter['src']);
			
			if($filter['filter_a']!=''){ $this->db->where('a.created_by',$filter['filter_a']); }	
			if($filter['filter_b']!=''){ $this->db->where('a.courier',$filter['filter_b']); }	
			if($filter['filter_c']!=''){ $this->db->where('a.status',$filter['filter_c']); }
			if($filter['filter_d']!=''){ $this->db->where('a.id_delivery_status',$filter['filter_d']); }
			if($filter['filter_e']!=''){ $this->db->where('c.id_department',$filter['filter_e']); }
			
			if($filter['filter_date_aa']!='' && $filter['filter_date_ab']!=''){
				$date_a = $filter['filter_date_aa']; $date_b = $filter['filter_date_ab'];
				$this->db->where(" a.start_date between '$date_a' and '$date_b' ");
			}
			
			if($filter['filter_date_ba']!='' && $filter['filter_date_bb']!=''){
				$date_a = $filter['filter_date_ba']; $date_b = $filter['filter_date_bb'];
				$this->db->where(" a.finish_date between '$date_a' and '$date_b' ");
			}	
			
		}
	
		$this->db->order_by('extract(month FROM a.start_date)','ASC');
		
		return $this->db->get();

	}

	
	public function M_Select_Driver_Count($filter,$created_by,$m,$y)
	{
		$this->db->select('count(a.id_request) as num_request');		
		$this->db->from('transport_request.request_driver a');
		$this->db->where('a.created_by',$created_by);
		$this->db->where('extract(month FROM a.start_date) =',$m);
		$this->db->where('extract(year FROM a.start_date) =',$y);
		$this->db->join('login.login_user b', 'a.created_by=b.id_login','LEFT');
		$this->db->join('public.public_view_employee c', 'b.id_employee=c.id_employee','LEFT');
		
		if($filter['filter_a']!=''){ $this->db->where('a.created_by',$filter['filter_a']); }	
		if($filter['filter_b']!=''){ $this->db->where('a.courier',$filter['filter_b']); }	
		if($filter['filter_c']!=''){ $this->db->where('a.status',$filter['filter_c']); }
		if($filter['filter_d']!=''){ $this->db->where('a.id_delivery_status',$filter['filter_d']); }
		if($filter['filter_e']!=''){ $this->db->where('c.id_department',$filter['filter_e']); }
		
		if($filter['filter_date_aa']!='' && $filter['filter_date_ab']!=''){
			$date_a = $filter['filter_date_aa']; $date_b = $filter['filter_date_ab'];
			$this->db->where(" a.start_date between '$date_a' and '$date_b' ");
		}
		
		if($filter['filter_date_ba']!='' && $filter['filter_date_bb']!=''){
			$date_a = $filter['filter_date_ba']; $date_b = $filter['filter_date_bb'];
			$this->db->where(" a.finish_date between '$date_a' and '$date_b' ");
		}	
		
		if($filter['src']!=''){
			
			$this->db->like('a.no_request',$filter['src']);
			
			if($filter['filter_a']!=''){ $this->db->where('a.created_by',$filter['filter_a']); }	
			if($filter['filter_b']!=''){ $this->db->where('a.courier',$filter['filter_b']); }	
			if($filter['filter_c']!=''){ $this->db->where('a.status',$filter['filter_c']); }
			if($filter['filter_d']!=''){ $this->db->where('a.id_delivery_status',$filter['filter_d']); }
			if($filter['filter_e']!=''){ $this->db->where('c.id_department',$filter['filter_e']); }
			
			if($filter['filter_date_aa']!='' && $filter['filter_date_ab']!=''){
				$date_a = $filter['filter_date_aa']; $date_b = $filter['filter_date_ab'];
				$this->db->where(" a.start_date between '$date_a' and '$date_b' ");
			}
			
			if($filter['filter_date_ba']!='' && $filter['filter_date_bb']!=''){
				$date_a = $filter['filter_date_ba']; $date_b = $filter['filter_date_bb'];
				$this->db->where(" a.finish_date between '$date_a' and '$date_b' ");
			}	
			
		}
		
		return $this->db->get();

	}
	
	public function M_Select_Driver_Count_Total($filter,$created_by)
	{
		$this->db->select('count(a.id_request) as num_request');		
		$this->db->from('transport_request.request_driver a');
		$this->db->where('a.created_by',$created_by);
		$this->db->join('login.login_user b', 'a.created_by=b.id_login','LEFT');
		$this->db->join('public.public_view_employee c', 'b.id_employee=c.id_employee','LEFT');
		
		if($filter['filter_a']!=''){ $this->db->where('a.created_by',$filter['filter_a']); }	
		if($filter['filter_b']!=''){ $this->db->where('a.courier',$filter['filter_b']); }	
		if($filter['filter_c']!=''){ $this->db->where('a.status',$filter['filter_c']); }
		if($filter['filter_d']!=''){ $this->db->where('a.id_delivery_status',$filter['filter_d']); }
		if($filter['filter_e']!=''){ $this->db->where('c.id_department',$filter['filter_e']); }
		
		if($filter['filter_date_aa']!='' && $filter['filter_date_ab']!=''){
			$date_a = $filter['filter_date_aa']; $date_b = $filter['filter_date_ab'];
			$this->db->where(" a.start_date between '$date_a' and '$date_b' ");
		}
		
		if($filter['filter_date_ba']!='' && $filter['filter_date_bb']!=''){
			$date_a = $filter['filter_date_ba']; $date_b = $filter['filter_date_bb'];
			$this->db->where(" a.finish_date between '$date_a' and '$date_b' ");
		}	
		
		if($filter['src']!=''){
			
			$this->db->like('a.no_request',$filter['src']);
			
			if($filter['filter_a']!=''){ $this->db->where('a.created_by',$filter['filter_a']); }	
			if($filter['filter_b']!=''){ $this->db->where('a.courier',$filter['filter_b']); }	
			if($filter['filter_c']!=''){ $this->db->where('a.status',$filter['filter_c']); }
			if($filter['filter_d']!=''){ $this->db->where('a.id_delivery_status',$filter['filter_d']); }
			if($filter['filter_e']!=''){ $this->db->where('c.id_department',$filter['filter_e']); }
			
			if($filter['filter_date_aa']!='' && $filter['filter_date_ab']!=''){
				$date_a = $filter['filter_date_aa']; $date_b = $filter['filter_date_ab'];
				$this->db->where(" a.start_date between '$date_a' and '$date_b' ");
			}
			
			if($filter['filter_date_ba']!='' && $filter['filter_date_bb']!=''){
				$date_a = $filter['filter_date_ba']; $date_b = $filter['filter_date_bb'];
				$this->db->where(" a.finish_date between '$date_a' and '$date_b' ");
			}	
			
		}
		
		return $this->db->get();

	}
/* end */
}
?>