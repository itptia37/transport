function ECourier(e,activity) {
	
	var charCode;
	if(e && e.which){
		charCode = e.which;
	} else if(window.event){
		e = window.event;
		charCode = e.keyCode;
	} 
	
	if(activity === 'myinput'){if(charCode == 13) {CourierSubmit();}}	
}


function CourierSubmit() {

	LoaderShow();

	var base_url = $("#BaseUrl").attr("label");
	var input_target = document.getElementById("input_target"); 
	var input_courier_name = document.getElementById("input_courier_name"); 
	var input_courier = document.getElementById("input_courier"); 
	
	  if (input_courier.value === '') {
		LoaderHide();
		ListBoxShow('my-list-box-courier_name','Courier/Search_List_Courier','ListDataCourier','input_src_courier_name');
		$("#label_input_courier_name").removeClass("has-success");
		$("#label_input_courier_name").addClass("has-error");		
		input_courier_name.focus();
        return false ;
      }
	  


	$.ajax({
		type: 'POST',
		url: base_url+'Courier/Save',
		data: {
		'input_target': input_target.value,
		'input_courier': input_courier.value,
		},
		success: function(status) {
		
			LoaderHide();
			if (status === 'destroy'){
				
				window.location = base_url;
				
			} else {
				
				document.getElementById("my-box-form-float").innerHTML = status;
					LoadDataTable('Courier/Data_Table');
				
			}
			
		}		
	});
}