function countdown(seconds)
{	
	if(seconds > 0){
		return seconds - 1;
	} else {
		return 0;
	}
}	

		
function IncrementPlayTime(StopOrStart='')
{	
	if(StopOrStart == ''){
		setPlayTimeUser = setInterval(function(){
			playTimeUser++; 
		},1000);
	} else {
		clearInterval(setPlayTimeUser);
	}
	
}



function getTime()
{	
	var s = countdown(time);					
	$('#pGameS').html(s + 's');
	time = s;
}

function timeDown(stop)
{	
	if(time == 0 || stop == 1){
		stopTime();			
	} else {
		 tdown = setInterval( function(){ getTime(); }, 1000);					
		 navout = setTimeout(function(){ navTime(); }, (1000 * time) - 10000);//10 s restantes
		 over = setTimeout(function(){ gameOver(); }, 1000 * time);//perdu à 0sec
	}
							
}

function stopTime()
{
	clearInterval(tdown);
	clearTimeout(navout);
	clearTimeout(over);
	clearInterval(nav);
}

function navTime()
{
	nav = setInterval(function (){ changeNavColor();}, 500);
	setTimeout(function(){stopTime();}, 10000);
}

function changeNavColor()
{						
	if(colorNav == 0){		
		$('#navGame').css({'background-color' : 'rgb(176,0,0)', 'transition' : 'all 0.5s'});
		colorNav++;
	} else {			
		$('#navGame').css({'background-color' : 'rgb(64,64,64)', 'transition' : 'all 0.5s'});
		colorNav--;						
	}	
}