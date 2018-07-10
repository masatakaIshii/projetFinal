<?php
require_once(__DIR__.'/../mainVerif.php');
require_once(__DIR__.'/../../model/forumModel.php');
$error = NULL;
$arrayErrors = arrayFieldErrors();
$surePost;
$allSearchTopics = NULL;

for($step = 1; $step < 4 && $error == NULL; $step++){
	switch ($step) {
		case 1:
			$surePost = postWithSpecialChars($_POST);
			$error = verifPostEmpty($arrayErrors);
			break;
		case 2:
			$error = checkIfFieldExist($surePost['searchField']);
			break;
		case 3:
			$allSearchTopics = listTopicsInfosBySearch($surePost['searchField'], $surePost['searchText']);
			
			if(!isset($allSearchTopics) || empty($allSearchTopics)) {
				
				$error = "<div>No result.</div>";
			}
			break;
		default:
			echo "<div>Problem with the list table call by search</div>";
			break;
	}
}


if(isset($error) && !empty($error)) {
	if($error === 'noInput') {
		$allSearchTopics = listTopicsInfosBySearch($surePost['searchField']);
		require_once(__DIR__.'/../../view/forum/forumSearchListView.php');
	} else {
		echo $error;
	}
}else {
	require_once(__DIR__.'/../../view/forum/forumSearchListView.php');
}

//$arrayErrors = arrayFieldError();

function arrayFieldErrors(){
	$errors = [
		'searchText' => 'noInput',
		'searchField' => '<div>Strange, normally it is not empty.</div>'
	];

	return $errors;
}

function checkIfFieldExist($field){
	$rightFields = ['subject.title', 'user.login', 'subject.views', 'subject.description'];
	for($i = 0; $i < count($rightFields); $i++){
		if($field === $rightFields[$i]) {
			return NULL;
		}
	}
	return 'There is no field that is named "' . $field .'"';
}
