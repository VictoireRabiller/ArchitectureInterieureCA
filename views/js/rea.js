'use strict';   
console.log("rea.js chargé");

var app = {}; //app pour application

app.intervalID = null ;
app.counter = 0;

 //variable globale à déclarer en dehors de toutes les fonctions afin d'etre partagée avec tous les fichiers js
 //on les déclare dans un objet 


function main () {


	$('#forward').on('click', function(){
		
		playNextImage();
	
	});
	
	
	displayImage();



	$('#backward').on('click', function(){
		
		playPreviousImage();

	});
	



	var buttonPlay = $("#play");

	var buttonPause = $('#pause');

	
	$( buttonPlay ).click(function() {
	 
	  	$( "#pause" ).toggle() && buttonPlay.toggle() ;
	  	// console.log(imageListRea);
		playImages();
	
	});


	$( buttonPause ).click(function() {

	  	$( "#play" ).toggle() && buttonPause.toggle() ;

	  	pauseImages(app.intervalID);

	});



$(document).on('keydown', function (event) {

	console.log(event.which);

	if (event.which == 39) { // arrow right
		playNextImage();
	}

	if (event.which == 37) { // arrow left
		playPreviousImage();
	}

	if (event.which == 32) { // space
		playImages();
	}

});

displayImage();


};
$(main);