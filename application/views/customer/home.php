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
		<link href="<?= asset_url() ?>fontawesome/css/all.css" rel="stylesheet">
		<script type="text/javascript" src="<?= asset_url() ?>js/JQuery3.3.1.js"></script>
		<script type="text/javascript" src="<?= asset_url() ?>js/home.js"></script>
	</head>
	<body>
		<div id="main">
			<?php 
			if ($is_loggedin != "no") {
				$user_info['info'] = $is_loggedin;
				$user_info['name'] = $name;
				$this->load->view("partials_customer/nav_loggedin", $user_info);  
			}
			else{
				$this->load->view("customer/navbar_customer");  
			}
			
			?>

			<div id="side-div">
				<h4 id="categories-title" class="bg-dark text-center">Categories</h4>
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
		<?php 	$counter = 0;
				foreach ($categories as $value) { ?>
					<li class="category-li" id="<?= $value['name'] ?>">
						<p type="submit"><?= $value['name'].'('.$value['num_category'].')' ?></p>
					</li>
		<?php	$counter++;
				} ?>
					
				</ul>
			</div>
			<div class="container-fluid" id="prod-list">
				
			</div>
			<?php if ($this->session->userdata("search") == TRUE) {
					$this->session->unset_userdata("search");
				} ?>
			<?php $this->load->view("partials_customer/footer_customer");  ?>
		</div>
	</body>	
</html
