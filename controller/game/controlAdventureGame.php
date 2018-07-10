<?php sessionStartWithCondition();
require_once('model/algoModel.php');
require_once('model/mainModel.php');
require_once('controller/game/sequenceControl.php');

if(isset($_GET['direction']) && !empty($_GET['direction']) && $_GET['direction'] == 'playPuzzleAdventure' && isset($_GET['puzzle']) && !empty($_GET['puzzle']))
{
	$sequenceOfpuzzle = getSequenceOfPuzzle($_GET['puzzle']);
	if(empty($sequenceOfpuzzle) )
	{
		throw new Exception('404 sequence not found <a href="index.php?action=game&direction=adventureChoseGameView">Retry to play sequence</a>');
		exit;
	}	
	
	verifSeqAccordingToProgression($sequenceOfpuzzle,$progressToNotOvertake,$sequencesGame);
}

