function ECash(e,activity) {
	
	var charCode;
	if(e && e.which){
		charCode = e.which;
	} else if(window.event){
		e = window.event;
		charCode = e.keyCode;
	} 
	
	if(activity === 'myinput'){if(charCode == 13) {CashSubmit();}}
		
}


function CashSubmit() {

	LoaderShow();

	var base_url = $("#BaseUrl").attr("label");
	var input_target = document.getElementById("input_target"); 
	var input_start_date = document.getElementById("input_start_date"); 
	var input_end_date = document.getElementById("input_end_date"); 
	var input_receiver_name = document.getElementById("input_receiver_name"); 
	var input_receiver = document.getElementById("input_receiver"); 
	var input_amount = document.getElementById("input_amount"); 
	  
	  if (input_start_date.value === '') {
		LoaderHide();
		$("#label_input_start_date").removeClass("has-success");
		$("#label_input_start_date").addClass("has-error");		
		input_start_date.focus();
        return false ;
      }
	  
	  if (input_end_date.value === '') {
		LoaderHide();
		$("#label_input_end_date").removeClass("has-success");
		$("#label_input_end_date").addClass("has-error");		
		input_end_date.focus();
        return false ;
      }
	  
	  /*if (input_start_date.value > input_end_date.value) {
		LoaderHide();
		AlertShow('danger','End date may not be smaller than the start date');
		$("#label_input_start_date").removeClass("has-success");
		$("#label_input_start_date").addClass("has-error");		
		input_start_date.focus();
        return false ;
      }*/
	  
	  if (input_receiver.value === '') {
		LoaderHide();
		ListBoxShow('my-list-box-receiver_name','Cash/Search_List_Receiver','ListDataReceiver','input_src_receiver_name');
		$("#label_input_receiver_name").removeClass("has-success");
		$("#label_input_receiver_name").addClass("has-error");		
		input_receiver_name.focus();
        return false ;
      }
	  
	  if (input_amount.value <= 0) {
		LoaderHide();
		$("#label_input_amount").removeClass("has-success");
		$("#label_input_amount").addClass("has-error");		
		input_amount.focus();
        return false ;
      }
	  
		

		CheckLastDate_And_Save();
	 
}




function CheckLastDate_And_Save() {
	var base_url = $("#BaseUrl").attr("label");
	var input_target = document.getElementById("input_target"); 
	var input_start_date = document.getElementById("input_start_date"); 
	var input_end_date = document.getElementById("input_end_date"); 
	var input_receiver_name = document.getElementById("input_receiver_name"); 
	var input_receiver = document.getElementById("input_receiver"); 
	var input_amount = document.getElementById("input_amount"); 
	  	
	$.ajax({
		type: 'POST',
		url: base_url+'Cash/Check_Last_Date',
		data: {
		'input_target': input_target.value,
		'input_start_date': input_start_date.value,
		'input_receiver': input_receiver.value,
		},
		success: function(status) {
		
			LoaderHide();
			if (status === 'destroy'){
				
				window.location = base_url;
				
			} else {

				
				if (status === 'YES'){
								
					
					$.ajax({
						type: 'POST',
						url: base_url+'Cash/Save',
						data: {
						'input_target': input_target.value,
						'input_start_date': input_start_date.value,
						'input_end_date': input_end_date.value,
						'input_receiver': input_receiver.value,
						'input_amount': input_amount.value,
						},
						success: function(status) {
						
							LoaderHide();
							if (status === 'destroy'){
								
								window.location = base_url;
								
							} else {
								
								document.getElementById("my-box-form-float").innerHTML = status;
									LoadDataTable('Cash/Data_Table');
								
							}
							
						}		
					});
					
								
				}else{
					
					AlertShow('danger','Start date may not be smaller than the previous end date');
					
				}
			
			
			}
		}		
	});
}





function SettelmentBoxShow(Name){ 
	$('#my-box-settelment').show();
	document.getElementById("SettelmentName").innerHTML = Name;
	document.getElementById("BtnSubmitSettelment").focus();
}

function SettelmentBoxHide(){
	$('#my-box-settelment').hide();
}

function SettelmentProccess(TargetLink,TargetId) {

	LoaderShow();

	var base_url = $("#BaseUrl").attr("label");
	
	  if (TargetId === '') {
		LoaderHide();
			AlertShow('danger','Proccess Filed');
        return false;
      }
	  

	$.ajax({
		type: 'POST',
		url: base_url+TargetLink,
		data: {
		'input_index': TargetId,
		},
		success: function(status) {
		
			LoaderHide();
			document.getElementById("my-box-form-float").innerHTML = status;
		}		
	});
}



function LockBoxShow(Name){ 
	$('#my-box-lock').show();
	document.getElementById("LockName").innerHTML = Name;
	document.getElementById("BtnSubmitLock").focus();
}

function LockBoxHide(){
	$('#my-box-lock').hide();
}

function LockProccess(TargetLink,TargetId) {

	LoaderShow();

	var base_url = $("#BaseUrl").attr("label");
	
	  if (TargetId === '') {
		LoaderHide();
			AlertShow('danger','Proccess Filed');
        return false;
      }
	  

	$.ajax({
		type: 'POST',
		url: base_url+TargetLink,
		data: {
		'input_index': TargetId,
		},
		success: function(status) {
		
			LoaderHide();
			document.getElementById("my-box-form-float").innerHTML = status;
		}		
	});
}





function CancelCashBoxShow(Name){ 
	$('#my-box-cancel').show();
	document.getElementById("CancelName").innerHTML = Name;
	document.getElementById("BtnCancel").focus();
}

function CancelCashBoxHide(){
	$('#my-box-cancel').hide();
}

function CancelCashProccess(TargetLink,TargetId) {

	LoaderShow();

	var base_url = $("#BaseUrl").attr("label");
	
	  if (TargetId === '') {
		LoaderHide();
			AlertShow('danger','Proccess Filed');
        return false;
      }
	  

	$.ajax({
		type: 'POST',
		url: base_url+TargetLink,
		data: {
		'input_index': TargetId,
		},
		success: function(status) {
		
			LoaderHide();
			document.getElementById("my-box-form-float").innerHTML = status;
		}		
	});
}
