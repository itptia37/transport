<?php 
defined('BASEPATH') or exit ('No direct script access allowed');

if($status == 1){ // lock
	$btn_approve = '<button onclick="SettelmentBoxShow(&#39;'.$no_cash.'&#39;)" id="BtnSubmit" class="btn btn-primary btn-sm">Finished</button>';
}else{
	$btn_approve = '';
}
if($status == 2){ // finished
	$btn_print	 = '<a href="'.base_url().'/Cash/Form/Print_PTJ/'.$target.'" target="_blank" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-print"></span></a>';
}else{
	$btn_print	 = '';
}
	
	
?>
<?php if($status == 1){ ?>
<div class="my-box-confirm" id="my-box-settelment">
	<div class="panel panel-primary my-panel">
	<div class="panel-body">
		<center>
		<img width="50px" class="img-responsive" src="<?php echo base_url() ?>assets/images/warning.png"/>
		<h3>Approve Settelment <span id="SettelmentName"></span> ?</h3>
		<div class="btn-group">
			<button onclick="SettelmentProccess('Cash/Approve','<?php echo $target; ?>')" class="btn btn-danger btn-sm" id="BtnSubmitSettelment">Submit</button>
			<button onclick="SettelmentBoxHide()" class="btn btn-default btn-sm">Cancel</button>
		</div>
		</center>
	</div>
	</div>
</div>
<?php } ?>

<div class="panel panel-primary my-panel">
<div class="panel-body">

	<span class="my-title"><b><span class="glyphicon glyphicon-record"></span> Settelment / PTJ</b></span>

	<hr class="my-hr">
	
	<input value="<?php echo $target; ?>" type="hidden" name="input_target" id="input_target" readonly="readonly" />
	
<table class="table-condensed">
	<tr>
		<td><span class="my-fild">Nomor KAS BON</span></td>
		<td width="10px">:</td>
		<td><?php echo $no_cash; ?></td>
	</tr>
	<tr>
		<td><span class="my-fild">Start Date</span></td>
		<td>:</td>
		<td><?php echo $start_date; ?></td>
	</tr>
	<tr>
		<td><span class="my-fild">End Date</span></td>
		<td>:</td>
		<td><?php echo $end_date; ?></td>
	</tr>
	<tr>
		<td><span class="my-fild"><?php echo $label; ?></span></td>
		<td>:</td>
		<td><?php echo $receiver_name; ?></td>
	</tr>
	<tr>
		<td><span class="my-fild">Amount</span></td>
		<td>:</td>
		<td><?php echo $amount; ?></td>
	</tr>
	<tr>
		<td><span class="my-fild">Total Expense</span></td>
		<td>:</td>
		<td><?php echo $total; ?></td>
	</tr>
	<tr>
		<td><span class="my-fild">Deference</span></td>
		<td>:</td>
		<td><?php echo $difference; ?></td>
	</tr>
	<tr>
		<td><span class="my-fild">Note</span></td>
		<td>:</td>
		<td><?php echo $note; ?></td>
	</tr>
</table>
	
		<hr class="my-hr">
		<?php require_once 'label_inputer.php'; ?>
		
	<br>
	
	<div class="btn-group">
		
		<?php echo $btn_approve.$btn_print; ?>
		
		<button onclick="FormFloatHide()" class="btn btn-default btn-sm">Close</button>
	
	</div><!-- btn-group -->
	
</div><!-- panel-body -->
</div><!-- panel -->