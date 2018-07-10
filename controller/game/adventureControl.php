<?php
if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
if(!isset($_SESSION['idUser']) || empty($_SESSION['idUser']))
{	
	require_once('view/game/mainGameView.php');
	exit;
}

require_once(__DIR__.'/../../model/algoModel.php'); 
require_once(__DIR__.'/../../model/mainModel.php'); 
//Pseudo joueur
$nameReq = selectAlgo('user','login','id',$_SESSION['idUser']);
$nameUser = $nameReq->fetch();
//adventure ou pas
$getAdventure = selectAlgo('adventure',0);
$getInfoAdventure = classifyAlgo($getAdventure);


$arrayErrors = array('Thanks to enter a pseudo which have between 4 and 9 caracters, without special caracters and letters first.','Adventure already started !','newPseudo','genderAdventure','Pseudo already taken !');

function existOrNotWithoutKeys($array,$searchValue)
{
	for ($i=0; $i < sizeof($array) ; $i++) { 
		if($array[$i] == $searchValue)
		{
			return true;
		}
	}
	return false;
}

function existOrNot($array,$searchField,$value)
{
	for ($i=0; $i < sizeof($array) ; $i++) { 
		if($array[$i][$searchField] == $value)
		{
			return true;
		}
	}
	return false;
}

