<?php $title = 'Connexion'; ?>

<?php ob_start(); ?>
<div class="container">
	<div class="pb-4 pt-2">
		<h1 class="text-center">Sign in</h1>
	</div>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-5">
				<form action="index.php?action=users&amp;direction=verificationConnection" method="post">
					<div class="form-group">
						<label for="loginConnect" class="font-weight-bold">Login :</label>	
						<input class="form-control" name="loginConnect" id="loginConnect" type="text" placeholder="Enter your login">
					</div>

					<div class="form-group">
						<label for="pwdConnect" class="font-weight-bold">Password :</label>	
						<input class="form-control" name="pwdConnect" id="pwdConnect" type="password" placeholder="Enter your password" >
					</div>
					<div class="text-center pb-5">
						<button type="submit" class="btn btn-primary btn-lg btn-block">Connect</button>
					</div>
				</form>
			</div>
		</div>
	</div>	
</div>
	
<?php
if(isset($error)){ 
	if($error == "CI"){
?>
<div class="row justify-content-center">
	<div class="text-center col-md-2">
		<p class="font-weight-bold">This account doesn't exist !</p>
	</div>
	<div class="text-center col-md-2">
		<a class="font-weight-bold" href="index.php?action=users&amp;direction=formForgot">Password forgot ?</a>
	</div>
</div>
<?php 
	}else{ 
?>
<div class="row justify-content-center">
	<div class="text-center col-md-2">
		<p class="font-weight-bold text-danger"><?= $error; ?></p>
	</div>
</div>
<?php
	}
}?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>