<?php 
sessionStartWithCondition();
require_once('controller/mainVerif.php');
require_once('model/gameModel.php');
require_once('model/mainModel.php');
require_once('controller/game/adventureControl.php');

$arrayValuesPost = array($_POST['newPseudo'],$_POST['genderAdventure']);
$verifPostEmpty = verifPost($arrayValuesPost);
if(!empty($verifPostEmpty))
{
	header('Location:index.php?action=game&error='.$verifPostEmpty);
	exit;
}

if($_POST['genderAdventure'] == 'male')
{
	$genderAdventure = 1;
} else {
	$genderAdventure = 0;
}

if(verifNewPseudo($_POST['newPseudo']) == false)
{
	header('Location:index.php?action=game&error='.'Thanks to enter a pseudo which have between 4 and 9 caracters, without special caracters and letters first.');
	exit;
}

if(existOrNot($getInfoAdventure,'pseudo',htmlspecialchars($_POST['newPseudo'])) == true)
{
	header('Location:index.php?action=game&error='.'Pseudo already taken !');
	exit;
}

if(existOrNot($getInfoAdventure,'idUser',$_SESSION['idUser']) == true)
{
	header('Location:index.php?action=game&error='.'Adventure already started !');
	exit;
}

$adventureToInsert = array(htmlspecialchars($_POST['newPseudo']),$genderAdventure,$_SESSION['idUser']);
$adventureFieldsToInsert=array('pseudo','gender','idUser');

insertInDb($adventureToInsert,'adventure',$adventureFieldsToInsert);
insertInDb(array(0,$_SESSION['idUser'],1),'resolutiongame',array('progression','idUser','idGame'));

header('Location:index.php?action=game&direction=adventureChoseGameView');

function verifNewPseudo($pseudo)
{
	if(preg_match("#^[a-zA-Z]{4,9}[0-9]{0,3}#",$pseudo) != true || preg_match("#[/W]#",$pseudo) == true || strlen($pseudo) > 9 )
	{
		return false;
	}
	return true;
}





 