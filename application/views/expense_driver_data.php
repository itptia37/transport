<?php 
defined('BASEPATH') or exit ('No direct script access allowed');
$no = 1;
$grandtotal_driver = 0;
?>

<div class="my-tools-box">
<div class="container-fluid">
<div class="row">
<div class="col-sm-6 my-tools-box-col">

	<div class="btn-group">
	<span class="btn btn-success btn-sm">Expense Driver</span>
	
	<a href="#" onclick="FormFloatShow('Expense_Driver/Form/Add/<?php echo enid_get(0); ?>/<?php echo enid_get(0); ?>')" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus"></span> Add</a>
	
	<span class="btn btn-primary btn-sm">Count : <?php echo $num_data; ?></span>
	<span onclick="RowBoxShow()" class="btn btn-primary btn-sm">Row : <span id="myrow"><?php echo $myrow; ?></span></span>
	
		<div id="my-row-box" style="display:none;">
		<li onclick="LoadDataTable('Expense_Driver/Rows/25')" class="my-row-item <?php if($myrow==25){echo'my-row-active';} ?>"><a href="#">25</a></li>
		<li onclick="LoadDataTable('Expense_Driver/Rows/50')" class="my-row-item <?php if($myrow==50){echo'my-row-active';} ?>"><a href="#">50</a></li>
		<li onclick="LoadDataTable('Expense_Driver/Rows/75')" class="my-row-item <?php if($myrow==75){echo'my-row-active';} ?>"><a href="#">75</a></li>
		<li onclick="LoadDataTable('Expense_Driver/Rows/100')" class="my-row-item <?php if($myrow==100){echo'my-row-active';} ?>"><a href="#">100</a></li>
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
		<th width="160px" onclick="LoadDataTable('Expense_Driver/Order_a_asc')" class="my-gradation my-th-label">No Request <span class="my-glyphicon glyphicon glyphicon-triangle-top"></span></th>
	<?php }elseif($order_a=='ASC'){ ?>
		<th width="160px" onclick="LoadDataTable('Expense_Driver/Order_a_desc')" class="my-gradation my-th-label">No Request <span class="my-glyphicon glyphicon glyphicon-triangle-bottom"></span></th>
	<?php } ?>

	<?php if($order_b=='DESC'){ ?>
		<th onclick="LoadDataTable('Expense_Driver/Order_b_asc')" class="my-gradation my-th-label">Driver / External <span class="my-glyphicon glyphicon glyphicon-triangle-top"></span></th>
	<?php }elseif($order_b=='ASC'){ ?>
		<th onclick="LoadDataTable('Expense_Driver/Order_b_desc')" class="my-gradation my-th-label">Driver / External <span class="my-glyphicon glyphicon glyphicon-triangle-bottom"></span></th>
	<?php } ?>	
		<th width="10px" onclick="FilterListBoxShow('my-filter-driver','Expense_Driver/Filter_Search_List_Driver','FilterListDataDriver','input_src_driver')" 
		class="my-gradation my-th-label" >
			<span class="my-filter my-glyphicon glyphicon glyphicon-filter"></span>
		</th>
	
	<?php
		foreach($result_data_expense_header as $data_th){
			echo'<td class="my-gradation my-th-label">'.$data_th->name.'</td>';
		}
	?>
		
		<td class="my-gradation my-th-label">Total</td>
		<td class="my-gradation my-th-label">-</td>

</thead>
<tbody class="my-table-body">
<?php 

if($num_data==0){
		echo '<tr><td colspan="'.($num_expense_header+6).'"><center>No data</center></td></tr>';
}else{

	$no = (1+$start);
	
	foreach($result_data as $data){
		
		echo'<tr onclick="SelectRowNormal('.$no.')" id="my-tr'.$no.'" class="my-tr" >';		
	
			echo'<td valign="top" align="center">'.$no.'</td>';
			echo'<td valign="top">'.$data->no_request.'</td>';
			
			echo'<td valign="top" colspan="2">';
				if($data->driver > 0) { echo xxs_filter($data->driver_name); }
					else if($data->external > 0) { echo xxs_filter($data->external_name); }
			echo'</td>';
			
			foreach($result_data_expense_header as $data_th){
				echo'<td align="right" width="110px">';
				
					$query_petty_driver = $this->M_Report_Petty_Cash->M_Expense_Detail($data_th->id_parameter,$data->id_request,1);
					if($query_petty_driver->num_rows() > 0){
						$petty_driver = $query_petty_driver->row();
						echo curr_ind(xxs_filter($petty_driver->balance));
					}
					
				echo'</td>';
			}
			
			$result_total_driver = $this->M_Report_Petty_Cash->M_Expense_Total($data->id_request,1)->row();
			echo'<td align="right">'.curr_ind($result_total_driver->total).'</td>';
			echo'<td align="center">';
				if($data->id_proccess <= 0){
					echo '<a href="#" onclick="FormFloatShow(&#39;Expense_Driver/Form/Add/'.enid_get($data->id_request).'/'.enid_get(0).'&#39;)" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>';
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