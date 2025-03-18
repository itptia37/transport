function ERequest_Courier(e,activity) {
	
	var ActionTarget = $("#ActionTarget").attr("label"); /* parameter id */
	var charCode;
	if(e && e.which){
		charCode = e.which;
	} else if(window.event){
		e = window.event;
		charCode = e.keyCode;
	} 
	
	if(activity === 'myrefresh'){if(charCode == 13) {SubmenuSelect('Request_Courier','Request_Courier');}}
	if(activity === 'myform'){if(charCode == 13) {FormFloatShow('Request_Courier/Form/Add/'+ActionTarget);}}
	if(activity === 'myinput'){if(charCode == 13) {Request_CourierSubmit();}}
	if(activity === 'mysubmit'){if(charCode == 13) {Request_CourierSubmit();}}
	if(activity === 'myreset'){if(charCode == 13) {FormFloatShow('Request_Courier/Form/Add/'+ActionTarget);}}
		
}


function Request_CourierSubmit(TargetAction) {

	loaderShow();

	var base_url = $("#BaseUrl").attr("label");
	var input_target = document.getElementById("input_target"); 
	var input_company = document.getElementById("input_company");	
	var input_request_option = document.getElementById("input_request_option");	
	var input_expense_purpose = document.getElementById("input_expense_purpose");
	var input_project_number = document.getElementById("input_project_number");	
	var input_start_date = document.getElementById("input_start_date");	
	var input_start_time_a = document.getElementById("input_start_time_a");	
	var input_start_time_b = document.getElementById("input_start_time_b");		
	
	var input_finish_time_personal = document.getElementById("input_finish_time_personal");	
	var input_destination = document.getElementById("input_destination");	
	var input_return = document.getElementById("input_return");
	var input_comment = document.getElementById("input_comment");
	var input_status = document.getElementById("input_status");
	
	var input_courier = document.getElementById("input_courier");
	var input_external = document.getElementById("input_external");
	var input_description = document.getElementById("input_description");
	var input_departur = document.getElementById("input_departur");
	var input_delivery = document.getElementById("input_delivery");
	var input_finish_date = document.getElementById("input_finish_date");	
	var input_finish_time_a = document.getElementById("input_finish_time_a");	
	var input_finish_time_b = document.getElementById("input_finish_time_b");		

	  if (input_company.value === '') {
		loaderHide();
		ListBoxShow('my-list-box-company','Request_Courier/Search_List_Company','ListDataCompany','input_src_company_name');
		$("#label_input_company_name").removeClass("has-success");
		$("#label_input_company_name").addClass("has-error");		
		return false ;
      }
	  
	  if (input_request_option.value === '') {
		loaderHide();
		ListBoxShow('my-list-box-request_option','Request_Courier/Search_List_Request_Option','ListDataRequestOption','input_src_request_option_name');
		$("#label_input_request_option_name").removeClass("has-success");
		$("#label_input_request_option_name").addClass("has-error");		
		return false ;
      }
	  
	  if (input_expense_purpose.value === '') {
		loaderHide();
		ListBoxShow('my-list-box-expense_purpose','Request_Courier/Search_List_Expense_Purpose','ListDataExpensePurpose','input_src_expense_purpose_name');
		$("#label_input_expense_purpose_name").removeClass("has-success");
		$("#label_input_expense_purpose_name").addClass("has-error");		
		return false ;
      }

	  if (input_start_date.value === '') {
		loaderHide();
		$("#label_input_start_date").removeClass("has-success");
		$("#label_input_start_date").addClass("has-error");		
		input_start_date.focus();
        return false ;
      }
	  
	  if (input_expense_purpose.value == 8) {	  
		  if (input_project_number.value === '') {
			loaderHide();
			$("#label_input_project_number").removeClass("has-success");
			$("#label_input_project_number").addClass("has-error");		
			input_project_number.focus();
			return false ;
		  }
	  }
	  
	  if (input_destination.value === '') {
		loaderHide();
		$("#label_input_destination").removeClass("has-success");
		$("#label_input_destination").addClass("has-error");		
		input_destination.focus();
        return false ;
      }
	  
	  if (input_description.value === '') {
		loaderHide();
		$("#label_input_description").removeClass("has-success");
		$("#label_input_description").addClass("has-error");		
		input_description.focus();
        return false ;
      }
	
	  
	  try{val_input_project_number = input_project_number.value;}
			catch (input_project_number){ val_input_project_number = ''; }
			
	   try{ var val_input_finish_time_personal = input_finish_time_personal_a.value+':'+input_finish_time_personal_b.value+':00';}
			catch (input_finish_time_personal_a){ var val_input_finish_time_personal = ''; }
			
	  try{val_input_courier = input_courier.value;}
			catch (input_courier){ val_input_courier = ''; }
			
	  try{val_input_external = input_external.value;}
			catch (input_external){ val_input_external = ''; }

	  try{val_input_departur = input_departur.value;}
			catch (input_departur){ val_input_departur = ''; }
		
	  try{val_input_return = input_return.value;}
			catch (input_return){ val_input_return = ''; }
			
	  try{val_input_delivery = input_delivery.value;}
			catch (input_delivery){ val_input_delivery = ''; }
				  		
	  try{val_input_finish_date = input_finish_date.value;}
			catch (input_finish_date){ val_input_finish_date = ''; }
			
	 try{ var val_input_finish_time = input_finish_time_a.value+':'+input_finish_time_b.value+':00';}
			catch (input_finish_time_a){ var val_input_finish_time = ''; }
			
	  if(input_request_option.value == 6){ var  fix_finish_time = val_input_finish_time_personal;}
		  else{ var fix_finish_time = val_input_finish_time;}

		$.ajax({
			type: 'POST',
			url: base_url+'Request_Courier/Save',
			data: {
			'input_target': input_target.value,
			'input_company': input_company.value,
			'input_request_option': input_request_option.value,
			'input_expense_purpose': input_expense_purpose.value,
			'input_project_number': val_input_project_number, 			
			'input_start_date': input_start_date.value,
			'input_start_time': input_start_time_a.value+':'+input_start_time_b.value+':00',
			'input_destination': input_destination.value,
			'input_description': input_description.value,
			'input_comment': input_comment.value,
			'input_status': input_status.value,
			'input_action': TargetAction,
			
			'input_courier': val_input_courier,
			'input_external': val_input_external,
			'input_departur': val_input_departur,
			'input_return': val_input_return,
			'input_delivery': val_input_delivery,
			
			'input_finish_date': val_input_finish_date,
			'input_finish_time': fix_finish_time, 	 			
			},
			success: function(status) {
			
				loaderHide();
				if (status === 'destroy'){
					
					window.location = base_url;
					
				} else {
					
					if(TargetAction === 'send'){ Tone('send'); }
					
					document.getElementById("my-content").innerHTML = status;
					
				}
				
			}		
		});
}

