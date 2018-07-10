
function insMove(element,topTable,botTable)
{	
	zValue++;	
	$(element).css('z-index',zValue);// on met le btn au dessus des autres.
	if(c == 0){	
		moveElement = setInterval(function(){
	   		changePosBtn(element,topTable,botTable);
		},10);			
		starting = setInterval( function(){ game(element); }, frequency);
		c++;
	} else {			
		clearInterval(starting);
		clearInterval(moveElement);
		goodPosition(element);
		c--;	
	}
}

function moveBtn(pass)
{	
	var h = getHeight(pass);
	var w = getWidth(pass);			
	var getId = $(pass).attr('id');
	$(pass).css('left',x - Math.round(w/2));
	$(pass).css('top',y - getId*getHeight(pass) + 0.5*getHeight(pass) );
}

function goodPosition(element)
{	
	$(element).css({'left' : 0,'top' : oneTop - ($(element).attr('id') - 1)*getHeight(element) });
} 

function fillTablesBot(element,number)
{	
	var tabBot = [];
	var idElement = $(element).attr('id');
	var topElement = $(element).offset().top;
	for(var i = 1 ; i <= number ; i++)
	{
		if( i != idElement && $('#' + i).offset().top > topElement )
		{
			tabBot.push(i);
		}
	}
	return tabBot;
}

function fillTablesTop(element,number)
{	
	var tabTop = [];
	var idElement = $(element).attr('id');
	var topElement = $(element).offset().top;
	for(var i = 1 ; i <= number ; i++)
	{
		if( i != idElement && $('#' + i).offset().top < topElement )
		{
			tabTop.push(i);
		}
	}
	return tabTop;
}

function changePosBtn(element,topTable,botTable)
{
	var top = $(element).offset().top;
	var getId = $(element).attr('id');
	var getH = getHeight(element);
	var secondTabTop = [];
	var secondTabBot = [];
	
	for(var i = 1 ; i <= nbBox ; i ++ )
	{	
		if( i != getId &&  top  > ($('#' + i).offset().top + getH ) && !searchId(topTable,i) )
		{				
			secondTabTop = fillTablesTop($('#' + i),nbBox);			
			$('#' + i).css({'left' : 0, 'top' : -(i-1)*getH + (secondTabTop.length*getH) });//i*getH - $(coordinates).offset().top -  secondTabTop.length * getH  });
			topTable.push(i);
			botTable = deleteId(botTable,i);			 						
		}

		if( i != getId && ( top + getH ) <  $('#' + i).offset().top && !searchId(botTable,i) ) 
		{		
			secondTabBot = fillTablesBot($('#' + i),nbBox);
			$('#' + i).css({'left' : 0, 'top' : -i*getH + getHeight(coordinates)  - (secondTabBot.length*getH) }); //228 - ( secondTabBot.length * getH )  });
			botTable.push(i);
			topTable = deleteId(topTable,i);										
		}
	}
	if( topTable.length >= 1){
		oneTop = topTable.length*getH - 1 ;	
	} else {
		oneTop = 0;
	}

	
}

function searchId(array,idToSearch)
{
	for(var i = 0 ; i < array.length ; i ++ ) 
	{
		if (array[i] == idToSearch)
		{
			return true;
		}
	}
	return false;
}

function deleteId(array,idToDelete)
{
	
	for (var i = 0 ; i < array.length ; i++ ) {
		if(array[i] == idToDelete)
		{			
			array.splice(i,1);
		}
	}
	return array;
}

