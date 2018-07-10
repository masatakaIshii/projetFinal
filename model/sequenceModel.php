<?php if (session_status() == PHP_SESSION_NONE) {
		session_start();
}
require_once(__DIR__.'/mainModel.php');

function selectGameForSequence($numSequence)
{
	$db = dbConnect();
	$whichGame = $db->prepare('SELECT game.id FROM game,sequence WHERE sequence.idGame = game.id and sequence.id = ?');
	$whichGame->execute(array($numSequence));
	$goodIdGame = $whichGame->fetch();
	return $goodIdGame['id'];
}

function getProgressOfGame($idUser,$idGame)
{
	$db = dbConnect();
	$req = $db->prepare('SELECT resolutiongame.progression FROM resolutiongame WHERE resolutiongame.idUser = ? AND resolutiongame.idGame = ?');
	$req->execute(array($idUser,$idGame));
	$f = $req->fetch();
	return $f['progression'];
}

function sequencesOfGame($idGame)
{
	$db = dbConnect();
	$sequences = $db->prepare('SELECT sequence.id FROM sequence,game WHERE game.id = sequence.idGame AND game.id = ? ORDER BY sequence.id ASC');
	$sequences->execute(array($idGame));
	$seqGame = $sequences->fetchAll(PDO::FETCH_ASSOC);
	return $seqGame;
}