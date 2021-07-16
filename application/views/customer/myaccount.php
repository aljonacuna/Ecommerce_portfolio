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
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$.get("myaccounts", function(res) {
					$("#content").html(res);
				});

				$(document).on("click", ".tag", function() {
					var id = this.id;
					var current = document.querySelector(".active-link");
					current.classList.remove("active-link");
					current.classList.add("inactive-link");
					var active = document.getElementById(id);
					active.classList.remove("inactive-link");
					active.classList.add("active-link");
					$.post("myaccounts/switch_page/" + id, $(this).serialize(), function(res) {
						$("#content").html(res);
					});
					return false;
				});
				$(document).on("submit", "form", function() {
					$.post($(this).attr("action"), $(this).serialize(), function(res) {
						$("#content").html(res);
					});
					return false;
				});
				$(document).on("click", ".edit-address", function() {
					id = this.id;
					if (id == "edit-shipping") {
						all_input("shipping");
						document.getElementById("save-btn-shipping").disabled = false;
					}
					else {
						all_input("billing");
						document.getElementById("save-btn-billing").disabled = false;
					}
				});
				function all_input(input) {
					var all_input = document.getElementsByClassName(input);
					console.log(all_input);
					for (var x = 0 ; x < all_input.length ; x++) {
						document.getElementById(all_input[x].id).disabled = false;
					}

				}
			});
		</script>
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