<?php ob_start(); ?>
<?php $title = 'Puzzle tab'; ?>
<?php require_once('model/algoModel.php');
require_once('controller/game/puzzleTab.php');
?>
<body style="background-color: black;">
	<h1 id="chosepuzzle" class="text-center pt-4">CHOSE A PUZZLE</h1>
	<div class="container-fluid" style="height : 150px;"></div>
	<div class="container-fluid" >
		<div class="row" id="namesTab">
			<div class="col-sm-3">
				<h3 class="text-center">NAME</h3>
			</div>
			<div class="col-sm-4">
				<h3 class="text-center">DIFFICULTY</h3>
			</div>			
			<div class="col-sm-3">
				<h3 class="text-center">WIN TO GET</h3>
			</div>
			<div class="col-sm-2">
				<h3 class="text-center">DONE</h3>
			</div>
		</div>
		<div class="container-fluid" style="height: 50px;"></div>
		<?php 
		displayTab($names); ?>
	</div>
<script type="text/javascript" src="public/js/welcomeGame.js"></script>
<script type="text/javascript" src="public/js/jsGaming/algoVar.js"></script>
<script type="text/javascript" src="public/js/jsGaming/algoLose.js"></script>
<script type="text/javascript" src="public/js/jsGaming/algoCreate.js"></script>
</body>

<?php $content = ob_get_clean(); ?>
<?php require_once('view/game/templateGame.php'); ?>