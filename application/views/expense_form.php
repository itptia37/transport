<div class="my-box-confirm" id="my-box-delete-expense">
	<div class="panel panel-primary my-panel">
	<div class="panel-body">
		<center>
		<img width="50px" class="img-responsive" src="<?php echo base_url() ?>assets/images/warning.png"/>
		<input type="hidden" name="input_index_expense" id="input_index_expense" readonly="readonly" />
		<input type="hidden" name="input_target_new" id="input_target_new" readonly="readonly" />
		<h3>Delete data <span id="DeleteNameExpense"></span> ?</h3>
		<div class="btn-group">
			<button onclick="DeleteExpenseProccess2('Expense_Driver')" class="btn btn-danger btn-sm" id="BtnSubmitDeleteExpense">Submit</button>
			<button onclick="DeleteBoxExpenseHide2()" class="btn btn-default btn-sm">Cancel</button>
		</div>
		</center>
	</div>
	</div>
</div>

<div class="panel panel-primary my-panel">
<div class="panel-body">
	
	<span class="my-title"><b><span class="glyphicon glyphicon-record"></span> Expense</b></span>

	<hr class="my-hr">
		
		<input value="<?php echo $id_expense; ?>" type="hidden" name="input_id_expense" id="input_id_expense" readonly="readonly"/>
		
		<span class="my-fild">No Request</span>
		<span id="label_input_request" class="my-fild-data">
		<span onclick="ListBoxShow('my-list-box-request','<?php echo $target_control; ?>/Search_List_Request','ListDataRequest','input_src_request_name')" 
		class="form-control input-sm" name="input_request_name" id="input_request_name" ><?php echo $request_name; ?></span>
			<!--List--->
			<input value="<?php echo $request; ?>" type="hidden" name="input_request" id="input_request" readonly="readonly"/>
			<div class="my-list-box" id="my-list-box-request" style="display:none;">
				<div class="panel panel-primary my-panel-list-box">
				<div class="panel-body my-panel-body-list-box">
					<input onkeyup="ListDataSrc('<?php echo $target_control; ?>/Search_List_Request','ListDataRequest','input_src_request_name')" 
					class="form-control input-sm" type="text" name="input_src_request_name" id="input_src_request_name" 
					placeholder="Search..."/>
					<div id="ListDataRequest"></div>
				</div>
				</div>
			</div>
			<!--List--->
		</span>		
		
		<span class="my-fild">Expense Type</span>
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
				
		<span class="my-fild">Balance</span>
		<span id="label_input_balance" class="my-fild-data">
			<input onkeypress="EExpense2(event,'mysubmit','<?php echo $target_control; ?>')"
			value="<?php echo $balance; ?>" type="number" id="input_balance" name="input_balance" class="form-control input-sm" placeholder="<?php echo ph(4); ?>" />
		</span>
	
		<br>
		
	<div class="btn-group">
		
		<button onClick="SubmitExpense2('<?php echo $target_control; ?>')" class="btn btn-primary btn-sm" >Save</button>
		<button onclick="FormFloatShow('<?php echo $target_control; ?>/Form/Add/<?php echo $request; ?>/<?php echo enid_get(0); ?>')" class="btn btn-warning btn-sm">Reset</button>
		<button onclick="LoadContent('<?php echo $target_control; ?>/Back')" class="btn btn-default btn-sm">Close</button>
	
	</div><!-- btn-group -->
	
	<hr class="my-hr">

<table class="table table-condensed table-bordered my-table">
	<thead>
		<tr class="my-bg-gradation" width="30px">
			<td class="my-gradation my-th-label" >No</td>
			<td class="my-gradation my-th-label" >Expense Type</td>
			<td class="my-gradation my-th-label" >Balance</td>
			<td width="70px" class="my-gradation my-th-label" >-</td>
		</tr>
	</thead>
<?php 

if($num_expense > 0) { 
	$no = 1;
	$total = 0;
	foreach($expense as $dte) { 
		
		echo'<tr onclick="SelectRowNormal('.$no.')" id="my-tr'.$no.'" class="my-tr">
		<td valign="top" align="center" width="30px">'.$no.'</td>
		<td>'.$dte->name.'</td><td align="right">'.curr_ind($dte->balance).'</td>';
		
		echo'<td align="center">';
		if($dte->id_proccess <= 0){
			echo'
			<button class="btn btn-primary btn-xs"
			onclick="FormFloatShow(&#39;'.$target_control.'/Form/Edit/'.$request.'/'.enid_get($dte->id_expense).'&#39;)" 
			><span class="glyphicon glyphicon-pencil"></span></button>&nbsp;';
			
			echo'<button class="btn btn-danger btn-xs"
			onClick="DeleteBoxExpenseShow2(&#39;'.enid_get($dte->id_expense).'&#39;,&#39;'.$dte->name.'&#39;,&#39;'.enid_get($dte->id_request).'&#39;)" 
			><span class="glyphicon glyphicon-remove"></span></button>';
		}
		echo'</td>';
		
		echo'</tr>';
		$total += $dte->balance;
		$no++;
	}
		echo'<tr><td colspan="2"><b>Total</b></td><td align="right"><b>'.curr_ind($total).'</b></td><td></td></tr>';
}
?>

</tbody>
</table>
	
</div>
</div>