$(function(){
	$('#offerPseudo').on('click','#offerPseudoAdventure', function(){		
		document.getElementById('newPseudo').value = '' ;
		document.getElementById('newPseudo').value = $(this).html();		
	});
});

function changeGenderImg(gender)
{
	if(gender.value == 'male')
	{
		$('#genderAdventureMale').css('visibility', 'visible');
		$('#genderAdventureFemale').css('visibility', 'hidden');

	} else {

		$('#genderAdventureMale').css('visibility', 'hidden');
		$('#genderAdventureFemale').css('visibility', 'visible');
	}
}

function confirmNewAdventure()
{	
	var newPseudo = $('#newPseudo').val();
	var verifOffer;
	var reqAjax = verifPseudoAdventure(newPseudo);
	var secondReqAjax;
	var divError = document.getElementById('offerPseudo');
	if(verifRegExpPseudo(newPseudo) )
	{	
		reqAjax.done(function(data)
		{	
			if(data == 1)
			{	
				$('#adventureForm').removeAttr('onsubmit').submit();

			} else {
				$(divError).html('');
				 $("<p id='adventureFormLabel'>Pseudo already taken, please try this :</p>").appendTo($(divError));
				for(var i = 0; i < 3 ; i++) {
					verifOffer = offerPseudo(newPseudo);
					secondReqAjax = verifPseudoAdventure(verifOffer);
					secondReqAjax.done(function(newData){
						if(newData == 1){
							appendPseudo(offerPseudo(newPseudo),divError);
						}
						else{							
							i--;
						}

					});					
				}
			}
		});
	}
}

function appendPseudo(newPseudo,div)
{	
	var p = document.createElement('p');
	p.id = 'offerPseudoAdventure';
	p.innerHTML = newPseudo;
	div.appendChild(p);
}

function verifRegExpPseudo(pseudo)
{	
	var length = pseudo.length;
	var i;
	var c = 0;
	var countNumber = 0;
	var countLetter = 0;
	var regexPseudo = /\W/;
	if(regexPseudo.test(pseudo))
	{
		writeErrorPseudoAdventure('Specials caracters must be removed.');
		return false;	
	}

	if(length < 4 || length > 9)
	{
		writeErrorPseudoAdventure('Thanks to enter a pseudo between 4 and 9 caracters.');
		return false;
	}

	for( i = 0 ; i < length ; i++)
	{
		if( isNaN(parseInt(pseudo[i])) )
		{
			countLetter++;
		}
	}

	if(countLetter < 4)
	{
		writeErrorPseudoAdventure('Thanks to enter a pseudo with a minimum of 4 letters.');
		return false;
	}

	countLetter = 0;

	for ( i = length - 1; i >= 0; i--) {
		if(!isNaN(parseInt(pseudo[i])) && countLetter == 0)
		{
			countNumber++;
		} else if(!isNaN(parseInt(pseudo[i])) && countLetter > 0) {
			writeErrorPseudoAdventure('The numbers have to be at the end of your pseudo.');
			return false;
		} else {
			countLetter++;
		}
	}

	if(countNumber > 3)
	{
		writeErrorPseudoAdventure('You can\'t have more than 3 numbers in your pseudo.');
		return false;
	}

	return true;
}

function verifPseudoAdventure(pseudo)
{	
	return $.ajax({
		url : 'controller/game/ajaxAdventureConfirm.php',
		type : 'get',
		data : "newPseudo=" + pseudo,
	});	
}



function offerPseudo(badPseudo)
{
	
	var number = Math.floor((Math.random() * 3) + 1);//random entre 1 et 3 
	var goodPseudo;
	//enlever les chiffres
	
	for (var i = badPseudo.length - 1 ; i >= 0; i--) {
		if(isNaN(parseInt(badPseudo[i]) ) )
		{
			break;
		} else {
			badPseudo = badPseudo.substr(0,i);
		}
	}
	goodPseudo = badPseudo ;
	//rajouter les chiffres
	for (var i = 0 ; i < number ; i++) {
		goodPseudo +=  Math.floor((Math.random() * 9) + 1);//random entre 1 et 9
	}

	return goodPseudo;	
}

function writeErrorPseudoAdventure(errorString)
{	
	document.getElementById('errorPseudoAdventure').innerHTML = "";
	var p = document.createElement('p');
	var div = document.getElementById('errorPseudoAdventure');
	p.className="text-center text-danger";
	p.innerHTML = errorString;
	div.className = "col-sm-12 pb-3 pt-2 alert alert-danger";
	div.role="alert";
	div.appendChild(p);
}