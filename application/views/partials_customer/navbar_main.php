<nav class="navbar navbar-expand-lg navbar-light" id="navbar">
	<div class="container-fluid">
		<a class="navbar-brand" href="#">Dojo Ecommerce</a>
	    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	      <span class="navbar-toggler-icon"></span>
	    </button>
	    <div class="collapse navbar-collapse" id="navbarSupportedContent">
	    	<ul class="navbar-nav me-auto mb-2 mb-lg-0" id="nav-ul">
	    		<li class="nav-item nav-li" id="cart">
		         	<a class="nav-link active nav-li fa fa-shopping-cart" href="<?= base_url() ?>cart">
		         		
				<?php  if ($this->session->userdata('orders') == TRUE){ ?>
						<span class="badge bg-secondary">
						<?php
							$orders = $this->session->userdata('orders');
							$user_orders = array();
							foreach ($orders as $value) {
								if ($value['user_id'] == $info['id']) {
									array_push($user_orders, $value['prod_id']);
								}
							}
							echo count($user_orders);
							 ?>
						</span>
				<?php 	} ?>
				
		         	</a>
		        </li>
		       <li class="nav-item" id="order-history-li">
	    			<a class="nav-link active nav-li" aria-current="page" href="<?= base_url() ?>customers/order_history" id="order-history-link">Purchase History</a>
	        	</li>
	    		<li class="nav-item" id="login-li">
	    			<a class="nav-link active nav-li" aria-current="page" href="<?= base_url() ?>logoff" 
	    				id="logoff-link">Logout</a>
	        	</li>
	      </ul>
	    </div>
	</div>
</nav>