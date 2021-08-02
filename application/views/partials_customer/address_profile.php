<div class="container-fluid" id="shipping-billing-info">
	<h4>Addresses</h4>
	<label>This is your personal addresses</label>
	<div id="divider"></div>
	<div class="alert alert-<?= (substr($msg, 0, 7) == 'Success') ? 'success' : 'danger' ?> 
	alert-dismissible fade show" role="alert"
		style="display: <?= ($msg == '') ? 'none' : 'block' ?>;"><?= $msg ?>
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> 
	</div>
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
			<h3>Shipping Address</h3>
			<div class="mb-3  edit-address" id="edit-shipping"><i class="fa fa-pencil-square-o fs-6" >
				</i> Edit shipping address</div>
			<form action="myaccounts/update_address/<?= $shipping_address['role_id'] ?>" method="post" id="shipping-form">
				<input type="hidden" name="csrf_test_name" value="<?= $token ?>">
				<label for="shipping_address">Address</label>
				<input type="text" name="street" class="form-control shipping" id="shipping-address" placeholder="Address"
				value="<?= $shipping_address['street'] ?>" disabled="true">
				<label for="city">City</label>
				<input type="text" name="city" class="form-control shipping" id="shipping-city" placeholder="City"
				value="<?= $shipping_address['city'] ?>" disabled="true">
				<label for="town">Town</label>
				<input type="text" name="town" class="form-control shipping" id="shipping-town" placeholder="Town"
				value="<?= $shipping_address['town'] ?>" disabled="true">
				<label for="zipcode">Zipcode</label>
				<input type="text" name="zip" class="form-control shipping" id="shipping-zip" placeholder="Zipcode"
				value="<?= $shipping_address['zip'] ?>" disabled="true">
				<input type="submit" value="Save" class="btn btn-primary mt-4" id="save-btn-shipping" disabled="true">
			</form>
		</div>
		<div class="tab-pane fade" id="billing" role="tabpanel" aria-labelledby="billing-tab">
			<h3>Billing Address</h3>
			<div class="mb-3 edit-address" id="edit-billing"><i class="fa fa-pencil-square-o fs-6">
				</i> Edit billing address</div>
			<form action="myaccounts/update_address/<?= $billing_address['role_id'] ?>" method="post" id="billing-form">
				<input type="hidden" name="csrf_test_name" value="<?= $token ?>">
				<label for="address">Address</label>
				<input type="text" name="street" class="form-control billing" id="billing-address" placeholder="Address" value="<?= $billing_address['street'] ?>" disabled="true">
				<label for="city">City</label>
				<input type="text" name="city" class="form-control billing" id="billing-city" placeholder="City"
				value="<?= $billing_address['city'] ?>" disabled="true">
				<label for="town">Town</label>
				<input type="text" name="town" class="form-control billing" id="billing-town" placeholder="Town"
				value="<?= $billing_address['town'] ?>" disabled="true">
				<label for="zipcode">Zipcode</label>
				<input type="text" name="zip" class="form-control billing" id="billing-zip" placeholder="Zipcode"
				value="<?= $billing_address['zip'] ?>" disabled="true">
				<input type="submit" value="Save" class="btn btn-primary mt-4" id="save-btn-billing" disabled="true">
			</form>
		</div>
	</div>
	<div class="csrf_token" id="<?= $token ?>"></div>
</div>