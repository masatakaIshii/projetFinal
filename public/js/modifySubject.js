function changeFormSubject(idLign) {
	var arrayField = []; //array of field names
	var arrayLignValues = [];	// array of contents of each tag of lign
	var objectSubject = {}; //all info of the selected subject, each property => field:text

	var h4 = document.querySelector('#newSubject h4'); //for change h4 to modify subject
	var tagField = document.querySelectorAll('#tableUserSubject tr[alt="fieldsSubject"] th');
	var tagLign = document.querySelectorAll('#tableUserSubject a[alt="' + idLign + '"]');
	var formTag = document.querySelector('#newSubject form');
	
	arrayField = tagsToTextsArray(tagField);
	arrayLignValues = tagsToTextsArray(tagLign); 
	objectSubject = objectFieldsWithValues(arrayField, arrayLignValues, length);

	changeTitleNewToUpdate(h4, objectSubject.title);
	changeButtonForm('#newSubject button', 'green', 'Update');
	changeFormValues(formTag, objectSubject, 'select, input, textarea');
	addUrlActionForm(idLign, formTag, 45);// to change action adress of form, 45 is basic length of action attribute
	putLinkChangeToNew(formTag); // to back for userto put new topic
	putOnClickInNewTopicNav();
}

//array content text of each tag in arrayTag
function tagsToTextsArray(arrayTag) {
	var arrayText = []; //array with strings
	for (var i = 0; arrayTag[i] != undefined; i++) {
		arrayText.push(arrayTag[i].textContent);
	}

	return arrayText;
}

//object content fieldname's property with value of fields
function objectFieldsWithValues(fields, values) {
	var objectLign = {}; //object content fiedls properties with values
	for(var i = 1; i < fields.length; i++) {
		objectLign[fields[i]] = values[i]; //fields[i] is string so objectLign[fields[i]] is obligation
	}
	return objectLign;
}
//change h4 tag title of the subject to edit
function changeTitleNewToUpdate(heading, title) {
	heading.innerHTML = 'Change your topic "' + title + '"';
}

function changeButtonForm(selector, color, textButton){
	var button;
	button = document.querySelector(selector);
	button.innerHTML = textButton;
	button.style.backgroundColor = color;
}

//for change all input(select and textarea) on form match with subject checked
function changeFormValues(form, objectFields, selectors) {
	var field; //field[i].name is field name(title, category, description) on form
	var formInputs = form.querySelectorAll(selectors);

	for(field in objectFields) {
		for(var i = 0; i < formInputs.length; i++) {
			if(field === formInputs[i].name) {
				if(formInputs[i].name === 'category'){
					cleanSelectedOption(formInputs[i]);
					selectedPreciseOption(formInputs[i], objectFields[field]); 
				}else if(formInputs[i].name === 'description'){
					formInputs[i].innerHTML = objectFields[field];
				}else{
					formInputs[i].setAttribute('value', objectFields[field]);
				}
			}
		}
	}
}

function cleanSelectedOption(select) {
	for(var i = 0; i < select.options.length; i++){
		select.options[i].selected = false; //for clean all selected attribute
	}
}

//to set selected attribute on concerned option in select
function selectedPreciseOption(select, valueOption) {

	for(var i = 0; i < select.options.length; i++){
		
		if(select.options[i].textContent == valueOption) {
			select.options[i].selected = true; //to put attribute on precise option
		}
	} 
}

//for change url of action attribute, for after update topic
function addUrlActionForm(id, form, index) {
	var actionString;//for get string of action in formTag
	var finalAction;//action with concat id = numberIdTopic
	
	actionString = form.getAttribute('action');
	
	if (actionString.indexOf('updateId=', index) != -1){ //45 because without id information, the length of action's string is 45.
		actionString = actionString.slice(0, index); //slice cut other part than parameter range
	}

	finalAction = actionString + '&updateId=' + id;
	
	form.setAttribute('action', finalAction);
}

//to put link for go back to register new topic
function putLinkChangeToNew(form) {
	var newLink;
	var parent;
	
	parent = form.querySelector('#topicButton');

	resetLink(parent);
	newLink = document.createElement('a');
	newLink.setAttribute('href', '#newSubject');
	newLink.setAttribute('onclick', 'goBackToRegister()');
	newLink.setAttribute('style', 'text-decoration: none;');
	newLink.setAttribute('class', 'h-100 d-inline-block align-middle');
	newLink.innerHTML = 'Go back to register';

	parent.appendChild(newLink);
}

//for delete "Go back to register" link if it's already here
function resetLink(parent) {
	var link = parent.querySelector('a');
	if(link != null) {
		parent.removeChild(link);
	}
}

function putOnClickInNewTopicNav() {
	var newTopicNav = document.querySelector('section nav a[href="#newSubject"]');
	newTopicNav.setAttribute('onclick', 'goBackToRegister()');
}