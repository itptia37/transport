<?php 
defined('BASEPATH') or exit ('No direct script access allowed');

	$input_start_date	= 'onkeypress="ECash(event,&#39;myinput&#39;)" onkeyup="CheckInput(&#39;input_start_date&#39;)" onmouseover="DateShow(&#39;input_start_date&#39;)"';
	$input_end_date		= 'onkeypress="ECash(event,&#39;myinput&#39;)" onkeyup="CheckInput(&#39;input_end_date&#39;)" onmouseover="DateShow(&#39;input_end_date&#39;)"';
	$input_receiver_name 	= 'onclick="ListBoxShow(&#39;my-list-box-receiver_name&#39;,&#39;Cash/Search_List_Receiver&#39;,&#39;ListDataReceiver&#39;,&#39;input_src_receiver_name&#39;)"';
	$btn_save			= '<button onclick="CashSubmit()" id="BtnSubmit" class="btn btn-primary btn-sm">Save</button>';
	$btn_print			= '<a href="'.base_url().'/Cash/Form/Print/'.$target.'" target="_blank" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-print"></span></a>';
	$btn_reset			= '<button onclick="FormFloatShow(&#39;Cash/Form/Add/'.enid_get(0).'&#39;)" id="BtnReset" class="btn btn-warning btn-sm">Reset</button>';
	
	if(desid_get($target) > 0){
		$btn_lock			= '<button onclick="LockBoxShow(&#39;'.$no_cash.'&#39;)" id="BtnLock" class="btn btn-primary btn-sm">Lock</button>';
		$btn_cancel			= '<button onclick="CancelCashBoxShow(&#39;'.$no_cash.'&#39;)" id="BtnCancel" class="btn btn-danger btn-sm">Cancel</button>';
	}else{
		$btn_lock			= '';
		$btn_cancel			= '';
	}
	$require 			= '<span class="my-require">*</span>';
	
?>

<div class="my-box-confirm" id="my-box-lock">
	<div class="panel panel-primary my-panel">
	<div class="panel-body">
		<center>
		<img width="50px" class="img-responsive" src="<?php echo base_url() ?>assets/images/warning.png"/>
		<h3>Lock <span id="LockName"></span> ?</h3>
		<div class="btn-group">
			<button onclick="LockProccess('Cash/Lock','<?php echo $target; ?>')" class="btn btn-danger btn-sm" id="BtnSubmitLock">Submit</button>
			<button onclick="LockBoxHide()" class="btn btn-default btn-sm">Cancel</button>
		</div>
		</center>
	</div>
	</div>
</div>

<div class="my-box-confirm" id="my-box-cancel">
	<div class="panel panel-primary my-cancel">
	<div class="panel-body">
		<center>
		<img width="50px" class="img-responsive" src="<?php echo base_url() ?>assets/images/warning.png"/>
		<h3>Cancel <span id="CancelName"></span> ?</h3>
		<div class="btn-group">
			<button onclick="CancelCashProccess('Cash/Cancel','<?php echo $target; ?>')" class="btn btn-danger btn-sm" id="BtnCancel">Submit</button>
			<button onclick="CancelCashBoxHide()" class="btn btn-default btn-sm">Cancel</button>
		</div>
		</center>
	</div>
	</div>
</div>

<div class="panel panel-primary my-panel">
<div class="panel-body">

	<span class="my-title"><b><span class="glyphicon glyphicon-record"></span> <?php echo $action; ?> Cash <?php echo $no_cash; ?></b></span>

	<hr class="my-hr">
	
	<input value="<?php echo $target; ?>" type="hidden" name="input_target" id="input_target" readonly="readonly" />
	
	<span class="my-fild">Start Date <?php echo $require; ?></span>	
	<span id="label_input_start_date" class="my-fild-data">
		<input <?php echo $input_start_date; ?> value="<?php echo $start_date; ?>" class="form-control input-sm" type="text" name="input_start_date" id="input_start_date" placeholder="<?php echo ph(5); ?>" required />
	</span>
	
	<span class="my-fild">End Date <?php echo $require; ?></span>	
	<span id="label_input_end_date" class="my-fild-data">
		<input <?php echo $input_end_date; ?> value="<?php echo $end_date; ?>" class="form-control input-sm" type="text" name="input_end_date" id="input_end_date" placeholder="<?php echo ph(5); ?>" required />
	</span>
	
	<span class="my-fild">Receiver <?php echo $require; ?></span>
	<span id="label_input_receiver_name" class="my-fild-data">
	<span <?php echo $input_receiver_name; ?> class="form-control input-sm" name="input_receiver_name" id="input_receiver_name" ><?php echo $receiver_name; ?></span>
		<!--List--->
		<input value="<?php echo $receiver; ?>" type="hidden" name="input_receiver" id="input_receiver" readonly="readonly"/>
		<div class="my-list-box" id="my-list-box-receiver_name" style="display:none;">
			<div class="panel panel-primary my-panel-list-box">
			<div class="panel-body my-panel-body-list-box">
				<input onkeydown="ListDataSrc('Cash/Search_List_Receiver','ListDataReceiver','input_src_receiver_name')" 
				class="form-control input-sm" type="hidden" name="input_src_receiver_name" id="input_src_receiver_name" placeholder="Search..."/>
				<div id="ListDataReceiver"></div>
			</div>
			</div>
		</div>
		<!--List--->
	</span><div class="my-break"></div>	
	
	<span class="my-fild">Amount <?php echo $require; ?></span>
		<span id="label_input_amount" class="my-fild-data">
			<input onkeypress="ECash(event,'myinput')"
			value="<?php echo $amount; ?>" type="text" id="input_amount" name="input_amount" class="form-control input-sm" placeholder="<?php echo ph(4); ?>" />
		</span>	
	</span><div class="my-break"></div>
				
		<hr class="my-hr">
		<?php require_once 'label_inputer.php'; ?>
	
		<br>
		
	<div class="btn-group">
		
		<?php echo $btn_save.$btn_reset; ?>
		
		<button onclick="FormFloatHide()" class="btn btn-default btn-sm">Close</button>
	
	</div><!-- btn-group -->
	&nbsp;&nbsp;&nbsp;
	<div class="btn-group">
		
		<?php echo $btn_lock.$btn_cancel; ?>
		
	</div><!-- btn-group -->
	
</div><!-- panel-body -->
</div><!-- panel -->