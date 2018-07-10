<?php ob_start(); ?>
<?php $title = 'Algoenza'; ?>
<?php 
require_once('view/game/algoView.php');
require_once('controller/game/algoControl.php'); 
?>
<h1 class="text-center"><?=$puzzleTitle;?></h1>
<div>
	<p class="text-center "><?=$entitle;?></p>					
</div>
<div class="col-sm-12 p-0 border border-secondary" id="algoGame">						
	<div id="play" class="col-sm-12  p-0">
		
		<?php displayIns($ins);	?>
		
	</div>
</div>
<button id="validate" class="btn btn-dark w-100 p-2 btn-lg border border-light d-block col-sm-12">Confirm</button>
<?php if (isset($_GET['direction']) && !empty($_GET['direction']) && $_GET['direction'] == 'playPuzzleAdventure')
{ ?>
	<script type="text/javascript" src="public/js/jsAdventure/loseAdventure.js"></script>
	<script type="text/javascript" src="public/js/jsAdventure/adventureGame.js"></script>
	<script type="text/javascript" src="public/js/jsAdventure/adventureVerifResults.js"></script>
	<script type="text/javascript" src="public/js/jsAdventure/winAdventure.js"></script>  <?php

} else { ?>
	<script type="text/javascript" src="public/js/jsGaming/algoLose.js"></script>
	<script type="text/javascript" src="public/js/jsGaming/algoVerifResult.js"></script>
	<script type="text/javascript" src="public/js/jsGaming/algoGame.js"></script> 
	<script type="text/javascript" src="public/js/jsGaming/algoWin.js"></script> <?php
}
	
 ?>
<script type="text/javascript" src="public/js/jsGaming/algoVar.js"></script>
<script type="text/javascript" src="public/js/jsGaming/algoCreate.js"></script>
<script type="text/javascript" src="public/js/jsGaming/algoMove.js"></script>

<script type="text/javascript" src="public/js/jsGaming/algoTime.js"></script>
<script type="text/javascript" src="public/js/jsGaming/algoPosition.js"></script>

<?php $content = ob_get_clean(); ?>
<?php require_once('view/game/templateGameWithSidebar.php'); ?>




