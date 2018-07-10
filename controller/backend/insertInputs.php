<?php
sessionStartWithCondition();

if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {

	require_once(__DIR__.'/../mainVerif.php');
	require_once(__DIR__.'/../../model/backendModel.php');

	$table; // table name of insert
	$errorInputs; //error during verifiration
	$inputs = []; // array assoc contain all inputs with the syntax : $column => $columnValue

	$table = $_POST['tabName'];
	$inputs = $_POST['inputs'];
	$errorInputs = checkInputsValue($table, $inputs);
	if(isset($errorInputs) || !empty($errorInputs)) {
		echo $errorInputs;
	} else {
		prepareToInsert($table, $inputs);
		$_POST['tablename'] = $table;
		require_once(__DIR__.'/showTableFunction.php');
	}
} else {
	header('Location:index.php?action=users&direction=logOut');
	exit();
}

function checkInputsValue($table,$inputs) {
	$errorInputs = NULL;
	$columnsTypes = selectColumnsTypes($table, $inputs); //model/backendModel.php
	
	$errorInputs = checkIfTypeIsRight($inputs, $columnsTypes);

	return $errorInputs;
}

/*To check if value is right*/
function checkIfTypeIsRight($arrayCheck, $arrayTypes) {
	$errorTypes = NULL; 
	$type; // type of arrayCheck
	$emptyCase = 0; // when value of array is empty, ++

	foreach ($arrayCheck as $key => $value) {
		$type = gettype($value);
		
		if(!checkMacthValueType($value, $arrayTypes[$key]) && !empty($value)) {
			$errorTypes = indicationErrorType($key, $arrayTypes[$key]);
			break;
		}
		if(empty($value)) {
			$emptyCase++;
		}
		if($emptyCase > 0){
			$errorTypes = '<div class="text-danger">You have to complete all fields to insert new lign.<div>';
		}
	}
	
	return $errorTypes;
}

/*Check if type match with the value*/
function checkMacthValueType($value, $typeSQL) {
	$right = FALSE;
	if(is_numeric($value)) {
		if((ctype_digit($value) && $typeSQL == 'int') || (preg_match('#^[0-1]$#', $value) && $typeSQL == 'tinyint') || $typeSQL == 'float') {
			$right =  TRUE;
		}
	}
	if(preg_match('#^\d{4}(-\d{2}){2} (\d{2}:){2}\d{2}$#', $value) || $typeSQL == 'datetime') {
		$right = TRUE;
	}
	if(preg_match('#^\d{4}(-\d{2}){2}$#', $value) && $typeSQL == 'date') {
		$right = TRUE;
	}
	if(preg_match('#^(\d{2}:){2}\d{2}$#', $value) && $typeSQL == 'time') {
		$right = TRUE;
	}
	if($typeSQL == 'text' || $typeSQL == 'mediumtext' || $typeSQL == 'varchar') {
		$right = TRUE;
	}
	return $right;
}

function indicationErrorType($fieldError, $typeError) {
	$showError = '<div class="text-danger">You put the wrong value in ' . $fieldError . ' field.</div>';
	$showError .= '<div class="text-danger">You have to put value that respect ' . $typeError . ' type</div>';

	return $showError;
}

function prepareToInsert($tabName, $fieldAndValue) {
	$GLOBALS['stringField'] = '';
	$GLOBALS['interValue'] = '';
	$arrayValue = array_values($fieldAndValue); //to convert array assoc to array num

	tabAssocToStringField($fieldAndValue);
	insertInDatabase($arrayValue ,$tabName, $GLOBALS['stringField'], $GLOBALS['interValue']);
}

function tabAssocToStringField($arrayAssoc){
	$length = count($arrayAssoc);
	$namesKeys = '';
	$namesValues = '';
	$index = 0;

	foreach($arrayAssoc as $key => $value){// les noms de colonnes avant values
		if($index == $length - 1){
			$namesKeys .= $key;
			$namesValues .= '?';
		}
		else{
			$namesKeys .= $key.',';
			$namesValues.= '?,';
		}
		$index++;
	}
	$GLOBALS['stringField'] =  $namesKeys;
	$GLOBALS['interValue'] = $namesValues;
}

function sessionStartWithCondition(){
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
}