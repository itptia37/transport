<?php 
function curr_ind($val){
if($val==0) {$curr_ind='';}
	elseif($val=='') {$curr_ind='';}
		else{ 
			$curr_ind = number_format($val,2,",", ".");	
			$exp = explode(",",$curr_ind); 
			if($exp[1] > 0){
				$curr_ind = $curr_ind;
			}else{
				$curr_ind = $exp[0];
			}
		}
  return $curr_ind;
}

function curr_ind_input($val){
if($val==0) {$curr_ind_input=0;}
	elseif($val=='') {$curr_ind_input=0;}
		else{ 
			$curr_ind_input = str_replace(".","",$val); 
			}
  return $curr_ind_input;
}


	function my_words($val) {
		$val = abs($val);
		$huruf = array("", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten", "Eleven","Twelve");
		$temp = "";
		$n_temp = "";
		if ($val < 13) {
			$temp = " ". $huruf[$val];
		} else if ($val < 20) {
			
			if($val == 13){
				$temp = "Thirteen";
			}elseif($val == 14){
				$temp = "Fourteen";
			}elseif($val == 15){
				$temp = "Fiveteen";
			}elseif($val == 16){
				$temp = "Sixteen";
			}elseif($val == 17){
				$temp = "Seventeen";
			}elseif($val == 18){
				$temp = "Eighteen";
			}elseif($val == 19){
				$temp = "Nineteen";
			}
		
		} else if ($val < 100) {
			
			if(floor($val/10) == 2){
				$n_temp = "Twenty";
			}elseif(floor($val/10) == 3){
				$n_temp = "Thirty";
			}elseif(floor($val/10) == 4){
				$n_temp = "Forty";
			}elseif(floor($val/10) == 5){
				$n_temp = "Fifty";
			}elseif(floor($val/10) == 6){
				$n_temp = "Sixty";
			}elseif(floor($val/10) == 7){
				$n_temp = "Seventy";
			}elseif(floor($val/10) == 8){
				$n_temp = "Eighty";
			}elseif(floor($val/10) == 9){
				$n_temp = "Ninety";
			}
			
			//$temp = " ". $n_temp ." ". my_words($val % 10);
			$temp = " ". $n_temp . my_words($val % 10);
			
		} else if ($val < 1000) {
			$temp = my_words($val/100) . " Hundred" . my_words($val % 100);
		} else if ($val < 1000000) {
			$temp = my_words($val/1000) . " Thousand" . my_words($val % 1000);
		} else if ($val < 1000000000) {
			$temp = my_words($val/1000000) . " Million" . my_words($val % 1000000);
		} else if ($val < 1000000000000) {
			$temp = my_words($val/1000000000) . " Billion" . my_words(fmod($val,1000000000));
		} else if ($val < 1000000000000000) {
			$temp = my_words($val/1000000000000) . " Trilion" . my_words(fmod($val,1000000000000));
		}     
		return $temp;
	}
 
	
	function my_coma($val) {
		$val = abs($val);
		$huruf = array("Zero", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine");
		$temp = "";
		
		if ($val < 10) {
			$temp = " ". $huruf[$val];
		}else if($val<20){
			$temp = my_coma($val - 10)." ";
		}else if ($val<100){
			$temp = my_coma($val/10)." ". my_coma($val%10);
		}
		
		return $temp;
	}
	
	function to_words($val) {
		
		if($val > 0){
			
			$ex = explode('.',$val);
			$point = isset($ex[1]) ? $ex[1]:'';
			if($point <= 0){
				$tpoint = '';
			}elseif($point > 0 && $point < 10 ){
				$x=0;
				$tpoint = 'and '.my_coma($point.$x);
			}elseif($point > 0 && $point < 100 ){
				$tpoint = 'and '.my_coma($point);
			}
			elseif($point > 100 ){
				$npoint = substr($point,0,2);
				$tpoint = 'and '.my_coma($npoint);
			}
			
			if($val < 0) {
				
				$result = "minus ". trim(my_words($val));
				
			} else {
				
				$result = trim(my_words($val));
			}   
		
		}
		
		return $result.$tpoint;
	}
	
	
	
	
function to_words_ind($x){
if($x<0){
$hasil = "minus ".trim(konversi(x));
}else{
$poin = trim(tkoma($x));
$hasil = trim(konversi($x));
}
if($poin){
$hasil = $hasil." koma ".$poin;
}else{
$hasil = $hasil;
}
return $hasil.' rupiah';
}

function konversi($x){
$x = abs($x);
$angka = array ("","satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
$temp = "";

if($x < 12){
$temp = " ".$angka[$x];
}else if($x<20){
$temp = konversi($x - 10)." belas";
}else if ($x<100){
$temp = konversi($x/10)." puluh". konversi($x%10);
}else if($x<200){
$temp = " seratus".konversi($x-100);
}else if($x<1000){
$temp = konversi($x/100)." ratus".konversi($x%100);
}else if($x<2000){
$temp = " seribu".konversi($x-1000);
}else if($x<1000000){
$temp = konversi($x/1000)." ribu".konversi($x%1000);
}else if($x<1000000000){
$temp = konversi($x/1000000)." juta".konversi($x%1000000);
}else if($x<1000000000000){
$temp = konversi($x/1000000000)." milyar".konversi(fmod($x, 1000000000));
}else if($x<1000000000000000){
$temp = konversi($x/1000000000000)." triliun".konversi(fmod($x, 1000000000000));
}

return $temp;
}


function tkoma($x){
$str = stristr($x,",");
$ex = explode(',',$x);
if(isset($ex[1]))
{
if(($ex[1]/10) >= 1){
$a = abs($ex[1]);
}
$string = array("nol", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan","sepuluh", "sebelas");
$temp = "";

$a2 = $ex[1]/10;
$pjg = strlen($str);
$i =1;


if($a >=1 && $a< 12){
$temp .= " ".$string[$a];
}else if($a>12 && $a<20){
$temp .= konversi($a - 10)."";
}else if ($a>20 && $a<100){
$temp .= konversi($a/10)."". konversi($a%10);
}else{
if($a2<1){

while ($i<$pjg){
$char = substr($str,$i,1);
$i++;
$temp .= " ".$string[$char];
}
}
}
return $temp;
}else{
return FALSE;
}


}
?>