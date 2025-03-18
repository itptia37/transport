function ChangeInput(){
	var em   = document.getElementById("input_email");
	var pass = document.getElementById("input_password");
	var check = document.getElementById("input_save_password");
	var my_check = document.getElementById("my-check");
	if(check.checked == false){
		em.removeAttribute("readonly");
		pass.removeAttribute("readonly");
		my_check.style.display = 'none';
	} else {
		em.readOnly = true;
		pass.readOnly = true;
	}
}

function LoaderShow(){
	var base_url = $("#BaseUrl").attr("label");/*<img src="'+base_url+'assets/images/loader.gif"/>*/
	document.getElementById("my-loading").innerHTML = '<div class="alert alert-info"><center><span id="my-loader" class="glyphicon glyphicon-refresh"></span> Waiting ...</center></div>';
}

function LoaderHide(){
	var base_url = $("#BaseUrl").attr("label");
	document.getElementById("my-loading").innerHTML = '';
}

function AlertShow(Type,Text){
	$(".my-alert-box").css('display','block');
	document.getElementById("my-alert-box").innerHTML = '<div class="alert alert-'+Type+' alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><center><span class="glyphicon glyphicon-alert"></span>&nbsp;&nbsp;'+Text+'</center></div>';
}

function AlertHide(){
	$(".my-alert-box").css('display','none');
}

function DateShow(TargetInput) {
	$("#"+TargetInput).datepicker({dateFormat: 'dd-mm-yy'});
}

function MenuClick(Menu){
	$(".my-menu-li-active").removeClass("my-menu-li-active");
	$("#"+Menu).addClass("my-menu-li-active");
}

function MenuSelect(Target){
	$(".my-menu-li-active").removeClass("my-menu-li-active");
	$("#"+Target).addClass("my-menu-li-active");
	
	LoadContent(Target);
	
}
function SubmenuSelect(Menu,Target){
	$(".my-menu-li-down-active").removeClass("my-menu-li-down-active");
	$("#"+Menu).addClass("my-menu-li-down-active");
	
	LoadContent(Target);
}

function LoadContent(Target) {

LoaderShow();

var base_url = $("#BaseUrl").attr("label");
var xhttp = new XMLHttpRequest();

xhttp.onreadystatechange = function() {
	
    if (this.readyState == 4 && this.status == 200) {
			
			LoaderHide();
			
			if (Target === 'Logout'){
				window.location = base_url;
			} else {
				if (this.responseText === 'destroy'){
					window.location = base_url;
				} else {
					
					document.getElementById("my-content").innerHTML = this.responseText;
				}
			}
			
		} 
	};
	xhttp.open("GET", base_url+Target, true);
	xhttp.send();
}






function LoadContentBottom(Target){
	var tr = $("#SelectedRowIndexData").attr("label"); /* primary */
	if(tr !== ''){
		var New_Target = Target+tr;
		LoadContent(New_Target)
	}
}

function FormFloatBottomShow(Target){
	var tr = $("#SelectedRowIndexData").attr("label");
	if(tr !== ''){
		var New_Target = Target+tr;
		FormFloatShow(New_Target)
	}
}

function FormFloatShow(Target) {

LoaderShow();

var base_url = $("#BaseUrl").attr("label");
var xhttp = new XMLHttpRequest();

xhttp.onreadystatechange = function() {
	
    if (this.readyState == 4 && this.status == 200) {
			
			LoaderHide();
			
				if (this.responseText === 'destroy'){
					window.location = base_url;
				} else {
					
					document.getElementById("my-box-form-float").innerHTML = this.responseText;
				}
			
			
		} 
	};
	xhttp.open("GET", base_url+Target, true);
	xhttp.send();
}

function FormFloatHide() {
	document.getElementById("my-box-form-float").innerHTML = '';
}


function ExportBoxShow(){
	var x = document.getElementById("my-export-box");
    if (x.style.display === 'none') {
        x.style.display = 'block';
		try{
			x.style.left = event.pageX+'px';
		} catch (x){$("#my-export-box").css('left','330px');}
		
    } else {
        x.style.display = 'none';
    }
}


function RowBoxShow(){
	var x = document.getElementById("my-row-box");
    if (x.style.display === 'none') {
        x.style.display = 'block';
		
		try{
			x.style.left = event.pageX+'px';
		} catch (x){$("#my-row-box").css('left','250px');}
			
    } else {
        x.style.display = 'none';
    }
}

function SummaryBoxShow(){
	var x = document.getElementById("my-summary-box");
    if (x.style.display === 'none') {
        x.style.display = 'block';
		x.style.left = event.pageX+'px';
    } else {
        x.style.display = 'none';
    }
}

function SelectRowNormal(Row){
	$(".my-tr-selected").removeClass("my-tr-selected");
	$("#my-tr"+Row).addClass("my-tr-selected");
}


function SelectRow(Row,Target,Name,MethodNext,ControllerNext,Identifier,Detail,Delete,Print) {
	
	var base_url = $("#BaseUrl").attr("label");
	$(".my-tr-selected").removeClass("my-tr-selected");
	$("#my-tr"+Row).addClass("my-tr-selected");
	$("#SelectedRowIndexData").attr('label',Target);
	$("#SelectedRowNameData").attr('label',Name);

	
	if(Detail == 1){
		document.getElementById("BtnEdit").innerHTML= '<span class="btn btn-primary btn-sm" onclick="'+MethodNext+'(&#39;'+ControllerNext+'/Form/Edit/&#39;)"><span class="glyphicon glyphicon-list-alt"></span> Detail</span>';
	} 
	
	if(Identifier == '0'){
		if(Delete == 1){
			document.getElementById("BtnDelete").innerHTML= '<span class="btn btn-danger btn-sm" onclick="DeleteBoxShow(&#39;'+Target+'&#39;,&#39;'+Name+'&#39;)"><span class="glyphicon glyphicon-remove"></span> Delete</span>';
		} 
	} 
	
	if(Print == 1){
		document.getElementById("BtnDelete").innerHTML= '<a href="'+base_url+ControllerNext+'/Form/Print/'+Target+'" target="blank" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-print"></span></a>';
	}
	
}


function LoadDataTable(Target) {

var base_url = $("#BaseUrl").attr("label");
var xhttp = new XMLHttpRequest();

xhttp.onreadystatechange = function() {
	
    if (this.readyState == 4 && this.status == 200) {
			
			if (Target === 'Logout'){
				window.location = base_url;
			} else {
				if (this.responseText === 'destroy'){
					window.location = base_url;
				} else {
					
					document.getElementById("my-data-table").innerHTML = this.responseText;
				}
			}
		} 
	};
	xhttp.open("GET", base_url+Target, true);
	xhttp.send();
}


function Search(Target) {
	LoaderShow();
	var base_url = $("#BaseUrl").attr("label");
	var input_src = document.getElementById("input_src"); 

	  
		$.ajax({
			type: 'POST',
			url: base_url+Target,
			data: {
			'input_src': input_src.value,
			},
			success: function(status) {
			
			LoaderHide();
			
				if (status === 'destroy'){
					window.location = base_url;
				} else {
					document.getElementById("my-data-table").innerHTML = status;
				}
			
			}		
		});
	
}

function SearchDate(Target) {
	LoaderShow();
	var base_url = $("#BaseUrl").attr("label");
	var input_src_a =  document.getElementById("input_src_a"); 
	var input_src_b =  document.getElementById("input_src_b"); 
	  
		$.ajax({
			type: 'POST',
			url: base_url+Target,
			data: {
			'input_date_a': input_src_a.value,
			'input_date_b': input_src_b.value,
			},
			success: function(status) {
			
			LoaderHide();
			
				if (status === 'destroy'){
					window.location = base_url;
				} else {
					document.getElementById("my-data-table").innerHTML = status;
				}
			
			}		
		});
	
}

function CheckPassword(Target){
	var input_password = document.getElementById("input_password");
	var input_confirm_password = document.getElementById("input_confirm_password");
	if (input_confirm_password.value !== input_password.value) {
		$("#label_input_confirm_password").removeClass("has-success");
		$("#label_input_confirm_password").addClass("has-error");		
        input_confirm_password.focus();
        return false;
	} else if (input_confirm_password.value === input_password.value) {
		$("#label_input_confirm_password").addClass("has-success");
		$("#label_input_confirm_password").removeClass("has-error");				
		input_confirm_password.focus();
		return false;
    }
}

function CheckInput(Target){
	var input = document.getElementById(Target);
	if (input.value === '') {
		$("#label_"+Target).removeClass("has-success");
		$("#label_"+Target).addClass("has-error");		
        input.focus();
        return false;
	} else if (input.value !== '') {
		$("#label_"+Target).addClass("has-success");
		$("#label_"+Target).removeClass("has-error");				
		input.focus();
		return false;
    }
}

function CheckNumber(Target){
	var input = document.getElementById(Target);
	if(!/^[0-9.]+$/.test(input.value)){
		$("#label_"+Target).removeClass("has-success");
		$("#label_"+Target).addClass("has-error");		
		input.focus();
        return false;
	}else if(/^[0-9.]+$/.test(input.value)){
		$("#label_"+Target).addClass("has-success");
		$("#label_"+Target).removeClass("has-error");		
		input.focus();
        return false;
	}
}

function CheckedAll(Index,Target) {
	var New_Index = document.getElementById(Index);
	
	if(New_Index.checked === true){
		$("."+Target).attr('checked', true);
	} else {
		$("."+Target).attr('checked', false);
	}
}

function StatusBoxShow(Id,Val,Name,Text){ AlertShow('danger','Proccess Filed');
	$('#my-box-status').show();
	document.getElementById("StatusText").innerHTML = Text;
	document.getElementById("StatusName").innerHTML = Name;
	document.getElementById("input_value_status").value = Val;
	document.getElementById("input_index_status").value = Id;
	document.getElementById("BtnSubmitStatus").focus();
	
	if(Val == 0){
		$("#BtnSubmitStatus").removeClass("btn-primary");
		$("#BtnSubmitStatus").addClass("btn-danger");
	}
	else if(Val == 1){
		$("#BtnSubmitStatus").removeClass("btn-danger");
		$("#BtnSubmitStatus").addClass("btn-primary");
	}
}

function StatusBoxHide(){
	$('#my-box-status').hide();
}

function StatusProccess(Target,DataTable) {

	LoaderShow();

	var base_url = $("#BaseUrl").attr("label");
	var input_index = document.getElementById("input_index_status"); 
	var input_status = document.getElementById("input_value_status"); 

	  if (input_index.value === '') {
		LoaderHide();
			AlertShow('danger','Proccess Filed');
        return false;
      }
	  
	  if (input_status.value === '') {
		LoaderHide();
			AlertShow('danger','Proccess Filed');
        return false;
      }
	  

	$.ajax({
		type: 'POST',
		url: base_url+Target,
		data: {
		'input_index': input_index.value,
		'input_status': input_status.value,
		},
		success: function(status) {
		
			LoaderHide();
			if (status === 'destroy'){
				window.location = base_url;
			} else {
				
				if(status === 'Status has been changed'){
				
					AlertShow('success',status);
					StatusBoxHide();
					LoadDataTable(DataTable);
					
				} else {
					AlertShow('danger',status);
				}
				
			}
			
		}		
	});
}

function ListBoxShowCheck(TargetBox,Target,TargetData,TargetInput,TargetParameter,Text){
	var ActionTarget = $("#ActionTarget").attr("label"); /* parameter id */
	var parameter = document.getElementById(TargetParameter);
	var x = document.getElementById(TargetBox);
	var y = document.getElementById(TargetInput);
	
	if(parameter.value === ActionTarget || parameter.value === '' || parameter.value == 0){
	
		y.setAttribute("type", "text");
	
		ListBoxShow(TargetBox,Target,TargetData,TargetInput);
		
	} else {
		
		y.setAttribute("type", "hidden");

		if (x.style.display === 'none') {
		 
			x.style.display = 'block';
			
			document.getElementById(TargetData).innerHTML = 'Delete '+Text+' for select this item';
			
		} else {
			x.style.display = 'none';
		}
		
	}
}

function ListBoxShow(TargetBox,Target,TargetData,TargetInput){
	var x = document.getElementById(TargetBox);
	
    if (x.style.display === 'none') {
     
		x.style.display = 'block';
		
		ListDataSrc(Target,TargetData,TargetInput);
		document.getElementById(TargetInput).focus();
		
    } else {
        x.style.display = 'none';
    }
}

function ListDataSrc(Target,TargetData,TargetInput) {

	var base_url = $("#BaseUrl").attr("label");
	var input_src_list = document.getElementById(TargetInput); 

	  
		$.ajax({
			type: 'POST',
			url: base_url+Target,
			data: {
			'input_src_list': input_src_list.value,
			},
			success: function(status) {
			
				if (status === 'destroy'){
					window.location = base_url;
				} else {
					document.getElementById(TargetData).innerHTML = status;
				}
			
			}		
		});
}

function ListDataSelect(TargetBox,TargetId,Id,TargetName,Name,Car,CarName,Action) {
		
		document.getElementById(TargetId).value = Id;
		document.getElementById(TargetName).innerHTML = Name;
		
		if(Action === 'with_car'){
			document.getElementById('input_car').value = Car;
			document.getElementById('input_car_name').innerHTML = CarName;
		}
		
		var a = document.getElementById('style_time_personal');
		var b = document.getElementById('style_project_number');
		var c = document.getElementById('style_finish');
		var d = document.getElementById('style_return_plan');
		
		if(Id === 4 || Id === 6 ){ /* personal car & personal motorcycle */
		
			a.style.display = 'block';
			try{c.style.display = 'none';} catch(c){}
			try{d.style.display = 'none';} catch(d){}
			
		} else if(Id === 1 || Id === 2 || Id === 3 || Id === 5){
			
			try{a.style.display = 'none';} catch(y){}
			try{c.style.display = 'block';} catch(y){}
			try{d.style.display = 'block';} catch(d){}
			
		}
		
		if(Id === 8 ){ /* project */
		
			b.style.display = 'block';
					
		} else if(Id === 7 || Id === 9 ) {
				
			try{b.style.display = 'none';} catch(b){}
			
		}
		
	var x = document.getElementById(TargetBox);
	x.style.display = 'none';
	
}

function UploadFile(Target,MethodNext,DataForm) {

	LoaderShow();	
	
	var base_url = $("#BaseUrl").attr("label");	
	var input_target = document.getElementById("input_target").value;
	var file_data = $("#input_file").prop("files")[0];
    var form_data = new FormData();
	form_data.append("file_attachment", file_data);
	form_data.append("input_target", input_target);
		$.ajax({
		type: 'POST',
		url: base_url+Target+'/Upload_File',
		cache: false,
        contentType: false,
        processData: false,
        data: form_data,
		success	: function(status) {
			
			LoaderHide();
				
			if(status == 'File has been uploaded'){
					
				AlertShow('success',status);
				
				if(MethodNext === 'LoadContent') {
					LoadContent(DataForm);
				} else if(MethodNext === 'FormFloatShow') {
					FormFloatShow(DataForm);
				}
					
			} else {
					
				AlertShow('danger',status);
					
			}
		}
	});
}

/* delete attachment */
function DeleteBoxAttachmentShow(Id,Name){ 
	$('#my-box-delete-attachment').show();
	document.getElementById("DeleteNameAttachment").innerHTML = Name;
	document.getElementById("input_index_attachment").value = Id;
	document.getElementById("BtnSubmitDeleteAttachment").focus();
}

function DeleteBoxAttachmentHide(){
	$('#my-box-delete-attachment').hide();
}

function DeleteAttachmentProccess(Target,MethodNext,DataForm) {

	LoaderShow();

	var base_url = $("#BaseUrl").attr("label");
	var input_index = document.getElementById("input_index_attachment"); 
	var input_attachment = document.getElementById("DeleteNameAttachment").innerHTML;
	
	  if (input_index.value === '') {
		LoaderHide();
			AlertShow('danger','Proccess Filed');
        return false;
      }
	  
	  if (input_attachment === '') {
		LoaderHide();
			AlertShow('danger','Proccess Filed');
        return false;
      }
	  

	$.ajax({
		type: 'POST',
		url: base_url+Target+'/Delete_File',
		data: {
		'input_index': input_index.value,
		'input_attachment': input_attachment,
		},
		success: function(status) {
		
			LoaderHide();
			if (status === 'destroy'){
				window.location = base_url;
			} else {
				
				if(status === 'File has been deleted'){
				
					AlertShow('success',status);
					
					DeleteBoxAttachmentHide();
					
					if(MethodNext === 'LoadContent') {
						LoadContent(DataForm);
					} else if(MethodNext === 'FormFloatShow') {
						FormFloatShow(DataForm);
					}
					
				} else {
					AlertShow('danger',status);
				}
				
			}
			
		}		
	});
}



/* filter */
function FilterBoxShow(TargetBox){
	$("#"+TargetBox).show();
}
function FilterBoxHide(TargetBox){
	$("#"+TargetBox).hide();
}
function FilterDateBoxShow(TargetBox){
	$("#"+TargetBox).show();
}
function FilterDateBoxHide(TargetBox){
	$("#"+TargetBox).hide();
}

function FilterDateProccess(Target,TargetInput_a,TargetInput_b){
	
	var base_url = $("#BaseUrl").attr("label");
	var input_date_a = document.getElementById(TargetInput_a);
	var input_date_b = document.getElementById(TargetInput_b);
	
		$.ajax({
			type: 'POST',
			url: base_url+Target,
			data: {
			'input_date_a': input_date_a.value,
			'input_date_b': input_date_b.value,
			},
			success: function(status) {
			
				if (status === 'destroy'){
					
					window.location = base_url;
					
				} else {
					
					document.getElementById("my-data-table").innerHTML = status;
					
				}
			
			}		
		});
}
function FilterListBoxShow(TargetBox,TargetLink,TargetData,TargetInput){
	$("#"+TargetBox).show();
	FilterListDataSrc(TargetLink,TargetData,TargetInput);
}
function FilterListBoxHide(TargetBox){
	$("#"+TargetBox).hide();
}

function FilterListDataSrc(TargetLink,TargetData,TargetInput) {

	var base_url = $("#BaseUrl").attr("label");
	var input_src_list = document.getElementById(TargetInput); 
	  
		$.ajax({
			type: 'POST',
			url: base_url+TargetLink,
			data: {
			'input_src_list': input_src_list.value,
			},
			success: function(status) {
			
				if (status === 'destroy'){
					window.location = base_url;
				} else {
					document.getElementById(TargetData).innerHTML = status;
				}
			
			}		
		});
}


function CancelBoxShow(Name){ 
	$('#my-box-cancel').show();
	document.getElementById("CancelName").innerHTML = Name;
	document.getElementById("BtnSubmitCancel").focus();
}

function CancelBoxHide(){
	$('#my-box-cancel').hide();
}

function CancelProccess(Target) {

	LoaderShow();

	var base_url = $("#BaseUrl").attr("label");
	var input_index = document.getElementById("input_target"); 

	  if (input_index.value === '') {
		LoaderHide();
			AlertShow('danger','Proccess Filed');
        return false;
      }
	  

	$.ajax({
		type: 'POST',
		url: base_url+Target,
		data: {
		'input_index': input_index.value,
		},
		success: function(status) {
		
			LoaderHide();
			document.getElementById("my-content").innerHTML = status;
		}		
	});
}



function SearchPatty(){
	LoaderShow();
	
	var base_url = $("#BaseUrl").attr("label");
	var input_company = document.getElementById("input_company"); 
	var input_request = document.getElementById("input_request"); 
	var input_purpose = document.getElementById("input_purpose"); 
	var input_department = document.getElementById("input_department"); 
	var input_requestor = document.getElementById("input_requestor"); 
	var input_close = document.getElementById("input_close");
	var input_driver = document.getElementById("input_driver"); 
	var input_courier = document.getElementById("input_courier"); 
	var input_external = document.getElementById("input_external"); 
	var input_date_a = document.getElementById("input_date_a"); 
	var input_date_b = document.getElementById("input_date_b"); 
	
	if (input_date_a.value === '') {
		LoaderHide();
		$("#label_input_date_a").removeClass("has-success");
		$("#label_input_date_a").addClass("has-error");		
		input_date_a.focus();
        return false;
    }
	
	if (input_date_b.value === '') {
		LoaderHide();
		$("#label_input_date_b").removeClass("has-success");
		$("#label_input_date_b").addClass("has-error");		
		input_date_b.focus();
        return false;
    }
	
	$.ajax({
		type: 'POST',
		url: base_url+'Report_Petty_Cash_Search/Search',
		data: {
		'input_company': input_company.value,
		'input_request': input_request.value,
		'input_purpose': input_purpose.value,
		'input_department': input_department.value,
		'input_requestor': input_requestor.value,
		'input_driver': input_driver.value,
		'input_courier': input_courier.value,
		'input_external': input_external.value,
		'input_close': input_close.value,
		'input_date_a': input_date_a.value,
		'input_date_b': input_date_b.value,
		},
		success: function(status) {
		
			LoaderHide();
			document.getElementById("my-data-table").innerHTML = status;
		}		
	});
	
}