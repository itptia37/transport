<div id="my-breadcrumb">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
	<?php echo $set_menu; ?>
	<?php echo $set_submenu; ?>
  </ol>
</nav>	

<div class="my-search-box">
	<div class="btn-group">
	<a href="#" onclick="LoadContent('Report_Petty_Cash_Close/Back')" class="btn btn-default btn-sm">Back</a>
	</div>
</div>
</div>

<div id="my-data-table">
<?php require_once'report_petty_cash_close_detail_data.php'; ?>
</div>