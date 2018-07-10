<?php
$idSubject; //idTopic
$infosSubject; //all informations of one topic
$infosAllComments; //all comments of the topic

/*prepare infos of one subject*/
$idSubject = htmlspecialchars($_GET['id']);
if(!is_numeric($idSubject)){
	throw new Exception("Problem with gthe value of get, don't cheat the value please. <a href=index.php>Return to the home page</a>");;
}

$infosSubject = getAllInfoTopicNoFKey($idSubject);
if(!$infosSubject){
	throw new Exception("There is a problem on a id of topic populated. You are a little nosy. <a href=index.php>Return to the home page</a>");
}

if(!isset($_SESSION['idTopic']) || empty($_SESSION['idTopic'])){
	addOneViewSubject($idSubject);
}
$_SESSION['idTopic'] = $idSubject; //if id of url change, session must match with new id

/*prepare commentary*/
$infosAllComments = getAllCommentByIdTopic($idSubject);

require_once('view/forum/topic/forumSubjectView.php');