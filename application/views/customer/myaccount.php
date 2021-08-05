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
		<link href="<?= asset_url() ?>fontawesome/css/all.css" rel="stylesheet">
		<script type="text/javascript" src="<?= asset_url() ?>js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?= asset_url() ?>js/JQuery3.3.1.js"></script>
		<script type="text/javascript" src="<?= asset_url() ?>js/myaccount.js"></script>
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
			<h2 id="lbl-myaccount">My Account</h2>
			<!-- breadcrumb -->
			<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb" id="breadcrumb">
				<ol class="breadcrumb px-2">
					<li class="breadcrumb-item"><a class="text-warning" id="home-link" 
						href="<?= base_url() ?>home" id="continue-shopping-link">Home</a></li>
					<li class="breadcrumb-item active" aria-current="page"><a class="text-decoration-none">
						Profile</a></li>
				</ol>
			</nav>
			<div id="side-nav">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0" id="side-nav-ul">
		    		<li class="nav-item nav-li" id="info">
			         	<div class="nav-link active-link tag" id="info-btn"><i class="fa fa-user fs-3 icon" ></i> Information</div>
			        </li>
		    		<li class="nav-item nav-li" id="address">
		    			<div class="nav-link inactive-link tag" id="address-btn">
		    				<i class="fa fa-map-marker fs-3 icon" aria-hidden="true"></i> Addresses</div>
		        	</li>
			         <li class="nav-item nav-li" id="chnagepass">
			          <div class="nav-link inactive-link tag" id="changepass-btn"><i class="fa fa-unlock-alt fs-3 icon" aria-hidden="true">
			          </i> Change password</div>
			        </li>
	      		</ul>
			</div>
			<div class="container-fluid" id="content">
					
			</div>
		</div>
		<!-- footer section -->
		<?php $this->load->view("partials_customer/footer_customer"); ?>
	</body>
</html>