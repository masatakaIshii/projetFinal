<?php $title = 'Topic : ' . $infosSubject['title']; ?>

<?php ob_start(); ?>
<main>
	<?php require_once(__DIR__.'/introTopicView.php');?>

	<?php require_once(__DIR__.'/commentaryListView.php');?>

	<?php require_once(__DIR__.'/newCommentaryView.php');?>
</main>
<?php $content = ob_get_clean();?>

<?php require_once(__DIR__.'/template.php');