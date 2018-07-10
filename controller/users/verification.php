<?php
require_once('model/usersModel.php');
require_once('controller/mainVerif.php');
require_once('model/algoModel.php');
require_once('model/mainModel.php');

function canCreatePuzzle($idUser)
{
	$db = dbConnect();
	$req = selectAlgo('adventure',0,'idUser',$idUser);
	$verif = $req->fetch();
	if($verif['progress'] < 100){
		return false;
	} else {
		return true;
	}
}
/*verifconnexion.php*/
//Check if user exist on database
function verifUserExist($login, $pwd){
	$verifUser = validUser($login,$pwd); //fonction pour récupérer un booléan si user exist

	if($verifUser === false){
		throw new Exception('The request getUserWhereEmail did\'nt succeed');
		exit;
	}
	$userexist = $verifUser->rowCount();
	if ($userexist != 0) {	
		$user = $verifUser->fetch(PDO::FETCH_ASSOC);
		sessionUser($user);//function in
	}else{
		$error = "CI";
	}
	$verifUser->closeCursor();
	if(!empty($error)){
		return $error;
	}
}

function sessionUser($userTab){
	//session_start if session_status not exist
	if (session_status() == PHP_SESSION_NONE) {
    	session_start();
	}
	$_SESSION['idUser'] = $userTab['id'];
	$_SESSION['login'] = $userTab['login'];
	$_SESSION['pwd'] = $userTab['password'];
	$_SESSION['admin'] = $userTab['administrator'];
}

/*verifconnexion && verifinscription*/
function cryptage($password){
	$salage = 'BYUFVEUBVYUGUKYC';
	return hash('sha512',$password.$salage);
}

function errorIfMailExist($mail) {
	$error = NULL; //return string error
	$verifUser; //for take user who have same mail than $_POST mail
	$userExist = 0; //verif if one or more users exist on $verifUser

	$verifUser = getUserWhereEmail($mail); //request for get info user(s) who have same $_POST['mail']
	if($verifUser === false){
		throw new Exception('The request getUserWhereEmail did\'nt succeed');
		exit;
	}
	$userExist = $verifUser->rowCount();
	if($userExist != 0){
		$error = "Le mail saisi a déjà été utilisé.";
	}

	$verifUser->closeCursor();
	return $error;
}

function verifPasswords($password, $password2) {
	$error = NULL; //return string errors

	if(preg_match('#[a-zA-Z0-9]{8,}#', $password)){
		if($password != $password2) {
			$error = "Les mots de passe ne sont pas identiques.";
		}
	}else{
		$error = "Le mot de passe doit faire plus de 8 caractères";
	}

	return $error;
}

function verifValidMail($mail) {
	$error = NULL; //return string error

	if(!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
		$error = "Le mail est invalide";
	}

	return $error;
}

