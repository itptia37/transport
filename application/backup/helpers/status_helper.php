<?php 
function myalert($type,$text){
	$myalert = '<div class="my-alert-box" ><div class="alert alert-'.$type.' alert-dismissible">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	<center><span class="glyphicon glyphicon-alert"></span>&nbsp;&nbsp;'.$text.'</center></div></div>';
return $myalert;
}

function status($val){ 
	if($val==0){$status='Inactive';}
	elseif($val==1){$status='Active';}
	else{$status='';}
return $status;
}

function status_label($val){ 
	if($val==0){$status_label='default';}
	elseif($val==1){$status_label='info';}
	else{$status_label='';}
return $status_label;
}

function status_text($val){ /* for js */
	if($val==0){$status_text='Enable';}
	elseif($val==1){$status_text='Disable';}
	else{$status_text='';}
return $status_text;
}

function change_status_value($val){ /* for js */
	if($val==0){$change_status_value=1;}
	elseif($val==1){$change_status_value=0;}
	else{$change_status_value=$val;}
return $change_status_value;
}

function status_transaction($val){ 
	if($val==0){$status_transaction='New';}
	elseif($val==1){$status_transaction='Sent';}
	elseif($val==2){$status_transaction='Proccess';}
	elseif($val==3){$status_transaction='Done';}
	elseif($val==4){$status_transaction='Cancel';}
	else{$status_transaction='';}
return $status_transaction;
}

function status_label_transaction($val){ 
	if($val==0){$status_label_transaction='default';}
	elseif($val==1){$status_label_transaction='warning';}
	elseif($val==2){$status_label_transaction='info';}
	elseif($val==3){$status_label_transaction='primary';}
	elseif($val==4){$status_label_transaction='danger';}
	else{$status_label_transaction='';}
return $status_label_transaction;
}

function status_text_transaction($val){ /* for js */
	if($val==1){$status_text_transaction='Send';}
	elseif($val==2){$status_text_transaction='Proccess';}
	elseif($val==3){$status_text_transaction='Done';}
	elseif($val==4){$status_text_transaction='Cancel';}
	else{$status_text_transaction='';}
return $status_text_transaction;
}

function status_cash($val){ 
	if($val==0){$status_cash='Proccess';}
	elseif($val==1){$status_cash='Lock';}
	elseif($val==2){$status_cash='Finish';}
	elseif($val==3){$status_cash='Cancel';}
	else{$status_cash='';}
return $status_cash;
}

function status_label_cash($val){ 
	if($val==0){$status_label_cash='default';}
	elseif($val==1){$status_label_cash='info';}
	elseif($val==2){$status_label_cash='primary';}
	elseif($val==3){$status_label_cash='danger';}
	else{$status_label_cash='';}
return $status_label_cash;
}

?>