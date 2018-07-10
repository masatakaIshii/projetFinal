
function numberInstructions()// recup nb instructions
{
	var select = document.getElementById('nbI')
	var op = select.options[select.selectedIndex];
	var nb = parseInt(op.value);
	return nb;
}
	
function createIns() // créer instrcutoins input
{	
	var number = numberInstructions();		
	var div = document.getElementById('ins');
	div.innerHTML = "";		
	for (var i = 0; i < number; i++) {						
		var input = document.createElement('input');
		var label = document.createElement('label');
		input.type = "text";
		input.required = true;
		input.className ="form-control col-sm-12";
		input.id = i + 1;
		input.name = "ins" + (i + 1);
		label.innerHTML = "Instruction " + (i + 1) +"  :";
		div.appendChild(label);
		div.appendChild(input);
	}	
}

function verifFields()
{
	
	if (!checkOrder() )
		return false;
	
	if (!checkText() )
		return false;

	return true;
}

function checkOrder()
{	
	var c = 0;
	var nb = numberInstructions();
	var answer = document.getElementsByName('answer')[0].value;
	for (var i = 0; i < nb; i++) {
		for (var j = 0; j < nb; j++) {
			if( (answer[i] < nb-(nb-1) || answer[i] > nb) || (i != j && answer[i] == answer[j]) )
				c++;
		}
	}
	if(answer.length != nb || isNaN(parseInt(answer)) || c > 0)
	{
		writeError("Merci de rentrer "+nb+" chiffres compris entre "+(nb - (nb - 1))+" et "+nb+" correspondants au bon ordre des instructions");
		return false;
	}
	return true;
}

function checkText()
{
	var text1 = document.getElementsByName('title')[0].value;
	var text2 = document.getElementsByName('entitle')[0].value;
	if(text1.length > 50)
	{
		writeError('Le titre ne doit pas dépasser 50 caractères');
		return false;
	}
	if(text2.length > 250)
	{
		writeError('L\'intitulé ne doit pas dépasser 250 caractères');
		return false;
	}
	return true;
}

function writeError(errorString)
{	
	document.getElementById('error').innerHTML = "";
	var p = document.createElement('p');
	var div = document.getElementById('error');
	p.className="text-center text-danger";
	p.innerHTML = errorString;
	div.className = "col-sm-12 pb-3 pt-2 alert alert-danger";
	div.role="alert";
	div.appendChild(p);
}