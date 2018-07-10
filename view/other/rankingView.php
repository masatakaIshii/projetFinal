<?php $title = 'Ranking'; ?>

<?php ob_start(); ?>
<section class="container">
	<table class="table table-sm table-darks">
		<thead>
			<tr>
				<th scope="col"></th>
				<?php showColumns($columnsRank);?>
			</tr>
		</thead>
		<tbody>
			<?php showAllLigns($getResolution);?>
		</tbody>
	</table>
</section>
<?php


function showColumns($columns) {
	$length = count($columns);

	for($i = 0; $i < $length; $i++) {
		?>
		<th scope="col"><?=$columns[$i];?>
		<?php
	}
}

function showAllLigns($dArrayAssoc) {
	$length = count($dArrayAssoc);
	$rankValue;

	for($i = 0; $i < $length; $i++){
		$rankValue = $i + 1;
		?>
		<tr>
			<th scope="row"><?= $rankValue;?></th>
		<?php

		foreach ($dArrayAssoc[$i] as $key => $value) {
			
		 	?>

		 	<td><?= $value; ?></td>
		 	<?php
		 }
		 ?>
		 </tr><?php
	}
}


$content = ob_get_clean();?>

<?php require_once('template.php'); ?>