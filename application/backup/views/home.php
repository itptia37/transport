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
</div>

<div id="my-data-table">

<div class="container-fluid">

<center><h4>WELCOME <?php echo ucwords($this->session->userdata('name_tr')); ?></h4></center>
<hr>

<div class="row">
<div class="col-sm-6">
	<div class="list-group">
		<a href="#" class="list-group-item active"><b>AVAILABLE DRIVER</b></a>
		<table class="table-condensed">
		<?php 
			if($num_standby_driver > 0) {
				foreach($standby_driver as $dt_standby_driver){	
					if($dt_standby_driver->id_driver != 12 && $dt_standby_driver->id_driver != 22 
					&& $dt_standby_driver->id_driver != 23){
						echo'<a href="#" class="list-group-item">'.$dt_standby_driver->name.'</a>';		
					}
				}
			}
		?>
		</table>
	</div>
</div>
<div class="col-sm-6">
	<div class="list-group">
		<a href="#" class="list-group-item active"><b>AVAILABLE COURIER</b></a>
		<table class="table-condensed">
		<?php 
			if($num_standby_courier > 0) {
				foreach($standby_courier as $dt_standby_courier){	
					echo'<a href="#" class="list-group-item">'.$dt_standby_courier->name.'</a>';		
				}
			}
		?>
		</table>
	</div>
</div>
</div>


<?php if($this->session->userdata('id_tr') != ''){ ?>
<div class="row">
<div class="col-sm-6">
	<div class="list-group">
		<a href="#" class="list-group-item active"><b>REQUEST DRIVER</b></a>
		<?php 
			if($num_request_driver > 0) {
				foreach($request_driver as $dt_driver){ 
						
					echo'<a href="#" onclick="LoadContent(&#39;Request_Driver/Form/Edit/'.enid_get($dt_driver->id_request).'&#39;,&#39;Driver&#39;)"
					class="list-group-item">'.$dt_driver->no_request.' - '.my_user_name($dt_driver->requestor,$dt_driver->email).' Status : '.status_transaction($dt_driver->status).'
					<br>Departure : '.date_ind_text($dt_driver->start_date).' '.$dt_driver->start_time.'</a>';
							
				}
			}
		?>
	</div>
</div>
<div class="col-sm-6">
	<div class="list-group">
		<a href="#" class="list-group-item active"><b>REQUEST COURIER</b></a>
		<?php 
			if($num_request_courier > 0) {
				foreach($request_courier as $dt_courier){
						
					echo'<a href="#" onclick="LoadContent(&#39;Request_Courier/Form/Edit/'.enid_get($dt_courier->id_request).'&#39;,&#39;Courier&#39;)"
					class="list-group-item">'.$dt_courier->no_request.' - '.my_user_name($dt_courier->requestor,$dt_courier->email).' Status : '.status_transaction($dt_courier->status).'
					<br>Departure : '.date_ind_text($dt_courier->start_date).' '.$dt_courier->start_time.'</a>';
							
				}
			}
		?>
	</div>
</div>
</div>
<?php } ?>

</div>
</div><!-- container-fluid -->

