<!DOCTYPE html>
	<html>
	<head>
		<title>My Account</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<link rel="stylesheet" type="text/css" href="<?= asset_url() ?>css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="<?= asset_url() ?>css/nav_footer.css">
		<link rel="stylesheet" type="text/css" href="<?= asset_url() ?>css/scrollbar.css">
		<link rel="stylesheet" type="text/css" href="<?= asset_url() ?>css/myaccount.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script type="text/javascript" src="<?= asset_url() ?>js/bootstrap.min.js"></script>
	</head>
	<body>
		<!-- nav bar section -->
		<?php 
		if ($is_loggedin != "no") {
			$user_info['info'] = $is_loggedin;
			$user_info['name'] = $name;
			$this->load->view("partials_customer/navbar_main", $user_info);  
		}
		else{
			$this->load->view("customer/navbar_customer");  
		}
		
		?>

		<!-- main content -->
		<div class="container-fluid" id="main">
			<div>
				
			</div>
		</div>
		
		<!-- footer section -->
		<?php $this->load->view("partials_customer/footer_customer"); ?>
	</body>
</html>