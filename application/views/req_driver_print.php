<?php 
defined('BASEPATH') or exit ('No direct script access allowed');
?>
<script type="text/javascript">
window.print();
</script>
<div id="my-data-table">
	<div class="container-fluid">
				
			<div class="panel panel-primary my-panel-form">
			<div class="panel-body">
			
			<center><h2><b><?php echo xxs_filter($no_request); ?></b></h2></center>
			<hr class="my-hr">
			
			<input value="<?php echo $target; ?>" type="hidden" name="input_target" id="input_target" readonly="readonly" />
			<input value="<?php echo $status; ?>" type="hidden" name="input_status" id="input_status" readonly="readonly" />
	
				<table width="100%"><tr>	
				<td valign="top" width="50%">
			
				<table width="100%">
				<tr>
				<td width="200px;">Requestor</td><td width="5px">:</td>
				<td><?php echo my_user_name($requestor,$requestor_email); ?></td>
				</tr>
				
				<tr>
				<td width="200px;">Request For</td><td width="5px">:</td>
				<td><?php echo $request_option_name; ?></td>
				</tr>

				<tr><td>Expense Purpose</td><td width="5px">:</td>
				<td>
					<?php echo $expense_purpose_name; ?>
					<?php if($project_number > 0){ echo'&nbsp;-&nbsp;'.$project_number; } ?>					
				</td>
				</tr>	
			
				<tr><td>Departure Date</td><td width="5px">:</td>
				<td>
					<?php echo $start_date; ?>&nbsp;<?php echo $start_time; ?>
					<?php if($request_option == 4){ echo'&nbsp;-&nbsp'.$finish_time; }?>
				</td>
				</tr>	
				
				<tr><td>Return Plan Date</td><td width="5px">:</td>
				<td>
					<?php echo $return_plan_date; ?>&nbsp;<?php echo $return_plan_time; ?>
				</td>
				</tr>

				<tr><td>Destination</td><td width="5px">:</td>
				<td><?php echo text_br($destination); ?></td>
				</tr>

				<tr><td>Description</td><td width="5px">:</td>
				<td><?php echo text_br($description); ?></td>
				</tr>
				
				<tr><td>Comment</td><td width="5px">:</td>
				<td><?php echo text_br($comment); ?></td>
				</tr>
				
				</table>
					
				</td><!-- col-sm-6 -->				
				<td valign="top">
				
				<table width="100%">
				
				<?php if(desid_get($driver) > 0) { ?>
				<tr><td>Driver</td><td width="5px">:</td>
				<td><?php echo $driver_name; ?></td>
				</tr>
				<?php } ?>
				
				<?php if(desid_get($car) > 0) { ?>
				<tr><td>Car</td><td width="5px">:</td>
				<td><?php echo $car_name; ?></td>
				</tr>
				<?php } ?>
				
				<?php if(desid_get($external) > 0) { ?>
				<tr><td>External</td><td width="5px">:</td>
				<td><?php echo $external_name; ?></td>
				</tr>
				<?php } ?>
				
				<tr><td width="200px;">Starting Kilometers</td><td width="5px">:</td>
				<td>
					<?php if($begin_km > 0){echo $begin_km.' (Km)';}else{echo'...........(Km)';} ?>
				</td>
				</tr>
				
				<tr><td>Final Kilometers</td><td width="5px">:</td>
				<td>
					<?php if($end_km > 0){echo $end_km.' (Km)';}else{echo'...........(Km)';} ?>
				</td>
				</tr>
				
				<?php if($request_option <=3 ){ ?>
				<tr><td>Return Actual Date</td><td width="5px">:</td>
				<td>
					<?php 
					if($finish_date != '' && $finish_time != ''){
					echo $finish_date.'&nbsp;'.$finish_time;
					} ?>
				</td>
				</tr>
				<?php } ?>
				
				<tr><td>Status</td><td width="5px">:</td>
				<td><?php echo status_transaction($status); ?></td>
				</tr>
				
				</table>
				
				
				</td><!-- col-sm-6 -->
				</tr></table><!-- row -->
				<?php if($num_expense > 0) { 
				echo'<table width="60%" border="1" >
					<thead>
						<tr class="my-bg-gradation" width="30px">
							<td class="my-gradation my-th-label" align="center">No</td>
							<td class="my-gradation my-th-label" align="center">Type</td>
							<td class="my-gradation my-th-label" align="center">Balance</td>
						</tr>
					</thead>';
				
						$no = 1;
						$total = 0;
						foreach($expense as $dte) { 
							
							echo'<tr>
							<td valign="top" align="center"  width="30px">'.$no.'</td>
							<td>'.$dte->name.'</td><td align="right">'.curr_ind($dte->balance).'</td>';
							echo'</tr>';
							$total += $dte->balance;
							$no++;
						}
							echo'<tr><td colspan="2"><b>Total</b></td>
							<td align="right"><b>'.curr_ind($total).'</b></td></tr>';
				
				echo'</table>';
				
				} ?>
				
				<hr class="my-hr">
				<div style="font-size:10px;">
				<?php require_once 'label_inputer.php'; ?>
				</div>
				
				</div><!-- panel-body -->
				</div><!-- panel -->		
			

				
				
		
	</div><!-- container-fluid -->
	

</div><!-- my-data-table-->

