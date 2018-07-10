<?php $title = 'Inscription'; ?>

<?php ob_start(); ?>
<div class="container">
	<div class="pb-4 pt-2">
		<h1 class="text-center">Create your account</h1>
	</div>

	<div class="row justify-content-center">
		<div class="col-md-5">
			<form action="index.php?action=users&amp;direction=verificationInscription" method="post">
				<div class="form-group">
					<label for="login" class="font-weight-bold">Login :</label>	
					<input class="form-control" name="login" id="login" type="text" placeholder="Choose your login" aria-describedby="aideid">
					<small class="form-text text-muted" id="aideid">
					You login will allow you to sign in with your password</small>
				</div>
				<div class="form-group">
					<label for="email" class="font-weight-bold">E-mail address :</label>	
					<input class="form-control" name="mail" id="email" type="email" placeholder="Enter your e-mail">
				</div>
				<div class="form-group">
					<label for="password" class="font-weight-bold">Password :</label>	
					<input class="form-control" name="password" id="password" type="password" placeholder="Choose your password" aria-describedby="aidemdp">
					<small class="form-text text-muted" id="aidemdp">Don't loose your password !</small>
				</div>
				<div class="form-group" >
					<label for="password2" class="font-weight-bold">Re-enter your password :</label>	
					<input class="form-control" name="password2" id="password2" type="password" placeholder="Enter the same password">
				</div>
				<div class="text-center pb-5">
					<button type="submit" class="btn btn-danger btn-lg btn-block">Confirm !</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php if(isset($error) ){
	?>
<div class="row justify-content-center">
	<div class="text-center col-md-2">
		<p class="font-weight-bold"><?= htmlspecialchars($error); ?></p>
	</div>
</div>
<?php } ?>
<?php $content = ob_get_clean(); ?>

<?php require_once('view/users/template.php'); ?>