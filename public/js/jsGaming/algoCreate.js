function link(txt,redirection,top,nameId)
{	
	if(redirection == 0){
		var a = document.createElement('p');
	} else {
		var a = document.createElement('a');
		a.href = redirection;
	}		
	a.className = "w-100 p-2 text-center";
	a.innerHTML = txt;
	if(nameId){
		a.id = nameId;
	}	
	a.style.display = "block";		
	$(a).css({'top': top, 'position' :'absolute'});				
	$(a).appendTo('body');
}

function newImg(src,nameId)
{
	var img = document.createElement('img');
	if(nameId){
		img.id = nameId;
	}					
	img.src = src;
	img.style.display = "block";					
	$(img).css({'height' : '100%', 'width' : '100%'});					
	$(img).appendTo('body');
	$('body').fadeToggle("slow");
}	
/*
function imgHide(src,nameId,top)
{
	var img = document.createElement('img');
	img.id = nameId;
	img.top = top;				
	img.src = src;
	img.style.display = "block";					
	//$(img).css({'height' : '128px', 'width' : '128px'});					
	$(img).appendTo('body');
} */
//});
