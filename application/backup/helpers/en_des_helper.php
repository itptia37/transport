<?php 
function enid_get($val){
	$a = base64_encode(base64_encode(base64_encode($val)));
	$b = str_replace('=','~',$a);
	$c = str_replace('/','#',$b);
	$d = str_replace('&','^',$c);
	$e = substr($d,0,3);
	$enid_get = $e.$d;
  return $enid_get;
}
function desid_get($val){
	$x = substr($val,3,20);
	$a = str_replace('=','~',$x);
	$b = str_replace('/','#',$a);
	$c = str_replace('&','^',$b);
	$d = base64_decode(base64_decode(base64_decode($c)));
	$desid_get = $d;
  return $desid_get;
}
?>