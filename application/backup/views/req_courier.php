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
	<input onkeyup="Search('Request_Courier/Search')" type="text" class="btn btn-default btn-sm" name="input_src" id="input_src" placeholder="Search..."/>
	<button onclick="SubmenuSelect('Request_Courier','Request_Courier')" 
	class="btn btn-default btn-sm"><span class="glyphicon glyphicon-refresh"></span></button>
	</div>
</div>
</div>


<div id="my-data-table">
	<?php require_once 'req_courier_data.php'; ?>
</div>