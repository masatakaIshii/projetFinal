<?php
sessionStartWithCondition(); //function below

require_once('controller/users/usersControl.php');
require_once('controller/backend/backendControl.php');
require_once('controller/game/gameControl.php');
require_once('controller/forum/forumControl.php');
require_once('controller/other/otherControl.php');

try {
	if(isset($_GET['action']) || !empty($_GET['action'])){
		//users
		if($_GET['action'] == 'users'){
			users();
		//game
		}elseif($_GET['action'] == 'game'){
			game();
		//backoffice
		}elseif($_GET['action'] == 'backoffice'){
			backoffice();
		//forum
		}elseif ($_GET['action'] == 'forum') {
			forum(); //controller/forumControl.php
		//classement
		}elseif ($_GET['action'] == 'other') {
			other();
		}else {
			throw new Exception('Problem, there is not action like that. <a href=index.php>Return to the home page</a>');
		}
	}else{ 
		//page d'accueil
		homePage();
	}
}
catch(Exception $e){

	$errorMessage = $e->getMessage();
	require('view/errorView.php');
}
 //pas obligé de fermer la balise de fermeture php d'après la recommandation officielle appelée PSR-2

function sessionStartWithCondition(){
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
}