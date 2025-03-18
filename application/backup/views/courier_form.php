<?php 
defined('BASEPATH') or exit ('No direct script access allowed');

	$input_courier_name = 'onclick="ListBoxShow(&#39;my-list-box-courier_name&#39;,&#39;Courier/Search_List_Courier&#39;,&#39;ListDataCourier&#39;,&#39;input_src_courier_name&#39;)"';
	$btn_save			= '<button onclick="CourierSubmit()" id="BtnSubmit" class="btn btn-primary btn-sm">Save</button>';
	$btn_reset			= '<button onclick="FormFloatShow(&#39;Courier/Form/Add/'.enid_get(0).'&#39;)" id="BtnReset" class="btn btn-warning btn-sm">Reset</button>';
	
	$require 			= '<span class="my-require">*</span>';
	
?>

<div class="panel panel-primary my-panel">
<div class="panel-body">

	<span class="my-title"><b><span class="glyphicon glyphicon-record"></span> <?php echo $action; ?> Courier</b></span>

	<hr class="my-hr">
	
	<input value="<?php echo $target; ?>" type="hidden" name="input_target" id="input_target" readonly="readonly" />
			
	<span class="my-fild">Courier <?php echo $require; ?></span>
	<span id="label_input_courier_name" class="my-fild-data">
	<span <?php echo $input_courier_name; ?> class="form-control input-sm" name="input_courier_name" id="input_courier_name" ><?php echo $courier_name; ?></span>
		<!--List--->
		<input value="<?php echo $courier; ?>" type="hidden" name="input_courier" id="input_courier" readonly="readonly"/>
		<div class="my-list-box" id="my-list-box-courier_name" style="display:none;">
			<div class="panel panel-primary my-panel-list-box">
			<div class="panel-body my-panel-body-list-box">
				<input onkeydown="ListDataSrc('Courier/Search_List_Courier','ListDataCourier','input_src_courier_name')" class="form-control input-sm" type="text" name="input_src_courier_name" id="input_src_courier_name" placeholder="Search..."/>
				<div id="ListDataCourier"></div>
			</div>
			</div>
		</div>
		<!--List--->
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