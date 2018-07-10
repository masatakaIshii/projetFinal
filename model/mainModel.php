<?php
//modele/frontend.php content different functions to do actions in database

/*to connect on database*/
function dbConnect(){
	$db = new PDO('mysql:host=localhost;dbname=projetannuel;charset=utf8', 'root', '',array(PDO::ATTR_ERRMODE	=>	PDO::ERRMODE_EXCEPTION));
	if(!isset($db) || empty($db)){
		throw new Exception("problème de dbConnect() à la db dans model.frontend.php");
	}

	return $db;
}

/*To get all informations of one table*/

function getAllInfosTab($tabName, $field){
	$db = dbConnect();
	$allInfo = $db->prepare('SELECT * FROM ' . $tabName . ' ORDER BY $order' . $field);
	$allInfo->execute([]);

	return $allInfo;
}

/*To get all colummn name*/
function getColumnsName($tabname){
	$db = dbConnect();
	// On récupère les noms de champs de la table
	$reqColumnsName = $db->prepare('SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_schema = "projetannuel" AND
		table_name = "'.$tabname.'"'); 
		//Recuperer les nom des attributs d'une table  avec : tabelschema = nombdd, tablename= nomtable
	$reqColumnsName->execute();
	
	return $reqColumnsName;
}

/*To get all informations of one field*/
function getAllInfoOneField($tabName, $field){
	$allInfos = [];

	$db = dbConnect();
	$reqInfosField = $db->prepare('SELECT ' . $field . ' FROM ' . $tabName);

	$reqInfosField->execute();
	
	while($objAllInfos = $reqInfosField->fetch(PDO::FETCH_ASSOC)){
		$allInfos[] = $objAllInfos[$field];
	}

	$reqInfosField->closeCursor();

	return $allInfos;
}

/*to get info of one column by one id of table*/
function getInfosById($tabname, $id, $field = "*"){
	$infosColumn; //all infos of one column
	
	$db = dbConnect();
	$reqOfColumnById = $db->prepare('SELECT ' . $field . ' FROM ' . $tabname . ' WHERE id = ?');
	$reqOfColumnById->execute([$id]);
	$infosColumn = $reqOfColumnById->fetch(PDO::FETCH_ASSOC);
	
	$reqOfColumnById->closeCursor();
	return $infosColumn;
}


/*get all infos in order by id*/
function getAllAscId($tabName) {
	$allIdOrder;

	$db = dbConnect();
	$reqAllId = $db->prepare('SELECT * FROM ? ORDER BY id');
	$reqAllId->execute($tabName);

	$allIdOrder = $reqAllId->fetchAll(PDO::FETCH_NUM);
	
	$reqAllId->closeCursor();
	return $allIdOrder;
}

/*get average of field where field = precise value*/
function getAverageOnePrecise($tabName, $averageField, $field, $fieldValue) {
	$averageValue;

	$db = dbConnect();
	$reqAvg = $db->prepare('SELECT ROUND(AVG(' . $averageField . '), 2) as average FROM ' . $tabName . ' WHERE ' . $field . ' = :value');
	$reqAvg->execute(['value' => $fieldValue]);

	$averageValue = $reqAvg->fetch(PDO::FETCH_NUM);

	$reqAvg->closeCursor();
	return $averageValue;
}

function updateWhereId($tabName, $field, $fieldValue, $id) {
	$db = dbConnect();

	$reqUpdateRate = $db->prepare('UPDATE ' . $tabName . ' SET ' . $field . " = " . $fieldValue . ' WHERE id = :id ');
	$reqUpdateRate->execute(['id' => $id]);
	
	$reqUpdateRate->closeCursor();
}

function deleteWhereId($tabName, $field, $id) {
	$db = dbConnect();

	$reqDeleteId = $db->prepare('DELETE FROM ' . $tabName . ' WHERE ' . $field . ' = :id');
	$reqDeleteId->execute(['id' => $id]);

	$reqDeleteId->closeCursor();
}
