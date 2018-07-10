$(function() {
	$('#newSubject').on('click', '#deleteButton', function() {
		var idTopicVal; // id of topic to delete

		if(confirm("Do you confirm your comment ?")) {
			idTopicVal = $(this).val();

			$.post({
				data : {idTopic : idTopicVal},
				url : 'controller/forum/ajaxDeleteTopic.php',
				dataType : 'json',
				timeout : 5000,
				success: function(data) {
					console.log(data);
					showErrorOrLoad(data);

				},
				error : function(message) {
					console.log(message);
					console.log('The request for topic did not succed.');
				}
			});
		}
	});
});

function showErrorOrLoad(json){
	var parent = $('#newSubject');
	if(json.error) {
		parent.append(json.error)
	} else {
		location.reload();
	}
}