<?php
require_once('model/usersModel.php');
require_once('controller/mainVerif.php');
require_once('controller/users/verification.php');

$error = NULL;
$surePost = [];
$step;
$arrayErrorsI = arrayErrorsInscription();

for($step = 1; $step < 6 && empty($error); $step++){
	switch($step) {
		case 1: //check if each $_POST['$key'] is empty
			$error = verifPostEmpty($arrayErrorsI); //mainVerif.php
			break;
		case 2: //put each $_POST in htmlspecialchars and verif if mail exist
			$surePost = postWithSpecialChars($_POST);// verification.php
			$error = errorIfMailExist($surePost['mail']);//verification.php
			break;
		case 3: //verif if pwd and pwd2 is the same
			$error = verifPasswords($surePost['password'], $surePost['password2']);
			break;
		case 4: //verif if mail respect RFC822
			$surePost['password'] = cryptage($surePost['password']);
			$error = verifValidMail($surePost['mail']);//in verification.php for verif if mail is valid.
			break;
		case 5://insert new user in db
			insertNewUser($surePost['login'],$surePost['mail'],$surePost['password']);
			break;
		default:
			throw new Exception("Error of coding at verifInscription.php");
	}
}

function arrayErrorsInscription(){
	$errors = [
	'login' => 'Incomplete login',
	'mail' => 'Incomplete e-mail',
	'password' => 'Incomplete password',
	'password2' => 'Incomplete 2nd password'
	];
	return $errors;
}