<div id="my-footer"></div>
<span id="ActionTarget" label="<?php echo enid_get(0); ?>"></span>
<span id="BaseUrl" label="<?php echo base_url(); ?>"></span>
</div><!--wrapper-->

<?php if($this->session->userdata('access_tr') == 25){ ?>
<script type="text/javascript">

var auto_refresh_notif = setInterval(LoadNotificationRequest, 5000);

function LoadNotificationRequest(){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
				$("#RowData").hide();
				
				if(this.responseText === 'none'){
					
					document.getElementById("request-notification").innerHTML = '';			
					
				}else if(this.responseText !== 'none'){
	
					document.getElementById("request-notification").innerHTML = this.responseText;
				}
				
			}
		};
	xhttp.open("GET", "<?php echo base_url();?>Main_Control/Get_Request", true);
	xhttp.send();
}
</script>
<?php } ?>

<script type="text/javascript">
function Tone(Action) {
	if(Action === 'send' ){
		var tone = document.getElementById("tone-send-request"); 
		tone.play(); 
	}
	if(Action === 'new' ){
		var tone = document.getElementById("tone-new-request"); 
		tone.play(); 
	}
}
</script>


</body>
</html>