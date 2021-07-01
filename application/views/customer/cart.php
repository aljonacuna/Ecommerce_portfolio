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
		<script type="text/javascript">
			$(document).ready(function() {
			// 	$(document).on("change", "#check-same-as-shipping", function() {
			// 		var fname = $("#fname").val();
			// 		$("#billing-fname").val(fname);
			// 		var lname = $("#lname").val();
			// 		$("#billing-lname").val(lname);
			// 		var street = $("#address").val();
			// 		$("#billing-address").val(street);
			// 		var city = $("#city").val();
			// 		$("#billing-city").val(city);
			// 		var town = $("#town").val();
			// 		$("#billing-town").val(town);
			// 		var zip = $("#zip").val();
			// 		$("#billing-zip").val(zip);
			// 	});
			});
		</script>
	</head>
	<body>
		<!-- navbar section -->
		<nav class="navbar navbar-expand-lg navbar-light" id="navbar">
			<div class="container-fluid">
				<a class="navbar-brand" href="#">Logo</a>
			</div>
		</nav>


		<!-- list of order section -->
		<div class="container-fluid" id="main-div">
			<div class="container-fluid" id="order-section">
				<table class="table table-hover">
					<tr>
						<th>Item</th>
						<th>Price</th>
						<th>Quantity</th>
						<th>Actions</th>
						<th>Total</th>
				    </tr>
		<?php  
			$total_price = 0 ;
		if($orders != "") {
			foreach ($orders as $key => $value) { 
				if ($value['user_id'] == $user_info['id']) { ?>
					<tr>
						<th><?= $value['prodname'] ?></th>
						<td><?= $value['price'] ?></td>
						<td><?= $value['quantity'] ?></td>
						<td><a href="" class="fa fa-pencil fs-5 ms-2 text-reset text-decoration-none"></a>
							<a href="<?= base_url() ?>cancel_cart/<?= $key ?>" class="fa fa-trash fs-5 ms-2 text-reset text-decoration-none"></a></td>
						<td>$<?= $value['tot_price'] ?></td>
					</tr>

		<?php   	$total_price+=$value['tot_price'];
				}
				?>
				
	<?php		
			}
		}	
		?>	    
				
				</table>
			</div>
			<section id="total-price-section">
				<article id="total-price-article">
					<p id="total-price">Total price: $<?= $total_price ?></p>
				</article>
				<article id="continue-shopping-article">
					<a href="<?= base_url() ?>home" id="continue-shopping-link" class="btn btn-primary">Continue shopping</a>
				</article>
			</section>

		</div>


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
						value="<?= $user_info['fname'] ?>"> 
						<label for="lname">Last Name</label>
						<input type="text" name="lname" class="form-control" id="lname" placeholder="Last Name"
						value="<?= $user_info['lname'] ?>">
						<label for="shipping_address">Address</label>
						<input type="text" name="address" class="form-control" id="address" placeholder="Address"
						value="<?= $shipping_address['street'] ?>">
						<label for="city">City</label>
						<input type="text" name="city" class="form-control" id="city" placeholder="City"
						value="<?= $shipping_address['city'] ?>">
						<label for="town">Town</label>
						<input type="text" name="town" class="form-control" id="town" placeholder="Town"
						value="<?= $shipping_address['town'] ?>">
						<label for="zipcode">Zipcode</label>
						<input type="text" name="zip" class="form-control" id="zip" placeholder="Zipcode"
						value="<?= $shipping_address['zip'] ?>">
					</form>
				</div>
				<div class="tab-pane fade" id="billing" role="tabpanel" aria-labelledby="billing-tab">
					<h3>Billing Information</h3>
					<form action="<?= base_url() ?>checkout" method="post">
						<p>
							<label>
								<input class="form-check-input" type="checkbox" name="same_as_shipping" id="check-same-as-shipping" onclick="same_as_shipping()"> Same as shipping
							</label>
						</p>
						<label for="fname">First Name</label>
						<input type="text" name="fname" class="form-control" id="billing-fname" placeholder="First Name" value="<?= $user_info['fname'] ?>">
						<label for="lname">Last Name</label>
						<input type="text" name="lname" class="form-control" id="billing-lname" placeholder="Last Name" value="<?= $user_info['lname'] ?>">
						<label for="address">Address</label>
						<input type="text" name="address" class="form-control" id="billing-address" placeholder="Address" value="<?= $billing_address['street'] ?>">
						<label for="city">City</label>
						<input type="text" name="city" class="form-control" id="billing-city" placeholder="City"
						value="<?= $billing_address['city'] ?>">
						<label for="town">Town</label>
						<input type="text" name="town" class="form-control" id="billing-town" placeholder="Town"
						value="<?= $billing_address['town'] ?>">
						<label for="zipcode">Zipcode</label>
						<input type="text" name="zip" class="form-control" id="billing-zip" placeholder="Zipcode"
						value="<?= $billing_address['zip'] ?>">
						<label for="card">Card</label>
						<input type="text" name="card" class="form-control" placeholder="Card">
						<label for="security">Security Code</label>
						<input type="text" name="security" class="form-control" placeholder="Security Code">
						<section>
							<label for="expiration">Expiration date</label>
							<input type="text" name="month" class="form-control" placeholder="(mm)" id="month">
							<label id="divider-p">/</label>
							<input type="text" name="year" class="form-control" placeholder="(yy)" id="year">
						</section>
						<input type="submit" value="Pay now" id="paynow-btn" class="btn btn-success">
					</form>
				</div>
			</div>
		</div>


		<!-- footer section -->
		<?php $this->load->view("partials_customer/footer_customer"); ?>
	</body>
</html>