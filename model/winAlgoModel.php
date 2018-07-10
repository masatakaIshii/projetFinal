<?php
if (session_status() == PHP_SESSION_NONE) {
		session_start();
}

require_once(__DIR__.'/mainModel.php');

function hasAlreadyPoints($iduser,$idPuzzle)
{
	$db = dbConnect();
	$alreadyPoints = $db->prepare('SELECT * FROM resolution WHERE idUser = ? and idPuzzle = ?');
	$alreadyPoints->execute(array($iduser,$idPuzzle));
	$alreadyGetPoints = $alreadyPoints->rowCount();
	return $alreadyGetPoints;
}





