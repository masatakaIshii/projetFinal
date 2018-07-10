
function emptyBody()
{
	$('body').fadeOut(1300, function(){
		$('body').empty();
	});					
}

function gameOver()
{	
	cptLose++;
	if(cptLose == 1){
		emptyBody();
		setTimeout(function(){newImg('public/image/gameOverW.jpg');},1500);
		setTimeout(function(){link('Come back','index.php?action=game&direction=access',0,"buttonJouerOver");},1500);
		setTimeout(function(){link('Retry','javascript:window.location.reload()',200,"buttonJouerOver");},1500);
		setTimeout(function(){link('Exit','index.php',400,"buttonJouerOver");},1500);
		setTimeout(function(){ $('body').css('background-color',' rgb(83,131,171)') } ,1500);			
	}		
}

function wrong()
{
	$('#validate').fadeIn("slow",function(){
		$('#validate').css('background-color', 'red');
		$('#validate').html('Wrong !');			
	});
	setTimeout(function(){
		$('#validate').fadeIn("slow",function(){
		$('#validate').css('background-color', 'black');
		$('#validate').html('Confirm');			
	});
	},1000);	
}
