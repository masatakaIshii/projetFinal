<?php ob_start(); ?>
<?php $title = 'Create your Puzzle ! '; ?>
<body>
	<h1 class="text-center text-danger">Come here, create your puzzle, it's free !</h1>
	<div class="container-fluid d-flex pt-5">
		<form class="row col-sm-12 pb-3" action="index.php?action=game&amp;direction=verifAlgo" method="POST" onsubmit="return verifFields();">
			<div class="col-sm-12 pb-2 text-center">
				<label for="title"><h3 class="text-center">Title</h3></label>
	  			<input class="form-control" type="text" name="title" placeholder="Title of your puzzle" required>		
			</div>
			<div class="col-sm-3">
				<h4>Number of instructions</h4>
				 <select id="nbI" onclick="createIns();" name="nbr" class="custom-select col-sm-7" required>
				    <option value="" style="display: none;">Choose a number</option>
				    <?php dis(); ?>
				 </select>

			</div>
			<div class="col-sm-3">
				<label for="entitled"><h4>Puzzle's heading :</h4></label>
	  			<textarea class="form-control" rows="5" name="entitle" placeholder="Describe your puzzle" required></textarea> 
			</div>
			<div class="col-sm-3">
				<h4>Resolution time</h4>
	  			 <div class="radio">
				  	<label><input type="radio" name="time" value="30" required>30s</label>
				</div>
				<div class="radio">
				  	<label><input type="radio"  name="time" value="60" required>60s</label>
				</div>
				<div class="radio disabled">
				  	<label><input type="radio" name="time" value="90" required>90s</label>
				</div> 			 
			</div>
			<div class="col-sm-3 justify-content-center">
				<label for="answer"><h4>Order answer :</h4></label>
	  			<input class="form-control" type="text" name="answer" placeholder="Right the instrcutions's right order" required>			 
			</div>
			<div class="col-sm-12" id="ins"></div>
			<div class="pb-3" id="error"></div>
			<button class="btn btn-danger"  type="submit">Submit</button>
		</form>
	</div>
</body>
<?php 
	function dis(){
		for ($i=1; $i < 9 ; $i++) { ?>
			<option  value=<?= htmlspecialchars($i + 1) ?>><?= htmlspecialchars($i + 1) ?></option>
		<?php }
	}
?>
<script src="public/js/jsCreate/createPuzzleAlgo.js"></script>
<?php $content = ob_get_clean(); ?>
<?php require_once('view/users/template.php'); ?>