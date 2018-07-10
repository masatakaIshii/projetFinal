<?php
require_once(__DIR__.'/mainModel.php');

//concern for selection of category in new topic
function getInfosCategory(){
	$db = dbConnect();

	$infosCategory = $db->prepare('SELECT id,name, priority FROM category');
	$infosCategory->execute();

	return $infosCategory;
}

//for show list of topics in forum page via view/forum/forumListSubjectView.php
function selectTopicsListWithoutFKeys() {
	$db = dbConnect();

	$reqListTopics = $db->query('SELECT subject.id as id, subject.title as title, subject.modified as modified, subject.rate as rate, subject.views as views, user.login as user, category.name as category FROM subject, user, category WHERE subject.idUser = user.id AND subject.idCategory = category.id');

	$selectListTopicsNoFKeys = $reqListTopics->fetchAll(PDO::FETCH_ASSOC);
	$reqListTopics->closeCursor();

	return $selectListTopicsNoFKeys;
}

//for insert new topic
function insertNewSubject($title, $description, $idUser, $idCategory){
	$db = dbConnect();

	$insertSubject = $db->prepare('INSERT INTO subject(title, created, modified, views, description, idUser, idCategory) VALUES (:title, NOW(), NOW(), :views, :description, :idUser, :idCategory)');
	$insertSubject->execute([
		'title' => $title,
		'views' => 0,
		'description' => $description,
		'idUser' => $idUser,
		'idCategory' => $idCategory
	]);
	$insertSubject->closeCursor();
}

//for add one view when user see the topic
function addOneViewSubject($id) {
	$db = dbConnect();

	$updateView = $db->prepare('UPDATE subject SET views = views + 1 WHERE id = :id');
	$updateView->execute(['id' => $id]);
	$updateView->closeCursor();
}

//select all precise informations of topic's list
function selectInfosTopicOfUser($id) {
	$reqAllInfos;
	$selectAllInfos;

	$db = dbConnect();

	$reqAllInfos = $db->prepare('SELECT subject.id, subject.title, subject.modified, user.login as user, category.name as category, subject.description FROM subject, user, category WHERE subject.idUser = user.id AND user.id = :id AND category.id = subject.idCategory');
	$reqAllInfos->execute(['id' => $id]);
	$selectAllInfos = $reqAllInfos->fetchAll(PDO::FETCH_ASSOC);
	
	$reqAllInfos->closeCursor();
	return $selectAllInfos;
}

//get idUser of a subject $id
function selectIdUserTopic($id) {
	$reqIdUser;		//request to select idUser
	$getIdUser;		//get IdUser thanks to $id

	$db = dbConnect();

	$reqIdUser = $db->prepare('SELECT idUser FROM subject WHERE id = :idSubject');
	$reqIdUser->execute(['idSubject' => $id]);
	$getIdUser = $reqIdUser->fetch(PDO::FETCH_ASSOC);

	$reqIdUser->closeCursor();
	return $getIdUser;
}

//update topic with its id
function updateTopic($idTopic, $title, $description, $category) {
	$reqUpdateTopic;	//request to update topic

	$db = dbConnect();

	$reqUpdateTopic = $db->prepare('UPDATE subject SET title = :title, description = :description, idCategory = :category, modified = NOW() WHERE id = :id');
	$reqUpdateTopic->execute([
		'title' => $title,
		'description' => $description,
		'category' => $category,
		'id' => $idTopic
	]);

	$reqUpdateTopic->closeCursor();
}

function getAllInfoTopicNoFKey($id) {
	$topicInfos;
	$reqTopicNoFKey;
	$db = dbConnect();

	$reqTopicNoFKey = $db->prepare('SELECT subject.id as id, subject.title as title, subject.modified as modified, subject.rate as rate, subject.description as description, user.login as user, category.name as category FROM subject, user, category WHERE subject.idUser = user.id AND subject.idCategory = category.id AND subject.id = :id');
	$reqTopicNoFKey->execute(['id' => $id]);
	$topicInfos = $reqTopicNoFKey->fetch(PDO::FETCH_ASSOC);

	$reqTopicNoFKey->closeCursor();
	return $topicInfos;
}

//get list of topic compared to search input or not
function listTopicsInfosBySearch($field, $text='') {
	$listTopicsSearch;	//list of show list of topic
	$reqSearchTopic;
	$db = dbConnect();
	
	if(!empty($text)) {
		$reqSearchTopic = $db->prepare('SELECT subject.id as id, subject.title as title, subject.modified as modified, subject.rate as rate, subject.views as views, user.login as user, category.name as category FROM subject, user, category WHERE ' .$field . ' LIKE "%' . $text . '%" AND subject.idUser = user.id AND subject.idCategory = category.id ORDER BY ' . $field);
		$reqSearchTopic->execute();
		
	} else {
		if ($field ==='subject.views') {
		$reqSearchTopic = $db->prepare('SELECT subject.id as id, subject.title as title, subject.modified as modified, subject.rate as rate, subject.views as views, user.login as user, category.name as category FROM subject, user, category WHERE subject.idUser = user.id AND subject.idCategory = category.id ORDER BY ' . $field . ' DESC');
		$reqSearchTopic->execute();
		} else {
			
		$reqSearchTopic = $db->prepare('SELECT subject.id as id, subject.title as title, subject.modified as modified, subject.rate as rate, subject.views as views, user.login as user, category.name as category FROM subject, user, category WHERE subject.idUser = user.id AND subject.idCategory = category.id ORDER BY ' . $field );
		$reqSearchTopic->execute();
		}
	}
	$listTopicsSearch = $reqSearchTopic->fetchAll(PDO::FETCH_ASSOC);
	$reqSearchTopic->closeCursor();

	return $listTopicsSearch;
}

//get all infos of one column order by $order
function getAllOrderBy($tabName, $field, $order) {
	$idTopics = []; //all id of topics
	$i = 0;
	$db = dbConnect();

	$reqTopics = $db->prepare('SELECT ' . $field . ' FROM ' . $tabName . ' ORDER BY ' . $order);
	$reqTopics->execute();
	
	for($i = 0; $reqExecute = $reqTopics->fetch(PDO::FETCH_ASSOC); $i++){
		$idTopics[$i] = intval($reqExecute[$field]); //convert string num to int value
	}

	$reqTopics->closeCursor();
	return $idTopics;
}


function checkIfUserVoteInTopic($idTopic, $idUser) {
	$votersByIdTopic; //All voters who vote specific topic
	$db = dbConnect();

	$reqVoters = $db->prepare('SELECT idUser FROM voters WHERE idTopic = :idTopic AND idUser = :idUser');
	$reqVoters->execute([
		'idTopic' => $idTopic,
		'idUser' => $idUser
	]);
	$votersByIdTopic = $reqVoters->fetchAll(PDO::FETCH_ASSOC);

	$reqVoters->closeCursor();
	return $votersByIdTopic;
}

function insertVoter($idUser, $idTopic, $rate) {
	$db = dbConnect();

	$reqVoter = $db->prepare('INSERT INTO voters (idUser, idTopic, rate) VALUES (:idUser, :idTopic, :rate)');
	$reqVoter->execute([
		'idUser' => $idUser,
		'idTopic' => $idTopic,
		'rate' => $rate
	]);

	$reqVoter->closeCursor();
}

function getAllCommentByIdTopic($idTopic){
	$allCommentOfTopic;
	$db = dbConnect();

	$reqAllComment = $db->prepare('SELECT commentary.id as idCommentary, commentary.description as description, user.login as user, user.id as idUser, commentary.modified as modified FROM commentary, user WHERE user.id = commentary.idUser AND commentary.idTopic = :id ORDER BY commentary.created');
	$reqAllComment->execute(['id' => $idTopic]);
	$allCommentOfTopic = $reqAllComment->fetchAll(PDO::FETCH_ASSOC);

	$reqAllComment->closeCursor();

	return $allCommentOfTopic;
}

function checkCommentWhereIdTopicAndIdUser($idComment, $idTopic, $idUser) {
	$allInfosOfComment;
	$db = dbConnect();

	$reqComment = $db->prepare('SELECT * FROM commentary WHERE id = :idComment AND idTopic = :idTopic AND idUser = :idUser');
	$reqComment->execute([
		'idComment' => $idComment,
		'idTopic' => $idTopic,
		'idUser' => $idUser
	]);

	$allInfosOfComment = $reqComment->fetch(PDO::FETCH_ASSOC);
	
	$reqComment->closeCursor();

	return $allInfosOfComment;
}

//to update description on one comment, call on controller/forum/topic/verifComment.php
function updateDescriptionOfComment($description, $idComment, $idUser, $idTopic) {
	$db = dbConnect();

	$reqUpdateComment = $db->prepare('UPDATE commentary SET description = :description, modified = NOW() WHERE id = :idComment AND idTopic = :idTopic AND idUser = :idUser');
	$reqUpdateComment->execute([
		'description' => $description,
		'idComment' => $idComment,
		'idUser' => $idUser,
		'idTopic' => $idTopic
	]);
	$reqUpdateComment->closeCursor();
}

//to insert comment, call on controller/forum/topic/verifComment.php
function insertComment($description, $idUser, $idTopic) {
	$db = dbConnect();

	$reqInsertComment = $db->prepare('INSERT INTO commentary (description, idUser, idTopic, created, modified) VALUES(:description, :idUser, :idTopic, NOW(), NOW())');
	$reqInsertComment->execute([
		'description' => $description,
		'idUser' => $idUser,
		'idTopic' => $idTopic
	]);
	$reqInsertComment->closeCursor();
}


function selectLastComment($idUser, $idTopic) {
	$lastCommentInfos;
	$db = dbConnect();

	$reqLastComment = $db->prepare('SELECT commentary.id as idComment, commentary.description as description, user.login as user, commentary.modified as modified FROM commentary, user, subject WHERE commentary.idUser = :idUser AND commentary.idTopic = :idTopic AND commentary.idUser = user.id AND commentary.idTopic = subject.id ORDER BY commentary.id DESC LIMIT 1');
	$reqLastComment->execute([
		'idUser' => $idUser,
		'idTopic' => $idTopic
	]);
	$lastCommentInfos = $reqLastComment->fetch(PDO::FETCH_ASSOC);
	$reqLastComment->closeCursor();

	return $lastCommentInfos;
}

function selectCommentOfUser($idComment, $idUser, $idTopic) {
	$commentInfos;
	$db = dbConnect();

	$reqCommentUser = $db->prepare('SELECT commentary.id as idComment, commentary.description as description, user.login as user, commentary.modified as modified FROM commentary, user, subject WHERE commentary.id = :idComment AND commentary.idUser = :idUser AND commentary.idTopic = :idTopic AND commentary.idUser = user.id AND commentary.idTopic = subject.id ');
	$reqCommentUser->execute([
		'idComment' => $idComment,
		'idUser' => $idUser,
		'idTopic' => $idTopic
	]);
	$commentInfos = $reqCommentUser->fetch(PDO::FETCH_ASSOC);
	$reqCommentUser->closeCursor();

	return $commentInfos;
}

function deleteComment($idComment) {
	$db = dbConnect();

	$reqDeleteComment = $db->prepare('DELETE FROM commentary WHERE id = :idComment');
	$reqDeleteComment->execute(['idComment' => $idComment]);

	$reqDeleteComment->closeCursor();
}

function checkTopicWhereIdUser($idTopic, $idUser) {
	$db = dbConnect();
	$infosTopic;

	$reqTopicUser = $db->prepare('SELECT * FROM subject WHERE id = :idTopic AND idUser = :idUser');
	$reqTopicUser->execute([
		'idTopic' => $idTopic,
		'idUser' => $idUser
	]);

	$infosTopic = $reqTopicUser->fetch(PDO::FETCH_ASSOC);

	$reqTopicUser->closeCursor();

	return $infosTopic; 
}