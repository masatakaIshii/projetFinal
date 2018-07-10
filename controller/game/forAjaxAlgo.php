<?php
if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
require_once(__DIR__.'/../../model/algoModel.php');
require_once(__DIR__.'/../../model/sequenceModel.php');
require_once(__DIR__.'/../../controller/game/sequenceControl.php');
require_once(__DIR__.'/../../model/sequenceModel.php');
if(isset($_POST['nbr'])){
	//pour recup le bon ordre des ins
	$insOrder = selectAlgo('puzzle','insOrder','id',$_POST['nbr']);
	$order = classifyAlgo($insOrder);
	$nbr = $order[0]['insOrder'];
	//pour recup le temps
	$getTime = selectAlgo('puzzle','expectedTime','id',$_POST['nbr']);
	$time = classifyAlgo($getTime);
	$seconds = $time[0]['expectedTime'];
}

if(isset($_GET['adv']))
{
	$points = selectAlgo('adventure','points','idUser',$_SESSION['idUser']);
	$gp = classifyAlgo($points);
	$pts = $gp[0]['points'];
} else {
	//recup le score des joueurs ! 
	$points = selectAlgo('user','points','id',$_SESSION['idUser']);
	$gp = classifyAlgo($points);
	$pts = $gp[0]['points'];
}

	 
if(isset($_GET['win'])){
	if(isset($_GET['numPuzzle'])){
		//recuperer la sequence du puzzle en cours puis voir si c'est la dernière séquence.
		$isSeqLast = getSequenceOfPuzzle($_GET['numPuzzle']);
		$gameOfSeq = selectGameForSequence($isSeqLast);
		$allSeq = sequencesOfGame($gameOfSeq);

		if($isSeqLast == $allSeq[sizeof($allSeq) - 1]['id'])
		{
			echo $pts.';last';
		} else {
			$seqId = $isSeqLast + 1;
			echo $pts.';'.$seqId;
		}
	} else {
		echo $pts;
	}
} else if(isset($_POST['nbr'])){
	echo $nbr .';'.$seconds.';'.$pts;
}

