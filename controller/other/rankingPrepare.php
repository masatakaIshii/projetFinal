<?php
require_once('model/otherModel.php');

$getResolution = getResolutionWithoutFKey();

$columnsRank = columnArrayAssoc($getResolution[0]);
function columnArrayAssoc($arrayAssoc){
	$columns = [];
	$index = 0;

	foreach($arrayAssoc as $key => $value) {
		$columns[$index] = $key;
		$index++;
	}

	return $columns;
}

require_once('view/other/rankingView.php');
