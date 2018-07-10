$(function(){
	bootbox.confirm({
		message: "ARE YOU READY ?",
		buttons: {
			confirm: {
				label : 'YES',
				className: 'btn-success'
			},
			cancel: {
				label: 'NO, I SURREND',
				className: 'btn-danger'
			}
		},
		callback: function(truth){
			if(truth == false){	

				gameOver();								
			}else{						
				//obtenir le temps, le nb d'instructions et l'ordre des instructions
				getInformations();	
				
				//obtenir les coordonnées de la souris en fonction des coordonnées de la div dans laquelle on joue
				$(document).mousemove(function(e){		 		
					x = e.pageX ;//- getLeft(coordinates);
					y = e.pageY - $('#play').offset().top ;//- $('#play').offset().top ;//- getTop(coordinates);
				});
				//deplacer les instructions		
				$('#play button').on({
					mousedown : function(){
						var listTopId = fillTablesTop(this,nbBox);
						var listBotId = fillTablesBot(this,nbBox);																
						insMove(this,listTopId,listBotId);	
					},	
					mouseup : function(){						
						var listTopId = fillTablesTop(this,nbBox);
						var listBotId = fillTablesBot(this,nbBox);																
						insMove(this,listTopId,listBotId);
					}																
				}); 

				/*$('#play button').on({
					mousedown : function(){
						var getId = $(this).attr('id');
						var getH = getHeight(this);
						var top = $(this).offset().top;
						$(this).css('left',x - Math.round(getH/2));
						$(this).css('top',y - getId*getHeight(this) + 0.5*getH );
						for(var i = 1 ; i <= nbBox ; i ++ )
						{	
							if( i != getId && ( getH + top ) > $('#' + i).offset().top && ( getH + top ) < ( $('#' + i).offset().top + getH ) )
							{
								
								$('#' + i).css({'left' : 0, 'top' : y - top });
								//break;			
							}
							if( i != getId &&  top < $('#' + i).offset().top + getH && ( getH + top ) > ( $('#' + i).offset().top + getH ) )
							{
								
								$('#' + i).css({'left' : 0, 'top' : y - i*getH*0.5 });
								//break;			
							}
						}
					}/*,
					mouseup : function (){

					}

				});*/

				//abandons
				$('#surrend, .surrend').on('click',function(){
					if(confirm("DO YOU REALLY WANT TO SURREND ?"))
						gameOver();
				});								
				//confirm
				$('#validate').on('click',function(){
					validate();					
				});
			}
		}
	});
});	
