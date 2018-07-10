var nameToDelete;
//Recuperer les ID et suppression d'utilisateur
$(function() {
;
	$('#show').on("click"," .btn-danger",function(){

		if(confirm("Confirm the removal of the line?")){
			var name = nameToDelete; // on stock la table visée dans la bdd
			var idname = $(this).attr("id"); // on stock le numéro d'id utilisateur à supprimer dans la bdd
			var rowtodelete = $(this).closest('tr'); // on stock la ligne à supprimer
			$.ajax({
				url :'controller/backend/deleteFunction.php', // nom de la page ciblée
				dataType : 'html', // type de donnée à recevoir
				type : 'POST',
				data : {numid : idname, tablename : name}, //on envoie la variable POST à la fct showtable

				success : function(statut){ //table contient la data recup donc le tableau de la fonction fdisplay
					rowtodelete.remove(); // on supprime la ligne stockée dans la variable rowtodelete
				},

				error : function(statut){
					document.write("Erreur :" + statut);

				}
			}); 
		}
	});

	// action du click des boutons
	$('#btns > button').click(function() /*  quand on clique sur un bouton situé dans la div d'id btns*/
	{	
		var name = $(this).attr("id"); // parametre quon envoie a showTableFunction, avec this, le selecteur detecte automatiquement quel bouton a été cliqué
		nameToDelete = name;

		$.ajax({
				url :'controller/backend/showTableFunction.php', // nom de la page ciblée
				dataType : 'html', // type de donnée à recevoir
				type : 'POST',
				data : 'tablename=' +  name, //on envoie la variable POST à la fct showtable

				success : function(table,statut){ //table contient la data recup donc le tableau de la fonction showTableFunction
						
						$("#show").empty(); //on efface lancien tableau 
						showCreateButton(name);
						$(table).appendTo("#show"); // si requete a marché, on met les données recup a la fin dune div id=afficher
				},
				error : function(statut){
						document.write("Erreur :" + statut);
						console.log(statut);
				}
		});
	});	
});

function showCreateButton(tabName) {
	var createButton;
	var parent;

	unsetCreateButton(tabName);
	createButton = document.createElement('button');
	parent = $('#showCreateButton')[0];

	$(createButton).attr('typr', 'button').attr('id', 'createButton');
	$(createButton).addClass('col-3 col-md-2 col-lg-2 col-auto btn btn-success');
	$(createButton).text('Create');
	$(createButton).val(tabName);
	
	$(createButton).appendTo(parent);
}

function unsetCreateButton() {
	if($('#createButton')) {
		$('#createButton').remove();
	}
}