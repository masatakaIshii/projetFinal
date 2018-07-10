<?php if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
require_once(__DIR__.'/../../model/algoModel.php');
require_once(__DIR__.'/../../controller/game/adventureControl.php');

if( isset($_GET['newPseudo']) && !empty($_GET['newPseudo']) )
{
	$newPseudoReq = selectAlgo('adventure',0);
	$newPseudoExist = classifyAlgo($newPseudoReq);
	if( existOrNot($newPseudoExist,'pseudo',$_GET['newPseudo']) )
	{
		echo 0;
	} else {
		echo 1;
	}

}