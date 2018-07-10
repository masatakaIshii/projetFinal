<?php
require_once('model/mainModel.php');

//modele/users.php contient différentes fonctions pour récupérer des informations dans la BDD

function getInfosLogin($login){
	$db = dbConnect();
	$infoUser = $db->prepare('SELECT * FROM user WHERE login = :login');
	$infoUser->execute();
	return $infoUser;
}

/*Concerne inscription.php*/
function getUserWhereEmail($email){
	$db = dbConnect();
	$user = $db->prepare('SELECT * FROM user WHERE  email = ? ');
	$user->execute(array($email));
	return $user;
}

function insertNewUser($login, $mail, $password){
	$db = dbConnect();
	$insertUser = $db->prepare('INSERT INTO user(login,email,password,creatorMode,administrator,created) VALUES (:login,:email,:password,:creatorMode,:administrator,NOW())');
	$insertUser->execute(array(
		'login' => $login,
		'email' => $mail,
		'password' => $password,
		'creatorMode' => 0,
		'administrator' => 0
	));
	$insertUser->closeCursor();
}

//pour vérifier si l'utilisateur est dans la bdd
function validUser($login,$password){
	$db = dbConnect();
	$verifUser = $db->prepare('SELECT * FROM user WHERE login = ? AND password = ? ');
	$verifUser->execute(array($login, $password));
	return $verifUser;
}