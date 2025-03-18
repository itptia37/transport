function EDriver(e,activity) {
	
	var ActionTarget = $("#ActionTarget").attr("label"); /* parameter id */
	var charCode;
	if(e && e.which){
		charCode = e.which;
	} else if(window.event){
		e = window.event;
		charCode = e.keyCode;
	} 
	
	if(activity === 'myrefresh'){if(charCode == 13) {SubmenuSelect('Driver','Driver');}}
	if(activity === 'myform'){if(charCode == 13) {FormFloatShow('Driver/Form/Add/'+ActionTarget);}}
	if(activity === 'myinput'){if(charCode == 13) {DriverSubmit();}}
	if(activity === 'mysubmit'){if(charCode == 13) {DriverSubmit();}}
	if(activity === 'myreset'){if(charCode == 13) {FormFloatShow('Driver/Form/Add/'+ActionTarget);}}
		
}


function DriverSubmit() {

	loaderShow();

	var base_url = $("#BaseUrl").attr("label");
	var input_target = document.getElementById("input_target"); 
	var input_driver_name = document.getElementById("input_driver_name"); 
	var input_driver = document.getElementById("input_driver"); 
	var input_car_name = document.getElementById("input_car_name"); 
	var input_car = document.getElementById("input_car"); 
	  
	  if (input_driver.value === '') {
		loaderHide();
		ListBoxShow('my-list-box-driver_name','Driver/Search_List_Driver','ListDataDriver','input_src_driver_name');
		$("#label_input_driver_name").removeClass("has-success");
		$("#label_input_driver_name").addClass("has-error");		
		input_driver_name.focus();
        return false ;
      }
	  


	$.ajax({
		type: 'POST',
		url: base_url+'Driver/Save',
		data: {
		'input_target': input_target.value,
		'input_driver': input_driver.value,
		'input_car': input_car.value,
		},
		success: function(status) {
		
			loaderHide();
			if (status === 'destroy'){
				
				window.location = base_url;
				
			} else {
				
				document.getElementById("my-box-form-float").innerHTML = status;
				LoadDataTable('Driver/Data_Table');
				
			}
			
		}		
	});
}