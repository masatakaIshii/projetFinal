<?php $title = 'Forum'; ?>

<?php ob_start(); ?>

<main>
	<?php require_once('view/forum/forumBarNavView.php'); ?>

	<?php require_once('view/forum/forumListSubjectView.php'); ?>

	<?php require_once('view/forum/forumNewSubject.php'); ?>

	<?php require_once(__DIR__.'/forumUserSubjectView.php'); ?>
</main>

<?php $content = ob_get_clean(); ?>
<?php require_once('view/forum/template.php');