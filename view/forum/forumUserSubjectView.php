<section class="container mt-5" id="tableUserSubject">
	<h4 class="d-inline mr-2">Your topics</h4>
	<h5 class="d-inline">Click to update</h5>
	
	<table class="table table-hover mt-2">
	  <thead>
	    <tr value="fieldsSubject" class="border">
			<th scope="col" class="text-center">#</th>
			<?php showFieldsUserSubject($infosUserSubject) ?>
	    </tr>
	  </thead>
	  <tbody data-link="row" class="rowlink border">
	  	<?php showLignsUserSubject($infosUserSubject) ?>
	  </tbody>
	</table>
</section>

<?php
/*functions showFieldsSubject and showLignsSubject*/

function showFieldsUserSubject($doubleArraySubject){
	if(isset($doubleArraySubject) && !empty($doubleArraySubject)) {
		foreach($doubleArraySubject[0] as $key => $value){
			if ($key !== 'id'){
				?><th scope="col" class="text-center"><?= $key;?></th><?php
			}
		}
	}
}

function showLignsUserSubject($doubleArraySubject){
	$idSubject;
	$showValue;
	
	if(isset($doubleArraySubject) && !empty($doubleArraySubject)) {
		for($i = 0; $i < count($doubleArraySubject); $i++){
			$idSubject = $doubleArraySubject[$i]['id']; ?>
			<tr>
				<th scope="row" class="p-0"><a href='#newSubject' onclick='changeFormSubject(<?=$idSubject;?>)' class="d-block m-0 p-3 text-dark text-center" style="text-decoration:none" value=<?=$idSubject;?>><?= $i + 1;?></a></th>
			<?php
				foreach ($doubleArraySubject[$i] as $key => $value){ 
					if ($key != 'id'){
						if ($key === 'mark'){
							if($value == NULL) {
								$showValue = 'Pas de note';
							} else {
								$showValue = $value . '/5';
							}
						} else {
							$showValue = $value;
						}
						?>
							<td class="p-0 m-0 align-middle border"><a href='#newSubject' onclick='changeFormSubject(<?=$idSubject;?>)' class="d-block m-0 p-0 text-dark text-center" style="text-decoration:none" value=<?=$idSubject;?>><?= $showValue; ?></a></td>
						<?php
					}
				} 
				?>
			</tr> 
			<?php
		}	
	}	
}
