<?php 
defined('BASEPATH') or exit ('No direct script access allowed');
?>

<div class="my-tools-box">
<div class="container-fluid">
<div class="row">
<div class="col-sm-6 my-tools-box-col">

	<div class="btn-group">
	<span class="btn btn-success btn-sm">User Data</span>
	
	<a href="#" onkeypress="EUser(event,'myform')" onclick="FormFloatShow('User/Form/Add/<?php echo enid_get(0); ?>')" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus"></span> Add</a>
	
	<span class="btn btn-primary btn-sm">Count : <?php echo $num_data; ?></span>
	<span onclick="RowBoxShow()" class="btn btn-primary btn-sm">Row : <span id="myrow"><?php echo $myrow; ?></span></span>

		<div id="my-row-box" style="display:none;" >
		<li onclick="LoadDataTable('User/Rows/25')" class="my-row-item <?php if($myrow==25){echo'my-row-active';} ?>"><a href="#">25</a></li>
		<li onclick="LoadDataTable('User/Rows/50')" class="my-row-item <?php if($myrow==50){echo'my-row-active';} ?>"><a href="#">50</a></li>
		<li onclick="LoadDataTable('User/Rows/75')" class="my-row-item <?php if($myrow==75){echo'my-row-active';} ?>"><a href="#">75</a></li>
		<li onclick="LoadDataTable('User/Rows/100')" class="my-row-item <?php if($myrow==100){echo'my-row-active';} ?>"><a href="#">100</a></li>
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
		<th onclick="LoadDataTable('User/Order_a_asc')" class="my-gradation my-th-label">Name<span class="my-glyphicon glyphicon glyphicon-triangle-top"></span></th>
	<?php }elseif($order_a=='ASC'){ ?>
		<th onclick="LoadDataTable('User/Order_a_desc')" class="my-gradation my-th-label">Name <span class="my-glyphicon glyphicon glyphicon-triangle-bottom"></span></th>
	<?php } ?>

	<?php if($order_b=='DESC'){ ?>
		<th onclick="LoadDataTable('User/Order_b_asc')" class="my-gradation my-th-label">Email <span class="my-glyphicon glyphicon glyphicon-triangle-top"></span></th>
	<?php }elseif($order_b=='ASC'){ ?>
		<th onclick="LoadDataTable('User/Order_b_desc')" class="my-gradation my-th-label">Email <span class="my-glyphicon glyphicon glyphicon-triangle-bottom"></span></th>
	<?php } ?>	
	
	<?php if($order_c=='DESC'){ ?>
		<th onclick="LoadDataTable('User/Order_c_asc')" class="my-gradation my-th-label">Access <span class="my-glyphicon glyphicon glyphicon-triangle-top"></span></th>
	<?php }elseif($order_c=='ASC'){ ?>
		<th onclick="LoadDataTable('User/Order_c_desc')" class="my-gradation my-th-label">Access <span class="my-glyphicon glyphicon glyphicon-triangle-bottom"></span></th>
	<?php } ?>	
	
	<?php if($order_d=='DESC'){ ?>
		<th onclick="LoadDataTable('User/Order_d_asc')" class="my-gradation my-th-label">Status <span class="my-glyphicon glyphicon glyphicon-triangle-top"></span></th>
	<?php }elseif($order_d=='ASC'){ ?>
		<th onclick="LoadDataTable('User/Order_d_desc')" class="my-gradation my-th-label">Status <span class="my-glyphicon glyphicon glyphicon-triangle-bottom"></span></th>
	<?php } ?>
	
</thead>
<tbody class="my-table-body">
<?php 
if($num_data == 0){
		echo '<tr><td colspan="5"><center>No data</center></td></tr>';
}else{ 
	
	$no = (1+$start);
	
	foreach($result_data as $data){
		
			$onclick_status = 'onclick="StatusBoxShow(&#39;'.enid_get($data->id_user).'&#39;,
			&#39;'.change_status_value($data->status).'&#39;,
			&#39;'.xxs_filter($data->username).'&#39;,
			&#39;'.status_text($data->status).'&#39;)"';

		/*
		SelectRow(Row,Target,Name,MethodNext,ControllerNext,Identifier,Detail,Delete,Print)
		*/
		
		echo'<tr onclick="SelectRow('.$no.',
		&#39;'.enid_get($data->id_user).'&#39;,
		&#39;'.xxs_filter($data->username).'&#39;,
		&#39;FormFloatBottomShow&#39;,
		&#39;User&#39;,
		&#39;0&#39;,
		1,0,0)" 			
		
		ondblclick="FormFloatShow(&#39;User/Form/Edit/'.enid_get($data->id_user).'&#39;)" 
		
		id="my-tr'.$no.'" class="my-tr" >';
		
			echo'<td align="center">'.$no.'</td>';
			echo'<td>';
			
			echo my_user_name($data->username,$data->email);
			
			echo'</td>';
			echo'<td>'.xxs_filter($data->email).'</td>';
			echo'<td>'.xxs_filter($data->useraccess).'</td>';
			
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
	<?php if($num_data > 0 && $num_data > $myrow){?>
	<ul class="pagination">	
	<?php if($page>5){ ?>
	<li><a href="#" onclick="LoadDataTable('User/Page/1/1')"
		><span class="glyphicon glyphicon-step-backward my-glyphicon"></span></a></li>
	<?php } ?>
	
		<?php if($page>5){ ?>
			<li><a href="#" onclick="LoadDataTable('User/Page/<?php echo ($next-1); ?>/<?php echo ($next-5); ?>')"
			><span class="glyphicon glyphicon-chevron-left my-glyphicon"></span></a></li>
		<?php } ?>
		<?php for ($i=1; $i<=(5); $i++){ ?>
			<?php if(($i+($next-1)) == $page){$page_active='id="my-page-active"';}else{$page_active='';} ?>
		<?php if(($i+$next)<=($max+1)){ ?>
			<li><a <?php echo $page_active; ?> href="#" 
			onclick="LoadDataTable('User/Page/<?php echo ($i+($next-1)); ?>/<?php echo ($next); ?>')"
			><?php echo ($i+($next-1)); ?></a></li>
		<?php }} ?>
		
		<?php if(($i+$next) <= $max){ ?>
		<li><a href="#" onclick="LoadDataTable('User/Page/<?php echo ($next+5); ?>/<?php echo ($next+5); ?>')"
		><span class="glyphicon glyphicon-chevron-right my-glyphicon"></span></a></li>
		
	<li><a href="#" onclick="LoadDataTable('User/Page/<?php echo ($max); ?>/<?php echo ($max-1); ?>')"
	><span class="glyphicon glyphicon-step-forward my-glyphicon"></span></a></li>
	<?php } ?>		
	</ul>
	<?php } ?>
</div>
<!-- my-page bottom -->

</div><!-- tools-box-bottom -->