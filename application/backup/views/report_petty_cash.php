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
	<input onmouseover="DateShow('input_src_a')" type="text" class="btn btn-default btn-sm" name="input_src_a" id="input_src_a" placeholder="Date..."/>
	<input onmouseover="DateShow('input_src_b')" type="text" class="btn btn-default btn-sm" name="input_src_b" id="input_src_b" placeholder="Date..."/>
	<button onclick="SearchDate('Report_Petty_Cash/Search_Date')" 
	class="btn btn-default btn-sm"><span class="glyphicon glyphicon-search"></span></button>
	<button onclick="SubmenuSelect('Report_Petty_Cash','Report_Petty_Cash')" 
	class="btn btn-default btn-sm"><span class="glyphicon glyphicon-refresh"></span></button>
	</div>
</div>
</div>

<div class="my-box-confirm" id="my-box-confirm">
	<div class="panel panel-primary my-panel">
	<div class="panel-body">
		<center>
		<img width="50px" class="img-responsive" src="<?php echo base_url() ?>assets/images/warning.png"/>
		<input type="hidden" name="input_index" id="input_index" readonly="readonly" />
		<h3>Proccess data ?</h3>
		<div class="btn-group">
			<button onclick="ConfirmProccess('Report_Petty_Cash/Proccess_Petty')" class="btn btn-danger btn-sm" id="BtnSubmitConfirm">Submit</button>
			<button onclick="ConfirmBoxHide()" class="btn btn-default btn-sm">Cancel</button>
		</div>
		</center>
	</div>
	</div>
</div>

<div class="my-box-filter">
	<!--Filter--->

	<div class="panel panel-primary my-box-filter-item" id="my-filter-date-start" style="display:none;" >
	<b>Filter Date</b><hr class="my-hr">
		<table class="table-condensed"><tr>
			<td><input onmouseover="DateShow('input_date_a')" type="text" class="form-control input-sm" name="input_date_a" id="input_date_a" placeholder="Date..." require /></td>
			<td><input onmouseover="DateShow('input_date_b')" type="text" class="form-control input-sm" name="input_date_b" id="input_date_b" placeholder="Date..." require /></td>
		</tr></table>
		
		<div class="btn-group">
			<button onclick="FilterDateProccess('Report_Petty_Cash/Filter_Date_a','input_date_a','input_date_b')" class="btn btn-primary btn-sm">Submit</button>
			<button onclick="FilterDateBoxHide('my-filter-date-start')" class="btn btn-default btn-sm">Close</button>
		</div>
	</div>
		
	<!--Filter--->
</div>

<div id="my-data-table">
	<?php require_once 'report_petty_cash_data.php'; ?>
</div>