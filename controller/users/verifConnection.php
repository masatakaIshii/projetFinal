<?php  
sessionStartWithCondition();
require_once('model/usersModel.php');
require_once('controller/users/verification.php');
//session_start if session_status not exist

$error = NULL;

$arrayErrors = arrayErrorsConnection();//array of errors

for($step = 1; $step < 3  && empty($error); $step++){
	switch ($step) {
		case 1:
			$error = verifPostEmpty($arrayErrors);  //function on verification.php
			break;
		case 2:
			$loginConnect = htmlspecialchars($_POST['loginConnect']);//function on controller/forum/verification.php
			$pwdConnect = htmlspecialchars($_POST['pwdConnect']);
			$pwdConnect = cryptage($pwdConnect);//function on controller/forum/verification.php
			
			$error = verifUserExist($loginConnect,$pwdConnect); //function on verification.php
			break;
		default:
			echo "Error on programmation ";
			break;
	}
}

function arrayErrorsConnection(){
	$errors=array(
		'loginConnect' => "Incomplete login",
		'pwdConnect' => "Incomplete password"
	);
	return $errors;
}