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
		<link rel="stylesheet" type="text/css" href="<?= asset_url() ?>css/slider.css">
		<link rel="stylesheet" type="text/css" href="<?= asset_url() ?>css/lightslider.css">
		<link href="<?= asset_url() ?>fontawesome/css/all.css" rel="stylesheet">
		<script type="text/javascript" src="<?= asset_url() ?>js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?= asset_url() ?>js/JQuery3.3.1.js"></script>
		<script type="text/javascript" src="<?= asset_url() ?>js/add_prod.js"></script>
		 <style type="text/css">
		 	#preview_img{
		 		margin-top: 5px;
		 		width: 15%;
		 		height: 50px;
		 	}
		 	#msg{
		 		width: 50%;
		 		margin: 20px 25% 0px 25%; 
		 	}
		 	label{
		 		margin-top: 10px;
		 	}
		 </style>
	</head>
	<body>
		<div class="row min-vh-100 flex-column flex-md-row">
			<?php $this->load->view("admin/navbar", $active); ?>
			<div class="col px-0 flex-grow-1">
				<h2>Add product</h2>
				<div id="input-div" class="container-fluid">
					<form action="<?= base_url()?>admins/edit_add_product" method="post" enctype="multipart/form-data" id="imageInputForm" multiple>
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>"
							value="<?php echo $this->security->get_csrf_hash();?>">
						<input type="hidden" name="tag" value="add">
						<label>Name: </label>
						<input type="text" name="prodname" placeholder="Name" class="form-control" id="prodname">
						<label>Price: </label>
						<input type="text" name="price" placeholder="Price" class="form-control" id="price">
						<label>Quantity: </label>
						<input type="number" name="quantity" placeholder="Quantity" class="form-control" id="qty">
						<label>Description: </label>
						<textarea name="desc" placeholder="Description" class="form-control" id="desc"></textarea>
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
						<div class="alert alert-primary d-flex align-items-center mt-2" role="alert">
						  <i class="fas fa-info-circle mx-2 me-3"></i> Choose 5 images at once, You cannot
						  change the image once you select it.
						</div>
						<label >Upload image: </label>
						<input type="file" id="uploadImageFile" name="products_image[]" class="form-control" multiple>
						 <div id="imagediv"></div>
						<input type="submit" value="Add" class="btn btn-primary w-75 mx-5 mt-2 mb-2"> 
					</form>
				</div>
				<div id="preview-div">
					<h4>Product preview</h4>
					<div id="product-div" class="container-fluid">
						<ul id="newgallery">
							 <li data-thumb="" id="list-img" class="li-1">
					            <img src="" align="Product" id="display-img" class="img1"/>
					        </li>
					        <li data-thumb="" id="list-img" class="li-2">
					            <img src="" align="Product" id="display-img" class="img2"/>
					        </li>
					        <li data-thumb="" id="list-img" class="li-3">
					            <img src="" align="Product" id="display-img" class="img3"/>
					        </li>
					        <li data-thumb="" id="list-img" class="li-4">
					            <img src="" align="Product" id="display-img" class="img4"/>
					        </li>
					        <li data-thumb="" id="list-img" class="li-5">
					            <img src="" align="Product" id="display-img" class="img5"/>
					     	</li>
						</ul>
	      			</div>
	      			<div class="container-fluid" id="prod-desc-section">
						<h4 id="prodname-text">Product name</h4>
						<p id="desc-text">Description</p>
						<p id="price">Price: &#8369; <span id="price-text">00</span></p>
						<p id="qty-p">Stocks: <span id="qty-text"></span> piece/s</p>
					</form>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript" src="<?= asset_url() ?>js/lightslider.js"></script>
<!-- 		<script src="<?= asset_url() ?>js/script.js" type="text/javascript"></script> -->
	</body>
</html>