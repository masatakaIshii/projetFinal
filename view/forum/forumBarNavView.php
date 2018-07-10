<section class="container">
	<nav class="navbar navbar-expand-lg navbar-light bg-light" id="navBarForum">
	  <a class="navbar-brand" href="#">Forum</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
	    <ul class="navbar-nav mr-auto">
	      	<li class="nav-item">
	        	<a class="nav-link" href="#newSubject">New topic<span class="sr-only"></span></a>
	     	 </li>
	     	 <li class="nav-item">
	        	<a class="nav-link" href="#tableUserSubject">Modify your topics</a>
	      </li>
	    </ul>
	    <div class="form-inline my-2 my-lg-0">
	     	<input class="form-control mr-sm-2 h-60 p-1" name="search" placeholder="Search" style="width: 40%;">
	      
	      	<?php selectFields($fieldsTopic); //function below?>
	      
			<button class="btn btn-outline-primary my-2 my-sm-0 h-25 p-1" style="width: 15%;" type="button" id="searchNav">
				<img src="public/image/forum/magnifying_glass.svg" class="w-50 pt-1 pb-1">
			</button>
	    </div>
	  </div>
	</nav>
</section>

<?php

function selectFields($names){
	?>
	<select class="form-control custom-select mr-sm-2 h-60 p-1" style="width: 35%" name='fields'><?php
	foreach($names as $key => $value) {
		?><option value=<?= $key;?>><?= $value; ?></option><?php
	}
	?></select><?php
}