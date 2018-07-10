function puzzleTab(nbBox) //range les valeurs top dans un tableau
{	
	var h,h2,btn,btn2,memo;
	var c = 1;		
	var tab = [];		
	for (var i = 1; i <= nbBox; i++) {
		tab.push(i);
	}		
	while(c != 0)//triage
	{	
		c = 0;
		for (var i = 0; i < nbBox - 1; i++) {
			btn = document.getElementById(tab[i]);//$('#' + tab[i]);				
			h = getTop(btn);
			btn2 = document.getElementById(tab[i+1]);//$('#' + tab[i+1]);
			h2 = getTop(btn2);
			if(h > h2)
			{
				memo = tab[i+1];
				tab[i+1] = tab[i];
				tab[i] = memo;
				c = 1;	
			}
		}
	}		
	return tab;
}

function verifPuzzle(nbBox,tabAnswer)
{	
	var tabResolv = [];
	for(var i = 0; i < nbBox; i++)
	{
		tabResolv.push(insOrder[i]);
	}
				
	for (var i = 0; i < nbBox; i++) 
	{						
		if(tabAnswer[i] != tabResolv[i])
		{
			return false;
		}
	}
	return true;
}

function validate()
{
	var tabAnswer = puzzleTab(nbBox);
	condition = verifPuzzle(nbBox,tabAnswer);
	if(condition == true)
	{	
		timeDown(1);						
		winAdventure();
	} else {
		wrong();					
	}
}

function getInformations()
{
	$.ajax({
		url : 'controller/game/forAjaxAlgo.php',
		type : 'POST',
		data : "nbr=" + nbr2[nbr2.length-1],
		dataType : 'html',					
		success : function(data)
		{	
			str = data.split(";") ;						
			insOrder = str[0];
			nbBox = insOrder.length;
			time = str[1];
			userPts = str[2];						
			timeDown(); // on commence le décompte du temps	
			console.log(data);							
		},
		error : function(status)
		{
			alert('aie');			
		}
		});
}					
