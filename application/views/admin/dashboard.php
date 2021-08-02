<!DOCTYPE html>
	<html>
	<head>
		<title></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1">
	
		<link rel="stylesheet" type="text/css" href="<?= asset_url() ?>css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="<?= asset_url() ?>css/admin_nav.css">
		<link rel="stylesheet" type="text/css" href="<?= asset_url() ?>css/dashboard.css">
		<link href="<?= asset_url() ?>fontawesome/css/all.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="<?= asset_url() ?>css/scrollbar.css">
		<script type="text/javascript" src="<?= asset_url() ?>js/bootstrap.min.js"></script>
	<!-- 	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> -->
		<script type="text/javascript" src="<?= asset_url() ?>js/JQuery3.3.1.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				var hash = "";
				$.get("<?= base_url()?>ajaxorderspage/render_orders", function(data) {
					$("#load_partials").html(data);
					refresh_token();
				});
				$(document).on("submit","#paging-form-orders", function() {
					$.post($(this).attr("action"), $(this).serialize(), function(data) {
						$("#load_partials").html(data);
						console.log(data);
					});
					return false;
				});
				$("#search-form").keyup(function() {
					var search = document.getElementById("search-box").value;
					search = (search == "") ? "1" : search;
					hash = refresh_token();
					$.post("<?= base_url() ?>ajaxorderspage/search_orders/"+search, 
						{"csrf_test_name": hash}, function(data) {
						$("#load_partials").html(data);
					});
					return false;
				});
				$(document).on("change","#order-status", function() {
					$.post($(this).attr("action"), $(this).serialize(), function(data) {
						$("#load_partials").html(data);
						setToken();
					});
					return false;
				});
				$("#select-form").change(function() {
					var sort = document.getElementById("sort-status").value;
					hash = refresh_token();
					$.post("<?= base_url() ?>ajaxorderspage/sort_by_status/"+sort, 
						{"csrf_test_name": hash}, function(data) {
						$("#load_partials").html(data);
					});
					return false;
				});
				function refresh_token() {
					return document.getElementsByClassName('csrf_token')[0].id;
				}
				function setToken() {
					$('input[name=csrf_test_name]').val(refresh_token());
				}
			});
		</script>
	
	</head>
	<body>
		<div class="row min-vh-100 flex-column flex-md-row">
			<?php $this->load->view("admin/navbar", $active); ?>
			<div class="col px-0 flex-grow-1">
				<h2>Orders</h2>
		<!-- partials view-->
			<form id="search-form" method="post">
				<div class="input-group mb-3" id="search-div">
					<i class=" input-group-text fa fa-search" aria-hidden="true" id="basic-addon1"></i>
					<input type="search" name="search_orders" placeholder="Search by Customer name or Product ID" class="form-control" id="search-box">
				</div>
			</form>
			<form id="select-form" method="post">
				<select class="form-select" name="status_sort" id="sort-status">
					<option value="5" selected>Show all</option>
					<option value="0">Order in process</option>
					<option value="1">Shipped</option>
					<option value="2">Canceled</option>
				</select>
			</form>
				<div id="load_partials"></div>
			</div>
		</div>
		
	</body>
</html>