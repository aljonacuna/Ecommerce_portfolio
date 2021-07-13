<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<link rel="stylesheet" type="text/css" href="<?= asset_url() ?>css/bootstrap.min.css">
		<script type="text/javascript" src="<?= asset_url() ?>js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="<?= asset_url() ?>css/cart.css">
		<link rel="stylesheet" type="text/css" href="<?= asset_url() ?>css/nav_footer.css">
		<link rel="stylesheet" type="text/css" href="<?= asset_url() ?>css/scrollbar.css">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	</head>
	<body>
		<!-- navbar section -->
		<nav class="navbar navbar-expand-lg navbar-light" id="navbar">
			<div class="container-fluid">
				<a class="navbar-brand" href="#">Dojo Ecommerce</a>
			</div>
		</nav>

		<!-- main content -->
		<div class="container-fluid" id="payment-div">
			<h2 class="text-center">Dojo Ecommerce Payment</h2>
			<div class="container-fluid" id="content">
				<div class='alert alert-<?= ($success != "") ? "success" : "warning" ?> <?= ($success != "") ? "d-inline" : "d-none" ?> alert-dismissible fade show' role="alert" id="msg-div">
					<div class="error" id="error">
						<?= ($success != "") ? $success : "" ?>
					</div>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> 
				</div>
				
				<form action="<?= base_url() ?>handlePayment" method="post" class="form-validation" id="form-validation">
					<div class="form-group ">
						<label for="card">Card</label>
						<div id="card_number" class="field form-control">
							<!-- <input type="text" name="card" class="form-control" placeholder="Card" id="card"> -->
						</div>
						
					</div>
					<div class="form-group">
						<label for="security">CVC Code</label>
						<div id="card_cvc" class="field form-control">
							<!-- <input type="text" name="security" class="form-control" placeholder="CVC" id="cvc"> -->
						</div>
						
					</div>
					<div class="form-group">
						<label for="expiration">Expiration date</label>
						<div id="card_expiry" class="field form-control"></div>
						<!-- 	<input type="text" name="month" class="form-control" placeholder="(mm)" id="month">
						<label id="divider-p">/</label>
						<input type="text" name="year" class="form-control" placeholder="(yy)" id="year"> -->
					</div>
					<input type="submit" value="Pay (&#8369; <?= $tot_amount ?>)" class="btn mt-5" id="payment-btn">
					<p id="line-left"></p><p class="text-center m-3" id="or-lbl">OR</p><p id="line-right"></p>
					<a href="<?= base_url() ?>home" class="btn btn-primary w-100" id="btn-continue">Continue Shopping</a>
				</form>
			</div>
		</div>
		<script src="https://js.stripe.com/v3/"></script>
		<script type="text/javascript" src="<?= asset_url() ?>js/payment.js"></script>

		<!-- footer section -->
		<?php $this->load->view("partials_customer/footer_customer"); ?>
	</body>
</html>