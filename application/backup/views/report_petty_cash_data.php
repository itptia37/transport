<?php 
defined('BASEPATH') or exit ('No direct script access allowed');
?>

<div class="my-tools-box">
<div class="container-fluid">
<div class="row">
<div class="col-sm-8 my-tools-box-col">

	<div class="btn-group">
	
	<span onclick="CompanyBoxShow()" class="btn btn-success btn-sm"><span id="company_name"><?php echo $company_name; ?></span> <span class="my-filter my-glyphicon glyphicon glyphicon-filter"></span></span>
	
	<div id="my-company-box" style="display:none;" >
		<?php foreach($result_company as $data_company){ ?>
			<li onclick="LoadDataTable('Report_Petty_Cash/Petty_Company/<?php echo enid_get($data_company->id_parameter); ?>')" >
			<a href="#"><?php echo $data_company->name; ?></a></li>
		<?php } ?>
	</div>
	
	<span onclick="PettyBoxShow()" class="btn btn-success btn-sm"><span id="petty_name"><?php echo $petty_name; ?></span> <span class="my-filter my-glyphicon glyphicon glyphicon-filter"></span></span>
	
	<div id="my-petty-box" style="display:none;" >
		<li onclick="LoadDataTable('Report_Petty_Cash/Petty_General')">
		<a href="#">ALL</a></li>
		
		<li onclick="LoadDataTable('Report_Petty_Cash/Petty_Driver')" >
		<a href="#">DRIVER</a></li>
		
		<li onclick="LoadDataTable('Report_Petty_Cash/Petty_Courier')" >
		<a href="#">COURIER</a></li>
		
		<li onclick="LoadDataTable('Report_Petty_Cash/Petty_Gs')" >
		<a href="#">POSTING GS</a></li>
		
		<li onclick="LoadDataTable('Report_Petty_Cash/Petty_To')" >
		<a href="#">POSTING TO</a></li>
		
		<li onclick="LoadDataTable('Report_Petty_Cash/Petty_Tc')">
		<a href="#">POSTING T&C </a></li>
	</div>
	
	
	<span class="btn btn-primary btn-sm">Count : <span id="my-count"><?php echo $num_data_driver+$num_data_courier; ?></span></span>
		
	<span onclick="ExportBoxShow()" class="btn btn-primary btn-sm">Export : <span id="SelectedRow"><?php echo ($num_marked_driver+$num_marked_courier); ?></span></span>
	
		<div id="my-export-box" style="display:none;" >
		<li><a target="_blank" href="<?php echo base_url(); ?>Report_Petty_Cash/Export/html">Html</a></li>
		<li><a target="_blank" href="<?php echo base_url(); ?>Report_Petty_Cash/Export/excel">Ms. Excel</a></li>
		<li><a target="_blank" href="<?php echo base_url(); ?>Report_Petty_Cash/Export/word">Ms. Word</a></li>
		<li><a target="_blank" href="<?php echo base_url(); ?>Report_Petty_Cash/Export/pdf">PDF</a></li>
		</div>
		
	</div>
	
</div>
<div class="col-sm-4 my-tools-box-col">

	<div id="my-page-top">
		<ul class="pagination">			
		</ul>
	</div>
	
</div><!-- col-->
</div><!-- row -->
</div><!-- container-->
</div><!-- tools-box -->

	
	<?php 
	$num_marked_driver_new = 0;
	$num_marked_courier_new = 0;
	if($filter_b != 1){$num_marked_driver_new = $num_marked_driver;}
	if($filter_a != 1){$num_marked_courier_new = $num_marked_courier;}
	
	$num_mark = $num_marked_driver_new+$num_marked_courier_new;
	
	if(($num_mark) > 0) {
		$style_mark_all_off = 'style="display:none;"';
		$style_mark_all_on = 'style="display:block;"';
	}else{
		$style_mark_all_off = 'style="display:block;"';
		$style_mark_all_on = 'style="display:none;"';
		
	}
	?>
	
<table class="table table-condensed table-bordered" style="font-size:11px">
<thead>
	<tr>
	<td rowspan="2" width="30px" class="my-gradation my-th-label">
		<span id="my-mark-all-off" <?php echo $style_mark_all_off; ?>>
			<span onclick="MarkAllReq(1)" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus"></span></span>
		</span>
		<span id="my-mark-all-on" <?php echo $style_mark_all_on; ?>>
			<span onclick="MarkAllReq(0)" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-minus"></span></span>
		</span>
	</td>
	<td rowspan="2" width="30px" class="my-gradation my-th-label">No</td>
	<td rowspan="2" class="my-gradation my-th-label">No. Request</td>
	<td rowspan="2" class="my-gradation my-th-label">Courier / Driver / External</td>
	<td rowspan="2" class="my-gradation my-th-label" width="80px">Date</td>
	<td colspan="2" class="my-gradation my-th-label">Purpose</td>
	<td rowspan="2" class="my-gradation my-th-label">Project Number</td>
	<td colspan="2" class="my-gradation my-th-label">Requestor</td>
	<td rowspan="2" class="my-gradation my-th-label">Vehicle Number</td>
	<td colspan="<?php echo $num_expense_header; ?>" class="my-gradation my-th-label">Expense Courier & Driver</td>
	<td rowspan="2" class="my-gradation my-th-label">Total</td>
	</tr>
	
	<tr>
	<td class="my-gradation my-th-label">Destination</td>
	<td class="my-gradation my-th-label">Purpose</td>
	<td class="my-gradation my-th-label">Name</td>
	<td class="my-gradation my-th-label">Department</td>
	<?php
		foreach($result_data_expense_header as $data_th){
			echo'<td class="my-gradation my-th-label">'.$data_th->name.'</td>';
		}
	?>
	</tr>
</thead>
<tbody class="my-table-body" >
	<?php  
	$no = 1;
	$grandtotal_driver = 0;
	$grandtotal_courier = 0;
	
	if($filter_b != 1){		
	
	if($num_data_driver > 0){
		foreach($result_data_driver as $data_driver){
		
			if($data_driver->id_mark > 0){
				$style_mark_off = 'style="display:none;"';
				$style_mark_on  = '';
			}else{
				$style_mark_off = '';
				$style_mark_on  = 'style="display:none;"';
			}
		
			echo'<tr onclick="SelectRowNormal('.$no.')" id="my-tr'.$no.'" class="my-tr" >';
			
			echo'<td valign="top" align="center">
				<span class="my-mark-off" id="my-mark-off'.$no.'" '.$style_mark_off.'>
				<span onclick="MarkReq(&#39;'.enid_get($data_driver->id_request).'&#39;,'.$no.',1,1)" 
				class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus"></span></span>
				</span>
				<span class="my-mark-on" id="my-mark-on'.$no.'" '.$style_mark_on.'>
				<span onclick="MarkReq(&#39;'.enid_get($data_driver->id_request).'&#39;,'.$no.',0,1)" 
				class="btn btn-success btn-xs"><span class="glyphicon glyphicon-minus"></span></span>
				</span>				
			</td>';
			
				echo'<td style="font-size:11px">'.$no.'</td>';
				echo'<td style="font-size:11px">'.xxs_filter($data_driver->no_request).'</td>';
				echo'<td style="font-size:11px">';
					if($data_driver->driver > 0) { echo xxs_filter($data_driver->driver_name); }
					else if($data_driver->external > 0) { echo xxs_filter($data_driver->external_name); }
				echo'</td>';
				
				echo'<td style="font-size:11px">'.date_ind(xxs_filter($data_driver->start_date)).'</td>';
				echo'<td style="font-size:10px">'.xxs_filter(text_br($data_driver->destination)).'</td>';
				echo'<td style="font-size:10px">'.xxs_filter(text_br($data_driver->description)).'</td>';
				echo'<td style="font-size:11px">';
					if($data_driver->project_number > 0){
						echo xxs_filter($data_driver->project_number);
					}
				echo'</td>';
				echo'<td style="font-size:11px">'.my_user_name($data_driver->requestor,$data_driver->requestor_email).'</td>';
				echo'<td style="font-size:11px">'.xxs_filter($data_driver->department).'</td>';
				echo'<td style="font-size:11px">'.xxs_filter($data_driver->car_name).'</td>';
				
				foreach($result_data_expense_header as $data_th){
				echo'<td align="right">';
				
					$query_petty_driver = $this->M_Report_Petty_Cash->M_Expense_Detail($data_th->id_parameter,$data_driver->id_request,1);
					if($query_petty_driver->num_rows() > 0){
						$petty_driver = $query_petty_driver->row();
						echo curr_ind(xxs_filter($petty_driver->balance));
					}
				
				echo'</td>';
				}				
				
				$result_total_driver = $this->M_Report_Petty_Cash->M_Expense_Total($data_driver->id_request,1)->row();
				echo'<td align="right">'.curr_ind($result_total_driver->total).'</td>';
				
			echo'</tr>';
			
			$grandtotal_driver += $result_total_driver->total;
			$no++;
			
			}
		}
	}
	
	if($filter_a != 1){
		
	if($num_data_courier > 0){
		foreach($result_data_courier as $data_courier){
		
			if($data_courier->id_mark > 0){
				$style_mark_off = 'style="display:none;"';
				$style_mark_on  = '';
			}else{
				$style_mark_off = '';
				$style_mark_on  = 'style="display:none;"';
			}
		
			echo'<tr onclick="SelectRowNormal('.$no.')" id="my-tr'.$no.'" class="my-tr" >';
			
			echo'<td valign="top" align="center">
				<span class="my-mark-off" id="my-mark-off'.$no.'" '.$style_mark_off.'>
				<span onclick="MarkReq(&#39;'.enid_get($data_courier->id_request).'&#39;,'.$no.',1,2)" 
				class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus"></span></span>
				</span>
				<span class="my-mark-on" id="my-mark-on'.$no.'" '.$style_mark_on.'>
				<span onclick="MarkReq(&#39;'.enid_get($data_courier->id_request).'&#39;,'.$no.',0,2)" 
				class="btn btn-success btn-xs"><span class="glyphicon glyphicon-minus"></span></span>
				</span>				
			</td>';
			
				echo'<td style="font-size:11px">'.$no.'</td>';
				echo'<td style="font-size:11px">'.xxs_filter($data_courier->no_request).'</td>';
				echo'<td style="font-size:11px">';
					if($data_courier->courier > 0) { echo xxs_filter($data_courier->courier_name); }
					else if($data_courier->external > 0) { echo xxs_filter($data_courier->external_name); }
				echo'</td>';
				
				echo'<td style="font-size:11px">'.date_ind(xxs_filter($data_courier->start_date)).'</td>';
				echo'<td style="font-size:10px">'.xxs_filter(text_br($data_courier->destination)).'</td>';
				echo'<td style="font-size:10px">'.xxs_filter(text_br($data_courier->description)).'</td>';
				echo'<td style="font-size:11px">';
					if($data_courier->project_number > 0){
						echo xxs_filter($data_courier->project_number);
					}
				echo'</td>';
				echo'<td style="font-size:11px">'.my_user_name($data_courier->requestor,$data_courier->requestor_email).'</td>';
				echo'<td style="font-size:11px">'.xxs_filter($data_courier->department).'</td>';
				echo'<td style="font-size:11px">-</td>';
				
				foreach($result_data_expense_header as $data_th){
				echo'<td align="right">';
				
					$query_petty_courier = $this->M_Report_Petty_Cash->M_Expense_Detail($data_th->id_parameter,$data_courier->id_request,2);
					if($query_petty_courier->num_rows() > 0){
						$petty_courier = $query_petty_courier->row();
						echo curr_ind(xxs_filter($petty_courier->balance));
					}
		
				echo'</td>';
				}	
				
				$result_total_courier = $this->M_Report_Petty_Cash->M_Expense_Total($data_courier->id_request,2)->row();
				echo'<td align="right">'.curr_ind($result_total_courier->total).'</td>';
				
			echo'</tr>';
			
			$grandtotal_courier += $result_total_courier->total;
			$no++;
			
			}
		}	
	}
	
	?>	
	
	<tr>
		<td align="center" colspan="13"><b>Grand Total</b></td>
		<td align="right" colspan="<?php echo $num_expense_header+1; ?>"><b><?php echo curr_ind($grandtotal_driver+$grandtotal_courier); ?></b></td>
	</td>
	
</tbody>
</table>
<?php 
if(($num_mark) > 0) {$style_proccess = 'display:block';}else{$style_proccess = 'display:none';}	
?>
<button id="BtnSubmitProccess" style="<?php echo $style_proccess; ?>" onclick="ConfirmBoxShow()" class="btn btn-primary btn-sm">Proccess Data : <span id="SelectedRowBottom"><?php echo ($num_marked_driver+$num_marked_courier); ?></span></button>


<br><br><br><br><br><br><br><br><br><br><br>

<div class="my-tools-box-bottom" style="display:none;">
	<div class="my-action-bottom" style="display:none;">
		<span id="SelectedRowIndexData" style="display:none;"></span>
		<span id="SelectedRowNameData" style="display:none;"></span>
		<span id="BtnEdit" style="display:none;"></span>
		<span id="BtnDelete" style="display:none;"></span>		
	</div><!-- my-action-bottom -->
</div><!-- tools-box-bottom -->