<?php sessionStartWithCondition();
require_once(__DIR__.'/algoModel.php');
require_once(__DIR__.'/mainModel.php');

function progressionBeforeExist($idUser,$numSequence)
{
	$db = dbConnect();
	$infoSequence = $db->prepare('SELECT resolutiongame.progression FROM game,resolutiongame WHERE resolutiongame.idGame = game.id AND game.id = ? AND resolutiongame.idUser = ? ');
	$infoSequence->execute(array($numSequence - 1,$idUser));
	return $infoSequence;
}

function doneGame($numGame)
{
	$db = dbconnect();
	$get = $db->prepare('SELECT * FROM resolutiongame WHERE idUser = ? AND idGame = ?');
	$get->execute(array($_SESSION['idUser'],$numGame));
	$count = $get->rowCount();
	if($count == 0){
		return 0;
	} else {
		return 1;
	}
}





