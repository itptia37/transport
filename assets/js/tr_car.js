function ECar(e,activity) {
	
	var charCode;
	if(e && e.which){
		charCode = e.which;
	} else if(window.event){
		e = window.event;
		charCode = e.keyCode;
	} 
	
	if(activity === 'myinput'){if(charCode == 13) {CarSubmit();}}
		
}


function CarSubmit() {

	LoaderShow();

	var base_url = $("#BaseUrl").attr("label");
	var input_target = document.getElementById("input_target"); 
	var input_car_name = document.getElementById("input_car_name"); 
	
	  if (input_car_name.value === '') {
		LoaderHide();
		$("#label_input_car_name").removeClass("has-success");
		$("#label_input_car_name").addClass("has-error");		
		input_car_name.focus();
        return false ;
      }

	$.ajax({
		type: 'POST',
		url: base_url+'Car/Save',
		data: {
		'input_target': input_target.value,
		'input_car_name': input_car_name.value,
		},
		success: function(status) {
		
			LoaderHide();
			if (status === 'destroy'){
				
				window.location = base_url;
				
			} else {
				
				document.getElementById("my-box-form-float").innerHTML = status;
					LoadDataTable('Car/Data_Table');
				
			}
			
		}		
	});
}