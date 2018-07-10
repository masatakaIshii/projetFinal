<?php sessionStartWithCondition();

require_once('controller/game/sequenceControl.php');
require_once('model/sequenceModel.php');

if(!isset($_GET['numSequence']) || empty($_GET['numSequence']) || !is_numeric($_GET['numSequence']) || $_GET['numSequence'] <=0 ) 
{
	throw new Exception('404 sequence not found <a href="index.php?action=game&direction=adventureChoseGameView">Retry to play sequence</a>');
	exit;
}



$adventureGames = allGames();//return allGames

//$idGame = selectGameForSequence($_GET['numSequence']);
$lastGameUser = lastIdGameUser($_SESSION['idUser']);

$progressToNotOvertake = getProgressOfGame($_SESSION['idUser'],$lastGameUser);

$sequencesGame = sequencesOfGame($lastGameUser);
$firstSequence = sequencesOfGame($adventureGames[0]['id']);

//num puzzle à jouer
$puzzleNumber = getPuzzleOfSequence($_GET['numSequence']);



if($_GET['numSequence'] > $sequencesGame[3]['id']) // 3 car une partie a 4 sequences donc tableau de 4 cases avec 3 last indice
{
	throw new Exception('404 sequence not found <a href="index.php?action=game&direction=adventureChoseGameView">Retry to play sequence</a>');
	exit;	
} 
/*
if($progressToNotOvertake == NULL && $_GET['numSequence'] > $sequencesGame[0]['id'] )
{	

	throw new Exception('404 sequence not found <a href="index.php?action=game&direction=adventureChoseGameView">Retry to play sequence</a>');
	exit;
} */

verifSeqAccordingToProgression($_GET['numSequence'],$progressToNotOvertake,$sequencesGame);

$goodNumPuzzle = $puzzleNumber['id'];

$goodSequence = selectAlgoOrderIdAsc('sequence',0,'id',$_GET['numSequence']);
$sequenceInfo = classifyAlgo($goodSequence);