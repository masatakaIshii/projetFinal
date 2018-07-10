<?php
if (session_status() == PHP_SESSION_NONE) {
		session_start();
}
require_once(__DIR__.'/../../model/gameModel.php');
require_once(__DIR__.'/../../model/algoModel.php');
require_once(__DIR__.'/../../model/sequenceModel.php');
require_once(__DIR__.'/../../model/mainModel.php');
require_once(__DIR__.'/../../model/winAlgoModel.php');
require_once(__DIR__.'/sequenceControl.php');
require_once(__DIR__.'/../mailControl.php');

$alreadyGetPoints = hasAlreadyPoints($_SESSION['idUser'],$_POST['numPuzzle']);

if(isset($_POST['timePlaying']) && !empty($_POST['timePlaying']))
{
	addingTime('adventure','time',$_POST['timePlaying'],'idUser',$_SESSION['idUser']);
}

if($alreadyGetPoints < 1)
{
	//recup les pts de lenigme
	$points = selectAlgo('puzzle','maxPoints','id',$_POST['numPuzzle']);
	$gp = classifyAlgo($points);
	$pts = $gp[0]['maxPoints'];
	$arrayPts = array($gp[0]['maxPoints']);

	if(isset($_POST['adv']) && $_POST['adv'] == 1)
	{
		$ptsAdv = selectAlgo('adventure',0,'idUser',$_SESSION['idUser']);
		$ptsUserAdv = $ptsAdv->fetch();

		$goodNumSequence = getSequenceOfPuzzle($_POST['numPuzzle']);
		$goodIdGame = selectGameForSequence($goodNumSequence);

		$getSeqofGame = sequencesOfGame($goodIdGame);
		$verifSeq = $getSeqofGame[0]['id'];
		//prendre progress game du gars
		$progressGameUserNow = getProgressOfGame($_SESSION['idUser'],$goodIdGame);

		if($progressGameUserNow == NULL && $verifSeq != 1)
		{	
			insertInDb(array(25,$_SESSION['idUser'],$goodIdGame),'resolutiongame',array('progression','idUser','idGame'));
			exit;
		}
		//prendre progress adventure du gars
		$progressAdventureUserNow = selectAlgo('adventure',0,'idUser',$_SESSION['idUser']);
		$pAdventure = $progressAdventureUserNow->fetch();	
		if($pAdventure['progress'] == 95)
		{	
			$msgMail = 'We are so happy to see you here '.$ptsUserAdv['pseudo'].' !<br>Now, you can create your <b>own puzzles<b> and <b>share it on Sick IT<b>. The adventure has just begun, so have fun !';			
			$coordUserReq = selectAlgo('user',0,'id',$_SESSION['idUser']);
			$coordUser = $coordUserReq->fetch();
			sendMail('sickitgame00@gmail.com',$coordUser['email'],'Congratulations ! New option available',$msgMail,'Sick IT prod.');
		}

		//var_dump($progressGameUserNow);
		$ppp = $progressGameUserNow + 25;
		updateTwoConditions('resolutiongame','progression',$ppp,'idUser',$_SESSION['idUser'],'idGame',$goodIdGame);//mettre 25 % dans game	
		
		update('adventure','progress',$pAdventure['progress'] + 5,'idUser',$_SESSION['idUser']);//mettre 25 / 5 % dans adventure
		update('adventure','points',$ptsUserAdv['points'] + $pts,'idUser',$_SESSION['idUser']);



	}else {
		//prendre les points déja acquis par lutilisateur
		$userPoints = selectAlgo('user','points','id',$_SESSION['idUser']);
		$usPts = classifyAlgo($userPoints);
		$userPts = $usPts[0]['points'];

		
			$resolutionTab = array($_SESSION['idUser'],$_POST['numPuzzle'],$pts,$_POST['rTime']);//table resolution
		$resolutionFields = array('idUser','idPuzzle','points','time');
		insertInDb($resolutionTab,'resolution',$resolutionFields);	
		update('user','points',$pts+$userPts,'id',$_SESSION['idUser']);// points gagnés par le user
	}	
}



