$(function() {
	//modify comment
	$('#topicComment').on('click','a[href="#changeCommentary"]' ,function() {
		var idComment = $(this).attr('id'); //to get id of comment click
		var allInfosOfComment = $(this).closest('article'); // to get all structure of article which is click
		var description = $(allInfosOfComment).find('.description').html(); //description

		unsetModifyChange();
		
		$('#changeCommentary textarea').val($.trim(description)); // because description without trim have lot of space

		$('#changeCommentary h4').text('Modify your comment').attr('value', idComment);//change title
		createModifyButton(idComment);

		createLinkGoBackRegister(idComment); 
		createDeleteButton(idComment);
	
		$('#backToRegister').on('click', function() {
			modifyToRegisterComment();
		});	
	});

});

function createModifyButton(id) {

	$('#changeCommentary a').text('Modify').removeClass('text-primary').addClass('text-success');//
	$('#changeCommentary a').attr('href', '#' + id);
}

/*create button to reset to register new comment*/
function createLinkGoBackRegister() {
	var goBackButton = $('#changeCommentary a').clone();
	var parent = $('#changeCommentary a').parent();
	
	$(goBackButton).text('Go back to register').removeClass('text-success').addClass('text-primary');
	$(goBackButton).attr('id', 'backToRegister').removeAttr('href');
	$(parent).append(goBackButton);
}							

/*create deleteButton*/
function createDeleteButton() {
	var deleteButton = $('#changeCommentary a').clone()[0];
	var grandPa = $('#changeCommentary a').parent().parent();

	$(deleteButton).text('Delete').removeClass('text-success').addClass('text-danger').addClass('mr-2');
	$(deleteButton).attr('id', 'deleteCommentary');
	$(deleteButton).appendTo(grandPa);

}

function unsetModifyChange(){

	if($('#deleteButton')) {
		$('#deleteCommentary').remove();
		$('#backToRegister').remove();
		$('textarea').val('');
	}
}

/*Change all form for register comment*/
function modifyToRegisterComment() {

	$('#buttonComment').text('Register').removeClass('text-success').removeAttr('href').addClass('text-primary');
	$('#changeCommentary h4').removeAttr('value');
	$('#changeCommentary h4').text('Your new comment');
	unsetModifyChange();
}