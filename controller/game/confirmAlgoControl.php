<?php
if(isset($_POST['conf'])){
	if($_POST['conf'] == 'true')
	{
		require_once ('view/game/playAlgoView.php');
	} else {
		require_once('view/game/puzzleTabView.php');
	}
}