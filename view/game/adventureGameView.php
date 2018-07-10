<?php 
sessionStartWithCondition();
ob_start(); 
$title = 'Game '.$_GET['gameNumber']; 
require_once('controller/game/choseGameVerif.php'); 
?>
<h1 class="text-center text-danger pb-5" id="titleGameH1"><?='Game : '.$coordGame['name'];?></h1>
<div class="container-fluid d-flex justify-content-center pt-5">
	<p class="text-light text-center" id="descriptionGame"><?=$coordGame['description'];?></p>
</div>

<a href=<?="index.php?action=game&direction=playAdventure&sequence=".$_GET['gameNumber'];?>><h1 class="text-center  pb-5 pt-5" id="titleGame">Start</h1></a>

<a href="index.php"><h1 class="text-center pb-5 pt-5" id="titleGame">Exit</h1></a>

<script type="text/javascript" src="public/js/welcomeGame.js"></script>
<script type="text/javascript" src="public/js/jsGaming/algoCreate.js"></script>
<script type="text/javascript" src="public/js/jsGaming/algoVar.js"></script>
<script type="text/javascript" src="public/js/jsGaming/algoLose.js"></script>
<?php $content = ob_get_clean(); ?>
<?php require_once('view/game/templateGameBlack.php'); ?>