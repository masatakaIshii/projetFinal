<?php sessionStartWithCondition(); ?>
<?php ob_start(); ?>
<?php $title = 'Enter new password';
 ?>

 <div class="container-fluid">
 	<form action=<?="index.php?action=users&direction=newPasswordConfirm&idFind=".$_GET['idFind'];?> method="POST" class="pt-3 pb-3">
 		<div class="form-group">
 			<input class="form-control" type="password" name="newPassword" placeholder="Enter your new password" required>
 			<input class="form-control" type="password" name="newPassword2" placeholder="Confirm your new password" required>
 		</div>
 		<button class="btn btn-info" type="submit" >Confirm new password</button>
 	</form>
 </div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?> 