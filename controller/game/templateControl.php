<?php 
function script($arrayLink)
{
	for ($i=0; $i < sizeof($arrayLink) ; $i++) { ?>
		<script src=<?php echo'public/js/'.$arrayLink[$i].'.js'?> type="text/javascript"></script>
	<?php }
}
