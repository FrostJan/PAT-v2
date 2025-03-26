<div class="text-center pt-5">
	<img src="images/logo.png" width="90px">
</div>

<div class="container sticky-top p-3 bg-white">
	<nav class="navbar navbar-expand-lg bg-white">
		<button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		    <i class="fal fa-bars"></i>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav">
				<li class="nav-item ml-2 mr-2">
                    <div class="dropdown">
					  <a class="btn dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
					    <i class="fal fa-user h5"></i>
					  </a>
					  <div class="dropdown-menu" style="min-width: 5rem;">
					    <a class="dropdown-item pl-2" href="login2.php">Login</a>
					    <a class="dropdown-item pl-2" href="signup.php">Register</a>
					  </div>
					</div>
                </li>

		    </ul>
		    <ul class="navbar-nav ml-auto">
				<li class="nav-item ml-2 mr-2">
                    <a class="nav-link text-dark font-weight-bold" href="index.php">Home</a>
                </li>
                <li class="nav-item ml-2 mr-2">
                    <a class="nav-link text-dark font-weight-bold" href="products.php">Products</a>
                </li>
                <li class="nav-item ml-2 mr-2">
                    <a class="nav-link text-dark font-weight-bold" href="about.php">About</a>
                </li>
                <li class="nav-item ml-2 mr-2">
                    <a class="nav-link text-dark font-weight-bold" href="contact.php">Contact</a>
                </li>
		    </ul>
		    <ul class="navbar-nav ml-auto">
		        <li class="nav-item">
			         <a class="nav-link showsearch text-dark" href="#"><i class="fal fa-search h5"></i></a>
		        </li>
		        <li class="nav-item">
			        <a class="nav-link text-dark position-relative" href="#"><i class="fal fa-shopping-cart h5"></i>
			        	<div class="cartcount text-white rounded-circle">0</div>
			        </a> 
		        </li>
		    </ul>
		</div>
	</nav>
</div>

<div class="searchingwrapper">
	<div style="max-width: 1000px;cursor: pointer;" class="text-right text-white p-3 m-auto closesearch"><i class="fal fa-times h1"></i></div>
	<form method="POST" action="controller/search_controller.php" class="w-100 pl-5 pr-5">
		<div class="searchbody m-auto">
			<input type="text" name="txtsearch" class="w-100 bg-transparent" placeholder="Search Products...">
			<button type="submit" class="bg-transparent text-white"><i class="fal fa-search"></i></button>
		</div>
	</form>
</div>