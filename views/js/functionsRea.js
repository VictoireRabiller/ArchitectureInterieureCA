'use strict';   



function displayImage() {
	console.log('displayImage',app.counter);
	var image = imageListRea[app.counter];

	$('#carrousel img').attr('src', image.file);

}

function playNextImage() {
	
	app.counter++;
		
	if (app.counter == imageListRea.length){

		app.counter = 0 ;
	}

	displayImage();

}



function playImages(){
	
	app.intervalID = setInterval(playNextImage, 3000);

}



 



function playPreviousImage() {
	
	app.counter--;
		
	if (app.counter < 0 ){

		app.counter = imageListRea.length - 1 ;
	}

	displayImage();

}






function pauseImages() {
  
  	clearInterval(app.intervalID);

}
