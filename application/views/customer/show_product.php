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
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
		<script type="text/javascript" src="<?= asset_url() ?>js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?= asset_url() ?>js/JQuery3.3.1.js"></script>
		<script type="text/javascript" src="<?= asset_url() ?>js/lightslider.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
<!-- 		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> -->
		<script src="jquery.js"></script>
		<script src="jquery.rateyo.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$("#rateYo").rateYo({
			   		rating: <?= round($avg_reviews['rating'])?>
			  });

			});
			//for increasing and decreasing the quantity
			var count = 0;
			function increase_price() {
				var qty = document.getElementById("quantity").value = count+=1;
				tot_price();	
			}
			function decrease_price() {
				var qty = document.getElementById("quantity").value;
				count = (qty > 1) ?count-=1 : 1;
				tot_price();
			}
			function tot_price() {
				var qty = document.getElementById("quantity").value = count;
				var tot = <?= $product['price'] ?> * qty;
				document.getElementById("price").innerHTML = "Price: $"+tot;		
			}
		</script>
	</head>
	<body>	
		<!-- navbar section -->
		<?php
			if ($is_loggedin != "no") {
				$user_info['info'] = $is_loggedin;
				$this->load->view("partials_customer/navbar_main",$user_info);  
			}
			else{
				$this->load->view("partials_customer/navbar_guest");  
			}
		
		?>
		
		<!-- product review section -->
		<div class="container-fluid" id="review-div">

		</div>

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
		<!-- <div class="container-fluid" id="product-section">
			<a href="<?= base_url() ?>home" id="back-btn" class="fa fa-arrow-left"></a>
			<div class="card" style="width: 18rem;" id="card">
				<div class="card-body">
					<img src="<?= base_url()?>uploads/<?= $main_image ?>" align="Product" id="display-img">
				</div>
				<div class="card-footer">
					<?php
						foreach ($sub_images as  $value) { ?>
							<img src="<?= base_url()?>uploads/<?= $value ?>" align="Product" id="other-prod-img">
			<?php		}
					?>
				</div>
			</div>
		</div> -->
		
		<!-- product description section desc max length should be 300 character -->
		<div class="container-fluid" id="prod-desc-section">
			<h4><?= $product['name'] ?></h4>
			<p id="description-p"><?= $product['desc'] ?></p>
			<span class="heading">Product Rating</span>
			<div id="rateYo" data-rateyo-num-stars="5"></div>
			<p><?= round($avg_reviews['rating']) ?> average based on <?= $avg_reviews['total'] ?> reviews.</p>
			<form action="<?= base_url() ?>addtocart" method="post" id="add-cart-form">
				<p id="price">Price: &#8369;<?= $product['price'] ?></p>
				<input type="hidden" name="id" value="<?= $product['id'] ?>">
				<input type="hidden" name="category_id" value="<?= $product['category_id'] ?>">
				<input type="hidden" name="prod_name" value="<?= $product['name'] ?>">
				<section id="qty-section">
					<label id="lbl-quantity">Quantity: </label>
					<div id="increment-btn" class="btn btn-primary" onclick="increase_price()">+</div>
					<input type="text" name="quantity" class="form-control" id="quantity"
					 placeholder="Quantity" value="1">
					<div id="decrement-btn" class="btn btn-primary" onclick="decrease_price()">-</div>
					<input type="submit" value="Add to cart" class="btn btn-success" id="add-to-cart-btn">
				</section>
			</form>
		</div>

		<div>
			<form>
		
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
		<!-- footer section -->
		<?php $this->load->view("partials_customer/footer_customer"); ?>
		<script src="<?= asset_url() ?>js/script.js" type="text/javascript"></script>
	</body>
</html>							