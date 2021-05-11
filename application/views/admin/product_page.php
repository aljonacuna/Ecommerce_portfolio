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
			function imagepreview() {
				var total_file=document.getElementById("uploadImageFile").files.length;
				for(var i=0;i<total_file;i++) {
					$('#imagediv').append("<img src='"+URL.createObjectURL(event.target.files[i])+"' id='preview_img'><br>");
				}
			}
		</script>
	</head>
	<body>
		<?php $this->load->view("admin/navbar",$products); ?>

		<!-- add modal section -->
		<div class="modal fade" id="exampleModal" tabindex="-1" 
		aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Add product</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<form action="<?= base_url()?>add_product" method="post" enctype="multipart/form-data" id="imageInputForm" multiple>
							<label>Name: </label>
							<input type="text" name="prodname" placeholder="Name" class="form-control">
							<label>Price: </label>
							<input type="text" name="price" placeholder="Price" class="form-control">
							<label>Quantity: </label>
							<input type="number" name="quantity" placeholder="Quantity" class="form-control">
							<label>Description: </label>
							<textarea name="desc" class="form-control" placeholder="Description"></textarea>
							<label>Categories: </label>
							<select class="form-select" name="category_select">
								<option value="default" selected>Choose category</option>
				<?php   if (!is_null($categories)) { 
							foreach ($categories as $value) {	?>
								<option value="<?= $value['name'] ?>"><?= $value['name'] ?></option>
				<?php		}

						}  ?>
						
							</select>
							<label>Or add new category: </label>
							<input type="text" name="category" placeholder="Add new category" class="form-control">
							<label>Upload image: </label>
							<input type="file" id="uploadImageFile" name="products_image[]" onchange="imagepreview();" class="form-control" multiple>
							 <div id="imagediv"></div>
							<input type="submit" value="Add" class="btn btn-primary w-75 mx-5 mt-5"> 
						</form>
					</div>
				</div>
			</div>
		</div>

		<!-- end of modal section -->


		<!-- filter using searchbox or dropdown menu -->
		<div class="container-fluid">
			<form action="<?= base_url() ?>ajaxproductspage/search" method="post" id="search-form" autocomplete="off">
				<div class="input-group mb-3" id="search-div">
					 <i class=" input-group-text fa fa-search" aria-hidden="true" id="basic-addon1"></i>
					<input type="search" name="search" placeholder="Search" class="form-control" id="search-box" 
					aria-label="search" aria-describedby="basic-addon1">
				</div>
			</form>
			<a  type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" href="#" id="add-product">Add new product</a>
		</div>

		<!-- list of orders -->

		<div id="load_partial"></div>
	</body>
</html>