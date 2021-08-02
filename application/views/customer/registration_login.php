<!DOCTYPE html>
	<html>
	<head>
		<title>Ecommerce</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<link rel="stylesheet" type="text/css" href="<?= asset_url() ?>css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="<?= asset_url() ?>css/reg_login.css">
		<link rel="stylesheet" type="text/css" href="<?= asset_url() ?>css/scrollbar.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script type="text/javascript" src="<?= asset_url() ?>js/bootstrap.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script type="text/javascript">
			// $(document).ready(function() {
			// 	$.get("<?= base_url() ?>customers/render_template", function(res) {
			// 		$("#main-div").html(res);
			// 	});
			// 	$(document).on("submit","form", function() {
			// 		$.post($(this).attr("action"), $(this).serialize(), function(res) {
			// 			$("#main-div").html(res);

			// 		});
			// 		return false;
			// 	});
			// });
		</script>
	</head>
	<body>
		<div class="container-fluid" id="main-div">
			<ul class="nav nav-tabs nav-fill bg-light" id="myTab" role="tablist">
				<li class="nav-item" role="presentation">
					<button class="nav-link <?php echo($active == 'login')? "active":"" ?>" id="login-tab" data-bs-toggle="tab" data-bs-target="#login" type="button" role="tab" aria-controls="login" aria-selected="true">Login</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link <?php echo($active == 'register')? "active":"" ?>" id="register-tab" data-bs-toggle="tab" data-bs-target="#register" type="button" role="tab" aria-controls="register" aria-selected="false">Register</button>
				</li>
			</ul>
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade <?php echo($active == 'login')?"show active":""; ?>" id="login" role="tabpanel" aria-labelledby="login-tab">
					<div class="alert alert-warning alert-dismissible fade show" role="alert" id="msg" style="text-align: center; display: <?php echo($msg_login!="")?"block":"none"; ?>">
						<strong>Error: </strong><?= ($msg_login == "incorrect") ? "Incorrect email or password" : "Please enter correct credentials" ?>
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
					<form action="<?= base_url() ?>login" method="post">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>"
							value="<?php echo $this->security->get_csrf_hash();?>">
						<label for="email_login">Email address</label>
						<div class="input-group mb-3">
						  <i class=" input-group-text fa fa-envelope-o" aria-hidden="true" id="basic-addon1"></i>
						  <input type="email" name="email_login" class="form-control" placeholder="Email address" aria-label="Email address" aria-describedby="basic-addon1" id="email_login">
						 
						</div>
						 <p class="error"><?= ($msg_login!= "" && $msg_login != "incorrect") ? 
						 $msg_login['email_login'] : "" ?></p>
						<label for="password_login">Password</label>
						<div class="input-group mb-3">
						  <i class=" input-group-text fa fa-key" aria-hidden="true" id="basic-addon2"></i>
						  <input type="password" name="password_login" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="basic-addon2" id="password_login">
						</div>
						<p class="error"><?= ($msg_login!= "" && $msg_login != "incorrect") ? $msg_login['password_login'] : "" ?></p>
						<input type="submit" value="Login" class="btn btn-primary" id="login-btn">
					</form>
				</div>
				<div class="tab-pane fade <?php echo($active == 'register')? "show active":""; ?>" id="register" role="tabpanel" aria-labelledby="register-tab">
					<div class="alert alert-warning alert-dismissible fade show" role="alert" id="msg" style="text-align: center; display: <?php echo($msg_reg!="")?"block":"none"; ?>">
						<strong>Error: </strong>
						<?php 
								if ($msg_reg == "email" && $msg_reg !=""){
									echo "Email already exist";
								}
								else if ($msg_reg == "invalidname" && $msg_reg!="") {
									echo "Invalid name";
								}
								else {
									echo "Unable to signup";
								}  ?>
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
				  		<form class="row" action="<?= base_url() ?>register" method="post" id="reg-form">
					  		<input type="hidden" name="active" value="register">
					  		<div class="col-md-6">
								<label for="fname" class="form-label">Fist name</label>
								<input type="text" name="fname" class="form-control" id="fname">
								<p class="error"><?= ($msg_reg!= "" && $msg_reg != "email" && $msg_reg !="invalidname") ? $msg_reg['fname'] : "" ?></p>
							</div>
							<div class="col-md-6">
								<label for="lname" class="form-label">Last name</label>
								<input type="text" name="lname" class="form-control" id="lname">
								<p class="error"><?= ($msg_reg!= "" && $msg_reg != "email" && $msg_reg !="invalidname") ? $msg_reg['lname'] : "" ?></p>
							</div>

							<div class="col-12">
								<label for="email" class="form-label">Email</label>
								<input type="email" name="email" class="form-control" id="email">
								<p class="error"><?= ($msg_reg!= "" && $msg_reg != "email" && $msg_reg !="invalidname") ? $msg_reg['email'] : "" ?></p>
							</div>
							<div class="col-md-6">
								<label for="password" class="form-label">Password</label>
								<input type="password" name="password" class="form-control" id="password">
								<p class="error"><?= ($msg_reg!= "" && $msg_reg != "email" && $msg_reg !="invalidname") ? $msg_reg['password'] : "" ?></p>
							</div>
							<div class="col-md-6">
								<label for="cpassword" class="form-label">Confirm Password</label>
								<input type="password" name="cpassword" class="form-control" id="cpassword">
								<p class="error"><?= ($msg_reg!= "" && $msg_reg != "email" && $msg_reg !="invalidname") ? $msg_reg['cpassword'] : "" ?></p>
							</div>
							<div class="col-12">
								<label for="street" class="form-label">Street</label>
								<input type="text" name="street" class="form-control" id="street" placeholder="0032 St Bulalakaw">
								<p class="error"><?= ($msg_reg!= "" && $msg_reg != "email" && $msg_reg !="invalidname") ? $msg_reg['street'] : "" ?></p>
							</div>
							<div class="col-md-6">
								<label for="city" class="form-label">City</label>
								<input type="text" name="city" class="form-control" id="city">
								<p class="error"><?= ($msg_reg!= "" && $msg_reg != "email" && $msg_reg !="invalidname") ? $msg_reg['city'] : "" ?></p>
							</div>
							<div class="col-md-4">
								<label for="town" class="form-label">Town</label>
								<input type="text" name="town" class="form-control" id="town">
								<p class="error"><?= ($msg_reg!= "" && $msg_reg != "email" && $msg_reg !="invalidname") ? $msg_reg['town'] : "" ?></p>
							</div>
							<div class="col-md-2">
								<label for="zip" class="form-label">Zip</label>
								<input type="text" name="zip" class="form-control" id="zip">
								<p class="error"><?= ($msg_reg!= "" && $msg_reg != "email" && $msg_reg !="invalidname") ? $msg_reg['zip'] : "" ?></p>
								</div>
							<div class="col-12">
								<div class="form-check">
									<label>
										<input class="form-check-input" type="checkbox" id="gridCheck">
									Agree to terms and service
									</label>
								</div>
							</div>
							<div class="col-12">
								<button type="submit" class="btn btn-primary" id="reg-btn">Register</button>
							</div>
						</form>
				</div>

			</div>
		</div>
	</body>
</html>