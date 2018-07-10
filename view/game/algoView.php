<?php 
function getIns($str)// decoupe les ins
	{
		$newStr = preg_split("/:::/", $str);
		return $newStr ; 		
	}

function displayIns($ins)
{	
	$length = sizeof($ins);
	for ($i=0; $i < $length ; $i++) { ?>
		<button id=<?=$i + 1?> class="btn btn-success border border-light d-block col-sm-12"><?= utf8_decode($ins[$i])?></button>
<?php	}
}