function EUser(e,activity) {
	
	var charCode;
	if(e && e.which){
		charCode = e.which;
	} else if(window.event){
		e = window.event;
		charCode = e.keyCode;
	} 
	
	if(activity === 'myinput'){if(charCode == 13) {UserSubmit();}}
		
}


function UserSubmit() {

	LoaderShow();

	var base_url = $("#BaseUrl").attr("label");
	var input_target = document.getElementById("input_target"); 
	var input_id_login = document.getElementById("input_id_login"); 
	var input_user = document.getElementById("input_user"); 
	var input_access = document.getElementById("input_access");
	  
	  if (input_id_login.value === '') {
		LoaderHide();
		ListBoxShow('my-list-box-user','User/Search_List_User','ListDataUser','input_src_user');
		$("#label_input_user").removeClass("has-success");
		$("#label_input_user").addClass("has-error");		
		input_user.focus();
        return false ;
      }

		$.ajax({
			type: 'POST',
			url: base_url+'User/Save',
			data: {
			'input_target': input_target.value,
			'input_id_login': input_id_login.value,
			'input_access': input_access.value,
			},
			success: function(status) {
			
				LoaderHide();
				
				if (status === 'destroy'){
					
					window.location = base_url;
					
				} else {
					
					document.getElementById("my-box-form-float").innerHTML = status;					
						LoadDataTable('User/Data_Table');
					
				}
				
			}		
		});
}