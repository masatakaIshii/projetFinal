<?php/* on affiche le tableau */ ?>
<table class="table">
	<!-- Tete du tableau-->
	<thead>
		<tr>				
			<th scope="col-1 col-md-1"></th> <!-- Colonnes qui sert à mettre les bouton-->
				<?php 
					$arrayTabForMail = spaceForButtons($tabname);
					$notShowPwd = showColumnsName($nameArrayColumns, $numbcol, $notShowPwd); 
				?>
		</tr>
	</thead>
	<!-- Corps du tableau-->
	<tbody>			
		<?php showLigns($numbcol, $showTable, $notShowPwd, $arrayid, $tabname, $arrayTabForMail); ?>	
	</tbody>
</table>

<?php
function spaceForButtons($tabname){
	$arrayTabForMail = ['commentary','puzzle','adventure','resolution','report','subject','user','category', 'entrance_test', 'voters', 'sequence'];
	foreach($arrayTabForMail as $value){
		if($value == $tabname){
		?><th scope="col-1 col-sm-1 col-md-1 col-lg-1"></th><?php
		}
	}
	return $arrayTabForMail;
}	

function showColumnsName($nameColumns, $columns, $notShowPwd){
	for ($i = 0; $i < $columns ; $i++) {
		if($nameColumns[$i] != 'password'){ ?>
		<th scope="col"><?= $nameColumns[$i]; ?></th>
		<?php 				
		}else{
			$notShowPwd = $i;
		}
	}
	return $notShowPwd;
}

function showLigns($colunms, $showTable, $notShowPwd, $arrayid, $tabname, $arrayTabForMail){
	$n = 0;
	while($show = $showTable->fetch()) { ?>		
 	<tr> <?php showButtons($arrayid[$n],$tabname, $arrayTabForMail);
		for ($i = 0; $i < $colunms ; $i++) {
			if($i != $notShowPwd) {?>							
			<td><?= $show[$i]; ?></td> <?php 
			}
		} 
		$n++;?>
	</tr>
	<?php 	
	}
}

function showButtons($id, $tabName, $arrayTabForMail){?>

	<td><button id=<?= $id ?> class='btn btn-danger col-12 col-sm-12 col-md-12'>Delete</button></td>
	<?php

	foreach($arrayTabForMail as $value){
		if($tabName == $value){ ?>
			<td><a value=<?= $id ?> class='btn btn-primary text-light col-12 col-sm-12 col-md-12 modifyButton'>Modify</a></td>
			<?php
			break;
		}
	}
}