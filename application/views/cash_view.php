<?php 
defined('BASEPATH') or exit ('No direct script access allowed');

	// $btn_print	 = '<a href="'.base_url().'/Cash/Form/Print/'.$target.'" target="_blank" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-print"></span></a>';
	$btn_print	 = '<a href="Cash/Form/Print/'.$target.'" target="_blank" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-print"></span></a>';
	
?>

<div class="panel panel-primary my-panel" style="position:fixed;left:20%;width:60%;">
<div class="panel-body">

	<span class="my-title"><b><span class="glyphicon glyphicon-record"></span> Cash Receipt</b></span>

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
		<td><span class="my-fild">Receiver</span></td>
		<td>:</td>
		<td><?php echo $receiver_name; ?></td>
	</tr>
	<tr>
		<td><span class="my-fild">Amount</span></td>
		<td>:</td>
		<td><?php echo ($amount); ?></td>
	</tr>
	<tr>
		<td><span class="my-fild">In Word</span></td>
		<td>:</td>
		<td><?php echo ($words); ?></td>
	</tr>
</table>
	
		<hr class="my-hr">
		<?php require_once 'label_inputer.php'; ?>
	
	<br>
	
	<div class="btn-group">
	
		<?php echo $btn_print; ?>
		<button onclick="FormFloatHide()" class="btn btn-default btn-sm">Close</button>
	
	</div><!-- btn-group -->
	
</div><!-- panel-body -->
</div><!-- panel -->