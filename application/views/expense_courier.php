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
	<input onkeyup="Search('Expense_Courier/Search')" type="text" class="btn btn-default btn-sm" name="input_src" id="input_src" placeholder="Search..."/>
	<button onclick="SubmenuSelect('Expense_Courier','Expense_Courier')" 
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
			<button onclick="DeleteProccess('Expense_Courier/Delete','Expense_Courier/Data_Table')" class="btn btn-danger btn-sm" id="BtnSubmitDelete">Submit</button>
			<button onclick="DeleteBoxHide()" class="btn btn-default btn-sm">Cancel</button>
		</div>
		</center>
	</div>
	</div>
</div>

<div class="my-box-filter">
	<!--Filter--->
	
	<div class="panel panel-primary my-box-filter-item" id="my-filter-courier" style="display:none;">
	<b>Filter Courier</b><hr class="my-hr">
		<table width="100%" class="table-condensed">
		<tr>
			<td><input onkeyup="FilterListDataSrc('Expense_Courier/Filter_Search_List_Courier','FilterListDataCourier','input_src_courier')"
			type="text" class="form-control input-sm" name="input_src_courier" id="input_src_courier" placeholder="Search..."/></td>
		</tr>
		<tr><td><div id="FilterListDataCourier"></div></td></tr>
		</table>
		
		<div class="btn-group">
			<button onclick="FilterListBoxHide('my-filter-courier')" class="btn btn-default btn-sm">Close</button>
		</div>
	</div>
	
	<!--Filter--->
</div>

<div id="my-data-table">
	<?php require_once 'expense_courier_data.php'; ?>
</div>