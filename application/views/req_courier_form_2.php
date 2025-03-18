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


	$target_control			= 'Request_Courier';
	$require 				= '';
	$style_time_personal 	= 'display:none;';
	$style_project_number 	= 'display:none;"';
	$style_courier 			= 'display:block;"';
	$style_external			= 'display:block;"';
	$style_departur 		= 'display:block;"';
	$style_return	 		= 'display:block;"';
	$style_delivery 		= 'display:block;"';
	$style_finish			= 'display:block;"';
	
	if($request_option == 6){ $style_time_personal = 'display:block;'; $style_finish = 'display:none;'; }
	if($expense_purpose == 8){ $style_project_number = 'display:block;';}
		
	if($status >= 3 && desid_get($courier) <= 0){
		$style_courier 		= 'display:none;"';
	}
	if($status >= 3 && desid_get($external) <= 0){
		$style_external		= 'display:none;"';
	}
	if($status >= 3 && desid_get($departur) <= 0){
		$style_departur 	= 'display:none;"';
	}
	if($status >= 3 && desid_get($return) <= 0){
		$style_return 		= 'display:none;"';
	}
	if($status >= 3 && desid_get($delivery) <= 0){
		$style_delivery 	= 'display:none;"';
	}
	
	$input_company 			= '';
	$input_request_option 	= '';
	$input_expense_purpose 	= '';
	$input_project_number	= '';
	$input_start_date		= '';
	$input_start_time		= '';
	$input_finish_time_personal	= '';
	$input_destination		= '';
	$input_description		= '';
	$input_file				= '';
	$btn_action				= '';
	$btn_cancel				= '';
	$input_courier			= '';
	$input_external			= '';
	$input_departur			= '';
	$input_return			= '';
	$input_delivery			= '';
	
	$input_finish_date		= '';
	$input_finish_time		= '';
	
if($edit_form == 1 && $status < 3){
	
	$input_company 			= 'onclick="ListBoxShow(&#39;my-list-box-company&#39;,&#39;Request_Courier/Search_List_Company&#39;,&#39;ListDataCompany&#39;,&#39;input_src_company_name&#39;)"';
	$input_request_option 	= 'onclick="ListBoxShow(&#39;my-list-box-request_option&#39;,&#39;Request_Courier/Search_List_Request_Option&#39;,&#39;ListDataRequestOption&#39;,&#39;input_src_request_option_name&#39;)"';
	$input_expense_purpose 	= 'onclick="ListBoxShow(&#39;my-list-box-expense_purpose&#39;,&#39;Request_Courier/Search_List_Expense_Purpose&#39;,&#39;ListDataExpensePurpose&#39;,&#39;input_src_expense_purpose_name&#39;)"';
	$input_project_number	= '';
	$input_start_date		= 'onkeypress="ERequest_Courier(event,&#39;myinput&#39;)" onkeyup="CheckInput(&#39;input_start_date&#39;)" onmouseover="DateShow(&#39;input_start_date&#39;)"';
	$input_start_time		= '';
	$input_finish_time_personal	= 'onkeypress="ERequest_Courier(event,&#39;myinput&#39;)"';
	$input_destination		= 'onkeyup="CheckInput(&#39;input_destination&#39;)"';
	$input_description		= 'onkeyup="CheckInput(&#39;input_description&#39;)"';
	
	
	$input_courier 			= 'onclick="ListBoxShowCheck(&#39;my-list-box-courier&#39;,&#39;Request_Courier/Search_List_Courier&#39;,&#39;ListDataCourier&#39;,&#39;input_src_courier_name&#39;,&#39;input_external&#39;,&#39;External&#39;)"';
	$input_external 		= 'onclick="ListBoxShowCheck(&#39;my-list-box-external&#39;,&#39;Request_Courier/Search_List_External&#39;,&#39;ListDataExternal&#39;,&#39;input_src_external_name&#39;,&#39;input_courier&#39;,&#39;Courier&#39;)"';
	$input_departur 		= 'onclick="ListBoxShow(&#39;my-list-box-departur&#39;,&#39;Request_Courier/Search_List_Departur&#39;,&#39;ListDataDepartur&#39;,&#39;input_src_departur_name&#39;)"';
	$input_return 			= 'onclick="ListBoxShow(&#39;my-list-box-return&#39;,&#39;Request_Courier/Search_List_Return&#39;,&#39;ListDataReturn&#39;,&#39;input_src_return_name&#39;)"';
	$input_delivery 		= 'onclick="ListBoxShow(&#39;my-list-box-delivery&#39;,&#39;Request_Courier/Search_List_Delivery&#39;,&#39;ListDataDelivery&#39;,&#39;input_src_delivery_name&#39;)"';
	
	$input_finish_date		= 'onkeypress="ERequest_Courier(event,&#39;myinput&#39;)" onkeyup="CheckInput(&#39;input_finish_date&#39;)" onmouseover="DateShow(&#39;input_finish_date&#39;)"';
	$input_finish_time		= '';
	
	$input_file				= '<span class="form-control input-sm"><input autocomplete="off" onchange="UploadFile(&#39;Request_Courier&#39;,&#39;LoadContent&#39;,&#39;Request_Courier/Form/Edit/'.$target.'&#39;)" type="file" name="input_file" id="input_file" /></span>';
 
	$btn_action				= '<button onclick="Request_CourierSubmit()" id="BtnSubmit" class="btn btn-primary btn-sm">Save</button>
	<button onclick="LoadContent(&#39;Request_Courier/Form/Add/'.enid_get(0).'&#39;)" id="BtnReset" class="btn btn-warning btn-sm">Reset</button>';
	
	$btn_cancel				= '<button style="float:right;" onclick="CancelBoxShow(&#39;'.xxs_filter($no_request).'&#39;)" id="BtnCancel" class="btn btn-danger btn-sm">Cancel</button>';
	
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
			<button onclick="DeleteAttachmentProccess('Request_Courier','LoadContent','Request_Courier/Form/Edit/<?php echo $target; ?>')" class="btn btn-danger btn-sm" id="BtnSubmitDeleteAttachment">Submit</button>
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
			<button onclick="CancelProccess('Request_Courier/Cancel')" class="btn btn-danger btn-sm" id="BtnSubmitCancel">Submit</button>
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
		<h3>Delete Expense <span id="DeleteNameExpense"></span> ?</h3>
		<div class="btn-group">
			<button onclick="DeleteExpenseProccess('Request_Courier')" 
			class="btn btn-danger btn-sm" id="BtnSubmitDeleteExpense">Submit</button>
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
			
			<span class="my-title"><b><span class="glyphicon glyphicon-record"></span> <?php echo $action; ?> Request Courier <span class="imp"><?php echo xxs_filter($no_request); ?></span></b></span>
			
			<!--<center><h4><b><?php ////echo xxs_filter($no_request); ?></b></h4></center>-->
			<hr class="my-hr">
			
			<input autocomplete="off" value="<?php echo $target; ?>" type="hidden" name="input_target" id="input_target" readonly="readonly" />
			<input autocomplete="off" value="<?php echo $status; ?>" type="hidden" name="input_status" id="input_status" readonly="readonly" />
	
				<div class="row">	
				<div class="col-sm-4">
				

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
							<input autocomplete="off" onkeyup="ListDataSrc('Request_Courier/Search_List_Company','ListDataCompany','input_src_company_name')" class="form-control input-sm" type="hidden" name="input_src_company_name" id="input_src_company_name" placeholder="Search..."/>
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
							<input autocomplete="off" onkeyup="ListDataSrc('Request_Courier/Search_List_Request_Option','ListDataRequestOption','input_src_request_option_name')" class="form-control input-sm" type="hidden" name="input_src_request_option_name" id="input_src_request_option_name" placeholder="Search..."/>
							<div id="ListDataRequestOption"></div>
						</div>
						</div>
					</div>
					<!--List--->
				</span><div class="my-break"></div>	

				<span class="my-fild">Expense Purpose <?php echo $require; ?></span>
				<span id="label_input_expense_purpose" class="my-fild-data">
					
					<table width="100%"><tr>
					<td>
						<span <?php echo $input_expense_purpose; ?> class="form-control input-sm" name="input_expense_purpose_name" id="input_expense_purpose_name" ><?php echo $expense_purpose_name; ?></span>
							<!--List--->
							<input autocomplete="off" value="<?php echo $expense_purpose; ?>" type="hidden" name="input_expense_purpose" id="input_expense_purpose" readonly="readonly"/>
							<div class="my-list-box" id="my-list-box-expense_purpose" style="display:none;">
								<div class="panel panel-primary my-panel-list-box">
								<div class="panel-body my-panel-body-list-box">
									<input autocomplete="off" onkeyup="ListDataSrc('Request_Courier/Search_List_Expense_Purpose','ListDataExpensePurpose','input_src_expense_purpose_name')" class="form-control input-sm" type="hidden" name="input_src_expense_purpose_name" id="input_src_expense_purpose_name" placeholder="Search..."/>
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
							<!--input autocomplete="off" <?php //echo $input_project_number; ?> value="<?php echo $project_number; ?>" class="form-control input-sm" type="number" name="input_project_number" id="input_project_number" placeholder="<?php //echo ph(6); ?>" / -->
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
					
				<span class="my-fild">Destination <?php echo $require; ?></span>
					<span id="label_input_destination" class="my-fild-data">
						<textarea <?php echo $input_destination; ?> id="input_destination" name="input_destination" rows="3" class="form-control input-sm" ><?php echo text_br($destination); ?></textarea>
					</span><div class="my-break"></div>	
	
					
				
					
				</div><!-- col-sm-4 -->			
				<div class="col-sm-4">
				

				
				<span class="my-fild">Description <?php echo $require; ?></span>
					<span id="label_input_description" class="my-fild-data">
						<textarea <?php echo $input_description; ?> id="input_description" name="input_description" rows="5" class="form-control input-sm" ><?php echo text_br($description); ?></textarea>
					</span><div class="my-break"></div>	
				
				<span class="my-fild">Comment</span>
					<span id="label_input_comment" class="my-fild-data">
						<textarea id="input_comment" name="input_comment" rows="4" class="form-control input-sm" ><?php echo text_br($comment); ?></textarea>
					</span><div class="my-break"></div>			
				
				<span id="style_courier" style="<?php echo $style_courier; ?>">
				<span class="my-fild">Courier</span>
				<span id="label_input_courier" class="my-fild-data">
				<span <?php echo $input_courier; ?> class="form-control input-sm" name="input_courier_name" id="input_courier_name" ><?php echo $courier_name; ?></span>
					<!--List--->
					<input autocomplete="off" value="<?php echo $courier; ?>" type="hidden" name="input_courier" id="input_courier" readonly="readonly"/>
					<div class="my-list-box" id="my-list-box-courier" style="display:none;">
						<div class="panel panel-primary my-panel-list-box">
						<div class="panel-body my-panel-body-list-box">
							<input autocomplete="off" onkeyup="ListDataSrc('Request_Courier/Search_List_Courier','ListDataCourier','input_src_courier_name')" class="form-control input-sm" type="text" name="input_src_courier_name" id="input_src_courier_name" placeholder="Search..."/>
							<div id="ListDataCourier"></div>
						</div>
						</div>
					</div>
					<?php if($status < 3){ ?>
					<a href="#" class="my-clear-text" onclick="ListDataSelect('my-list-box-courier','input_courier','','input_courier_name','')"><span>&times;</span></a>
					<?php } ?>
					<!--List--->
				</span><div class="my-break"></div>	
				</span>
				
				<span id="style_external" style="<?php echo $style_external; ?>">
				<span class="my-fild">External </span>
				<span id="label_input_external" class="my-fild-data">
				<span <?php echo $input_external; ?> class="form-control input-sm" name="input_external_name" id="input_external_name" ><?php echo $external_name; ?></span>
					<!--List--->
					<input autocomplete="off" value="<?php echo $external; ?>" type="hidden" name="input_external" id="input_external" readonly="readonly"/>
					<div class="my-list-box" id="my-list-box-external" style="display:none;">
						<div class="panel panel-primary my-panel-list-box">
						<div class="panel-body my-panel-body-list-box">
							<input autocomplete="off" onkeyup="ListDataSrc('Request_Courier/Search_List_External','ListDataExternal','input_src_external_name')" class="form-control input-sm" type="text" name="input_src_external_name" id="input_src_external_name" placeholder="Search..."/>
							<div id="ListDataExternal"></div>
						</div>
						</div>
					</div>
					<?php if($status < 3){ ?>
					<a href="#" class="my-clear-text" onclick="ListDataSelect('my-list-box-external','input_external','','input_external_name','')"><span>&times;</span></a>
					<?php } ?>
					<!--List--->
				</span><div class="my-break"></div>	
				</span>
				
				<span id="style_departur" style="<?php echo $style_departur; ?>">
				<span class="my-fild">Departure Vehicle</span>
				<span id="label_input_departur" class="my-fild-data">
				<span <?php echo $input_departur; ?> class="form-control input-sm" name="input_departur_name" id="input_departur_name" ><?php echo $departur_name; ?></span>
					<!--List--->
					<input autocomplete="off" value="<?php echo $departur; ?>" type="hidden" name="input_departur" id="input_departur" readonly="readonly"/>
					<div class="my-list-box" id="my-list-box-departur" style="display:none;">
						<div class="panel panel-primary my-panel-list-box">
						<div class="panel-body my-panel-body-list-box">
							<input autocomplete="off" onkeyup="ListDataSrc('Request_Courier/Search_List_Departur','ListDataDepartur','input_src_departur_name')" class="form-control input-sm" type="text" name="input_src_departur_name" id="input_src_departur_name" placeholder="Search..."/>
							<div id="ListDataDepartur"></div>
						</div>
						</div>
					</div>
					<?php if($status < 3){ ?>
					<a href="#" class="my-clear-text" onclick="ListDataSelect('my-list-box-departur','input_departur','','input_departur_name','')"><span>&times;</span></a>
					<?php } ?>
					<!--List--->
				</span><div class="my-break"></div>	
				</span>

				
				
				
				</div><!-- col-sm-4 -->		
				<div class="col-sm-4">
				


					<center><span><b>Fill these field bellow for complete request</b></span></center><br>
				
				<span id="style_return" style="<?php echo $style_return; ?>">
				<span class="my-fild">Return Vehicle</span>
				<span id="label_input_return" class="my-fild-data">
				<span <?php echo $input_return; ?> class="form-control input-sm" name="input_return_name" id="input_return_name" ><?php echo $return_name; ?></span>
					<!--List--->
					<input autocomplete="off" value="<?php echo $return; ?>" type="hidden" name="input_return" id="input_return" readonly="readonly"/>
					<div class="my-list-box" id="my-list-box-return" style="display:none;">
						<div class="panel panel-primary my-panel-list-box">
						<div class="panel-body my-panel-body-list-box">
							<input autocomplete="off" onkeyup="ListDataSrc('Request_Courier/Search_List_Return','ListDataReturn','input_src_return_name')" class="form-control input-sm" type="text" name="input_src_return_name" id="input_src_return_name" placeholder="Search..."/>
							<div id="ListDataReturn"></div>
						</div>
						</div>
					</div>
					<?php if($status < 3){ ?>
					<a href="#" class="my-clear-text" onclick="ListDataSelect('my-list-box-return','input_return','','input_return_name','')"><span>&times;</span></a>
					<?php } ?>
					<!--List--->
				</span><div class="my-break"></div>	
				</span>
				
				<span id="style_delivery" style="<?php echo $style_delivery; ?>">
				<span class="my-fild">Delivery Status</span>
				<span id="label_input_delivery" class="my-fild-data">
				<span <?php echo $input_delivery; ?> class="form-control input-sm" name="input_delivery_name" id="input_delivery_name" ><?php echo $delivery_name; ?></span>
					<!--List--->
					<input autocomplete="off" value="<?php echo $delivery; ?>" type="hidden" name="input_delivery" id="input_delivery" readonly="readonly"/>
					<div class="my-list-box" id="my-list-box-delivery" style="display:none;">
						<div class="panel panel-primary my-panel-list-box">
						<div class="panel-body my-panel-body-list-box">
							<input autocomplete="off" onkeyup="ListDataSrc('Request_Courier/Search_List_Delivery','ListDataDelivery','input_src_delivery_name')" class="form-control input-sm" type="hidden" name="input_src_delivery_name" id="input_src_delivery_name" placeholder="Search..."/>
							<div id="ListDataDelivery"></div>
						</div>
						</div>
					</div>
					<?php if($status < 3){ ?>
					<a href="#" class="my-clear-text" onclick="ListDataSelect('my-list-box-delivery','input_delivery','','input_delivery_name','')"><span>&times;</span></a>
					<?php } ?>
					<!--List--->
				</span><div class="my-break"></div>	
				</span>
				
				<span id="style_finish" style="<?php echo $style_finish; ?>">
				<span class="my-fild">Return Date <?php echo $require; ?></span>
					<span id="label_input_finish" class="my-fild-data">
				
						<table width="100%"><tr>
						<td>
							<span id="label_input_finish_date" class="my-fild-data">
								<input autocomplete="off" <?php echo $input_finish_date; ?> value="<?php echo $finish_date; ?>" class="form-control input-sm" type="text" name="input_finish_date" id="input_finish_date" placeholder="<?php echo ph(5); ?>" required />
							</span>
						</td>
						
						<td width="70px">
							<span id="label_input_finish_time" class="my-fild-data">
							<span class="form-control input-sm">
								<table style="margin-top:-23px">
								<tr>
									<td style="padding-bottom:6px;"><span class="my-fild">Hour</span></td><td></td>
									<td style="padding-bottom:6px;"><span class="my-fild">Minute</span></td>
								</tr>
								<tr>
								<td><select id="input_finish_time_a" name="input_finish_time_a" style="border:0px;">
									<?php 
									for($x=1;$x<=23;$x++){
										if($finish_time_a == $x) { $selectx = 'selected'; }else{$selectx = '';}
											echo'<option value="'.$x.'" '.$selectx.'>'.sprintf('%02s'.$valx, $x).'</option>';
									}
									?>
									<option value="00">00</option>
								</select></td>
								<td>&nbsp;:&nbsp;</td>
								<td><select id="input_finish_time_b" name="input_finish_time_b" style="border:0px;">
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
						</td>				
						</tr></table>				
					</span><div class="my-break"></div>	
				</span>
				
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
							
							if($status <= 2 ){
							
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
				
				
				
				
				</div><!-- col-sm-4 -->
				</div><!-- row -->
				<hr>
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
		<a href="<?php echo base_url() ?>Request_Courier/Form/Print/<?php echo $target ?>" target="_blank" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-print"></span></a>
		<button onClick="SubmenuSelect('Request_Courier','Request_Courier/Back')" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-menu-left"></span> Back</button>
		</div>
		</div>

	</div>