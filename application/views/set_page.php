	<?php if($num_data > 0 && $num_data > $myrow){?>
	<ul class="pagination">	
	<?php if($page>5){ ?>
	<li><a href="#" onclick="LoadDataTable('<?php echo $controller; ?>/Page/1/1')"
		><span class="glyphicon glyphicon-step-backward my-glyphicon"></span></a></li>
	<?php } ?>
	
		<?php if($page>5){ ?>
			<li><a href="#" onclick="LoadDataTable('<?php echo $controller; ?>/Page/<?php echo ($next-1); ?>/<?php echo ($next-5); ?>')"
			><span class="glyphicon glyphicon-chevron-left my-glyphicon"></span></a></li>
		<?php } ?>
		<?php for ($i=1; $i<=(5); $i++){ ?>
			<?php if(($i+($next-1)) == $page){$page_active='id="my-page-active"';}else{$page_active='';} ?>
		<?php if(($i+$next)<=($max+1)){ ?>
			<li><a <?php echo $page_active; ?> href="#" 
			onclick="LoadDataTable('<?php echo $controller; ?>/Page/<?php echo ($i+($next-1)); ?>/<?php echo ($next); ?>')"
			><?php echo ($i+($next-1)); ?></a></li>
		<?php }} ?>
		
		<?php if(($i+$next) <= $max){ ?>
		<li><a href="#" onclick="LoadDataTable('<?php echo $controller; ?>/Page/<?php echo ($next+5); ?>/<?php echo ($next+5); ?>')"
		><span class="glyphicon glyphicon-chevron-right my-glyphicon"></span></a></li>
		
	<li><a href="#" onclick="LoadDataTable('<?php echo $controller; ?>/Page/<?php echo ($max); ?>/<?php echo ($max-1); ?>')"
	><span class="glyphicon glyphicon-step-forward my-glyphicon"></span></a></li>
	<?php } ?>		
	</ul>
	<?php } ?>