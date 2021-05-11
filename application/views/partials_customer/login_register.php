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
		<form action="<?= base_url() ?>login" method="post">
			<label for="email_login">Email address</label>
			<div class="input-group mb-3">
			  <i class=" input-group-text fa fa-envelope-o" aria-hidden="true" id="basic-addon1"></i>
			  <input type="email" name="email_login" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" id="email_login">
			</div>
			<label for="password_login">Password</label>
			<div class="input-group mb-3">
			  <i class=" input-group-text fa fa-key" aria-hidden="true" id="basic-addon2"></i>
			  <input type="password" name="password_login" class="form-control" placeholder="Password" aria-label="Username" aria-describedby="basic-addon2" id="password_login">
			</div>
			<input type="submit" value="Login" class="btn btn-primary" id="login-btn">
		</form>
	</div>
		<div class="tab-pane fade <?php echo($active == 'register')? "show active":""; ?>" id="register" role="tabpanel" aria-labelledby="register-tab">
	  	<form class="row g-3" action="<?= base_url() ?>customers/register_customer" method="post" id="reg-form">
	  		<input type="hidden" name="active" value="register">
	  		<div class="col-md-6">
				<label for="fname" class="form-label">Fist name</label>
				<input type="text" name="fname" class="form-control" id="fname">
				<p class="error"><?= ($msg!= "" && $msg != "email" && $msg !="invalidname") ? $msg['fname'] : "" ?></p>
			</div>
			<div class="col-md-6">
				<label for="lname" class="form-label">Last name</label>
				<input type="text" name="lname" class="form-control" id="lname">
				<p class="error"><?= ($msg!= "" && $msg != "email" && $msg !="invalidname") ? $msg['lname'] : "" ?></p>
			</div>

			<div class="col-12">
				<label for="email" class="form-label">Email</label>
				<input type="email" name="email" class="form-control" id="email">
				<p class="error"><?= ($msg!= "" && $msg != "email" && $msg !="invalidname") ? $msg['email'] : "" ?></p>
			</div>
			<div class="col-md-6">
				<label for="password" class="form-label">Password</label>
				<input type="password" name="password" class="form-control" id="password">
				<p class="error"><?= ($msg!= "" && $msg != "email" && $msg !="invalidname") ? $msg['password'] : "" ?></p>
			</div>
			<div class="col-md-6">
				<label for="cpassword" class="form-label">Confirm Password</label>
				<input type="password" name="cpassword" class="form-control" id="cpassword">
				<p class="error"><?= ($msg!= "" && $msg != "email" && $msg !="invalidname") ? $msg['cpassword'] : "" ?></p>
			</div>
			<div class="col-12">
				<label for="street" class="form-label">Street</label>
				<input type="text" name="street" class="form-control" id="street" placeholder="0032 St Bulalakaw">
				<p class="error"><?= ($msg!= "" && $msg != "email" && $msg !="invalidname") ? $msg['street'] : "" ?></p>
			</div>
			<div class="col-md-6">
				<label for="city" class="form-label">City</label>
				<input type="text" name="city" class="form-control" id="city">
				<p class="error"><?= ($msg!= "" && $msg != "email" && $msg !="invalidname") ? $msg['city'] : "" ?></p>
			</div>
			<div class="col-md-4">
				<label for="town" class="form-label">Town</label>
				<input type="text" name="town" class="form-control" id="town">
				<p class="error"><?= ($msg!= "" && $msg != "email" && $msg !="invalidname") ? $msg['town'] : "" ?></p>
			</div>
			<div class="col-md-2">
				<label for="zip" class="form-label">Zip</label>
				<input type="text" name="zip" class="form-control" id="zip">
				<p class="error"><?= ($msg!= "" && $msg != "email" && $msg !="invalidname") ? $msg['zip'] : "" ?></p>
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