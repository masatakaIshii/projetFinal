<?php $title = "Too bad"; ?>
<?php ob_start() ?>

<main>
	<section class="container pb-3 pt-4" style="background-color: rgba(0,0,0,0);">
		<div>
		<?php cantGame() ?>
		</div>		
	</section>	
</main>

<?php

function cantGame(){
	?>
		<div class="w-100 p-2  text-dark">You cannot play because you do not satisfy the 3rd condition to play Sick-IT.</div>
		<div class="w-100 p-2  text-dark">To play, we must be able to identify you so you must s... ..!</div>
		<div class="p-2">
			<a href="index.php" class="w-100 text-danger" >You can go back to the home page.</a>
		</div>
	<?php
}

$content = ob_get_clean() ?>
<?php require('view/users/template.php'); ?>