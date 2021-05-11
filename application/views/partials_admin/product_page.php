<div class="alert alert-warning alert-dismissible fade show" role="alert" id="msg" style="display: <?= ($msg == "")?"none":"block"; ?>">
  <strong>Error: </strong> <?= $msg ?>.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<div class="container-fluid" id="order-section">
	<table class="table table-hover">
		<tr>
			<th scope="col">Image</th>
			<th scope="col">ID</th>
			<th scope="col">Name</th>
			<th scope="col">Inventory count</th>
			<th scope="col">Quantity sold</th>
			<th scope="col">Action</th>
	    </tr>
<?php  
	foreach ($products as $value) { 

			$img_explode = explode(",", $value['image']);
			$main_img = "";
			foreach ($img_explode as  $value_image) {
				if (substr($value_image, 0,5) == "main:") {
					$main_img = substr($value_image, 5,strlen($value_image));
				}
			}
			
		?>
	    <tr>
			<td id="image-td"><img src="<?= base_url()?>uploads/<?= $main_img ?>" id="product-img"></td>
			<td><a href=""><?= $value['id']?></a></td>
			<td><?= $value['name'] ?></td>
			<td><?= $value['quantity'] ?></td>
			<td>
	<?php
		foreach ($sold as $key => $value1) {
			if ($value['id'] == $value1['id']) {
				echo (is_null($value1['id'])) ? "0" : $value1['quantity_sold'];
			}
		}
		?>
			</td>
			<td><a href="" class="fa fa-pencil fs-5 ms-2 text-reset text-decoration-none"></a>
				<a href="" class="fa fa-trash fs-5 ms-3 text-reset text-decoration-none"></a></td>
		</tr>
<?php   }

?>
		
	</table>
</div>
<div class="container-fluid" id="pages">
	<nav aria-label="Paging" id="paging-bottom">
		<ul class="pagination" id="bot-paging-ul">
			
<?php
		$temp_page = $page;
		if ($page == 1) {
			
		 ?>
		 	<li class="page-item disabled" id="bot-paging-li">
<?php	} ?>
				<form method="post" action="<?= base_url() ?>ajaxproductspage/switch_page" id="paging-form">
					<input type="hidden" name="page" value="<?= $temp_page-=1 ?>">
					<input type="submit" value="Prev" class="page-link">
				</form>
			</li>			
					
			

	<?php
		for ($x = $links_start ; $x <= $links_end  ; $x++) { ?>
			<li class="page-item <?php echo ($page == $x)?"active":""?>" id="bot-paging-li">
				<form method="post" action="<?= base_url() ?>ajaxproductspage/switch_page" id="paging-form">
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
				<form method="post" action="<?= base_url() ?>ajaxproductspage/switch_page" id="paging-form">
					<input type="hidden" name="page" value="<?= $temp_page+=1 ?>">
					<input type="submit" value="Next" class="page-link">
				</form>
			</li>
		</ul>
	</nav>
</div>