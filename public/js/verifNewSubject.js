function validSubjectFields(){
	var titleInput = document.getElementsByName('title')[0];
	var descriptionText = document.getElementsByName('description')[0];
	var errors = 0;

	if(!confirm("Confirmez-vous votre sujet?")){
		errors++;
	}else{
		resetInput(titleInput);
		resetInput(descriptionText);

		var errorTitle = checkTextValue(titleInput.value, 1, 50);
		if(errorTitle){
			displayError(titleInput, errorTitle);
			errors++;
		}
		
		var errorDescription = checkTextValue(descriptionText.value, 1, 9999);
		if(errorDescription){
			displayError(descriptionText, errorDescription);
			errors++;
		}
	}

	return error == 0;
}

function resetInput(input){
	input.style.borderColor = '';
	var parent = input.parentNode;
	var elements = parent.getElementsByTagName('p');

	if(elements.length > 0){
		parent.removeChild(element[0]);
	}
}

function displayError(input, message){
	input.style.borderColor = 'red';
	var parent = input.parentNode;
	var error = document.createElement('p');

	error.style.color = 'red';
	error.innerHTML = message;
	parent.appendChild(error);
}

function checkTextLengthMin(value, minLength){
	return value.length >= minLength;
}

function checkTextLengthMax(value, maxLength){
	return value.length <= maxLength;
}

function checkTextValue(value, minLength, maxLength){
	var error = 0;

 	if(!checkTextLengthMin(value, minLength)) {
 		error = 'Il faut au moins ' + minLength + ' caractères.';
 	}
 	if(!checkTextLengthMax(value, maxLength)) {
 		error = 'Il faut au plus ' + maxLength + ' caractères.';
 	}
 	return error;
}