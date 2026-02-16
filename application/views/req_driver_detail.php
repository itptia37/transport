<?php 
defined('BASEPATH') or exit ('No direct script access allowed');

$edit_form		= 0;
$edit_expense 	= 0;

if($this->session->userdata('access_tr') == 25 || $this->session->userdata('access_tr') == 26){
	$edit_expense = 1;
}

if($this->session->userdata('access_tr') == 24 && $status <= 0){
	$edit_form	= 1;
}elseif($edit_expense == 1 && $status >= 0){
	$edit_form	= 1;
}


	$target_control			= 'Request_Driver';
	$require 				= '';
	$style_time_personal 	= 'display:none;';
	$style_project_number 	= 'display:none;"';
	$style_return_plan 		= 'display:block;"';
	$style_driver 			= 'display:none;"';
	$style_car 				= 'display:none;"';
	$style_external			= 'display:none;"';
	$style_finish			= 'display:block;"';
	
	if($request_option == 4){ $style_time_personal = 'display:block;'; $style_finish = 'display:none;'; $style_return_plan = 'display:none;'; }
	if($expense_purpose == 8){ $style_project_number = 'display:block;';}
	
	if($request_option == 1){$style_driver = 'display:block;'; $style_car = 'display:block;'; $style_external = 'display:block;';}
	elseif($request_option == 2){$style_driver = 'display:block;'; $style_external = 'display:block;';}
	elseif($request_option == 3){$style_car = 'display:block;'; $style_external = 'display:block;';}
	
	if($status >= 3 && desid_get($driver) <= 0){
		$style_driver 		= 'display:none;"';
	}
	if($status >= 3 && desid_get($car) <= 0){
		$style_car 			= 'display:none;"';
	}
	if($status >= 3 && desid_get($external) <= 0){
		$style_external		= 'display:none;"';
	}

?>

<div id="my-breadcrumb">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
	<?php echo $set_menu; ?>
	<?php echo $set_submenu; ?>
	<?php echo $set_action; ?>
  </ol>
</nav>	
</div>

<div id="my-data-table">
	<div class="container-fluid">
				
			<div class="panel panel-primary my-panel-form">
			<div class="panel-body">
			
			<span class="my-title"><b><span class="glyphicon glyphicon-record"></span> Detail Request Driver</b></span>
			
			<center><h4><b><?php echo xxs_filter($no_request); ?></b></h4></center>
			<hr class="my-hr">
			
			<input value="<?php echo $target; ?>" type="hidden" name="input_target" id="input_target" readonly="readonly" />
			<input value="<?php echo $status; ?>" type="hidden" name="input_status" id="input_status" readonly="readonly" />
	
				<div class="row">	
				<div class="col-sm-6">
		
				<span class="my-fild">Requestor</span>
				<span id="label_input_requestor" class="my-fild-data">
				<br><span name="input_requestor" id="input_requestor" ><?php echo my_user_name($requestor,$requestor_email); ?></span>
					</span><hr class="my-hr">
					
				<span class="my-fild">Request For</span>
				<span id="label_input_request_option" class="my-fild-data">
				<br><span name="input_request_option_name" id="input_request_option_name" ><?php echo $request_option_name; ?></span>
					</span><hr class="my-hr">

				<span class="my-fild">Expense Purpose</span>
				<span id="label_input_expense_purpose" class="my-fild-data">
					
					<table width="100%"><tr>
					<td>
						<span name="input_expense_purpose_name" id="input_expense_purpose_name" ><?php echo $expense_purpose_name; ?></span>
							<?php if($project_number > 0){echo '&nbsp;-&nbsp;'.$project_number; } ?>
					</td>
					</tr></table>					
				</span><hr class="my-hr">		
			
				<span class="my-fild">Departure Date</span>
					<span id="label_input_start" class="my-fild-data">
				
						<table><tr>
						<td>
							<span id="label_input_start_date" class="my-fild-data">
								<span name="input_start_date" id="input_start_date" ><?php echo $start_date; ?></span>
							</span>
						</td>
						
						<td>
							<span id="label_input_start_time" class="my-fild-data">
								<span name="input_start_time" id="input_start_time" >&nbsp;<?php echo $start_time; ?></span>
							</span>
						</td>
						
						<td>
							<span id="style_time_personal" style="<?php echo $style_time_personal; ?>">
							<span id="label_input_finish_time_personal" class="my-fild-data">
								<span name="input_finish_time_personal" id="input_finish_time_personal" ><?php if($finish_time != ''){ echo '&nbsp;-&nbsp;'.$finish_time; } ?></span>
							</span>
							</span>
						</td>					
						</tr></table>				
					</span><hr class="my-hr">
					
					<span id="style_return_plan" style="<?php echo $style_return_plan; ?>">
					<span class="my-fild">Return Plan</span>
					<span id="label_input_return_plan" class="my-fild-data">
				
						<table><tr>
						<td>
							<span id="label_input_return_plan_date" class="my-fild-data">
								<span name="input_return_plan_date" id="input_return_plan_date" ><?php echo $return_plan_date; ?></span>
							</span>
						</td>
						
						<td>
							<span id="label_input_return_plan_time" class="my-fild-data">
								<span name="input_return_plan_time" id="input_return_plan_time" >&nbsp;<?php echo $return_plan_time; ?></span>
							</span>
						</td>
				
						</tr></table>
					</span>
					</span>
					
				<span class="my-fild">Destination</span>
					<span id="label_input_destination" class="my-fild-data">
						<br><span id="input_destination" name="input_destination" ><?php echo text_br($destination); ?></span>
					</span><hr class="my-hr">

				<span class="my-fild">Description</span>
					<span id="label_input_description" class="my-fild-data">
						<br><span id="input_description" name="input_description" ><?php echo text_br($description); ?></span>
					</span><hr class="my-hr">
				
				<span class="my-fild">Comment</span>
					<span id="label_input_comment" class="my-fild-data">
						<br><span id="input_comment" name="input_comment" ><?php echo text_br($comment); ?></span>
					</span><br>
					
				</div><!-- col-sm-6 -->				
				<div class="col-sm-6">
				
				<?php if(desid_get($driver) > 0) { ?>
				<span id="style_driver" style="<?php echo $style_driver; ?>">
				<span class="my-fild">Driver</span>
				<span id="label_input_driver" class="my-fild-data">
					<br><span name="input_driver_name" id="input_driver_name" ><?php echo $driver_name; ?></span>					
				</span><hr class="my-hr">
				</span>
				<?php } ?>
				
				<?php if(desid_get($car) > 0) { ?>
				<span id="style_car" style="<?php echo $style_car; ?>">
				<span class="my-fild">Car</span>
				<span id="label_input_car" class="my-fild-data">
					<br><span name="input_car_name" id="input_car_name" ><?php echo $car_name; ?></span>					
				</span><hr class="my-hr">
				</span>
				<?php } ?>
				
				<?php if(desid_get($external) > 0) { ?>
				<span id="style_external" style="<?php echo $style_external; ?>">
				<span class="my-fild">External </span>
				<span id="label_input_external" class="my-fild-data">
					<br><span name="input_external_name" id="input_external_name" ><?php echo $external_name; ?></span>					
				</span><hr class="my-hr">
				</span>
				<?php } ?>
				
				
				<span class="my-fild">Starting Kilometers </span>
				<span id="label_input_starting_kilometers" class="my-fild-data">
					<br><span name="input_starting_kilometers" id="input_starting_kilometers" ><?php if($begin_km > 0){echo $begin_km.' (Km)';}else{echo'...........(Km)';} ?></span>					
				</span><hr class="my-hr">
				
				<span class="my-fild">Final Kilometers </span>
				<span id="label_input_starting_kilometers" class="my-fild-data">
					<br><span name="input_starting_kilometers" id="input_starting_kilometers" ><?php if($end_km > 0){echo $end_km.' (Km)';}else{echo'...........(Km)';} ?></span>	
				</span><hr class="my-hr">
				
				<span id="style_finish" style="<?php echo $style_finish; ?>">
				<span class="my-fild">Return Actual Date</span>
					<span id="label_input_finish" class="my-fild-data">
						<?php if($finish_date != '' && $finish_time != ''){ ?>
						<table><tr>
						<td>
							<span id="label_input_finish_date" class="my-fild-data">
								<span name="input_finish_date" id="input_finish_date" ><?php echo $finish_date; ?></span>
							</span>
						</td>
						
						<td>
							<span id="label_input_finish_time" class="my-fild-data">
								<span name="input_finish_time" id="input_finish_time" >&nbsp;<?php echo $finish_time; ?></span>
							</span>
						</td>				
						</tr></table>
						<?php } ?>
					</span><hr class="my-hr">
				</span>
				
				<span class="my-fild">Status </span>
				<span id="label_input_status" class="my-fild-data">
					<br><span name="input_status" id="input_status" ><?php echo status_transaction($status); ?></span>	
				</span><hr class="my-hr">
				
				<?php if(desid_get($target) > 0){
					echo'<span class="my-fild">File ( pdf, png, jpg )</span>';
					
				} 
				
				if($num_attachment > 0){
				
					$no_file = 1;
					
					echo'<table>';
					
					foreach($result_attachment as $data_file){
					
						echo'<tr>';
						
						echo'<td rowspan="2" valign="top">'.$no_file++.'</td>';
						
						// echo'<td><a href="'.base_url().'attachment/'.$data_file->attachment.'" 
						// target="_blank" class="my-list-file-item">
						// <span class="glyphicon glyphicon-file"></span> '.$data_file->attachment.'</a>
						// </td>';
						echo'<td><a href="attachment/'.$data_file->attachment.'" 
						target="_blank" class="my-list-file-item">
						<span class="glyphicon glyphicon-file"></span> '.$data_file->attachment.'</a>
						</td>';
						
						echo'</tr>';
						
						if($data_file->created_by > 0){
						
							echo '<tr><td>&nbsp;<span class="my-label">Inputed by '.$data_file->creater.' '.date_time_ind_full($data_file->created_date).'</span></td></tr>';
					
						}
						
					} /* $result_attachment */
					
					echo'</table>';
					
				}else{ echo '<i><br>No Attachment</i>'; } /* if($num_attachment > 0) */
				
				?>				
				
				
				</div><!-- col-sm-6 -->
				</div><!-- row -->
				
				<?php require_once 'req_expense.php'; ?>
				
				<hr class="my-hr">
				<?php require_once 'label_inputer.php'; ?>
				
				</div><!-- panel-body -->
				</div><!-- panel -->		
			

				
				
		
	</div><!-- container-fluid -->
	

</div><!-- my-data-table-->

<br><br><br>

	<div class="my-tools-box-bottom">
	
		<div class="my-action-bottom">
		<div class="btn-group">
		<a href="<?php echo base_url() ?>Request_Driver/Form/Print/<?php echo $target ?>" target="_blank" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-print"></span></a>
		<button onClick="SubmenuSelect('Request_Driver','Request_Driver/Back')" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-menu-left"></span> Back</button>
		</div>
		</div>

	</div>