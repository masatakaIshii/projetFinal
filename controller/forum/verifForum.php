<?php
require_once('model/forumModel.php');
require_once('controller/mainVerif.php');

$error = NULL;
$surePost = []; //$_POST with htmlspecialchars
$step; //different step of verification
$arrayErrorsSubject = arrayErrorsNewSubject(); //for put error if post is empty

for($step = 1; $step < 6 && empty($error); $step++) {
	switch($step) {
		case 1: //check if each $_POST['$key'] is empty
			$error = verifPostEmpty($arrayErrorsSubject); //mainVerif.php
			break;
		case 2://put each $_POST in htmlspecialchars and check length of title
			$surePost = postWithSpecialChars($_POST);
			$error = checkLengthText($surePost['title'], 1, 50, 'Titre');//in controller/mainVerif.php
			break;
		case 3://check length of description
			$error = checkLengthText($surePost['description'],1, 1500, 'Description');
			break;
		case 4 ://check if this category exist on db
			$error = checkInfosExistInField('category', 'id', $surePost['category']);
			break;
		case 5://insert new subject on db or update
			if(isset($_GET['updateId']) && !empty($_GET['updateId'])){
 				checkIfIsLoginTopics($surePost, $_GET['updateId'], $_SESSION['idUser']);
			} else {
				insertNewSubject($surePost['title'], $surePost['description'], $_SESSION['idUser'], $surePost['category']);
			}
			break;
		default:
			throw new Exception("Problem in verification of forum. <a href=index.php>Return to the home page</a>");
	}
}

header('Location:index.php?action=forum');

function arrayErrorsNewSubject() {
	$errors = [
		'title' => "The title is empty",
		'category' => "The category is empty",
		'description' => "The description is empty"
	];
	return $errors;
}

function checkInfosExistInField($tabName, $field, $checkValue){
	$allInfos;
	$error = NULL;

	$allInfos = getAllInfoOneField($tabName, $field);
	
	foreach ($allInfos as $value) {
		if($value === $checkValue){
			return NULL;
		}
	}
	$error = "Bizarre, the category sent in form is not present in our site... You are a little tampering. <a href=index.php>Return to the home page</a>";
	return $error;
}

function checkIfIsLoginTopics($post, $getId, $sessionId) {
	$selectIdUser; 	//to get iduser thanks that $getId
	$sureGetId = htmlspecialchars($getId);

	if(is_numeric($sureGetId)){
		$selectIdUser = selectIdUserTopic($sureGetId);
		if (!isset($selectIdUser) || empty($selectIdUser)) {
			throw new Exception("It means, you tried to modify a subject that is not yours. Are not you ashamed ? <a href=index.php>Return to the home page</a>");
		}
		if($selectIdUser['idUser'] == $sessionId) {
			updateTopic($sureGetId, $post['title'], $post['description'], $post['category']);
		} else {
			throw new Exception('You change the method get. Stop doing that PLS. <a href=index.php>Return to the home page</a>');
		}
	} else {
		throw new Exception('Strange, the get caracteristic is not appropriate. <a href=index.php>Return to the home page</a>');
	}
}