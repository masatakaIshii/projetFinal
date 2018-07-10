<?php $title = 'Team'; ?>

<?php ob_start(); ?>
<section class="container">
	<article class="d-flex flex-column">
		<div>
			<div class="d-flex justify-content-center">
				<h3 class="h3">Team of sick</h3>
			</div>
			<div class="d-flex justify-content-around mb-2">
				<div class="card" style="width: 18rem;">
				  <img class="card-img-top" src="public/image/oldman.png" alt="masa">
				  <div class="card-body">
				    <h5 class="card-title">Masa</h5>
				    <p class="card-text">Co-manager of SICK IT. He is not goot to resolve the problem.</p>
				  </div>
				</div>
				<div class="card" style="width: 18rem;">
				  <img class="card-img-top" src="public/image/boy.png" alt="jeremy">
				  <div class="card-body">
				    <h5 class="card-title">Jérémy</h5>
				    <p class="card-text">Co-manager of SICK IT. He is the genius of jQuery.</p>
				  </div>
				</div>	
			</div>
			<div class="d-flex justify-content-center">
				<a href="index.php" class="btn btn-link">Back to home page</a>
			</div>
			
	</article>
</section>

<?php
$content = ob_get_clean();

require_once('template.php');