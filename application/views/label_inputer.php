	<?php if($creater != '' || $creater_email != ''){ ?>
		<span class="my-fild-data">
			<?php 
			
			echo'<span class="my-label">Created by '.my_user_name($creater,$creater_email).' '.$created_date.'</span>';
			?>
		</span><br>
	<?php } ?>
	
	<?php if($updater != '' || $updater_email != ''){ ?>
	<span class="my-fild-data">
			<?php 
			echo'<span class="my-label">Updated by '.my_user_name($updater,$updater_email).' '.$updated_date.'</span>';
			?>
		</span><br>
	<?php } ?>