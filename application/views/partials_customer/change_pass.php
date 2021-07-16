<div class="container-fluid" id="changepass-div">
	<h4>Update Password</h4>
	<label>Do not share to anyone your password for your account's security</label>
	<div id="divider"></div>
	<div class="alert alert-<?= (substr($msg, 0, 7) == 'Success') ? 'success' : 'danger' ?> 
	alert-dismissible fade show" role="alert"
		style="display: <?= ($msg == '') ? 'none' : 'block' ?>;"><?= $msg ?>
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> 
	</div>
	<form class="" action="myaccounts/changepass/<?= $info['id'] ?>" method="post" id="changepass-form">
		<div id="input-div">
			<label>New Password</label>
			<input type="password" name="newpass" class="form-control" placeholder="New Password" id="newpass">
			<label>Confirm Password</label>
			<input type="password" name="confpass" class="form-control" placeholder="Confirm Password" id="confpass">
			<input type="submit" value="Save" class="btn btn-primary" id="save-btn">
		</div>
	</form>
</div>