if(typeof ok !== "undefined"){

function puzzleTab(nbBox) //range les valeurs top dans un tableau
				{	
					var h,h2,btn,btn2,memo;
					var c = 1;		
					var tab = [];		
					for (var i = 1; i <= nbBox; i++) {
						tab.push(i);
					}		
					while(c != 0)//triage
					{	
						c = 0;
						for (var i = 0; i < nbBox - 1; i++) {
							btn = $('#' + tab[i]);				
							h = getTop(btn);
							btn2 = $('#' + tab[i+1]);
							h2 = getTop(btn2);
								if(h > h2)
								{
									memo = tab[i+1];
									tab[i+1] = tab[i];
									tab[i] = memo;
									c = 1;	
								}
						}
					}		
					return tab;
				}

				function verifPuzzle(nbBox,tabAnswer)
				{	
					var tabResolv = [];
					for(var i = 0; i < nbBox; i++)
					{
						tabResolv.push(insOrder[i]);
					}
					
					for (var i = 0; i < nbBox; i++) {
						
						if(tabAnswer[i] != tabResolv[i])
						{
							return false;
						}
					}
					return true;
				}
}