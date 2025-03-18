<?php 
defined('BASEPATH') or exit ('No direct script access allowed');

	$input_driver_name 	= 'onclick="ListBoxShow(&#39;my-list-box-driver_name&#39;,&#39;Driver/Search_List_Driver&#39;,&#39;ListDataDriver&#39;,&#39;input_src_driver_name&#39;)"';
	$input_car_name 	= 'onclick="ListBoxShow(&#39;my-list-box-car_name&#39;,&#39;Driver/Search_List_Car&#39;,&#39;ListDataCar&#39;,&#39;input_src_car_name&#39;)"';
	$btn_action			= '<button onclick="DriverSubmit()" id="BtnSubmit" class="btn btn-primary btn-sm">Save</button>
	<button onclick="FormFloatShow(&#39;Driver/Form/Add/'.enid_get(0).'&#39;)" id="BtnReset" class="btn btn-warning btn-sm">Reset</button>';
	
	$require 			= '<span class="my-require">*</span>';
	
?>

<div class="panel panel-primary my-panel">
<div class="panel-body">

	<span class="my-title"><b><span class="glyphicon glyphicon-record"></span> <?php echo $action; ?> Driver</b></span>

	<hr class="my-hr">
	
	<input value="<?php echo $target; ?>" type="hidden" name="input_target" id="input_target" readonly="readonly" />
			
	<span class="my-fild">Driver <?php echo $require; ?></span>
	<span id="label_input_driver_name" class="my-fild-data">
	<span <?php echo $input_driver_name; ?> class="form-control input-sm" name="input_driver_name" id="input_driver_name" ><?php echo $driver_name; ?></span>
		<!--List--->
		<input value="<?php echo $driver; ?>" type="hidden" name="input_driver" id="input_driver" readonly="readonly"/>
		<div class="my-list-box" id="my-list-box-driver_name" style="display:none;">
			<div class="panel panel-primary my-panel-list-box">
			<div class="panel-body my-panel-body-list-box">
				<input onkeydown="ListDataSrc('Driver/Search_List_Driver','ListDataDriver','input_src_driver_name')" class="form-control input-sm" type="text" name="input_src_driver_name" id="input_src_driver_name" placeholder="Search..."/>
				<div id="ListDataDriver"></div>
			</div>
			</div>
		</div>
		<!--List--->
	</span><br>		
	
	<span class="my-fild">Car </span>
	<span id="label_input_car_name" class="my-fild-data">
	<span <?php echo $input_car_name; ?> class="form-control input-sm" name="input_car_name" id="input_car_name" ><?php echo $car_name; ?></span>
		<!--List--->
		<input value="<?php echo $car; ?>" type="hidden" name="input_car" id="input_car" readonly="readonly"/>
		<div class="my-list-box" id="my-list-box-car_name" style="display:none;">
			<div class="panel panel-primary my-panel-list-box">
			<div class="panel-body my-panel-body-list-box">
				<input onkeydown="ListDataSrc('Driver/Search_List_Car','ListDataCar','input_src_car_name')" class="form-control input-sm" type="text" name="input_src_car_name" id="input_src_car_name" placeholder="Search..."/>
				<div id="ListDataCar"></div>
			</div>
			</div>
		</div>
		<!--List--->
	</span><br>		
					
		<hr class="my-hr">
		<?php require_once 'label_inputer.php'; ?>
	
		<br>
		
	<div class="btn-group">
		
		<?php echo $btn_action; ?>
		
		<button onclick="FormFloatHide()" class="btn btn-default btn-sm">Close</button>
	
	</div><!-- btn-group -->
	
</div><!-- panel-body -->
</div><!-- panel -->