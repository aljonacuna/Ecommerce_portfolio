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
		<link rel="stylesheet" type="text/css" href="<?= asset_url() ?>css/order_history.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script type="text/javascript" src="<?= asset_url() ?>js/bootstrap.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
		<script src="jquery.js"></script>
		<script src="jquery.rateyo.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$(".rateYo").rateYo().on("rateyo.change", function (e, data) {
	            	var rating = data.rating;
		            $(this).parent().find('.score').text('score :'+ $(this).attr('data-rateyo-score'));
		            $(this).parent().find('.result').text('Rating :'+ rating);
		            $("div").parent().find('input[name=rating]').val(rating);
		            $("div").parent().find('.rates').text("You rate this: "+rating);
		            var id = $(this).parent().find('input[name=id]').val();
		            $("div").parent().find("input[name=product_id]").val(id);
       			 });
				 
			});
		</script>
		
	</head>
	<body>
		<?php
			$data['orders'] = $orders;
			$data['user_data'] = $info;
			$this->load->view("partials_customer/navbar_main", $data); 
		?>

		<div class="modal" tabindex="-1" id="review_modal">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
					<h5 class="modal-title">Product Review<span class="mx-5 rates"></span></h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<form action="<?= base_url() ?>review" method="post">
							<label>Any comments</label>
							<textarea name="comment" class="form-control comment"></textarea>
							<input type="hidden" name="rating">
							<input type="hidden" name="product_id">
							<input type="hidden" name="user_id" value="<?= $info['id'] ?>">
							<input type="submit" value="Send review" class="btn btn-primary mt-3 w-25">
						</form>
					</div>
				</div>
			</div>
		</div>
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
			<div id="img-div" class="container-fluid mx-4 p-3">
				<img src="<?= base_url()?>uploads/<?= $main_image ?>" id="prod-img">
				<section id="date-ordered" class="m-3">
					<p><?= $value['created_at'] ?></p>
					<p class="fw-bolder">Total price: <?= $value['total'] ?></p>
				</section>
			</div>

			<div class="container-fluid" id="details">
				<h4><?= $value['name'] ?></h4>
				<p id="description-p"><?= $value['description'] ?></p>
				<div class="rateYo" id= "rating" data-bs-toggle="modal" data-bs-target="#review_modal"
				data-rateyo-rating="4" data-rateyo-num-stars="5"data-rateyo-score="3">
		         </div>
				 <span class='result'>Rating: 0</span>
				<form action="<?= base_url() ?>addtocart" method="post" id="add-cart-form">
					<p id="price">Price: $<?= $value['price'] ?></p>
					<input type="hidden" name="id" value="<?= $value['product_id'] ?>">
					<section id="qty-section">
						<label id="lbl-quantity">Quantity: </label>
						<input type="text" name="quantity" class="form-control" id="quantity"
						 placeholder="Quantity" value="<?= $value['quantity'] ?>">
					</section>
				</form>
			</div>
		</div>
<?php	} ?>
		
	</body>
</html>