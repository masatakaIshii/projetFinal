<?php 
require_once(__DIR__.'/mainModel.php');
require_once(__DIR__.'/gameModel.php');

function selectAlgo($tabName, $field=0,$fieldcondition='',$condition='')
{
	$db = dbConnect();

	if($field != 0){
		$fieldnames = tabToStringFields($field);
	}
	else {
		$fieldnames = '*';
	}

	if($fieldcondition != '' && $condition != ''){
		$getInfo = $db->query('SELECT '.$fieldnames.' FROM ' . $tabName . ' WHERE '.$fieldcondition.' = '.$condition.' ');
	}
	else {
		$getInfo = $db->query('SELECT '.$fieldnames.' FROM ' . $tabName . '');
	}

	
	return $getInfo;
} 

function selectAlgoOrderIdAsc($tabName, $field=0,$fieldcondition='',$condition='')
{
	$db = dbConnect();

	if($field != 0){
		$fieldnames = tabToStringFields($field);
	}
	else {
		$fieldnames = '*';
	}

	if($fieldcondition != '' && $condition != ''){
		$getInfo = $db->query('SELECT '.$fieldnames.' FROM ' . $tabName . ' WHERE '.$fieldcondition.' = '.$condition.' ORDER BY id ASC');
	}
	else {
		$getInfo = $db->query('SELECT '.$fieldnames.' FROM ' . $tabName . ' ORDER BY id ASC');
	}

	
	return $getInfo;
} 

function classifyAlgo($tabInfo)
{
	$tab = $tabInfo->fetchAll(PDO::FETCH_ASSOC);
	return $tab;
} 

