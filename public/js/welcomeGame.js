
	function welcome()
	{	
		cptWelcome++;
		if(cptWelcome == 1){
			emptyBody();
			setTimeout(function(){newImg('public/image/accueilJeu.png');},1500);
			setTimeout(function(){link('Adventure','index.php?action=game&direction=adventureHome',200,'menuGame1');},2000);
			setTimeout(function(){link('Puzzles','index.php?action=game&direction=access',400,'menuGame2');},2000);
			setTimeout(function(){link('Exit','index.php',600,'menuGame3');},2000);
			setTimeout(function(){	
				$('body').removeClass("bg-light");
				$('body').css({'background-color':'black', 'z-index' : -1}); },2000);	
		}		
		//images cachées 
		
		//setTimeout(function(){imgHide('public/image/backpack.png','imgHide1',300);},1500);
		//setTimeout(function(){imgHide('public/image/accueilJeu.png','imgHide2',500);},1500);
		//setTimeout(function(){imgHide('public/image/accueilJeu.png','imgHide3',700);},1500); 
		//liens		
	}

	$(function(){
		$('#crossExit').on("click", function(){
		welcome();
		});
	});
	

	/*$('body').on("click",function(){
		alert('yo');
		$('#imgHide1').css('visibility', 'inline-block');
	}); */


/*
$('#menuGame2').hover(function(){
	$('#imgHide2').css('visibility', 'inline-block');
});


$('#menuGame3').hover(function(){
	$('#imgHide3').css('visibility', 'inline-block');
}); */



