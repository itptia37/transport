<?php 
defined('BASEPATH') or exit ('No direct script access allowed');

if($export_to == 'excel'){ /* ---------- export excel ---------- */

	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=\"Courier Report Request.xls\" ");
	header("Pragma: no-cache");

}elseif($export_to == 'word'){ /* ---------- export word ---------- */

	header("Content-type: application/vnd.ms-word");
	header("Content-Disposition: attachment; filename=\"Courier Report Request.doc\" ");
	header("Pragma: no-cache");

}elseif($export_to == 'pdf'){ /* ---------- export pdf ---------- */

	include_once APPPATH.'/libraries/mpdf/mpdf.php';
	/*mPDF('utf-8', 'A4', 0, 'calibri', margin-left, margin-right,  margin-top,  margin-bottom, 1, 1, '') $mpdf->AddPage('L');*/
	$mpdf = new mPDF('utf-8', 'A4', 0, 'calibri', 10, 10, 10, 10, 1, 1, ''); 
	$mpdf->AddPage('L');
	ob_start(); 
}  /* ---------- else html ---------- */ 
?>
<div style="text-align: right; font-weight: bold;">
    PT INDOSPEC ASIA
</div><hr>
<h4>REQUEST COURIER REPORT</h4>
<table width="100%" class="table table-condensed table-bordered" border="1"
style="border-collapse:collapse;border:none;padding:2px;">
<tr>
	<th width="30px" align="center" style="background-color: #95a5a6;color: #fff;" >No</th>
	<th align="center" style="background-color: #95a5a6;color: #fff;" >NO REQUEST</th>
	<th align="center" style="background-color: #95a5a6;color: #fff;" >COMPANY</th>
	<th align="center" style="background-color: #95a5a6;color: #fff;" >REQUESTOR</th>
	<th align="center" style="background-color: #95a5a6;color: #fff;" >DEPARTMENT</th>
	<th align="center" style="background-color: #95a5a6;color: #fff;" >DEPARTURE DATE</th>
	<th align="center" style="background-color: #95a5a6;color: #fff;" >DEPARTURE TIME</th>
	<th align="center" style="background-color: #95a5a6;color: #fff;" >RETURN DATE</th>
	<th align="center" style="background-color: #95a5a6;color: #fff;" >RETURN TIME</th>
	<th align="center" style="background-color: #95a5a6;color: #fff;" >REQUEST FOR</th>
	<th align="center" style="background-color: #95a5a6;color: #fff;" >PURPOSE</th>
	<th align="center" style="background-color: #95a5a6;color: #fff;" >DESTINATION</th>
	<th align="center" style="background-color: #95a5a6;color: #fff;" >DESCRIPTION</th>
	<th align="center" style="background-color: #95a5a6;color: #fff;" >COURIER</th>
	<th align="center" style="background-color: #95a5a6;color: #fff;" >EXTERNAL</th>
	<th align="center" style="background-color: #95a5a6;color: #fff;" >DELIVERY</th>
	<th align="center" style="background-color: #95a5a6;color: #fff;" >BALANCE</th>
	<th width="70px" align="center" style="background-color: #95a5a6;color: #fff;" >STATUS</th>
</tr>
<?php
$no = 1;
foreach($result_data as $data){
	
	$dt 	= $this->M_Global->M_Request_Sum($data->id_request,2)->row();
	
	echo'<tr>';
	echo'<td valign="top" align="center">'.$no.'</td>';
	echo'<td valign="top">'.$data->no_request.'</td>';
	echo'<td valign="top">'.$data->company_name.'</td>';
	echo'<td valign="top">';
		echo my_user_name($data->requestor,$data->requestor_email);
	echo'</td>';
	
	echo'<td valign="top">'.$data->department.'</td>';
	echo'<td valign="top">'.date_ind($data->start_date).'</td>';
	echo'<td valign="top">'.$data->start_time.'</td>';
	echo'<td valign="top">'.date_ind($data->finish_date).'</td>';
	echo'<td valign="top">'.$data->finish_time.'</td>';
	echo'<td valign="top">'.$data->request_option_name.'</td>';
	echo'<td valign="top">'.$data->expense_purpose_name.'</td>';
	echo'<td valign="top">'.$data->destination.'</td>';
	echo'<td valign="top">'.$data->description.'</td>';
	echo'<td valign="top">'.$data->courier_name.'</td>';
	echo'<td valign="top">'.$data->external_name.'</td>';
	echo'<td valign="top">'.$data->delivery_name.'</td>';
	echo'<td valign="top">'.($dt->total).'</td>';
	echo'<td valign="top">'.status_transaction($data->status).'</td>';
	echo'</tr>';
	$no++;
}
?>
</table>
<?php 
if($export_to == 'pdf'){
	$html = ob_get_contents(); 
	ob_end_clean();
	$mpdf->WriteHTML(utf8_encode($html));
	$mpdf->Output("Courier Report Request.pdf" ,'I');
	exit;
} 
?>