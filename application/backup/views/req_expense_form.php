<div class="panel panel-primary my-panel">
<div class="panel-body">
	
	<span class="my-title"><b><span class="glyphicon glyphicon-record"></span> Expense</b></span>

	<input value="<?php echo $id_expense; ?>" type="hidden" name="input_id_expense" id="input_id_expense" readonly="readonly"/>
	
	<hr class="my-hr">

<table class="table table-condensed table-bordered my-table">
	<thead>
		<tr class="my-bg-gradation" width="30px">
			<td class="my-gradation my-th-label" >No</td>
			<td width="50%" class="my-gradation my-th-label" >Expense Type</td>
			<td class="my-gradation my-th-label" >Balance</td>
			<td width="70px" class="my-gradation my-th-label" >-</td>
		</tr>
	</thead>
	<tbody>

<?php 

if($num_expense > 0) { 
	$no = 1;
	$total = 0;
	foreach($expense as $dte) { 
		
		echo'<tr onclick="SelectRowNormal('.$no.')" id="my-tr'.$no.'" class="my-tr">
		<td valign="top" align="center"  width="30px">'.$no.'</td>
		<td>'.$dte->name.'</td><td align="right">'.curr_ind($dte->balance).'</td>';
		
		//if($edit_expense == 1 && $status < 4){
			echo'<td align="center">
			<button class="btn btn-primary btn-xs"
			onclick="FormExpenseShow(&#39;'.$target_control.'/Form_Expense/Edit/'.$target.'/'.enid_get($dte->id_expense).'&#39;)" 
			><span class="glyphicon glyphicon-pencil"></span></button>&nbsp;';
			
			echo'<button class="btn btn-danger btn-xs"
			onClick="DeleteBoxExpenseShow(&#39;'.enid_get($dte->id_expense).'&#39;,&#39;'.$dte->name.'&#39;,&#39;'.enid_get($dte->id_request).'&#39;)" 
			><span class="glyphicon glyphicon-remove"></span></button></td>';
		//}
		
		echo'</tr>';
		$total += $dte->balance;
		$no++;
	}
		
}
?>
	<tr>
		<td align="center"><?php echo $no; ?></td>
		<td>
			<span id="label_input_expense_type" class="my-fild-data">
			<span onclick="ListBoxShow('my-list-box-expense_type','<?php echo $target_control; ?>/Search_List_Expense_Type','ListDataExpenseType','input_src_expense_type_name')" 
			class="form-control input-sm" name="input_expense_type_name" id="input_expense_type_name" ><?php echo $expense_type_name; ?></span>
				<!--List--->
				<input value="<?php echo $expense_type; ?>" type="hidden" name="input_expense_type" id="input_expense_type" readonly="readonly"/>
				<div class="my-list-box" id="my-list-box-expense_type" style="display:none;">
					<div class="panel panel-primary my-panel-list-box">
					<div class="panel-body my-panel-body-list-box">
						<input onkeyup="ListDataSrc('<?php echo $target_control; ?>/Search_List_Expense_Type','ListDataExpenseType','input_src_expense_type_name')" class="form-control input-sm" type="hidden" name="input_src_expense_type_name" id="input_src_expense_type_name" placeholder="Search..."/>
						<div id="ListDataExpenseType"></div>
					</div>
					</div>
				</div>
				<!--List--->
			</span>
		</td>
		<td>
			<span id="label_input_balance" class="my-fild-data">
				<input onkeypress="EExpense(event,'myinput','<?php echo $target_control; ?>')"
				value="<?php echo $balance; ?>" type="number" id="input_balance" name="input_balance" class="form-control input-sm" placeholder="<?php echo ph(4); ?>" />
			</span>
		</td>
		<td align="center">
			<button onClick="SubmitExpenseType('<?php echo $target_control; ?>')" class="btn btn-primary btn-sm" ><span class="glyphicon glyphicon-plus"></span></button>
		</td>
	</tr>
	
	<?php 
	echo'<tr><td colspan="2"><b>Total</b></td>
	<td align="right"><b>'.curr_ind($total).'</b></td><td></td></tr>';
	?>
	
</tbody>
</table>
	
	
	

	<div class="btn-group">
		
		<button onclick="FormExpenseShow('<?php echo $target_control; ?>/Form_Expense/Add/<?php echo $target; ?>/<?php echo enid_get(0); ?>')" class="btn btn-warning btn-sm">Reset</button>
		<button onclick="LoadContent('<?php echo $target_control; ?>/Form/Edit/<?php echo $target; ?>')" class="btn btn-default btn-sm">Close</button>
	
	</div><!-- btn-group -->
	
</div>
</div>