<?php $arrayL = array('algoVar','algoPosition','algoCreate','algoLose','algoTime','algoMove','algoVerifResult','algoWin','welcomeGame'); ?>
<!DOCTYPE html>
<html>
<head>
	<title><?= $title ?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
	<script
  src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"
  integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30="
  crossorigin="anonymous"></script>
	<!-- <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/themes/smoothness/jquery-ui.css" />
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/jquery-ui.min.js"></script> -->
	
	<link rel="stylesheet" type="text/css" href="public/css/projetStyle.css">
</head>
<body class="bg-light">
	<?php require_once(__DIR__."/header.php");?>
	<?= $content ?>
	<?php require_once(__DIR__."/../footer.php"); ?>
	<?php script($arrayL); ?>
</body>
</html>
<?php

function script($arrayLink)
{
	for ($i=0; $i < sizeof($arrayLink) ; $i++) { ?>
		<script src=<?php echo'public/js/'.$arrayLink[$i].'.js'?> type="text/javascript"></script>
	<?php }
}

 ?>