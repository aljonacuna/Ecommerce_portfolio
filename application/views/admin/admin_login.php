<!DOCTYPE html>
	<html>
	<head>
		<title>Dashboard</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<link rel="stylesheet" type="text/css" href="<?= asset_url() ?>css/bootstrap.min.css">
		<script type="text/javascript" src="<?= asset_url() ?>js/bootstrap.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<style type="text/css">
			*{
				padding: 0px;
				margin: 0px;
			}
			body{
				background-color: #ccc;
			}
			#main-div{
				margin-top: 100px;
				padding: 10px;
			}
			label{
				margin-top: 5px;
			}
			.error{
				color: red;
			}
			@media only screen and (max-width: 480px){
				#card-login{
					width: 90%;
				}
			}

			@media only screen and (min-width: 481px){
				#card-login{
					width: 70%;
				}
	
			}
			@media only screen and (min-width: 1024px){
				#card-login{
					width: 50%;
				}
			}	
		</style>
	</head>
	<body>
		<div class="container vh-75" id="main-div">
			<div class="row justify-content-center h-100">
				<div class="card my-auto bg-light" id="card-login">
					<h4 class="text-center mt-3">Admin login page</h4>
					<div class="alert alert-warning alert-dismissible fade show" role="alert" id="msg" style="text-align: center; display: <?php echo($msg_login!="" || $msg_not_admin != "") ? "block":"none"; ?>">
						<strong>Error: </strong>
						<?= ($msg_login == "" && $msg_not_admin == "" ? "Please enter correct credentials" 
								: ($msg_not_admin != "" ? $msg_not_admin : "Incorrect email or password" ))  ?>
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
					<div class="card-body">
						<form action="<?= base_url() ?>admin_login" method="post">
							<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>"
							value="<?php echo $this->security->get_csrf_hash();?>">
							<label>Email</label>
							<input type="email" name="email_login" class="form-control" placeholder="Email Address">
							 <p class="error"><?= ($msg_login!= "" && $msg_login != "incorrect") ? 
						 		$msg_login['email_login'] : "" ?></p>
							<label>Password</label>
							<input type="password" name="password_login" class="form-control" placeholder="Password">
							<p class="error"><?= ($msg_login!= "" && $msg_login != "incorrect") ? $msg_login['password_login'] : "" ?></p>
							<input type="submit" value="Login" class="btn btn-primary m-3 px-5">
						</form>
					</div>
				</div>
			</div>
		</div>
		<?= $this->session->unset_userdata("msg_not_admin") ?>
	</body>
</html>