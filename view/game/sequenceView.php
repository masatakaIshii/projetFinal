<?php 
sessionStartWithCondition();
ob_start(); 
$title = 'Sequence '.$_GET['numSequence']; 
require_once('controller/game/sequenceVerif.php');
 ?>

<div class="col-sm-12 pb-5 d-flex justify-content-center">
	<div class="col-sm-6 border border-dark">
		<h1 class="text-center text-info pb-3" id="adventureH1"><?='Sequence '.$_GET['numSequence'].' : '.$sequenceInfo[0]['name'];?></h1>
	</div>
</div>
<div class="row col-sm-12 pb-5 d-flex justify-content-center">
	<img id="goalLogo" src="public/image/goal.png">
	<h1 class="text-center pt-3 text-light" id="goalSequence"><?='GOAL : '.$sequenceInfo[0]['goal'];?></h1>
</div>


<div class="container-fluid d-flex justify-content-center pb-5 pt-5">
	<p class="text-light" id="descriptionSequence"><?=$sequenceInfo[0]['content'];?></p>
</div>

<a href=<?="index.php?action=game&direction=playPuzzleAdventure&puzzle=".$goodNumPuzzle;?> ><h1 class="text-center  pt-5" id="titleGame">PLAY</h1></a>

<script type="text/javascript" src="public/js/welcomeGame.js"></script>
<script type="text/javascript" src="public/js/jsGaming/algoCreate.js"></script>
<script type="text/javascript" src="public/js/jsGaming/algoVar.js"></script>
<script type="text/javascript" src="public/js/jsGaming/algoLose.js"></script>
<?php $content = ob_get_clean(); ?>
<?php require_once('view/game/templateGameBlack.php'); ?>