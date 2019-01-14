'use strict';   



function displayImage() {
	console.log('displayImage',app.counter);
	var image = imageList[app.counter];

	$('#carrousel img').attr('src', image.file);

}

function playNextImage() {
	
	app.counter++;
		
	if (app.counter == imageList.length){

		app.counter = 0 ;
	}

	displayImage();

}



function playImages(){
	
	app.intervalID = setInterval(playNextImage, 3000);

}



