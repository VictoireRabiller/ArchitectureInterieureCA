
"use strict";
console.log("main.js chargé");



$( '#formContact').submit(function() {

  $( 'test2' ).val($( '#test1' ).val());

});



// function initElement()
// {
//   var p = document.getElementById("slider");
//   p.onclick = showSlides;
// };


var slideIndex = 1;

showSlides(slideIndex);

// Next/previous controls
function plusSlides(n) {
  showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  // var slideIndex = 1;
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {
    slideIndex = 1
  }
  if (n < 1) {
    slideIndex = slides.length
  }
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }

  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
} 

$('#prev').on('click', function(){
  plusSlides(-1);
});

$('#next').on('click', function(){
  plusSlides(1);
});

$('#dot1').on('click', function(){
  currentSlide(1);
});
$('#dot2').on('click', function(){
  currentSlide(2);
});
$('#dot3').on('click', function(){
  currentSlide(3);
});
$('#dot4').on('click', function(){
  currentSlide(4);
});
$('#dot5').on('click', function(){
  currentSlide(5);
});
$('#dot6').on('click', function(){
  currentSlide(6);
});
$('#dot7').on('click', function(){
  currentSlide(7);
});
$('#dot8').on('click', function(){
  currentSlide(8);
});
$('#dot9').on('click', function(){
  currentSlide(9);
});
$('#dot10').on('click', function(){
  currentSlide(10);
});
$('#dot11').on('click', function(){
  currentSlide(11);
});
$('#dot12').on('click', function(){
  currentSlide(12);
});
$('#dot13').on('click', function(){
  currentSlide(13);
});
$('#dot14').on('click', function(){
  currentSlide(14);
});
$('#dot15').on('click', function(){
  currentSlide(15);
});
$('#dot16').on('click', function(){
  currentSlide(16);
});
$('#dot17').on('click', function(){
  currentSlide(17);
});
$('#dot18').on('click', function(){
  currentSlide(18);
});






// var slideIndex = 0;
// showSlides();

// function showSlides() {
//   var i;
//   var slides = document.getElementsByClassName("mySlides");
//   for (i = 0; i < slides.length; i++) {
//     slides[i].style.display = "none";
//   }
//   slideIndex++;
//   if (slideIndex > slides.length) {slideIndex = 1}
//   slides[slideIndex-1].style.display = "block";
//   setTimeout(showSlides, 2000); // Change image every 2 seconds
// } 

