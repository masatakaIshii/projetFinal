<?php
sessionStartWithCondition();

if(isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {

	require_once(__DIR__.'/../mainVerif.php');
	require_once(__DIR__.'/../../model/backendModel.php');

	$errorTable = NULL;
	$table = NULL;
	$errorTable = allVerifTableinBackend($table);
	$listColumns = NULL;

	if(!isset($errorTable) || empty($errorTable)) {
		$listColumns = fetchColumnsName($table);
		
		require_once(__DIR__.'/../../view/backend/newLignTableView.php');
	} else {
		sendJsonError($errorTable);
	}
} else {
	header('Location:index.php?action=users&direction=logOut');
	exit();
}

function allVerifTableinBackend(&$sureTable) {
	$step;
	$error = NULL;
	$showError = ['tabName' => 'the post for table is empty.'];

	for($step = 1; $step < 4 && $error == NULL; $step++) {
		switch ($step) {
			case 1:
				$error = verifPostEmpty($showError);
				break;
			case 2:
				$sureTable = htmlspecialchars($_POST['tabName']);
				$error = checkLengthAndType($_POST['tabName'], "string", 1, PHP_INT_MAX);
				break;
			case 3:
				$error = checkIfTableExist($sureTable);
				break;
			default:
				$error = "Problem with the delete function";
				break;
		}
	}

	return $error;
}

function checkIfTableExist($table) {
	$error = NULL;
	$getTable = NULL;

	$getTable = selectTable($table);
	if(!isset($getTable) || empty($getTable)) {
		$error = "This table's name doesn't exist.";
	}
	
	 return $error;
}

function fetchColumnsName($table) {
	$columns = [];

	$reqColumns = getColumnsName($table);
	for($i = 0; $exec = $reqColumns->fetch(PDO::FETCH_NUM); $i++){
		$columns[$i] = $exec[0];
	}
	
	return $columns;
}

function sessionStartWithCondition(){
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
}