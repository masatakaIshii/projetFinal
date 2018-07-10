<?php sessionStartWithCondition(); ?>
<?php ob_start(); ?>
<?php $title = 'Adventure'; ?>
<?php require_once('controller/game/adventureControl.php'); ?>

<body class="bg-light">
	<h1 id="adventureH1" class="text-center">Welcome in adventure <?=$nameUser['login'];?></h1>
	<?php if(existOrNot($getInfoAdventure,'idUser',$_SESSION['idUser']) == true ){ ?>
			<a href="index.php?action=game&direction=adventureChoseGameView"><h1 class="text-center pt-5 pb-5" id="adventureContinue">Continue your adventure</h1></a>
			<div class="container-fluid pb-5 d-flex justify-content-center">
				<div id="progressBar" class="col-sm-6 p-0 bg-light border border-dark">
				  <div id="insideBar" class="p-0 text-center text-light font-weight-bold">0%</div>
				</div>
			</div>
			<h1 class="text-center pt-5 pb-5" id="adventureReset">Reset your adventure</h1>
			<a href="index.php"><h1 class="text-center pt-5" id="adventureExit">Exit</h1></a>

	<?php } else { ?>
			<a href="index.php?action=game&direction=newAdventure"><h1 class="text-center pt-5 pb-5" id="adventureStart">Start an adventure here !</h1></a>
			<a href="index.php"><h1 class="text-center pt-5" id="adventureExit">Exit</h1></a>

	<?php } ?>	

<script src="public/js//welcomeGame.js"></script>
<script src="public/js/jsAdventure/adventureHome.js"></script>
<script src="public/js/jsGaming/algoVar.js"></script>
<script src="public/js/jsGaming/algoLose.js"></script>
<script src="public/js/jsGaming/algoCreate.js"></script>
</body>



<?php $content = ob_get_clean(); ?>
<?php require_once('view/game/templateGameWhite.php'); ?>