var width = [];
var progress;
var tabSetIntervals = [];
var stopIntervalIndex = 0;
$(function(){
	$.ajax({
		type : 'get',
		dataType: 'json',
		url : 'controller/game/ajaxProgressGame.php',
	}).done(function(data){
		for(let i = 0 ; i < data.length - 1; i += 2)
		{	
			width[i] = 0;
			tabSetIntervals[i] = setInterval(function(){
				progressBarChose(data[i],data[i+1],i)
			},20) ;
		}
	});
});

function progressBarChose(idGame,percentage,idWidth)
{	
	
	if(width[idWidth] >= percentage )
	{		
		clearInterval(tabSetIntervals[idWidth]);
	} else {
		width[idWidth]++;
		$('#progressBar'+idGame).css('width' , width[idWidth] +'%' );
		$('#progressBar'+idGame+' p').html(Math.floor(width[idWidth]) + '%');		
	}
}