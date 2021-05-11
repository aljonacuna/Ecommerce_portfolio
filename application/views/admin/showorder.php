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
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	</head>
	<body>
		
		<?php $this->load->view("admin/navbar"); ?>
		<!-- shipping and billing info section -->
		<div class="container-fluid" id="shipping-billing-info">
			<h5>Order ID : <?= $customer_info['id'] ?></h5>
			<label id="lbl-shipping">Customer shipping info: </label>
			<section id="name-section">
				<label>Name:</label><p><?= $customer_info['name'] ?></p>
			</section>
			<section id="address-section">
				<label>Address:</label><p><?= $customer_info['street'] ?></p>
			</section>
			<section id="city-section">
				<label>Town:</label><p><?= $customer_info['town'] ?></p>
			</section>
			<section id="town-section">
				<label>City:</label><p><?= $customer_info['city'] ?></p>
			</section>
			<section id="zip-section">
				<label>Zipcode:</label><p><?= $customer_info['zip'] ?></p>
			</section>
			<label id="lbl-billing">Customer billing info: </label>
			<section id="name-section">
				<label>Name:</label><p><?= $customer_info['name'] ?></p>
			</section>
			<section id="address-section">
				<label>Address:</label><p><?= $customer_info['street'] ?></p>
			</section>
			<section id="city-section">
				<label>City:</label><p><?= $customer_info['town'] ?></p>
			</section>
			<section id="town-section">
				<label>Name:</label><p><?= $customer_info['city'] ?></p>
			</section>
			<section id="zip-section">
				<label>Name:</label><p><?= $customer_info['zip'] ?></p>
			</section>
		</div>

		<div class="container-fluid" id="order-details">

		<!-- list of orders -->
			<div class="container-fluid" id="order-section">
				<table class="table table-hover">
					<tr>
						<th scope="col">ID</th>
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
						<th><a href="showorder.html"><?= $value['id'] ?></a></th>
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
				<section class="alert alert-success" role="alert" id="order-status">
					<p>Status: <?php 
								if ($customer_info['status_id'] == 0)
									echo "Orders in process";
								else if ($customer_info['status_id'] == 1)
									echo "Shipped";
								else
									echo "Canceled";
								  ?></p>
				</section>
				<section class="container-fluid" id="order-subtotal">
					<p id="total-fee-p">Sub total: $<?= $total ?></p>
					<p id="total-fee-p">Shipping: $<?= $shipping_fee ?></p>
					<p id="total-fee-p">Total price: $<?= $total + $shipping_fee ?></p>
				</section>
			</div>
		</div>
	</body>
</html>