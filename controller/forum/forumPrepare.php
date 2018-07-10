<?php
$namesCategory = [];

$infoCategory = getInfosCategory(); //forumModel.php
$namesCategory = listPriorityTop($infoCategory, $namesCategory); //f below, for have array of array which contain namesColumns => valuesColumns

$fieldsTopic = ['subject.title' => 'title', 'user.login' => 'user', 'subject.views' => 'views', 'subject.description' => 'description'];

//to empty the session of idTopic
if(isset($_SESSION['idTopic']) && !empty($_SESSION['idTopic'])) {
	unset($_SESSION['idTopic']);
}

/*preparation list of subject*/
$preciseInfosSubject = selectTopicsListWithoutFKeys();

/*preparation list of category (id, nameCategory) for newTopic*/
$infosUserSubject = selectInfosTopicOfUser($_SESSION['idUser']); //function in forumModel.php
if(!isset($infosUserSubject) && empty($infosUserSubject)){
	echo "Not topic for now";
}

require_once('view/forum/forumView.php');
$infoCategory->closeCursor();


//to get list[$id => $name] and priority on top
function listPriorityTop($info, $listNames){
	
	for ($i = 0; $allList = $info->fetch(); $i++){
		if($allList['priority'] == 1){
			$listNames = array_unshift_assoc($listNames, $allList['id'],$allList['name']);

		}else{
			$listNames[$allList['id']] = $allList['name'];
		}
	}
	return $listNames;
}

//put key and value on beginning of array
function array_unshift_assoc($arr, $key, $val) 
{ 
    $arr = array_reverse($arr, true); //inverse order element of array, true mean that conserve index values
    $arr[$key] = $val; 
    $arr = array_reverse($arr, true); 
    return $arr;
}