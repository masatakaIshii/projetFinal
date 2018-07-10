<?php $title = 'Presentation'; ?>

<?php ob_start(); ?>
<section class="container">
	<article class="d-flex flex-column">
		<div>
			<div class="d-flex justify-content-center">
				<h4>Presentation of SICK IT</h4>
			</div>
			<div class="d-flex justify-content-center pb-3">
				<img class="rounded" src="public/image/cerveau.jpg" style="max-height: 400px; max-width: 550px" alt='brain picture'>
			</div>
			<div class="d-flex justify-content-center">
				<p class="col-md-7">
					This is not a prohibited site at least 18 years old.<br>
					Why did we name sick IT, because this is a game that has a link with IT and sickness.<br>
					Why sickness ? because you have to solve diseases related to computers like algorithm, database and network.<br>
					Feel free to live the adventure mode of sick IT and you will have a surprise in the end. Good resolution !
				</p>
			</div>
			<div class="d-flex justify-content-center">
				<a href="index.php">Back to home page</a>
			</div>
		</div>
	</article>
</section>

<?php
$content = ob_get_clean();

require_once('template.php');

