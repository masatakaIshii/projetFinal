<?php sessionStartWithCondition();

require_once(__DIR__.'/../../model/algoModel.php');
require_once(__DIR__.'/../../model/mainModel.php');
require_once(__DIR__.'/../../model/sequenceModel.php');
require_once(__DIR__.'/../../model/choseGameModel.php');
require_once(__DIR__.'/../../controller/game/puzzleTab.php');
require_once(__DIR__.'/../../controller/game/sequenceControl.php');
require_once(__DIR__.'/../../controller/game/choseGameControl.php');



if(isset($_GET['sequence']) && !empty($_GET['sequence']))
{	
	if($_GET['sequence'] > 1)
	{
		$infoSequence = progressionBeforeExist($_SESSION['idUser'],$_GET['sequence']);
		$existSeqUs = $infoSequence-> rowCount();
		$progressionSequence = $infoSequence->fetch();

		if($progressionSequence['progression'] != 100 || $existSeqUs < 1)
		{
			throw new Exception('404 sequence not found <a href="index.php?action=game&direction=adventureChoseGameView">Retry to play sequence</a>');
			exit;
		}
	}

	if($_GET['sequence'] < 1) 
	{
		throw new Exception('404 sequence not found <a href="index.php?action=game&direction=adventureChoseGameView">Retry to play sequence</a>');
		exit;
	}
	//prendre la sequence en fonction de num game et progression
	$WhichSequence = selectAlgo('sequence',0,'idGame',$_GET['sequence']);
	$sequenceToPlay = classifyAlgo($WhichSequence);
	//$seqProgReq = selectAlgo('resolutiongame',0,'idGame',lastIdGameUser($_SESSION['idUser']));
	//$seqProgUser = $seqProgReq->fetch();
	$seqProgUser = getProgressOfGame($_SESSION['idUser'],lastIdGameUser($_SESSION['idUser']));

	switch($seqProgUser)
	{	
		case 0:
		header('Location:index.php?action=game&direction=play&numSequence='.$sequenceToPlay[0]['id']);
		exit;
			break;
		case 25 :
		header('Location:index.php?action=game&direction=play&numSequence'.$sequenceToPlay[1]['id']);
		exit;
			break;
		case 50 : 
		header('Location:index.php?action=game&direction=play&numSequence'.$sequenceToPlay[2]['id']);
		exit;
			break;
		case 75 :
		header('Location:index.php?action=game&direction=play&numSequence'.$sequenceToPlay[3]['id']);
		exit;
			break;
	}
}

$infoGame = selectAlgoOrderIdAsc('game',0);
$allGames = classifyAlgo($infoGame);
$getProgress = selectAlgoOrderIdAsc('resolutiongame','progression','idUser',$_SESSION['idUser']);
$progressUser = classifyAlgo($getProgress);

if(isset($_GET['gameNumber']) && !empty($_GET['gameNumber']))
{	

	if( $_GET['gameNumber'] > $allGames[count($allGames) - 1]['id'] ||  $_GET['gameNumber'] <= 0 || ($_GET['gameNumber'] > 1 && sizeof($progressUser) < 1) )
	{	

		throw new Exception('Wrong game <a href="index.php?action=game&direction=adventureChoseGameView">Chose an other game</a>');
		exit;
	} else if(count($progressUser) > 1){

		if( $_GET['gameNumber'] > 1 && $progressUser[$_GET['gameNumber'] - 2]['progression'] != 100  )
		{	
			//var_dump($progressUser);
			throw new Exception('Wrong game <a href="index.php?action=game&direction=adventureChoseGameView">Chose an other game</a>');
			exit;
		}
	}

	$infoOfThisgame = selectAlgo('game',0,'id',$_GET['gameNumber']);
	$coordGame = $infoOfThisgame -> fetch();
}

















