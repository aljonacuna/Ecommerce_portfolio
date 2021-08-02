<aside class="col-12 col-md-2 col-x1-2 bg-dark flex-shrink-1">
	<nav class="navbar navbar-expand-md flex-md-column flex-row 
	align-items-center py-2 sticky-top navbar-dark" id="navbar">
		<div class="text-center p-3" id="welcome-div">
			<a class="navbar-brand mx-3" href="#"> 
				<span id="text-welcome">Welcome <?php
					 $info = $this->session->userdata("info_admin");
					 echo $info['fname']." ".$info['lname']; ?></a></span>
		</div>
		 <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		      <span class="navbar-toggler-icon"></span>
		    </button>
		    <div class="collapse navbar-collapse order-last" id="navbarSupportedContent">
		    	<ul class="navbar-nav flex-column w-100" id="nav-ul">
		    		<li class="nav-item" id="orders">
			         	<a class="nav-link <?=  ($active == "orders")? 'active' : "" ?> nav-li" aria-current="page" 
			         	 href="<?= base_url() ?>admins/orders"><i class="fas fa-cash-register me-3"></i>Orders</a>
			        </li>
		    		<li class="nav-item" id="products-li">
		    			<a class="nav-link <?=  ($active == "products")? 'active' : "" ?>  nav-li" aria-current="page" href="<?= base_url() ?>admins/product_page"><i class="fas fa-tshirt me-3"></i>Products</a>
		        	</li>
			        <li class="nav-item" id="logoff-li">
			          <a class="btn btn-outline-light" href="<?= base_url() ?>admins/logoff">Log off</a>
			        </li>
		      </ul>
		    </div>
	</nav>
</aside>
