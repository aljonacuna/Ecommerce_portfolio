<!DOCTYPE html>
	<html>
	<head>
		<title></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<link rel="stylesheet" type="text/css" href="<?= asset_url() ?>css/bootstrap.min.css">
		<script type="text/javascript" src="<?= asset_url() ?>js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="<?= asset_url() ?>css/home.css">
		<link rel="stylesheet" type="text/css" href="<?= asset_url() ?>css/nav_footer.css">
		<link rel="stylesheet" type="text/css" href="<?= asset_url() ?>css/scrollbar.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script type="text/javascript">
			$(document).ready( function() {
				$.get("<?= base_url()?>ajaxcustomers/render_products", function(res) {
					$("#prod-list").html(res);
				});
				$(document).on("submit","form", function() {
					$.post($(this).attr("action"), $(this).serialize(), function(res) {
						$("#prod-list").html(res);
					});
					return false;
				});
				$(document).on("keyup","#form-search", function() {
					$.post($(this).attr("action"), $(this).serialize(), function(res) {
						$("#prod-list").html(res);
					});
					return false;
				});
			});
		</script>
	</head>
	<body>
		
		<?php 
		if ($is_loggedin != "no") {
			$user_info['info'] = $is_loggedin;
			$this->load->view("partials_customer/nav_loggedin",$user_info);  
		}
		else{
			$this->load->view("customer/navbar_customer");  
		}
		
		?>

		<div id="side-div">
			<h4 id="categories-title" class="bg-dark text-center">Categories</h4>
			<ul class="navbar-nav me-auto mb-2 mb-lg-0">
	<?php 	foreach ($categories as $value) { ?>
				<li id="category-li">
					<form id="category-filter-form" action="ajaxcustomers/search_category" 
						method="post">
						<input type="hidden" name="category" value="<?= $value['name'] ?>">
						<input type="submit" value="<?= $value['name'].'('.$value['num_category'].')' ?>" id="btn-category">
					</form>
				</li>
	<?php	} ?>
				
			</ul>
		</div>
		<div class="container-fluid" id="prod-list">
			
		</div>
		<?php if ($this->session->userdata("search") == TRUE) {
				$this->session->unset_userdata("search");
			} ?>
		<?php $this->load->view("partials_customer/footer_customer");  ?>
	</body>	
</html
