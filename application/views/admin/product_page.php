<!DOCTYPE html>
	<html>
	<head>
		<title></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<link rel="stylesheet" type="text/css" href="<?= asset_url() ?>css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="<?= asset_url() ?>css/admin_nav.css">
		<link rel="stylesheet" type="text/css" href="<?= asset_url() ?>css/dashboard.css">
		<link rel="stylesheet" type="text/css" href="<?= asset_url() ?>css/scrollbar.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script type="text/javascript" src="<?= asset_url() ?>js/bootstrap.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
		 <style type="text/css">
		 	#preview_img{
		 		margin-top: 25px;
		 		width: 25%;
		 		height: 70px;
		 	}
		 	#msg{
		 		width: 50%;
		 		margin: 20px 25% 0px 25%; 
		 	}
		 	label{
		 		margin-top: 10px;
		 	}
		 </style>
		<script type="text/javascript">
			$(document).ready( function() {
				$.get("<?= base_url()?>ajaxproductspage/render_productpage", function(res) {
					$("#load_partial").html(res);
				});

				$(document).on("submit","#paging-form", function() {
					$.post($(this).attr("action"), $(this).serialize(), function(res) {
						$("#load_partial").html(res);
					});
					return false;
				});
				$("#search-form").keyup(function() {
					$.post($(this).attr("action"), $(this).serialize(), function(res) {
						$("#load_partial").html(res);
					});
					return false;
				})
			});
		</script>
	</head>
	<body>
		<div class="row min-vh-100 flex-column flex-md-row">
			<?php $this->load->view("admin/navbar", $products); ?>
			<div class="col px-0 flex-grow-1">
				<h2>Products</h2>
			<!-- filter using searchbox or dropdown menu -->
				<div class="container-fluid">
					<form action="<?= base_url() ?>ajaxproductspage/search" method="post" id="search-form" autocomplete="off">
						<div class="input-group mb-3" id="search-div">
							 <i class=" input-group-text fa fa-search" aria-hidden="true" id="basic-addon1"></i>
							<input type="search" name="search" placeholder="Search" class="form-control" id="search-box" 
							aria-label="search" aria-describedby="basic-addon1">
						</div>
					</form>
					<a  type="button" class="btn btn-primary" href="<?= base_url() ?>admins/add_product_page" id="add-product">Add new product</a>
				</div>

				<!-- list of orders -->

				<div id="load_partial"></div>
			</div>
		</div>
	</body>
</html>