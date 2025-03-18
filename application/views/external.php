<?php 
defined('BASEPATH') or exit ('No direct script access allowed');
?>

<div id="my-breadcrumb">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
	<?php echo $set_menu; ?>
	<?php echo $set_submenu; ?>
  </ol>
</nav>	

<div class="my-search-box">
	<div class="btn-group">
	<input onkeyup="Search('External/Search')" type="text" class="btn btn-default btn-sm" name="input_src" id="input_src" placeholder="Search..."/>
	<button onclick="SubmenuSelect('External','External')" 
	class="btn btn-default btn-sm"><span class="glyphicon glyphicon-refresh"></span></button>
	</div>
</div>
</div>

<div class="my-box-form-float" id="my-box-form-float"></div>

<div class="my-box-confirm" id="my-box-delete">
	<div class="panel panel-primary my-panel">
	<div class="panel-body">
		<center>
		<img width="50px" class="img-responsive" src="<?php echo base_url() ?>assets/images/warning.png"/>
		<input type="hidden" name="input_index" id="input_index" readonly="readonly" />
		<h3>Delete data <span id="DeleteName"></span> ?</h3>
		<div class="btn-group">
			<button onclick="DeleteProccess('External/Delete','External/Data_Table')" class="btn btn-danger btn-sm" id="BtnSubmitDelete">Submit</button>
			<button onclick="DeleteBoxHide()" class="btn btn-default btn-sm">Cancel</button>
		</div>
		</center>
	</div>
	</div>
</div>

<div class="my-box-confirm" id="my-box-status">
	<div class="panel panel-primary my-panel">
	<div class="panel-body">
		<center>
		<img width="50px" class="img-responsive" src="<?php echo base_url() ?>assets/images/warning.png"/>
		<input type="hidden" name="input_index_status" id="input_index_status" readonly="readonly" />
		<input type="hidden" name="input_value_status" id="input_value_status" readonly="readonly" />
		<h3><span id="StatusText"></span> <span id="StatusName"></span> ?</h3>
		<div class="btn-group">
			<button onclick="StatusProccess('External/Status','External/Data_Table')" class="btn btn-danger btn-sm" id="BtnSubmitStatus">Submit</button>
			<button onclick="StatusBoxHide()" class="btn btn-default btn-sm">Cancel</button>
		</div>
		</center>
	</div>
	</div>
</div>

<div id="my-data-table">
	<?php require_once 'external_data.php'; ?>
</div>