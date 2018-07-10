<?php 
sessionStartWithCondition();

require_once('model/algoModel.php');
require_once('model/mainModel.php');
/*
$field = array('id','name','description');
$get = selectAlgo('puzzle',$field);
$geget = classifyAlgo($get);
*/
$namesPuzzle = array('id','name','maxPoints');
$namesP = selectAlgo('puzzle',$namesPuzzle,'personal',1);
$names = classifyAlgo($namesP);
/*
function headTable($field){
	
	for ($i=0; $i < sizeof($field) ; $i++) { ?> 
		<th scope="col"><?= $field[$i]; ?></th> 
	<?php }
}

function bodyTable($getInfo, $field)
{	
	
	for ($i=0; $i < sizeof($getInfo) ; $i++) { ?>
		<tr>
		<?php for ($j=0; $j < sizeof($field) ; $j++) { ?>
				<td><a href=<?= "index.php?action=game&amp;direction=algo&amp;puzzle=".($getInfo[$i]['id']);?>><?= utf8_decode($getInfo[$i][$field[$j]]); ?></a></td>
		<?php } ?>
		</tr>

	<?php }
}
*/

function stars($nbStars=0)
{
	if($nbStars == 0){
		for ($i=0; $i < rand(1,5); $i++) { ?>
			<img src="public/image/star.png" id="logoImg">
<?php 	}
	} else {
		for ($i=0; $i < $nbStars ; $i++) { ?>
			<img src="public/image/star.png" id="logoImg">
<?php 	}
	}

}


function donePuzzle($numPuzzle)
{
	$db = dbconnect();
	$get = $db->prepare('SELECT * FROM resolution WHERE idUser = ? AND idPuzzle = ?');
	$get->execute(array($_SESSION['idUser'],$numPuzzle));
	$count = $get->rowCount();
	if($count == 0){
		return 0;
	} else {
		return 1;
	}
}

function displayTab($info)
{
	for ($i=0; $i < sizeof($info); $i++) { ?>
		<div class="row">
<?php	for ($j=0; $j < 4 ; $j++) { 
			if($j == 0){ ?>
				<div class="col-sm-3 d-flex justify-content-center">
					<a id="alogo" href=<?="index.php?action=game&direction=algo&puzzle=".($info[$i]['id']);?>><?=$info[$i]['name'];?></a>
				</div>

	<?php	} else if ($j == 1){ ?>
				<div class="col-sm-4 d-flex justify-content-center">
					<?php stars(); ?>
				</div>

	<?php	} else if ($j == 2){ ?>
				<div class="col-sm-3 d-flex justify-content-center">
					<?php if(donePuzzle($info[$i]['id']) == 0){ ?>
							<p id="plogo"><?=$info[$i]['maxPoints'].' points';?></p>
				<?php	} else { ?>
							<p id="plogo"><?='0 points';?></p>
				<?php	} ?>	
				</div>			

	<?php	} else { ?>
				<div class="col-sm-2 d-flex justify-content-center">
					<?php if(donePuzzle($info[$i]['id']) == 0){ ?>
							<img id="logoImg" src="public/image/cross.png"> 
				<?php	} else { ?>
							<img id="logoImg" src="public/image/validate.png">
				<?php	} ?>
				</div>
	<?php   }
		} ?>
		</div>
		<div class="container-fluid" style="height: 50px;"></div>
	
<?php }

} 

