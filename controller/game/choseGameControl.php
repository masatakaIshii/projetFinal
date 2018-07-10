<?php 
require_once(__DIR__.'/../../model/choseGameModel.php');
require_once(__DIR__.'/../../controller/game/puzzleTab.php');
require_once(__DIR__.'/../../controller/game/choseGameControl.php');

function displayGames($allInfoGames,$progressUser)
{ 
	for($i = 0 ; $i < sizeof($allInfoGames) ; $i++ )
	{ ?>
	<div class="row"> 
		<div class="col-sm-1 d-flex justify-content-center"> <?php
			if($i == 0) 
			{ ?>
				<a href=<?="index.php?action=game&direction=adventureGame&gameNumber=".$allInfoGames[$i]['id'];?> ><img src="public/image/play.png" id="logoImg"></a> <?php
			} elseif (doneGame($allInfoGames[$i-1]['id']) == 1 && $progressUser[$i-1]['progression'] == 100) {
				//var_dump($allInfoGames[$i-1]['id']);
				?>
				<a href=<?="index.php?action=game&direction=adventureGame&gameNumber=".$allInfoGames[$i]['id'];?> ><img src="public/image/play.png" id="logoImg"></a> <?php
			} ?>
		</div>
		<div class="col-sm-4 d-flex justify-content-center">
			<p  id="gameName"><?=$allInfoGames[$i]['name'];?></p>
		</div>
		<div class="col-sm-3 d-flex justify-content-center">
			<?php stars($allInfoGames[$i]['difficulty']); ?>
		</div>
		<div class="col-sm-4 d-flex justify-content-center">
			<div class="col-sm-12 p-0 bg-light border border-dark">
				<div class="progBar" id=<?="progressBar".$allInfoGames[$i]['id'];?> ><p class="text-center" id="progBar"></p></div>
			</div>
		</div>
	</div>
	<div class="container-fluid" style="height: 50px;"></div>
	 <?php
	}
}
 ?>