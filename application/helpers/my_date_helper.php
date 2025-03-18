<?php
defined('BASEPATH') OR exit('No direct script access allowed');
function my_date(){
	return date('Y-m-d');
}
function my_time(){
	return gmdate('H:i:s', time()+60*60*7);
}
function my_date_time(){
	return date('Y-m-d').' '.gmdate('H:i:s', time()+60*60*7);
}
function date_modif($val){
	if($val== '00') 
	{$date_modif = 24;}
	else 
	{$date_modif = $val;}
	return $date_modif;
}
function date_ind_full($val){
if($val=='0000-00-00 00:00:00') {$date_ind_full='';}
elseif($val=='') {$date_ind_full='';}
elseif($val==NULL) {$date_ind_full='';}
else {
	$exp 		= explode(' ',$val);
	$val_my_date	= $exp['0'];
	$val_my_time	= $exp['1'];
	if($val_my_date=='0000-00-00') {$date_ind_full='';}
	else{
		$exp 		= explode('-',$val_my_date);
		$my_date	= $exp['2'];
		$my_month	= $exp['1'];
		$my_year	= $exp['0'];
		$date_ind_full = $my_date.'-'.$my_month.'-'.$my_year; 
		}
	}
	return $date_ind_full;
}

function date_time_ind_full($val){
if($val=='0000-00-00 00:00:00') {$date_time_ind_full='';}
elseif($val=='') {$date_time_ind_full='';}
elseif($val==NULL) {$date_time_ind_full='';}
else {
	$exp 		= explode(' ',$val);
	$val_my_date	= $exp['0'];
	$val_my_time	= $exp['1'];
	if($val_my_date=='0000-00-00') {$date_time_ind_full='';}
	else{
		$exp 		= explode('-',$val_my_date);
		$my_date	= $exp['2'];
		$my_month	= $exp['1'];
		$my_year	= $exp['0'];
		$date_time_ind_full = $my_date.'-'.$my_month.'-'.$my_year.' '.$val_my_time; 
		}
	}
	return $date_time_ind_full;
}

function date_ind($val){
if($val=='0000-00-00') {$date_ind='';}
elseif($val=='') {$date_ind='';}
elseif($val==NULL) {$date_ind='';}
else {
	$exp 		= explode('-',$val);
	$my_date	= $exp['2'];
	$my_month	= $exp['1'];
	$my_year	= $exp['0'];
	$date_ind 	= $my_date.'-'.$my_month.'-'.$my_year; 
	}
return $date_ind;
}

function date_input($val){
if($val=='00-00-0000') {$date_input=NULL;}
elseif($val=='') {$date_input=NULL;}
elseif($val==NULL) {$date_input=NULL;}
else {
	$exp 		= explode('-',$val);
	$my_date	= $exp['0'];
	$my_month	= $exp['1'];
	$my_year	= $exp['2'];
	$date_input = $my_year.'-'.$my_month.'-'.$my_date; 
	}
return $date_input;
}
function time_input($val){
if($val=='') {$time_input=NULL;}
elseif($val==NULL) {$time_input=NULL;}
else {$time_input=$val;}
return $time_input;
}




function date_ind_text($val){
	
if($val=='0000-00-00') {$date_ind='';}
elseif($val=='') {$date_ind='';}
elseif($val==NULL) {$date_ind='';}
else {
	$exp 		= explode('-',$val);
	$my_date	= $exp['2'];
	$my_month	= $exp['1'];
	$my_year	= $exp['0'];
	
	if($my_month == '01')
		{$result_month = 'Jan';}
	elseif($my_month == '02')
		{$result_month = 'Feb';}
	elseif($my_month == '03')
		{$result_month = 'Mar';}	
	elseif($my_month == '04')
		{$result_month = 'Apr';}
	elseif($my_month == '05')
		{$result_month = 'May';}
	elseif($my_month == '06')
		{$result_month = 'Jun';}
	elseif($my_month == '07')
		{$result_month = 'Jul';}
	elseif($my_month == '08')
		{$result_month = 'Aug';}
	elseif($my_month == '09')
		{$result_month = 'Sep';}
	elseif($my_month == '10')
		{$result_month = 'Oct';}
	elseif($my_month == '11')
		{$result_month = 'Nov';}
	elseif($my_month == '12')
		{$result_month = 'Des';}
	else{$my_month = 'ss';}
	
	$date_ind 	= $my_date.'-'.($result_month).'-'.$my_year;
	}
return $date_ind;
}

function mymonth_summary($val){
if($val=='0000-00') {$mymonth_summary='';}
elseif($val=='') {$mymonth_summary='';}
elseif($val==NULL) {$mymonth_summary='';}
else {
	$exp		= explode('-',$val);
	$my_month  	= $exp['1'];
	$my_year 	= $exp['0'];
	
if($my_month == '01')
	{$result_month = 'Jan';}
elseif($my_month == '02')
	{$result_month = 'Feb';}
elseif($my_month == '03')
	{$result_month = 'Mar';}	
elseif($my_month == '04')
	{$result_month = 'Apr';}
elseif($my_month == '05')
	{$result_month = 'May';}
elseif($my_month == '06')
	{$result_month = 'Jun';}
elseif($my_month == '07')
	{$result_month = 'Jul';}
elseif($my_month == '08')
	{$result_month = 'Aug';}
elseif($my_month == '09')
	{$result_month = 'Sep';}
elseif($my_month == '10')
	{$result_month = 'Oct';}
elseif($my_month == '11')
	{$result_month = 'Nov';}
elseif($my_month == '12')
	{$result_month = 'Des';}
else{$my_month = '';}

	$mymonth_summary = $result_month.' '.$my_year; 
	}
return $mymonth_summary;
}


function mymonth_src($val){
	
if($val == 'jan')
	{$mymonth_src = '01';}
elseif($val == 'feb')
	{$mymonth_src = '02';}
elseif($val == 'mar')
	{$mymonth_src = '03';}	
elseif($val == 'apr')
	{$mymonth_src = '04';}
elseif($val == 'may')
	{$mymonth_src = '05';}
elseif($val == 'jun')
	{$mymonth_src = '06';}
elseif($val == 'jul')
	{$mymonth_src = '07';}
elseif($val == 'aug')
	{$mymonth_src = '08';}
elseif($val == 'sep')
	{$mymonth_src = '09';}
elseif($val == 'okt')
	{$mymonth_src = '10';}
elseif($val == 'nov')
	{$mymonth_src = '11';}
elseif($val == 'des')
	{$mymonth_src = '12';}
	
else{$mymonth_src = $val;}

return $mymonth_src;
}


function Romawi($val){
	
if($val == '01')
	{$result_month = 'I';}
elseif($val == '02')
	{$result_month = 'II';}
elseif($val == '03')
	{$result_month = 'III';}	
elseif($val == '04')
	{$result_month = 'IV';}
elseif($val == '05')
	{$result_month = 'V';}
elseif($val == '06')
	{$result_month = 'VI';}
elseif($val == '07')
	{$result_month = 'VII';}
elseif($val == '08')
	{$result_month = 'VIII';}
elseif($val == '09')
	{$result_month = 'IX';}
elseif($val == '10')
	{$result_month = 'X';}
elseif($val == '11')
	{$result_month = 'XI';}
elseif($val == '12')
	{$result_month = 'XII';}
else{$result_month = '';}

	$Romawi = $result_month.'/'.date('y');
	
return $Romawi;
}


function get_hour($val){
if($val=='00:00:00') {$get_hour='';}
elseif($val=='') {$get_hour='';}
elseif($val==NULL) {$get_hour='';}
else {
	$exp 		= explode(':',$val);
	$my_hour	= isset($exp['0']) ? $exp['0']:'';
	$get_hour 	= $my_hour; 
	}
return $get_hour;
}

function get_minute($val){
if($val=='00:00:00') {$get_minute='';}
elseif($val=='') {$get_minute='';}
elseif($val==NULL) {$get_minute='';}
else {
	$exp 		= explode(':',$val);
	$my_minute	= isset($exp['1']) ? $exp['1']:'';
	$get_minute = $my_minute; 
	}
return $get_minute;
}
?>