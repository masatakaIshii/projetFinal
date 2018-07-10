<?php
require_once('model/forumModel.php');
require_once('controller/mainControl.php');

function forum(){

	if(isset($_SESSION['idUser'])) {
		if(!empty($_GET['direction'])) {
			if($_GET['direction'] == 'verification'){
				require_once('controller/forum/verifForum.php');
				require_once('controller/forum/forumPrepare.php');

			} elseif ($_GET['direction'] == 'subject') {
				require_once('controller/forum/topic/subjectPrepare.php');
				
			} else {
				throw new Exception("There is a problem with the forum direction. Stop trying a nonexistent direction. <a href=index.php>Return to the home page</a>");
			}
		} else {
			require_once('controller/forum/forumPrepare.php');
		}
	} else {
			throw new Exception("You have to connect to access the forum. <a href='index.php?action=users&amp;direction=connection'>Connect</a>");
	}
}