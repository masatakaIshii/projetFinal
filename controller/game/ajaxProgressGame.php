<?php 
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
require_once(__DIR__.'/../../model/algoModel.php');
require_once(__DIR__.'/../../model/mainModel.php');
$arrayInfoProgressBar = selectAlgoOrderIdAsc('resolutiongame',0,'idUser',$_SESSION['idUser']);
$InfoProgressBar = classifyAlgo($arrayInfoProgressBar);
$arrayIdGames = array();


for ($i=0; $i < sizeof($InfoProgressBar) ; $i++) { 
	array_push($arrayIdGames, $InfoProgressBar[$i]['idGame'], $InfoProgressBar[$i]['progression']);
}

echo json_encode($arrayIdGames);


//renvoyer tableau avec les id game et progression d el'iduser

