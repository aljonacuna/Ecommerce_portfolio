<ul class="pagination" id="bot-paging-ul">
<?php
$temp_page = $page;
if ($page == 1) {
	
 ?>
 	<li class="page-item disabled" id="bot-paging-li">
<?php	} ?>
		<form method="post" action="ajaxcustomers/switchpage" id="paging-form">
			<input type="hidden" name="page" value="<?= $temp_page-=1 ?>">
			<input type="submit" value="Prev" class="page-link">
		</form>
	</li>			
			
<?php
for ($x = $links_start ; $x <= $links_end  ; $x++) { ?>
	<li class="page-item <?php echo ($page == $x)?"active":""?>" id="bot-paging-li">
		<form method="post" action="ajaxcustomers/switchpage" id="paging-form">
			<input type="hidden" name="page" value="<?= $x ?>">
			<input type="submit" value="<?= $x ?>" class="page-link">
		</form>
	</li>
<?php	}
?>		
	
	
<?php
$temp_page = $page;
if ($links_end == $max_page) {
	
 ?>
	 <li class="page-item disabled" id="bot-paging-li">	
		
<?php	}?>	
		<form method="post" action="ajaxcustomers/switchpage" id="paging-form">
			<input type="hidden" name="page" value="<?= $temp_page+=1 ?>">
			<input type="submit" value="Next" class="page-link">
		</form>
	</li>
</ul>