//function for go back to register form
function goBackToRegister() {
	var h4 = document.querySelector('#newSubject h4');
	var formTag = document.querySelector('#newSubject form');
	var divButton = formTag.querySelector('#topicButton');
	var parent = document.querySelector('#topicButton');

	changeTitle(h4, 'Your new topic');
	changeButtonForm('#newSubject button', 'Register', 'btn btn-primary col-3 col-sm-3 col-md-2 col-lg-2'); //function in modifySubject.js
	cleanFormValues(formTag, 'select, input, textarea');
	goBackUrlAction(formTag, 45);
	resetLink(divButton); //function in modifySubject.js
	removeOnClickInNewTopicNav();
	removeDeleteButton(parent);
}

function changeTitle (heading, newTitle) {
	heading.innerHTML = newTitle;
}

function cleanFormValues(form, selectors) {
	var formValues = form.querySelectorAll(selectors);

	 for(var i = 0; i < formValues.length; i++) {
	 	if (formValues[i].name === 'category') {
	 		cleanSelectedOption(formValues[i]); //function in modifySubject.js
	 	}else if(formValues[i].name === 'description') {
	 		formValues[i].innerHTML = "";
	 	}else{
	 		formValues[i].removeAttribute('value');
	 	}
	 }	
}

function goBackUrlAction(form, index) {
	var actionString;//for get string of action in formTag

	actionString = form.getAttribute('action');
	actionString = actionString.slice(0, index);

	form.setAttribute('action', actionString);
}

function removeOnClickInNewTopicNav() {
	var newTopicNav = document.querySelector('section nav a[href="#newSubject"]');
	newTopicNav.removeAttribute('onclick');
}

function removeDeleteButton(parent) {
	var deleteButton = document.querySelector('#deleteButton');
	console.log(deleteButton);
	parent.removeChild(deleteButton);
	parent.setAttribute('class', 'form-group');
}