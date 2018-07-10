<?php 
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
require_once(__DIR__.'/../../model/algoModel.php');
require_once(__DIR__.'/../../model/backendModel.php');

if(isset($_GET['req']) && !empty($_GET['req']) )
{
	if($_GET['req'] == 'progress')
	{
		$reqForProgress = selectAlgo('adventure',0,'idUser',$_SESSION['idUser']);
		$percentageProgress = $reqForProgress->fetch();
		echo $percentageProgress['progress'];
		exit;
	}
}


if(isset($_POST['req']) && !empty($_POST['req']) )
{
	if($_POST['req'] == 'deleteAdventure')
	{	
		deleteLignWhereId('adventure', 'idUser', $_SESSION['idUser']);
		//deleteLignWhereId('resolution', 'idUser', $_SESSION['idUser'],);
		deleteGameAdventure($_SESSION['idUser']);
		deleteLignWhereId('resolutiongame', 'idUser', $_SESSION['idUser']);
		exit;
	}
}



