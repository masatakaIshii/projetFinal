<?php if (session_status() == PHP_SESSION_NONE) {
		session_start();
}

require_once(__DIR__.'/../../model/algoModel.php');
require_once(__DIR__.'/../../model/mainModel.php');


function getPuzzleOfSequence($idSequence)
{
	$getP = selectAlgo('puzzle',0,'idSequence',$idSequence);
	$puzzleOfseq = $getP->fetch();
	return $puzzleOfseq;
}

function getSequenceOfPuzzle($idPuzzle)
{
	$getSeq = selectAlgoOrderIdAsc('puzzle',0,'id',$idPuzzle);
	$sequenceName = $getSeq->fetch();
	return $sequenceName['idSequence'];
}

function allGames()
{
	$games = selectAlgoOrderIdAsc('game',0);
	$allGames = classifyAlgo($games);
	return $allGames;
}

function lastIdGameUser($idUser)
{
	$progress = selectAlgoOrderIdAsc('resolutiongame',0,'idUser',$idUser);
	$getProgress = classifyAlgo($progress);
	if(sizeof($getProgress) > 0 )
	{
		if($getProgress[sizeof($getProgress) - 1]['progression'] == 100 && $getProgress[sizeof($getProgress) - 1]['idGame'] < 5)
			return $getProgress[sizeof($getProgress) - 1]['idGame'] + 1;
		return $getProgress[sizeof($getProgress) - 1]['idGame'];
	}else {
		return 1;
	}
}





function verifSeqAccordingToProgression($get,$progress,$tabSequenceId)
{	

	//verifie que la sequence est bien atteignable par le user en fonction de sa progression dans la partie
switch ($progress) {
	case 0:
		if($get > $tabSequenceId[0]['id'])
		{
			throw new Exception('404 sequence not found <a href="index.php?action=game&direction=adventureChoseGameView">Retry to play sequence</a>');
			exit;
		}
		break;
	case 25 :
		if( $get >  $tabSequenceId[1]['id'])
		{
			throw new Exception('404 sequence not found <a href="index.php?action=game&direction=adventureChoseGameView">Retry to play sequence</a>');
			exit;
		}
		break;
	case 50 : 
		if( $get >  $tabSequenceId[2]['id'])
		{
			throw new Exception('404 sequence not found <a href="index.php?action=game&direction=adventureChoseGameView">Retry to play sequence</a>');
			exit;
		}
		break;
	}
}


