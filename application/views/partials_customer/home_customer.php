<h2 id="prod-currentpage"><?php echo ($current_category == "") ? 
"All category" : $current_category ?> (<?= $page ?>)</h2>
<nav aria-label="Top pages" id="top-paging">
	<?php $this->load->view("partials_customer/pages_btn.php"); ?>
</nav>
<form id="sort-form" method="post">
	<label id="sprt-lbl">Sorted by:</label>
	<input type="hidden" name="csrf_test_name" id="csrf_token">
	<select class="form-select" aria-label="sort" id="sort-list" name="sort">
		<option value="5" <?= ($sort_by != "most" || $sort_by != "low" || $sort_by != "high") ? "selected" : "" ?>>
				Show All
		</option>
		<option value="most" <?= ($sort_by == "most") ? "selected" : "" ?>>Most popular</option>
		<option value="low" <?= ($sort_by == "low") ? "selected" : "" ?>>Lowest price</option>
		<option value="high" <?= ($sort_by == "high") ? "selected" : "" ?>>Highest price</option>
	</select>
</form>

<?php
foreach ($products as $value) { 
	$img_explode = explode(",", $value['image']);
	$prod_name = (strlen($value['name'])) >= 12 ? substr($value['name'], 0, 12).".." : $value['name'];
	$main_img = "";
	foreach ($img_explode as  $value_image) {
		if (substr($value_image, 0,5) == "main:") {
			$main_img = substr($value_image, 5,strlen($value_image));
		}
	}
?>
<div class="card" id="card">
	<a href="<?= base_url() ?>showproduct/<?= $value['id'] ?>/<?= $value['category_id'] ?>"><img src="<?= base_url()?>uploads/<?= $main_img ?>" class="card-img-top" alt="Product" id="prod-img"></a>
	<div class="card-body">
		<h5 class="card-title" id="prod-name"><?= $prod_name ?></h5>
		<p class="card-text fs-6 fw-bold" id="price">&#8369; <?= $value['price']?> </p>
	</div>
</div>
<?php	}
?>			
<nav aria-label="Paging" id="paging-bottom">
	<?php $this->load->view("partials_customer/pages_btn.php"); ?>
</nav>
<div class="csrf_token" id="<?= $token ?>"></div>