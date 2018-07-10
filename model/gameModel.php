<?php
function specialChars($tab)
{
	for ($i=0; $i < sizeof($tab) ; $i++) { 
		$tab[$i] = htmlspecialchars(utf8_encode($tab[$i])); // utf8_decode a la recuperation
	}
	return $tab;
}


function insertInDb($tabToAdd,$tabName,$fieldNames=0)//attention les champs doivent être dans l'ordre
{	
	$db = dbConnect();	
	$inter = tabToStringValues($tabToAdd);	

	if($fieldNames == 0){		
		$req = $db->prepare('INSERT INTO '.$tabName.' VALUES ('.$inter.') ');
	}else{
		$nameFields = tabToStringFields($fieldNames);	
		$req = $db->prepare('INSERT INTO '.$tabName.' ('.$nameFields.') VALUES ('.$inter.') ');	
	}

	$req->execute($tabToAdd);

	return $req;
}

function tabToStringFields($fieldNames)
{	
	$length = sizeof($fieldNames);
	$nameFields = '';
	for($i = 0 ; $i < $length ; $i++){// les noms de colonnes avant values
		if($i == $length - 1)
			$nameFields .= $fieldNames[$i];
		else
			$nameFields .= $fieldNames[$i].',';
	}
	return $nameFields;

}

function tabToStringValues($arrayValues)
{	
	$length = sizeof($arrayValues);
	$inter = '';
	for($i = 0 ; $i < $length ; $i++){// les ?,?,? ...
		if($i == $length - 1)
			$inter .= '?';
		else
			$inter .= '?,';
	}
	return $inter;
}


function returnTimePlay($idUser)
{
	$timeReq = selectAlgoOrderIdAsc('adventure',0,'idUser',$idUser);
	$timeDone = classifyAlgo($timeReq);
	return $timeDone[0]['time'];
}

function addingTime($tabName,$field,$timeToAdd,$cond='',$value='')
{
	$db = dbConnect();	
	if($cond == '' || $value == '')
	{
		$up = $db->prepare('UPDATE '.$tabName.' SET '.$field. ' = DATE_ADD('.$field.', INTERVAL '.$timeToAdd.' second )');
	} else {
		$up = $db->prepare('UPDATE '.$tabName.' SET '.$field.' = DATE_ADD('.$field.', INTERVAL '.$timeToAdd.' second ) WHERE '.$cond.' = '.$value.'');
	}

	$up->execute();
}

function update($tabName,$field,$ins,$cond='',$value='')
{
	$db = dbConnect();	
	if($cond == '' || $value == '')
	{
		$up = $db->prepare('UPDATE '.$tabName.' SET '.$field.' = \''.$ins.'\' ');
	} else {
		$up = $db->prepare('UPDATE '.$tabName.' SET '.$field.' = \''.$ins.'\' WHERE '.$cond.' = '.$value.'');
	}

	$up->execute();
}

function updateTwoConditions($tabName,$field,$ins,$cond='',$value='',$cond2='',$value2='')
{
	$db = dbConnect();	
	if($cond == '' || $value == '')
	{
		$up = $db->prepare('UPDATE '.$tabName.' SET '.$field.' = \''.$ins.'\' ');
	} else if($cond2 == '' || $value2 == '') {
		$up = $db->prepare('UPDATE '.$tabName.' SET '.$field.' = \''.$ins.'\' WHERE '.$cond.' = '.$value.'');
	} else {
		$up = $db->prepare('UPDATE '.$tabName.' SET '.$field.' = \''.$ins.'\' WHERE '.$cond.' = '.$value.' AND '.$cond2.' = '.$value2.'');
	}

	$up->execute();
}