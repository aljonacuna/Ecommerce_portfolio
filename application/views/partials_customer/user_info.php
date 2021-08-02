<div class="container-fluid" id="profile-div">
	<h4>My Profile</h4>
	<label>Personal Information</label>
	<div id="divider"></div>
	<div class="alert alert-<?= (substr($msg, 0, 7) == 'Success') ? 'success' : 'danger' ?> alert-dismissible fade show" 
		role="alert"
		style="display: <?= ($msg == '') ? 'none' : 'block' ?>;"><?= $msg ?>
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> 
	</div>
	<form action="<?= base_url() ?>myaccounts/update_user_info/<?= $info['id'] ?>" method="post" id="info-form">
		<div id="input-div">
			<input type="hidden" name="csrf_test_name" value="<?= $token ?>">
			<label> First name</label>
			<div class="link-input">
				<input type="text" name="fname" class="form-control" value="<?= $info['fname'] ?>" id="fname">
			</div>
			<label> Last name</label>
			<div>
				<input type="text" name="lname" class="form-control" value="<?= $info['lname'] ?>" id="lname">
			</div>
			<label> Email address</label>
			<div>
				<input type="email" name="email" class="form-control" value="<?= $info['email'] ?>" id="email">
			</div>
			<input type="submit" value="Save" class="btn btn-primary" id="save-btn">
		</div>
	</form>
	<div class="csrf_token" id="<?= $token ?>"></div>
</div>