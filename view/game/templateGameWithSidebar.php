<!DOCTYPE html>
<html>
<head>
	<title><?=$title?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>	
	<link rel="stylesheet" type="text/css" href="public/css/projetStyle.css">
</head>
<body>
	<div class="container-fluid p-0">		
		<div class="row col-sm-12" style="max-width: 1500px;">
			<div class="col-sm-2 p-0" >
				<?php require_once('view/game/GameSidebar.php'); ?>
			</div>
			<div class="col-sm-10 p-0 bg-light">
				<?= $content ?>				
			</div>			
		</div>
	</div>

</body>
</html>
