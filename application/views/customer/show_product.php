<!DOCTYPE html>
	<?php
	function image_similar($image){
		$img_explode = explode(",", $image);
			$main_img = "";
			foreach ($img_explode as  $value_image) {
				if (substr($value_image, 0,5) == "main:") {
					$main_img = substr($value_image, 5,strlen($value_image));
				}
			}
			return $main_img;
		}
	?>
	<html>
	<head>
		<title></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<link rel="stylesheet" type="text/css" href="<?= asset_url() ?>css/bootstrap.min.css">
		<script type="text/javascript" src="<?= asset_url() ?>js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="<?= asset_url() ?>css/show_prod.css">
		<link rel="stylesheet" type="text/css" href="<?= asset_url() ?>css/nav_footer.css">
		<link rel="stylesheet" type="text/css" href="<?= asset_url() ?>css/scrollbar.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
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
			$data['orders'] = $orders;
			$data['user_data'] = $info;
			$this->load->view("partials_customer/navbar_main", $data); 
		?>
		
		<!-- product review section -->
		<div class="container-fluid" id="review-div">

		</div>

		<!-- product section -->
		<div class="container-fluid" id="product-section">
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
		</div>
		
		<!-- product description section desc max length should be 300 character -->
		<div class="container-fluid" id="prod-desc-section">
			<h4><?= $product['name'] ?></h4>
			<p id="description-p"><?= $product['desc'] ?></p>
			<span class="heading">Product Rating</span>
			<div id="rateYo" data-rateyo-num-stars="5"></div>
			<p><?= round($avg_reviews['rating']) ?> average based on <?= $avg_reviews['total'] ?> reviews.</p>
			<form action="<?= base_url() ?>addtocart" method="post" id="add-cart-form">
				<p id="price">Price: $<?= $product['price'] ?></p>
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
		<!-- similar items -->

		<div class="container-fluid text-center" id="similar-items">
			<h4>Similar Items</h4>
			<div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
	            <div class="carousel-inner">
	                <div class="carousel-item active" data-bs-interval="10000">
	        <?php  
            	foreach ($similar_products as $key => $value) { 
            		if ($key <= 3) { 
            			$image = image_similar($value['image']);
            			?>
            			
            			<div class="card d-inline-block" id="card-similar-items" >
							<img src="<?= base_url()?>uploads/<?= $image ?>" alt="Similar Product" id="similar-prod-img">
							<div class="card-footer">
								<h5 id="price-similar-items"><?= $value['name'] ?></h5>
								<p id="price-similar-items">$<?= $value['price'] ?></p>
							</div>
						</div>
          <?php   	}
            		

       		}    ?>
	                </div>
	               <?php 
            	if (count($similar_products) > 4) { ?>
            		<div class="carousel-item" data-bs-interval="20000">
		         <?php  
		        	foreach ($similar_products as $key => $value) { 
		        		if ($key >= 4) { 
		        			$image = image_similar($value['image']);
		        			?>
		        			
		        			<div class="card d-inline-block" id="card-similar-items">
								<img src="<?= base_url()?>uploads/<?= $image ?>" alt="Similar Product" id="similar-prod-img">
								<div class="card-footer">
									<h5 id="price-similar-items"><?= $value['name'] ?></h5>
									<p id="price-similar-items">$<?= $value['price'] ?></p>
								</div>
							</div>
		      <?php   	}          		
		   			}    ?>
		           	</div>
        <?php    }
            ?>
         <?php 
            	if (count($similar_products) > 8) { ?>
            		<div class="carousel-item">
		         <?php  
		        	foreach ($similar_products as $key => $value) { 
		        		if ($key >= 8) { 
		        			$image = image_similar($value['image']);
		        			?>
		        			
		        			<div class="card d-inline-block" id="card-similar-items">
								<img src="<?= base_url()?>uploads/<?= $image ?>" alt="Similar Product" id="similar-prod-img">
								<div class="card-footer">
									<h5 id="price-similar-items"><?= $value['name'] ?></h5>
									<p id="price-similar-items">$<?= $value['price'] ?></p>
								</div>
							</div>
		      <?php   	}          		
		   			}    ?>
		           	</div>
        <?php    }
            ?>
	              
	            </div>
	            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
	            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
	            <span class="visually-hidden">Previous</span>
	            </button>
	            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
	            <span class="carousel-control-next-icon" aria-hidden="true"></span>
	            <span class="visually-hidden">Next</span>
	            </button>
	        </div>
		</div>

		<div class="container-fluid bg-light w-75 mt-4">
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
	</body>
</html>							