<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>

<?php require_once 'set_header.php'; ?>
<div id="my-container-content">

<div id="my-loading"></div>


<div id="my-content">
<?php 
	if($this->session->userdata('id_tr') == ''){
		
		if($this->session->userdata('notif_login') != ''){
			echo myalert('danger',$this->session->userdata('notif_login'));
		}
		
		require_once 'login.php';
		
	}else{
		
		require_once 'home.php';
		
	}
?>
</div><!--my-content-->

</div><!--my-container-content-->
<?php require_once 'set_footer.php'; ?>