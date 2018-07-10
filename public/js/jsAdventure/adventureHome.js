var progress;
var width = 1;
function progressBarHome(percentage)
{	
	//var width = Math.floor( $('#progressBar').width() / $('#insideBar').width() );
	if(width >= percentage )
	{
		clearInterval(progress);
	} else {
		width++;
		$('#insideBar').css('width' , width +'%' );	
		$('#insideBar').html(Math.floor(width) + '%');		
	}
}

$(function(){	
	$.ajax({
		type : 'get',
		url : 'controller/game/ajaxAdventureHome.php',
		data : 'req=' + 'progress',
	}).done(function(data){
		progress = setInterval(function(){progressBarHome(data)},10);
	});	

	$('#adventureReset').click(function(){
		$.ajax({
			type : 'post',
			url : 'controller/game/ajaxAdventureHome.php',
			data : 'req=' + 'deleteAdventure',
		}).done(function(){
			location.reload();
		});
	});
});
