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
		<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	</head>
	<body>
		<!-- navbar section -->
		<?php
			if ($is_loggedin != "no") {
				$user_info['info'] = $is_loggedin;
				$user_info['name'] = $name;
				$this->load->view("partials_customer/navbar_main", $user_info);  
			}
			else{
				$this->load->view("partials_customer/navbar_guest");  
			}
		
		?>

		<!-- breadcrumb -->
		<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb" id="breadcrumb">
			<ol class="breadcrumb px-2">
				<li class="breadcrumb-item"><a class="text-warning" id="home-link" 
					href="<?= base_url() ?>home" id="continue-shopping-link">Home</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="#">Cart</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="#shipping-billing-info">Shipping and Billing address</a></li>
			</ol>
		</nav>

		<!-- edit modal section -->
		<div class="modal fade" id="billing_modal" tabindex="-1" 
		aria-labelledby="billing_modal" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Edit billing address</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<form action="edit_billing/<?= $billing_address['role_id'] ?>" method="post">
							<label>Street: </label>
							<input type="text" name="street" placeholder="Street" class="form-control">
							<label>City: </label>
							<input type="text" name="city" placeholder="City" class="form-control">
							<label>Town: </label>
							<input type="text" name="town" placeholder="Town" class="form-control">
							<label>Zip: </label>
							<input type="text" name="zip" placeholder="Zip" class="form-control">
							<input type="submit" value="Save" class="btn btn-primary w-75 mx-5 mt-5"> 
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- end of modal section -->

		<!-- list of order section -->
		<div class="container-fluid" id="main">
			<?php
				if ($orders == "" || $orders == "null" || sizeof($orders) == 0) { ?>
					<div class="container-fluid" id="empty-cart">
						<div id="empty-cart-display">
							<img src="<?= asset_url() ?>img/empty-cart.png" id="empty-cart-img">
							<p id="empty-cart-lbl">Your shopping cart is empty</p>
							<div id="shopping-link-div">
							<a href="<?= base_url() ?>home" id="continue-shopping-link" class="btn btn-primary">
							Continue shopping</a>
							</div>
						</div>
					</div>
			<?php }
			else { 
				$data['orders'] = $orders;
				$this->load->view("partials_customer/cart_order", $data);  
			}
			?>

			<!-- shipping and billing information -->
			<div class="container-fluid" id="shipping-billing-info">
				<ul class="nav nav-tabs nav-fill bg-light" id="myTab" role="tablist">
					<li class="nav-item" role="presentation">
						<button class="nav-link active" id="shipping-tab" data-bs-toggle="tab" data-bs-target="#shipping" type="button" role="tab" aria-controls="shipping" aria-selected="true">Shipping</button>
					</li>
					<li class="nav-item" role="presentation">
						<button class="nav-link"id="billing-tab" data-bs-toggle="tab" data-bs-target="#billing" type="button" role="tab" aria-controls="billing" aria-selected="false">Billing</button>
					</li>
				</ul>
				<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade show active" id="shipping" role="tabpanel" aria-labelledby="shipping-tab">
						<h3>Shipping Information</h3>
						<form>
							<label for="fname">First Name</label>
							<input type="text" name="fname" class="form-control" id="fname" placeholder="First Name" 
							value="<?= $user_info['fname'] ?>" disabled="true"> 
							<label for="lname">Last Name</label>
							<input type="text" name="lname" class="form-control" id="lname" placeholder="Last Name"
							value="<?= $user_info['lname'] ?>" disabled="true">
							<label for="shipping_address">Address</label>
							<input type="text" name="address" class="form-control" id="address" placeholder="Address"
							value="<?= $shipping_address['street'] ?>" disabled="true">
							<label for="city">City</label>
							<input type="text" name="city" class="form-control" id="city" placeholder="City"
							value="<?= $shipping_address['city'] ?>" disabled="true">
							<label for="town">Town</label>
							<input type="text" name="town" class="form-control" id="town" placeholder="Town"
							value="<?= $shipping_address['town'] ?>" disabled="true">
							<label for="zipcode">Zipcode</label>
							<input type="text" name="zip" class="form-control" id="zip" placeholder="Zipcode"
							value="<?= $shipping_address['zip'] ?>" disabled="true">
						</form>
					</div>
					<div class="tab-pane fade" id="billing" role="tabpanel" aria-labelledby="billing-tab">
						<h3>Billing Information</h3>
						<form>
							<p>
								<a class="fs-6 link-primary text-decoration-none" 
								id="edit-billing" data-bs-toggle="modal" 
								data-bs-target="#billing_modal"> <i class="fa fa-pencil-square-o fs-6 " ></i>Edit billing address</a>
							</p>
							<label for="fname">First Name</label>
							<input type="text" name="fname" class="form-control" id="billing-fname" placeholder="First Name" value="<?= $user_info['fname'] ?>" disabled="true">
							<label for="lname">Last Name</label>
							<input type="text" name="lname" class="form-control" id="billing-lname" placeholder="Last Name" value="<?= $user_info['lname'] ?>" disabled="true">
							<label for="address">Address</label>
							<input type="text" name="address" class="form-control" id="billing-address" placeholder="Address" value="<?= $billing_address['street'] ?>" disabled="true">
							<label for="city">City</label>
							<input type="text" name="city" class="form-control" id="billing-city" placeholder="City"
							value="<?= $billing_address['city'] ?>" disabled="true">
							<label for="town">Town</label>
							<input type="text" name="town" class="form-control" id="billing-town" placeholder="Town"
							value="<?= $billing_address['town'] ?>" disabled="true">
							<label for="zipcode">Zipcode</label>
							<input type="text" name="zip" class="form-control" id="billing-zip" placeholder="Zipcode"
							value="<?= $billing_address['zip'] ?>" disabled="true">
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- footer section -->
		<?php $this->load->view("partials_customer/footer_customer"); ?>
	</body>
</html>