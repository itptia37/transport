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
	<input onkeyup="Search('Cash/Search')" type="text" class="btn btn-default btn-sm" name="input_src" id="input_src" placeholder="Search..."/>
	<button onclick="SubmenuSelect('Cash','Cash')" 
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
			<button onclick="DeleteProccess('Cash/Delete','Cash/Data_Table')" class="btn btn-danger btn-sm" id="BtnSubmitDelete">Submit</button>
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
			<button onclick="StatusProccess('Cash/Status','Cash/Data_Table')" class="btn btn-danger btn-sm" id="BtnSubmitStatus">Submit</button>
			<button onclick="StatusBoxHide()" class="btn btn-default btn-sm">Cancel</button>
		</div>
		</center>
	</div>
	</div>
</div>

<div class="my-box-filter">
	<!--Filter--->
	
	<div class="panel panel-primary my-box-filter-item" id="my-filter-date-start" style="display:none;">
	<b>Filter Date</b><hr class="my-hr">
		<table class="table-condensed"><tr>
			<td><input onmouseover="DateShow('input_date_start_a')" type="text" class="form-control input-sm" name="input_date_start_a" id="input_date_start_a" placeholder="Date..." require /></td>
			<td><input onmouseover="DateShow('input_date_start_b')" type="text" class="form-control input-sm" name="input_date_start_b" id="input_date_start_b" placeholder="Date..." require/></td>
		</tr></table>
		
		<div class="btn-group">
			<button onclick="FilterDateProccess('Cash/Filter_Date_a','input_date_start_a','input_date_start_b')" class="btn btn-primary btn-sm">Submit</button>
			<button onclick="FilterDateBoxHide('my-filter-date-start')" class="btn btn-default btn-sm">Close</button>
		</div>
	</div>
	
	<div class="panel panel-primary my-box-filter-item" id="my-filter-receiver" style="display:none;">
	<b>Filter Receiver</b><hr class="my-hr">
		<table width="100%" class="table-condensed">
		<tr>
			<td><input onkeyup="FilterListDataSrc('Cash/Filter_Search_List_Receiver','FilterListDataReceiver','input_src_receiver')"
			type="text" class="form-control input-sm" name="input_src_receiver" id="input_src_receiver" placeholder="Search..."/></td>
		</tr>
		<tr><td><div id="FilterListDataReceiver"></div></td></tr>
		</table>
		
		<div class="btn-group">
			<button onclick="FilterListBoxHide('my-filter-receiver')" class="btn btn-default btn-sm">Close</button>
		</div>
	</div>

	<div class="panel panel-primary my-box-filter-item" id="my-filter-status" style="display:none;">
	<b>Filter Status</b><hr class="my-hr">
		<table width="100%" class="table-condensed">
		<tr><td><div id="FilterListDataStatus">
			<li onclick="LoadDataTable('Cash/Filter_Status/2')"><a href="#"><?php echo status_cash(0) ?></a></li>
			<li onclick="LoadDataTable('Cash/Filter_Status/3')"><a href="#"><?php echo status_cash(1) ?></a></li>
			<li onclick="LoadDataTable('Cash/Filter_Status/4')"><a href="#"><?php echo status_cash(2) ?></a></li>
			<li onclick="LoadDataTable('Cash/Filter_Status/5')"><a href="#"><?php echo status_cash(3) ?></a></li>
		</div></td></tr>
		</table>
		
		<div class="btn-group">
			<button onclick="FilterBoxHide('my-filter-status')" class="btn btn-default btn-sm">Close</button>
		</div>
	</div>
	
	<!--Filter--->
</div>

<div id="my-data-table">
	<?php require_once 'cash_data.php'; ?>
</div>