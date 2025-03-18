<div id="my-breadcrumb">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
	<?php echo $set_menu; ?>
	<?php echo $set_submenu; ?>
	<?php echo $set_action; ?>
  </ol>
</nav>	
</div>

			<div class="panel panel-primary my-panel-form">
			<div class="panel-body">
			
			<span class="my-title"><b><span class="glyphicon glyphicon-record"></span> Search Petty Cash </span></b></span>
			<hr class="my-hr">
			
			<div class="row">	
				<div class="col-sm-4">				
				
				<span class="my-fild">Company</span>
				<span id="label_input_company" class="my-fild-data">
				<select name="input_company" id="input_company" class="form-control input-sm">
					<option value="">All</option>
					<?php 
					foreach($result_company as $dtc){
						echo '<option value="'.$dtc->id_parameter.'">'.$dtc->name.'</option>';
					}
					?>
				</select>
				</span><div class="my-break"></div>						
				
				<span class="my-fild">Request</span>
				<span id="label_input_request" class="my-fild-data">
				<select name="input_request" id="input_request" class="form-control input-sm">
					<option value="">All</option>
					<option value="1">Driver</option>
					<option value="2">Courier</option>
				</select>
				</span><div class="my-break"></div>				

				<span class="my-fild">Purpose</span>
				<span id="label_input_purpose" class="my-fild-data">
				<select name="input_purpose" id="input_purpose" class="form-control input-sm">
					<option value="">All</option>
					<?php 
					foreach($result_purpose as $dtp){
						echo '<option value="'.$dtp->id_parameter.'">'.$dtp->name.'</option>';
					}
					?>
				</select>
				</span><div class="my-break"></div>	
				
				<span class="my-fild">Department</span>
				<span id="label_input_department" class="my-fild-data">
				<select name="input_department" id="input_department" class="form-control input-sm">
					<option value="">All</option>
					<?php 
					foreach($result_department as $dtd){
						echo '<option value="'.$dtd->id_department.'">'.$dtd->department.'</option>';
					}
					?>
				</select>
				</span><div class="my-break"></div>	
				
				</div>			
				<div class="col-sm-4">				
			
				<span class="my-fild">Requestor</span>
				<span id="label_input_requestor" class="my-fild-data">
				<select name="input_requestor" id="input_requestor" class="form-control input-sm">
					<option value="">All</option>
					<?php 
					foreach($result_requestor as $dtd){
						echo '<option value="'.$dtd->id_login.'">'.my_user_name($dtd->name,$dtd->email).'</option>';
					}
					?>
				</select>
				</span><div class="my-break"></div>	
	
				<span class="my-fild">Driver</span>
				<span id="label_input_driver" class="my-fild-data">
				<select name="input_driver" id="input_driver" class="form-control input-sm">
					<option value="">All</option>
					<?php 
					foreach($result_driver as $dto1){
						echo '<option value="'.$dto1->driver.'">Driver - '.$dto1->name.'</option>';
					}
					?>
				</select>
				</span><div class="my-break"></div>	
				
				<span class="my-fild">Courier</span>
				<span id="label_input_courier" class="my-fild-data">
				<select name="input_courier" id="input_courier" class="form-control input-sm">
					<option value="">All</option>
					<?php 
					foreach($result_courier as $dto2){
						echo '<option value="'.$dto2->courier.'">Courier - '.$dto2->name.'</option>';
					}
					?>
				</select>
				</span><div class="my-break"></div>	
				
				
				<span class="my-fild">External</span>
				<span id="label_input_external" class="my-fild-data">
				<select name="input_external" id="input_external" class="form-control input-sm">
					<option value="">All</option>
					<?php 
					foreach($result_external as $dto3){
						echo '<option value="'.$dto3->id_parameter.'"> External - '.$dto3->name.'</option>';
					}
					?>
				</select>
				</span><div class="my-break"></div>	
				
				</div>			
				<div class="col-sm-4">	
	
				<span class="my-fild">New / Close</span>
				<span id="label_input_close" class="my-fild-data">
				<select name="input_close" id="input_close" class="form-control input-sm">
					<option value="">All</option>
					<option value="1">New</option>
					<option value="2">Close</option>
				</select>
				</span><div class="my-break"></div>	
				
					<span class="my-fild">Date Range</span>
					<span id="label_input_date_a" class="my-fild-data">
						<input value="<?php echo $date_a; ?>" onmouseover="DateShow('input_date_a')" type="text" class="form-control input-sm" name="input_date_a" id="input_date_a" placeholder="Start..." require />
					</span><div class="my-break"></div>	
					
					<span class="my-fild">&nbsp;</span>
					<span id="label_input_date_b" class="my-fild-data">
						<input value="<?php echo $date_b; ?>" onmouseover="DateShow('input_date_b')" type="text" class="form-control input-sm" name="input_date_b" id="input_date_b" placeholder="End..." require />
					</span><div class="my-break"></div>	
					
					<br>

				</div>			
			</div>	
					
					<div class="btn-group">
						<button onclick="SearchPatty()" name="btn_search" id="btn_search" class="btn btn-primary btn-sm">Search</button>
						<a href="#" onclick="LoadContent('Report_Petty_Cash_Search/index')" class="btn btn-default btn-sm">Refresh</a>
					</div>
					
			</div><!-- panel-body -->
			</div><!-- panel -->		
			

				
				

<div id="my-data-table" style="margin-top:2px;">	

</div><!-- my-data-table-->