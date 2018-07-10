<?php 
require_once(__DIR__.'/verification.php');
require_once(__DIR__.'/../mainVerif.php');
require_once(__DIR__.'/../../model/gameModel.php');



$fieldsPosts = array($_POST['newPassword'],$_POST['newPassword2'],$_GET['idFind']);
$verifTwoPasswords = verifPost($fieldsPosts);
if(!empty($verifTwoPasswords))
{
	throw new Exception('Error on '.$verifTwoPasswords.' <a href="index.php?action=users&direction=formForgot">Retry</a>');
	exit;	
}

$verifNewPasswords = verifPasswords($_POST['newPassword'], $_POST['newPassword2']);
if($verifNewPasswords != NULL)
{
	throw new Exception('Error on '.$verifNewPasswords.' <a href="index.php?action=users&direction=formForgot">Retry</a>');
	exit;
}
$passwordInsert = cryptage($_POST['newPassword']);

update('user','password',$passwordInsert,'id',$_GET['idFind']);
update('user','confirm',0,'id',$_GET['idFind']);

header('Location:index.php?action=users&direction=connection');

 ?>