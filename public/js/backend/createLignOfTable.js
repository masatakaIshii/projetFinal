$(function() {
	$('#manageBack').on('click', '#createButton', function() {
		var table = $('#createButton').val();

		unsetCreateButton();

		if (table) {
			$.post({
				data: {tabName : table},
				url: 'controller/backend/prepareCreateLign.php',
				timeout: 3000,
				success: function(data) {
					$("#show").empty();
					$("#createButton").removeAttr('value');
					$("#show").append(data);
				}
			});
		}
	});
});

