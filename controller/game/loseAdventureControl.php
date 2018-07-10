<?php
if (session_status() == PHP_SESSION_NONE) {
		session_start();
}
require_once(__DIR__.'/../../model/gameModel.php');
require_once(__DIR__.'/../../model/algoModel.php');

require_once(__DIR__.'/../../model/mainModel.php');
require_once(__DIR__.'/../../model/winAlgoModel.php');



if(isset($_POST['timePlaying']) && !empty($_POST['timePlaying']))
{
	$baseTime = returnTimePlay($_SESSION['idUser']);
	$totalTime = $baseTime + $_POST['timePlaying'];
	addingTime('adventure','time',$_POST['timePlaying'],'idUser',$_SESSION['idUser']);
}







