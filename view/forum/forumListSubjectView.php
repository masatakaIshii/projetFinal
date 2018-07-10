<section class="container mt-3">
	<table class="table table-hover border" id="tableSubject">
	  <thead>
	    <tr class="text-center">
			<th scope="col">#</th>
			<?php showFieldsSubject($preciseInfosSubject) ?>
	    </tr>
	  </thead>
	  <tbody data-link="row" class="rowlink text-center">
	  	<?php showLignsSubject($preciseInfosSubject) ?>
	  </tbody>
	</table>
</section>

<?php

function showFieldsSubject($doubleArraySubject){
	foreach($doubleArraySubject[0] as $key => $value){
		if ($key !== 'id'){
			?><th scope="co text-center">
				<?= $key;?>
			</th><?php
		}
	}
}

function showLignsSubject($doubleArraySubject){
	$idSubject; //id of subject 
	$showValue; // to show value of rate
	
	for($i = 0; $i < count($doubleArraySubject); $i++){
		$idSubject = $doubleArraySubject[$i]['id'];
		?>
		<tr>
			<th scope="row" class="p-3 text-center"><a href='index.php?action=forum&amp;direction=subject&amp;id=<?=$idSubject ?>' class="d-block m-0 p-0 text-dark" style="text-decoration:none"><?= $i + 1;?></a></th>
		<?php
			foreach ($doubleArraySubject[$i] as $key => $value){ 
				if ($key != 'id'){
					$showValue = conditionsRateShowValue($key, $value);
					?>
						<td class="p-0 align-middle"><a href='index.php?action=forum&amp;direction=subject&amp;id=<?=$idSubject ?>' class="d-block m-0 p-0 text-dark" style="text-decoration:none"><?= $showValue; ?></a></td> 
					<?php
				}
			} 
			?>
		</tr> 
		<?php
	}
}

function conditionsRateShowValue($field, $fieldValue) {
	$contentValue = ''; // the content of rate

	if($field === 'rate') {
		if($fieldValue == NULL) {
			$contentValue = 'Not yet rated';
		} else {
			$contentValue = $fieldValue . '/5';
		}
	} else {
		$contentValue = $fieldValue;
	}

	return $contentValue;
}