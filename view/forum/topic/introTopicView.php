<section class="jumbotron" id="introTopic">
	<div class="container">
		<div class="d-flex justify-content-between">
			<div>
				<h1 id='titleTopic'>Topic : <?=$infosSubject['title']; ?></h1>
				<div class="lead">Description : <?=$infosSubject['description']; ?></div>
				<hr class="my-4">
			</div>
			<a href="index.php?action=forum">Return to forum</a>
		</div>
		<div class="d-flex justify-content-between">
			<div>Modified <strong><?=$infosSubject['modified']; ?></strong></div>
			<div>
				<div>Written by <strong><?=$infosSubject['user']; ?></strong></div>
				<div>The topic concerning the category <strong><?=$infosSubject['category']; ?></strong></div>
			</div>
		</div>
		<div class="d-flex alink-items-center">
			<div class="col-auto my-1">
				<label for="rateTopic" class="mr-sm-2">Rate this topic :</label>
				<div id="contentAllRateParts" class="d-flex align-items-center">
					<div class="mr-2">
						<select class="custom-select mr-sm-2" name="rate" placeholder="Rate this topic">
						<?php rateShow(5);?>
						</select>
					</div>
					<div>
						<button type="button" class="btn btn-warning" id="rateTopic">Rate</button>
					</div>
					<div class="h4 ml-4" id="respondRate">
						<?= checkRate($infosSubject['rate']);?>
					</div>
				</div>	
			</div>
		</div>
	</div>
</section>

<?php

function rateShow($length) {
	for($i = 1; $i <= $length; $i++) {
		if($i == 1) {
		?>
			<option value=<?=$i; ?> selected><?=$i; ?></option>
		<?php
		} else {
		?>
			<option value=<?=$i; ?>><?=$i; ?></option>
		<?php
		}
	}
}

function checkRate($rate) {
	if(isset($rate) && !empty($rate)) {
		?>
		<div>Total rate : <?=$rate;?>/5</div>
		<?php
	} else {
		?>
		<div>Not rated yet</div>
		<?php
	}
}