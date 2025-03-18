<?php 
function ph($val){
	
	if($val == 1){ $ph = '<span style="color:#999999;">-- select --</span>'; }
	if($val == 2){ $ph = '<span style="color:#999999;">automatic</span>'; }
	if($val == 3){ $ph = 'text...'; }
	if($val == 4){ $ph = '2000'; }
	if($val == 5){ $ph = date('d-m-Y'); }
	if($val == 6){ $ph = 1234; }
	
	return $ph;	
}
?>