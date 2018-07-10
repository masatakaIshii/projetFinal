<?php
require_once('model/mainModel.php');

function getResolutionWithoutFKey() {
	$db = dbConnect();
	$getAllRank;

	$reqRank = $db->query('SELECT user.login as user, puzzle.name as puzzle, resolution.time as remaining_time FROM user, puzzle, resolution WHERE user.id = resolution.idUser AND puzzle.id = resolution.idPuzzle ORDER BY resolution.time DESC');
	
	$getAllRank = $reqRank->fetchAll(PDO::FETCH_ASSOC);

	$reqRank->closeCursor();
	return $getAllRank;
}