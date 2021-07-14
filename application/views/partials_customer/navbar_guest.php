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
		         	</a>
		        </li>
		      
	    		<li class="nav-item" id="login-li">
	    			<a class="nav-link active nav-li" aria-current="page" href="<?= base_url() ?>to_login">Login</a>
	        	</li>
		        <li class="nav-item" id="reg-li">
		          <a class="nav-link active" href="<?= base_url() ?>customers/register_customer">Register</a>
		        </li>
	      </ul>
	    </div>
	</div>
</nav>