function ERequest_Driver(e,activity) {
	
	var ActionTarget = $("#ActionTarget").attr("label"); /* parameter id */
	var charCode;
	if(e && e.which){
		charCode = e.which;
	} else if(window.event){
		e = window.event;
		charCode = e.keyCode;
	} 
	
	if(activity === 'myrefresh'){if(charCode == 13) {SubmenuSelect('Request_Driver','Request_Driver');}}
	if(activity === 'myform'){if(charCode == 13) {FormFloatShow('Request_Driver/Form/Add/'+ActionTarget);}}
	if(activity === 'myinput'){if(charCode == 13) {Request_DriverSubmit();}}
	if(activity === 'mysubmit'){if(charCode == 13) {Request_DriverSubmit();}}
	if(activity === 'myreset'){if(charCode == 13) {FormFloatShow('Request_Driver/Form/Add/'+ActionTarget);}}
		
}


function Request_DriverSubmit(TargetAction) {

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
	
	var input_return_plan_date = document.getElementById("input_return_plan_date");	
	var input_return_plan_time_a = document.getElementById("input_return_plan_time_a");	
	var input_return_plan_time_b = document.getElementById("input_return_plan_time_b");	
	
	var input_finish_time_personal_a = document.getElementById("input_finish_time_personal_a");	
	var input_finish_time_personal_b = document.getElementById("input_finish_time_personal_b");	
	
	var input_destination = document.getElementById("input_destination");	
	var input_description = document.getElementById("input_description");
	var input_begin_km = document.getElementById("input_begin_km");
	var input_end_km = document.getElementById("input_end_km");
	var input_comment = document.getElementById("input_comment");
	var input_status = document.getElementById("input_status");
	
	var input_driver = document.getElementById("input_driver");
	var input_car = document.getElementById("input_car");
	var input_external = document.getElementById("input_external");
	var input_finish_date = document.getElementById("input_finish_date");	
	var input_finish_time_a = document.getElementById("input_finish_time_a");	
	var input_finish_time_b = document.getElementById("input_finish_time_b");	
	
	  if (input_company.value === '') {
		loaderHide();
		ListBoxShow('my-list-box-company','Request_Driver/Search_List_Company','ListDataCompany','input_src_company_name');
		$("#label_input_company_name").removeClass("has-success");
		$("#label_input_company_name").addClass("has-error");		
		return false ;
      }
	  
	  if (input_request_option.value === '') {
		loaderHide();
		ListBoxShow('my-list-box-request_option','Request_Driver/Search_List_Request_Option','ListDataRequestOption','input_src_request_option_name');
		$("#label_input_request_option_name").removeClass("has-success");
		$("#label_input_request_option_name").addClass("has-error");		
		return false ;
      }
	  
	  if (input_expense_purpose.value === '') {
		loaderHide();
		ListBoxShow('my-list-box-expense_purpose','Request_Driver/Search_List_Expense_Purpose','ListDataExpensePurpose','input_src_expense_purpose_name');
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
	 
	  if (input_request_option.value < 4) {	  
		  if (input_return_plan_date.value === '') {
			loaderHide();
			$("#label_input_return_plan_date").removeClass("has-success");
			$("#label_input_return_plan_date").addClass("has-error");		
			input_return_plan_date.focus();
			return false ;
		  }
	  }
	  
	  if (input_expense_purpose.value == 8) {	  
		  if (input_project_number.value <= 0 ) {
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
	  
	 
	  try{ var val_input_project_number = input_project_number.value;}
			catch (input_project_number){ var val_input_project_number = ''; }
			
	  try{ var val_input_finish_time_personal = input_finish_time_personal_a.value+':'+input_finish_time_personal_b.value+':00';}
			catch (input_finish_time_personal_a){ var val_input_finish_time_personal = ''; }
			
	  try{ var val_input_driver = input_driver.value;}
			catch (input_driver){ var val_input_driver = ''; }
			
	  try{ var val_input_car = input_car.value;}
			catch (input_car){ var val_input_car = ''; }
			
	  try{ var val_input_external = input_external.value;}
			catch (input_external){ var val_input_external = ''; }
			
	  try{ var val_input_finish_date = input_finish_date.value;}
			catch (input_finish_date){ var val_input_finish_date = ''; }
			
	  try{ var val_input_finish_time = input_finish_time_a.value+':'+input_finish_time_b.value+':00';}
			catch (input_finish_time_a){ var val_input_finish_time = ''; }
			
	  if(input_request_option.value == 4){ var  fix_finish_time = val_input_finish_time_personal;}
		  else{ var fix_finish_time = val_input_finish_time;}

		$.ajax({
			type: 'POST',
			url: base_url+'Request_Driver/Save',
			data: {
			'input_target': input_target.value,
			'input_company': input_company.value,
			'input_request_option': input_request_option.value,
			'input_expense_purpose': input_expense_purpose.value,
			'input_project_number': val_input_project_number, 			
			'input_start_date': input_start_date.value,
			'input_start_time': input_start_time_a.value+':'+input_start_time_b.value+':00',
			'input_return_plan_date': input_return_plan_date.value,
			'input_return_plan_time': input_return_plan_time_a.value+':'+input_return_plan_time_b.value+':00',
			'input_destination': input_destination.value,
			'input_description': input_description.value,
			'input_begin_km': input_begin_km.value,
			'input_end_km': input_end_km.value,
			'input_comment': input_comment.value,
			'input_status': input_status.value,
			'input_action': TargetAction,
			
			'input_driver': val_input_driver,
			'input_car': val_input_car,
			'input_external': val_input_external,
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

