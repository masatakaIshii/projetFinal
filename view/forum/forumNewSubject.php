<section id="newSubject" class="container mt-5">
	<h4>Your new topic</h4>
	<form method="post" action="index.php?action=forum&amp;direction=verification" onsubmit="return validSubjectFields()">
		<div class="form-row">
			<div class="form-group col-md-4 mb-3 mr-3">
				<label for="title">Title</label>
				<input type="text" class="form-control" id="title" name="title" placeholder="Please enter your title" required>
			</div>
			<div class="form-group col-md-4 mb-3">
				<label for="category">Category</label>
				<?php selectNewTopicCategory($namesCategory)?>
			</div>
		</div>
		<div class="form-group">
			<label for="description">Description</label>
			<textarea class="form-control" id="description" rows="7" name="description" placeholder="Please enter your topic's description" required></textarea>
		</div>
		<div class="form-group" id="topicButton">
			<button type="submit" class="btn btn-primary col-3 col-sm-3 col-md-2 col-lg-2">Register</button>
			<?php if(isset($error)){showIfError($error);} ?>
		</div>
		
	</form>
</section>

<?php
function selectNewTopicCategory($names){
	?>
	<select class="form-control custom-select mr-sm-2" id="category" name='category'><?php
	foreach ($names as $key => $value) {
		?><option value=<?= $key;?>><?= $value; ?></option><?php
	}
	?></select><?php
}

function showIfError($error) {
	if(!empty($error)){
	?>
		<div style="color:red;"><?=$error ?></div>
	<?php
	}
}

?>