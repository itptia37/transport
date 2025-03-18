function EExternal(e,activity) {
	
	var charCode;
	if(e && e.which){
		charCode = e.which;
	} else if(window.event){
		e = window.event;
		charCode = e.keyCode;
	} 
	
	if(activity === 'myinput'){if(charCode == 13) {ExternalSubmit();}}
		
}


function ExternalSubmit() {

	LoaderShow();

	var base_url = $("#BaseUrl").attr("label");
	var input_target = document.getElementById("input_target"); 
	var input_external_name = document.getElementById("input_external_name"); 
	
	  if (input_external_name.value === '') {
		LoaderHide();
		$("#label_input_external_name").removeClass("has-success");
		$("#label_input_external_name").addClass("has-error");		
		input_external_name.focus();
        return false ;
      }

	$.ajax({
		type: 'POST',
		url: base_url+'External/Save',
		data: {
		'input_target': input_target.value,
		'input_external_name': input_external_name.value,
		},
		success: function(status) {
		
			LoaderHide();
			if (status === 'destroy'){
				
				window.location = base_url;
				
			} else {
				
				document.getElementById("my-box-form-float").innerHTML = status;
					LoadDataTable('External/Data_Table');
				
			}
			
		}		
	});
}