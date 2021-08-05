<!DOCTYPE html>
	<html>
	<head>
		<title></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<link rel="stylesheet" type="text/css" href="<?= asset_url() ?>css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="<?= asset_url() ?>css/show_prod.css">
		<link rel="stylesheet" type="text/css" href="<?= asset_url() ?>css/nav_footer.css">
		<link rel="stylesheet" type="text/css" href="<?= asset_url() ?>css/scrollbar.css">
		<link rel="stylesheet" type="text/css" href="<?= asset_url() ?>css/slider.css">
		<link rel="stylesheet" type="text/css" href="<?= asset_url() ?>css/lightslider.css">
		<link href="<?= asset_url() ?>fontawesome/css/all.css" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
		<script type="text/javascript" src="<?= asset_url() ?>js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?= asset_url() ?>js/JQuery3.3.1.js"></script>
		<script type="text/javascript" src="<?= asset_url() ?>js/lightslider.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
		<script src="jquery.js"></script>
		<script src="jquery.rateyo.js"></script>
	</head>
	<body>	
		<!-- navbar section -->
		<div id=nav>
			
		</div>
		<!-- breadcrumb -->
		<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb" id="breadcrumb">
			<ol class="breadcrumb px-2">
				<li class="breadcrumb-item"><a class="text-warning" id="home-link" 
					href="<?= base_url() ?>home" id="continue-shopping-link">Home</a></li>
				<li class="breadcrumb-item active" aria-current="page"><label class="text-primary"><?= $product['name'] ?></label></li>
			</ol>
		</nav>
		
		<div id="main">
			<!-- product section -->
			<div class="container-fluid" id="product-section">
	    		<ul id="gallery">
			        <li data-thumb="<?= base_url()?>uploads/<?= $main_image ?>" id="list-img">
			            <img src="<?= base_url()?>uploads/<?= $main_image ?>" align="Product" id="display-img"/>
			        </li>
		<?php 	foreach ($sub_images as $key => $value) { ?>
					<li data-thumb="<?= base_url()?>uploads/<?= $value ?>" id="list-img">
			            <img src="<?= base_url()?>uploads/<?= $value ?>" align="Product" id="display-img"/>
			        </li>
		<?php	} ?>
			       
	      		</ul>
			</div>
			
			<!-- Toast message -->
			<div class="toast align-items-center position-absolute" role="alert" aria-live="assertive" aria-atomic="true"
			id="toast-msg">
				<div class="d-flex">
					<div class="toast-body">
						<p class="fw-bolder" id="text-toast">Add to cart successfully</p>
						<i class="fa fa-check-circle" id="icon-success" aria-hidden="true"></i>
					</div>
				</div>
			</div>
			
			<!-- product description section desc max length should be 300 character -->
			<div class="container-fluid" id="prod-desc-section">
				<h4><?= $product['name'] ?></h4>
				<p id="description-p"><?= $product['desc'] ?></p>
				<span class="fw-bolder heading">Product Rating</span>
				<div id="rateYo" data-rateyo-num-stars="5"></div>
				<p><span id="reviews-text">
					<?= round($avg_reviews['rating']) ?> average based on <?= $avg_reviews['total'] ?>
				</span> reviews.</p>
				<form action="<?= base_url() ?>addtocart" method="post" id="add-cart-form">
					<p id="price">Price: &#8369;<span id="price-text"><?= $product['price'] ?></span></p>
					<input type="hidden" name="csrf_test_name" id="csrf_token">
					<input type="hidden" name="id" value="<?= $product['id'] ?>" id="prod_id">
					<input type="hidden" name="price_prod" id="price_prod" value="<?= $product['price'] ?>">
					<input type="hidden" name="category_id" value="<?= $product['category_id'] ?>">
					<input type="hidden" name="prod_name" value="<?= $product['name'] ?>">
					<input type="hidden" name="prod_img" value="<?= $main_image ?>" name="">
					<input type="hidden" name="qty" value="<?= $product['qty'] ?>" id="qty">
					<section id="qty-section">
						<label id="lbl-quantity" class="fw-bolder">Quantity: </label>
						<div id="increment-btn" class="btn btn-primary" data="qty-btn">+</div>
						<input type="text" name="quantity" class="form-control" id="quantity"
						 placeholder="Quantity" value="1">
						<div id="decrement-btn" class="btn btn-primary" data="qty-btn">-</div>
						<input type="submit" value="Add to cart" class="btn btn-success" id="add-to-cart-btn">
						<p id="stock-count">Stocks: <?= $product['qty'] ?> piece/s</p>
					</section>
				</form>
			</div>



			<!-- similar item -->
			<h4 id="similar-items-lbl">Similar items</h4>
			<div class="container-fluid" id="slider-container">

			<!--slider------------------->
				<ul id="autoWidth" class="cs-hidden">
	<?php 
	foreach ($similar_products as $key => $value) {
		$images = explode(",", $value['image']);
		foreach ($images as $value_image) {
			if (substr($value_image, 0, 5) == "main:") { 
				$main_img = substr($value_image, 5,strlen($value_image));
				?>
					<li class="item-a">
					  	<!--slider-box-->
						<div class="box">
							<!--model-->
							<a href="<?= base_url() ?>showproduct/<?= $value['id'] ?>/<?= $value['category_id'] ?>"
								id="similar-link">
								<img src="<?= base_url() ?>/uploads/<?= $main_img ?>" class="model">
							<!--details-->
							</a>
							<div class="details">
								<p><?= $value['name'] ?></p>
								<p>&#8369; <?= $value['price'] ?></p>
							</div>
						</div>
					</li>
			<?php		}
					}
				}
			?>
				</ul>
			</div>

			<div class="container-fluid bg-light mt-4" id="customer-review-container">
				<section class="container-fluid">
					<p class="fs-5 fw-bolder">Customers Review</p>
				</section>
		<?php
			foreach ($reviews as $value) { ?>
				<section id="customer-review" class="container-fluid mx-5">
					<p class=" fw-bolder"><?= $value['name'] ?>
					<span class="mx-5" id="user_rates">Rate <?= $value['rating'] ?></span></p>
				
					<p id="date"><?= $value['created_at'] ?></p>
					<p class="d-inline-block"><?= $value['comment'] ?></p>
				</section>
	<?php	}
		?>
				
			</div>
		</div>
		<!-- footer section -->
		<?php $this->load->view("partials_customer/footer_customer"); ?>
		<script src="<?= asset_url() ?>js/script.js" type="text/javascript"></script>
		<script type="text/javascript" src="<?= asset_url() ?>js/show_prod.js"></script>
	</body>
</html>							