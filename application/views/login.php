<?php 
defined('BASEPATH') or exit ('No direct script access allowed');
?>

<div id="my-breadcrumb">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
	<?php echo $set_menu; ?>
	<?php echo $set_submenu; ?>
  </ol>
</nav>
</div>

<div id="my-data-table">



<div id="my-login-box">
	<div class="panel panel-primary my-panel">
	<div class="panel-body">
	
	<span class="my-login-label">Login Transport Request</span><hr class="my-hr">
	
	<div class="row">
	
	<form action="<?php echo base_url(); ?>Login/Login_Validate" method="post" >
		<div class="col-sm-5">
			<center><img class="img-responsive" src="<?php echo base_url(); ?>assets/images/lock.png" /></center>
		</div>
		
		<div class="col-sm-7">
		
			<span class="my-fild"><b>Email</b></span>
				<span id="label_input_email" class="my-fild-data">
					<input onkeyup="CheckInput('input_email')" class="form-control input-sm" type="email" name="input_email" id="input_email" required />
				</span><br>
				
			<span class="my-fild"><b>Password</b></span>
				<span id="label_input_password" class="my-fild-data">
					<input onkeyup="CheckInput('input_password')" class="form-control input-sm" type="password" name="input_password" id="input_password" required />
				</span><br>
				
			<button class="btn btn-primary btn-sm">Submit</button>
		
				
		</div>
		
	</form>
	</div>
		
		<hr class="my-hr">
		<center><span class="my-label"><i>Copy &copy; 2018 Powered by PTIA</i></span></center>
	
	</div>
	</div>
</div>


</div>