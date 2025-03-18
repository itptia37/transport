<?php 
defined('BASEPATH') or exit ('No direct script access allowed');

$edit_form		= 0;
$edit_expense = 0;

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
	
	if($request_option == 4){ $style_time_personal = 'display:block;'; $style_return_plan = 'display:none;';}
	if($expense_purpose == 8){ $style_project_number = 'display:block;';}
	
	$input_company 			= '';
	$input_request_option 	= '';
	$input_expense_purpose 	= '';
	$input_project_number	= '';
	$input_start_date		= '';
	$input_finish_time_personal	= '';
	$input_destination		= '';
	$input_description		= '';
	$input_begin_km			= '';
	$input_end_km			= '';
	$input_file				= '';
	$btn_action				= '';
	$btn_cancel				= '';
	
if($edit_form == 1 && $status < 3){
	
	if($status <= 0){
		$btn_send			= '<button onclick="Request_DriverSubmit(&#39;send&#39;)" id="BtnSend" class="btn btn-primary btn-sm">Send</button>';	
	}else{
		$btn_send			= '';
	}
	
	$input_company 			= 'onclick="ListBoxShow(&#39;my-list-box-company&#39;,&#39;Request_Driver/Search_List_Company&#39;,&#39;ListDataCompany&#39;,&#39;input_src_company_name&#39;)"';
	$input_request_option 	= 'onclick="ListBoxShow(&#39;my-list-box-request_option&#39;,&#39;Request_Driver/Search_List_Request_Option&#39;,&#39;ListDataRequestOption&#39;,&#39;input_src_request_option_name&#39;)"';
	$input_expense_purpose 	= 'onclick="ListBoxShow(&#39;my-list-box-expense_purpose&#39;,&#39;Request_Driver/Search_List_Expense_Purpose&#39;,&#39;ListDataExpensePurpose&#39;,&#39;input_src_expense_purpose_name&#39;)"';
	$input_project_number	= '';
	$input_start_date		= 'onkeypress="ERequest_Driver(event,&#39;myinput&#39;)" onkeyup="CheckInput(&#39;input_start_date&#39;)" onmouseover="DateShow(&#39;input_start_date&#39;)"';
	$input_finish_time_personal	= 'onkeypress="ERequest_Driver(event,&#39;myinput&#39;)"';
	$input_return_plan_date		= 'onkeypress="ERequest_Driver(event,&#39;myinput&#39;)" onkeyup="CheckInput(&#39;input_return_plan_date&#39;)" onmouseover="DateShow(&#39;input_return_plan_date&#39;)"';
	$input_destination		= 'onkeyup="CheckInput(&#39;input_destination&#39;)"';
	$input_description		= 'onkeyup="CheckInput(&#39;input_description&#39;)"';
	
	$input_begin_km			= 'onkeyup="CheckNumber(&#39;input_begin_km&#39;)"';
	$input_end_km			= 'onkeyup="CheckNumber(&#39;input_end_km&#39;)"';
	
	$input_file				= '<span class="form-control input-sm"><input autocomplete="off" onchange="UploadFile(&#39;Request_Driver&#39;,&#39;LoadContent&#39;,&#39;Request_Driver/Form/Edit/'.$target.'&#39;)" type="file" name="input_file" id="input_file" /></span>';
	$btn_action				= '<button onclick="Request_DriverSubmit()" id="BtnSubmit" class="btn btn-primary btn-sm">Save</button>'.$btn_send.'
	<button onclick="LoadContent(&#39;Request_Driver/Form/Add/'.enid_get(0).'&#39;)" id="BtnReset" class="btn btn-warning btn-sm">Reset</button>';
	
	if(desid_get($target) > 0 ){
		$btn_cancel			= '<button style="float:right;" onclick="CancelBoxShow(&#39;'.xxs_filter($no_request).'&#39;)" id="BtnCancel" class="btn btn-danger btn-sm">Cancel</button>';
	}
	
	$require 				= '<span class="my-require">*</span>';
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

<div class="my-box-confirm" id="my-box-delete-attachment">
	<div class="panel panel-primary my-panel">
	<div class="panel-body">
		<center>
		<img width="50px" class="img-responsive" src="<?php echo base_url() ?>assets/images/warning.png"/>
		<input autocomplete="off" type="hidden" name="input_index_attachment" id="input_index_attachment"  readonly="readonly"/>
		<h3>Delete file <span id="DeleteNameAttachment"></span> ?</h3>
		<div class="btn-group">
			<button onclick="DeleteAttachmentProccess('Request_Driver','LoadContent','Request_Driver/Form/Edit/<?php echo $target; ?>')" class="btn btn-danger btn-sm" id="BtnSubmitDeleteAttachment">Submit</button>
			<button onclick="DeleteBoxAttachmentHide()" class="btn btn-default btn-sm">Cancel</button>
		</div>
		</center>
	</div>
	</div>
</div>

<div class="my-box-confirm" id="my-box-cancel">
	<div class="panel panel-primary my-panel">
	<div class="panel-body">
		<center>
		<img width="50px" class="img-responsive" src="<?php echo base_url() ?>assets/images/warning.png"/>
		<h3>Cancel Request <span id="CancelName"></span> ?</h3>
		<div class="btn-group">
			<button onclick="CancelProccess('Request_Driver/Cancel')" class="btn btn-danger btn-sm" id="BtnSubmitCancel">Submit</button>
			<button onclick="CancelBoxHide()" class="btn btn-default btn-sm">Cancel</button>
		</div>
		</center>
	</div>
	</div>
</div>

<div class="my-box-confirm" id="my-box-delete-expense">
	<div class="panel panel-primary my-panel">
	<div class="panel-body">
		<center>
		<img width="50px" class="img-responsive" src="<?php echo base_url() ?>assets/images/warning.png"/>
		<input autocomplete="off" type="hidden" name="input_target_new" id="input_target_new"  readonly="readonly"/>
		<input autocomplete="off" type="hidden" name="input_index_expense" id="input_index_expense"  readonly="readonly"/>
		<h3>Delete Exspense <span id="DeleteNameExpense"></span> ?</h3>
		<div class="btn-group">
			<button onclick="DeleteExpenseProccess('Request_Driver','LoadContent','Request_Driver/Form/Edit/<?php echo $target; ?>')" class="btn btn-danger btn-sm" id="BtnSubmitDeleteExpense">Submit</button>
			<button onclick="DeleteBoxExpenseHide()" class="btn btn-default btn-sm">Cancel</button>
		</div>
		</center>
	</div>
	</div>
</div>

<div id="my-data-table">
	<div class="container-fluid">
				
			<div class="panel panel-primary my-panel-form">
			<div class="panel-body">
			
			<span class="my-title"><b><span class="glyphicon glyphicon-record"></span> <?php echo $action; ?> Request Driver <span class="imp"><?php echo xxs_filter($no_request); ?></span></b></span>
			
			<!--<center><h4><b><?php //echo xxs_filter($no_request); ?></b></h4></center>-->
			<hr class="my-hr">
			
			<input autocomplete="off" value="<?php echo $target; ?>" type="hidden" name="input_target" id="input_target" readonly="readonly" />
			<input autocomplete="off" value="<?php echo $status; ?>" type="hidden" name="input_status" id="input_status" readonly="readonly" />

				<div class="row">	
				<div class="col-sm-6">
			
				<?php if(desid_get($target) > 0){ ?>
				<span class="my-fild">Requestor</span>
					<span id="label_input_requestor" class="my-fild-data">
						<span id="input_requestor" name="input_requestor" class="form-control input-sm" ><?php echo my_user_name($requestor,$requestor_email); ?></span>
					</span><div class="my-break"></div>	
				<?php } ?>				
				
				<span class="my-fild">Company <?php echo $require; ?></span>
				<span id="label_input_company" class="my-fild-data">
				<span <?php echo $input_company; ?> class="form-control input-sm" name="input_company_name" id="input_company_name" ><?php echo $company_name; ?></span>
					<!--List--->
					<input autocomplete="off" value="<?php echo $company; ?>" type="hidden" name="input_company" id="input_company" readonly="readonly"/>
					<div class="my-list-box" id="my-list-box-company" style="display:none;">
						<div class="panel panel-primary my-panel-list-box">
						<div class="panel-body my-panel-body-list-box">
							<input autocomplete="off" onkeyup="ListDataSrc('Request_Driver/Search_List_Company','ListDataCompany','input_src_company_name')" class="form-control input-sm" type="hidden" name="input_src_company_name" id="input_src_company_name" placeholder="Search..."/>
							<div id="ListDataCompany"></div>
						</div>
						</div>
					</div>
					<!--List--->
				</span><div class="my-break"></div>	
				
				<span class="my-fild">Request For <?php echo $require; ?></span>
				<span id="label_input_request_option" class="my-fild-data">
				<span <?php echo $input_request_option; ?> class="form-control input-sm" name="input_request_option_name" id="input_request_option_name" ><?php echo $request_option_name; ?></span>
					<!--List--->
					<input autocomplete="off" value="<?php echo $request_option; ?>" type="hidden" name="input_request_option" id="input_request_option" readonly="readonly"/>
					<div class="my-list-box" id="my-list-box-request_option" style="display:none;">
						<div class="panel panel-primary my-panel-list-box">
						<div class="panel-body my-panel-body-list-box">
							<input autocomplete="off" onkeyup="ListDataSrc('Request_Driver/Search_List_Request_Option','ListDataRequestOption','input_src_request_option_name')" class="form-control input-sm" type="hidden" name="input_src_request_option_name" id="input_src_request_option_name" placeholder="Search..."/>
							<div id="ListDataRequestOption"></div>
						</div>
						</div>
					</div>
					<!--List--->
				</span><div class="my-break"></div>		

				<span class="my-fild">Purpose <?php echo $require; ?></span>
				<span id="label_input_expense_purpose" class="my-fild-data">
					
					<table width="100%"><tr>
					<td>
						<span <?php echo $input_expense_purpose; ?> class="form-control input-sm" name="input_expense_purpose_name" id="input_expense_purpose_name" ><?php echo $expense_purpose_name; ?></span>
							<!--List--->
							<input autocomplete="off" value="<?php echo $expense_purpose; ?>" type="hidden" name="input_expense_purpose" id="input_expense_purpose" readonly="readonly"/>
							<div class="my-list-box" id="my-list-box-expense_purpose" style="display:none;">
								<div class="panel panel-primary my-panel-list-box">
								<div class="panel-body my-panel-body-list-box">
									<input autocomplete="off" onkeyup="ListDataSrc('Request_Driver/Search_List_Expense_Purpose','ListDataExpensePurpose','input_src_expense_purpose_name')" class="form-control input-sm" type="hidden" name="input_src_expense_purpose_name" id="input_src_expense_purpose_name" placeholder="Search..."/>
									<div id="ListDataExpensePurpose"></div>
								</div>
								</div>
							</div>
							<!--List--->
					</td><td>
						<span id="style_project_number" style="<?php echo $style_project_number; ?>">
						<span id="label_input_project_number" class="my-fild-data">
						
						
		<span onclick="ListBoxShow('my-list-box-project_number','Main_Control/Search_List_Project','ListDataProject','input_src_project_number_name')" 
		class="form-control input-sm" name="input_project_number_name" id="input_project_number_name" ><?php echo $project_number; ?></span>
			<!--List--->
			<input value="<?php echo $project_number; ?>" type="hidden" name="input_project_number" id="input_project_number" readonly="readonly"/>
			<div class="my-list-box" id="my-list-box-project_number" style="display:none;">
				<div class="panel panel-primary my-panel-list-box">
				<div class="panel-body my-panel-body-list-box">
					<input onkeyup="ListDataSrc('Main_Control/Search_List_Project','ListDataProject','input_src_project_number_name')" 
					class="form-control input-sm" type="text" name="input_src_project_number_name" id="input_src_project_number_name" 
					placeholder="Search..."/>
					<div id="ListDataProject"></div>
				</div>
				</div>
			</div>
			<!--List--->
			
							<!--input autocomplete="off" <?php //echo $input_project_number; ?> value="<?php //echo $project_number; ?>" class="form-control input-sm" type="number" name="input_project_number" id="input_project_number" placeholder="<?php //echo ph(6); ?>" / -->
						</span>
						</span>
					</td>	
					</tr></table>
				</span><div class="my-break"></div>			
			
				<span class="my-fild">Departure Date <?php echo $require; ?></span>
					<span id="label_input_start" class="my-fild-data">
				
						<table width="100%"><tr>
						<td>
							<span id="label_input_start_date" class="my-fild-data">
								<input autocomplete="off" <?php echo $input_start_date; ?> value="<?php echo $start_date; ?>" class="form-control input-sm" type="text" name="input_start_date" id="input_start_date" placeholder="<?php echo ph(5); ?>" required />
							</span>
						</td>
						
						<td width="70px">
							<span id="label_input_start_time" class="my-fild-data">
							<span class="form-control input-sm">
								<table style="margin-top:-23px">
								<tr>
									<td style="padding-bottom:6px;"><span class="my-fild">Hour</span></td><td></td>
									<td style="padding-bottom:6px;"><span class="my-fild">Minute</span></td>
								</tr>
								<tr>
								<td><select id="input_start_time_a" name="input_start_time_a" style="border:0px;">
									<?php 
									for($x=1;$x<=23;$x++){
										if($start_time_a == $x) { $selectx = 'selected'; }else{$selectx = '';}
											echo'<option value="'.$x.'" '.$selectx.'>'.sprintf('%02s'.$valx, $x).'</option>';
									}
									?>
									<option value="00">00</option>
								</select></td>
								<td>&nbsp;:&nbsp;</td>
								<td><select id="input_start_time_b" name="input_start_time_b" style="border:0px;">
									<?php 
									for($y=1;$y<=11;$y++){
										if($start_time_b == ($y*5)) { $selecty = 'selected'; }else{$selecty = '';}
											echo'<option value="'.($y*5).'" '.$selecty.'>'.sprintf('%02s'.$valy, ($y*5)).'</option>';
									}
									?>
									<option value="00">00</option>
								</select></td>
								</tr></table>
							</span>
							</span>
						</td>
						
						<td width="1px">
							<span id="style_time_personal" style="<?php echo $style_time_personal; ?>">
							<span id="label_input_finish_time_personal" class="my-fild-data">
								<span class="form-control input-sm">
									<table style="margin-top:-23px">
									<tr>
										<td style="padding-bottom:6px;"><span class="my-fild">Hour</span></td><td></td>
										<td style="padding-bottom:6px;"><span class="my-fild">Minute</span></td>
									</tr>
									<tr>
									<td><select id="input_finish_time_personal_a" name="input_finish_time_personal_a" style="border:0px;">
										<?php 
										for($x=1;$x<=23;$x++){
											if($finish_time_a == $x) { $selectx = 'selected'; }else{$selectx = '';}
												echo'<option value="'.$x.'" '.$selectx.'>'.sprintf('%02s'.$valx, $x).'</option>';
										}
										?>
										<option value="00">00</option>
									</select></td>
									<td>&nbsp;:&nbsp;</td>
									<td><select id="input_finish_time_personal_b" name="input_finish_time_personal_b" style="border:0px;">
										<?php 
										for($y=1;$y<=11;$y++){
											if($finish_time_b == ($y*5)) { $selecty = 'selected'; }else{$selecty = '';}
												echo'<option value="'.($y*5).'" '.$selecty.'>'.sprintf('%02s'.$valy, ($y*5)).'</option>';
										}
										?>
										<option value="00">00</option>
									</select></td>
									</tr></table>
								</span>
							</span>
							</span>
						</td>					
						</tr></table>
					</span><div class="my-break"></div>		
				
				<span id="style_return_plan" style="<?php echo $style_return_plan; ?>">
				<span class="my-fild">Return Plan Date <?php echo $require; ?></span>
					<span id="label_input_return_plan" class="my-fild-data">
				
						<table width="100%"><tr>
						<td>
							<span id="label_input_return_plan_date" class="my-fild-data">
								<input autocomplete="off" <?php echo $input_return_plan_date; ?> value="<?php echo $return_plan_date; ?>" class="form-control input-sm" type="text" name="input_return_plan_date" id="input_return_plan_date" placeholder="<?php echo ph(5); ?>" required />
							</span>
						</td>
						
						<td width="70px">
							<span id="label_input_return_plan_time" class="my-fild-data">
							<span class="form-control input-sm">
								<table style="margin-top:-23px">
								<tr>
									<td style="padding-bottom:6px;"><span class="my-fild">Hour</span></td><td></td>
									<td style="padding-bottom:6px;"><span class="my-fild">Minute</span></td>
								</tr>
								<tr>
								<td><select id="input_return_plan_time_a" name="input_return_plan_time_a" style="border:0px;">
									<?php 
									for($x=1;$x<=23;$x++){
										if($return_plan_time_a == $x) { $selectx = 'selected'; }else{$selectx = '';}
											echo'<option value="'.$x.'" '.$selectx.'>'.sprintf('%02s'.$valx, $x).'</option>';
									}
									?>
									<option value="00">00</option>
								</select></td>
								<td>&nbsp;:&nbsp;</td>
								<td><select id="input_return_plan_time_b" name="input_return_plan_time_b" style="border:0px;">
									<?php 
									for($y=1;$y<=11;$y++){
										if($return_plan_time_b == ($y*5)) { $selecty = 'selected'; }else{$selecty = '';}
											echo'<option value="'.($y*5).'" selecty>'.sprintf('%02s'.$valy, ($y*5)).'</option>';
									}
									?>
									<option value="00">00</option>
								</select></td>
								</tr></table>
							</span>
							</span>
						</td>				
						</tr></table>
					</span><div class="my-break"></div>		
				</span>
					


					
				</div><!-- col-sm-6 -->				
				<div class="col-sm-6">
				
				<span class="my-fild">Destination <?php echo $require; ?></span>
					<span id="label_input_destination" class="my-fild-data">
						<textarea <?php echo $input_destination; ?> id="input_destination" name="input_destination" rows="3" class="form-control input-sm" ><?php echo text_br($destination); ?></textarea>
					</span><div class="my-break"></div>	
					
				<span class="my-fild">Description <?php echo $require; ?></span>
					<span id="label_input_description" class="my-fild-data">
						<textarea <?php echo $input_description; ?> id="input_description" name="input_description" rows="3" class="form-control input-sm" ><?php echo text_br($description); ?></textarea>
					</span><div class="my-break"></div>	
					
				<!--	
				<span id="style_kilometer" style="display:none;">
				
					<span id="label_input_kilometer" class="my-fild-data">
				
						<table width="100%">
						<tr>
							<td><span class="my-fild">Starting Kilometers</span></td>
							<td><span class="my-fild">Final Kilometers</span></td>
						</tr>
						<tr>
						<td>
							<span id="label_input_begin_km" class="my-fild-data">
								<input autocomplete="off" <?php ////echo $input_begin_km; ?> value="<?php ////echo $begin_km; ?>" class="form-control input-sm" type="number" name="input_begin_km" id="input_begin_km" placeholder="<?php ////echo ph(6); ?>" required />
							</span>
						</td>
						
						<td>
							<span id="label_input_end_km" class="my-fild-data">
								<input autocomplete="off" <?php ////echo $input_end_km; ?> value="<?php ////echo $end_km; ?>" class="form-control input-sm" type="number" name="input_end_km" id="input_end_km" placeholder="<?php ////echo ph(6); ?>" required />
							</span>
						</td>				
						</tr>
						</table>
				
					</span><div class="my-break"></div>		
				</span>
				-->
				
				<span class="my-fild">Comment</span>
					<span id="label_input_comment" class="my-fild-data">
						<textarea id="input_comment" name="input_comment" rows="2" class="form-control input-sm" ><?php echo text_br($comment); ?></textarea>
					</span><div class="my-break"></div>	
					
				<?php if(desid_get($target) > 0){
					echo'<hr class="my-hr">';
					echo'<span class="my-fild">File ( pdf, png, jpg )</span>';
					echo $input_file; 
				
					if($num_attachment > 0){
					
						$no_file = 1;
						
						echo'<table>';
						
						foreach($result_attachment as $data_file){
						
							echo'<tr>';
							
							echo'<td rowspan="2" valign="top">'.$no_file++.'</td>';
							
							echo'<td><a href="'.base_url().'attachment/'.$data_file->attachment.'" 
							target="_blank" class="my-list-file-item">
							<span class="glyphicon glyphicon-file"></span> '.$data_file->attachment.'</a>
							</td>';
							
							if($status == 0 ){
							
							echo'<td rowspan="2" valign="top"><a href="#" class="my-list-file-item"
								onclick="DeleteBoxAttachmentShow(&#39;'.enid_get($data_file->id_attachment).'&#39;,&#39;'.$data_file->attachment.'&#39;)">
								<span class="glyphicon glyphicon-remove my-list-file-delete"></span></a>
								</td>';
							} 
							
							echo'</tr>';
							
							if($data_file->created_by > 0){
							
								echo '<tr><td>&nbsp;<span class="my-label">Inputed by '.$data_file->creater.' '.date_time_ind_full($data_file->created_date).'</span></td></tr>';
						
							}
							
						} /* $result_attachment */
						
						echo'</table>';
						
					}else{ echo '<i><br>No Attachment</i>'; } /* if($num_attachment > 0) */
				}
				?>				
				
				
				</div><!-- col-sm-6 -->
				</div><!-- row -->
				
				<?php require_once 'req_expense.php'; ?>
				
				<?php echo $btn_cancel; ?>		
				
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
		
		<?php echo $btn_action; ?>
		<?php if(desid_get($target) > 0){ ?>
		<a href="<?php echo base_url() ?>Request_Driver/Form/Print/<?php echo $target ?>" target="_blank" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-print"></span></a>
		<?php } ?>
		<button onClick="SubmenuSelect('Request_Driver','Request_Driver/Back')" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-menu-left"></span> Back</button>
		</div>
		</div>

	</div>