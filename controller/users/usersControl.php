<?php
//concerne la page d'accueil, l'inscription et la connexion
function users(){
	if(isset($_GET['direction']) || !empty($_GET['direction'])){
		$direction = htmlspecialchars($_GET['direction']);

		if($direction == 'logOut' && sessionUserActived('idUser')){
			logOut();

		}else if($direction == 'connection' && !sessionUserActived('idUser')){
			connection();

		}else if($direction == 'newPasswordConfirm' && !sessionUserActived('idUser')){
			newPasswordConfirm();

		}else if($direction == 'redirectPassword' && !sessionUserActived('idUser')){
			redirectPassword();

		}else if($direction == 'passwordForgot' && !sessionUserActived('idUser')){
			passwordForgot();

		}else if($direction == 'newPassword' && !sessionUserActived('idUser')){
			newPassword();

		}else if($direction == 'formForgot' && !sessionUserActived('idUser')){
			formForgot();

		}else if($direction == 'verificationConnection' && !sessionUserActived('idUser')){
			verificationConnection();

		}else if($direction == 'inscription' && !sessionUserActived('idUser')){
			inscription();

		}else if($direction == 'verificationInscription' && !sessionUserActived('idUser')){
			verificationInscription();
		}else{
			selectProblemUser(sessionUserActived('idUser'));
		}
	}else{
		throw new Exception("The second parameter is empty, strange.");
	}
}

function redirectPassword()
{
	require_once('controller/users/redirectPassword.php');
}

function newPassword()
{
	require_once('view/users/newPasswordForm.php');
}


function formForgot()
{
	require_once('view/users/formPasswordForgot.php');
}


//logout of user
function logOut(){
	if(!isset($_SESSION['login']) || empty($_SESSION['login'])){
		throw new Exception('Erreur, probleme a fonction logOut.php !');
	}else{
		require('controller/users/logOut.php');
	}	
}

function passwordForgot()
{
	require_once('controller/users/passwordForgot.php');
}


function newPasswordConfirm()
{
	require_once('controller/users/verifNewPassword.php');
}

//connetion
function connection(){
	//accéder à la page
	require_once('view/users/connectionView.php');
}

function verificationConnection(){
	//verification
	require_once('controller/users/verifConnection.php');
	if(!empty($error)){
		require_once('view/users/connectionView.php');
	}else{
		homePage();
	}
}

function inscription(){
	require_once('view/users/inscriptionView.php');
}

function verificationInscription(){
	require_once('controller/users/verifInscription.php');
	if(!empty($error)){
		require_once('view/users/inscriptionView.php');
	}else{
		require_once('view/users/successinscription.php');
	}
}

function homePage(){
	require_once('view/users/homePageView.php');
}

function sessionUserActived($key){
	if(isset($_SESSION[$key]) && !empty($_SESSION[$key])) {
		return true;
	}else {
		return false;
	}
}

function selectProblemUser($boolSession){
	if($boolSession){
		throw new Exception("You can't access to this page because you are already connected. <a href='index.php'>Return to the home page</a>");
	}else{
		throw new Exception("You are already log out so you can't log out the second time. <a href='index.php'>Return to the home page</a>");
	}
}