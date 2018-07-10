<section id="topicComment" class="container border-top mb-4">
	<h4 class="p-3 border-bottom">Comments</h4>
	<?php
		if(empty($infosAllComments)){
			?><?php
			hiddenComment();
		} else {
			showAllComment($infosAllComments);
		}
	?>
</section>

<?php

function hiddenComment() {
	?>
	<p class="p-2">No comments yet</p>
	<div hidden id='firstComment'>
		<article class="d-flex flex-column border-bottom mb-2 comment">
			<div class="d-flex justify-content-between p-2">
				<div class="d-flex justify-content-start">
					<div class="mr-3 font-weight-bold user">user</div>
					<div class="modified">modified : <span>modified</span></div>
				</div class="p-1">
				<a href="#changeCommentary" class="text-success" value="comment">modify your comment</a>
			</div>
			<div class="p-2 pb-5 mb-3 bg-white description">
				description	
			</div>
		</article>
	</div>
	<?php	
}

//show all comments of a topic
function showAllComment($comments) {
	$length;
	$showComment = [];

	for($i = 0, $length = count($comments); $i < $length; $i++){
		
		?>
		<div class="numberComments" value=<?=$comments[$i]['idCommentary'] ;?>>
			<article class="d-flex flex-column border-bottom mb-2 comment">
				<div class="d-flex justify-content-between p-2">
					<div class="d-flex justify-content-start">
						<div class="mr-3 font-weight-bold user"><?=$comments[$i]['user']; ?></div>
						<div class="modified">modified : <span><?=$comments[$i]['modified'];?></span></div>
					</div class="p-1">
					<?php showLinksUserComments($comments[$i]['idUser'], $_SESSION['idUser'], $comments[$i]['idCommentary']);?>
				</div>
				<div class="p-2 pb-5 mb-3 bg-white description">
					<?= $comments[$i]['description']; ?>
				</div>
			</article>
		</div>
		<?php
	}
}

//create link to modify if the comments are to the user
function showLinksUserComments($check, $idUser, $idComment) {
	if($check == $idUser) {
		?>
		<a href="#changeCommentary" class="text-success" id=<?=$idComment ?> value="comment">modify your comment</a>
		<?php
	}
}