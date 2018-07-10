<?php sessionStartWithCondition();
require_once('controller/mainVerif.php');
require_once('model/gameModel.php');
require_once('model/algoModel.php');

$ins = '';
for ($i=0; $i < $_POST['nbr'] ; $i++) { //créer le string des instructions
	if($i == $_POST['nbr'] - 1 )
		$ins .= $_POST['ins'. ($i + 1)];
	else
		$ins .= $_POST['ins'. ($i + 1)] . ":::";// ::: pour séparer instructions
}

$isUserAdminReq = selectAlgo('user',0,'id',$_SESSION['idUser']);
$arrayIsAdmin = $isUserAdminReq->fetch();
$isUserAdmin = $arrayIsAdmin['administrator'];
if($isUserAdmin == 0){
	$tab = array($_POST['title'] ,
		$_POST['entitle'] ,
		$_POST['time'],
		$_POST['answer'],
		$ins,
		1
	);
} else {
	$tab = array($_POST['title'] ,
		$_POST['entitle'] ,
		$_POST['time'],
		$_POST['answer'],
		$ins,
		0
	);
}

$fields = array('name','description','expectedTime','insOrder','content','personal');
$newTab = specialChars($tab);
$verifTab = verifPost($tab);

if (isset($verifTab)){
	require_once('view/game/createPuzzleAlgo.php');
	exit;
} else {
	if($isUserAdmin == 0){
		insertInDb($newTab,'puzzle',$fields);
		require_once('view/game/puzzleTabView.php');
		exit;
	} else {
		insertInDb($newTab,'puzzle',$fields);
		require_once('view/game/adventureChoseGameView.php');
		exit;
	}
	
	
	exit;
}
