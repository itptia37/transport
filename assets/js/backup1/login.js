/*
function ELogin(e,activity) {
	var charCode;
	
	if(e && e.which){
		
		charCode = e.which;
		
	} else if(window.event){
		
		e = window.event;
		
		charCode = e.keyCode;
		
	}
	
	if(activity === 'myinput'){if(charCode == 13) {Validate();}}
	if(activity === 'myvalidate'){if(charCode == 13) {Validate();}}
}

function Validate() {
	
	loaderShow();
	
	var base_url = $("#BaseUrl").attr("label");
	var input_email = document.getElementById("input_email"); 
	var input_password = document.getElementById("input_password"); 
	var input_save_password = document.getElementById("input_save_password"); 
	
	 if (input_email.value === '') {
		loaderHide();
		$("#label_input_email").removeClass("has-success");
		$("#label_input_email").addClass("has-error");		
		input_email.focus();
        return false;
      }
	  
	  if (input_password.value === '') {
		loaderHide();
		$("#label_input_password").removeClass("has-success");
		$("#label_input_password").addClass("has-error");		
		input_email.focus();
        return false;
      }
	  
	   try{val_input_save_password = input_save_password.checked;}
			catch (input_save_password){ val_input_save_password = ''; }
	  
	  $.ajax({
		  
		type: 'POST',
		url: base_url+"Login/Login_Validate",
		data: {
		'input_email': input_email.value,
		'input_password': input_password.value,
		'input_save_password': val_input_save_password,
		},
		
		success: function(status) {
		
			loaderHide();
			
			if(status === 'success'){
				
				window.location = base_url;
				
			} else {
			
				if (status === 'destroy'){
					
					window.location = base_url;
					
				} else {
					
					AlertShow('danger',status);
					
				}
				
			}
		}		
	});
	
}

function EForget(e,Target) {
var charCode;
	if(e && e.which){
		charCode = e.which;
	} else if(window.event){
		e = window.event;
		charCode = e.keyCode;
	}
	
	if(charCode == 13) {
		CheckForget(Target);
	}
}
function CheckForget(Target) {
	loaderShow();
	var base_url = $("#base_url").attr("href");
	var input_email = document.getElementById("input_email"); 
	 if (input_email.value === '') {
		loaderHide();
        $(".my-note-input_email").css("display","inline");
		input_email.focus();
        return false ;
      }
	 
	  $.ajax({
		type: 'POST',
		url: base_url+"ChangePassword/PostForget/"+Target,
		data: {
		'input_email': input_email.value,
		},
		success: function(status) {
			loaderHide();
			document.getElementById("my-content").innerHTML = status;
		}		
	});
}

function EChangePasswordF(e,Target) {
var charCode;
	if(e && e.which){
		charCode = e.which;
	} else if(window.event){
		e = window.event;
		charCode = e.keyCode;
	}
	
	if(charCode == 13) {
		SaveNewPasswordF(Target);
	}
}
function SaveNewPasswordF(Target) {

	loaderShow();
	var base_url = $("#base_url").attr("href");
	var input_pass_01 = document.getElementById("input_pass_01"); 
	var input_pass_02 = document.getElementById("input_pass_02"); 
	
	
	  if (input_pass_01.value === '') {
		loaderHide();
        $(".my-note-input_pass_01").css("display","inline");		
        input_pass_01.focus();
        return false ;
      }
	  if (input_pass_02.value === '') {
		loaderHide();
        $(".my-note-input_pass_02").css("display","inline");		
        input_pass_02.focus();
        return false ;
      }
	  if (input_pass_01.value != input_pass_02.value) {
		loaderHide();
        $(".my-note-input_pass_02b").css("display","inline");		
        input_pass_02.focus();
        return false ;
      }	  
	  
	$.ajax({
		type: 'POST',
		url: base_url+"ChangePassword/PostNewPasswordF/"+Target,
		data: {
		'input_pass_01': input_pass_01.value,
		'input_pass_02': input_pass_02.value,
		},
		success: function(status) {
				loaderHide();
				document.getElementById("my-content").innerHTML = status;
			
		}		
	});
} */