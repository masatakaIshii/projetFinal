<?php
sessionStartWithCondition();
require_once(__DIR__.'/../mainVerif.php');
require_once(__DIR__.'/../../model/forumModel.php');


$errorIdTopic = NULL;
$idTopic = NULL;

$errorIdTopic = allVerifIdTopic($idTopic);

if(!isset($errorIdTopic) || empty($errorIdTopic)) {
	deleteTopic($idTopic);
	sendIdTopic($idTopic);

} else {
	sendJsonError($errorIdTopic);
}

/*Few verifications of topic*/
function allVerifIdTopic(&$sureIdTopic) {
	$step;
	$error = NULL;
	$arrayErrors = ['idCommentary' => 'The id is empty, strange.'];

	for($step = 1; $step < 4 && empty($error); $step++) {
		switch($step) {
			case 1:
				$error = verifPostEmpty($_POST);
				break;
			case 2:
				$sureIdTopic = htmlspecialchars($_POST['idTopic']);
				$error = checkLengthType($sureIdTopic);
				break;
			case 3:
				$error = verifyTopicWhereIdUser($sureIdTopic);
				break;
			default:
				$error = "Problem with the delete function";
				break;
		}
	}

	unset($sureIdTopic);
	return $error;
}

function verifytopicWhereIdUser($idTopic) {
	$errorVerifTopic = NULL;
	$allInfosTopic = checkTopicWhereIdUser($idTopic, $_SESSION['idUser']);

	if(!isset($allInfosTopic) || empty($allInfosTopic)) {
		$errorVerifTopic = "Strange, you want to delete the topic thatis not to you.";
	}

	return $errorVerifTopic;
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

function deleteTopic($idTopic) {
	$arrayTablesFKey =  ['commentary'];
	deleteAllForeignKeyAndId($idTopic, 'idTopic', $arrayTablesFKey);
	deleteWhereId('subject', 'id',$idTopic);
}

function sessionStartWithCondition(){
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
}

function sendIdTopic($id) {
	$sendJson['idTopic'] = $id;
	echo json_encode($sendJson);
}