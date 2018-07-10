<!DOCTYPE html>
<html>
<head>
	<title><?= $title ?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="public/css/projetStyle.css">
</head>
<body class="bg-light">
	<main>
	<?= $content ?>
	</main>
	<?php require_once("view/footer.php"); ?>
	<script src="public/js/backend/backofficeView.js"></script>
	<script src="public/js/backend/createLignOfTable.js"></script>
	<script src="public/js/backend/sendInputsForInsert.js"></script>
</body>
</html>