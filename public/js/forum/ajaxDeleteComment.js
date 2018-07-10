$(function() {
	//click for delete comment
	$('#changeCommentary').on('click','#deleteCommentary',function() {
		if (confirm("Do you want to delete your comment ?")) {
			var idComment = $('#changeCommentary h4').attr('value');

			$.post({
				data: {idCommentary : idComment},
				url: 'controller/forum/topic/deleteComment.php',
				timeout: 7000,
				success: function(data) {
					console.log(data);
					showErrorOrDeteleComment(data);
					modifyToRegisterComment();
				},
				error: function() {
					console.log('The request for delete comment did not succed');
				}
			});
		}
	});
});

function showErrorOrDeteleComment(data) {
	var objComment = jQuery.parseJSON(data);

	if(objComment.id) {
		//deleteComment(objComment.id);
		location.reload();
	} else if(objComment.id){
		showErrorComment(objComment);
	}
}

function showErrorComment(dataError) {
	var parent = $('#buttonComment').parent();
	var error = document.createElement('div');
	var text;

	if(dataError.error) {
		$(error).text(dataError).addClass('text-danger');
	} else {
		text = "Strange, the request work but don't send something";
		$(error).text(text).addClass('text-danger');
	}
	$(parent).append(error);
}
/*
function deleteComment(dataId) {
	var article = $('#' + dataId.id).closest('article');
	var prevArticle = $(article).prev('article');
	
	if(prevArticle.length === 0) {	
		resetHiddenDiv(article);
	} else {
		$(article).remove();
	}
}

function resetHiddenDiv(article) {
	var div = $(article).closest('div');
	var p = document.createElement('p');
	var parent = $(div).parent();

	$(p).addClass('p-2').text('No comments yet').appendTo(parent);
	$(div).append(parent);

	$(div).attr('hidden', true);
	$(div).find('.user').text('user');
	$(div).find('.modified span').text('modified');
	$(div).find('.description').text('description');
	console.log(div);
}
*/