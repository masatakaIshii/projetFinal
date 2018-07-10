function win()
{	
	cptLose++;
	if(cptLose == 1){
		$.ajax({
			url : 'controller/game/winAlgoControl.php',
			type : 'POST',
			data : {numPuzzle : nbr2[nbr2.length-1], rTime : time },			
			error : function(txt)
			{
				alert(txt);
			}
		});

		var reqAjax = $.ajax({
			url : 'controller/game/forAjaxAlgo.php',
			type : 'get',
			data : "win=" +1,
		});
		
		reqAjax.done(function(data){
			console.log(data);
			userPts = data;
			emptyBody();
			setTimeout(function(){newImg('public/image/pannuelwin.png')},1500);
			setTimeout(function(){link('New score : '+userPts,0,200,'buttonWin')},1500);
			setTimeout(function(){link('Continue','index.php?action=game&direction=access',350,'buttonWin')},1500);
			setTimeout(function(){link('Exit','index.php',500,'buttonWin')},1500);
		});
	}		
}	
