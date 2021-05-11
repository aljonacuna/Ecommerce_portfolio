
<nav class="navbar navbar-expand-lg navbar-dark bg-" id="navbar">
	<div class="container-fluid">
		<a class="navbar-brand" href="#">Dashboard</a>
	    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	      <span class="navbar-toggler-icon"></span>
	    </button>
	    <div class="collapse navbar-collapse" id="navbarSupportedContent">
	    	<ul class="navbar-nav me-auto mb-2 mb-lg-0" id="nav-ul">
	    		<li class="nav-item nav-li" id="orders">
		         	<a class="nav-link <?=  ($orders == "orders")? 'active' : "" ?> nav-li" aria-current="page" 
		         	 href="<?= base_url() ?>dashboard">Orders</a>
		        </li>
	    		<li class="nav-item" id="products-li">
	    			<a class="nav-link <?=  ($products == "products")? 'active' : "" ?>  nav-li" aria-current="page" href="<?= base_url() ?>admins/product_page">Products</a>
	        	</li>
		        <li class="nav-item" id="logoff-li">
		          <a class="btn btn-outline-light" href="<?= base_url() ?>admins/logoff">Log off</a>
		        </li>
	      </ul>
	    </div>
	</div>
</nav>
