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
	<button onclick="SearchDateClose('Report_Petty_Cash_Close/Search_Date')" 
	class="btn btn-default btn-sm"><span class="glyphicon glyphicon-search"></span></button><button onclick="SubmenuSelect('Report_Petty_Cash_Close','Report_Petty_Cash_Close')" 
	class="btn btn-default btn-sm"><span class="glyphicon glyphicon-refresh"></span></button>
	</div>
</div>
</div>


<div id="my-data-table">
	<?php require_once 'report_petty_cash_close_data.php'; ?>
</div>