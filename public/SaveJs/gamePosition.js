if(typeof ok !== "undefined"){
function getTop(par)
				{	
					return $(par).offset().top;
				}

				function getLeft(par)
				{			
					
					return $(par).offset().left;
				}

function getHeight(par){	
					return par.offsetHeight;
				}

				function getWidth(par){
					return par.offsetWidth;
				}
function game(pass)
				{	
					var h = getHeight(pass);
					var w = getWidth(pass);
					$(pass).css('left',x - Math.round(w/2));
					$(pass).css('top',y - Math.round(h/2));
				}
				
				function verifPosition(element)// verif que les boutons ne sortent pas de la div
				{		
					
					if(getTop(element) > (getTop(coordinates) + getHeight(coordinates)) || getTop(element) < getTop(coordinates) )
					{
						$(element).css('top',0);
					}

					if(getLeft(element) > 0 || getLeft(element) < 0)
					{
						$(element).css('left',0);
					}
				}
}