<?php
	$main_image = "";
	foreach ($order_history as $key => $value) { 
		$img_explode = explode(",", $value['image']);
		foreach ($img_explode as $value_images) {
			if (substr($value_images, 0,5) == "main:") {
				$main_image = substr($value_images, 5,strlen($value_images));
			}
		}	
		?>
		<div class="container-fluid mt-2" id="main-div">
			<div id="img-div" class="container-fluid">
				<img src="<?= base_url()?>uploads/<?= $main_image ?>" id="prod-img">
				<section id="date-ordered" class="container-fluid">
					<p id=date><?= $value['created_at'] ?></p>
					<p class="fw-bolder" id="tot-price">Total price: <?= $value['total'] ?></p>
					<?php $status = ""; ?>
					<p class="fw-bolder" id="status">Status: <span class="text-<?php
					if ($value['status_id'] == 0) {
						echo 'primary';
						$status = 'Order in process';
					}
					else if ($value['status_id'] == 1) {
						echo 'success';
						$status = 'Shipped'; 
					}
					else {
						echo 'danger';
						$status = "Canceled"; 

					}?> ">
				<?= $status; ?></span></p>
				</section>
			</div>

			<div class="container-fluid" id="details">
				<h4><?= $value['name'] ?></h4>
				<p id="description-p"><?= $value['description'] ?></p>
		<?php 
			if($value['status_id'] == 1) { ?>
				<div class="rateYo" id= "rating" data-bs-toggle="modal" data-bs-target="#review_modal"
				data-rateyo-rating="4" data-rateyo-num-stars="5"data-rateyo-score="3">
		         </div>
	<?php  	} ?>
				 <span class='result'>Rating: 0</span>
				<form action="<?= base_url() ?>addtocart" method="post" id="add-cart-form">
					<p id="price">Price: &#8369; <?= $value['price'] ?></p>
					<input type="hidden" name="csrf_test_name" value="<?= $token ?>">
					<input type="hidden" name="id" value="<?= $value['product_id'] ?>">
					<section id="qty-section">
						<label id="lbl-quantity">Quantity: </label>
						<input type="text" name="quantity" class="form-control" id="quantity"
						 placeholder="Quantity" value="<?= $value['quantity'] ?>">
					</section>
				</form>
			</div>
			<div class="csrf_token" id="<?= $token ?>"></div>
		</div>
<?php	} ?>