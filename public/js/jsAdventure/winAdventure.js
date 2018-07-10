
function winAdventure()
{	
	cptLose++;
	if(cptLose == 1){
		IncrementPlayTime('STOP!');
		$.ajax({
			url : 'controller/game/winAlgoControl.php',
			type : 'POST',
			data : {numPuzzle : nbr2[nbr2.length-1], rTime : time, timePlaying : playTimeUser,adv : 1 },		
		}).done(function(message){
	
			var reqAjax = $.ajax({
				url : 'controller/game/forAjaxAlgo.php',
				type : 'get',
				data : {win : 1,numPuzzle : nbr2[nbr2.length-1],adv :1},
			}).fail(function(message){
				console.log(message);
			});
			
			reqAjax.done(function(data){
				console.log(data);
				var dataInfo = data.split(";");			
				if(dataInfo[1] == 'last')
				{	
					userPts = dataInfo[0];
					emptyBody();
					setTimeout(function(){newImg('public/image/pannuelwin.png')},1500);
					setTimeout(function(){link('New score : '+userPts,0,200,'buttonWin')},1500);
					setTimeout(function(){link('Continue','index.php?action=game&direction=adventureChoseGameView',350,'buttonWin')},1500);
					setTimeout(function(){link('Exit','index.php',500,'buttonWin')},1500);
				} else {					
					userPts = dataInfo[0];
					var nextSequence = dataInfo[1];
					emptyBody();
					setTimeout(function(){newImg('public/image/pannuelwin.png')},1500);
					setTimeout(function(){link('New score : '+userPts,0,200,'buttonWin')},1500);
					setTimeout(function(){link('Continue','index.php?action=game&direction=play&numSequence='+nextSequence,350,'buttonWin')},1500);
					setTimeout(function(){link('Exit','index.php',500,'buttonWin')},1500);					
				}
				
			});
		});
	}		
}	
