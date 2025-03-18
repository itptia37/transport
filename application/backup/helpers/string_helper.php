<?php 

function my_user_name($x,$y){
	if($x == ''){
		$exp = explode('@',$y);
		$a   = isset($exp[0]) ? $exp[0]:'';
		$my_user_name = str_replace('.',' ',$a);
	}else{
		$my_user_name = $x;
	}
	return strtoupper(xxs_filter($my_user_name));
}

function my_file_name($val){
	return $val.date('Y-m-d').'-'.gmdate('His');
}

function string_document_number($val){
$arr = array(" ");
$string_po = strtoupper(str_replace($arr,"",$val));
return $string_po;
}

function string_id($val){
$arr = array(" ","/",".","&","-","'");
$string_id = str_replace($arr,"_",$val);
return $string_id;
}

function string_src($val){
$string_src = str_replace("'","",$val);
return $string_src;
}

function text_br_input($val){
$array = array("<br />","<br/>");
$text_br_input = str_replace($array,"<br>",$val);
return $text_br_input;
}

function text_br($val){
$array = array("<br />","<br/>","<br>","</br>","<br >");
$text_br = str_replace($array,"",$val);
return $text_br;
}

function description_limit($val){
$array = array("<br />","<br/>","<br>","</br>","<br >");
$a = str_replace($array,"",$val);
$b = strlen($val);
	if($b > 120){
		$description_limit = substr($a,0,120).'...';
	}else{
		$description_limit = $a;
	}
return $description_limit;
}

function name_limit($val){
$a = strlen($val);
	if($a > 20){
		$name_limit = substr($val,0,20).'...';
	}else{
		$name_limit = $val;
	}
return $name_limit;
}

?>