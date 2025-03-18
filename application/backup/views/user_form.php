<?php 
defined('BASEPATH') or exit ('No direct script access allowed');

	$input_user = 'onclick="ListBoxShow(&#39;my-list-box-user&#39;,&#39;User/Search_List_User&#39;,&#39;ListDataUser&#39;,&#39;input_src_user&#39;)"';
	$btn_action		= '<button onclick="UserSubmit()" id="BtnSubmit" class="btn btn-primary btn-sm">Save</button>
	<button onclick="FormFloatShow(&#39;User/Form/Add/'.enid_get(0).'&#39;)" id="BtnReset" class="btn btn-warning btn-sm">Reset</button>';
	
	$require 		= '<span class="my-require">*</span>';
	
?>

<div class="panel panel-primary my-panel">
<div class="panel-body">

	<span class="my-title"><b><span class="glyphicon glyphicon-record"></span> <?php echo $action; ?> User</b></span>

	<hr class="my-hr">
	
	<input value="<?php echo $target; ?>" type="hidden" name="input_target" id="input_target" readonly="readonly" />
			
	<span class="my-fild">User <?php echo $require; ?></span>
	<span id="label_input_user" class="my-fild-data">
	<span <?php echo $input_user; ?> class="form-control input-sm" name="input_user" id="input_user" ><?php echo $email; ?></span>
		<!--List--->
		<input value="<?php echo $id_login; ?>" type="hidden" name="input_id_login" id="input_id_login" readonly="readonly"/>
		<div class="my-list-box" id="my-list-box-user" style="display:none;">
			<div class="panel panel-primary my-panel-list-box">
			<div class="panel-body my-panel-body-list-box">
				<input onkeydown="ListDataSrc('User/Search_List_User','ListDataUser','input_src_user')" class="form-control input-sm" type="text" name="input_src_user" id="input_src_user" placeholder="Search..."/>
				<div id="ListDataUser"></div>
			</div>
			</div>
		</div>
		<!--List--->
	</span><br>		
	
	<span class="my-fild">Access <?php echo $require; ?></span>
		<span id="label_input_access" class="my-fild-data">
			<select class="form-control input-sm" name="input_access" id="input_access" >
			<?php 
			foreach($list_user_access as $dtl) {
				
				if($access == $dtl->id_parameter){ $selected = 'selected';}else{$selected = '';}
				
				echo '<option value="'.$dtl->id_parameter.'" '.$selected.'>'.$dtl->name.'</option>';
				
			} 
			?>
			</select>
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