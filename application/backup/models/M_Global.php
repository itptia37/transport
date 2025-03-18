<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Global extends CI_Model {

	public function M_Logout()
	{
		$this->session->unset_userdata('id_tr');
		$this->session->unset_userdata('email_tr');
		$this->session->unset_userdata('name_tr');
		$this->session->unset_userdata('access_tr');	
		echo'destroy';
	}

	public function M_Get_Tone($table)
	{
		$this->db->select('id_request'); 
		$this->db->where('status',1);
		$this->db->where('read',0);
		$this->db->where('tone',0);
		return $this->db->get('transport_request.request_'.$table);
	}
	
	public function M_Get_Request($table)
	{
		$this->db->select('
		a.id_request,
		a.start_date,
		a.start_time,
		a.no_request,
		a.status,b.email,
		c.name as requestor
		'); 
		$this->db->where('a.status',1);
		$this->db->where('a.read',0);
		
		if($this->session->userdata('access_tr') == 24){ //basic			
			$this->db->where('a.created_by',desid_get($this->session->userdata('id_tr')));			
		}
		
		$this->db->from('transport_request.request_'.$table.' a');
		$this->db->join('login.login_user b', 'a.created_by = b.id_login','LEFT');
		$this->db->join('public.view_employee c', 'b.id_employee = c.id_employee','LEFT');
		return $this->db->get();
	}	
	
	public function M_Get_Request_Home($table)
	{
		$this->db->select('
		a.id_request,
		a.start_date,
		a.start_time,
		a.no_request,
		a.status,b.email,
		c.name as requestor
		'); 
		$this->db->where('a.status >',0);
		$this->db->where('a.status <',3);		
		
		if($this->session->userdata('access_tr') == 24){ //basic			
			$this->db->where('a.created_by',desid_get($this->session->userdata('id_tr')));			
		}
		
		$this->db->from('transport_request.request_'.$table.' a');
		$this->db->join('login.login_user b', 'a.created_by = b.id_login','LEFT');
		$this->db->join('public.view_employee c', 'b.id_employee = c.id_employee','LEFT');
		return $this->db->get();
	}
	
	public function M_Get_Standby_Home($table)
	{
		$this->db->select('a.*,b.name'); 		
		$this->db->from('transport_request.parameter_'.$table.' a');
		$this->db->where('a.status',1);
		$this->db->where('a.'.$table.' !=',null);
		$this->db->join('public.view_employee b', 'a.'.$table.' = b.id_employee','LEFT');
		$this->db->where('a.'.$table.' not in (select c.'.$table.' from transport_request.request_'.$table.' c where c.status < 3)');
		return $this->db->get();
	}
	
	public function Create_No_request($val,$table)
	{
		$this->db->select('no_request');
		$this->db->where("EXTRACT(YEAR FROM (created_date)) = '".date('Y')."' ");
		$this->db->order_by('id_request','DESC');
		$this->db->limit(1);
		$query = $this->db->get($table);

		$num = $query->num_rows();
		if($num == 0){
			$no_request = '0001'.$val;
		} else {
			$dt = $query->row();
			$idMax = $dt->no_request;
			$no = (int) substr($idMax,0,4);$no++;
			return sprintf('%04s'.$val, $no);
		}
		return $no_request;
	}
	
	public function M_Create_Id($fild,$table)
	{
		$this->db->select_max($fild);
		$query = $this->db->get($table);
		
		$num = $query->num_rows();
		if($num == 0){
			$id_parameter = 1;
		} else {
			$dt = $query->row();
			$id_parameter= ($dt->$fild+1);
		}
		return $id_parameter;
	}
	
	public function Create_No_Cash($val,$table)
	{
		$this->db->select_max('no_cash');
		$this->db->where("EXTRACT(YEAR FROM (created_date)) = '".date('Y')."' ");
		$query = $this->db->get($table);

		$num = $query->num_rows();		
		if($num == 0){
			$no_cash = '0001'.$val;
		} else {
			$dt = $query->row();
			$idMax = $dt->no_cash;
			$no = (int) substr($idMax,0,4);$no++;
			return sprintf('%04s'.$val, $no);
		}
		return $no_cash;
	}
	
	public function M_CheckId($fild,$table)
	{
		$this->db->select_max($fild);
		return $this->db->get($table);	
	}
	
	public function M_Select_File($target,$table,$request)
	{
		$this->db->select('a.*,c.name as creater');
		$this->db->from($table);
		$this->db->where($target);
		$this->db->where('a.flag',$request);
		$this->db->join('login.login_user b', 'a.created_by = b.id_login','LEFT');
		$this->db->join('public.view_employee c', 'b.id_employee = c.id_employee','LEFT');
		return $this->db->get();
	}

	public function M_Search_List_Project($src)
	{
		$this->db->select('project_number as project_no');
		$this->db->like('(project_number)::VARCHAR',$src);
		$this->db->order_by('project_number','DESC');
		$this->db->limit(10);
		//return $this->db->get('ios.project');
		//return $this->db->get('app_standart.ios_project');
		return $this->db->get('app_master.ios_project');
	}
	
	public function M_Select_Where($table,$target)
	{
		$this->db->where($target);
		return $this->db->get($table);
	}
	
	public function M_Save($table,$data)
	{
	
		$this->db->trans_start();
		$this->db->insert($table,$data);
		$this->db->trans_complete();
		return $this->db->trans_status();
		
	}

	public function M_Update($table,$data,$target)
	{
		
		$this->db->trans_start();
		$this->db->set($data);
		$this->db->where($target);
		$this->db->update($table);
		$this->db->trans_complete();
		return $this->db->trans_status();
	}

	public function M_Delete($table,$target)
	{
		
		$this->db->trans_start();
		$this->db->where($target);
		$this->db->delete($table);
		$this->db->trans_complete();
		return $this->db->trans_status();
	}	
	
	public function M_List_Parameter_Src($target,$src)
	{
		$this->db->where($target); 
		$this->db->like('name',$src); 
		$this->db->where('status',1); 
		$this->db->limit(10);	
		$this->db->order_by('seq','ASC');
		return $this->db->get('transport_request.parameter');	
	}
	
	public function M_List_Parameter($target)
	{
		$this->db->where($target); 
		$this->db->where('status',1); 
		$this->db->order_by('seq','ASC');
		return $this->db->get('transport_request.parameter');	
	}
	
	
	public function M_Search_List_Company($src)
	{
		
		$this->db->select('id_parameter,name');		
		$this->db->like('name',strtoupper($src));		
		$this->db->where('id_parameter_category',$this->session->userdata('set_company'));
		$this->db->where('status',1); 
		$this->db->order_by('seq');		
		$this->db->limit(10);		
		return $this->db->get('transport_request.parameter');
		
	}
	
	public function M_ExpenseData($id_request,$request)
	{
		$this->db->select('a.*,b.name,c.id_proccess');
		$this->db->from('transport_request.request_expense a');
		$this->db->where('a.id_request',$id_request);
		$this->db->where('a.status',1);
		$this->db->where('a.request',$request);
		$this->db->join('transport_request.parameter b', 
			'a.expense_type=b.id_parameter','INNER');
		$this->db->join('transport_request.request_mark c', 
			'a.id_request=c.id_request and c.request='.$request,'LEFT');
		return $this->db->get();
	}
	
	public function M_Expense_Detail($id_expense,$request)
	{
		$this->db->select('a.id_expense,a.expense_type,a.balance,b.name');
		$this->db->from('transport_request.request_expense a');
		$this->db->where('a.id_expense',$id_expense);
		$this->db->where('a.status',1);
		$this->db->where('a.request',$request);
		$this->db->join('transport_request.parameter b', 
			'a.expense_type=b.id_parameter','INNER');
		return $this->db->get();
	}
	
	public function M_Request_Sum($target,$request)
	{	/* sum expense */
		$this->db->select('sum(balance) as total');
		$this->db->where('id_request',$target);
		$this->db->where('request',$request);
		$this->db->where('status',1);
		return $this->db->get('transport_request.request_expense');
		
	}
	
	public function M_Search_List_Expense_Type($src)
	{
		
		$this->db->select('id_parameter,name');		
		$this->db->like('name',strtoupper($src));		
		$this->db->where('id_parameter_category',$this->session->userdata('set_expense_type'));	
		$this->db->where('status',1); 
		$this->db->order_by('seq');		
		$this->db->limit(10);		
		return $this->db->get('transport_request.parameter');
		
	}	

	public function M_Check_Expense($id_request,$expense_type,$request)
	{
		
		$this->db->select('a.id_expense');		
		$this->db->from('transport_request.request_expense a');
		$this->db->where('a.id_request',$id_request);	
		$this->db->where('a.expense_type',$expense_type); 
		$this->db->where('a.request',$request); 
		$this->db->where('k.id_proccess',null);		
		$this->db->join('transport_request.request_mark k', 
			'a.id_request=k.id_request and k.request = '.$request,'LEFT');
		return $this->db->get();
		
	}
	
    public function M_SendEmail($email,$subject,$body){
		
    	$this->load->helper('path');
    	$this->load->library('MyPHPMailer'); 
		
		$email_sender = $this->db->get('transport_request.email_sender')->row();
		
		$this->db->select('name');
		$this->db->where('id_parameter_category',$this->session->userdata('set_email_receiver'));
		$this->db->where('status',1);
		$email_receiver = $this->db->get('transport_request.parameter')->result();
		
        $fromEmail		= $email_sender->email;
        $pass 			= $email_sender->password;
        $toEmail		= $email;
        $subjectEmail 	= $subject;
        $bodyEmail		= $body;
        
		
        $mail = new PHPMailer;
		
		$mail->IsHTML(true);   
        $mail->IsSMTP();   
        $mail->SMTPAuth   = true; 
        $mail->SMTPSecure = $email_sender->smtpsecure; 
		
        $mail->Host       = $email_sender->host;
        $mail->Port       = $email_sender->port;
		
        $mail->Username   = $fromEmail;
        $mail->Password   = $pass;
        $mail->SetFrom($fromEmail, 'Transport Request');
		
		$mail->AddAddress($toEmail);
		//$mail->addCC($fromEmail);
		
		foreach($email_receiver as $data){
			$mail->addCC($data->name);
			//$mail->addBCC("it@indospec.co.id");
		}	
			
        $mail->Subject    = $subjectEmail;
        $mail->Body       = $bodyEmail;
        
        
       
        if($mail->Send()) {
			$result = 'Berhasil';
       	} else {
            $result = 'Eror: '.$mail->ErrorInfo;
        }
		
			$result;
		
	}
	
	public function M_MAC()
	{
	   ob_start();  
	   //Get the ipconfig details using system commond  
	   system('ipconfig /all');  
	   // Capture the output into a variable  
	   $mycomsys = ob_get_contents();  
	   // Clean (erase) the output buffer  
	   ob_clean();  
	   $find_mac = "Physical"; //find the "Physical" & Find the position of Physical text  
	   $pmac = strpos($mycomsys, $find_mac);  
	   // Get Physical Address  
	   $macaddress=substr($mycomsys,($pmac+36),17);  
	   //Display Mac Address  
	   return $macaddress;  
	}
	
/**/
}
?>