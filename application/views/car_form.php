<?php 
defined('BASEPATH') or exit ('No direct script access allowed');

	$input_car_name = 'onkeypress="ECar(event,&#39;myinput&#39;)" onkeyup="CheckInput(&#39;input_car_name&#39;)"';
	$btn_save		= '<button onclick="CarSubmit()" id="BtnSubmit" class="btn btn-primary btn-sm">Save</button>';
	$btn_reset		= '<button onclick="FormFloatShow(&#39;Car/Form/Add/'.enid_get(0).'&#39;)" id="BtnReset" class="btn btn-warning btn-sm">Reset</button>';
	
	$require 		= '<span class="my-require">*</span>';
	
?>

<div class="panel panel-primary my-panel">
<div class="panel-body">

	<span class="my-title"><b><span class="glyphicon glyphicon-record"></span> <?php echo $action; ?> Car</b></span>

	<hr class="my-hr">
	
	<input value="<?php echo $target; ?>" type="hidden" name="input_target" id="input_target" readonly="readonly" />
	
	<span class="my-fild">Name <?php echo $require; ?></span>
		<span id="label_input_car_name" class="my-fild-data">
			<input <?php echo $input_car_name; ?> value="<?php echo $car_name; ?>" class="form-control input-sm" type="text" name="input_car_name" id="input_car_name" placeholder="<?php echo ph(3); ?>" required autofocus />
		</span><br>
					
		<hr class="my-hr">
		<?php require_once 'label_inputer.php'; ?>
	
		<br>
		
	<div class="btn-group">
		
		<?php echo $btn_save.$btn_reset; ?>
		
		<button onclick="FormFloatHide()" class="btn btn-default btn-sm">Close</button>
	
	</div><!-- btn-group -->
	
</div><!-- panel-body -->
</div><!-- panel -->