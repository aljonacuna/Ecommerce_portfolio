
<div class="bg-info pt-1" id="num-of-order">
	<p>Number of orders</p>
	<i class="fas fa-shopping-basket fs-4"></i>
	<p>Total: <?= $num_orders['total'] ?></p>
</div>
<div class="bg-warning pt-1" id="order-in-process">
	<p>Order in process</p>
	<i class="fas fa-bell fs-4"></i>
	<p>Total: <?= $process['total'] ?></p>
</div>
<div class="bg-success pt-1" id="shipped">
	<p>Shipped</p>
	<i class="fas fa-shipping-fast fs-3"></i>
	<p>Total: <?= $shipped['total'] ?></p>
</div>
<div class="bg-danger pt-1" id="canceled">
	<p>Canceled</p>
	<i class="fas fa-window-close fs-4"></i>
	<p>Total: <?= $canceled['total'] ?></p>
</div>
	
<div class="container-fluid" id="order-section">
	<table class="table table-hover">
		<tr id="tr-order">
			<th scope="col">Transaction id</th>
			<th scope="col">Name</th>
			<th scope="col">Date</th>
			<th scope="col">Shipping address</th>
			<th scope="col">Total</th>
			<th scope="col">Status</th>
	    </tr>
<?php
	foreach ($orders as $value) { ?>
		<tr>
			<th><a href="<?= base_url() ?>admins/showorder/<?= $value['id'] ?>/<?= $value['uid'] ?>"><?= $value['id'] ?></a></th>
			<td><?= $value['name'] ?></td>
			<td><?= $value['created_at'] ?></td>
			<td><?= $value['street']." ".$value['town']." ".$value['city'] ?></td>
			<td><?= $value['total'] ?></td>
			<td>
				<form action="<?= base_url() ?>ajaxorderspage/orders_status" method="post" id="order-status">
					<input type="hidden" name="id" value="<?= $value['id'] ?>">
					<input type="hidden" name="csrf_test_name" value="<?= $token ?>">
					<input type="hidden" name="search_paging" value="<?= $search ?>">
					<input type="hidden" name="key" value="<?= $key ?>">
					<input type="hidden" name="page" value="<?= $page ?>">
					<select class="form-select" name="status" id="status">
						<option <?= ($value['status_id'] == 0)?"selected":"" ?> value="0">Order in process</option>
						<option <?= ($value['status_id'] == 1)?"selected":"" ?> value="1">Shipped</option>
						<option <?= ($value['status_id'] == 2)?"selected":"" ?> value="2">Canceled</option>
					</select>
				</form>
			</td>
		</tr>
<?php	}
?>

	</table>
</div>

<div class="container-fluid" id="pages">
	<nav aria-label="Paging" id="paging-bottom">
		<ul class="pagination" id="bot-paging-ul">
			<?php
		$temp_page = $page;
		if ($page == 1) {
			
		 ?>
		 	<li class="page-item disabled" id="bot-paging-li">
<?php	} ?>
				<form method="post" action="<?= base_url() ?>ajaxorderspage/switch_page" id="paging-form-orders">
					<input type="hidden" name="search_paging" value="<?= $search ?>">
					<input type="hidden" name="key" value="<?= $key ?>">
					<input type="hidden" name="csrf_test_name" value="<?= $token ?>">
					<input type="hidden" name="page" value="<?= $temp_page-=1 ?>">
					<input type="submit" value="Prev" class="page-link">
				</form>
			</li>			
					
			

	<?php
		for ($x = $links_start ; $x <= $links_end  ; $x++) { ?>
			<li class="page-item <?php echo ($page == $x)?"active":""?>" id="bot-paging-li">
				<form method="post" action="<?= base_url() ?>ajaxorderspage/switch_page" id="paging-form-orders">
					<input type="hidden" name="search_paging" value="<?= $search ?>">
					<input type="hidden" name="key" value="<?= $key ?>">
					<input type="hidden" name="csrf_test_name" value="<?= $token ?>">
					<input type="hidden" name="page" value="<?= $x ?>">
					<input type="submit" value="<?= $x ?>" class="page-link">
				</form>
			</li>
<?php	}
	?>		
			
			
<?php
		$temp_page = $page;
		if ($links_end == $max_page) {
			
		 ?>
			 <li class="page-item disabled" id="bot-paging-li">	
				
<?php	}?>	
				<form method="post" action="<?= base_url() ?>ajaxorderspage/switch_page" id="paging-form-orders">
					<input type="hidden" name="search_paging" value="<?= $search ?>">
					<input type="hidden" name="key" value="<?= $key ?>">
					<input type="hidden" name="csrf_test_name" value="<?= $token ?>">
					<input type="hidden" name="page" value="<?= $temp_page+=1 ?>">
					<input type="submit" value="Next" class="page-link">
				</form>
			</li>
		</ul>
	</nav>
	<div class="csrf_token" id="<?= $token ?>"></div>
</div>