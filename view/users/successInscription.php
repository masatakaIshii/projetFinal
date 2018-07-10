<?php $title = 'Inscription'; ?>

<?php ob_start(); ?>
<main class="bg-light h-25">
	<section class="container ">
		<span>Congratulation <?=$surePost['login'];?>, you are registered. <a href="index.php?action=users&amp;direction=connection">Sign in</a><span>
	</section>
</main>

<?php $content = ob_get_clean(); ?>

<?php require_once('view/users/template.php');