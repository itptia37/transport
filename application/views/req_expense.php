<?php if(desid_get($target) > 0){  ?>

<div class="my-box-form-float" id="my-box-form-float"></div>

<!--
<?php ///if($edit_expense == 1 && $status <= 2) { ?>
<button class="btn btn-primary btn-xs" style="margin-bottom:5px;"
onclick="FormExpenseShow('<?php ///echo $target_control; ?>/Form_Expense/Add/<?php ///echo $target; ?>/<?php ///echo enid_get(0); ?>')">
<span class="glyphicon glyphicon-plus"></span> ADD</button>
<?php ///} ?>
-->

<table class="table table-condensed table-bordered my-table">

<?php if($edit_expense == 1) { ?>
	<thead>
		<tr class="my-bg-gradation">
			<td class="my-gradation my-th-label" width="30px">No</td>
			<td class="my-gradation my-th-label" >Expense Type</td>
			<td class="my-gradation my-th-label" >Balance</td>
		</tr>
	</thead>
<?php }else{
	if($num_expense > 0) { ?>
	<thead>
		<tr class="my-bg-gradation" width="30px">
			<td class="my-gradation my-th-label" >No</td>
			<td class="my-gradation my-th-label" >Expense Type</td>
			<td class="my-gradation my-th-label" >Balance</td>
		</tr>
	</thead>
<?php }} ?>

<tbody>

<?php 

if($num_expense > 0) { 
	$no = 1;
	$total = 0;
	foreach($expense as $dte) { 
		
		echo'<tr onclick="SelectRowNormal('.$no.')" id="my-tr'.$no.'" class="my-tr">
		<td valign="top" align="center"  width="30px">'.$no.'</td>
		<td>'.$dte->name.'</td><td align="right">'.curr_ind($dte->balance).'</td>';

		echo'</tr>';
		$total += $dte->balance;
		$no++;
	}
		echo'<tr><td colspan="2"><b>Total</b></td>
		<td colspan="2" align="right"><b>'.curr_ind($total).'</b></td></tr>';
}
?>

</tbody>
</table>
<?php  } ?>