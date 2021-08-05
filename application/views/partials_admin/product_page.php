<div class="modal" tabindex="-1" id="del-confirmation">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Delete</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<p class="text-center">Are you sure you want to delete this?</p>
				<form method="post" id="del-form" action="<?= base_url() ?>ajaxproductspage/delete_product">
					<input type="hidden" name="csrf_test_name" value="<?= $token ?>">
					<input type="hidden" name="prod_id" id="prod_id">
					<input type="hidden" name="current_page" value="<?= $page ?>">
					<div id="buttons" class="text-end">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="close-btn">Close</button>
						<input type="submit" value="Delete" class="btn btn-danger" id="confirm-del-btn">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid" id="product-section">
	<table class="table table-hover">
		<tr id="tr-product">
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
			<td><a href="<?= base_url() ?>admins/edit_product/<?= $value['id'] ?>" class="fas fa-edit fs-5 ms-4 text-reset text-decoration-none"></a>
				<a href="" class="fa fa-trash fs-5 ms-3 text-reset text-decoration-none del-btn" data-bs-toggle="modal"
				 data-bs-target="#del-confirmation" id="<?= $value['id'] ?>"></a></td>
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
					<input type="hidden" name="search_paging" value="<?= $search ?>">
					<input type="hidden" name="page" value="<?= $temp_page-=1 ?>">
					<input type="hidden" name="csrf_test_name" value="<?= $token ?>">
					<input type="submit" value="Prev" class="page-link">
				</form>
			</li>			
					
			

	<?php
		for ($x = $links_start ; $x <= $links_end  ; $x++) { ?>
			<li class="page-item <?php echo ($page == $x)?"active":""?>" id="bot-paging-li">
				<form method="post" action="<?= base_url() ?>ajaxproductspage/switch_page" id="paging-form">
					<input type="hidden" name="search_paging" value="<?= $search ?>">
					<input type="hidden" name="page" value="<?= $x ?>">
					<input type="hidden" name="csrf_test_name" value="<?= $token ?>">
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
					<input type="hidden" name="search_paging" value="<?= $search ?>">
					<input type="hidden" name="page" value="<?= $temp_page+=1 ?>">
					<input type="hidden" name="csrf_test_name" value="<?= $token ?>">
					<input type="submit" value="Next" class="page-link">
				</form>
			</li>
		</ul>
	</nav>
	<div class="csrf_token" id="<?= $token ?>"></div>
</div>