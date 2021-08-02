<!DOCTYPE html>
	<html>
	<head>
		<title></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		
		<link rel="stylesheet" type="text/css" href="<?= asset_url() ?>css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="<?= asset_url() ?>css/admin_nav.css">
		<link rel="stylesheet" type="text/css" href="<?= asset_url() ?>css/showorder.css">
		<link rel="stylesheet" type="text/css" href="<?= asset_url() ?>css/scrollbar.css">
		<script type="text/javascript" src="<?= asset_url() ?>js/bootstrap.min.js"></script>
		<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> -->
	</head>
	<body>
		<div class="row min-vh-100 flex-column flex-md-row">
		
			<?php $this->load->view("admin/navbar", $active); ?>
			<!-- shipping and billing info section -->
			<div class="col px-0 flex-grow-1">
				<div class="container-fluid" id="shipping-billing-info">
					<h5>Transaction ID : <?= $transaction_id ?></h5>
					<label id="lbl-shipping">Customer shipping info: </label>
					<section id="name-section">
						<label>Name:</label><p><?= $customer_info['fname']." ".$customer_info['lname'] ?></p>
					</section>
					<section id="address-section">
						<label>Address:</label><p><?= $shipping['street'] ?></p>
					</section>
					<section id="city-section">
						<label>Town:</label><p><?= $shipping['town'] ?></p>
					</section>
					<section id="town-section">
						<label>City:</label><p><?= $shipping['city'] ?></p>
					</section>
					<section id="zip-section">
						<label>Zipcode:</label><p><?= $shipping['zip'] ?></p>
					</section>
					<label id="lbl-billing">Customer billing info: </label>
					<section id="name-section">
						<label>Name:</label><p><?= $customer_info['fname']." ".$customer_info['lname'] ?></p>
					</section>
					<section id="address-section">
						<label>Address:</label><p><?= $billing['street'] ?></p>
					</section>
					<section id="city-section">
						<label>City:</label><p><?= $billing['town'] ?></p>
					</section>
					<section id="town-section">
						<label>Name:</label><p><?= $billing['city'] ?></p>
					</section>
					<section id="zip-section">
						<label>Name:</label><p><?= $billing['zip'] ?></p>
					</section>
				</div>

				<div class="container-fluid" id="order-details">

				<!-- list of orders -->
					<div class="container-fluid" id="order-section">
						<table class="table table-hover">
							<tr>
								<th scope="col">Order ID</th>
								<th scope="col">Item</th>
								<th scope="col">Price</th>
								<th scope="col">Quantity</th>
								<th scope="col">Total</th>
						    </tr>
				    <?php
				    	$total = 0;
				    	$shipping_fee = 10;
				    	foreach ($orders as $value) {		    		
				    		$total+=$value['total'];
				    		?>
				    		<tr>
								<th><?= $value['id'] ?></a></th>
								<td><?= $value['name'] ?></td>
								<td><?= $value['price'] ?></td>
								<td><?= $value['quantity'] ?></td>
								<td>$<?= $value['total'] ?> </td>
							</tr>
				<?php 	}
				    ?>
						
							
						</table>
					</div>
					<div class="container-fluid" id="status-subtotal">
									<?php
										$status = "";
										$alert = "";
										if ($status_id == 0) {
											$status =  "Orders in process";
											$alert = "info";
										}
										else if ($status_id == 1) {
											$status = "Shipped";
											$alert = "success";
										}

										else {
											$status = "Canceled";
											$alert = "danger";
										}
										  ?>
						<section class="alert alert-<?= $alert ?>" role="alert" id="order-status">
							<p>Status: <?= $status ?></p>
						</section>
						<section class="container-fluid" id="order-subtotal">
							<p id="total-fee-p">Sub total: $<?= $total ?></p>
							<p id="total-fee-p">Shipping: $<?= $shipping_fee ?></p>
							<p id="total-fee-p">Total price: $<?= $total + $shipping_fee ?></p>
						</section>
					</div>
				</div>
			</div>
		</div>	
	</body>
</html>