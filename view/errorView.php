<?php $title = 'Erreur'; ?>
<?php ob_start() ?>
<main>
	<section class="container pb-3 pt-4">
		<?= $errorMessage ?>
	</section>
</main>

<?php $content = ob_get_clean(); 

require_once('view/users/template.php');

