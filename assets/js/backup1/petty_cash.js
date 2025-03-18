function ConfirmBoxShow(){ 
	$('#my-box-confirm').show();
	document.getElementById("BtnSubmitConfirm").focus();
}

function ConfirmBoxHide(){
	$('#my-box-confirm').hide();
}

function ConfirmProccess(TargetLink) {

	LoadDataTable(TargetLink);
		ConfirmBoxHide();
}

function MarkReq(TargetID,TargetBox,Action,Request) {

	var x = document.getElementById("my-mark-off"+TargetBox);
	var y = document.getElementById("my-mark-on"+TargetBox);
	var z = document.getElementById("BtnSubmitProccess");
	var num = document.getElementById("SelectedRow").innerHTML;
	
	var x2 = document.getElementById("my-mark-all-off");
	var y2 = document.getElementById("my-mark-all-on");
	
	if(Action == 1){
		
		x.style.display = 'none';
		y.style.display = 'block';
		
		MarkAdd(TargetID,Request);
		
		var new_num = parseInt(num)+1;
		
		if(new_num > 0){
			x2.style.display = 'none';
			y2.style.display = 'block';
		}
		
	} else {
		
		x.style.display = 'block';
		y.style.display = 'none';
		
		MarkDelete(TargetID,Request);
		
		var new_num = parseInt(num)-1;
		
		if(new_num <= 0){
			x2.style.display = 'block';
			y2.style.display = 'none';				
		}
		
	}
	
	if(new_num == 0){z.style.display = 'none';} else {z.style.display = 'block';}
	
	document.getElementById("SelectedRow").innerHTML = new_num;
	document.getElementById("SelectedRowBottom").innerHTML = new_num;
}

function MarkAllReq(Action) {

	var x = document.getElementById("my-mark-all-off");
	var y = document.getElementById("my-mark-all-on");
	var z = document.getElementById("BtnSubmitProccess");
	var num = document.getElementById("my-count").innerHTML;
	
	var x2 = $(".my-mark-off");
	var y2 = $(".my-mark-on");
	
	if(Action == 1){
		
		x.style.display = 'none';
		y.style.display = 'block';
		
		x2.css('display','none');
		y2.css('display','block');
		
		MarkAllAdd();
		
		var new_num = parseInt(num);
		
	} else {
		
		x.style.display = 'block';
		y.style.display = 'none';
		
		x2.css('display','block');
		y2.css('display','none');
			
		MarkAllDelete();
		
		var new_num = 0;
	}
	
	if(new_num == 0){z.style.display = 'none';} else {z.style.display = 'block';}
	
	document.getElementById("SelectedRow").innerHTML = new_num;
	document.getElementById("SelectedRowBottom").innerHTML = new_num;
}



function MarkAdd(TargetID,Request) {

	var base_url = $("#BaseUrl").attr("label");
	
	$.ajax({
		type: 'POST',
		url: base_url+'Report_Petty_Cash/Mark_Add',
		data: {
		'input_index': TargetID,
		'input_request': Request,
		},
		success: function(status) {
			
			if(status === 'failed'){
			
				AlertShow('danger','Proses Failed');
				
			}			
		}
	});
}

function MarkDelete(TargetID,Request) {

	var base_url = $("#BaseUrl").attr("label");
	
	$.ajax({
		type: 'POST',
		url: base_url+'Report_Petty_Cash/Mark_Delete',
		data: {
		'input_index': TargetID,
		'input_request': Request,
		},
		success: function(status) {
			
			if(status === 'failed'){
			
				AlertShow('danger','Proses Failed');
				
			}			
		}		
	});
}

function MarkAllAdd(TargetID) {

	var base_url = $("#BaseUrl").attr("label");
	
	$.ajax({
		type: 'POST',
		url: base_url+'Report_Petty_Cash/Mark_All_Add',
		success: function(status) {
			
			if(status === 'failed'){
			
				AlertShow('danger','Proses Failed');
				
			}			
		}
		
	});
}

function MarkAllDelete(TargetID) {

	var base_url = $("#BaseUrl").attr("label");
	
	$.ajax({
		type: 'POST',
		url: base_url+'Report_Petty_Cash/Mark_All_Delete',
		success: function(status) {
			
			if(status === 'failed'){
			
				AlertShow('danger','Proses Failed');
				
			}			
		}
		
	});
}


function SearchDateClose(Target) {
	loaderShow();
	var base_url = $("#BaseUrl").attr("label");
	var input_src_a =  document.getElementById("input_src_a"); 
	  
		$.ajax({
			type: 'POST',
			url: base_url+Target,
			data: {
			'input_date_a': input_src_a.value,
			},
			success: function(status) {
			
			loaderHide();
			
				if (status === 'destroy'){
					window.location = base_url;
				} else {
					document.getElementById("my-data-table").innerHTML = status;
				}
			
			}		
		});
	
}


function CompanyBoxShow(){
	var x = document.getElementById("my-company-box");
    if (x.style.display === 'none') {
        x.style.display = 'block';
		try{
			x.style.left = event.pageX+'px';
		} catch (x){$("#my-company-box").css('left','120px');}
		
    } else {
        x.style.display = 'none';
    }
}

function PettyBoxShow(){
	var x = document.getElementById("my-petty-box");
    if (x.style.display === 'none') {
        x.style.display = 'block';
		try{
			x.style.left = event.pageX+'px';
		} catch (x){$("#my-petty-box").css('left','180px');}
		
    } else {
        x.style.display = 'none';
    }
}
