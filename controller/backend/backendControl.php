<?php

require_once('model/backendModel.php');

function backoffice(){
	if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1){
		if(isset($_GET['direction']) || !empty($_GET['direction'])){
			$directionBack = $_GET['direction'];
			if($directionBack == 'delete'){
				require('controller/backend/deleteFunction.php');
			
			}else if($directionBack == 'showTable'){
				require('controller/backend/showTableFunction.php');
			}
		}else{
			require('view/backend/backofficeView.php');
		}
	}else{
		throw new Exception("probleme avec le paramètre du backoffice");
	}
	
}
