function ECar(e,activity) {
	
	var ActionTarget = $("#ActionTarget").attr("label"); /* parameter id */
	var charCode;
	if(e && e.which){
		charCode = e.which;
	} else if(window.event){
		e = window.event;
		charCode = e.keyCode;
	} 
	
	if(activity === 'myrefresh'){if(charCode == 13) {SubmenuSelect('Car','Car');}}
	if(activity === 'myform'){if(charCode == 13) {FormFloatShow('Car/Form/Add/'+ActionTarget);}}
	if(activity === 'myinput'){if(charCode == 13) {CarSubmit();}}
	if(activity === 'mysubmit'){if(charCode == 13) {CarSubmit();}}
	if(activity === 'myreset'){if(charCode == 13) {FormFloatShow('Car/Form/Add/'+ActionTarget);}}
		
}


function CarSubmit() {

	loaderShow();

	var base_url = $("#BaseUrl").attr("label");
	var input_target = document.getElementById("input_target"); 
	var input_car_name = document.getElementById("input_car_name"); 
	
	  if (input_car_name.value === '') {
		loaderHide();
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
		
			loaderHide();
			if (status === 'destroy'){
				
				window.location = base_url;
				
			} else {
				
				document.getElementById("my-box-form-float").innerHTML = status;
				LoadDataTable('Car/Data_Table');
				
			}
			
		}		
	});
}