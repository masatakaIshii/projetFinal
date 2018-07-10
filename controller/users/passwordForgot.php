<?php sessionStartWithCondition();
require_once(__DIR__.'/../mailControl.php');
require_once(__DIR__.'/verification.php');
require_once(__DIR__.'/../../model/gameModel.php');
require_once(__DIR__.'/../../model/algoModel.php');
require_once(__DIR__.'/../../model/usersModel.php');
//mt_rand(0,9);
/*
if(isset($_GET['boolConfirm']) && !empty($_GET['boolConfirm']))
{
	echo'<h1>CHECK YOUR MAIL !</h1>';
	exit;
}*/




if(!isset($_POST['mailForgot']) || empty($_POST['mailForgot']) || verifValidMail($_POST['mailForgot']) != NULL || strlen($_POST['mailForgot']) > 120)
{
	throw new Exception('Mail incorrect syntaxe <a href="index.php?action=users&direction=formForgot">Retry</a>');
	exit;	
}

$isEmailExist = getUserWhereEmail($_POST['mailForgot']);
$mailCount = $isEmailExist->rowCount();

if($mailCount < 1 || !isset($mailCount) || empty($mailCount))
{
	throw new Exception('Mail doesn\'t exist <a href="index.php?action=users&direction=formForgot">Retry</a>');
	exit;
} else {
	$userFind = $isEmailExist->fetch();
}



$keyForPassword ="";
for($i = 0; $i < 4; $i++)
{
	$keyForPassword.= mt_rand(0,9);
}
$cryptKey = cryptage($keyForPassword);
update('user','confirmKey',$cryptKey,'id',$userFind['id']);
$msgMail = 'Hi, we are sorry that you lose your intelligence but don\'t worry we have a solution, click on this link <br> <a href="http://localhost/projetFinal/index.php?action=users&direction=redirectPassword&boolConfirm=1&confKey='.$cryptKey.'&idFind='.$userFind['id'].'">CLICK</a>';
sendMail('sickitgame00@gmail.com',$_POST['mailForgot'],'Forgot your password',$msgMail,'Sick IT prod.');
echo'<h1>CHECK YOUR MAIL !</h1>';








	

