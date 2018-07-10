$(function() {
	//click for add comment in the topic
	$('#changeCommentary').on('click', '#buttonComment',function() {
		if (confirm("Do you confirm your comment ?")) {
			var showError = null;
			var grandparent = null;

			unsetErrorComment();
			showError = checkDescription(this);

			if(!showError) {
		    	var contentCom = $('#textComment').val(); //commentaryListView.php
		    	var idComment = $('#changeCommentary h4').attr('value');

				$.post({
					data: {description : contentCom, idCommentary: idComment},
					url: 'controller/forum/topic/verifComment.php',
					dataType: 'json',
					timeout: 7000,
					success: function(data) {
						console.log(data);
						showComment(data);
					 	unsetErrorComment();
					 	modifyToRegisterComment();
					},
					error: function() {
					 	console.log('The request for the comment did not succed');
					}
				});
			}
		}
	});
});

function unsetErrorComment() {

	if($("#commentError")) {
		$("#commentError").remove();
		$("#textComment").removeClass('border-danger');
	}
}

//check description and if error, put text error in red
function checkDescription(button) {
	var elementError = null;
	var description = $('#textComment').val();
	var error = checkTextValue(description, 1, 500);

	if(error) {
		grandparent = $(button).parent().parent();
		elementError = document.createElement('div');
		$(elementError).addClass('text-danger').attr('id', 'commentError');
		$(elementError).append(error);
		$('#textComment').addClass('border-danger'); //border of textarea become red
		putElementToParent(elementError, grandparent);
	}
	
	return elementError;
}

function checkTextValue(value, minLength, maxLength){
	var error = 0;
	var concatChar = '';

 	if(!checkTextLengthMin(value, minLength)) {
 		if(minLength < 2 && minLength >= 0){
 			concatChar = ' character';
 		} else if(minLength >= 2){
 			concatChar = ' characters';
 		} else {
 			concatChar = '... the length is below zero. You like to tamper codes.'
 		}
 		error = 'It takes at least ' + minLength + concatChar;
 	}
 	if(!checkTextLengthMax(value, maxLength)) {
 		error = 'Il takes at most ' + maxLength + ' characters.';
 	}
 	return error;
}

function checkTextLengthMin(value, minLength){
	return value.length >= minLength;
}

function checkTextLengthMax(value, maxLength){
	return value.length <= maxLength;
}

function putElementToParent(element, parent) {
	$(parent).addClass('d-flex justify-content-start align-items-center');
	$(parent).append(element);
}

function showComment(comment) {
	var firstComment = $('article a')[0]; //first comment of the topic

	if($("div:hidden")[0] !== undefined) {
		
		if(comment.error){
			showError(comment.error);
		} else if(!isNaN($(firstComment).attr("value"))) {
			$("p[class='p-2']").text("Don't cheat the HTML code please QQ. Your comment is add anyway.");
		} else {
			showFirstComment(comment);
		}
	} else {
		if(comment.update != 1) {
			addNewComment(comment);
		}else{
			replaceComment(comment);
		}
	}
}

function showError(error){
	var div = document.createElement('div');
	var parent = $('buttonComment').parent();

	$(div).text(error).css('color', 'red');
	$(div).appendTo(parent);

}

function showFirstComment(commentInfos) {
	
	$("div:hidden .user").text(commentInfos.user);
	$("div:hidden .modified span").text(commentInfos.modified);
	$("div:hidden a").attr('id', commentInfos.idComment);
	$("div:hidden .description").text(commentInfos.description);

	$("p[class='p-2']").remove();
	$("div:hidden").removeAttr("hidden");
	$("textarea").val("");
}

function addNewComment(commentInfos) {
	
	var article = $(".comment:last").clone(); //clone() must be use, otherwise the element of before disappear
	var divComment = document.createElement('div');
	console.log(commentInfos.idComment);
	
	$(article).find(".user").text(commentInfos.user);
	$(article).find(".modified span").text(commentInfos.modified);
	$(article).find(".description").text(commentInfos.description);
	$(article).find("a").attr('id', commentInfos.idComment);
	$(article).appendTo("#topicComment");
	$("textarea").val("");

	$(article).appendTo(divComment);
	$(divComment).appendTo('#topicComment');
	$(divComment).addClass("numberComments");
	$(divComment).attr('value', commentInfos.idComment);
}

function replaceComment(commentInfos) {
	var divComment = $('div[value="' + commentInfos.idComment + '"]');
	console.log(commentInfos.idComment);
	console.log($('div[value="' + commentInfos.idComment + '"]'));
	$(divComment).find('.user').text(commentInfos.user);

	$(divComment).find('.modified span').text(commentInfos.modified);
	$(divComment).find('.description').text(commentInfos.description);
	$('textarea').val('');
}