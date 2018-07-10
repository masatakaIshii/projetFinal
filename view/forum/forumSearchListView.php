  <thead>
    <tr class="text-center">
		<th scope="col">#</th>
		<?php showFieldsSubject($allSearchTopics) ?>
    </tr>
  </thead>
  <tbody data-link="row" class="rowlink text-center">
  	<?php showLignsSubject($allSearchTopics) ?>
  </tbody>

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
	$showValue; // 
	
	for($i = 0; $i < count($doubleArraySubject); $i++){
		$idSubject = $doubleArraySubject[$i]['id'];
		?>
		<tr>
			<th scope="row" class="p-3 text-center"><a href='index.php?action=forum&amp;direction=subject&amp;id=<?=$idSubject ?>' class="d-block m-0 p-0 text-dark" style="text-decoration:none"><?= $i + 1;?></a></th>
		<?php
			foreach ($doubleArraySubject[$i] as $key => $value){ 
				if ($key != 'id'){
					if ($key === 'rate'){
						if($value == NULL) {
							$showValue = 'Not yet rated';
						} else {
							$showValue = $value . '/5';
						}
					} else {
						$showValue = $value;
					}
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