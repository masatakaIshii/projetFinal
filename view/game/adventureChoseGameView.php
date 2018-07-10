<?php ob_start(); ?>
<?php $title = 'Games'; ?>
<?php require_once('model/algoModel.php');
require_once('controller/game/choseGameVerif.php');
require_once('controller/game/choseGameControl.php');
?>
<body>
	<h1 id="ChoseGameH1" class="text-center pt-4">PLAY GAMES</h1>
	<div class="container-fluid" style="height : 95px;"></div>
	<div class="container-fluid">
		<div class="row">
		
			<div class="col-sm-5">
				<h3 class="text-center text-dark">Game</h3>
			</div>
			<div class="col-sm-3">
				<h3 class="text-center text-dark">Difficulty</h3>
			</div>
			<div class="col-sm-4">
				<h3 class="text-center text-dark">Progression</h3>
			</div>			
		</div>
		<div class="container-fluid" style="height: 50px;"></div>
		<?php displayGames($allGames,$progressUser); ?>
		
	</div>
	<script src="public/js/jsAdventure/choseGame.js"></script>
	<script type="text/javascript" src="public/js/welcomeGame.js"></script>
	<script type="text/javascript" src="public/js/jsGaming/algoCreate.js"></script>
	<script type="text/javascript" src="public/js/jsGaming/algoVar.js"></script>
	<script type="text/javascript" src="public/js/jsGaming/algoLose.js"></script>
</body>

<?php $content = ob_get_clean(); ?>
<?php require_once('view/game/templateGameWhite.php'); ?>