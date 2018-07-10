<?php 
require_once('controller/game/forAjaxAlgo.php');

$fields = array('name','description','expectedTime','insOrder','content');

if(isset($_GET['puzzle']) && !empty($_GET['puzzle'])){
	$nbr = htmlspecialchars($_GET['puzzle']);
	if(!is_numeric($nbr)) exit;	//nbr correspond au numero de lenigme passée en get
} else  if($_GET['direction'] == 'algo'){
	require_once('view/game/puzzleTabView.php');
	exit;
}


if($_GET['direction'] == 'playPuzzleAdventure')
{
	$points = selectAlgo('adventure','points','idUser',$_SESSION['idUser']);
	$gp = classifyAlgo($points);
	$pts = $gp[0]['points'];
} else {
	$points = selectAlgo('user','points','id',$_SESSION['idUser']);
	$gp = classifyAlgo($points);
	$pts = $gp[0]['points'];
}

//recup nom joueur
$nameReq = selectAlgo('user','login','id',$_SESSION['idUser']);
$nameUser = $nameReq->fetch();
//recup les points du joueur

//recup les instructions
$get = selectAlgo('puzzle',$fields,'id',$nbr);
$getInfos = classifyAlgo($get);
$ins = getIns($getInfos[0]['content']);

//pour la gamesidebar
$tab = array('Score : ','Ranking : ','Remaining time : ');

$srcImg = array('public/image/rscore.png','public/image/crown.png','public/image/hourglass.png');
//recupérer title and entitle
$titlesPuzzle = selectAlgo('puzzle',0,'id',$nbr);
$titlePuzzle = classifyAlgo($titlesPuzzle);
$entitle = $titlePuzzle[0]['description'];
$puzzleTitle = $titlePuzzle[0]['name'];
$puzzleSecond = $titlePuzzle[0]['expectedTime'];

$tab2 = array($pts.' points','',$puzzleSecond .'s');
//scripts
//$arrayL = array('algoVar','algoPosition','algoCreate','algoLose','algoTime','algoMove','algoVerifResult','algoWin','algoGame','welcomeGame');

function GameSidebar($first,$second,$imgSrc)
{
	for ($i=0; $i < sizeof($first) ; $i++) { ?>
		<div class="row pl-5">	
			<img src=<?=$imgSrc[$i];?> id="imgGame">
			<p class=" text-light text-left  pt-3 pl-3" id="pGame"><?=$first[$i];?></p>						
		</div>
		<?php if($i == 2){ ?>
				<p class="text-light text-center pb-2 font-weight-bold" id="pGameS"><?=$second[$i];?></p>		
		<?php } else { ?>
				<p class="text-light text-center pb-3 font-weight-bold"><?=$second[$i];?></p>
		<?php } ?> 

	<?php }
} 



