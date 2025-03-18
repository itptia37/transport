<?php 
defined('BASEPATH') or exit ('No direct script access allowed');
?>

<div class="my-tools-box">
<div class="container-fluid">
<div class="row">
<div class="col-sm-6 my-tools-box-col">

	<div class="btn-group">
	<span class="btn btn-success btn-sm">Request Driver</span>
	
	<a href="#" onkeypress="ERequest_Driver(event,'myform')" onclick="LoadContent('Request_Driver/Form/Add/<?php echo enid_get(0); ?>')" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus"></span> Add</a>
	
	<span class="btn btn-primary btn-sm">Count : <?php echo $num_data; ?></span>
	<span onclick="RowBoxShow()" class="btn btn-primary btn-sm">Row : <span id="myrow"><?php echo $myrow; ?></span></span>
	
		<div id="my-row-box" style="display:none;">
		<li onclick="LoadDataTable('Request_Driver/Rows/25')" class="my-row-item <?php if($myrow==25){echo'my-row-active';} ?>"><a href="#">25</a></li>
		<li onclick="LoadDataTable('Request_Driver/Rows/50')" class="my-row-item <?php if($myrow==50){echo'my-row-active';} ?>"><a href="#">50</a></li>
		<li onclick="LoadDataTable('Request_Driver/Rows/75')" class="my-row-item <?php if($myrow==75){echo'my-row-active';} ?>"><a href="#">75</a></li>
		<li onclick="LoadDataTable('Request_Driver/Rows/100')" class="my-row-item <?php if($myrow==100){echo'my-row-active';} ?>"><a href="#">100</a></li>
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
		<th width="130px" onclick="LoadDataTable('Request_Driver/Order_a_asc')" class="my-gradation my-th-label">No Request <span class="my-glyphicon glyphicon glyphicon-triangle-top"></span></th>
	<?php }elseif($order_a=='ASC'){ ?>
		<th width="130px" onclick="LoadDataTable('Request_Driver/Order_a_desc')" class="my-gradation my-th-label">No Request <span class="my-glyphicon glyphicon glyphicon-triangle-bottom"></span></th>
	<?php } ?>

	<?php if($order_b=='DESC'){ ?>
		<th onclick="LoadDataTable('Request_Driver/Order_b_asc')" class="my-gradation my-th-label">Requestor <span class="my-glyphicon glyphicon glyphicon-triangle-top"></span></th>
	<?php }elseif($order_b=='ASC'){ ?>
		<th onclick="LoadDataTable('Request_Driver/Order_b_desc')" class="my-gradation my-th-label">Requestor <span class="my-glyphicon glyphicon glyphicon-triangle-bottom"></span></th>
	<?php } ?>	
	
	<?php if($order_c=='DESC'){ ?>
		<th width="90px" onclick="LoadDataTable('Request_Driver/Order_c_asc')" class="my-gradation my-th-label">Departure <span class="my-glyphicon glyphicon glyphicon-triangle-top"></span></th>
	<?php }elseif($order_c=='ASC'){ ?>
		<th width="90px" onclick="LoadDataTable('Request_Driver/Order_c_desc')" class="my-gradation my-th-label">Departure <span class="my-glyphicon glyphicon glyphicon-triangle-bottom"></span></th>
	<?php } ?>
	
	<?php if($order_d=='DESC'){ ?>
		<th width="80px" onclick="LoadDataTable('Request_Driver/Order_d_asc')" class="my-gradation my-th-label">Return <span class="my-glyphicon glyphicon glyphicon-triangle-top"></span></th>
	<?php }elseif($order_d=='ASC'){ ?>
		<th width="80px" onclick="LoadDataTable('Request_Driver/Order_d_desc')" class="my-gradation my-th-label">Return <span class="my-glyphicon glyphicon glyphicon-triangle-bottom"></span></th>
	<?php } ?>
	
	<?php if($order_e=='DESC'){ ?>
		<th onclick="LoadDataTable('Request_Driver/Order_e_asc')" class="my-gradation my-th-label">Description <span class="my-glyphicon glyphicon glyphicon-triangle-top"></span></th>
	<?php }elseif($order_e=='ASC'){ ?>
		<th onclick="LoadDataTable('Request_Driver/Order_e_desc')" class="my-gradation my-th-label">Description <span class="my-glyphicon glyphicon glyphicon-triangle-bottom"></span></th>
	<?php } ?>
	
	<?php if($order_f=='DESC'){ ?>
		<th onclick="LoadDataTable('Request_Driver/Order_f_asc')" class="my-gradation my-th-label">Detail <span class="my-glyphicon glyphicon glyphicon-triangle-top"></span></th>
	<?php }elseif($order_f=='ASC'){ ?>
		<th onclick="LoadDataTable('Request_Driver/Order_f_desc')" class="my-gradation my-th-label">Detail <span class="my-glyphicon glyphicon glyphicon-triangle-bottom"></span></th>
	<?php } ?>
	
	<th width="110px" class="my-gradation my-th-label">Total</th>
	
	<?php if($order_g=='DESC'){ ?>
		<th width="90px" onclick="LoadDataTable('Request_Driver/Order_g_asc')" class="my-gradation my-th-label">Status <span class="my-glyphicon glyphicon glyphicon-triangle-top"></span></th>
	<?php }elseif($order_g=='ASC'){ ?>
		<th width="90px" onclick="LoadDataTable('Request_Driver/Order_g_desc')" class="my-gradation my-th-label">Status <span class="my-glyphicon glyphicon glyphicon-triangle-bottom"></span></th>
	<?php } ?>
	

</thead>
<tbody class="my-table-body">
<?php 
$start_date	= '';
$finish_date= '';
$detail 	= '';
$kilometer	= '';
$total		= '';
$br			= '';
if($num_data==0){
		echo '<tr><td colspan="9"><center>No data</center></td></tr>';
}else{

	$no = (1+$start);
	
	foreach($result_data as $data){
		
		$dt = $this->M_Global->M_Request_Sum($data->id_request,1)->row();
		$total = '';
		
		/*
		SelectRow(Row,Target,Name,MethodNext,ControllerNext,Identifier,Detail,Delete,Print)
		*/
		
		echo'<tr onclick="SelectRow('.$no.',
		&#39;'.enid_get($data->id_request).'&#39;,
		&#39;'.xxs_filter($data->no_request).'&#39;,
		&#39;LoadContentBottom&#39;,
		&#39;Request_Driver&#39;,
		&#39;0&#39;,
		1,0,1)" 
		
		ondblclick="LoadContent(&#39;Request_Driver/Form/Edit/'.enid_get($data->id_request).'&#39;)"
		
		id="my-tr'.$no.'" class="my-tr" >';
			
			echo'<td valign="top" align="center">'.$no.'</td>';
			echo'<td valign="top">'.$data->no_request.'</td>';
			
			echo'<td valign="top">';
				echo my_user_name($data->requestor,$data->requestor_email);
			echo'</td>';
			
			echo'<td valign="top"><b class="imp">';			
				if(date_ind(xxs_filter($data->start_date)) != '' && $data->start_time != '')
				{ echo date_ind(xxs_filter($data->start_date)).'<br>'.$data->start_time;}			
			echo'</b></td>';
			
			echo'<td valign="top">';
				if(date_ind(xxs_filter($data->finish_date)) != '' && $data->finish_time != '')
				{ echo date_ind(xxs_filter($data->finish_date)).'<br>'.$data->finish_time;}		
			echo'</td>';		
			
			echo'<td valign="top">';
				echo '<b>'.$data->company_name.'</b>,&nbsp;';
				echo '<b class="blue">'.$data->expense_purpose_name.'</b>,&nbsp;';
				echo'Request <b class="imp">'.$data->request_option_name.'</b>,&nbsp;';
				echo'Destination '.xxs_filter(description_limit($data->destination.', '.$data->description));
				if(xxs_filter($data->begin_km) > 0){ 
					echo'<br>Kilometer '.xxs_filter($data->begin_km).'-'.xxs_filter($data->end_km);
				}
				if(xxs_filter($data->project_number) > 0){
					echo '&nbsp;('.$data->project_number.')';
				}
			echo'</td>';
			
			echo'<td valign="top">';
				if($data->external > 0){			
						
						echo'<b>External</b> <b class="imp">'.xxs_filter($data->external_name).'</b>';
						
					}elseif($data->external <=0){
					
						if($data->request_option == 1 && $data->status > 1 ){
							
							$i = ''; $j = ''; $k = '';
							if($data->driver > 0) { $i = '<b>Driver</b> <b class="imp">'.xxs_filter($data->driver_name).'</b>';}
							if($data->car > 0) { $j = '<b>Car</b> <b class="imp">'.xxs_filter($data->car_name).'</b>';}
							if($i != '' && $j != ''){$k = ', ';}
							
							echo $i.$k.$j;
						
						}elseif($data->request_option == 2 && $data->status > 1 && $data->driver > 0){
						
							echo'<b>Driver</b> <b class="imp">'.xxs_filter($data->driver_name).'</b>';
						
						}elseif($data->request_option == 3 && $data->status > 1 && $data->car > 0 ){
					
							echo'<b>Car</b> <b class="imp">'.xxs_filter($data->car_name).'</b>';
					
						}
					}
			echo'</td>';
			
			echo'<td valign="top" align="right">'.curr_ind($dt->total).'</td>';
			
			echo'<td align="center"><span class="my-btn-active-status label label-'.status_label_transaction($data->status).'" >'.status_transaction($data->status).'</span></td>';
			
			/* asli 
			echo'<td align="center"><span class="my-btn-active-status label label-'.status_label_transaction($data->status).'" 
			'.$onclick_status.' >'.status_transaction($data->status).'</span></td>';
			*/
			
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