<?php 
defined('BASEPATH') or exit ('No direct script access allowed');
?>

<div class="my-tools-box">
<div class="container-fluid">
<div class="row">
<div class="col-sm-6 my-tools-box-col">

	<div class="btn-group">
	<span class="btn btn-success btn-sm">Courier Data</span>
	
	<a href="#" onclick="FormFloatShow('Courier/Form/Add/<?php echo enid_get(0); ?>')" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus"></span> Add</a>
	
	<span class="btn btn-primary btn-sm">Count : <?php echo $num_data; ?></span>
	<span onclick="RowBoxShow()" class="btn btn-primary btn-sm">Row : <span id="myrow"><?php echo $myrow; ?></span></span>

		<div id="my-row-box" style="display:none;" >
		<li onclick="LoadDataTable('Courier/Rows/25')" class="my-row-item <?php if($myrow==25){echo'my-row-active';} ?>"><a href="#">25</a></li>
		<li onclick="LoadDataTable('Courier/Rows/50')" class="my-row-item <?php if($myrow==50){echo'my-row-active';} ?>"><a href="#">50</a></li>
		<li onclick="LoadDataTable('Courier/Rows/75')" class="my-row-item <?php if($myrow==75){echo'my-row-active';} ?>"><a href="#">75</a></li>
		<li onclick="LoadDataTable('Courier/Rows/100')" class="my-row-item <?php if($myrow==100){echo'my-row-active';} ?>"><a href="#">100</a></li>
		</div>

	</div>
		
</div>
<div class="col-sm-6 my-tools-box-col">

<!-- my-page top -->
<div id="my-page-top">
	<?php require_once 'set_page.php'; ?>
</div>
<!-- my-page top -->

</div><!-- col-->
</div><!-- row -->
</div><!-- container-->
</div><!-- tools-box -->



<table class="table table-condensed table-bordered">
<thead>
	
	<th width="30px" class="my-gradation my-th-label">No</th>
	
	<?php if($order_a=='DESC'){ ?>
		<th onclick="LoadDataTable('Courier/Order_a_asc')" class="my-gradation my-th-label">Name<span class="my-glyphicon glyphicon glyphicon-triangle-top"></span></th>
	<?php }elseif($order_a=='ASC'){ ?>
		<th onclick="LoadDataTable('Courier/Order_a_desc')" class="my-gradation my-th-label">Name <span class="my-glyphicon glyphicon glyphicon-triangle-bottom"></span></th>
	<?php } ?>

	<?php if($order_b=='DESC'){ ?>
		<th onclick="LoadDataTable('Courier/Order_b_asc')" class="my-gradation my-th-label">Status <span class="my-glyphicon glyphicon glyphicon-triangle-top"></span></th>
	<?php }elseif($order_b=='ASC'){ ?>
		<th onclick="LoadDataTable('Courier/Order_b_desc')" class="my-gradation my-th-label">Status <span class="my-glyphicon glyphicon glyphicon-triangle-bottom"></span></th>
	<?php } ?>
	
</thead>
<tbody class="my-table-body">
<?php 
if($num_data == 0){
		echo '<tr><td colspan="3"><center>No data</center></td></tr>';
}else{ 
	
	$no = (1+$start);
	
	foreach($result_data as $data){
		
			$onclick_status = 'onclick="StatusBoxShow(&#39;'.enid_get($data->id_courier).'&#39;,
			&#39;'.change_status_value($data->status).'&#39;,
			&#39;'.xxs_filter($data->courier_name).'&#39;,
			&#39;'.status_text($data->status).'&#39;)"';

		/*
		SelectRow(Row,Target,Name,MethodNext,ControllerNext,Identifier,Detail,Delete,Print)
		*/
		
		echo'<tr onclick="SelectRow('.$no.',
		&#39;'.enid_get($data->id_courier).'&#39;,
		&#39;'.xxs_filter($data->courier_name).'&#39;,
		&#39;FormFloatBottomShow&#39;,
		&#39;Courier&#39;,
		&#39;0&#39;,
		1,0,0)" 
		
		ondblclick="FormFloatShow(&#39;Courier/Form/Edit/'.enid_get($data->id_courier).'&#39;)" 
		
		id="my-tr'.$no.'" class="my-tr" >';
		
			echo'<td align="center">'.$no.'</td>';
			echo'<td>'.xxs_filter($data->courier_name).'</td>';
			
			echo'<td align="center"><span class="my-btn-active-status label label-'.status_label($data->status).'" 
			'.$onclick_status.' >'.status($data->status).'</span></td>';
			
		echo'</tr>';
		
		$no++;

	}
}
?>
</tbody>
</table>

<div class="my-tools-box-bottom">

	<?php require_once 'set_btn_bottom.php'; ?>

<!-- my-page bottom -->
<div id="my-page-bottom">
	<?php require_once 'set_page.php'; ?>
</div>
<!-- my-page bottom -->

</div><!-- tools-box-bottom -->