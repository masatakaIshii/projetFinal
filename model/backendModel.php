<?php
require_once(__DIR__.'/mainModel.php');
//model/backend.php pour les requêtes qui concernent le backoffice

/*Concerne deleteFunction.php*/
function deleteLignWhereId($tabname, $field, $id){
	$db = dbConnect();//dbConnect est dans model/frontend.php
	$deleteLign = $db->prepare('DELETE FROM '. $tabname.' WHERE '.$field.' = '.$id.'');
	$deleteLign->execute();
}

function deleteGameAdventure($idUser)
{
	$db = dbConnect();
	$prep = $db->prepare('DELETE resolution FROM resolution INNER JOIN puzzle ON puzzle.id = resolution.idPuzzle WHERE resolution.idUser = '.$idUser.' AND puzzle.personal = 0');
	$prep->execute();
}
/*Concerne showTableFunction.php*/
function getInformationsTable($tabname){
	$db = dbConnect();
	$infos = $db->prepare('SELECT * FROM '.$tabname.''); /* On prépare la commande que l'on souhaiterai*/

	$infos->execute(); /* On execute la commande préparée, attention à bien mettre la même variable*/
	return $infos;
}

function selectTable($tabName) {
	$db = dbConnect();
	$infoTable;

	$reqTable = $db->prepare('SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = :tabName');
	$reqTable->execute(['tabName' => $tabName]);

	$infoTable = $reqTable->fetch(PDO::FETCH_ASSOC);

	$reqTable->closeCursor();

	return $infoTable;
}

function selectColumnsTypes($tabName, $columns) {
	$db = dbConnect();
	$reqColumnsTypes;
	$columnsTypes;
	$execute;

	$reqColumnsTypes = $db->prepare('SELECT DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = :tabName and COLUMN_NAME = :columns');

	foreach($columns as $key => $value) {
		$reqColumnsTypes->execute([
			'tabName' => $tabName,
			'columns' => $key
		]);
		$execute = $reqColumnsTypes ->fetch();
		$columnsTypes[$key] = $execute[0];
	}

	return $columnsTypes;
}

//attention les champs doivent être dans l'ordre
function insertInDatabase($tabToAdd,$tabName,$nameFields,$inter){	
	$db = dbConnect();
		
	$req = $db->prepare('INSERT INTO '.$tabName.' ('.$nameFields.') VALUES ('.$inter.') ');	
	$req->execute($tabToAdd);
	
	$req->closeCursor();
}