<div id="my-menu" style="margin-bottom:0px;">
<nav class="navbar navbar-default" style="margin-bottom:0px;">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			
		<a class="navbar-brand" href="#">
		<table id="my-menu-box-logo"><tr>
		<td><img id="my-menu-logo-img" src="<?php echo base_url('assets/images/logo_new.png'); ?>" alt="LOGO" /></td><td><?php echo $this->session->userdata('set_web'); ?></td>
		</tr></table>
		</a>
			
		</div>
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">	
			
				<li id="Home" class="my-menu-li my-menu-li-active" 
				onclick="MenuSelect('Home')"><a href="#" >
				<center>
					<span class="glyphicon glyphicon-home"></span> 
					<div style="font-size:10px">Home</div>
				</center>
				</a></li>
			
			<?php if($this->session->userdata('id_tr') != ''){ ?>
							
				<li id="Request" class="my-menu-li" 
				onclick="MenuClick('Request')"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
				<center>
					<span class="glyphicon glyphicon-road"></span>
					<div style="font-size:10px">Request</div>
				</center>
				</a>
					<ul class="dropdown-menu my-ul-menu-down">
					
						<li id="Request_Driver" onclick="SubmenuSelect('Request_Driver','Request_Driver/index')"
						><a href="#"><span class="my-text-menu-down"> Request Driver</span></a></li>
						
						<li id="Request_Courier" onclick="SubmenuSelect('Request_Courier','Request_Courier')"
						><a href="#"><span class="my-text-menu-down"> Request Courier</span></a></li>
						
					</ul>
				</li>
			
			<?php 
				if($this->session->userdata('access_tr') == 25 ||
					$this->session->userdata('access_tr') == 26 ){ 
					 //advanced & middle
			?>
				
				<?php //if($this->session->userdata('email_tr') == 'wawan.suryawan@indospec.co.id'){
				if($this->session->userdata('email_tr') <> 'resepsionis@indospec.co.id'){ ?>
				<li id="Cash" class="my-menu-li" 
				onclick="MenuSelect('Cash')"><a href="#" >
				<center>
					<span class="glyphicon glyphicon-usd"></span>
					<div style="font-size:10px">Cash Receipt</div>
				</center>
				</a></li>
				<?php } ?>
				
				<li id="Expense" class="my-menu-li" 
					onclick="MenuClick('Expense')"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<center>
						<span class="glyphicon glyphicon-euro"></span> 
						<div style="font-size:10px">Expense</div>
						</center>
						</a>
						<ul class="dropdown-menu my-ul-menu-down">
						
							<li id="Expense_Driver" onclick="SubmenuSelect('Expense_Driver','Expense_Driver/index')"
							><a href="#"><span class="my-text-menu-down"> Expense Driver</span></a></li>
							
							<li id="Expense_Courier" onclick="SubmenuSelect('Expense_Courier','Expense_Courier/index')"
							><a href="#"><span class="my-text-menu-down"> Expense Courier</span></a></li>
							
							
						</ul>				
					</li>	
				
				<li id="Report" class="my-menu-li" 
				onclick="MenuClick('Report')"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
				<center>
					<span class="glyphicon glyphicon-list-alt"></span>
					<div style="font-size:10px">Report</div>
					</center>
				</a>
					<ul class="dropdown-menu my-ul-menu-down">
						
						<li id="Report_Request_Driver" onclick="SubmenuSelect('Report_Request_Driver','Report_Request_Driver/index')"
						><a href="#"><span class="my-text-menu-down"> Request Driver </span></a></li>
						
						<li id="Report_Request_Courier" onclick="SubmenuSelect('Report_Request_Courier','Report_Request_Courier/index')"
						><a href="#"><span class="my-text-menu-down"> Request Courier</span></a></li>
						
						<li id="Report_Request_Chart" ><a target="_blank" href="<?php echo base_url(); ?>Report_Request_Chart/index"><span class="my-text-menu-down"> Report Chart</span></a></li>
						
						<li id="Report_Petty_Cash" onclick="SubmenuSelect('Report_Petty_Cash','Report_Petty_Cash/index')"
						><a href="#"><span class="my-text-menu-down"> Petty Cash - Open</span></a></li>
						
						<li id="Report_Petty_Cash_Close" onclick="SubmenuSelect('Report_Petty_Cash_Close','Report_Petty_Cash_Close/index')"
						><a href="#"><span class="my-text-menu-down"> Petty Cash - Close</span></a></li>
						
						<li id="Report_Petty_Cash_Search" onclick="SubmenuSelect('Report_Petty_Cash_Search','Report_Petty_Cash_Search/index')"
						><a href="#"><span class="my-text-menu-down"> Petty Cash - Search</span></a></li>
						
					</ul>
				</li>		

				<?php 
				 if($this->session->userdata('access_tr') == 26 ){ 
				//advanced 
				?>
				
				<li id="User" class="my-menu-li" 
				onclick="MenuClick('User')"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
				<center>
					<span class="glyphicon glyphicon-user"></span> 
					<div style="font-size:10px">User</div>
				</center>
				</a>				
					<ul class="dropdown-menu my-ul-menu-down">
					
						<li id="User" onclick="SubmenuSelect('User','User/index')"
						><a href="#"><span class="my-text-menu-down"> User</span></a></li>
						
					</ul>	
				</li>
				
				<li id="Setup" class="my-menu-li" 
				onclick="MenuClick('Setup')"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
				<center>
					<span class="glyphicon glyphicon-cog"></span> 
					<div style="font-size:10px">Setup</div>
					</center>
				</a>
					<ul class="dropdown-menu my-ul-menu-down">
					
						<li id="Car" onclick="SubmenuSelect('Car','Car/index')"
						><a href="#"><span class="my-text-menu-down"> Car</span></a></li>
						
						<li id="Driver" onclick="SubmenuSelect('Driver','Driver/index')"
						><a href="#"><span class="my-text-menu-down"> Driver</span></a></li>
						
						<li id="Courier" onclick="SubmenuSelect('Courier','Courier/index')"
						><a href="#"><span class="my-text-menu-down"> Courier</span></a></li>
						
						<li id="External" onclick="SubmenuSelect('External','External/index')"
						><a href="#"><span class="my-text-menu-down"> External</span></a></li>
						
					</ul>				
				</li>	
				<?php }// advanced ?>
				
				<?php } ?>				
			<?php }elseif($this->session->userdata('id_tr') == ''){ ?>
		
				<li id="Login" class="my-menu-li" 
				onclick="MenuSelect('Login')"><a href="#" >
				<center>
					<span class="glyphicon glyphicon-log-in"></span> 
					<div style="font-size:10px">Login</div>
				</center>
				</a></li>
			
			<?php } ?>
				
			</ul>
			
			<?php if($this->session->userdata('id_tr') != ''){ ?>
			<ul class="nav navbar-nav navbar-right">
				<li id="Logout" ><a href="<?php echo base_url().'Logout/index'; ?>" >
				<center>
					<span class="glyphicon glyphicon-log-out"></span>
					<div style="font-size:10px">Logout</div>
				</center>
				</a></li>
			</ul>
			<?php } ?>
			
		</div><!-- navbar-collapse -->
	</div>
</nav>
</div>