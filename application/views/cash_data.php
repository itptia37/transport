<?php 
defined('BASEPATH') or exit ('No direct script access allowed');
?>

<div class="my-tools-box">
<div class="container-fluid">
<div class="row">
<div class="col-sm-6 my-tools-box-col">

	<div class="btn-group">
	<span class="btn btn-success btn-sm">Cash Data</span>
	
	<a href="#" onclick="FormFloatShow('Cash/Form/Add/<?php echo enid_get(0); ?>')" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus"></span> Add</a>
	
	<span class="btn btn-primary btn-sm">Count : <?php echo $num_data; ?></span>
	<span onclick="RowBoxShow()" class="btn btn-primary btn-sm">Row : <span id="myrow"><?php echo $myrow; ?></span></span>

		<div id="my-row-box" style="display:none;" >
		<li onclick="LoadDataTable('Cash/Rows/25')" class="my-row-item <?php if($myrow==25){echo'my-row-active';} ?>"><a href="#">25</a></li>
		<li onclick="LoadDataTable('Cash/Rows/50')" class="my-row-item <?php if($myrow==50){echo'my-row-active';} ?>"><a href="#">50</a></li>
		<li onclick="LoadDataTable('Cash/Rows/75')" class="my-row-item <?php if($myrow==75){echo'my-row-active';} ?>"><a href="#">75</a></li>
		<li onclick="LoadDataTable('Cash/Rows/100')" class="my-row-item <?php if($myrow==100){echo'my-row-active';} ?>"><a href="#">100</a></li>
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
		<th onclick="LoadDataTable('Cash/Order_a_asc')" class="my-gradation my-th-label">No Faktur <span class="my-glyphicon glyphicon glyphicon-triangle-top"></span></th>
	<?php }elseif($order_a=='ASC'){ ?>
		<th onclick="LoadDataTable('Cash/Order_a_desc')" class="my-gradation my-th-label">No Faktur <span class="my-glyphicon glyphicon glyphicon-triangle-bottom"></span></th>
	<?php } ?>
	
	<?php if($order_b=='DESC'){ ?>
		<th onclick="LoadDataTable('Cash/Order_b_asc')" class="my-gradation my-th-label">Name <span class="my-glyphicon glyphicon glyphicon-triangle-top"></span></th>
	<?php }elseif($order_b=='ASC'){ ?>
		<th onclick="LoadDataTable('Cash/Order_b_desc')" class="my-gradation my-th-label">Name <span class="my-glyphicon glyphicon glyphicon-triangle-bottom"></span></th>
	<?php } ?>
		<th width="10px" onclick="FilterListBoxShow('my-filter-receiver','Cash/Filter_Search_List_Receiver','FilterListDataReceiver','input_src_receiver')" 
		class="my-gradation my-th-label" >
			<span class="my-filter my-glyphicon glyphicon glyphicon-filter"></span>
		</th>
		
	<?php if($order_c=='DESC'){ ?>
		<th onclick="LoadDataTable('Cash/Order_c_asc')" class="my-gradation my-th-label">Amount <span class="my-glyphicon glyphicon glyphicon-triangle-top"></span></th>
	<?php }elseif($order_c=='ASC'){ ?>
		<th onclick="LoadDataTable('Cash/Order_c_desc')" class="my-gradation my-th-label">Amount <span class="my-glyphicon glyphicon glyphicon-triangle-bottom"></span></th>
	<?php } ?>
	
	<?php if($order_d=='DESC'){ ?>
		<th onclick="LoadDataTable('Cash/Order_d_asc')" class="my-gradation my-th-label">Start <span class="my-glyphicon glyphicon glyphicon-triangle-top"></span></th>
	<?php }elseif($order_d=='ASC'){ ?>
		<th onclick="LoadDataTable('Cash/Order_d_desc')" class="my-gradation my-th-label">Start <span class="my-glyphicon glyphicon glyphicon-triangle-bottom"></span></th>
	<?php } ?>
		<th width="10px" onclick="FilterDateBoxShow('my-filter-date-start')" class="my-gradation my-th-label" >
			<span class="my-filter my-glyphicon glyphicon glyphicon-filter"></span>
		</th>
	
	<th class="my-gradation my-th-label">End</th>
	
	<?php if($order_e=='DESC'){ ?>
		<th onclick="LoadDataTable('Cash/Order_e_asc')" class="my-gradation my-th-label">Status <span class="my-glyphicon glyphicon glyphicon-triangle-top"></span></th>
	<?php }elseif($order_e=='ASC'){ ?>
		<th onclick="LoadDataTable('Cash/Order_e_desc')" class="my-gradation my-th-label">Status <span class="my-glyphicon glyphicon glyphicon-triangle-bottom"></span></th>
	<?php } ?>
		<th width="10px" onclick="FilterBoxShow('my-filter-status')" class="my-gradation my-th-label" >
			<span class="my-filter my-glyphicon glyphicon glyphicon-filter"></span>
		</th>
	
	<th class="my-gradation my-th-label" width="90px">PTJ View</th>
	
</thead>
<tbody class="my-table-body">
<?php 
if($num_data == 0){
		echo '<tr><td colspan="12"><center>No data</center></td></tr>';
}else{ 
	
	$no = (1+$start);
	
	foreach($result_data as $data){
		
		/*if($data->status == 1) {
			$onclick_status = 'onclick="StatusBoxShow(&#39;'.enid_get($data->id_cash).'&#39;,
			&#39;'.change_status_value($data->status).'&#39;,
			&#39;'.xxs_filter($data->no_cash).'&#39;,
			&#39;'.status_text($data->status).'&#39;)"';
		}else{
			$onclick_status = '';
		}
		/*
		SelectRow(Row,Target,Name,MethodNext,ControllerNext,Identifier,Detail,Delete,Print)
		*/
		
		if($data->end_date == my_date()){$x='style="color:red;"';}else{$x='';}
			
		echo'<tr '.$x.' onclick="SelectRow('.$no.',
		&#39;'.enid_get($data->id_cash).'&#39;,
		&#39;'.xxs_filter($data->no_cash).'&#39;,
		&#39;FormFloatBottomShow&#39;,
		&#39;Cash&#39;,
		&#39;0&#39;,
		1,0,0)" 
		
		ondblclick="FormFloatShow(&#39;Cash/Form/Edit/'.enid_get($data->id_cash).'&#39;)" 
		
		id="my-tr'.$no.'" class="my-tr" >';
		
				
			echo'<td align="center">'.$no.'</td>';
			echo'<td>'.xxs_filter($data->no_cash).'</td>';
			echo'<td colspan="2">'.xxs_filter($data->receiver_name).'</td>';
			echo'<td>'.curr_ind(xxs_filter($data->amount)).'</td>';
			echo'<td colspan="2">'.date_ind(xxs_filter($data->start_date)).'</td>';
			echo'<td>'.date_ind(xxs_filter($data->end_date)).'</td>';
			echo'<td align="center" colspan="2">
			<span class="my-btn-active-status label label-'.status_label_cash($data->status).'" 
			 >'.status_cash($data->status).'</span></td>';
			
		
			echo'<td align="center">';
			if($data->status < 3){
				echo'<a href="#" onclick="FormFloatShow(&#39;Cash/Form/PTJ/'.enid_get($data->id_cash).'&#39;)"
				class="btn btn-primary btn-xs">view</a>';
			}
			echo'</td>';
			
			
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