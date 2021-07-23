<!DOCTYPE html>
	<html>
	<head>
		<title></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1">
	
		<link rel="stylesheet" type="text/css" href="<?= asset_url() ?>css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="<?= asset_url() ?>css/admin_nav.css">
		<link rel="stylesheet" type="text/css" href="<?= asset_url() ?>css/dashboard.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="<?= asset_url() ?>css/scrollbar.css">
		<script type="text/javascript" src="<?= asset_url() ?>js/bootstrap.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$.get("<?= base_url()?>ajaxorderspage/render_orders", function(data) {
					$("#load_partials").html(data);
				});
				$(document).on("submit","#paging-form-orders", function() {
					$.post($(this).attr("action"), $(this).serialize(), function(data) {
						$("#load_partials").html(data);
					});
					return false;
				});
				$("#search-form").keyup(function() {
					$.post($(this).attr("action"), $(this).serialize(), function(data) {
						$("#load_partials").html(data);
					});
					return false;
				});
				$(document).on("change","#order-status", function() {
					$.post($(this).attr("action"), $(this).serialize(), function(data) {
						// $("#load_partials").html(data);
					});
					return false;
				});
				$("#select-form").change(function() {
					$.post($(this).attr("action"), $(this).serialize(), function(data) {
						$("#load_partials").html(data);
					});
					return false;
				});
			});
		</script>
	
	</head>
	<body>
		<div class="row min-vh-100 flex-column flex-md-row">
			<?php $this->load->view("admin/navbar",$orders); ?>
			<div class="col px-0 flex-grow-1">
				<h2>Orders</h2>
				<div class="container-fluid pt-1" id="num-of-order">
					<p>Number of orders</p>
					<p>Total: <?= $num_orders['total'] ?></p>
				</div>
				<div class="container-fluid pt-1" id="order-in-process">
					<p>Order in process</p>
					<p>Total: <?= $process['total'] ?></p>
				</div>
				<div class="container-fluid pt-1" id="shipped">
					<p>Shipped</p>
					<p>Total: <?= $shipped['total'] ?></p>
				</div>
				<div class="container-fluid pt-1" id="canceled">
					<p>Canceled</p>
					<p>Total: <?= $canceled['total'] ?></p>
				</div>
				<form id="search-form" action="<?= base_url() ?>ajaxorderspage/search_orders" method="post">
					<div class="input-group mb-3" id="search-div">
						<i class=" input-group-text fa fa-search" aria-hidden="true" id="basic-addon1"></i>
						<input type="search" name="search_orders" placeholder="Search" class="form-control" id="search-box">
					</div>
				</form>
				<form id="select-form" action="<?= base_url() ?>ajaxorderspage/sort_by_status" method="post">
					<select class="form-select" name="status_sort">
						<option value="5" selected>Show all</option>
						<option value="0">Order in process</option>
						<option value="1">Shipped</option>
						<option value="2">Canceled</option>
					</select>
				</form>

		<!-- partials view-->
				<div id="load_partials"></div>
			</div>
		</div>
		
	</body>
</html>