<?php 
defined('BASEPATH') or exit ('No direct script access allowed');

if($export_to == 'excel'){ /* ---------- export excel ---------- */

	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=\"Report Petty Cash.xls\" ");
	header("Pragma: no-cache");

}elseif($export_to == 'word'){ /* ---------- export word ---------- */

	header("Content-type: application/vnd.ms-word");
	header("Content-Disposition: attachment; filename=\"Report Petty Cash.doc\" ");
	header("Pragma: no-cache");

}elseif($export_to == 'pdf'){ /* ---------- export pdf ---------- */

	include_once APPPATH.'/libraries/mpdf/mpdf.php';
	/*mPDF('utf-8', 'A4', 0, 'calibri', margin-left, margin-right,  margin-top,  margin-bottom, 1, 1, '') $mpdf->AddPage('L');*/
	$mpdf = new mPDF('utf-8', 'A4', 0, 'calibri', 10, 10, 10, 10, 1, 1, ''); 
	$mpdf->AddPage('L');
	ob_start(); 
}  /* ---------- else html ---------- */ 

?>



<table width="100%" class="table table-condensed table-bordered" border="1"
style="border-collapse:collapse;border:none;padding:2px; font-size:11px;">
	
<tr>
	<td rowspan="4" colspan="2" valign="top"><center><img src="<?php echo base_url(); ?>assets/images/logo_report.png" alt=""/></center></td>
	<td rowspan="4" colspan="2" valign="top">PT. INDOSPEC ASIA</td>
	<td colspan="<?php echo (8+$num_expense_header); ?> " valign="top"><center>Confidential</center></td>
</tr>
<tr>
	<td colspan="<?php echo (8+$num_expense_header); ?> "><center><b><?php echo $title_report; ?></b></center></td>
</tr>
<tr>
	<td colspan="<?php echo (8+$num_expense_header); ?>" valign="top">&nbsp;</td>
</tr>
<tr>
	<td colspan="<?php echo (8+$num_expense_header); ?>" valign="top">&nbsp;</td>
</tr>

<tr>
	<td colspan="2" valign="top">Prepared : <br><br><br></td>
	<td colspan="2" valign="top">Checked by : <br><br><br></td>
	<td colspan="<?php echo (8+$num_expense_header); ?>" valign="top">No : <br><br><br></td>
</tr>

<tr>
	<td colspan="4" valign="top">Approved by : <br><br>( Widi laksmono )</td>
	<td colspan="3" valign="top">Date : <br><br><br></td>
	<td colspan="3" valign="top">Rev : <br><br><br></td>
	<td colspan="<?php echo (2+$num_expense_header); ?>" valign="top">File : <br><br><br></td>
</tr>

	<tr>
	<td rowspan="2" width="30px" align="center" style="background-color: #95a5a6;color: #fff;">No</td>
	<td rowspan="2" align="center" style="background-color: #95a5a6;color: #fff;">No. Request</td>
	<td rowspan="2" align="center" style="background-color: #95a5a6;color: #fff;">Courier / Driver / External</td>
	<td rowspan="2" align="center" style="background-color: #95a5a6;color: #fff;" width="80px">Date</td>
	<td colspan="2" align="center" style="background-color: #95a5a6;color: #fff;">Purpose</td>
	<td rowspan="2" align="center" style="background-color: #95a5a6;color: #fff;">Project Number</td>
	<td colspan="2" align="center" style="background-color: #95a5a6;color: #fff;">Requestor</td>
	<td rowspan="2" align="center" style="background-color: #95a5a6;color: #fff;">Vehicle Number</td>
	<td colspan="<?php echo $num_expense_header; ?>" align="center" style="background-color: #95a5a6;color: #fff;">Expense Courier & Driver</td>
	<td rowspan="2" align="center" style="background-color: #95a5a6;color: #fff;">Total</td>
	<td rowspan="2" align="center" style="background-color: #95a5a6;color: #fff;">IOS</td>
	</tr>
	
	<tr>
	<td align="center" style="background-color: #95a5a6;color: #fff;">Destination</td>
	<td align="center" style="background-color: #95a5a6;color: #fff;">Purpose</td>
	<td align="center" style="background-color: #95a5a6;color: #fff;">Name</td>
	<td align="center" style="background-color: #95a5a6;color: #fff;">Department</td>
	<?php
		foreach($result_data_expense_header as $data_th){
			echo'<td align="center" style="background-color: #95a5a6;color: #fff;">'.$data_th->name.'</td>';
		}
	?>
	</tr>
	

	
<tbody class="my-table-body">
	<?php  
	$no = 1;
	$grandtotal_driver = 0;
	$grandtotal_courier = 0;	
	
	if($num_data_driver > 0){
		foreach($result_data_driver as $data_driver){
				
			echo'<tr>';
				echo'<td valign="top" style="font-size:11px">'.$no.'</td>';
				echo'<td valign="top" style="font-size:11px">'.xxs_filter($data_driver->no_request).'</td>';
				echo'<td valign="top" style="font-size:11px">';
					if($data_driver->driver > 0) { echo xxs_filter($data_driver->driver_name); }
						elseif($data_driver->external > 0) { echo xxs_filter($data_driver->external_name); }
				echo'</td>';
				echo'<td valign="top" style="font-size:11px">'.(xxs_filter($data_driver->start_date)).'</td>';
				echo'<td valign="top" style="font-size:10px">'.xxs_filter(text_br($data_driver->destination)).'</td>';
				echo'<td valign="top" style="font-size:10px">'.xxs_filter(text_br($data_driver->description)).'</td>';
				echo'<td valign="top" style="font-size:11px">';
					if($data_driver->project_number > 0){
						echo xxs_filter($data_driver->project_number);
					}
				echo'</td>';
				echo'<td valign="top" style="font-size:11px">'.my_user_name($data_driver->requestor,$data_driver->requestor_email).'</td>';
				echo'<td valign="top" style="font-size:11px">'.xxs_filter($data_driver->department).'</td>';
				echo'<td valign="top" style="font-size:11px">'.xxs_filter($data_driver->car_name).'</td>';
				
				foreach($result_data_expense_header as $data_th){
				echo'<td valign="top" style="font-size:11px">';
				
					$query_petty_driver = $this->M_Report_Petty_Cash->M_Expense_Detail($data_th->id_parameter,$data_driver->id_request,1);
					if($query_petty_driver->num_rows() > 0){
						$petty_driver = $query_petty_driver->row();
						echo (xxs_filter($petty_driver->balance));
					}
				
				echo'</td>';
				}
				
				$result_total_driver = $this->M_Report_Petty_Cash->M_Expense_Total($data_driver->id_request,1)->row();
				echo'<td valign="top" style="font-size:11px">'.($result_total_driver->total).'</td>';
				echo'<td style="font-size:11px"></td>';
				
			echo'</tr>';
			
			$grandtotal_driver += $result_total_driver->total;		
			$no++;
			
			}
		}

		
	if($num_data_courier > 0){
		foreach($result_data_courier as $data_courier){
		
			echo'<tr>';			
				echo'<td valign="top" style="font-size:11px">'.$no.'</td>';
				echo'<td valign="top" style="font-size:11px">'.xxs_filter($data_courier->no_request).'</td>';
				echo'<td valign="top" style="font-size:11px">';
					if($data_courier->courier > 0) { echo xxs_filter($data_courier->courier_name); }
						if($data_courier->external > 0) { echo xxs_filter($data_courier->external_name); }
				echo'</td>';
				echo'<td valign="top" style="font-size:11px">'.(xxs_filter($data_courier->start_date)).'</td>';
				echo'<td valign="top" style="font-size:10px">'.xxs_filter(text_br($data_courier->destination)).'</td>';
				echo'<td valign="top" style="font-size:10px">'.xxs_filter(text_br($data_courier->description)).'</td>';
				echo'<td valign="top" style="font-size:11px">';
					if($data_courier->project_number > 0){
						echo xxs_filter($data_courier->project_number);
					}
				echo'</td>';
				echo'<td valign="top" style="font-size:11px">'.my_user_name($data_courier->requestor,$data_courier->requestor_email).'</td>';
				echo'<td valign="top" style="font-size:11px">'.xxs_filter($data_courier->department).'</td>';
				echo'<td valign="top" style="font-size:11px">-</td>';
				
				foreach($result_data_expense_header as $data_th){
				echo'<td valign="top" style="font-size:11px">';
				
					$query_petty_courier = $this->M_Report_Petty_Cash->M_Expense_Detail($data_th->id_parameter,$data_courier->id_request,2);
					if($query_petty_courier->num_rows() > 0){
						$petty_courier = $query_petty_courier->row();
						echo (xxs_filter($petty_courier->balance));
					}
		
				echo'</td>';
				}	
				
				$result_total_courier = $this->M_Report_Petty_Cash->M_Expense_Total($data_courier->id_request,2)->row();
				echo'<td style="font-size:11px">'.($result_total_courier->total).'</td>';
				echo'<td style="font-size:11px"></td>';
				
			echo'</tr>';
			
			$grandtotal_courier += $result_total_courier->total;		
			$no++;
			
			}
		}	
	
	
	?>
	
	<tr>
		<td align="center" colspan="10" style="font-size:11px"><b>Grand Total</b></td>
		<td align="right" colspan="<?php echo ($num_expense_header+1); ?>" style="font-size:11px"><b><?php echo ($grandtotal_driver+$grandtotal_courier); ?></b></td>
		<td></td>
	</tr>
		
</tbody>
</table>
<?php 
if($export_to == 'pdf'){
	$html = ob_get_contents(); 
	ob_end_clean();
	$mpdf->WriteHTML(utf8_encode($html));
	$mpdf->Output($title_report,'I');
	exit;
} 
?>