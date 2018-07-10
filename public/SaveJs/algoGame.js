$(document).ready(function(){
	bootbox.confirm({
		message: "Are you sure to continue ? Click on Yes to begin or on No to relax ",
		buttons: {
			confirm: {
				label : 'Yeah, of course !',
				className: 'btn-success'
			},
			cancel: {
				label: 'No, I\'m going to sleep, hmm anyway',
				className: 'btn-danger'
			}
		},
		callback: function(truth){
			if(truth == false){
				$.ajax({
					url : 'view/game/playAlgoView.php',
					type : 'POST',
					data : "truth="+ 'false',					
					error : function(status)
					{
						alert('Echec annulation');			
					}
				});				
			}else{
				var insOrder;
				var ok = 1;
				var coordinates = $("#play");
				var x,y,starting;	
				var condition = 'undefined';
				var fps = 30;
				var nbBox;
				var time = 15;
				var str;
				var frequency = Math.round(1000/fps);	
				var c = 0;
				var nbr = location.search;//parametre GET dans l'url
				var nbr2 = nbr.split("=");
				var colorNav = 0;				
							
				//obtenir le temps, le nb d'instructions et l'ordre des instructions
				$.ajax({
					url : 'controller/game/forAjaxAlgo.php',
					type : 'POST',
					data : "nbr=" + nbr2[nbr2.length-1] ,
					dataType : 'html',					
					success : function(data)
					{	
						str = data.split(";") ;
						insOrder = str[0];
						nbBox = insOrder.length;
						//time = str[1];			
					},
					error : function(status)
					{
						alert('aie');			
					}
				}); 

				timeDown(); // on commence le décompte du temps			
				//obtenir les coordonnées de la souris en fonction des coordonnées de la div dans laquelle on joue
				$(document).mousemove(function(e){		 		
					x = e.pageX - getLeft(coordinates);
					y = e.pageY - getTop(coordinates);	
				});				
				//deplacer les instructions		
				$('#play button').on('click', function(){	
					if(c == 0){
						var pass = this;		
						starting = setInterval( function(){ game(pass); }, frequency);
						c++;
					} else {
						pass = this;		
						clearInterval(starting);
						verifPosition(pass);
						c--;
					}					
				}); 
				
				$('#validate').on('click',function(){

					var tabAnswer = puzzleTab(nbBox);
					condition = verifPuzzle(nbBox,tabAnswer);

					if(condition == true)
					{
						alert("C'est gagné !");
					} else {
						alert("C'est perdu !");
						time = 0;
					}
				});				
			}
		}
	}); 	
});