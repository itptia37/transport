<?php 
defined('BASEPATH') or exit ('No direct script access allowed');
?>

<div class="my-tools-box">
<div class="container-fluid">
<div class="row">
<div class="col-sm-6 my-tools-box-col">

	<div class="btn-group">
	<span class="btn btn-success btn-sm">Report Petty Cash Close Data</span>
	
	<span class="btn btn-primary btn-sm">Count : <?php echo $num_data; ?></span>
	<span onclick="RowBoxShow()" class="btn btn-primary btn-sm">Row : <span id="myrow"><?php echo $myrow; ?></span></span>
	
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
		<th onclick="LoadDataTable('Report_Petty_Cash_Close/Order_a_asc')" class="my-gradation my-th-label">Created <span class="my-glyphicon glyphicon glyphicon-triangle-top"></span></th>
	<?php }elseif($order_a=='ASC'){ ?>
		<th onclick="LoadDataTable('Report_Petty_Cash_Close/Order_a_desc')" class="my-gradation my-th-label">Created <span class="my-glyphicon glyphicon glyphicon-triangle-bottom"></span></th>
	<?php } ?>

	<?php if($order_b=='DESC'){ ?>
		<th onclick="LoadDataTable('Report_Petty_Cash_Close/Order_b_asc')" class="my-gradation my-th-label">Name <span class="my-glyphicon glyphicon glyphicon-triangle-top"></span></th>
	<?php }elseif($order_b=='ASC'){ ?>
		<th onclick="LoadDataTable('Report_Petty_Cash_Close/Order_b_desc')" class="my-gradation my-th-label">Name <span class="my-glyphicon glyphicon glyphicon-triangle-bottom"></span></th>
	<?php } ?>
		
		<th class="my-gradation my-th-label">Description</th>
		
		<th width="30px" class="my-gradation my-th-label"></th>
	
</thead>
<tbody class="my-table-body">
<?php 
if($num_data == 0){
		echo '<tr><td colspan="5"><center>No data</center></td></tr>';
}else{ 
	
	$no = (1+$start);
	
	foreach($result_data as $data){
		
			echo'<tr onclick="SelectRowNormal('.$no.')" id="my-tr'.$no.'" class="my-tr" >';
		
			echo'<td align="center">'.$no.'</td>';
			echo'<td>'.date_ind($data->created_date).' '.$data->created_time.'</td>';			
			echo'<td>'.xxs_filter($data->name).'</td>';
			echo'<td>'.xxs_filter($data->description).'</td>';
			echo'<td><span class="btn btn-primary btn-xs" onclick="LoadContent(&#39;Report_Petty_Cash_Close/View/'.enid_get($data->id_proccess).'&#39;)" 
			>View</span>';
		echo'</tr>';
		
		$no++;

	}
}
?>
</tbody>
</table>

<div class="my-tools-box-bottom">

	<div class="my-action-bottom">
		<span id="SelectedRowIndexData"></span>
		<span id="SelectedRowNameData"></span>
		<span id="BtnEdit"></span>		
		<span id="BtnDelete"></span>		
	</div><!-- my-action-bottom -->

<!-- my-page bottom -->
<div id="my-page-bottom">
	<?php require_once 'set_page.php'; ?>
</div>
<!-- my-page bottom -->

</div><!-- tools-box-bottom -->