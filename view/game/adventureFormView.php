<?php sessionStartWithCondition(); ?>
<?php ob_start(); ?>
<?php $title = 'New adventure'; ?>
<?php require_once('controller/game/adventureControl.php'); ?>

<body class="bg-light">
	<h1 id="newAdventureH1" class="text-center pb-5"><?='Let\'s get started '. $nameUser['login'] .' !';?></h1>
	<div class="container-fluid">
		<form method="POST" id="adventureForm" onsubmit="return false" action="index.php?action=game&amp;direction=newAdventureConfirm">
			<div class="row col-sm-12 pb-5">
				<div class="form-group col-sm-4 pr-5">
				    <label id="adventureFormLabel" for="newPseudo">How can we call you ?</label>
				    <input type="text" class="form-control col-sm-12" name="newPseudo" id="newPseudo" placeholder="Enter your pseudo" required>
				    <div id="offerPseudo" class="col-sm-12"></div>
				 </div>
				 <div class="form-check form-check-inline pl-5 col-sm-3" id="genderMale">
				 	<img src="public/image/man.png" id="genderAdventureMale">
				 	<input class="form-check-input" onclick="changeGenderImg(this)" type="radio" name="genderAdventure" id="genderMale" value="male" checked>
				 	<label class="form-check-label" id="adventureFormLabel" for="genderMale">I chose to be a man</label>
				 </div>
				 <div class="form-check form-check-inline pl-5 col-sm-3" id="genderFemale">
				 	<img src="public/image/woman.png" id="genderAdventureFemale">				 	
				 	<input class="form-check-input" onclick="changeGenderImg(this)" type="radio" name="genderAdventure" id="genderFemale" value="female">
				 	<label class="form-check-label" id="adventureFormLabel" for="genderFemale">I chose to be a woman</label>
				 </div>
			</div>
			<div class="col-sm-12" id="errorPseudoAdventure"></div>
			<button id="validateAdventure" onclick="confirmNewAdventure()" class="btn btn-danger w-100 p-2  btn-lg border border-light d-block col-sm-12">I'm ready</button>
		</form>		
	</div>

<script src="public/js/jsAdventure/adventureForm.js"></script>
</body>

<?php $content = ob_get_clean(); ?>
<?php require_once('view/game/templateGameWhite.php'); ?>