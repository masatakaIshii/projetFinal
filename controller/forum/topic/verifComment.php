<?php
sessionStartWithCondition();
require_once(__DIR__.'/../../mainVerif.php');
require_once(__DIR__.'/../../../model/forumModel.php');

$errors; //array of errors than key of array assoc is attribute
$errorNewComment; //after the verification, to show error or noting

$errors = prepareCommentErrors();

$errorNewComment = verifPostComment($errors);

if(isset($errorNewComment) && !empty($errorNewComment)) {
	sendCommentError($errorNewComment);
} else {
	inserOrUpdateComment($_SESSION['idTopic'], $_SESSION['idUser']);
}


function inserOrUpdateComment($idTopic, $idUser) {
	
	$sureIdComment; //post comment with special chars
	$sureDescription = htmlspecialchars($_POST['description']); //post description with special chars
	$allInfoOfComment;

	if(isset($_POST['idCommentary']) && !empty($_POST['idCommentary'])) {
		$sureIdComment = htmlspecialchars($_POST['idCommentary']);
		updateDescriptionOfComment($sureDescription, $sureIdComment, $idUser, $idTopic); //model/forumModel.php l.213
		$allInfoOfComment = selectCommentOfUser($sureIdComment, $idUser, $idTopic);//model/forumModel.php l.253
		$allInfoOfComment['update'] = 1;
	} else {
		insertComment($sureDescription, $idUser, $idTopic);//model/forumModel.php l.225
		$allInfoOfComment = selectLastComment($idUser, $idTopic);//model/forumModel.php l.
	}

	sentCommentInfosToJson($allInfoOfComment);
}

function sentCommentInfosToJson($commentInfos) {

	
	$commentInfos['description'] = htmlspecialchars_decode($commentInfos['description']); //for decode htmlspecial chars
	$sendJson = $commentInfos;

	header('Content-Type: application/json');
	echo json_encode($sendJson);
}

function sendCommentError($errorComment) {
	$sendJson = ['error' => $errorComment];

	header('Content-Type: application/json');
	echo json_encode($sendJson);
}

//all verification of comment
function verifPostComment($checkErrors) {
	$error = NULL;
	$surePost;

	for($step = 1; $step < 4 && $error == NULL; $step++) {
		switch ($step) {
			case 1:
				$surePost = postWithSpecialChars($_POST);
				$error = verifPostEmpty($checkErrors);
				break;
			case 2:
				$error = checkLengthText($surePost['description'], 1, 5000, 'description'); //check length of $_POST['description'], url: controller/mainVerif.php
				break;
			case 3:
				$error = checkSessionIdTopic($_SESSION['idTopic']);
				break;
			case 4 :
				if(isset($surePost['idCommentary'])) {
					$error = checkIfCommentMatchWithUserTopic($surePost['idCommentary'], $_SESSION['idTopic'], $_SESSION['idUser']);
				}
				break;
			default:
				$error = "Problem with the verification of rate";
				break;
		}
	}

	return $error;
}

function checkIfCommentMatchWithUserTopic($idComment, $sessionTopic, $sessionUser) {
	$errorComTopicUser;
	$checkMatchComTopicUser = checkCommentWhereIdTopicAndIdUser($idComment, $sessionTopic, $sessionUser);// to check if idcomment correspond that session id of topic and user, url: model/forumModel.php
	if(empty($checkMatchComTopicUser)) {
		$errorComTopicUser = "There is a probleme with the comment that you want to update.";
	}

	return $errorComTopicUser;
}

function checkSessionIdTopic($idTopic) {
	$error; //error
	$allIdTopic; // to get all Topic in ascendant order

	$allIdTopic = getAllOrderBy('subject', 'id', 'id'); // select to get all id of topic in forumModel.php

	if(empty($allIdTopic)) {
		return NULL; // There is not Topic in database
	} else {
		if(dichotomie($allIdTopic, $idTopic)) { //method dichotomis, in controller/mainVerif.php
			$error = NULL;
		} else {
			$error = "IdTopic put in session doesn't exist, strange...";
		}
	}

	return $error;
}

//array for show if each post value is empty
function prepareCommentErrors() {
	$arrayErrors;

	if(isset($_POST['idCommentary'])) {

		$arrayErrors = [
			'description' => 'The description is empty.',
			'idCommentary' =>'Strange, the idCommentary is empty'
		];
	} else {
		$arrayErrors = ['description' => 'The description is empty.'];
	}

	return $arrayErrors;
}

function sessionStartWithCondition(){
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
}