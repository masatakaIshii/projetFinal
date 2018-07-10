
function getTop(par)
{			
	return par.offsetTop;
}

function getLeft(par)
{			
	return par.offsetLeft;
}

function getHeight(par){	
	return par.offsetHeight;
}

function getWidth(par){
	return par.offsetWidth;
}

function posZero(btn)
{
	$(btn).css({'top' : 0, 'left' : 0});
}

function game(pass)
{	
	var h = getHeight(pass);
	var w = getWidth(pass);			
	var getId = $(pass).attr('id');
	$(pass).css('left',x - Math.round(w/2));
	$(pass).css('top',y - getId*getHeight(pass) + 0.5*getHeight(pass) );	
}



	/*
	function verifPosition(element)// verif que les boutons ne sortent pas de la div
	{	
		var posElement = getTop(element) + getHeight(element);
		var permut = 0;
		var btnId = $(element).attr('id');
		for (var i = 1; i <= nbBox; i++ ) {
			if(btnId != i && posElement >= getTop(document.getElementById(i)) && posElement < (getTop(document.getElementById(i)) + getHeight(document.getElementById(i)) ) )
			{	
				permutePos(document.getElementById(btnId),document.getElementById(i),btnId,i);
				permut++;
			}
		}

		if(permut == 0)
		{
			posZero(element);
		}

		/*

		if(firstId == secondId ) // si le joueur a cliqué deux fois sur le meme btn
		{
			posZero(element);//remet lemlement a sa position initiale
			
		} else {

			permutePos(firstId,secondId,element);
			//console.log(getTop(document.getElementById(1)));
		}
		//console.log(firstPos);
		//console.log(getTop(firstElement));
		/*console.log(firstElement);
		console.log(firstPos);
		console.log(element);
		console.log(getTop(element)); 
		if(firstPos != getTop(element))
		{
			/*for (var i = 0; i < nbBox ; i--) {			
				var secondPos = getTop(element) + getHeight(element);
				var firstPos = pos + getHeight(element);//ici top du premier btn + taille dun bouton
				var secondId = $(element).attr('id');// id du deuxieme btn

				if(numPos != (i+1) && firstPos > getTop(otherBtn) && firstPos < secondPos)
				{
					permutePos(element,otherBtn,pos);				
				}
			} 
			permutePos(firstElement,element,firstPos,getTop(element));	
		} else {

			if(getTop(element) > getTop(validBtn)   || getTop(element) < getTop(coordinates) )
			{
				$(element).css('top',0);
			}

			if(getLeft(element) > 0 || getLeft(element) < 0)
			{
				$(element).css('left',0);
			}
		}		
	} 

	function permutePos(firstEl,secondEl,id1,id2)
	{	
		
		console.log(btnHeight);
		$(firstEl).css({'left' : 0, 'top' : getTop(secondEl) - (id1+0.1)*btnHeight}); //- (3.5+(id1-1))*getHeight(firstEl) });
		$(secondEl).css({'left' : 0, 'top' : firstTop - (id2+0.1)*getHeight(firstEl)}); //- (3.5+(id2-1))*getHeight(firstEl) });
		
	} */

	/*
	function permutePos(firstId,secondId,btn)
	{	
		if(firstId > secondId){
			$(firstId).css({'left' : 0, 'top' : -(getHeight(btn)*(firstId-secondId)) });
			$(secondId).css({'left' : 0, 'top' : getHeight(btn)*(firstId-secondId) });
		} else {
			$('#'+firstId).css({'left' : 0, 'top' :  getHeight(btn)*(secondId-firstId) });
			$('#'+secondId).css({'left' : 0, 'top' : -(getHeight(btn)*(secondId-firstId)) });
			//console.log(firstId,secondId);
			var first = $('#'+firstId);
			var second = $('#'+secondId);
			first.removeAttr('id');
			second.removeAttr('id');
			first.attr('id',secondId);
			second.attr('id',firstId);
			//document.getElementById(firstId).id = 2;
			//document.getElementById(secondId).id = 1;
			//$('#'+firstId).attr('id', secondId);
			//$('#'+secondId).attr('id', firstId);
			console.log(document.getElementById(firstId).id);
			console.log(document.getElementById(secondId).id);


		}		
	}	*/
	/*
	function permutePos(firstElement,secondElement,firstPos,secondPos)
	{	
		console.log(firstElement,secondElement,firstPos,secondPos);
		$(firstElement).css({'top' : 0, 'left' : 0});
		$(secondElement).css({'top' : 0, 'left' : 0});
	} */	

	
//});