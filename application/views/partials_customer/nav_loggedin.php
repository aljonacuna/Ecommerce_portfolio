<nav class="navbar navbar-expand-lg navbar-light" id="navbar">
	<div class="container-fluid">
		<a class="navbar-brand" href="<?= base_url() ?>home">Dojo Ecommerce</a>
	    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	      <span class="navbar-toggler-icon"></span>
	    </button>
	    <div class="collapse navbar-collapse" id="navbarSupportedContent">
	    	<form class="d-flex" id="form-search" action="ajaxcustomers/search_prodname" method="post">
	    		<input type="hidden" name="csrf_test_name" id="csrf_token">
		       <div class="input-group">
		       		<input class="form-control" type="search" name="search" placeholder="Search Product" aria-label="Search" aria-describedby="basic-addon1" id="search">
		       		<i class=" input-group-text fa fa-search text-end" aria-hidden="true" id="basic-addon1"></i>
		        </div>
	      	</form>
	    	<ul class="navbar-nav mx-auto mb-2 mb-lg-0" id="nav-ul">
	    		<li class="nav-item nav-li" id="cart">
		         	<a class="nav-link active nav-li fa fa-shopping-cart" href="<?= base_url() ?>cart">
		         		
				<?php  if ($this->session->userdata('orders') == TRUE){ ?>
						<span class="badge bg-secondary">
						<?php
							$orders = $this->session->userdata('orders');
							if (array_key_exists($info['id'], $orders)) {
								$count = 0;
								foreach ($orders[$info['id']] as $value) {
									$count = $count + $value['quantity'];
								}
								echo $count;
							}
							else {
								echo 0;
							}
							 ?>
						</span>
				<?php 	} ?>
				
				
		         	</a>
		        </li>
		       <li class="nav-item" id="order-history-li">
	    			<a class="nav-link active nav-li" aria-current="page" href="<?= base_url() ?>customers/order_history">Purchase History</a>
	        	</li>
	    		<li class="nav-item" id="account-li">
					<ul class="navbar-nav">
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<?= $name ?>
							</a>
							<ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
								<li><a class="dropdown-item" href="<?= base_url() ?>myaccount">My Account</a></li>
								<li><a class="dropdown-item" href="<?= base_url() ?>logoff">Log out</a></li>
							</ul>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</nav>