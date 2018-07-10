<?php
sessionStartWithCondition();
function game(){
	if(isset($_GET['direction']) && !empty($_GET['direction']) && isset($_SESSION['idUser']) && !empty($_SESSION['idUser']))
	{
		if($_GET['direction'] == 'create')
			createAlgo();
		else if ($_GET['direction'] == 'access')
			accessAlgo();
		else if ($_GET['direction'] == 'algo')
			algo();
		else if ($_GET['direction'] == 'verifAlgo')
			verifAlgo();
		else if ($_GET['direction'] == 'adventureHome')
			adventureHome();
		else if ($_GET['direction'] == 'newAdventure')			
			newAdventure();					
		else if ($_GET['direction'] == 'newAdventureConfirm')
			newAdventureConfirm();
		else if ($_GET['direction'] == 'adventureChoseGameView')
			adventureChoseGameView();
		else if ($_GET['direction'] == 'adventureGame')
			adventureGame();
		else if ($_GET['direction'] == 'playAdventure')
			playAdventure();
		else if ($_GET['direction'] == 'play')
			play();
		else if ($_GET['direction'] == 'playPuzzleAdventure')
			playPuzzleAdventure();

	} else if(isset($_GET['error']) && !empty($_GET['error'])){
		require_once('controller/game/adventureControl.php');
		if(existOrNotWithoutKeys($arrayErrors,$_GET['error']) == true){
			throw new Exception($_GET['error'] . '<a href="index.php?action=game&direction=newAdventure">Retry to start a new adventure</a>');
		} else {
			throw new Exception('Empty field <a href="index.php?action=game&direction=newAdventure">Retry to start a new adventure</a>');
		}
	} else {
		require_once('view/game/mainGameView.php');
	}
	
}


function playPuzzleAdventure()
{
	require_once('view/game/playAlgoView.php');
}

function play()
{
	require_once('view/game/sequenceView.php');
}


function playAdventure()
{
	if(!isset($_GET['sequence']) || empty($_GET['sequence']))
	{	
		throw new Exception('404 sequence not found <a href="index.php?action=game&direction=adventureChoseGameView">Retry to play sequence</a>');
	} else {
		require_once('controller/game/choseGameVerif.php');
	}
}


function adventureGame()
{
	if(isset($_GET['gameNumber']) && !empty($_GET['gameNumber'])) 
	{
		require_once('view/game/adventureGameView.php');
	} else
	{
		throw new Exception('Wrong game <a href="index.php?action=game&direction=adventureChoseGameView">Chose an other game</a>');
		exit;
	}
}


function adventureChoseGameView()
{
	require_once('view/game/adventureChoseGameView.php');	
}


function newAdventureConfirm()
{	
	require_once('controller/game/newAdventureVerif.php');
}

function newAdventure()
{	
	require_once('controller/game/adventureControl.php');
	if(existOrNot($getInfoAdventure,'idUser',$_SESSION['idUser']) == true){
		throw new Exception('You have already started !'. '<a href="index.php?action=game&direction=adventureHome">Retry to start a new adventure</a>');
	} else {
		require_once('view/game/adventureFormView.php');
	}
}

function adventureHome()
{
	require_once('view/game/adventureHomeView.php');
}

function createAlgo()
{
	require_once('view/game/createPuzzleAlgo.php');
}

function accessAlgo()
{	
	require_once('view/game/puzzleTabView.php');
}

function algo()
{	
	require_once('view/game/playAlgoView.php');		
}

function verifAlgo()
{
	require_once('controller/game/verifAlgo.php');
}