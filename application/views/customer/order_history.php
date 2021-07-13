<!DOCTYPE html>
	<html>
	<head>
		<title></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<link rel="stylesheet" type="text/css" href="<?= asset_url() ?>css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="<?= asset_url() ?>css/show_prod.css">
		<link rel="stylesheet" type="text/css" href="<?= asset_url() ?>css/nav_footer.css">
		<link rel="stylesheet" type="text/css" href="<?= asset_url() ?>css/scrollbar.css">
		<link rel="stylesheet" type="text/css" href="<?= asset_url() ?>css/order_history.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script type="text/javascript" src="<?= asset_url() ?>js/bootstrap.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$.get("<?= base_url()?>orderhistory/render_html", function(res) {
				$("#main").html(res);
				rateYo();
			});

			$(document).on("click", ".tag", function() {
				var id = this.id
				var which_tab = id.substr(-1, id.length);
				var current = document.querySelector(".active-link");
				current.classList.remove("active-link");
				current.classList.add("inactive-link");
				var active = document.getElementById(id);
				active.classList.remove("inactive-link");
				active.classList.add("active-link");
				$.post("<?= base_url()?>orderhistory/switch_tab/" + which_tab, $(this).serialize(), function(res) {
					$("#main").html(res);
					rateYo();
				});
				return false;
			});

			function rateYo() {
				setTimeout(function() {
						$(".rateYo").rateYo().on("rateyo.change", function (e, data) {
				    	var rating = data.rating;
				        $(this).parent().find('.score').text('score :'+ $(this).attr('data-rateyo-score'));
				        $(this).parent().find('.result').text('Rating :'+ rating);
				        $("div").parent().find('input[name=rating]').val(rating);
				        $("div").parent().find('.rates').text("You rate this: "+rating);
				        var id = $(this).parent().find('input[name=id]').val();
				        $("div").parent().find("input[name=product_id]").val(id);
					});		
				}, 1000);
			}
			});
			
		</script>
	</head>
	<body>
		<!-- navbar section -->
		<?php
			if ($is_loggedin != "no") {
				$user_info['info'] = $is_loggedin;
				$this->load->view("partials_customer/navbar_main",$user_info);  
			}
			else{
				$this->load->view("partials_customer/navbar_guest");  
			}
		
		?>
		<ul class="nav justify-content-center" id="tabs">
			<!-- <span class="position-absolute top-10 start-0">Hey</span> -->
			<li class="nav-item">
				<button class="nav-link active-link tag" id="all-btn9">All</button>
			</li>
			<li class="nav-item">
				<button class="nav-link inactive-link tag" id="oip-btn0">Order in process</button>
			</li>
			<li class="nav-item">
				<button class="nav-link inactive-link tag" id="shipped-btn1">Shipped</button>
			</li>
			<li class="nav-item">
				<button class="nav-link inactive-link tag" id="cancel-btn2">Cancel</button>
			</li>
		</ul>
		<div class="modal" tabindex="-1" id="review_modal">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
					<h5 class="modal-title">Product Review<span class="rates"></span></h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<form action="<?= base_url() ?>review" method="post">
							<label>Any comments</label>
							<textarea name="comment" class="form-control comment"></textarea>
							<input type="hidden" name="rating">
							<input type="hidden" name="product_id">
							<input type="hidden" name="user_id" value="<?= $info['id'] ?>">
							<input type="submit" value="Send review" class="btn btn-primary mt-3">
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="container-fluid" id="main">
			
		</div>
		<script src="jquery.js"></script>
		<script src="jquery.rateyo.js"></script>
		<?php $this->load->view("partials_customer/footer_customer"); ?>
	</body>
</html>