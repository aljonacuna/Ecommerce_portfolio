<div id="main-div">
	<div id="order-section">
		<table class="table table-hover">
			<tr>
				<th id="item">Item</th>
				<th>Price</th>
				<th>Quantity</th>
				<th>Actions</th>
				<th>Total</th>
		    </tr>
<?php  
	$total_price = 0 ;
if($orders != "") {
	foreach ($orders as $key => $value) { ?>
			<tr>
				<td>
					<img src="<?= base_url()?>uploads/<?= $value['prodimage'] ?>" id="display-img"/>
					<p><?= $value['prodname'] ?></p>
				</td>
				<td><?= $value['price'] ?></td>
				<td><?= $value['quantity'] ?></td>
				<td class="text-danger">
					<a href="<?= base_url() ?>cancel_cart/<?= $key ?>" class="fa fa-trash fs-5 ms-2 text-reset text-decoration-none"></a></td>
				<td>&#8369; <?= $value['tot_price'] ?></td>
			</tr>

<?php   	$total_price+=$value['tot_price']; ?>
<?php		
	}
}	
?>	    
		
		</table>
	</div>
	<section id="total-price-section">

		<article id="total-price-article">
			<p id="total-price">Total price: <span id="tot-price-text">&#8369; <?= $total_price ?></span></p>
			<p>+ Shipping fee &#8369; 10</p>
		</article>
		<article id="paynow-article">
			<a href="<?= base_url() ?>checkout" id="paynow-btn" 
				class="btn <?= ($cart == false) ? 'disabled' : '' ?>">Checkout</a>
		</article>
		<article id="continue-shopping-article">
			<a href="<?= base_url() ?>home" id="continue-shopping-link" class="btn btn-primary">Continue shopping</a>
		</article>
		
	</section>

</div>
