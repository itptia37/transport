<?php 

function xxs_filter($str){
	$filter = htmlentities($str, ENT_QUOTES, 'UTF-8');
	$xxs_filter = str_replace("&lt;br&gt;","<br>",$filter);
	return $xxs_filter;	
}
?>