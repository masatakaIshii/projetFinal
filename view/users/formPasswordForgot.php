<?php sessionStartWithCondition(); ?>
<?php ob_start(); ?>
<?php $title = 'Enter email';
 ?>

 <div class="container-fluid">
 	<form action="index.php?action=users&direction=passwordForgot" class="pt-3 pb-3" method="POST">
 		<div class="form-group">
 			<input class="form-control" type="email" name="mailForgot" placeholder="Enter the mail of your account" required>
 		</div>
 		<button class="btn btn-info" type="submit" >Get email to recuparate your password</button>
 	</form>
 </div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?> 