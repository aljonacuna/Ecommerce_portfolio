<!DOCTYPE html>
	<html>
	<head>
		<title>Edit Product</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<link rel="stylesheet" type="text/css" href="<?= asset_url() ?>css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="<?= asset_url() ?>css/admin_nav.css">
		<link rel="stylesheet" type="text/css" href="<?= asset_url() ?>css/dashboard.css">
		<link rel="stylesheet" type="text/css" href="<?= asset_url() ?>css/scrollbar.css">
		<link rel="stylesheet" type="text/css" href="<?= asset_url() ?>css/slider.css">
		<link rel="stylesheet" type="text/css" href="<?= asset_url() ?>css/lightslider.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script type="text/javascript" src="<?= asset_url() ?>js/bootstrap.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
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
			<?php $this->load->view("admin/navbar", $products); ?>
			<div class="col px-0 flex-grow-1">
				<h2>Edit product</h2>
				<div id="input-div" class="container-fluid">
					<form action="<?= base_url()?>admins/edit_add_product" method="post" enctype="multipart/form-data" id="imageInputForm" multiple>
						<label>Name: </label>
						<input type="hidden" name="tag" value="edit">
						<input type="hidden" name="old_images" value="<?= $product['image'] ?>">
						<input type="hidden" name="id" value="<?= $product['id'] ?>">
						<input type="hidden" name="old_category" value="<?= $category['name'] ?>">
						<input type="text" name="prodname" placeholder="Name" class="form-control" id="prodname"
						value="<?= $product['name'] ?>">
						<label>Price: </label>
						<input type="text" name="price" placeholder="Price" class="form-control" id="price"
						value="<?= $product['price'] ?>">
						<label>Quantity: </label>
						<input type="text" name="quantity" placeholder="Quantity" class="form-control" id="qty"
						value="<?= $product['quantity'] ?>">
						<label>Description: </label>
						<textarea name="desc" placeholder="Description" class="form-control" id="desc">
							<?= $product['description'] ?></textarea>
						<label>Categories: </label>
						<select class="form-select" name="category_select">
							<option value="default">Choose category</option>
			<?php   if (!is_null($categories)) { 
						foreach ($categories as $value) {	
							if ($category['name'] == $value['name']) { ?>
								<option value="<?= $value['name'] ?>" selected><?= $value['name'] ?></option>
					<?php	}
							else { ?>
								<option value="<?= $value['name'] ?>"><?= $value['name'] ?></option>
					<?php	} ?>
							
			<?php		}

					}  ?>
					
						</select>
						<label>Or add new category: </label>
						<input type="text" name="category" placeholder="Add new category" class="form-control">
						<div class="alert alert-primary d-flex align-items-center mt-2" role="alert">
						  <i class="fa fa-info-circle mx-2" aria-hidden="true"></i> Choose 5 images at once, You cannot
						  change the image once you select it.
						</div>
						<label>Upload image: </label>
						<input type="file" id="uploadImageFile" name="products_image[]" class="form-control" multiple>
						<div id="imagediv"></div>
						<a href="" class="btn btn-secondary" id="cancel-btn">Cancel</a>
						<input type="submit" value="Save changes" class="btn btn-primary" id="save-btn"> 
						
					</form>
				</div>
				<div id="preview-div">
					<h4>Product preview</h4>
					<div id="product-div" class="container-fluid">
						<ul id="oldgallery" class="previous">
							 <li data-thumb="<?= base_url()?>uploads/<?= $main_image ?>" id="list-img" class="li-1">
					            <img src="<?= base_url()?>uploads/<?= $main_image ?>" align="Product" id="display-img" class="img1"/>
					        </li>
				<?php 	foreach ($thumb_images as $key => $value) { ?>
					        <li data-thumb="<?= base_url()?>uploads/<?= $value ?>" id="list-img" class="li-2">
					            <img src="<?= base_url()?>uploads/<?= $value ?>" align="Product" id="display-img" class="img2"/>
					        </li>
				<?php 	}  ?>
						</ul>
						<ul id="newgallery" class="new">
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
						<h4 id="prodname-text"></h4>
						<p id="desc-text"></p>
						<p id="price">Price: &#8369; <span id="price-text"></span></p>
						<p id="qty-p">Stocks: <span id="qty-text"></span> piece/s</p>
					</form>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript" src="<?= asset_url() ?>js/lightslider.js"></script>
		<script src="<?= asset_url() ?>js/script.js" type="text/javascript"></script>
	</body>
</html>