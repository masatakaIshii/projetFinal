<?php $title = "backOffice";?>

<?php ob_start(); ?>
<div class="bg-light">
	<div class="container-fluid">
		
	  	<div class="row">
	  	<!-- DEBUT SEPARATION ENTRE SIDEBAR ET CONTENU DU BODY -->    
		   	<section class="col-sm-2 p-0"> 
		      	<nav class="col-auto sidebar-nav bg-dark  nav flex-column" style="height: 100vh;position:fixed;top:0;z-index:10;left:0;" id="sidebar"> 
		      		<div class="sidebar-header pb-4 pt-4 justify-content-center" style="font-size: 25px;background-color: rgba(0,0,0,0);"">
		         		<a class="nav-link text-light text-center font-weight-bold">Back Office</a>
		         	</div>

		         	<div id="btns" class="col-auto p-0 m-0 sidebar-brand mr-auto">
		         		
		          <!-- liste des boutons de la sidebar -->
						<?php sideNameEachTable();?>
						<div class="dropdown-divider"></div>
					</div>		     
		      	</nav>
		  	</section> 
	    <!-- FIN SEPARATION ENTRE SIDEBAR ET CONTENU DU BODY -->
	  		<section class="col-sm-10">
	  			<?php require_once("headerAdmin.php"); ?>	
				
			</section>
			<section class="container d-flex flex-column" id="manageBack">
				<div class="d-flex justify-content-end mb-3" id="showCreateButton"></div>
				<div class="col-auto" id="show"></div> <!-- Div dans laquelle on affiche les tableaux-->
			</section>
		</div>
	</div>
</div>

<?php
function sideNameEachTable(){
	$arrayNav = ['user', 'category', 'commentary', 'puzzle', 'adventure', 'subject','sequence', 'voters', 'resolution', 'resolutiongame', 'test'];

	foreach($arrayNav as $value){ ?>
	<div class="dropdown-divider"></div>			
	<button type="button"  id=<?= $value ?> class="btn btn-dark" style="width:100%;" ><?= ucfirst($value) ?></button><?php 	
	} 	
}

 $content = ob_get_clean();
 ?>

<?php require('template.php'); 