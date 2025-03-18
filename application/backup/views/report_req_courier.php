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
	<input onkeyup="Search('Report_Request_Courier/Search')" type="text" class="btn btn-default btn-sm" name="input_src" id="input_src" placeholder="Search..."/>
	<button onclick="SubmenuSelect('Report_Request_Courier','Report_Request_Courier')" 
	class="btn btn-default btn-sm"><span class="glyphicon glyphicon-refresh"></span></button>
	</div>
</div>
</div>

<div class="my-box-filter">
	<!--Filter--->

	<div class="panel panel-primary my-box-filter-item" id="my-filter-requestor" style="display:none;">
	<b>Filter Requestor</b><hr class="my-hr">
		<table width="100%" class="table-condensed">
		<tr>
			<td><input onkeyup="FilterListDataSrc('Report_Request_Courier/Filter_Search_List_Requestor','FilterListDataRequestor','input_src_requestor')"
			type="text" class="form-control input-sm" name="input_src_requestor" id="input_src_requestor" placeholder="Search..."/></td>
		</tr>
		<tr><td><div id="FilterListDataRequestor"></div></td></tr>
		</table>
		
		<div class="btn-group">
			<button onclick="FilterListBoxHide('my-filter-requestor')" class="btn btn-default btn-sm">Close</button>
		</div>
	</div>

	<div class="panel panel-primary my-box-filter-item" id="my-filter-department" style="display:none;">
	<b>Filter Department</b><hr class="my-hr">
		<table width="100%" class="table-condensed">
		<tr>
			<td><input onkeyup="FilterListDataSrc('Report_Request_Courier/Filter_Search_List_Department','FilterListDataDepartment','input_src_department')"
			type="text" class="form-control input-sm" name="input_src_department" id="input_src_department" placeholder="Search..."/></td>
		</tr>
		<tr><td><div id="FilterListDataDepartment"></div></td></tr>
		</table>
		
		<div class="btn-group">
			<button onclick="FilterListBoxHide('my-filter-department')" class="btn btn-default btn-sm">Close</button>
		</div>
	</div>
	
	<div class="panel panel-primary my-box-filter-item" id="my-filter-date-start" style="display:none;">
	<b>Filter Date</b><hr class="my-hr">
		<table class="table-condensed"><tr>
			<td><input onmouseover="DateShow('input_date_start_a')" type="text" class="form-control input-sm" name="input_date_start_a" id="input_date_start_a" placeholder="Date..." require /></td>
			<td><input onmouseover="DateShow('input_date_start_b')" type="text" class="form-control input-sm" name="input_date_start_b" id="input_date_start_b" placeholder="Date..." require/></td>
		</tr></table>
		
		<div class="btn-group">
			<button onclick="FilterDateProccess('Report_Request_Courier/Filter_Date_a','input_date_start_a','input_date_start_b')" class="btn btn-primary btn-sm">Submit</button>
			<button onclick="FilterDateBoxHide('my-filter-date-start')" class="btn btn-default btn-sm">Close</button>
		</div>
	</div>
	
	<div class="panel panel-primary my-box-filter-item" id="my-filter-purpose" style="display:none;">
	<b>Filter Expense Purpose</b><hr class="my-hr">
		<table width="100%" class="table-condensed">
		<tr>
			<td><input onkeyup="FilterListDataSrc('Report_Purpose_Courier/Filter_Search_List_Purpose','FilterListDataPurpose','input_src_purpose')"
			type="hidden" class="form-control input-sm" name="input_src_purpose" id="input_src_purpose" placeholder="Search..."/></td>
		</tr>
		<tr><td><div id="FilterListDataPurpose"></div></td></tr>
		</table>
		
		<div class="btn-group">
			<button onclick="FilterListBoxHide('my-filter-purpose')" class="btn btn-default btn-sm">Close</button>
		</div>
	</div>
	
	<div class="panel panel-primary my-box-filter-item" id="my-filter-request" style="display:none;">
	<b>Filter Request</b><hr class="my-hr">
		<table width="100%" class="table-condensed">
		<tr>
			<td><input onkeyup="FilterListDataSrc('Report_Request_Courier/Filter_Search_List_Request','FilterListDataRequest','input_src_request')"
			type="hidden" class="form-control input-sm" name="input_src_request" id="input_src_request" placeholder="Search..."/></td>
		</tr>
		<tr><td><div id="FilterListDataRequest"></div></td></tr>
		</table>
		
		<div class="btn-group">
			<button onclick="FilterListBoxHide('my-filter-request')" class="btn btn-default btn-sm">Close</button>
		</div>
	</div>
	
	<div class="panel panel-primary my-box-filter-item" id="my-filter-courier" style="display:none;">
	<b>Filter Courier</b><hr class="my-hr">
		<table width="100%" class="table-condensed">
		<tr>
			<td><input onkeyup="FilterListDataSrc('Report_Courier_Courier/Filter_Search_List_Courier','FilterListDataCourier','input_src_courier')"
			type="text" class="form-control input-sm" name="input_src_courier" id="input_src_courier" placeholder="Search..."/></td>
		</tr>
		<tr><td><div id="FilterListDataCourier"></div></td></tr>
		</table>
		
		<div class="btn-group">
			<button onclick="FilterListBoxHide('my-filter-courier')" class="btn btn-default btn-sm">Close</button>
		</div>
	</div>
	
	<div class="panel panel-primary my-box-filter-item" id="my-filter-balance" style="display:none;">
	<b>Filter Balance</b><hr class="my-hr">
		<table width="100%" class="table-condensed">
		<tr><td><div id="FilterListDataStatus">
			<li onclick="LoadDataTable('Report_Request_Courier/Filter_Balance/1')"><a href="#">Null</a></li>
			<li onclick="LoadDataTable('Report_Request_Courier/Filter_Balance/2')"><a href="#">Not Null</a></li>
		</div></td></tr>
		</table>
		
		<div class="btn-group">
			<button onclick="FilterBoxHide('my-filter-balance')" class="btn btn-default btn-sm">Close</button>
		</div>
	</div>
	
	<div class="panel panel-primary my-box-filter-item" id="my-filter-status" style="display:none;">
	<b>Filter Status</b><hr class="my-hr">
		<table width="100%" class="table-condensed">
		<tr><td><div id="FilterListDataStatus">
			<li onclick="LoadDataTable('Report_Request_Courier/Filter_Status/2')"><a href="#"><?php echo status_transaction(0) ?></a></li>
			<li onclick="LoadDataTable('Report_Request_Courier/Filter_Status/3')"><a href="#"><?php echo status_transaction(1) ?></a></li>
			<li onclick="LoadDataTable('Report_Request_Courier/Filter_Status/4')"><a href="#"><?php echo status_transaction(2) ?></a></li>
			<li onclick="LoadDataTable('Report_Request_Courier/Filter_Status/5')"><a href="#"><?php echo status_transaction(3) ?></a></li>
			<li onclick="LoadDataTable('Report_Request_Courier/Filter_Status/6')"><a href="#"><?php echo status_transaction(4) ?></a></li>
		</div></td></tr>
		</table>
		
		<div class="btn-group">
			<button onclick="FilterBoxHide('my-filter-status')" class="btn btn-default btn-sm">Close</button>
		</div>
	</div>
	
	<!--Filter--->
</div>



<div id="my-data-table">
	<?php require_once 'report_req_courier_data.php'; ?>
</div>