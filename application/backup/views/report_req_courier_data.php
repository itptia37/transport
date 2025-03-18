<?php 
defined('BASEPATH') or exit ('No direct script access allowed');
?>

<div class="my-tools-box">
<div class="container-fluid">
<div class="row">
<div class="col-sm-6 my-tools-box-col">

	<div class="btn-group">
	<span class="btn btn-success btn-sm">Report Request Courier</span>
	
	<span class="btn btn-primary btn-sm">Count : <?php echo $num_data; ?></span>
	<span onclick="RowBoxShow()" class="btn btn-primary btn-sm">Row : <span id="myrow"><?php echo $myrow; ?></span></span>
	
		<div id="my-row-box" style="display:none;">
		<li onclick="LoadDataTable('Report_Request_Courier/Rows/25')" class="my-row-item <?php if($myrow==25){echo'my-row-active';} ?>"><a href="#">25</a></li>
		<li onclick="LoadDataTable('Report_Request_Courier/Rows/50')" class="my-row-item <?php if($myrow==50){echo'my-row-active';} ?>"><a href="#">50</a></li>
		<li onclick="LoadDataTable('Report_Request_Courier/Rows/75')" class="my-row-item <?php if($myrow==75){echo'my-row-active';} ?>"><a href="#">75</a></li>
		<li onclick="LoadDataTable('Report_Request_Courier/Rows/100')" class="my-row-item <?php if($myrow==100){echo'my-row-active';} ?>"><a href="#">100</a></li>
		</div>
		
	<span onclick="ExportBoxShow()" class="btn btn-primary btn-sm">Export</span>
	
		<div id="my-export-box" style="display:none;" >
		<li><a target="_blank" href="<?php echo base_url(); ?>Report_Request_Courier/Export/html">Html</a></li>
		<li><a target="_blank" href="<?php echo base_url(); ?>Report_Request_Courier/Export/excel">Ms. Excel</a></li>
		<li><a target="_blank" href="<?php echo base_url(); ?>Report_Request_Courier/Export/word">Ms. Word</a></li>
		<li><a target="_blank" href="<?php echo base_url(); ?>Report_Request_Courier/Export/pdf">PDF</a></li>
		</div>
		
	<!--
	<span onclick="SummaryBoxShow()" class="btn btn-primary btn-sm">View Summary</span>
	
		<div id="my-summary-box" style="display:none;" >
		<li><a href="#">Requestor</a></li>
		<li><a href="#">Courier</a></li>
		<li><a href="#">Expense</a></li>
		</div>
		-->
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
		<th width="160px" onclick="LoadDataTable('Report_Request_Courier/Order_a_asc')" class="my-gradation my-th-label">No Request <span class="my-glyphicon glyphicon glyphicon-triangle-top"></span></th>
	<?php }elseif($order_a=='ASC'){ ?>
		<th width="160px" onclick="LoadDataTable('Report_Request_Courier/Order_a_desc')" class="my-gradation my-th-label">No Request <span class="my-glyphicon glyphicon glyphicon-triangle-bottom"></span></th>
	<?php } ?>
		
	<?php if($order_b=='DESC'){ ?>
		<th width="100px" onclick="LoadDataTable('Report_Request_Courier/Order_b_asc')" class="my-gradation my-th-label">Requestor <span class="my-glyphicon glyphicon glyphicon-triangle-top"></span></th>
	<?php }elseif($order_b=='ASC'){ ?>
		<th width="100px" onclick="LoadDataTable('Report_Request_Courier/Order_b_desc')" class="my-gradation my-th-label">Requestor <span class="my-glyphicon glyphicon glyphicon-triangle-bottom"></span></th>
	<?php } ?>
		<th width="10px" onclick="FilterListBoxShow('my-filter-requestor','Report_Request_Courier/Filter_Search_List_Requestor','FilterListDataRequestor','input_src_requestor')" class="my-gradation my-th-label" >
			<span class="my-filter my-glyphicon glyphicon glyphicon-filter"></span>
		</th>
		
	<?php if($order_h=='DESC'){ ?>
		<th width="100px" onclick="LoadDataTable('Report_Request_Courier/Order_h_asc')" class="my-gradation my-th-label">Department <span class="my-glyphicon glyphicon glyphicon-triangle-top"></span></th>
	<?php }elseif($order_h=='ASC'){ ?>
		<th width="100px" onclick="LoadDataTable('Report_Request_Courier/Order_h_desc')" class="my-gradation my-th-label">Department <span class="my-glyphicon glyphicon glyphicon-triangle-bottom"></span></th>
	<?php } ?>
		<th width="10px" onclick="FilterListBoxShow('my-filter-department','Report_Request_Courier/Filter_Search_List_Department','FilterListDataDepartment','input_src_department')" class="my-gradation my-th-label" >
			<span class="my-filter my-glyphicon glyphicon glyphicon-filter"></span>
		</th>
	
	<?php if($order_c=='DESC'){ ?>
		<th width="90px" onclick="LoadDataTable('Report_Request_Courier/Order_c_asc')" class="my-gradation my-th-label">Departure <span class="my-glyphicon glyphicon glyphicon-triangle-top"></span></th>
	<?php }elseif($order_c=='ASC'){ ?>
		<th width="90px" onclick="LoadDataTable('Report_Request_Courier/Order_c_desc')" class="my-gradation my-th-label">Departure <span class="my-glyphicon glyphicon glyphicon-triangle-bottom"></span></th>
	<?php } ?>
		<th width="10px" onclick="FilterDateBoxShow('my-filter-date-start')" class="my-gradation my-th-label" >
			<span class="my-filter my-glyphicon glyphicon glyphicon-filter"></span>
		</th>
	
	<?php if($order_d=='DESC'){ ?>
		<th width="80px" onclick="LoadDataTable('Report_Request_Courier/Order_d_asc')" class="my-gradation my-th-label">Return <span class="my-glyphicon glyphicon glyphicon-triangle-top"></span></th>
	<?php }elseif($order_d=='ASC'){ ?>
		<th width="80px" onclick="LoadDataTable('Report_Request_Courier/Order_d_desc')" class="my-gradation my-th-label">Return <span class="my-glyphicon glyphicon glyphicon-triangle-bottom"></span></th>
	<?php } ?>
	
	<?php if($order_e=='DESC'){ ?>
		<th onclick="LoadDataTable('Report_Request_Courier/Order_e_asc')" class="my-gradation my-th-label">Description <span class="my-glyphicon glyphicon glyphicon-triangle-top"></span></th>
	<?php }elseif($order_e=='ASC'){ ?>
		<th onclick="LoadDataTable('Report_Request_Courier/Order_e_desc')" class="my-gradation my-th-label">Description <span class="my-glyphicon glyphicon glyphicon-triangle-bottom"></span></th>
	<?php } ?>
		<th width="10px" onclick="FilterListBoxShow('my-filter-purpose','Report_Request_Courier/Filter_Search_List_Purpose','FilterListDataPurpose','input_src_purpose')" class="my-gradation my-th-label" >
			<span class="my-filter my-glyphicon glyphicon glyphicon-filter"></span>
		</th>
		<th width="10px" onclick="FilterListBoxShow('my-filter-request','Report_Request_Courier/Filter_Search_List_Request','FilterListDataRequest','input_src_request')" class="my-gradation my-th-label" >
			<span class="my-filter my-glyphicon glyphicon glyphicon-filter"></span>
		</th>
		
	<?php if($order_f=='DESC'){ ?>
		<th onclick="LoadDataTable('Report_Request_Courier/Order_f_asc')" class="my-gradation my-th-label">Detail <span class="my-glyphicon glyphicon glyphicon-triangle-top"></span></th>
	<?php }elseif($order_f=='ASC'){ ?>
		<th onclick="LoadDataTable('Report_Request_Courier/Order_f_desc')" class="my-gradation my-th-label">Detail <span class="my-glyphicon glyphicon glyphicon-triangle-bottom"></span></th>
	<?php } ?>
		<th width="10px" onclick="FilterListBoxShow('my-filter-courier','Report_Request_Courier/Filter_Search_List_Courier','FilterListDataCourier','input_src_courier')" class="my-gradation my-th-label" >
			<span class="my-filter my-glyphicon glyphicon glyphicon-filter"></span>
		</th>
		
	<th width="90px" class="my-gradation my-th-label">Delivery</span></th>
	
	
	<th width="110px" class="my-gradation my-th-label">Balance</span></th>
		<th width="10px" onclick="FilterBoxShow('my-filter-balance')" class="my-gradation my-th-label" >
			<span class="my-filter my-glyphicon glyphicon glyphicon-filter"></span>
		</th>
		
	<?php if($order_g=='DESC'){ ?>
		<th width="80px" onclick="LoadDataTable('Report_Request_Courier/Order_g_asc')" class="my-gradation my-th-label">Status <span class="my-glyphicon glyphicon glyphicon-triangle-top"></span></th>
	<?php }elseif($order_g=='ASC'){ ?>
		<th width="80px" onclick="LoadDataTable('Report_Request_Courier/Order_g_desc')" class="my-gradation my-th-label">Status <span class="my-glyphicon glyphicon glyphicon-triangle-bottom"></span></th>
	<?php } ?>
		<th width="10px" onclick="FilterBoxShow('my-filter-status')" class="my-gradation my-th-label" >
			<span class="my-filter my-glyphicon glyphicon glyphicon-filter"></span>
		</th>
	

</thead>
<tbody class="my-table-body">
<?php 
$start_date	= '';
$finish_date= '';
$detail 	= '';
$total		= '';
$br			= '';
if($num_data==0){
		echo '<tr><td colspan="20"><center>No data</center></td></tr>';
}else{

	$no = (1+$start);
	
	foreach($result_data as $data){
		
		$dt 	= $this->M_Global->M_Request_Sum($data->id_request,2)->row();
		
		/*
		SelectRow(Row,Target,Name,MethodNext,ControllerNext,Identifier,Detail,Delete,Print)
		*/
		
		echo'<tr onclick="SelectRow('.$no.',
		&#39;'.enid_get($data->id_request).'&#39;,
		&#39;'.xxs_filter($data->no_request).'&#39;,
		&#39;LoadContentBottom&#39;,
		&#39;Report_Request_Courier&#39;,
		&#39;0&#39;,
		1,0,1)" 
		
		ondblclick="LoadContent(&#39;Report_Request_Courier/Form/Edit/'.enid_get($data->id_request).'&#39;)"
		
		id="my-tr'.$no.'" class="my-tr" >';
			
			echo'<td valign="top" align="center">'.$no.'</td>';
			echo'<td valign="top">'.$data->no_request.'</td>';
			
			echo'<td valign="top" colspan="2">';
				echo my_user_name($data->requestor,$data->requestor_email);
			echo'</td>';
			
			echo'<td valign="top" colspan="2">'.$data->department.'</td>';
			
			echo'<td valign="top" colspan="2">';			
				if(date_ind(xxs_filter($data->start_date)) != '' && $data->start_time != '')
				{ echo date_ind(xxs_filter($data->start_date)).'<br>'.$data->start_time;}				
			echo'</td>';
			
			echo'<td valign="top">';
				if(date_ind(xxs_filter($data->finish_date)) != '' && $data->finish_time != '')
				{ echo date_ind(xxs_filter($data->finish_date)).'<br>'.$data->finish_time;}		
			echo'</td>';		
			
			echo'<td valign="top" colspan="3">';
				echo '<b>'.$data->company_name.'</b>,&nbsp;';
				echo '<b class="blue">'.$data->expense_purpose_name.'</b>,&nbsp;';
				echo'Request <b class="imp">'.$data->request_option_name.'</b>,&nbsp;';
				echo'Destination '.xxs_filter(description_limit($data->destination.', '.$data->description));
				
			echo'</td>';
			
			echo'<td valign="top" colspan="2">';
				if($data->external > 0 ){			
						
						echo'<b>External</b> <b class="imp">'.xxs_filter($data->external_name).'</b>';
						
					}else{
						if($data->courier > 0){
					
							echo'<b>Courier</b> <b class="imp">'.xxs_filter($data->courier_name).'</b>';
						
						}
					}
			echo'</td>';
			
			echo'<td valign="top">'.$data->delivery_name.'</td>';
			echo'<td valign="top" colspan="2" align="right">'.curr_ind($dt->total).'</td>';
			
			echo'<td align="center" colspan="2">
			<span class="my-btn-active-status label label-'.status_label_transaction($data->status).'" >'.status_transaction($data->status).'</span></td>';
			
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