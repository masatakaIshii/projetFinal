<?php
sessionStartWithCondition();
require_once(__DIR__.'/../../mainVerif.php');
require_once(__DIR__.'/../../../model/forumModel.php');

$errors; //array of errors than key of array assoc is attribute
$errorRate; //after the verification, to show error or noting

$errors = ['option' => 'Strange, the option is not selected.'];
$errorRate = verifPostRate($errors, $_POST);

header('Content-Type: application/json');

$sendJson = sendErrorOrRate($errorRate);
echo json_encode($sendJson);


//all verification of Rate
 function verifPostRate($checkErrors) {
 	$error = NULL;
 	$surePost;

	for($step = 1; $step < 5 && $error == NULL; $step++) {
		switch ($step) {
			case 1:
				$surePost = postWithSpecialChars($_POST);
				$error = verifPostEmpty($checkErrors);
				break;
			case 2:
				$error = checkRateAndIdTopicValues($surePost); //check each value if int and good lenght
				break;
			case 3:
				$error = checkIfTopicExist($_SESSION['idTopic']);
				break;
			case 4:
				$error = checkVoters($_SESSION['idUser'], $_SESSION['idTopic'], $surePost['option']);
				break;			
			default:
				$error = "Problem with the verification of rate";
				break;
		}
	}

	return $error;
}

function sendErrorOrRate($errorRate=NULL) {
	$sendValue;
	$rateValue = getInfosById('subject', $_SESSION['idTopic'], 'rate');

	$sendValue = [
		'error' => $errorRate,
		'rate' => $rateValue['rate']
	];

	return $sendValue;
}

function checkIfTopicExist($idTopic) {
	$error; //error
	$allIdTopic; // to get all Topic in ascendant order

	$allIdTopic = getAllOrderBy('subject', 'id', 'id'); // select to get all id of topic in forumModel.php

	if(empty($allIdTopic)) {
		return NULL; // There is not Topic in database
	} else {
		if(dichotomie($allIdTopic, $idTopic)) { //method dichotomis, in controller/mainVerif.php
			$error = NULL;
		} else {
			$error = "Identifiant of the topic that you rate is not present, strange...";
		}
	}
	return $error;
}

//check each value if int and good lenght
function checkRateAndIdTopicValues($post) {
	foreach($post as $key => $value) {
		if(!is_numeric($value)){
			return $key . ' is  not number, strange.';
		}
		if($key == 'option') {
			if(checkLengthText($value, 1, 5, $key)){
				return $key . ' does not the appropriate length.';
			}
		}else {
			if(checkLengthText($value, 1, PHP_INT_MAX, $key)){
				return $key . ' does not the appropriate length.';
			}	
		}
	}

	return NULL;
}

function checkVoters($idUser, $idTopic, $rate) {
	$allIdUserInVoter; //get all id user
	$averageRate = NULL; //array of voters
	$boolUserInVoters = false; //bool to confirm if user vote or not

	$allIdUserInVoter = checkIfUserVoteInTopic($idTopic, $idUser);

	if(!isset($allIdUserInVoter) || empty($allIdUserInVoter)) {
		insertVoter($idUser, $idTopic, $rate);
		$averageRate = getAverageOnePrecise('voters', 'rate', 'idTopic', $idTopic); //model/mainModel.php
		updateWhereId('subject', 'rate', $averageRate[0], $idTopic); //model/mainModel.php
		return NULL;
	} else {
		return 'You have already voted.';
	}
	
}

function sessionStartWithCondition(){
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
}