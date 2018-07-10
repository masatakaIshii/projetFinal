<?php sessionStartWithCondition();
require_once(__DIR__.'/../mailControl.php');
require_once(__DIR__.'/verification.php');
require_once(__DIR__.'/../../model/gameModel.php');
require_once(__DIR__.'/../../model/algoModel.php');
require_once(__DIR__.'/../../model/usersModel.php');

if(isset($_GET['boolConfirm']) && !empty($_GET['boolConfirm']) && $_GET['boolConfirm'] == 1 && isset($_GET['idFind']) && !empty($_GET['idFind']) )
{	
	$findUserReq = selectAlgo('user',0,'id',$_GET['idFind']);
	$findUser = $findUserReq->fetch();
	update('user','confirm',1,'id',$findUser['id']);//mettre 1 dans confirm
} else {
	throw new Exception('Fatal error <a href="index.php?action=users&direction=formForgot">Retry</a>');
	exit;
}

if(isset($_GET['confKey']) && !empty($_GET['confKey']))
{
	$userConfKeyReq = selectAlgo('user',0,'confirm',1);
	$userConfKeys = classifyAlgo($userConfKeyReq);	
	for ($i=0; $i < count($userConfKeys) ; $i++) { 
		if($userConfKeys[$i]['confirmKey'] == $_GET['confKey'])
		{	
			$idUserFind = $userConfKeys[$i]['id'];
			header('Location:index.php?action=users&direction=newPassword&idFind='.$idUserFind);
			exit;
		}
	}
	throw new Exception('Fatal error <a href="index.php?action=users&direction=formForgot">Retry</a>');
	exit;	
}