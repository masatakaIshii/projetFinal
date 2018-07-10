$(function() {
	$("#manageBack").on('click', '#insertContents', function() {
		var table = $('#manageBack h4 span').text();

		if(confirm('Confirm the inputs of ' + table + '\'s table?')) {
			var inputs = $('#tableContent input');
			var length = inputs.length;
			var columns = $('#tableContent label');
			var columnsInputs = {};

			columnsInputs = objectNamesInputs(columns, inputs, length);
			$.post({
				data: {inputs : columnsInputs, tabName : table},
				url: 'controller/backend/insertInputs.php',
				timeout: 4000,
				success: function(data) {
					putTabValueToCreateButton();
					
					$('#show').empty();
					$(data).appendTo('#show');
					showCreateButton(table);
				}
			});
		}
	});
});

function objectNamesInputs(names, inputs, length) {
	var i;
	var objet = {};
	var name;
	var input;

	for(i = 0; i < length; i++) {
		name = $(names[i]).html();
		input = $(inputs[i]).val();

		objet[name] = input;
	}
	
	return objet;
}

function putTabValueToCreateButton() {
	var text = $("#tableContent span").text();
	$('#createButton').val(text);
}