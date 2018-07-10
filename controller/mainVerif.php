<?php
/*function after form with POST method*/

//Check each $_POST['value'] is value is void in form
function verifPostEmpty($fieldsError){
	
	foreach ($fieldsError as $keys => $value) {
		if(!isset($_POST[$keys]) || empty($_POST[$keys])){
			$error = $value;
			break;
		}
	}
	if(!empty($error)){
		return $error;
	}
}

function verifPost($fieldsError)//the same without keys
{
	foreach ($fieldsError as $value) {
		if(!isset($value) || empty($value))
		{
			$error = $value;
			break;
		}
	}
	if(!empty($error) && isset($error))
	{
		return $error;
	}
}

function postWithSpecialChars($post) {
	$arrayPost = array();
	
	foreach ($post as $key => $value) {
		if(array_key_exists($key, $post)){
			$arrayPost[$key] = htmlspecialchars($post[$key]);
		}
	}

	return $arrayPost;
}

function checkLengthText($text, $minLength, $maxLength, $blockName){
	$error = NULL;
	$length = strlen($text);

	if($length < $minLength){
		$error = 'You must have more than ' . $minlength . ' characters';
	}
	if($length > $maxLength) {
		$error = 'You must have less than ' . $maxLength . ' characters';
	}
	if(!empty($error)){
		$error .= ' in the case ' . $blockName . '.';
	}
	return $error;
}

function dichotomie($array, $checkValue) {
	$maxIndex = count($array) - 1; //max index which decrease if value checkValue is inferior
	$minIndex = 0; //contrary than $maxIndex
	$currentIndex = $maxIndex; //index which determine the variation of max and min index
	$stop = 0; //to stop the iteration

	while($stop == 0){

		$currentIndex = round(($maxIndex + $minIndex) / 2);

		if($maxIndex < $minIndex || $maxIndex == 0) {
			$stop = 1; //in case that checkValue is not in array
		}
		if($array[$currentIndex] == $checkValue) {
			$stop = 2; //checkValue is in array
		} else if($array[$currentIndex] > $checkValue) {
			$maxIndex = $currentIndex - 1;
		} else {
			$minIndex = $currentIndex + 1;
		}
	}

	if($stop == 1) {
		return false;
	} else {
		return true;
	}
}


function checkLengthAndType($value, $type, $minLength, $maxLenght) {
	$errorLengthAndType = NULL;
	
	if(!rightLength($value, $minLength, PHP_INT_MAX)) {
		$errorLengthAndType = "Problem with length.";
	}
	if(gettype($value) !== $type) {
		$errorLengthAndType = "Probleme with type.";
	}

	return $errorLengthAndType;
}

function rightLength($text, $minLength, $maxLength) {
	$length = strlen($text);

	if($length < $minLength || $length > $maxLength) {
		return FALSE;
	}
	return TRUE;
}

function sendJsonError($error) {
	$sendJson['error'] = $error;
	echo json_encode($sendJson);
}

function deleteAllForeignKeyAndId($idFKey, $nameFKey, $tablesContainFKey) {
	$i;
	$length = count($tablesContainFKey);

	for($i = 0; $i < $length; $i++) {

		deleteWhereId($tablesContainFKey[$i], $nameFKey, $idFKey);
	}
}