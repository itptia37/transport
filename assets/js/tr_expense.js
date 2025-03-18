/* proses expense pada detail request */
function EExpense(e,activity,TargetLink) {
	
	var charCode;
	if(e && e.which){
		charCode = e.which;
	} else if(window.event){
		e = window.event;
		charCode = e.keyCode;
	} 
	
	if(activity === 'myinput'){if(charCode == 13) {SubmitExpenseType(TargetLink);}}
		
}

function FormExpenseShow(Target) {
LoaderShow();

var base_url = $("#BaseUrl").attr("label");
var xhttp = new XMLHttpRequest();

xhttp.onreadystatechange = function() {
	
    if (this.readyState == 4 && this.status == 200) {
			
			LoaderHide();
			
				if (this.responseText === 'destroy'){
					window.location = base_url;
				} else {
					
					document.getElementById("my-box-form-expense").innerHTML = this.responseText;
				}
			
		} 
	};
	xhttp.open("GET", base_url+Target, true);
	xhttp.send();
}

function SubmitExpenseType(TargetLink){
	
	var base_url = $("#BaseUrl").attr("label");
	var input_target = document.getElementById("input_target"); 
	var input_id_expense = document.getElementById("input_id_expense"); 
	var input_expense_type = document.getElementById('input_expense_type');
	var input_balance = document.getElementById('input_balance');
	
	if(input_target.value === ''){
		LoaderHide();
		ListBoxShow('my-list-box-expense_type',TargetLink+'/Search_List_Expense_Type','ListDataExpenseType','input_src_expense_type_name');
		$("#label_input_expense_type_name").removeClass("has-success");
		$("#label_input_expense_type_name").addClass("has-error");	
		input_expense_type.focus();
		return false ;
	}

	if(input_expense_type.value === ''){
		LoaderHide();
		ListBoxShow('my-list-box-expense_type',TargetLink+'/Search_List_Expense_Type','ListDataExpenseType','input_src_expense_type_name');
		$("#label_input_expense_type_name").removeClass("has-success");
		$("#label_input_expense_type_name").addClass("has-error");	
		input_expense_type.focus();
		return false ;
	}
	
	if(input_balance.value <= 0 ){
		LoaderHide();
		$("#label_input_balance").removeClass("has-success");
		$("#label_input_balance").addClass("has-error");	
		input_balance.focus();
		return false ;
	}
		
	$.ajax({
			type: 'POST',
			url: base_url+TargetLink+'/Save_Expense',
			data: {
			'input_target': input_target.value,
			'input_id_expense': input_id_expense.value,
			'input_expense_type': input_expense_type.value,
			'input_balance': input_balance.value,
			},
			success: function(status) {
			
				LoaderHide();
				if (status === 'destroy'){
						
					window.location = base_url;
						
				} else {
						
					document.getElementById("my-box-form-expense").innerHTML = status;
						
				}
				
			}		
		});
	
}

function FormExpenseHide() {
	document.getElementById("my-box-form-expense").innerHTML = '';
}

/* delete expense */
function DeleteBoxExpenseShow(Id,Name,IdRequest){ 
	$('#my-box-delete-expense').show();
	document.getElementById("DeleteNameExpense").innerHTML = Name;
	document.getElementById("input_index_expense").value = Id;
	document.getElementById("input_target_new").value = IdRequest;
	document.getElementById("BtnSubmitDeleteExpense").focus();
}

function DeleteBoxExpenseHide(){
	$('#my-box-delete-expense').hide();
}

function DeleteExpenseProccess(Target) {

	LoaderShow();

	var base_url = $("#BaseUrl").attr("label");
	var input_target = document.getElementById("input_target_new"); 
	var input_index = document.getElementById("input_index_expense"); 
	
	  if (input_index.value === '') {
		LoaderHide();
			AlertShow('danger','Proccess Filed');
        return false;
      }

	$.ajax({
		type: 'POST',
		url: base_url+Target+'/Delete_Expense',
		data: {
		'input_target': input_target.value,
		'input_index': input_index.value,
		},
		success: function(status) {
		
			LoaderHide();
			DeleteBoxExpenseHide();
			
				if (status === 'destroy'){
						
					window.location = base_url;
						
				} else {
						
					document.getElementById("my-box-form-expense").innerHTML = status;
						
				}
			
		}		
	});
}
/* proses expense pada detail request */





/* proses expense pada terpisah pada menu expense */
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
		LoaderHide();
		ListBoxShow('my-list-box-request',TargetLink+'/Search_List_Request','ListDataRequest','input_request_name');
		$("#label_input_request_name").removeClass("has-success");
		$("#label_input_request_name").addClass("has-error");	
		input_request_name.focus();
		return false ;
	}

	if(input_expense_type.value === ''){
		LoaderHide();
		ListBoxShow('my-list-box-expense_type',TargetLink+'/Search_List_Expense_Type','ListDataExpenseType','input_src_expense_type_name');
		$("#label_input_expense_type_name").removeClass("has-success");
		$("#label_input_expense_type_name").addClass("has-error");	
		input_expense_type.focus();
		return false ;
	}

	  if (input_balance.value === '') {
		LoaderHide();
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
			
				LoaderHide();
				if (status === 'destroy'){
						
					window.location = base_url;
						
				} else {
						
					document.getElementById("my-box-form-float").innerHTML = status;
						
				}
				
			}		
		});
	
}

function DeleteBoxExpenseShow2(Id,Name,IdRequest){ 
	$('#my-box-delete-expense').show();
	document.getElementById("DeleteNameExpense").innerHTML = Name;
	document.getElementById("input_index_expense").value = Id;
	document.getElementById("input_target_new").value = IdRequest;
	document.getElementById("BtnSubmitDeleteExpense").focus();
}

function DeleteBoxExpenseHide2(){
	$('#my-box-delete-expense').hide();
}

function DeleteExpenseProccess2(Target) {

	LoaderShow();

	var base_url = $("#BaseUrl").attr("label");
	var input_target = document.getElementById("input_target_new"); 
	var input_index = document.getElementById("input_index_expense"); 
	
	  if (input_index.value === '') {
		LoaderHide();
			AlertShow('danger','Proccess Filed');
        return false;
      }

	$.ajax({
		type: 'POST',
		url: base_url+Target+'/Delete_Expense',
		data: {
		'input_target': input_target.value,
		'input_index': input_index.value,
		},
		success: function(status) {
		
			LoaderHide();
			DeleteBoxExpenseHide2();
			
				if (status === 'destroy'){
						
					window.location = base_url;
						
				} else {
						
					document.getElementById("my-box-form-float").innerHTML = status;
						
				}
			
		}		
	});
}
/* proses expense pada terpisah pada menu expense */