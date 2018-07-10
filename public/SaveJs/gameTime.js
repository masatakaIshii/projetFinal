if(typeof ok !== "undefined"){
function countdown(seconds)
					{	
					if(seconds > 0){
						return seconds - 1;
					} else {
						return 0;
					}
				}	
				
				function getTime()
				{	
					var s = countdown(time);					
					$('#pGameS').html(s + 's');
					time = s;
				}

				function timeDown()
				{	
					if(time == 0){
						stopTime(tdown);
					}
					var tdown = setInterval( function(){ getTime(); }, 1000);					
					setTimeout(function(){ navTime(); }, (1000 * time) - 10000);//10 s restantes					
				}

				function stopTime(interval)
				{
					clearInterval(interval);
				}

				function navTime()
				{
					var nav = setInterval(function (){ changeNavColor();}, 1000);
					if(time == 0){
						stopTime(nav);
					}
				}

				function changeNavColor()
				{						
					if(colorNav == 0){
						$('#navGame').css({'background-color' : 'red', 'transition' : 'all 1s'});
						colorNav++;
					} else {
						$('#navGame').css({'background-color' :'black', 'transition' : 'all 1s'});
						colorNav--;						
					}	
				}
}