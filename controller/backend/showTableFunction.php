<?php
	showtable($_POST['tablename']); 
	function showtable($tabname){ /* La fonction doit pouvoir afficher la table souhaitée */
		require_once(__DIR__."/../../model/backendModel.php");
		$numbcol =0; /* Nombre de colonnes dans table utilisé prochainement*/
		$n=0;/* Pour les numeros de ligne*/
		$arrayid =[];
		$nameArrayColumns=[];/* On initialise le tableau dans lequel on rangera le nom des colonnes*/
		/* Compteur et recuperation noms colonnes */
		$notShowPwd = -1;
		$columnsName = getColumnsName($tabname);
		while($names = $columnsName->fetch()){	
			$nameArrayColumns[] .= $names['COLUMN_NAME']; /* On créé automatiquement un tableau dans lequel on concatène les noms de colonnes */
			$numbcol++;/* compteur de colonnes */
		}

		$infosTab = getInformationsTable($tabname);
		$showTable = getInformationsTable($tabname); 

		/* Récupérer les num d'id et les mettres dans un tableau */
		while($numid = $infosTab->fetch()){
				$arrayid[] .= $numid[$nameArrayColumns[0]]; /* $numid=['idEnigme'] */
		}
		require_once(__DIR__.'/../../view/backend/showTableFunctionView.php');
	}
