function EExpense2(e,activity,TargetLink) {
	
	var charCode;
	if(e && e.which){
		charCode = e.which;
	} else if(window.event){
		e = window.event;
		charCode = e.keyCode;
	} 
	
	
	if(activity === 'myinput'){if(charCode == 13) {SubmitExpense2(TargetLink);}}
	if(activity === 'mysubmit'){if(charCode == 13) {SubmitExpense2(TargetLink);}}

		
}

function SubmitExpense2(TargetLink){
	
	var base_url = $("#BaseUrl").attr("label");
	var input_request_name = document.getElementById("input_request_name"); 
	var input_request = document.getElementById("input_request"); 
	var input_id_expense = document.getElementById("input_id_expense"); 
	var input_expense_type = document.getElementById('input_expense_type');
	var input_balance = document.getElementById('input_balance');
	
	if(input_request.value === ''){
		loaderHide();
		ListBoxShow('my-list-box-request',TargetLink+'/Search_List_Request','ListDataRequest','input_request_name');
		$("#label_input_request_name").removeClass("has-success");
		$("#label_input_request_name").addClass("has-error");	
		input_request_name.focus();
		return false ;
	}

	if(input_expense_type.value === ''){
		loaderHide();
		ListBoxShow('my-list-box-expense_type',TargetLink+'/Search_List_Expense_Type','ListDataExpenseType','input_src_expense_type_name');
		$("#label_input_expense_type_name").removeClass("has-success");
		$("#label_input_expense_type_name").addClass("has-error");	
		input_expense_type.focus();
		return false ;
	}

	  if (input_balance.value === '') {
		loaderHide();
		$("#label_input_balance").removeClass("has-success");
		$("#label_input_balance").addClass("has-error");		
		input_balance.focus();
        return false ;
      }
		
	$.ajax({
			type: 'POST',
			url: base_url+TargetLink+'/Save_Expense',
			data: {
			'input_request': input_request.value,
			'input_id_expense': input_id_expense.value,
			'input_expense_type': input_expense_type.value,
			'input_balance': input_balance.value,
			},
			success: function(status) {
			
				loaderHide();
				if (status === 'destroy'){
						
					window.location = base_url;
						
				} else {
						
					document.getElementById("my-box-form-float").innerHTML = status;
						
				}
				
			}		
		});
	
}
