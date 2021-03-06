<!DOCTYPE html>
<html>
<head>
	<title><?= $title ?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
	<link rel="stylesheet" type="text/css" href="public/css/projetStyle.css">
	<link rel="stylesheet" type="text/css" href="public/css/forumStyle.css">
</head>
<body class="bg-light">
	<?php require("header.php");?>
	<?= $content ?>
	<?php require("view/footer.php"); ?>
	
	<script src="public/js/forum/ajaxSearch.js"></script>
	<script src="public/js/forum/verifNewSubject.js"></script>
	<script src="public/js/forum/modifySubject.js"></script>
	<script src="public/js/forum/removeModifyTopic.js"></script>
	<script src="public/js/forum/ajaxDeleteTopic.js"></script>
</body>
</html>