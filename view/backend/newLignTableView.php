<div class="container" id="tableContent">
	<h4 class="mb-4">Table : <span><?=$table ;?><span></h4>
	<form class="d-flex justify-content-center">
		<?php
		if($errorTable) {
			?><div class="text-danger"><?=$errorTable; ?></div><?php
		} else {
			showListTable($listColumns);
		}
		?>
	</form>
</div>

<?php

function showListTable($list) {
	$length = count($list); ?>
	<div class="container-fluid">
		<form action="#show"> <?php

		for($i = 1; $i < $length; $i++) {
			?>
			<div class="row col-sm-10">
				<div class="col-sm-2">
					<label for=<?= $list[$i] ?>><?= $list[$i] ?></label>
				</div>
				<div class="col-10 col-sm-8 col-md-6" >
					<input type="text" name=<?= $list[$i] ?> placeholder="Enter <?= $list[$i]?>" id=<?= $list[$i] ?> autocomplete="tel-local">
				</div>
			</div>
			<div style="height: 25px;"></div>
			<?php
		}
		?>  
			<div class="form-group row col-md-5">
				<button type="button" class="btn btn-primary col-md-12" id="insertContents">Insert</button>
			</div>
		</form>
	</div> 
	<?php
}