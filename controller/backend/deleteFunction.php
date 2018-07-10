<?php
	require_once('../../model/backendModel.php');
	$field = firstfield($_POST['tablename']);
	 function firstfield($tabname) // tabname est le nom de la table
	{
		$columnsName = getColumnsName($tabname);
		$reqField = $columnsName->fetch(); // on fait qu'un seul fetch pour recup juste le premier champs

		$namefiled = $reqField[0]; // on range le nom dans une variable
		return($namefiled);
		$columnsName->closeCursor();
	}

	deleteLign($_POST['tablename'], $field, $_POST['numid']);
	function deleteLign($table, $field, $idNumber){
		//1re vérification est pour savoir si chaque paramètre est null ou de valeur 0;
		if((!isset($table) || empty($table)) && (!isset($field) || empty($field)) && (!isset($idNumber) || empty($idNumber))){
			//2me vérification est pour savoir si chaque valeur est du bon type
				throw new Exception("Fonction deleteLign dans controller/backend/deleteFunction.php a un problème");
		}else{
			if(is_string($table) || is_string($field)){
				deleteLignWhereId($table, $field, $idNumber);
				echo $table . " et " . $fleid . " et " . $idNumber;
			}
		}
	}
?>

	