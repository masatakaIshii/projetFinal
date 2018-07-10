<?php
sessionStartWithCondition();
require_once(__DIR__.'/../../mainVerif.php');
require_once(__DIR__.'/../../../model/forumModel.php');

$errorIdComment = NULL;
$idComment = NULL;

$errorIdComment = allVerifIdComment($idComment);

if(!isset($errorIdComment) || empty($errorIdComment)){
	deleteComment($idComment);
	sendIdCommentToDelete($idComment);
} else {
	sendJsonError($errorIdComment);
}

function allVerifIdComment(&$sureIdComment) {
	$step; //each step of verification
	$error = NULL; //error if verif is not right
	$arrayErrors = ['idCommentary' => 'The id is empty, strange.'];

	for($step = 1; $step < 4 && $error == NULL; $step++) {
		switch ($step) {
			case 1:
				$error = verifPostEmpty($arrayErrors);
				break;
			case 2:
				$sureIdComment = htmlspecialchars($_POST['idCommentary']);
				$error = checkLengthType($sureIdComment);
				break;
			case 3:
				$error = verifyCommentWhereIdUserAndTopic($sureIdComment);
				break;
			default:
				$error = "Problem with the delete function";
				break;
		}
	}

	unset($sureIdComment);
	return $error;
}


function checkLengthType($idComment) {
	$errorLengthAndType = NULL;

	if(!goodLength($idComment, 1, PHP_INT_MAX)) {
		$errorLengthAndType = "Problem with length";
	}
	if(!is_numeric($idComment)) {
		$errorLengthAndType = "Probleme with type";
	}

	return $errorLengthAndType;
}

function goodLength($text, $minLength, $maxLength) {
	$length = strlen($text);

	if($length < $minLength || $length > $maxLength) {
		return FALSE;
	}
	return TRUE;
}

function verifyCommentWhereIdUserAndTopic($idComment) {
	$errorVerify = NULL;
	$allInfosComment = checkCommentWhereIdTopicAndIdUser($idComment, $_SESSION['idTopic'], $_SESSION['idUser']);

	if(!isset($allInfosComment) || empty($allInfosComment)) {
		$errorVerify = "Strange, you want to delete the comment that is not to you.";
	}

	return $errorVerify;
}

function sendIdCommentToDelete($id) {
	$sendJson['id'] = $id;
	echo json_encode($sendJson);
}


function sessionStartWithCondition(){
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
}

