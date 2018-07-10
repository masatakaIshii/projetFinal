<?php

function other() {

	if(!empty($_GET['direction'])){
		if($_GET['direction'] == 'ranking') {
			require_once('controller/other/rankingPrepare.php');
		} else if ($_GET['direction'] == 'presentation'){
			require_once('view/other/presentationView.php');
		} else if($_GET['direction'] == 'team'){
			require_once('view/other/teamView.php');
		} else {
			throw New Exceiption("You cheat the URL, stop...");
		}
	} else {
		throw New Exception ("You cheat the URL.");
	}
}

